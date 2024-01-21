<?php

namespace app\models;

use Exception;

class SignUp extends Model
{
    private User $userModel;
    private Transaction $invoiceModel;

    public function __construct(User $userModel, Transaction $invoiceModel)
    {
        parent::__construct();
        $this->userModel = $userModel;
        $this->invoiceModel = $invoiceModel;
    }

    //todo polzvai tva za reg a ne user modela che shte stane mazalo - vsichko ste bude na edno
    /**
     * @throws Exception
     */
    public function register(array $userInfo, array $invoiceInfo): int
    {
        try {
            $this->getDb()->beginTransaction();
            //$userId = $this->userModel->get($userInfo['email']);
            $invoiceId = $this->invoiceModel->create($invoiceInfo['amount'],5);
            $this->getDb()->commit();
        } catch (Exception $e) {
            if ($this->getDb()->inTransaction()){
                $this->getDb()->rollBack();
            }
            throw $e;
        }

        return $invoiceId;
    }

}