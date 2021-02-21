<template>
  <div class="row">
    <b-breadcrumb :items="ro"></b-breadcrumb>
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
                id="pills-contact-tab"
                data-toggle="pill"
                href="#pills-contact"
                role="tab"
                aria-controls="pills-contact"
                aria-selected="false"
                type="button"
                class="btn btn-outline-primary btn-fw Btn-verDetalle"
                @click="verDetalleIndex()"
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
                id="Btn-generarCuotas"
                @click="verDetalleIndex()"
                v-b-modal.modal-generarCuotas
                disabled
              >
                <i class="mdi mdi-attachment text-primary mr-1"></i>GENERAR
                CUOTAS
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
                @click="cancelar()"
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
              <template>
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
                      :items="listarCompras"
                      :fields="listarFacturaCompra"
                      :filter="filter"
                      :per-page="perPage7"
                      :current-page="currentPage7"
                      :bordered="bordered"
                      sticky-header
                      small
                      responsive
                      selected-variant="success"
                      @row-selected="seleccionarIndex"
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
                          <input type="hidden" @click="cancelar" />
                        </template>
                      </template>

                      <template v-slot:cell(factura_compra_total)="{ item }">{{
                        item.factura_compra_total
                          | currency("", 0, { thousandsSeparator: "." })
                      }}</template>

                      <template v-slot:cell(factura_tasa_cambio)="{ item }">{{
                        item.factura_tasa_cambio
                          | currency("", 0, { thousandsSeparator: "." })
                      }}</template>
                    </b-table>
                    <div class="mt-3">
                      <h6>Paginas</h6>
                      <b-pagination
                        v-model="currentPage7"
                        pills
                        :total-rows="rows"
                        :per-page="perPage7"
                        aria-controls="my-table"
                      ></b-pagination>
                    </div>
                  </div>
                </fieldset>
              </template>
            </div>
            <div
              class="tab-pane fade"
              id="pills-contact"
              role="tabpanel"
              aria-labelledby="pills-contact-tab"
            >
              <template>
                <fieldset>
                  <legend>DETALLE DE LA COMPRAS</legend>
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-4">
                              <div class="border-bottom text-center pb-4">
                                <div class="mb-3">
                                  <h3>CABECERA FACTURA</h3>
                                </div>
                                <div class="d-flex justify-content-center">
                                  <button class="btn btn-primary">
                                    GENERAR CUOTAS
                                  </button>
                                </div>
                              </div>
                              <div
                                class="py-4"
                                v-for="(item, index) in verCabecera"
                                :key="index"
                              >
                                <p class="clearfix">
                                  <span class="float-left">
                                    Factura Numero :
                                  </span>
                                  <span class="float-right text-muted">
                                    {{ item.factura_compra_numero }}
                                  </span>
                                </p>
                                <p class="clearfix">
                                  <span class="float-left">
                                    Fecha Registro :
                                  </span>
                                  <span class="float-right text-muted">
                                    {{ item.fecha_registro }}
                                  </span>
                                </p>
                                <p class="clearfix">
                                  <span class="float-left">
                                    Fecha Vencimiento :
                                  </span>
                                  <span class="float-right text-muted">
                                    {{ item.fecha_vencimiento }}
                                  </span>
                                </p>
                                <p class="clearfix">
                                  <span class="float-left">
                                    T. Comprobante :
                                  </span>
                                  <span class="float-right text-muted">
                                    {{ item.tipo_comprobante_descripcion }}
                                  </span>
                                </p>
                                <p class="clearfix">
                                  <span class="float-left">
                                    Condicion Factura :
                                  </span>
                                  <span class="float-right text-muted">
                                    {{ item.factura_compra_tipo }}
                                  </span>
                                </p>
                                <p class="clearfix">
                                  <span class="float-left"> T. Moneda : </span>
                                  <span class="float-right text-muted">
                                    {{ item.moneda_descripcion }}
                                  </span>
                                </p>
                                <p class="clearfix">
                                  <span class="float-left">
                                    Tasa Cambio :
                                  </span>
                                  <span class="float-right text-muted">
                                    {{ item.factura_tasa_cambio }}
                                  </span>
                                </p>
                              </div>
                            </div>
                            <div class="col-lg-8">
                              <div class="mt-4 py-2 border-top border-bottom">
                                <ul class="nav profile-navbar" role="tablist">
                                  <li class="nav-item">
                                    <a
                                      class="nav-link active"
                                      id="home-tab"
                                      data-toggle="tab"
                                      href="#home-1"
                                      role="tab"
                                      aria-controls="home-1"
                                      aria-selected="true"
                                    >
                                      <i class="mdi mdi-account-outline"></i>
                                      DETALLE DE LA FACTURA
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a
                                      class="nav-link"
                                      id="profile-tab"
                                      data-toggle="tab"
                                      href="#profile-1"
                                      role="tab"
                                      aria-controls="profile-1"
                                      aria-selected="false"
                                    >
                                      <i class="mdi mdi-newspaper"></i>
                                      CUOTAS GENERADAS
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a
                                      class="nav-link"
                                      id="contact-tab"
                                      data-toggle="tab"
                                      href="#contact-1"
                                      role="tab"
                                      aria-controls="contact-1"
                                      aria-selected="false"
                                    >
                                      <i class="mdi mdi-calendar"></i>
                                      CUOTAS PAGADAS
                                    </a>
                                  </li>
                                </ul>
                              </div>
                              <div class="tab-content">
                                <div
                                  class="tab-pane fade show active"
                                  id="home-1"
                                  role="tabpanel"
                                  aria-labelledby="home-tab"
                                >
                                  <div class="profile-feed">
                                    <div>
                                      <b-table
                                        :items="verDetalle"
                                        :fields="listarDetalle"
                                        :striped="striped"
                                        :bordered="bordered"
                                        :small="small"
                                      >
                                        <template v-slot:cell(selected)>
                                          <b-icon
                                            icon="caret-right-fill"
                                          ></b-icon>
                                        </template>
                                        <template
                                          v-slot:cell(factura_compras_detalle_precio)="{
                                            item,
                                          }"
                                          >{{
                                            item.factura_compras_detalle_precio
                                              | currency("", 0, {
                                                thousandsSeparator: ".",
                                              })
                                          }}</template
                                        >
                                        <template
                                          v-slot:cell(factura_compra_detalle_cantidad)="{
                                            item,
                                          }"
                                          >{{
                                            item.factura_compra_detalle_cantidad
                                              | currency("", 0, {
                                                thousandsSeparator: ".",
                                              })
                                          }}</template
                                        >
                                      </b-table>
                                    </div>
                                    <div class="container-fluid mt-5 w-100">
                                      <p class="text-left mb-2">
                                        Sub Total (Exenta) :
                                        {{
                                          calcularSubtotalExentaDetalle
                                            | currency("", 0, {
                                              thousandsSeparator: ".",
                                            })
                                        }}
                                      </p>
                                      <p class="text-left mb-2">
                                        Sub Total (Iva 5%) :
                                        {{
                                          calcularSubtotalIva5Detalle
                                            | currency("", 0, {
                                              thousandsSeparator: ".",
                                            })
                                        }}
                                      </p>
                                      <p class="text-left">
                                        Sub Total (Iva 10%) :
                                        {{
                                          calcularSubtotalIva10Detalle
                                            | currency("", 0, {
                                              thousandsSeparator: ".",
                                            })
                                        }}
                                      </p>
                                      <h4 class="text-left mb-5">
                                        Sub Total General :
                                        {{
                                          (calcularSubtotalIva10Detalle +
                                            calcularSubtotalIva5Detalle +
                                            calcularSubtotalExentaDetalle)
                                            | currency("", 0, {
                                              thousandsSeparator: ".",
                                            })
                                        }}
                                        Gs.
                                      </h4>
                                      <hr />
                                    </div>
                                  </div>
                                </div>
                                <div
                                  class="tab-pane fade"
                                  id="profile-1"
                                  role="tabpanel"
                                  aria-labelledby="profile-tab"
                                >
                                  <div class="profile-feed">
                                    <div>
                                      <b-table
                                        :items="cuotasGeneradas"
                                        :fields="listarCuotaGeneradas"
                                        :striped="striped"
                                        :bordered="bordered"
                                        :small="small"
                                      >
                                        <template v-slot:cell(selected)>
                                          <b-icon
                                            icon="caret-right-fill"
                                          ></b-icon>
                                        </template>
                                        <template
                                          v-slot:cell(compra_cuota_monto)="{
                                            item,
                                          }"
                                          >{{
                                            item.compra_cuota_monto
                                              | currency("", 0, {
                                                thousandsSeparator: ".",
                                              })
                                          }}</template
                                        >
                                        <template
                                          v-slot:cell(compra_cuota_saldo)="{
                                            item,
                                          }"
                                          >{{
                                            item.compra_cuota_saldo
                                              | currency("", 0, {
                                                thousandsSeparator: ".",
                                              })
                                          }}</template
                                        >
                                        <template
                                          v-slot:cell(compra_cuota_cantidad)="{
                                            item
                                          }"
                                        >
                                        <div v-if="item.compra_cuota_cantidad == 0">
                                            <b-badge pill variant="success">Entrega Inicial</b-badge>
                                        </div>
                                        <div v-else>
                                            <b-badge pill variant="secondary">Cuota Nro {{item.compra_cuota_cantidad}}</b-badge>
                                        </div>
                                         </template
                                        >
                                      </b-table>
                                    </div>
                                  </div>
                                </div>
                                <div
                                  class="tab-pane fade"
                                  id="contact-1"
                                  role="tabpanel"
                                  aria-labelledby="contact-tab"
                                >
                                  <h4>SIN CUOTAS PAGADAS</h4>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </template>
            </div>
            <div
              class="tab-pane fade"
              id="pills-career"
              role="tabpanel"
              aria-labelledby="pills-profile-tab-custom"
            >
              <!-- FORMULARIO AGREGAR -->
              <template>
                <form class="forms-sample" @submit.prevent="agregar">
                  <!-- COMIENZO DE CODIGO CABECERA-->

                  <fieldset>
                    <legend>FACTURA COMPRA CABECERA</legend>
                    <b-container class="bv-example-row">
                      <b-row>
                        <b-col sm="2">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Nro. Fact.</label
                          >
                          <input-mask
                            mask="999-999-9999999"
                            class="form-control form-control-sm"
                            v-model="factura_compras.numero_factura"
                          ></input-mask>
                        </b-col>
                        <b-col sm="2">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Fecha Registro</label
                          >
                          <input-mask
                            mask="99/99/9999"
                            class="form-control form-control-sm"
                            v-model="factura_compras.fecha_registro"
                          ></input-mask>
                        </b-col>
                        <b-col cols="4"></b-col>
                        <b-col sm="2">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Usuario</label
                          >
                          <b-form-input
                            size="sm"
                            v-bind:value="`${user.nombre_usuario}`"
                            disabled
                          ></b-form-input>
                        </b-col>
                        <b-col sm="2">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Ruc.</label
                          >
                          <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                            <b-form-input
                              autocomplete="off"
                              size="sm"
                              v-model="ruc_buscar_proveedor"
                              @keypress.prevent.enter="
                                autocompletadoProveedor()
                              "
                            ></b-form-input>
                            <div class="input-group-prepend">
                              <b-button
                                size="sm"
                                style="border-radius: 0 4px 4px 0"
                                @click.prevent="autocompletadoProveedor()"
                                variant="light"
                              >
                                <b-icon icon="search"></b-icon>
                              </b-button>
                            </div>
                          </div>
                        </b-col>
                      </b-row>
                      <b-row>
                        <b-col sm="2">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Fecha Emision Factura</label
                          >
                          <input-mask
                            mask="99/99/9999"
                            class="form-control form-control-sm"
                            v-model="factura_compras.fecha_emision"
                          ></input-mask>
                        </b-col>

                        <b-col sm="2">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Fecha Vencimiento </label
                          >
                          <input-mask
                            v-model="factura_compras.factura_fecha_vencimiento"
                            mask="99/99/9999"
                            class="form-control form-control-sm"
                          ></input-mask>
                        </b-col>
                        <b-col sm="2">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Nro Timbrado</label
                          >
                          <input-mask
                            mask="99999999"
                            class="form-control form-control-sm"
                            v-model="factura_compras.numero_timbrado"
                          ></input-mask>
                        </b-col>
                        <b-col cols="2"></b-col>
                        <b-col sm="4">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Proveedor</label
                          >
                          <v-select
                            @input="SelectProveedor"
                            :options="optiones"
                            label="personas_nombre_completo"
                            v-model="factura_compras.idproveedor"
                            :reduce="(proveedor) => proveedor.id_proveedor"
                          ></v-select>
                        </b-col>
                      </b-row>

                      <b-row>
                        <b-col sm="2">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Timbr. Vecimiento</label
                          >
                          <input-mask
                            mask="99/99/9999"
                            class="form-control form-control-sm"
                            v-model="factura_compras.tim_vencimiento"
                          ></input-mask>
                        </b-col>
                        <b-col sm="2">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Tipo Moneda</label
                          >
                          <b-form-select
                            v-model="factura_compras.idtipomoneda"
                            @change="tazacambio()"
                            size="sm"
                          >
                            <option value>--Seleccione--</option>
                            <option
                              v-for="(item, index) in tipomoneda"
                              :key="index"
                              v-bind:value="item.id_tipo_moneda"
                            >
                              {{ item.moneda_descripcion }}
                              {{ item.moneda_siglas }}
                            </option>
                          </b-form-select>
                        </b-col>
                        <b-col sm="2">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Tasa Cambio</label
                          >
                          <vue-autonumeric
                            class="form-control form-control-sm"
                            v-model="factura_compras.tasa_cambio"
                            :options="{
                              digitGroupSeparator: '.',
                              decimalCharacter: ',',
                              decimalCharacterAlternative: '.',
                              minimumValue: '0',
                            }"
                            disabled
                          ></vue-autonumeric>
                        </b-col>
                        <b-col sm="2"></b-col>
                        <b-col sm="4">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Direcion</label
                          >
                          <b-form-input
                            size="sm"
                            disabled
                            v-model="proveedor_direccion"
                          ></b-form-input>
                        </b-col>
                      </b-row>
                      <b-row>
                        <b-col sm="3">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Orden Compras</label
                          >
                          <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                            <b-form-input
                              size="sm"
                              v-model="numero_orden_buscar"
                              @keypress.prevent.enter="autocompletadoOrden()"
                              autocomplete="off"
                            ></b-form-input>
                            <div class="input-group-prepend">
                              <b-button
                                v-b-modal.modal-xlO
                                size="sm"
                                style="border-radius: 0 4px 4px 0"
                                variant="light"
                              >
                                <b-icon icon="search"></b-icon>
                              </b-button>
                            </div>
                          </div>
                        </b-col>
                        <b-col sm="2" v-if="!mostrar">
                          <label
                            class="mr-sm-3"
                            for="inline-form-custom-select-pref"
                          ></label>
                          <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                            <b-button
                              v-b-modal.modal-xlp
                              size="sm"
                              style="border-radius: 4px 4px 4px 4px"
                              variant="primary"
                            >
                              Ver Detalle
                              <b-icon icon="list"></b-icon>
                            </b-button>
                          </div>
                        </b-col>
                        <b-col sm="2">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Condic. Factura</label
                          >
                          <b-form-select
                            :options="options"
                            v-model="factura_compras.condicion_factura"
                            size="sm"
                          ></b-form-select>
                        </b-col>
                        <b-col sm="2">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Tipo Comprobante</label
                          >
                          <b-form-select
                            v-model="factura_compras.idtipocomprobante"
                            size="sm"
                          >
                            <option value>--Seleccione--</option>
                            <option
                              v-for="(item, index) in tipocomprobante"
                              :key="index"
                              v-bind:value="item.id_tipo_comprobante"
                            >
                              {{ item.tipo_comprobante_descripcion }}
                            </option>
                          </b-form-select>
                        </b-col>

                        <b-col sm="2">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Afecta Stock</label
                          >
                          <b-form-checkbox
                            switch
                            size="lg"
                            v-model="factura_compras.afecta_stock"
                            >{{
                              factura_compras.afecta_stock == false
                                ? "No"
                                : "Si"
                            }}</b-form-checkbox
                          >
                        </b-col>
                      </b-row>
                      <b-row>
                        <b-col sm="4">
                          <label
                            class="mr-sm-2"
                            for="inline-form-custom-select-pref"
                            >Observacion</label
                          >
                          <b-form-textarea
                            v-model="factura_compras.observacion"
                            id="textarea-no-resize"
                            placeholder="Observaciones...."
                            rows="3"
                            no-resize
                          ></b-form-textarea>
                        </b-col>
                      </b-row>
                    </b-container>
                  </fieldset>
                  <!-- FIN CODIGO CABECERA-->

                  <!-- CARGA DE PRODUCTOS -->
                  <fieldset>
                    <legend>CARGA DE PEDIDO</legend>
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
                              @keyup="autocomproducto()"
                              autocomplete="off"
                            />
                            <div class="input-group-prepend">
                              <b-button v-b-modal.modal-productos size="sm">
                                <b-icon icon="search"></b-icon>
                              </b-button>
                            </div>
                            <br />
                          </div>
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
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="exampleInputUsername1">PRECIO</label>
                          <vue-autonumeric
                            class="form-control form-control-sm"
                            v-model="producto_precio"
                            :options="{
                              digitGroupSeparator: '.',
                              decimalCharacter: ',',
                              decimalCharacterAlternative: '.',
                              minimumValue: '0',
                            }"
                          ></vue-autonumeric>
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
                          <vue-autonumeric
                            class="form-control form-control-sm"
                            v-model="producto_cantidad"
                            @keypress.prevent.enter="agregarDetalle()"
                            :options="{
                              digitGroupSeparator: '.',
                              decimalCharacter: ',',
                              decimalCharacterAlternative: '.',
                              minimumValue: '0',
                            }"
                          ></vue-autonumeric>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <b-button
                            size="sm"
                            variant="primary"
                            style="margin-top: 30px"
                            @click.prevent="agregarDetalle()"
                          >
                            <b-icon icon="plus-circle"></b-icon>
                          </b-button>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  <!-- FIN CARGA PRODUCTOS -->
   <div class="alert alert-danger alert-dismissible" v-show="errorFactura" >
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <b>Por favor corriga los siguientes errores:</b>
                    <ul>
                      <li v-for="error in errorMostrarMsjFactura" :key="error" v-text="error"></li>
                    </ul>
                  </div>




                  <!-- CARGA DE DETALLES -->
                  <!-- COMIENZO CODIGO DETALLES   -->
                  <fieldset>
                    <legend>Detalle</legend>

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
                          <b-th>DEPOSITO</b-th>
                          <b-th>U. MEDIDA</b-th>
                          <b-th>CANTIDAD</b-th>
                          <b-th>PRECIO U.</b-th>
                          <b-th>EXENTA</b-th>
                          <b-th>5%</b-th>
                          <b-th>10%</b-th>
                          <b-th></b-th>
                        </b-tr>
                      </b-thead>
                      <b-tbody v-if="arrayDetalle.length">
                        <b-tr
                          v-for="(item, index) in arrayDetalle"
                          :key="index"
                          style="cursor: pointer; text-align: center"
                        >
                          <b-td>
                            <b-icon
                              icon="caret-right-fill"
                              @mousedown="editarCantidad(item)"
                            ></b-icon>
                          </b-td>
                          <b-td v-text="item.producto_codigode_barra"></b-td>
                          <b-td v-text="item.producto_descripcion"></b-td>
                          <b-td>
                            <b-form-select v-model="item.iddeposito">
                              <option value>--Seleccione--</option>
                              <option
                                v-for="(item, index) in depositos"
                                :key="index"
                                v-bind:value="item.id_deposito"
                              >
                                {{ item.deposito_descripcion }}
                              </option>
                            </b-form-select>
                          </b-td>
                          <b-td>
                            <b-form-select v-model="item.idunidad">
                              <option value>--Seleccione--</option>
                              <option
                                v-for="(item, index) in desglosar"
                                :key="index"
                                v-bind:value="item.id_desglosar"
                              >
                                {{ item.desglosar_descripcion }}
                              </option>
                            </b-form-select>
                          </b-td>
                          <b-td>
                            <span
                              v-if="!modoEditar2 && idproducto == item.id_items"
                              @keypress.prevent.enter="editarCantidad(item)"
                            >
                              <vue-autonumeric
                                class="form-control form-control-sm"
                                v-model="item.producto_cantidad"
                                :options="{
                                  digitGroupSeparator: '.',
                                  decimalCharacter: ',',
                                  decimalCharacterAlternative: '.',
                                  minimumValue: '0',
                                }"
                              ></vue-autonumeric>
                            </span>
                            <span v-else>
                              <b-td class="span_detalle">{{
                                item.producto_cantidad
                                  | currency("", 2, { decimalSeparator: "," })
                              }}</b-td>
                            </span>
                          </b-td>
                          <b-td>
                            <span
                              v-if="!modoEditar2 && idproducto == item.id_items"
                              @keypress.prevent.enter="editarCantidad(item)"
                            >
                              <vue-autonumeric
                                class="form-control form-control-sm"
                                v-model="item.producto_precio"
                                :options="{
                                  digitGroupSeparator: '.',
                                  decimalCharacter: ',',
                                  decimalCharacterAlternative: '.',
                                  minimumValue: '0',
                                }"
                              ></vue-autonumeric>
                            </span>
                            <span v-else>
                              <b-td class="span_detalle">{{
                                item.producto_precio
                                  | currency("", 0, { thousandsSeparator: "." })
                              }}</b-td>
                            </span>
                          </b-td>
                          <b-td
                            v-if="item.tipo_impuesto_descripcion === 'EXENTA'"
                            >{{
                              (item.producto_cantidad * item.producto_precio)
                                | currency("", 0, { thousandsSeparator: "." })
                            }}</b-td
                          >
                          <b-td v-else>0</b-td>
                          <b-td
                            v-if="item.tipo_impuesto_descripcion === 'IVA 5%'"
                            >{{
                              (item.producto_cantidad * item.producto_precio)
                                | currency("", 0, { thousandsSeparator: "." })
                            }}</b-td
                          >
                          <b-td v-else>0</b-td>
                          <b-td
                            v-if="item.tipo_impuesto_descripcion === 'IVA 10%'"
                            >{{
                              (item.producto_cantidad * item.producto_precio)
                                | currency("", 0, { thousandsSeparator: "." })
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
                          <b-td colspan="9">
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
                          >{{ calcularSubtotalIva5 | formatNumber }}</b-th
                        >
                        <b-th
                          class="text-right"
                          style="
                            width: 150px;
                            font-family: 'Consolas', monospace;
                          "
                          >{{ calcularSubtotalIva10 | formatNumber }}</b-th
                        >
                      </b-tr>
                      <tr class="bg">
                        <b-th colspan="6">GRAVADA S/ IVA</b-th>
                         <b-th
                          class="text-right"
                          style="font-family: 'Consolas', monospace"
                          >{{ totalGravada5 | formatNumber }}</b-th
                        >
                        <b-th
                          class="text-right"
                          style="font-family: 'Consolas', monospace"
                          >{{ totalGravada10 | formatNumber }}</b-th>
                          </tr>
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
                  <!-- FIN DE DETALLES -->
                  <b-button variant="outline-primary" type="submit"
                    >GUARDAR</b-button
                  >
                </form>
              </template>
              <!-- FORMULARIO FIN AGREGAR -->
            </div>

            <!-- LISTA DEL DETALLE PRODUCTOS -->
            <b-modal id="modal-productos" size="xl" title="LISTA DE PRODUCTOS">
              <div
                class="container-fluid mt-5 d-flex justify-content-center w-100"
              >
                <div class="table-responsive w-100">
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
                    select-mode="multi"
                    :items="ProductosModal"
                    :fields="ProductoFields"
                    :filter="filter"
                    :per-page="perPage6"
                    :current-page="currentPage6"
                    :bordered="bordered"
                    sticky-header
                    small
                    responsive
                    selected-variant="success"
                    @row-selected="agregarDetalleModalProductos"
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
                        <input type="hidden" />
                      </template>
                    </template>

                    <template v-slot:cell(costo_items)="{ item }">{{
                      item.costo_items
                        | currency("", 0, { thousandsSeparator: "." })
                    }}</template>

                    <template v-slot:cell(estado_items)="{ item }"
                      ><b-badge pill variant="success">
                        <b-icon icon="arrow-counterclockwise"></b-icon>
                        {{ item.estado_items }}
                      </b-badge></template
                    >

                    <!-- <template v-slot:cell(exenta)="{ item }">{{
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
                    }}</template> -->
                  </b-table>
                  <div class="mt-3">
                    <h6>Paginas</h6>
                    <b-pagination
                      v-model="currentPage"
                      pills
                      :total-rows="rows4"
                      :per-page="perPage6"
                      aria-controls="my-table"
                    ></b-pagination>
                  </div>
                </div>
              </div>
            </b-modal>
            <!-- FIN DEL DETALLE PRODUCTOS -->

            <!-- LISTA  DE ORDEN DE COMPRAS -->
            <b-modal
              id="modal-xlO"
              size="xl"
              title="LISTA DE ORDENES APROBADAS"
            >
              <div
                class="container-fluid mt-5 d-flex justify-content-center w-100"
              >
                <div class="table-responsive w-100">
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
                    :items="OrdenCompra2"
                    :fields="ordenCompraC"
                    :filter="filter"
                    :per-page="perPage5"
                    :current-page="currentPage5"
                    :bordered="bordered"
                    sticky-header
                    small
                    responsive
                    selected-variant="success"
                    @row-selected="AgregarOrden"
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
                        <input type="hidden" />
                      </template>
                    </template>

                    <template v-slot:cell(orden_compras_estado)="{ item }"
                      ><b-badge pill variant="success">
                        <b-icon icon="arrow-counterclockwise"></b-icon>
                        {{ item.orden_compras_estado }}
                      </b-badge></template
                    >
                  </b-table>
                </div>
              </div>
            </b-modal>
            <!-- LISTA  DE ORDEN DE COMPRAS -->

            <!-- LISTA DEL DETALLE DE ORDEN DE COMPRAS -->
            <b-modal
              id="modal-xlp"
              size="xl"
              title="LISTA DE DETALLES DE ORDEN"
            >
              <div
                class="container-fluid mt-5 d-flex justify-content-center w-100"
              >
                <div class="table-responsive w-100">
                  <b-table
                    ref="selectableTable"
                    selectable
                    select-mode="multi"
                    :items="OrdenCompraDetalle"
                    :fields="ordenCompraD"
                    :filter="filter"
                    :per-page="perPage4"
                    :current-page="currentPage4"
                    :bordered="bordered"
                    sticky-header
                    small
                    responsive
                    selected-variant="success"
                    @row-selected="agregarDetalleModalOrden"
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
                        <input type="hidden" />
                      </template>
                    </template>

                    <template
                      v-slot:cell(orden_compras_detalles_precios)="{ item }"
                      >{{
                        item.orden_compras_detalles_precios
                          | currency("", 0, { thousandsSeparator: "." })
                      }}</template
                    >

                    <template v-slot:cell(exenta)="{ item }">{{
                      item.exenta | currency("", 0, { thousandsSeparator: "." })
                    }}</template>
                    <template v-slot:cell(grav5)="{ item }">{{
                      item.grav5 | currency("", 0, { thousandsSeparator: "." })
                    }}</template>
                    <template v-slot:cell(grav10)="{ item }">{{
                      item.grav10 | currency("", 0, { thousandsSeparator: "." })
                    }}</template>
                  </b-table>
                </div>
              </div>
            </b-modal>
            <!-- FIN DEL DETALLE DE ORDEN DE COMPRAS -->

            <!-- MODAL DE GENERAR CUOTAS -->
            <b-modal
              id="modal-generarCuotas"
              size="lg"
              title="MODAL GENERAR CUOTAS"
              ok-only
              no-stacking
            >
              <template>
                <div class="container-fluid">
                  <div
                    class="container-fluid d-flex justify-content-between"
                    v-for="(item, index) in verCabecera"
                    :key="index"
                  >
                    <div class="col-lg-4 pl-0">
                      <p class="mt-5 mb-2"><b>Proveedor</b></p>
                      <p>
                        RUC: {{ item.cedula_identidad_personas
                        }}<br />Direccion:
                        {{ item.direccion_exacta }},<br />Telefono:
                        {{ item.telefono_personas }}.
                      </p>
                    </div>
                    <div class="col-lg-4 pr-0">
                      <p class="mt-5 mb-2 text-right"><b>Factura</b></p>
                      <p class="text-right">
                        Nro Factura : {{ item.factura_compra_numero }},<br />
                        Fecha Registro : {{ item.fecha_registro }}<br />
                        Tipo Factura: {{ item.factura_compra_tipo }}<br />
                        Total:
                        {{
                          item.factura_compra_total
                            | currency("", 0, { thousandsSeparator: "." })
                        }}
                      </p>
                    </div>
                  </div>
                </div>
                <b-row>
                  <b-col cols="4">
                    <label class="mr-sm-2" for="inline-form-custom-select-pref"
                      >Fecha Venc.</label
                    >
                    <b-form-datepicker
                      size="sm"
                      id="datepicker-dateformat2"
                      :date-format-options="{
                        day: 'numeric',
                        month: 'numeric',
                        year: 'numeric',
                      }"
                      locale="es"
                      v-model="generar_cuotas.fechaVencimiento"
                    ></b-form-datepicker>
                  </b-col>
                  <b-col cols="4">
                    <label class="mr-sm-2" for="inline-form-custom-select-pref"
                      >Cantidad Cuotas</label
                    >
                    <b-form-input
                      id="input-small"
                      size="sm"
                      v-model="generar_cuotas.cantidad"
                    ></b-form-input>
                  </b-col>
                  <b-col cols="4">
                    <label class="mr-sm-2" for="inline-form-custom-select-pref"
                      >Tipo Pagos</label
                    >
                    <b-form-select
                      :options="TipoPago"
                      v-model="generar_cuotas.idtigopago"
                      size="sm"
                    ></b-form-select>
                  </b-col>
                  <b-col cols="4">
                    <label class="mr-sm-2" for="inline-form-custom-select-pref"
                      >Entrega Inicial</label
                    >

                    <vue-autonumeric
                      class="form-control form-control-sm"
                      v-model="generar_cuotas.entregaInicial"
                      :options="{
                        digitGroupSeparator: '.',
                        decimalCharacter: ',',
                        decimalCharacterAlternative: '.',
                        minimumValue: '0',
                      }"
                    ></vue-autonumeric>
                  </b-col>
                </b-row>
                <br />
                <b-row>
                  <b-col cols="12">
                    <button
                      class="btn btn-primary block"
                      @click.prevent="GenerarCuotas"
                    >
                      GENERAR CUOTAS
                    </button>
                  </b-col>
                </b-row>
                <hr />
                <form class="forms-sample" @submit.prevent="guardarCuotas">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>NRO CUOTAS</th>
                        <th>FECHA VENCIMIENTO</th>
                        <th>MONTO</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in filasCuotas" :key="index">
                        <td>{{ item.cantidad }}</td>
                        <td>{{ item.fechaVencimiento }}</td>
                        <td>
                          {{
                            item.monto
                              | currency("", 0, { thousandsSeparator: "." })
                          }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <button
                    class="btn btn-primary block"
                    id="btn-guardarCuotas"
                    disabled
                  >
                    GUARDAR
                  </button>
                </form>
              </template>
            </b-modal>
            <!-- FIN MODAL GENERAR CUOTAS-->

         
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import InputMask from "vue-input-mask";
import swal from "sweetalert";
import VueAutonumeric from "vue-autonumeric";
import ToggleButton from "primevue/togglebutton";
import InputNumber from "primevue/inputnumber";
import Calendar from "primevue/calendar";
let user = document.head.querySelector('meta[name="user"]');
export default {
  components: {
    VueAutonumeric,
    InputMask,
    ToggleButton,
    InputNumber,
    Calendar,
  },
  data() {
    return {
      mostrar: true,
      modoEditar2: true,
      modoEditar: false,
      fixed: true,
      striped: true,
      bordered: true,
      filter: null,
      perPage: 3,
      perPage2: 6,
      perPage3: 6,
      perPage4: 6,
      perPage5: 6,
      perPage6: 6,
      perPage7: 6,
      currentPage: 1,
      currentPage2: 1,
      currentPage3: 1,
      currentPage4: 1,
      currentPage5: 1,
      currentPage6: 1,
      currentPage7: 1,
      errorPedido: 0,
      errorMostrarMsjPedido: [],
      ProductosModal: [],
      idproducto: -1,
      producto_cantidad: 0,
      producto_cantidades: 0,
      producto_precio: 0,
      codigode_barra_producto: "",
      tipo_impuesto_descripcion: "",
      id_tipo_impuesto_descripcion: "",
      descripcion: "",
      listarCompras: [],
      arrayDetalle: [],
      OrdenCompra: [],
      OrdenCompraDetalle: [],
      OrdenCompra2: [],
      items: [],
      Proveedor: [],
      depositos: [],
      desglosar: [],
      tipomoneda: [],
      filasCuotas: [],
      tipocomprobante: [],
      errorMostrarMsjFactura: [],
      soporte_items: [],
      verCabecera: [],
      verDetalle: [],
      cuotasGeneradas: [],
      errorFactura: 0,
      numero_orden_buscar: "",
      ruc_buscar_proveedor: "",
      proveedor_descripcion: "",
      proveedor_direccion: "",
      taza_cambio: "",
      small: true,
      listar_: false,
      generar_cuotas: {
        fechaVencimiento: "",
        idtigopago: 30,
        cantidad: 1,
        entregaInicial: 0,
      },

      factura_compras: {
        idordencompra: 0,
        condicion_factura: "",
        numero_factura: "",
        fecha_emision: "",
        factura_fecha_vencimiento: "",
        fecha_registro: "",
        numero_timbrado: "",
        tim_vencimiento: "",
        grav5: "",
        grav10: "",
        idusuario: "",
        idsucursal: "",
        idproveedor: "",
        idtipomoneda: "",
        idtipocomprobante: "",
        observacion: "S/N",
        tasa_cambio: "",
        totalcompra: "",
        afecta_stock: 0,
      },
      optiones: [],
      props: ["pedido_compra"],
      options: [
        { value: "CONTADO", text: "CONTADO" },
        { value: "CREDITO", text: "CREDITO" },
      ],
      TipoPago: [
        { value: 30, text: "MENSUAL" },
        { value: 14, text: "QUINCENAL" },
        { value: 7, text: "SEMANAL" },
      ],
      selected: "",
      selectede: [],
      ro: [
        {
          text: "Admin",
          href: "#",
        },
        {
          text: "pedidos",
          to: "pedido_compras",
        },
        {
          text: "Library",
          active: true,
        },
      ],
      fields: [
        { key: "seleccionar", label: "", class: "w-5px" },
        {
          key: "numero_compra",
          label: "Nro PEDIDO",
        },
        {
          key: "fecha_formater",
          label: "fecha",
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
        { key: "opciones", label: "", class: "w-5px" },
        {
          key: "numero_orden_compras",
          label: "Nro ORDEN",
        },
        {
          key: "fecha_orden",
          label: "fecha",
        },

        {
          key: "fecha_plazo",
          label: "Valido Hasta",
        },
        {
          key: "orden_compras_estado",
          label: "ESTADO",
        },
        { key: "operacion", label: "", class: "w-5px" },
      ],
      fields4: [
        { key: "opciones", label: "", class: "w-5px" },
        {
          key: "numero_pre",
          label: "Nro Presupuesto",
        },
        {
          key: "fecha_pre",
          label: "Fecha Cargada",
        },

        {
          key: "fecha_plazo",
          label: "Fecha Plazo",
        },
        {
          key: "presupuesto_monto",
          label: "Presupuesto Monto",
        },
        {
          key: "presupuesto_estado",
          label: "ESTADO",
        },
      ],
      ordenCompraD: [
        { key: "selected", label: "", class: "w-5px" },
        {
          key: "codigode_barra_items",
          label: "Codigo Barra",
        },
        {
          key: "descripcion_items",
          label: "Descripcion",
        },
        {
          key: "orden_compras_detalles_cantidad",
          label: "Cantidad",
        },
        {
          key: "orden_compras_detalles_precios",
          label: "Precios U.",
        },
        {
          key: "exenta",
          label: "EXENTA",
        },
        {
          key: "grav5",
          label: "Iva 5%",
        },
        {
          key: "grav10",
          label: "Iva 10%",
        },
      ],
      ordenCompraC: [
        { key: "selected", label: "", class: "w-5px" },
        {
          key: "numero_orden_compras",
          label: "Numero Orden Compra",
        },
        {
          key: "fecha_orden",
          label: "Fecha Creacion",
        },
        {
          key: "fecha_plazo",
          label: "Fecha Plazo",
        },
        {
          key: "personas_nombre_completo",
          label: "Proveedor",
        },
        {
          key: "orden_compras_estado",
          label: "Estado",
        },
      ],
      ProductoFields: [
        {
          key: "selected",
          label: "",
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
          key: "costo_items",
          label: "PRECIO COMPRA",
          sortable: true,
        },
        {
          key: "estado_items",
          label: "ESTADO",
        },
      ],
      listarFacturaCompra: [
        {
          key: "selected",
          label: "",
        },
        {
          key: "factura_compra_numero",
          label: "Numero Fact.",
          sortable: true,
        },
        {
          key: "personas_nombre_completo",
          label: "Proveedor",
          sortable: true,
        },
        {
          key: "fecha_registro",
          label: "Fecha Carga.",
          sortable: true,
        },
        {
          key: "fecha_emision_compras",
          label: "Fecha Emisi.",
          sortable: true,
        },
        {
          key: "fecha_vencimiento",
          label: "Fecha Venc.",
          sortable: true,
        },
        {
          key: "factura_compra_tipo",
          label: "Condicion Fact.",
          sortable: true,
        },
        {
          key: "moneda_descripcion",
          label: "Moneda",
          sortable: true,
        },
        {
          key: "factura_tasa_cambio",
          label: "T. Cambio",
          sortable: true,
        },
        {
          key: "factura_compra_total",
          label: "Total",
          sortable: true,
        },
      ],
      listarDetalle: [
        {
          key: "selected",
          label: "",
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
          key: "deposito_descripcion",
          label: "Deposito",
          sortable: true,
        },
        {
          key: "desglosar_descripcion",
          label: "Unidad M.",
          sortable: true,
        },

        {
          key: "factura_compra_detalle_cantidad",
          label: "Cantidad",
          sortable: true,
        },

        {
          key: "factura_compras_detalle_precio",
          label: "Precio",
          sortable: true,
        },
      ],
      listarCuotaGeneradas: [
        {
          key: "selected",
          label: "",
        },
        {
          key: "compra_cuota_cantidad",
          label: "Nro Cuota",
          sortable: true,
        },
        {
          key: "fecha_cuotas_ven",
          label: "Fecha Vencimiento",
          sortable: true,
        },
        {
          key: "compra_cuota_monto",
          label: "monto",
          sortable: true,
        },
        {
          key: "compra_cuota_saldo",
          label: "Saldo",
          sortable: true,
        },
      ],
    };
  },
  methods: {
    cancelar() {
      $(".Btn-verDetalle").prop("disabled", true);
      $("#Btn-generarCuotas").prop("disabled", true);
      $("#Btn-anular").prop("disabled", true);
      this.$refs.selectableTable.clearSelected();
    },
    seleccionarIndex(items, index) {
      var me = this;
      $("#Btn-cancelar").prop("disabled", false);
      $(".Btn-verDetalle").prop("disabled", false);
      $("#Btn-generarCuotas").prop("disabled", false);
      $("#Btn-anular").prop("disabled", false);
      me.soporte_items = items;
      console.log(items);
    },
    NotificacionProveedor(variant = "warning") {
      this.$bvToast.toast(
        `No se encontro proveedor con RUC: ` + this.ruc_buscar_proveedor,
        {
          title: "DATO NO ENCONTRADO",
          variant: variant,
          solid: true,
        }
      );
    },
    NotificacionOrden(variant = "warning") {
      this.$bvToast.toast(
        `No se encontro la Orden con Nro: ` + this.numero_orden_buscar,
        {
          title: "DATO NO ENCONTRADO",
          variant: variant,
          solid: true,
        }
      );
    },
    NotificacionProveedorValidacion(variant = "danger") {
      this.$bvToast.toast("LLENE EL CAMPO RUC", {
        title: "ERROR..",
        variant: variant,
        solid: true,
      });
    },

    validarFactura() {
      let me = this;
      me.errorFactura = 0;
      me.errorMostrarMsjFactura = [];
      if (me.factura_compras.condicion_factura == "")
        me.errorMostrarMsjFactura.push("Ingrese La Condicion compra");
      if (me.factura_compras.numero_factura == "")
        me.errorMostrarMsjFactura.push("Ingrese La el numero de la factura");
      if (me.factura_compras.fecha_emision == "")
        me.errorMostrarMsjFactura.push("Ingrese La Fecha emision");
      if (me.factura_compras.numero_timbrado == "")
        me.errorMostrarMsjFactura.push("Ingrese el numero de timbrado");
      if (me.factura_compras.tim_vencimiento == "")
        me.errorMostrarMsjFactura.push("Ingrese la fecha timbrado");
      if (me.factura_compras.idproveedor == "")
        me.errorMostrarMsjFactura.push("Ingrese el proveedor");
      if (me.factura_compras.idtipomoneda == "")
        me.errorMostrarMsjFactura.push("Ingrese el tipo moneda");
      if (me.factura_compras.idtipocomprobante == "")
        me.errorMostrarMsjFactura.push("Ingrese el tipo comprante");
      if (me.factura_compras.observacion == "")
        me.errorMostrarMsjFactura.push("Ingrese La Fecha");
      if (me.factura_compras.tasa_cambio == "")
        me.errorMostrarMsjFactura.push("Ingrese La tasa cambio");
      if (me.arrayDetalle.length <= 0)
        me.errorMostrarMsjFactura.push("Ingrese detalles");
      if (me.errorMostrarMsjFactura.length) me.errorFactura = 1;
      console.log(me.errorMostrarMsjFactura);
      return me.errorFactura;
    },

    GenerarCuotas() {
      var me = this;
      me.filasCuotas = [];
      $("#btn-guardarCuotas").prop("disabled", false);
      let cantidad = me.generar_cuotas.cantidad;
      var fecha = me.generar_cuotas.fechaVencimiento;
      var formaterfecha = new Date(fecha);
      let tipoPago = me.generar_cuotas.idtigopago;
      var id_compra = me.verCabecera[0].id_factura_compra;
      let EntregaInicial = me.generar_cuotas.entregaInicial;
      var total = Math.round(
        this.verCabecera[0].factura_compra_total - EntregaInicial
      );
      var montoCuota = Math.round(total / cantidad);
      if (EntregaInicial > this.verCabecera[0].factura_compra_total) {
        this.$bvToast.toast(
          `el monto : ` + EntregaInicial + ` es mayor al monto de la factura`,
          {
            title: "ERROR",
            variant: "danger",
            solid: true,
          }
        );
        total = 0;
      } else {
        if (EntregaInicial > 0) {
          for (let index = 0; index < cantidad; index++) {
            me.filasCuotas.push({
              id_compra: id_compra,
              cantidad: index + 1,
              fechaVencimiento:
                formaterfecha.getDate() +
                "/" +
                (formaterfecha.getMonth() + 1) +
                "/" +
                formaterfecha.getFullYear(),
              monto: montoCuota,
            });
            formaterfecha.setDate(formaterfecha.getDate() + tipoPago);
          }

          me.filasCuotas.unshift({
            id_compra: id_compra,
            cantidad: 0,
            fechaVencimiento:
             (formaterfecha.getDate()+ 1)  +
              "/" +
              (formaterfecha.getMonth() +1) +
              "/" +
              formaterfecha.getFullYear(),
            monto: EntregaInicial * -1,
          });
          formaterfecha.setDate(formaterfecha.getDate());
        } else {
          for (let index = 0; index < cantidad; index++) {
            me.filasCuotas.push({
              id_compra: id_compra,
              cantidad: index + 1,
              fechaVencimiento:
            (formaterfecha.getDate()+ 1) +
                "/" +
                (formaterfecha.getMonth() + 1) +
                "/" +
                formaterfecha.getFullYear(),
              monto: montoCuota,
            });
            formaterfecha.setDate(formaterfecha.getDate() + tipoPago);
          }
        }
      }
    },
    guardarCuotas() {
      var me = this;
      var parametros = {
        datos: me.filasCuotas,
      };
      axios
        .post("/factura_compras-GuardarCuotas", parametros)
        .then((response) => {
          this.$bvToast.toast(
            `SE GENERO ` +
              me.generar_cuotas.cantidad +
              ` CUOTAS DESDE LA FECHA  ` +
              me.generar_cuotas.fechaVencimiento,
            {
              title: "DATOS GUARDADOS",
              variant: "success",
              solid: true,
            }
          );
          console.log(response);
          me.generar_cuotas.entregaInicial = "";
          me.filasCuotas = [];
          me.listarCuotasGenerada;
        })
        .catch((error) => console.log(error));
    },
    agregar() {
        if (this.validarFactura()) {
        return;
      }
      let me = this;
      const parametros = {
        condicion_factura: me.factura_compras.condicion_factura,
        idordencompra: me.factura_compras.idordencompra,
        numero_factura: me.factura_compras.numero_factura,
        fecha_registro: me.factura_compras.fecha_registro,
        fecha_emision: me.factura_compras.fecha_emision,
        numero_timbrado: me.factura_compras.numero_timbrado,
        tim_vencimiento: me.factura_compras.tim_vencimiento,
        factura_fecha_vencimiento: me.factura_compras.factura_fecha_vencimiento,
        idusuario: me.factura_compras.idusuario,
        idsucursal: me.factura_compras.idsucursal,
        idproveedor: me.factura_compras.idproveedor,
        idtipomoneda: me.factura_compras.idtipomoneda,
        idtipocomprobante: me.factura_compras.idtipocomprobante,
        observacion: me.factura_compras.observacion,
        tasa_cambio: me.factura_compras.tasa_cambio,
        totalgeneral: me.factura_compras.totalcompra,
        observacion: me.factura_compras.observacion,
        grav5: me.factura_compras.grav5,
        grav10: me.factura_compras.grav10,
        afecta_stock: me.factura_compras.afecta_stock,
        detalles_facturas: me.arrayDetalle,
      };

      axios
        .post("/factura_compras-agregar", parametros)
        .then((response) => {
          this.$bvToast.toast(
            `SE AGREGO LA FACTURA ` +
              this.factura_compras.numero_factura +
              ` DEL PROVEEDOR ` +
              this.factura_compras.idproveedor,
            {
              title: "AGREGADO CON EXITO",
              variant: "success",
              solid: true,
            }
          );
          this.listarComprasL();
          this.factura_compras = {};
          this.arrayDetalle = [];
          this.direccion_exacta = "";
          this.ruc_buscar_proveedor ="";
          this.factura_compras.tasa_cambio ="";
        })
        .catch((error) => console.log(error));
    },
    listarComprasL() {
      axios
        .get("/factura_compras-index")
        .then((response) => {
          this.listarCompras = response.data;
        })
        .catch((error) => console.log(error));
    },
    ProductoModal() {
      axios
        .get("/Productos-Modal")
        .then((response) => {
          this.ProductosModal = response.data;
        })
        .catch((error) => console.log(error));
    },
    proveedorselect() {
      var me = this;
      axios
        .get("/proveedores")
        .then((response) => {
          me.optiones = response.data;
        })
        .catch((error) => console.log(error));
    },
    tazacambio: async function (event) {
      var el = this;
      var respuesta = [];
      var url = "/tazaCambios?valor=" + el.factura_compras.idtipomoneda;
      await axios
        .get(url)
        .then((response) => {
          respuesta = response.data;
          el.factura_compras.tasa_cambio = respuesta[0]["tipo_moneda_compra"];
        })
        .catch((error) => console.log(error));
    },
    tipocomprobanteselect() {
      var me = this;
      axios
        .get("/tipocomprobante")
        .then((response) => {
          me.tipocomprobante = response.data;
        })
        .catch((error) => console.log(error));
    },
    AgregarOrden(items) {
      console.log(items);
      var me = this;
      var arrayModal = [];
      this.factura_compras.idordencompra = items[0].id_orden_compras;
      this.factura_compras.idproveedor = items[0].id_proveedor;
      this.numero_orden_buscar = items[0].numero_orden_compras;
      this.proveedor_descripcion = items[0].personas_nombre_completo;
      this.proveedor_direccion = items[0].direccion_exacta;
      this.ruc_buscar_proveedor = items[0].cedula_identidad_personas;
      var url = "/OrdenCompra/DetalleModal?id=" + items[0].id_orden_compras;
      axios(url)
        .then((response) => {
          arrayModal = response.data;
          for (let i = 0; i < arrayModal.length; i++) {
            me.arrayDetalle.push({
              id_items: arrayModal[i].id_items,
              producto_codigode_barra: arrayModal[i].codigode_barra_items,
              producto_descripcion: arrayModal[i].descripcion_items,
              producto_cantidad: arrayModal[i].orden_compras_detalles_cantidad,
              producto_precio: arrayModal[i].orden_compras_detalles_precios,
              id_tipo_impuesto: arrayModal[i].id_tipo_impuesto,
              idunidad: 1,
              iddeposito: 1,
              tipo_impuesto_descripcion:
                arrayModal[i].tipo_impuesto_descripcion,
            });
          }
        })
        .catch((error) => console.log(error));
      this.$bvToast.toast(
        `Se Agrego la Orden : ` + items[0].numero_orden_compras,
        {
          title: "AGREGADO",
          variant: "success",
          solid: true,
        }
      );
    },
    autocompletadoOrden() {
      var me = this;
      var url = "/OrdenCompras/buscarOrden?id=" + me.numero_orden_buscar;
      axios
        .get(url)
        .then((response) => {
          me.OrdenCompra = response.data;
          if (me.OrdenCompra.length <= 0) {
            me.NotificacionOrden();
            me.ruc_buscar_proveedor = "";
            me.factura_compras.idproveedor = "";
            me.proveedor_direccion = "";
            me.mostrar = true;
          } else {
            me.ruc_buscar_proveedor =
              me.OrdenCompra[0]["cedula_identidad_personas"];
            me.factura_compras.idproveedor = me.OrdenCompra[0]["id_proveedor"];
            me.factura_compras.idordencompra =
              me.OrdenCompra[0]["id_orden_compras"];
            me.proveedor_direccion = me.OrdenCompra[0]["direccion_exacta"];
            me.mostrar = false;
          }
        })
        .catch((error) => console.log(error));

      // OBTENER DETALLE DE LA ORDEN COMPRA
      var url = "/OrdenCompras/buscarOrdenDetalle?id=" + me.numero_orden_buscar;
      axios
        .get(url)
        .then(function (response) {
          me.OrdenCompraDetalle = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    SelectProveedor() {
      var me = this;
      var datos = [];
      const url =
        "/proveedores/buscarProveedorId?id=" + me.factura_compras.idproveedor;
      axios
        .get(url)
        .then((response) => {
          datos = response.data;
          me.factura_compras.idproveedor = datos[0]["id_proveedor"];
          me.proveedor_direccion = datos[0]["direccion_exacta"];
          me.ruc_buscar_proveedor = datos[0]["cedula_identidad_personas"];
        })
        .catch((error) => console.log(error));
    },
    autocompletadoProveedor() {
      var me = this;
      if (me.ruc_buscar_proveedor == "") {
        me.ruc_buscar_proveedor = "";
        me.proveedor_descripcion = "";
        me.proveedor_direccion = "";
        me.NotificacionProveedorValidacion();
      } else {
        const url =
          "/proveedores/buscarProveedorRuc?ruc=" + me.ruc_buscar_proveedor;
        axios
          .get(url)
          .then((response) => {
            me.Proveedor = response.data;
            if (me.Proveedor.length <= 0) {
              me.ruc_buscar_proveedor = "";
              me.factura_compras.idproveedor = "";
              me.proveedor_direccion = "";
              me.NotificacionProveedor();
            } else {
              me.factura_compras.idproveedor = me.Proveedor[0]["id_proveedor"];
              me.proveedor_direccion = me.Proveedor[0]["direccion_exacta"];
            }
          })
          .catch((error) => console.log(error));
      }
    },
    listarDesglosar() {
      axios
        .get("/desglosar")
        .then((res) => {
          this.desglosar = res.data;
        })
        .catch((error) => console.log(error));
    },
    listarOrdenCompras() {
      axios
        .get("/OrdenComprasFactura")
        .then((res) => {
          this.OrdenCompra2 = res.data;
        })
        .catch((error) => console.log(error));
    },
    listarTipoMoneda() {
      axios
        .get("/tipomoneda")
        .then((res) => {
          this.tipomoneda = res.data;
        })
        .catch((error) => console.log(error));
    },
    listarDeposito() {
      axios
        .get("/depositos")
        .then((res) => {
          this.depositos = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
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
    onBlur() {
      this.listar_ = false;
    },
    editarCantidad(item) {
      this.idproducto = item.id_items;
      this.producto_cantidades = item.producto_cantidad;
      this.producto_precio = item.producto_precio;
      this.modoEditar2 = !this.modoEditar2;
      this.producto_precio = 0;
    },
    borrarProducto(item, index) {
      this.arrayDetalle.splice(index, 1);
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
    llenar(item) {
      this.factura_compras.idproducto = item.id_items;
      this.descripcion = item.descripcion_items;
      this.producto_precio = item.costo_items;
      this.producto_cantidad = 1;
      this.codigode_barra_producto = item.codigode_barra_items;
      this.tipo_impuesto_descripcion = item.tipo_impuesto_descripcion;
      this.id_tipo_impuesto = item.id_tipo_impuesto;
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

    agregarDetalle() {
      let me = this;
      if (me.encuentra(me.factura_compras.idproducto)) {
        swal({
          type: "error",
          title: "Error...",
          text: "Ese artículo ya se encuentra agregado!",
        });
      } else {
        me.arrayDetalle.push({
          id_items: me.factura_compras.idproducto,
          producto_codigode_barra: me.codigode_barra_producto,
          producto_descripcion: me.descripcion,
          producto_cantidad: me.producto_cantidad,
          producto_precio: me.producto_precio,
          idunidad: 1,
          iddeposito: 1,
          id_tipo_impuesto: me.id_tipo_impuesto,
          tipo_impuesto_descripcion: me.tipo_impuesto_descripcion,
          id_items: me.factura_compras.idproducto,
        });

        me.factura_compras.idproducto = 0;
        me.descripcion = "";
        me.producto_precio = 0;
        me.producto_cantidad = 0;
      }
    },
    agregarDetalleModalProductos(items) {
      let me = this;
      var armar = [];
      items.forEach((element) => {
        armar.id = element.id_items;
        armar.codigode_barra_items = element.codigode_barra_items;
        armar.descripcion_items = element.descripcion_items;
        armar.cantidad = element.cantidad;
        armar.costo = element.costo_items;
        armar.id_tipo_impuesto = element.id_tipo_impuesto;
        armar.tipo_impuesto_descripcion = element.tipo_impuesto_descripcion;
      });
      console.log(armar.id);
      if (me.encuentra(armar.id)) {
        this.$bvToast.toast(
          `EL PRODUCTO : ` +
            armar.descripcion_items +
            ` YA SE ENCUENTRA EN EL DETALLE `,
          {
            title: "ERROR",
            variant: "danger",
            solid: true,
          }
        );
      } else {
        me.arrayDetalle.push({
          id_items: armar.id,
          producto_codigode_barra: armar.codigode_barra_items,
          producto_descripcion: armar.descripcion_items,
          producto_cantidad: 1,
          producto_precio: armar.costo,
          idunidad: 1,
          iddeposito: 1,
          id_tipo_impuesto: armar.id_tipo_impuesto,
          tipo_impuesto_descripcion: armar.tipo_impuesto_descripcion,
        });
      }
    },
    agregarDetalleModalOrden(items) {
      let me = this;
      var armar = [];
      items.forEach((element) => {
        armar.id = element.id_items;
        (armar.codigode_barra_items = element.codigode_barra_items),
          (armar.descripcion_items = element.descripcion_items);
        armar.producto_codigode_barra = element.id_items;
        armar.orden_compras_detalles_cantidad =
          element.orden_compras_detalles_cantidad;
        armar.orden_compras_detalles_precios =
          element.orden_compras_detalles_precios;
        armar.id_tipo_impuesto = element.id_tipo_impuesto;
        armar.tipo_impuesto_descripcion = element.tipo_impuesto_descripcion;
      });
      console.log(armar.id);
      if (me.encuentra(armar.id)) {
        this.$bvToast.toast(
          `EL PRODUCTO : ` +
            armar.descripcion_items +
            ` YA SE ENCUENTRA EN EL DETALLE `,
          {
            title: "ERROR",
            variant: "danger",
            solid: true,
          }
        );
      } else {
        me.arrayDetalle.push({
          id_items: armar.id,
          producto_codigode_barra: armar.codigode_barra_items,
          producto_descripcion: armar.descripcion_items,
          producto_cantidad: armar.orden_compras_detalles_cantidad,
          producto_precio: armar.orden_compras_detalles_precios,
          idunidad: 1,
          iddeposito: 1,
          id_tipo_impuesto: armar.id_tipo_impuesto,
          tipo_impuesto_descripcion: armar.tipo_impuesto_descripcion,
        });

        me.factura_compras.idproducto = 0;
        me.descripcion = "";
        me.producto_precio = 0;
        me.producto_cantidad = 0;
      }
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
          idunidad: 1,
          iddeposito: 1,
          producto_precio: data["costo_items"],
          id_tipo_impuesto: data["id_tipo_impuesto"],
          tipo_impuesto_descripcion: data["tipo_impuesto_descripcion"],
        });
      }
    },
    agregarDetalleModal(data = []) {
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
          idunidad: 1,
          iddeposito: 1,
          producto_precio: data["costo_items"],
          tipo_impuesto_descripcion: data["tipo_impuesto_descripcion"],
        });
      }
    },
    verDetalleIndex() {
      let me = this;
      //Obtener Cabecera
      var url =
        "/FacturaCompra/obtenerCabecera?id=" +
        me.soporte_items[0]["id_factura_compra"];

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
        "/FacturaCompra/obtenerDetalle?id=" +
        me.soporte_items[0]["id_factura_compra"];
      axios
        .get(url)
        .then(function (response) {
          me.verDetalle = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
      //Obtener Cuotas
      var url =
        "/listar-cuotaGenerada?id=" + me.soporte_items[0]["id_factura_compra"];

      axios
        .get(url)
        .then((response) => {
          me.cuotasGeneradas = response.data;
        })
        .catch((error) => console.log(error));

      document.getElementById("pills-home-tab-custom").click();
    },
  },
  computed: {
    user() {
      return JSON.parse(user.content);
    },
    rows() {
      return this.listarCompras.length;
    },
    rows5() {
      return this.items.length;
    },
    rows2() {
      return this.modal_Articulo.length;
    },
    rows3() {
      return this.items3.length;
    },
    rows4() {
      return this.ProductoFields.length;
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
    calcularSubtotalIva5() {
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
    calcularSubtotalIva10() {
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
      var iva5 = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        if (this.arrayDetalle[i].tipo_impuesto_descripcion === "IVA 5%") {
          iva5 =
            iva5 +
            Math.round(
              (this.arrayDetalle[i].producto_precio *
                this.arrayDetalle[i].producto_cantidad) /
                21
            );
        }
      }
      return iva5;
    },
    Iva10() {
      var iva10 = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        if (this.arrayDetalle[i].tipo_impuesto_descripcion === "IVA 10%") {
          iva10 =
            iva10 +
            Math.round(
              (this.arrayDetalle[i].producto_precio *
                this.arrayDetalle[i].producto_cantidad) /
                11
            );
        }
      }
      return iva10;
    },
    totalgeneral() {
      let me = this;
      return (me.factura_compras.totalcompra =
        me.calcularSubtotalExenta +
        me.calcularSubtotalIva5 +
        me.calcularSubtotalIva10);
    },
    totalGravada5() {
      let me = this;
      var gravada5 = 0;
      for (var i = 0; i < me.arrayDetalle.length; i++) {
        if (me.arrayDetalle[i].tipo_impuesto_descripcion === "IVA 5%") {
          gravada5 =
            gravada5 +
            Math.round(
              (this.arrayDetalle[i].producto_precio *
                this.arrayDetalle[i].producto_cantidad) /
                1.05
            );
        }
      }
      return (me.factura_compras.grav5 = gravada5);
    },
    totalGravada10() {
      let me = this;
      var gravada10 = 0;
      for (var i = 0; i < me.arrayDetalle.length; i++) {
        if (me.arrayDetalle[i].tipo_impuesto_descripcion === "IVA 10%") {
          gravada10 =
            gravada10 +
            Math.round(
              (this.arrayDetalle[i].producto_precio *
                this.arrayDetalle[i].producto_cantidad) /
                1.1
            );
        }
      }
      return (me.factura_compras.grav10 = gravada10);
    },

    calcularSubtotalExentaDetalle() {
      var exenta = 0;
      for (var i = 0; i < this.verDetalle.length; i++) {
        if (this.verDetalle[i].tipo_impuesto_descripcion === "EXENTA") {
          exenta =
            exenta +
            this.verDetalle[i].factura_compra_detalle_cantidad *
              this.verDetalle[i].factura_compras_detalle_precio;
        }
      }
      return exenta;
    },
    calcularSubtotalIva5Detalle() {
      var grav5 = 0;
      for (var i = 0; i < this.verDetalle.length; i++) {
        if (this.verDetalle[i].tipo_impuesto_descripcion === "IVA 5%") {
          grav5 =
            grav5 +
            this.verDetalle[i].factura_compra_detalle_cantidad *
              this.verDetalle[i].factura_compras_detalle_precio;
        }
      }
      return grav5;
    },
    calcularSubtotalIva10Detalle() {
      var grav10 = 0;
      for (var i = 0; i < this.verDetalle.length; i++) {
        if (this.verDetalle[i].tipo_impuesto_descripcion === "IVA 10%") {
          grav10 =
            grav10 +
            this.verDetalle[i].factura_compra_detalle_cantidad *
              this.verDetalle[i].factura_compras_detalle_precio;
        }
      }
      return grav10;
    },
  },
  mounted() {
    let me = this;
    me.factura_compras.idusuario = me.$attrs.pedido_compra.id_usuarios;
    me.factura_compras.idsucursal = me.$attrs.pedido_compra.id_sucursal;
  },
  created() {
    this.listarOrdenCompras();
    this.listarTipoMoneda();
    this.proveedorselect();
    this.tipocomprobanteselect();
    this.ProductoModal();
    this.listarDesglosar();
    this.listarDeposito();
    this.listarComprasL();

    var fechaHoy = new Date();

    this.generar_cuotas.fechaVencimiento =
      fechaHoy.getFullYear() +
      "-" +
      (fechaHoy.getMonth() + 1) +
      "-" +
      fechaHoy.getDate();

    ///console.log(this.generar_cuotas.fechaVencimiento);
  },
};
</script>
<style scoped>
tr.highlighted td {
  background: red;
}
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