<?php

class Product extends CI_Controller {

	public function get( $id ) {
		// API key
		$apiKey = '81cdafca86929fb7a0376263d35604e932f5ef40';

		// API auth credentials
		$apiUser = "a.vdberg98@gmail.com";  // user email
		$apiPass = "1q2w3e4r";              // user password

		// Specify the ID of the product
		$productID = $id;

		// API URL
		$url = 'http://rest-api.test/api/products/get/' . $productID;

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
			print_r( $result );
			echo '</pre>';
		}
	}

	public function post() {
		// API key
		$apiKey = '81cdafca86929fb7a0376263d35604e932f5ef40';

		// API auth credentials
		$apiUser = "a.vdberg98@gmail.com";
		$apiPass = "A2ronda2n";

		// API URL
		$url = 'http://rest-api.test/api/products/post/';

		// User account info
		$userData = array(
			'title' => 'Wooden table',
			'desc'  => 'Nice wooden table.',
			'price' => '250',
			'tags'  => 'wood, tables',
			'image' => 'http://pngimg.com/uploads/table/table_PNG6977.png'
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
		}
	}


}