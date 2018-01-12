

var guardarSalida = function(){
	
	
	var fecha = $("#fecha").val();
	var folio = $("#folio").val();
	var Ubicacion = $("#Ubicacion").val();
	var UbicacionNueva = $("#UbicacionNueva").val();
	var codigo = $("#codigo").val();
	var idalmacen = $("#idalmacen").val();
	//var inventariable = $("#inventariable").val();	
	var numeroSerie = $("#numeroSerie").val();
	var mac = $("#mac").val();	
	var comentarios = $("#comentarios").val();
		
	if(fecha==""){
		mostrarAviso("Favor de seleccionar la fecha.");
		return false;
	}else{
		
	}
	
	if(folio==""){
		mostrarAviso("Favor de seleccionar el folio.");
		return false;
	}else{
		
	}
	
	if(Ubicacion==""||Ubicacion==0){
		mostrarAviso("Favor de seleccionar la ubicaci&oacute;n.");
		return false;
	}else{
		
	}
	
	if(UbicacionNueva==""||UbicacionNueva==0){
		mostrarAviso("Favor de seleccionar la nueva ubicaci&oacute;n.");
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
	
	
	//if(inventariable==""){
//		mostrarAviso("Favor de seleccionar si es inventariable.");
//		return false;
//	}else{
//		
//	}
	
	//if(inventariable=="si"){
		if(numeroSerie=="" && mac==""){			
			mostrarAviso("Favor de seleccionar el n&uacute;mero de serie o direcci&oacute;n mac.");
			return false;
		}else{
			
		}
	//}
	
	if(comentarios==""){
		mostrarAviso("Favor de capturar comentarios.");
		return false;
	}else{
		
	}
	
	xajax_registroSalida(fecha,folio,Ubicacion,UbicacionNueva,codigo,idalmacen,numeroSerie,mac,comentarios);
}

var guardarRecepcion = function(){
	
	
	var fecha = $("#fechaT").val();
	var folio = $("#folioT").val();
	var Ubicacion = $("#UbicacionNuevaT").val();
	var idalmacenT = $("#idalmacenT").val();
	var comentarios = $("#comentariosT").val().trim();
		
	if(fecha==""){
		mostrarAviso("Favor de seleccionar la fecha.");
		return false;
	}else{
		
	}
	
	if(folio==""){
		mostrarAviso("Favor de seleccionar el folio.");
		return false;
	}else{
		
	}
	
	if(Ubicacion==""){
		mostrarAviso("Favor de seleccionar la ubicaci&oacute;n.");
		return false;
	}else{
		
	}
	
	if(idalmacenT==""){
		mostrarAviso("Favor de capturar un folio valido.");
		return false;
	}else{
		
	}
	if(comentarios==""){
		mostrarAviso("Favor de capturar comentarios.");
		return false;
	}else{
		
	}
	
	xajax_registroRecepcion(fecha,folio,Ubicacion,idalmacenT,comentarios);
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

var inicializarControles=function()
	{	
  	 $("#btnGuardar").click(guardarSalida);
  	 $("#btnGuardarT").click(guardarRecepcion);
  	 //$("#frmRegistro").submit(guardar);
  	 $('.entero').numeric();
     $('.decimal').numeric(","); 
     //$("#datosInventario").hide();
     $("#inventariable").change(inventariable);
     $("#fecha").datepicker({
 		yearRange : "1900:2020",
 		changeYear : true,
 		changeMonth : true,
 		constrainInput : true
 	});
     
     $("#fechaT").datepicker({
  		yearRange : "1900:2020",
  		changeYear : true,
  		changeMonth : true,
  		constrainInput : true
  	});
     
 	$("#codigo").autocomplete({source:"getProductoTraslado.php",
		messages: {
	        noResults:  function(){$("#idalmacen").val("");},
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
				$("#Ubicacion").val(ui.item.idubicacion);
			}
			else
			{
				$("#idalmacen").val("");	
				$("#mac").val("");
				$("#numeroSerie").val("");
				$("#Ubicacion").val(0);
			}
			
		}});
 	
	
	
	$("#numeroSerie").autocomplete({source:"getProductoNoSerieTraslado.php",
		messages: {
	        noResults:  function(){$("#idalmacen").val("");},
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
				$("#Ubicacion").val(ui.item.idubicacion);
			}
			else
			{
				$("#mac").val("");	
				$("#idalmacen").val("");
				$("#codigo").val("");
				$("#Ubicacion").val(0);
			}
			
		}});
	
	$("#mac").autocomplete({source:"getProductoMacTraslado.php",
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
				$("#Ubicacion").val(ui.item.idubicacion);
			}
			else
			{
				$("#numeroSerie").val("");	
				$("#idalmacen").val("");
				$("#codigo").val("");
				$("#Ubicacion").val(0);
			}
			
		}});
 	
	
	$("#folioT").autocomplete({source:"getFolioTraslado.php",
		messages: {
	        noResults: function(){$("#idalmacenT").val("");},
	        results: function() {}
	    },
		minLength:2,
		select: function(event,ui)
		{
			var code = ui.item.id;
			if(code != '') 
			{
				$("#idalmacenT").val(ui.item.id);
				$("#numeroSerieT").val(ui.item.numeroSerie);
				$("#codigoT").val(ui.item.codigo);
				$("#UbicacionT").val(ui.item.idubicacion);
				$("#macT").val(ui.item.mac);
				$("#comentariosTa").val(ui.item.comentarioSalida);
				$("#UbicacionNuevaT").val(ui.item.idUbicacionNueva);
			}
			else
			{
				$("#idalmacenT").val(ui.item.id);
				$("#numeroSerieT").val("");	
				$("#idalmacenT").val("");
				$("#codigoT").val("");
				$("#UbicacionT").val(0);
				$("#macT").val("");
				$("#comentariosTa").val("");
				$("#UbicacionNuevaT").val("");
			}
			
		}});
	
	};
	
	
	$(document).ready(function(){inicializarControles()});