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

	function getPageData($pageID) {
		$this->db->select('*');
		$this->db->where('id', $pageID);
		$query = $this->db->get($this->pagesTable);
		return $query->row();
	}

	function getPageRouteData($pageID) {
		$this->db->select('*');
		$this->db->from($this->pagesTable);
		$this->db->join('acms_routes', 'acms_routes.page_id = acms_pages.id');
		$this->db->where('acms_pages.id', $pageID);
		$query = $this->db->get();
		return $query->row();
	}

	function getPageMenuData($pageID) {
		$this->db->select('page_title, slug');
		$this->db->from($this->pagesTable);
		$this->db->join('acms_routes', 'acms_routes.page_id = acms_pages.id');
		$this->db->where('acms_pages.id', $pageID);
		$query = $this->db->get();
		return $query->row();
	}

	function getPageTemplateTableName($pageID) {
		$this->db->select('template_table_name');
		$this->db->from('acms_routes');
		$this->db->join('acms_pages', 'acms_pages.id = acms_routes.page_id');
		$this->db->join('acms_templates', 'acms_templates.id = acms_pages.template_id');
		$this->db->where('acms_pages.id', $pageID);
		$query = $this->db->get();
		$result = $query->row();

		return $result->template_table_name;
	}

	function getPageTemplateName($pageID) {
		$this->db->select('template_name');
		$this->db->from('acms_routes');
		$this->db->join('acms_pages', 'acms_pages.id = acms_routes.page_id');
		$this->db->join('acms_templates', 'acms_templates.id = acms_pages.template_id');
		$this->db->where('acms_pages.id', $pageID);
		$query = $this->db->get();
		$result = $query->row();

		return $result->template_name;
	}

	function getAllPageInfo($columns = array()) {
		if ($columns) {
			$this->db->select(implode(", ", $columns));
		}
		$this->db->from($this->pagesTable);
		$this->db->join('acms_routes', 'acms_routes.page_id = acms_pages.id');
		$this->db->join('acms_templates', 'acms_templates.id = acms_pages.template_id');
		$this->db->join('users', 'acms_pages.updated_by = users.id');

		$query = $this->db->get();

		return $query->result();
	}

	function getCurrentThemeTemplateFile($pageID) {
		if (!$pageID) return null;

		$this->db->trans_start();
		//Get template_id from acms_pages table
		$this->db->select('template_id');
		$this->db->where('id', $pageID);
		$query = $this->db->get('acms_pages');
		$result = $query->row();
		$templateId = $result->template_id;

		//Get template_json from acms_templates table
		$this->db->select('template_json');
		$this->db->where('id', $templateId);
		$query = $this->db->get('acms_templates');
		$result = $query->row();
		$template = json_decode($result->template_json);

		//Get template_table_name from acms_templates table
		$this->db->select('template_table_name');
		$this->db->where('id', $templateId);
		$query = $this->db->get('acms_templates');
		$result = $query->row();
		$templateName = $result->template_table_name;

		//Get page_id from $templateName table
		$this->db->where('page_id', $pageID);
		$query = $this->db->get($templateName);
		$templateData = $query->row();
		$this->db->trans_complete();

		unset($templateData->id);
		unset($templateData->page_id);
		unset($templateData->submit);

		$templateData = (array)$templateData;
		foreach ($template->components as $component) {
			if (isset($templateData[$component->key])) {
				$component->defaultValue = $templateData[$component->key];
			}
		}

		return json_encode($template);
	}

	function checkIfPageWithTemplateExist($id = null) {
		if (!$id) return null;

		$this->db->where('template_id', $id);
		$query = $this->db->get($this->pagesTable);
		return $query->result();
	}

	function delRow($id = null) {
		if (!$id) return null;

		$this->db->from($this->pagesTable);
		$this->db->join('acms_routes', 'acms_routes.page_id = acms_pages.id');
		$this->db->where('acms_pages.id', $id);
		$query = $this->db->get();
		$result = $query->row();

		echo $result->is_homepage;

		if ($result->is_homepage == true){
			return array(
				'error' => "Can't delete the homepage."
			);
		}

		if ($result->is_homepage == false) {
			$this->db->where('id', $id);
			$this->db->delete($this->pagesTable);
			return true;
		}
	}

}