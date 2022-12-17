@extends('layouts.app')

@section('title','Mensajes')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Mensajes</h3>
                    <div class="card-tools"> 
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-3 input-group input-group-sm mb-3">
                            <input type="text" class="form-control text-uppercase" placeholder="Buscar" id="buscarMensaje">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>    
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" id="ListaMensaje">
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
            $('#Mensajes').addClass('active');
            listarMensaje();
            
        });
    </script>
    
@endsection
