<?php

require_once '../libs/PHPMailer/src/PHPMailer.php';
require_once '../libs/PHPMailer/src/Exception.php';
require_once '../libs/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$sender_name = "";
$sender_email = "";
$sender_message = "";
$sender_subject = "";

$mail_form_enabled = false;

function handle_mailform() {
	global $mail_form_enabled;
	$mail_form_enabled = true;

	if(array_key_exists('g-recaptcha-response', $_POST)) {
		try {
			global $sender_name, $sender_email, $sender_message, $sender_subject;

			$sender_name = stripslashes($_POST["name"]);
			$sender_email = stripslashes($_POST["email"]);
			$sender_message = stripslashes($_POST["message"]);
			$sender_subject = stripslashes($_POST["subject"]);

			$verifyURL = "https://www.google.com/recaptcha/api/siteverify";
			$g_response = $_POST["g-recaptcha-response"];
			$secret = "	6LeUXnYUAAAAAJDT-dDe_QIig1mo-fibM6sAMLnT";
			$remote_ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR']);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $verifyURL);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
				'secret' => $secret
				, 'response' => $g_response
				, 'remoteip' => $remote_ip)));

			// Accept all HTTPS certificates
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			
			// Receive server response ...
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec($ch);
			curl_close($ch);
			$recaptcha_response = json_decode($server_output);

			if(!$recaptcha_response->success) {
				//throw new Exception("reCAPTCHA failed");
			}
			$subject = $_POST["subject"];
			$message = $_POST["message"];
		
			// remove the backslashes that normally appears when entering " or '
			
			$locationDetails = file_get_contents("http://ipinfo.io/{$remote_ip}/json");

			// check notes from https://help.dreamhost.com/hc/en-us/articles/215842658-PHPmailer-overview

			// Setup mailer
			$mail = new PHPMailer(true);
			$mail->SMTPDebug = 2;
			$mail->isSMTP();
			$mail->Host = 'smtp.dreamhost.com';
			$mail->Username = 'contact-form@webadmin.kimchiandchips.com';
			$mail->Password = 'tK00Zce59z0';
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;

			// Recipients
			$mail->setFrom('contact-form@webadmin.kimchiandchips.com');
			//$mail->addReplyTo($sender_email, $sender_name);
			$mail->addAddress('elliot@kimchiandchips.com', 'Studio Kimchi and Chips');

			$mail->Subject = $sender_subject;
			$mail->Body = $sender_message;

			$mail->send();

			$mail_send_success = true;
		}
		catch(Exception $e) {
			print('<div class="mail_send_error"><b>Mail send error:</b>');
			print('<pre class="mail_send_error_detail">');
			print_r($e);
			print('</pre></div>');
		}
	}
}

?>