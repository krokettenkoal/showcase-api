<?php

/**
 * Get course by id
 * @api {get} /course/find
 * @param {int} courseId - id of the course to get
 */

require_once __DIR__ . '/../../__src/api/CourseApi.php';
require_once __DIR__ . '/../../__src/lib/Util/ApiUtil.php';
require_once __DIR__ . '/../../__src/lib/Util/Logger.php';

try {
    $api = new CourseApi();
    $courseId = ApiUtil::queryInt("courseId");
    $data = $api->getCourseById($courseId);
    ApiUtil::json($data);
}
catch (ApiException $ex) {
    ApiUtil::error($ex->getCode());
} catch (Exception|Error $err){
    Logger::error($err->getMessage());
    ApiUtil::error();
}
