<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    protected $table = 'promocodes';

    protected $fillable = [
        'id',
        'name',
        'value',
        'count_usage_all',
        'expired_date',
        'count_usage_user',
        'do_not_combine'
    ];

    public $timestamps = false;
}