<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	private $template;

	/**
	 * Pages constructor.
	 */
	public function __construct() {
		parent::__construct();

		//load page model
		$this->load->model(array('page_model', 'admin/settings_model'));

		//get slug without the first slash
		$slug = $_SERVER['REQUEST_URI'];

		//Get page data
		$this->data = $this->page_model->getPageData($slug);

		//get site theme and set path location
		$this->site_theme = '../../' . $this->settings_model->getCurrentTheme();

		//get site theme and set path location
		$this->page_template = $this->data->template_file_name;
	}

	public function page() {
		debug($this->data);
		$this->load->view($this->site_theme . '\\templates\\' . $this->page_template, $this->data);
	}
}