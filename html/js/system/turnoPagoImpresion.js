function sig(){

	xajax_siguiente();	

		return false;
	}
var inicializarControles=function()
{ 
	$("#btnSiguiente").click(sig);
	
};
$(document).ready(function(){inicializarControles()});