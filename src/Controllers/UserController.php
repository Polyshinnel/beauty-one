<?php


namespace App\Controllers;


use App\Repository\UserDeatailRepository;

class UserController
{
    private $userDetailRepository;
    private $helperController;

    public function __construct(UserDeatailRepository $userDetailRepository,HelperController $helperController)
    {
        $this->userDetailRepository = $userDetailRepository;
        $this->helperController = $helperController;
    }

    public function updateUserDetails($userArr,$token) {
        $userInfo = $this->userDetailRepository->getUserDetailByToken($token);
        $userId = $userInfo[0]['user_id'];

        $response = [
            'message' => 'none',
            'errors' => 'none'
        ];

        $checkName = $this->helperController->validateName($userArr['name']);
        $checkMail = $this->helperController->validateMail($userArr['mail']);
        $checkPhone = $this->helperController->validatePhone($userArr['phone']);

        if(!$checkMail) {
            $response['errors'] = 'Не правильно заполнено поле Email';
        }

        if(!$checkPhone) {
            $response['errors'] = 'Не правильно заполнено поле Телефон';
        }

        if(!$checkName) {
            $response['errors'] = 'Поле имя должно содержать больше 1 символа';
        }

        if($checkMail && $checkPhone && $checkName) {
            $filter = [
                'user_id' => $userId
            ];

            $updateArr = [
                'name' => $userArr['name'],
                'phone' => $userArr['phone'],
                'mail' => $userArr['mail'],
            ];

            $response['message'] = 'Данные успешно обновлены';

            $this->userDetailRepository->updateUserDetail($updateArr,$filter);
        }


        return $response;
    }
}