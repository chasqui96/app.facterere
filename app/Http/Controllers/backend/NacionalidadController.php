<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\Nacionalidad;
use Illuminate\Support\Facades\DB;
class NacionalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $nacionalidades = DB::table('pais')->select('id_pais', 'pais_gentilicio','pais_siglas','pais_descripcion')->get();    
        return response()->json($nacionalidades);
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
        $nacionalidades = DB::select("select sp_nacionalidad(0,'$request->gentilicio','$request->siglas','$request->descripcion',1)");
        return response()->json($nacionalidades);
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
        //
        $nacionalidades = DB::select("select sp_nacionalidad($id,'$request->gentilicio','$request->siglas','$request->descripcion',2)");
        return response()->json($nacionalidades);
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
        $nacionalidades = Nacionalidad::find($id);
        $nacionalidades->delete();
    }
}
