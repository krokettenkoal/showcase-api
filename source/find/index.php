<?php

/**
 * Get a source code by id
 * @api {get} /source/find
 * @param {int} sourceId - The id of the source type to get
 */

require_once __DIR__ . '/../../__src/api/SourceApi.php';
require_once __DIR__ . '/../../__src/lib/Util/ApiUtil.php';
require_once __DIR__ . '/../../__src/lib/Util/Logger.php';

try {
    $api = new SourceApi();
    $sourceId = ApiUtil::queryInt("sourceId");
    $data = $api->getSourceById($sourceId);
    ApiUtil::json($data);
}
catch (ApiException $ex) {
    ApiUtil::error($ex->getCode());
} catch (Exception|Error $err){
    Logger::error($err->getMessage());
    ApiUtil::error();
}
