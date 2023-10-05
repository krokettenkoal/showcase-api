<?php

namespace Phpress\Util;

require_once __DIR__ . '/../Exception/ApiException.php';
require_once __DIR__ . '/StringUtil.php';

use Phpress\Exception\ApiException;

/**
 * @deprecated Will be removed in favor of the Phpress Router
 */
class ApiUtil
{
    /**
     * Sends a JSON response
     * @param mixed $data The data to be sent
     */
    public static function json(mixed $data): void
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    /**
     * Sets the HTTP response code
     * @param int $code The HTTP response code
     */
    public static function error(int $code = 500): void {
        http_response_code($code);
    }

    /**
     * Retrieves a query parameter
     * @param string $param The query parameter name
     * @throws ApiException If the query parameter does not exist or is empty
     */
    public static function query(string $param): string {
        if(StringUtil::isNullOrEmpty($param))
            throw new ApiException(400, "No query parameter name specified");

        $val = $_GET[$param];
        if(StringUtil::isNullOrEmpty($val))
            throw new ApiException(400, "Query parameter $param does not exist or is empty");

        return $val;
    }

    /**
     * Retrieves a query parameter as an int
     * @param string $param The query parameter name
     * @throws ApiException If the query parameter does not exist, is empty or cannot be converted to int
     */
    public static function queryInt(string $param): int {
        $val = self::query($param);
        $val = intval($val);
        if($val === 0)
            throw new ApiException(400, "Query parameter $param cannot be converted to int");

        return $val;
    }
}
