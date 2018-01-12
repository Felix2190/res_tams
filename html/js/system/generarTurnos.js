function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

var avanzaTurno= function(){
	var turno = $("#txtTurnoActual").val().trim();
	xajax_avanzaTurno(turno);
	window.location.reload(true);
	sleep(1000);
}

var atender= function(){
	var turno = $("#txtTurnoActual").val().trim();
	xajax_atender(turno);
	sleep(1000);
	window.location.reload(true);
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
			if($("#txtIdPersona").val()=="")
				$("#txtIdPersona").val(0);
		}
	}	
		
	xajax_validarbio(id);
}

var buscar = function(){
	existeErrorCURP = false;
	existeErrorRFC=false;
	existeErrorLicencia=false;
	$("#txtIdPersona").val("");
	var curp,rfc,licencia;
	var buscar = $("#txtBuscar").val().trim();
	curp="";
	rfc="";
	licencia="";
	
	if (buscar.length==13 || buscar.length==10){//es RFC
		rfc=buscar;
	}else if(buscar.length==18 || buscar.length==50 ){ //es CURP
		curp=buscar;
	}else if(buscar.length==11){//Es licencia
		licencia=buscar;
	}

	if(rfc=="" &&	curp=="" &&	licencia=="" ){
			mostrarAviso("Debe indicar CURP, RFC, o Numero de licencia");
		}
	else{
		mostrarEspera('Enviando informaci&oacute;n');
		xajax_buscar(curp,rfc,licencia);
		
	}	
	
	
}

var scrollTabla=function(){
	window.scrollTo(500, 0);
}


var guardaSinVal=function(){
	existeError=false;
	var turno = $("#txtTurno").val().trim();
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

var guardarPersona=function(){
	existeError=false;
	var turno = $("#txtTurnoActual").val().trim();
	
	var persona=$("#txtIdPersona").val().trim();
	var tramite=$("#slcTramites").val().trim();
	
	
	if(persona=="" || turno=="" || tramite=="")
		existeError = true;
	
	
	if(existeError ){
		mostrarAviso("Busque a una persona y seleccione el tramite" );
		}
	else{
		mostrarEspera('Enviando informaci&oacute;n' +tramite+' '+persona+ ' ' + turno);
		xajax_guardarTurno(turno,persona,tramite);
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
	
		$("#txtLicencia").val('');
	
		$("#txtBuscar").val('');
	
		$("#txtIdPersona").val('');
		
		$("#slcTramites").empty();

}


var limpiar=function(){
	$("#txtIdPersona").val('');
	$("#txtBuscar").val('');
	$("#txtRFC").val('');
	$("#txtTurno").val('');
	var n=0;
	$("#tablaResultados tr").each(function () {	n++;});	
	for(i=n;i>=0;i--){
		$("#tablaResultados tr:eq('"+i+"')").remove();
	};
	$("#slcTramites").empty();	
	$('#slcTramites').append($('<option>', {
    value: '',
    text: 'Seleccione una opción'
}));
}
 
var inicializarControles=function(){
	
	$("#btnAtender").click(atender);
	$("#btnSiguienteTurno").click(avanzaTurno)
}

$(document).ready(function(){inicializarControles()});