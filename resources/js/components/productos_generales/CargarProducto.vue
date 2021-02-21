<template>
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="card px-3">
          <div class="card-body">
            <h4 class="card-title">SUBIR ARCHIVO</h4>
            <div class="alert alert-danger alert-dismissible" v-if="mensajes">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <b>Por favor corriga los siguientes errores:</b>
              <ul>
                <li v-for="(item,index) in errors" :key="index">{{ item }}</li>
              </ul>
            </div>
            <div id="prueba"></div>
            <form
              class="forms-sample"
              enctype="multipart/form-data"
              @submit.prevent="agregarproductos"
            >
              <div class="add-items d-flex">
                <input
                  type="file"
                  class="form-control todo-list-input"
                  @change="Obtenerarchivo"
                  ref="file-input"
                />
                <button
                  class="add btn btn-primary font-weight-bold todo-list-add-btn"
                  id="add-task"
                >
                  <i class="mdi mdi-database-plus"></i>
                </button>
              </div>
            </form>
            <b-modal id="modal-xl" size="xl">
              <b-table id="my-table" :items="items" sticky-header small head-variant="light"></b-table>
            </b-modal>
            <!-- -->
            <div class="list-wrapper">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Detalles</h4>
                    <div class="table-responsive">
                      <table class="table table-striped text-center">
                        <thead>
                          <tr>
                            <th>Registros Disponibles</th>
                            <th>Progreso</th>
                            <th>Registros Impotados</th>
                            <th>Estado</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody v-for="(item, index) in carga" :key="index">
                          <tr>
                            <td>{{item.count}}</td>
                            <td>
                              <b-progress
                                :value="value"
                                :max="max"
                                show-progress
                                animated
                                wit
                                :variant="variant"
                              ></b-progress>
                            </td>
                            <td>{{item.total}}</td>
                            <td v-if="item.count === 0">
                              <i class="mdi mdi-numeric-0-box-outline"></i>
                            </td>
                            <td v-else>
                              <i class="mdi mdi-check-circle"></i>
                            </td>
                            <td>
                              <b-button v-b-modal.modal-xl variant="primary">
                                Ver
                                <i class="mdi mdi-eye"></i>
                              </b-button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
      archivo_xlsx: "",
      variant: "primary",
      value: 0,
      max: 100,
      carga: [],
      errors: [],
      mensajes: false,
      items: [],
      fields: [
        {
          ID: "id_producto",
          CODIGOBARRA: "codigode_barra_producto",
          DESCRIPCION: "descripcion_producto",
          CATEGORIA: "categoria_descripcion"
        }
      ]
    };
  },
  created() {
    this.cargarProductos();
  },
  methods: {
    listarProductos() {
      axios
        .get("/productos")
        .then(res => {
          this.items = res.data;
        })
        .catch(error => console.log(error));
    },
    cargarProductos() {
      axios
        .get("/carga-Producto")
        .then(res => {
          this.carga = res.data;
        })
        .catch(error => console.log(error));
    },
    Obtenerarchivo(e) {
      let file = e.target.files[0];
      this.archivo_xlsx = file;
    },
    agregarproductos() {
      var _this = this;
      let formData = new FormData();
      formData.append("producto_archivo", this.archivo_xlsx);
      axios
        .post("/subir-Producto", formData, {
          onUploadProgress: function(e) {
            _this.value = Math.round((e.loaded / e.total) * 100);
          }
        })
        .then(res => {
          document.getElementById(
            "prueba"
          ).innerHTML = ` <div class="alert alert-success alert-dismissible" show>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Completado!</strong> La importacion se realizo con exitos.
            </div>`;
          //swal("Correcto!", "Se Subio todos los Datos", "success");
          this.cargarProductos();
          this.listarProductos();
          this.value = 0;
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            this.mensajes = true;
            this.value = 0;
          } else if (error.response.status === 500) {
            document.getElementById(
              "prueba"
            ).innerHTML = `<div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert"  aria-label="close">&times;</a>
            <strong>Error!</strong> NO se puede duplicar el mismo Codigo.
            </div>`;
            this.value = 0;
          }
        });
      this.$refs["file-input"].value = "";
    }
  }
};
</script>