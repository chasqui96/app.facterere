<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <ul
            class="nav nav-pills nav-pills-success justify-content-md-center"
            id="pills-tab"
            role="tablist"
          >
            <li class="nav-item">
              <button
                type="button"
                class="btn btn-outline-primary btn-fw"
                id="pills-home-tab-custom"
                data-toggle="pill"
                href="#pills-health"
                role="tab"
                aria-controls="pills-contact"
                aria-selected="true"
              >
                <i class="mdi mdi-format-list-bulleted text-primary mr-1"></i>
                TABLA
              </button>
            </li>
            <li class="nav-item">
              <button
                type="button"
                class="btn btn-outline-primary btn-fw"
                id="pills-profile-tab-custom"
                data-toggle="pill"
                href="#pills-career"
                role="tab"
                aria-controls="pills-profile"
                aria-selected="false"
              >
                <i class="mdi mdi-account-plus text-primary mr-1"></i>NUEVO
              </button>
            </li>
            <li class="nav-item">
              <button
                type="button"
                id="Btn-verDetalle"
                class="btn btn-outline-primary btn-fw detallePresupuesto"
                @click="verPresupuesto()"
                v-b-modal.modal-presupuesto
                disabled
              >
                <i class="mdi mdi-format-indent-increase text-primary mr-1"></i
                >VER DETALLES
              </button>
            </li>
            <li class="nav-item">
              <button
                type="button"
                class="btn btn-outline-primary btn-fw editarPresupuesto"
                id="Btn-editar"
                @click="seleccionarEditar"
                disabled
              >
                <i class="mdi mdi-attachment text-primary mr-1"></i>EDITAR
              </button>
            </li>
            <li class="nav-item">
              <button
                type="button"
                id="Btn-anular"
                class="btn btn-outline-primary btn-fw anularPresupuesto"
                @click="Anular()"
                disabled
              >
                <i class="mdi mdi-delete text-primary mr-1"></i>ANULAR
              </button>
            </li>
            <li class="nav-item">
              <button
                type="button"
                class="btn btn-outline-primary btn-fw"
                id="Btn-cancelar"
                @click="unselectThirdRow"
                disabled
              >
                <i class="mdi mdi-delete text-primary mr-1"></i>CANCELAR
              </button>
            </li>
          </ul>
          <div
            class="tab-content tab-content-custom-pill"
            id="pills-tabContent-custom"
          >
            <div
              class="tab-pane fade show active"
              id="pills-health"
              role="tabpanel"
              aria-labelledby="pills-home-tab-custom"
            >
              <!-- COMIENZO DE LA TABLA -->

              <fieldset>
                <legend>TABLA</legend>
                <div class="col-lg-12">
                  <b-col lg="4" class="my-1">
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
                          <b-button :disabled="!filter" @click="filter = ''"
                            >Borrar</b-button
                          >
                        </b-input-group-append>
                      </b-input-group>
                    </b-form-group>
                  </b-col>

                  <b-table
                    ref="selectableTable"
                    selectable
                    select-mode="single"
                    :items="items"
                    :fields="fields3"
                    :filter="filter"
                    :per-page="perPage"
                    :current-page="currentPage"
                    :bordered="bordered"
                    sticky-header
                    small
                    responsive
                    selected-variant="success"
                    @row-selected="onRowSelected"
                  >
                    <template v-slot:cell(selected)="{ rowSelected }">
                      <template v-if="rowSelected">
                        <span aria-hidden="true">&check;</span>
                        <span class="sr-only"></span>
                      </template>
                      <template v-else>
                        <span aria-hidden="true">
                          <b-icon icon="caret-right-fill"></b-icon>
                        </span>
                        <span class="sr-only"></span>
                        <input type="hidden" @click="unselectThirdRow" />
                      </template>
                    </template>
                    <template v-slot:cell(presupuesto_estado)="{ item }">
                      <b-badge
                        pill
                        :variant="
                          getOrderStatusColorPre(item.presupuesto_estado)
                        "
                      >
                        {{ item.presupuesto_estado }}
                        <b-icon icon="arrow-counterclockwise"></b-icon>
                      </b-badge>
                    </template>
                    <template v-slot:cell(presupuesto_monto)="{ item }">{{
                      item.presupuesto_monto
                        | currency("", 0, { thousandsSeparator: "." })
                    }}</template>
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
                </div>
              </fieldset>

              <!-- FIN DE LA TABLA -->
            </div>
            <div
              class="tab-pane fade"
              id="pills-career"
              role="tabpanel"
              aria-labelledby="pills-profile-tab-custom"
            >
              <!-- FORMULARIO EDITAR -->
              <template v-if="modoEditar2">
                <form
                  class="forms-sample"
                  @submit.prevent="editarDatos(presupuesto)"
                >
                  <!-- COMIENZO DE CODIGO CABECERA-->
                  <fieldset>
                    <legend>PRESUPUESTO COMPRAS</legend>
                    <div class="row p-3 text-center">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputUsername1"
                            >NRO DE PRESUPUESTO</label
                          >
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
                          <label for="exampleInputUsername1"
                            >PRESUPUESTO FECHA</label
                          >
                          <Calendar
                            id="spanish"
                            v-model="presupuesto.presupuesto_fecha"
                            :minDate="minDate"
                            :maxDate="maxDate"
                            :locale="es"
                            dateFormat="dd/mm/yy"
                            class="p-inputtext-sm"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputUsername1"
                            >PRESUPUESTO PLAZO</label
                          >
                          <Calendar
                            id="spanish"
                            v-model="presupuesto.presupuesto_plazo"
                            :minDate="minDate"
                            :maxDate="maxDate"
                            :locale="es"
                            dateFormat="dd/mm/yy"
                          
                            class="p-inputtext-sm"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputUsername1">USUARIO</label>
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
                          <label for="exampleInputUsername1">PROVEEDORES</label>
                          <b-form-select
                            v-model="presupuesto.idproveedor"
                            size="sm"
                          >
                            <option value>--Seleccione--</option>
                            <option
                              v-for="(item, index) in proveedores"
                              :key="index"
                              v-bind:value="item.id_proveedor"
                            >
                              {{ item.personas_nombre_completo }}
                            </option>
                          </b-form-select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputUsername1">OBSERVACION</label>
                          <b-form-textarea
                            id="textarea-no-resize"
                            placeholder="Observaciones...."
                            rows="3"
                            no-resize
                            v-model="presupuesto.presupuesto_observacion"
                          ></b-form-textarea>
                        </div>
                      </div>
                    </div>
                    <h5></h5>
                  </fieldset>
                  <!-- FIN DE CODIGO CABECERA-->

                  <!-- COMIENZO DE MESAJE ERROR VALIDACION -->
                  <div
                    class="alert alert-danger alert-dismissible"
                    v-show="errorPedido"
                  >
                    <a
                      href="#"
                      class="close"
                      data-dismiss="alert"
                      aria-label="close"
                      >&times;</a
                    >
                    <b>Por favor corriga los siguientes errores:</b>
                    <ul>
                      <li
                        v-for="error in errorMostrarMsjPedido"
                        :key="error"
                        v-text="error"
                      ></li>
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
                                  <label for="exampleInputUsername1"
                                    >Productos</label
                                  >
                                  <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                                    <input type="hidden" />
                                    <input
                                      class="typeahead form-control-sm"
                                      type="search"
                                      @blur="onBlur"
                                      placeholder="Productos"
                                      v-model="descripcion"
                                      @keyup="autocomproducto()"
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
                                  <b-list-group
                                    class="autocomplete mt-2"
                                    v-if="listar_"
                                  >
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
                                  <label for="exampleInputUsername1"
                                    >PRECIO</label
                                  >
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
                                  <label for="exampleInputUsername1">
                                    CANTIDAD
                                    <span
                                      style="color: red"
                                      v-show="producto_cantidad == 0"
                                      >(*)</span
                                    >
                                  </label>
                                  <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    placeholder="Cantidad Pedido"
                                    v-model="producto_cantidad"
                                    @keyup.enter="agregarDetalleProducto()"
                                  />
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <b-button
                                    variant="primary"
                                    style="margin-top: 30px"
                                    @click="agregarDetalleProducto()"
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
                              <template v-slot:cell(seleccionar)="{ item }">
                                <b-button
                                  v-b-modal.modal-xl
                                  size="sm"
                                  @click="verPedido(item)"
                                  >ver</b-button
                                >
                              </template>
                              <template
                                v-slot:cell(pedido_compras_estado)="{ item }"
                              >
                                <b-badge
                                  pill
                                  :variant="
                                    getOrderStatusColor(
                                      item.pedido_compras_estado
                                    )
                                  "
                                >
                                  {{ item.pedido_compras_estado }}
                                  <b-icon
                                    icon="arrow-counterclockwise"
                                  ></b-icon>
                                </b-badge> </template
                              >>
                              <template v-slot:cell(opciones)="row">
                                <b-button
                                  size="sm"
                                  variant="primary"
                                  @click="Registrar(row.item, row.index)"
                                  >Registrado</b-button
                                >
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
                      style="text-align: center"
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
                          style="cursor: pointer; text-align: center"
                        >
                          <input type="hidden" v-text="item.idpedidocompra" />
                          <b-td>
                            <b-icon
                              icon="caret-right-fill"
                              @mousedown="editarCantidad(item)"
                            ></b-icon>
                          </b-td>
                          <b-td v-text="item.producto_codigode_barra"></b-td>
                          <b-td v-text="item.producto_descripcion"></b-td>
                          <b-td>
                            <span
                              v-if="!modoEditar2 && idproducto == item.id_items"
                            >
                              <b-form-input
                                type="number"
                                v-model="item.producto_cantidad"
                                class="form-control"
                                style="width: 50px; heigth: 20px"
                                size="sm"
                                @keypress.enter="editarCantidad(item)"
                              ></b-form-input>
                            </span>
                            <span v-else>
                              <b-td
                                v-text="item.producto_cantidad"
                                class="span_detalle"
                              ></b-td>
                            </span>
                          </b-td>
                          <b-td>
                            <span
                              v-if="!modoEditar2 && idproducto == item.id_items"
                            >
                              <b-form-input
                                type="number"
                                v-model="item.producto_precio"
                                class="form-control"
                                style="width: 120px; heigth: 20px"
                                size="sm"
                                @keypress.enter="editarCantidad(item)"
                              ></b-form-input>
                            </span>
                            <span v-else>
                              <b-td
                                v-text="item.producto_precio"
                                class="span_detalle"
                              ></b-td>
                            </span>
                          </b-td>
                          <b-td
                            v-if="item.tipo_impuesto_descripcion === 'EXENTA'"
                            >{{
                              (item.producto_cantidad * item.producto_precio)
                                | formatNumber
                            }}</b-td
                          >
                          <b-td v-else>0</b-td>
                          <b-td
                            v-if="item.tipo_impuesto_descripcion === 'IVA 5%'"
                            >{{
                              (item.producto_cantidad * item.producto_precio)
                                | formatNumber
                            }}</b-td
                          >
                          <b-td v-else>0</b-td>
                          <b-td
                            v-if="item.tipo_impuesto_descripcion === 'IVA 10%'"
                            >{{
                              (item.producto_cantidad * item.producto_precio)
                                | formatNumber
                            }}</b-td
                          >
                          <b-td v-else>0</b-td>
                          <b-td>
                            <button
                              v-on:click.prevent="borrarProducto(item, index)"
                            >
                              x
                            </button>
                          </b-td>
                        </b-tr>
                      </b-tbody>
                      <b-tbody v-else>
                        <b-tr style="height: 300px">
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
                          style="
                            width: 135px;
                            font-family: 'Consolas', monospace;
                          "
                          >{{ calcularSubtotalExenta | formatNumber }}</b-th
                        >
                        <b-th
                          class="text-right"
                          style="
                            width: 145px;
                            font-family: 'Consolas', monospace;
                          "
                          >{{ calcularSubtotalGrav5 | formatNumber }}</b-th
                        >
                        <b-th
                          class="text-right"
                          style="
                            width: 150px;
                            font-family: 'Consolas', monospace;
                          "
                          >{{ calcularSubtotalGrav10 | formatNumber }}</b-th
                        >
                      </b-tr>

                      <b-tr class="bg">
                        <b-th colspan="6">LIQUIDACION DE IVA 5% / 10%</b-th>
                        <b-th
                          class="text-right"
                          style="font-family: 'Consolas', monospace"
                          >{{ Iva5 | formatNumber }}</b-th
                        >
                        <b-th
                          class="text-right"
                          style="font-family: 'Consolas', monospace"
                          >{{ Iva10 | formatNumber }}</b-th
                        >
                      </b-tr>

                      <b-tr class="bg">
                        <b-th colspan="7">TOTAL DEL IVA</b-th>
                        <b-th
                          class="text-right"
                          style="font-family: 'Consolas', monospace"
                          >{{ (Iva5 + Iva10) | formatNumber }}</b-th
                        >
                      </b-tr>

                      <b-tr bgcolor="lightblue">
                        <b-th colspan="7">TOTAL DEL GENERAL</b-th>
                        <b-th
                          class="text-right"
                          style="font-family: 'Consolas', monospace"
                          >Gs. {{ totalgeneral | formatNumber }}</b-th
                        >
                      </b-tr>
                    </b-table-simple>
                  </fieldset>
                  <!-- FIN CODIGO DETALLES   -->
                  <button type="submit">EDITAR</button>
               
                </form>
              </template>
              <!-- FIN FORMULARIO EDITAR -->

              <!-- FORMULARIO AGREGAR -->

              <template v-else>
                <form class="forms-sample" @submit.prevent="agregar">
                  <!-- COMIENZO DE CODIGO CABECERA-->
                  <fieldset>
                    <legend>PRESUPUESTO COMPRAS</legend>
                    <div class="row p-3 text-center">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputUsername1"
                            >NRO DE PRESUPUESTO</label
                          >
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
                          <label for="exampleInputUsername1"
                            >PRESUPUESTO FECHA</label
                          >
                          <Calendar
                            id="spanish"
                            v-model="presupuesto.presupuesto_fecha"
                            :minDate="minDate"
                            :maxDate="maxDate"
                            :locale="es"
                            dateFormat="dd/mm/yy"
                            :manualInput="true"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputUsername1"
                            >PRESUPUESTO PLAZO</label
                          >
                          <Calendar
                            id="spanish"
                            v-model="presupuesto.presupuesto_plazo"
                            :minDate="minDate"
                            :maxDate="maxDate"
                            :locale="es"
                            dateFormat="dd/mm/yy"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputUsername1">USUARIO</label>
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
                          <label for="exampleInputUsername1">PROVEEDORES</label>
                          <b-form-select
                            v-model="presupuesto.idproveedor"
                            size="sm"
                          >
                            <option value>--Seleccione--</option>
                            <option
                              v-for="(item, index) in proveedores"
                              :key="index"
                              v-bind:value="item.id_proveedor"
                            >
                              {{ item.personas_nombre_completo }}
                            </option>
                          </b-form-select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputUsername1">OBSERVACION</label>
                          <b-form-textarea
                            id="textarea-no-resize"
                            placeholder="Observaciones...."
                            rows="3"
                            no-resize
                            v-model="presupuesto.presupuesto_observacion"
                          ></b-form-textarea>
                        </div>
                      </div>
                    </div>
                    <h5></h5>
                  </fieldset>
                  <!-- FIN DE CODIGO CABECERA-->

                  <!-- COMIENZO DE MESAJE ERROR VALIDACION -->
                  <div
                    class="alert alert-danger alert-dismissible"
                    v-show="errorPedido"
                  >
                    <a
                      href="#"
                      class="close"
                      data-dismiss="alert"
                      aria-label="close"
                      >&times;</a
                    >
                    <b>Por favor corriga los siguientes errores:</b>
                    <ul>
                      <li
                        v-for="error in errorMostrarMsjPedido"
                        :key="error"
                        v-text="error"
                      ></li>
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
                                  <label for="exampleInputUsername1"
                                    >Productos</label
                                  >
                                  <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                                    <input type="hidden" />
                                    <input
                                      class="typeahead form-control-sm"
                                      type="search"
                                      @blur="onBlur"
                                      placeholder="Productos"
                                      v-model="descripcion"
                                      @keyup="autocomproducto()"
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
                                  <b-list-group
                                    class="autocomplete mt-2"
                                    v-if="listar_"
                                  >
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
                                  <label for="exampleInputUsername1"
                                    >PRECIO</label
                                  >
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
                                  <label for="exampleInputUsername1">
                                    CANTIDAD
                                    <span
                                      style="color: red"
                                      v-show="producto_cantidad == 0"
                                      >(*)</span
                                    >
                                  </label>
                                  <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    placeholder="Cantidad Pedido"
                                    v-model="producto_cantidad"
                                    @keyup.enter="agregarDetalleProducto()"
                                  />
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <b-button
                                    variant="primary"
                                    style="margin-top: 30px"
                                    @click="agregarDetalleProducto()"
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
                              <template v-slot:cell(seleccionar)="{ item }">
                                <b-button
                                  v-b-modal.modal-xl
                                  size="sm"
                                  @click="verPedido(item)"
                                  >ver</b-button
                                >
                              </template>
                              <template
                                v-slot:cell(pedido_compras_estado)="{ item }"
                              >
                                <b-badge
                                  pill
                                  :variant="
                                    getOrderStatusColor(
                                      item.pedido_compras_estado
                                    )
                                  "
                                >
                                  {{ item.pedido_compras_estado }}
                                  <b-icon
                                    icon="arrow-counterclockwise"
                                  ></b-icon>
                                </b-badge> </template
                              >>
                              <template v-slot:cell(opciones)="row">
                                <b-button
                                  size="sm"
                                  variant="primary"
                                  @click="Registrar(row.item, row.index)"
                                  >Registrado</b-button
                                >
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
                      style="text-align: center"
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
                          style="cursor: pointer; text-align: center"
                        >
                          <input type="hidden" v-text="item.idpedidocompra" />
                          <b-td>
                            <b-icon
                              icon="caret-right-fill"
                              @mousedown="editarCantidad(item)"
                            ></b-icon>
                          </b-td>
                          <b-td v-text="item.producto_codigode_barra"></b-td>
                          <b-td v-text="item.producto_descripcion"></b-td>
                          <b-td>
                            <span
                              v-if="!modoEditar2 && idproducto == item.id_items"
                            >
                              <b-form-input
                                type="number"
                                v-model="item.producto_cantidad"
                                class="form-control"
                                style="width: 50px; heigth: 20px"
                                size="sm"
                                @keypress.enter="editarCantidad(item)"
                              ></b-form-input>
                            </span>
                            <span v-else>
                              <b-td
                                v-text="item.producto_cantidad"
                                class="span_detalle"
                              ></b-td>
                            </span>
                          </b-td>
                          <b-td>
                            <span
                              v-if="!modoEditar2 && idproducto == item.id_items"
                            >
                              <b-form-input
                                type="number"
                                v-model="item.producto_precio"
                                class="form-control"
                                style="width: 120px; heigth: 20px"
                                size="sm"
                                @keypress.enter="editarCantidad(item)"
                              ></b-form-input>
                            </span>
                            <span v-else>
                              <b-td
                                v-text="item.producto_precio"
                                class="span_detalle"
                              ></b-td>
                            </span>
                          </b-td>
                          <b-td
                            v-if="item.tipo_impuesto_descripcion === 'EXENTA'"
                            >{{
                              (item.producto_cantidad * item.producto_precio)
                                | formatNumber
                            }}</b-td
                          >
                          <b-td v-else>0</b-td>
                          <b-td
                            v-if="item.tipo_impuesto_descripcion === 'IVA 5%'"
                            >{{
                              (item.producto_cantidad * item.producto_precio)
                                | formatNumber
                            }}</b-td
                          >
                          <b-td v-else>0</b-td>
                          <b-td
                            v-if="item.tipo_impuesto_descripcion === 'IVA 10%'"
                            >{{
                              (item.producto_cantidad * item.producto_precio)
                                | formatNumber
                            }}</b-td
                          >
                          <b-td v-else>0</b-td>
                          <b-td>
                            <button
                              v-on:click.prevent="borrarProducto(item, index)"
                            >
                              x
                            </button>
                          </b-td>
                        </b-tr>
                      </b-tbody>
                      <b-tbody v-else>
                        <b-tr style="height: 300px">
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
                          style="
                            width: 135px;
                            font-family: 'Consolas', monospace;
                          "
                          >{{ calcularSubtotalExenta | formatNumber }}</b-th
                        >
                        <b-th
                          class="text-right"
                          style="
                            width: 145px;
                            font-family: 'Consolas', monospace;
                          "
                          >{{ calcularSubtotalGrav5 | formatNumber }}</b-th
                        >
                        <b-th
                          class="text-right"
                          style="
                            width: 150px;
                            font-family: 'Consolas', monospace;
                          "
                          >{{ calcularSubtotalGrav10 | formatNumber }}</b-th
                        >
                      </b-tr>

                      <b-tr class="bg">
                        <b-th colspan="6">LIQUIDACION DE IVA 5% / 10%</b-th>
                        <b-th
                          class="text-right"
                          style="font-family: 'Consolas', monospace"
                          >{{ Iva5 | formatNumber }}</b-th
                        >
                        <b-th
                          class="text-right"
                          style="font-family: 'Consolas', monospace"
                          >{{ Iva10 | formatNumber }}</b-th
                        >
                      </b-tr>

                      <b-tr class="bg">
                        <b-th colspan="7">TOTAL DEL IVA</b-th>
                        <b-th
                          class="text-right"
                          style="font-family: 'Consolas', monospace"
                          >{{ (Iva5 + Iva10) | formatNumber }}</b-th
                        >
                      </b-tr>

                      <b-tr bgcolor="lightblue">
                        <b-th colspan="7">TOTAL DEL GENERAL</b-th>
                        <b-th
                          class="text-right"
                          style="font-family: 'Consolas', monospace"
                          >Gs. {{ totalgeneral | formatNumber }}</b-th
                        >
                      </b-tr>
                    </b-table-simple>
                  </fieldset>
                  <!-- FIN CODIGO DETALLES   -->
                  <button type="submit" class="btn btn-primary mr-2">GUARDAR</button>
                </form>
              </template>

              <!-- FIN FORMULARIO AGREGAR -->

              <!-- COMIENZO CODIGO VER PRESUPUESTO MODELO -->

              <b-modal id="modal-presupuesto" size="xl">
                <div class="container-fluid d-flex justify-content-between">
                  <div
                    class="col-lg-3 pl-0"
                    v-for="(item, index) in verCabecera"
                    :key="index"
                  >
                    <p class="mt-5 mb-2">
                      <b>PRESUPUESTO COMPRA NRO: {{ item.numero_pre }}</b>
                    </p>
                  </div>
                  <div class="col-lg-3 pr-0">
                    <p class="mt-5 mb-2 text-right">
                      <b>Cabecera</b>
                    </p>
                    <p
                      class="text-right"
                      v-for="(item, index) in verCabecera"
                      :key="index"
                    >
                      {{ item.fecha_pre }}
                      <br />
                      {{ item.fecha_plazo }},
                      <br />
                      {{ item.sucursal_descripcion }}.
                    </p>
                  </div>
                </div>
                <div
                  class="container-fluid mt-5 d-flex justify-content-center w-100"
                >
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
                        <tr
                          class="text-right"
                          v-for="(detalle, index) in verDetalle"
                          :key="index"
                        >
                          <td class="text-left">
                            {{ detalle.codigode_barra_items }}
                          </td>
                          <td class="text-left">
                            {{ detalle.descripcion_items }}
                          </td>
                          <td>
                            {{
                              detalle.presupuesto_cantidad ||
                              detalle.presupuesto_pedido_cantidad
                            }}
                          </td>
                          <td>
                            {{
                              detalle.presupuesto_precio ||
                              detalle.presupuesto_pedido_precio
                            }}
                          </td>
                          <td>{{ detalle.exenta | formatNumber }}</td>
                          <td>{{ detalle.grav5 | formatNumber }}</td>
                          <td>{{ detalle.grav10 | formatNumber }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </b-modal>

              <!-- FIN CODIGO MODAL -->

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
                          @keyup.enter="
                            listarproductomodal(descripcion_modal, selected)
                          "
                          placeholder="Productos"
                          v-model="descripcion_modal"
                          autocomplete="off"
                        />
                        <div class="input-group-prepend">
                          <b-button
                            v-b-modal.modal-lg
                            size="sm"
                            @click="
                              listarproductomodal(descripcion_modal, selected)
                            "
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
                    <template v-slot:cell(id_items)="{ item }">
                      <input
                        type="checkbox"
                        @click="agregarDetalleModalProducto(item)"
                      />
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
                <div
                  class="container-fluid mt-5 d-flex justify-content-center w-100"
                >
                  <div class="table-responsive w-100">
                    <b-table
                      ref="selectableTablePedido"
                      selectable
                      select-mode="multi"
                      :items="verDetalle"
                      :fields="fields4"
                      :filter="filter"
                      :per-page="perPage"
                      :current-page="currentPage"
                      bordered
                      sticky-header
                      small
                      responsive
                      selected-variant="success"
                      @row-selected="agregarDetalle"
                    >
                      <template v-slot:cell(selected)="{ rowSelected }">
                        <template v-if="rowSelected">
                          <span aria-hidden="true">&check;</span>
                          <span class="sr-only"></span>
                        </template>
                        <template v-else>
                          <span aria-hidden="true">
                            <b-icon icon="caret-right-fill"></b-icon>
                          </span>
                          <span class="sr-only"></span>
                        </template>
                      </template>
                      <template v-slot:cell(presupuesto_estado)="{ item }">
                        <b-badge
                          pill
                          :variant="
                            getOrderStatusColorPre(item.presupuesto_estado)
                          "
                        >
                          {{ item.presupuesto_estado }}
                          <b-icon icon="arrow-counterclockwise"></b-icon>
                        </b-badge>
                      </template>
                      <template
                        v-slot:cell(pedido_compras_detalles_precio)="{ item }"
                        >{{
                          item.pedido_compras_detalles_precio
                            | currency("", 0, { thousandsSeparator: "." })
                        }}</template
                      >

                      <template v-slot:cell(exenta)="{ item }">{{
                        item.exenta
                          | currency("", 0, { thousandsSeparator: "." })
                      }}</template>

                      <template v-slot:cell(grav5)="{ item }">{{
                        item.grav5
                          | currency("", 0, { thousandsSeparator: "." })
                      }}</template>
                      <template v-slot:cell(grav10)="{ item }">{{
                        item.grav10
                          | currency("", 0, { thousandsSeparator: "." })
                      }}</template>
                    </b-table>
                  </div>
                </div>
              </b-modal>
              <!-- FIN CODIGO MODAL -->
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
import Calendar from "primevue/calendar";
let user = document.head.querySelector('meta[name="user"]');
export default {
  components: {
    InputMask,
    Calendar,
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
      perPage: 6,
      perPage2: 6,
      currentPage: 1,
      currentPage2: 1,
      errorPedido: 0,
      errorMostrarMsjPedido: [],
      items2: [],
      items: [],
      proveedores: [],
      arrayDetalle: [],
      editarDetalle: [],
      verDetalle: [],
      verCabecera: [],
      buscar_articulo: [],
      modal_Articulo: [],
      soporte_items: [],
      buscar_por: [
        { item: "codigode_barra_producto", name: "Codigo de Barra" },
        { item: "descripcion_producto", name: "Descripcion" },
      ],
      presupuesto: {
        presupuesto_fecha: "",
        presupuesto_observacion: "S/N",
        presupuesto_plazo: "",
        presupuesto_monto: "",
        idproveedor: "",
        idusuario: "",
        idsucursal: "",
        idpedidocompra: "0",
        idpresupuesto: "",
      },
      es: {
        firstDayOfWeek: 1,
        dayNames: [
          "Domingo",
          "Lunes",
          "Martes",
          "Miércoles",
          "Jueves",
          "Viernes",
          "Sábado",
        ],
        dayNamesShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        dayNamesMin: ["D", "L", "M", "X", "J", "V", "S"],
        monthNames: [
          "Enero",
          "Febrero",
          "Marzo",
          "Abril",
          "Mayo",
          "Junio",
          "Julio",
          "Agosto",
          "Septiembre",
          "Octubre",
          "Noviembre",
          "Diciembre",
        ],
        monthNamesShort: [
          "Ene",
          "Feb",
          "Mar",
          "Abr",
          "May",
          "Jun",
          "Jul",
          "Ago",
          "Sep",
          "Oct",
          "Nov",
          "Dic",
        ],
        today: "Hoy",
        clear: "Borrar",
        weekHeader: "Sm",
      },
      listar_: false,
      minDate: null,
      maxDate: null,
      invalidDates: null,
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
          label: "Nro PEDIDO",
        },
        {
          key: "fecha_formater",
          label: "FECHA",
        },

        {
          key: "sucursal_descripcion",
          label: "SUCURSAL",
        },
        {
          key: "pedido_compras_estado",
          label: "ESTADO",
        },
        {
          key: "opciones",
          label: "Opciones",
        },
      ],
      fields2: [
        {
          key: "id_items",
          label: "Opciones",
        },
        {
          key: "codigode_barra_items",
          label: "Codigo Barra",
          sortable: true,
        },
        {
          key: "descripcion_items",
          label: "DESCRIPCION",
          sortable: true,
        },
        {
          key: "desglosar_descripcion",
          label: "UNIDA M.",
          sortable: true,
        },
        {
          key: "costo_items",
          label: "PRECIO COMPRA",
          sortable: true,
        },
        {
          key: "estado_items",
          label: "ESTADO",
        },
      ],
      fields3: [
        { key: "selected", label: "", class: "w-5px" },
        {
          key: "numero_pre",
          label: "Nro PRESUPUESTO",
        },
        {
          key: "personas_nombre_completo",
          label: "PROVEEDOR",
        },
        {
          key: "fecha_pre",
          label: "FECHA",
        },

        {
          key: "fecha_plazo",
          label: "FECHA PLAZO",
        },
        {
          key: "presupuesto_monto",
          label: "MONTO PRESUPUESTO",
        },
        {
          key: "presupuesto_estado",
          label: "ESTADO",
        },
      ],
      fields4: [
        { key: "selected", label: "", class: "w-5px" },
        {
          key: "codigode_barra_items",
          label: "COD. BARRAS",
        },
        {
          key: "descripcion_items",
          label: "DESCRIPCION",
        },
        {
          key: "pedido_compras_detalles_cantidad",
          label: "CANTIDAD",
        },
        {
          key: "pedido_compras_detalles_precio",
          label: "PRECIO",
        },
        {
          key: "grav5",
          label: "GRAV5",
        },
        {
          key: "grav10",
          label: "GRAV10",
        },
      ],
    };
  },
  methods: {
    unselectThirdRow() {
      // Rows are indexed from 0, so the third row is index 2

      $("#Btn-verDetalle").prop("disabled", true);
      $("#Btn-editar").prop("disabled", true);
      $("#Btn-anular").prop("disabled", true);
      this.$refs.selectableTable.clearSelected();
    },
    onRowSelected(items, index) {
      var me = this;
      $("#Btn-cancelar").prop("disabled", false);
      $("#Btn-verDetalle").prop("disabled", false);
      $("#Btn-editar").prop("disabled", false);
      $("#Btn-anular").prop("disabled", false);
      me.soporte_items = items;
      console.log(items);
    },
    getOrderStatusColor(pedido_compras_estado) {
      if (pedido_compras_estado === "ACTIVO") return "secondary";
    },
    getOrderStatusColorPre(presupuesto_estado) {
      if (presupuesto_estado === "PENDIENTE") return "secondary";
    },
    agregar() {
      if (this.validarPedido()) {
        return;
      }
      axios
        .post(
          "/agregar-presupuesto_compra",
          {
            presupuesto_numero: this.presupuesto.presupuesto_numero,
            presupuesto_fecha: this.presupuesto.presupuesto_fecha,
            presupuesto_plazo: this.presupuesto.presupuesto_plazo,
            presupuesto_observacion: this.presupuesto.presupuesto_observacion,
            presupuesto_monto: this.presupuesto.presupuesto_monto,
            idproveedor: this.presupuesto.idproveedor,
            idsucursal: this.presupuesto.idsucursal,
            idusuario: this.presupuesto.idusuario,
            idpedidocompra: this.presupuesto.idpedidocompra,
            datos: this.arrayDetalle,
          },
          {
            onUploadProgress: function () {
              document.getElementById(
                "cargando"
              ).innerHTML = `<b-icon icon="arrow-clockwise" animation="spin-pulse" font-scale="4"></b-icon>`;
            },
          }
        )
        .then((response) => {
          swal("Correcto!", "SE INSERTO CON EXITO", "success");
          this.listarPresupuestoCompras();
          this.arrayDetalle = [];
          this.producto_cantidad = 0;
          this.producto_precio = 0;
          this.idproducto = 0;
          this.presupuesto.presupuesto_fecha = "";
          this.presupuesto.presupuesto_plazo = "";
          this.presupuesto.idproveedor = "";
        })
        .catch((error) => {
          console.log(error);
        });
    },

    seleccionarEditar() {
      var arrayEditar = [];
      var me = this;
      me.siguiente_numero= me.soporte_items[0]["numero"];
      me.presupuesto.idpresupuesto = me.soporte_items[0]["id_presupuesto"];
      me.presupuesto.presupuesto_fecha =
        me.soporte_items[0]["presupuesto_fecha"];
      me.presupuesto.presupuesto_plazo = me.soporte_items[0]["fecha_plazo"];
      me.presupuesto.presupuesto_monto =
        me.soporte_items[0]["presupuesto_monto"];
      me.presupuesto.presupuesto_observacion =
        me.soporte_items[0]["presupuesto_observaciones"];
      me.presupuesto.idproveedor = me.soporte_items[0]["id_proveedor"];
      me.presupuesto.idusuario = me.soporte_items[0]["id_usuario"];
      me.presupuesto.idsucursal = me.soporte_items[0]["id_sucursal"];
      var url = "/Presupuesto/editarDetalle?id=" + me.presupuesto.idpresupuesto;
      axios(url)
        .then((response) => {
          arrayEditar= response.data;
          for (let i = 0; i < arrayEditar.length; i++) {
           me.arrayDetalle.push({
              id_items: arrayEditar[i].id_items,
              producto_codigode_barra: arrayEditar[i].codigode_barra_items,
              producto_descripcion: arrayEditar[i].descripcion_items,
              producto_cantidad: arrayEditar[i].presupuesto_cantidad,
              producto_precio: arrayEditar[i].presupuesto_precio,
              tipo_impuesto_descripcion:arrayEditar[i].tipo_impuesto_descripcion,
              id_presupuesto:arrayEditar[i].id_presupuesto,
            });

            
          }

          console.log(arrayEditar);
        })
        .catch((error) => console.log(error));

      this.modoEditar = false;
      document.getElementById("pills-profile-tab-custom").click();
    },
    editarDatos(presupuesto) {
      var me = this;
      const params = {
            presupuesto_numero: this.siguiente_numero,
            presupuesto_fecha: presupuesto.presupuesto_fecha,
            presupuesto_plazo: presupuesto.presupuesto_plazo,
            presupuesto_observacion: presupuesto.presupuesto_observacion,
            presupuesto_monto: presupuesto.presupuesto_monto,
            idproveedor: presupuesto.idproveedor,
            idsucursal:presupuesto.idsucursal,
            idusuario: 1,
            idpedidocompra: presupuesto.idpedidocompra,
            datos: me.arrayDetalle,
      };

      axios.put(`/editar-Presupuesto/${me.presupuesto.idpresupuesto}`, params).then(res => {
        this.modoEditar = false;
        const index = this.items.findIndex(
          item => item.id_presupuesto === presupuesto.id_presupuesto
        );
        this.items[index] = res.data;
        this.listarPresupuestoCompras();
         this.$bvToast.toast(res.data.texto, {
        title: "ERROR..",
        variant: res.data.Color,
        solid: true,
      })
        console.log(res.data);
      });
  document.getElementById("pills-home-tab-custom").click();
    },
    autocomproducto() {
      var _this = this;
      var url = "/productos/buscarArticulo?filtro=" + _this.descripcion;
      axios(url)
        .then((response) => {
          _this.buscar_articulo = response.data;
          _this.listar_ = true;
        })
        .catch((error) => console.log(error));
    },
    llenar(item) {
      this.presupuesto.idproducto = item.id_items;
      this.descripcion = item.descripcion_items;
      this.producto_precio = item.costo_items;
      this.producto_cantidad = 1;
      this.codigode_barra_producto = item.codigode_barra_items;
      this.tipo_impuesto_descripcion = item.tipo_impuesto_descripcion;
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
    listarPresupuestoCompras() {
      axios
        .get("/listar-PresupuestoCompras")
        .then((res) => {
          this.items = res.data;
          this.siguiente_numero = this.items[0]["numero_siguiente"];
        })
        .catch((error) => console.log(error));
    },
    listarproductomodal() {
      var _this = this;
      var url =
        "/productos/buscarArticuloModal?filtro=" +
        _this.descripcion_modal +
        "&por=" +
        _this.selected;
      axios(url)
        .then((response) => {
          _this.modal_Articulo = response.data;
        })
        .catch((error) => console.log(error));
    },
    listarPedidoCompras() {
      axios
        .get("/listar-PedidoCompras")
        .then((res) => {
          this.items2 = res.data;
        })
        .catch((error) => console.log(error));
    },
    listarProveedores() {
      axios
        .get("/proveedores")
        .then((res) => {
          this.proveedores = res.data;
        })
        .catch((error) => console.log(error));
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
    agregarDetalle(items = []) {
      console.log(items[0].id_items);
      let me = this;
      if (me.encuentra(items[0].id_items)) {
        swal({
          type: "error",
          title: "Error...",
          text: "Ese artículo ya se encuentra agregado!",
        });
      } else {
        me.arrayDetalle.push({
          id_items: items[0].id_items,
          producto_codigode_barra: items[0].codigode_barra_items,
          producto_descripcion: items[0].descripcion_items,
          producto_cantidad: 1,
          producto_precio: items[0].costo_items,
          tipo_impuesto_descripcion: items[0].tipo_impuesto_descripcion,
           id_presupuesto: me.presupuesto.idpresupuesto,
        });
      }
    },
    verPedido(item) {
      let me = this;

      //Obtener Detalles
      var url = "/PedidoCompra/obtenerDetalle?id=" + item.id_pedido_compras;
      axios
        .get(url)
        .then(function (response) {
          me.verDetalle = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });

      // document.getElementById("pills-home-tab-custom").click();
    },
    agregarDetalleModalProducto(data = []) {
      let me = this;
      if (me.encuentra(data["id_items"])) {
        swal({
          type: "error",
          title: "Error...",
          text: "Ese artículo ya se encuentra agregado!",
        });
      } else {
        me.arrayDetalle.push({
          id_items: data["id_items"],
          producto_codigode_barra: data["codigode_barra_items"],
          producto_descripcion: data["descripcion_items"],
          producto_cantidad: 1,
          producto_precio: data["costo_items"],
          tipo_impuesto_descripcion: data["tipo_impuesto_descripcion"],
           id_presupuesto: me.presupuesto.idpresupuesto,
        });
      }
    },
    agregarDetalleProducto() {
      let me = this;
      if (me.encuentra(me.presupuesto.idproducto)) {
        swal({
          type: "error",
          title: "Error...",
          text: "Ese artículo ya se encuentra agregado!",
        });
      } else {
        me.arrayDetalle.push({
          id_items: me.presupuesto.idproducto,
          producto_codigode_barra: me.codigode_barra_producto,
          producto_descripcion: me.descripcion,
          producto_cantidad: me.producto_cantidad,
          producto_precio: me.producto_precio,
          tipo_impuesto_descripcion: me.tipo_impuesto_descripcion,
           id_presupuesto: me.presupuesto.idpresupuesto,
        });
        console.log(me.arrayDetalle);
        me.presupuesto.idproducto = 0;
        me.descripcion = "";
        me.producto_precio = 0;
        me.producto_cantidad = 0;
      }
    },
    validarPedido() {
      let me = this;
      me.errorPedido = 0;
      me.errorMostrarMsjPedido = [];

      if (me.presupuesto.presupuesto_fecha == "")
        me.errorMostrarMsjPedido.push("Ingrese La Fecha");
      if (me.presupuesto.presupuesto_plazo == "")
        me.errorMostrarMsjPedido.push("Ingrese el Plazo");
      if (me.presupuesto.idproveedor == "")
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
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          axios
            .put(`/Registrar-PedidoCompra/${item.id_pedido_compras}`)
            .then(() => {
              this.items2.splice(index, 1);
              this.listarPedidoCompras();
            });
          swal("El Proceso Culmino Correctamente!", {
            icon: "success",
          });
        } else {
          swal("El proceso fue Cancelado!");
        }
      });
    },
    verPresupuesto() {
      let me = this;
      me.modoEditar = true;
      //Obtener Cabecera
      var url =
        "/PresupuestoCompra/obtenerCabecera?id=" +
        me.soporte_items[0]["id_presupuesto"];

      axios
        .get(url)
        .then(function (response) {
          me.verCabecera = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });

      //Obtener Detalles
      var url =
        "/PresupuestoCompra/obtenerDetalle?id=" +
        me.soporte_items[0]["id_presupuesto"];
      axios
        .get(url)
        .then(function (response) {
          me.verDetalle = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });

      document.getElementById("pills-home-tab-custom").click();
    },
    Anular() {
      swal({
        title: "Desea Anular ?",
        text: "Se anulara esta Fila!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          var me = this;
          axios
            .put(
              "/anular-presupuesto_compra/" +
                me.soporte_items[0]["id_presupuesto"]
            )
            .then(() => {
              const index = me.items.findIndex(
                (item) =>
                  item.id_presupuesto === me.soporte_items[0]["id_presupuesto"]
              );
              me.items.splice(index, 1);
            });
          swal("se ah eliminado correctamente", {
            icon: "success",
          });
        } else {
          swal("La operacion fue Cancelada!");
        }
      });
    },
    cancelarVer() {
      this.modoEditar = false;
      this.verCabecera = [];
      this.verDetalle = [];
    },
  },
  computed: {
    state() {
      return this.value.length === this.arrayDetalle.id_items;
    },
    user() {
      return JSON.parse(user.content);
    },
    rows() {
      return this.items.length;
    },
    rows2() {
      return this.modal_Articulo.length;
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
    },
    totalgeneral() {
      let me = this;
      return (me.presupuesto.presupuesto_monto =
        me.calcularSubtotalExenta +
        me.calcularSubtotalGrav5 +
        me.calcularSubtotalGrav10);
    },
    
  },
  created() {
    let today = new Date();
    let month = today.getMonth();
    let year = today.getFullYear();
    let prevMonth = month === 0 ? 11 : month - 1;
    let prevYear = prevMonth === 11 ? year - 1 : year;
    let nextMonth = month === 11 ? 0 : month + 1;
    let nextYear = nextMonth === 0 ? year + 1 : year;
    this.minDate = new Date();
    this.minDate.setMonth(prevMonth);
    this.minDate.setFullYear(prevYear);
    this.maxDate = new Date();
    this.maxDate.setMonth(nextMonth);
    this.maxDate.setFullYear(nextYear);

    let invalidDate = new Date();
    invalidDate.setDate(today.getDate() - 1);
    this.invalidDates = [today, invalidDate];
    this.presupuesto.presupuesto_fecha = today + "/" + month + "/" + year;
    var me = this;
    me.listarPedidoCompras();
    me.listarProveedores();
    me.listarPresupuestoCompras();
  },
  mounted() {
    let me = this;
    me.presupuesto.idusuario = me.$attrs.pedido_compra.id_usuarios;
    me.presupuesto.idsucursal = me.$attrs.pedido_compra.id_sucursal;
  },
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