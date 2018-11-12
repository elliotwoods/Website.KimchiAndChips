<?php

$path_to_image_cache = realpath(__DIR__) . "/../image_cache/";
$current_page_folder_path = substr($_SERVER['REQUEST_URI'], 0, strripos($_SERVER['REQUEST_URI'], '/') + 1);

$folder_depth = substr_count($current_page_folder_path, '/') - 1;

$path_to_base_url = "";
for($i=0; $i<$folder_depth; $i++) {
	$path_to_base_url .= '../';
}

$url_to_fetch_script = "/utils/serve_image.php";


//from https://stackoverflow.com/questions/3349753/delete-directory-with-files-in-it
function deleteDir($dirPath) {
	if (! is_dir($dirPath)) {
		throw new InvalidArgumentException("$dirPath must be a directory");
	}
	if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
		$dirPath .= '/';
	}
	$files = glob($dirPath . '*', GLOB_MARK);
	foreach ($files as $file) {
		if (is_dir($file)) {
			deleteDir($file);
		} else {
			unlink($file);
		}
	}
	rmdir($dirPath);
}

//from https://secure.php.net/manual/en/function.imagecreatefromjpeg.php
function imageCreateFromAny($file_path) {
	$image_info = getimagesize($file_path); // [] if you don't have exif you could use getImageSize() 
	$image_mime_type = $image_info['mime'];

	$allowed_types = array( 
		'image/gif',
		'image/jpeg',
		'image/png',
		'image/bmp',
		'image/webp'
	);

	if (!in_array($image_mime_type, $allowed_types)) { 
		return false; 
	}

	switch (array_search($image_mime_type, $allowed_types)) { 
		case 0:
			return imagecreatefomgif($file_path); 
		case 1:
			return imagecreatefromjpeg($file_path);
		case 2: 
			return imagecreatefrompng($file_path);
		case 3:
			return imagecreatefrombmp($file_path);
		case 4:
			return imagecreatefromwebp($file_path);
	}

	return false;
} 

?>