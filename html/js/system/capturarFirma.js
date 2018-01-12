function sig(){

	xajax_siguiente();	

		return false;
	}
var inicializarControles=function()
{ 
	$("#btnFirmar").click(function(){
		xajax_capturar();
	});
	
};
$(document).ready(function(){inicializarControles()});