<?php

function getMode(): string
{
    if(!getenv('API_MODE')) {
        return 'prod';
    }

    return match (getenv('API_MODE')) {
        'dev', 'development' => 'dev',
        default => 'prod',
    };
}

define("API_MODE", getMode());