<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends CI_Controller {
	public $data = array();

	public function __construct() {
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('language'));
		$this->lang->load('auth');

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
		$this->load->view('admin/new_template');
	}

	//ToDo: Validatie en formulier in view maken via CI form builder
	public function newTemplatePost() {

		$templateName = $this->input->post('templateName');
		$templateTableName = 'acms_tpl_' . (strtolower(str_replace(' ', '_', $templateName)));

		$data = array(
			'template_name' => $templateName,
			'template_table_name' => $templateTableName,
			'template_json' => $this->input->post('jsonElement'),
			'last_updated'  => date("Y-m-d H:i:s"),
		);
		$this->db->trans_start();
		$this->db->insert('acms_templates', $data);
		$this->db->trans_complete();

		$template = json_decode($this->input->post('jsonElement'));

		$dbFields = array();
		$dbFields['page_id'] = array(
			'type'     => 'INT',
			'constraint' => 11,
		);
		foreach ($template->components as $component) {
			$dbFields[$component->key] = array(
				'type'     => 'TEXT',
				'default' => NULL,
			);
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

	public function del($id = null) {
		if ($id) {

			$this->load->model('admin/page');
			if ($this->page->checkIfPageWithTemplateExist($id)) {
				redirect('/admin/templates?error=some-pages-uses-this-template');
				exit();
			}

			$this->load->model('admin/template');
			$data['template'] = $this->template->delRow($id);
			$this->load->view('admin/single_template', $data);
			redirect('/admin/templates');
		} else {
			redirect('/admin/templates');
		}
	}

}
