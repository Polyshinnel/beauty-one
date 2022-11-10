<?php


namespace App\Controllers;


use App\Repository\UserRepository;

class AuthController
{
    private $userRepository;
    private $mailer;

    public function __construct(UserRepository $userRepository, MailerClass $mailer)
    {
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
    }

    public function authUser($userId) {
        $json = [
            'error' => 'none',
            'code' => ''
        ];
        $type = $this->checkUserId($userId);
        $json['type'] = $type;

        if($type == 'undefined'){
            $json['error'] = 'Не получилось распознать почту или телефон';
        }

        if($json['error'] == 'none') {
            $json['code'] = $this->createCode($type);


            $createArr = [
                'userId' => $userId,
                'code' => $json['code'],
                'token' => ''
            ];

            $filter = [
                'userId' => $userId
            ];

            $checkIssetUser = $this->userRepository->getFilteredUser($filter);

//            if($type == 'mail') {
//                $address = $userId;
//                $mailArr = [
//                    'subject' => 'Код авторизации для Beauty One',
//                    'body' => "Ваш код авторизации: /r/n <h1>".$json['code']."</h1>"
//                ];
//                $this->mailer->sendMail($address,$mailArr);
//            }

            if(empty($checkIssetUser)){
                $this->userRepository->createUser($createArr);
            }
            else
            {
                $updateData = [
                    'code' => $json['code']
                ];
                $this->userRepository->updateUserData($filter,$updateData);
            }
        }

        return $json;
    }

    public function checkUserByToken($token) {
        $filter = [
            'token' => $token
        ];

        $checkUserByToken = $this->userRepository->getFilteredUser($filter);



        if(empty($checkUserByToken)){
            $data = [
                'userId' => 'none',
                'message' => 'err token'
            ];
        }
        else
        {
            $data = [
                'userId' => $checkUserByToken[0]['userId'],
                'message' => 'token ok'
            ];
        }

        return $data;
    }

    public function createAuthToken($userId,$code) {
        $token = $this->generateToken();

        $filter = [
            'userId' => $userId,
            'code' => $code
        ];

        $updateData = [
            'token' => $token
        ];

        $this->userRepository->updateUserData($filter,$updateData);

        return [
            'userId' => $userId,
            'token' => $token
        ];
    }

    private function checkUserId(string $userId) : string {
        $validateMail = $validate = preg_match('/[\.a-z0-9_\-]+[@][a-z0-9_\-]+([.][a-z0-9_\-]+)+[a-z]{1,4}/i', $userId);
        if($validateMail) {
            return 'mail';
        }

        $validatePhone = preg_replace('/[^0-9]/', '', $userId);
        $validatePhone = mb_substr($validatePhone,1);
        $validatePhone = '+7'.$validatePhone;
        if(mb_strlen($validatePhone) == 12){
            return 'phone';
        }

        return 'undefined';
    }

    private function createDigitsCode(int $length) : string {
        $code = '';
        for($i = 0; $i < $length; $i++) {
            $code .= rand(0,9);
        }
        return $code;
    }

    private function createCode(string $type) : string {
        $code = '';
        if($type == 'mail') {
            $code = $this->createDigitsCode(4);
        }
        return $code;
    }

    private function generateToken()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf(
            '%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(16384, 20479),
            mt_rand(32768, 49151),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535)
        );
    }
}