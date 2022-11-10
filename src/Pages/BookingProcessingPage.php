<?php


namespace App\Pages;


use App\Controllers\BookingProcessingController;
use App\Controllers\HelperController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class BookingProcessingPage
{
    private $bookingProcessingController;
    private $helperController;

    public function __construct(BookingProcessingController $bookingProcessingController,HelperController $helperController)
    {
        $this->bookingProcessingController = $bookingProcessingController;
        $this->helperController = $helperController;
    }

    public function get(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {

        $params = $request->getParsedBody();
        $token = $params['token'];
        $dateStart = $params['date_start'];
        $minutes = $params['minutes'];
        $seatId = $params['seat_id'];
        $dateEnd = $this->helperController->convertTimeToDate($dateStart,$minutes);

        $bookingResult = $this->bookingProcessingController->bookingProcessing($token,$seatId,$dateStart,$dateEnd);
        var_dump($bookingResult);

        $json = json_encode('',JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );
    }
}