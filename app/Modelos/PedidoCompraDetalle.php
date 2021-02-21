<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class PedidoCompraDetalle extends Model
{
    //
    protected $table = 'pedido_compras_detalles';
    protected $primaryKey = 'id_pedido_compras';
   protected $fillable = [
       'id_pedido_compras',
       'pedido_compras_detalles_precio',
       'pedido_compras_detalles_cantidad',
       'id_items'  ,
       ];
   public $timestamps = false;
}
