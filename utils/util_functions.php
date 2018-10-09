<?php

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
			self::deleteDir($file);
		} else {
			unlink($file);
		}
	}
	rmdir($dirPath);
}

//from https://secure.php.net/manual/en/function.imagecreatefromjpeg.php
function imageCreateFromAny($filepath) { 
	$type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize() 
	$allowedTypes = array( 
		1,  // [] gif 
		2,  // [] jpg 
		3,  // [] png 
		6   // [] bmp 
	); 
	if (!in_array($type, $allowedTypes)) { 
		return false; 
	} 
	switch ($type) { 
		case 1 : 
			$im = imageCreateFromGif($filepath); 
		break; 
		case 2 : 
			$im = imageCreateFromJpeg($filepath); 
		break; 
		case 3 : 
			$im = imageCreateFromPng($filepath); 
		break; 
		case 6 : 
			$im = imageCreateFromBmp($filepath); 
		break; 
	}    
	return $im;  
} 

?>