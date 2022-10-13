<?php


namespace App\Pages;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class AuthPage
{
    public function get(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = $request->getQueryParams();
        $userId = $params['userId'];
        $json = [
            'error' => 'none'
        ];
        $type = $this->checkUserId($userId);
        $json['type'] = $type;
        if($type == 'undefined'){
            $json['error'] = 'Не получилось распознать почту или телефон';
        }
        $json['code'] = $this->createCode($type);
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
}