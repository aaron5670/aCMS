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

		$templateTableName = 'acms_tpl_' . (strtolower(str_replace(' ', '_', $templateName)));

		$data = array(
			'template_name'       => $templateName,
			'template_table_name' => $templateTableName,
			'template_file_name'  => $templateFile,
			'template_json'       => $this->input->post('jsonElement'),
			'last_updated'        => date("Y-m-d H:i:s"),
		);
		$this->db->trans_start();
		$this->db->insert('acms_templates', $data);
		$this->db->trans_complete();

		$template = json_decode($this->input->post('jsonElement'));

		$dbFields = array();
		$dbFields['page_id'] = array(
			'type'       => 'INT',
			'constraint' => 11,
		);
		foreach ($template->components as $component) {
			//if fileupload datatype is BLOB
			if (isset($component->storage)) :
				$dbFields[$component->key] = array(
					'type'    => 'BLOB',
					'default' => null,
				);
			else:
				$dbFields[$component->key] = array(
					'type'    => 'TEXT',
					'default' => null,
				);
			endif;
		}

		$this->templateTableCreator($dbFields, $templateTableName);
	}

	private function templateTableCreator($fields = array(), $templateTableName = null) {
		$this->load->dbforge();
		$this->dbforge->add_key('page_id');
		$this->dbforge->add_field('id');
		$this->dbforge->add_field($fields);

		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (page_id) REFERENCES acms_pages(id) ON DELETE CASCADE ON UPDATE CASCADE');

		$this->dbforge->create_table($templateTableName, true);
	}

	//ToDo: if pageID is invalid redirect to admin/pages
	public function editTemplate($templateID) {
		if ($templateID) {
			$this->load->model('admin/template');
			$data['template'] = $this->template->getRow($templateID);
			$data['formioJS_Version'] = $this->formioJS_Version;

			$this->load->view('admin/edit_template', $data);
		} else {
			redirect('/admin/templates');
		}
	}

	public function del($templateID = null) {
		if ($templateID) {

			$this->load->model('admin/page');
			if ($this->page->checkIfPageWithTemplateExist($templateID)) {
				redirect('/admin/templates?message=some-pages-uses-this-template');
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
