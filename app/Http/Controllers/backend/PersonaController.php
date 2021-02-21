<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Modelos\Persona;
class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $personas = DB::select("select * from v_personas order by id_persona desc");   
        return response()->json($personas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $foto = time().$file->getClientOriginalName();
            $file->move(public_path().'/foto_perfil/',$foto);
        
            }
            $personas = DB::select("select sp_personas(0,'$request->nombre','$request->apellido','$request->FechaNac','$request->telefono','$request->cedula_identidad','$request->correo','$request->genero',$request->idciudad,$request->idnacionalidad,$request->idestadocivil,'$request->imagen','$request->direccion','$request->barrio',1)");
             return response()->json($personas);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

    {
      
        // $personas = Persona::find($id);
        // $personas->nombre_personas = $request->nombre;
        // $personas->apellido_personas = $request->apellido;
        // $personas->fecha_nacimiento_personas = $request->FechaNac;
        // $personas->telefono_personas = $request->telefono;
        // $personas->cedula_identidad_personas = $request->cedula_identidad;
        // $personas->correo_electronico_personas = $request->correo;
        // $personas->genero_personas = $request->genero;
        // $personas->id_ciudad = $request->idciudad;
        // $personas->id_nacionalidad = $request->idnacionalidad;
        // $personas->id_estado_civil = $request->idestadocivil;
        // $personas->direccion_personas = $request->direccion;
        // $personas->barrio_personas =$request->barrio
        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $foto = time().$file->getClientOriginalName();
            $request->imagen = $foto;
            $file->move(public_path().'/foto_perfil/',$foto);
            }
            $personas = DB::select("select sp_personas($id,'$request->nombre','$request->apellido','$request->FechaNac','$request->telefono','$request->cedula_identidad','$request->correo','$request->genero',$request->idciudad,$request->idnacionalidad,$request->idestadocivil,'$request->imagen','$request->direccion','$request->barrio',2)");
             return response()->json($personas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $personas = Persona::find($id);
        $personas->delete();
    }
}
