<?php
/*
	Juassi 2.0
	Mailer Class
*/

class juassi_mailer {

	var $message;
	var $subject;
	var $headers;
	var $to;
	var $to_email;
	var $to_name;
	var $from;
	var $from_email;
	var $from_name;
	var $x_mailer;
	var $ip_address;
	var $mailer_version;
	var $reply;
	var $content_type;


	function create($to_email, $to_name, $from_email, $from_name, $subject, $message) {

		$this->ip_address = $_SERVER['REMOTE_ADDR'];

		$this->message = $message;
		$this->subject = $subject;

		$this->to_email = $to_email;
		$this->to_name = $to_name;

		$this->to = $this->to_name . ' <' . $this->to_email . '>' . "\n";

		$this->from_email = $from_email;
		$this->from_name = $from_name;

		$this->from = 'From: ' . $this->from_name . ' <' . $this->from_email . '>' . "\n";

		$this->mailer_version = '1';

		$this->x_mailer = 'X-Mailer: Juassi 2 Mailing Class '. $this->mailer_version . "\n";
		$this->content_type = "Content-Type: text/plain; charset=utf-8";
		$this->headers = $this->from . $this->x_mailer . $this->content_type;

	}

	function send() {

		if (mail($this->to, $this->subject, $this->message, $this->headers)) {
			trigger_error('MAILER: A message was sent to '.$this->to_email, E_USER_NOTICE);
			return true;
		}
		else {
			trigger_error('MAILER: Unable to send message to '.$this->to_email, E_USER_WARNING);
			return false;
		}
	}

	function to($to) {
		$this->to = $to;
	}
	function to_email($to_email) {
		$this->to_email = $to_email;
	}
	function to_name($to_name) {
		$this->to_name = $to_name;
	}

	function from($from) {
		$this->from = $from;
	}
	function from_email($from_email) {
		$this->from_email = $from_email;
	}
	function from_name($from_name) {
		$this->from_name = $from_name;
	}

	function message($message) {
		$this->message = $message;
	}

	function headers($headers) {
		$this->headers = $this->from . $this->x_mailer . $this->content_type;
	}

	function update_headers() {
		$this->headers = $this->from . $this->x_mailer;
	}

	function subject($subject) {
		$this->subject = $subject;
	}

	function x_mailer($x_mailer) {
		$this->x_mailer = $x_mailer;
	}

	function ip_address($ip_address) {
		$this->ip_address = $ip_address;
	}
}


?>