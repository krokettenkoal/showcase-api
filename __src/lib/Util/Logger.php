<?php

require_once __DIR__ . "/../../lib/env.php";

const LOG_DIR = __DIR__ . "/../../../__log";
require_once __DIR__ . "/StringUtil.php";

class Logger {
    private static function log(string $level, string $message): void
    {
        $log = sprintf("[%s] %s: %s [%s]\n", date("Y-m-d H:i:s"), $level, $message, API_MODE);
        file_put_contents(LOG_DIR . "/api.log", $log, FILE_APPEND);
    }

    public static function info(string $message): void
    {
        if(StringUtil::isNullOrEmpty($message))
            return;

        self::log("INFO", $message);
    }

    public static function error(string $message): void
    {
        if(StringUtil::isNullOrEmpty($message))
            return;

        self::log("ERROR", $message);
    }
}