<?php


namespace App\Repository;


use App\Models\Seat;

class SeatRepository
{
    private $seatModel;

    public function __construct(Seat $seatModel)
    {
        $this->seatModel = $seatModel;
    }

    public function getRoomSeats($roomId) {
        return $this->seatModel->where('room_id',$roomId)->get()->toArray();
    }

    public function getSeatById($seatId) {
        return $this->seatModel->where('id',$seatId)->first()->toArray();
    }
}