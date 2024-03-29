<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {
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
		$this->load->library('logviewer');
		$data['logViewer'] = $this->logviewer->showLogs();

		$this->load->view('admin/logs', $data);
	}

}
