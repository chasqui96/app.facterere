<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Modelos\Funcionario;
class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $funcionarios = DB::select("select * from v_funcionarios order by id_funcionario desc");   
        return response()->json($funcionarios);
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
        $funcionarios = DB::select("select sp_funcionario(0,'$request->fecha_alta','$request->estado',$request->persona,$request->cargo,1)");
        return response()->json($funcionarios);
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
        $funcionarios = DB::select("select sp_funcionario($id,'$request->fecha_alta','$request->estado',$request->persona,$request->cargo,2)");
        return response()->json($funcionarios);
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
        $funcionarios = DB::select("select sp_funcionario($id,'$request->fecha_alta','$request->estado',$request->persona,$request->cargo,$request->operacion)");
        return response()->json($funcionarios);
    }
}
