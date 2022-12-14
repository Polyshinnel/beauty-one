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

    public function getLastSortedOrder(String $column,String $sort) : array {
        return $this->orderModel->orderBy($column,$sort)->paginate(1,['*'],'page',1)->toArray();
    }

    public function createOrder(array $createArr) : void {
        $this->orderModel::create($createArr);
    }

    public function updateOrder($orderId,$updateArr) {
        $this->orderModel->where('id',$orderId)->update($updateArr);
    }
}