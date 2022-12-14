<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    protected $table = 'user_transactions';

    protected $fillable = [
        'id',
        'user_id',
        'unique_transaction_id',
        'money_cost',
    ];

    public $timestamps = false;
}