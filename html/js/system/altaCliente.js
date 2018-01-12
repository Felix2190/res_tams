  	
    	var cambioMunicipioCPC=function(cveEstado,cveMunicipio)
    	{	
    		var cp=$("#CPC").val().trim();
    		mostrarEspera("Cargando localidades...");
    		xajax_cambioMunicipioC(cveEstado,cveMunicipio);
    		xajax_asentamientosCPC(cveEstado,cveMunicipio,cp);
    		
    		return;
    	};    	    	
    	
    	var cambioMunicipioCPF=function(cveEstado,cveMunicipio)
    	{	
    		var cp=$("#CPF").val().trim();
    		mostrarEspera("Cargando localidades...");
    		xajax_cambioMunicipioF(cveEstado,cveMunicipio);
    		xajax_asentamientosCPF(cveEstado,cveMunicipio,cp);
    		
    		return;
    	};
    	
    	var cambioEstadoC = function() {
    		var cveEstado = $("#estadoC").val().trim();

    		if (cveEstado == "0") {
    			$("#municipioC").html(
    					'<option value="">Selecciona un estado.</option>')
    			$("#coloniaC").html(
    					'<option value="">Selecciona un municipio.</option>')
    			return;
    		}
    		mostrarEspera("Cargando ciudades/delegaciones...");
    		xajax_cambioEstadoC(cveEstado);
    		return;
    	};
    	
    	var cambioEstadoF = function() {
    		var cveEstado = $("#estadoF").val().trim();

    		if (cveEstado == "0") {
    			$("#municipioF").html(
    					'<option value="">Selecciona un estado.</option>')
    			$("#coloniaF").html(
    					'<option value="">Selecciona un municipio.</option>')
    			return;
    		}
    		mostrarEspera("Cargando ciudades/delegaciones...");
    		xajax_cambioEstadoF(cveEstado);
    		return;
    	};

    	
    	var buscarCPC=function()
    	{	
    		var cp=$("#CPC").val().trim();
    		if(cp.length==5)
    		{
    			mostrarAviso("Buscando Código Postal");
    			xajax_buscarCPC(cp);
    			
    		}
    		return false;
    	};
    	
    	var buscarCPF=function()
    	{	
    		var cp=$("#CPF").val().trim();
    		if(cp.length==5)
    		{
    			mostrarAviso("Buscando Código Postal");
    			xajax_buscarCPF(cp);
    			
    		}
    		return false;
    	};
    	
    	var existeCodigo=false;
    	
    	var colocarDatosC=function(datos)
    	{
    		if(datos!=null)
    		{
    			$("#estadoC").attr("disabled","disabled");
    			$("municipioC").attr("disabled","disabled");
    			//$("#txtAsentamiento").removeAttr("disabled");
    			
    			$("#estadoC").val(datos.c_estado);
    			
    			$("#municipioC").empty();  			    			
    			$("#municipioC").append("<option value='"+datos.c_mnpio+"'>"+datos.municipio+"</option>");
          //$('#slcLocalidadAuto').val('');
          //$('#slcLocalidadAuto').show();
          //$('#slcLocalidadAuto').removeAttr('disabled');
    			cambioMunicipioCPC(datos.c_estado,datos.c_mnpio);
    			
    			//console.log(datos);
    			console.dir(datos);
    			existeCodigo=true;
    			//ocultarMensaje();
    			
    		}
    		else
    		{
    			$("#slcEstado").val("0");
    			$("#slcMunicipio").val("")
    			$("#slcLocalidad").val("")
    			
    			mostrarAviso("Sin coincidencias de Código Postal en base de datos.");
    			$("#slcEstado").removeAttr("disabled");
    			$("#slcMunicipio").removeAttr("disabled");
    			//$("#slcMunicipio").removeAttr("disabled");
    			existeCodigo=false;
    		}
    		//colocaCambioAutocompleteAsentamiento();
    	};
    	
    	var colocarDatosF=function(datos)
    	{
    		if(datos!=null)
    		{
    			$("#estadoF").attr("disabled","disabled");
    			$("municipioF").attr("disabled","disabled");
    			//$("#txtAsentamiento").removeAttr("disabled");
    			
    			$("#estadoF").val(datos.c_estado);
    			
    			$("#municipioF").empty();  			    			
    			$("#municipioF").append("<option value='"+datos.c_mnpio+"'>"+datos.municipio+"</option>");
          //$('#slcLocalidadAuto').val('');
          //$('#slcLocalidadAuto').show();
          //$('#slcLocalidadAuto').removeAttr('disabled');
    			cambioMunicipioCPF(datos.c_estado,datos.c_mnpio);
    			
    			//console.log(datos);
    			console.dir(datos);
    			existeCodigo=true;
    			//ocultarMensaje();
    			
    		}
    		else
    		{
    			$("#slcEstado").val("0");
    			$("#slcMunicipio").val("")
    			$("#slcLocalidad").val("")
    			
    			mostrarAviso("Sin coincidencias de Código Postal en base de datos.");
    			$("#slcEstado").removeAttr("disabled");
    			$("#slcMunicipio").removeAttr("disabled");
    			//$("#slcMunicipio").removeAttr("disabled");
    			existeCodigo=false;
    		}
    		//colocaCambioAutocompleteAsentamiento();
    	};
    	
    	
    	
    	var colocaCambioAutocompleteAsentamiento=function()
    	{
    		if(existeCodigo)
    			{
    				$("#txtAsentamiento").autocomplete({source:"getAsentamiento.php?cp=" + $("#txtCP").val().trim(),
    				minLength:4
    				});
    			}
    		else
    		{
    			$("#txtAsentamiento").autocomplete({source:"getAsentamiento.php?e=" + $("#slcEstado").val().trim()+"&m=" + $("#slcMunicipio").val().trim(),
    				minLength:4
    				});
    		}
    	};
    	
    	var cambioMunicipioC = function() {

    		var cveEstado = $("#estadoC").val().trim();
    		var cveMunicipio = $("#municipioC").val().trim();
    		
    		if (cveEstado == "0") {
    			$("#municipioC").html(
    					'<option value="">Selecciona un estado.</option>')
    			$("#coloniaC").html(
    					'<option value="">Selecciona un municipio.</option>')
    			return;
    		}else if (cveMunicipio == "0") {
    			$("#municipioC").html(
    					'<option value="">Selecciona un municipio.</option>')
    			$("#coloniaC").html(
    					'<option value="">Selecciona un colonia.</option>')
    			return;
    		}
    		mostrarEspera("Cargando ciudades/delegaciones...");
    		xajax_cambioMunicipioC(cveEstado,cveMunicipio);
    		return;
    	};
    	
    	var cambioMunicipioF=function()
    	{
    		var cveEstado = $("#estadoF").val().trim();
    		var cveMunicipio = $("#municipioF").val().trim();
    		
    		if (cveEstado == "0") {
    			$("#municipioF").html(
    					'<option value="">Selecciona un estado.</option>')
    			$("#coloniaF").html(
    					'<option value="">Selecciona un municipio.</option>')
    			return;
    		}else if (cveMunicipio == "0") {
    			$("#municipioF").html(
    					'<option value="">Selecciona un municipio.</option>')
    			$("#coloniaF").html(
    					'<option value="">Selecciona un colonia.</option>')
    			return;
    		}
    		mostrarEspera("Cargando ciudades/delegaciones...");
    		xajax_cambioMunicipioF(cveEstado,cveMunicipio);
    		return;
    	};
    	
    	var hacercopia = function(){
  		
  		if ($("#mismoDatos").is(":checked")){
  			
	  		$("#nombreF").val($("#nombreCF").val());
	  		$("#aPaternoF").val($("#aPaternoCF").val());
	  		$("#aMaternoF").val($("#aMaternoCF").val());
	  		$("#emailF").val($("#emailCF").val());
	  		$("#rSocialF").val($("#rSocialC").val());
	  		$("#paisF").val($("#paisC").val());
	  		$("#estadoF").val($("#estadoC").val());
	  		$("#CPF").val($("#CPC").val());
	  		//$("#ciudadF").val($("#ciudadC").val());	  		
	  		$("#municipioF").empty();  			    			
			$("#municipioF").append("<option value='"+$("#municipioC").val()+"'>"+$("#municipioC option:selected" ).text()+"</option>");
	  		//$( "#municipioC option:selected" ).text();
			$("#ciudadF").empty();
			$("#ciudadF").append("<option value='"+$("#ciudadC").val()+"'>"+$( "#ciudadC option:selected" ).text()+"</option>");
	  			  		
	  		$("#coloniaF").empty();
			$("#coloniaF").append("<option value='"+$("#coloniaC").val()+"'>"+$( "#coloniaC option:selected" ).text()+"</option>");
			
	  		$("#calleF").val($("#calleC").val());
	  		$("#noExteriorF").val($("#noExteriorC").val());
	  		$("#noInteriorF").val($("#noInteriorC").val());
	  		$("#telefonoF").val($("#telefonoCF").val());
	  		$("#extensionF").val($("#extensionC").val());
	  		
	  		
	  		$("#LadaTelCasaF").val($("#LadaTelCasaCF").val());
	  		$("#txtLadaTelCasaF").val($("#txtLadaTelCasaCF").val());
	  		$("#txtTelCasaF").val($("#txtTelCasaCF").val());		 			  			  			  		
  			}
  		else{
//	  		$("#nombreF").val("");
//	  		$("#aPaternoF").val("");
//	  		$("#aMaternoF").val("");
//	  		$("#emailF").val("");
//	  		$("#rSocialF").val("");
//	  		$("#paisF").val("");
//	  		$("#estadoF").val("");
//	  		$("#CPF").val("");
//	  		$("#ciudadF").val("");
//	  		$("#municipioF").val("");
//	  		$("#coloniaF").val("");
//	  		$("#calleF").val("");
//	  		$("#noExteriorF").val("");
//	  		$("#noInteriorF").val("");
//	  		$("#telefonoF").val("");
//	  		$("#extensionF").val("");  		
//  		$("#LadaTelCasaF").val();
//	  		$("#txtLadaTelCasaF").val();
//	  		$("#txtTelCasaF").val();	
  			}
  	}
	
    	var guardar = function(){
    		var existeError=false;
    		
    		nombreC = $("#nombreC").val();
    		if(nombreC==""){
    			$(".nombreC").removeClass("isOk");
    			$(".nombreC").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".nombreC").removeClass("isError");
    			$(".nombreC").addClass("isOk");
    		}
    		aPaternoC = $("#aPaternoC").val();
    		if(aPaternoC==""){
    			$(".aPaternoC").removeClass("isOk");
    			$(".aPaternoC").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".aPaternoC").removeClass("isError");
    			$(".aPaternoC").addClass("isOk");
    		}
    		aMaternoC = $("#aMaternoC").val();
    		if(aMaternoC==""){
    			$(".aMaternoC").removeClass("isOk");
    			$(".aMaternoC").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".aMaternoC").removeClass("isError");
    			$(".aMaternoC").addClass("isOk");
    		}
    		emailC = $("#emailC").val();
    		if(emailC==""){
    			$(".emailC").removeClass("isOk");
    			$(".emailC").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".emailC").removeClass("isError");
    			$(".emailC").addClass("isOk");
    		}
    		rSocialC = $("#rSocialC").val();
    		if(rSocialC==""){
    			$(".rSocialC").removeClass("isOk");
    			$(".rSocialC").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".rSocialC").removeClass("isError");
    			$(".rSocialC").addClass("isOk");
    		}
    		paisC = $("#paisC").val();
    		if(paisC==""){
    			$(".paisC").removeClass("isOk");
    			$(".paisC").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".paisC").removeClass("isError");
    			$(".paisC").addClass("isOk");
    		}
    		estadoC = $("#estadoC").val();
    		if(estadoC==""){
    			$(".estadoC").removeClass("isOk");
    			$(".estadoC").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".estadoC").removeClass("isError");
    			$(".estadoC").addClass("isOk");
    		}
    		CPC = $("#CPC").val();
    		if(CPC==""){
    			$(".CPC").removeClass("isOk");
    			$(".CPC").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".CPC").removeClass("isError");
    			$(".CPC").addClass("isOk");
    		}
    		ciudadC = $("#ciudadC").val();
    		if(ciudadC==""){
    			$(".ciudadC").removeClass("isOk");
    			$(".ciudadC").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".ciudadC").removeClass("isError");
    			$(".ciudadC").addClass("isOk");
    		}
    		municipioC = $("#municipioC").val();
    		if(municipioC==""){
    			$(".municipioC").removeClass("isOk");
    			$(".municipioC").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".municipioC").removeClass("isError");
    			$(".municipioC").addClass("isOk");
    		}
    		coloniaC = $("#coloniaC").val();
    		if(coloniaC==""){
    			$(".coloniaC").removeClass("isOk");
    			$(".coloniaC").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".coloniaC").removeClass("isError");
    			$(".coloniaC").addClass("isOk");
    		}
    		calleC = $("#calleC").val();
    		if(calleC==""){
    			$(".calleC").removeClass("isOk");
    			$(".calleC").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".calleC").removeClass("isError");
    			$(".calleC").addClass("isOk");
    		}
    		noExteriorC = $("#noExteriorC").val();
    		if(noExteriorC==""){
    			$(".noExteriorC").removeClass("isOk");
    			$(".noExteriorC").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".noExteriorC").removeClass("isError");
    			$(".noExteriorC").addClass("isOk");
    		}
    		noInteriorC = $("#noInteriorC").val();
//    		if(noInteriorC==""){
//    			$(".noInteriorC").removeClass("isOk");
//    			$(".noInteriorC").addClass("isError");
//    			existeError=true;
//    		}
//    		else{
//    			$(".noInteriorC").removeClass("isError");
//    			$(".noInteriorC").addClass("isOk");
//    		}
//    		telefonoC = $("#telefonoC").val();
//    		if(telefonoC==""){
//    			$(".telefonoC").removeClass("isOk");
//    			$(".telefonoC").addClass("isError");
//    			existeError=true;
//    		}
//    		else{
//    			$(".telefonoC").removeClass("isError");
//    			$(".telefonoC").addClass("isOk");
//    		}
    		extensionC = $("#extensionC").val();
//    		if(extensionC==""){
//    			$(".extensionC").removeClass("isOk");
//    			$(".extensionC").addClass("isError");
//    			existeError=true;
//    		}
//    		else{
//    			$(".extensionC").removeClass("isError");
//    			$(".extensionC").addClass("isOk");
//    		}
    		//select
    		paisC = $("#paisC").val();
    		if(paisC=="" || paisC==0){
    			existeError=true;
    			$(".paisC").removeClass("isOk");
    		    $(".paisC").addClass("isError");
    		}else {
    			$(".paisC").removeClass("isError");
    		    $(".paisC").addClass("isOk");
    		}
    		estadoC = $("#estadoC").val();
    		if(estadoC=="" || estadoC==0){
    			existeError=true;
    			$(".noestadoC").removeClass("isOk");
    		    $(".estadoC").addClass("isError");
    		}else {
    			$(".estadoC").removeClass("isError");
    		    $(".estadoC").addClass("isOk");
    		}
    		municipioC = $("#municipioC").val();
    		if(municipioC=="" || municipioC==0){
    			existeError=true;
    			$(".nombrmunicipioC").removeClass("isOk");
    		    $(".municipioC").addClass("isError");
    		}else {
    			$(".municipioC").removeClass("isError");
    		    $(".municipioC").addClass("isOk");
    		}
    		ciudadC = $("#ciudadC").val();
    		if(ciudadC=="" || ciudadC==0){
    			existeError=true;
    			$(".nociudadC").removeClass("isOk");
    		    $(".ciudadC").addClass("isError");
    		}else {
    			$(".ciudadC").removeClass("isError");
    		    $(".ciudadC").addClass("isOk");
    		}
    		ciudadC
    		coloniaC = $("#coloniaC").val();
    		if(coloniaC=="" || coloniaC==0){
    			existeError=true;
    			$(".nomcoloniaC").removeClass("isOk");
    		    $(".coloniaC").addClass("isError");
    		}else {
    			$(".coloniaC").removeClass("isError");
    		    $(".coloniaC").addClass("isOk");
    		}
    		LadaTelCasaC = $("#LadaTelCasaC").val();
    		var telCasaAreaC=$("#txtLadaTelCasaC").val();    		
    		var telCasaNumeroC=$("#txtTelCasaC").val();
    		if(telCasaAreaC != null)
    			telCasaAreaC = telCasaAreaC.trim();
    		if(telCasaNumeroC != null)
    			telCasaNumeroC = telCasaNumeroC.trim();
    		var exCasa=telCasaAreaC.length+telCasaNumeroC.length
    		
    		if(exCasa!=0&&exCasa!=10)
    		{
    			if(telCasaAreaC.length!=2&&telCasaAreaC.length!=3)
    				mostrarAviso("El código de area de teléfono de casa es incorrecto.");
    			if(telCasaAreaC.length==2&&telCasaNumero.length!=8)
    				mostrarAviso("El número de teléfono de casa es incorrecto.");
    			if(telCasaAreaC.length==3&&telCasaNumero.length!=7)
    				mostrarAviso("El número de teléfono de casa es incorrecto.");
    			return false;
    		}else{
//    			$(".txtLadaTelCasaC").removeClass("isOk");
//    		    $(".txtLadaTelCasaC").addClass("isError");
//    		    $(".txtTelCasaC").removeClass("isOk");
//    		    $(".txtTelCasaC").addClass("isError");
    		}
    		////facturacion /////////////////
    		nombreF = $("#nombreF").val();
    		if(nombreF==""){
    			$(".nombreF").removeClass("isOk");
    			$(".nombreF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".nombreF").removeClass("isError");
    			$(".nombreF").addClass("isOk");
    		}
    		aPaternoF = $("#aPaternoF").val();
    		if(aPaternoF==""){
    			$(".aPaternoF").removeClass("isOk");
    			$(".aPaternoF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".aPaternoF").removeClass("isError");
    			$(".aPaternoF").addClass("isOk");
    		}
    		aMaternoF = $("#aMaternoF").val();
    		if(aMaternoF==""){
    			$(".aMaternoF").removeClass("isOk");
    			$(".aMaternoF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".aMaternoF").removeClass("isError");
    			$(".aMaternoF").addClass("isOk");
    		}
    		emailF = $("#emailF").val();
    		if(emailF==""){
    			$(".emailF").removeClass("isOk");
    			$(".emailF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".emailF").removeClass("isError");
    			$(".emailF").addClass("isOk");
    		}
    		rSocialF = $("#rSocialF").val();
    		if(rSocialF==""){
    			$(".rSocialF").removeClass("isOk");
    			$(".rSocialF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".rSocialF").removeClass("isError");
    			$(".rSocialF").addClass("isOk");
    		}
    		paisF = $("#paisF").val();
    		if(paisF==""){
    			$(".paisF").removeClass("isOk");
    			$(".paisF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".paisF").removeClass("isError");
    			$(".paisF").addClass("isOk");
    		}
    		estadoF = $("#estadoF").val();
    		if(estadoF==""){
    			$(".estadoF").removeClass("isOk");
    			$(".estadoF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".estadoF").removeClass("isError");
    			$(".estadoF").addClass("isOk");
    		}
    		CPF = $("#CPF").val();
    		if(CPF==""){
    			$(".CPF").removeClass("isOk");
    			$(".CPF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".CPF").removeClass("isError");
    			$(".CPF").addClass("isOk");
    		}
    		ciudadF = $("#ciudadF").val();
    		if(ciudadF==""){
    			$(".ciudadF").removeClass("isOk");
    			$(".ciudadF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".ciudadF").removeClass("isError");
    			$(".ciudadF").addClass("isOk");
    		}
    		municipioF = $("#municipioF").val();
    		if(municipioF==""){
    			$(".municipioF").removeClass("isOk");
    			$(".municipioF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".municipioF").removeClass("isError");
    			$(".municipioF").addClass("isOk");
    		}
    		coloniaF = $("#coloniaF").val();
    		if(coloniaF==""){
    			$(".coloniaF").removeClass("isOk");
    			$(".coloniaF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".coloniaF").removeClass("isError");
    			$(".coloniaF").addClass("isOk");
    		}
    		calleF = $("#calleF").val();
    		if(calleF==""){
    			$(".calleF").removeClass("isOk");
    			$(".calleF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".calleF").removeClass("isError");
    			$(".calleF").addClass("isOk");
    		}
    		noExteriorF = $("#noExteriorF").val();
    		if(noExteriorF==""){
    			$(".noExteriorF").removeClass("isOk");
    			$(".noExteriorF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".noExteriorF").removeClass("isError");
    			$(".noExteriorF").addClass("isOk");
    		}
    		noInteriorF = $("#noInteriorF").val();
//    		if(noInteriorF==""){
//    			$(".noInteriorF").removeClass("isOk");
//    			$(".noInteriorF").addClass("isError");
//    			existeError=true;
//    		}
//    		else{
//    			$(".noInteriorF").removeClass("isError");
//    			$(".noInteriorF").addClass("isOk");
//    		}
//    		telefonoF = $("#telefonoF").val();
//    		if(telefonoF==""){
//    			$(".telefonoF").removeClass("isOk");
//    			$(".telefonoF").addClass("isError");
//    			existeError=true;
//    		}
//    		else{
//    			$(".telefonoF").removeClass("isError");
//    			$(".telefonoF").addClass("isOk");
//    		}
    		extensionF = $("#extensionF").val();
//    		if(extensionF==""){
//    			$(".extensionF").removeClass("isOk");
//    			$(".extensionF").addClass("isError");
//    			existeError=true;
//    		}
//    		else{
//    			$(".extensionF").removeClass("isError");
//    			$(".extensionF").addClass("isOk");
//    		}
    		//select
    		paisF = $("#paisF").val();
    		if(paisF=="" || paisF==0){
    			existeError=true;
    			$(".paisF").removeClass("isOk");
    		    $(".paisF").addClass("isError");
    		}else {
    			$(".paisF").removeClass("isError");
    		    $(".paisF").addClass("isOk");
    		}
    		estadoF = $("#estadoF").val();
    		if(estadoF=="" || estadoF==0){
    			existeError=true;
    			$(".noestadoF").removeClass("isOk");
    		    $(".estadoF").addClass("isError");
    		}else {
    			$(".estadoF").removeClass("isError");
    		    $(".estadoF").addClass("isOk");
    		}
    		municipioF = $("#municipioF").val();
    		if(municipioF=="" || municipioF==0){
    			existeError=true;
    			$(".nombrmunicipioF").removeClass("isOk");
    		    $(".municipioF").addClass("isError");
    		}else {
    			$(".municipioF").removeClass("isError");
    		    $(".municipioF").addClass("isOk");
    		}
    		ciudad = $("#ciudad").val();
    		if(ciudad=="" || ciudad==0){
    			existeError=true;
    			$(".nociudad").removeClass("isOk");
    		    $(".ciudad").addClass("isError");
    		}else {
    			$(".ciudad").removeClass("isError");
    		    $(".ciudad").addClass("isOk");
    		}
    		
    		coloniaF = $("#coloniaF").val();
    		if(coloniaF=="" || coloniaF==0){
    			existeError=true;
    			$(".nomcoloniaF").removeClass("isOk");
    		    $(".coloniaF").addClass("isError");
    		}else {
    			$(".coloniaF").removeClass("isError");
    		    $(".coloniaF").addClass("isOk");
    		}
    		LadaTelCasaF = $("#LadaTelCasaF").val();
    		var telCasaAreaF=$("#txtLadaTelCasaF").val();
    		var telCasaNumeroF=$("#txtTelCasaF").val();
    		if(telCasaAreaF != null)
    			telCasaAreaF = telCasaAreaF.trim();
    		if(telCasaNumeroF != null)
    			telCasaNumeroF = telCasaNumeroF.trim();
    		var exCasa=telCasaAreaF.length+telCasaNumeroF.length
    		
    		if(exCasa!=0&&exCasa!=10)
    		{
    			if(telCasaAreaF.length!=2&&telCasaAreaF.length!=3)
    				mostrarAviso("El código de area de teléfono de casa es incorrecto.");
    			if(telCasaAreaF.length==2&&telCasaNumeroF.length!=8)
    				mostrarAviso("El número de teléfono de casa es incorrecto.");
    			if(telCasaAreaF.length==3&&telCasaNumeroF.length!=7)
    				mostrarAviso("El número de teléfono de casa es incorrecto.");
    			return false;
    		}else{
//    			$(".txtLadaTelCasaF").removeClass("isOk");
//    		    $(".txtLadaTelCasaF").addClass("isError");
//    		    $(".txtTelCasaF").removeClass("isOk");
//    		    $(".txtTelCasaF").addClass("isError");
    		}
    		
    		RFC = $("#RFC").val();
    		if(RFC==""){
    			$(".RFC").removeClass("isOk");
    			$(".RFC").addClass("isError");
    			existeError=true;
    		}
    		else{
    			if(RFC.length >12){
    			$(".RFC").removeClass("isError");
    			$(".RFC").addClass("isOk");
    			}
    			else{
    				$(".RFC").removeClass("isOk");
        			$(".RFC").addClass("isError");
        			existeError=true;
    			}
    		}
    		
    		
    		LadaTelCasaCA = $("#LadaTelCasaCA").val();
    		if(LadaTelCasaCA==""){
    			$(".LadaTelCasaCA").removeClass("isOk");
    			$(".LadaTelCasaCA").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".LadaTelCasaCA").removeClass("isError");
    			$(".LadaTelCasaCA").addClass("isOk");
    		}
    		txtLadaTelCasaCA = $("#txtLadaTelCasaCA").val();
    		if(txtLadaTelCasaCA==""){
    			$(".txtLadaTelCasaCA").removeClass("isOk");
    			$(".txtLadaTelCasaCA").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".txtLadaTelCasaCA").removeClass("isError");
    			$(".txtLadaTelCasaCA").addClass("isOk");
    		}
    		txtTelCasaCA = $("#txtTelCasaCA").val();
    		if(txtTelCasaCA==""){
    			$(".txtTelCasaCA").removeClass("isOk");
    			$(".txtTelCasaCA").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".txtTelCasaCA").removeClass("isError");
    			$(".txtTelCasaCA").addClass("isOk");
    		}

    		nombreCF = $("#nombreCF").val();
    		if(nombreCF==""){
    			$(".nombreCF").removeClass("isOk");
    			$(".nombreCF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".nombreCF").removeClass("isError");
    			$(".nombreCF").addClass("isOk");
    		}
    		aPaternoCF = $("#aPaternoCF").val();
    		if(aPaternoCF==""){
    			$(".aPaternoCF").removeClass("isOk");
    			$(".aPaternoCF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".aPaternoCF").removeClass("isError");
    			$(".aPaternoCF").addClass("isOk");
    		}
    		aMaternoCF = $("#aMaternoCF").val();
    		if(aMaternoCF==""){
    			$(".aMaternoCF").removeClass("isOk");
    			$(".aMaternoCF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".aMaternoCF").removeClass("isError");
    			$(".aMaternoCF").addClass("isOk");
    		}
    		emailCF = $("#emailCF").val();
    		if(emailCF==""){
    			$(".emailCF").removeClass("isOk");
    			$(".emailCF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".emailCF").removeClass("isError");
    			$(".emailCF").addClass("isOk");
    		}
    		LadaTelCasaCF = $("#LadaTelCasaCF").val();
    		if(LadaTelCasaCF==""){
    			$(".LadaTelCasaCF").removeClass("isOk");
    			$(".LadaTelCasaCF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".LadaTelCasaCF").removeClass("isError");
    			$(".LadaTelCasaCF").addClass("isOk");
    		}
    		txtLadaTelCasaCF = $("#txtLadaTelCasaCF").val();
    		if(txtLadaTelCasaCF==""){
    			$(".txtLadaTelCasaCF").removeClass("isOk");
    			$(".txtLadaTelCasaCF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".txtLadaTelCasaCF").removeClass("isError");
    			$(".txtLadaTelCasaCF").addClass("isOk");
    		}
    		txtTelCasaCF = $("#txtTelCasaCF").val();
    		if(txtTelCasaCF==""){
    			$(".txtTelCasaCF").removeClass("isOk");
    			$(".txtTelCasaCF").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".txtTelCasaCF").removeClass("isError");
    			$(".txtTelCasaCF").addClass("isOk");
    		}

    		nombreCT = $("#nombreCT").val();
    		if(nombreCT==""){
    			$(".nombreCT").removeClass("isOk");
    			$(".nombreCT").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".nombreCT").removeClass("isError");
    			$(".nombreCT").addClass("isOk");
    		}
    		aPaternoCT = $("#aPaternoCT").val();
    		if(aPaternoCT==""){
    			$(".aPaternoCT").removeClass("isOk");
    			$(".aPaternoCT").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".aPaternoCT").removeClass("isError");
    			$(".aPaternoCT").addClass("isOk");
    		}
    		aMaternoCT = $("#aMaternoCT").val();
    		if(aMaternoCT==""){
    			$(".aMaternoCT").removeClass("isOk");
    			$(".aMaternoCT").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".aMaternoCT").removeClass("isError");
    			$(".aMaternoCT").addClass("isOk");
    		}
    		emailCT = $("#emailCT").val();
    		if(emailCT==""){
    			$(".emailCT").removeClass("isOk");
    			$(".emailCT").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".emailCT").removeClass("isError");
    			$(".emailCT").addClass("isOk");
    		}
    		txtLadaTelCasaCT = $("#txtLadaTelCasaCT").val();
    		if(txtLadaTelCasaCT==""){
    			$(".txtLadaTelCasaCT").removeClass("isOk");
    			$(".txtLadaTelCasaCT").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".txtLadaTelCasaCT").removeClass("isError");
    			$(".txtLadaTelCasaCT").addClass("isOk");
    		}
    		LadaTelCasaCT = $("#LadaTelCasaCT").val();
    		if(LadaTelCasaCT==""){
    			$(".LadaTelCasaCT").removeClass("isOk");
    			$(".LadaTelCasaCT").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".LadaTelCasaCT").removeClass("isError");
    			$(".LadaTelCasaCT").addClass("isOk");
    		}
    		txtLadaTelCasaCT = $("#txtLadaTelCasaCT").val();
    		if(txtLadaTelCasaCT==""){
    			$(".txtLadaTelCasaCT").removeClass("isOk");
    			$(".txtLadaTelCasaCT").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".txtLadaTelCasaCT").removeClass("isError");
    			$(".txtLadaTelCasaCT").addClass("isOk");
    		}
    		txtTelCasaCT = $("#txtTelCasaCT").val();
    		if(txtTelCasaCT==""){
    			$(".txtTelCasaCT").removeClass("isOk");
    			$(".txtTelCasaCT").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".txtTelCasaCT").removeClass("isError");
    			$(".txtTelCasaCT").addClass("isOk");
    		}
    		
    		usuario = $("#usuario").val();
    		if(usuario==""){
    			$(".usuario").removeClass("isOk");
    			$(".usuario").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".usuario").removeClass("isError");
    			$(".usuario").addClass("isOk");
    		}

    		password = $("#password").val();
    		if(password==""){
    			$(".password").removeClass("isOk");
    			$(".password").addClass("isError");
    			existeError=true;
    		}
    		else{
    			$(".password").removeClass("isError");
    			$(".password").addClass("isOk");
    		}	
    		
    		if(existeError)
				mostrarAviso("Faltan capturar algunos campos.");
    		else{
    			mostrarEspera("Registrando información...");
    			xajax_guardar(    					
    					nombreC,
    					aPaternoC,
    					aMaternoC,
    					emailC,
    					rSocialC,
    					paisC,
    					estadoC,
    					CPC,
    					municipioC,
    					ciudadC,
    					coloniaC,
    					calleC,
    					noExteriorC,
    					noInteriorC,
    					LadaTelCasaC,
    					telCasaAreaC,
    					telCasaNumeroC,
    					extensionC,
    					nombreF,
    					aPaternoF,
    					aMaternoF,
    					emailF,
    					rSocialF,
    					paisF,
    					estadoF,
    					CPF,
    					municipioF,
    					ciudadF,
    					coloniaF,
    					calleF,
    					noExteriorF,
    					noInteriorF,
    					LadaTelCasaF,
    					telCasaAreaF,
    					telCasaNumeroF,
    					extensionF,RFC,LadaTelCasaCA,
    					txtLadaTelCasaCA,
    					txtTelCasaCA,
    					nombreCF,
    					aPaternoCF,
    					aMaternoCF,
    					emailCF,
    					LadaTelCasaCF,
    					txtLadaTelCasaCF,
    					txtTelCasaCF,
    					nombreCT,
    					aPaternoCT,
    					aMaternoCT,
    					emailCT,
    					LadaTelCasaCT,
    					txtLadaTelCasaCT,    					
    					txtLadaTelCasaCT,
    					txtTelCasaCT,
    					usuario, 
    					password);
    		
    	}
    }
    	var inicializarControles=function()
	{	
		//$("#btnBuscar").click(buscador);
		$("#estadoC").change(cambioEstadoC);
		$("#estadoF").change(cambioEstadoF);
		$("#municipioC").change(cambioMunicipioC);
		$("#municipioF").change(cambioMunicipioF);
		$(".numeric").numeric({integers:true,negative : false});
		
		$("#txtCP").change(function(){existeCodigo=false;});
		$("#btnBuscarCPC").click(buscarCPC);
		$("#btnBuscarCPF").click(buscarCPF);
		$("#mismoDatos").click(hacercopia);
		$("#btnGuardar").click(guardar);

	};
	//Se utiliza para que el campo de texto solo acepte letras
	function soloLetras(e) {
	    key = e.keyCode || e.which;
	    tecla = String.fromCharCode(key).toString();
	    //letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";//Se define todo el abecedario que se quiere que se muestre.
	    letras = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";//Se define todo el abecedario que se quiere que se muestre.
	    especiales = [8, 37, 39, 46, 6]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

	    tecla_especial = false
	    for(var i in especiales) {
	        if(key == especiales[i]) {
	            tecla_especial = true;
	            break;
	        }
	    }

	    if(letras.indexOf(tecla) == -1 && !tecla_especial){
	//alert('Tecla no aceptada');
	        return false;
	      }
	}
	
	$(document).ready(function(){inicializarControles()});
	
	
