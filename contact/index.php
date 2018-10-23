<?php

$page_name = "contact";

include './contact.php';

handle_mailform();

render_contact_begin();

include 'body.php';

render_contact_end();

?>