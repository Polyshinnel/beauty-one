<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TariffSpecial extends Model
{
    protected $table = 'tariff_specials';

    protected $fillable = [
        'id',
        'name',
        'coefficient',
        'hours',
        'days_of_week',
        'days_of_month',
        'time_start',
        'time_finish',
        'valid_from',
        'valid_for'
    ];

    public $timestamps = false;

}