<?php


namespace App\Controllers;


use App\Repository\OrderDetailsRepository;
use App\Repository\OrderRepository;
use App\Repository\SeatRepository;
use App\Repository\UserTransactionRepository;

class BookingProcessingController
{
    private $orderRepository;
    private $orderDetailsRepository;
    private $userTransactionRepository;
    private $tariffCalculator;
    private $checkBookingController;
    private $seatRepository;

    public function __construct(
        OrderRepository $orderRepository,
        OrderDetailsRepository $orderDetailsRepository,
        UserTransactionRepository $userTransactionRepository,
        TariffCalculator $tariffCalculator,
        BookingController $checkBookingController,
        SeatRepository $seatRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailsRepository = $orderDetailsRepository;
        $this->userTransactionRepository = $userTransactionRepository;
        $this->tariffCalculator = $tariffCalculator;
        $this->checkBookingController = $checkBookingController;
        $this->seatRepository = $seatRepository;
    }

    public function bookingProcessing($seatId,$dateStart,$dateEnd) {
        $seatData = $this->seatRepository->getSeatById($seatId);
        $locationId = $seatData['location_id'];
        $seatType = $seatData['seat_type'];
        $resultChecking = $this->checkBookingController->checkBooking($seatId,$dateStart,$dateEnd);
        if(!$resultChecking) {
            return $this->tariffCalculator->calculateTariff($locationId,$seatType,$dateStart,$dateEnd);
        } else {
            return false;
        }
    }


}