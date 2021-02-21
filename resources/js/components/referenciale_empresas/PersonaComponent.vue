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
              @submit.prevent="editarDatos(personas)"
              v-if="modoEditar"
            >
                 <div class="btn-toolbar justify-content-md-center">
                    <div class="btn-group">
                          <button type="submit" class="btn btn-sm btn-outline-secondary" >
                        <i class="mdi mdi-settings text-primary mr-1" ></i>Editar
                      </button>
                      <button type="button" class="btn btn-sm btn-outline-secondary" @click="cancelarEdicion">
                        <i class="mdi mdi-window-close  text-primary mr-1" ></i>Cancelar
                      </button>
                    </div>
                  </div>
              <fieldset>
                <legend>Cargar Foto de Perfil</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <div class="col-sm-9" v-if="personas.imagen === null">
                        <img src="/images/defaul.png" width="100" class="img-thumbnail " />
                        <input type="file" @change="ObtenerImagen" ref="file-input" class="form-control mt-3" />
                      </div>
                      <!-- <div class="col-sm-9" v-else-if="personas.imagen === ''">
                        <img :src="'/foto_perfil/'+personas.imagen" width="100" class="img-thumbnail" />
                        <input type="file" @change="ObtenerImagen" class="form-control" />
                      </div>-->
                      <div class="col-sm-9" v-else>
                        <img :src="imagenes" width="100" class="img-thumbnail" />
                        <input type="file" @change="ObtenerImagen" ref="file-input" class="form-control mt-3" />
                        <b-button @click="borrar" class="mt-3">Reset</b-button>
                      </div>
                    </div>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>Informaciones Personales</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nombres</label>
                      <div class="col-sm-9">
                        <b-form-input
                          id="input-live"
                          v-model="personas.nombre"
                          :state="nameState"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca un nombre"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Apellidos</label>
                      <div class="col-sm-9">
                        <b-form-input
                          id="input-live"
                          v-model="personas.apellido"
                          :state="apellidoestado"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca un nombre"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Genero</label>
                      <div class="col-sm-9">
                        <b-form-select v-model="personas.genero">
                          <option value="">>--Seleccione--</option>
                          <option value="MASCULINO">MASCULINO</option>
                          <option value="FEMENINO">FEMENINO</option>
                        </b-form-select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Feha de Naci.</label>
                      <div class="col-sm-9">
                        <input-mask
                          v-model="personas.fecha_nacimiento"
                          mask="99/99/9999"
                          class="form-control"
                        ></input-mask>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Origen Nac.</label>
                      <div class="col-sm-9">
                        <b-form-select v-model="personas.idnacionalidad" >
                          <option value="">--Seleccione--</option>
                          <option
                            v-for="(item, index) in nacionalidades"
                            :key="index"
                            v-bind:value="item.id_pais"
                          >{{item.pais_gentilicio}} - {{item.pais_siglas}}</option>
                        </b-form-select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Estado Civil</label>
                      <div class="col-sm-4">
                        <b-form-select v-model="personas.idestadocivil" >
                          <option value="">--Seleccione--</option>
                          <option
                            v-for="(item, index) in estadosciviles"
                            :key="index"
                            v-bind:value="item.id_estado_civil"
                          >{{item.estado_civil_descripcion}}</option>
                        </b-form-select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">C.I/DNI</label>
                      <div class="col-sm-6">
                        <b-form-input
                          id="input-live"
                          v-model="personas.cedula_identidad"
                          :state="Ci"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca un nombre"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>Informacion de Contacto</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Ciudad</label>
                      <div class="col-sm-9">
                        <b-form-select v-model="personas.idciudad" >
                          <option value="">--Seleccione--</option>
                          <option
                            v-for="(item, index) in ciudades"
                            :key="index"
                            v-bind:value="item.id_ciudad"
                          >{{item.ciudades_descripcion}}</option>
                        </b-form-select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Barrio</label>
                      <div class="col-sm-9">
                        <b-form-input
                          id="input-live"
                          v-model="personas.barrio"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca el Barrio"
                          trim
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Direccion</label>
                      <div class="col-sm-9">
                        <b-form-input
                          id="input-live"
                          v-model="personas.direccion"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca una Direccion"
                          trim
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Telefono</label>
                      <div class="col-sm-9">
                        <b-form-input
                          id="input-live"
                          v-model="personas.telefono"
                          :state="telefonoestado"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca un nombre"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Correo Valido</label>
                      <div class="col-sm-9">
                        <b-form-input
                          id="input-live"
                          v-model="personas.correo"
                          :state="tipoemail"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca un correo valido"
                          trim
                        ></b-form-input>
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
                        <i class="mdi mdi-attachment text-primary mr-1"></i>Grabar
                      </button>
                      <button type="submit" class="btn btn-sm btn-outline-secondary">
                        <i class="mdi mdi-delete text-primary mr-1"></i>Delete
                      </button>
                    </div>
                  </div>
                  <!-- FIN CODIGO BOTONES -->
              <fieldset>
                <legend>Cargar Foto de Perfil</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <div class="col-sm-9" v-if="!personas.imagen">
                        <img src="/images/defaul.png" width="100" height="100" class="img-thumbnail" />
                        <input type="file" @change="ObtenerImagen" class="form-control mt-2" />
                      </div>

                      <div class="col-sm-9" v-else>
                        <img :src="imagenes" width="100" height="100" class="img-thumbnail" />
                        <input type="file" @change="ObtenerImagen" ref="file-input" class="form-control mt-2" />
                         <b-button @click="borrar" class="mt-3">Reset</b-button>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>Informaciones Personales</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nombres</label>
                      <div class="col-sm-9">
                        <b-form-input
                          id="input-live"
                          v-model="personas.nombre"
                          :state="nameState"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca un nombre"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Apellidos</label>
                      <div class="col-sm-9">
                        <b-form-input
                          id="input-live"
                          v-model="personas.apellido"
                          :state="apellidoestado"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca un Apellido"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Genero</label>
                      <div class="col-sm-9">
                        <b-form-select v-model="personas.genero">
                          <option value="">--Seleccione--</option>
                          <option value="MASCULINO">MASCULINO</option>
                          <option value="FEMENINO">FEMENINO</option>
                        </b-form-select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Feha de Naci.</label>
                      <div class="col-sm-9">
                        <input-mask
                          v-model="personas.fecha_nacimiento"
                          mask="99/99/9999"
                          class="form-control"
                        ></input-mask>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Origen Nac.</label>
                      <div class="col-sm-9">
                     <b-form-select v-model="personas.idnacionalidad" >
                          <option value="">--Seleccione--</option>
                          <option
                            v-for="(item, index) in nacionalidades"
                            :key="index"
                            v-bind:value="item.id_pais"
                          >{{item.pais_gentilicio}} - {{item.pais_siglas}}</option>
                        </b-form-select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Estado Civil</label>
                      <div class="col-sm-4">
                        <b-form-select v-model="personas.idestadocivil">
                          <option value="">--Seleccione--</option>
                          <option
                            v-for="(item, index) in estadosciviles"
                            :key="index"
                            v-bind:value="item.id_estado_civil"
                          >{{item.estado_civil_descripcion}}</option>
                        </b-form-select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">C.I/DNI</label>
                      <div class="col-sm-6">
                        <b-form-input
                          id="input-live"
                          v-model="personas.cedula_identidad"
                          :state="Ci"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca un C.I o DNI"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend>Informacion de Contacto</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Ciudad</label>
                      <div class="col-sm-9">
                        <b-form-select v-model="personas.idciudad">
                          <option value="">--Seleccione--</option>
                          <option
                            v-for="(item, index) in ciudades"
                            :key="index"
                            v-bind:value="item.id_ciudad"
                          >{{item.ciudades_descripcion}}</option>
                        </b-form-select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Barrio</label>
                      <div class="col-sm-9">
                        <b-form-input
                          id="input-live"
                          v-model="personas.barrio"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca el Barrio"
                          trim
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Direccion</label>
                      <div class="col-sm-9">
                        <b-form-input
                          id="input-live"
                          v-model="personas.direccion"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca una Direccion"
                          trim
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Telefono</label>
                      <div class="col-sm-9">
                        <b-form-input
                          id="input-live"
                          v-model="personas.telefono"
                          :state="telefonoestado"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca un Telefono"
                          trim
                          required
                        ></b-form-input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Correo Valido</label>
                      <div class="col-sm-9">
                        <b-form-input
                          id="input-live"
                          v-model="personas.correo"
                          :state="tipoemail"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Introduzca un correo valido"
                          trim
                        ></b-form-input>
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
                  >
                    <template v-slot:cell(show_details)="row">
                      <b-button
                        size="sm"
                        @click="row.toggleDetails"
                        variant="primary"
                      >{{ row.detailsShowing ? '-' : '+'}}</b-button>
                    </template>

                    <template v-slot:row-details="row">
                      <b-card
                        :img-src="'/foto_perfil/'+row.item.imagen_persona"
                        img-alt="Card image"
                        img-right
                        alt
                        width="50"
                        height="50"
                      >
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
                          <b-col>{{ row.item.pais_gentilicio}}</b-col>
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
      ciudades: [],
      nacionalidades: [],
      estadosciviles: [],
      VerImagen: "",
      personas: {
        nombre: "",
        apellido: "",
        fecha_nacimiento: "",
        cedula_identidad: "",
        telefono: "",
        imagen: "",
        correo: "",
        genero: "",
        direccion: "",
        barrio: "",
        idnacionalidad: "",
        idciudad: "",
        idestadocivil: ""
      },
      fields: [
        { key: "show_details", label: "", class: "w-5px" },
        {
          key: "id_persona",
          label: "ID",
          sortable: true
        },
        {
          key: "cedula_identidad_personas",
          label: "CI/DNI",
          sortable: true
        },
        {
          key: "personas_nombre_completo",
          label: "Nombre Completo",
          sortable: true
        },
        {
          key: "fecha_formato",
          label: "Fecha Naci",
          sortable: true
        },

        { key: "actions", label: "Actions" }
      ]
    };
  },
  methods: {
    borrar(){
       this.$refs['file-input'].value = '';
       this.personas.imagen = '';
    },
    listar() {
      axios
        .get("/listar-Personas")
        .then(res => {
          this.items = res.data;
        })
        .catch(error => console.log(error));
    },
    agregar() {
      let formData = new FormData();
      formData.append("nombre", this.personas.nombre),
        formData.append("apellido", this.personas.apellido),
        formData.append("FechaNac", this.personas.fecha_nacimiento),
        formData.append("telefono", this.personas.telefono),
        formData.append("imagen", this.personas.imagen),
        formData.append("genero", this.personas.genero),
        formData.append("correo", this.personas.correo),
        formData.append("direccion", this.personas.direccion),
        formData.append("barrio", this.personas.barrio),
        formData.append("cedula_identidad", this.personas.cedula_identidad),
        formData.append("idnacionalidad", this.personas.idnacionalidad),
        formData.append("idciudad", this.personas.idciudad),
        formData.append("idestadocivil", this.personas.idestadocivil);

      axios
        .post("/grabar-personas", formData)
        .then(res => {
          this.items.push(res.data);
          this.listar();
          swal("Correcto!", "Datos Ingresados Correctamente!", "success");
          document.getElementById("pills-profile-tab-custom").click();
        })
        .catch(error => {
          let mensaje = "Error no identificado";
          swal("error", mensaje, "error");
        });
      (this.personas.nombre = ""),
        (this.personas.apellido = ""),
        (this.personas.fecha_nacimiento = ""),
        (this.personas.cedula_identidad = ""),
        (this.personas.correo = ""),
        (this.personas.imagen = null),
        this.$refs['file-input'].value = '',
        (this.personas.genero = ""),
        (this.personas.telefono = ""),
        (this.personas.direccion = ""),
        (this.personas.barrio = ""),
        (this.personas.idnacionalidad = ""),
        (this.personas.idciudad = ""),
        (this.personas.idestadocivil = "");
    },
    editarFormulario(item) {
      this.personas.id_persona = item.id_persona;
      this.personas.nombre = item.nombre_personas;
      this.personas.apellido = item.apellido_personas;
      this.personas.fecha_nacimiento = item.fecha_formato;
      this.personas.cedula_identidad = item.cedula_identidad_personas;
      this.personas.correo = item.correo_electronico_personas;
      this.personas.imagen = item.imagen_persona;
      this.personas.genero = item.genero_personas;
      this.personas.telefono = item.telefono_personas;
      this.personas.direccion = item.direccion_personas;
      this.personas.barrio = item.barrio_personas;
      this.personas.idnacionalidad = item.id_pais;
      this.personas.idciudad = item.id_ciudad;
      this.personas.idestadocivil = item.id_estado_civil;
      this.modoEditar = true;
      document.getElementById("pills-home-tab-custom").click();
    },
    editarDatos(personas) {
      let formData = new FormData();
      formData.append("nombre", this.personas.nombre),
        formData.append("apellido", this.personas.apellido),
        formData.append("FechaNac", this.personas.fecha_nacimiento),
        formData.append("telefono", this.personas.telefono),
        formData.append("imagen", this.personas.imagen),
        formData.append("genero", this.personas.genero),
        formData.append("correo", this.personas.correo),
        formData.append("direccion", this.personas.direccion),
        formData.append("barrio", this.personas.barrio),
        formData.append("cedula_identidad", this.personas.cedula_identidad),
        formData.append("idnacionalidad", this.personas.idnacionalidad),
        formData.append("idciudad", this.personas.idciudad),
        formData.append("idestadocivil", this.personas.idestadocivil);
      formData.append("_method", "PUT");
      axios
        .post(`/Editar-Persona/${personas.id_persona}`, formData)
        .then(res => {
          this.modoEditar = false;
          const index = this.items.findIndex(
            item => item.id_persona === personas.id_persona
          );
          this.items[index] = res.data;
          this.listar();
          swal("Correcto!", "Se Edito!", "success");
        });
      (this.personas.nombre = ""),
        (this.personas.apellido = ""),
        (this.personas.fecha_nacimiento = ""),
        (this.personas.cedula_identidad = ""),
        (this.personas.correo = ""),
        (this.personas.imagen = null),
         this.$refs['file-input'].value = '',
        (this.personas.genero = ""),
        (this.personas.telefono = ""),
        (this.personas.direccion = ""),
        (this.personas.barrio = ""),
        (this.personas.idnacionalidad = ""),
        (this.personas.idciudad = ""),
        (this.personas.idestadocivil = "");
    },
    eliminarDatos(personas, index) {
      swal({
        title: "Desea eliminar ?",
        text: "Se eliminara de la base de datos!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          axios.delete(`/Eliminar-Persona/${personas.id_persona}`).then(() => {
            this.items.splice(index, 1);
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
      this.personas = {
        nombre: "",
        apellido: "",
        fecha_nacimiento: "",
        cedula_identidad: "",
        telefono: "",
        imagen: "",
        correo: "",
        genero: "",
        direccion: "",
        barrio: "",
        idnacionalidad: "",
        idciudad: "",
        idestadocivil: ""
      };
    },
    ObtenerImagen(e) {
      let file = e.target.files[0];
      this.personas.imagen = file;
      this.CargarImagen(file);
    },
    CargarImagen(file) {
      let reader = new FileReader();
      reader.onload = e => {
        this.VerImagen = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImg() {
      this.personas.imagen = null;
      this.VerImagen = null;
    }
  },
  created() {
    this.listar();
    axios
      .get("/ciudades")
      .then(res => {
        this.ciudades = res.data;
      })
      .catch(error => console.log(error));
    axios
      .get("/nacionalidad")
      .then(res => {
        this.nacionalidades = res.data;
      })
      .catch(error => console.log(error));
    axios
      .get("/estado-civil")
      .then(res => {
        this.estadosciviles = res.data;
      })
      .catch(error => console.log(error));
  },
  computed: {
    nameState() {
      return this.personas.nombre.length > 0 ? true : false;
    },
    apellidoestado() {
      return this.personas.apellido.length > 0 ? true : false;
    },
    Ci() {
      return this.personas.cedula_identidad.length > 0 ? true : false;
    },
    telefonoestado() {
      return this.personas.telefono.length > 0 ? true : false;
    },
    tipoemail() {
      var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(this.personas.correo) ? true : false;
    },
    imagenes() {
      return this.VerImagen;
    },
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