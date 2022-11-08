<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RoomAddsType extends Model
{
    protected $table = 'rooms_adds_type';

    protected $fillable = [
        'id',
        'name'
    ];

    public $timestamps = false;
}