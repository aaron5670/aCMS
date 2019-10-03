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