<?php
if ( ! defined( 'BASEPATH' ) ) {
	exit( 'No direct script access allowed' );
}

// Load the Rest Controller library
require APPPATH . 'libraries/REST_Controller.php';

class Authentication extends REST_Controller {

	public function __construct() {
		parent::__construct();

		// Load the user model
		$this->load->model( 'user' );
	}

	public function login_post() {
		// Get the post data
		$email    = $this->post( 'email' );
		$password = $this->post( 'password' );

		// Validate the post data
		if ( ! empty( $email ) && ! empty( $password ) ) {

			// Check if any user exists with the given credentials
			$con['returnType'] = 'single';
			$con['conditions'] = array(
				'email'    => $email,
				'password' => md5( $password ),
				'status'   => 1
			);
			$user              = $this->user->getRows( $con );

			if ( $user ) {
				// Set the response and exit
				$this->response( array(
					'status'  => true,
					'message' => 'User login successful.',
					'data'    => $user
				), REST_Controller::HTTP_OK );
			} else {
				// Set the response and exit
				//BAD_REQUEST (400) being the HTTP response code
				$this->response( "Wrong email or password.", REST_Controller::HTTP_BAD_REQUEST );
			}
		} else {
			// Set the response and exit
			$this->response( "Provide email and password.", REST_Controller::HTTP_BAD_REQUEST );
		}
	}

	public function registration_post() {
		// Get the post data
		$first_name = strip_tags( $this->post( 'first_name' ) );
		$last_name  = strip_tags( $this->post( 'last_name' ) );
		$email      = strip_tags( $this->post( 'email' ) );
		$password   = $this->post( 'password' );
		$phone      = strip_tags( $this->post( 'phone' ) );

		// Validate the post data
		if ( ! empty( $first_name ) && ! empty( $last_name ) && ! empty( $email ) && ! empty( $password ) ) {

			// Check if the given email already exists
			$con['returnType'] = 'count';
			$con['conditions'] = array(
				'email' => $email,
			);
			$userCount         = $this->user->getRows( $con );

			if ( $userCount > 0 ) {
				// Set the response and exit
				$this->response( "The given email already exists.", REST_Controller::HTTP_BAD_REQUEST );
			} else {
				// Insert user data
				$userData = array(
					'first_name' => $first_name,
					'last_name'  => $last_name,
					'email'      => $email,
					'password'   => md5( $password ),
					'phone'      => $phone
				);
				$insert   = $this->user->insert( $userData );

				// Check if the user data is inserted
				if ( $insert ) {
					// Set the response and exit
					$this->response( array(
						'status'  => true,
						'message' => 'The user has been added successfully.',
						'data'    => $insert
					), REST_Controller::HTTP_OK );
				} else {
					// Set the response and exit
					$this->response( "Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST );
				}
			}
		} else {
			// Set the response and exit
			$this->response( "Provide complete user info to add.", REST_Controller::HTTP_BAD_REQUEST );
		}
	}

	public function user_get( $id = 0 ) {
		// Returns all the users data if the id not specified,
		// Otherwise, a single user will be returned.
		$con   = $id ? array( 'id' => $id ) : '';
		$users = $this->user->getRows( $con );

		// Check if the user data exists
		if ( ! empty( $users ) ) {
			// Set the response and exit
			//OK (200) being the HTTP response code
			$this->response( $users, REST_Controller::HTTP_OK );
		} else {
			// Set the response and exit
			//NOT_FOUND (404) being the HTTP response code
			$this->response( array(
				'status'  => false,
				'message' => 'No user was found.'
			), REST_Controller::HTTP_NOT_FOUND );
		}
	}

	public function user_put() {
		$id = $this->put( 'id' );

		// Get the post data
		$first_name = strip_tags( $this->put( 'first_name' ) );
		$last_name  = strip_tags( $this->put( 'last_name' ) );
		$email      = strip_tags( $this->put( 'email' ) );
		$password   = $this->put( 'password' );
		$phone      = strip_tags( $this->put( 'phone' ) );

		// Validate the post data
		if ( ! empty( $id ) && ( ! empty( $first_name ) || ! empty( $last_name ) || ! empty( $email ) || ! empty( $password ) || ! empty( $phone ) ) ) {
			// Update user's account data
			$userData = array();
			if ( ! empty( $first_name ) ) {
				$userData['first_name'] = $first_name;
			}
			if ( ! empty( $last_name ) ) {
				$userData['last_name'] = $last_name;
			}
			if ( ! empty( $email ) ) {
				$userData['email'] = $email;
			}
			if ( ! empty( $password ) ) {
				$userData['password'] = md5( $password );
			}
			if ( ! empty( $phone ) ) {
				$userData['phone'] = $phone;
			}
			$update = $this->user->update( $userData, $id );

			// Check if the user data is updated
			if ( $update ) {
				// Set the response and exit
				$this->response( array(
					'status'  => true,
					'message' => 'The user info has been updated successfully.'
				), REST_Controller::HTTP_OK );
			} else {
				// Set the response and exit
				$this->response( "Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST );
			}
		} else {
			// Set the response and exit
			$this->response( "Provide at least one user info to update.", REST_Controller::HTTP_BAD_REQUEST );
		}
	}

}