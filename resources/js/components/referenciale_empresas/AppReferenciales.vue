<template>
<div>
    <!-- comienzo del navbar home -->
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <ul class="navbar-nav navbar-nav-left">
              <li class="nav-item ml-0 mr-lg-5">
                <a href="#" class="nav-link horizontal-nav-left-menu profile-settings-open">
                  <i class="mdi mdi-format-list-bulleted"></i>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                  id="notificationDropdown"
                  href="#"
                  data-toggle="dropdown"
                >
                  <i class="mdi mdi-bell mx-0"></i>
                  <span class="count bg-success">2</span>
                </a>
                <div
                  class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                  aria-labelledby="notificationDropdown"
                >
                  <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
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
                      <h6 class="preview-subject font-weight-normal">Settings</h6>
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
              <li class="nav-item dropdown">
                <a
                  class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                  id="messageDropdown"
                  href="#"
                  data-toggle="dropdown"
                >
                  <i class="mdi mdi-email mx-0"></i>
                  <span class="count bg-primary">4</span>
                </a>
                <div
                  class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                  aria-labelledby="messageDropdown"
                >
                  <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="/../../images/faces/face4.jpg" alt="image" class="profile-pic" />
                    </div>
                    <div class="preview-item-content flex-grow">
                      <h6 class="preview-subject ellipsis font-weight-normal">David Grey</h6>
                      <p
                        class="font-weight-light small-text text-muted mb-0"
                      >The meeting is cancelled</p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="/../../images/faces/face2.jpg" alt="image" class="profile-pic" />
                    </div>
                    <div class="preview-item-content flex-grow">
                      <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook</h6>
                      <p class="font-weight-light small-text text-muted mb-0">New product launch</p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="/../../images/faces/face3.jpg" alt="image" class="profile-pic" />
                    </div>
                    <div class="preview-item-content flex-grow">
                      <h6 class="preview-subject ellipsis font-weight-normal">Johnson</h6>
                      <p class="font-weight-light small-text text-muted mb-0">Upcoming board meeting</p>
                    </div>
                  </a>
                </div>
              </li>
              <li class="nav-item dropdown d-sm-flex d-none">
                <a href="#" class="nav-link count-indicator">
                  <i class="mdi mdi-message-reply-text"></i>
                </a>
              </li>
              <li class="nav-item nav-search d-none d-lg-block ml-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="search">
                      <i class="mdi mdi-magnify"></i>
                    </span>
                  </div>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="search"
                    aria-label="search"
                    aria-describedby="search"
                  />
                </div>
              </li>
            </ul>
            <div
              class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center"
            >
              <a class="navbar-brand brand-logo" href="index.html">
                <img src="/../../images/logo.svg" alt="logo" />
              </a>
              <a class="navbar-brand brand-logo-mini" href="index.html">
                <img src="/../../images/logo-mini.svg" alt="logo" />
              </a>
            </div>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown d-sm-flex d-none">
                <button type="button" class="btn btn-inverse-primary btn-sm">Product</button>
              </li>
              <li class="nav-item dropdown d-sm-flex d-none">
                <a
                  class="dropdown-toggle show-dropdown-arrow btn btn-inverse-primary btn-sm"
                  id="nreportDropdown"
                  href="#"
                  data-toggle="dropdown"
                >Reports</a>
                <div
                  class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                  aria-labelledby="nreportDropdown"
                >
                  <p class="mb-0 font-weight-medium float-left dropdown-header">Reports</p>
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
              <li class="nav-item dropdown d-sm-flex d-none">
                <button type="button" class="btn btn-inverse-primary btn-sm">Settings</button>
              </li>
              <li class="nav-item nav-profile dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  data-toggle="dropdown"
                  id="profileDropdown"
                >
                  <span class="nav-profile-name">Johnson</span>
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
                  <a class="dropdown-item">
                    <i class="mdi mdi-logout text-primary"></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
            <button
              class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
              type="button"
              data-toggle="horizontal-menu-toggle"
            >
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">
        <div class="container">
          <ul class="nav page-navigation">
            <li class="nav-item">
              <a class="nav-link" href="/home">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">INICIO</span>
              </a>
            </li>
            <li class="nav-item mega-menu">
              <a href="/referenciales" class="nav-link">
                <i class="mdi mdi-cube-outline menu-icon"></i>
                <span class="menu-title">REFERENCIALES GENERALES</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="submenu">
                <div class="col-group-wrapper row">
                  <div class="col-group col-md-4">
                    <div class="row">
                      <div class="col-12">
                        <p class="category-heading">Empresa</p>
                        <div class="submenu-item">
                          <div class="row">
                            <div class="col-md-6">
                              <ul>
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
                              </ul>
                            </div>
                            <div class="col-md-6">
                              <ul>
                                <li class="nav-item">
                                  <router-link class="nav-link" :to="{ name: 'funcionario'}">Funcionario</router-link>
                                </li>
                                <li class="nav-item">
                                   <router-link class="nav-link" :to="{ name: 'deposito'}">Deposito</router-link>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-group col-md-4">
                    <div class="row">
                      <div class="col-12">
                        <p class="category-heading">Ventas</p>
                        <div class="submenu-item">
                          <div class="row">
                            <div class="col-md-6">
                              <ul>
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
                              </ul>
                            </div>
                            <div class="col-md-6">
                              <ul>
                                <li class="nav-item">
                                  <a class="nav-link" href="pages/ui-features/popups.html">Popup</a>
                                </li>
                                <li class="nav-item">
                                  <a
                                    class="nav-link"
                                    href="pages/ui-features/notifications.html"
                                  >Notification</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-group col-md-4">
                    <p class="category-heading">Compras</p>
                    <ul class="submenu-item">
                      <li class="nav-item">
                      <router-link class="nav-link" :to="{ name: 'proveedor'}">Proveedores</router-link>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/icons/font-awesome.html">Font Awesome</a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link"
                          href="pages/icons/simple-line-icon.html"
                        >Simple Line Icons</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/icons/themify.html">Themify Icons</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi-chart-areaspline menu-icon"></i>
                <span class="menu-title">Forms</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="submenu">
                <ul class="submenu-item">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/forms/advanced_elements.html">Advanced Elements</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/forms/validation.html">Validation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/forms/wizard.html">Wizard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/forms/text_editor.html">Text Editor</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/forms/code_editor.html">Code Editor</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item mega-menu">
              <a href="#" class="nav-link">
                <i class="mdi mdi-finance menu-icon"></i>
                <span class="menu-title">Data</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="submenu">
                <div class="col-group-wrapper row">
                  <div class="col-group col-md-5">
                    <p class="category-heading">Charts</p>
                    <div class="submenu-item">
                      <div class="row">
                        <div class="col-md-6">
                          <ul>
                            <li class="nav-item">
                              <a class="nav-link" href="pages/charts/chartjs.html">Chart Js</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="pages/charts/morris.html">Morris</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="pages/charts/flot-chart.html">Flot</a>
                            </li>
                            <li class="nav-item">
                              <a
                                class="nav-link"
                                href="pages/charts/google-charts.html"
                              >Google Chart</a>
                            </li>
                          </ul>
                        </div>
                        <div class="col-md-6">
                          <ul>
                            <li class="nav-item">
                              <a class="nav-link" href="pages/charts/sparkline.html">Sparkline</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="pages/charts/c3.html">C3 Chart</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="pages/charts/chartist.html">Chartist</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="pages/charts/justGage.html">JustGage</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-group col-md-4">
                    <p class="category-heading">Table</p>
                    <ul class="submenu-item">
                      <li class="nav-item">
                        <a class="nav-link" href="pages/tables/basic-table.html">Basic Table</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/tables/data-table.html">Data Table</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/tables/js-grid.html">Js-grid</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/tables/sortable-table.html">Sortable Table</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-group col-md-3">
                    <p class="category-heading">Maps</p>
                    <ul class="submenu-item">
                      <li class="nav-item">
                        <a class="nav-link" href="pages/maps/mapael.html">Mapael</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/maps/vector-map.html">Vector Map</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/maps/google-maps.html">Google Map</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item mega-menu">
              <a href="#" class="nav-link">
                <i class="mdi mdi-codepen menu-icon"></i>
                <span class="menu-title">Sample Pages</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="submenu">
                <div class="col-group-wrapper row">
                  <div class="col-group col-md-3">
                    <p class="category-heading">User Pages</p>
                    <ul class="submenu-item">
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/login.html">Login</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/login-2.html">Login 2</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/register.html">Register</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/register-2.html">Register 2</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/lock-screen.html">Lockscreen</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-group col-md-3">
                    <p class="category-heading">Error Pages</p>
                    <ul class="submenu-item">
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/error-400.html">400</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/error-404.html">404</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/error-500.html">500</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/error-505.html">505</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-group col-md-3">
                    <p class="category-heading">E-commerce</p>
                    <ul class="submenu-item">
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/invoice.html">Invoice</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/pricing-table.html">Pricing Table</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/orders.html">Orders</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-group col-md-3">
                    <p class="category-heading">General</p>
                    <ul class="submenu-item">
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/search-results.html">Search Results</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/profile.html">Profile</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/timeline.html">Timeline</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/news-grid.html">News grid</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/portfolio.html">Portfolio</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/samples/faq.html">FAQ</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi-image-filter menu-icon"></i>
                <span class="menu-title">Apps</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="submenu">
                <ul class="submenu-item">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/apps/email.html">Email</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/apps/calendar.html">Calendar</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/apps/todo.html">Todo List</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/apps/gallery.html">Gallery</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a
                href="http://www.templatewatch.com/kapella/docs/documentation.html"
                target="_blank"
                class="nav-link"
              >
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Documentation</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <!-- fin navbar home -->

    <!-- sidebar perfil del usuario -->
    <div class="profile-sidebar" id="profile-sidebar">
      <i class="profile-settings-close mdi mdi-close"></i>
      <div class="profile-sidebar-header">
        <div class="text-center">
          <div>
            <div class="profile-sidebar-thumb">
              <img src="images/faces/face18.jpg" alt="profile" />
            </div>
            <div class="profile-sidebar-info">
              <h4 class="name">J</h4>
              <h5 class="mb-0 designation">Sales Head</h5>
            </div>
          </div>
          <div class="profile-social-icons">
            <a href="#">
              <i class="mdi mdi-facebook-box"></i>
            </a>
            <a href="#">
              <i class="mdi mdi-twitter-box"></i>
            </a>
            <a href="#">
              <i class="mdi mdi-instagram"></i>
            </a>
            <a href="#">
              <i class="mdi mdi-google-plus-box"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="profile-sidebar-body">
        <ul class="list-profile-items">
          <li class="profile-item">
            <a href="#" class="profile-sidebar-link">
              <div class="d-flex align-items-center">
                <i class="mdi mdi-account-outline text-primary"></i>
                <div>
                  <h5 class="item-title">My Profile</h5>
                  <p class="item-detail">Account settings and more</p>
                </div>
              </div>
            </a>
          </li>
          <li class="profile-item">
            <a href="#" class="profile-sidebar-link">
              <div class="d-flex align-items-center">
                <i class="mdi mdi-email-outline text-info"></i>
                <div>
                  <h5 class="item-title">My Messages</h5>
                  <p class="item-detail">Inbox and tasks</p>
                </div>
              </div>
            </a>
          </li>
          <li class="profile-item">
            <a href="#" class="profile-sidebar-link">
              <div class="d-flex align-items-center">
                <i class="mdi mdi-vector-polyline text-danger"></i>
                <div>
                  <h5 class="item-title">My Activities</h5>
                  <p class="item-detail">Logs and notifications</p>
                </div>
              </div>
            </a>
          </li>
          <li class="profile-item">
            <a href="#" class="profile-sidebar-link">
              <div class="d-flex align-items-center">
                <i class="mdi mdi-timer-sand text-success"></i>
                <div>
                  <h5 class="item-title">My Tasks</h5>
                  <p class="item-detail">latest tasks and projects</p>
                </div>
              </div>
            </a>
          </li>
          <li class="profile-item">
            <a href="#" class="profile-sidebar-link">
              <div class="d-flex align-items-center">
                <i class="mdi mdi-cash-100 text-warning"></i>
                <div>
                  <h5 class="item-title">Billing</h5>
                  <p class="item-detail">
                    billing & statements
                    <span class="badge badge-danger ml-2">2 Pending</span>
                  </p>
                </div>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- fin del sedebar perfil -->

 <div class="container-fluid page-body-wrapper">
    <div class="main-panel">
      <div class="content-wrapper">
        <transition name="slideDown" mode="out-in">
          <router-view></router-view>
        </transition>
      </div>
    </div>
 </div>
   	<footer class="footer">
          <div class="footer-wrap">
              <div class="w-100 clearfix">
                <span class="d-block text-center text-sm-left d-sm-inline-block">Copyright © 2020 <a href="https://www.templatewatch.com/" target="_blank"> ChasquiDesing </a> FACTERERE-V1.0 </span>
            
              </div>
          </div>
        </footer>
</div>
</template>
<script>

export default {
 
};
</script>

<style scoped>

</style>