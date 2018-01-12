function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

var valbiosinid=function(){
	xajax_validarbio(0);
}
var ValidarBiografico=function(id,fila){
	var tableReg = document.getElementById('tablesorting-1');	
	for (var i = 2; i < tableReg.rows.length; i++) {		
		if (fila==i) {
			tableReg.rows[i].style.display = '';
			$("#txtIdPersona").val(id);
		} else {
			tableReg.rows[i].style.display = 'none';
		}
	}
	//xajax_validarbio(id);
}

var buscar = function(){
	existeErrorCURP = false;
	existeErrorRFC=false;
	existeErrorLicencia=false;
	$("#txtIdPersona").val("");
	var curp = $("#txtCURP").val().trim();
	if (curp == "") {
		existeErrorCURP = true;
		console.log("Error: txtCURP");
		$(".txtCURP").removeClass("isOk");
		$(".txtCURP").addClass("isError");
	} else {
		$(".txtCURP").removeClass("isError");
	}
	
	var rfc = $("#txtRFC").val().trim();
	if (rfc == "") {
		existeErrorRFC = true;
		console.log("Error: txtRFC");
		$(".txtRFC").removeClass("isOk");
		$(".txtRFC").addClass("isError");
	} else {
		$(".txtRFC").removeClass("isError");
	}
	
	var licencia = $("#txtLicencia").val().trim();
	if (licencia == "") {
		existeErrorLicencia = true;
		console.log("Error: txtLicencia");
		$(".txtLicencia").removeClass("isOk");
		$(".txtLicencia").addClass("isError");
	} else {
		$(".txtLicencia").removeClass("isError");
	}
	
	
	if(existeErrorCURP &&	existeErrorRFC &&	existeErrorLicencia ){
			mostrarAviso("Debe indicar CURP, RFC, o Numero de licencia");
		}
	else{
		mostrarEspera('Enviando informaci&oacute;n');
		xajax_buscar(curp,rfc,licencia);
	}
	
	
}

var guardarPersona=function(){
	existeError=false;
	var turno = $("#txtTurno").val().trim();
	var persona=$("#txtIdPersona").val().trim();
	
	if(persona=="")
		existeError = true;
	
	if (turno == "") {
		existeError = true;
		console.log("Error: txtTurno");
		$(".txtTurno").removeClass("isOk");
		$(".txtTurno").addClass("isError");
	} else {
		$(".txtTurno").removeClass("isError");
	}
	
	if(existeError ){
		mostrarAviso("Seleccione una persona e indique el numero de turno externo para continuar "+persona);
		}
	else{
		mostrarEspera('Enviando informaci&oacute;n');
		xajax_guardarTurno(turno,persona);
		}
}

var consultaCURP=function(){
	var windowObjectReference;
	var strWindowFeatures = "menubar=no,location=no,resizable=yes,scrollbars=no,status=yes,fullscreen";
     //function openRequestedPopup() {
      windowObjectReference = window.open("getCURP.php", "CNN_WindowName", strWindowFeatures);
     //}
}

var limpiarcampos= function(){
	if($(this).attr('name')=='txtCURP'){		
		$("#txtRFC").val('');
		$("#txtLicencia").val('');
	}
	if($(this).attr('name')=='txtRFC'){
		$("#txtCURP").val('');		
		$("#txtLicencia").val('');
	}
	if($(this).attr('id')=='txtLicencia'){
		$("#txtCURP").val('');
		$("#txtRFC").val('');
		
	}
}

var guardaSinVal=function(){
	existeError=false;
	crearTurno
	var persona=$("#txtIdPersona").val().trim();
	
	var tableReg = document.getElementById('tablaResultados');	
	var snreult=false;
	
	if(tableReg.rows.length==1 ){
		
			snreult=true;
	}
	if(turno=="")
		mostrarAviso("Indique el numero de turno externo , ");
	else if(persona!="" || !snreult ){		
		mostrarAviso("No debe haber coincidencias y se debe realizar la busqueda para Guardar sin validación ");}
	else if(existeError ){
		mostrarAviso("Indique el numero de turno externo para continuar");
		}
	else{
		mostrarEspera('Enviando informaci&oacute;n');
		xajax_guardarTurno(turno,-1);
		}
	
} 

var crearTurno=function(){
	var idUbicacion=$("#idUbicacion").val().trim();
	mostrarEspera('Generando el turno.. ');
	xajax_agregaNuevoTurno(idUbicacion);
	sleep(3000);	
	window.location.reload(true);
}


var limpiar=function(){
	$("#txtCURP").val('');
	$("#txtLicencia").val('');
	$("#txtRFC").val('');
	$("#txtTurno").val('');
	var n=0;
	$("#tablaResultados tr").each(function () {	n++;});	
	for(i=n;i>=0;i--){
		$("#tablaResultados tr:eq('"+i+"')").remove();
	};
}
 
var inicializarControles=function(){
	$("#btnGuardar").click(buscar);
	$("#btnValBio").click(valbiosinid);
	$("#txtCURP").focusin(limpiarcampos);
	$("#txtRFC").focusin(limpiarcampos);
	$("#txtLicencia").focusin(limpiarcampos);
	$("#btnConsultarCURP").click(consultaCURP);
	$("#btnGuardarTurno").click(guardarPersona);
	$("#btnTurnoSNBio").click(guardaSinVal);
	$("#btnCancelar").click(limpiar);
	$("#btnCrearTurno").click(crearTurno);
}

$(document).ready(function(){inicializarControles()});