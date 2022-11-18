<?php


namespace App\Pages;


use App\Controllers\UserController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class UserPage
{
    private $userController;

    public function __construct(UserController $userController)
    {
        $this->userController = $userController;
    }

    public function get(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface{
        $params = $request->getParsedBody();
        $userArr = [
            'name' => $params['name'],
            'phone' => $params['phone'],
            'mail' => $params['mail']
        ];
        $token = $params['token'];


        $userResponse = $this->userController->updateUserDetails($userArr,$token);
        $json = json_encode($userResponse,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );
    }

    public function getUserByToken(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        $params = $request->getQueryParams();
        $token = $params['token'];

        $json = $this->userController->getUserByToken($token);
        $json = json_encode($json[0],JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );
    }
}