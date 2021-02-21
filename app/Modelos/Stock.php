<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $table = 'stock_productos';
    protected $primaryKey = ['id_producto','id_deposito'];
    protected $fillable = ['stock_minimo','stock_maximo','stock_cantidad'];
    public $timestamps = false;
    public $incrementing = false;
}
