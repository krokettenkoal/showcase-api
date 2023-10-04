<?php

/**
 * Get all examples for a given session
 * @api {get} /api/example
 * @param {int} sessionId - The id of the session to get examples for
 */

require_once __DIR__ . '/../__src/api/ExampleApi.php';
require_once __DIR__ . '/../__src/lib/Util/ApiUtil.php';
require_once __DIR__ . '/../__src/lib/Util/Logger.php';

try {
    $api = new ExampleApi();
    $sessionId = ApiUtil::queryInt("sessionId");
    $data = $api->getExamplesBySession($sessionId);
    ApiUtil::json($data);
}
catch (Exception $e){
    Logger::error($e->getMessage());
    ApiUtil::error();
}
