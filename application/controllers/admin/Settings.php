<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	public $data = array();

	public function __construct() {
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('language'));
		$this->lang->load('auth');
	}

	//Admin website settings
	public function websiteSettings() {
		if (!$this->ion_auth->in_group(array('editor', 'admin'))) {
			redirect('/auth', 'refresh');
			exit();
		}

		$this->load->model('admin/settings_model');
		$allPages = $this->settings_model->getAllRoutes();
		$data['pages'] = $allPages;

		$this->load->view('admin/website-settings', $data);
	}

	public function changeWebsiteSettings() {
		if (!$this->ion_auth->in_group(array('editor', 'admin'))) {
			redirect('/auth', 'refresh');
			exit();
		}

		$postData = $this->input->post();

		$this->db->trans_start();
		$this->db->set('is_homepage', false);
		$this->db->update('acms_routes');

		$data = array(
			'is_homepage' => 1,
		);
		$this->db->where('page_id', $postData['siteHomepage']);
		$this->db->update('acms_routes', $data);
		$this->db->trans_complete();
	}

	//Super admin CMS settings
	public function cmsSettings() {
		if (!$this->ion_auth->is_admin()) {
			redirect('auth/login', 'refresh');
			exit();
		}

		$this->load->model('admin/settings_model');
		$data['themes'] = $this->settings_model->getThemes();
		$data['settings'] = $this->settings_model->getSettings();

		$this->load->view('admin/cms-settings', $data);
	}

	public function changeCMSSettings() {
		if (!$this->ion_auth->is_admin()) {
			redirect('auth/login', 'refresh');
			exit();
		}

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
