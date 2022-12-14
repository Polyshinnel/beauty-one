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
            ->where('bookings.booking_status','!=',4)
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

    public function getBookingByToken($token) {
        return $this->bookingModel::select(
            'bookings.id',
            'bookings.booking_status',
            'bookings.time_start',
            'bookings.time_end',
            'seats.name as seat_name',
            'rooms.name as room_name',
            'rooms.short',
            'rooms.img as room_img',
            'booking_status.name as status_name',
            'booking_status.color_hex as status_color'
        )
            ->leftjoin('seats','bookings.seat_id','=','seats.id')
            ->leftjoin('rooms','seats.room_id','=','rooms.id')
            ->leftjoin('users','bookings.user_id','=','users.id')
            ->leftjoin('booking_status','bookings.booking_status','=','booking_status.id')
            ->where('users.token',$token)
            ->orderBy('bookings.id','DESC')
            ->get()
            ->toArray();
    }

    public function getBookingByStatus() {
        return $this->bookingModel
            ->where('booking_status',1)
            ->orWhere('booking_status',2)
            ->get()
            ->toArray();
    }

    public function getBookingsOrder($id) {
        return $this->bookingModel::select(
            'bookings.id',
            'bookings.booking_status',
            'bookings.time_start',
            'bookings.time_end',
            'orders.date_create',
            'orders.id as order_id',
            'orders.transaction_id',
            'orders.user_id',
            'orders.order_total_money'
        )
            ->leftjoin('order_details','bookings.id','=','order_details.booking_id')
            ->leftjoin('orders','order_details.order_id','=','orders.id')
            ->where('bookings.id',$id)
            ->get()
            ->toArray();
    }

    public function updateBooking($id,$updateArr) {
        $this->bookingModel
            ->where('id',$id)
            ->update($updateArr);
    }

    public function getBookingById($bookingId) {
        return $this->bookingModel::select(
            'bookings.id',
            'bookings.booking_status',
            'bookings.time_start',
            'bookings.time_end',
            'seats.name as seat_name',
            'rooms.name as room_name',
            'rooms.short',
            'rooms.img_big as room_img',
            'booking_status.name as status_name',
            'booking_status.color_hex as status_color',
            'order_details.money_value'
        )
            ->leftjoin('seats','bookings.seat_id','=','seats.id')
            ->leftjoin('rooms','seats.room_id','=','rooms.id')
            ->leftjoin('users','bookings.user_id','=','users.id')
            ->leftjoin('booking_status','bookings.booking_status','=','booking_status.id')
            ->leftjoin('order_details','bookings.id','=','order_details.booking_id')
            ->where('bookings.id',$bookingId)
            ->get()
            ->toArray();
    }

}