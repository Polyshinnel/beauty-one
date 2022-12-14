<?php


namespace App\Controllers;


use App\Repository\BookingRepository;
use App\Repository\OrderRepository;
use App\Repository\UserTransactionRepository;

class ShopBookingController
{
    private $userTransactionRepository;
    private $bookingRepository;
    private $orderRepository;

    public function __construct(UserTransactionRepository $userTransactionRepository,BookingRepository $bookingRepository,OrderRepository $orderRepository)
    {
        $this->userTransactionRepository = $userTransactionRepository;
        $this->bookingRepository = $bookingRepository;
        $this->orderRepository = $orderRepository;
    }

    public function createShopByMoney($bookingId) {
        $bookingDetail = $this->bookingRepository->getBookingsOrder($bookingId);
        $orderId = $bookingDetail[0]['order_id'];
        $updateArr = [
            'status_order' => 1
        ];
        $this->orderRepository->updateOrder($orderId,$updateArr);

        $createTransactionArr = [
            'user_id' => $bookingDetail[0]['user_id'],
            'unique_transaction_id' => $bookingDetail[0]['transaction_id'],
            'money_cost' => $bookingDetail[0]['order_total_money'],
        ];

        $this->userTransactionRepository->createTransaction($createTransactionArr);

        $updateBookingArr = [
            'booking_status' => 2
        ];

        $this->bookingRepository->updateBooking($bookingId,$updateBookingArr);
    }
}