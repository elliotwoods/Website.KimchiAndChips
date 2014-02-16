<?

$GLOBALS['isLive'] = in_array("--export", $argv);

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