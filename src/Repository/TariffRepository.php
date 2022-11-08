<?php


namespace App\Repository;


use App\Models\Tariff;

class TariffRepository
{
    private $tariffModel;

    public function __construct(Tariff $tariffModel)
    {
        $this->tariffModel = $tariffModel;
    }

    public function getFilteredTariff(array $filter) : array {
        return $this->tariffModel->where($filter)->get()->toArray();
    }
}