<div class="alert alert-danger print-error-msg" style="display:none">
  <ul></ul>
</div>

<form  class="form box-body" id="formActualizarPersona"> 
    @csrf  
    <input id="persona_id" name="persona_id" value="{{ $persona->id }}" hidden="" type="number" />     
    <div class="row">
        <div class="col-md">
            <div class="form-group">
                <label>Nombres</label>
                <input type="text" placeholder="Ingresar" name="nombres" value="{{ $persona->nombres }}" class="form-control" autocomplete="off">
            </div>
        </div>
    </div>  
    <div class="row">
        <div class="col-md">
            <div class="form-group">
                <label>Correo</label>
                <input type="emal" placeholder="Ingresar" name="correo" value="{{ $persona->correo }}" class="form-control" autocomplete="off">
            </div>
        </div>
    </div>         
    <div class="row">          
        <div class="col-md-12">
            <div class="form-group">
                <button class="btn btn-primary actionBtn float-right" id="footer_action_button" type="submit">
                    Actualizar
                </button>
            </div>
        </div>
    </div>
</form>
