<?php

namespace Phpress\Controller;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Handler/SourceHandler.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Phpress\Handler\SourceHandler;
use Phpress\Exception\ApiException;

class SourceController extends BaseController
{
    private static SourceHandler $handler;

    protected static function lazyInit(): void
    {
        if(empty(self::$handler))
            self::$handler = new SourceHandler();
    }

    /**
     * Gets all source codes for a given example
     * @param Request $req The request received from the router
     * @param Response $res The response to be sent by the router
     * @return Response The response containing the source codes
     */
    public static function getSourcesByExample(Request $req, Response $res): Response
    {
        self::lazyInit();
        $example = $req->query->getInt('example');
        $sources = self::$handler->getSourcesByExample($example);
        $res->setContent(json_encode($sources));
        return $res;
    }

    /**
     * Gets a source code by its ID
     * @param Request $req The request received from the router
     * @param Response $res The response to be sent by the router
     * @return Response The response containing the source code
     * @throws ApiException If the source code does not exist
     */
    public static function getSourceById(Request $req, Response $res): Response
    {
        self::lazyInit();
        $id = $req->query->getInt('id');
        $source = self::$handler->getSourceById($id);
        $res->setContent(json_encode($source));
        return $res;
    }
}