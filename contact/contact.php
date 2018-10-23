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
	
			$post_data = http_build_query(
				array(
					'secret' => $secret,
					'response' => $g_response,
					'remoteip' => (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'])
				)
			);
	
			if(function_exists('curl_init') && function_exists('curl_setopt') && function_exists('curl_exec')) {
				// Use cURL to get data 10x faster than using file_get_contents or other methods
				$ch =  curl_init($verifyURL);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
					curl_setopt($ch, CURLOPT_TIMEOUT, 5);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-type: application/x-www-form-urlencoded'));
					$response = curl_exec($ch);
				curl_close($ch);
			} else {
				// If server not have active cURL module, use file_get_contents
				$opts = array('http' =>
					array(
						'method'  => 'POST',
						'header'  => 'Content-type: application/x-www-form-urlencoded',
						'content' => $post_data
					)
				);
				$context  = stream_context_create($opts);
				$response = file_get_contents($verifyURL, false, $context);
			}
	
			$result = json_decode($response);
			var_dump($result);
	
			if (!$result->success) {
				throw new Exception("reCAPTCHA failed to identify you as a human.");
			}
		}
		catch(Exception $e) {
			var_dump($e);
		}
	}
}

?>