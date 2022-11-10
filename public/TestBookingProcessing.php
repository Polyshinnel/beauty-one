<?php

$urlrest = 'http://beauty-one.web/bookingProcessing';

$data = array(
    'seat_id' => '1',
    'date_start' => '2022-11-02 17:00:00',
    'minutes' => '210',
    'token' => '1111-1111-1111-1111',
);

$ch = curl_init($urlrest);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$res = curl_exec($ch);
curl_close($ch);

print_r($res);