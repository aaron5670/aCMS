<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class News_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		// Load the database library
		$this->load->database();
		$this->newsTable = 'acms_news';
	}

	function getRows($columns = array()) {
		if ($columns) {
			$this->db->select(implode(", ", $columns));
		}

		$query = $this->db->get($this->newsTable);
		return $query->result();
	}

	function getNewsData($pageID) {
		$this->db->select('*');
		$this->db->where('id', $pageID);
		$query = $this->db->get($this->newsTable);
		return $query->row();
	}

	function getNewsTemplateName($newsID) {
		$this->db->select('template_name');
		$this->db->from('acms_news');
		$this->db->join('acms_templates', 'acms_templates.id = acms_news.template_id');
		$this->db->where('acms_news.id', $newsID);
		$query = $this->db->get();
		$result = $query->row();

		return $result->template_name;
	}

	function getNewsTemplateTableName($pageID) {
		$this->db->select('template_table_name');
		$this->db->from('acms_news');
		$this->db->join('acms_templates', 'acms_templates.id = acms_news.template_id');
		$this->db->where('acms_news.id', $pageID);
		$query = $this->db->get();
		$result = $query->row();

		return $result->template_table_name;
	}

	function getAllNewsInfo($columns = array()) {
		if ($columns) {
			$this->db->select(implode(", ", $columns));
		}
		$this->db->from($this->newsTable);
		$this->db->join('acms_templates', 'acms_templates.id = acms_news.template_id');
		$this->db->join('users', 'acms_news.author = users.id');

		$query = $this->db->get();

		return $query->result();
	}

	function checkIfNewsWithTemplateExist($id = null) {
		if (!$id) return null;

		$this->db->where('template_id', $id);

		$query = $this->db->get($this->newsTable);
		return $query->result();
	}

	function getCurrentThemeTemplateFile($pageID) {
		if (!$pageID) return null;

		$this->db->trans_start();
		//Get template_id from acms_pages table
		$this->db->select('template_id');
		$this->db->where('id', $pageID);
		$query = $this->db->get('acms_news');
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
		$this->db->where('news_id', $pageID);
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


	function delRow($id = null) {
		if (!$id) return null;

		$this->db->where('id', $id);
		$this->db->delete($this->newsTable);
		return true;

	}

}