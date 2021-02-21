<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    //
    protected $table = 'ciudades';
    protected $primaryKey = 'id_ciudad';
    protected $fillable = ['ciudades_descripcion','id_pais'];
    public $timestamps = false;
}
