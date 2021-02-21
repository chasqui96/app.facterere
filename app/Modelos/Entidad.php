<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    //
    protected $table = 'entidades';
    protected $primaryKey = 'id_entidades';
    protected $fillable = ['entidades_razon_social'];
    public $timestamps = false;
}
