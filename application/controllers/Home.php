<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Home extends CI_Controller {

	/**
	 * Home constructor.
	 */
	public function __construct() {
		parent::__construct();

		//Basic site data
		$data = array(
			'site_title' => 'REST-API Website',
		);

		//Load <head>
		$this->load->view( 'templates/head' );
		//Load <nav>
		$this->parser->parse( 'templates/navigation', $data );
	}

	public function index() {
		$this->load->view( 'templates/header' );
		$this->load->view( 'pages/home' );
		$this->load->view( 'templates/footer' );
	}

	public function keys() {
		if ( ! $this->ion_auth->logged_in() ) {
			// redirect them to the login page
			redirect( 'auth/login', 'refresh' );
			exit();
		} else {
			$query = $this->db->get_where('rest_api_keys', array('user_id' => $_SESSION['user_id']));
			$row   = $query->row();

			//Load string library
			$this->load->helper( 'string' );

			if ( empty( $row ) ) {
				$pageData = array(
					'key' => 'You dont have a REST API Key. Generate <a href="' . site_url( 'home/generate' ) . '">here</a> your REST API Key.',
				);
			} else {
				$pageData = array(
					'key' => 'You already have a REST API Key. Regenerate a new REST API Key <a href="' . site_url( 'home/generate' ) . '">here</a>',
				);
			}

			$this->parser->parse( 'pages/keys', $pageData );
			$this->load->view( 'templates/footer' );
		}
	}

	public function generate() {
		if ( ! $this->ion_auth->logged_in() ) {
			// redirect them to the login page
			redirect( 'auth/login', 'refresh' );
			exit();
		} else {

			$query = $this->db->query( 'SELECT user_id FROM rest_api_keys' );
			$row   = $query->row();

			//Load string library
			$this->load->helper( 'string' );

			//Get user ID
			$user      = $this->ion_auth->user()->row();
			$userId    = $user->id;

			if ( empty( $row ) ) {
				$randomKey = random_string( 'sha1' );

				$data = array(
					'user_id'        => $userId,
					'key'            => $randomKey,
					'level'          => 0,
					'ignore_limits'  => 0,
					'is_private_key' => 0,
					'ip_addresses'   => '',
				);

				//Insert new generated key into database
				$this->db->insert( 'rest_api_keys', $data );

				$pageData = array(
					'key' => 'Your REST API KEY: <strong>' . $randomKey . '</strong>',
				);
			} else {
				//Delete first current key
				$this->db->delete('rest_api_keys', array('user_id' => $userId));

				$randomKey = random_string( 'sha1' );

				$data = array(
					'user_id'        => $userId,
					'key'            => $randomKey,
					'level'          => 0,
					'ignore_limits'  => 0,
					'is_private_key' => 0,
					'ip_addresses'   => '',
				);

				//Insert new generated key into database
				$this->db->insert( 'rest_api_keys', $data );

				$pageData = array(
					'key' => 'Your REST API KEY: <strong>' . $randomKey . '</strong>',
				);
			}

			$this->parser->parse( 'pages/keys', $pageData );
			$this->load->view( 'templates/footer' );
		}
	}
}