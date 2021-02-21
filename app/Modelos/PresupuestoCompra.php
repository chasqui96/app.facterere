<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class PresupuestoCompra extends Model
{
    //
    protected $table = 'presupuesto_proveedor';
    protected $primaryKey = 'id_presupuesto';
   protected $fillable = [
       'id_presupuesto',
       'presupuesto_estado'
       ];
   public $timestamps = false;
}
