<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'id',
        'name',
        'short',
        'description',
        'img',
        'status'
    ];
}