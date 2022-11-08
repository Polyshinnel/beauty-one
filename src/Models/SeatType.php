<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SeatType extends Model
{
    protected $table = 'seats_type';

    protected $fillable = [
        'id',
        'name'
    ];

    public $timestamps = false;
}