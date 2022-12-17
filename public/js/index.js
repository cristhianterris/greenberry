var csrfToken = $('[name="csrf_token"]').attr('content');
//  setInterval(refreshToken, 5000); 1 hour 3600000
function refreshToken(){
    $.get('refresh-csrf').done(function(data){
        csrfToken = data; // the new token
    });
}
setInterval(refreshToken, 3600000); // 1 hour 3600000








function autocomplete(inp) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/      
        var busquedaJson = function(palabra) {  
          $.getJSON("/busquedaJson/"+palabra,function(data){
                $.each(data, function(key,value){                
                  /*check if the item starts with the same letters as the text field value:*/
                  if (value['entrada'].substr(0, palabra.length).toUpperCase() == palabra.toUpperCase())  {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + value['entrada'].substr(0, palabra.length) + "</strong>";
                    b.innerHTML += value['entrada'].substr(palabra.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + value['entrada'] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                  }
                });    
          });
        };
        busquedaJson(val);
    });

    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          /*If the arrow DOWN key is pressed,
          increase the currentFocus variable:*/
          currentFocus++;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 38) { //up
          /*If the arrow UP key is pressed,
          decrease the currentFocus variable:*/
          currentFocus--;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 13) {
          /*If the ENTER key is pressed, prevent the form from being submitted,*/
          e.preventDefault();
              var y = document.getElementById("buscarEntrada");
              $.ajax({
                  type: "get",
                  url: "/busqueda/"+y.value,
                  success: function(data) {
                      $("#ListaEntradaIndex").empty().html(data);
                  }
              });
          if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
          }
        }
    });

    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }

    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }

    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("buscarEntrada"));

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
    //var id = $('#entrada_id').val();
    $.ajax({
        type: 'get',
        url: '/info/'+id,
        success: function(data) { 
        $("#ListaEntradaIndex").empty().html(data);
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

var palabraRecomendada = function() {
    $.ajax({
        type: 'get',
        url: '/palabraRecomendada',
        success: function(data) {                 
            $('#PalabraRecomendada').empty().html(data); 
        }
    });
};

var letrasABC = function() {
    $.ajax({
        type: 'get',
        url: '/letrasABC',
        success: function(data) {                 
            $('#LetrasABC').empty().html(data); 
        }
    });
};


$('.card-body').on('click', '.buscarEntrada', function(event){
    $('.buscarEntrada').prop('disabled', true);
    event.preventDefault();
    var x = document.getElementById("buscarEntrada");
    if (x.value == '') {
        listarEntradaIndex();
    } else {            
        $.ajax({
            type: "get",
            url: "/busqueda/" + x.value,
            success: function(data) {
                $("#ListaEntradaIndex").empty().html(data);
            }
        });
    } 
    $('.buscarEntrada').prop('disabled', false);          
});


$('.card-body').on('click', '.letraABC', function(event){        
    event.preventDefault();
    var x = this.value;            
    $.ajax({
        type: "get",
        url: "/busqueda/" + x,
        success: function(data) {
            $("#ListaEntradaIndex").empty().html(data);
        }
    });
    $('.buscarEntrada').prop('disabled', false);          
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

$('#buscarEntrada').keypress(function(e) {
    var keycode = (e.keyCode ? e.keyCode : e.which);
    if (keycode == '13') {            
        var x = document.getElementById("buscarEntrada");
        x.value = x.value.toUpperCase();
        if (x.value == '') {
            listarEntradaIndex();
        } else {                
            $.ajax({
                type: "get",
                url: "/busqueda/" + x.value,
                success: function(data) {
                    $("#ListaEntradaIndex").empty().html(data);
                }
            });
        } 
        return false;
    }
});

var busquedaJson = function(palabra) {
    $.ajax({
        type: "get",
        url: "/busquedaJson/"+palabra,
        success: function(data) {  
            data;
        }
    });
};


$('.card-body').on('click', '.grabarContacto', function(event){
    event.preventDefault();
    var data = $( "#formContacto" ).serialize();
    $.post( "/contacto", data, function(data){
        if ($.isEmptyObject(data.error)) {  
            alert(data.success);          
            $('.form-control').val('');
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