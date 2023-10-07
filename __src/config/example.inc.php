<?php

/**
 * This is an example configuration file.
 * Copy this file to prod.inc.php (and dev.inc.php to support dev mode) and change the values to your needs.
 */

const CFG_DB = [
    'pdo.dsn' => 'mysql:host=localhost;charset=utf8mb4',
    'pdo.username' => 'root',
    'pdo.password' => 'root',
    'pdo.options' => [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    ]
];

const CFG_API = [
    'router.base' => '/api',
    'log.name' => 'api',
    'cors' => [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, PATCH, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With'
    ],
];