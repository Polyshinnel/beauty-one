<?php


namespace App\Pages;


use App\Controllers\RoomListController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class RoomPage
{
    private $roomListController;

    public function __construct(RoomListController $roomListController)
    {
        $this->roomListController = $roomListController;
    }

    public function get(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $locationId = $args['id'];
        $rooms = $this->roomListController->getRoomList($locationId);
        $json = json_encode($rooms,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );
    }
}