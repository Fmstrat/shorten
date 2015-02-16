<?php

\OCP\App::checkAppEnabled('shorten');

function validateCode($string) {
	if(preg_match("/^[\w]+$/", $string)) {
		return true;
	} else {
		return false;
	}
}

$code = $_GET['code'];
if (validateCode($code)) {
	$url = "";
	$query = OCP\DB::prepare('SELECT * FROM *PREFIX*shorten WHERE shortcode=?');
	$results = $query->execute(Array($code))->fetchAll();
	if ($results) {
		foreach($results as $result) {
			$url = $result['url'];	
		}
	}
	if ($url != "") {
		//header("Location: ".$url."&download");
		$url = $url."/download";
		ini_set('user_agent','ownCloud Downloader;'); 
		$headers = get_headers($url);
		$binary = false;
		foreach ($headers as $h) {
			if ($h == "Content-Transfer-Encoding: binary")
				$binary = true;
		}
		if ($binary) {
			foreach ($headers as $h) {
				header($h);
			}
			$f = fopen($url, 'r');
			while(!feof($f)){
				print fgets($f, 1024);
			}
			fclose($f);
		} else {
			header("Location: ".$url);
		}
	} else {
		echo "Invalid link.";
	}
} else {
	echo "Invalid link.";
}
