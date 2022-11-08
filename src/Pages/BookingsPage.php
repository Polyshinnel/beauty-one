<?php


namespace App\Pages;


use App\Controllers\BookingController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class BookingsPage
{
    private $bookingController;

    public function __construct(BookingController $bookingController)
    {
        $this->bookingController = $bookingController;
    }


    public function get(ServerRequestInterface $request, ResponseInterface $response,array $args): ResponseInterface {
        $seatId = $args['id'];
        $bookings = $this->bookingController->getAllBookingsSeat($seatId);

        $json = json_encode($bookings,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );
    }

    public function checkBooking(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        $params = $request->getParsedBody();
        $seatId = $params['seat_id'];
        $dateStart = $params['date_start'];
        $dateEnd = $params['date_end'];
        $checkResult = $this->bookingController->checkBooking($seatId,$dateStart,$dateEnd);

        $json['answer'] = 'false';

        if(!$checkResult) {
            $json['answer'] = 'ok';
        }

        $json = json_encode($json,JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );
    }


}