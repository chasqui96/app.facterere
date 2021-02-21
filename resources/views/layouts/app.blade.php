<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user" content="{{ Auth::user() }}">

    <title>{{ config('app.name', 'app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="/../../images/icono.ico" rel="icon">
     <!-- Scripts -->
     
     <script src="{{ asset('js/app.js') }}" defer></script>
     <script src="{{ asset('js/vendor.bundle.base.js') }}"></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="sidebar-icon-only">
    <div id="app">
      <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="index.html"><img src="../../images/AZUL.svg" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../../images/AZUL.svg" alt="logo"/></a>
            
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link count-indicator "><i class="mdi mdi-message-outline"></i></a>
                  </li>
              <li class="nav-item dropdown">
                  <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="mdi mdi-bell-outline mx-0"></i>
                    <span class="count bg-success">2</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                          <div class="preview-icon bg-success">
                            <i class="mdi mdi-information mx-0"></i>
                          </div>
                      </div>
                      <div class="preview-item-content">
                          <h6 class="preview-subject font-weight-normal">Application Error</h6>
                          <p class="font-weight-light small-text mb-0 text-muted">
                            Just now
                          </p>
                      </div>
                    </a>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                          <div class="preview-icon bg-warning">
                            <i class="mdi mdi-settings mx-0"></i>
                          </div>
                      </div>
                      <div class="preview-item-content">
                          <h6 class="preview-subject font-weight-normal">Settings</h6>
                          <p class="font-weight-light small-text mb-0 text-muted">
                            Private message
                          </p>
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
                          <p class="font-weight-light small-text mb-0 text-muted">
                            2 days ago
                          </p>
                      </div>
                    </a>
                  </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-email-outline mx-0"></i>
                  <span class="count bg-primary">4</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <img src="../../images/faces/face4.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                        </h6>
                        <p class="font-weight-light small-text text-muted mb-0">
                          The meeting is cancelled
                        </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <img src="../../images/faces/face2.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                        </h6>
                        <p class="font-weight-light small-text text-muted mb-0">
                          New product launch
                        </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <img src="../../images/faces/face3.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                        </h6>
                        <p class="font-weight-light small-text text-muted mb-0">
                          Upcoming board meeting
                        </p>
                    </div>
                  </a>
                </div>
              </li>
              <li class="nav-item nav-search d-none d-lg-block">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="search">
                      <i class="mdi mdi-magnify"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="search">
                </div>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown  d-lg-flex d-none">
                <button type="button" class="btn btn-inverse-primary btn-sm">Product </button>
              </li>
              <li class="nav-item dropdown d-lg-flex d-none">
                <a class="dropdown-toggle show-dropdown-arrow btn btn-inverse-primary btn-sm" id="nreportDropdown" href="#" data-toggle="dropdown">
                Reports
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="nreportDropdown">
                    <a class="dropdown-item">
                      <i class="mdi mdi-file-pdf text-primary"></i>
                      Pdf
                    </a>
                    <a class="dropdown-item">
                      <i class="mdi mdi-file-excel text-primary"></i>
                      Excel
                    </a>
                </div>
              </li>
              <li class="nav-item dropdown d-lg-flex d-none">
                <button type="button" class="btn btn-inverse-primary btn-sm">Settings</button>
              </li>
              <li class="nav-item nav-profile dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  data-toggle="dropdown"
                  id="profileDropdown"
                >
                  <span class="nav-profile-name" >{{ Auth::user()->nombre_usuario }}</span>
                  <span class="online-status"></span>
                  <img src="/../../images/faces/face28.png" alt="profile" />
                </a>
                <div
                  class="dropdown-menu dropdown-menu-right navbar-dropdown"
                  aria-labelledby="profileDropdown"
                >
                  <a class="dropdown-item">
                    <i class="mdi mdi-settings text-primary"></i>
                    Settings
                  </a>
                  
                  <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout text-primary"></i>
                    {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </div>
              </li>
  
  
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
          <!-- partial:partials/_settings-panel.html -->
          <div class="theme-setting-wrapper">
            <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
            <div id="theme-settings" class="settings-panel">
              <i class="settings-close mdi mdi-close"></i>
              <p class="settings-heading">SIDEBAR SKINS</p>
              <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
              <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
              <p class="settings-heading mt-2">HEADER SKINS</p>
              <div class="color-tiles mx-0 px-4">
                <div class="tiles success"></div>
                <div class="tiles warning"></div>
                <div class="tiles danger"></div>
                <div class="tiles primary"></div>
                <div class="tiles info"></div>
                <div class="tiles dark"></div>
                <div class="tiles default"></div>
              </div>
            </div>
          </div>
          <!-- partial -->
          <!-- partial:partials/_sidebar.html -->
         <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="nav-item nav-profile dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown" aria-expanded="false">
                  <div class="d-flex">
                      <img src="../../images/faces/face28.png" alt="profile">
                      <div>
                        <span class="sidebar-profile-name font-weight-bold">Johnson</span>
                        <p class="sidebar-profile-designation text-muted text-small">Sales head</p>
                      </div>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                  <a class="dropdown-item">
                    <i class="mdi mdi-settings text-primary"></i>
                    Settings
                  </a>
                  <a class="dropdown-item">
                    <i class="mdi mdi-logout text-primary"></i>
                    Logout
                  </a>
                </div>
              </div>
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="index.html">
                <i class="mdi mdi-file-document-box menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="mdi mdi-finance menu-icon"></i>
                <span class="menu-title">MERCADERIA</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                  
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'productos'}" >Productos</router-link>
                   </li>
                   <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'categoria'}">Categoria</router-link>
                   </li>
                   <li class="nav-item">
                     <router-link class="nav-link" :to="{ name: 'bloque'}">Estante</router-link>
                   </li>
                   <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'desglosamiento'}">Unidad</router-link>
                   </li>
                  
                   <li class="nav-item">
                     <router-link class="nav-link" :to="{ name: 'cargar_productos'}">Carga Masiva</router-link>
                   </li>     
                   
                   <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'deposito'}">Deposito</router-link>
                 </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="mdi mdi-finance menu-icon"></i>
                <span class="menu-title">INVENTARIO</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                  
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'inventario'}" >Inventario</router-link>
                   </li>
                   <li class="nav-item">
                     <router-link class="nav-link" :to="{ name: 'alta_producto'}">Stock</router-link>
                   </li>
          
                 </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">GESTIONAR COMPRA</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'pedido_compras'}" >Pedidos Compras</router-link>
                  </li>
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'presupuesto_compras'}" >Presupuesto Compras</router-link>
                  </li>
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'orden_compras'}" >Ordenes Compras</router-link>
                  </li>
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'facturas_compras'}" >Facturas Compras</router-link>
                  </li>
                </ul>
              </div>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="mdi mdi-chart-areaspline menu-icon"></i>
                <span class="menu-title">PARAMETROS COMPR.</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'proveedor'}">Proveedores</router-link>
                    </li>
                    <li class="nav-item">
                      <router-link class="nav-link" :to="{ name: 'tipo_movimiento_inventario'}" >Tip. Movimiento</router-link>
                     </li>
                     <li class="nav-item">
                      <router-link class="nav-link" :to="{ name: 'tipo_operacion_inventario'}" >Tip. Operacion</router-link>
                     </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">PARAMETRO DE VENTAS</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-advanced">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'cliente'}">Clientes</router-link>
                    </li>
                     <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'timbrado'}">Timbrados</router-link>
                    </li>
                    <li class="nav-item">
                      <router-link class="nav-link" :to="{ name: 'tarjeta'}" >Tarjetas</router-link>
                    </li>
                    <li class="nav-item">
                     <router-link class="nav-link" :to="{ name: 'marcatarjeta'}">Marca Tarjetas</router-link>
                    </li>
                    <li class="nav-item">
                      <router-link class="nav-link" :to="{ name: 'tipoimpuesto'}">Tipo Impuesto</router-link>
                    </li>
                    <li class="nav-item">
                       <router-link class="nav-link" :to="{ name: 'entidade'}">Entidad Emisora</router-link>
                    </li>
                    <li class="nav-item">
                      <router-link class="nav-link" :to="{ name: 'tipo_moneda'}">Tipo Moneda</router-link>
                     </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-cube-outline menu-icon"></i>
                <span class="menu-title">PARAMETROS PERSONAL.</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">

                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'personas'}">Personas</router-link>
                  </li>
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'ciudad'}">Ciudades</router-link>
                 </li>
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'nacionalidad'}">Nacionalidad</router-link>
                  </li>
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'estadocivil'}">Estado Civil</router-link>
                  </li>
                  <li class="nav-item">
                   <router-link class="nav-link" :to="{ name: 'cargo'}">Cargo</router-link>
                  </li>
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'sucursal'}">Sucursal</router-link>
                  </li>
                  <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'funcionario'}">Funcionario</router-link>
                  </li>
                 
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="mdi mdi-emoticon menu-icon"></i>
                <span class="menu-title">Icons</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/icons/flag-icons.html">Flag icons</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/icons/font-awesome.html">Font Awesome</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/icons/simple-line-icon.html">Simple line icons</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/icons/themify.html">Themify icons</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://www.templatewatch.com/kapella/docs/documentation.html" target="_blank">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Documentation</span>
              </a>
            </li>
          </ul>
        </nav> 
          <!-- partial -->
          <div class="main-panel">
            <div class="content-wrapper">
            @yield('content')
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
              <div class="footer-wrap">
                  <div class="w-100 clearfix">
                    <span class="d-block text-center text-sm-left d-sm-inline-block">Copyright © 2020 <a href="https://www.templatewatch.com/" target="_blank"> ChasquiDesing </a> FACTERERE-V1.0 </span>
                
                  </div>
              </div>
            </footer>
            <!-- partial -->
          </div>
          <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>      
    </div>
    {{-- FIN APP --}}
  
    
    <script src="{{ asset('js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <script src="{{ asset('js/profile-settings.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/chartjs-plugin-datalabels.js') }}"></script>
    <script src="{{ asset('js/raphael-2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/justgage.js') }}"></script>
    
    <script src="{{ asset('js/dashboard.js') }}"></script>
   @yield('script')
</body>
</html>
