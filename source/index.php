<?php

/**
 * Get all source codes for a given example
 * @api {get} /api/source
 * @param {int} exampleId - The id of the example to get source codes for
 */

require_once __DIR__ . '/../__src/api/SourceApi.php';
require_once __DIR__ . '/../__src/lib/Util/ApiUtil.php';
require_once __DIR__ . '/../__src/lib/Util/Logger.php';

try {
    $api = new SourceApi();
    $exampleId = ApiUtil::queryInt("exampleId");
    $data = $api->getSourcesByExample($exampleId);
    ApiUtil::json($data);
}
catch (Exception $e){
    Logger::error($e->getMessage());
    ApiUtil::error();
}
