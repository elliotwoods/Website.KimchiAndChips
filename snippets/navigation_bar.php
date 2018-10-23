<?php

function style_navi($navi_name) {
	if (!isset($page_name)) {
		return "";
	}

	if ($navi_name == $page_name) {
		return "top-navi-item-selected";
	}
	else {
		return "";
	}
}

function render_navi_item($navi_page_name) {
	global $page_name;
	
	if (isset($page_name)) {
		if ($page_name == $navi_page_name) {
			return '<div><span class="top-navi-selected top-works animated fadeIn"> ' . $navi_page_name . ' </span></div>';
		}
	}

	return '<a class="top-navi-item top-works animated fadeIn" href="/../' . $navi_page_name . '/"> ' . $navi_page_name . ' </a>';
}

?>

<div class="header">

	<div class="header-background"></div>
	
	<div class="top-logo">
		<a href="/./works/">
			<img class=logo src="/images/logo.png" alt="titleLogo" height="50px">
		</a>
	</div>

    <div class="top-navi">
		<div class="top-navi-1">
			<div class="top-navi-item top-works"><?= render_navi_item("works") ?></div>
			<div class="top-navi-item top-about"><?= render_navi_item("about") ?></div>
		</div>
		<div class="top-navi-2">
			<div class="top-navi-item top-archive"><?= render_navi_item("archive") ?></div>
			<div class="top-navi-item top-contact"><?= render_navi_item("contact") ?></div>
		</div>
    </div>

</div>