<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'id',
        'user_id',
        'seat_id',
        'order_id',
        'booking_status',
        'time_start',
        'time_end'
    ];

    public $timestamps = false;
}