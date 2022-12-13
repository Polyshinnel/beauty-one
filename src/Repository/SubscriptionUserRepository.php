<?php


namespace App\Repository;


use App\Models\SubscriptionUser;

class SubscriptionUserRepository
{
    private $subscriptionUserModel;

    public function __construct(SubscriptionUser $subscriptionUserModel)
    {
        $this->subscriptionUserModel = $subscriptionUserModel;
    }

    public function createSubscription(array $createArr) : void {
        $this->subscriptionUserModel::create($createArr);
    }

    public function updateSubscription(String $userId,array $updateArr) : void {
        $this->subscriptionUserModel->where('user_id',$userId)->update($updateArr);
    }
}