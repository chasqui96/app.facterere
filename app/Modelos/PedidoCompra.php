<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class PedidoCompra extends Model
{
    //
    protected $table = 'pedido_compras';
    protected $primaryKey = 'id_pedido_compras';
   protected $fillable = [
       'pedido_compras_fecha',
       'pedido_compras_estado'  ,
       'id_usuarios'  ,
       'id_sucursal'  ,
       'pedido_compra_nro' ,
    
       ];
   public $timestamps = false;
}
