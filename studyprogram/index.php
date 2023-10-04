<?php

/**
 * Get all study programs
 * @api {get} /api/studyprogram
 */

require_once __DIR__ . '/../__src/api/StudyProgramApi.php';
require_once __DIR__ . '/../__src/lib/Util/ApiUtil.php';
require_once __DIR__ . '/../__src/lib/Util/Logger.php';

try {
    $api = new StudyProgramApi();
    $data = $api->getStudyPrograms();
    ApiUtil::json($data);
}
catch (Exception $e){
    Logger::error($e->getMessage());
    ApiUtil::error();
}
