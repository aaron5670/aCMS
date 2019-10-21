<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends CI_Controller {
	public $data = array();

	public function __construct() {
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('language'));
		$this->lang->load('auth');

		/*
		 * Formio.JS version
		 * GitHub page: https://github.com/formio/formio.js
		 * Last version changed & tested on: 2019-10-16
		 *
		 * Bugs:
		 * - Data Map Component not working
		 *
		 * Notes:
		 * - By version 4.3.5 JSON Schema won't load
		 */
		$this->formioJS_Version = '4.3.2';

		if (!$this->ion_auth->is_admin()) {
			redirect('auth/login', 'refresh');
			exit();
		}
	}

	public function index() {
		$this->load->model('admin/template');
		$data['templates'] = $this->template->getRows(array('id', 'template_name', 'last_updated'));

		$this->load->view('admin/templates', $data);
	}

	public function view($id = null) {
		if ($id) {
			$this->load->model('admin/template');
			$data['template'] = $this->template->getRow($id);
			$this->load->view('admin/single_template', $data);
		} else {
			redirect('/admin/templates');
		}
	}

	public function newTemplate() {
		$this->load->model(array('admin/template', 'admin/settings_model'));
		$data['unusedTemplates'] = $this->template->getUnusedThemeTemplateFiles();
		$data['siteTheme'] = $this->settings_model->getSettings(array('site_theme'));
		$data['formioJS_Version'] = $this->formioJS_Version;

		$this->load->view('admin/new_template', $data);
	}

	//ToDo: Validatie en formulier in view maken via CI form builder
	public function newTemplatePost() {
		$templateName = $this->input->post('templateName');
		$templateFile = $this->input->post('templateFile');
		$isNewsTemplate = $this->input->post('isNewsTemplate');

		$templateTableName = 'acms_tpl_' . (strtolower(str_replace(' ', '_', $templateName)));

		$this->db->trans_start();
		$data = array(
			'template_name'       => $templateName,
			'template_table_name' => $templateTableName,
			'template_file_name'  => $templateFile,
			'is_news_template'    => false,
			'template_json'       => $this->input->post('jsonElement'),
			'last_updated'        => date("Y-m-d H:i:s"),
		);

		if ($isNewsTemplate === "true") {
			$data['is_news_template'] = true;
		}

		$this->db->insert('acms_templates', $data);
		$this->db->trans_complete();

		$jsonTemplate = json_decode($this->input->post('jsonElement'));

		$dbFields = $this->formiojs_form_json_to_db_table($jsonTemplate, $isNewsTemplate);

		$this->templateTableCreator($dbFields, $templateTableName, $isNewsTemplate);
	}

	private function formiojs_form_json_to_db_table($jsonTemplate, $isNewsTemplate) {
		$dbFields = array();

		$isNewsTemplate = filter_var($isNewsTemplate, FILTER_VALIDATE_BOOLEAN);

		//Check if news or page template
		if ($isNewsTemplate === true) {
			$dbFields['news_id'] = array(
				'type'       => 'INT',
				'constraint' => 11,
			);
		} else {
			$dbFields['page_id'] = array(
				'type'       => 'INT',
				'constraint' => 11,
			);
		}

		foreach ($jsonTemplate->components as $component) {

			//if fileupload datatype is BLOB
			if (isset($component->storage)) :
				$dbFields[$component->key] = array(
					'type'    => 'BLOB',
					'default' => null,
				);
				continue; //stop foreach loop!
			endif;

			//if has columns
			if (isset($component->columns)) :
				//foreach column
				foreach ($component->columns as $column) :
					//foreach column component
					foreach ($column->components as $columnComponent) :

						//if column has a fileupload  then datatype is BLOB
						if (isset($component->storage)) :
							$dbFields[$component->key] = array(
								'type'    => 'BLOB',
								'default' => null,
							);
							continue; //stop foreach loop!
						endif;

						$dbFields[$columnComponent->key] = array(
							'type'    => 'TEXT',
							'default' => null,
						);
					endforeach;
				endforeach;
				continue; //stop foreach loop!
			endif;

			$dbFields[$component->key] = array(
				'type'    => 'TEXT',
				'default' => null,
			);
		}

		return $dbFields;
	}

	private function templateTableCreator($fields = array(), $templateTableName, $isNewsTemplate) {
		$this->load->dbforge();

		$isNewsTemplate = filter_var($isNewsTemplate, FILTER_VALIDATE_BOOLEAN);

		//Check if news or page template
		if ($isNewsTemplate === true) {
			$this->dbforge->add_key('news_id');
		} else {
			$this->dbforge->add_key('page_id');
		}

		$this->dbforge->add_field('id');
		$this->dbforge->add_field($fields);

		//Check if news or page template
		if ($isNewsTemplate === true) {
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (news_id) REFERENCES acms_news(id) ON DELETE CASCADE ON UPDATE CASCADE');
		} else {
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (page_id) REFERENCES acms_pages(id) ON DELETE CASCADE ON UPDATE CASCADE');
		}

		$this->dbforge->create_table($templateTableName, true);
	}

	//ToDo: if pageID is invalid redirect to admin/pages
	public function editTemplate($templateID) {
		if ($templateID) {
			$this->load->model('admin/template');
			$data['formioJS_Version'] = $this->formioJS_Version;
			$data['template'] = $this->template->getRow($templateID);

			debug($data);

			$this->load->view('admin/edit_template', $data);
		} else {
			redirect('/admin/templates');
		}
	}

	public function editTemplatePost() {

		if (isset($_POST) && !empty($_POST)) {
			$this->load->dbforge();

			$templateID = $this->input->post('templateID');
			$templateTableName = $this->input->post('templateTableName');
			$templateJSON = $this->input->post('jsonElement');
			$isNewsTemplate = $this->input->post('isNewsTemplate');

			echo '<pre>';
			var_dump($_POST);

			//START DATABASE TRANSACTION
			$this->db->trans_start();

			//Update 'template_json in database' database table 'acms_templates'
			$this->db->set('template_json', $templateJSON);
			$this->db->where('id', $templateID);
			$this->db->update('acms_templates');

			//Delete all pages with this template
			$this->db->where('template_id', $templateID);
			$this->db->delete('acms_pages');

			//DROP current template table (if exits)
			$this->dbforge->drop_table($templateTableName, true);

			//Create new database table fields
			$templateJSON = json_decode($templateJSON);
			$dbFields = $this->formiojs_form_json_to_db_table($templateJSON, $isNewsTemplate);

			//Create database table
			$this->templateTableCreator($dbFields, $templateTableName, $isNewsTemplate);

			$this->db->trans_complete();
			//END DATABASE TRANSACTION
		}
	}

	public function del($templateID = null) {
		if ($templateID) {
			$this->load->model('admin/page');
			$this->load->model('admin/news_model');
			if ($this->page->checkIfPageWithTemplateExist($templateID) || $this->news_model->checkIfNewsWithTemplateExist($templateID)) {
				redirect('/admin/templates?message=some-pages-or-news-uses-this-template');
				exit();
			}
			$this->load->model('admin/template');
			$this->template->delRow($templateID);
			redirect('/admin/templates?message=successfully-deleted');
		} else {
			redirect('/admin/templates');
		}
	}
}
