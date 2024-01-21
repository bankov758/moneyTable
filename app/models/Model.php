<?php

namespace app\models;

use app\App;
use App\DB;

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