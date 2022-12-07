<?php


namespace App\Pages;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class BookingList
{
    public function get(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface{
        $params = $request->getQueryParams();


        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );
    }
}