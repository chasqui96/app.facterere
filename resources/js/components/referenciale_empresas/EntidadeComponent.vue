<template>
  <div class="row justify-content-md-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <fieldset>
            <legend>FORMLARIO ENTIDAD</legend>
            <form class="forms-sample" @submit.prevent="editarDatos(entidad)" v-if="modoEditar">
              <div class="form-group">
                <label for="exampleInputUsername1">DESCRIPCION</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInputUsername1"
                  v-model="entidad.descripcion"
                  placeholder="DESCRIPCION ENTIDAD"
                />
              </div>
              <button type="submit" class="btn btn-primary mr-2">EDITAR</button>
              <button class="btn btn-light" @click="cancelarEdicion">Cancelar</button>
            </form>
            <form class="forms-sample" @submit.prevent="agregar" v-else>
              <div class="form-group">
                <label for="exampleInputUsername1">DESCRIPCION</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInputUsername1"
                  v-model="entidad.descripcion"
                  placeholder="DESCRIPCION ENTIDAD"
                />
              </div>
              <button type="submit" class="btn btn-primary mr-2">GRABAR</button>
            </form>
          </fieldset>
          <hr>
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
        </div>
      </div>
    </div>

  </div>
</template>
<script>
import swal from "sweetalert";
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
      entidad: {
        descripcion: ""
      },
      fields: [
        {
          key: "id_entidades",
          label: "ID",
          sortable: true
        },
        {
          key: "entidades_razon_social",
          label: "CIUDADES",
          sortable: true
        },
        { key: "actions", label: "Actions" }
      ]
    };
  },
  created() {
    this.listar();
  },
  methods: {
    listar() {
      axios
        .get("/entidades")
        .then(res => {
          this.items = res.data;
        })
        .catch(error => console.log(error));
    },
    agregar() {
      if (this.entidad.descripcion === "") {
        swal("ERROR", "NO PUEDE DEJAR VACIO ESTE CAMPO", "error");
        return;
      }
      const params = {
        descripcion: this.entidad.descripcion
      };

      axios
        .post("/guardar-Entidad", params)
        .then(res => {
          this.items.push(res.data);
          this.listar();
          swal("Correcto!", "SE INSERTO CON EXITO", "success");
        })
        .catch(error => {
          let mensaje = "Error no identificado";
          swal("error", mensaje, "error");
        });
      this.entidad.descripcion = "";
    },
    editarFormulario(item) {
      this.entidad.id_entidades = item.id_entidades;
      this.entidad.descripcion = item.entidades_razon_social;
      this.modoEditar = true;
    },
    editarDatos(entidad) {
      const params = {
        descripcion: entidad.descripcion
      };

      axios.put(`/editar-Entidad/${entidad.id_entidades}`, params).then(res => {
        this.modoEditar = false;
        const index = this.items.findIndex(
          item => item.id_entidades === entidad.id_entidades
        );
        this.items[index] = res.data;
        this.listar();
        swal("Correcto!", "Se Edito!", "success");
      });
      this.entidad.descripcion = "";
    },
    eliminarDatos(entidad, index) {
      swal({
        title: "Desea eliminar ?",
        text: "Se eliminara de la base de datos!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          axios.delete(`/eliminar-Entidad/${entidad.id_entidades}`).then(() => {
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
      this.entidad= {
        descripcion: ""
      };
    }
  },
  computed: {
    rows() {
      return this.items.length;
    }
  }
};
</script>
<style  scoped>
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