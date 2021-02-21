<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    //
    protected $table = 'cargos';
    protected $primaryKey = 'id_cargo';
    protected $fillable = ['cargo_descripcion'];
    public $timestamps = false;
}
