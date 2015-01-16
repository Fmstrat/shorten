<?php

OCP\User::checkAdminUser();

//OCP\Util::addStyle('roundcube', 'adminSettings');
//OCP\Util::addScript('roundcube', 'adminSettings');


$tmpl = new OCP\Template('shorten', 'admin');
$tmpl->assign('type', OCP\Config::getAppValue('shorten', 'type', ''));
$tmpl->assign('host', OCP\Config::getAppValue('shorten', 'host', ''));
$tmpl->assign('api', OCP\Config::getAppValue('shorten', 'api', ''));

return $tmpl -> fetchPage();

