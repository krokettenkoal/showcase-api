<?php

/**
 * Get a source type by id
 * @api {get} /sourcetype/find
 * @param {int} typeId - The id of the source type to get
 */

require_once __DIR__ . '/../../__src/api/SourceTypeApi.php';
require_once __DIR__ . '/../../__src/lib/Util/ApiUtil.php';
require_once __DIR__ . '/../../__src/lib/Util/Logger.php';

try {
    $api = new SourceTypeApi();
    $typeId = ApiUtil::queryInt("typeId");
    $data = $api->getSourceTypeById($typeId);
    ApiUtil::json($data);
}
catch (ApiException $ex) {
    ApiUtil::error($ex->getCode());
} catch (Exception|Error $err){
    Logger::error($err->getMessage());
    ApiUtil::error();
}
