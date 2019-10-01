<?php defined('BASEPATH') OR exit('No direct script access allowed');

//ToDo: deze Admin Controller nog uitsplitten in een mapje Admin met daarin verschillende controllers.


class Settings extends CI_Controller {
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
		$this->load->view('admin/settings');
	}

}
