<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
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
		$data['users'] = $this->ion_auth->users()->result();
		foreach ($data['users'] as $k => $user) {
			$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}

		$this->load->view('admin/users', $data);
	}

}
