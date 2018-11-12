<?php

include __DIR__ . "/utils/render_image.php";
include __DIR__ . "/utils/render_text.php";

function render_snippet($snippet_name) {
	include(__DIR__ . '/snippets/' . $snippet_name . ".php");
}

function render_page_begin() {
	render_snippet('html_begin');
	render_snippet('head');
	render_snippet('body_begin');
	render_snippet('main_element_begin');
	render_snippet('top_button');
	render_snippet('navigation_bar');
}

function render_page_end() {
	render_snippet('main_element_end');
	render_snippet('footer');
	render_snippet('body_end');
	render_snippet('html_end');
}

?>