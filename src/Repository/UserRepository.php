<?php


namespace App\Repository;


use App\Models\Users;

class UserRepository
{
    private $userModel;

    public function __construct(Users $userModel)
    {
        $this->userModel = $userModel;
    }

    public function createUser($createArr) {
        $this->userModel::create($createArr);
    }
}