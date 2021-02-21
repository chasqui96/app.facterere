<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    protected $fillable = ['categoria_descripcion'];
    public $timestamps = false;
}
