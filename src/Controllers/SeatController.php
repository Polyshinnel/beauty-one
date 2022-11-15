<?php


namespace App\Controllers;


use App\Repository\SeatRepository;
use App\Repository\TariffRepository;
use App\Repository\TariffSpecialRepository;

class SeatController
{
    private $seatRepository;
    private $tariffRepository;
    private $tariffSpecialRepository;

    public function __construct(
        SeatRepository $seatRepository,
        TariffRepository $tariffRepository,
        TariffSpecialRepository $tariffSpecialRepository
    )
    {
        $this->seatRepository = $seatRepository;
        $this->tariffRepository = $tariffRepository;
        $this->tariffSpecialRepository = $tariffSpecialRepository;
    }

    public function getSeatsByRoomId($roomId) {
        $seatsArr = $this->seatRepository->getRoomSeats($roomId);
        $seats = [];
        foreach ($seatsArr as $item) {
            $filter = [
                'location_id' => $item['location_id'],
                'type_object' => $item['seat_type']
            ];

            $tariffs = [];

            $tariffList = $this->tariffRepository->getFilteredTariff($filter);

            foreach ($tariffList as $tariffItem) {
                $id = $tariffItem['specials'];
                $basePrice = $tariffItem['base_price'];
                $tariffSpecials = $this->tariffSpecialRepository->getTariffById($id);
                $tariffName = $tariffSpecials['name'];
                $coefficient = $tariffSpecials['coefficient'];
                $price = ceil(($basePrice*$coefficient));

                $tariffs[] = [
                    'name' => $tariffName,
                    'price' => $price
                ];
            }

            $seats[] = [
                'id' => $item['id'],
                'location_id' => $item['location_id'],
                'seat_type' => $item['seat_type'],
                'name' => $item['name'],
                'tariffs' => $tariffs
            ];
        }

        return $seats;
    }
}