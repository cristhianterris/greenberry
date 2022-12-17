

<div class="row">
	<div class="col-12">
		<h4 class="text-red pb-0 mb-0">
			<b>
				{{ $entrada->entrada."." }}
			</b>
		</h4>
	@php
    	$i=0;
	@endphp
	@foreach($entrada->registros as $entrada_registro)
		@if(!is_null($entrada_registro["marca_frecuencia_uso"])) 

			@php $i++; @endphp	
		
			<P class="my-0 py-0"> 

				@if($i>1)
					<b>
					@php
					    echo $i.". ";
					@endphp 
					</b>
				@endif

				

					@foreach($entrada_registro["gramaticales"] as $registro_gramaticales)						

						@if ($loop->first && $loop->count>1)
					        {{ $registro_gramaticales->abreviatura }}
					    @endif

					    @if ($loop->last  && $loop->count>1)
					        , {{ $registro_gramaticales->abreviatura }}
					    @endif

					    @if ($loop->count==1)
					        {{ $registro_gramaticales->abreviatura }}
					    @endif

					    @if ($loop->iteration <> $loop->first && $loop->iteration <> $loop->last)
					    	, {{ $registro_gramaticales->abreviatura }}
					    @endif

					@endforeach


					@foreach($entrada_registro["sociolinguisticas"] as $registro_sociolinguisticas)						

						@if ($loop->first && $loop->count>1)
					        «{{ $registro_sociolinguisticas->abreviatura }}
					    @endif

					    @if ($loop->last  && $loop->count>1)
					        , {{ $registro_sociolinguisticas->abreviatura }}».
					    @endif

					    @if ($loop->count==1)
					        «{{ $registro_sociolinguisticas->abreviatura }}».
					    @endif

					    @if ($loop->iteration <> $loop->first && $loop->iteration <> $loop->last)
					    	, {{ $registro_sociolinguisticas->abreviatura }}
					    @endif

					@endforeach


					@foreach($entrada_registro["pragmaticas"] as $registro_pragmaticas)						

						@if ($loop->first && $loop->count>1)
					        «{{ $registro_pragmaticas->abreviatura }}
					    @endif

					    @if ($loop->last  && $loop->count>1)
					        , {{ $registro_pragmaticas->abreviatura }}».
					    @endif

					    @if ($loop->count==1)
					        «{{ $registro_pragmaticas->abreviatura }}».
					    @endif

					    @if ($loop->iteration <> $loop->first && $loop->iteration <> $loop->last)
					    	, {{ $registro_pragmaticas->abreviatura }}
					    @endif

					@endforeach


					@foreach($entrada_registro["diatopicas"] as $registro_diatopicas)						

						@if ($loop->first && $loop->count>1)
					        <cite title="Source Title">{{ $registro_diatopicas->abreviatura }}
					    @endif

					    @if ($loop->last  && $loop->count>1)
					        , {{ $registro_diatopicas->abreviatura }}</cite>
					    @endif

					    @if ($loop->count==1)
					        <cite title="Source Title">{{ $registro_diatopicas->abreviatura }}</cite>
					    @endif

					    @if ($loop->iteration <> $loop->first && $loop->iteration <> $loop->last)
					    	, {{ $registro_diatopicas->abreviatura }}
					    @endif

					@endforeach


					@foreach($entrada_registro["diatecnicas"] as $registro_diatecnicas)						

						@if ($loop->first && $loop->count>1)
					        {{ $registro_diatecnicas->abreviatura }}
					    @endif

					    @if ($loop->last  && $loop->count>1)
					        , {{ $registro_diatecnicas->abreviatura }}
					    @endif

					    @if ($loop->count==1)
					        {{ $registro_diatecnicas->abreviatura }}
					    @endif

					    @if ($loop->iteration <> $loop->first && $loop->iteration <> $loop->last)
					    	, {{ $registro_diatecnicas->abreviatura }}
					    @endif

					@endforeach



				{{ $entrada_registro["marca_frecuencia_uso"] }}

				@if(!is_null($entrada_registro["vease"])) 
					V. <b>{{ $entrada_registro["vease"] }}.</b> 
				@endif
				
			</P>
		@endif

	@endforeach

	@foreach($entrada->subentradas as $entrada_registro)

		<h5 class="pt-2 pb-0 mb-0">
			<b>{{ $entrada_registro["entrada"]."." }}</b>
		</h5>

		@php
	    	$i=0;
		@endphp

		@foreach($entrada_registro["registros"] as $subentrada_registro)

			@if( !is_null($subentrada_registro["marca_frecuencia_uso"]) ) 

				@php $i++; @endphp				
			
				<P class="my-0 py-0">
							
					@if($i>1)
						<b>
						@php
						    echo $i.". ";
						@endphp 
						</b>
					@endif



					@foreach($subentrada_registro["gramaticales"] as $registro_gramaticales)						

						@if ($loop->first && $loop->count>1)
					        {{ $registro_gramaticales->abreviatura }}
					    @endif

					    @if ($loop->last  && $loop->count>1)
					        , {{ $registro_gramaticales->abreviatura }}
					    @endif

					    @if ($loop->count==1)
					        {{ $registro_gramaticales->abreviatura }}
					    @endif

					    @if ($loop->iteration <> $loop->first && $loop->iteration <> $loop->last)
					    	, {{ $registro_gramaticales->abreviatura }}
					    @endif

					@endforeach


					@foreach($subentrada_registro["sociolinguisticas"] as $registro_sociolinguisticas)						

						@if ($loop->first && $loop->count>1)
					        «{{ $registro_sociolinguisticas->abreviatura }}
					    @endif

					    @if ($loop->last  && $loop->count>1)
					        , {{ $registro_sociolinguisticas->abreviatura }}».
					    @endif

					    @if ($loop->count==1)
					        «{{ $registro_sociolinguisticas->abreviatura }}».
					    @endif

					    @if ($loop->iteration <> $loop->first && $loop->iteration <> $loop->last)
					    	, {{ $registro_sociolinguisticas->abreviatura }}
					    @endif

					@endforeach


					@foreach($subentrada_registro["pragmaticas"] as $registro_pragmaticas)						

						@if ($loop->first && $loop->count>1)
					        «{{ $registro_pragmaticas->abreviatura }}
					    @endif

					    @if ($loop->last  && $loop->count>1)
					        , {{ $registro_pragmaticas->abreviatura }}».
					    @endif

					    @if ($loop->count==1)
					        «{{ $registro_pragmaticas->abreviatura }}».
					    @endif

					    @if ($loop->iteration <> $loop->first && $loop->iteration <> $loop->last)
					    	, {{ $registro_pragmaticas->abreviatura }}
					    @endif

					@endforeach


					@foreach($subentrada_registro["diatopicas"] as $registro_diatopicas)						

						@if ($loop->first && $loop->count>1)
					        <cite title="Source Title">{{ $registro_diatopicas->abreviatura }}
					    @endif

					    @if ($loop->last  && $loop->count>1)
					        , {{ $registro_diatopicas->abreviatura }}</cite>
					    @endif

					    @if ($loop->count==1)
					        <cite title="Source Title">{{ $registro_diatopicas->abreviatura }}</cite>
					    @endif

					    @if ($loop->iteration <> $loop->first && $loop->iteration <> $loop->last)
					    	, {{ $registro_diatopicas->abreviatura }}
					    @endif

					@endforeach


					@foreach($subentrada_registro["diatecnicas"] as $registro_diatecnicas)						

						@if ($loop->first && $loop->count>1)
					        {{ $registro_diatecnicas->abreviatura }}
					    @endif

					    @if ($loop->last  && $loop->count>1)
					        , {{ $registro_diatecnicas->abreviatura }}
					    @endif

					    @if ($loop->count==1)
					        {{ $registro_diatecnicas->abreviatura }}
					    @endif

					    @if ($loop->iteration <> $loop->first && $loop->iteration <> $loop->last)
					    	, {{ $registro_diatecnicas->abreviatura }}
					    @endif

					@endforeach



					
					{{ $subentrada_registro["marca_frecuencia_uso"] }} 
					
				</P>

			@endif
		@endforeach

	@endforeach


{{--

	MARCA FRECUENCIA DE USO

--}}

	@php
    	$j=0;
	@endphp
	@foreach($entrada->registros as $entrada_registro)
		@if(!is_null($entrada_registro["ejemplo"])) 

			@php $j++; @endphp	
		
			<em class="my-0 py-0"> 
			@php
			  	echo Str::of($entrada_registro["ejemplo"])->replace($entrada_registro["resaltado"],'<b>'. $entrada_registro["resaltado"].'</b>');	
							echo '<sup> '.$j.'</sup>';
			@endphp  
			</em><br>
		@endif

	@endforeach

	@foreach($entrada->subentradas as $entrada_registro)
		

		@php
	    	$i=0;
		@endphp

		@foreach($entrada_registro["registros"] as $subentrada_registro)

			@if( !is_null($subentrada_registro["ejemplo"]) ) 

				@php $j++; @endphp				
			
				<em class="my-0 py-0">	
				@php
					echo Str::of($subentrada_registro["ejemplo"])->replace($subentrada_registro["resaltado"],'<b>'. $subentrada_registro["resaltado"].'</b>');	
				    echo '<sup> '.$j.'</sup>';
				@endphp	
				</em><br>

			@endif
		@endforeach

	@endforeach

	</div>	
</div>



