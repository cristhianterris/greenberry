@if(count($equipos)>0)
  @foreach($equipos as $equipo)

	<div class="col-md-12">
		<div class="callout callout-warning">	
			<button type="button" class="btn btn-tool float-right" onclick="eliminarTorneoEquipo({{$equipo->id}},{{ $equipo->tournamentID}})">
				<i class="fas fa-times"></i>
            </button>
			<table>
				<tbody>
					<tr>
						<td>
							<img src="{{ $equipo->urlLogo }}" alt="Logo {{  $equipo->teamID }}" class="img-size-50 mr-2">	
						</td>
						<td>
							<h4>{{ $equipo->name }}</h4> 
						</td>	
						<td>
							<a href="#" class="btn btn-success load" onclick="cargarPartidas({{ $equipo->teamID }})"><i class="fas fa-sync-alt load"></i></a>
						</td>					
				</tr>
				</tbody>
				
			</table>

			             
        </div>
	</div>

	@endforeach
@else
<div class="col-md-12 text-center">
	<p>No hay resultados</p> 
</div>
	 
@endif
