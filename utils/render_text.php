<?php

include_once "utils.php";
include_once dirname(__DIR__) . "/libs/parsedown/Parsedown.php";

$Parsedown = new Parsedown;
$Parsedown->setSafeMode(true);

function render_markdown($text) {
	global $Parsedown;
	return $Parsedown->text($text);
}

function render_markdown_file($filename) {
	$text = file_get_contents($filename);
	return render_markdown($text);
}

?>