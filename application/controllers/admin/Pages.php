<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
	public $data = array();

	public function __construct() {
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('language', 'admin/utility'));
		$this->lang->load('auth');

		if (!$this->ion_auth->is_admin()) {
			redirect('auth/login', 'refresh');
			exit();
		}

		active_menu(array('/admin/pages', '/admin/new-page'));

	}

	public function index() {
		$this->load->model('admin/page');
		$data['pages'] = $this->page->getAllPageInfo(array('acms_pages.id', 'page_title', 'template_name', 'acms_pages.updated_on', 'first_name', 'slug', 'page_status'));

		$this->load->view('admin/pages', $data);
	}

	public function newPage() {
		$this->load->model('admin/template');
		$data['templates'] = $this->template->getRows(array('id', 'template_name'));

		$this->load->view('admin/new_page', $data);
	}

	//ToDo: if pageID is invalid redirect to admin/pages
	public function editPage($pageID) {
		$this->load->model('admin/page');
		$pageData = $this->page->getPageData($pageID);
		$pageRouteData = $this->page->getPageRouteData($pageID);
		$data['pageID'] = $pageData->id;
		$data['pageTitle'] = $pageData->page_title;
		$data['pageTemplate'] = $this->page->getPageTemplateName($pageID);
		$data['pageTemplateTable'] = $this->page->getPageTemplateTableName($pageID);
		$data['pageSlug'] = $pageRouteData->slug;
		$data['pageStatus'] = $pageRouteData->page_status;
		$data['currentTemplate'] = $this->loadCurrentPageTemplate($pageID);

		$this->load->view('admin/edit_page', $data);
	}

	public function editPagePost() {
		$postData = $this->input->post();
		if ($postData) :
			$pageID = $postData['pageID'];

			$this->db->trans_start();

			//Update acms_pages table
			$data = array(
				'page_title' => $postData['pageTitle'],
				'updated_on' => date("Y-m-d H:i:s"),
				'updated_by' => $_SESSION['user_id'],
			);
			$this->db->where('id', $pageID);
			$this->db->update('acms_pages', $data);

			//Update acms_routes table
			$data = array(
				'slug'        => $postData['pageSlug'],
				'page_status' => $postData['pageStatus'],
				'updated_on'  => date("Y-m-d H:i:s"),
				'updated_by'  => $_SESSION['user_id'],
			);
			$this->db->where('page_id', $pageID);
			$this->db->update('acms_routes', $data);

			//Update template table with page data
			$this->db->where('page_id', $pageID);
			$this->db->update($postData['pageTemplateTable'], $postData['data']);

			$this->db->trans_complete();
		endif;
	}

	public function loadCurrentPageTemplate($pageID) {
		$this->load->model('admin/page');
		return $this->page->getCurrentThemeTemplateFile($pageID);
	}

	//Load a page template if user select on!
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
			'slug'        => $postData['pageSlug'],
			'controller'  => 'pages/page',
			'page_id'     => $pageID,
			'page_status' => $postData['pageStatus'],
			'updated_on'  => date("Y-m-d H:i:s"),
			'updated_by'  => $_SESSION['user_id'],
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

	public function del($id = null) {
		if ($id) {
			$this->load->model('admin/page');
			$this->page->delRow($id);
			redirect('/admin/pages');
		} else {
			redirect('/admin/pages');
		}
	}
}
