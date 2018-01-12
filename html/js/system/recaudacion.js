var guardar = function(){
  var existeError = false;
  var idRecaudacion = $('#id').val();
	var txtNombre = $("#txtNombre").val();
  
	if(txtNombre==""){
    $("#txtNombre").removeClass("isOk");
    $("#txtNombre").addClass("isError");
		existeError = true;
	}else{
    $("#txtNombre").removeClass("isError");
    $("#txtNombre").addClass("isOk");
  }
  if($("#estatus").is(':checked')){
    var estatus = 1;
  }else{
    var estatus = 0;
  }   
  if(existeError){
		mostrarAviso("Faltan capturar algunos campos.");
    return false;
  }

	mostrarEspera("Registrando información...");
    			xajax_guardar(
              idRecaudacion,    					
    					txtNombre,
              estatus);
}

var inicializarControles=function()
	{	

  	 $("#btnGuardar").click(guardar);  

  	
	};
	$(document).ready(function(){inicializarControles()});