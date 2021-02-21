<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class TipoImpuesto extends Model
{
    //
    protected $table = 'tipo_de_impuesto';
    protected $primaryKey = 'id_tipo_impuesto';
    protected $fillable = ['tipo_impuesto_descripcion'];
    public $timestamps = false;
}
