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

    public function getRoomById($id) : array {
        return $this->roomModel::Select(
            'rooms.short',
            'rooms.img as room_preview',
            'rooms_adds_type.name as adds_name',
            'room_adds.value'
        )
            ->leftjoin(
                'room_adds','rooms.id','=','room_adds.room_id'
            )
            ->leftjoin(
                'rooms_adds_type','room_adds.adds_type_id','=','rooms_adds_type.id'
            )
            ->where('rooms.id',$id)
            ->get()
            ->toArray();
    }
}