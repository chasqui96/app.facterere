<template>
 <div class="row">
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
            
              <template v-if="modoEditar">
                 <div class="btn-toolbar justify-content-md-center">
                    <div class="btn-group">
                      <button type="submit" class="btn btn-sm btn-outline-secondary" @click="cancelarVer">
                        <i class="mdi mdi-window-close  text-primary mr-1" ></i>Cancelar
                      </button>
                    </div>
                  </div>
                <div class="container-fluid d-flex justify-content-between">
                  <div class="col-lg-3 pl-0" v-for="(item, index) in verCabecera" :key="index">
                    <p class="mt-5 mb-2">
                      <b>PEDIDO COMPRA NRO: {{item.numero_compra}}</b>
                    </p>
                  </div>
                  <div class="col-lg-3 pr-0">
                    <p class="mt-5 mb-2 text-right">
                      <b>Cabecera</b>
                    </p>
                    <p class="text-right" v-for="(item, index) in verCabecera" :key="index">
                      {{item.fecha_pedido}}
                      <br />
                      {{item.nombre_usuario}},
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
                        <tr class="text-right" v-for="(detalle,index) in verDetalle" :key="index">
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
                    <legend>PEDIDO COMPRAS</legend>
                    <div class="row p-3 text-center">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputUsername1">NRO DE PEDIDO</label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder
                            disabled
                            v-model="siguiente_numero"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputUsername1">PEDIDO FECHA</label>
                          <input-mask
                            v-model="compras_pedidos.pedido_fecha"
                            mask="99/99/9999"
                            class="form-control"
                          ></input-mask>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputUsername1">SUCURSAL</label>
                          <input type="hidden" v-bind:value="`${user.id_sucursal}`" />
                          <input
                            type="text"
                            class="form-control"
                            placeholder
                            disabled
                            v-bind:value="`${user.id_sucursal}`"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputUsername1">USUARIO</label>
                          <input type="hidden" />
                          <input
                            type="text"
                            class="form-control"
                            v-bind:value="`${user.nombre_usuario}`"
                            placeholder="Usuario"
                            disabled
                          />
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

                  <!-- COMIENZO CODIGO CARGA PRODUCTOS   -->
                  <fieldset>
                    <legend>CARGA DE PEDIDO</legend>
                    <div class="row p-3">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputUsername1">Productos</label>
                          <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                            <input type="hidden" v-model="compras_pedidos.idproducto" />
                            <input
                              class="typeahead"
                              type="search"
                              @blur="onBlur"
                              placeholder="Productos"
                              v-model="descripcion"
                              @keyup="autocomproducto();"
                              autocomplete="off"
                            />
                            <div class="input-group-prepend">
                              <b-button v-b-modal.modal-xl size="sm">
                                <b-icon icon="search"></b-icon>
                              </b-button>
                            </div>
                            <br />
                          </div>
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
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="exampleInputUsername1">PRECIO</label>
                          <input
                            type="text"
                            class="form-control"
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
                            <span style="color: red;" v-show="producto_cantidad==0">(*)</span>
                          </label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Cantidad Pedido"
                            v-model="producto_cantidad"
                            @keyup.prevent="agregarDetalle()"
                          />
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <b-button
                            variant="primary"
                            style="margin-top:30px;"
                            @click.prevent="agregarDetalle()"
                          >
                            <b-icon icon="plus-circle"></b-icon>
                          </b-button>
                        </div>
                      </div>
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
                        </b-tr>
                      </b-thead>
                      <b-tbody v-if="arrayDetalle.length">
                        <b-tr
                          v-for="(item, index) in arrayDetalle"
                          :key="index"
                          style="cursor:pointer;text-align:center;"
                        >
                          <b-td>
                            <button v-on:click.prevent="borrarProducto(item,index)">x</button>
                          </b-td>
                          <b-td
                            v-text="item.producto_codigode_barra"
                            @mousedown="editarCantidad(item)"
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
                          <b-td class="span_detalle">{{item.producto_precio | formatNumber}}</b-td>

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
              <!-- COMIENZO CODIGO MODAL -->
              <b-modal id="modal-xl" size="xl" title="LISTA DE PRODUCTOS">
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
                            v-b-modal.modal-xl
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
                   <input type="checkbox"  @click="agregarDetalleModal(item)">
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
            </div>
            <div
              class="tab-pane fade"
              id="pills-career"
              role="tabpanel"
              aria-labelledby="pills-profile-tab-custom"
            >
              <!-- COMIENZO DE LA TABLA -->
              <div class="content-wrapper">
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
                      :items="items2"
                      :striped="striped"
                      :bordered="bordered"
                      :fields="fields"
                      :filter="filter"
                      :per-page="perPage"
                      :current-page="currentPage"
                      responsive
                    >
                      <template v-slot:cell(opciones)="row">
                        <b-button size="sm" @click="verPedido(row.item)" class="btn btn-warning">Ver</b-button>
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
                        :total-rows="rows"
                        :per-page="perPage"
                        aria-controls="my-table"
                      ></b-pagination>
                    </div>
                  </div>
                </fieldset>
              </div>
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
      currentPage: 1,
      currentPage2: 1,
      buscar_articulo: [],
      modal_Articulo: [],
      verCabecera: [],
      verDetalle: [],
      errorPedido: 0,
      errorMostrarMsjPedido: [],
      listar_: false,
      descripcion_modal: "",
      selected: "codigode_barra_items",
      inheritAttrs: false,
      props: ["pedido_compra"],
      items2: [],
      compras_pedidos: {
        pedido_fecha: "",
        idusuario: '',
        idsucursal: ''
      },
      producto_cantidad: 0,
      producto_cantidades: 0,
      producto_precio: 0,
      codigode_barra_producto: "",
      tipo_impuesto_descripcion: "",
       descripcion: "",
      arrayDetalle: [],
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
          key: "costo_items",
          label: "PRECIO COMPRA",
          sortable: true
        },
        {
          key: "estado_items",
          label: "ESTADO"
        }
      ],
      fields: [
        {
          key: "opciones",
          label: "Opciones"
        },
        {
          key: "numero_compra",
          label: "Nro PEDIDO"
        },
        {
          key: "fecha_formater",
          label: "FECHA",
          sortable: true
        },
        {
          key: "nombre_usuario",
          label: "ENCARGADO",
          sortable: true
        },
        {
          key: "pedido_compras_estado",
          label: "ESTADO"
        }
      ],
      buscar_por: [
        { item: "codigode_barra_items", name: "Codigo de Barra" },
        { item: "descripcion_items", name: "Descripcion" }
      ]
    };
  },
  methods: {
    listarPedidoCompras() {
      axios
        .get("/listar-PedidoCompras")
        .then(res => {
          this.items2 = res.data;
          this.siguiente_numero = this.items2[0]["numero_siguiente"];
        })
        .catch(error => console.log(error));
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
    agregar() {
      if (this.validarPedido()) {
        return;
      }
      axios
        .post("/agregar-pedido_compra", {
          pedido_fecha: this.compras_pedidos.pedido_fecha,
          idusuario: this.compras_pedidos.idusuario,
          idsucursal: this.compras_pedidos.idsucursal,
          datos: this.arrayDetalle
        })
        .then(response => {
          swal("Correcto!", "SE INSERTO CON EXITO", "success");
          this.listarPedidoCompras();
          this.arrayDetalle = [];
          this.producto_cantidad = 0;
          this.producto_precio = 0;
          this.idproducto = 0;
          this.compras_pedidos.pedido_fecha = "";
        })
        .catch(error => {
          console.log(error);
        });
    },
    llenar(item) {
      this.compras_pedidos.idproducto = item.id_items;
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
    encuentra(id) {
      var sw = 0;
      for (var i = 0; i < this.arrayDetalle.length; i++) {
        if (this.arrayDetalle[i].id_items == id) {
          sw = true;
        }
      }
      return sw;
    },
    agregarDetalleModal(data = []) {
      console.log(typeof data);
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
    agregarDetalle() {
      let me = this;
      if (me.encuentra(me.compras_pedidos.idproducto)) {
        swal({
          type: "error",
          title: "Error...",
          text: "Ese artículo ya se encuentra agregado!"
        });
      } else {
        me.arrayDetalle.push({
          id_items: me.compras_pedidos.idproducto,
          producto_codigode_barra: me.codigode_barra_producto,
          producto_descripcion: me.descripcion,
          producto_cantidad: me.producto_cantidad,
          producto_precio: me.producto_precio,
          tipo_impuesto_descripcion: me.tipo_impuesto_descripcion
        });

        me.compras_pedidos.idproducto = 0;
        me.descripcion = "";
        me.producto_precio = 0;
        me.producto_cantidad = 0;
      }
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
          axios
            .put(`/Anular-PedidoCompra/${item.id_pedido_compras}`)
            .then(() => {
              this.items2.splice(index, 1);
              this.listarPedidoCompras();
            });
          swal("se ah eliminado correctamente", {
            icon: "success"
          });
        } else {
          swal("La operacion fue Cancelada!");
        }
      });
    },
    verPedido(item) {
      let me = this;
      me.modoEditar = true;
      //Obtener Cabecera

      var url = "/PedidoCompra/obtenerCabecera?id=" + item.id_pedido_compras;

      axios
        .get(url)
        .then(function(response) {
          me.verCabecera = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });

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

      document.getElementById("pills-home-tab-custom").click();
    },
    cancelarVer() {
      this.modoEditar = false;
      this.verCabecera = [];
      this.verDetalle = [];
    },
    validarPedido() {
      let me = this;
      me.errorPedido = 0;
      me.errorMostrarMsjPedido = [];

      if (me.compras_pedidos.pedido_fecha == "")
        me.errorMostrarMsjPedido.push("Ingrese La Fecha");
      if (me.arrayDetalle.length <= 0)
        me.errorMostrarMsjPedido.push("Ingrese detalles");
      if (me.errorMostrarMsjPedido.length) me.errorPedido = 1;

      return me.errorPedido;
    }
  },
  mounted(){
    let me = this;
    me.compras_pedidos.idusuario = me.$attrs.pedido_compra.id_usuarios;
    me.compras_pedidos.idsucursal = me.$attrs.pedido_compra.id_sucursal;
  },
  computed: {
    user(){
  
     return  JSON.parse(user.content);
    },
    rows() {
      return this.items2.length;
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
    }
  },
  created() {
    this.listarPedidoCompras();
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
