<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class FacturaComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $factura_compras = DB::select("select * from v_factura_compras where factura_compra_estado = 'PENDIENTE' order by id_factura_compra desc");   
        return response()->json($factura_compras);
    }


    public function verCabecera(Request $request)
    {
        //
        $idfacturacompra =  $request->id;
        $factura_compras = DB::select("select * from v_factura_compras where id_factura_compra =".$idfacturacompra);   
        return response()->json($factura_compras);
    }
    public function verDetalle(Request $request)
    {
        $idfacturacompra  =  $request->id;
        
    $factura_compras = DB::select("SELECT * FROM v_factura_compra_detalles WHERE id_factura_compra =".$idfacturacompra );
    return response()->json($factura_compras);
    }

    public function listarCuotaGeneradas(Request $request)
    {
        $idfacturacompra  =  $request->id;
        
    $factura_compras = DB::select("SELECT * FROM v_cuota_compras WHERE id_factura_compra =".$idfacturacompra );
    return response()->json($factura_compras);
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
        \Debugbar::info($request);
        $detalle1 = $request->detalles_facturas;
        $detalles = "{";
         foreach ($detalle1 as $detalle => $value) { 
            $detalles .= "{"."0,".$value['producto_precio'].",".$value['producto_cantidad'].",".$value['iddeposito'].",".$value['id_tipo_impuesto'].",".$value['id_items'].",".$value['idunidad']."},";
         }
        $detalles = substr($detalles, 0, -1);
        $detalles .= "}";

        $factura_compras = DB::select("select sp_factura_compras(0,'$request->numero_factura',$request->idordencompra,'$request->fecha_emision','$request->factura_fecha_vencimiento','$request->fecha_registro','$request->numero_timbrado',$request->idproveedor,$request->idsucursal,$request->idusuario,$request->idtipocomprobante,'$request->tim_vencimiento',$request->idtipomoneda,'$request->tasa_cambio','$request->condicion_factura',$request->grav5,$request->grav10,'$request->totalgeneral','$request->observacion','".$detalles."',$request->afecta_stock,1)");
        return response()->json($factura_compras);
        \Debugbar::info($detalles);
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

    public function guardarCuotas(Request $request)
    {
        \Debugbar::info($request->datos);
        $detalle1 = $request->datos;
        $detalles = "{";
         foreach ($detalle1 as $detalle => $value) { 
            $detalles .= "{".$value['id_compra'].",".$value['cantidad'].",".$value['fechaVencimiento'].",".$value['monto'].",".$value['monto'].",0},";
         }
        $detalles = substr($detalles, 0, -1);
        $detalles .= "}";

        $factura_compras = DB::select("select sp_compra_cuotas('".$detalles."',1)");
        return response()->json($factura_compras);

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
