<?php defined('BASEPATH') OR exit('No direct script access allowed');

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
		$this->load->model('admin/settings_model');
		$data['themes'] = $this->settings_model->getThemes();
		$data['settings'] = $this->settings_model->getSettings();

		$this->load->view('admin/settings', $data);
	}

	public function changeSettings() {
		$postData = $this->input->post();

		$data = array(
			'id' => 1,
			'site_title' => $postData['siteTitle'],
			'site_theme' => $postData['siteTheme'],
			'updated_on' => date("Y-m-d H:i:s"),
		);
		$this->db->replace('acms_settings', $data);
	}

}
