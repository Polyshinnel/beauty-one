<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TariffTypeObjects extends Model
{
    protected $table = 'tarif_type_objects';

    protected $fillable = [
        'id',
        'name'
    ];

    public $timestamps = false;
}