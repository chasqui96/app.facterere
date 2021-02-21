<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Modelos\Timbrado;
class TimbradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $timbrados = DB::select("select * from v_timbrados order by id_timbrado desc");   
        return response()->json($timbrados);
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
        $timbrados = DB::select("select sp_timbrados(0,$request->timbrado_numero,'$request->timbrado_desde','$request->timbrado_hasta',$request->timbrado_nro_inicial,$request->timbrado_nro_final,$request->timbrado_ult_numero,'$request->timbrado_documento',$request->idsucursal,$request->timbrado_establecimiento,$request->timbrado_expedicion,1)");
        return response()->json($timbrados);
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
        $timbrados = DB::select("select sp_timbrados($id,$request->timbrado_numero,'$request->timbrado_desde','$request->timbrado_hasta',$request->timbrado_nro_inicial,$request->timbrado_nro_final,$request->timbrado_ult_numero,'$request->timbrado_documento',$request->idsucursal,$request->timbrado_establecimiento,$request->timbrado_expedicion,2)");
        return response()->json($timbrados);
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
        $timbrados = Timbrado::find($id);
        $timbrados->delete();
    }
}
