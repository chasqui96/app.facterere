<template>
  <div class="row justify-content-md-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
             <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
              <li class="nav-item">
                <button
                  class="nav-link active btn-sm"
                  id="pills-home-tab-custom"
                  data-toggle="pill"
                  href="#pills-health"
                  role="tab"
                  aria-controls="pills-home"
                  aria-selected="true"
                >Agregar</button>
              </li>
              <li class="nav-item">
                <button
                  class="nav-link btn-sm"
                  id="pills-profile-tab-custom"
                  data-toggle="pill"
                  href="#pills-career"
                  role="tab"
                  aria-controls="pills-profile"
                  aria-selected="false"
                >Tabla</button>
              </li>
            </ul>
          <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom">
            <div
              class="tab-pane fade show active"
              id="pills-health"
              role="tabpanel"
              aria-labelledby="pills-home-tab-custom"
            >
              <!-- CODIGO BOTONES -->
              <!-- FIN CODIGO BOTONES -->
              <template v-if="modoEditar">
                   <!-- CODIGO BOTONES -->
                  <div class="btn-toolbar justify-content-md-center">
                    <div class="btn-group">
                      <button type="submit" class="btn btn-sm btn-outline-secondary" @click="cancelarVer">
                        <i class="mdi mdi-window-close  text-primary mr-1" ></i>Cancelar
                      </button>
                    </div>
                  </div>
                  <!-- FIN CODIGO BOTONES -->
        
                <div class="container-fluid d-flex justify-content-between">
                  <div class="col-lg-3 pl-0" v-for="(item, index) in verCabecera1" :key="index">
                    <p class="mt-5 mb-2">
                      <b>PEDIDO COMPRA NRO: {{item.numero_orden_compras}}</b>
                    </p>
                  </div>
                  <div class="col-lg-3 pr-0">
                    <p class="mt-5 mb-2 text-right">
                      <b>Cabecera</b>
                    </p>
                    <p class="text-right" v-for="(item, index) in verCabecera1" :key="index">
                      {{item.fecha_orden}}
                      <br />
                      {{item.fecha_plazo}},
                      <br />
                      {{item.sucursal_descripcion}}.
                    </p>
                  </div>
                </div>
                <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                  <div class="table-responsive w-100">
                    <table class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                          <th>CODIGO B.</th>
                          <th>DESCRIPCION</th>
                          <th class="text-right">CANTIDAD</th>
                          <th class="text-right">PRECIO</th>
                          <th class="text-right">EXENTA</th>
                          <th class="text-right">GRAV5</th>
                          <th class="text-right">GRAV10</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="text-right" v-for="(detalle,index) in verDetalle2" :key="index">
                          <td class="text-left">{{detalle.codigode_barra_items}}</td>
                          <td class="text-left">{{detalle.descripcion_items}}</td>
                          <td>{{detalle.orden_compras_detalles_cantidad || detalle.compras_orden_pedido_cantidad}}</td>
                          <td>{{detalle.orden_compras_detalles_precios || detalle.compras_orden_pedido_precio }}</td>
                          <td>{{detalle.exenta | formatNumber}}</td>
                          <td>{{detalle.grav5 | formatNumber }}</td>
                          <td>{{detalle.grav10 | formatNumber}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </template>
              <template v-else>
                <form class="forms-sample" @submit.prevent="agregar">
                  <!-- CODIGO BOTONES -->
                  <div class="btn-toolbar justify-content-md-center">
                    <div class="btn-group">
                      <button type="submit" class="btn btn-sm btn-outline-secondary">
                        <i class="mdi mdi-attachment text-primary mr-1"></i>Grabar
                      </button>
                      <button type="submit" class="btn btn-sm btn-outline-secondary">
                        <i class="mdi mdi-delete text-primary mr-1"></i>Delete
                      </button>
                    </div>
                  </div>
                  <!-- FIN CODIGO BOTONES -->
                  <!-- COMIENZO DE CODIGO CABECERA-->
                  <fieldset>
                    <legend>ORDEN COMPRAS</legend>
                    <div class="row p-3 text-center">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>NRO DE ORDEN</label>
                          <input
                            type="text"
                            class="form-control form-control-sm"
                            placeholder
                            disabled
                            v-model="siguiente_numero"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>ORDEN FECHA</label>
                          <input-mask
                            v-model="orden_compras.orden_fecha"
                            mask="99/99/9999"
                            class="form-control form-control-sm"
                          ></input-mask>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>ORDEN PLAZO</label>
                          <input-mask
                            v-model="orden_compras.orden_plazo"
                            mask="99/99/9999"
                            class="form-control form-control-sm"
                          ></input-mask>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>USUARIO</label>
                          <input type="hidden" />
                          <input
                            type="text"
                            class="form-control form-control-sm"
                            v-bind:value="`${user.nombre_usuario}`"
                            placeholder="Usuario"
                            disabled
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row p-3 text-center">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>PROVEEDORES O R. S.</label>
                          <b-form-select v-model="orden_compras.idproveedor" size="sm">
                            <option value="">--Seleccione--</option>
                            <option
                              v-for="(item, index) in proveedores"
                              :key="index"
                              v-bind:value="item.id_proveedor"
                            >{{item.personas_nombre_completo}}</option>
                          </b-form-select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>OBSERVACION</label>
                          <b-form-textarea
                            id="textarea-no-resize"
                            placeholder="Observaciones...."
                            rows="3"
                            no-resize
                            v-model="orden_compras.orden_observacion"
                          ></b-form-textarea>
                        </div>
                      </div>
                    </div>
                    <h5></h5>
                  </fieldset>
                  <!-- FIN DE CODIGO CABECERA-->

                  <!-- COMIENZO DE MESAJE ERROR VALIDACION -->
                  <div class="alert alert-danger alert-dismissible" v-show="errorPedido">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <b>Por favor corriga los siguientes errores:</b>
                    <ul>
                      <li v-for="error in errorMostrarMsjPedido" :key="error" v-text="error"></li>
                    </ul>
                  </div>
                  <!-- FIN DE MESAJE ERROR VALIDACION -->
                  <div id="cargando"></div>
                  <!-- COMIENZO CODIGO CARGA PRODUCTOS   -->

                  <fieldset>
                    <legend>Carga</legend>
                    <div>
                      <b-tabs
                        active-nav-item-class="font-weight-bold text-uppercase text-primary"
                        content-class="mt-3"
                      >
                        <b-tab title="Sin Pedido" active>
                          <template>
                            <div class="row p-3">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="exampleInputUsername1">Productos</label>
                                  <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                                    <input type="hidden" />
                                    <input
                                      class="form-control form-control-sm"
                                      type="search"
                                      @blur="onBlur"
                                      placeholder="Productos"
                                      v-model="descripcion"
                                      @keyup="autocomproducto();"
                                      autocomplete="off"
                                    />
                                    <div class="input-group-prepend">
                                      <b-button v-b-modal.modal-lg size="sm">
                                        <b-icon icon="search"></b-icon>
                                      </b-button>
                                    </div>
                                    <br />
                                  </div>
                                  <!-- AUTOCOMPLETADO LISTADO AQUI -->
                                  <b-list-group class="autocomplete mt-2" v-if="listar_">
                                    <b-list-group-item
                                      button
                                      v-for="(item, index) in buscar_articulo"
                                      :key="index"
                                      v-text="item.descripcion_items"
                                      v-bind:value="item.id_items"
                                      @mousedown="llenar(item)"
                                    ></b-list-group-item>
                                  </b-list-group>
                                  <!-- FIN  AUTOCOMPLETADO LISTADO AQUI -->
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label>PRECIO</label>
                                  <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    placeholder="Precio Pedido"
                                    v-model="producto_precio"
                                    disabled
                                  />
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label >
                                    CANTIDAD
                                    <span
                                      style="color: red;"
                                      v-show="producto_cantidad==0"
                                    >(*)</span>
                                  </label>
                                  <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    placeholder="Cantidad Pedido"
                                    v-model="producto_cantidad"
                                    @keypress.prevent.enter="agregarDetalleProducto()"
                                  />
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <b-button
                                    variant="primary"
                                    style="margin-top:30px;"
                                    @click.prevent="agregarDetalleProducto()"
                                  >
                                    <b-icon icon="plus-circle"></b-icon>
                                  </b-button>
                                </div>
                              </div>
                            </div>
                          </template>
                        </b-tab>
                        <b-tab title="Con Pedido">
                          <template>
                            <b-table
                              :items="items2"
                              :striped="striped"
                              :bordered="bordered"
                              :fields="fields"
                              :filter="filter"
                              :per-page="perPage"
                              :current-page="currentPage"
                              responsive
                              small
                            >
                              <template v-slot:cell(seleccionar)="{item}">
                                <b-button v-b-modal.modal-xl size="sm" @click="verPedido(item)">ver</b-button>
                              </template>
                              <template v-slot:cell(pedido_compras_estado)="{item}">
                                <b-badge
                                  pill
                                  :variant="getOrderStatusColor(item.pedido_compras_estado)"
                                >
                                  {{item.pedido_compras_estado}}
                                  <b-icon icon="arrow-counterclockwise"></b-icon>
                                </b-badge>
                              </template>
                              <template v-slot:cell(opciones)="row">
                                <b-button
                                  size="sm"
                                  variant="primary"
                                  @click="Registrar(row.item,row.index)"
                                >Registrado</b-button>
                              </template>
                            </b-table>
                            <div class="mt-3">
                              <h6>Paginas</h6>
                              <b-pagination
                                v-model="currentPage"
                                pills
                                :total-rows="rows"
                                :per-page="perPage"
                                aria-controls="my-table"
                              ></b-pagination>
                            </div>
                          </template>
                        </b-tab>
                        <b-tab title="Con Presupuesto">
                          <template>
                            <b-table
                              :items="items3"
                              :striped="striped"
                              :bordered="bordered"
                              :fields="fields4"
                              :filter="filter"
                              :per-page="perPage3"
                              :current-page="currentPage3"
                              responsive
                              small
                            >
                              <template v-slot:cell(presupuesto_estado)="{item}">
                                <b-badge
                                  pill
                                  :variant="getOrderStatusColorPre(item.presupuesto_estado)"
                                >
                                  {{item.presupuesto_estado}}
                                  <b-icon icon="arrow-counterclockwise"></b-icon>
                                </b-badge>
                              </template>
                              <template v-slot:cell(opciones)="row">
                                <b-button
                                  v-b-modal.modal-xls
                                  size="sm"
                                  @click="verPresupuesto(row.item)"
                                >ver</b-button>
                                <b-button
                                  size="sm"
                                  variant="primary"
                                  @click="Aprobar(row.item, row.index)"
                                >Aprobar</b-button>
                              </template>
                            </b-table>
                            <div class="mt-3">
                              <h6>Paginas</h6>
                              <b-pagination
                                v-model="currentPage3"
                                pills
                                :total-rows="rows3"
                                :per-page="perPage3"
                                aria-controls="my-table"
                              ></b-pagination>
                            </div>
                          </template>
                        </b-tab>
                      </b-tabs>
                    </div>
                  </fieldset>
                  <!-- FIN CODIGO CARGA PRODUCTOS   -->

                  <!-- COMIENZO CODIGO DETALLES   -->
                  <fieldset>
                    <legend>Detalle Pedido</legend>
                    <b-table-simple
                      small
                      bordered
                      sticky-header
                      outlined
                      responsive
                      hover
                      style="text-align:center"
                    >
                      <b-thead>
                        <b-tr>
                          <b-th></b-th>
                          <b-th>CODIGO</b-th>
                          <b-th>DESCRIPCION</b-th>
                          <b-th>CANTIDAD</b-th>
                          <b-th>PRECIO U.</b-th>
                          <b-th>EXENTA</b-th>
                          <b-th>GRAV. 5%</b-th>
                          <b-th>GRAV. 10%</b-th>
                          <b-th></b-th>
                        </b-tr>
                      </b-thead>
                      <b-tbody v-if="arrayDetalle.length">
                        <b-tr
                          v-for="(item, index) in arrayDetalle"
                          :key="index"
                          style="cursor:pointer;text-align:center;"
                        >
                          <input type="hidden" v-text="item.idpedidocompra" />
                          <b-td>
                             <b-icon icon="caret-right-fill"  @mousedown="editarCantidad(item)"></b-icon>
                          </b-td>
                          <b-td
                            v-text="item.producto_codigode_barra"
                          ></b-td>
                          <b-td v-text="item.producto_descripcion"></b-td>
                          <b-td>
                            <span v-if="!modoEditar2 && idproducto == item.id_items">
                              <b-form-input
                                type="number"
                                v-model="item.producto_cantidad"
                                class="form-control"
                                style="width:50px;heigth:20px;"
                                size="sm"
                                @keypress.enter="editarCantidad(item)"
                              ></b-form-input>
                            </span>
                            <span v-else>
                              <b-td v-text="item.producto_cantidad" class="span_detalle"></b-td>
                            </span>
                          </b-td>
                          <b-td>
                            <span v-if="!modoEditar2 && idproducto == item.id_items">
                              <b-form-input
                                type="number"
                                v-model="item.producto_precio"
                                class="form-control"
                                style="width:120px;heigth:20px;"
                                size="sm"
                                @keypress.enter="editarCantidad(item)"
                              ></b-form-input>
                            </span>
                            <span v-else>
                              <b-td v-text="item.producto_precio" class="span_detalle"></b-td>
                            </span>
                          </b-td>
                          <b-td
                            v-if="item.tipo_impuesto_descripcion === 'EXENTA'"
                          >{{item.producto_cantidad * item.producto_precio | formatNumber}}</b-td>
                          <b-td v-else>0</b-td>
                          <b-td
                            v-if="item.tipo_impuesto_descripcion === 'IVA 5%'"
                          >{{item.producto_cantidad * item.producto_precio | formatNumber}}</b-td>
                          <b-td v-else>0</b-td>
                          <b-td
                            v-if="item.tipo_impuesto_descripcion === 'IVA 10%'"
                          >{{item.producto_cantidad * item.producto_precio | formatNumber}}</b-td>
                          <b-td v-else>0</b-td>
                          <b-td>  <button v-on:click.prevent="borrarProducto(item,index)">x</button></b-td>
                          
                        </b-tr>
                      </b-tbody>
                      <b-tbody v-else>
                        <b-tr style="height:300px">
                          <b-td colspan="8">
                            <h5>NO HAY PRODUCTOS AGREGADOS</h5>
                          </b-td>
                        </b-tr>
                      </b-tbody>
                    </b-table-simple>
                    <b-table-simple small bordered>
                      <b-tr class="bg">
                        <b-th colspan="5">SUBTOTAL</b-th>
                        <b-th
                          class="text-right"
                          style="width:135px;font-family: 'Consolas', monospace;"
                        >{{calcularSubtotalExenta | formatNumber}}</b-th>
                        <b-th
                          class="text-right"
                          style="width:145px;font-family: 'Consolas', monospace;"
                        >{{calcularSubtotalGrav5 | formatNumber}}</b-th>
                        <b-th
                          class="text-right"
                          style="width:150px;font-family: 'Consolas', monospace;"
                        >{{calcularSubtotalGrav10 |formatNumber}}</b-th>
                      </b-tr>

                      <b-tr class="bg">
                        <b-th colspan="6">LIQUIDACION DE IVA 5% / 10%</b-th>
                        <b-th
                          class="text-right"
                          style="font-family: 'Consolas', monospace;"
                        >{{Iva5 | formatNumber}}</b-th>
                        <b-th
                          class="text-right"
                          style="font-family: 'Consolas', monospace;"
                        >{{Iva10 |formatNumber}}</b-th>
                      </b-tr>

                      <b-tr class="bg">
                        <b-th colspan="7">TOTAL DEL IVA</b-th>
                        <b-th
                          class="text-right"
                          style="font-family: 'Consolas', monospace;"
                        >{{Iva5+Iva10 |formatNumber}}</b-th>
                      </b-tr>

                      <b-tr bgcolor="lightblue">
                        <b-th colspan="7">TOTAL DEL GENERAL</b-th>
                        <b-th
                          class="text-right"
                          style="font-family: 'Consolas', monospace;"
                        >Gs. {{calcularSubtotalExenta + calcularSubtotalGrav5 + calcularSubtotalGrav10 | formatNumber}}</b-th>
                      </b-tr>
                    </b-table-simple>
                  </fieldset>
                  <!-- FIN CODIGO DETALLES   -->
                </form>
              </template>
              <!-- COMIENZO CODIGO MODAL PRODUCTO -->

              <b-modal id="modal-lg" size="lg" title="LISTA DE PRODUCTOS">
                <div class="row p-3">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Buscar Por</label>
                      <b-form-radio-group
                        v-model="selected"
                        :options="buscar_por"
                        class="mb-3"
                        value-field="item"
                        text-field="name"
                      ></b-form-radio-group>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Ingrese</label>
                      <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                        <input
                          class="typeahead"
                          type="search"
                          @keyup.enter="listarproductomodal(descripcion_modal,selected)"
                          placeholder="Productos"
                          v-model="descripcion_modal"
                          autocomplete="off"
                        />
                        <div class="input-group-prepend">
                          <b-button
                            v-b-modal.modal-lg
                            size="sm"
                            @click="listarproductomodal(descripcion_modal,selected)"
                          >
                            <b-icon icon="search"></b-icon>
                          </b-button>
                        </div>
                        <br />
                      </div>
                    </div>
                  </div>
                </div>
                <div>
                  <b-table
                    striped
                    small
                    :per-page="perPage2"
                    :current-page="currentPage2"
                    :fields="fields2"
                    :items="modal_Articulo"
                    bordered
                  >
                    <template v-slot:cell(id_items)="{item}">
                      <input type="checkbox" @click="agregarDetalleModalProducto(item)" />
                    </template>
                  </b-table>
                  <template>
                    <b-pagination
                      v-model="currentPage2"
                      :total-rows="rows2"
                      :per-page="perPage2"
                      aria-controls="my-table"
                    ></b-pagination>
                  </template>
                </div>
              </b-modal>

              <!-- FIN CODIGO MODAL -->

              <!-- COMIENZO CODIGO MODAL PEDIDO -->
              <b-modal id="modal-xl" size="xl" title="LISTA DE PEDIDOS">
                <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                  <div class="table-responsive w-100">
                    <table class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                          <th></th>
                          <th>CODIGO B.</th>
                          <th>DESCRIPCION</th>
                          <th class="text-right">CANTIDAD</th>
                          <th class="text-right">PRECIO</th>
                          <th class="text-right">EXENTA</th>
                          <th class="text-right">GRAV5</th>
                          <th class="text-right">GRAV10</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="text-right" v-for="(detalle,index) in verDetalle" :key="index">
                          <td class="text-left">
                            <input type="checkbox" @click="agregarDetalle(detalle)" />
                          </td>
                          <td class="text-left">{{detalle.codigode_barra_items}}</td>
                          <td class="text-left">{{detalle.descripcion_items}}</td>
                          <td>{{detalle.pedido_compras_detalles_cantidad}}</td>
                          <td>{{detalle.pedido_compras_detalles_precio}}</td>
                          <td>{{detalle.exenta | formatNumber}}</td>
                          <td>{{detalle.grav5 | formatNumber }}</td>
                          <td>{{detalle.grav10 | formatNumber}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </b-modal>
              <!-- FIN CODIGO MODAL -->

              <!-- COMIENZO CODIGO DE MODAL PRESUPUESTO-->
              <b-modal id="modal-xls" size="xl" title="LISTA DE PRESUPUESTO">
                <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                  <div class="table-responsive w-100">
                    <table class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                          <th></th>
                          <th>CODIGO B.</th>
                          <th>DESCRIPCION</th>
                          <th class="text-right">CANTIDAD</th>
                          <th class="text-right">PRECIO</th>
                          <th class="text-right">EXENTA</th>
                          <th class="text-right">GRAV5</th>
                          <th class="text-right">GRAV10</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          class="text-right"
                          v-for="(detalle,index) in verDetallePresupuesto"
                          :key="index"
                        >
                          <td class="text-left">
                            <input type="checkbox" @click="agregarDetalle(detalle)" />
                          </td>
                          <td class="text-left">{{detalle.codigode_barra_items}}</td>
                          <td class="text-left">{{detalle.descripcion_items}}</td>
                          <td>{{detalle.pedido_compras_detalles_cantidad}}</td>
                          <td>{{detalle.pedido_compras_detalles_precio}}</td>
                          <td>{{detalle.exenta | formatNumber}}</td>
                          <td>{{detalle.grav5 | formatNumber }}</td>
                          <td>{{detalle.grav10 | formatNumber}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </b-modal>
              <!--FIN CODIGO MODAL PREPUSESTO -->
            </div>
            <div
              class="tab-pane fade"
              id="pills-career"
              role="tabpanel"
              aria-labelledby="pills-profile-tab-custom"
            >
              <!-- COMIENZO DE LA TABLA -->
                <fieldset>
                  <legend>TABLA</legend>
                  <div class="col-lg-12">
                    <b-col lg="8" class="my-1">
                      <b-form-group
                        label="BUSCAR"
                        label-cols-sm="3"
                        label-align-sm="right"
                        label-size="sm"
                        label-for="filterInput"
                        class="mb-3"
                      >
                        <b-input-group size="sm">
                          <b-form-input
                            v-model="filter"
                            type="search"
                            id="filterInput"
                            placeholder="Filtrar"
                          ></b-form-input>
                          <b-input-group-append>
                            <b-button :disabled="!filter" @click="filter = ''">Borrar</b-button>
                          </b-input-group-append>
                        </b-input-group>
                      </b-form-group>
                    </b-col>

                    <b-table
                      id="my-table"
                      small
                      :items="items"
                      :striped="striped"
                      :bordered="bordered"
                      :fields="fields3"
                      :filter="filter"
                      :per-page="perPage"
                      :current-page="currentPage"
                      responsive
                    >
                      <template v-slot:cell(orden_compras_estado)="{item}">
                        <b-badge
                          pill
                          :variant="getOrderStatusColorOrden(item.orden_compras_estado)"
                        >
                          {{item.orden_compras_estado}}
                          <b-icon icon="arrow-counterclockwise"></b-icon>
                        </b-badge>
                      </template>
                      <template v-slot:cell(opciones)="row">
                        <b-button size="sm" @click="verOrden(row.item)" class="btn btn-warning">Ver</b-button>
                      </template>
                      <template v-slot:cell(operacion)="row">
                        <b-button
                          size="sm"
                          class="btn btn-secondary"
                          @click="AprobarOrden(row.item, row.index)"
                        >Aprobar</b-button>
                        <b-button
                          size="sm"
                          class="btn btn-danger"
                          @click="Anular(row.item, row.index)"
                        >Anular</b-button>
                      </template>
                    </b-table>
                    <div class="mt-3">
                      <h6>Paginas</h6>
                      <b-pagination
                        v-model="currentPage"
                        pills
                        :total-rows="rows1"
                        :per-page="perPage"
                        aria-controls="my-table"
                      ></b-pagination>
                    </div>
                  </div>
                </fieldset>
              <!-- FIN DE LA TABLA -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import InputMask from "vue-input-mask";
import swal from "sweetalert";
let user = document.head.querySelector('meta[name="user"]');
export default {
  components: {
    InputMask
  },
  data() {
    return {
      value: [],
      checked: false,
      idproducto: -1,
      modoEditar2: true,
      modoEditar: false,
      siguiente_numero: "",
      fixed: true,
      striped: true,
      bordered: true,
      filter: null,
      perPage: 3,
      perPage2: 6,
      perPage3: 6,
      currentPage: 1,
      currentPage2: 1,
      currentPage3: 1,
      errorPedido: 0,
      errorMostrarMsjPedido: [],
      items: [],
      items2: [],
      items3: [],
      proveedores: [],
      arrayDetalle: [],
      verDetalle: [],
      verDetalle2: [],
      verCabecera1: [],
      buscar_articulo: [],
      modal_Articulo: [],
      verDetallePresupuesto: [],
      buscar_por: [
        { item: "codigode_barra_producto", name: "Codigo de Barra" },
        { item: "descripcion_producto", name: "Descripcion" }
      ],
      orden_compras: {
        orden_numero: "",
        orden_fecha: "",
        orden_observacion: "S/N",
        orden_plazo: "",
        idproveedor: "",
        idusuario: "",
        idsucursal: ""
      },
      idpresupuesto: "0",
      listar_: false,
      producto_cantidad: 0,
      producto_cantidades: 0,
      producto_precio: 0,
      idpedidocompra: "",
      codigode_barra_producto: "",
      tipo_impuesto_descripcion: "",
      descripcion: "",
      descripcion_modal: "",
      selected: "codigode_barra_producto",
      props: ["pedido_compra"],
      fields: [
        { key: "seleccionar", label: "", class: "w-5px" },
        {
          key: "numero_compra",
          label: "Nro PEDIDO"
        },
        {
          key: "fecha_formater",
          label: "fecha"
        },

        {
          key: "sucursal_descripcion",
          label: "SUCURSAL"
        },
        {
          key: "pedido_compras_estado",
          label: "ESTADO"
        },
        {
          key: "opciones",
          label: "Opciones"
        }
      ],
      fields2: [
        {
          key: "id_items",
          label: "Opciones"
        },
        {
          key: "codigode_barra_items",
          label: "Codigo Barra",
          sortable: true
        },
        {
          key: "descripcion_items",
          label: "DESCRIPCION",
          sortable: true
        },
        {
          key: "desglosar_descripcion",
          label: "UNIDA M.",
          sortable: true
        },
        {
          key: "costo_items",
          label: "PRECIO COMPRA",
          sortable: true
        },
        {
          key: "estado_items",
          label: "ESTADO"
        }
      ],
      fields3: [
        { key: "opciones", label: "", class: "w-5px" },
        {
          key: "numero_orden_compras",
          label: "Nro ORDEN"
        },
        {
          key: "fecha_orden",
          label: "fecha"
        },

        {
          key: "fecha_plazo",
          label: "Valido Hasta"
        },
        {
          key: "orden_compras_estado",
          label: "ESTADO"
        },
        { key: "operacion", label: "", class: "w-5px" }
      ],
      fields4: [
        { key: "opciones", label: "", class: "w-5px" },
        {
          key: "numero_pre",
          label: "Nro Presupuesto"
        },
        {
          key: "fecha_pre",
          label: "Fecha Cargada"
        },

        {
          key: "fecha_plazo",
          label: "Fecha Plazo"
        },
        {
          key: "presupuesto_monto",
          label: "Presupuesto Monto"
        },
        {
          key: "presupuesto_estado",
          label: "ESTADO"
        }
      ]
    };
  },
  methods: {
    getOrderStatusColorOrden(orden_compras_estado) {
      if (orden_compras_estado === "PENDIENTE") return "secondary";
    },
    getOrderStatusColor(pedido_compras_estado) {
      if (pedido_compras_estado === "PENDIENTE") return "secondary";
    },
    getOrderStatusColorPre(presupuesto_estado) {
      if (presupuesto_estado === "PENDIENTE") return "secondary";
    },
    agregar() {
      if (this.validarPedido()) {
        return;
      }
      axios
        .post("/agregar-orden_compra", {
          orden_numero: this.orden_compras.orden_numero,
          orden_fecha: this.orden_compras.orden_fecha,
          orden_plazo: this.orden_compras.orden_plazo,
          orden_observacion: this.orden_compras.orden_observacion,
          idproveedor: this.orden_compras.idproveedor,
          idsucursal: this.orden_compras.idsucursal,
          idusuario: this.orden_compras.idusuario,
          idpresupuesto: this.idpresupuesto,
          datos: this.arrayDetalle
        })
        .then(response => {
          swal("Correcto!", "SE INSERTO CON EXITO", "success");
          this.listarOrdenCompras();
        })
        .catch(error => {
          console.log(error);
        });
      this.arrayDetalle = [];
      this.producto_cantidad = 0;
      this.producto_precio = 0;
      this.idproducto = 0;
      this.orden_compras.orden_fecha = "";
      this.orden_compras.orden_plazo = "";
      this.orden_compras.idproveedor = "";
    },
    autocomproducto() {
      var _this = this;
      var url = "/productos/buscarArticulo?filtro=" + _this.descripcion;
      axios(url)
        .then(response => {
          _this.buscar_articulo = response.data;
          _this.listar_ = true;
        })
        .catch(error => console.log(error));
    },
    llenar(item) {
      this.orden_compras.idproducto = item.id_items;
      this.descripcion = item.descripcion_items;
      this.producto_precio = item.costo_items;
      this.producto_cantidad = 1;
      this.codigode_barra_producto = item.codigode_barra_items;
      this.tipo_impuesto_descripcion = item.tipo_impuesto_descripcion;
    },
    Aprobar(item, index) {
      let me = this;
      me.orden_compras.idproveedor = item.id_proveedor;
      me.idpresupuesto = item.id_presupuesto;
      var data = [];
      //Obtener Detalles
      var url = "/PresupuestoCompra/obtenerDetalle?id=" + item.id_presupuesto;
      axios
        .get(url)
        .then(function(response) {
          data = response.data;
          if (me.encuentraPre(data["id_presupuesto"])) {
            swal({
              type: "error",
              title: "Error...",
              text: "Solo Puede Agregar un Presupuesto!"
            });
          } else {
            data.forEach(e => {
              me.arrayDetalle.push({
                id_items: e["id_items"],
                producto_codigode_barra: e["codigode_barra_items"],
                producto_descripcion: e["descripcion_items"],
                producto_cantidad:
                  e["presupuesto_cantidad"] || e["presupuesto_pedido_cantidad"],
                producto_precio:
                  e["presupuesto_precio"] || e["presupuesto_pedido_precio"],
                tipo_impuesto_descripcion: e["tipo_impuesto_descripcion"]
              });
            });
          }
        })
        .catch(function(error) {
          console.log(error);
        });

      axios
        .put(`/PresupuestoCompra/Aprobar/${item.id_presupuesto}`)
        .then(() => {
          this.items3.splice(index, 1);
          this.listarPresupuestoCompras();
        })
        .catch(error => console.log(error));
    },
    onBlur() {
      this.listar_ = false;
    },
    editarCantidad(item) {
      this.idproducto = item.id_items;
      this.producto_cantidades = item.producto_cantidad;
      this.producto_precio = item.producto_precio;
      this.modoEditar2 = !this.modoEditar2;
    },
    borrarProducto(item, index) {
      this.arrayDetalle.splice(index, 1);
    },
    listarOrdenCompras() {
      axios
        .get("/OrdenCompras")
        .then(res => {
          this.items = res.data;
          this.siguiente_numero = this.items[0]["siguiente_numero"];
        })
        .catch(error => console.log(error));
    },
    listarproductomodal() {
      var _this = this;
      var url =
        "/productos/buscarArticuloModal?filtro=" +
        _this.descripcion_modal +
        "&por=" +
        _this.selected;
      axios(url)
        .then(response => {
          _this.modal_Articulo = response.data;
        })
        .catch(error => console.log(error));
    },
    listarPedidoCompras() {
      axios
        .get("/listar-PedidoCompras")
        .then(res => {
          this.items2 = res.data;
        })
        .catch(error => console.log(error));
    },
    listarPresupuestoCompras() {
      axios
        .get("/listar-PresupuestoCompras")
        .then(res => {
          this.items3 = res.data;
        })
        .catch(error => console.log(error));
    },
    listarProveedores() {
      axios
        .get("/proveedores")
        .then(res => {
          this.proveedores = res.data;
        })
        .catch(error => console.log(error));
    },
    encuentra(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        if (this.arrayDetalle[i].id_items == id) {
          sw = true;
        }
      }
      return sw;
    },
    encuentraPre(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        if (this.arrayDetalle[i].id_presupuesto == id) {
          sw = true;
        }
      }
      return sw;
    },
    agregarDetalle(data = []) {
      let me = this;
      if (me.encuentra(data["id_items"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "Ese artículo ya se encuentra agregado!"
        });
      } else {
        me.arrayDetalle.push({
          id_items: data["id_items"],
          producto_codigode_barra: data["codigode_barra_items"],
          producto_descripcion: data["descripcion_items"],
          producto_cantidad: 1,
          producto_precio: data["costo_items"],
          tipo_impuesto_descripcion: data["tipo_impuesto_descripcion"],
          idpedidocompra: data["id_pedido_compras"]
        });
      }
      this.checked = true;
    },
    verPedido(item) {
      let me = this;
      //Obtener Detalles
      var url = "/PedidoCompra/obtenerDetalle?id=" + item.id_pedido_compras;
      axios
        .get(url)
        .then(function(response) {
          me.verDetalle = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    verPresupuesto(item) {
      let me = this;
      //Obtener Detalles
      var url = "/PresupuestoCompra/obtenerDetalle?id=" + item.id_presupuesto;
      axios
        .get(url)
        .then(function(response) {
          me.verDetallePresupuesto = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    agregarDetalleModalProducto(data = []) {
      let me = this;
      if (me.encuentra(data["id_items"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "Ese artículo ya se encuentra agregado!"
        });
      } else {
        me.arrayDetalle.push({
          id_items: data["id_items"],
          producto_codigode_barra: data["codigode_barra_items"],
          producto_descripcion: data["descripcion_items"],
          producto_cantidad: 1,
          producto_precio: data["costo_items"],
          tipo_impuesto_descripcion: data["tipo_impuesto_descripcion"]
        });
      }
    },
    agregarDetalleProducto() {
      let me = this;
      if (me.encuentra(me.orden_compras.idproducto)) {
        swal({
          type: "error",
          title: "Error...",
          text: "Ese artículo ya se encuentra agregado!"
        });
      } else {
        me.arrayDetalle.push({
          id_items: me.orden_compras.idproducto,
          producto_codigode_barra: me.codigode_barra_producto,
          producto_descripcion: me.descripcion,
          producto_cantidad: me.producto_cantidad,
          producto_precio: me.producto_precio,
          tipo_impuesto_descripcion: me.tipo_impuesto_descripcion
        });

        me.orden_compras.idproducto = 0;
        me.descripcion = "";
        me.producto_precio = 0;
        me.producto_cantidad = 0;
      }
    },
    validarPedido() {
      let me = this;
      me.errorPedido = 0;
      me.errorMostrarMsjPedido = [];

      if (me.orden_compras.orden_fecha == "")
        me.errorMostrarMsjPedido.push("Ingrese La Fecha");
      if (me.orden_compras.orden_plazo == "")
        me.errorMostrarMsjPedido.push("Ingrese el Plazo");
      if (me.orden_compras.idproveedor == "")
        me.errorMostrarMsjPedido.push("Ingrese el Proveedor");
      if (me.arrayDetalle.length <= 0)
        me.errorMostrarMsjPedido.push("Ingrese detalles");
      if (me.errorMostrarMsjPedido.length) me.errorPedido = 1;

      return me.errorPedido;
    },
    Registrar(item, index) {
      swal({
        title: "YA REGISTRO TODO?",
        text: "Si Registra ya no vera en la Grilla!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          axios
            .put(`/Registrar-PedidoCompra/${item.id_pedido_compras}`)
            .then(() => {
              this.items2.splice(index, 1);
              this.listarPedidoCompras();
            });
          swal("El Proceso Culmino Correctamente!", {
            icon: "success"
          });
        } else {
          swal("El proceso fue Cancelado!");
        }
      });
    },
    verOrden(item) {
      let me = this;
      me.modoEditar = true;
      //Obtener Cabecera

      var url = "/OrdenCompra/obtenerCabecera?id=" + item.id_orden_compras;

      axios
        .get(url)
        .then(function(response) {
          me.verCabecera1 = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });

      //Obtener Detalles
      var url = "/OrdenCompra/obtenerDetalle?id=" + item.id_orden_compras;
      axios
        .get(url)
        .then(function(response) {
          me.verDetalle2 = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });

      document.getElementById("pills-home-tab-custom").click();
    },
    Anular(item, index) {
      swal({
        title: "Desea Anular ?",
        text: "Se anulara esta Fila!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          axios.put(`/Anular-OrdenCompra/${item.id_orden_compras}`).then(() => {
            this.items.splice(index, 1);
            this.listarOrdenCompras();
          });
          swal("se ah Anulado correctamente", {
            icon: "success"
          });
        } else {
          swal("La operacion fue Cancelada!");
        }
      });
    },
    AprobarOrden(item, index) {
      swal({
        title: "Desea Aprobar ?",
        text: "Se Aprobara su Orden!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          axios
            .put(`/Aprobar-OrdenCompra/${item.id_orden_compras}`)
            .then(() => {
              this.items.splice(index, 1);
              this.listarOrdenCompras();
            });
          swal("Usted Aprobo la Orden De Compra..", {
            icon: "success"
          });
        } else {
          swal("La operacion fue Cancelada!");
        }
      });
    },
    cancelarVer() {
      this.modoEditar = false;
      this.verCabecera1 = [];
      this.verDetalle2 = [];
    }
  },
  computed: {
    state() {
      return this.value.length === this.arrayDetalle.id_items;
    },
    user() {
      return JSON.parse(user.content);
    },
    rows() {
      return this.items2.length;
    },
    rows1() {
      return this.items.length;
    },
    rows2() {
      return this.modal_Articulo.length;
    },
    rows3() {
      return this.items3.length;
    },
    calcularSubtotalExenta() {
      var exenta = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        if (this.arrayDetalle[i].tipo_impuesto_descripcion === "EXENTA") {
          exenta =
            exenta +
            this.arrayDetalle[i].producto_precio *
              this.arrayDetalle[i].producto_cantidad;
        }
      }
      return exenta;
    },
    calcularSubtotalGrav5() {
      var grav5 = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        if (this.arrayDetalle[i].tipo_impuesto_descripcion === "IVA 5%") {
          grav5 =
            grav5 +
            this.arrayDetalle[i].producto_precio *
              this.arrayDetalle[i].producto_cantidad;
        }
      }
      return grav5;
    },
    calcularSubtotalGrav10() {
      var grav10 = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        if (this.arrayDetalle[i].tipo_impuesto_descripcion === "IVA 10%") {
          grav10 =
            grav10 +
            this.arrayDetalle[i].producto_precio *
              this.arrayDetalle[i].producto_cantidad;
        }
      }
      return grav10;
    },
    Iva5() {
      var grav5 = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        if (this.arrayDetalle[i].tipo_impuesto_descripcion === "IVA 5%") {
          grav5 =
            grav5 +
            Math.round(
              (this.arrayDetalle[i].producto_precio *
                this.arrayDetalle[i].producto_cantidad) /
                21
            );
        }
      }
      return grav5;
    },
    Iva10() {
      var grav10 = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        if (this.arrayDetalle[i].tipo_impuesto_descripcion === "IVA 10%") {
          grav10 =
            grav10 +
            Math.round(
              (this.arrayDetalle[i].producto_precio *
                this.arrayDetalle[i].producto_cantidad) /
                11
            );
        }
      }
      return grav10;
    }
  },
  created() {
    var me = this;
    me.listarPedidoCompras();
    me.listarProveedores();
    me.listarOrdenCompras();
    me.listarPresupuestoCompras();
  },
  mounted() {
    let me = this;
    me.orden_compras.idusuario = me.$attrs.pedido_compra.id_usuarios;
    me.orden_compras.idsucursal = me.$attrs.pedido_compra.id_sucursal;
  }
};
</script>

<style scoped>
.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
}
span .span_detalle {
  border: none;
}
.fixed-plugin {
  position: fixed;
  top: 115px;
  right: 0;
  width: 70px;
  background: rgba(0, 0, 0, 0.3);
  z-index: 1031;
  border-radius: 8px 0 0 8px;
  text-align: center;
}
.fixed-plugin2 {
  position: fixed;
  top: 130px;
  left: 0;
  width: 64px;
  background: rgba(0, 0, 0, 0.3);
  z-index: 1031;
  border-radius: 0px 8px 8px 0px;
  text-align: center;
}
.fixed-plugin3 {
  position: fixed;
  top: 250px;
  left: 0;
  width: 64px;
  background: rgba(0, 0, 0, 0.3);
  z-index: 1031;
  border-radius: 0px 8px 8px 0px;
  text-align: center;
}
.fixed-plugin4 {
  position: fixed;
  top: 220px;
  right: 0;
  width: 66px;
  background: rgba(0, 0, 0, 0.3);
  z-index: 1031;
  border-radius: 8px 0 0 8px;
  text-align: center;
}
fieldset {
  border: 1px solid black !important;
  margin: 5px;
  min-width: 0;
  padding: 10px;
  position: relative;
  border-radius: 4px;
  background-color: #fffdfd;
  padding-left: 10px !important;
}

legend {
  font-size: 14px;
  font-weight: bold;
  margin-bottom: 0px;
  width: 35%;
  height: 5%;
  border: 1px solid black;
  border-radius: 4px;
  padding: 5px 5px 5px 10px;
  background-color: #ffffff;
}
</style>