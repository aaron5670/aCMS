<?php defined('BASEPATH') OR exit('No direct script access allowed');

//ToDo: deze Admin Controller nog uitsplitten in een mapje Admin met daarin verschillende controllers.


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
		$this->load->view('admin/pages');
	}

	public function newPage() {
		$this->load->view('admin/new_page');
	}

	//ToDo: Validatie en formulier in view maken via CI Form builder
	public function newPagePost() {
		$data = array(
			'slug'       => $this->input->post('pageSlug'),
			'controller' => 'pages/pages',
			'page_id'    => 3,
		);
		$this->db->insert('acms_routes', $data);
	}
}
