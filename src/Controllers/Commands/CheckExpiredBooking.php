<?php


namespace App\Controllers\Commands;


use App\Repository\BookingRepository;
use DateTime;

class CheckExpiredBooking
{
    private $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function processingExpiredBooking() {
        $bookings = $this->bookingRepository->getBookingByStatus();
        foreach ($bookings as $booking) {
            if($booking['booking_status'] == 1) {
                $bookingDetails = $this->bookingRepository->getBookingsOrder($booking['id']);

                $dateCreate = $bookingDetails[0]['date_create'];
                $dateCreate = strtotime($dateCreate);
                $currData = time();
                $diffData = ($currData - $dateCreate)/60;

                if($diffData > 15) {
                    $updateArr = [
                        'booking_status' => 4
                    ];
                    $this->bookingRepository->updateBooking($booking['id'],$updateArr);
                }
            } else {
                $dateEnd = $booking['time_end'];
                $dateEnd = strtotime($dateEnd);
                $currData = time();

                $dateDiff = $dateEnd - $currData;

                if($dateDiff < 0) {
                    $updateArr = [
                        'booking_status' => 3
                    ];
                    $this->bookingRepository->updateBooking($booking['id'],$updateArr);
                }
            }
        }
    }
}