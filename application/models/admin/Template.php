<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Template extends CI_Model {
	public function __construct() {
		parent::__construct();

		// Load the database library
		$this->load->database();
		$this->templatesTable = 'acms_templates';
	}

	function getRows($columns = array()) {
		if ($columns) {
			$this->db->select(implode(", ", $columns));
		}

		$query = $this->db->get($this->templatesTable);
		return $query->result();
	}

	function getRow($id = null) {
		if (!$id) return null;

		$this->db->where('id', $id);

		$query = $this->db->get($this->templatesTable);
		return $query->result();
	}

	function getThemeTemplateFiles() {
		//load page model
		$this->load->model('admin/settings_model');

		//get all theme templates
		$themeTemplates = $this->settings_model->getCurrentTheme() . DIRECTORY_SEPARATOR . 'templates';

		if (is_dir($themeTemplates)){
			return preg_grep('~^tpl_.*\.php$~', scandir($themeTemplates));
		}else {
			return array(
				'error' => 'Create a in your theme folder a subdirectory called: templates'
			);
		}
	}

	function getUnusedThemeTemplateFiles() {
		$templateFiles = $this->getThemeTemplateFiles();

		$this->db->select('template_file_name');
		$this->db->from('acms_templates');
		$query = $this->db->get();
		$usedTemplates = $query->result();

		$usedTemplateFiles = array();
		foreach ($usedTemplates as $templateFile) {
			$usedTemplateFiles[] = $templateFile->template_file_name;
		}

		//compare two arrays and returns unused template files
		return array_diff($templateFiles, $usedTemplateFiles);
	}

	function delRow($id = null) {
		if (!$id) return null;

		// this search for the template database table and drops it.
		$this->load->dbforge();
		$this->db->where('id', $id);
		$data = $this->db->get($this->templatesTable)->row();
		$tableName = str_replace(' ', '_', $data->template_name);
		$tableName = strtolower('acms_tpl_' . $tableName);
		$this->dbforge->drop_table($tableName, true);

		// this deletes the current template from the templatesTable
		$this->db->where('id', $id);
		return $this->db->delete($this->templatesTable);
	}

}