<?php defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
	public $data = array();

	public function __construct() {
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('language', 'admin/utility'));
		$this->lang->load('auth');

		if (!$this->ion_auth->in_group(array('editor', 'admin'))) {
			redirect('/auth', 'refresh');
			exit();
		}
	}

	public function index() {
		$this->load->model('admin/news_model');
		$data['news'] = $this->news_model->getAllNewsInfo(array(
			'acms_news.id',
			'acms_news.news_title',
			'acms_news.updated_on',
			'users.first_name',
			'acms_templates.template_name',
		));

//		debug($data);

		$this->load->view('admin/news/index', $data);
	}

	public function newNews() {
		$this->load->model('admin/template');
		$data['templates'] = $this->template->getRows(array('id', 'template_name', 'is_news_template'));

		$this->load->view('admin/news/new_news_item', $data);
	}

	//ToDo: if newsID is invalid redirect to admin/pages
	public function editNews($newsID) {
		$this->load->model('admin/news_model');
		$pageData = $this->news_model->getNewsData($newsID);
		$data['newsID'] = $pageData->id;
		$data['newsTitle'] = $pageData->news_title;
		$data['newsTemplate'] = $this->news_model->getNewsTemplateName($newsID);
		$data['newsTemplateTable'] = $this->news_model->getNewsTemplateTableName($newsID);
		$data['currentTemplate'] = $this->loadCurrentNewsTemplate($newsID);

		$this->load->view('admin/news/edit_news_item', $data);
	}

	public function editNewsPost() {
		$postData = $this->input->post();
		if ($postData) :
			$newsID = $postData['newsID'];

			$this->db->trans_start();

			//Update acms_pages table
			$data = array(
				'news_title' => $postData['newsTitle'],
				'updated_on' => date("Y-m-d H:i:s"),
				'updated_by' => $_SESSION['user_id'],
			);
			$this->db->where('id', $newsID);
			$this->db->update('acms_news', $data);

			//Update template table with page data
			$this->db->where('news_id', $newsID);
			$this->db->update($postData['newsTemplateTable'], $postData['data']);

			$this->db->trans_complete();
		endif;
	}

	public function loadCurrentNewsTemplate($newsID) {
		$this->load->model('admin/news_model');
		return $this->news_model->getCurrentThemeTemplateFile($newsID);
	}

	//Load a page template if user select on!
	public function loadNewsTemplate() {
		$this->load->model('admin/template');
		$newsTemplate = $this->template->getRow($this->input->post('newsTemplate'));

		if ($newsTemplate[0]->template_json) {
			echo $newsTemplate[0]->template_json;
		}
	}

	//ToDo: Validatie en formulier in view maken via CI Form builder
	public function newNewsPost() {

		if ($this->input->post()) :
			$postData = $this->input->post();

			//start transaction
			$this->db->trans_start();

			//Insert $dataNewsTable into the acms_news table
			$dataNewsTable = array(
				'news_title'  => $postData['newsTitle'],
				'template_id' => $postData['templateId'],
				'author'      => $_SESSION['user_id'],
				'created_on'  => date("Y-m-d H:i:s"),
				'updated_on'  => date("Y-m-d H:i:s"),
				'updated_by'  => $_SESSION['user_id'],
			);
			$this->db->insert('acms_news', $dataNewsTable);

			$newsID = $this->db->insert_id(); //last inserted ID

			//Get template_table_name from acms_templates table
			$this->db->select('id, template_table_name');
			$this->db->where('id', $postData['templateId']);
			$query = $this->db->get('acms_templates');
			$templateName = $query->result();
			$templateName = $templateName[0]->template_table_name;

			//add newsID to the post data array
			$postData['data']['news_id'] = $newsID;

			//For the formioJS file upload component
			foreach ($postData['data'] as $key => $data) {
				if (is_array($data)) {
					foreach ($data as $sub_data) {
						if (isset($sub_data['url'])) {
							$postData['data'][$key] = $sub_data['url'];
						}
						continue;
					}
				}
			}

			//For the formioJS Edit Grid component
			foreach ($postData['data'] as $key => $data) {
				if (is_array($data)) {
					foreach ($data as $sub_data) {
						if (!isset($sub_data['url'])) {
							$postData['data'][$key] = json_encode($data);
						}
						continue;
					}
				}
			}

			//Insert into the selected template table the form post data
			$this->db->insert($templateName, $postData['data']);
			$this->db->trans_complete();
		endif;
	}

	public function del($id = null) {
		if ($id) {
			$this->load->model('admin/news_model');
			$deletePage = $this->news_model->delRow($id);

			if ($deletePage['error']) {
				redirect('/admin/news/index?message=cantDeleteHomepage');
			}

			if ($deletePage) {
				redirect('/admin/news/index');
			}

		} else {
			redirect('/admin/news/index');
		}
	}
}
