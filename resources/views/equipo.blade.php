
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

  <title>DiPerú | Diccionario de peruanismos en línea</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/../../dist/css/adminlte.css">
  <!-- JQuery JS -->
  <script src="/plugins/jquery/jquery.min.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Libre+Baskerville%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100i%2C200i%2C300i%2C400i%2C500i%2C600i%2C700i%2C800i%2C900i&amp;subset=latin&amp;ver=4.9.16" type="text/css" media="all">

<style>


/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-light navbar-diperu">
    <div class="container py-2">
      <div class="row">
        <div class="col-sm-3">
          
          <a href="/" class="navbar-brand">
            <img src="/dist/img/DiPeru-logo.png" alt="DiPeru Logo">            
          </a>

        </div>
        <div class="col-sm-9 d-flex align-items-end">
          <div class="row">
            <div class="col-12 text-white">
              <h3>DiPerú</h3>
              
            </div>
            <div class="col-12 text-white">
              <h3>
                <b>Diccionario de peruanismos en línea</b>
              </h3>
            </div>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
        </div>
      </div>    
    </div>
  </nav>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md  navbar-collapse navbar-secondary" id="navbarSupportedContent">
    <div class="container " style="font-family: 'Libre Baskerville', serif;">
      <div class="navbar navbar-expand-md py-0" >
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link text-white" href="/">INICIO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/equipo">EQUIPO <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/contacto">CONTACTO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/planta">PLANTA</a>
          </li>
        </ul>
      </div>
       
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-4">


    <!-- Main content -->
    <div class="content">
      <div class="container">

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="input-group input-group-sm autocomplete">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-diperu buscarEntrada"><i class="fas fa-search"></i></button>
                    <input type="text" name="table_search" class="form-control float-right text-uppercase" placeholder="BUSCAR" list="busquedaList" id="buscarEntrada">
                  </div>                    
                </div>                           
              </div> 
            </div>
          </div>
        </div>

        <div class="row">
          
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body" id="ListaEntradaIndex">
                <h3><b>Equipo</b></h3><br>

                <dl class="dl-horizontal">
                  <dt>Presidente</dt>
                  <dd>Dr. Marco Martos Carrera (Presidente)</dd>

                  <dt>Director Técnico</dt>
                  <dd>Dr. Julio Calvo Pérez</dd>

                  <dt>Vicedirectora Técnica</dt>
                  <dd>Dra. Rosa Sonia Carrasco Ligarda</dd>

                  <dt>Secretaria Técnica</dt>
                  <dd>Mag. Consuelo Meza Lagos</dd>

                  <dt>Otros Miembros Operativos</dt>
                  <dd>Dra. María Chavarría</dd>
                  <dd>Dra. Aída Mendoza Cuba (†)</dd>
                  <dd>Mª del Carmen La Torre Cuadros (becaria y primera Secretaria Técnica)</dd>
                  <dd>Mag. María del Carmen Cuba Manrique</dd>
                  <dd>Mag. Rosa Luna García</dd>
                  <dd>Mag. María del Pilar Negrini Málaga</dd>
                  <dd>Mag. Teresa Ramos Quispe</dd>
                  <dd>Lic. Alicia Alonzo Sutta</dd>
                  <dd>Lic. Lady A. Leyva Ato </dd>
                  <dd>Lic. Marco Antonio Lovón Cueva (Director de Grupos Externos)</dd>
                  <dd>Lic. Gildo Valero Vega</dd>
                  <dd>D. Juan Enrique Quiroz Vela (primer Vicedirector Técnico)</dd>

                  <dt>Becarios</dt>
                  <dd>Paola Arana Vera, Ana Arias Torre, Agustín Panizo Jansana, Eder Peña Valenzuela, Isabel C. Wong Fupuy.</dd>

                  <dt>Experto en informática y diccionarios electrónicos</dt>
                  <dd>D. Luis Delboy</dd>

                  <dt>Formato</dt>
                  <dd>Lic. Patricia Maquera Vizcarra, Carol L. Marchán Aylas, Cinthya F. Porta Chuquillanqui.</dd>

                  <dt>Otros colaboradores</dt>
                    <dd>Dr. Augusto Alcocer Martínez.</dd>
                    <dd>Dr. Oscar Coello Cruz</dd>
                    <dd>Prof. Shirley Cortez Gonzales</dd>
                    <dd>Sr. Eduardo Vásquez Piérola</dd>
                    <dd>Sr. Richard Cacchione</dd>

                  <dt>Secretaria administrativa</dt>
                  <dd>Dª Magaly Rueda Frías</dd>

                  <dt>Revisión y corrección final</dt>
                  <dd>Dr. Julio Calvo Pérez</dd>

                  <dt>Cuidado de la edición</dt>
                  <dd>Dr. Marco Martos Carrera</dd>
                  <dd>Dr. Alberto Varillas Montenegro</dd>

                  <dt>Alumnos</dt>
                  <dd>A este listado se añade además un buen conjunto de alumnos y jóvenes lingüistas que han hecho aportes de diverso alcance al Diccionario de Peruanismos.</dd>
                </dl>
                
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h1 class="card-title" style="font-family: 'Libre Baskerville', serif;"><b>Palabra Recomendada</b></h1>
                <br>
                <div id="PalabraRecomendada">                  
                </div>                
              </div>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body d-flex justify-content-center align-items-center ">
                @foreach($letrasABC as $letraABC)
                      <button type="button " class="btn  btn-danger btn-flat mx-1 text-uppercase letraABC" id="letraABC" value="{{$letraABC->letra}}">{{$letraABC->letra}}</button>
                @endforeach
              </div> 
            </div>
          </div>
        </div>
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
   <footer class="main-footer navbar-diperu-1">
    <div class="container">
      <div class="row">
        <div class="col-4">
          <div class="text-dark">
            <h5>
              <strong>Academia Peruana de la Lengua</strong>
            </h5>
            <p>Email: <a href="mailto:diperu@apl.org.pe">diperu@apl.org.pe</a></p>
            <p>Dirección: Conde de Superunda N.° 298, Lima 1 – Perú</p>
            <p><a href="mailto:academiaperuanadelalengua.apl@gmail.com">academiaperuanadelalengua.apl@gmail.com</a></p>
            <p>Teléfono: <a href="tel:+51014282884">(01) 428-2884</a></p>
          </div>
        </div>
        <div class="col-4">
          <div class="text-dark">
            <h5>
              <strong>Enlaces de interés</strong>
            </h5>
            <p><a href="#">Academia Peruana de la Lengua</a></p>
            <p><a href="#">Boletin de la APL</a></p>
            <p><a href="#">Real Academia Espanola</a></p>
          </div>
        </div>
        <div class="col-4 ">
          <div class="text-dark">
            <h5>
              <strong>Patrocinado</strong>
            </h5>
            <img src="https://www.practicas.pe/organizaciones/practicas-minas-buenaventura.png">
          </div>
        </div>
      </div> 
      
    </div>
  </footer>

  <footer class="text-white navbar-diperu-2 py-1">    
    
    <div class="container">
        <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Diccionario de peruanismos en línea
      </div>
      <!-- Default to the left -->
      
        <strong>Copyright &copy; 2020 <a href="#">DiPerú</a>.</strong> All rights reserved.
      

    </div>
        
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
    <script>  
      $(document).ready(function(){        
        palabraRecomendada();
      });
    </script>

<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

<script src="{{ asset('/js/index.js') }}" type="text/javascript"></script>
</body>
</html>
