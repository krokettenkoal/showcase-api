<?php

require_once __DIR__ . '/../lib/env.php';
require_once __DIR__ . '/../config/' . API_MODE . '.inc.php';

class ShowcaseDb extends PDO {
    public function __construct()
    {
        $dsn = CFG_DB['pdo.dsn'];
        $username = CFG_DB['pdo.username'];
        $password = CFG_DB['pdo.password'];
        $options = CFG_DB['pdo.options'];
        parent::__construct($dsn, $username, $password, $options);
    }
}