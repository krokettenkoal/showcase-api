<?php

namespace Phpress\Controller;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Handler/SourceTypeHandler.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Phpress\Handler\SourceTypeHandler;
use Phpress\Exception\ApiException;

class SourceTypeController extends BaseController
{
    private static SourceTypeHandler $handler;

    protected static function lazyInit(): void
    {
        if(empty(self::$handler))
            self::$handler = new SourceTypeHandler();
    }

    /**
     * Gets all source types
     * @param Request $req The request received from the router
     * @param Response $res The response to be sent by the router
     * @return Response The response containing the source types
     */
    public static function getSourceTypes(Request $req, Response $res): Response
    {
        self::lazyInit();
        $sourceTypes = self::$handler->getSourceTypes();
        $res->setContent(json_encode($sourceTypes));
        return $res;
    }

    /**
     * Gets a source type by its ID
     * @param Request $req The request received from the router
     * @param Response $res The response to be sent by the router
     * @return Response The response containing the source type
     * @throws ApiException If the source type does not exist
     */
    public static function getSourceTypeById(Request $req, Response $res): Response
    {
        self::lazyInit();
        $id = $req->query->getInt('id');
        $sourceType = self::$handler->getSourceTypeById($id);
        $res->setContent(json_encode($sourceType));
        return $res;
    }
}