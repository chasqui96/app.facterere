<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\TipoMoneda;
use Illuminate\Support\Facades\DB;
class TipoMonedaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tipomoneda = DB::table('tipo_moneda_divisa')->select('id_tipo_moneda','moneda_descripcion','moneda_siglas')->orderBy('id_tipo_moneda')->get();    
        return response()->json($tipomoneda);
    }


    public function tazaCambios(Request $request)
    {
        $valor = $request->valor;
        $tipomoneda = DB::select("select * from tipo_moneda_divisa where id_tipo_moneda =".$valor);    
        return response()->json($tipomoneda);
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
        $tipomoneda = DB::select("select sp_tipo_moneda(0,'$request->descripcion','$request->siglas',1)");    
        return response()->json($tipomoneda);
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
        $tipomoneda = DB::select("select sp_tipo_moneda($id,'$request->descripcion','$request->siglas',2)");    
        return response()->json($tipomoneda);
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
        $tipomoneda = TipoMoneda::find($id);
        $tipomoneda->delete();
    }
}
