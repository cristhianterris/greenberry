
<table class="table no-margin table-hover">
  <thead>
  <tr>
    <th></th>
    <th>Contacto</th>
    <th>correo</th>
    <th>Asunto</th>
    <th>Mensaje</th>
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
      {{ Str::of( $mensaje->mensaje )->limit(45) }}                          
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
<div class="d-flex justify-content-center" id="pg-mensajes">
    {{ $mensajes->links() }}
</div>