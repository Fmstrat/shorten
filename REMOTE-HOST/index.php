<?php

#
# Enter your owncloud URL below with no trailing slash
# Ex. "https://mydomain.ext/owncloud"
#
$owncloud_url = "";

#
# Set enabled to true when you are ready to use the application
#
#$enabled = true;
$enabled = false;

function validateCode($string) {
	if(preg_match("/^[\w]+$/", $string)) {
		return true;
	} else {
		return false;
	}
}

function startsWith($haystack, $needle) {
	return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

if ($enabled) {
	$inurl = $_SERVER["REQUEST_URI"];
	$code = substr($inurl, strpos($inurl, "?") + 1);    
	if (validateCode($code)) {
		$url = $owncloud_url."/index.php/apps/shorten/code.php?code=".$code;
		ini_set('user_agent','ownCloud Downloader;');
		$headers = get_headers($url);
		foreach ($headers as $h) {
			if (startsWith($h, "Location:")) {
				header($h);
				exit;
			}
		}
		foreach ($headers as $h) {
			header($h);
		}
		$f = fopen($url, 'r');
		while(!feof($f)){
			if ($f)
				print fgets($f, 1024);
		}
		fclose($f);
	} else {
		echo "Invalid link.";
	}
}

?>
