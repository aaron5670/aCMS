<?php defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . '/vendor/autoload.php';


class Mail extends CI_Controller {

	/**
	 * Pages constructor.
	 */
	public function __construct() {
		parent::__construct();

		//load email config
		$this->config->load('email', TRUE);
	}

	public function index() {
		// Create the Transport
		$transport = (new Swift_SmtpTransport($this->config->item('servername', 'email'), $this->config->item('port', 'email')))
			->setUsername($this->config->item('username', 'email'))
			->setPassword($this->config->item('password', 'email'))
		;

		// Create the Mailer using your created Transport
		$mailer = new Swift_Mailer($transport);

		// Create a message
		$message = (new Swift_Message('Contact formulier'))
			->setFrom(['info@aaronvandenberg.nl' => 'John Doe'])
			->setTo(['a.vdberg98@gmail.com' => 'A name'])
			->setBody('Here is the message itself')
		;

		// Send the message
		//$result = $mailer->send($message);
	}
}