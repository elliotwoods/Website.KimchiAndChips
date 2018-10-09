<?php

include "utils/render_image.php";

function render_snippet($snippet_name) {
	include(__DIR__ . '/snippets/' . $snippet_name . ".php");
}

?>