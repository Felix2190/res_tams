var colocarLOGLAT=function(marker)
	{
		var markerLatLng = marker.getPosition();
		$("#spLon").html(markerLatLng.lng());
		$("#spLat").html(markerLatLng.lat());
		
		$("#txtLon").val(markerLatLng.lng());
		$("#txtLat").val(markerLatLng.lat());
		
		
		
		
	};
	
	var mostrarComentario=function(nombre, fecha,comentario,sistema)
	{
		if(sistema)
			var ico="gear";
		else
			var ico="user";
		var ms='<div class="comment-content">'+
		'<div class="comment-time">'+
		'<i class="fa fa-' + ico + '"></i> ' + nombre + ' &nbsp;&nbsp;<i class="fa fa-clock-o"></i> ' + fecha +
		'</div>'+
		'<div class="comment-msg">'+
		  comentario + 
		'</div>'+
		'<br>'+
		'</div>';
		$("#divComentarios").append(ms);
		$("#txtComentario").val("");
		ocultarMensaje();
	};
	
	var agregarComentario=function()
	{
		var id=$("#idP").val().trim();
		var comentario=$("#txtComentario").val().trim();
		if(comentario!="")
		{
			mostrarAviso("Registrando comentario...");			
			xajax_agregarComentario(id,comentario);
		}
		return false;
	};

	var editar=function()
	{
		$("#slcAgente").removeAttr("disabled");
		$("#slcEstatus").removeAttr("disabled");
		
		$("#btnCancelar").show();
		$("#btnAceptar").show();
		
		$("#btnListado").hide();
		$("#btnEditar").hide();
		
		return false;
	};
	var cerrarCampos=function()
	{
		$("#btnCancelar").hide();
		$("#btnAceptar").hide();
		$("#btnListado").show();
		$("#btnEditar").show();
		$("#slcAgente").attr("disabled","disabled");
		$("#slcEstatus").attr("disabled","disabled");
	}
	var aceptar=function()
	{	
		var id=$("#hId").val().trim();		
		var idAgente=$("#slcAgente").val();		
		var estatus=$("#slcEstatus").val();
		mostrarAviso("Guardando cambios...");
		xajax_aceptarCambios(id, idAgente, estatus);
		return false;
	}
	
	var cancelar=function()
	{
		$("#btnCancelar").hide();
		$("#btnAceptar").hide();
		$("#btnListado").show();
		$("#btnEditar").show();
		$("#frmDatos").get(0).reset();
		$("#slcAgente").attr("disabled","disabled");
		$("#slcEstatus").attr("disabled","disabled");
		return false;
	}

	var confirmarSiguienteEtapa=function(id)
	{
		mostrarAviso("Registrando cambio...");
		xajax_siguienteEtapa(id);
		return false;
	};
	
	var siguienteEtapa=function()
	{
		var id=$("#hId").val().trim();
		mostrarConfirmacion("El prospecto pasar&aacute; a la siguiente etapa &iquest;Es correcto?",id,confirmarSiguienteEtapa);
		return false;
	};
	
	
	
	
	
	
	
	
	var files;

	

	// Grab the files and set them to our variable
	function prepareUpload(event)
	{
	  files = event.target.files;
	}
	
	function uploadFiles(event)
	{
		var id=$("#hId").val().trim();
	  event.stopPropagation(); // Stop stuff happening
	    event.preventDefault(); // Totally stop stuff happening

	    // START A LOADING SPINNER HERE

	    // Create a formdata object and add the files
	    var data = new FormData();
	    $.each(files, function(key, value)
	    {
	        data.append(key, value);
	    });

	    $.ajax({
	        url: 'prospectoPerfil.php?id=' + id + '&files',
	        type: 'POST',
	        data: data,
	        cache: false,
	        dataType: 'json',
	        processData: false, // Don't process the files
	        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	        success: function(data, textStatus, jqXHR)
	        {
	            if(typeof data.error === 'undefined')
	            {
	            	mostrarAviso("Se subi&oacute; el archivo correctamente.");
	            	$("#divFileDownload").show();	            	
	            	$("#lblFileName").html(data.fileName);
	            	//alert("1");
	            	//console.dir(data);
	                // Success so call function to process the form
	                //submitForm(event, data);
	                
	            }
	            else
	            {
	            	mostrarAviso("Ocurri&oacute: un error al enviar el archivo de propuesta.");
	                // Handle errors here
	            	//alert("2");
	            	//console.log('ERRORS: ' + data.error);
	                
	            }
	        },
	        error: function(jqXHR, textStatus, errorThrown)
	        {
	            // Handle errors here
	        	//alert("3");
	        	console.log('ERRORS: ' + textStatus);	            
	            // STOP LOADING SPINNER
	        },
	        complete: function()
	        {
	        	//alert("4");
	        }
	    });
	}
	
	
	
	
	
	$(document).ready(function()
	{	
		$("#btnAgregarNota").click(agregarComentario);
		//$("#slcAgente").select2();
		//$("#slcEstatus").select2();
		
		$("#btnEditar").click(editar);
		$("#btnCancelar").click(cancelar);
		$("#btnAceptar").click(aceptar);
		$("#btnNext").click(siguienteEtapa);
		cancelar();
		
		
		// Add events
		$('input[type=file]').on('change', prepareUpload);
		$('#btnSubir').on('click', uploadFiles);
		
		
		//initMap();
	});
	 

