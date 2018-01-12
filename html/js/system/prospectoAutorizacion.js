	var autorizaProspecto=function(idProspecto)
	{
		mostrarAviso("Autorizando prospecto...");
		xajax_autorizaProspecto(idProspecto);
		return false;
	};
	var rechazaProspecto=function(idProspecto)
	{
		mostrarAviso("Rechazando prospecto...");
		xajax_rechazarProspecto(idProspecto);
		return false;
	};
	
	var inicializarControles=function()
	{	
		$(".btnAutorizar").click(function()
		{
			var id=$(this).attr("data");			
			mostrarConfirmacion("Deseas autorizar al prospecto?",id,autorizaProspecto);
		});			
		
		$(".btnRechazar").click(function()
		{
			var id=$(this).attr("data");			
			mostrarConfirmacion("Deseas rechazar al prospecto?",id,rechazaProspecto);
		});
	};
	$(document).ready(function(){inicializarControles()});