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

namespace OCA\Shorten\Controller;

use \OCP\AppFramework\ApiController;
use \OCP\AppFramework\Http\JSONResponse;
use \OCP\AppFramework\Http\Response;
use \OCP\AppFramework\Http;
use \OCP\IRequest;

#\OCP\User::checkLoggedIn();
\OCP\App::checkAppEnabled('shorten');


class ShortenApiController extends ApiController {

    private $userId;

    public function __construct($appName, IRequest $request){
        parent::__construct($appName, $request);
    }


    /**
     * @NoAdminRequired
     * @CORS
     * @NoCSRFRequired
     */
    public function makeurl() {
	require_once 'shorten/lib/makeurl.php';
	return generateUrl();
    }

    /**
     * @NoAdminRequired
     * @CORS
     * @NoCSRFRequired
     */
    public function code() {
	require_once 'shorten/lib/code.php';
	return runCode();
    }

    /**
     * @CORS
     * @NoCSRFRequired
     */
    public function setval() {
	require_once 'shorten/lib/setval.php';
	return setAdminVal();
    }
}
