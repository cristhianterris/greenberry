

@if(count($entradas)>0)

  @foreach($entradas as $entrada)
  <ul class="list-unstyled">
    <li>
      <a href="/buscar/{{ urlencode($entrada->entrada) }}" class="text-red" {{--onclick="infoEntradaIndex({{ $entrada->id }})"--}}>
        <h5>
          <b>
            {{ $entrada->entrada }}
          </b>
        </h5>
      </a>           
    </li>
  </ul>
  @endforeach
@else    
  <div align="center">
      <h5>No hay resultados</h5>
  </div>
@endif
  <div class="d-flex justify-content-center" id="pg-entradasIndex">
      {{ $entradas->links() }}
  </div>