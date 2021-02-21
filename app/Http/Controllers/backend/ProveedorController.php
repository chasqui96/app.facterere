<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $proveedores = DB::select("select * from v_proveedor order by id_proveedor desc");   
        return response()->json($proveedores);
    }



    public function buscarRuc(Request $request){
       $proveedores = DB::select("select * from v_proveedor where cedula_identidad_personas ='$request->ruc'");   
       return response()->json($proveedores);
    }



    public function buscarId(Request $request){
        $proveedores = DB::select("select * from v_proveedor where id_proveedor =".$request->id);   
        return response()->json($proveedores);
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
        $proveedores = DB::select("select sp_proveedor(0,'$request->estado',$request->persona,1)");
        return response()->json($proveedores);
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
        $proveedores = DB::select("select sp_proveedor($id,'$request->estado',$request->persona,2)");
        return response()->json($proveedores);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cambiar(Request $request, $id)
    {
        //
        $proveedores = DB::select("select sp_proveedor($id,'$request->estado',$request->persona,$request->operacion)");
        return response()->json($proveedores);
    }
}
