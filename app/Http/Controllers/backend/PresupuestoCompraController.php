<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Modelos\PresupuestoCompraDetalle;
use App\Modelos\PresupuestoCompra;
use App\Modelos\PresupuestoPedidoCompra;
class PresupuestoCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $presupuesto_compras = DB::select("select * from v_presupuesto_compra where presupuesto_estado = 'PENDIENTE' ORDER BY id_presupuesto desc;");   
        return response()->json($presupuesto_compras);
    }
    
    public function verCabecera(Request $request)
    {
        //
        $idpresupuesto =  $request->id;
        $presupuesto_compras = DB::select("select * from v_presupuesto_compra where id_presupuesto =".$idpresupuesto);   
        return response()->json($presupuesto_compras);
    }
    public function verDetalle(Request $request)
    {
        $idpresupuesto =  $request->id;
        
    $presupuesto_compras = DB::select("SELECT * FROM v_presupuesto_detalles WHERE id_presupuesto =".$idpresupuesto);
    return response()->json($presupuesto_compras);
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
        
    $detalle1 = $request->datos;
    $detalles = "{";
     foreach ($detalle1 as $detalle => $value) { 
        $detalles .= "{"."0,".$value['producto_cantidad'].",".$value['producto_precio'].",".$value['id_items']."},";
     }
    $detalles = substr($detalles, 0, -1);
    $detalles .= "}";
    
           $presupuesto_compras = DB::select("select sp_presupuestos(0,0,'$request->presupuesto_fecha','$request->presupuesto_plazo','$request->presupuesto_observacion',$request->presupuesto_monto,$request->idproveedor,$request->idusuario,$request->idsucursal,$request->idpedidocompra,'".$detalles."',1)");
           return response()->json($presupuesto_compras);
            \Debugbar::info($presupuesto_compras);
           
            // foreach ($detalles as $key => $filas) {
              
            //     if(isset($filas['idpedinew PresupuestoPedidoCompra;
            //             $pedidoorden->idocompra'])){
            //             $pedidoorden = d_presupuesto = $presupuesto_compras[0]->ultimo_codigo;
            //             $pedidoorden->id_pedido_compras = $filas['idpedidocompra'];
            //             $pedidoorden->id_items = $filas['id_items'];
            //             $pedidoorden->presupuesto_pedido_cantidad = $filas['producto_cantidad'];
            //             $pedidoorden->presupuesto_pedido_precio = $filas['producto_precio'];
            //             $pedidoorden->save();
            //         }else{
            //      $detalle = new PresupuestoCompraDetalle();
            //      $detalle->id_presupuesto = $presupuesto_compras[0]->ultimo_codigo;
            //      $detalle->id_items = $filas['id_items'];
            //      $detalle->presupuesto_cantidad = $filas['producto_cantidad'];
            //      $detalle->presupuesto_precio = $filas['producto_precio'];         
            //      $detalle->save();}
            //     }
             
       
        
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
    public function buscarDetalle(Request $request)
    {
        $id = $request->id;

        $presupuesto_compras = DB::select("select * from v_presupuesto_detalles where id_presupuesto =".$id);
           return response()->json($presupuesto_compras);
    }


    public function update(Request $request, $id)
    {
        //
        \Debugbar::info($id);
        
        $presupuesto_compras = PresupuestoCompra::find($id);
        $presupuesto_compras->presupuesto_numero = $request->presupuesto_numero;
        $presupuesto_compras->presupuesto_fecha = $request->presupuesto_fecha;
        $presupuesto_compras->presupuesto_validez = $request->presupuesto_plazo;
        $presupuesto_compras->presupuesto_estado = 'PENDIENTE';
        $presupuesto_compras->presupuesto_monto = $request->presupuesto_monto;
        $presupuesto_compras->id_proveedor = $request->idproveedor;
        $presupuesto_compras->id_usuarios = $request->idusuario;
        $presupuesto_compras->id_sucursal = $request->idsucursal;
        $presupuesto_compras->presupuesto_observaciones = $request->presupuesto_observacion;
        $presupuesto_compras->save(); 
        $detalles = $request->datos;
             foreach ($detalles as $key => $filas) {
                $detalle =PresupuestoCompraDetalle::whereIn('id_items', [$filas['id_items']])->whereIn('id_presupuesto', [$id])->firstOrCreate(['id_presupuesto' => $id,'id_items'=>$filas['id_items']],['presupuesto_cantidad' => $filas['producto_cantidad'],
                'presupuesto_precio' => $filas['producto_precio'],'id_items' => $filas['id_items']]);
                $detalle->presupuesto_precio = $filas['producto_precio'];
                $detalle->presupuesto_cantidad = $filas['producto_cantidad'];
              $detalle->save();
            
            }
           $mensaje = [
               'Texto' =>'Se Edito Correctamente',
               'Color'=> 'success'
           ];
            return response()->json($mensaje);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aprobar(Request $request, $id)
    {
        //
        $presupuesto_compras = PresupuestoCompra::findOrFail($request->id);
        $presupuesto_compras->presupuesto_estado = 'REGISTADO';
        $presupuesto_compras->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function anular(Request $request, $id)
    {
        //
        $presupuesto_compras = PresupuestoCompra::findOrFail($request->id);
        $presupuesto_compras->presupuesto_estado = 'ANULADO';
        $presupuesto_compras->save();
    }
}
