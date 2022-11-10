<?php


namespace App\Controllers;


class HelperController
{
    public function convertTimeToDate($dateStart,$time) {
        $seconds = $time*60;
        $timeStart = strtotime($dateStart);
        $timeEnd = $timeStart+$seconds;
        return date("Y-m-d H:i:s",$timeEnd);
    }

    public function createUniqueNumber($create_count) {
        $unique_id = $create_count;

        for($i = 0;$i < (16 - strlen($create_count));$i++){
            $unique_id = '0'.$unique_id;
        }



        $unique_id_arr = str_split($unique_id);

        $normalize_unique_id = '';

        for($i = 15;$i>-1;$i--){

            if(($i == '12') || ($i == '8') || ($i == '4')) {
                $normalize_unique_id = '-'.$unique_id_arr[$i].$normalize_unique_id;
            }else{
                $normalize_unique_id = $unique_id_arr[$i].$normalize_unique_id;
            }
        }

        return $normalize_unique_id;

    }
}