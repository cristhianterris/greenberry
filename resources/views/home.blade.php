@extends('layouts.app')

@section('title','Dashboard home')

@section('content')

        <div class="row">
        
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Usuarios</span>
                <span class="info-box-number">{{ $totUsuarios }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Personas</span>
                <span class="info-box-number">{{ $totPersonas }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-inbox"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Mensajes</span>
                <span class="info-box-number">{{ $totMensajes }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div> 
          <!-- /.col -->

        </div>

        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Lista de personas</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>

              <div class="card-body p-0">
                <div class="table-responsive">

                <table class="table table-hover m-0">
                  <thead>
                  <tr>
                    <th></th>
                    <th>Nombres</th>
                    <th>Correo</th>
                    <th>Registrado</th>
                  </tr>
                  </thead>
                  <tbody>
                @if(count($personas)>0)
                  @foreach($personas as $persona)
                  <tr>       
                    <td>
                      <a href="#" onclick="infoPersona({{$persona->id}})"> 
                        <i class="fas fa-clipboard-list"></i>
                      </a>
                    </td> 
                    <td>
                      {{ $persona->nombres }}
                    </td>   
                    <td>
                      {{ $persona->correo }}
                    </td>  
                    <td>
                      {{ $persona->created_at }}
                    </td>  
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                @else
                    </tbody>
                  </table>
                  <div align="center">
                      <h5>No hay resultados</h5>
                  </div>
                @endif

                </div>

              </div>

              <div class="card-footer clearfix">

                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">Ver todo</a>
              </div>

            </div>
          </div>
          <div class="col-12 col-sm-6">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Histórico de correos</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>

              <div class="card-body p-0">
                <div class="table-responsive">

                  <table class="table table-hover m-0">
                    <thead>
                    <tr>
                      <th></th>
                      <th>Contacto</th>
                      <th>correo</th>
                      <th>Asunto</th>
                      <th>Fecha y Hora</th>
                    </tr>
                    </thead>
                    <tbody>
                  @if(count($mensajes)>0)
                    @foreach($mensajes as $mensaje)
                    <tr>       
                      <td>
                        <a href="#" onclick="infoMensaje({{$mensaje->id}})"><i class="far fa-envelope"></i></a>
                      </td>
                      <td>
                        {{ $mensaje->contacto }}
                      </td>  
                      <td>
                        <a href="mailto:{{ $mensaje->correo }}">{{ $mensaje->correo }}</a>
                      </td>    
                      <td> 
                        {{ Str::of( $mensaje->asunto )->limit(25) }}                           
                      </td>  
                      <td>
                        {{ $mensaje->created_at }}                             
                      </td> 
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                  @else
                      </tbody>
                    </table>
                    <div align="center">
                        <h5>No hay resultados</h5>
                    </div>
                  @endif





                </div>

              </div>

              <div class="card-footer clearfix">

                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">Ver todo</a>
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