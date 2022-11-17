<?php

$urlrest = 'http://beauty-one.web/updateUser';

$data = array(
    'name' => 'Андрей',
    'phone' => '+7903026445',
    'mail' => 'polyshinnel@gmail.com',
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