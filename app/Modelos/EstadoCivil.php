<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    //
    protected $table = 'estado_civil';
    protected $primaryKey = 'id_estado_civil';
    protected $fillable = ['estado_civil_descripcion'];
    public $timestamps = false;
}
