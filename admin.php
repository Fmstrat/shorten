<?php

OCP\User::checkAdminUser();

//OCP\Util::addStyle('roundcube', 'adminSettings');
//OCP\Util::addScript('roundcube', 'adminSettings');


$tmpl = new OCP\Template('shorten', 'admin');
$host = OCP\Config::getAppValue('shorten', 'host', '');
$tmpl->assign('host', $host);

return $tmpl -> fetchPage();

