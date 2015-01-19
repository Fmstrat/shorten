<?php

\OCP\User::checkLoggedIn();
\OCP\App::checkAppEnabled('shorten');


//$newHost = "https://nowsci.com/s/";
$host = OCP\Config::getAppValue('shorten', 'host', '');
$type = OCP\Config::getAppValue('shorten', 'type', '');
$api = OCP\Config::getAppValue('shorten', 'api', '');

function startsWith($haystack, $needle) {
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

function rand_chars($length) {
	$urlString = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$arr = str_split($urlString);
	shuffle($arr);
	$arr = array_slice($arr, 0, $length);
	$str = implode('', $arr);
	return $str;
} 

function getShortcode($url) {
	$shortcode = '';
	$query = OCP\DB::prepare('SELECT shortcode FROM *PREFIX*shorten WHERE url=?');
	$results = $query->execute(Array($url))->fetchAll();
	if ($results) {
		foreach($results as $result) {
			$shortcode = $result['shortcode'];	
		}
	}
	if ($shortcode == "") {
		$shortcode = rand_chars(6);
		$found = true;
		while ($found) {
			$query = OCP\DB::prepare('SELECT id FROM *PREFIX*shorten WHERE shortcode=?');
			$results = $query->execute(Array($shortcode))->fetchAll();
			if (!$results) {
				$found = false;
				$uid = \OCP\User::getUser();
				$query = OCP\DB::prepare('INSERT INTO *PREFIX*shorten (uid, shortcode, url) VALUES (?,?,?)');
				$query->execute(Array($uid,$shortcode,$url));
				$id = OCP\DB::insertid('*PREFIX*shorten');
			} else
				$shortcode = rand_chars(6);
		}
	}
	return $shortcode;
}

$curUrl = $_POST['curUrl'];
if (isset($type) && ($type == "" || $type == "internal")) {
	if ($host == "" || startsWith($curUrl, $host)) {
		echo $curUrl;
	} else {
		$shortcode = getShortcode($curUrl);
		$newUrl = $host."?".$shortcode;
		echo $newUrl;
	}
} elseif ($type == "googl") {
	if ($api && $api != "") {
		require_once __DIR__ . '/../lib/class.googl.php';
		$googl = new googl($api);
		$short = $googl->s($curUrl);
		echo $short;
	} else {
		echo $curUrl;
	}
} else {
	echo $curUrl;
}

?>
