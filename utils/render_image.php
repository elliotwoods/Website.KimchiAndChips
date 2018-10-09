<?php

include("utils.php");

function render_image($url, $parameter_string = "") {
	global $path_to_image_cache, $path_to_base_url, $url_to_fetch_script, $current_page_folder_path;

	
	echo "<picture>";

	//make path absolute
	if(substr($url, 0, 1) != '/') {
		$abs_url = $current_page_folder_path . $url;
	}
	else {
		$abs_url = $url;
	}

	$raw_image_path = $path_to_base_url . $abs_url;
	$cache_image_path = $path_to_image_cache . $abs_url;
	$cache_details_filename = $cache_image_path . '/cache_details.json';

	$file_modification_time = filemtime($raw_image_path);
	$file_size = filesize($raw_image_path);

	$needs_build_cache = false;
	$image_size = null;

	//try to get the image size from the existing cache
	try {
		//presume it's a folder
		if(file_exists($cache_image_path)) {
			//check if the cache is valid

			$cache_details_file = file_get_contents($cache_details_filename);
			$cache_details = json_decode($cache_details_file, true);

			if($file_modification_time != $cache_details['file_modification_time']) {
				throw new Exception();
			}

			if($file_size != $cache_details['file_size']) {
				throw new Exception();
			}

			if(!array_key_exists('image_size', $cache_details)) {
				throw new Exception();
			}
			else {
				$image_size = $cache_details['image_size'];
			}

			$needs_build_cache = false;
		}
		else {
			//needs to build, but no exceptions, so don't need to clear existing
			$needs_build_cache = true;
		}

		// If we got to here, then we can presume that the cache is valid
	}
	catch (Exception $e) {
		$needs_build_cache = true;

		//invalidate the cache - also removes all cached files
		if(file_exists($cache_image_path)) {
			deleteDir($cache_image_path);
		}
	}

	// get the image size and save it as a cache
	if($needs_build_cache) {
		$image_size = getimagesize($raw_image_path);
		
		$cache_details = array();
		$cache_details['file_modification_time'] = $file_modification_time;
		$cache_details['file_size'] = $file_size;
		$cache_details['image_size'] = $image_size;

		mkdir($cache_image_path, 0777, true);
		file_put_contents($cache_details_filename, json_encode($cache_details));
	}

	$pyramid_width = $image_size[0];
	do {
		$pyramid_url = "";
		if($pyramid_width == $image_size[0]) {
			//serve original image
			$pyramid_url = $url;
		}
		else {
			$pyramid_url = $url_to_fetch_script . "?url=" . urlencode($abs_url) . '&width=' . $pyramid_width;
		}

		echo '<source media="(min-width: ' . ($pyramid_width / 2) .  'px)" srcset="' . $pyramid_url . '">' . "\n";

		$pyramid_width /= 2;
		$pyramid_width = floor($pyramid_width);
	} while ($pyramid_width > 256);
	
	echo '<img src="' . $url . '" class="fadeInOnLoad" ' . $parameter_string . '/>';
	echo "</picture>";
}
?>
