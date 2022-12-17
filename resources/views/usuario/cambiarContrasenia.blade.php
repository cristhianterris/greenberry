<div class="alert alert-danger print-error-msg" style="display:none">
  <ul></ul>
</div>

<form  class="form box-body" id="formActualizarContrasenia"> 
    @csrf    
    <input id="idUsuario" name="id" value="{{ $usuario->id }}" hidden="" type="number" />       
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Nueva contraseña</label>
                <input type="password" placeholder="contraseña" name="password" value="" class="form-control" autocomplete="off">
            </div>
        </div>
    </div>   
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Confirmar contraseña</label>
                <input type="password" placeholder="contraseña" name="password_confirmation" value="" class="form-control" autocomplete="off">
            </div>
        </div>
    </div>            
    <div class="row">
        <div class="col-12">
            <div class="form-group pull-right">
                <button class="btn btn-primary actionBtn float-right" id="footer_action_button" type="submit">
                    Actualizar
                </button>
            </div>
        </div>
    </div>
</form>


