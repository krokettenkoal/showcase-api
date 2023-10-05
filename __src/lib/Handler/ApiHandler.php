<?php

namespace Phpress\Handler;

require_once __DIR__ . '/../Util/Db.php';

use Phpress\Util\ShowcaseDb;

abstract class ApiHandler {
    protected ShowcaseDb $db;

    public function __construct() {
        $this->db = new ShowcaseDb();
    }
}