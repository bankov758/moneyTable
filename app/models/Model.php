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

//    public function register(array $userInfo, array $invoiceInfo): int
//    {
//        try {
//            $this->getDb()->beginTransaction();
//            //$userId = $this->userModel->get($userInfo['email']);
//            $invoiceId = $this->invoiceModel->create($invoiceInfo['amount'],5);
//            $this->getDb()->commit();
//        } catch (Exception $e) {
//            if ($this->getDb()->inTransaction()){
//                $this->getDb()->rollBack();
//            }
//            throw $e;
//        }
//
//        return $invoiceId;
//    }

}