<?php

$page_name = "contact";

include './contact.php';

// Mail form is disabled for the time being
//handle_mailform();

render_page_begin();

include 'body.php';

render_page_end();

?>