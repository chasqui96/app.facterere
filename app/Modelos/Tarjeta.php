<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    //
    protected $table = 'tarjetas';
    protected $primaryKey = 'id_tarjeta';
    protected $fillable = ['tarjeta_tipo','id_marca_tarjeta'];
    public $timestamps = false;
}
