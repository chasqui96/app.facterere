<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TipoMovimientoInventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tipo_movimiento = DB::table('tipos_movimientos_inventarios')->select('tipo_movimiento_inventario_id', 'descripcion')->orderBy('tipo_movimiento_inventario_id')->get();    
        return response()->json($tipo_movimiento);
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
        $tipo_movimiento = DB::select("select sp_tipo_movimientos_inventario(0,'$request->descripcion',1)");
        return response()->json( $tipo_movimiento);
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
        $tipo_movimiento = DB::select("select sp_tipo_movimientos_inventario($id,'$request->descripcion',2)");
        return response()->json( $tipo_movimiento);
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
        $tipo_movimiento = DB::select("select sp_tipo_movimientos_inventario($id,'ss',3)");
        return response()->json( $tipo_movimiento);
    }
}
