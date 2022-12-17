var csrfToken = $('[name="csrf_token"]').attr('content');

function refreshToken(){
    $.get('refresh-csrf').done(function(data){
        csrfToken = data; // the new token
    });
}
setInterval(refreshToken, 3600000); // 1 hour 3600000

const Toast = Swal.mixin({
    toast: true,
    position:'top-end',
    showConfirmButton: false,
    timer: 3000
});

var timer = null;

$('#buscarUsuario').change(function(){
    clearTimeout(timer);
    timer = setTimeout(buscarUsuario, 500)
});
$('#buscarEntrada').change(function(){
    clearTimeout(timer);
    timer = setTimeout(buscarEntrada, 500)
});
$('#buscarRegistro').change(function(){
    clearTimeout(timer);
    timer = setTimeout(buscarRegistro, 500)
});
$('#buscarPersona').change(function(){
    clearTimeout(timer);
    timer = setTimeout(buscarPersona, 500)
});
$('#buscarSociolinguistica').change(function(){
    clearTimeout(timer);
    timer = setTimeout(buscarSociolinguistica, 500)
});
$('#buscarPragmatica').change(function(){
    clearTimeout(timer);
    timer = setTimeout(buscarPragmatica, 500)
});
$('#buscarDiatopica').change(function(){
    clearTimeout(timer);
    timer = setTimeout(buscarDiatopica, 500)
});
$('#buscarDiatecnica').change(function(){
    clearTimeout(timer);
    timer = setTimeout(buscarDiatecnica, 500)
});
$('#buscarMensaje').change(function(){
    clearTimeout(timer);
    timer = setTimeout(buscarMensaje, 500)
});
$('#buscarLog').change(function(){
    clearTimeout(timer);
    timer = setTimeout(buscarLog, 500)
});

    var listar = function() {
        $.ajax({
            type: "get",
            url: "/listar",
            success: function(data) {            
                $("#ListaEntradaIndex").empty().html(data);            
            }
        });
    };
    
    var listarEntradaIndex = function() {
        $.ajax({
            type: "get",
            url: "/listar",
            success: function(data) {            
                $("#ListaEntradaIndex").empty().html(data);            
            }
        });
    };

    var infoEntradaIndex = function(id) {
        $.ajax({
            type: 'get',
            url: '/info/'+id,
            success: function(data) { 
            $("#ListaEntradaIndex").empty().html(data);
            }
        });
    };

    var infoEntrada = function(id) {
        $.ajax({
            type: 'get',
            url: '/info/'+id,
            success: function(data) { 
                $('#tituloModalLg').empty().html("<i class='fa fa-clock-o'></i> Entrada");
                    $('#contentModalLg').empty().html(data);     
                    $('#myModalLg').modal({backdrop: 'static'});
                }
        });
    };

    var infoEntradaConfig = function() {
        $.ajax({
            type: 'get',
            url: '/palabraRecomendada',
            success: function(data) {                 
                $('#PalabraRecomendada').empty().html(data);     

            }
        });
    };

    $(document).on("click", "#pg-entradasIndex .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaEntradaIndex").empty().html(data);
            }
        });
    });

    $('.card-body').on('click', '.buscarEntradaIndex', function(event){
        $('.buscarEntrada').prop('disabled', true);
        event.preventDefault();
        var x = document.getElementById("buscarEntradaIndex");
        x.value = x.value.toUpperCase();
        if (x.value == '') {
            listarEntradaIndex();

        } else {
            
            $.ajax({
                type: "get",
                url: "/buscar/" + x.value,
                success: function(data) {
                    $("#ListaEntradaIndex").empty().html(data);
                }
            });
        } 
        $('.buscarEntrada').prop('disabled', false);          
    });

/*  Usuarios
*/
    var listarUsuario = function() {
        $.ajax({
            type: "get",
            url: "/usuario/listar",
            success: function(data) {            
                $("#ListaUsuario").empty().html(data);            
            }
        });
    };

    var infoUsuario = function(id) {
        $.ajax({
            type: 'get',
            url: '/usuario/'+id,
            success: function(data) {  
                $('#tituloModalMd').empty().html("<i class='fa fa-clock-o'></i> Usuario");
                $('#contentModalMd').empty().html(data);     
                $('#myModalMd').modal({backdrop: 'static'});
            }
        });
    };
    
    var nuevoUsuario = function() {
        $.ajax({
            type: "get",
            url: "/usuario/nuevo",
            success: function(data) {  
                $('#tituloModalMd').empty().html('<i class="fa fa-rocket"></i> Nuevo Usuario');
                $('#contentModalMd').empty().html(data);       
                $('.actionBtn').addClass('grabarUsuario'); 
                $("#myModalMd").modal({backdrop: "static"});
            }
        });
    };

    var editarUsuario = function(usuario_id) {
        $.ajax({
            type: 'get',
            url: '/usuario/'+usuario_id+'/editar',
            success: function(data) {  
                $('#tituloModalMd').empty().html("<i class='fa fa-rocket'></i> Editar Usuario");
                $('#contentModalMd').empty().html(data);         
                $('.actionBtn').addClass('actualizarUsuario'); 
                $('#myModalMd').modal({backdrop: 'static'});
            }
        });
    };
    
    var cambiarContrasenia = function(userID) {
        $.ajax({
            type: 'get',
            url: '/usuario/'+userID+'/cambiarContrasenia',
            success: function(data) {  
                $('#tituloModalSm').empty().html("<i class='fas fa-key'></i> Cambiar Contraseña");
                $('#contentModalSm').empty().html(data);         
                $('.actionBtn').addClass('actualizarContrasenia'); 
                $('#myModalSm').modal({backdrop: 'static'});
            }
        });
    };  
       
    var buscarUsuario = function() {
        var x = document.getElementById("buscarUsuario");
        x.value = x.value.toUpperCase();
        if (x.value == '') {
            listarUsuario();
        } else {
            $.ajax({
                type: "get",
                url: "/usuario/buscar/" + x.value,
                success: function(data) {
                    $("#ListaUsuario").empty().html(data);
                }
            });
        }
    };

    var eliminarUsuario = function(id) 
    {    
        if (confirm('Seguro de Eliminar este usuario?')) {
            $.ajax({
                url: '/usuario/'+id+'/eliminar',
                type: "get",
                success: function (data) {
                    listarUsuario();
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                }
            });
        }
    };

    $(document).on("click", "#pg-usuarios .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaUsuario").empty().html(data);
            }
        });
    });

    $('.modal-body').on('click', '.grabarUsuario', function(event){
        $('.grabarUsuario').prop('disabled', true);
        event.preventDefault();
        var data = $( "#formNuevoUsuario" ).serialize();
        $.post( "/usuario/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide');   
                listarUsuario();
                $("#myModalMd").modal("hide");
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.grabarUsuario').prop('disabled', false);
            }    
        });           
    });
    $('.card-body').on('click', '.grabarConfiguracion', function(event){
        event.preventDefault();
        var data = $( "#formGrabarConfiguracion" ).serialize();
        $.post( "/configuracion/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) { 
                infoEntradaConfig();                 
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
            }    
        });           
    });
    $('.modal-body').on('click', '.actualizarUsuario', function(event){
        $('.actualizarUsuario').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarUsuario" ).serialize();
        var id = $( "#idUsuario" ).val();        
        $.post( "/usuario/"+id+"/actualizar", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                $("#myModalMd").modal("hide");
                listarUsuario();
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.actualizarUsuario').prop('disabled', false);
            }
        });   
    });


    $('.modal-body').on('click', '.actualizarContrasenia', function(event){
        $('.actualizarContrasenia').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarContrasenia" ).serialize();
        var id = $( "#idUsuario" ).val();        
        $.post( "/usuario/"+id+"/actualizarContrasenia", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                listarUsuario();
                $("#myModalSm").modal("hide");
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.actualizarContrasenia').prop('disabled', false);
            }
        });   
    });

    var listarEntrada = function() {
        $.ajax({
            type: "get",
            url: "/entrada/listar",
            success: function(data) {            
                $("#ListaEntrada").empty().html(data);            
            }
        });
    };
    var listarSubEntrada = function(entrada_id) {
        $.ajax({
            type: 'get',
            url: '/entrada/'+entrada_id+'/subEntradas',
            success: function(data) {  
                $("#ListaSubEntradas-"+entrada_id).empty().html(data);
            }
        });
    };
    var buscarEntrada = function() {
        var x = document.getElementById("buscarEntrada");
        x.value = x.value.toUpperCase();
        if (x.value == '') {
            listarEntrada();
        } else {
            $.ajax({
                type: "get",
                url: "/entrada/buscar/" + x.value,
                success: function(data) {
                    $("#ListaEntrada").empty().html(data);
                }
            });
        }
    };

    var nuevaEntrada = function() {
        $.ajax({
            type: "get",
            url: "/entrada/nuevo",
            success: function(data) {  
                $('#tituloModalLg').empty().html('<i class="fas fa-font"></i> Nueva Entrada');
                $('#contentModalLg').empty().html(data);       
                $('.actionBtn').addClass('grabarEntrada'); 
                $("#myModalLg").modal({backdrop: "static"});
            }
        });
    };

    var nuevaSubEntrada = function(entrada_id) {
        $.ajax({
            type: 'get',
            url: '/entrada/'+entrada_id+'/nuevo',
            success: function(data) {  
                $('#tituloModalLg').empty().html('<i class="fas fa-font"></i> Nueva Entrada');
                $('#contentModalLg').empty().html(data);       
                $('.actionBtn').addClass('grabarEntrada'); 
                $("#myModalLg").modal({backdrop: "static"});
            }
        });
    };

    var editarEntrada = function(entrada_id) {
        $.ajax({
            type: 'get',
            url: '/entrada/'+entrada_id+'/editar',
            success: function(data) {  
                $('#tituloModalSm').empty().html("<i class='fa fa-rocket'></i> Editar Entrada");
                $('#contentModalSm').empty().html(data);         
                $('.actionBtn').addClass('actualizarEntrada'); 
                $('#myModalSm').modal({backdrop: 'static'});
            }
        });
    };

    var eliminarEntrada = function(id) 
    {    
        if (confirm('Seguro de Eliminar esta entrada?')) {
            $.ajax({
                url: '/entrada/'+id+'/eliminar',
                type: "get",
                success: function (data) {
                    listarEntrada();
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                }
            });
        }
    };

    $(document).on("click", "#pg-entradas .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaEntrada").empty().html(data);
            }
        });
    });

    $('.modal-body').on('click', '.grabarEntrada', function(event){
        $('.grabarEntrada').prop('disabled', false);
        event.preventDefault();
        var data = $( "#formNuevaEntrada" ).serialize();
        $.post( "/entrada/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide');
                listarEntrada(); 
                $("#myModalLg").modal("hide");  
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.grabarEntrada').prop('disabled', false);
            }    
        });           
    });

    $('.modal-body').on('click', '.actualizarEntrada', function(event){
        $('.actualizarEntrada').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarEntrada" ).serialize();
        var id = $( "#entrada_id" ).val();        
        $.post( "/entrada/"+id+"/actualizar", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                $("#myModalSm").modal("hide");
                listarEntrada();
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.actualizarEntrada').prop('disabled', false);
            }
        });   
    });

    var listarRegistro = function() {
        $.ajax({
            type: "get",
            url: "/registro/listar",
            success: function(data) {            
                $("#ListaRegistro").empty().html(data);            
            }
        });
    };

    var infoRegistro = function(id) {
        $.ajax({
            type: 'get',
            url: '/registro/'+id,
            success: function(data) {  
                $('#tituloModalLg').empty().html("<i class='fa fa-clock-o'></i> Registro");
                $('#contentModalLg').empty().html(data);     
                $('#myModalLg').modal({backdrop: 'static'});
            }
        });
    };

    var buscarRegistro = function() {
        var filtro = document.getElementById("filtro");
        var registro = document.getElementById("buscarRegistro");
        if (registro.value == '') {
            listarRegistro();
        } else {
            $.ajax({
                type: "get",
                url: "/registro/buscar/" + registro.value +"/"+ filtro.value,
                success: function(data) {
                    $("#ListaRegistro").empty().html(data);
                }
            });
        }
    };

    var nuevoRegistro = function() {
        $.ajax({
            type: "get",
            url: "/registro/nuevo",
            success: function(data) {  
                $('#tituloModalLg').empty().html('<i class="fas fa-font"></i> Nuevo Registro');
                $('#contentModalLg').empty().html(data);       
                $('.actionBtn').addClass('grabarRegistro'); 
                $("#myModalLg").modal({backdrop: "static"});
            }
        });
    };

    var editarRegistro = function(registro_id) {
        $.ajax({
            type: 'get',
            url: '/registro/'+registro_id+'/editar',
            success: function(data) {  
                $('#tituloModalLg').empty().html("<i class='fa fa-rocket'></i> Editar Registro");
                $('#contentModalLg').empty().html(data);         
                $('.actionBtn').addClass('actualizarRegistro'); 
                $('#myModalLg').modal({backdrop: 'static'});
            }
        });
    };

    var eliminarRegistro = function(id) 
    {    
        if (confirm('Seguro de Eliminar este Registro?')) {
            $.ajax({
                url: '/registro/'+id+'/eliminar',
                type: "get",
                success: function (data) {
                    listarRegistro();
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                }
            });
        }
    };


    $(document).on("click", "#pg-registros .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaRegistro").empty().html(data);
            }
        });
    });

    $('.modal-body').on('click', '.grabarRegistro', function(event){
        $('.grabarRegistro').prop('disabled', false);
        event.preventDefault();
        var data = $( "#formNuevoRegistro" ).serialize();
        $.post( "/registro/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide');
                listarRegistro(); 
                $("#myModalLg").modal("hide");  
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.grabarRegistro').prop('disabled', false);
            }    
        });           
    });

    $('.modal-body').on('click', '.actualizarRegistro', function(event){
        $('.actualizarRegistro').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarRegistro" ).serialize();
        var id = $( "#registro_id" ).val();        
        $.post( "/registro/"+id+"/actualizar", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                listarRegistro();
                $("#myModalLg").modal("hide");                
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.actualizarRegistro').prop('disabled', false);
            }
        });     
    });

/*  Persona
*/
    var listarPersona = function() {
        $.ajax({
            type: "get",
            url: "/persona/listar",
            success: function(data) {            
                $("#ListaPersona").empty().html(data);            
            }
        });
    };  

    var infoPersona = function(id) {
        $.ajax({
            type: 'get',
            url: '/persona/'+id,
            success: function(data) {  
                $('#tituloModalMd').empty().html("<i class='fa fa-clock-o'></i> Persona");
                $('#contentModalMd').empty().html(data);     
                $('#myModalMd').modal({backdrop: 'static'});
            }
        });
    };

    var buscarPersona = function() {
        var x = document.getElementById("buscarPersona");
        x.value = x.value.toUpperCase();
        if (x.value == '') {
            listarPersona();
        } else {
            $.ajax({
                type: "get",
                url: "/persona/buscar/" + x.value,
                success: function(data) {
                    $("#ListaPersona").empty().html(data);
                }
            });
        }
    };  

    var nuevaPersona = function() {
        $.ajax({
            type: "get",
            url: "/persona/nuevo",
            success: function(data) {  
                $('#tituloModalMd').empty().html('<i class="fas fa-font"></i> Nueva persona');
                $('#contentModalMd').empty().html(data);       
                $('.actionBtn').addClass('grabarPersona'); 
                $("#myModalMd").modal({backdrop: "static"});
            }
        });
    };

    var editarPersona = function(persona_id) {
        $.ajax({
            type: 'get',
            url: '/persona/'+persona_id+'/editar',
            success: function(data) {  
                $('#tituloModalMd').empty().html("<i class='fa fa-rocket'></i> Editar persona");
                $('#contentModalMd').empty().html(data);         
                $('.actionBtn').addClass('actualizarPersona'); 
                $('#myModalMd').modal({backdrop: 'static'});
            }
        });
    };

    var eliminarPersona = function(id) 
    {    
        if (confirm('Seguro de Eliminar esta persona?')) {
            $.ajax({
                url: '/persona/'+id+'/eliminar',
                type: "get",
                success: function (data) {
                    listarPersona();
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                }
            });
        }
    };

    $(document).on("click", "#pg-personas .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaPersona").empty().html(data);
            }
        });
    });

    $('.modal-body').on('click', '.grabarPersona', function(event){
        $('.grabarPersona').prop('disabled', false);
        event.preventDefault();
        var data = $( "#formNuevaPersona" ).serialize();
        $.post( "/persona/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide');
                listarPersona(); 
                $("#myModalMd").modal("hide");  
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.grabarPersona').prop('disabled', false);
            }    
        });           
    });

    $('.modal-body').on('click', '.actualizarPersona', function(event){
        $('.actualizarPersona').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarPersona" ).serialize();
        var id = $( "#persona_id" ).val();        
        $.post( "/persona/"+id+"/actualizar", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                listarPersona();
                $("#myModalMd").modal("hide");                
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.actualizarPersona').prop('disabled', false);
            }
        });   
    });

/*  Sociolingistica
*/
    var listarSociolinguistica = function() {
        $.ajax({
            type: "get",
            url: "/sociolinguistica/listar",
            success: function(data) {            
                $("#ListaSociolinguistica").empty().html(data);            
            }
        });
    };  

    var buscarSociolinguistica = function() {
        var x = document.getElementById("buscarSociolinguistica");
        x.value = x.value.toUpperCase();
        if (x.value == '') {
            listarSociolinguistica();
        } else {
            $.ajax({
                type: "get",
                url: "/sociolinguistica/buscar/" + x.value,
                success: function(data) {
                    $("#ListaSociolinguistica").empty().html(data);
                }
            });
        }
    };  

    var nuevaSociolinguistica = function() {
        $.ajax({
            type: "get",
            url: "/sociolinguistica/nuevo",
            success: function(data) {  
                $('#tituloModalMd').empty().html('<i class="fas fa-font"></i> Nueva sociolinguistica');
                $('#contentModalMd').empty().html(data);       
                $('.actionBtn').addClass('grabarSociolinguistica'); 
                $("#myModalMd").modal({backdrop: "static"});
            }
        });
    };

    var editarSociolinguistica = function(sociolinguitica_id) {
        $.ajax({
            type: 'get',
            url: '/sociolinguistica/'+sociolinguitica_id+'/editar',
            success: function(data) {  
                $('#tituloModalMd').empty().html("<i class='fa fa-rocket'></i> Editar sociolinguistica");
                $('#contentModalMd').empty().html(data);         
                $('.actionBtn').addClass('actualizarSociolinguistica'); 
                $('#myModalMd').modal({backdrop: 'static'});
            }
        });
    };

    var eliminarSociolinguistica = function(id) 
    {    
        if (confirm('Seguro de Eliminar esta sociolinguistica?')) {
            $.ajax({
                url: '/sociolinguistica/'+id+'/eliminar',
                type: "get",
                success: function (data) {
                    listarSociolinguistica();
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                }
            });
        }
    };

    $(document).on("click", "#pg-sociolinguisticas .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaSociolinguistica").empty().html(data);
            }
        });
    });

    $('.modal-body').on('click', '.grabarSociolinguistica', function(event){
        $('.grabarSociolinguistica').prop('disabled', false);
        event.preventDefault();
        var data = $( "#formNuevaSociolinguistica" ).serialize();
        $.post( "/sociolinguistica/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide');
                listarSociolinguistica(); 
                $("#myModalMd").modal("hide");  
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.grabarSociolinguistica').prop('disabled', false);
            }
        });           
    });

    $('.modal-body').on('click', '.actualizarSociolinguistica', function(event){
        $('.actualizarSociolinguistica').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarSociolinguistica" ).serialize();
        var id = $( "#sociolinguistica_id" ).val();        
        $.post( "/sociolinguistica/"+id+"/actualizar", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                listarSociolinguistica();
                $("#myModalMd").modal("hide");                
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.actualizarSociolinguistica').prop('disabled', false);
            }
        });   
    });

/*  Pragmatica
*/
    var listarPragmatica = function() {
        $.ajax({
            type: "get",
            url: "/pragmatica/listar",
            success: function(data) {            
                $("#ListaPragmatica").empty().html(data);            
            }
        });
    };

    var buscarPragmatica = function() {
        var x = document.getElementById("buscarPragmatica");
        x.value = x.value.toUpperCase();
        if (x.value == '') {
            listarPragmatica();
        } else {
            $.ajax({
                type: "get",
                url: "/pragmatica/buscar/" + x.value,
                success: function(data) {
                    $("#ListaPragmatica").empty().html(data);
                }
            });
        }
    };    

    var nuevaPragmatica = function() {
        $.ajax({
            type: "get",
            url: "/pragmatica/nuevo",
            success: function(data) {  
                $('#tituloModalMd').empty().html('<i class="fas fa-font"></i> Nueva pragmática');
                $('#contentModalMd').empty().html(data);       
                $('.actionBtn').addClass('grabarPragmatica'); 
                $("#myModalMd").modal({backdrop: "static"});
            }
        });
    };

    var editarPragmatica = function(pragmatica_id) {
        $.ajax({
            type: 'get',
            url: '/pragmatica/'+pragmatica_id+'/editar',
            success: function(data) {  
                $('#tituloModalMd').empty().html("<i class='fa fa-rocket'></i> Editar pragmática");
                $('#contentModalMd').empty().html(data);         
                $('.actionBtn').addClass('actualizarPragmatica'); 
                $('#myModalMd').modal({backdrop: 'static'});
            }
        });
    };

    var eliminarPragmatica = function(id) 
    {    
        if (confirm('Seguro de Eliminar esta pragmatica?')) {
            $.ajax({
                url: '/pragmatica/'+id+'/eliminar',
                type: "get",
                success: function (data) {
                    listarPragmatica();
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                }
            });
        }
    };

    $(document).on("click", "#pg-pragmaticas .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaPragmatica").empty().html(data);
            }
        });
    });

    $('.modal-body').on('click', '.grabarPragmatica', function(event){
        $('.grabarPragmatica').prop('disabled', false);
        event.preventDefault();
        var data = $( "#formNuevaPragmatica" ).serialize();
        $.post( "/pragmatica/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide');
                listarPragmatica(); 
                $("#myModalMd").modal("hide");  
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.grabarPragmatica').prop('disabled', false);
            }    
        });           
    });

    $('.modal-body').on('click', '.actualizarPragmatica', function(event){
        $('.actualizarPragmatica').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarPragmatica" ).serialize();
        var id = $( "#pragmatica_id" ).val();        
        $.post( "/pragmatica/"+id+"/actualizar", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                $("#myModalMd").modal("hide");
                listarPragmatica();
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.actualizarPragmatica').prop('disabled', false);
            }
        });   
    });

/*  Diatopica
*/
    var listarDiatopica = function() {
        $.ajax({
            type: "get",
            url: "/diatopica/listar",
            success: function(data) {            
                $("#ListaDiatopica").empty().html(data);            
            }
        });
    };

    var buscarDiatopica = function() {
        var x = document.getElementById("buscarDiatopica");
        if (x.value == '') {
            listarDiatopica();
        } else {
            $.ajax({
                type: "get",
                url: "/diatopica/buscar/" + x.value,
                success: function(data) {
                    $("#ListaDiatopica").empty().html(data);
                }
            });
        }
    };    

    var nuevaDiatopica = function() {
        $.ajax({
            type: "get",
            url: "/diatopica/nuevo",
            success: function(data) {  
                $('#tituloModalMd').empty().html('<i class="fas fa-font"></i> Nueva diatópica');
                $('#contentModalMd').empty().html(data);       
                $('.actionBtn').addClass('grabarDiatopica'); 
                $("#myModalMd").modal({backdrop: "static"});
            }
        });
    };

    var editarDiatopica = function(diatopica_id) {
        $.ajax({
            type: 'get',
            url: '/diatopica/'+diatopica_id+'/editar',
            success: function(data) {  
                $('#tituloModalMd').empty().html("<i class='fa fa-rocket'></i> Editar diatópica");
                $('#contentModalMd').empty().html(data);         
                $('.actionBtn').addClass('actualizarDiatopica'); 
                $('#myModalMd').modal({backdrop: 'static'});
            }
        });
    };

    var eliminarDiatopica = function(id) 
    {    
        if (confirm('Seguro de Eliminar esta diatopica?')) {
            $.ajax({
                url: '/diatopica/'+id+'/eliminar',
                type: "get",
                success: function (data) {
                    listarDiatopica();
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                }
            });
        }
    };

    $(document).on("click", "#pg-diatopicas .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaDiatopica").empty().html(data);
            }
        });
    });

    $('.modal-body').on('click', '.grabarDiatopica', function(event){
        $('.grabarDiatopica').prop('disabled', false);
        event.preventDefault();
        var data = $( "#formNuevaDiatopica" ).serialize();
        $.post( "/diatopica/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide');
                listarDiatopica(); 
                $("#myModalMd").modal("hide");  
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.grabarDiatopica').prop('disabled', false);
            }    
        });           
    });

    $('.modal-body').on('click', '.actualizarDiatopica', function(event){
        $('.actualizarDiatopica').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarDiatopica" ).serialize();
        var id = $( "#diatopica_id" ).val();        
        $.post( "/diatopica/"+id+"/actualizar", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                $("#myModalMd").modal("hide");
                listarDiatopica();
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.actualizarDiatopica').prop('disabled', false);
            }
        });   
    });

/*  Diatecnica
*/
    var listarDiatecnica = function() {
        $.ajax({
            type: "get",
            url: "/diatecnica/listar",
            success: function(data) {            
                $("#ListaDiatecnica").empty().html(data);            
            }
        });
    };  

    var buscarDiatecnica = function() {
        var x = document.getElementById("buscarDiatecnica");
        x.value = x.value.toUpperCase();
        if (x.value == '') {
            listarDiatecnica();
        } else {
            $.ajax({
                type: "get",
                url: "/diatecnica/buscar/" + x.value,
                success: function(data) {
                    $("#ListaDiatecnica").empty().html(data);
                }
            });
        }
    };  

    var nuevaDiatecnica = function() {
        $.ajax({
            type: "get",
            url: "/diatecnica/nuevo",
            success: function(data) {  
                $('#tituloModalMd').empty().html('<i class="fas fa-font"></i> Nueva diatécnica');
                $('#contentModalMd').empty().html(data);       
                $('.actionBtn').addClass('grabarDiatecnica'); 
                $("#myModalMd").modal({backdrop: "static"});
            }
        });
    };

    var editarDiatecnica = function(diatecnica_id) {
        $.ajax({
            type: 'get',
            url: '/diatecnica/'+diatecnica_id+'/editar',
            success: function(data) {  
                $('#tituloModalMd').empty().html("<i class='fa fa-rocket'></i> Editar diatécnica");
                $('#contentModalMd').empty().html(data);         
                $('.actionBtn').addClass('actualizarDiatecnica'); 
                $('#myModalMd').modal({backdrop: 'static'});
            }
        });
    };

    var eliminarDiatecnica = function(id) 
    {    
        if (confirm('Seguro de Eliminar esta diatecnica?')) {
            $.ajax({
                url: '/diatecnica/'+id+'/eliminar',
                type: "get",
                success: function (data) {
                    listarDiatecnica();
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                }
            });
        }
    };

    $(document).on("click", "#pg-diatecnicas .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaDiatecnica").empty().html(data);
            }
        });
    });

    $('.modal-body').on('click', '.grabarDiatecnica', function(event){
        $('.grabarDiatecnica').prop('disabled', false);
        event.preventDefault();
        var data = $( "#formNuevaDiatecnica" ).serialize();
        $.post( "/diatecnica/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide');
                listarDiatecnica(); 
                $("#myModalMd").modal("hide");  
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.grabarDiatecnica').prop('disabled', false);
            }    
        });           
    });

    $('.modal-body').on('click', '.actualizarDiatecnica', function(event){
        $('.actualizarDiatecnica').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarDiatecnica" ).serialize();
        var id = $( "#diatecnica_id" ).val();        
        $.post( "/diatecnica/"+id+"/actualizar", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                $("#myModalMd").modal("hide");
                listarDiatecnica();
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                $('.actualizarDiatecnica').prop('disabled', false);
            }
        });   
    });


/*  Logs
*/
    var listarLog = function() {
        $.ajax({
            type: "get",
            url: "/log/listar",
            success: function(data) {            
                $("#ListaLog").empty().html(data);            
            }
        });
    };

    var buscarLog = function() {
        var x = document.getElementById("buscarLog");
        x.value = x.value.toUpperCase();
        if (x.value == '') {
            listarLog();
        } else {
            $.ajax({
                type: "get",
                url: "/log/buscar/" + x.value,
                success: function(data) {
                    $("#ListaLog").empty().html(data);
                }
            });
        }
    };

    $(document).on("click", "#pg-logs .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaLog").empty().html(data);
            }
        });
    });

    var infoLog = function(log_id) {
        $.ajax({
            type: 'get',
            url: '/log/'+log_id,
            success: function(data) { 
                $('#tituloModalLg').empty().html("<i class='fa fa-clock-o'></i> Log");
                    $('#contentModalLg').empty().html(data);     
                    $('#myModalLg').modal({backdrop: 'static'});
                }
        });
    };

/*  Mensajes
*/
    var listarMensaje = function() {
        $.ajax({
            type: "get",
            url: "/mensaje/listar",
            success: function(data) {            
                $("#ListaMensaje").empty().html(data);            
            }
        });
    };

    var buscarMensaje = function() {
        var x = document.getElementById("buscarMensaje");
        if (x.value == '') {
            listarMensaje();
        } else {
            $.ajax({
                type: "get",
                url: "/mensaje/buscar/" + x.value,
                success: function(data) {
                    $("#ListaMensaje").empty().html(data);
                }
            });
        }
    };  

    var infoMensaje = function(id) {
        $.ajax({
            type: 'get',
            url: '/mensaje/'+id,
            success: function(data) { 
                $('#tituloModalLg').empty().html("<i class='far fa-envelope'></i> Mensaje");
                    $('#contentModalLg').empty().html(data);     
                    $('#myModalLg').modal({backdrop: 'static'});
                }
        });
    };


    
    var listarPagina = function() {
        $.ajax({
            type: "get",
            url: "/sitio-web/pagina/listar",
            success: function(data) {            
                $("#ListaPagina").empty().html(data);            
            }
        });
    };

    $(document).on("click", "#pg-mensajes .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaMensaje").empty().html(data);
            }
        });
    });

    var nuevaPagina = function() {
        $.ajax({
            type: "get",
            url: "/sitio-web/pagina/nuevo",
            success: function(data) {  
                $('#tituloModalXl').empty().html('<i class="fas fa-font"></i> Nueva página');
                $('#contentModalXl').empty().html(data); 
                $('textarea').summernote({
                    lang: 'es-ES',
                    dialogsInBody: true
                });      
                $('.actionBtn').addClass('grabarPagina'); 
                $("#myModalXl").modal({backdrop: "static"});
            }
        });
    };

    var editarPagina = function(pagina_id) {
        $.ajax({
            type: 'get',
            url: '/sitio-web/pagina/'+pagina_id+'/editar',
            success: function(data) {  
                $('#tituloModalXl').empty().html("<i class='fa fa-rocket'></i> Editar Página");
                $('#contentModalXl').empty().html(data);  
                $('textarea').summernote({
                    lang: 'es-ES',
                    dialogsInBody: true
                });        
                $('.actionBtn').addClass('actualizarPagina'); 
                $('#myModalXl').modal({backdrop: 'static'});
            }
        });
    };

    var eliminarPagina = function(id) 
    {    
        if (confirm('Seguro de Eliminar esta página?')) {
            $.ajax({
                url: '/sitio-web/pagina/'+id+'/eliminar',
                type: "get",
                success: function (data) {
                    listarPagina();
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                }
            });
        }
    };

    $('.modal-body').on('click', '.grabarPagina', function(event){
        event.preventDefault();
        var data = $( "#formNuevaPagina" ).serialize();
        $.post( "/sitio-web/pagina/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide');   
                listarPagina();
                $("#myModalXl").modal("hide");
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
            }    
        });           
    });

    $('.modal-body').on('click', '.actualizarPagina', function(event){
        event.preventDefault();
        var data = $( "#formActualizarPagina" ).serialize();
        var id = $( "#pagina_id" ).val();        
        $.post( "/sitio-web/pagina/"+id+"/actualizar", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                $("#myModalXl").modal("hide");
                listarPagina();
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
            }
        });   
    });