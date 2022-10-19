<?php


namespace App\Pages;


use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class AuthPage
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function get(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = $request->getQueryParams();
        $userId = $params['userId'];
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

        $data = json_encode($json,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($data)
        );
    }

    public function createToken(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {

        $token = $this->generateToken();
        $params = $request->getParsedBody();

        $userId = $params['userId'];

        $filter = [
            'userId' => $userId
        ];

        $updateData = [
            'token' => $token
        ];

        $this->userRepository->updateUserData($filter,$updateData);

        $json = [
            'userId' => $userId,
            'token' => $token
        ];

        $data = json_encode($json,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($data)
        );
    }

    public function checkToken(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        $params = $request->getParsedBody();
        $token = $params['token'];

        $filter = [
            'token' => $token
        ];

        $checkUserByToken = $this->userRepository->getFilteredUser($filter);



        if(empty($checkUserByToken)){
            $json = [
                'userId' => 'none',
                'message' => 'err token'
            ];
        }
        else
        {
            $json = [
                'userId' => $checkUserByToken[0]['userId'],
                'message' => 'err token'
            ];
        }

        $data = json_encode($json,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($data)
        );
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