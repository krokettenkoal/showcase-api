<?php

require_once __DIR__ . '/../lib/Db.php';

abstract class BaseApi {
    protected ShowcaseDb $db;

    public function __construct() {
        $this->db = new ShowcaseDb();
    }
}