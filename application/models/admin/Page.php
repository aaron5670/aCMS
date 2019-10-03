<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Page extends CI_Model {

	public function __construct() {
		parent::__construct();

		// Load the database library
		$this->load->database();
		$this->pagesTable = 'acms_pages';
	}

	function getRows($columns = array()) {
		if ($columns) {
			$this->db->select(implode(", ", $columns));
		}

		$query = $this->db->get($this->pagesTable);
		return $query->result();
	}

	function getAllPageInfo($columns = array()) {
		if ($columns) {
			$this->db->select(implode(", ", $columns));
		}
		$this->db->from('acms_pages');
		$this->db->join('acms_routes', 'acms_routes.page_id = acms_pages.id');
		$this->db->join('acms_templates', 'acms_templates.id = acms_pages.template_id');
		$this->db->join('users', 'acms_pages.author = users.id');

		$query = $this->db->get();

		return $query->result();
	}

	function checkIfPageWithTemplateExist($id = null) {
		if (!$id) return null;

		$this->db->where('template_id', $id);

		$query = $this->db->get($this->pagesTable);
		return $query->result();
	}

	function delRow($id = null) {
		if (!$id) return null;

	}

}