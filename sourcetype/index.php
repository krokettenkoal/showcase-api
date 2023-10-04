<?php

/**
 * Get all source types
 * @api {get} /api/sourcetype
 */

require_once __DIR__ . '/../__src/api/SourceTypeApi.php';
require_once __DIR__ . '/../__src/lib/Util/ApiUtil.php';
require_once __DIR__ . '/../__src/lib/Util/Logger.php';

try {
    $api = new SourceTypeApi();
    $data = $api->getSourceTypes();
    ApiUtil::json($data);
}
catch (Exception $e){
    Logger::error($e->getMessage());
    ApiUtil::error();
}
