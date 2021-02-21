<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{
    //
    protected $table = 'bloques';
    protected $primaryKey = 'id_bloque';
    protected $fillable = ['bloques_descripcion'];
    public $timestamps = false;
}
