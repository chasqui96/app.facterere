<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    //
    protected $table = 'pais';
    protected $primaryKey = 'id_pais';
    protected $fillable = [
        'pais_gentilicio',
        'pais_siglas',
        'pais_descripcion',
    ];
    public $timestamps = false;
}
