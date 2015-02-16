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


use \OCP\AppFramework\App;
use \OCP\IContainer;

use \OCA\Shorten\Controller\ShortenApiController;


class Application extends App {


	public function __construct (array $urlParams=array()) {
		parent::__construct('shorten', $urlParams);

		$container = $this->getContainer();

		/**
		 * Controllers
		 */
                $container->registerService('ShortenApiController', function($c){
                        return new ShortenApiController(
                                $c->query('AppName'),
                                $c->query('Request')
                        );
                });


		/**
		 * Core
		 */
		$container->registerService('UserId', function(IContainer $c) {
			return \OCP\User::getUser();
		});		
		
	}
}
