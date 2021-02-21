<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class PresupuestoCompraDetalle extends Model
{
    //
    protected $table = 'presupuesto_proveedor_detalle';
    protected $primaryKey = 'id_presupuesto';
   protected $fillable = [
       'id_presupuesto',
       'presupuesto_cantidad',
       'presupuesto_precio',
       'id_items'  ,
       ];
   public $timestamps = false;
}
