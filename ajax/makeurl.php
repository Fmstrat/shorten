<?php

\OCP\User::checkLoggedIn();
\OCP\App::checkAppEnabled('ownnote');

//$newHost = "https://nowsci.com/s/";
$newHost = OCP\Config::getAppValue('shorten', 'host', '');


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
if ($newHost == "") {
	echo $curUrl;
} else {
	$shortcode = getShortcode($curUrl);
	$newUrl = $newHost."?".$shortcode;
	echo $newUrl;
}

?>
