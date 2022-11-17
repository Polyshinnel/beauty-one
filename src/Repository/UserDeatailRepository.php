<?php


namespace App\Repository;


use App\Models\UserDeatail;

class UserDeatailRepository
{
    private $userDetailsModel;

    public function __construct(UserDeatail $userDetailsModel)
    {
        $this->userDetailsModel = $userDetailsModel;
    }

    public function getUserDetailByToken($token) {
        return $this->userDetailsModel::select(
            'user_details.user_id',
            'user_details.name',
            'user_details.phone',
            'user_details.mail'
        )
            ->leftjoin('users','user_details.user_id','=','users.id')
            ->where('users.token',$token)
            ->get()
            ->toArray();
    }

    public function updateUserDetail($updateArr,$filter) {
        $this->userDetailsModel->where($filter)->update($updateArr);
    }

    public function createUserDetail($createArr) {
        $this->userDetailsModel::create($createArr);
    }
}