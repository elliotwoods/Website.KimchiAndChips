<?

$args = array();
if(isset($argv)) {
  $args = $argv;
}

$GLOBALS['isLive'] = in_array("--export", $args);

function varDump($var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

function shortenText($text, $targetLength) {
	$rawLength = strlen($text);
	if ($rawLength < $targetLength) {
		return $text;
	} else {
		$firstSection = substr($text, 0, $targetLength - 6);
		$lastSection = substr($text, -3, 3);
		return $firstSection . "..." . $lastSection;
	}
}
?>
