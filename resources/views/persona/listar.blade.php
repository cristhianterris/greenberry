
<table class="table no-margin table-hover">
  <thead>
  <tr>
    <th></th>
    <th>Nombres</th>
    <th>Correo</th>
    <th>Registrado</th>
    <th></th>
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
    <td class="text-right py-0 align-middle">
    @if(Auth::user()->is_admin)  
      <div class="btn-group btn-group-sm">
        <a href="#" class="btn btn-secondary" onclick="enviarCorreo({{ $persona->id }})"><i class="fa fa-envelope"></i></a>
        <a href="#" class="btn btn-info" onclick="editarPersona({{ $persona->id }})"><i class="fas fa-pencil-alt"></i></a>
        <a href="#" class="btn btn-danger" onclick="eliminarPersona({{ $persona->id }})"><i class="fas fa-trash"></i></a>
      </div>       
    @endif   
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
<div class="d-flex justify-content-center" id="pg-personas">
    
</div>{{ $personas->links() }}