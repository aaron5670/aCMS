<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Pages extends CI_Controller {

	/**
	 * Pages constructor.
	 */
	public function __construct() {
		parent::__construct();
	}

	public function pages() {
		echo '<pre>';

		//get slug without the first slash
		$slug = trim($_SERVER['REQUEST_URI'], '/');

		$this->db->where('slug', $slug);
		$query = $this->db->get('acms_routes');

		if ($query) {
			print_r($query->result());
			echo $slug;
		}else {
			echo 'Error: slug niet gevonden in database';
		}
	}
}