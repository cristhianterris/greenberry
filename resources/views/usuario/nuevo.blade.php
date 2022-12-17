<div class="alert alert-danger print-error-msg" style="display:none">
  <ul></ul>
</div>

<form  class="form box-body" id="formNuevoUsuario"> 
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" placeholder="Username" name="username" value="" class="form-control" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">            
            <div class="form-group tipo_usuario">
                <label>Entrada</label> 
                <select class="form-control" name="tipo_usuario">     
                    <option value="0">Estándar</option>
                    <option value="1">Administrador</option>                                          
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label>Nombres</label>
                <input type="text" placeholder="Nombres" name="name" value="" class="form-control" autocomplete="off">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>correo</label>
                <input type="email" placeholder="Correo" name="email" value="" class="form-control" autocomplete="off">
            </div>
        </div>
    </div>		      
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button class="btn btn-primary actionBtn float-right" id="footer_action_button" type="submit">
                    Grabar
                </button>
            </div>
        </div>
    </div>
</form>