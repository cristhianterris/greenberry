@extends('layouts.app')

@section('title','Logs')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Logs</h3>
                    <div class="card-tools"> 
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-3 input-group input-group-sm mb-3">
                            <input type="search" class="form-control text-uppercase" placeholder="Buscar" id="buscarLog">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>    
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" id="ListaLog">
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
            $('#Logs').addClass('active');
            listarLog();
            
        });
    </script>
    
@endsection
