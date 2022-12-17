
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
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.css">
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
            <a class="nav-link text-white" href="/">INICIO <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/equipo">EQUIPO</a>
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
                <h3><b style="font-family: 'Libre Baskerville', serif;">Sobre el DiPerú</b></h3>

                <p class="card-text">
                  El Perú tiene una larga tradición en temas lexicográficos. Recordamos con afecto a Diego de Villegas y Quevedo, presbítero nacido en Piura, quien tuvo a su cargo la revisión de la letra “m” en el <cite title="Source Title">Diccionario de Autoridades.</cite> Desde ese momento del siglo XVIII, mucha agua ha corrido bajo los puentes, se han sucedido distintos momentos de sumo interés para la investigación sobre los vocablos. Fresca está en la memoria de los peruanos estudiosos la actitud de Ricardo Palma en 1892, cuando tuvo vivo interés en lograr que numerosas voces de nuestras tierras se incorporasen al <cite title="Source Title">Diccionario de la Lengua Española</cite> de la RAE. Su intento, aparentemente derrotado, es el símbolo del derecho de los países americanos a usar la lengua española según sus usos y costumbres. En cierto sentido, Palma se adelanta a las más avanzadas posiciones de la lingüística contemporánea, que admiten y defienden que en el uso de cada hablante está presente al mismo tiempo el habla general y el habla regional.
                  <cite title="Source Title">Source</cite>
                </p> 

                <p class="card-text">
                  La aparición en 2010 del <cite title="Source Title">Diccionario de Americanismos,</cite> editado por la Asociación de Academias de la Lengua Española, aparte del significado académico de esta obra de gran envergadura, tiene el significado político de poner en pie de igualdad a todos los vocablos de la lengua española usados a los dos lados del Atlántico. El orbe hispano abarca a veintidós comunidades o países, cada uno de ellos con los mismos derechos y obligaciones. Justo es decir que los herederos de la Real Academia Española del siglo XIX han cambiado lentamente sus puntos de vista y ahora admiten con propiedad y galanura el derecho de los pueblos americanos a utilizar su particular forma de manejar el español.
                </p>  

                <p class="card-text">
                  Aparte de los dos trabajos de Palma, <cite title="Source Title">Papeletas lexicográficas</cite> y <cite title="Source Title">Neologismos y americanismos,</cite> en el siglo XIX destaca como investigador en el ramo Juan de Arona, Pedro Paz Soldán y Unanue, quien al publicar en 1883-1884 su libro <cite title="Source Title">Diccionario de Peruanismos</cite> sentó las bases de la investigación en todo el siglo siguiente. Durante varias décadas en el siglo XX, la lexicografía ha sido obra de aficionados, personas de buena voluntad que hacían listas de palabras y les colocaban significados según su leal saber y entender. Sin duda, el material que han recogido y trabajado es valioso en sí mismo como fuente de consulta, pero la falta de profesionalidad en su elaboración lo hace también desconfiable. Solo cuando lingüistas de oficio como Pedro Benvenutto Murrieta en los años treinta del siglo XX, o Martha Hildebrandt Pérez Treviño, desde los años sesenta hasta la actualidad, emprenden sus labores, podemos decir que la lexicografía peruana adquiere el perfil y la entraña del trabajo científico. Sin embargo, ni con todos sus vastos conocimientos, ni con sus denodados esfuerzos, estos dos estudiosos lograron hacer un diccionario de peruanismos. Tal honor le corresponde a Miguel Ángel Ugarte Chamorro, lingüista arequipeño, cuya familia publicó en 1997 su <cite title="Source Title">Vocabulario de Peruanismos</cite> que hasta hoy es el único trabajo de envergadura que puede citarse, al lado, sin duda, de diccionarios regionales valiosos, que no pueden desdeñarse. Lo que estaba haciendo falta era un diccionario de peruanismos colectivo, hecho por muchos investigadores. Esa es precisamente la obra que ponemos en manos de nuestros lectores.
                </p>

                <p class="card-text">
                  Este diccionario de peruanismos, <cite title="Source Title">DiPerú,</cite> empezó a ser soñado en 2005 y poco tiempo después se fueron organizando los grupos de trabajo dirigidos por el <cite title="Source Title">peruanista</cite> español Julio Calvo Pérez, que tenía ya veinte años laborando en asuntos de nuestro país, de literatura o de lingüística, desde el <cite title="Source Title">Ollantay</cite> hasta el quechua y su vínculo con el español. Calvo, Director Técnico del Proyecto es al mismo tiempo miembro correspondiente de la Academia Peruana de la Lengua. Para él y para todos los colaboradores, sin excepción posible, mi gratitud personal y la gratitud de la Academia Peruana de la Lengua y también la gratitud de los usuarios que tendrán en sus manos un instrumento confiable que bucea en los usos y costumbres de los hablantes del español en el Perú. Al mismo tiempo, nuestro reconocimiento institucional a la memoria de Alberto Benavides de la Quintana, miembro honorario de la Academia Peruana de la Lengua, quien a través de la empresa Buenaventura nos ha proporcionado medios materiales para llevar a cabo esta obra. Roque Benavides, actual responsable de dicha entidad, se está haciendo cargo también de la publicación. Para él también nuestro agradecimiento. Gratitud también a los colegas de la Academia Peruana de la Lengua que tanto nos han estimulado para no cejar en este empeño y de forma especial a Alberto Varillas Montenegro, por sus diarios ajetreos en la imprenta y a Ricardo Silva-Santisteban por el apoyo desde el cargo de presidente de la institución.
                </p>

                <p class="card-text">
                  Como otros diccionarios de países hispanoamericanos, el nuestro es un repertorio monolingüe y semasiológico, es decir que proporciona información sobre el significado de los términos, de modo preferente, y deja de lado la etimología, fuente de muchas controversias. Es fundamentalmente un diccionario de uso, que empieza ahí donde se detuvo Arona. Vale decir que recoge palabras desde 1882 hasta el día de hoy. Pero tal vez el rasgo más importante del diccionario es su característica de diferencial y, en ese sentido, los distintos orígenes de los propios investigadores, de todas las regiones del Perú, y el origen del director del proyecto, un español con alma de peruano, en lugar de ser una desventaja como algunos conjeturaban, se convirtió a la postre en una ventaja. Pero yendo más allá: podemos felicitarnos por la competencia lingüística de los estudiosos implicados, pero también, por el trabajo de campo realizado y por el manejo adecuado de una vasta bibliografía peruana, española y de numerosos países hispanoamericanos. 
                </p>

                <p class="card-text">
                  Recogemos palabras usadas en el Perú y que no pertenecen a la lengua general, aunque merced a la dicción y a la escritura de los peruanos, viajan como el viento a todos los rincones del mundo. Empezar fue difícil, la travesía fue complicada, hubo huracanes y tempestades que hicieron temblar nuestra nave, pero ahora, sosegados, arribamos a buen puerto: la publicación. Nuestra gratitud a todos los que leyeron los originales e hicieron aportes dentro y fuera de la institución. La nave está lista para partir y podemos pensar otra hazaña: la elaboración del Diccionario de uso el español del Perú, un equivalente del <cite title="Source Title">DRAE</cite> y del Diccionario de Americanismos. Esa es la tarea de los próximos diez años.
                </p>

                
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
        <div class="col-md-4">
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
        <div class="col-md-4">
          <div class="text-dark">
            <h5>
              <strong>Enlaces de interés</strong>
            </h5>
            <p><a href="#">Academia Peruana de la Lengua</a></p>
            <p><a href="#">Boletin de la APL</a></p>
            <p><a href="#">Real Academia Espanola</a></p>
          </div>
        </div>
        <div class="col-md-4 ">
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
