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
	var_dump($_POST);
	if(array_key_exists('g-recaptcha-response', $_POST)) {
		$sender_name = stripslashes($_POST["name"]);
		$sender_email = stripslashes($_POST["email"]);
		$sender_message = stripslashes($_POST["message"]);

		$url = "https://www.google.com/recaptcha/api/siteverify";
		$response = $_POST["g-recaptcha-response"];
		$secret = "6LcwLXYUAAAAAJXpZNGt7m739EEYNzbFo30i0fod";

		$data = array(
			'secret' => $secret,
			'response' => $response,
			'remoteip' => $_SERVER['REMOTE_ADDR']
		);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		$verifyResponse = curl_exec($ch);
		curl_close($ch);
	
		$recaptchaResponse = json_decode($verifyResponse);

		var_dump($recaptchaResponse);
	}
}

?>