<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $table = 'items';
     protected $primaryKey = 'id_items';
    protected $fillable = [
        'id_items',
        'descripcion_items',
        'costo_items'  ,
        'precio_minorista_items'  ,
        'precio_mayorista_items'  ,
        'codigode_barra_items'  ,
        'id_categoria'          ,
        'id_tipo_impuesto',
        'id_desglosar'  ,
        'id_bloque'   ,
        'estado_items',
        ];
    public $timestamps = false;
}
