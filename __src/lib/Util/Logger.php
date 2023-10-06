<?php

namespace Phpress\Util;

require_once __DIR__ . "/env.php";
require_once __DIR__ . "/StringUtil.php";

class Logger {
    private const LOG_DIR = __DIR__ . "/../../../__log/";

    public const LOG_LEVEL_INFO = "INFO";
    public const LOG_LEVEL_ERROR = "ERROR";
    public const LOG_LEVEL_DEBUG = "DEBUG";
    public const LOG_LEVEL_WARN = "WARN";

    private const DEFAULT_LOG_NAME = "app";

    private string $name;

    public function __construct(?string $name = null) {
        $name = self::validateLogName($name);
        $this->name = $name;
    }

    /**
     * Validates the given log (file) name
     * @param string|null $logName The log name to validate
     * @return string The validated log name, or the default log name if the given log name is invalid (or empty/null)
     */
    private static function validateLogName(?string $logName): string {
        if(StringUtil::isNullOrEmpty($logName))
            return self::DEFAULT_LOG_NAME;

        $rx = '/^\.?[\w.]?\w+$/';
        if(!preg_match($rx, $logName))
            return self::DEFAULT_LOG_NAME;

        return $logName;
    }

    /**
     * Gets the log name (without extension)
     * @return string The log name
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Gets the log path
     * @return string The path to the log file
     */
    public function getLogPath(): string {
        return self::LOG_DIR . $this->name . ".log";
    }

    /**
     * Logs a message with the given log level
     * @param string $level The log level
     * @param string $message The message to log
     * @return void
     */
    public function log(string $level, string $message): void
    {
        $log = sprintf("[%s] %s: %s [%s]\n", date("Y-m-d H:i:s"), $level, $message, API_MODE);
        file_put_contents($this->getLogPath(), $log, FILE_APPEND);
    }

    /**
     * Logs an info message
     * @param string $message The message to log
     * @return void
     */
    public function info(string $message): void
    {
        if(StringUtil::isNullOrEmpty($message))
            return;

        $this->log(self::LOG_LEVEL_INFO, $message);
    }

    /**
     * Logs a debug message
     * @param string $message The message to log
     * @return void
     */
    public function debug(string $message): void
    {
        if(StringUtil::isNullOrEmpty($message))
            return;

        $this->log(self::LOG_LEVEL_DEBUG, $message);
    }

    /**
     * Logs a warning message
     * @param string $message The message to log
     * @return void
     */
    public function warn(string $message): void
    {
        if(StringUtil::isNullOrEmpty($message))
            return;

        $this->log(self::LOG_LEVEL_WARN, $message);
    }

    /**
     * Logs an error message
     * @param string $message The message to log
     * @return void
     */
    public function error(string $message): void
    {
        if(StringUtil::isNullOrEmpty($message))
            return;

        $this->log(self::LOG_LEVEL_ERROR, $message);
    }
}