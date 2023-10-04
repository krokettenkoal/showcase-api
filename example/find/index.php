<?php

/**
 * Get an example by id
 * @api {get} /example/find
 * @param {int} exampleId - The id of the example to get
 */

require_once __DIR__ . '/../../__src/api/ExampleApi.php';
require_once __DIR__ . '/../../__src/lib/Util/ApiUtil.php';
require_once __DIR__ . '/../../__src/lib/Util/Logger.php';

try {
    $api = new ExampleApi();
    $exampleId = ApiUtil::queryInt("exampleId");
    $data = $api->getExampleById($exampleId);
    ApiUtil::json($data);
}
catch (ApiException $ex) {
    ApiUtil::error($ex->getCode());
} catch (Exception|Error $err){
    Logger::error($err->getMessage());
    ApiUtil::error();
}
