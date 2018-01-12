var inicializarControles=function()
	{    
	    $("#btnGuardar").click(guardarInformacion);//Accion del boton Guardar
	    $("#btnCancelar").click(function(){
	      location.reload();
	    });
		$("#frmRegistro").submit(guardarInformacion);  
	}

	var guardarInformacion=function()
	{    
		if(document.getElementById("archivo").files.length==0){			
			mostrarAviso("Selecciona un archivo.");	
			
		}else{
			var files =document.getElementById("archivo");
			mostrarAviso("Guardando informacion.");				
		}
	}

    $(document).ready(function(){inicializarControles(); });