<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
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
		$this->load->model('admin/page');

		$this->load->view('admin/pages');
	}

	public function newPage() {
		$this->load->model('admin/template');
		$data['templates'] = $this->template->getRows(array('id', 'template_name'));

		$this->load->view('admin/new_page', $data);
	}

	public function loadPageTemplate() {
		$this->load->model('admin/template');
		$pageTemplate = $this->template->getRow($this->input->post('pageTemplate'));

		echo $pageTemplate[0]->template_json;
	}

	//ToDo: Validatie en formulier in view maken via CI Form builder
	public function newPagePost() {

		$postData = $this->input->post();

		//start transaction
		$this->db->trans_start();

		//Insert $dataPagesTable into the acms_pages table
		$dataPagesTable = array(
			'page_title'  => $postData['pageTitle'],
			'template_id' => $postData['templateId'],
			'author'      => $_SESSION['user_id'],
			'created_on'  => date("Y-m-d H:i:s"),
			'updated_on'  => date("Y-m-d H:i:s"),
			'updated_by'  => $_SESSION['user_id'],
		);
		$this->db->insert('acms_pages', $dataPagesTable);

		$pageID = $this->db->insert_id(); //last inserted ID

		//Insert $dataRoutesTable into the acms_routes table
		$dataRoutesTable = array(
			'slug'       => $postData['pageSlug'],
			'controller' => 'pages/pages',
			'page_id'    => $pageID,
		);
		$this->db->insert('acms_routes', $dataRoutesTable);

		//Get template_table_name from acms_templates table
		$this->db->select('id, template_table_name');
		$this->db->where('id', $postData['templateId']);
		$query = $this->db->get('acms_templates');
		$templateName = $query->result();
		$templateName = $templateName[0]->template_table_name;

		//add pageID to the post data array
		$postData['data']['page_id'] = $pageID;

		//Insert into the selected template table the form post data
		$this->db->insert($templateName, $postData['data']);
		$this->db->trans_complete();
	}
}
