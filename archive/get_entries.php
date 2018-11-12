<?php

include "constants.php";

// Build up the object/json representation of the entire archive
function scan_filesystem() {
	$archive_entries_path = realpath(__DIR__);
	$archive_entries_path_length = strlen($archive_entries_path);
	$archive = [];

	// List folder
	$dir_contents = scandir($archive_entries_path, 1); // reverse order

	// Get all valid year entries
	$year_folders = array();
	foreach ($dir_contents as $dir_content_item) {
		if(is_dir($dir_content_item) && is_numeric($dir_content_item)) {
			array_push($year_folders, $dir_content_item);
		}
	}

	foreach($year_folders as $year) {
		$year_folder_path = $archive_entries_path . '/' . $year;
		$dir_contents = scandir($year_folder_path, 1);
		
		// Get all valid entries
		$archive_items = array();
		foreach($dir_contents as $dir_content_item) {
			if(substr($dir_content_item, 0, 1) != '.') {
				array_push($archive_items, $dir_content_item);
			}
		}
		
		foreach($archive_items as $archive_item) {
			try {
				$archive_item_folder_path = $year_folder_path . '/' . $archive_item;
				$archive_item_main_filename = $archive_item_folder_path . '/main.json';

				// Skip entries missing their main.json
				if(!file_exists($archive_item_main_filename)) {
					continue;
				}

				$main_json = file_get_contents($archive_item_main_filename);
				$archive_item_description = json_decode($main_json, true);
			
				$minor_path = substr($archive_item_folder_path, $archive_entries_path_length);

				$archive[$minor_path] = $archive_item_description;
				$archive[$minor_path]['tags'] = flatten_tags(get_archive_item_tags($archive_item_description));
			}
			catch (Exception $e) {
				// Let it go
			}
		}
	}

	return $archive;
}

// NOTE : filtering is done principally on client side. This function is not used in ordinary operation
function check_filter($description, $tag) {
	if(array_key_exists('type', $description)) {
		$type = strtolower($description['type']);
		if($type ==$tag) {
			return true;
		}
	}

	if(array_key_exists('related projects', $description)) {
		foreach($description['related projects'] as $related_project) {
			if($related_project == $tag) {
				return true;
			}
		}
	}

	if(array_key_exists('date', $description)) {
		$date = date_parse($description['date']);
		if(strval($date['year']) == $tag) {
			return true;
		}
	}

	return false;
}

$archive = [];

// Check if cache exists 
if(file_exists($archive_cache_filename)) {
	$archive_json = file_get_contents($archive_cache_filename);
	$archive = json_decode($archive_json, true);
}
else {
	$archive = scan_filesystem();
	$archive_json = json_encode($archive);
	file_put_contents($archive_cache_filename, $archive_json);
}

if(array_key_exists('filter', $_GET)) {
	// Get the tag filters from query string
	$tag_filters = explode(",", $_GET['filter']);

	// Remove empty entries
	$tag_filters = array_filter($tag_filters, function($value) {
		return trim($value) != "";
	});

	if(count($tag_filters) > 0) {
		// Format the strings
		for($i = 0; $i < count($tag_filters); $i++) {
			//strip leading and trailing whitespace
			$entry = trim($tag_filters[$i]);

			//set it to lower
			$entry = strtolower($entry);

			//store back in array
			$tag_filters[$i] = $entry;
		}

		$archive_filtered = [];

		// Filter against these tags
		foreach($archive as $path => $description) {
			$passes_tag_filter = true;
			foreach($tag_filters as $tag_filter) {
				if (!check_filter($description, $tag_filter)) {
					//skip this entry if any tag filter doesn't match
					$passes_tag_filter = false;
					break;
				}
			}
			if($passes_tag_filter) {
				$archive_filtered[$path] = $description;
			}
		}

		// Replace the variable with the filtered one
		$archive = $archive_filtered;
	}
}

print json_encode($archive);

?>