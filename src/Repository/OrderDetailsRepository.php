<?php


namespace App\Repository;


use App\Models\OrderDetail;

class OrderDetailsRepository
{
    private $orderDetailsModel;

    public function __construct(OrderDetail $orderDetailsModel)
    {
        $this->orderDetailsModel = $orderDetailsModel;
    }
}