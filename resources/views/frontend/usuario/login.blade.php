<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'app.name') }}</title>
    <link href="/../../images/icono.ico" rel="icon" >
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  
     <!-- Scripts -->
     
     {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/horizontal-layout-light/style.css') }}">
</head>
<body>

    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="main-panel">
          <div class="content-wrapper d-flex align-items-center auth px-0">

            <div class="row w-100 mx-0">
              <div class="col-lg-4 mx-auto"  >

                @if(Session::has('success_message'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                  </button>
                    {{ Session::get('success_message') }}
                </div>
            @endif
            @if(Session::has('error_message'))
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                  </button>
                    {{ Session::get('error_message') }}
                </div>
            @endif
                <div class="auth-form-light text-center py-3 px-4 px-sm-5" style="border:1px solid">
                  <div class="brand-logo">
                    <img src="../../../images/facturacion.png" alt="logo" />
                  </div>
                  <h2>FACTERERE</h2>
                  <h4>Iniciar Seccion!</h4>

                  <form class="pt-3"  method="POST" action="{{ route('logueo') }}" > 
                    @csrf
                    <div class="form-group">
                        <input  type="text" class="form-control form-control-lg @error('nombre_usuario') is-invalid @enderror" name="username" value="{{ old('nombre_usuario') }}" required autocomplete="username" autofocus>
                        @error('usuario')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <input id="txtPassword" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" value="{{ old('password') }}" name="password" required autocomplete="current-password">
                           <div class="input-group-append">
                         <button id="show_password" class="btn btn-secondary" type="button" onclick="mostrarPassword()"> <span class="mdi mdi-eye icon"></span> </button>
                          </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                          <label class="form-check-label text-muted">
                            {{ __('Remember Me') }}
                            <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                
                          </label>
                        </div>
                    
                      </div>
                    <div class="mt-3">
                      <button type="submit"
                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                      >  {{ __('Login') }}</button>
                    </div>
                    <div class="text-center mt-4 font-weight-light">
                      Aun no te Registrate!?
                      <a href="register.html" class="text-primary">Crear</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script src="{{ asset('js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <script src="{{ asset('js/profile-settings.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="/js/app.js"></script>
    <script type="text/javascript">
      function mostrarPassword(){
              var cambio = document.getElementById("txtPassword");
              if(cambio.type == "password"){
                  cambio.type = "text";
                  $('.icon').removeClass('mdi mdi-eye').addClass('mdi mdi-eye-off');
              }else{
                  cambio.type = "password";
                  $('.icon').removeClass('mdi mdi-eye-off').addClass('mdi mdi-eye');
              }
          } 
          
          $(document).ready(function () {
          //CheckBox mostrar contraseña
          $('#ShowPassword').click(function () {
              $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
          });
      });
      </script>
</body>
</html>