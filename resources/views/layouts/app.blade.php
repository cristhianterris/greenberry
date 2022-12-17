<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="/img/greenberry-logo-bg-green.png">

  <title>Greenberry | @yield('title')</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ url('/plugins/fontawesome-free/css/all.min.css') }} ">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ url('/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Toaster -->
  <link rel="stylesheet" href="{{ url('/plugins/toastr/toastr.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/dist/css/adminlte.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Libre+Baskerville%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100i%2C200i%2C300i%2C400i%2C500i%2C600i%2C700i%2C800i%2C900i&amp;subset=latin&amp;ver=4.9.16" type="text/css" media="all">
  <!-- JQuery JS -->
  <script src="{{ url('/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Date Picker CSS -->
  <link href="{{ url('/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet"/>
  <link href="{{ url('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet"/>

  <link href="{{ url('/plugins/summernote/summernote-bs4.min.css') }}" rel="stylesheet"/>


  <link href="{{ url('/plugins/select2/css/select2.min.css') }}" rel="stylesheet"/>
  <link href="{{ url('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet"/>
  <script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>
  <script src="{{ url('plugins/select2/js/i18n/es.js') }}"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed accent-info" style="height: auto;">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light">


    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="{{  url('/dist/img/AdminLTELogo.png') }}" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline">
              @if (Auth::check())
               {{ Auth::User()->name }}
              @else
                Invitado
              @endif

          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-greenberry">
            <img src="{{  url('/dist/img/AdminLTELogo.png') }}" class="img-circle elevation-2" alt="User Image">

            <p>

              @if (Auth::check())
                {{ Auth::User()->name }}
                <small>Member since {{ Auth::User()->created_at }}
                </small>
              @else
                Invitado
              @endif

            </p>
          </li>
          <!-- Menu Footer-->
          @if (Auth::check())
              <li class="user-footer">
             {{--  <a href="#" class="btn btn-default btn-flat">Perfil</a>--}}
              <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  Salir
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>

          @endif


        </ul>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-greenberry elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/home') }}" class="brand-link navbar-greenberry">
      <img src="{{  url('/dist/img/greenberry-white-logo.png') }}" alt="AdminLTE Logo" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight">Greenberry</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('/home') }}" class="nav-link" id="Home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header">MAESTROS</li>
        
        @if(Auth::user()->is_admin)
          <li class="nav-item">
            <a href="{{ url('/usuario') }}" class="nav-link" id="Usuarios">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>Usuarios</p>
            </a>
          </li>
        @endif
        
          
          <li class="nav-item">
            <a href="{{ url('/persona') }}" class="nav-link" id="Personas">
              <i class="nav-icon fas fa-spell-check"></i>
              <p>Personas</p>
            </a>
          </li>
         
          <li class="nav-header">OTROS</li>
          <li class="nav-item">
            <a href="/mensaje" class="nav-link" id="Mensajes">
              <i class="nav-icon fas fa-inbox"></i>
              <p>Mensajes</p>
            </a>
          </li>


        @if(Auth::user()->is_admin)
          <li class="nav-item">
            <a href="/log" class="nav-link" id="Logs">
              <i class="nav-icon fas fa-list-ol"></i>
              <p>Logs</p>
            </a>
          </li>
        @endif

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content pt-3">
      <div class="container-fluid">

        @yield('content')


      <div class="modal fade" id="myModalXl" style="overflow-y: scroll;">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="tituloModalXl">Extra Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="contentModalXl">
              <p>One fine body&hellip;</p>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="myModalLg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="tituloModalLg">Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="contentModalLg">
              <p>One fine body&hellip;</p>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="myModalMd">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="tituloModalMd">Default Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="contentModalMd">
              <p>One fine body&hellip;</p>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="myModalSm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="tituloModalSm">Small Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="contentModalSm">
              <p>One fine body&hellip;</p>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021-2021 <a href="#">Di Peru</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery
<script src="plugins/jquery/jquery.min.js"></script>-->
<!-- Bootstrap -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- SweetAlert2 -->
<script src="/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="/plugins/raphael/raphael.min.js"></script>
<script src="/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="/plugins/chart.js/Chart.min.js"></script>
<!-- SummerNote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<script src="/plugins/summernote/lang/summernote-es-ES.min.js"></script>
<!-- Minimizar main -->
<script src="{{ asset('/js/main.js') }}" type="text/javascript"></script>
</body>
</html>
