<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $table = 'personas';
    protected $primaryKey = 'id_persona';
    protected $fillable = ['nombre_personas','apellido_personas','fecha_nacimiento_personas','telefono_personas','cedula_identidad_personas','correo_electronico_personas','genero_personas','id_ciudad','id_nacionalidad','id_estado_civil','imagen_persona','direccion_personas','barrio_personas'];
    public $timestamps = false;
    public function getRouteKeyName()
    {
        return 'celuda_identidad_personas';
    }
    
}
