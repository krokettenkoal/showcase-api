<?php

/**
 * Get study program by id
 * @api {get} /api/studyprogram/find
 * @param {int} programId - id of the study program to get
 */

require_once __DIR__ . '/../../__src/api/StudyProgramApi.php';
require_once __DIR__ . '/../../__src/lib/Util/ApiUtil.php';
require_once __DIR__ . '/../../__src/lib/Util/Logger.php';

try {
    $api = new StudyProgramApi();
    $programId = ApiUtil::queryInt("programId");
    $data = $api->getStudyProgramById($programId);
    ApiUtil::json($data);
}
catch (ApiException $ex) {
    ApiUtil::error($ex->getCode());
} catch (Exception|Error $err){
    Logger::error($err->getMessage());
    ApiUtil::error();
}
