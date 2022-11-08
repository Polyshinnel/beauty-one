<?php


namespace App\Repository;


use App\Models\Location;

class LocationRepository
{
    private $locationModel;

    public function __construct(Location $locationModel)
    {
        $this->locationModel = $locationModel;
    }

    public function getAllLocations() {
        return $this->locationModel->all()->toArray();
    }
}