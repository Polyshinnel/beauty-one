<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserDeatail extends Model
{
    protected $table = 'user_details';
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'mail'
    ];
    public $timestamps = false;

}