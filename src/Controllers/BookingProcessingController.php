<?php


namespace App\Controllers;


use App\Repository\BookingRepository;
use App\Repository\OrderDetailsRepository;
use App\Repository\OrderRepository;
use App\Repository\SeatRepository;
use App\Repository\UserRepository;
use App\Repository\UserTransactionRepository;

class BookingProcessingController
{
    private $orderRepository;
    private $orderDetailsRepository;
    private $userTransactionRepository;
    private $tariffCalculator;
    private $checkBookingController;
    private $seatRepository;
    private $helperController;
    private $userRepository;
    private $bookingRepository;

    public function __construct(
        OrderRepository $orderRepository,
        OrderDetailsRepository $orderDetailsRepository,
        UserTransactionRepository $userTransactionRepository,
        TariffCalculator $tariffCalculator,
        BookingController $checkBookingController,
        SeatRepository $seatRepository,
        HelperController $helperController,
        UserRepository $userRepository,
        BookingRepository $bookingRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailsRepository = $orderDetailsRepository;
        $this->userTransactionRepository = $userTransactionRepository;
        $this->tariffCalculator = $tariffCalculator;
        $this->checkBookingController = $checkBookingController;
        $this->seatRepository = $seatRepository;
        $this->helperController = $helperController;
        $this->userRepository = $userRepository;
        $this->bookingRepository = $bookingRepository;
    }

    public function bookingProcessing($token,$seatId,$dateStart,$dateEnd) {
        $seatData = $this->seatRepository->getSeatById($seatId);
        $locationId = $seatData['location_id'];
        $seatType = $seatData['seat_type'];


        //Проверяем бронь
        $resultChecking = $this->checkBookingController->checkBooking($seatId,$dateStart,$dateEnd);
        //Проверяем есть ли пользователь с таким токеном
        $userId = $this->checkUserToken($token);

        if(($resultChecking == false) && ($userId != false)) {
            $calculateTariff = $this->tariffCalculator->calculateTariff($locationId,$seatType,$dateStart,$dateEnd);
            $transactionId = $this->createTransactionId();
            $this->createOrder($userId,$transactionId,$calculateTariff);
            $this->createBooking($userId,$seatId,$dateStart,$dateEnd);
            $this->createOrderDetails($calculateTariff);
            return true;
        } else {
            return false;
        }
    }

    private function createTransactionId() {
        $lastOrderInfo = $this->orderRepository->getLastSortedOrder('transaction_id','DESC');
        if(empty($lastOrderInfo['data'])) {
            $startId = 1;
        } else {
            $rawStartId = $lastOrderInfo['data'][0]['transaction_id'];
            $rawStartId = preg_replace('/[^0-9]/', '', $rawStartId);
            $startId = (int)$rawStartId+1;
        }

        return $this->helperController->createUniqueNumber($startId);
    }

    private function checkUserToken($token) {
        $userFilter = [
            'token' => $token
        ];
        $userData = $this->userRepository->getFilteredUser($userFilter);
        if(!empty($userData)) {
            return $userData[0]['id'];
        } else {
            return false;
        }
    }

    private function createOrder($userId,$transactionId,$calculateTariff) {
        $orderTotalTime = $calculateTariff['hours'] * 60;
        $createArr = [
            'user_id' => $userId,
            'transaction_id' => $transactionId,
            'status_order' => 0,
            'order_total_time' => $orderTotalTime,
            'order_total_money' => $calculateTariff['price_seat'],
            'date_create' => date('Y-m-d H:i:s')
        ];
        $this->orderRepository->createOrder($createArr);
    }

    private function createBooking($userId,$seatId,$timeStart,$timeEnd) {
        $lastOrderInfo = $this->orderRepository->getLastSortedOrder('id','DESC');
        $orderId = $lastOrderInfo['data'][0]['id'];
        $createArr = [
            'user_id' => $userId,
            'seat_id' => $seatId,
            'order_id' => $orderId,
            'time_start' => $timeStart,
            'time_end' => $timeEnd
        ];
        $this->bookingRepository->createBooking($createArr);
    }

    private function createOrderDetails($calculateTariff) {
        $bookingRecord = $this->bookingRepository->getLastSortedBooking('id','DESC');
        $bookingId = $bookingRecord['data'][0]['id'];
        $orderId = $bookingRecord['data'][0]['order_id'];
        $moneyValue = $calculateTariff['price_seat'];
        $timeValue = $calculateTariff['hours'] * 60;

        $createList = [
            [
                'order_id' => $orderId,
                'promocode_id' => 0,
                'product_id' => 2,
                'booking_id' => $bookingId,
                'money_value' => $moneyValue,
                'time_value' => $timeValue,
                'quantity' => 0
            ],
            [
                'order_id' => $orderId,
                'promocode_id' => 0,
                'product_id' => 3,
                'booking_id' => $bookingId,
                'money_value' => $moneyValue,
                'time_value' => $timeValue,
                'quantity' => 0
            ],
        ];

        foreach ($createList as $createItem) {
            $this->orderDetailsRepository->createOrderDetail($createItem);
        }
    }
}