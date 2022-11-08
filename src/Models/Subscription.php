<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    protected $fillable = [
        'id',
        'time_val',
        'tariff_id',
        'location_id',
        'available_days'
    ];

    public $timestamps = false;
}