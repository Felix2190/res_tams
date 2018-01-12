var confirmaCorte=function(dato)
{
	xajax_corte();
	
	return false;
}

var corte=function()
{
	console.log("corte");
	mostrarConfirmacion("Se realizar&aacute; el corte de caja.<br /> &iquest;Deseas continuar con la operaci&oacute;n?",0,confirmaCorte);
	console.log("corte2");
	return false;
};
var inicializarControles=function(){
	$("#btnCorte").click(corte);
}

$(document).ready(function(){inicializarControles()});