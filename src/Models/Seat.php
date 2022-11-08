<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $table = 'seats';

    protected $fillable = [
        'id',
        'location_id',
        'room_id',
        'name',
        'seat_type'
    ];

    public $timestamps = false;
}