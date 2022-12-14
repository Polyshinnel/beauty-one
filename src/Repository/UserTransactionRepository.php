<?php


namespace App\Repository;


use App\Models\UserTransaction;

class UserTransactionRepository
{
    private $userTransactionModel;

    public function __construct(UserTransaction $userTransactionModel)
    {
        $this->userTransactionModel = $userTransactionModel;
    }

    public function createTransaction($createArr) {
        $this->userTransactionModel::create($createArr);
    }
}