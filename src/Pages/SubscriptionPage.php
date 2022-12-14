<?php


namespace App\Pages;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class SubscriptionPage
{
    private $subscriptionController;

    public function __construct()
    {

    }

    public function get(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $params = $request->getParsedBody();

        $result = $this->roomController->getRoomAds($id);

        $json = json_encode($result,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );

    }
}