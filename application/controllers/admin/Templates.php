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
		$this->load->model('template');
		$data['templates'] = $this->template->getRows(array('id', 'template_name', 'last_updated'));

		$this->load->view('admin/templates', $data);
	}

	public function view($id = null) {
		if ($id) {
			$this->load->model('template');
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
		$data = array(
			'template_name' => $templateName,
			'template_json' => $this->input->post('jsonElement'),
			'last_updated'  => date("Y-m-d H:i:s"),
		);
		$this->db->trans_start();
		$this->db->insert('acms_templates', $data);
		$this->db->trans_complete();

		$template = json_decode($this->input->post('jsonElement'));

		$dbFields = array();
		foreach ($template->components as $component) {
			$dbFields[$component->key] = array(
				'type'     => 'TEXT',
				'unsigned' => true,
			);
		}

		$this->templateTableCreator($dbFields, $templateName);
	}

	public function templateTableCreator($fields = array(), $templateName = null) {
		$templateName = str_replace(' ', '_', $templateName);

		$this->load->dbforge();

		$this->dbforge->add_field('id');
		$this->dbforge->add_field($fields);
		$this->dbforge->create_table(('acms_tpl_' . $templateName), true);
	}

	public function del($id = null) {
		if ($id) {
			$this->load->model('template');
			$data['template'] = $this->template->delRow($id);
			$this->load->view('admin/single_template', $data);
			redirect('/admin/templates');
		} else {
			redirect('/admin/templates');
		}
	}

}
