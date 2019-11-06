<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Settings_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		// Load the database library
		$this->load->database();
	}

	function getSettings($columns = array()) {
		if ($columns) {
			$this->db->select(implode(", ", $columns));
		}

		$query = $this->db->get('acms_settings');
		return $query->row();
	}

	function getSiteTitle() {
		$this->db->select('site_title');
		$query = $this->db->get('acms_settings');
		$result = $query->row();

		return $result->site_title;
	}

	function getThemes() {
		return array_filter(glob('themes' . DIRECTORY_SEPARATOR . '*'), 'is_dir');
	}

	function getCurrentTheme() {
		$this->db->select('site_theme');
		$query = $this->db->get('acms_settings');
		$result = $query->row();

		return $result->site_theme;
	}

	function getAllRoutes() {
		$this->db->select('page_id, page_title, is_homepage, is_newspage');
		$this->db->from('acms_pages');
		$this->db->join('acms_routes', 'acms_routes.page_id = acms_pages.id');
		$query = $this->db->get();
		return $query->result();
	}

}