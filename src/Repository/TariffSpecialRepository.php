<?php


namespace App\Repository;


use App\Models\TariffSpecial;

class TariffSpecialRepository
{
    private $tariffSpecialModel;

    public function __construct(TariffSpecial $tariffSpecialModel)
    {
        $this->tariffSpecialModel = $tariffSpecialModel;
    }

    public function checkTariffSpecialWithTime($filter,$timeStart,$timeEnd,$dateStart,$dateEnd) {
        return $this->tariffSpecialModel
            ->where($filter)
            ->where('time_start','<=',$timeStart)
            ->where('time_finish','>=',$timeEnd)
            ->where('valid_from','<=',$dateStart)
            ->where('valid_for','>=',$dateEnd)
            ->get()
            ->toArray();
    }

    public function getFilteredTariffSpecial($filter,$dateStart,$dateEnd) {
        return $this->tariffSpecialModel
            ->where($filter)
            ->where('valid_from','<=',$dateStart)
            ->where('valid_for','>=',$dateEnd)
            ->get()
            ->toArray();
    }

    public function getFilteredTariffByHours($hours,$dateStart,$dateEnd) {
        return $this->tariffSpecialModel
            ->where('hours','<=',$hours)
            ->where('valid_from','<=',$dateStart)
            ->where('valid_for','>=',$dateEnd)
            ->get()
            ->toArray();
    }

    public function getTariffById($id) {
        return $this->tariffSpecialModel->where('id',$id)->first()->toArray();
    }
}