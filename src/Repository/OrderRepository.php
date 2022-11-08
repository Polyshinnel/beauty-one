<?php


namespace App\Repository;


use App\Models\Order;

class OrderRepository
{
    private $orderModel;

    public function __construct(Order $orderModel)
    {
        $this->orderModel = $orderModel;
    }
}