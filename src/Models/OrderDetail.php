<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $fillable = [
        'id',
        'order_id',
        'promocode_id',
        'product_id',
        'booking_id',
        'money_value',
        'time_value',
        'quantity'
    ];

    public $timestamps = false;
}