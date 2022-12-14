<?php


namespace App\Repository;


use App\Models\SubscriptionList;
use App\Models\SubscriptionUser;

class SubscriptionRepository
{
    private $subscriptionList;
    private $subscriptionUser;

    public function __construct(SubscriptionList $subscriptionList,SubscriptionUser $subscriptionUser)
    {
        $this->subscriptionList = $subscriptionList;
        $this->subscriptionUser = $subscriptionUser;
    }

    public function createUserSubscription($createArr) {
        $this->subscriptionUser::create($createArr);
    }

    public function updateUserSubscription($id,$updateArr) {
        $this->subscriptionUser->where('id',$id)->update($updateArr);
    }

    public function getUserSubscription($filter) {
        return $this->subscriptionUser->where($filter)->get()->toArray();
    }

    public function getListSubscription() {
        return $this->subscriptionList->all()->toArray();
    }
}