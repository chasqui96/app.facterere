<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\TipoImpuesto;
use Illuminate\Support\Facades\DB;
class TipoimpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tipoimpuestos = DB::table('tipo_de_impuesto')->select('id_tipo_impuesto', 'tipo_impuesto_descripcion')->orderBy('id_tipo_impuesto')->get();    
        return response()->json($tipoimpuestos);
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
        $tipoimpuestos = DB::select("select sp_tipo_impuesto(0,'$request->descripcion',1)");
        return response()->json($tipoimpuestos);
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
        $tipoimpuestos = DB::select("select sp_tipo_impuesto($id,'$request->descripcion',2)");
        return response()->json($tipoimpuestos);
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
        $tipoimpuestos = TipoImpuesto::find($id);
        $tipoimpuestos->delete();
    }
}
