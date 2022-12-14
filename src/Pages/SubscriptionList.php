<?php


namespace App\Pages;


use App\Controllers\LocationController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class SubscriptionList
{
    private $locationController;

    public function __construct(LocationController $locationController)
    {
        $this->locationController = $locationController;
    }


    public function get(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {

        $params = $request->getQueryParams();

        if(!empty($params)) {
            $jsonArr = $this->locationController->getListLocationByRange($params);
        } else {
            $jsonArr = $this->locationController->getListLocation();
        }

        $json = json_encode($jsonArr,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );
    }
}