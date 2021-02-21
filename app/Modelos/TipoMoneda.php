<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class TipoMoneda extends Model
{
    //
    protected $table = 'tipo_moneda_divisa';
    protected $primaryKey = 'id_tipo_moneda';
    protected $fillable = ['moneda_descripcion','moneda_siglas'];
    public $timestamps = false;
}
