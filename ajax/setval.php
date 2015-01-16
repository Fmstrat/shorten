<?php

OCP\User::checkAdminUser();
\OCP\App::checkAppEnabled('ownnote');

if ($_POST['host']) {
	OCP\Config::setAppValue('shorten', 'host', $_POST['host']);
	echo "host:".$_POST['host'];
}
if ($_POST['api']) {
	OCP\Config::setAppValue('shorten', 'api', $_POST['api']);
	echo "api:".$_POST['api'];
}
if ($_POST['type']) {
	OCP\Config::setAppValue('shorten', 'type', $_POST['type']);
	echo "type:".$_POST['type'];
}


?>
