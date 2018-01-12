
var actualizar = function(){

	mostrarEspera('Actualizando..');
	xajax_guardarTurno();
	
}
 
var inicializarControles=function(){
	$("#btnActualizar").click(actualizar);	
}

$(document).ready(function(){inicializarControles()});