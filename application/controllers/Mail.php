<?php defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . '/vendor/autoload.php';

class Mail extends CI_Controller {

	public function send() {

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$name = $email = $message = "";

			function validate_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			if (!empty($_POST["name"])) {
				$name = validate_input($_POST["name"]);
			} else {
				redirect(site_url('contact?formError=true'));
				die();
			}

			if (empty($_POST["email"])) {
				redirect(site_url('contact?formError=true'));
			} else {
				$email = validate_input($_POST["email"]);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					redirect(site_url('contact?formError=true'));
					die();
				}
			}

			if (!empty($_POST["message"])) {
				$message = validate_input($_POST["message"]);
			} else {
				redirect(site_url('contact?formError=true'));
				die();
			}

			//load email config
			$this->config->load('email', true);

			// Create the Transport
			$transport = (new Swift_SmtpTransport($this->config->item('servername', 'email'), $this->config->item('port', 'email')))
				->setUsername($this->config->item('username', 'email'))
				->setPassword($this->config->item('password', 'email'));

			// Create the Mailer using your created Transport
			$mailer = new Swift_Mailer($transport);

			$body = <<<MYTAG
				<h2>Nieuw bericht vanaf het contactformulier van de website.</h2>
				<p><b>Naam: </b>$name</p>
				<p><b>Email: </b>$email</p>
				<p><b>Bericht:<br/></b>$message</p>
MYTAG;

			// Create a message
			$message = (new Swift_Message('Nieuw bericht vanaf het contact formulier op de website'))
				->setFrom(['info@aaronvandenberg.nl' => 'Backcorner-geluidsverhuur.nl'])
				->setTo(['a.vdberg98@gmail.com' => 'Backcorner-geluidsverhuur.nl'])
				->setBody($body, 'text/html');

			// Send the message
			if ($mailer->send($message)) {
				redirect(site_url('contact?success=true'));
			} else {
				redirect(site_url('contact?sendFailed=true'));
			}
		}
	}
}