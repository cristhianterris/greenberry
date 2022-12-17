<div class="alert alert-danger print-error-msg" style="display:none">
  <ul></ul>
</div>

<form  class="form box-body" id="formActualizarUsuario"> 
    @csrf    
    <input id="idUsuario" name="id" value="{{ $usuario->id }}" hidden="" type="number" />    
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" placeholder="Username" name="username" value="{{ $usuario->username }}" class="form-control" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">            
            <div class="form-group tipo_usuario">
                <label>Entrada</label> 
                <select class="form-control" name="tipo_usuario">     
                    <option value="0" @if($usuario->is_admin==0) selected @endif>Estándar</option>
                    <option value="1" @if($usuario->is_admin==1) selected @endif>Administrador</option>                                          
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-9">
            <div class="form-group">
                <label>Nombres</label>
                <input type="text" placeholder="Nombres" name="name" value="{{ $usuario->name }}" autofocus="autofocus" class="form-control" autocomplete="off">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label>correo</label>
                <input type="email" placeholder="Correo" name="email" value="{{ $usuario->email }}" class="form-control" autocomplete="off">
            </div>
        </div>
    </div>         
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <button class="btn btn-primary actionBtn float-right" id="footer_action_button" type="submit">
                    Actualizar
                </button>
            </div>
        </div>
    </div>
</form>


