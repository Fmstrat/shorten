<?php


OCP\User::checkAdminUser();
\OCP\App::checkAppEnabled('shorten');

function setAdminVal() {
	if (isset($_POST['host'])) {
		OCP\Config::setAppValue('shorten', 'host', $_POST['host']);
		echo "host:".$_POST['host'];
	}
	if (isset($_POST['api'])) {
		OCP\Config::setAppValue('shorten', 'api', $_POST['api']);
		echo "api:".$_POST['api'];
	}
	if (isset($_POST['type'])) {
		OCP\Config::setAppValue('shorten', 'type', $_POST['type']);
		echo "type:".$_POST['type'];
	}
}
?>
