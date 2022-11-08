<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RoomAdd extends Model
{
    protected $table = 'room_adds';

    protected $fillable = [
        'room_id',
        'adds_type_id',
        'value'
    ];

    public $timestamps = false;
}