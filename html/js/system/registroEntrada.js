

var guardar = function(){
	
	
	var fecha = $("#fecha").val();
	var folio = $("#folio").val();
	var Ubicacion = $("#Ubicacion").val();
	var tipo = $("#tipo").val();
	var idcodigo = $("#idcodigo").val();
	var codigo = $("#codigo").val();
	var inventariable = $("#inventariable").val();
	var numeroSerie = $("#numeroSerie").val();
	var mac = $("#mac").val();
	var comentarios = $("#comentarios").val();
	
	if(fecha==""){
		mostrarAviso("Favor de capturar fecha.");
		return false;
	}else{
	
	}
	if(folio==""){
		mostrarAviso("Favor de capturar folio.");
		return false;
	}else{
		
	}
	
	if(Ubicacion==""||Ubicacion==0){
		mostrarAviso("Favor de seleccionar Ubicacion.");
		return false;
	}else{
		
	}
	if(tipo==""){
		mostrarAviso("Favor de seleccionar tipo.");
		return false;
	}else{
		
	}
	if(idcodigo==""){
		mostrarAviso("Favor de capturar el c&oacute;digo.");
		return false;
	}else{
		
	}
	if(inventariable==""){
		mostrarAviso("Favor de seleccionar inventariable.");
		return false;
	}else{
		
	}
	
	
	
	
	if(comentarios==""){
		mostrarAviso("Favor de capturar comentario.");
		return false;
	}else{
		
	}
	
	xajax_entrada(fecha,folio,Ubicacion,tipo,idcodigo,inventariable,numeroSerie,mac,comentarios); 
		
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



function formatMAC(e) {
    var r = /([a-f0-9]{2})([a-f0-9]{2})/i,
        str = e.target.value.replace(/[^a-f0-9]/ig, "");

    while (r.test(str)) {
        str = str.replace(r, '$1' + ':' + '$2');
    }

    e.target.value = str.slice(0, 17);
};
var inicializarControles=function()
	{
	var macAddress = $("#mac");
	macAddress.on("keyup", formatMAC);
	
  	 $("#btnGuardar").click(guardar);  
  	 //$("#frmRegistro").submit(guardar);
  	 $('.entero').numeric();
     $('.decimal').numeric(","); 
     $("#datosInventario").hide();
     $("#inventariable").change(inventariable);
     $("#fecha").datepicker({
 		yearRange : "1990:2020",
 		changeYear : true,
 		changeMonth : true,
 		constrainInput : true
 	});
     
 	$("#codigo").autocomplete({source:"getProducto.php",
		messages: {
	        noResults:  function(){$("#idcodigo").val("");},
	        results: function() {}
	    },
		minLength:3,
		select: function(event,ui)
		{
			var code = ui.item.id;
			if(code != '') 
			{
				$("#idcodigo").val(ui.item.id);
			}
			else
			{
				$("#idcodigo").val("");	
			}
			
		}});
 	
// 	length=1;
// 	$("#mac").focusin(function (evt) {
// 	   
// 	    $(this).keypress(function () {
// 	        content=$(this).val();
// 	        content1 = content.replace(/\:/g, '');
// 	        length=content1.length;
// 	        if(((length % 2) == 0) && length < 10 && length > 1){
// 	            $('#mac').val($('#mac').val() + ':');
// 	            }
//
// 	    });

 //	});
 	
	};
	$(document).ready(function(){inicializarControles()});