<?php

include("utils.php");

$target_width = $_GET['width'];

$url = $_GET['url'];
$cache_image_path = $path_to_image_cache . $url;
$cache_asset_path = $cache_image_path . '/' . $target_width  . '.jpg';

// check if a cached copy already exists
if (!file_exists($cache_asset_path)) {
	$source_image_path = $path_to_base_url . $url;
	$source_image = imageCreateFromAny($source_image_path);
	$source_image_resolution = getimagesize($source_image_path);

	$target_scale_factor = $target_width / $source_image_resolution[0];
	$target_height = floor($source_image_resolution[1] * $target_scale_factor);

	$target_image = imagecreatetruecolor($target_width, $target_height);

	imagecopyresampled($target_image
		, $source_image
		, 0, 0
		, 0, 0
		, $target_width, $target_height
		, $source_image_resolution[0], $source_image_resolution[1]);
	
	imagejpeg($target_image, $cache_asset_path, 95);
}

header('Content-Type: image/jpeg');
print(file_get_contents($cache_asset_path));
?>