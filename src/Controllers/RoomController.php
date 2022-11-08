<?php


namespace App\Controllers;


use App\Repository\RoomRepository;

class RoomController
{
    private $roomRepository;
    private $seatController;

    public function __construct(
        RoomRepository $roomRepository,
        SeatController $seatController
    )
    {
        $this->roomRepository = $roomRepository;
        $this->seatController = $seatController;
    }

    public function getRoomAds($id) {
        $results = $this->roomRepository->getRoomById($id);
        $seats = $this->seatController->getSeatsByRoomId($id);

        $arr = [];

        $arr['name'] = $results[0]['short'];
        $arr['preview'] = $results[0]['room_preview'];
        $arr['address'] = $results[0]['address'];
        $arr['status'] = $results[0]['status'];

        $equipment = [];
        $supply = [];
        $common = [];
        $gallery = [];

        foreach ($results as $result){
            if($result['adds_name'] == 'equipment') {
                $equipment[] = $result['value'];
            }

            if($result['adds_name'] == 'supply') {
                $supply[] = $result['value'];
            }

            if($result['adds_name'] == 'common') {
                $common[] = $result['value'];
            }

            if($result['adds_name'] == 'image') {
                $gallery[] = $result['value'];
            }
        }

        $arr['equipment'] = $equipment;
        $arr['supply'] = $supply;
        $arr['common'] = $common;
        $arr['gallery'] = $gallery;
        $arr['seats'] = $seats;

        return $arr;
    }
}