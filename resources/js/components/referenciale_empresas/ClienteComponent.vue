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
              @submit.prevent="editarDatos(cliente)"
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
                <legend>Informaciones Personales</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Persona</label>
                      <div class="col-sm-9">
                        <b-form-select
                          v-model="cliente.idpersona">
                        <option value="">--Seleccione--</option>
                          <option
                            v-for="(item, index) in personas"
                            :key="index"
                            v-bind:value="item.id_persona"
                          >{{item.nombre_personas}} {{item.apellido_personas}}</option>
                        </b-form-select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">RUC.</label>
                      <div class="col-sm-9">
                        <input-mask
                          v-model="cliente.cliente_ruc"
                          mask="9999999-9"
                          class="form-control"
                        ></input-mask>
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
                <legend>Informaciones Personales</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Persona</label>
                      <div class="col-sm-9">
                        <b-form-select
                          v-model="cliente.idpersona">
                        <option value="">--Seleccione--</option>
                          <option
                            v-for="(item, index) in personas"
                            :key="index"
                            v-bind:value="item.id_persona"
                          >{{item.nombre_personas}} {{item.apellido_personas}}</option>
                        </b-form-select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">RUC.</label>
                      <div class="col-sm-9">
                        <input-mask
                          v-model="cliente.cliente_ruc"
                          mask="9999999-9"
                          class="form-control"
                        ></input-mask>
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
                    <template v-slot:cell(cliente_estado)="{item}">
                       <b-badge pill :variant="getOrderStatusColor(item.cliente_estado)">{{item.cliente_estado}}</b-badge>
                    </template>

                    <template v-slot:cell(show_details)="row">
                      <b-button
                        size="sm"
                        @click="row.toggleDetails"
                        variant="primary"
                      >{{ row.detailsShowing ? '-' : '+'}}</b-button>
                    </template>

                    <template v-slot:row-details="row">
                      <b-card img-alt="Card image" img-right alt width="50" height="50">
                        <div style="font-size: 2rem;">
                          <b-avatar :src="'/foto_perfil/'+row.item.imagen_persona" size="6rem"></b-avatar>
                        </div>
                        <b-row class="mb-2">
                          <b-col sm="3" class="text-sm-right">
                            <b>Sexo:</b>
                          </b-col>
                          <b-col>{{ row.item.genero_personas }}</b-col>
                        </b-row>

                        <b-row class="mb-2">
                          <b-col sm="3" class="text-sm-right">
                            <b>Estado Civil:</b>
                          </b-col>
                          <b-col>{{ row.item.estado_civil_descripcion }}</b-col>
                        </b-row>
                        <hr />
                        <b-row class="mb-2">
                          <b-col sm="3" class="text-sm-right">
                            <b>Nacionalidad:</b>
                          </b-col>
                          <b-col>{{ row.item.nacionalidad_descripcion }}</b-col>
                        </b-row>

                        <b-row class="mb-2">
                          <b-col sm="3" class="text-sm-right">
                            <b>Ciudad:</b>
                          </b-col>
                          <b-col>{{ row.item.ciudades_descripcion }}</b-col>
                        </b-row>

                        <b-row class="mb-2">
                          <b-col sm="3" class="text-sm-right">
                            <b>Direccion:</b>
                          </b-col>
                          <b-col>{{ row.item.direccion_exacta}}</b-col>
                        </b-row>

                        <hr />
                        <b-row class="mb-2">
                          <b-col sm="3" class="text-sm-right">
                            <b>Correo:</b>
                          </b-col>
                          <b-col>{{ row.item.correo_electronico_personas }}</b-col>
                        </b-row>

                        <b-row class="mb-2">
                          <b-col sm="3" class="text-sm-right">
                            <b>Telefono:</b>
                          </b-col>
                          <b-col>{{ row.item.telefono_personas }}</b-col>
                        </b-row>
                      </b-card>
                    </template>

                    <template v-slot:cell(actions)="row">
                      <b-button
                        size="sm"
                        @click="editarFormulario(row.item)"
                        class="btn btn-warning"
                      ><b-icon icon="pencil-square"></b-icon></b-button>

                      <b-button v-if="row.item.cliente_estado === 'INACTIVO'"
                        size="sm"
                        @click="Cambiar(row.item, 3)"
                        class="btn btn-success"
                         v-b-tooltip.hover title="Activar Cliente"
                      ><b-icon icon="check-box"></b-icon></b-button>

                      <b-button v-else
                        size="sm"
                        @click="Cambiar(row.item, 4)"
                        class="btn btn-danger"
                         v-b-tooltip.hover title="InActivar Cliente"
                      ><b-icon icon="x-square"></b-icon></b-button>
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
      personas: [],
      cliente: {
        cliente_ruc: "",
        idpersona: "",
      },
      fields: [
        { key: "show_details", label: "", class: "w-5px" },
        {
          key: "id_cliente",
          label: "ID",
          sortable: true
        },
         {
          key: "cliente_numero_ruc",
          label: "Ruc",
          sortable: true
        },
        {
          key: "personas_nombre_completo",
          label: "Nombre Completo",
          sortable: true
        },
       
         { label: 'Estado',
          key: 'cliente_estado'},

        { key: "actions", label: "Actions" }
      ]
    };
  },
  methods: {
      getOrderStatusColor(cliente_estado ) {
      if(cliente_estado === 'ACTIVO') return "success"
      if(cliente_estado  === 'INACTIVO') return "danger"
    },
    listar() {
      axios
        .get("/clientes")
        .then(res => {
          this.items = res.data;
        })
        .catch(error => console.log(error));
    },
    agregar() {
      const params = {
         cliente_ruc : this.cliente.cliente_ruc,
         idpersona: this.cliente.idpersona
      };
       (this.cliente.cliente_ruc = ""),
        (this.cliente.idpersona = ""),
        axios
          .post("/guardar-Cliente", params)
          .then(res => {
            this.items.push(res.data);
            this.listar();
            swal("Correcto!", "Datos Ingresados Correctamente!", "success");
          })
          .catch(error => {
            let mensaje = "Error no identificado";
            swal("error", mensaje, "error");
          });
      document.getElementById("pills-profile-tab-custom").click();
    },
    editarFormulario(item) {
      this.cliente.id_cliente = item.id_cliente;
      this.cliente.cliente_ruc = item.cliente_numero_ruc;
      this.cliente.idpersona = item.id_persona;

      this.modoEditar = true;
      console.log(item);
      document.getElementById("pills-home-tab-custom").click();
    },
    editarDatos(cliente) {
      const params = { 
        cliente_ruc: cliente.cliente_ruc,
        idpersona:    cliente.idpersona
      };
      axios
        .put(`/editar-Cliente/${cliente.id_cliente}`, params)
        .then(res => {
          this.modoEditar = false;
          const index = this.items.findIndex(
            item => item.id_cliente === cliente.id_cliente
          );
          this.items[index] = res.data;
          this.listar();
          swal("Correcto!", "Se Edito!", "success");
        });
      (this.cliente.cliente_ruc = ""),
        (this.cliente.idpersona = ""),
        document.getElementById("pills-profile-tab-custom").click();
    },
    Cambiar(item ,operacion) {
        const params = {
        cliente_ruc : item.cliente_numero_ruc,
        idpersona: item.id_persona,
        operacion: operacion
      };
      axios
        .put(`/cambiar-Cliente/${item.id_cliente}`,params)
        .then(res => {
          this.items.push = res.data;
          this.listar();
          swal("Correcto!", "Se Cambio de Estado !", "success");
        });
    },
    cancelarEdicion() {
      this.modoEditar = false;
      this.cliente = {
        cliente_ruc: "",
        idpersona: ""
      };
    }
  },
  created() {
    this.listar();
    axios
      .get("/listar-Personas")
      .then(res => {
        this.personas = res.data;
      })
      .catch(error => console.log(error));

    axios
      .get("/cargos")
      .then(res => {
        this.cargos = res.data;
      })
      .catch(error => console.log(error));
  },
  computed: {
    rows() {
      return this.items.length;
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