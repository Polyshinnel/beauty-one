<?php

$urlrest = 'http://beauty.deploy-server.ru/checkToken';

$data = array(
    'token' => '1B65D4CE-729F-4E0F-839F-1E04C24C4DCC',
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