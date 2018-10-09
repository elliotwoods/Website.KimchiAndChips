<?php

include(dirname(__DIR__).'/main.php');

function render_main_begin() {
	render_snippet('html_begin');
	render_snippet('head');
	render_snippet('body_begin');
	render_snippet('top_button');
	render_snippet('navigation_bar');
	render_snippet('current_signifier_begin');
}

function render_main_end() {
	render_snippet('body_end');
	render_snippet('html_end');
}

$doc_path = realpath(getcwd());
$main_path = realpath(__DIR__);
$main_url_path = '/main/' . str_replace($main_path . DIRECTORY_SEPARATOR, '', $doc_path) . '/';

?>