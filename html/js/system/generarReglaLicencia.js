var guardar = function(){
  var existeError = false;
	var txtNombre = $("#txtNombre").val();
  if($("#formatoSF001").is(':checked')){
    var formatoSF001 = 1;
  }else{
    var formatoSF001 = 0;
  }
	if($("#examenTransito").is(':checked')){
    var examenTransito = 1;
  }else{
    var examenTransito = 0;
  }
	if($("#identificacionOficial").is(':checked')){
    var identificacionOficial = 1;
  }else{
    var identificacionOficial = 0;
  }
	if($("#comprobanteDomicilio").is(':checked')){
    var comprobanteDomicilio = 1;
  }else{
    var comprobanteDomicilio = 0;
  }
	if($("#curp").is(':checked')){
    var curp = 1;
  }else{
    var curp = 0;
  }
	if($("#rfc").is(':checked')){
    var rfc = 1;
  }else{
    var rfc = 0;
  }
	if($("#actaNacimiento").is(':checked')){
    var actaNacimiento = 1;
  }else{
    var actaNacimiento = 0;
  }
	if($("#polizaSeguro").is(':checked')){
    var polizaSeguro = 1;
  }else{
    var polizaSeguro = 0;
  }
	if($("#cartaResponsiva").is(':checked')){
    var cartaResponsiva = 1;
  }else{
    var cartaResponsiva = 0;
  }
	if($("#identificacionPadreTutor").is(':checked')){
    var identificacionPadreTutor = 1;
  }else{
    var identificacionPadreTutor = 0;
  }                
  if($("#formatoMigratorio").is(':checked')){
    var formatoMigratorio = 1;
  }else{
    var formatoMigratorio = 0;
  }
  if($("#constanciaLicenciaVigente").is(':checked')){
    var constanciaLicenciaVigente = 1;
  }else{
    var constanciaLicenciaVigente = 0
  }
  if($("#licenciaAnterior").is(':checked')){
    var licenciaAnterior = 1;
  }else{
    var licenciaAnterior = 0
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
	if(slcTipoLicencia=="0"){
		$("#slcTipoLicencia").removeClass("isOk");
    $("#slcTipoLicencia").addClass("isError");
		existeError = true;
	}else{
    $("#slcTipoLicencia").removeClass("isError");
    $("#slcTipoLicencia").addClass("isOk");
  }
  if(existeError){
		mostrarAviso("Faltan capturar algunos campos.");
    return false;
  }

	mostrarEspera("Registrando información...");
    			xajax_guardar(    					
    					txtNombre,
    					formatoSF001,
    					examenTransito,
    					identificacionOficial,
    					comprobanteDomicilio,
    					curp,
    					rfc,
    					actaNacimiento,
    					polizaSeguro,
    					cartaResponsiva,
    					identificacionPadreTutor,
    					formatoMigratorio,
    					constanciaLicenciaVigente,
              licenciaAnterior,
              slcTipoLicencia);
}

var inicializarControles=function()
	{	

  	 $("#btnGuardar").click(guardar);  

  	
	};
	$(document).ready(function(){inicializarControles()});