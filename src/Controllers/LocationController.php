<?php


namespace App\Controllers;


use App\Repository\LocationRepository;

class LocationController
{
    private $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function getListLocation() {
        $data['locations'] = $this->locationRepository->getAllLocations();
        return $data;
    }

    public function getListLocationByRange($params) {
        $geo = $params['geo'];
        $listLocations = $this->locationRepository->getAllLocations();
        $locationArr = [];

        foreach ($listLocations as $locationItem) {
            $coordLocation = $locationItem['coordinates'];

            $coordArr1 = explode(',',$geo);
            $coordArr2 = explode(',',$coordLocation);
            $lat1 = $coordArr1[0];
            $long1 = $coordArr1[1];
            $lat2 = $coordArr2[0];
            $long2 = $coordArr2[1];

            $range = $this->getRangeCoords($lat1,$long1,$lat2,$long2);
            $range = ceil($range);
            $range = round(($range/1000),2);

            $locationArr[] = [
                'id' => $locationItem['id'],
                'coordinates' => $locationItem['coordinates'],
                'img' => $locationItem['img'],
                'county' => $locationItem['county'],
                'city' => $locationItem['city'],
                'address' => $locationItem['address'],
                'description' => $locationItem['description'],
                'underground' => $locationItem['underground'],
                'range' => $range
            ];

        }



        uasort($locationArr,array('App\Controllers\LocationController','sortDistanceFunction'));

        $data['locations'] = $locationArr;
        return $data;
    }

    private function getRangeCoords($lat1,$long1,$lat2,$long2) {
        //радиус Земли
        $R = 6372795;
        //перевод коордитат в радианы
        $lat1 *= pi() / 180;
        $lat2 *= pi() / 180;
        $long1 *= pi() / 180;
        $long2 *= pi() / 180;
        //вычисление косинусов и синусов широт и разницы долгот
        $cl1 = cos($lat1);
        $cl2 = cos($lat2);
        $sl1 = sin($lat1);
        $sl2 = sin($lat2);
        $delta = $long2 - $long1;
        $cdelta = cos($delta);
        $sdelta = sin($delta);
        //вычисления длины большого круга
        $y = sqrt(pow($cl2 * $sdelta, 2) + pow($cl1 * $sl2 - $sl1 * $cl2 * $cdelta, 2));
        $x = $sl1 * $sl2 + $cl1 * $cl2 * $cdelta;
        $ad = atan2($y, $x);
        //расстояние между двумя координатами в метрах
        return $ad * $R;
    }

    private function sortDistanceFunction($a, $b) {
        return ($a['range'] > $b['range']);
    }
}