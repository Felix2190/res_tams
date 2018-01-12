
var guardar = function(){
	var nombre = $("#nombre").val();	
	var estatus = $("#estatus").val();
	
	if(nombre==""){
		mostrarAviso("Favor de capturar nombre.");
		return false;
	}else{
	
	}

	if(estatus==""){
		mostrarAviso("Favor de seleccionar el estatus.");
		return false;
	}else{
	
	}
	
	xajax_guardar(nombre,estatus);
}

var inicializarControles=function()
	{	
  	 $("#btnGuardar").click(guardar);  
  	   	
	};
	$(document).ready(function(){inicializarControles()});