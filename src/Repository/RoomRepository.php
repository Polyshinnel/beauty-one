<?php

namespace App\Repository;

use App\Models\Room;

class RoomRepository
{
    private $roomModel;

    public function __construct(Room $roomModel)
    {
        $this->roomModel = $roomModel;
    }

    public function getAllRooms() : array {
        return $this->roomModel->all()->toArray();
    }
}