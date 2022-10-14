<?php


namespace App\Pages;


use App\Repository\RoomRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class RoomPageAdds
{
    private $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function get(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $results = $this->roomRepository->getRoomById($id);

        $json = [];

        $json['name'] = $results[0]['short'];
        $json['preview'] = $results[0]['room_preview'];

        $equipment = [];
        $supply = [];
        $common = [];
        $gallery = [];

        foreach ($results as $result){
            if($result['adds_name'] == 'equipment') {
                $equipment[] = $result['value'];
            }

            if($result['adds_name'] == 'supply') {
                $supply[] = $result['value'];
            }

            if($result['adds_name'] == 'common') {
                $common[] = $result['value'];
            }

            if($result['adds_name'] == 'image') {
                $gallery[] = $result['value'];
            }
        }

        $json['equipment'] = $equipment;
        $json['supply'] = $supply;
        $json['common'] = $common;
        $json['gallery'] = $gallery;

        $json = json_encode($json,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );

    }
}