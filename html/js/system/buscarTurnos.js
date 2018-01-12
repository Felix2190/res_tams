var limpiar= function(){
	$("#txtFechaMovimiento").val('')
	$("#txtTurnoInt").val('')
	$("#txtTurnoExt").val('')
	$("#slcTipo").val('')
	$("#txtNombre").val('')
	$("#txtApPat").val('')
	$("#txtApMat").val('')
	$("#txtCURP").val('')
	var n=0;
	$("#tablaResultados tr").each(function () {	n++;});
	
	for(i=n;i>=0;i--){
		$("#tablaResultados tr:eq('"+i+"')").remove();
	};
} 

var buscar=function(){
	var txtFecha=$("#txtFechaMovimiento").val().trim();
	var txtTurnoInt=$("#txtTurnoInt").val().trim();
	var txtTurnoExt=$("#txtTurnoExt").val().trim();
	var slcTipo=$("#slcTipo").val().trim();
	var txtNombres=$("#txtNombre").val().trim();
	var txtApePat=$("#txtApPat").val().trim();
	var txtApeMat=$("#txtApMat").val().trim();
	var txtCurp=$("#txtCURP").val().trim();
	mostrarEspera('Enviando informaci&oacute;n'+txtCurp);
	xajax_consulta(txtTurnoExt,txtTurnoInt,txtNombres,txtApeMat,txtApePat,txtFecha,slcTipo,txtCurp);	
}

var inicializarControles=function(){
	
	
	var d = new Date();
	var strDate = d.getFullYear()+ "-" + (d.getMonth()+1) + "-" + d.getDate();
	
	$("#txtFechaMovimiento").datepicker(
		{yearRange:"-5:+0",
		changeYear :true,changeMonth :true,constrainInput:true,
		 dateFormat: 'yy-mm-dd'}).on('dp.show', function() {
		  return $(this).data('DateTimePicker').setDate(strDate);});
	
	$("#txtFechaMovimiento").datepicker();
	
	$("#txtFechaMovimiento").attr("readonly","readonly");
	$("#btnCancelar").click(limpiar);
	$("#btnBuscar").click(buscar);
}

$(document).ready(function(){inicializarControles()});