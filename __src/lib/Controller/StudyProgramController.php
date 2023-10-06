<?php

namespace Phpress\Controller;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Handler/StudyProgramHandler.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Phpress\Handler\StudyProgramHandler;
use Phpress\Exception\ApiException;

class StudyProgramController extends BaseController
{
    private static StudyProgramHandler $handler;

    protected static function lazyInit(): void
    {
        if(empty(self::$handler))
            self::$handler = new StudyProgramHandler();
    }

    /**
     * Gets all study programs
     * @param Request $req The request received from the router
     * @param Response $res The response to be sent by the router
     * @return Response The response containing the study programs
     */
    public static function getStudyPrograms(Request $req, Response $res): Response
    {
        self::lazyInit();
        $studyPrograms = self::$handler->getStudyPrograms();
        $res->setContent(json_encode($studyPrograms));
        return $res;
    }

    /**
     * Gets a study program by its ID
     * @param Request $req The request received from the router
     * @param Response $res The response to be sent by the router
     * @return Response The response containing the study program
     * @throws ApiException If the study program does not exist
     */
    public static function getStudyProgramById(Request $req, Response $res): Response
    {
        self::lazyInit();
        $id = $req->query->getInt('id');
        $studyProgram = self::$handler->getStudyProgramById($id);
        $res->setContent(json_encode($studyProgram));
        return $res;
    }
}