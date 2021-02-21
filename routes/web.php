<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','backend\LoginController@index')->name('usuario-login');
Route::post('/admin-panel','backend\LoginController@login')->name('logueo');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/modulo-referenciales', 'HomeController@referenciales')->name('referenciales');
// Route::get('/modulo-productos', 'HomeController@productosgenerales')->name('productos');




// RUTAS DE REFERENCIALES DE EMPRESA
Route::post('/grabar-personas', 'backend\PersonaController@store')->name('personas.store');
Route::get('/listar-Personas', 'backend\PersonaController@index')->name('personass.index');
Route::put('/Editar-Persona/{id}', 'backend\PersonaController@update')->name('persona.update');
Route::delete('/Eliminar-Persona/{id}', 'backend\PersonaController@destroy')->name('persona.destroy');

Route::get('/ciudades', 'backend\CiudadController@index')->name('ciudades');
Route::post('guardar-Ciudad','backend\CiudadController@store')->name('ciudades.store');
Route::put('editar-Ciudad/{id}','backend\CiudadController@update')->name('ciudades.update');
Route::delete('eliminar-Ciudad/{id}','backend\CiudadController@destroy')->name('ciudades.destroy');

Route::get('/nacionalidad', 'backend\NacionalidadController@index')->name('nacionalidades');
Route::post('guardar-Nacionalidad','backend\NacionalidadController@store')->name('ciudades.store');
Route::put('editar-Nacionalidad/{id}','backend\NacionalidadController@update')->name('ciudades.update');
Route::delete('eliminar-Nacionalidad/{id}','backend\NacionalidadController@destroy')->name('ciudades.destroy');

Route::get('/estado-civil', 'backend\EstadoCivilController@index')->name('estado-civil');
Route::post('guardar-EstadoCivil','backend\EstadoCivilController@store')->name('estado-civil.store');
Route::put('editar-EstadoCivil/{id}','backend\EstadoCivilController@update')->name('estado-civil.update');
Route::delete('eliminar-EstadoCivil/{id}','backend\EstadoCivilController@destroy')->name('estado-civil.destroy');

Route::get('/cargos', 'backend\CargoController@index')->name('cargos');
Route::post('guardar-Cargo','backend\CargoController@store')->name('cargos.store');
Route::put('editar-Cargo/{id}','backend\CargoController@update')->name('cargos.update');
Route::delete('eliminar-Cargo/{id}','backend\CargoController@destroy')->name('cargos.destroy');

Route::get('/sucursales', 'backend\SucursalController@index')->name('sucursales');
Route::post('guardar-Sucursal','backend\SucursalController@store')->name('sucursales.store');
Route::put('editar-Sucursal/{id}','backend\SucursalController@update')->name('sucursales.update');
Route::delete('eliminar-Sucursal/{id}','backend\SucursalController@destroy')->name('sucursales.destroy');

Route::get('/depositos', 'backend\DepositoController@index')->name('depositos');
Route::post('guardar-Deposito','backend\DepositoController@store')->name('depositos.store');
Route::put('editar-Deposito/{id}','backend\DepositoController@update')->name('depositos.update');
Route::delete('eliminar-Deposito/{id}','backend\DepositoController@destroy')->name('depositos.destroy');

Route::get('/funcionarios', 'backend\FuncionarioController@index')->name('funcionarios');
Route::post('guardar-Funcionario','backend\FuncionarioController@store')->name('funcionarios.store');
Route::put('editar-Funcionario/{id}','backend\FuncionarioController@update')->name('funcionarios.update');
Route::put('cambiar-Funcionario/{id}','backend\FuncionarioController@cambiar')->name('funcionarios.destroy');

// FIN DE RUTAS DE EMPRESA



// RUTAS DE REFERENCIALES DE VENTAS
Route::get('/tarjetas', 'backend\TarjetaController@index')->name('tarjetas');
Route::post('guardar-Tarjeta','backend\TarjetaController@store')->name('tarjetas.store');
Route::put('editar-Tarjeta/{id}','backend\TarjetaController@update')->name('tarjetas.update');
Route::delete('eliminar-Tarjeta/{id}','backend\TarjetaController@destroy')->name('tarjetas.destroy');

Route::get('/marcatarjetas', 'backend\MarcaTarjetaController@index')->name('marcatarjetas');
Route::post('guardar-MarcaTarjeta','backend\MarcaTarjetaController@store')->name('marcatarjetas.store');
Route::put('editar-MarcaTarjeta/{id}','backend\MarcaTarjetaController@update')->name('marcatarjetas.update');
Route::delete('eliminar-MarcaTarjeta/{id}','backend\MarcaTarjetaController@destroy')->name('marcatarjetas.destroy');

Route::get('/tipomoneda', 'backend\TipoMonedaController@index')->name('tipomoneda');
Route::get('/tazaCambios', 'backend\TipoMonedaController@tazaCambios')->name('tipotazamoneda');
Route::post('guardar-TipoMoneda','backend\TipoMonedaController@store')->name('tipomoneda.store');
Route::put('editar-TipoMoneda/{id}','backend\TipoMonedaController@update')->name('tipomoneda.update');
Route::delete('eliminar-TipoMoneda/{id}','backend\TipoMonedaController@destroy')->name('tipomoneda.destroy');

Route::get('/timbrados', 'backend\TimbradoController@index')->name('timbrados');
Route::post('guardar-Timbrado','backend\TimbradoController@store')->name('timbrados.store');
Route::put('editar-Timbrado/{id}','backend\TimbradoController@update')->name('timbrados.update');
Route::delete('eliminar-Timbrado/{id}','backend\TimbradoController@destroy')->name('timbrados.destroy');

Route::get('/clientes', 'backend\ClienteController@index')->name('clientes');
Route::post('guardar-Cliente','backend\ClienteController@store')->name('clientes.store');
Route::put('editar-Cliente/{id}','backend\ClienteController@update')->name('clientes.update');
Route::put('cambiar-Cliente/{id}','backend\ClienteController@cambiar')->name('clientes.cambio');

Route::get('/tipoimpuestos', 'backend\TipoimpuestoController@index')->name('tipoimpuestos');
Route::post('guardar-Tipoimpuesto','backend\TipoimpuestoController@store')->name('tipoimpuestos.store');
Route::put('editar-Tipoimpuesto/{id}','backend\TipoimpuestoController@update')->name('tipoimpuestos.update');
Route::delete('eliminar-Tipoimpuesto/{id}','backend\TipoimpuestoController@destroy')->name('tipoimpuestos.destroy');


Route::get('/entidades', 'backend\EntidadController@index')->name('entidades');
Route::post('guardar-Entidad','backend\EntidadController@store')->name('entidades.store');
Route::put('editar-Entidad/{id}','backend\EntidadController@update')->name('entidades.update');
Route::delete('eliminar-Entidad/{id}','backend\EntidadController@destroy')->name('entidades.destroy');


Route::get('/tipomovimiento', 'backend\TipoMovimientoInventarioController@index')->name('tipomovimiento');
Route::post('guardar-tipomovimiento','backend\TipoMovimientoInventarioController@store')->name('tipomovimiento.store');
Route::put('editar-tipomovimiento/{id}','backend\TipoMovimientoInventarioController@update')->name('tipomovimiento.update');
Route::delete('eliminar-tipomovimiento/{id}','backend\TipoMovimientoInventarioController@destroy')->name('tipomovimiento.destroy');


Route::get('/tipoOperacion', 'backend\TipoOperacionInventarioController@index')->name('tipoOperacion');
Route::post('guardar-tipoOperacion','backend\TipoOperacionInventarioController@store')->name('tipoOperacion.store');
Route::put('editar-tipoOperacion/{id}','backend\TipoOperacionInventarioController@update')->name('tipoOperacion.update');
Route::delete('eliminar-tipoOperacion/{id}','backend\TipoOperacionInventarioController@destroy')->name('tipoOperacion.destroy');
// FIN DE RUTAS DE VENTAS

// RUTAS DE REFERENCIALES DE COMPRAS
Route::get('/proveedores', 'backend\ProveedorController@index')->name('proveedores');
Route::get('/proveedores/buscarProveedorId', 'backend\ProveedorController@buscarId')->name('proveedoresbuscar');
Route::get('/proveedores/buscarProveedorRuc', 'backend\ProveedorController@buscarRuc')->name('proveedoresbuscarruc');
Route::post('guardar-Proveedor','backend\ProveedorController@store')->name('proveedores.store');
Route::put('editar-Proveedor/{id}','backend\ProveedorController@update')->name('proveedores.update');
Route::put('cambiar-Proveedor/{id}','backend\ProveedorController@cambiar')->name('proveedores.cambiar');
// FIN DE RUTAS DE COMPRAS


// RUTAS MODULO MERCADERIA
Route::get('/productos/buscarArticulo', 'backend\ProductoController@buscarArticulo')->name('productos.buscar');
Route::get('/Productos-Modal', 'backend\ProductoController@ProductoModal')->name('productos.modal');
Route::get('/productos/buscarArticuloModal', 'backend\ProductoController@buscarArticuloModal')->name('productos.buscar');
Route::get('/productos', 'backend\ProductoController@index')->name('productos');
Route::post('guardar-Producto','backend\ProductoController@store')->name('productos.store');
Route::put('editar-Producto/{id}','backend\ProductoController@update')->name('productos.update');
Route::put('cambiar-Producto/{id}','backend\ProductoController@cambiar')->name('productos.cambiar');
Route::post('subir-Producto','backend\ProductoController@importar')->name('productos.importar');
Route::get('/carga-Producto', 'backend\ProductoController@carga')->name('carga.productos');
Route::get('/listar-stock', 'backend\ProductoController@listarstock')->name('listar.stock');
Route::post('guardar-stock','backend\ProductoController@stock')->name('stock.store');
Route::put('editar-Stock/{id}','backend\ProductoController@editarStock')->name('stock.update');
Route::put('cambiar-Stock/{id}','backend\ProductoController@cambiarstock')->name('stock.cambiar');

Route::get('/bloques', 'backend\BloqueController@index')->name('bloques');
Route::post('guardar-Bloque','backend\BloqueController@store')->name('bloques.store');
Route::put('editar-Bloque/{id}','backend\BloqueController@update')->name('bloques.update');
Route::delete('eliminar-Bloque/{id}','backend\BloqueController@destroy')->name('bloques.destroy');

Route::get('/categorias', 'backend\CategoriaController@index')->name('categorias');
Route::post('guardar-Categoria','backend\CategoriaController@store')->name('categorias.store');
Route::put('editar-Categoria/{id}','backend\CategoriaController@update')->name('categorias.update');
Route::delete('eliminar-Categoria/{id}','backend\CategoriaController@destroy')->name('categorias.destroy');

Route::get('/desglosar', 'backend\DesglosarController@index')->name('desglosar');
Route::post('guardar-Desglosar','backend\DesglosarController@store')->name('desglosar.store');
Route::put('editar-Desglosar/{id}','backend\DesglosarController@update')->name('desglosar.update');
Route::delete('eliminar-Desglosar/{id}','backend\DesglosarController@destroy')->name('desglosar.destroy');

// FIN DE RUTAS DE MODULO MERCADERIA 

//RUTAS PEDIDOS COMPRAS
Route::post('/agregar-pedido_compra','backend\PedidoCompraController@store')->name('pedido.store');
Route::get('/listar-PedidoCompras','backend\PedidoCompraController@index')->name('pedido.listar');
Route::get('/PedidoCompra/obtenerCabecera','backend\PedidoCompraController@VerCabecera')->name('vercabecera.listar');
Route::get('/PedidoCompra/obtenerDetalle','backend\PedidoCompraController@VerDetalle')->name('verdetalle.listar');
Route::put('/Anular-PedidoCompra/{id}','backend\PedidoCompraController@update')->name('pedido.anular');
Route::put('/Registrar-PedidoCompra/{id}','backend\PedidoCompraController@registrado')->name('pedido.registrado');
//FIN RUTAS PEDIDOS COMPRAS



//RUTAS ORDEN COMPRAS
Route::get('/OrdenCompras','backend\OrdenCompraController@index')->name('orden.listar');
Route::get('/OrdenComprasFactura','backend\OrdenCompraController@OrdenFacturaCompras')->name('orden.listar');
Route::get('/OrdenCompras/buscarOrden','backend\OrdenCompraController@index')->name('orden.listar');
Route::post('/agregar-orden_compra','backend\OrdenCompraController@store')->name('orden.store');
Route::get('/listar-Pedido-Orden','backend\OrdenCompraController@listarPedidoOrden')->name('orden.pedido.listar');
Route::get('/listar-Pedido-Detalle','backend\OrdenCompraController@listarPedidoOrdenDe')->name('orden.detalle.listar');
Route::get('/OrdenCompra/obtenerCabecera','backend\OrdenCompraController@VerCabecera')->name('vercabecera.listar');
Route::get('/OrdenCompra/obtenerDetalle','backend\OrdenCompraController@VerDetalle')->name('verdetalle.listar');
Route::put('/Anular-OrdenCompra/{id}','backend\OrdenCompraController@update')->name('orden.anular');
Route::put('/Aprobar-OrdenCompra/{id}','backend\OrdenCompraController@Aprobar')->name('orden.anular');
//FIN RUTAS ORDEN COMPRAS

//RUTAS PRESUPUESTO COMPRAS

Route::post('/agregar-presupuesto_compra','backend\PresupuestoCompraController@store')->name('presupuesto.store');
Route::put('/anular-presupuesto_compra/{id}','backend\PresupuestoCompraController@anular')->name('presupuestoanular.store');
Route::get('/listar-PresupuestoCompras','backend\PresupuestoCompraController@index')->name('presupuesto.listar');
Route::get('/PresupuestoCompra/obtenerCabecera','backend\PresupuestoCompraController@verCabecera')->name('vercabecera.listar');
Route::get('/PresupuestoCompra/obtenerDetalle','backend\PresupuestoCompraController@verDetalle')->name('verdetalle.listar');
Route::put('/PresupuestoCompra/Aprobar/{id}','backend\PresupuestoCompraController@aprobar')->name('aprobar.listar');
Route::get('/Presupuesto/editarDetalle','backend\PresupuestoCompraController@buscarDetalle')->name('buscar.detalle');
Route::put('editar-Presupuesto/{id}','backend\PresupuestoCompraController@update')->name('presupuesto.update');
//FIN RUTAS PRESUPUESTO COMPRAS
Route::get('/OrdenCompras/buscarOrden','backend\OrdenCompraController@buscarOrden')->name('orden.listar');
Route::get('/OrdenCompras/buscarOrdenDetalle','backend\OrdenCompraController@buscarOrdenDetalle')->name('orden.listardetalle');
Route::get('OrdenCompra/DetalleModal','backend\OrdenCompraController@buscarOrdenDetalle')->name('buscar.detalle');
////


//FIN RUTAS FACTURAS COMPRAS
Route::get('/FacturaCompra/obtenerCabecera','backend\FacturaComprasController@verCabecera')->name('vercabecera.listar');
Route::get('/FacturaCompra/obtenerDetalle','backend\FacturaComprasController@verDetalle')->name('verdetalle.listar');
Route::post('/factura_compras-agregar','backend\FacturaComprasController@store')->name('compra.store');
Route::post('/factura_compras-GuardarCuotas','backend\FacturaComprasController@guardarCuotas')->name('compra.guardarCuotas');
Route::get('/factura_compras-index','backend\FacturaComprasController@index')->name('compra.index');
Route::get('/listar-cuotaGenerada','backend\FacturaComprasController@listarCuotaGeneradas')->name('cuotas.index');
////

///TIPO COMPROBANTE 
Route::get('/tipocomprobante','backend\TipoComprobanteController@index')->name('tipocomprobante.listar');
/////////
// Route::any('{all}', function () { return view('/home');})->where(['all' => '.*']); 
Route::get('{path}', function() {
    return view('/home');
})->where('path', '.*');