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
}