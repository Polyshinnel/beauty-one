<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'id',
        'location_id',
        'name',
        'short',
        'description',
        'img',
        'status'
    ];

    public $timestamps = false;
}