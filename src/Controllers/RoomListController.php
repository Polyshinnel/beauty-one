<?php


namespace App\Controllers;


use App\Repository\RoomRepository;

class RoomListController
{
    private $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function getRoomList($id) {
        return $this->roomRepository->getRoomListByLocationId($id);
    }
}