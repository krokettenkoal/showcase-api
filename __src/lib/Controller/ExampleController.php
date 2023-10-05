<?php

namespace Phpress\Controller;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Handler/ExampleHandler.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Phpress\Handler\ExampleHandler;
use Phpress\Exception\ApiException;

class ExampleController extends BaseController
{
    private static ExampleHandler $handler;

    protected static function lazyInit(): void
    {
        if(empty(self::$handler))
            self::$handler = new ExampleHandler();
    }

    /**
     * Gets all examples for a given session
     * @param Request $req The request received from the router
     * @param Response $res The response to be sent by the router
     * @return Response The response containing the examples
     */
    public static function getExamplesBySession(Request $req, Response $res): Response
    {
        self::lazyInit();
        $session = $req->query->getInt('session');
        $examples = self::$handler->getExamplesBySession($session);
        $res->setContent(json_encode($examples));
        return $res;
    }

    /**
     * Gets a lecture example by its ID
     * @param Request $req The request received from the router
     * @param Response $res The response to be sent by the router
     * @return Response The response containing the example
     * @throws ApiException If the example does not exist
     */
    public static function getExampleById(Request $req, Response $res): Response
    {
        self::lazyInit();
        $id = $req->query->getInt('id');
        $example = self::$handler->getExampleById($id);
        $res->setContent(json_encode($example));
        return $res;
    }
}