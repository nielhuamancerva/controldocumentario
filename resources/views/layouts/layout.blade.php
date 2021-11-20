<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>MUNICIPALIDAD DISTRITAL DE PERENE</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="/dist/css/select2.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-secondary bg-cyan navbar-light">
  <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
  </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
 
      <ul class="navbar-nav ml-auto">
   
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="/dist/img/avatar5.png" width="30" height="30" alt="logo"> 
                                {{Auth::user()->BuscarPersona()}} <span class="caret"></span>
                                </a>
                      
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#EditarContraseña{{Auth::user()->id}}">  
                                        {{ __('Cambio Contraseña') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </li>
                        @endguest
        </ul>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="/dist/img/avatar5.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ Auth::user()->tieneRol()}} </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     <!--dividir <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if(Auth::user()->tieneRol()=='administrador')
     
            <li class="nav-item has-treeview menu-{{ request()->is('usuarios') ? 'open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('usuarios') ? 'active' : '' }}">
                  <i class="nav-icon far fa-user"></i>
                  <p>
                    Usuarios
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('usuarios.index') }}" class="nav-link {{ request()->is('usuarios') ? 'active' : '' }}" >
                    <i class="fas fa-user"></i>
                    <p>Usuarios</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('personas.index') }}" class="nav-link {{ request()->is('personas') ? 'active' : '' }}" >
                    <i class="fas fa-user"></i>
                    <p>Personas</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview menu-{{ request()->is('roles') ? 'open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('roles') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-address-card"></i>
                  <p>
                    Roles
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('roles') ? 'active' : '' }}" >
                    <i class="nav-icon far fa-address-book"></i>
                    <p> Roles</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview menu-{{ request()->is('areas','accesoenvioarea','cantidadenvioarea') ? 'open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('areas','accesoenvioarea','cantidadenvioarea') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-warehouse"></i>
                  <p>
                    Area
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('areas.index') }}" class="nav-link {{ request()->is('areas') ? 'active' : '' }}" >
                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                    <p>Area</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('accesoenvioarea.index') }}" class="nav-link {{ request()->is('accesoenvioarea') ? 'active' : '' }}" >
                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                    <p>Acceso Envio Areas</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('cantidadenvioarea.index') }}" class="nav-link {{ request()->is('cantidadenvioarea') ? 'active' : '' }}" >
                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                    <p>Cantidad de Envio</p>                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview menu-{{ request()->is('documentos') ? 'open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('documentos') ? 'active' : '' }}">
                  <i class="nav-icon far fa-file-alt"></i>
                  <p>
                    Documentos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('documentos.index') }}" class="nav-link {{ request()->is('documentos') ? 'active' : '' }}" >
                    <i class="nav-icon fas fa-file-archive"></i>
                    <p>Documentos</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview menu-{{ request()->is('archivadores','archivadores/create','Archivadores/BandejaArchivados') ? 'open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('archivadores','archivadores/create','Archivadores/BandejaArchivados') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-archive"></i>
                  <p>
                    Archivadores
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('archivadores.index') }}" class="nav-link {{ request()->is('archivadores') ? 'active' : '' }}" >
                    <i class="nav-icon far fa-folder-open"></i>
                    <p>Archivador</p>
                  </a>
                </li>
              </ul>
            </li>

        @elseif(Auth::user()->tieneRol()=='empleado' or Auth::user()->tieneRol()=='tramitador')
         <li class="nav-item has-treeview menu-{{ request()->is('tramitesinternos','tramitesinternosprocesos') ? 'open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('tramitesinternos','tramitesinternosprocesos') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>
                    Tramites Internos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('tramitesinternos.index') }}" class="nav-link {{ request()->is('tramitesinternos') ? 'active' : '' }}" >
                      <i class="nav-icon fas fa-file-export"></i>
                      <p>Bandeja Tramite Internos</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('tramitesinternosprocesos.index') }}"  class="nav-link {{ request()->is('tramitesinternosprocesos') ? 'active' : '' }}" >
                      <i class="nav-icon fas fa-file-export"></i>
                      <p>Procesar Tramites Internos</p>
                    </a>
                  </li>
                </ul>
            </li>

            <li class="nav-item has-treeview menu-{{ request()->is('archivadoresenviados','archivadoresrecibidos') ? 'open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('archivadoresenviados','archivadoresrecibidos') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>
                    Archivador
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('archivadoresenviados.index') }}" class="nav-link {{ request()->is('archivadoresenviados') ? 'active' : '' }}" >
                      <i class="nav-icon fas fa-file-export"></i>
                      <p>Archivador Enviados</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('archivadoresrecibidos.index') }}" class="nav-link {{ request()->is('archivadoresrecibidos') ? 'active' : '' }}" >
                      <i class="nav-icon fas fa-file-export"></i>
                      <p>Archivador Recibidos</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview menu-{{ request()->is('expediente') ? 'open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('expediente') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>
                    Expendientes
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('expediente.index') }}" class="nav-link {{ request()->is('expediente') ? 'active' : '' }}" >
                      <i class="nav-icon fas fa-file-export"></i>
                      <p>Busqueda Expediente</p>
                    </a>
                  </li>
                </ul>
              </li>
              
            @if(Auth::user()->tieneRol()=='tramitador')

                  <li class="nav-item has-treeview menu-{{ request()->is('tramitesexternos') ? 'open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('tramitesexternos') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        Tramites Externos
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('tramitesexternos.index') }}" class="nav-link {{ request()->is('tramitesexternos') ? 'active' : '' }}" >
                          <i class="nav-icon fas fa-file-export"></i>
                          <p>Bandeja</p>
                        </a>
                      </li>
                    </ul>
                </li>
              @endif
          @endif

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    @yield('nav-contenido')
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
    @yield('contenido')
 
 
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a href="https://www.muniperene.gob.pe">Municipalidad de Perene</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>

<script src="/dist/js/select2.min.js"></script>
@stack('script')
<script src="/dist/js/sweetalert.min.js"></script>
<script>
@if(session('expediente'))
        swal('Expediente N° "{{session('expediente')}}" Generado!', "", "success");
    @endif
    </script>
@yield('script')
</body>
                                      <div class="modal fade" id="EditarContraseña{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Crear Usuarios</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="POST" action="{{ route('cambiocontraseña', Auth::user()->id) }}">
                                                    @method('PATCH')
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label for="rolename" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña Anterior') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="areaname" type="text" class="form-control @error('rolename') is-invalid @enderror" name="areaname" value="{{Auth::user()->password}}" required autocomplete="areaname" autofocus>
                                                            @error('rolename')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="password_general" class="col-md-4 col-form-label text-md-right">{{ __('Nueva Contraseña') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="password_general" type="text" class="form-control @error('password_general') is-invalid @enderror" name="password_general" value="" required autocomplete="password_general" autofocus>

                                                            @error('rolename')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                
                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            <button type="submit" class="btn btn-primary">
                                                                {{ __('Actualizar') }}
                                                            </button>
                                                            <button type="reset" class="btn btn-danger">Cancelar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                       
                                </div>
</html>
