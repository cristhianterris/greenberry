@extends('layouts.app')

@section('title','Dashboard home')

@section('content')

        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Torneos</span>
                <span class="info-box-number">
                  {{ $torneoTotal }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Equipos</span>
                <span class="info-box-number">{{ $equipoTotal }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-friends"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Jugadores</span>
                <span class="info-box-number">{{ $jugadorTotal }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->



          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Inscripciones</span>
                <span class="info-box-number">{{ $inscripcionesTotal }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->


        </div>
        <div class="row">
          <div class="col-md-8">
              
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Torneos</h3>
                <div class="card-tools">                  
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-valign-middle">                    
                  <tbody>
                  @foreach($torneos as $torneo)
                    <tr>
                      <td>{{ $torneo->name }}</td>
                      <td>
                        <a href="#" class="text-muted float-right">
                          <i class="fas fa-search"></i>
                        </a>
                      </td>
                    </tr>     
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Equipos</h3>
                <div class="card-tools">                  
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-valign-middle">                    
                  <tbody>
                  @foreach($equipos as $equipo)
                    <tr>
                      <td>
                        <img src="{{ $equipo->urlLogo }}" alt="Product 1" class="img-size-32 mr-2">                        
                      </td>
                      <td>{{ $equipo->name }}</td>
                      <td>
                        <a href="#" class="text-muted float-right">
                          <i class="fas fa-search"></i>
                        </a>
                      </td>
                    </tr>     
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Jugadores</h3>
                <div class="card-tools">                  
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-valign-middle">                    
                  <tbody>
                  @foreach($jugadores as $jugador)
                    <tr>
                      <td>
                        <img src="{{ $jugador->teamLogo }}" alt="Product 1" class="img-circle img-size-32 mr-2">                      
                      </td>
                      <td>{{ $jugador->username }}</td>
                      <td>
                        <a href="#" class="text-muted float-right">
                          <i class="fas fa-search"></i>
                        </a>
                      </td>
                    </tr>     
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
<script>
  $(document).ready(function(){
    $('#Home').addClass('active'); 
  });
</script>
@endsection