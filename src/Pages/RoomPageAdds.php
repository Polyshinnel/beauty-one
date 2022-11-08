<?php


namespace App\Pages;


use App\Controllers\RoomController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class RoomPageAdds
{
    private $roomController;

    public function __construct(RoomController $roomController)
    {
        $this->roomController = $roomController;
    }

    public function get(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];

        $result = $this->roomController->getRoomAds($id);

        $json = json_encode($result,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );

    }
}