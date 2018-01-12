
	var refrescaDatos=function(datos)
	{
		$("#divTabla").html(datos);
		TableData.init();
	};


	var enviarFecha=function()
	{	
		var i=jQuery("#txtInicio").val().trim();
		var f=jQuery("#txtFin").val().trim();
		
		if(i=="")
		{
			mostrarAviso(translateReturn("Seleccion la fecha de inicio"));
			return;
		
		}
		
		if(f=="")
		{
			mostrarAviso(translateReturn("Selecciona la fecha final"));
			return;
		
		}
		
		mostrarEspera(translateReturn("Sending filters..."));
		xajax_enviarFecha(i,f);
	};
	
	
	jQuery(document).ready(function() 
	{	
		jQuery("#btnEnviar").click(enviarFecha);
	});