<?php


namespace App\Pages;


use App\Controllers\CheckoutSeatController;
use App\Controllers\HelperController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class CheckoutSeatPage
{
    private $checkoutSeatController;
    private $helperController;

    public function __construct(CheckoutSeatController $checkoutSeatController,HelperController $helperController)
    {
        $this->checkoutSeatController = $checkoutSeatController;
        $this->helperController = $helperController;
    }

    public function get(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        $params = $request->getParsedBody();
        $token = $params['token'];
        $timeStart = $params['date_start'];
        $minutes = $params['minutes'];
        $seatId = $params['seat_id'];
        $timeEnd = $this->helperController->convertTimeToDate($timeStart,$minutes);
        $checkoutResult = $this->checkoutSeatController->checkoutSeat($seatId,$timeStart,$timeEnd);

        $json = json_encode($checkoutResult,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );
    }
}