<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    //
    protected $table = 'orden_de_compras';
    protected $primaryKey = 'id_orden_compras';
   protected $fillable = [
       'id_orden_compras',
       'orden_compras_estado '];
   public $timestamps = false;
}
