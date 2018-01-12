


var inicializarControles=function()
{
	var d = new Date();
	var strDateIni = d.getFullYear()+ "-" + (d.getMonth()+1) + "-01";
	var strDateFin = d.getFullYear()+ "-" + (d.getMonth()+1) + "-" + d.getDate();
	
	
	console.log(strDateIni);
	
	$("#txtFechaIni").datepicker(	
	{	
		changeYear :true,
		changeMonth :true,
		constrainInput:true,
		dateFormat: "yy-mm-dd",
		maxDate:0
	});
	
	
	$("#txtFechaIni").datepicker('setDate', strDateIni);	
	$("#txtFechaIni").attr("readonly","readonly");
	
	
	$("#txtFechaFin").datepicker(	
	{	
		changeYear :true,
		changeMonth :true,
		constrainInput:true,
		dateFormat: "yy-mm-dd",
		maxDate:0
	});
	
	
	$("#txtFechaFin").datepicker('setDate', strDateFin);	
	$("#txtFechaFin").attr("readonly","readonly");
	
	$("#btnActualizar").click(actualizar);
	
	$("#btnReset").click(resetTurno);
	
	actualizar();
	
	
};
$(document).ready(function(){inicializarControles()});

var reiniciarConfirmacion=function()
{
	xajax_reiniciarTurnos();
}
var resetTurno=function()
{
	mostrarConfirmacion("Se reiniciar&aacute; el contador de turnos. Confirma la operaci&oacute;n.",0,reiniciarConfirmacion);
};




var actualizar=function()
{
	mostrarEspera("Actualizando informaci&oacute;n...");
	xajax_actualizar($("#txtFechaIni").val(),$("#txtFechaFin").val());
};