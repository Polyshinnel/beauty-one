<?php


namespace App\Pages;


use App\Controllers\BookingController;
use App\Controllers\HelperController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class BookingsPage
{
    private $bookingController;
    private $helperController;

    public function __construct(BookingController $bookingController,HelperController $helperController)
    {
        $this->bookingController = $bookingController;
        $this->helperController = $helperController;
    }


    public function get(ServerRequestInterface $request, ResponseInterface $response,array $args): ResponseInterface {
        $seatId = $args['id'];
        $bookings['booking'] = $this->bookingController->getAllBookingsSeat($seatId);

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
        $minutes = $params['minutes'];
        $dateEnd = $this->helperController->convertTimeToDate($dateStart,$minutes);
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

    public function getActiveBookingByToken(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        $params = $request->getQueryParams();

        if(empty($params['token'])) {
            $errArr = [
                'error' => 'token is empty'
            ];
            $json = json_encode($errArr,JSON_UNESCAPED_UNICODE);
        } else {
            $token = $params['token'];
            $bookings = $this->bookingController->getCurrentBookingsByToken($token);
            if(empty($bookings)){
                $json = [
                    'error' => 'empty bookings'
                ];
            } else {
                $json = [
                    'bookings' => $bookings,
                    'error' => 'no'
                ];
            }

            $json = json_encode($json,JSON_UNESCAPED_UNICODE);
        }



        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );
    }

    public function getHistoryBookingByToken(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
        $params = $request->getQueryParams();

        if(empty($params['token'])) {
            $errArr = [
                'error' => 'token is empty'
            ];
            $json = json_encode($errArr,JSON_UNESCAPED_UNICODE);
        } else {
            $token = $params['token'];
            $bookings = $this->bookingController->getHistoryBookingsByToken($token);
            if(empty($bookings)){
                $json = [
                    'error' => 'empty bookings'
                ];
            } else {
                $json = [
                    'bookings' => $bookings,
                    'error' => 'no'
                ];
            }

            $json = json_encode($json,JSON_UNESCAPED_UNICODE);
        }



        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );
    }

    public function getBookingById(ServerRequestInterface $request, ResponseInterface $response,array $args): ResponseInterface {
        $bookingId = $args['id'];
        $booking = $this->bookingController->getBookingById($bookingId);

        $json = json_encode($booking[0],JSON_UNESCAPED_UNICODE);

        return new Response(
            200,
            new Headers(['Content-Type' => 'text/html']),
            (new StreamFactory())->createStream($json)
        );
    }
}