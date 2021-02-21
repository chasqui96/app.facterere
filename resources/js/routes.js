import Vue from 'vue';
import Router from 'vue-router';
 
Vue.use(Router)

export default new Router({
    routes:[
     
        {  
            path: '/referenciales_empresa/personas',
            component: require('./components/referenciale_empresas/PersonaComponent').default,
            name:'personas'
        },
        {  
            path: '/referenciales_empresa/ciudades',
            component: require('./components/referenciale_empresas/CiudadComponent').default,
            name:'ciudad'
        },
        {  
            path: '/referenciales_empresa/nacionalidad',
            component: require('./components/referenciale_empresas/NacionalidadComponent').default,
            name:'nacionalidad'
        },
        {  
            path: '/referenciales_empresa/estadocivil',
            component: require('./components/referenciale_empresas/EstadoCivilComponent').default,
            name:'estadocivil'
        },
        {  
            path: '/referenciales_empresa/cargos',
            component: require('./components/referenciale_empresas/CargoComponent').default,
            name:'cargo'
        },
        {  
            path: '/referenciales_empresa/sucursales',
            component: require('./components/referenciale_empresas/SucursalComponent').default,
            name:'sucursal'
        },
        {  
            path: '/referenciales_empresa/funcionario',
            component: require('./components/referenciale_empresas/FuncionarioComponent').default,
            name:'funcionario'
        },
        {  
            path: '/referenciales_empresa/deposito',
            component: require('./components/referenciale_empresas/DepositoComponent').default,
            name:'deposito'
        },
        {  
            path: '/referenciales_empresa/proveedor',
            component: require('./components/referenciale_empresas/ProveedorComponent').default,
            name:'proveedor'
        },
        {  
            path: '/referenciales_empresa/tarjeta',
            component: require('./components/referenciale_empresas/TarjetaComponent').default,
            name:'tarjeta'
        },
        {  
            path: '/referenciales_empresa/marcatarjeta',
            component: require('./components/referenciale_empresas/MarcaTarjetaComponent').default,
            name:'marcatarjeta'
        },
        {  
            path: '/referenciales_empresa/timbrado',
            component: require('./components/referenciale_empresas/TimbradoComponent').default,
            name:'timbrado'
        },
        {  
            path: '/referenciales_empresa/cliente',
            component: require('./components/referenciale_empresas/ClienteComponent').default,
            name:'cliente'
        },
        {  
            path: '/referenciales_empresa/tipoimpuesto',
            component: require('./components/referenciale_empresas/TipoImpuestoComponent').default,
            name:'tipoimpuesto'
        },
        {  
            path: '/referenciales_empresa/entidade',
            component: require('./components/referenciale_empresas/EntidadeComponent').default,
            name:'entidade'
        },
        ,
        {  
            path: '/referenciales_empresa/tipo_moneda',
            component: require('./components/referenciale_empresas/TipoMoneda').default,
            name:'tipo_moneda'
        },
        // RUTAS DE PRODUCTO GENERALES
        {  
            path: '/modulo_producto/categoria',
            component: require('./components/productos_generales/CategoriaComponent').default,
            name:'categoria'
        },
        {  
            path: '/modulo_producto/bloque',
            component: require('./components/productos_generales/BloqueComponent').default,
            name:'bloque'
        },
        {  
            path: '/modulo_producto/desglosar',
            component: require('./components/productos_generales/UnidadMedidaComponent').default,
            name:'desglosamiento'
        },
        {  
            path: '/modulo_producto/productos',
            component: require('./components/productos_generales/ProductoComponent').default,
            name:'productos'
        },
        {  
            path: '/modulo_producto/stock_producto',
            component: require('./components/productos_generales/StockComponent').default,
            name:'alta_producto'
        },
        {  
            path: '/modulo_producto/bd_cargar_productos',
            component: require('./components/productos_generales/CargarProducto').default,
            name:'cargar_productos'
        },
        {  
            path: '/modulo_producto/tipo_operacion_inventario',
            component: require('./components/productos_generales/TipoOperacionInventario').default,
            name:'tipo_operacion_inventario'
        },
        {  
            path: '/modulo_producto/tipo_movimiento_inventario',
            component: require('./components/productos_generales/TipoMovimientoInventario').default,
            name:'tipo_movimiento_inventario'
        },
        {  
            path: '/modulo_producto/inventario',
            component: require('./components/productos_generales/InventarioComponent').default,
            name:'inventario'
        },
          // FIN DE RUTAS DE PRODUCTO GENERALES


          // RUTAS DE MODULO COMPRAS
        {  
            path: '/modulo_compra/pedido_compras',
            component: require('./components/modulo_compras/PedidoCompra').default,
            name:'pedido_compras'
        },
        {  
            path: '/modulo_compra/orden_compras',
            component: require('./components/modulo_compras/OrdenCompra').default,
            name:'orden_compras'
        },
        {  
            path: '/modulo_compra/presupuesto_compras',
            component: require('./components/modulo_compras/PresupuestoCompra').default,
            name:'presupuesto_compras'
        },
        {  
            path: '/modulo_compra/facturas_compras',
            component: require('./components/modulo_compras/FacturaCompra').default,
            name:'facturas_compras'
        }

          // FIN DE RUTAS DE MODULO COMPRAS
    ],
    mode: 'history'

})