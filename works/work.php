<?php

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	include(dirname(__DIR__).'../main.php');
}
else {
	include(dirname(__DIR__).'/main.php');
}

function render_work_begin() {
	render_snippet('html_begin');
	render_snippet('head');
	render_snippet('fade_in_on_load_head');
	render_snippet('body_begin');
	render_snippet('top_button');
	render_snippet('navigation_bar');
}

function render_work_end() {
	render_snippet('footer');
	render_snippet('body_end');
	render_snippet('fade_in_on_load_foot');
	render_snippet('html_end');
}

$doc_path = realpath(getcwd());
$works_path = realpath(__DIR__);
$work_url_path = '/works/' . str_replace($works_path . DIRECTORY_SEPARATOR, '', $doc_path) . '/';

?>