var guardar = function(){
  var existeError = false;
	var txtNombre = $("#txtNombre").val();

	if(txtNombre==""){
    $("#txtNombre").removeClass("isOk");
    $("#txtNombre").addClass("isError");
		existeError = true;
	}else{
    $("#txtNombre").removeClass("isError");
    $("#txtNombre").addClass("isOk");
  }

  if(existeError){
		mostrarAviso("Faltan capturar algunos campos.");
    return false;
  }


	mostrarEspera("Registrando información...");
    			xajax_guardar(    					
    					txtNombre);
}

var inicializarControles=function()
	{	

  	 $("#btnGuardar").click(guardar);  

  	
	};
	$(document).ready(function(){inicializarControles()});