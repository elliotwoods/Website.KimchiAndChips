<?php

$doc_path = realpath(getcwd());
$works_path = realpath(__DIR__);

if($doc_path == $works_path) {
	// we're in the works folder
	require_once '../main.php';

	$page_name = "works";
	$subdir_name = "works";
}
else {
	// we're in a subdir work
	require_once '../../main.php';

	$subdir_name = str_replace($works_path . DIRECTORY_SEPARATOR, '', $doc_path);
	$work_url_path = '/works/' . $subdir_name . '/';
	$page_name = $subdir_name;
}


function render_work_begin() {
	/*
	render_snippet('html_begin');
	render_snippet('head');
	render_snippet('fade_in_on_load_head');
	render_snippet('body_begin');
	render_snippet('top_button');
	render_snippet('navigation_bar');
	*/
	render_page_begin();
	render_snippet('fade_in_on_load_head');
}

function render_work_end() {
	/*
	render_snippet('footer');
	render_snippet('body_end');
	render_snippet('fade_in_on_load_foot');
	render_snippet('html_end');
	*/
	render_snippet('fade_in_on_load_foot');
	render_page_end();
}

render_work_begin();

include 'body.php';

render_work_end();

?>