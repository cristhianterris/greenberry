@extends('layouts.app')

@section('title','Torneos')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-trophy"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">1° PUESTO</span>
            @if(count($puestos)>0)
                    <span class="info-box-number">
                        {{ $puestos[0]->teamName }}
                    </span>
                </div>
                <img src="{{ $puestos[0]->teamLogo }}" alt="Logo" class="info-box-icon img-size-50 mr-2">
            @else
            	-
            	</div>

            @endif
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
          <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-trophy"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">2° PUESTO</span>
            @if(count($puestos)>1)
                    <span class="info-box-number">
                    	{{ $puestos[1]->teamName }}
                    </span>
                </div>
                	<img src="{{ $puestos[1]->teamLogo }}" alt="Logo" class="info-box-icon img-size-50 mr-2">	
            @else
				-
            	</div>
            @endif
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-trophy"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">3° PUESTO</span> 
                @if(count($puestos)>2)
                    <span class="info-box-number">                    	
                    	{{ $puestos[2]->teamName }}
                    </span>
                </div>
                <img src="{{ $puestos[2]->teamLogo }}" alt="Logo" class="info-box-icon img-size-50 mr-2">
                @else
                	-
            	</div>
                @endif
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-medal"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">MÁS KILLS</span>

            @if(count($topKills)>0)
                    <span class="info-box-number">{{ $topKills[0]->username }}</span>
                </div>
                <img src="{{ $topKills[0]->teamLogo }}" alt="Logo" class="info-box-icon img-size-50 mr-2">
            @else
                	-
            	</div>
            @endif




                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

	<div class="row">
		<div class="col-md-8">
	@php
    	$i=0;
	@endphp	
	
	@foreach($puestos as $puesto)	
			
		@php
	    	$i++;
		@endphp	
			<div class="card collapsed-card @if($i==1) card-outline card-warning @elseif($i==2) card-outline card-danger @elseif($i==3) card-outline card-success @endif">
             	<div class="card-header"  data-card-widget="collapse">
             	  	<div class="row">
             	  		<div class="col-1 text-center">
             	  			<h2>
             	  				@php
								    echo $i;
								@endphp
             	  			</h2>		
             	  		</div>
             	  		<div class="col-5">
             	  			<table>
								<tbody>
									<tr>
										<td>
											<img src="{{ $puesto->teamLogo }}" alt="Logo" class="img-size-50 mr-2">	
										</td>
										<td>
											<h4>{{$puesto->teamName}}</h4> 
										</td>					
								</tr>
								</tbody>
								
							</table>
             	  			
             	  		</div>
             	  		<div class="col-3 offset-3 pull-right">
             	  			
											<h3 class="float-right">
												@if(isset($puesto->puntosTotal))
													{{$puesto->puntosTotal}} Ptos
												@else
													0 Ptos
												@endif
											</h3> 
										
             	  		</div>

             	  	</div>

             	</div>
             	<!-- /.card-header -->
             	<div class="card-body p-0" style="display: none;">   

					



        @if(count($equipoPartidas)>0)


			@foreach($equipoPartidas as $equipoPartida)	
				@if($puesto->teamID == $equipoPartida->teamID)
				<div class="card collapsed-card my-0">
             		<div class="card-header pb-0" data-card-widget="collapse">
             	  	<div class="row px-3 py-0">
	             	  		<div class="col-1 text-center">
	             	  			<h5>
	             	  				{{$equipoPartida->teamPlacement}}
	             	  			</h5>		
	             	  		</div>
	             	  		<div class="col-3">
	             	  			<table>
									<tbody>
										<tr>
											<td>
												<h5>BR Quads</h5>
											</td>
											<td>
												<h6 class="lead">Verdansk</h6> 
											</td>					
									</tr>
									</tbody>
								</table>
	             	  		</div>
	             	  		<div class="col-2 ">   
	             	  			<table>
									<tbody>
										<tr>
											<td>
												<p>
													@php 
								                        date_default_timezone_set('America/Lima');
								                        echo date('H:i',strtotime($equipoPartida->utcStart.' UTC'));
								                    @endphp
												</p> 
											</td>					
									</tr>
									</tbody>
								</table>
	             	  		</div>
	             	  		<div class="col-2">   
	             	  			<table>
									<tbody>
										<tr>
											<td>
												<p>
													{{$equipoPartida->killsTotal}} Kills
												</p> 
											</td>					
									</tr>
									</tbody>									
								</table>											
	             	  		</div>
	             	  		<div class="col-1">    
	             	  			<table>
									<tbody>
										<tr>
											<td>
												<p>
													{{$equipoPartida->teamSurvivalTime }}  
											</p></td>					
									</tr>
									</tbody>									
								</table>											
	             	  		</div>
	             	  		<div class="col-3 pull-right">	             	  			
												<h5 class="float-right">{{$equipoPartida->puntosTotal}} Ptos</h5> 											
	             	  		</div>
	             	</div>  

             	</div>
             	<!-- /.card-header -->
	             	<div class="card-body p-0 bg-light" style="display: none;">            	 
						

		             	@foreach($partidas as $partida)
			             	@if($partida->matchID == $equipoPartida->matchID && $partida->teamID == $equipoPartida->teamID )
				            	<div class="row  px-5 py-1 ">
				             	  		
				             	  		<div class="col-3 offset-1">
				             	  			<table>
												<tbody>
													<tr>
														<td>
															<h5>BR Quads</h5>
														</td>
														<td>
															<h6 class="lead">{{ $partida->username }}</h6> 
														</td>					
												</tr>
												</tbody>
												
											</table>
				             	  			
				             	  		</div>
				             	  		<div class="col-2 ">            	  			
											
				             	  			<table>
												<tbody>
													<tr>
														<td>
															<p>
																{{ $partida->kills }} Kills
															</p> 
														</td>					
												</tr>
												</tbody>
												
											</table>
														
				             	  		</div>
				             	  		<div class="col-2">            	  			
											
				             	  			<table>
												<tbody>
													<tr>
														<td>
															<p>
																{{ $partida->damageDone }}
															</p> 
														</td>					
												</tr>
												</tbody>
												
											</table>
														
				             	  		</div>
				             	  		<div class="col-1 pull-right">            	  			
											
				             	  			<table>
												<tbody>
													<tr>
														<td>
															<p>
																{{ $partida->score }}
														</td>					
												</tr>
												</tbody>
												
											</table>
														
				             	  		</div>
				             	  		<div class="col-3">
				             	  			
															<h5 class="float-right">{{ $partida->puntosKill }} Ptos</h5> 
														
				             	  		</div>

				             	</div>  
				            @endif
			            @endforeach

						
						
	             	  <!-- /.table-responsive -->
		             </div>
	             	<!-- /.card-footer -->
	            </div>

				@endif

	        @endforeach 

	    @else
	    	<p class="text-center">
	    		No hay resultados
	    	</p>
	    @endif



	             	  <!-- /.table-responsive -->
	             	</div>
	             	<!-- /.card-footer -->
	            </div>
	@endforeach

		</div>
		<div class="col-md-4">
            <div class="card card-outline card-primary">
              	<div class="card-header" data-card-widget="collapse">
              	  	<h3 class="card-title text-center">Tabla de Puntuación</h3>
              	</div>
              	<!-- /.card-header -->
              	<div class="card-body table-responsive p-0">
              	 	<table class="table table-hover text-center">
                 		<thead>
                 		  	<tr>
                 		  	  	<th>Puesto</th>
                 		  	  	<th>Puntos</th>
                 		  	</tr>
                 		</thead>
                 		<tbody>
                 		  	<tr>
						  	  	<td>1° Puesto</td>
						  	  	<td>55 puntos</td>
							</tr>
							<tr>
							    <td>2° Puesto</td>
							    <td>45 puntos</td>
							</tr>
							<tr>
							    <td>3° Puesto</td>
							    <td>40 puntos</td>
							</tr>
							<tr>
							    <td>4° Puesto</td>
							    <td>35 puntos</td>
							</tr>
							<tr>
							    <td>5° Puesto</td>
							    <td>30 puntos</td>
							</tr>
							<tr>
							    <td>6° Puesto</td>
							    <td>25 puntos</td>
							</tr>
							<tr>
							    <td>7° Puesto</td>
							    <td>20 puntos</td>
							</tr>
							<tr>
							    <td>8° Puesto</td>
							    <td>15 puntos</td>
							</tr>
							<tr>
							    <td>9° Puesto</td>
							    <td>10 puntos</td>
							</tr>
							<tr>
							    <td>10° Puesto</td>
							    <td>5 puntos</td>
							</tr>
							<tr>
							    <td>Kills</td>
							    <td>2 puntos</td>
							</tr>
                  		</tbody>
              	  	</table>
              	</div>
              	<!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card card-outline card-primary">
              <div class="card-header border-0" data-card-widget="collapse">
                <h3 class="card-title">Top Kills</h3>
                <div class="card-tools">
                  
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th></th>
                    <th>Equipo</th>
                    <th>Jugador</th>
                    <th>Kills</th>
                  </tr>
                  </thead>
                  <tbody>
@if(count($topKills)>0)
                @foreach($topKills as $topkill)
                  <tr>
                    <td>
                      <img src="{{ $topkill->teamLogo }}" alt="Product 1" class="img-size-32 mr-2">
                    </td>
                    <td>{{  $topkill->teamName }}</td>
                    <td>
                      {{ $topkill->username }}
                    </td>
                    <td>
                      {{ $topkill->killsTotal }}
                    </td>
                  </tr>
                @endforeach
@else
<tr>
	<td colspan="4">
		<p class="text-center">
			No hay resultados
		</p>
	</td>
<tr>
@endif
                  </tbody>
                </table>
              </div>
            </div>

          </div>
	</div>


    
@endsection
