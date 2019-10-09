<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Settings_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		// Load the database library
		$this->load->database();
		$this->pagesTable = 'acms_pages';
	}

	function getSettings($columns = array()) {
		if ($columns) {
			$this->db->select(implode(", ", $columns));
		}

		$query = $this->db->get('acms_settings');
		return $query->row();
	}


	function getThemes() {
		return array_filter(glob('themes\*'), 'is_dir');
	}

	function getCurrentTheme() {
		$this->db->select('site_theme');
		$query = $this->db->get('acms_settings');
		$result = $query->row();

		return $result->site_theme;
	}

}