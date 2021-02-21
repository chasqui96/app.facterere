<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Desglosar extends Model
{
    //
    protected $table = 'desglosar';
    protected $primaryKey = 'id_desglosar';
    protected $fillable = ['desglosar_descripcion'];
    public $timestamps = false;
}
