<?

$activeArguments = array();
if (is_array($argv)) {
	$activeArguments =  array_shift($argv);
}

$isLive = in_array("--make", $activeArguments);
?>