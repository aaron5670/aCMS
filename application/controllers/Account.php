<?php
/*
 * This is login with REST API
 * DEPRECATED USED FOR REST API EXAMPLES
 */

class Account extends CI_Controller {

	public function login() {
		// API key
		$apiKey = 'CODEX@123';

		// API auth credentials
		$apiUser = "admin";
		$apiPass = "1234";

		// API URL
		$url = 'http://rest-api.test/api/authentication/login/';

		// User account login info
		$userData = array(
			'email'    => 'aaron@example.com',
			'password' => 'login_pass'
		);

		// Create a new cURL resource
		$ch = curl_init( $url );

		curl_setopt( $ch, CURLOPT_TIMEOUT, 30 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "X-API-KEY: " . $apiKey ) );
		curl_setopt( $ch, CURLOPT_USERPWD, "$apiUser:$apiPass" );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $userData );

		$result = curl_exec( $ch );

		if ( curl_errno( $ch ) ) {
			print "Error: " . curl_error( $ch );
		} else {
			// Show me the result
			$result = json_decode( $result, true );

			// Close cURL resource
			curl_close( $ch );

			echo '<pre>';
			print_r( $result );
			echo '</pre>';

			if ( isset( $result['status'] ) == 1 ) {
				$newdata = array(
					'first_name' => $result['data']['first_name'],
					'email'  => $userData['email'],
					'logged_in' => true
				);

				$this->session->set_userdata( $newdata );
			} else {
				$this->session->sess_destroy();
			}
		}

		echo '<pre>';
		print_r( $this->session->userdata );
		echo '</pre>';
	}

	public function register() {
		// API key
		$apiKey = '81cdafca86929fb7a0376263d35604e932f5ef40';

		// API auth credentials
		$apiUser = "a.vdberg98@gmail.com";
		$apiPass = "1q2w3e4r";

		// API URL
		$url = 'http://rest-api.test/api/authentication/registration/';

		// User account info
		$userData = array(
			'first_name' => 'John',
			'last_name'  => 'Doe',
			'email'      => 'ineenhut@gmail.com',
			'password'   => 'login_pass',
			'phone'      => '123-456-7890'
		);

		// Create a new cURL resource
		$ch = curl_init( $url );

		curl_setopt( $ch, CURLOPT_TIMEOUT, 30 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "X-API-KEY: " . $apiKey ) );
		curl_setopt( $ch, CURLOPT_USERPWD, "$apiUser:$apiPass" );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $userData );

		$result = curl_exec( $ch );

		if ( curl_errno( $ch ) ) {
			print "Error: " . curl_error( $ch );
		} else {
			// Show me the result
			$result = json_decode( $result, true );

			// Close cURL resource
			curl_close( $ch );

			var_dump( $result );
		}
	}

	public function retrieve( $id ) {
		// API key
		$apiKey = 'CODEX@123';

		// API auth credentials
		$apiUser = "admin";
		$apiPass = "1234";

		// Specify the ID of the user
		$userID = $id;

		// API URL
		$url = 'http://rest-api.test/api/authentication/user/' . $userID;

		// Create a new cURL resource
		$ch = curl_init( $url );

		curl_setopt( $ch, CURLOPT_TIMEOUT, 30 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "X-API-KEY: " . $apiKey ) );
		curl_setopt( $ch, CURLOPT_USERPWD, "$apiUser:$apiPass" );

		$result = curl_exec( $ch );

		if ( curl_errno( $ch ) ) {
			print "Error: " . curl_error( $ch );
		} else {
			// Show me the result
			$result = json_decode( $result, true );

			// Close cURL resource
			curl_close( $ch );

			echo '<pre>';
			var_dump( $result );
			echo '</pre>';
		}
	}

	public function update() {
		// API key
		$apiKey = 'CODEX@123';

		// API auth credentials
		$apiUser = "admin";
		$apiPass = "1234";

		// Specify the ID of the user
		$userID = 11;

		// API URL
		$url = 'http://rest-api.test/api/authentication/user/';

		// User account info
		$userData = array(
			'id'         => $userID,
			'first_name' => 'John',
			'last_name'  => 'Doe',
			'email'      => 'aaron@example.com',
			'password'   => 'login_pass',
			'phone'      => '545-856-3439'
		);

		// Create a new cURL resource
		$ch = curl_init( $url );

		curl_setopt( $ch, CURLOPT_TIMEOUT, 30 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
			'X-API-KEY: ' . $apiKey,
			'Content-Type: application/x-www-form-urlencoded'
		) );
		curl_setopt( $ch, CURLOPT_USERPWD, "$apiUser:$apiPass" );
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "PUT" );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $userData ) );

		$result = curl_exec( $ch );

		if ( curl_errno( $ch ) ) {
			print "Error: " . curl_error( $ch );
		} else {
			// Show me the result
			$result = json_decode( $result, true );

			// Close cURL resource
			curl_close( $ch );

			echo '<pre>';
			var_dump( $result );
			echo '</pre>';
		}
	}
}