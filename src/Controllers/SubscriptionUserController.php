<?php


namespace App\Controllers;


use App\Repository\SubscriptionUserRepository;

class SubscriptionUserController
{
    private $subscriptionRepository;

    public function __construct(SubscriptionUserRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }


}