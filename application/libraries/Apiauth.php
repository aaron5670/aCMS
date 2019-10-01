<?php
/**
 * Name:         API Auth
 * Author:       Aaron van den Berg
 *               a.vdberg98@gmail.com
 *
 * Created:      15.04.2019
 * Version:      1.0
 *
 * Description:  Authentication for REST API, Authenticate from database table. Library requires the Ion Auth Library.
 * Requirements: CodeIgniter Ion Auth (http://github.com/benedmunds/CodeIgniter-Ion-Auth)
 *
 * @author       Aaron van den Berg
 * @link         http://github.com/aaron5670
 * @filesource
 */
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

/**
 * Class Ion_auth
 */
class Apiauth {

	public function __construct() {
		// Get the CodeIgniter reference
		$this->_CI = &get_instance();
		$this->_CI->load->database();
		$this->_CI->load->library( array( 'ion_auth' ) );
	}

	public function login( $username, $password ) {
		$remember = false; // remember the user
		if ( $this->_CI->ion_auth->login( $username, $password, $remember ) == true ) {
			return true;
		} else {
			return false;
		}
	}
}