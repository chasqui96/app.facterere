<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    //
    protected $table = 'sucursales';
    protected $primaryKey = 'id_sucursal';
    protected $fillable = ['sucursal_descripcion'];
    public $timestamps = false;
}
