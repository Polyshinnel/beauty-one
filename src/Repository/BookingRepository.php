<?php


namespace App\Repository;


use App\Models\Booking;

class BookingRepository
{
    private $bookingModel;

    public function __construct(Booking $bookingModel)
    {
        $this->bookingModel = $bookingModel;
    }

    public function getBookingsFromPeriod($filter,String $dateStart,String $dateEnd) : array {
        return $this->bookingModel
            ->where($filter)
            ->whereBetween('time_start',[$dateStart,$dateEnd])
            ->get()
            ->toArray();
    }

    public function getAllBookingsSeat($seatId) {
        return $this->bookingModel
            ->where('seat_id',$seatId)
            ->get()
            ->toArray();
    }
}