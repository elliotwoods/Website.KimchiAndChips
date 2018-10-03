<?php

function render_snippet($snippet_name) {
	include(__DIR__ . '/snippets/' . $snippet_name . ".php");
}

?>