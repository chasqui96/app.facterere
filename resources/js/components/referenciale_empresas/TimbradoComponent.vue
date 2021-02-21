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

            <!-- comienzo de formulario Editar -->
            <form
              class="form-sample"
              enctype="multipart/form-data"
              @submit.prevent="editarDatos(timbrado)"
              v-if="modoEditar"
            >
               <!-- CODIGO BOTONES -->
                  <div class="btn-toolbar justify-content-md-center">
                    <div class="btn-group">
                      <button type="submit" class="btn btn-sm btn-outline-secondary">
                        <i class="mdi-settings text-primary mr-1"></i>Editar
                      </button>
                      <button type="submit" class="btn btn-sm btn-outline-secondary"  @click="cancelarEdicion">
                        <i class="mdi mdi-window-close text-primary mr-1"></i>Cancelar
                      </button>
                    </div>
                  </div>
                  <!-- FIN CODIGO BOTONES -->
              <fieldset>
                <legend>FORMULARIO TIMBRADO</legend>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">NroTimbrado</label>
                      <div class="col-sm-9">
                           <b-form-input
                          id="input-live"
                          v-model="timbrado.timbrado_numero"
                          :state="timbradonumero"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca 8 digitos"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Desde</label>
                      <div class="col-sm-9">
                        <input-mask
                          v-model="timbrado.timbrado_desde"
                          mask="99/99/9999"
                          class="form-control"
                          required
                        ></input-mask>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Hasta</label>
                      <div class="col-sm-9">
                        <input-mask
                          v-model="timbrado.timbrado_hasta"
                          mask="99/99/9999"
                          class="form-control"
                      
                        ></input-mask>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Documento</label>
                      <div class="col-sm-9">
                        <b-form-select v-model="timbrado.timbrado_documento">
                          <option value>--Seleccione--</option>
                          <option value="FACTURA">FACTURA</option>
                          <option value="TICKET">TICKECT</option>
                          <option value="NOTA">NOTA CREDITO O DEBITO</option>
                        </b-form-select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Estable.</label>
                      <div class="col-sm-9">
              
                
                            <b-form-input
                          id="input-live"
                         v-model="timbrado.timbrado_establecimiento"
                          :state="timbradoestablecimiento"
                          aria-describedby="input-live-help input-live-feedback"
                         placeholder="Introduzca Establecimiento Ej:1"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Expedi.</label>
                      <div class="col-sm-9">
                        
                            <b-form-input
                          id="input-live"
                          v-model="timbrado.timbrado_expedicion"
                          :state="timbradoexpedicion"
                          aria-describedby="input-live-help input-live-feedback"
                           placeholder="Introduzca Expedicion Ej:2"
                          trim
                          required
                        ></b-form-input>
                
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nro Incial.</label>
                      <div class="col-sm-9">
                  
                              <b-form-input
                          id="input-live"
                           v-model="timbrado.timbrado_nro_inicial"
                          :state="timbradonumeroinicial"
                          aria-describedby="input-live-help input-live-feedback"
                            placeholder="Nro Inicial Ej:1"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nro Final</label>
                      <div class="col-sm-9">
                       
                          <b-form-input
                          id="input-live"
                           v-model="timbrado.timbrado_nro_final"
                          :state="timbradonumerofinal"
                          aria-describedby="input-live-help input-live-feedback"
                            placeholder="Nro Final Ej:50"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Ult. Numero</label>
                      <div class="col-sm-9">
                          <b-form-input
                          id="input-live"
                           v-model="timbrado.timbrado_ult_numero"
                          :state="timbradoultimo"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Ultimo Nro Ej:50"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Sucursal</label>
                      <div class="col-sm-9">
                        <b-form-select v-model="timbrado.idsucursal" >
                          <option value>--Seleccione--</option>
                          <option
                            v-for="(item, index) in sucursales"
                            :key="index"
                            v-bind:value="item.id_sucursal"
                          >{{item.sucursal_descripcion}}</option>
                        </b-form-select>
                      </div>
                    </div>
                  </div>
                </div>
              </fieldset>
            </form>
            <!-- fin formulario editar -->

            <!-- comienzo formulario agregar -->
            <form
              class="form-sample"
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
                <legend>FORMULARIO TIMBRADO</legend>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">NroTimbrado</label>
                      <div class="col-sm-9">
                           <b-form-input
                          id="input-live"
                          v-model="timbrado.timbrado_numero"
                          :state="timbradonumero"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca 8 digitos"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Desde</label>
                      <div class="col-sm-9">
                        <input-mask
                          v-model="timbrado.timbrado_desde"
                          mask="99/99/9999"
                          class="form-control"
                          required
                        ></input-mask>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Hasta</label>
                      <div class="col-sm-9">
                        <input-mask
                          v-model="timbrado.timbrado_hasta"
                          mask="99/99/9999"
                          class="form-control"
                        required
                        ></input-mask>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Documento</label>
                      <div class="col-sm-9">
                        <b-form-select v-model="timbrado.timbrado_documento">
                          <option value>--Seleccione--</option>
                          <option value="FACTURA">FACTURA</option>
                          <option value="TICKET">TICKECT</option>
                          <option value="NOTA">NOTA CREDITO O DEBITO</option>
                        </b-form-select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Estable.</label>
                      <div class="col-sm-9">
              
                
                            <b-form-input
                          id="input-live"
                         v-model="timbrado.timbrado_establecimiento"
                          :state="timbradoestablecimiento"
                          aria-describedby="input-live-help input-live-feedback"
                         placeholder="Introduzca Establecimiento Ej:1"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Expedi.</label>
                      <div class="col-sm-9">
                        
                            <b-form-input
                          id="input-live"
                          v-model="timbrado.timbrado_expedicion"
                          :state="timbradoexpedicion"
                          aria-describedby="input-live-help input-live-feedback"
                           placeholder="Introduzca Expedicion Ej:2"
                          trim
                          required
                        ></b-form-input>
                
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nro Incial.</label>
                      <div class="col-sm-9">
                  
                              <b-form-input
                          id="input-live"
                           v-model="timbrado.timbrado_nro_inicial"
                          :state="timbradonumeroinicial"
                          aria-describedby="input-live-help input-live-feedback"
                            placeholder="Nro Inicial Ej:1"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nro Final</label>
                      <div class="col-sm-9">
                       
                          <b-form-input
                          id="input-live"
                           v-model="timbrado.timbrado_nro_final"
                          :state="timbradonumerofinal"
                          aria-describedby="input-live-help input-live-feedback"
                            placeholder="Nro Final Ej:50"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Ult. Numero</label>
                      <div class="col-sm-9">
                          <b-form-input
                          id="input-live"
                           v-model="timbrado.timbrado_ult_numero"
                          :state="timbradoultimo"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Ultimo Nro Ej:50"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Sucursal</label>
                      <div class="col-sm-9">
                        <b-form-select v-model="timbrado.idsucursal" >
                          <option value>--Seleccione--</option>
                          <option
                            v-for="(item, index) in sucursales"
                            :key="index"
                            v-bind:value="item.id_sucursal"
                          >{{item.sucursal_descripcion}}</option>
                        </b-form-select>
                      </div>
                    </div>
                  </div>
                </div>
              </fieldset>

            </form>
            <!-- fin formulario agregar -->
          </div>
          <div
            class="tab-pane fade"
            id="pills-career"
            role="tabpanel"
            aria-labelledby="pills-profile-tab-custom"
          >
            <!-- Empieza la tabla -->
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
                  >
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
                            <b>Establecimiento:</b>
                          </b-col>
                          <b-col>{{ row.item.formateo_establecimiento}}</b-col>
                        </b-row>

                        <b-row class="mb-2">
                          <b-col sm="3" class="text-sm-right">
                            <b>Sucursal:</b>
                          </b-col>
                          <b-col>{{ row.item.formateo_punto_expedicion }}</b-col>
                        </b-row>
                        <b-row class="mb-2">
                          <b-col sm="3" class="text-sm-right">
                            <b>Numero Inicio:</b>
                          </b-col>
                          <b-col>{{ row.item.formateo_inicial }}</b-col>
                          <b-col sm="3" class="text-sm-right">
                            <b>Tipo Documento:</b>
                          </b-col>
                          <b-col>{{ row.item.timbrado_tipo_documento }}</b-col>
                        </b-row>
                        <hr>
                          <b-row class="mb-2">
                          <b-col sm="3" class="text-sm-right">
                            <b>Numero Fiscal desde:</b>
                          </b-col>
                          <b-col>{{ row.item.formateo_establecimiento}}-{{ row.item.formateo_punto_expedicion }}-{{ row.item.formateo_inicial }}</b-col>
                                           <b-col sm="3" class="text-sm-right">
                            <b>Numero Fiscal hasta:</b>
                          </b-col>
                          <b-col>{{ row.item.formateo_establecimiento}}-{{ row.item.formateo_punto_expedicion }}-{{ row.item.formateo_ultimo_numero }}</b-col>
                        </b-row>
                        </b-card>
                        

                    </template>
                    <template v-slot:cell(actions)="row">
                      <b-button
                        size="sm"
                        @click="editarFormulario(row.item)"
                        class="btn btn-warning"
                      >Editar</b-button>

                      <b-button
                        size="sm"
                        @click="eliminarDatos(row.item, row.index)"
                        class="btn btn-danger"
                      >Eliminar</b-button>
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
            <!-- fin -->
          </div>
        </div>
      </div>
      <div class="card-body"></div>
      <hr />
    </div>
  </div>
</template>
<script>
import InputMask from "vue-input-mask";
import swal from "sweetalert";
export default {
  components: {
    InputMask
  },
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
      sucursales: [],
      timbrado: {
        timbrado_numero: "",
        timbrado_desde: "",
        timbrado_desde: "",
        timbrado_establecimiento: "",
        timbrado_expedicion: "",
        idsucursal: "",
        timbrado_nro_inicial: "",
        timbrado_nro_final: "",
        timbrado_ult_numero: "",
        timbrado_documento: ""
      },
      fields: [
        { key: "show_details", label: "", class: "w-5px" },
        {
          key: "id_timbrado",
          label: "ID",
          sortable: true
        },
        {
          key: "timbrado_numero",
          label: "Timbrado Nro",
          sortable: true
        },
         {
          key: "fecha_desde",
          label: "Vigente Desde",
          sortable: true
        },
          {
          key: "fecha_hasta",
          label: "Vigente Hasta",
          sortable: true
        },
        { label: "Sucursal", key: "sucursal_descripcion" },

        { key: "actions", label: "Actions" }
      ]
    };
  },
  methods: {
    listar() {
      axios
        .get("/timbrados")
        .then(res => {
          this.items = res.data;
        })
        .catch(error => console.log(error));
    },
    agregar() {
        if( this.timbrado.timbrado_desde === ''){
       swal('error','llene el campo fecha','error');
     }else if(this.timbrado.timbrado_hasta=== ''){
       swal('error','llene el campo fecha','error');
     }else{
      const params = {
        timbrado_numero: this.timbrado.timbrado_numero,
        timbrado_desde: this.timbrado.timbrado_desde,
        timbrado_hasta: this.timbrado.timbrado_hasta,
        timbrado_nro_inicial: this.timbrado.timbrado_nro_inicial,
        timbrado_nro_final: this.timbrado.timbrado_nro_final,
        timbrado_documento: this.timbrado.timbrado_documento,
        timbrado_ult_numero: this.timbrado.timbrado_ult_numero,
        timbrado_establecimiento: this.timbrado.timbrado_establecimiento,
        timbrado_expedicion: this.timbrado.timbrado_expedicion,
        idsucursal: this.timbrado.idsucursal
      };

      axios
        .post("/guardar-Timbrado", params)
        .then(res => {
          this.items.push(res.data);
          this.listar();
          swal("Correcto!", "Datos Ingresados Correctamente!", "success");
        })
        .catch(error => {
          let mensaje = "Error no identificado";
          swal("error", mensaje, "error");
        });
      // limpiamos los campos
      (this.timbrado.timbrado_numero = ""),
        (this.timbrado.timbrado_desde = ""),
        (this.timbrado.timbrado_hasta = ""),
        (this.timbrado.timbrado_nro_inicial = ""),
        (this.timbrado.timbrado_nro_final = ""),
        (this.timbrado.timbrado_documento = ""),
        (this.timbrado.timbrado_ult_numero = ""),
        (this.timbrado.timbrado_establecimiento = ""),
        (this.timbrado.timbrado_expedicion = ""),
        (this.timbrado.idsucursal = "");
      ///////////////////////////////////
      document.getElementById("pills-profile-tab-custom").click();
     }
    },
    editarFormulario(item) {
      this.timbrado.id_timbrado = item.id_timbrado;
      this.timbrado.timbrado_numero = item.timbrado_numero;
      this.timbrado.timbrado_desde = item.fecha_desde;
      this.timbrado.timbrado_hasta = item.fecha_hasta;
      this.timbrado.timbrado_nro_inicial = item.timbrado_numero_inicial;
      this.timbrado.timbrado_nro_final = item.timbrado_numero_final;
      this.timbrado.timbrado_documento = item.timbrado_tipo_documento;
      this.timbrado.timbrado_ult_numero = item.timbrado_ultimo_numero;
      this.timbrado.timbrado_establecimiento = item.timbrado_establecimiento;
      this.timbrado.timbrado_expedicion = item.timbrado_punto_expedicion;
      this.timbrado.idsucursal = item.id_sucursal;
      this.modoEditar = true;
      document.getElementById("pills-home-tab-custom").click();
    },
    editarDatos(timbrado) {
      const params = {
        timbrado_numero: timbrado.timbrado_numero,
        timbrado_desde: timbrado.timbrado_desde,
        timbrado_hasta: timbrado.timbrado_hasta,
        timbrado_nro_inicial: timbrado.timbrado_nro_inicial,
        timbrado_nro_final: timbrado.timbrado_nro_final,
        timbrado_documento: timbrado.timbrado_documento,
        timbrado_ult_numero: timbrado.timbrado_ult_numero,
        timbrado_establecimiento: timbrado.timbrado_establecimiento,
        timbrado_expedicion: timbrado.timbrado_expedicion,
        idsucursal: timbrado.idsucursal
      };
      axios
        .put(`/editar-Timbrado/${timbrado.id_timbrado}`, params)
        .then(res => {
          this.modoEditar = false;
          const index = this.items.findIndex(
            item => item.id_timbrado === timbrado.id_timbrado
          );
          this.items[index] = res.data;
          this.listar();
          swal("Correcto!", "Se Edito!", "success");
        });
      // limpiamos los campos
      (this.timbrado.timbrado_numero = ""),
        (this.timbrado.timbrado_desde = ""),
        (this.timbrado.timbrado_hasta = ""),
        (this.timbrado.timbrado_nro_inicial = ""),
        (this.timbrado.timbrado_nro_final = ""),
        (this.timbrado.timbrado_documento = ""),
        (this.timbrado.timbrado_ult_numero = ""),
        (this.timbrado.timbrado_establecimiento = ""),
        (this.timbrado.timbrado_expedicion = ""),
        (this.timbrado.idsucursal = "");
      ///////////////////////////////////
      document.getElementById("pills-profile-tab-custom").click();
    },
    eliminarDatos(timbrado, index) {
      swal({
        title: "Desea eliminar ?",
        text: "Se eliminara de la base de datos!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          axios
            .delete(`/eliminar-Timbrado/${timbrado.id_timbrado}`)
            .then(() => {
              this.items.splice(index, 1);
              this.listar();
            });
          swal("se ah eliminado correctamente", {
            icon: "success"
          });
        } else {
          swal("La operacion fue Cancelada!");
        }
      });
    },

    cancelarEdicion() {
      this.modoEditar = false;
      this.deposito = {};
    }
  },
  created() {
    this.listar();

    axios
      .get("/sucursales")
      .then(res => {
        this.sucursales = res.data;
      })
      .catch(error => console.log(error));
  },
  computed: {
    rows() {
      return this.items.length;
    },
      timbradonumero() {
      return this.timbrado.timbrado_numero.length === 8 ? true : false;
    },
     timbradoestablecimiento() {
      return this.timbrado.timbrado_establecimiento.length > 0  ? true : false;
    },
     timbradoexpedicion() {
      return this.timbrado.timbrado_expedicion.length > 0  ? true : false;
    },
     timbradonumeroinicial() {
      return this.timbrado.timbrado_nro_inicial.length > 0  ? true : false;
    },
     timbradonumerofinal() {
      return this.timbrado.timbrado_nro_final.length > 0  ? true : false;
    },
     timbradoultimo() {
      return this.timbrado.timbrado_ult_numero.length > 0 ? true : false;
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