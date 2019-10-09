<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Page_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		// Load the database library
		$this->load->database();
	}

	function getPageData($slug) {

		//transform slug without the first slash
		$slug = trim($_SERVER['REQUEST_URI'], '/');

		//Array with all the database columns
		$tableColumns = array(
			'acms_routes.id',
			'acms_routes.slug',
			'acms_pages.id',
			'acms_pages.page_title',
			'acms_pages.author',
			'acms_pages.updated_on',
			'acms_templates.id',
			'acms_templates.template_table_name',
			'acms_templates.template_file_name',
		);

		//Get templateTable name
		$this->db->select(implode(', ', $tableColumns));
		$this->db->from('acms_routes');
		$this->db->join('acms_pages', 'acms_pages.id = acms_routes.page_id');
		$this->db->join('acms_templates', 'acms_templates.id = acms_pages.template_id');
		$this->db->where('slug', $slug);
		$query = $this->db->get();
		$result = $query->result();

		//Get template table name from database
		$templateTable = $result[0]->template_table_name;

		//Add template table name to TableColumns array
		$tableColumns[] = $templateTable . '.*';

		$this->db->select(implode(', ', $tableColumns));
		$this->db->from('acms_routes');
		$this->db->where('slug', $slug);
		$this->db->join('acms_pages', 'acms_pages.id = acms_routes.page_id');
		$this->db->join('acms_templates', 'acms_templates.id = acms_pages.template_id');
		$this->db->join($templateTable, $templateTable . '.page_id = acms_pages.id');
		$query = $this->db->get();
		$result = $query->row();

		return $result;
	}

}