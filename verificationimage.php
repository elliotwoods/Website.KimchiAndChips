<?php
// ----------------------------------------- 
//  The Web Help .com
// ----------------------------------------- 

if (!isset($_SERVER['HTTP_REFERER']) or checkValidReferer() === false) die();

function checkValidReferer() {
  $out = false;
  $ref = $_SERVER['HTTP_REFERER'];
  $lh = $_SERVER['HTTP_HOST'];
  if (stripos($ref,$lh) !== false) $out = true;
  return $out;
}

header('Content-type: image/png');
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$width = 110;
$height = 22;

$my_image = imagecreatetruecolor($width, $height);

imagefill($my_image, 0, 0, 0xececec);

// add noise
for ($c = 0; $c < 150; $c++){
	$x = rand(0,$width-1);
	$y = rand(0,$height-1);
	imagesetpixel($my_image, $x, $y, 0x000000);
}

$x = rand($width / 2 - 18 - 10,$width / 2 - 18 + 10);
$y = rand(2,6);

$rand_string = rand(1000,9999);
imagestring($my_image, 5, $x, $y, $rand_string, 0x000000);

setcookie('tntcon',(md5($rand_string.'a4xn')));

imagepng($my_image);
imagedestroy($my_image);
?>