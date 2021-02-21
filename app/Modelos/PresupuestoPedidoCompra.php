<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class PresupuestoPedidoCompra extends Model
{
    //
    protected $table = 'presupuesto_proveedor_pedido';
    protected $primaryKey = 'id_presupuesto';
   protected $fillable = [
       'id_presupuesto',
       'id_pedido_compras',
       'id_items'  ,
       'presupuesto_pedido_cantidad',
       'presupuesto_pedido_precio',
       ];
   public $timestamps = false;
}
