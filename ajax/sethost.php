<?php

OCP\User::checkAdminUser();
\OCP\App::checkAppEnabled('ownnote');

$host = $_POST['host'];
OCP\Config::setAppValue('shorten', 'host', $host);

echo $host;

?>
