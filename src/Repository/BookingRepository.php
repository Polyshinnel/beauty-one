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
        return $this->bookingModel::select(
            'user_details.name',
             'bookings.id',
             'bookings.user_id',
             'bookings.seat_id',
             'bookings.order_id',
             'bookings.time_start',
             'bookings.time_end'
        )
            ->leftjoin('user_details','bookings.user_id','=','user_details.user_id')
            ->where('bookings.seat_id',$seatId)
            ->get()
            ->toArray();
    }

    public function getLastSortedBooking(String $column,String $sort) : array {
        return $this->bookingModel->orderBy($column,$sort)->paginate(1,['*'],'page',1)->toArray();
    }

    public function createBooking(array $createArr) : void {
        $this->bookingModel::create($createArr);
    }
}