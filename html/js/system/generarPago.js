var removerInformacion=function()
{
	$("#divInfo").html("Sin informaci&oacute;n.");
	$("#btnGenerarPago").attr("disabled","disabled");
	$("#btnEnviar").attr("disabled","disabled");
	
}
var colocarInformacion=function(datos)
{
	$("#divInfo").html(datos);
	//$("#btnGenerarPago").removeAttr("disabled");
	//$("#btnEnviar").removeAttr("disabled");
	
	$("#txtRecibe").numeric({ negative : false ,integers:true});
	$("#txtUltimos").numeric({ negative : false ,integers:true});
	
	$("#txtRecibe").keyup(function()
	{
		if($(this).val().trim()!="")
		{
			var total=$(this).attr("data");
			var cambio=$(this).val()-total;
			
			cambio=cambio.toFixed(2)
			if(cambio>=0)
			{
				$("#lblCambio").html("$ " + cambio);
				$("#btnGenerarPago").removeAttr("disabled");
			}
			else
			{
				$("#lblCambio").html("Pago insuficiente");
				$("#btnGenerarPago").attr("disabled","disabled");
			}
		}
		else
		{
			$("#lblCambio").html("");
			$("#btnGenerarPago").attr("disabled","disabled");
		}
	});	
	$("#slcFormaPago").focus();	
	$("#slcFormaPago").focusout(function()
	{
		if($(this).val()=="efectivo"||$(this).val()=="")
		{
			$("#txtRecibe").focus();
		}
		else
		{	
			$("#txtUltimos").focus();
		}
	});
	
	$("#slcFormaPago").change(function()
	{
		if($(this).val()=="efectivo"||$(this).val()=="")
		{
			$("#txtUltimos").val("");
			$("#txtUltimos").attr("disabled","disabled");
			//$("#txtRecibe").focus();
			
		}
		else
		{	
			$("#txtUltimos").removeAttr("disabled");
			//$("#txtUltimos").focus();
		}

	});
	
	
};
var buscarTurno=function()
{	
	mostrarAviso("Buscando informacion...");
	var idInterno=$("#txtTurnoInterno").val().trim();
	var idExterno=$("#txtTurnoExterno").val().trim();
	
	if(idInterno==""&&idExterno=="")
	{
		mostrarAviso("Captura el turno interno o externo a buscar.");
		return false;
	}
	
	xajax_buscarTurnoPago(idInterno, idExterno);	
	return false;
};

var registrarPago=function()
{
	return registrar(false);
};

var enviarBanco=function()
{
	return registrar(true);
};
var registrar=function(enviandoBanco)
{
	var idTurno=$("#idTurno").val();
	//var txtFolioTesoreria=$("#txtFolioTesoreria").val().trim();
	var txtFolioTesoreria="";
	
	var forma=$("#slcFormaPago").val();
	var ultimos=$("#txtUltimos").val().trim();
	
	
	console.log("[" + idTurno + "]");
	console.log("[" + forma + "]");
	console.log("[" + ultimos + "]");
	
	if(forma=="")
	{
		mostrarAviso("Selecciona la forma de pago.");
		return false;
	}
	
	if((forma=="td"||forma=="tc")&&ultimos.length!=4)
	{
		mostrarError("Captura los &uacute;ltimos 4 d&iacute;gitos de la tarjeta.");
		return false;
	
	}
	
	var txtComentarios=$("#txtComentarios").val().trim();
	
	if(idTurno=="")
	{
		mostrarError("Ocurrio un error, consulte al area de sistemas.");
		return false;
	}
	
	/*
	if(txtFolioTesoreria=="")
	{
		mostrarAviso("Capture el folio de tesorer&iacute;a.");
		return false;
	}
	*/
	
	/*
	if(enviandoBanco)
	{
		mostrarAviso("Enviando banco...");
		xajax_enviarBanco(idTurno, txtFolioTesoreria, txtComentarios);
	}
	else
	{
	*/
		mostrarAviso("Registrando pago...");
		xajax_registrarPago(idTurno, txtFolioTesoreria, txtComentarios,forma,ultimos);
	/*}*/
	return false;
};



var inicializarControles=function()
{
	$("#txtTurnoInterno").numeric({ negative : false ,integers:true});
	$("#txtTurnoExterno").numeric({ negative : false ,integers:true});
	
	
	$("#btnBuscar").click(buscarTurno);
	$("#btnGenerarPago").attr("disabled","disabled");
	$("#btnGenerarPago").click(registrarPago);
	
	$("#generaPDF").click(function()
	{
		xajax_generaPDF();
	});
	
	//$("#btnEnviar").click(enviarBanco);
	//$("#btnEnviar").attr("disabled","disabled");
	
	if($("#txtTurnoInterno").val().trim()!="")
	{
		buscarTurno();
	}
	
};
$(document).ready(function(){inicializarControles()});