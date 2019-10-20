<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public $data = array();

	public function __construct() {
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('language'));
		$this->lang->load('auth');

		if (!$this->ion_auth->in_group(array('editor', 'admin'))) {
			redirect('/auth', 'refresh');
			exit();
		}
	}

	public function index() {
		$this->load->view('admin/dashboard_page');
	}
}
