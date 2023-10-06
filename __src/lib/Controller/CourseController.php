<?php

namespace Phpress\Controller;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Handler/CourseHandler.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Phpress\Handler\CourseHandler;
use Phpress\Exception\ApiException;

class CourseController extends BaseController
{
    private static CourseHandler $handler;

    protected static function lazyInit(): void
    {
        if(empty(self::$handler))
            self::$handler = new CourseHandler();
    }

    /**
     * Gets all courses
     * @param Request $req The request received from the router
     * @param Response $res The response to be sent by the router
     * @return Response The response containing the courses
     */
    public static function getCourses(Request $req, Response $res): Response
    {
        self::lazyInit();
        $courses = self::$handler->getCourses();
        $res->setContent(json_encode($courses));
        return $res;
    }

    /**
     * Gets a course by its ID
     * @param Request $req The request received from the router
     * @param Response $res The response to be sent by the router
     * @return Response The response containing the course
     * @throws ApiException If the course does not exist
     */
    public static function getCourseById(Request $req, Response $res): Response
    {
        self::lazyInit();
        $id = $req->query->getInt('id');
        $course = self::$handler->getCourseById($id);
        $res->setContent(json_encode($course));
        return $res;
    }
}