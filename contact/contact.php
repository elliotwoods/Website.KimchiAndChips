<?php

include(dirname(__DIR__).'/main.php');

function render_contact_begin() {
	render_snippet('html_begin');
	render_snippet('head');
	render_snippet('body_begin');
	render_snippet('top_button');
	render_snippet('navigation_bar');
}

function render_contact_end() {
	render_snippet('footer_nocolor');
	render_snippet('body_end');
	render_snippet('html_end');
}

function handle_mailform() {
	if(array_key_exists('g-recaptcha-response', $_POST)) {
		try {
			$sender_name = stripslashes($_POST["name"]);
			$sender_email = stripslashes($_POST["email"]);
			$sender_message = stripslashes($_POST["message"]);

			$verifyURL = "https://www.google.com/recaptcha/api/siteverify";
			$g_response = $_POST["g-recaptcha-response"];
			$secret = "6LcwLXYUAAAAAJXpZNGt7m739EEYNzbFo30i0fod";
			$remote_ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR']);

			require_once '../libs/recaptcha/src/autoload.php';
			$recaptcha = new \ReCaptcha\ReCaptcha($secret);
			$response = $recaptcha->setExpectedHostname('kimchiandchips.com')
				->verify($g_response, $remote_ip);
			
			var_dump($response);
	
			if (!$response->isSuccess) {
				var_dump($response->getErrorCodes());
			}
		}
		catch(Exception $e) {
			var_dump($e);
		}
	}
}

?>