
<table class="table no-margin table-hover">
  <thead>
  <tr>
    <th></th>
    <th>IdUsuario</th>
    <th>Usuario</th>
    <th>Acción</th>
    <th>Tabla</th>
    <th>Detalle</th>
    <th>Fecha y Hora</th>
  </tr>
  </thead>
  <tbody>
@if(count($logs)>0)
  @foreach($logs as $log)
  <tr> 
    <td>
      <a href="#" onclick="infoLog({{ $log->id }})" data-toggle="tooltip" data-placement="bottom" title="Info Log">
        <i class="fas fa-clipboard-list"></i>
      </a>  
    </td>  
    <td>
      {{ $log->user_id }}
    </td>  
    <td>
      {{ $log->user_nombre }}
    </td>    
    <td>
      {{ $log->accion }}                             
    </td>  
    <td>
      {{ $log->tabla }}                             
    </td>  
    <td>
      {{  Str::limit($log->detalle, 120, ' ...') }}                             
    </td> 
    <td>
      {{ $log->created_at }}                             
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
<div class="d-flex justify-content-center" id="pg-logs">
    {{ $logs->links() }}
</div>