<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Modelos\OrdenCompra;
use App\Modelos\OrdenCompraDetalle;
use App\Modelos\OrdenPedidoCompra;

class OrdenCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $orden_compras = DB::select("select * from v_orden_compras where orden_compras_estado = 'PENDIENTE' order by id_orden_compras desc");   
        return response()->json($orden_compras);
    }
    public function OrdenFacturaCompras()
    {
        //
       $orden_compras = DB::select("select * from v_orden_compras where orden_compras_estado = 'APROBADO' order by id_orden_compras desc");   
        return response()->json($orden_compras);
    }
    public function buscarOrden(Request $request){
        $idordencompra =  $request->id;
        $orden_compras = DB::select("select * from v_orden_compras where  orden_compras_estado = 'APROBADO' and  id_orden_compras =".$idordencompra);   
         return response()->json($orden_compras);
    }

    public function buscarOrdenDetalle(Request $request){
        $idordencompra =  $request->id;
        $orden_compras_detalles = DB::select("select * from v_orden_compras_detalles where id_orden_compras =".$idordencompra);   
         return response()->json($orden_compras_detalles);
    }
    public function VerCabecera(Request $request)
    {
       $idordencompra =  $request->id;
       $orden_compras = DB::select("select * from v_orden_compras where id_orden_compras =".$idordencompra);   
        return response()->json($orden_compras);
    }
    public function VerDetalle(Request $request)
    { 
        $idordencompra =  $request->id;
        
        if($orden_compras = DB::select("SELECT * FROM v_orden_compras_detalles v1 where exists(select * from v_orden_compras_detalles_2 v2 where v1.id_orden_compras =".$idordencompra.")")){

            return response()->json($orden_compras);
        }else{
            $orden_compras = DB::select("SELECT * FROM v_orden_compras_detalles_2 v1 where  exists(select * from v_orden_compras_detalles v2 where v1.id_orden_compras =".$idordencompra.")");
        }
        return response()->json($orden_compras);
    }
    public function listarPedidoOrden()
    {
        //
        $orden_compras = DB::select("select * from v_pedido_compra_detalle, (select   to_char(id_pedido_compras, '000'::text) AS numero_compra,pedido_compras_estado,sucursal_descripcion from v_pedido_compra where pedido_compras_estado =  'PENDIENTE' ) as pcomp");   
        return response()->json($orden_compras);
    } 

    public function listarPedidoOrdende()
    {
        //
        $orden_compras = DB::select("select * from v_pedido_compra_detalle");   
        return response()->json($orden_compras);
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
        //$orden_compras = New PedidoCompra;
        //$orden_compras->id_pedido_compras = 3;
        //$orden_compras->pedido_compras_fecha = $request->pedido_fecha;
        //$orden_compras->id_usuarios = $request->idusuario;
        //$orden_compras->id_sucursal = $request->idsucursal;
        //$orden_compras->pedido_compra_nro = $request->pedido_numero;
        //$orden_compras->pedido_compras_estado = 'PENDIENTE';
        //$orden_compras->save();
        // $detalles = $request->datos;
        // foreach ($detalles as $key => $filas) {
        //         $detalle = new PedidoCompraDetalle();
        //         $detalle->id_pedido_compras =$orden_compras->id_pedido_compras;
        //         $detalle->id_producto = $filas['id_producto'];
        //         $detalle->pedido_compras_detalles_cantidad = $filas['producto_cantidad'];
        //         $detalle->pedido_compras_detalles_precio = $filas['producto_precio'];         
        //         $detalle->save();
        // }


        // return response()->json($pedidos_compras);
           
            $orden_compras = DB::select(DB::raw("select sp_orden_de_compras(0,'$request->orden_fecha',0,'$request->orden_observacion','$request->orden_plazo',$request->idsucursal,$request->idproveedor,$request->idusuario,$request->idpresupuesto,1) as ultimo_codigo"));
            $detalles = $request->datos;
            
            foreach ($detalles as $key => $filas) {
                if(isset($filas['idpedidocompra'])){
                        $pedidoorden = new OrdenPedidoCompra;   
                        $pedidoorden->id_orden_compras = $orden_compras[0]->ultimo_codigo;
                        $pedidoorden->id_pedido_compras = $filas['idpedidocompra'];
                        $pedidoorden->id_items = $filas['id_items'];
                        $pedidoorden->compras_orden_pedido_cantidad = $filas['producto_cantidad'];
                        $pedidoorden->compras_orden_pedido_precio = $filas['producto_precio'];
                        $pedidoorden->save();
                    }else{
                 $detalle = new OrdenCompraDetalle();
                 $detalle->id_orden_compras = $orden_compras[0]->ultimo_codigo;
                 $detalle->id_items = $filas['id_items'];
                 $detalle->orden_compras_detalles_cantidad = $filas['producto_cantidad'];
                 $detalle->orden_compras_detalles_precios = $filas['producto_precio'];         
                 $detalle->save();}
                }
    
            return response()->json($orden_compras);
       
        
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
        $orden_compras = OrdenCompra::findOrFail($request->id);
        $orden_compras->orden_compras_estado = 'ANULADO';
        $orden_compras->save();
    }
    public function Aprobar(Request $request, $id)
    {
        //
        $orden_compras = OrdenCompra::findOrFail($request->id);
        $orden_compras->orden_compras_estado = 'APROBADO';
        $orden_compras->save();
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
