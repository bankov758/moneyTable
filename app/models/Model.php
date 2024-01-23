<?php

namespace app\models;

use app\core\App;
use app\core\DB;

abstract class Model
{
    private DB $db;

    public function __construct()
    {
        $this->db = App::db();
    }

    protected function getDb(): DB
    {
        return $this->db;
    }

}