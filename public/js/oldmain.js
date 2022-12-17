
            var csrfToken = $('[name="csrf_token"]').attr('content');

           //  setInterval(refreshToken, 5000); 1 hour 3600000

            function refreshToken(){
                $.get('refresh-csrf').done(function(data){
                    csrfToken = data; // the new token
                });
            }

            setInterval(refreshToken, 3600000); // 1 hour 3600000


$( ".datepicker" ).datepicker({
   format: "dd-mm-yyyy",
  todayBtn: "linked",
  language: "es",
  orientation: "auto right",
  weekStart: 1,
  daysOfWeekDisabled: "0",
  daysOfWeekHighlighted: "0",
  todayHighlight: true,
  autoclose: true    
}).datepicker("setDate", "0");

var timer = null;

$('#buscarUsuario').keydown(function(){
    clearTimeout(timer);
    timer = setTimeout(buscarUsuario, 1000)
});

/*	Marcacion
*/
        var  indexAsistencia= function() {              
            $.getJSON('/empleado/json',function(data){   
                $.each(data, function(key,value){
                    $(".empleados select").append('<option value="'+value['id']+'">'+value['apellidos']+', '+value['nombres']+'</option>');
                });
            });       
        };

        var  selectProyectos= function() {
            $(".proyectos select").empty(); 
            $.getJSON('/asistencia/marcacion/proyectos',function(data){ 
                $(".proyectos select").append('<option selected="true" disabled="disabled">Elegir Proyecto</option>');         
                $.each(data, function(key,value){
                    $(".proyectos select").append('<option value="'+value['id']+'">'+value['nombre']+'</option>');  
                });
            });            
        };

        var  getHostname = function() {
            $.getJSON('/asistencia/marcacion/hostname',function(data){ 
                console.log(data);  
            });            
        };

        var  selectEmpleados= function() {
            $(".empleados select").empty();                  
            $.getJSON('asistencia/marcacion/proyecto/'+$(".proyectos select").val()+'/empleados',function(data){   
                $(".empleados select").append('<option selected="true" disabled="disabled">Elegir Empleado</option>');             
                $.each(data, function(key,value){
                    $(".empleados select").append('<option value="'+value['idEmpleado']+'">'+value['apellidos']+', '+value['nombres']+'</option>');
                });
            });       
        };

        var  selectTurnos= function() {            
            $(".turnos select").empty();
            $.getJSON('asistencia/marcacion/proyecto/'+$(".proyectos select").val()+'/turnos',function(data){
                $(".turnos select").append('<option selected="true" disabled="disabled">Elegir Turno</option>');
                $.each(data, function(key,value){
                    $(".turnos select").append('<option value="'+value['id']+'">'+value['codigo']+'</option>');
                });
            });      
        };

    $('.box-body').on('click', '.rptRangoAsistencia', function(event){
        $('.rptRangoAsistencia').prop('disabled', true);
        event.preventDefault();
        var data = $( "#formRptRangoAsistencia" ).serialize();
        $.post( "/asistencia/reporte/rango", data, function(data){
            
                $("#asistencias").empty().html(data);    
                $('.rptRangoAsistencia').prop('disabled', false);
            
        });           
    });

	$('.box-body').on('click', '.exportRptRangoAsistencia', function(event){
        $('.exportRptRangoAsistencia').prop('disabled', true);
        event.preventDefault();
        var data = $( "#formRptRangoAsistencia" ).serialize();
        $.post( "/asistencia/reporte/exportrango", data, function(data){           
            
        });           
    });

    var rptRangoAsistencia = function() {
        var data = $( "#formRptRangoAsistencia" ).serialize();
        $.post( "/asistencia/reporte/rango", data, function(data){            
            $("#asistencias").empty().html(data);    
        }); 
    };

    var rptRangoTardanzaAsistencia = function() {
        var data = $( "#formRptRangoAsistencia" ).serialize();
        $.post( "/asistencia/reporte/RangoTardanza", data, function(data){            
            $("#asistencias").empty().html(data);    
        }); 
    };

    var infoMarcacion = function(id) {
        $.ajax({
            type: 'get',
            url: '/asistencia/marcacion/'+id+'/info',
            success: function(data) {  
                $('#tituloModalMd').empty().html("<i class='fa fa-rocket'></i> Marcación");
                $('#contentModalMd').empty().html(data);     
                $('#myModalMd').modal({backdrop: 'static'});
            }
        });
    };

    var editarMarcacion = function(id) {
	    $.ajax({
	        type: 'get',
	        url: '/asistencia/marcacion/'+id+'/editar',
	        success: function(data) {  
	            $('#tituloModalMd').empty().html("<i class='fa fa-rocket'></i> Editar Marcacion");
        		$('#contentModalMd').empty().html(data);  
					$('.dtp').datetimepicker({
        				format: 'HH:mm:ss',
					    minDate: moment('00:00:00', 'HH:mm:ss'),
					    maxDate: moment('23:59:59', 'HH:mm:ss'),
        			});
       			$('.actionBtn').addClass('actualizarMarcacion'); 
       			$('#myModalMd').modal({backdrop: 'static'});
	        }
	    });
	};


    $('.modal-body').on('click', '.actualizarMarcacion', function(event){
        $('.actualizarMarcacion').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarMarcacion" ).serialize();
        var id = $( "#idMarcacion" ).val();        
        $.post( "/asistencia/marcacion/"+id+"/actualizar", data, function(data){            
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide'); 
                $("#myModalMd").modal("hide");  
                //listarProyecto();
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
                //$('.grabarProyecto').prop('disabled', false);
            } 
        });   
    });

	
	var eliminarMarcacion = function(id) 
	{    
	    if (confirm('Seguro de Eliminar esta marcación?')) {
	        $.ajax({
	            url: '/asistencia/marcacion/'+id+'/eliminar',
	            type: "get",
	            success: function () {
	                
	            }
	        });
	    }
	};
	


    var listarPalabra = function() {
        $.ajax({
            type: "get",
            url: "/palabra/listar",
            success: function(data) {            
                $("#ListaPalabra").empty().html(data);            
            }
        });
    };

    $(document).on("click", "#pg-palabras .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaPalabra").empty().html(data);
            }
        });
    });


	
/*	Proyecto
*/
	var listarProyecto = function() {
	    $.ajax({
	        type: "get",
	        url: "/proyecto/listar",
	        success: function(data) {            
	            $("#ListaProyecto").empty().html(data);            
	        }
	    });
	};

	$(document).on("click", "#pg-proyectos .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaProyecto").empty().html(data);
            }
        });
    });

	var infoProyecto = function(id) {
	    $.ajax({
	        type: 'get',
	        url: '/proyecto/'+id,
	        success: function(data) {  
	            $('#tituloModalLg').empty().html("<i class='fa fa-rocket'></i> Proyecto");
        		$('#contentModalLg').empty().html(data);     
       			$('#myModalLg').modal({backdrop: 'static'});
	        }
	    });
	};
	
	var nuevoProyecto = function() {
	    $.ajax({
	        type: "get",
	        url: "/proyecto/nuevo",
	        success: function(data) {  
	            $('#tituloModalMd').empty().html('<i class="fa fa-rocket"></i> Nuevo Proyecto');
        		$('#contentModalMd').empty().html(data);
                $('.dtp-inicio').datetimepicker({
                    format: 'DD-MM-YYYY'
                }); 
        		$('.dtp-fin').datetimepicker({
                    format: 'DD-MM-YYYY'
                }); 

       			$('.actionBtn').addClass('grabarProyecto'); 
       			$("#myModalMd").modal({backdrop: "static"});
	        }
	    });
	};
	
	var editarProyecto = function(id) {
	    $.ajax({
	        type: "get",
	        url: "/proyecto/"+id+"/editar",
	        success: function(data) {  
	            $('#tituloModalMd').empty().html('<i class="fa fa-rocket"></i> Editar Proyecto');
        		$('#contentModalMd').empty().html(data);
					$( ".datepicker" ).datepicker({
					  format: "dd-mm-yyyy",
					  todayBtn: "linked",
					  language: "es",
					  orientation: "auto right",
					  weekStart: 1,
					  daysOfWeekDisabled: "0",
					  daysOfWeekHighlighted: "0",
					  todayHighlight: true,
					  autoclose: true    
					});
       			$('.actionBtn').addClass('actualizarProyecto'); 
       			$("#myModalMd").modal({backdrop: "static"});
	        }
	    });
	};

	var eliminarProyecto = function(id) 
	{    
	    if (confirm('Seguro de Eliminar este proyecto?')) {
	        $.ajax({
	            url: '/proyecto/'+id+'/eliminar',
	            type: "get",
	            success: function () {
	                listarProyecto();
	            }
	        });
	    }
	};
	    
	var buscarProyecto = function() {
	    var x = document.getElementById("buscarProyecto");
		x.value = x.value.toUpperCase();
	    if (x.value == '') {
	        listarProyecto();
	    } else {
	        $.ajax({
	            type: "get",
	            url: "/proyecto/buscar/" + x.value,
	            success: function(data) {
	                $("#ListaProyecto").empty().html(data);
	            }
	        });
	    }
	};

	$('.modal-body').on('click', '.grabarProyecto', function(event){
        $('.grabarProyecto').prop('disabled', true);
        event.preventDefault();
        var data = $( "#formNuevoProyecto" ).serialize();
        $.post( "/proyecto/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide'); 
                $("#myModalMd").modal("hide");  
                listarProyecto();
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
                //$('.grabarProyecto').prop('disabled', false);
            }    
        });           
    });

    $('.modal-body').on('click', '.actualizarProyecto', function(event){
        $('.actualizarProyecto').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarProyecto" ).serialize();
        var id = $( "#idProyecto" ).val();        
        $.post( "/proyecto/"+id+"/actualizar", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                listarProyecto();
                $("#myModalMd").modal("hide");
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
                $('.actualizarProyecto').prop('disabled', false);
            }
        });   
    });



/*	Empleado
*/
	var listarEmpleado = function() {
	    $.ajax({
	        type: "get",
	        url: "/empleado/listar",
	        success: function(data) {            
	            $("#ListaEmpleado").empty().html(data);            
	        }
	    });
	};

	$(document).on("click", "#pg-empleados .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaEmpleado").empty().html(data);
            }
        });
    });

	var infoEmpleado = function(id) {
	   	$.ajax({
            type: 'get',
            url: '/empleado/'+id,
            success: function(data) {  
                $('#tituloModalMd').empty().html("<i class='fa fa-clock-o'></i> Empleado");
                $('#contentModalMd').empty().html(data);     
                $('#myModalMd').modal({backdrop: 'static'});
            }
        });
	};
	
	var nuevoEmpleado = function() {
	    $.ajax({
	        type: "get",
	        url: "/empleado/nuevo",
	        success: function(data) {  
	            $('#tituloModalMd').empty().html('<i class="fa fa-rocket"></i> Nuevo Empleado');
        		$('#contentModalMd').empty().html(data);
                $('.datepicker').datepicker({
                    format: "dd-mm-yyyy",
                    startDate: "01-01-1990"
                });  
        		selectProyectos();      
       			$('.actionBtn').addClass('grabarEmpleado'); 
       			$("#myModalMd").modal({backdrop: "static"});
	        }
	    });
	};
	
	var editarEmpleado = function(id) {
	    $.ajax({
	        type: 'get',
	        url: '/empleado/'+id+'/editar',
	        success: function(data) {  
	            $('#tituloModalMd').empty().html("<i class='fa fa-rocket'></i> Editar Empleado");
        		$('#contentModalMd').empty().html(data);         
                $( ".datepicker" ).datepicker({
                    format: "dd-mm-yyyy",
                    language: "es",
                    orientation: "auto right",
                    weekStart: 1,
                    daysOfWeekHighlighted: "0",
                    todayHighlight: true,
                    autoclose: true    
                });
       			$('.actionBtn').addClass('actualizarEmpleado'); 
       			$('#myModalMd').modal({backdrop: 'static'});
	        }
	    });
	};

	var eliminarEmpleado = function(id) 
	{    
	    if (confirm('Seguro de Eliminar este empleado?')) {
	        $.ajax({
	            url: '/empleado/'+id+'/eliminar',
	            type: "get",
	            success: function () {
	                listarEmpleado();
	            }
	        });
	    }
	};

    var eliminarJugador = function(id) 
    {    
        if (confirm('Seguro de Eliminar este jugador?')) {
            $.ajax({
                url: '/jugador/'+id+'/eliminar',
                type: "get",
                success: function () {
                    listarJugador();
                }
            });
        }
    };

    var eliminarEquipo = function(id) 
    {    
        if (confirm('Seguro de Eliminar este Equipo?')) {
            $.ajax({
                url: '/equipo/'+id+'/eliminar',
                type: "get",
                success: function () {
                    listarEquipo();
                }
            });
        }
    };
	    
	var buscarEmpleado = function() {
	    var x = document.getElementById("buscarEmpleado");
	    x.value = x.value.toUpperCase();
	    if (x.value == '') {
	        listarEmpleado();
	    } else {
	        $.ajax({
	            type: "get",
	            url: "/empleado/buscar/" + x.value,
	            success: function(data) {
	                $("#ListaEmpleado").empty().html(data);
	            }
	        });
	    }
	};

	$('.modal-body').on('click', '.grabarEmpleado', function(event){
        $('.grabarEmpleado').prop('disabled', true);
        event.preventDefault();
        var data = $( "#formNuevoEmpleado" ).serialize();
        $.post( "/empleado/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide'); 
                $("#myModalMd").modal("hide");  
                listarEmpleado();

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
                $('.grabarEmpleado').prop('disabled', false);
            }    
        });           
    });

    $('.modal-body').on('click', '.actualizarEmpleado', function(event){
        $('.actualizarEmpleado').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarEmpleado" ).serialize();
        var id = $( "#idEmpleado" ).val();        
        $.post( "/empleado/"+id+"/actualizar", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                listarEmpleado();
                $("#myModalMd").modal("hide");
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
                $('.actualizarEmpleado').prop('disabled', false);
            }
        });   
    });


/*	Turno
*/
	var listarTurno = function() {
	    $.ajax({
	        type: "get",
	        url: "/turno/listar",
	        success: function(data) {            
	            $("#ListaTurno").empty().html(data);            
	        }
	    });
	};

	$(document).on("click", "#pg-turnos .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaTurno").empty().html(data);
            }
        });
    });

	var infoTurno = function(id) {
	   	$.ajax({
	        type: 'get',
	        url: '/turno/'+id,
	        success: function(data) {  
	            $('#tituloModalMd').empty().html("<i class='fa fa-clock-o'></i> Turno");
        		$('#contentModalMd').empty().html(data);     
       			$('#myModalMd').modal({backdrop: 'static'});
	        }
	    });
	};
	
	var nuevoTurno = function() {
	    $.ajax({
	        type: "get",
	        url: "/turno/nuevo",
	        success: function(data) {  
	            $('#tituloModalMd').empty().html('<i class="fa fa-rocket"></i> Nuevo Turno');
        		$('#contentModalMd').empty().html(data);     
        			$('.dtp-entrada').datetimepicker({
        				format: 'HH:mm:ss',
					    defaultDate: moment('11:12:02', 'HH:mm:ss'),
					    minDate: moment('00:00:00', 'HH:mm:ss'),
					    maxDate: moment('23:59:59', 'HH:mm:ss'),
        			}).show();   
        			$('.dtp-salida').datetimepicker({
        				format: 'HH:mm:ss',
					    minDate: moment('00:00:00', 'HH:mm:ss'),
					    maxDate: moment('23:59:59', 'HH:mm:ss'),
        			});    
       			$('.actionBtn').addClass('grabarTurno'); 
       			$("#myModalMd").modal({backdrop: "static"});
	        }
	    });
	};

	var editarTurno = function(id) {
	    $.ajax({
	        type: 'get',
	        url: '/turno/'+id+'/editar',
	        success: function(data) {  
	            $('#tituloModalMd').empty().html("<i class='fa fa-rocket'></i> Editar Turno");
        		$('#contentModalMd').empty().html(data);  
        			$('.dtp-entrada').datetimepicker({
        				format: 'HH:mm:ss',
					    defaultDate: moment('11:12:02', 'HH:mm:ss'),
					    minDate: moment('00:00:00', 'HH:mm:ss'),
					    maxDate: moment('23:59:59', 'HH:mm:ss'),
        			}).show();   
        			$('.dtp-salida').datetimepicker({
        				format: 'HH:mm:ss',
					    minDate: moment('00:00:00', 'HH:mm:ss'),
					    maxDate: moment('23:59:59', 'HH:mm:ss'),
        			});       
       			$('.actionBtn').addClass('actualizarTurno'); 
       			$('#myModalMd').modal({backdrop: 'static'});
	        }
	    });
	};

	var eliminarTurno = function(id) 
	{    
	    if (confirm('Seguro de Eliminar este turno?')) {
	        $.ajax({
	            url: '/turno/'+id+'/eliminar',
	            type: "get",
	            success: function () {
	                listarTurno();
	            }
	        });
	    }
	};
	    
	var buscarTurno = function() {
	    var x = document.getElementById("buscarTurno");
	    x.value = x.value.toUpperCase();
	    if (x.value == '') {
	        listarTurno();
	    } else {
	        $.ajax({
	            type: "get",
	            url: "/turno/buscar/" + x.value,
	            success: function(data) {
	                $("#ListaTurno").empty().html(data);
	            }
	        });
	    }
	};

	$('.modal-body').on('click', '.grabarTurno', function(event){
        $('.grabarTurno').prop('disabled', true);
        event.preventDefault();
        var data = $( "#formNuevoTurno" ).serialize();
        $.post( "/turno/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide'); 
                $("#myModalMd").modal("hide");  
                listarTurno();

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
                $('.grabarTurno').prop('disabled', false);
            }    
        });           
    });

    $('.modal-body').on('click', '.actualizarTurno', function(event){
        $('.actualizarTurno').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarTurno" ).serialize();
        var id = $( "#idTurno" ).val();        
        $.post( "/turno/"+id+"/actualizar", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                listarTurno();
                $("#myModalMd").modal("hide");
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
                $('.actualizarTurno').prop('disabled', false);
            }
        });   
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
    var listarTorneo = function() {
        $.ajax({
            type: "get",
            url: "/torneo/listar",
            success: function(data) {            
                $("#ListaTorneo").empty().html(data);            
            }
        });
    };
    var listarJugador = function() {
        $.ajax({
            type: "get",
            url: "/jugador/listar",
            success: function(data) {            
                $("#ListaJugador").empty().html(data);            
            }
        });
    };
    var listarEquipoJugadores = function(equipoID) {
        $.ajax({
            type: "get",
            url: "/equipo/"+equipoID+"/jugadores",
            success: function(data) {            
                $("#ListaEquipoJugadores").empty().html(data);            
            }
        });
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

    var nuevoJugador = function() {
        $.ajax({
            type: "get",
            url: "/jugador/nuevo",
            success: function(data) {  
                $('#tituloModalMd').empty().html('<i class="fa fa-rocket"></i> Nuevo Jugador');
                $('#contentModalMd').empty().html(data);       
                $('.validarBtn').addClass('validarActivitionID'); 
                $('.actionBtn').addClass('grabarJugador'); 
                $("#myModalMd").modal({backdrop: "static"});
            }
        });
    };
  
    var editarUsuario = function(id) {
        $.ajax({
            type: 'get',
            url: '/usuario/'+id+'/editar',
            success: function(data) {  
                $('#tituloModalMd').empty().html("<i class='fa fa-rocket'></i> Editar Usuario");
                $('#contentModalMd').empty().html(data);         
                $('.actionBtn').addClass('actualizarUsuario'); 
                $('#myModalMd').modal({backdrop: 'static'});
            }
        });
    };
  
    var editarJugador = function(id) {
        $.ajax({
            type: 'get',
            url: '/jugador/'+id+'/editar',
            success: function(data) {  
                $('#tituloModalMd').empty().html("<i class='fa fa-rocket'></i> Editar Jugador");
                $('#contentModalMd').empty().html(data);         
                $('.actionBtn').addClass('actualizarJugador'); 
                $('#myModalMd').modal({backdrop: 'static'});
            }
        });
    };
  
    var cambiarContrasenia = function(id) {
        $.ajax({
            type: 'get',
            url: '/usuario/'+id+'/cambiarContrasenia',
            success: function(data) {  
                $('#tituloModalSm').empty().html("<i class='fas fa-key'></i> Cambiar Contraseña");
                $('#contentModalSm').empty().html(data);         
                $('.actionBtn').addClass('actualizarContrasenia'); 
                $('#myModalSm').modal({backdrop: 'static'});
            }
        });
    };
 /* 
    var eliminarEmpleado = function(id) 
    {    
        if (confirm('Seguro de Eliminar este empleado?')) {
            $.ajax({
                url: '/empleado/'+id+'/eliminar',
                type: "get",
                success: function () {
                    listarEmpleado();
                }
            });
        }
    };
*/        
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

    $('.modal-body').on('click', '.grabarUsuario', function(event){
        $('.grabarUsuario').prop('disabled', true);
        event.preventDefault();
        var data = $( "#formNuevoUsuario" ).serialize();
        $.post( "/usuario/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide'); 
                $("#myModalMd").modal("hide");  
                listarUsuario();

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

    $('.modal-body').on('click', '.grabarJugador', function(event){
        $('.grabarJugador').prop('disabled', true);
        event.preventDefault();
        var data = $( "#formNuevoJugador" ).serialize();
        $.post( "/jugador/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide'); 
                $("#myModalMd").modal("hide");  
                listarJugador();

            } else {                
                $('.grabarJugador').prop('disabled', false);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');    
                var errors = data.error;                
                if (errors.length == 1) {
                    $(".print-error-msg").find("ul").append('<li>'+data.error+'</li>')
                } else  {
                    $.each( data.error, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
                }
                
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
                listarUsuario();
                $("#myModalMd").modal("hide");
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

    $('.modal-body').on('click', '.validarActivitionID', function(event){
        $('.validarActivitionID').prop('disabled', true); 
        event.preventDefault();  
        var activisionID = $( "#activisionID" ).val();  
        if( activisionID.length == 0){
            var activisionID = "vacio";
        }
        var data = $( "#formNuevoJugador" ).serialize(); 
        var id = activisionID.replace("#", "%23");     
        $.post( "/CallofDuty/"+id+"/preview", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                $('#previewPlayer').empty().html(data); 
                $('.validarActivitionID').prop('disabled', false);
            } else {
                $('.validarActivitionID').prop('disabled', false);
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $(".print-error-msg").find("ul").append('<li>'+data.error+'</li>');               
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
                
            }
        });   
    });

    $('.modal-body').on('click', '.actualizarContrasenia', function(event){
        $('.actualizarUsuario').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarContrasenia" ).serialize();
        var id = $( "#idUsuario" ).val();        
        $.post( "/usuario/"+id+"/actualizarContrasenia", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                listarUsuario();
                $("#myModalMd").modal("hide");
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




/*  Equipos
*/
    var listarEquipo = function() {
        $.ajax({
            type: "get",
            url: "/equipo/listar",
            success: function(data) {            
                $("#ListaEquipo").empty().html(data);            
            }
        });
    };

    $(document).on("click", "#pg-equipos .pagination li a", function(e) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                $("#ListaEquipo").empty().html(data);
            }
        });
    });

    var infoEquipo = function(id) {
        $.ajax({
            type: 'get',
            url: '/equipo/'+id,
            success: function(data) {  
                $('#tituloModalMd').empty().html("<i class='fas fa-users'></i> Equipo");
                $('#contentModalMd').empty().html(data);   
                listarEquipoJugadores(id);  
                $('#myModalMd').modal({backdrop: 'static'});
            }
        });
    };
    
    var nuevoEquipo = function() {
        $.ajax({
            type: "get",
            url: "/equipo/nuevo",
            success: function(data) {  
                $('#tituloModalMd').empty().html('<i class="fa fa-rocket"></i> Nuevo Equipo');
                $('#contentModalMd').empty().html(data);  
                $('.actionBtn').addClass('grabarEquipo'); 
                $("#myModalMd").modal({backdrop: "static"});
            }
        });
    };
  
    var editarEquipo = function(id) {
        $.ajax({
            type: 'get',
            url: '/equipo/'+id+'/editar',
            success: function(data) {  
                $('#tituloModalMd').empty().html("<i class='fa fa-rocket'></i> Editar Equipo");
                $('#contentModalMd').empty().html(data);         
                $('.actionBtn').addClass('actualizarEquipo'); 
                $('#myModalMd').modal({backdrop: 'static'});
            }
        });
    };
 /* 
    var eliminarEmpleado = function(id) 
    {    
        if (confirm('Seguro de Eliminar este empleado?')) {
            $.ajax({
                url: '/empleado/'+id+'/eliminar',
                type: "get",
                success: function () {
                    listarEmpleado();
                }
            });
        }
    };
*/        
    var buscarEquipo = function() {
        var x = document.getElementById("buscarEquipo");
        x.value = x.value.toUpperCase();
        if (x.value == '') {
            listarEquipo();
        } else {
            $.ajax({
                type: "get",
                url: "/equipo/buscar/" + x.value,
                success: function(data) {
                    $("#ListaEquipo").empty().html(data);
                }
            });
        }
    };



    $('.modal-body').on('click', '.grabarEquipo', function(event){
        $('.grabarEquipo').prop('disabled', true);
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/equipo/grabar',
            data: new FormData($("#formNuevoEquipo")[0]),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,            
            success: function() {                
            },
            error: function(respuesta) {
                $(".panel-collapse").collapse('hide'); 
                $("#myModalMd").modal("hide");  
                listarEquipo();
            }    
        });
        
    });


/*
    $('.modal-body').on('click', '.grabarEquipo', function(event){
        $('.grabarEquipo').prop('disabled', true);
        event.preventDefault();
        var data = $( "#formNuevoEquipo" ).serialize();
        $.post( "/equipo/grabar", data, function(data){
            if ($.isEmptyObject(data.error)) {  
                $(".panel-collapse").collapse('hide'); 
                $("#myModalMd").modal("hide");  
                listarEquipo();

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
                $('.grabarEquipo').prop('disabled', false);
            }    
        });           
    });
*/
    $('.modal-body').on('click', '.actualizarEquipo', function(event){
        $('.actualizarEquipo').prop('disabled', true); 
        event.preventDefault();
        var data = $( "#formActualizarEquipo" ).serialize();
        var id = $( "#idEquipo" ).val();        
        $.post( "/equipo/"+id+"/actualizar", data, function(data){            
            if ($.isEmptyObject(data.error)) {
                listarEquipo();
                $("#myModalMd").modal("hide");
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
                $('.actualizarEquipo').prop('disabled', false);
            }
        });   
    });
