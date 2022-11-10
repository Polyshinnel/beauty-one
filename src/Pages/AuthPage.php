<?php


namespace App\Pages;


use App\Controllers\AuthController;
use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class AuthPage
{
    private $authController;
    private $mailer;

    public function __construct(AuthController $authController)
    {
        $this->authController = $authController;
    }

    public function get(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = $request->getQueryParams();
        $userId = $params['userId'];

        $json = $this->authController->authUser($userId);

        $data = json_encode($json,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($data)
        );
    }

    public function createToken(ServerRequestInterface $request): ResponseInterface {

        $params = $request->getParsedBody();

        $userId = $params['userId'];
        $code = $params['code'];

        $json = $this->authController->createAuthToken($userId,$code);

        $data = json_encode($json,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($data)
        );
    }

    public function checkToken(ServerRequestInterface $request): ResponseInterface {
        $params = $request->getParsedBody();
        $token = $params['token'];

        $json = $this->authController->checkUserByToken($token);

        $data = json_encode($json,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($data)
        );
    }


}