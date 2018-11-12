<?php

include "constants.php";

if(!file_exists($archive_cache_filename)) {
	throw(new Exception("We need $archive_cache_filename to exist before trying to get tags!"));
}
$archive_cache_modification_time = filemtime($archive_cache_filename);

// Check if we need to rebuild the tags cache
$needs_cache_rebuild = false;
if(!file_exists($tags_cache_filename)) {
	$needs_cache_rebuild = true;
}
else {
	$tags_cache_modification_time = filemtime($tags_cache_filename);

	if($archive_cache_modification_time > $tags_cache_modification_time) {
		$needs_cache_rebuild = true;
	}
}

if ($needs_cache_rebuild) {
	$archive_json = file_get_contents($archive_cache_filename);
	$archive = json_decode($archive_json, true);
	
	$years = [];
	$types = [];
	$projects = [];
	
	foreach($archive as $path => $description) {
		$archive_item_tags = get_archive_item_tags($description);

		merge_tags($years, $archive_item_tags['years']);
		merge_tags($types, $archive_item_tags['types']);
		merge_tags($projects, $archive_item_tags['projects']);
	}

	arsort($years);
	sort($types);
	sort($projects);

	$tags_cache = [];
	$tags_cache['years'] = $years;
	$tags_cache['types'] = $types;
	$tags_cache['projects'] = $projects;
	$tags_cache_json = json_encode($tags_cache);
	file_put_contents($tags_cache_filename, $tags_cache_json);
}
else {
	$tags_cache_json = file_get_contents($tags_cache_filename);
	$tags_cache = json_decode($tags_cache_json, true);
}

print(json_encode($tags_cache));

?>