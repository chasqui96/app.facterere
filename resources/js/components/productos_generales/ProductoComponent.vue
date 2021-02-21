<template>
  <div class="col-12 grid-margin">
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
            <h4 class="card-title">FORMULARIO</h4>
            <!-- FORMULARIO EDITAR -->
            <form
              class="forms-sample"
              enctype="multipart/form-data"
              @submit.prevent="editarDatos(producto)"
              v-if="modoEditar"
            >

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
                <legend>MODULO PRODUCTO</legend>
                <div class="row p-3 text-center">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Codigo De Barras</label>
                      <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="height:39px">
                            <i class="mdi mdi-barcode-scan mdi-20px"></i>
                          </span>
                        </div>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Codigo De Barras"
                          v-model="producto.producto_codigode_barra"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Categoria</label>
                      <b-form-select v-model="producto.idcategoria">
                        <option value>--Seleccione--</option>
                        <option
                          v-for="(item, index) in categorias"
                          :key="index"
                          v-bind:value="item.id_categoria"
                        >{{item.categoria_descripcion}}</option>
                      </b-form-select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Descripcion</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Descripcion del Producto"
                        v-model="producto.producto_descripcion"
                      />
                    </div>
                  </div>
                </div>

                <div class="row p-3 text-center">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Precio Compra</label>
                      <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="height:39px">Gs</span>
                        </div>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Precio Compra"
                          v-model="producto.producto_precio_costo"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Precio Venta Minorista</label>
                      <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="height:39px">Gs</span>
                        </div>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Precio Venta"
                          v-model="producto.producto_precio_venta_minorista"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Precio Venta Mayorista</label>
                      <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="height:39px">Gs</span>
                        </div>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Precio Venta"
                          v-model="producto.producto_precio_venta_mayorista"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Tipo Impuesto</label>
                      <b-form-select v-model="producto.idtipoimpuesto">
                        <option value>--Seleccione--</option>
                        <option
                          v-for="(item, index) in tipoimpuesto"
                          :key="index"
                          v-bind:value="item.id_tipo_impuesto"
                        >{{item.tipo_impuesto_descripcion}}</option>
                      </b-form-select>
                    </div>
                  </div>
                </div>
                <div class="row p-3 text-center">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Desglosar</label>
                      <b-form-select v-model="producto.iddesglosar">
                        <option value>--Seleccione--</option>
                        <option
                          v-for="(item, index) in desglosar"
                          :key="index"
                          v-bind:value="item.id_desglosar"
                        >{{item.desglosar_descripcion}}</option>
                      </b-form-select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Estante</label>
                      <b-form-select v-model="producto.idbloque">
                        <option value>--Seleccione--</option>
                        <option
                          v-for="(item,index) in bloques"
                          :key="index"
                          v-bind:value="item.id_bloque"
                        >{{item.bloques_descripcion}}</option>
                      </b-form-select>
                    </div>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>IMAGEN</legend>
                <div class="row p-3">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Imagen</label>
                      <input
                        type="file"
                        @change="ObtenerImagen"
                        ref="file-input"
                        class="form-control mt-2"
                      />
                      <b-button @click="borrar" class="mt-3">Reset</b-button>
                    </div>
                  </div>
                  <div class="col-md-6" v-if="producto.producto_imagen === ''">
                    <div class="form-group">
                      <img
                        src="/images/productodefault.png"
                        width="150"
                        height="150"
                        class="img-thumbnail"
                      />
                    </div>
                  </div>
                  <div class="col-md-6" v-else>
                    <div class="form-group">
                      <img :src="imagenes" width="150" height="150" class="img-thumbnail" />
                    </div>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>GENERAR CODIDO DE BARRAS</legend>
                <div class="row p-3">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputUsername1">BARRAS</label>
                      <div id="vs">
                        <svg
                          class="barcode"
                          :jsbarcode-format="formato"
                          :jsbarcode-value="producto.producto_codidode_barra"
                          :jsbarcode-linecolor="color"
                          jsbarcode-textmargin="0"
                          jsbarcode-fontoptions="bold"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Cantidad</label>
                      <input
                        type="text"
                        class="form-control"
                        id="exampleInputUsername1"
                        placeholder="Codigo De Barras"
                        v-model="cantidad_barcode"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Tipo</label>
                      <b-form-select :options="opciones" v-model="formato"></b-form-select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Color</label>
                      <b-form-select :options="colors" v-model="color"></b-form-select>
                    </div>
                  </div>
                  <div>
                    <a class="btn btn-outline-primary" @click="hacer(generar)">Generar</a>
                    <a href="#" class="btn btn-outline-warning" @click="imprimir(imprimir)">
                      <i class="mdi mdi-printer mr-1"></i>
                    </a>
                  </div>
                </div>
              </fieldset>
               </form>
            <!-- FIN FORMULARIO EDITAR -->

            <!-- FORMULARIO AGREGAR -->
            <form
              class="forms-sample"
              enctype="multipart/form-data"
              @submit.prevent="agregar"
              v-else
            >
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
                <legend>MODULO PRODUCTO</legend>
                <div class="row p-3 text-center">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Codigo De Barras</label>
                      <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="height:39px">
                            <i class="mdi mdi-barcode-scan mdi-20px"></i>
                          </span>
                        </div>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Codigo De Barras"
                          v-model="producto.producto_codigode_barra"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Categoria</label>
                      <b-form-select v-model="producto.idcategoria">
                        <option value>--Seleccione--</option>
                        <option
                          v-for="(item, index) in categorias"
                          :key="index"
                          v-bind:value="item.id_categoria"
                        >{{item.categoria_descripcion}}</option>
                      </b-form-select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Descripcion</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Descripcion del Producto"
                        v-model="producto.producto_descripcion"
                      />
                    </div>
                  </div>
                </div>

                <div class="row p-3 text-center">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Precio Compra</label>
                      <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="height:39px">Gs</span>
                        </div>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Precio Compra"
                          v-model="producto.producto_precio_costo"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Precio Venta Mayorista</label>
                      <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="height:39px">Gs</span>
                        </div>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Precio Venta"
                          v-model="producto.producto_precio_venta_mayorista"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Precio Venta Minorista</label>
                      <div class="input-group mb-3 mr-sm-3 mb-sm-0">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="height:39px">Gs</span>
                        </div>
                        <b-form-input
                          id="input-live"
                         v-model="producto.producto_precio_venta_minorista"
                          :state="validacionprecios"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Precio Minorista"
                          trim
                          required
                        ></b-form-input>
                      
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Tipo Impuesto</label>
                      <b-form-select v-model="producto.idtipoimpuesto">
                        <option value>--Seleccione--</option>
                        <option
                          v-for="(item, index) in tipoimpuesto"
                          :key="index"
                          v-bind:value="item.id_tipo_impuesto"
                        >{{item.tipo_impuesto_descripcion}}</option>
                      </b-form-select>
                    </div>
                  </div>
                </div>
                <div class="row p-3 text-center">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Desglosar</label>
                      <b-form-select v-model="producto.iddesglosar">
                        <option value>--Seleccione--</option>
                        <option
                          v-for="(item, index) in desglosar"
                          :key="index"
                          v-bind:value="item.id_desglosar"
                        >{{item.desglosar_descripcion}}</option>
                      </b-form-select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Estante</label>
                      <b-form-select v-model="producto.idbloque">
                        <option value>--Seleccione--</option>
                        <option
                          v-for="(item,index) in bloques"
                          :key="index"
                          v-bind:value="item.id_bloque"
                        >{{item.bloques_descripcion}}</option>
                      </b-form-select>
                    </div>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>IMAGEN</legend>
                <div class="row p-3">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Imagen</label>
                      <input
                        type="file"
                        @change="ObtenerImagen"
                        ref="file-input"
                        class="form-control mt-2"
                      />
                      <b-button @click="borrar" class="mt-3">Reset</b-button>
                    </div>
                  </div>
                  <div class="col-md-6" v-if="producto.producto_imagen === ''">
                    <div class="form-group">
                      <img
                        src="/images/productodefault.png"
                        width="150"
                        height="150"
                        class="img-thumbnail"
                      />
                    </div>
                  </div>
                  <div class="col-md-6" v-else>
                    <div class="form-group">
                      <img :src="imagenes" width="150" height="150" class="img-thumbnail" />
                    </div>
                  </div>
                </div>
              </fieldset>
              <div id="alerta"></div>
              <div id="alerta2"></div>
              <fieldset>
                <legend>GENERAR CODIDO DE BARRAS</legend>
                <div class="row p-3">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputUsername1">BARRAS</label>
                      <div class="card align-center">
                        <div id="vs">
                          <svg
                            class="barcode"
                            :jsbarcode-format="formato"
                            :jsbarcode-value="producto.producto_codigode_barra"
                            :jsbarcode-linecolor="color"
                            jsbarcode-textmargin="0"
                            jsbarcode-fontoptions="bold"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Cantidad</label>
                      <input
                        type="text"
                        class="form-control"
                        id="exampleInputUsername1"
                        placeholder="Codigo De Barras"
                        v-model="cantidad_barcode"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Tipo</label>
                      <b-form-select :options="opciones" v-model="formato"></b-form-select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Color</label>
                      <b-form-select :options="colors" v-model="color"></b-form-select>
                    </div>
                  </div>
                </div>
                <div class="row p-3">
                  <div class="col-md-3">
                    <a class="btn btn-outline-primary" @click="hacer(generar)">Generar</a>
                    <a href="#" class="btn btn-outline-warning" @click="imprimir(imprimir)">
                      <i class="mdi mdi-printer mr-1"></i>
                    </a>
                  </div>
                </div>
              </fieldset>
            </form>
            <!-- FIN DE FORMULARIO AGREGAR -->
          </div>

          <div
            class="tab-pane fade"
            id="pills-career"
            role="tabpanel"
            aria-labelledby="pills-profile-tab-custom"
          >
            <!-- Empieza la tabla -->
            <div class="content-wrapper">
              <fieldset>
                <legend>TABLA</legend>
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
                    small
                  >
                    <template v-slot:cell(estado_items)="{item}">
                      <b-badge
                        pill
                        :variant="getOrderStatusColor(item.estado_items)"
                      >{{item.estado_items}}</b-badge>
                    </template>
                    <template v-slot:cell(show_details)="row">
                      <b-button
                        size="sm"
                        @click="row.toggleDetails"
                        variant="primary"
                      >{{ row.detailsShowing ? '-' : '+'}}</b-button>
                    </template>

                    <template v-slot:row-details="row">
                      <b-card>
                        <b-row class="mb-2">
                          <b-col sm="3" class="text-sm-right">
                            <b>Precio Compra:</b>
                          </b-col>
                          <b-col>{{ row.item.costo_items}}</b-col>
                          <b-col sm="3" class="text-sm-right">
                            <b>Precio Venta Minorista:</b>
                          </b-col>
                          <b-col>{{ row.item.precio_minorista_items }}</b-col>
                        </b-row>
                        <b-row class="mb-2">
                          <b-col sm="3" class="text-sm-right">
                            <b>Tipo Iva:</b>
                          </b-col>
                          <b-col>{{ row.item.tipo_impuesto_descripcion}}</b-col>
                          <b-col sm="3" class="text-sm-right">
                            <b>Precio Venta Mayorista:</b>
                          </b-col>
                          <b-col>{{ row.item.precio_mayorista_items }}</b-col>
                        </b-row>
                        <b-row class="mb-2">
                          <b-col sm="3" class="text-sm-right">
                            <b>Venta Por:</b>
                          </b-col>
                          <b-col>{{ row.item.desglosar_descripcion }}</b-col>
                          <b-col sm="3" class="text-sm-right">
                            <b>Ubicacion del Producto:</b>
                          </b-col>
                          <b-col>{{ row.item.bloques_descripcion }}</b-col>
                        </b-row>
                      </b-card>
                    </template>
                    <!-- PARAGUAY	Guarani	PYG	600	0 -->

                    <template v-slot:cell(actions)="row">
                      <b-button
                        size="sm"
                        @click="editarFormulario(row.item)"
                        class="btn btn-warning"
                      >
                        <b-icon icon="pencil-square"></b-icon>
                      </b-button>

                      <b-button
                        v-if="row.item.estado_items === 'INACTIVO'"
                        size="sm"
                        @click="Cambiar(row.item, 3)"
                        class="btn btn-success"
                        v-b-tooltip.hover
                        title="Activar Funcionario"
                      >
                        <b-icon icon="check-box"></b-icon>
                      </b-button>

                      <b-button
                        v-else
                        size="sm"
                        @click="Cambiar(row.item, 4)"
                        class="btn btn-danger"
                        v-b-tooltip.hover
                        title="InActivar Funcionario"
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
            <!-- fin -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import jsPDF from "jspdf";
export default {
  data() {
    return {
      modoEditar: false,
      fixed: true,
      striped: true,
      bordered: true,
      perPage: 3,
      currentPage: 1,
      filter: null,
      items: [],
      VerImagen: "",
      categorias: [],
      bloques: [],
      tipoimpuesto: [],
      desglosar: [],
      formato: [],
      generar: "",
      color: "",
      cantidad_barcode: "",
      colors: [
        { value: "", text: "--Seleccione--" },
        { value: "#000000", text: "NEGRO" },
        { value: "#E50000", text: "ROJO" },
        { value: "#027814", text: "VERDE" },
        { value: "#020A78", text: "AZUL" },
        { value: "#0aa", text: "TURQUESA" }
      ],
      opciones: [
        { value: "", text: "--Seleccione--" },
        { value: "CODE128", text: "CODE128 auto" },
        { value: "CODE128A", text: "CODE128 A" },
        { value: "CODE128B", text: "CODE128 B" },
        { value: "CODE39", text: "CODE39" },
        { value: "EAN13", text: "EAN13" },
        { value: "EAN8", text: "EAN8" },
        { value: "ITF14", text: "ITF14" },
        { value: "ITF", text: "ITF" },
        { value: "MSI", text: "MSI" },
        { value: "MSI10", text: "MSI10" },
        { value: "MSI11", text: "MSI11" },
        { value: "MSI1010", text: "MSI1010" },
        { value: "MSI1110", text: "MSI1110" },
        { value: "PHARMACODE", text: "Pha" },
        { value: "UPC", text: "UPC" }
      ],
      producto: {
        producto_descripcion: "",
        producto_codigode_barra: "",
        producto_imagen: "",
        producto_precio_costo: "",
        producto_precio_venta_minorista: "",
        producto_precio_venta_mayorista: "",
        idcategoria: "",
        idtipoimpuesto: "",
        iddesglosar: "",
        idbloque: ""
      },
      fields: [
        { key: "show_details", label: "", class: "w-5px" },
        {
          key: "codigode_barra_items",
          label: "CODIGO BARRA",
          sortable: true
        },
        {
          key: "descripcion_items",
          label: "DESCRIPCION",
          sortable: true
        },
        {
          key: "categoria_descripcion",
          label: "CATEGORIA ",
          sortable: true
        },

        {
          key: "estado_items",
          label: "ESTADO",
          sortable: true
        },

        { key: "actions", label: "Actions" }
      ]
    };
  },
  created() {
    this.listarProductos();
    this.listarCategoria();
    this.listarBloques();
    this.listarDesglosar();
    this.listarTipoImpuesto();
  },
  methods: {
    getOrderStatusColor(estado_items) {
      if (estado_items === "ACTIVO") return "success";
      if (estado_items === "INACTIVO") return "danger";
    },
    agregar() {
      let formData = new FormData();
      formData.append(
        "producto_descripcion",
        this.producto.producto_descripcion
      ),
        formData.append(
          "producto_codigode_barra",
          this.producto.producto_codigode_barra
        ),
        formData.append("producto_imagen", this.producto.producto_imagen),
        formData.append(
          "producto_precio_costo",
          this.producto.producto_precio_costo
        ),
        formData.append(
          "producto_precio_venta_minorista",
          this.producto.producto_precio_venta_minorista
        ),
        formData.append(
          "producto_precio_venta_mayorista",
          this.producto.producto_precio_venta_mayorista
        ),
        formData.append("producto_idcategoria", this.producto.idcategoria),
        formData.append(
          "producto_idtipoimpuesto",
          this.producto.idtipoimpuesto
        ),
        formData.append("producto_iddesglosar", this.producto.iddesglosar),
        formData.append("producto_idbloque", this.producto.idbloque),
        axios
          .post("/guardar-Producto", formData)
          .then(res => {
            this.items.push(res.data);
            this.listarProductos();
            swal("Correcto!", "Datos Ingresados Correctamente!", "success");
            document.getElementById("pills-profile-tab-custom").click();
          })
          .catch(error => {
            let mensaje = "Error no identificado";
            swal("error", mensaje, "error");
          });
      (this.producto.producto_descripcion = ""),
        (this.producto.producto_codigode_barra = ""),
        (this.producto.producto_precio_costo = ""),
        (this.producto.producto_precio_venta_minorista = ""),
        (this.producto.producto_precio_venta_mayorista = ""),
        (this.producto.idcategoria = ""),
        (this.producto.idtipoimpuesto = ""),
        (this.producto.iddesglosar = ""),
        (this.producto.idbloque = ""),
        (this.producto.producto_imagen = ""),
        (this.$refs["file-input"].value = "");
    },
    editarFormulario(item) {
      this.producto.id_items = item.id_items;
      this.producto.producto_descripcion = item.descripcion_items;
      this.producto.producto_codigode_barra = item.codigode_barra_items;
      this.producto.producto_precio_costo = item.costo_items;
      this.producto.producto_precio_venta_minorista = item.precio_minorista_items;
      this.producto.producto_precio_venta_mayorista =item.precio_mayorista_items;
      this.producto.producto_imagen = item.imagen_url_items;
      this.producto.idcategoria = item.id_categoria;
      this.producto.idtipoimpuesto = item.id_tipo_impuesto;
      this.producto.iddesglosar = item.id_desglosar;
      this.producto.idbloque = item.id_bloque;
      this.modoEditar = true;
      document.getElementById("pills-home-tab-custom").click();
    },
    editarDatos(producto) {
      let formData = new FormData();
      formData.append(
        "producto_descripcion",
        this.producto.producto_descripcion
      ),
        formData.append(
          "producto_codigode_barra",
          this.producto.producto_codigode_barra
        ),
        formData.append("producto_imagen", this.producto.producto_imagen),
        formData.append(
          "producto_precio_costo",
          this.producto.producto_precio_costo
        ),
        formData.append(
          "producto_precio_venta_minorista",
          this.producto.producto_precio_venta_minorista
        ),
        formData.append(
          "producto_precio_venta_mayorista",
          this.producto.producto_precio_venta_mayorista
        ),
        formData.append("producto_idcategoria", this.producto.idcategoria),
        formData.append(
          "producto_idtipoimpuesto",
          this.producto.idtipoimpuesto
        ),
        formData.append("producto_iddesglosar", this.producto.iddesglosar),
        formData.append("producto_idbloque", this.producto.idbloque),
        formData.append("_method", "PUT");
      axios
        .post(`/editar-Producto/${producto.id_items}`, formData)
        .then(res => {
          this.modoEditar = false;
          const index = this.items.findIndex(
            item => item.id_items === producto.id_items
          );
          this.items[index] = res.data;
          this.listarProductos();
          swal("Correcto!", "Se Edito!", "success");
        });
      (this.producto.producto_descripcion = ""),
        (this.producto.producto_codigode_barra = ""),
        (this.producto.producto_precio_costo = ""),
        (this.producto.producto_precio_venta_minorista = ""),
        (this.producto.producto_precio_venta_mayorista = ""),
        (this.producto.idcategoria = ""),
        (this.producto.idtipoimpuesto = ""),
        (this.producto.iddesglosar = ""),
        (this.producto.idbloque = ""),
        (this.producto.producto_imagen = ""),
        (this.$refs["file-input"].value = "");
    },
    cancelarEdicion() {
      this.modoEditar = false;
      this.producto = {
        producto_descripcion: "",
        producto_codigode_barra: "",
        producto_imagen: "",
        producto_precio_costo: "",
        producto_precio_venta_minorista: "",
        producto_precio_venta_mayorista: "",
        idcategoria: "",
        idtipoimpuesto: "",
        iddesglosar: "",
        idbloque: ""
      };
    },
    Cambiar(item, operacion) {
      let formData = new FormData();
      formData.append("producto_descripcion", item.descripcion_items),
        formData.append(
          "producto_codigode_barra",
          item.producto_codigode_barra
        ),
        formData.append("producto_imagen", item.imagen_url_items),
        formData.append("producto_precio_costo", item.costo_items),
        formData.append(
          "producto_precio_venta_minorista",
          item.precio_minorista_items
        ),
        formData.append(
          "producto_precio_venta_mayorista",
          item.precio_mayorista_items
        ),
        formData.append("producto_idcategoria", item.id_categoria),
        formData.append("producto_idtipoimpuesto", item.id_tipo_impuesto),
        formData.append("producto_iddesglosar", item.id_desglosar),
        formData.append("producto_idbloque", item.id_bloque),
        formData.append("operacion", operacion),
        formData.append("_method", "PUT");
      axios.post(`/cambiar-Producto/${item.id_items}`, formData).then(res => {
        this.items.push = res.data;
        this.listarProductos();
        swal("Correcto!", "Se Cambio de Estado !", "success");
      });
    },
    listarProductos() {
      axios
        .get("/productos")
        .then(res => {
          this.items = res.data;
        })
        .catch(error => console.log(error));
    },
    listarCategoria() {
      axios
        .get("/categorias")
        .then(res => {
          this.categorias = res.data;
        })
        .catch(error => console.log(error));
    },
    listarBloques() {
      axios
        .get("/bloques")
        .then(res => {
          this.bloques = res.data;
        })
        .catch(error => console.log(error));
    },
    listarDesglosar() {
      axios
        .get("/desglosar")
        .then(res => {
          this.desglosar = res.data;
        })
        .catch(error => console.log(error));
    },
    listarTipoImpuesto() {
      axios
        .get("/tipoimpuestos")
        .then(res => {
          this.tipoimpuesto = res.data;
        })
        .catch(error => console.log(error));
    },
    ObtenerImagen(e) {
      let file = e.target.files[0];
      this.producto.producto_imagen = file;
      this.CargarImagen(file);
    },
    CargarImagen(file) {
      let reader = new FileReader();
      reader.onload = e => {
        this.VerImagen = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    borrar() {
      this.$refs["file-input"].value = "";
      this.producto.producto_imagen = "";
    },
    hacer(generar) {
      if (this.producto.producto_codigode_barra === "") {
        document.getElementById(
          "alerta2"
        ).innerHTML = `<div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert"  aria-label="close">&times;</a>
            <strong>Error!</strong> Llene el campo Codigo de Barra.
            </div>`;
      } else {
        JsBarcode(".barcode").init();
      }
    },
    imprimir() {
      if (this.cantidad_barcode === "") {
        document.getElementById(
          "alerta"
        ).innerHTML = `<div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert"  aria-label="close">&times;</a>
            <strong>Error!</strong> Llene el Campo Cantidad de Codigo de Barra para poder imprimir!.
            </div>`;
      } else {
        var _this = this;
        var codigo_tipo = document.getElementById("vs");
        var mywindow = window.open("", "PRINT", "height=400,width=600");
        mywindow.document.write("<html><head>");
        mywindow.document.write("</head><body>");
        mywindow.document.write(
          codigo_tipo.innerHTML.repeat(_this.cantidad_barcode)
        );
        mywindow.document.write("</body></html>");
        mywindow.document.close(); // necesario para IE >= 10
        mywindow.focus(); // necesario para IE >= 10
        mywindow.print();
        mywindow.close();
        return true;
      }
    }
  },
  computed: {
    imagenes() {
      return this.VerImagen;
    },
    rows() {
      return this.items.length;
    },
    validacionprecios(){
      return this.producto.producto_precio_venta_minorista.length < this.producto.producto_precio_venta_mayorista.length ? true : false;;
    }
  }
};
</script>
<style scoped>
div.error {
  color: #9f3a38;
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