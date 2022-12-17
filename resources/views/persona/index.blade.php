@extends('layouts.app')

@section('title','Personas')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Personas</h3>
                    <div class="card-tools">
                    @if(Auth::user()->is_admin) 
                      <a href="#" onclick="nuevaPersona()"><i class="fas fa-plus"> Nuevo</i></a>
                    @endif                      
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-3 input-group input-group-sm mb-3">
                            <input type="search" class="form-control text-uppercase" placeholder="Buscar" id="buscarPersona">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>    
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" id="ListaPersona">
                                <div class="overlay py-4">
                                  <i class="fas fa-2x fa-sync-alt fa-spin fa-3x fa-fw"></i>
                                </div>                                
                            </div>                            
                        </div>
                    </div>
                  
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->

    <script>  
        $(document).ready(function(){
            $('#Personas').addClass('active');
            listarPersona();
            
        });
    </script>
    
@endsection
