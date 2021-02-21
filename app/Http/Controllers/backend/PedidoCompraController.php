<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Modelos\PedidoCompra;
use App\Modelos\PedidoCompraDetalle;
class PedidoCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pedidos_compras = DB::select("select * from v_pedido_compra where pedido_compras_estado = 'PENDIENTE' order by id_pedido_compras desc");   
        return response()->json($pedidos_compras);
    }
    public function VerCabecera(Request $request)
    {
       $idpedidocompra =  $request->id;
        $pedidos_compras = DB::select("select * from v_pedido_compra where id_pedido_compras =".$idpedidocompra);   
        return response()->json($pedidos_compras);
    }
    public function VerDetalle(Request $request)
    {
       $idpedidocompra =  $request->id;
        $pedidos_compras = DB::select("select * from v_pedido_compra_detalle where id_pedido_compras =".$idpedidocompra);   
        return response()->json($pedidos_compras);
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
        // $pedidos_compras = New PedidoCompra;
        // $pedidos_compras->id_pedido_compras = 3;
        // $pedidos_compras->pedido_compras_fecha = $request->pedido_fecha;
        // $pedidos_compras->id_usuarios = $request->idusuario;
        // $pedidos_compras->id_sucursal = $request->idsucursal;
        // $pedidos_compras->pedido_compra_nro = $request->pedido_numero;
        // $pedidos_compras->pedido_compras_estado = 'PENDIENTE';
        // $pedidos_compras->save();
        // $detalles = $request->datos;
        // foreach ($detalles as $key => $filas) {
        //         $detalle = new PedidoCompraDetalle();
        //         $detalle->id_pedido_compras = $pedidos_compras->id_pedido_compras;
        //         $detalle->id_producto = $filas['id_producto'];
        //         $detalle->pedido_compras_detalles_cantidad = $filas['producto_cantidad'];
        //         $detalle->pedido_compras_detalles_precio = $filas['producto_precio'];         
        //         $detalle->save();
        // }


        // return response()->json($pedidos_compras);
           
            $pedidos_compras = DB::select(DB::raw("select sp_pedido_compra3(0,'$request->pedido_fecha',$request->idusuario,$request->idsucursal,0,1) as ultimo_codigo"));
            $detalles = $request->datos;
            foreach ($detalles as $key => $filas) {
                foreach($pedidos_compras as $a){
                 $detalle = new PedidoCompraDetalle();
                 $detalle->id_pedido_compras = $a->ultimo_codigo;
                 $detalle->id_items = $filas['id_items'];
                 $detalle->pedido_compras_detalles_cantidad = $filas['producto_cantidad'];
                 $detalle->pedido_compras_detalles_precio = $filas['producto_precio'];         
                 $detalle->save();
                }
         }
            return response()->json($pedidos_compras);
       
        
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
        $pedidos_compras = PedidoCompra::findOrFail($request->id);
        $pedidos_compras->pedido_compras_estado = 'ANULADO';
        $pedidos_compras->save();
    }
    public function registrado(Request $request, $id)
    {
        //
        $pedidos_compras = PedidoCompra::findOrFail($request->id);
        $pedidos_compras->pedido_compras_estado = 'REGISTRADO';
        $pedidos_compras->save();
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
    }
}
