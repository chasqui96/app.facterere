<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class MarcaTarjeta extends Model
{
    //
    protected $table = 'marca_tajeta';
    protected $primaryKey = 'id_marca_tarjeta';
    protected $fillable = ['marca_tarjeta_descripcion'];
    public $timestamps = false;
}
