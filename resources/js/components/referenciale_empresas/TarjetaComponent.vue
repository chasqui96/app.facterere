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
              @submit.prevent="editarDatos(tarjeta)"
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
                <legend>FORMULARIO TARJETA</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Descripcion</label>
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputUsername1"
                          v-model="tarjeta.descripcion"
                          placeholder="DESCRIPCION TARJETA"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Marcas</label>
                      <div class="col-sm-9">
                        <b-form-select v-model="tarjeta.idmarcatarjeta">
                          <option value="">--Seleccione--</option>
                          <option
                            v-for="(item, index) in marcatarjetas"
                            :key="index"
                            v-bind:value="item.id_marca_tarjeta"
                          >{{item.marca_tarjeta_descripcion}}</option>
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
                <legend>FORMULARIO TARJETAS</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Descripcion</label>
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputUsername1"
                          v-model="tarjeta.descripcion"
                          placeholder="DESCRIPCION TARJETAS"
                        />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Marcas</label>
                      <div class="col-sm-9">
                        <b-form-select v-model="tarjeta.idmarcatarjeta">
                          <option value="">--Seleccione--</option>
                          <option
                            v-for="(item, index) in marcatarjetas"
                            :key="index"
                            v-bind:value="item.id_marca_tarjeta"
                          >{{item.marca_tarjeta_descripcion}}</option>
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
                    <template v-slot:cell(actions)="row">
                      <b-button
                        size="sm"
                        @click="editarFormulario(row.item)"
                        class="btn btn-warning"
                      >
                        Editar
                      </b-button>

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
      marcatarjetas: [],
      tarjeta: {
        descripcion: "",
        idmarcatarjeta: ""
      },
      fields: [
        {
          key: "id_tarjeta",
          label: "ID",
          sortable: true
        },
        {
          key: "tarjeta_tipo",
          label: "Descripcion",
          sortable: true
        },
        { key: "marca_tarjeta_descripcion",
         label: "Marca",
        },

        { key: "actions", label: "Actions" }
      ]
    };
  },
  methods: {
    listar() {
      axios
        .get("/tarjetas")
        .then(res => {
          this.items = res.data;
        })
        .catch(error => console.log(error));
    },
    agregar() {
      const params = {
        descripcion: this.tarjeta.descripcion,
        idmarcatarjeta: this.tarjeta.idmarcatarjeta
      };
      (this.tarjeta.descripcion = ""),
        (this.tarjeta.idmarcatarjeta = ""),
        axios
          .post("/guardar-Tarjeta", params)
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
      this.tarjeta.id_tarjeta = item.id_tarjeta;
       this.tarjeta.descripcion = item.tarjeta_tipo;
      this.tarjeta.idmarcatarjeta = item.id_marca_tarjeta;
      this.modoEditar = true;
      document.getElementById("pills-home-tab-custom").click();
    },
    editarDatos(tarjeta) {
       const params = {
        descripcion: tarjeta.descripcion,
        idmarcatarjeta:  tarjeta.idmarcatarjeta
      };
      axios
        .put(`/editar-Tarjeta/${tarjeta.id_tarjeta}`, params)
        .then(res => {
          this.modoEditar = false;
          const index = this.items.findIndex(
            item => item.id_tarjeta === tarjeta.id_tarjeta
          );
          this.items[index] = res.data;
          this.listar();
          swal("Correcto!", "Se Edito!", "success");
        });
       (this.tarjeta.descripcion = ""),
        (this.tarjeta.idmarcatarjeta = ""),
        document.getElementById("pills-profile-tab-custom").click();
    },
    eliminarDatos(tarjeta, index) {
      swal({
        title: "Desea eliminar ?",
        text: "Se eliminara de la base de datos!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          axios.delete(`/eliminar-Tarjeta/${tarjeta.id_tarjeta}`).then(() => {
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
      this.tarjeta = {
        descripcion: "",
        idmarcatarjeta: ""
      };
    }
  },
  created() {
    this.listar();
    axios
      .get("/marcatarjetas")
      .then(res => {
        this.marcatarjetas = res.data;
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