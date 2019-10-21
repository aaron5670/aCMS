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
		$this->load->model(array('page_model', 'admin/settings_model', 'admin/menu_model', 'admin/settings_model'));

		//get slug without the first slash
		$slug = $_SERVER['REQUEST_URI'];

		//get site theme and set path location
		$this->current_theme = $this->settings_model->getCurrentTheme();
		$this->site_theme_view = '../../' . $this->current_theme;
		$this->site_theme_path = $this->current_theme . DIRECTORY_SEPARATOR . 'templates';
		$this->menu = $this->menu_model->getMenu();

		//if page isn't homepage
		if ($slug !== '/') :
			//Get page data
			$this->data = $this->page_model->getPageData($slug);
			$this->data->_MenuItems = $this->menu;
			$this->data->_SiteTitle = $this->settings_model->getSiteTitle();

			//get site theme and set path location
			$this->page_template = $this->data->template_file_name;
		endif;
	}

	//ToDo: pretty error handling if a template isn't found on the server (default template)
	public function homepage() {
		$homepageData = $this->page_model->getHomepage();
		//debug($homepageData);
		if (file_exists($this->current_theme)) {
			if ($homepageData) {
				if (file_exists($this->site_theme_path)) {
					if (file_exists($this->site_theme_path . DIRECTORY_SEPARATOR . $homepageData->template_file_name)) {

						$homepageData->_MenuItems = $this->menu;
						$homepageData->_SiteTitle = $this->settings_model->getSiteTitle();

						$this->load->view($this->site_theme_view . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $homepageData->template_file_name, $homepageData);
					} else {
						echo 'Page template <b>' . $this->current_theme . DIRECTORY_SEPARATOR . $homepageData->template_file_name . '</b> not found!';
					}
				} else {
					mkdir($this->site_theme_path, 0777);
					echo "The directory $this->site_theme_path was not found, but is now successfully created.";
					exit;
				}
			} else {
				echo 'Geen homepagina gevonden';
			}
		} else {
			echo 'Error theme: <b>' . $this->current_theme . '</b> not found';
		}
	}

	//ToDo: pretty error handling if a template isn't found on the server (default template)
	public function page() {
//		debug($this->data);

		if (file_exists($this->current_theme)) {
			if (file_exists($this->site_theme_path)) {
				if (file_exists($this->site_theme_path . DIRECTORY_SEPARATOR . $this->page_template)) {

					$this->load->view($this->site_theme_view . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $this->page_template, $this->data);
				} else {
					echo 'Page template <b>' . $this->current_theme . DIRECTORY_SEPARATOR . $this->page_template . '</b> not found!';
				}
			} else {
				mkdir($this->site_theme_path, 0777);
				echo "The directory $this->site_theme_path was not found, but is now successfully created.";
				exit;
			}
		} else {
			echo 'Error theme: <b>' . $this->current_theme . '</b> not found';
		}
	}
}