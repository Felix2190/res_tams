

var guardar = function(){
	
	
	var fecha = $("#fecha").val();
	var folio = $("#folio").val();
	var Ubicacion = $("#Ubicacion").val();
	var codigo = $("#codigo").val();
	var idalmacen = $("#idalmacen").val();
	var inventariable = $("#inventariable").val();	
	var numeroSerie = $("#numeroSerie").val();
	var mac = $("#mac").val();	
	var comentarios = $("#comentarios").val();
	var salida = $("#salida").val();
	var tipoSalida = $("#tipoSalida").val();
	var paqueteria = $("#paqueteria").val();
	var guia = $("#guia").val();
	var especifique = $("#especifiques").val();
	var personaRecibe = $("#personaRecibe").val();
		
	if(fecha==""){
		mostrarAviso("Favor de seleccionar la fecha.");
		return false;
	}else{
		
	}
	
	if(folio==""){
		mostrarAviso("Favor de capturar el folio.");
		return false;
	}else{
		
	}
	
	if(Ubicacion=="" || Ubicacion==0){
		mostrarAviso("Favor de seleccionar la ubicaci&oacute;n.");
		return false;
	}else{
		
	}
	
	if(codigo==""){
		mostrarAviso("Favor de capturar el c&oacute;digo.");
		return false;
	}else{
		
	}
	
	if(idalmacen==""){
		mostrarAviso("Favor de capturar el c&oacute;digo o el numero de serie.");
		return false;
	}else{
		
	}
	
	
	if(inventariable==""){
		mostrarAviso("Favor de seleccionar si es inventariable.");
		return false;
	}else{
		
	}
	
	if(inventariable=="si"){
		if(numeroSerie=="" && mac==""){			
			mostrarAviso("Favor de seleccionar el n&uacute;mero de serie o direcci&oacute;n mac.");
			return false;
		}else{
			
		}
	}
	
	if(comentarios==""){
		mostrarAviso("Favor de capturar comentarios.");
		return false;
	}else{
		
	}
	
		//mostrarAviso("Favor de capturar comentarios.");
		//return false;
	
	if(salida == ""){
		mostrarAviso("Favor de seleccionar el campo salio a.");
		return false;
	}
	if(tipoSalida == ""){
		mostrarAviso("Favor de seleccionar el campo tipo de entrega.");
		return false;
	}
	if(tipoSalida == "paqueteria"){
		if(paqueteria==""){
			mostrarAviso("Favor de capturar paqueteria.");
			return false;
		}else{
			
		}
		if(guia==""){
			mostrarAviso("Favor de capturar guia.");
			return false;
		}else{
			
		}
				
	}else if(tipoSalida=="otro"){		
		if(especifique==""){
			mostrarAviso("Favor de capturar el campo especifique.");
			return false;
		}else{
			
		}
	}
	
	if(personaRecibe==""){
		mostrarAviso("Favor de capturar la persona que recibe.");
		return false;
	}else{
		
	}
	
	
	xajax_registroSalida(fecha,folio,Ubicacion,codigo,idalmacen,inventariable,numeroSerie,mac,comentarios,salida,tipoSalida ,paqueteria ,guia ,especifique ,personaRecibe );
}

var inventariable=function()
{	
	valor = $("#inventariable").val();
	if (valor=="si"){
		$("#datosInventario").show();
	}else{
		$("#datosInventario").hide();
	}
};

var salida = function(){
	salida = $("#tipoSalida").val();
	if(salida == "paqueteria"){
		$("#paq").show();
		$("#noGuia").show();
		$("#especifique").hide();
	}else if(salida=="otro"){
		$("#paq").hide();
		$("#noGuia").hide();
		$("#especifique").show();
	}
} 
var inicializarControles=function()
	{	
  	 $("#btnGuardar").click(guardar);  
  	 //$("#frmRegistro").submit(guardar);
  	 $('.entero').numeric();
     $('.decimal').numeric(","); 
     $("#datosInventario").hide();
     $("#inventariable").change(inventariable);
     $("#fecha").datepicker({
 		yearRange : "1900:2020",
 		changeYear : true,
 		changeMonth : true,
 		constrainInput : true
 	});
     
 	$("#codigo").autocomplete({source:"getProductoSalida.php",
		messages: {
	        noResults: function(){$("#idalmacen").val("");},
	        results: function() {}
	    },
		minLength:2,
		select: function(event,ui)
		{
			var code = ui.item.id;
			if(code != '') 
			{
				$("#idalmacen").val(ui.item.id);
				$("#mac").val(ui.item.mac);
				$("#numeroSerie").val(ui.item.numeroSerie);
			}
			else
			{
				$("#idalmacen").val("");	
				$("#mac").val("");
				$("#numeroSerie").val("");
			}
			
		}});
 	
	
	
	$("#numeroSerie").autocomplete({source:"getProductoNoSerie.php",
		messages: {
	        noResults: function(){$("#idalmacen").val("");},
	        results: function() {}
	    },
		minLength:2,
		select: function(event,ui)
		{
			var code = ui.item.id;
			if(code != '') 
			{
				$("#idalmacen").val(ui.item.id);
				$("#mac").val(ui.item.mac);
				$("#codigo").val(ui.item.codigo);
			}
			else
			{
				$("#mac").val("");	
				$("#idalmacen").val("");
				$("#codigo").val("");
			}
			
		}});
	
	$("#mac").autocomplete({source:"getProductoMac.php",
		messages: {
	        noResults: function(){$("#idalmacen").val("");},
	        results: function() {}
	    },
		minLength:2,
		select: function(event,ui)
		{
			var code = ui.item.id;
			if(code != '') 
			{
				$("#idalmacen").val(ui.item.id);
				$("#numeroSerie").val(ui.item.numeroSerie);
				$("#codigo").val(ui.item.codigo);
			}
			else
			{
				$("#numeroSerie").val("");	
				$("#idalmacen").val("");
				$("#codigo").val("");
			}
			
		}});
 		$("#tipoSalida").change(salida);
 		$("#paq").hide();
		$("#noGuia").hide();
		$("#especifique").hide();
	};
	
	
	$(document).ready(function(){inicializarControles()});