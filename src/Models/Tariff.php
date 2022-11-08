<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $table = 'tarifs';

    protected $fillable = [
        'id',
        'location_id',
        'type_object',
        'specials',
        'base_price'
    ];

    public $timestamps = false;
}