<?php


namespace App\Controllers;


use App\Repository\TariffRepository;
use App\Repository\TariffSpecialRepository;

class TariffCalculator
{
    private $tariffRepository;
    private $tariffSpecialRepository;

    public function __construct(TariffRepository $tariffRepository,TariffSpecialRepository $tariffSpecialRepository)
    {
        $this->tariffRepository = $tariffRepository;
        $this->tariffSpecialRepository = $tariffSpecialRepository;
    }

    public function calculateTariff($locationId,$typeObject,$timeStart,$timeEnd) {

        $startSeconds = strtotime($timeStart);
        $endSeconds = strtotime($timeEnd);
        $hours = (($endSeconds-$startSeconds)/3600);
        $daysOfWeek = date('w',$startSeconds);

        $timeArrStart = explode(' ',$timeStart);
        $hoursStart = $timeArrStart[1];

        $timeArrEnd = explode(' ',$timeEnd);
        $hoursEnd = $timeArrEnd[1];

        $dateStartDay = $timeArrStart[0];
        $dateEndDay = $timeArrEnd[0];


        $tariffSpecialList = [];

        //Проверяем актуальные тарифы попадающие под временной интервал
        $tariffSpecialFilterList = [
            [
                'days_of_week' => $daysOfWeek
            ],
            [
                'hours' => NULL,
                'days_of_week' => NULL,
                'days_of_month' => NULL,
            ],
        ];
        foreach ($tariffSpecialFilterList as $tariffSpecialFilter) {
            $specialTariffsByTimeInterval = $this->tariffSpecialRepository->checkTariffSpecialWithTime($tariffSpecialFilter,$hoursStart,$hoursEnd,$dateStartDay,$dateEndDay);
            if(!empty($specialTariffsByTimeInterval)) {
                foreach ($specialTariffsByTimeInterval as $specialTariffByTimeInterval) {
                    $tariffSpecialList[$specialTariffByTimeInterval['id']] = $specialTariffByTimeInterval;
                }
            }
        }


        //Проверяем актуальные тарифы попадающие под условие по времени

        $specialTariffsByHours = $this->tariffSpecialRepository->getFilteredTariffByHours($hours,$dateStartDay,$dateEndDay);
        if(!empty($specialTariffsByHours)) {
            foreach ($specialTariffsByHours as $specialTariffByHours) {
                $tariffSpecialList[$specialTariffByHours['id']] = $specialTariffByHours;
            }
        }

        //Проверяем тарифы которые подходят под условия дня недели и дня месяца
        $tariffSpecialFilterList = [
            [
                'days_of_week' => $daysOfWeek
            ],
            [
                'hours' => NULL,
                'days_of_week' => NULL,
                'days_of_month' => NULL,
                'time_start' => NULL,
                'time_finish' => NULL,
            ],
        ];

        foreach ($tariffSpecialFilterList as $tariffSpecialFilter) {
            $resultSpecialTariffs = $this->tariffSpecialRepository->getFilteredTariffSpecial($tariffSpecialFilter,$dateStartDay,$dateEndDay);
            if(!empty($resultSpecialTariffs)) {
                foreach ($resultSpecialTariffs as $resultSpecialTariff){
                    $tariffSpecialList[$resultSpecialTariff['id']] = $resultSpecialTariff;
                }
            }
        }


        //Получаем список доступных тарифов для данного типа рабочего места
        $tariffFilter = [
            'location_id' => $locationId,
            'type_object' => $typeObject
        ];


        $tariffAvailableList = $this->tariffRepository->getFilteredTariff($tariffFilter);

        $availableTariff = [];

        //Перебираем доступные тарифы для данного типа комнаты
        foreach ($tariffAvailableList as $tariffAvailableItem) {
            if(isset($tariffSpecialList[$tariffAvailableItem['specials']])) {
                $availableTariff[] = $tariffSpecialList[$tariffAvailableItem['specials']];
            }
        }

        //Сортируем тарифы по приоритету
        uasort($availableTariff, array('App\Controllers\TariffCalculator','SortFunction'));
        $availableTariff = array_values($availableTariff);

        $basePrice = '';
        //Текущий расчетный тариф для данного рабочего места
        $currentTariff = $availableTariff[0];

        //Узнаем базовую ставку:
        foreach ($tariffAvailableList as $tariffAvailableItem) {
            if($currentTariff['id'] == $tariffAvailableItem['specials']) {
                $basePrice = $tariffAvailableItem['base_price'];
            }
        }

        $priceSeat = ceil($basePrice*$currentTariff['coefficient']*$hours);

        $returnArr = [
            'hours' => $hours,
            'base_price' => $basePrice,
            'price_seat' => $priceSeat,
            'tariff_name' => $currentTariff['name'],
            'coefficient' => $currentTariff['coefficient'],
            'price_by_hour' => ceil($currentTariff['coefficient']*$basePrice)
        ];

        return $returnArr;
    }

    private function SortFunction($a, $b) {
        return ($a['priority'] < $b['priority']);
    }
}