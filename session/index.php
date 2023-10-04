<?php

/**
 * Get all source codes for a given course
 * @api {get} /api/session
 * @param {int} courseId - The id of the course to get sessions for
 */

require_once __DIR__ . '/../__src/api/SessionApi.php';
require_once __DIR__ . '/../__src/lib/Util/ApiUtil.php';
require_once __DIR__ . '/../__src/lib/Util/Logger.php';

try {
    $api = new SessionApi();
    $courseId = ApiUtil::queryInt("courseId");
    $data = $api->getSessionsByCourse($courseId);
    ApiUtil::json($data);
}
catch (Exception $e){
    Logger::error($e->getMessage());
    ApiUtil::error();
}
