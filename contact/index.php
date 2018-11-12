<?php

$page_name = "contact";

// Mail form is disabled for the time being
//include './contact.php';
//handle_mailform();

// This usually goes inside contact.php - but we disabled PHPMailer so it doesn't run
require_once dirname(__DIR__).'/main.php';

render_page_begin();

include 'body.php';

render_page_end();

?>