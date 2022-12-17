<div class="row">
	<div class="col-md">
		<strong><i class="fas fa-book mr-1"></i> ID/Usuario</strong>
		<p class="text-muted">
		  {{ $log->user_id }}/{{ $log->user_nombre }}
		</p>
	</div>
	<div class="col-md"></div>
</div>
<hr>
<div class="row">
	<div class="col-md">
		<strong><i class="far fa-file-alt mr-1"></i> tabla</strong>
		<p class="text-muted">
		  {{ $log->tabla }}
		</p>
	</div>
	<div class="col-md">
		<strong><i class="fas fa-pencil-alt mr-1"></i> Acción</strong>
		<p class="text-muted">{{ $log->accion }}</p>		
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md">		
		<strong><i class="far fa-file-alt mr-1"></i> Detalle</strong>
		@if($log->tabla == 'publicacion')
		<div class="col-md">
		  @php
		    echo $log->detalle;
		  @endphp  
		</div>  
		@else
		<p class="text-muted">{{ $log->detalle }}</p>
		@endif
	</div>
</div>
