<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'id',
        'user_id',
        'transaction_id',
        'status_order',
        'order_total_time',
        'order_total_money',
        'date_create'
    ];

    public $timestamps = false;
}