<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Menu_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		// Load the database library
		$this->load->database();
		$this->pagesTable = 'acms_menu';
	}

	public function getMenuItems() {
		$this->db->select('*');
		$this->db->order_by('menu_item_sort_order', 'ASC');
		$query = $this->db->get('acms_menu');
		return $query->result();
	}

	function getAvailablePages() {
		$this->db->select('acms_pages.id, acms_pages.page_title, acms_routes.slug, acms_routes.page_status');
		$this->db->from('acms_pages');
		$this->db->where('acms_routes.page_status', 'published');
		$this->db->join('acms_routes', 'acms_routes.page_id = acms_pages.id');
		$this->db->join('acms_templates', 'acms_templates.id = acms_pages.template_id');
		$this->db->join('users', 'acms_pages.author = users.id');

		$query = $this->db->get();

		return $query->result();
	}

	function delMenuItem($id = null) {
		if (!$id) return null;
		$this->db->where('id', $id);
		$this->db->delete($this->pagesTable);
		return true;
	}

}