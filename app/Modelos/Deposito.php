<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    //
    protected $table = 'depositos';
    protected $primaryKey = 'id_deposito';
    protected $fillable = ['deposito_descripcion','id_sucursal'];
    public $timestamps = false;
}
