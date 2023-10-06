<?php

namespace Phpress\Controller;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Handler/SessionHandler.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Phpress\Handler\SessionHandler;
use Phpress\Exception\ApiException;

class SessionController extends BaseController
{
    private static SessionHandler $handler;

    protected static function lazyInit(): void
    {
        if(empty(self::$handler))
            self::$handler = new SessionHandler();
    }

    /**
     * Gets all sessions for a given course
     * @param Request $req The request received from the router
     * @param Response $res The response to be sent by the router
     * @return Response The response containing the sessions
     */
    public static function getSessionsByCourse(Request $req, Response $res): Response
    {
        self::lazyInit();
        $course = $req->query->getInt('course');
        $sessions = self::$handler->getSessionsByCourse($course);
        $res->setContent(json_encode($sessions));
        return $res;
    }

    /**
     * Gets a session (lecture/exercise) by its ID
     * @param Request $req The request received from the router
     * @param Response $res The response to be sent by the router
     * @return Response The response containing the session
     * @throws ApiException If the session does not exist
     */
    public static function getSessionById(Request $req, Response $res): Response
    {
        self::lazyInit();
        $id = $req->query->getInt('id');
        $session = self::$handler->getSessionById($id);
        $res->setContent(json_encode($session));
        return $res;
    }
}