<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SubscriptionUser extends Model
{
    protected $table = 'subscibtion_user';
    protected $fillable = [
        'id',
        'user_id',
        'subsctiption_id',
        'transaction_id',
        'current_time',
        'date_start',
        'date_end',
        'available'
    ];
}