<?php
if ( ! defined( 'BASEPATH' ) ) {
	exit( 'No direct script access allowed' );
}

// Load the Rest Controller library
require APPPATH . 'libraries/REST_Controller.php';

class Products extends REST_Controller {

	public function __construct() {
		parent::__construct();

		// Load the product model
		$this->load->model( 'product' );
	}

	protected function get_get( $id = 0 ) {
		// Returns all the products data if the id not specified,
		// Otherwise, a single product will be returned.
		$con      = $id ? array( 'id' => $id ) : '';
		$products = $this->product->getRows( $con );

		// Check if the product data exists
		if ( ! empty( $products ) ) {
			// Set the response and exit
			//OK (200) being the HTTP response code
			$this->response( $products, REST_Controller::HTTP_OK );
		} else {
			// Set the response and exit
			//NOT_FOUND (404) being the HTTP response code
			$this->response( array(
				'status'  => false,
				'message' => 'No product was found.'
			), REST_Controller::HTTP_NOT_FOUND );
		}
	}

	public function post_post() {
		// Get the post data
		$title = strip_tags( $this->post( 'title' ) );
		$desc  = strip_tags( $this->post( 'desc' ) );
		$price = strip_tags( $this->post( 'price' ) );
		$tags  = strip_tags( $this->post( 'tags' ) );
		$image = strip_tags( $this->post( 'image' ) );

		// Validate the post data
		if ( ! empty( $title ) && ! empty( $desc ) && ! empty( $price ) && ! empty( $tags ) && ! empty( $image ) ) {
			// Insert product data
			$productData = array(
				'title' => $title,
				'desc'  => $desc,
				'price' => $price,
				'tags'  => $tags,
				'image' => $image
			);
			$insert      = $this->product->insert( $productData );

			// Check if the product data is inserted
			if ( $insert ) {
				// Set the response and exit
				$this->response( array(
					'status'  => true,
					'message' => 'The product has been added successfully.',
					'data'    => $insert
				), REST_Controller::HTTP_OK );
			} else {
				// Set the response and exit
				$this->response( "Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST );
			}
		} else {
			// Set the response and exit
			$this->response( "Provide complete product info to add.", REST_Controller::HTTP_BAD_REQUEST );
		}
	}

}