<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class OrdenCompraDetalle extends Model
{
    //
    protected $table = 'orden_compras_detalles';
    protected $primaryKey = 'id_orden_compras';
   protected $fillable = [
       'id_orden_compras',
       'orden_compras_detalles_precios',
       'orden_compras_detalles_cantidad',
       'id_items'  ,
       ];
   public $timestamps = false;
}
