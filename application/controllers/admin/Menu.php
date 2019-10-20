<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('language'));
		$this->lang->load('auth');

		if (!$this->ion_auth->in_group(array('editor', 'admin'))) {
			redirect('/auth', 'refresh');
			exit();
		}
	}

	public function index() {
		$this->load->model('admin/page');
		$this->load->model('admin/menu_model');

		$data['menuItems'] = $this->menu_model->getMenuItems();
		$data['pages'] = $this->menu_model->getAvailablePages();

		$this->load->view('admin/menu', $data);
	}

	public function addMenuItem() {
		if (isset($_POST['menu-item-page-id'])) {
			$this->load->model('admin/page');
			$menuItemData = $this->page->getPageMenuData($_POST['menu-item-page-id']);
			if ($menuItemData) {
				$data = array(
					'menu_item_title'      => $menuItemData->page_title,
					'page_id'              => $_POST['menu-item-page-id'],
					'menu_item_target'     => (isset($_POST['menu-item-target']) == '_blank') ? '_blank' : '_self',
					'menu_item_sort_order' => 9999,
				);
				$this->db->insert('acms_menu', $data);

				redirect('admin/menu');
			}
		} elseif (isset($_POST['menu-item-title']) && isset($_POST['menu-item-slug'])) {
			$data = array(
				'menu_item_title'      => $_POST['menu-item-title'],
				'menu_item_url'        => $_POST['menu-item-slug'],
				'menu_item_target'     => (isset($_POST['menu-item-target']) == '_blank') ? '_blank' : '_self',
				'menu_item_sort_order' => 9999,
			);
			$this->db->insert('acms_menu', $data);

			redirect('admin/menu');
		}
	}

	public function editMenuItem() {
		if ($_POST['menu-item-id'] && $_POST['menu-item-title']) {
			$this->db->set('menu_item_title', $_POST['menu-item-title']);
			if (isset($_POST['menu-item-url'])) {
				$this->db->set('menu_item_url', $_POST['menu-item-url']);
			}
			$this->db->set('menu_item_target', (isset($_POST['menu-item-target']) == '_blank') ? '_blank' : '_self');
			$this->db->where('id', $_POST['menu-item-id']);
			$this->db->update('acms_menu');

			redirect('admin/menu');
		}
	}


	public function delMenuItem($id) {
		$this->load->model('admin/menu_model');
		if ($this->menu_model->delMenuItem($id)) {
			redirect('admin/menu');
		} else {
			redirect('admin/menu?error=true');
		}
	}

	public function postMenuOrder() {
		if (isset($_POST['sort_order'])) {

			/* split the value of the sortation */
			$items = explode(',', $_POST['sort_order']);

			/* run the update query for each id */
			foreach ($items as $index => $id) {
				$id = (int)$id;

				if ($id != '') {
					$query = $this->db->query('UPDATE acms_menu SET menu_item_sort_order = ' . ($index + 1) . ' WHERE id = ' . $id);
				}
			}
			die();
		}
	}

}
