<?php

/**
 * Get a session by id
 * @api {get} /session/find
 * @param {int} sessionId - The id of the session to get
 */

require_once __DIR__ . '/../../__src/api/SessionApi.php';
require_once __DIR__ . '/../../__src/lib/Util/ApiUtil.php';
require_once __DIR__ . '/../../__src/lib/Util/Logger.php';

try {
    $api = new SessionApi();
    $sessionId = ApiUtil::queryInt("sessionId");
    $data = $api->getSessionById($sessionId);
    ApiUtil::json($data);
}
catch (ApiException $ex) {
    ApiUtil::error($ex->getCode());
} catch (Exception|Error $err){
    Logger::error($err->getMessage());
    ApiUtil::error();
}
