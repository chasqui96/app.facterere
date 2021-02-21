<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Imports\ProductoImportar;
use App\Modelos\Stock;
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productos = DB::select("select * from v_items order by id_items desc");   
        return response()->json($productos);
    }
    public function carga()
    {
        //
        $productos = DB::select("select * from v_carga");   
        return response()->json($productos);
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
        if($request->hasFile('producto_imagen')){
            $file = $request->file('producto_imagen');
            $foto = time().$file->getClientOriginalName();
            $file->move(public_path().'/productos_imagen/',$foto);
        
            }                                           //CODIGO1 ,DESCRIPCION2,PRECIOCOSTO3,PRECIOMINORISTA4,PRECIOMAYORISTA5,CODIGODEBARRA6,CATEGORIA7,IMAGEN8,tipoimpuesto9,desglosar10,bloque11
            $productos = DB::select("select sp_items(0,'$request->producto_descripcion',$request->producto_precio_costo,$request->producto_precio_venta_minorista,$request->producto_precio_venta_mayorista,'$request->producto_codigode_barra',$request->producto_idcategoria,'$request->producto_imagen',$request->producto_idtipoimpuesto,$request->producto_iddesglosar,$request->producto_idbloque,1)");
             return response()->json($productos);
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
         if($request->hasFile('producto_imagen')){
            $file = $request->file('producto_imagen');
            $foto = time().$file->getClientOriginalName();
            $request->imagen = $foto;
            $file->move(public_path().'/productos_imagen/',$foto);
            }
            $productos = DB::select("select sp_items($id,'$request->producto_descripcion',$request->producto_precio_costo,$request->producto_precio_venta_minorista,$request->producto_precio_venta_mayorista,'$request->producto_codigode_barra',$request->producto_idcategoria,'$request->producto_imagen',$request->producto_idtipoimpuesto,$request->producto_iddesglosar,$request->producto_idbloque,2)");
             return response()->json($productos);
       
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
        $productos = DB::select("select sp_items($id,'$request->producto_descripcion',$request->producto_precio_costo,$request->producto_precio_venta_minorista,$request->producto_precio_venta_mayorista,'$request->producto_codigode_barra',$request->producto_idcategoria,'$request->producto_imagen',$request->producto_idtipoimpuesto,$request->producto_iddesglosar,$request->producto_idbloque,$request->operacion)");
       return response()->json($productos);
    }


    public function importar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'producto_archivo' => 'mimes:xls,xlsx,cvs'
        ]);
         
        if ($validator->fails()) {
             return response()->json(['errors'=>['message' => 'Solo archivos con extensiones .xlsx, .cvs, .xls']], 422);
        }

        $file = $request->file('producto_archivo');
        Excel::import(new ProductoImportar,$file);
        return response()->json($file);
    }

    public function buscarArticulo(Request $request){
        if (!$request->ajax()) return redirect('/home');
   
        $filtro = $request->filtro;
        $productos = DB::select("select * from v_items where  descripcion_items ilike '%$filtro%' order by id_items limit 5");

        return response()->json($productos);
    }
    
    public function ProductoModal(){
     
        $productos = DB::select("select * from v_items");

        return response()->json($productos);
    }



    public function buscarArticuloModal(Request $request){
        if (!$request->ajax()) return redirect('/home');
   
        $filtro = $request->filtro;
        $por = $request->por;
        if($filtro ==''){
            $productos = DB::select("select * from v_items");
            return response()->json($productos);
        }else{
        $productos = DB::select("select * from v_items where ".$por." ilike '%$filtro%' order by id_items ");
        return response()->json($productos);
        }
    }

    public function stock(Request $request){
         $stocks =DB::select("select sp_stock_producto($request->stock_cantidad,$request->stock_minimo,$request->stock_maximo,$request->idproducto,$request->iddeposito,1)");
         // new Stock();
        //  $stocks->stock_cantidad = $request->stock_cantidad;
        //  $stocks->stock_minimo =   $request->stock_minimo;
        //  $stocks->stock_maximo =   $request->stock_maximo;
        //  $stocks->id_items =    $request->idproducto;
        //  $stocks->id_deposito =    $request->iddeposito;
        //  $stocks->save();
        // DB::select("select sp_stock_producto($request->stock_cantidad,$request->stock_minimo,$request->stock_maximo,$request->idproducto,$request->iddeposito,1)");
        return response()->json($stocks);
    }
    public function listarstock(){
        $stocks = DB::select("select * from v_stock order by id_items asc ");
        return response()->json($stocks);
     }


     public function editarStock(Request $request, $id){
        $stocks = DB::select("select sp_stock_producto($request->stock_cantidad,$request->stock_minimo,$request->stock_maximo,$id,$request->iddeposito,2)");
        return response()->json($stocks);
     }


     public function cambiarstock(Request $request, $id){
        $stocks = DB::select("select sp_stock_producto($request->stock_cantidad,$request->stock_minimo,$request->stock_maximo,$request->idproducto,$request->iddeposito,$request->operacion)");
        return response()->json($stocks);
    
    }
    
}