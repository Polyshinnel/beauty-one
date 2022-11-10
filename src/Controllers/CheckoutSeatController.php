<?php


namespace App\Controllers;


use App\Repository\RoomRepository;
use App\Repository\SeatRepository;

class CheckoutSeatController
{
    private $tariffCalculator;
    private $seatRepository;
    private $roomRepository;

    public function __construct(
        TariffCalculator $tariffCalculator,
        SeatRepository $seatRepository,
        RoomRepository $roomRepository
    )
    {
        $this->tariffCalculator = $tariffCalculator;
        $this->seatRepository = $seatRepository;
        $this->roomRepository = $roomRepository;
    }

    public function checkoutSeat($seatId,$timeStart,$timeEnd) {
        $seatInfo = $this->seatRepository->getSeatById($seatId);
        $roomInfo = $this->roomRepository->getShortRoomById($seatInfo['room_id']);
        $roomName = $roomInfo['name'];
        $seatName = $seatInfo['name'];
        $locationId = $seatInfo['location_id'];
        $seatType = $seatInfo['seat_type'];

        $calculateResult = $this->tariffCalculator->calculateTariff($locationId,$seatType,$timeStart,$timeEnd);

        return [
            'hours' => $calculateResult['hours'],
            'price_by_hour' => $calculateResult['price_by_hour'],
            'tariff_name' => $calculateResult['tariff_name'],
            'room_name' => $roomName,
            'seat_name' => $seatName,
            'total' => $calculateResult['price_seat']
        ];
    }
}