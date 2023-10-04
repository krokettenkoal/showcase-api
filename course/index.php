<?php

/**
 * Get all courses
 * @api {get} /api/course
 */

require_once __DIR__ . '/../__src/api/CourseApi.php';
require_once __DIR__ . '/../__src/lib/Util/ApiUtil.php';
require_once __DIR__ . '/../__src/lib/Util/Logger.php';

try {
    $api = new CourseApi();
    $data = $api->getCourses();
    ApiUtil::json($data);
}
catch (Exception $e){
    Logger::error($e->getMessage());
    ApiUtil::error();
}
