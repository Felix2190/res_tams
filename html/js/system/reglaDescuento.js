var guardar = function(){
  var existeError = false;
	var txtNombre = $("#txtNombre").val();
	var txtDescripcion = $("#txtDescripcion").val();
	var txtEdadMinima = $("#txtEdadMinima").val();
	var txtEdadMaxima = $("#txtEdadMaxima").val();
  var txtCantidad = $("#txtCantidad").val(); 
  var idReglaDescuento = $("#id").val();
  var estatus = $("#estatus").val();   
  if($("#esPorcentaje").is(':checked')){
    var esPorcentaje = 1;
  }else{
    var esPorcentaje = 0;
  }
  if($("#estatus").is(':checked')){
    var estatus = 1;
  }else{
    var estatus = 0;
  }  
  var slcTipoLicencia = $("#slcTipoLicencia").val();

	if(txtNombre==""){
    $("#txtNombre").removeClass("isOk");
    $("#txtNombre").addClass("isError");
		existeError = true;
	}else{
    $("#txtNombre").removeClass("isError");
    $("#txtNombre").addClass("isOk");
  }
	if(txtDescripcion==""){
    $("#txtDescripcion").removeClass("isOk");
    $("#txtDescripcion").addClass("isError");
		existeError = true;
	}else{
    $("#txtDescripcion").removeClass("isError");
    $("#txtDescripcion").addClass("isOk");
  }  
	if(slcTipoLicencia=="0"){
		$("#slcTipoLicencia").removeClass("isOk");
    $("#slcTipoLicencia").addClass("isError");
		existeError = true;
	}else{
    $("#slcTipoLicencia").removeClass("isError");
    $("#slcTipoLicencia").addClass("isOk");
  }
  if(isNaN($("#txtEdadMinima").val()) || txtEdadMinima==''){
    $("#txtEdadMinima").removeClass("isOk");
    $("#txtEdadMinima").addClass("isError");
		existeError = true;
	}else{
    $("#txtEdadMinima").removeClass("isError");
    $("#txtEdadMinima").addClass("isOk");
  }
  if(isNaN($("#txtEdadMaxima").val()) || txtEdadMaxima==''){  
    $("#txtEdadMaxima").removeClass("isOk");
    $("#txtEdadMaxima").addClass("isError");
		existeError = true;
	}else{
    $("#txtEdadMaxima").removeClass("isError");
    $("#txtEdadMaxima").addClass("isOk");
  }
  if(isNaN($("#txtCantidad").val()) || txtCantidad==''){
    $("#txtCantidad").removeClass("isOk");
    $("#txtCantidad").addClass("isError");
		existeError = true;
	}else{
    $("#txtCantidad").removeClass("isError");
    $("#txtCantidad").addClass("isOk");
  }  
  if(existeError){
		mostrarAviso("Faltan capturar algunos campos.");
    return false;
  }

	mostrarEspera("Registrando información...");
    			xajax_actualizar(    					
    					txtNombre,
              txtDescripcion,
    					esPorcentaje,
    					txtCantidad,
    					txtEdadMinima,
    					txtEdadMaxima,
    					slcTipoLicencia,
              idReglaDescuento,
              estatus);
}

var inicializarControles=function()
	{	

  	 $("#btnGuardar").click(guardar);  

  	
	};
	$(document).ready(function(){inicializarControles()});