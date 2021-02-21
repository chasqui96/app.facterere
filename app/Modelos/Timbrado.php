<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Timbrado extends Model
{
    //
    protected $table = 'timbrados';
    protected $primaryKey = 'id_timbrado';
    protected $fillable = ['timbrado_numero','timbrado_fecha_desde','timbrado_fecha_hasta','timbrado_numero_inicial','timbrado_numero_final','timbrado_ultimo_numero','timbrado_tipo_documento','id_sucursal','timbrado_establecimiento',' timbrado_punto_expedicion'];
    public $timestamps = false;

}
