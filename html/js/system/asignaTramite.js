var asignaTramite=function(id,fila){
	var tableReg = document.getElementById('tablesorting-1');	
	for (var i = 2; i < tableReg.rows.length; i++) {		
		if (fila==i) {
			tableReg.rows[i].style.display = '';
			$("#txtIdTurno").val(id);
		} else {
			tableReg.rows[i].style.display = 'none';
		}
	}
	//xajax_validarbio(id);
}

var asignar=function(){
	var turnoi=$("#txtIdTurno").val();
	var turno = $("#txtTurno").val().trim();
	if(turno=="" ||  isNaN(turno)){
		mostrarAviso("Indique el numero de turno para continuar");
		return ;
	}
	xajax_asignar(turnoi,turno);
	
}

var limpiar=function(){
	$("#txtTurno").val('');
	var n=0;
	$("#tablaResultados tr").each(function () {	n++;});
	
	for(i=n;i>=0;i--){
		$("#tablaResultados tr:eq('"+i+"')").remove();
	};
	$("#txtTurnoInt").val('');
	$("#txtTurnoExt").val('');
	$("#txtIdTurno").val('');
	$("#txtNombre").val('');
	$("#txtFecha").val('');
	$("#txtTurno").val('');
}

var buscarTurno=function(){
	existeError=false;
	var turno = $("#txtTurno").val().trim();
	
	if(turno=="" ||  isNaN(turno)){
		mostrarAviso("Indique el numero de turno para continuar");
		}
	else{
		mostrarEspera('Enviando informaci&oacute;n');
		xajax_consulta(turno);
		}
	
} 
 
var inicializarControles=function(){
	
	$("#btnConsultarTurno").click(buscarTurno);
	$("#btnCancelar").click(limpiar);
	$("#btnAsignaTramite").click(asignar);
}

$(document).ready(function(){inicializarControles()});