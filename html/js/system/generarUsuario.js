var guardar = function(){
  var existeError = false;
	var txtNombre = $("#txtNombre").val();
  var txtApellidos = $("#txtApellidos").val();
  var txtUsuario = $("#txtUsuario").val();
  var txtContrasena = $("#txtContrasena").val();
  var txtContrasenaRepetir = $("#txtContrasenaRepetir").val();
  var txtEmail = $("#txtEmail").val(); 
  var slcRecaudacion = $("#slcRecaudacion").val();
  var slcRol = $("#slcRol").val();  

	if(txtNombre==""){
    $("#txtNombre").removeClass("isOk");
    $("#txtNombre").addClass("isError");
		existeError = true;
	}else{
    $("#txtNombre").removeClass("isError");
    $("#txtNombre").addClass("isOk");
  }
	if(txtApellidos==""){
    $("#txtApellidos").removeClass("isOk");
    $("#txtApellidos").addClass("isError");
		existeError = true;
	}else{
    $("#txtApellidos").removeClass("isError");
    $("#txtApellidos").addClass("isOk");
  }
	if(txtUsuario==""){
    $("#txtUsuario").removeClass("isOk");
    $("#txtUsuario").addClass("isError");
		existeError = true;
	}else{
    $("#txtUsuario").removeClass("isError");
    $("#txtUsuario").addClass("isOk");
  }
	if(txtEmail==""){
    $("#txtEmail").removeClass("isOk");
    $("#txtEmail").addClass("isError");
		existeError = true;
	}else{
    $("#txtEmail").removeClass("isError");
    $("#txtEmail").addClass("isOk");
  }
	if(txtContrasena==""){
    $("#txtContrasena").removeClass("isOk");
    $("#txtContrasena").addClass("isError");
		existeError = true;
	}else{
    $("#txtContrasena").removeClass("isError");
    $("#txtContrasena").addClass("isOk");
  }
	if(txtContrasenaRepetir==""){
    $("#txtContrasenaRepetir").removeClass("isOk");
    $("#txtContrasenaRepetir").addClass("isError");
		existeError = true;
	}else{
    $("#txtContrasenaRepetir").removeClass("isError");
    $("#txtContrasenaRepetir").addClass("isOk");
  }          
	if(slcRecaudacion=="0"){
		$("#slcRecaudacion").removeClass("isOk");
    $("#slcRecaudacion").addClass("isError");
		existeError = true;
	}else{
    $("#slcRecaudacion").removeClass("isError");
    $("#slcRecaudacion").addClass("isOk");
  }
	if(slcRol=="0"){
		$("#slcRol").removeClass("isOk");
    $("#slcRol").addClass("isError");
		existeError = true;
	}else{
    $("#slcRol").removeClass("isError");
    $("#slcRol").addClass("isOk");
  }  

  if(existeError){
		mostrarAviso("Faltan capturar algunos campos.");
    return false;
  }
  if(txtContrasena!=txtContrasenaRepetir){
		mostrarAviso("Las contraseñas no coinciden.");
    return false;
  }  

	mostrarEspera("Registrando información...");
    			xajax_guardar(    					
    					txtNombre,
    					txtApellidos,
    					txtUsuario,
    					txtEmail,
    					txtContrasena,
    					slcRecaudacion,
    					slcRol);
}

var inicializarControles=function()
	{	

  	 $("#btnGuardar").click(guardar);  

  	
	};
	$(document).ready(function(){inicializarControles()});