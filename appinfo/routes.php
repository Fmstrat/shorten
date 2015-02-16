<?php
/**
 * ownCloud - shorten
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Ben Curtis <ownclouddev@nosolutions.com>
 * @copyright Ben Curtis 2015
 */

namespace OCA\Shorten\AppInfo;

/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
$application = new Application();

$application->registerRoutes($this, array('routes' => array(
	array('name' => 'shorten_api#makeurl', 'url' => '/makeurl', 'verb' => 'POST'),
	array('name' => 'shorten_api#setval', 'url' => '/setval', 'verb' => 'POST'),
        array('name' => 'shorten_api#preflighted_cors', 'url' => '/api/v0.2/{path}', 'verb' => 'OPTIONS', 'requirements' => array('path' => '.+')),
)));

$this->create('shorten_code', '/code.php')->action( function($params){ require 'shorten/lib/code.php'; } );
