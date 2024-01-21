<?php

namespace app\models;

class Transaction extends Model
{
    public function create(float $amount, int $userId, string $description): int
    {
        $invoiceCreateStatement = $this->getDb()->prepare(
            ' insert into transactions (amount, user_id, date, description) 
                   values (?, ?, now(), ?) ');
        $invoiceCreateStatement->execute([$amount, $userId, $description]);
        return (int)$this->getDb()->lastInsertId();
    }

    public function findAll(int $userId): array
    {
        $selectStatement = $this->getDb()->prepare(
            ' select date, id, description, amount from transactions 
                   where user_id = ? '
        );
        $selectStatement->execute([$userId]);
        $invoice = $selectStatement->fetchAll();
        return $invoice ? $invoice : [];
    }

    public function delete(int $transactionId): void
    {
        $deleteStatement = $this->getDb()->prepare(
            ' delete from transactions 
                   where id = ? '
        );
        $deleteStatement->execute([$transactionId]);
    }

}