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
        
    
              <form class="forms-sample" @submit.prevent="editarDatos(stocks)" v-if="modoEditar">
                     <!-- CODIGO BOTONES -->
                  <div class="btn-toolbar justify-content-md-center">
                    <div class="btn-group">
                      <button type="submit" class="btn btn-sm btn-outline-secondary">
                        <i class="mdi mdi-settings text-primary mr-1"></i>Editar
                      </button>
                      <button type="submit" class="btn btn-sm btn-outline-secondary"  @click="cancelarEdicion">
                        <i class="mdi mdi-window-close text-primary mr-1"></i>Cancelar
                      </button>
                    </div>
                  </div>
                  <!-- FIN CODIGO BOTONES -->
                <fieldset>
                  <legend>Editar Formulario</legend>
                  <table
                    style="text-align:center;"
                    class="table table-bordered table-striped table-hover"
                  >
                    <thead>
                      <tr>
                        <th>DESCRIPCION</th>
                        <th>DEPOSITO</th>
                        <th>STOCK ACTUAL</th>
                        <th>STOCK MINIMO</th>
                        <th>STOCK MAXIMO</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <input type="hidden" v-model="stocks.id_producto" />
                          <input
                            class="form-control form-control-sm"
                            type="search"
                            @blur="onBlur"
                            placeholder="Productos"
                            v-model="descripcion"
                            @keyup="autocomproducto();"
                            autocomplete="off"
                          />
                          <br />

                          <b-list-group class="autocomplete mt-2" v-if="listar_">
                            <b-list-group-item
                              button
                              v-for="(item, index) in buscar_articulo"
                              :key="index"
                              v-text="item.descripcion_producto"
                              v-bind:value="item.id_producto"
                              @mousedown="llenar(item)"
                            ></b-list-group-item>
                          </b-list-group>
                        </td>
                        <td>
                          <b-form-select v-model="stocks.iddeposito">
                            <option value>--Seleccione--</option>
                            <option
                              v-for="(item, index) in depositos"
                              :key="index"
                              v-bind:value="item.id_deposito"
                            >{{item.deposito_descripcion}}</option>
                          </b-form-select>
                        </td>
                        <td>
                          <input type="text" class="form-control form-control-sm" v-model="stocks.stock_cantidad" />
                        </td>
                        <td>
                          <input type="text" class="form-control form-control-sm" v-model="stocks.stock_minimo" />
                        </td>
                        <td>
                          <input type="text" class="form-control form-control-sm" v-model="stocks.stock_maximo" />
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </fieldset>
              </form>
              <form class="forms-sample" v-else @submit.prevent="agregar">
                              <!-- CODIGO BOTONES -->
                  <div class="btn-toolbar justify-content-md-center">
                    <div class="btn-group">
                      <button type="submit" class="btn btn-sm btn-outline-secondary">
                        <i class="mdi mdi-floppy text-primary mr-1"></i>Grabar
                      </button>
                    </div>
                  </div>
                  <!-- FIN CODIGO BOTONES -->
                <fieldset>
                  <legend>STOCK ALTA</legend>
                  <div class="row p-3 text-center">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Productos</label>
                        <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                          <input type="hidden" v-model="stocks.id_producto" />
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
                    <div class="col-md-3">
                      <div class="form-group">
                        <label >Stock Cantidad</label>
                        <input
                          type="text"
                          class="form-control form-control-sm"
                          placeholder="Stock"
                          v-model="stocks.stock_cantidad"
                        />
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label >Stock Minimo</label>
                        <input
                          type="text"
                          class="form-control form-control-sm"
                          placeholder="Stock Minimo"
                          v-model="stocks.stock_minimo"
                        />
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Stock Maximo</label>
                        <input
                          type="text"
                          class="form-control form-control-sm"
                          placeholder="Stock Maximo"
                          v-model="stocks.stock_maximo"
                        />
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Deposito</label>
                        <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                          <b-form-select v-model="stocks.iddeposito">
                            <option value>--Seleccione--</option>
                            <option
                              v-for="(item, index) in depositos"
                              :key="index"
                              v-bind:value="item.id_deposito"
                            >{{item.deposito_descripcion}}</option>
                          </b-form-select>
                        </div>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
            <b-modal id="modal-xl" size="xl" title="LISTA DE PRODUCTOS">
              <div class="row p-3">
                <div class="col-md-6">
                  <div class="form-group">
                    <label >Buscar Por</label>
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
                    <label>Ingrese</label>
                    <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                      <input
                        class="form-control form-control-sm"
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
                    <b-button size="sm" @mousedown="llenar(item)" variant="success"><b-icon icon="arrow-return-left"></b-icon></b-button>
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
            <div
              class="tab-pane fade"
              id="pills-career"
              role="tabpanel"
              aria-labelledby="pills-profile-tab-custom"
            >
              <fieldset>
                  <legend>TABLA</legend>
                  <div>
  <b-table-simple hover small caption-top responsive bordered>
    <colgroup><col><col></colgroup>
    <colgroup><col><col><col></colgroup>
    <colgroup><col><col></colgroup>
    <b-thead head-variant="dark" style="text-align:center">
      <b-tr>
        <b-th colspan="3" rowspan="2" style="align:center" >DESCRIPCION PRODUCTO</b-th>
        <b-th rowspan="2">DEPOSITO</b-th>
        <b-th colspan="3">TIPO DE MOVIMIENTO</b-th>
        <b-th colspan="2">PRECIOS</b-th>
        <b-th colspan="2">STOCK</b-th>
      </b-tr>
      <b-tr>
        <b-th>Ultimo Ingreso</b-th>
        <b-th>Stock Ant.</b-th>
        <b-th>Stock Actual</b-th>
        <b-th>Precio Anterior</b-th>
        <b-th>Precio Actutal</b-th>
         <b-th>Stock Minimo</b-th>
          <b-th>Stock Maximo</b-th>
      </b-tr>
    </b-thead>
    <b-tbody>
      <b-tr>
        <b-td>47822</b-td>
        <b-td class="text-right">TALADRO MAKITA DE HOY</b-td>
        <b-td>UNIDAD</b-td>
        <b-td>CENTRAL</b-td>
        <b-td>25</b-td>
        <b-td>43</b-td>
        <b-td variant="success">72</b-td>
        <b-td>23</b-td>
        <b-td>23</b-td>
        <b-td>23</b-td>
        <b-td>23</b-td>
      </b-tr>
         <b-tr>
        <b-td>47822</b-td>
        <b-td class="text-right">TALADRO MAKITA DE HOY</b-td>
        <b-td>UNIDAD</b-td>
        <b-td>CENTRAL</b-td>
        <b-td>25</b-td>
        <b-td>43</b-td>
        <b-td variant="success">72</b-td>
        <b-td>23</b-td>
        <b-td>23</b-td>
        <b-td>23</b-td>
        <b-td>23</b-td>
      </b-tr>
         <b-tr>
        <b-td>47822</b-td>
        <b-td class="text-right">TALADRO MAKITA DE HOY</b-td>
        <b-td>UNIDAD</b-td>
        <b-td>CENTRAL</b-td>
        <b-td>25</b-td>
        <b-td>43</b-td>
        <b-td variant="success">72</b-td>
        <b-td>23</b-td>
        <b-td>23</b-td>
        <b-td>23</b-td>
        <b-td>23</b-td>
      </b-tr>
         <b-tr>
        <b-td>47822</b-td>
        <b-td class="text-right">TALADRO MAKITA DE HOY</b-td>
        <b-td>UNIDAD</b-td>
        <b-td>CENTRAL</b-td>
        <b-td>25</b-td>
        <b-td>43</b-td>
        <b-td variant="success">72</b-td>
        <b-td>23</b-td>
        <b-td>23</b-td>
        <b-td>23</b-td>
        <b-td>23</b-td>
      </b-tr>
    </b-tbody>
  </b-table-simple>
</div>
                  <div class="col-lg-12">
                    <b-col lg="3" class="my-1">
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
                      :items="items"
                      :striped="striped"
                      :bordered="bordered"
                      :fields="fields"
                      :filter="filter"
                      :per-page="perPage"
                      :current-page="currentPage"
                      responsive
                    >
                      <template v-slot:cell(stock_cantidad)="{item}">
                        <span
                          :class="getOrderStockColor(item.stock_cantidad)"
                          v-if="item.stock_cantidad >= 100"
                        >
                          {{item.stock_cantidad}} Unidad
                          <i class="mdi mdi-arrow-up"></i>
                        </span>
                        <span
                          :class="getOrderStockColor(item.stock_cantidad)"
                          v-else-if="item.stock_cantidad >= 21"
                        >
                          {{item.stock_cantidad }} Unidad
                          <i class="mdi mdi-arrow-down"></i>
                        </span>
                        <span
                          :class="getOrderStockColor(item.stock_cantidad)"
                          v-else-if="item.stock_cantidad <= 20"
                        >
                          {{item.stock_cantidad }} Unidad
                          <i class="mdi mdi-arrow-down"></i>
                        </span>
                      </template>
                      <template v-slot:cell(stock_minimo)="{item}">
                        <span class="text-danger">{{item.stock_minimo}}</span>
                      </template>
                      <template v-slot:cell(stock_maximo)="{item}">
                        <span class="text-success">{{item.stock_maximo}}</span>
                      </template>
                      <template v-slot:cell(stock_estado)="{item}">
                        <b-badge
                          :variant="getOrderStatusColor(item.stock_estado)"
                        >{{item.stock_estado}}</b-badge>
                      </template>
                      <template v-slot:cell(actions)="row">
                        <b-button
                          size="sm"
                          @click="editarFormulario(row.item)"
                          class="btn btn-warning"
                        >Editar</b-button>
                        <b-button
                          v-if="row.item.stock_estado === 'INACTIVO'"
                          size="sm"
                          @click="Cambiar(row.item, 3)"
                          class="btn btn-success"
                          v-b-tooltip.hover
                          title="Activar Stock"
                        >
                          <b-icon icon="check-box"></b-icon>
                        </b-button>

                        <b-button
                          v-else
                          size="sm"
                          @click="Cambiar(row.item, 4)"
                          class="btn btn-danger"
                          v-b-tooltip.hover
                          title="InActivar Stock"
                        >
                          <b-icon icon="x-square"></b-icon>
                        </b-button>
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
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- optional indicators -->
</template>

<script>
export default {
  data() {
    return {
      depositos: [],
      fixed: true,
      striped: true,
      bordered: true,
      perPage: 3,
      perPage2: 6,
      currentPage: 1,
      currentPage2: 1,
      filter: null,
      listar_: false,
      selected: "codigode_barra_producto",
      buscar_articulo: [],
      descripcion_modal: "",
      buscar_db: "",
      descripcion: "",
      stocks: {
        id_producto: "",
        stock_cantidad: "",
        stock_minimo: "",
        stock_maximo: "",
        iddeposito: ""
      },
      items: [],
      modal_Articulo: [],
      buscar_por: [
        { item: "codigode_barra_producto", name: "Codigo de Barra" },
        { item: "descripcion_producto", name: "Descripcion" }
      ],
      fields2: [
        {key: "id_items",
          label: " ",},
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
          key: "precio_minorista_items",
          label: "PRECIO VENTA",
          sortable: true
        },
        {
          key: "estado_items",
          label: "ESTADO"
        }
      ],
      fields: [
        {
          key: "descripcion_items",
          label: "DESCRIPCION",
          sortable: true
        },
        {
          key: "deposito_descripcion",
          label: "DEPOSITO",
          sortable: true
        },
        {
          key: "stock_cantidad",
          label: "STOCK ACTUAL",
          sortable: true
        },
        {
          key: "stock_minimo",
          label: "STOCK MINIMO",
          sortable: true
        },
        {
          key: "stock_maximo",
          label: "STOCK MAXIMO",
          sortable: true
        },
        {
          key: "stock_estado",
          label: "ESTADO"
        },

        { key: "actions", label: "Actions" }
      ],
      modoEditar: false
    };
  },
  created() {
    this.tablaStock();
    this.listarDeposito();
  },
  methods: {
    getOrderStatusColor(stock_estado) {
      if (stock_estado === "ACTIVO") return "success";
      if (stock_estado === "INACTIVO") return "danger";
    },
    getOrderStockColor(stock_cantidad) {
      if (stock_cantidad >= 100) return "text-success";
      else if (stock_cantidad >= 21) return "text-warning";
      else if (stock_cantidad <= 20) return "text-danger";
    },
    llenar(item) {
      this.stocks.id_producto = item.id_items;
      this.descripcion = item.descripcion_items;
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
    onBlur() {
      this.listar_ = false;
    },
    agregar() {
      const params = {
        idproducto: this.stocks.id_producto,
        stock_cantidad: this.stocks.stock_cantidad,
        stock_minimo: this.stocks.stock_minimo,
        stock_maximo: this.stocks.stock_maximo,
        iddeposito: this.stocks.iddeposito
      };
      axios
        .post("/guardar-stock", params)
        .then(res => {
          this.items.push(res.data);
          this.tablaStock();
          swal("Correcto!", "SE INSERTO CON EXITO", "success");
        })
        .catch(error => {
          let mensaje = "Error no identificado";
          swal("error", mensaje, "error");
        });
      this.descripcion = "";
      this.stocks.iddeposito = "";
      this.stocks.id_producto = "";
      this.stocks.stock_cantidad = "";
      this.stocks.stock_minimo = "";
      this.stocks.stock_maximo = "";
    },
    tablaStock() {
      axios
        .get("/listar-stock")
        .then(res => {
          this.items = res.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    listarDeposito() {
      axios
        .get("/depositos")
        .then(res => {
          this.depositos = res.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    editarFormulario(item) {
      this.descripcion = item.descripcion_items;
      this.stocks.id_producto = item.id_items;
      this.stocks.iddeposito = item.id_deposito;
      this.stocks.stock_cantidad = item.stock_cantidad;
      this.stocks.stock_minimo = item.stock_minimo;
      this.stocks.stock_maximo = item.stock_maximo;
      this.modoEditar = true;
      document.getElementById("pills-home-tab-custom").click();
    },
    editarDatos(stocks) {
      const params = {
        stock_cantidad: stocks.stock_cantidad,
        stock_minimo: stocks.stock_minimo,
        stock_maximo: stocks.stock_maximo,
        idproducto: stocks.id_producto,
        iddeposito: stocks.iddeposito
      };

      axios
        .put(`/editar-Stock/${stocks.id_producto}`, params)
        .then(res => {
          this.modoEditar = false;
          const index = this.items.findIndex(
            item => item.id_items === stocks.id_producto
          );
          this.items[index] = res.data;
          this.tablaStock();
          swal("Correcto!", "Se Edito!", "success");
        })
        .catch(error => {
          let mensaje = "NO PUEDE DUPLICAR EL PRODUCTO,YA EXITE";
          swal("error", mensaje, "error");
        });
      this.descripcion = "";
      this.stocks.iddeposito = "";
      this.stocks.id_producto = "";
      this.stocks.stock_cantidad = "";
      this.stocks.stock_minimo = "";
      this.stocks.stock_maximo = "";
    },

    Cambiar(item, operacion) {
      const params = {
        idproducto: item.id_items,
        iddeposito: item.id_deposito,
        stock_cantidad: item.stock_cantidad,
        stock_minimo: item.stock_minimo,
        stock_maximo: item.stock_maximo,
        operacion: operacion
      };
      axios.put(`/cambiar-Stock/${item.id_items}`, params).then(res => {
        this.items.push = res.data;
        this.tablaStock();
        swal("Correcto!", "Se Cambio de Estado !", "success");
      });
    },
    cancelarEdicion() {
      this.modoEditar = false;
      this.stocks = {
        stock_cantidad: "",
        stock_minimo: "",
        stock_maximo: "",
        iddeposito: "",
        id_producto: ""
      };
    }
  },
  computed: {
    rows() {
      return this.items.length;
    },
    rows2() {
      return this.modal_Articulo.length;
    }
  }
};
</script>
<style scoped>
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
.autocomplete {
  display: block;
  position: absolute;
  z-index: 1000;
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