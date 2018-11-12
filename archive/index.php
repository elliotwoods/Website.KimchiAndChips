<?php

$page_name = "archive";

require_once '../main.php';

render_page_begin();

include 'tag_editor.php';

include 'list_archive.php';

render_page_end();

?>