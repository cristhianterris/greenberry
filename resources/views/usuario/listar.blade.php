
<table class="table no-margin table-hover">
  <thead>
  <tr>
    <th></th>
    <th>Nombres</th>
    <th>Usuario</th>     
    <th>Correo</th>
    <th>Registrado</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
@if(count($usuarios)>0)
  @foreach($usuarios as $usuario)
  <tr>   
    <td>
       @if($usuario->is_admin==1)
        <i class="fas fa-user-secret"></i>
      @else
        <i class="fas fa-user-tie"></i>
      @endif
    </td>
    <td>{{ $usuario->name }}</td>
    <td>{{ $usuario->username }}</td>
    <td>{{ $usuario->email }}</td>
    <td>{{ $usuario->created_at }}</td>
    <td class="text-right py-0 align-middle">
      <div class="btn-group btn-group-sm">
        <a href="#" class="btn btn-warning" onclick="cambiarContrasenia({{ $usuario->id }})"><i class="fas fa-key"></i></a>
        <a href="#" class="btn btn-info" onclick="editarUsuario({{ $usuario->id }})"><i class="fas fa-pencil-alt"></i></a>
        @if($usuario->id>1) 
          <a href="#" class="btn btn-danger" onclick="eliminarUsuario({{ $usuario->id }})"  ><i class="fas fa-trash"></i></a>
        @endif
      </div>                        
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
<div class="d-flex justify-content-center" id="pg-usuarios">
    {{ $usuarios->links() }}
</div>