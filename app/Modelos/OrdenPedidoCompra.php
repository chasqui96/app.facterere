<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class OrdenPedidoCompra extends Model
{
    //
    protected $table = 'orden_pedido_compras';
    protected $primaryKey = 'id_orden_compras';
   protected $fillable = [
       'id_orden_compras',
       'id_pedido_compras',
       'id_items'  ,
       'compras_orden_pedido_cantidad',
       'compras_orden_pedido_precio',
       ];
   public $timestamps = false;
}
