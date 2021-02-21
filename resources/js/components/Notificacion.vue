<template>
  <li class="nav-item dropdown">
    <a
      class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
      id="notificationDropdown"
      href="#"
      data-toggle="dropdown"
    >
      <i class="mdi mdi-bell mx-0"></i>
      <span class="count bg-success" v-text="numero"></span>
    </a>
    <div
      class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
      aria-labelledby="notificationDropdown"
    >
      <p class="mb-0 font-weight-normal float-left dropdown-header">Notificationes</p>
      <a class="dropdown-item preview-item">
        <div class="preview-thumbnail">
          <div class="preview-icon bg-success">
            <i class="mdi mdi-information mx-0"></i>
          </div>
        </div>
        <div class="preview-item-content">
          <h6 class="preview-subject font-weight-normal">Application Error</h6>
          <p class="font-weight-light small-text mb-0 text-muted">Just now</p>
        </div>
      </a>
      <a class="dropdown-item preview-item">
        <div class="preview-thumbnail">
          <div class="preview-icon bg-warning">
            <i class="mdi mdi-settings mx-0"></i>
          </div>
        </div>
        <div class="preview-item-content">
          <h6 class="preview-subject font-weight-normal">Configuracion Empresa</h6>
          <p class="font-weight-light small-text mb-0 text-muted">Private message</p>
        </div>
      </a>
      <a class="dropdown-item preview-item">
        <div class="preview-thumbnail">
          <div class="preview-icon bg-info">
            <i class="mdi mdi-account-box mx-0"></i>
          </div>
        </div>
        <div class="preview-item-content">
          <h6 class="preview-subject font-weight-normal">New user registration</h6>
          <p class="font-weight-light small-text mb-0 text-muted">2 days ago</p>
        </div>
      </a>
    </div>
  </li>
</template>
<script>
export default {
   data(){
       return{
              pedido_compras: [],
              numero:''
       }
   },
   
methods:{
  ver(){
     axios
        .get("/listar-PedidoCompra")
        .then(res => {
          this.pedido_compras = res.data;
          this.numero = this.pedido_compras[0]["count"];
        })
        .catch(error => console.log(error));
  }
}
};
</script>