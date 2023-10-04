<?php

class StringUtil
{
    /**
     * Checks if a string is null or empty
     * @param string|null $str The string to be checked
     */
    public static function isNullOrEmpty(?string $str): bool {
        return ($str === null || trim($str) === '');
    }
}