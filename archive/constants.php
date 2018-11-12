<?php

$archive_cache_filename = "archive_cache.json";
$tags_cache_filename = "tags_cache.json";

function get_archive_item_tags($description) {
	$tags = [];

	if(array_key_exists('date', $description)) {
		$date = date_parse($description['date']);
		$year = strval($date['year']);
		$tags['years'] = [ $year ];
	}
	else {
		$tags['years'] = [];
	}

	if(array_key_exists('type', $description)) {
		$type = $description['type'];
		$tags['types'] = [ $type ];
	}
	else {
		$tags['types'] = [];
	}

	if(array_key_exists('related projects', $description)) {
		$tags['projects'] = $description['related projects'];
	}
	else {
		$tags['projects'] = [];
	}

	return $tags;
}

function merge_tags(&$collection, $addition) {
	foreach($addition as $entry) {
		if(!in_array($entry, $collection)) {
			array_push($collection, $entry);
		}
	}
}

function flatten_tags($archive_tag_set) {
	$tags = [];
	merge_tags($tags, $archive_tag_set['years']);
	merge_tags($tags, $archive_tag_set['types']);
	merge_tags($tags, $archive_tag_set['projects']);
	return $tags;
}

?>