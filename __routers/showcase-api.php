<?php

require_once __DIR__ . '/../__src/lib/Router/Router.php';
require_once __DIR__ . '/../__src/lib/Controller/CourseController.php';
require_once __DIR__ . '/../__src/lib/Controller/ExampleController.php';
require_once __DIR__ . '/../__src/lib/Controller/SessionController.php';
require_once __DIR__ . '/../__src/lib/Controller/SourceController.php';
require_once __DIR__ . '/../__src/lib/Controller/SourceTypeController.php';
require_once __DIR__ . '/../__src/lib/Controller/StudyProgramController.php';
require_once __DIR__ . '/../__src/lib/Util/env.php';
require_once __DIR__ . '/../__src/config/' . API_MODE . '.inc.php';

use Phpress\Router\Router;
use Phpress\Controller\CourseController;
use Phpress\Controller\ExampleController;
use Phpress\Controller\SessionController;
use Phpress\Controller\SourceController;
use Phpress\Controller\SourceTypeController;
use Phpress\Controller\StudyProgramController;

const ShowcaseApiRouter = new Router(CFG_API['router.base'] ?? '/', 'showcase-api');

//  COURSE
ShowcaseApiRouter->get('/course', CourseController::getCourses(...));
ShowcaseApiRouter->get('/course/find', CourseController::getCourseById(...));

//  EXAMPLE
ShowcaseApiRouter->get('/example', ExampleController::getExamplesBySession(...));
ShowcaseApiRouter->get('/example/find', ExampleController::getExampleById(...));

//  SESSION
ShowcaseApiRouter->get('/session', SessionController::getSessionsByCourse(...));
ShowcaseApiRouter->get('/session/find', SessionController::getSessionById(...));

//  SOURCE
ShowcaseApiRouter->get('/source', SourceController::getSourcesByExample(...));
ShowcaseApiRouter->get('/source/find', SourceController::getSourceById(...));

//  SOURCE TYPE
ShowcaseApiRouter->get('/sourcetype', SourceTypeController::getSourceTypes(...));
ShowcaseApiRouter->get('/sourcetype/find', SourceTypeController::getSourceTypeById(...));

//  STUDY PROGRAM
ShowcaseApiRouter->get('/studyprogram', StudyProgramController::getStudyPrograms(...));
ShowcaseApiRouter->get('/studyprogram/find', StudyProgramController::getStudyProgramById(...));