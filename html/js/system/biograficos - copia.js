//Se utiliza para que el campo de texto solo acepte letras
	function guardarTab1(){
		var mailError=true;
		existeError = false;
		var txtIdTurno = $("#txtIdTurno").val().trim();
//		 alert(txtIdTurno);
		var txtApellidoPaterno = $("#txtApellidoPaterno").val().trim();
		if (txtApellidoPaterno == "") {
			existeError = true;
			console.log("Error: txtApellidoPaterno");
			$(".txtApellidoPaterno").removeClass("isOk");
			$(".txtApellidoPaterno").addClass("isError");
		} else {
			$(".txtApellidoPaterno").removeClass("isError");
		}
		
		var txtApellidoMaterno = $("#txtApellidoMaterno").val().trim();
		if (txtApellidoMaterno == "") {
			existeError = true;
			console.log("Error: txtApellidoMaterno");
			$(".txtApellidoMaterno").removeClass("isOk");
			$(".txtApellidoMaterno").addClass("isError");
		} else {
			$(".txtApellidoMaterno").removeClass("isError");
		}
		
		var txtNombres = $("#txtNombres").val().trim();
		if (txtNombres == "") {
			existeError = true;
			console.log("Error: txtApellidoPaterno");
			$(".txtNombres").removeClass("isOk");
			$(".txtNombres").addClass("isError");
		} else {
			$(".txtNombres").removeClass("isError");
		}
		
		var txtNombre2 = $("#txtNombres2").val().trim();
		if (txtNombre2 == "") {
			existeError = true;
			console.log("Error: tx");
			$(".txtNombres2").removeClass("isOk");
			$(".txtNombres2").addClass("isError");
		} else {
			$(".txtNombres2").removeClass("isError");
		}
		
		var slcGenero = $("#slcGenero").val().trim();
		if (slcGenero == "") {
			existeError = true;
			console.log("Error: slcGenero");
			$(".slcGenero").removeClass("isOk");
			$(".slcGenero").addClass("isError");
		} else {
			$(".slcGenero").removeClass("isError");
		}			
		
		
		var slcNacionalidad = $("#slcNacionalidad").val().trim();
		if (slcNacionalidad == "") {
			existeError = true;
			console.log("Error: slcNacionalidad");
			$(".slcNacionalidad").removeClass("isOk");
			$(".slcNacionalidad").addClass("isError");
		} else {
			$(".slcNacionalidad").removeClass("isError");
		}
		
		var txtNacimiento = $("#txtNacimiento").val().trim();
		if (txtNacimiento == "") {
			existeError = true;
			console.log("Error: txtNacimiento");
			$(".txtNacimiento").removeClass("isOk");
			$(".txtNacimiento").addClass("isError");
		} else {
			$(".txtNacimiento").removeClass("isError");
		}
		
		var txtCorreoE = $("#txtCorreoE").val().trim();
		if (txtCorreoE == "") {
			existeError = true;
			console.log("Error: txtCorreoE");
			$(".txtCorreoE").removeClass("isOk");
			$(".txtCorreoE").addClass("isError");
		} else if(!validateEmail(txtCorreoE)){
			mailError = true;
			console.log("Error: txtCorreoE");
			$(".txtCorreoE").removeClass("isOk");
			$(".txtCorreoE").addClass("isError");
			
		}else{
			mailError = false;
			$(".txtCorreoE").removeClass("isError");
		}
		

		
		if(existeError){
			mostrarAviso("Algunos campos no estan completos, valide las etiquetas en rojo");
			return ;
		}else{
		

		if(mailError){
			mostrarAviso("El formato del correo no es valido.");
			return ;
		}
	
		
		else{
/*			curp = generaCurp({
			  nombre            : txtNombres,
			  apellido_paterno  : txtApellidoPaterno,
			  apellido_materno  : txtApellidoMaterno,
			  sexo              : slcGenero,
			  estado            : clavecurpestado(slcEntidad),
			  fecha_nacimiento  : [txtNacimiento.substr(8, 2), txtNacimiento.substr(5, 2), txtNacimiento.substr(0, 4) ]
			});
	*/	
//			rfc =calcula(txtApellidoPaterno,txtApellidoMaterno,txtNombres,txtNacimiento.substr(2, 2)+txtNacimiento.substr(5, 2)+txtNacimiento.substr(8, 2))
			mostrarEspera('Guardando informaci&oacute;n, turno ' +txtIdTurno);
			
			
			xajax_guardarTab1(txtApellidoPaterno,txtApellidoMaterno,txtNombres, txtNombre2, txtNacimiento,slcGenero,slcNacionalidad ,txtCorreoE,
					txtIdTurno);
			
		
		}
		}
	}
	
	
	function guardarTab3(){
		existeError = false;
		var txtIdTurno = $("#txtIdTurno").val().trim();
		
		var slcColorOjos = $("#slcColorOjos").val().trim();
		if (slcColorOjos == "") {
			existeError = true;
			console.log("Error: slcColorOjos");
			$(".slcColorOjos").removeClass("isOk");
			$(".slcColorOjos").addClass("isError");
		} else {
			$(".slcColorOjos").removeClass("isError");
		}
		
		var slcColorPelo = $("#slcColorPelo").val().trim();
		if (slcColorPelo == "") {
			existeError = true;
			console.log("Error: slcColorPelo");
			$(".slcColorPelo").removeClass("isOk");
			$(".slcColorPelo").addClass("isError");
		} else {
			$(".slcColorPelo").removeClass("isError");
		}
		
		var slcTipoSandre = $("#slcTipoSandre").val().trim();
		if (slcTipoSandre == "") {
			existeError = true;
			console.log("Error: slcTipoSandre");
			$(".slcTipoSandre").removeClass("isOk");
			$(".slcTipoSandre").addClass("isError");
		} else {
			$(".slcTipoSandre").removeClass("isError");
		}
		
		
		var txtPesoKG = $("#txtPesoKG").val().trim();
		if (txtPesoKG == "") {
			existeError = true;
			console.log("Error: txtPesoKG");
			$(".txtPesoKG").removeClass("isOk");
			$(".txtPesoKG").addClass("isError");
		} else {
			$(".txtPesoKG").removeClass("isError");
		}
		
		var txtSenas = $("#txtParticulares").val().trim();
		
		if(existeError){
			mostrarAviso("Algunos campos no estan completos, valide las etiquetas en rojo");
		}
		else{
			mostrarEspera('Guardando informaci&oacute;n del turno '+txtIdTurno);
			
			$("#divMsjTab2").hide();
			
			xajax_guardarTab2(slcColorOjos ,slcColorPelo ,slcTipoSandre ,txtPesoKG, txtSenas,txtIdTurno);
		
		}
	}
	
	function guardarTab2(){
		existeError = false;
		
		var txtIdTurno = $("#txtIdTurno").val().trim();
		
		var txtCP = $("#txtCP").val().trim();
		if (txtCP == "") {
			existeError = true;
			console.log("Error: txtCP");
			$(".txtCP").removeClass("isOk");
			$(".txtCP").addClass("isError");
		} else {
			$(".txtCP").removeClass("isError");
		}

		var slcEstado = $("#slcEstadoDom").val().trim();
		if (slcEstado == "") {
			existeError = true;
			console.log("Error: slcEstado");
			$(".slcEstadoDom").removeClass("isOk");
			$(".slcEstadoDom").addClass("isError");
		} else {
			$(".slcEstadoDom").removeClass("isError");
		}
		
		var slcMunicipioDom = $("#slcMunicipioDomicilio").val().trim();
		if (slcMunicipioDom == "") {
			existeError = true;
			console.log("Error: slcMunicipio");
			$(".slcMunicipioDomicilio").removeClass("isOk");
			$(".slcMunicipioDomicilio").addClass("isError");
		} else {
			$(".slcMunicipioDomicilio").removeClass("isError");
		}
		
		var slcLocalidad = $("#slcLocalidad").val().trim();
		
		if (slcLocalidad == "") {
			existeError = true;
			console.log("Error: slcLocalidad");
			$(".slcLocalidad").removeClass("isOk");
			$(".slcLocalidad").addClass("isError");
		} else {
			$(".slcLocalidad").removeClass("isError");
		}
		
		var slcColonia = $("#slcColonia").val().trim();
		if (slcColonia == "") {
			existeError = true;
			console.log("Error: slcColonia");
			$(".slcColonia").removeClass("isOk");
			$(".slcColonia").addClass("isError");
		} else {
			$(".slcColonia").removeClass("isError");
		}

		var txtCalle = $("#txtCalle").val().trim();
		if (txtCalle == "") {
			existeError = true;
			console.log("Error: txtCalle");
			$(".txtCalle").removeClass("isOk");
			$(".txtCalle").addClass("isError");
		} else {
			$(".txtCalle").removeClass("isError");
		}
		
		var txtNumExt = $("#txtNumExt").val().trim();
		if (txtNumExt == "") {
			existeError = true;
			console.log("Error: txtNumExt");
			$(".txtNumExt").removeClass("isOk");
			$(".txtNumExt").addClass("isError");
		} else {
			$(".txtNumExt").removeClass("isError");
		}		
		
		var txtNumInt = $("#txtNumInt").val().trim();
		if (txtNumInt == "") {
			existeError = true;
			console.log("Error: txtNumInt");
			$(".txtNumInt").removeClass("isOk");
			$(".txtNumInt").addClass("isError");
		} else {
			$(".txtNumInt").removeClass("isError");
		}		
		
		
		
		var txtCodigoPais = $("#txtCodPais").val().trim();
		if (txtCodigoPais == "") {
			existeError = true;
			console.log("Error: CodigoPais");
			$(".txtTelefono").removeClass("isOk");
			$(".txtTelefono").addClass("isError");
		}  else if(txtCodigoPais.length<2){
			existeError = true;
			$(".txtTelefono").removeClass("isOk");
			$(".txtTelefono").addClass("isError");
			mostrarError("El Codigo Pais debe contener 2 digitos.");
			return ;
		}else {
			$(".txtTelefono").removeClass("isError");
		}
		
		var txtLada = $("#txtLada").val().trim();
		if (txtLada == "") {
			existeError = true;
			console.log("Error: CodigoPais");
			$(".txtTelefono").removeClass("isOk");
			$(".txtTelefono").addClass("isError");
		}  else if(txtLada.length<3){
			existeError = true;
			$(".txtTelefono").removeClass("isOk");
			$(".txtTelefono").addClass("isError");
			mostrarError("La Lada debe contener 3 digitos.");
			return ;
		}else {
			$(".txtTelefono").removeClass("isError");
		}
		
		var txtTelefono = $("#txtTelefono").val().trim();
		if (txtTelefono == "") {
			existeError = true;
			console.log("Error: txtTelefono");
			$(".txtTelefono").removeClass("isOk");
			$(".txtTelefono").addClass("isError");
		}  else if(txtTelefono.length<7){
			existeError = true;
			$(".txtTelefono").removeClass("isOk");
			$(".txtTelefono").addClass("isError");
			mostrarError("El número de teléfono debe contener 10 digitos.");
			return ;
		}else {
			$(".txtTelefono").removeClass("isError");
		}
		
		
		var txtTelefonoMobil = $("#txtTelefonoMobil").val().trim();
		if(txtTelefonoMobil != ""&&txtTelefonoMobil.length<10){
			existeError = true;
			$(".txtTelefonoMobil").removeClass("isOk");
			$(".txtTelefonoMobil").addClass("isError");
			mostrarError("El número de teléfono debe contener 10 digitos.");
			return ;
		}else {
			$(".txtTelefonoMobil").removeClass("isError");
		}


		if(existeError){
			mostrarAviso("Algunos campos no estan completos, valide las etiquetas en rojo");
		}
		else{
			if(txtCP.length<5){
				existeError = true;
				$(".txtCP").removeClass("isOk");
				$(".txtCP").addClass("isError");
				mostrarError("El C&oacute;digo Postal debe contener 5 digitos.");
				return ;
			}else{
			mostrarEspera('Guardando informaci&oacute;n del turno '+txtIdTurno);
			
			xajax_guardarTab2(slcEstado ,slcMunicipioDom,slcLocalidad,slcColonia,txtCalle ,
					txtNumExt, txtNumInt ,txtCP ,txtCodigoPais, txtLada,txtTelefono ,txtTelefonoMobil ,txtIdTurno);
			}
		}
	
		
	}
	
	function guardarTab4(){
		existeError = false;
		var txtIdTurno = $("#txtIdTurno").val().trim();
		
		var txtNombreContacto = $("#txtNombreContacto").val().trim();
		if (txtNombreContacto == "") {
			existeError = true;
			console.log("Error: txtNombreContacto");
			$(".txtNombreContacto").removeClass("isOk");
			$(".txtNombreContacto").addClass("isError");
		} else {
			$(".txtNombreContacto").removeClass("isError");
		}
		
		var slParentezcoContacto = $("#slParentezcoContacto").val().trim();
		if (slcLocalidad == "") {
			existeError = true;
			console.log("Error: slParentezcoContacto");
			$(".slParentezcoContacto").removeClass("isOk");
			$(".slParentezcoContacto").addClass("isError");
		} else {
			$(".slParentezcoContacto").removeClass("isError");
		}
		
		var slcEstadoContacto = $("#slcEstadoContacto").val().trim();
		if (slcEstadoContacto == "") {
			existeError = true;
			console.log("Error: slcEstadoContacto");
			$(".slcEstadoContacto").removeClass("isOk");
			$(".slcEstadoContacto").addClass("isError");
		} else {
			$(".slcEstadoContacto").removeClass("isError");
		}
		
		var slcMunicipioContacto = $("#slcMunicipioContacto").val().trim();
		if (slcMunicipioContacto == "" ) {
			existeError = true;
			console.log("Error: slcMunicipioContacto");
			$(".slcMunicipioContacto").removeClass("isOk");
			$(".slcMunicipioContacto").addClass("isError");
		} else {
			$(".slcMunicipioContacto").removeClass("isError");
		}
		
		
		var slcLocalidadContacto = $("#slcLocalidadContacto").val().trim();
		if (slcLocalidadContacto == "") {
			existeError = true;
			console.log("Error: slcLocalidadContacto");
			$(".slcLocalidadContacto").removeClass("isOk");
			$(".slcLocalidadContacto").addClass("isError");
		} else {
			$(".slcLocalidadContacto").removeClass("isError");
		}
		
		var txtCalleContacto = $("#txtCalleContacto").val().trim();
		if (txtCalleContacto == "") {
			existeError = true;
			console.log("Error: txtCalleContacto");
			$(".txtCalleContacto").removeClass("isOk");
			$(".txtCalleContacto").addClass("isError");
		} else {
			$(".txtCalleContacto").removeClass("isError");
		}
		
		var txtNumExtContacto = $("#txtNumExtContacto").val().trim();
		if (txtNumExtContacto == "") {
			existeError = true;
			console.log("Error: txtNumExtContacto");
			$(".txtNumExtContacto").removeClass("isOk");
			$(".txtNumExtContacto").addClass("isError");
		} else {
			$(".txtNumExtContacto").removeClass("isError");
		}
		
		var txtNumIntContacto = $("#txtNumIntContacto").val().trim();
		if (txtNumIntContacto == "") {
			existeError = true;
			console.log("Error: txtNumIntContacto");
			$(".txtNumIntContacto").removeClass("isOk");
			$(".txtNumInContacto").addClass("isError");
		} else {
			$(".txtNumIntContacto").removeClass("isError");
		}
		
		var txtColoniaContacto = $("#txtColoniaContacto").val().trim();
		if (txtColoniaContacto == "") {
			existeError = true;
			console.log("Error: txtColoniaContacto");
			$(".txtColoniaContacto").removeClass("isOk");
			$(".txtColoniaContacto").addClass("isError");
		} else {
			$(".txtColoniaContacto").removeClass("isError");
		}
		
		var txtCPContacto = $("#txtCPContacto").val().trim();
		if (txtCPContacto == "") {
			existeError = true;
			console.log("Error: txtCPContacto");
			$(".txtCPContacto").removeClass("isOk");
			$(".txtCPContacto").addClass("isError");
		}  else if(txtCPContacto.length<5){
			existeError = true;
			$(".txtCPContacto").removeClass("isOk");
			$(".txtCPContacto").addClass("isError");
			mostrarError("La CURP debe contener 5 digitos.");
			return ;
		}else {
			$(".txtCPContacto").removeClass("isError");
		}
		
		var txtTelefonoContacto = $("#txtTelefonoContacto").val().trim();
		if (txtTelefonoContacto == "") {
			existeError = true;
			console.log("Error: txtTelefonoContacto");
			$(".txtTelefonoContacto").removeClass("isOk");
			$(".txtTelefonoContacto").addClass("isError");
		} else if(txtTelefonoContacto.length<10){
			existeError = true;
			$(".txtTelefonoContacto").removeClass("isOk");
			$(".txtTelefonoContacto").addClass("isError");
			mostrarError("El número de teléfono debe contener 10 digitos.");
			return ;
		} else {
			$(".txtTelefonoContacto").removeClass("isError");
		}
		
		var txtObservaciones = $("#txtObservacionesContacto").val().trim();
		
		if(existeError){
			mostrarAviso("Algunos campos no estan completos, valide las etiquetas en rojo");
		}
		else{
			mostrarEspera('Guardando informaci&oacute;n del turno '+txtIdTurno);
			
			$("#divMsjTab4").hide();
			
			xajax_guardarTab4(txtNombreContacto ,slParentezcoContacto ,slcEstadoContacto, slcMunicipioContacto, slcLocalidadContacto ,txtCalleContacto ,
					txtNumExtContacto,txtNumIntContacto ,txtColoniaContacto ,txtCPContacto ,txtTelefonoContacto, txtObservaciones,txtIdTurno);
		
		}
	
		
	}
	
	function guardarTab5(){
		existeError = false;
		var txtIdTurno = $("#txtIdTurno").val().trim();

		var chkEsJubilado= $("#chkEsJubilado").prop('checked');
		
		var slcInstitucionjubilacion = $("#slcInstitucionjubilacion").val().trim();
		if (slcInstitucionjubilacion == "" && chkEsJubilado) {
			existeError = true;
			console.log("Error: slcInstitucionjubilacion");
			$(".slcInstitucionjubilacion").removeClass("isOk");
			$(".slcInstitucionjubilacion").addClass("isError");
		} else {
			$(".slcInstitucionjubilacion").removeClass("isError");
		}
		
		var txtNumJubilado = $("#txtNumJubilado").val().trim();
		if (txtNumJubilado == "" && chkEsJubilado) {
			existeError = true;
			console.log("Error: txtNumJubilado");
			$(".txtNumJubilado").removeClass("isOk");
			$(".txtNumJubilado").addClass("isError");
		} else {
			$(".txtNumJubilado").removeClass("isError");
		}
		
		var txtFechaAfiliacion = $("#txtFechaAfiliacion").val().trim();
		if (txtFechaAfiliacion == "" && chkEsJubilado) {
			existeError = true;
			console.log("Error: txtFechaAfiliacion");
			$(".txtFechaAfiliacion").removeClass("isOk");
			$(".txtFechaAfiliacion").addClass("isError");
		} else {
			$(".txtFechaAfiliacion").removeClass("isError");
		}
		
		var slcEstadoCivil = $("#slcEstadoCivil").val().trim();
		if (slcEstadoCivil == "") {
			existeError = true;
			console.log("Error: slcEstadoCivil");
			$(".slcEstadoCivil").removeClass("isOk");
			$(".slcEstadoCivil").addClass("isError");
		} else {
			$(".slcEstadoCivil").removeClass("isError");
		}
		
		
		var chkLentes = $('#chkLentes').prop('checked') ;
		var chkOrganos = $('#chkOrganos').prop('checked') ;
		var chkTransmision = $('#chkTransmisionAUtomatica').prop('checked') ;
		var chkVehiculo = $('#chkVehiculoDiscapacitado').prop('checked') ;
		var chkProtesis = $('#chkProtesis').prop('checked') ;

		if(existeError){
			mostrarAviso("Algunos campos no estan completos, valide las etiquetas en rojo");
		}
		else{
			mostrarEspera('Guardando informaci&oacute;n del turno '+txtIdTurno);
			
			$("#divMsjTab5").hide();
			
			xajax_guardarTab5(chkEsJubilado,slcInstitucionjubilacion,txtNumJubilado,txtFechaAfiliacion,slcEstadoCivil,
					chkLentes,chkOrganos,chkTransmision,chkVehiculo,chkProtesis,txtIdTurno);
	}
}
	
	function guardarTabTodo(){
		var txtIdTurno = $("#txtIdTurno").val().trim();
		xajax_guardarTodo(txtIdTurno);
}
	
	

	var cambioEntidadNacimiento = function() {
		var cveEstado = $("#slcEntidadNac").val().trim();

		if (cveEstado == "0" || cveEstado == "") {
			$("#slcMunicipioNac").html(
					'<option value="">Selecciona una opci&oacute;n.</option>')
			//$("#coloniaC").html(
			//		'<option value="">Selecciona un municipio.</option>')
			return;
		}
		mostrarEspera("Cargando ciudades...");
		xajax_cambioEntidad(cveEstado,"nacimiento");
		return;
	};
	
	//-----------------Domicilio------------/
	var cambioEntidadCont = function() {
		var cveEstado = $("#slcEstadoDom").val().trim();

		$("#slcMunicipioDomicilio").html(
		'<option value="">Selecciona una opci&oacute;n.</option>');
		mostrarEspera("Cargando municipios...");
		xajax_cambioEntidad(cveEstado);
		return;
	};
	
	var cambioMunicipioDomicilio = function() {
		var cveEstado = $("#slcEstadoDom").val().trim();
		var cveMunicipio = $("#slcMunicipioDomicilio").val().trim();
		
			$("#slcLocalidad").html(
					'<option value="">Selecciona una opci&oacute;n.</option>')
			$("#slcColonia").html(
					'<option value="">Selecciona una opci&oacute;n.</option>')
			 $("#txtCP").val('');
			 $("#txtCP").attr("disabled",false);

		$("slcColonia").attr("disabled",true);
		mostrarEspera("Cargando localidades...");
		xajax_cambioMunicipio(cveEstado,cveMunicipio);
		return;
	};

	var cambioLocalidadDomicilio = function() {
		var cveLocalidad = $("#slcLocalidad").val().trim();
		var cveEstado = $("#slcEstadoDom").val().trim();
		var cveMunicipio = $("#slcMunicipioDomicilio").val().trim();
		 $("#txtCP").val('');
		 $("#txtCP").attr("disabled",false);		
			$("#slcColonia").html(
					'<option value="">Selecciona una opci&oacute;n.</option>')
		$("#slcColonia").attr("disabled",false);			
		mostrarEspera("Cargando colonias...");
		xajax_cambioLocalidad(cveEstado,cveMunicipio);
		return;
	};


	//--------------Fin datos contacto-----------------//
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
	};
	
	var cambiarNacionalidad= function() {
		var cveNacionalidad =$("#slcNacionalidad").val().trim();
		console.log("Nacionalidad:"+cveNacionalidad);
		if (cveNacionalidad=="mex"){	
			$('#slcMunicipioNac').attr('disabled', false);
			$('#slcEntidadNac').attr('disabled', false);			
		}
		else{
			$('#slcMunicipioNac').attr('disabled', true);
			$('#slcEntidadNac').attr('disabled', true);
		}
			
	};
	
	function validateEmail(email) {
		  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		  return re.test(email);
		}
	
var inicializarControles=function()
	{
	var d = new Date();
	var strDate = d.getFullYear()+ "-" + (d.getMonth()+1) + "-" + d.getDate();
	
	$("#txtNacimiento").datepicker({yearRange:d.getFullYear()-130+":"+(d.getFullYear()-15),changeYear :true,changeMonth :true,constrainInput:true,startDate: "2015-01-01"}).on('dp.show', function() {
		  return $(this).data('DateTimePicker').setDate(strDate);
	});
	
	$("#txtNacimiento").datepicker('setDate', strDate);
	
	$("#txtNacimiento").attr("readonly","readonly");
	
	var strDate = d.getFullYear()-16 + "-" + (d.getMonth()+1) + "-" + d.getDate();
	$("#txtFechaAfiliacion").datepicker({yearRange:d.getFullYear()-50+":"+(d.getFullYear()),changeYear :true,changeMonth :true,constrainInput:true});
	
	$("#txtFechaAfiliacion").attr("readonly","readonly");
	
	
//	$("#chkEsJubilado").on("change", jubiladoactivar);
	//activarjubilado($("#chkEsJubilado").prop('checked'));
//	alert($("#chkEsJubilado").prop('checked'));
	
	$(".numeric2").numeric({integers:true,negative : false});
	
	
	$('.numeric').on('input', function() {
	    var position = this.selectionStart - 1;
	    
	    fixed = this.value.replace(/[^0-9\.]/g, '');  //remove all but number and .
	    if(fixed.charAt(0) === '.')                  //can't start with .
	      fixed = fixed.slice(1);
	    
	    var pos = fixed.indexOf(".") + 1;
	    if(pos >= 0)
	      fixed = fixed.substr(0,pos) + fixed.slice(pos).replace('.', '');  //avoid more than one .
	    
	    if (this.value !== fixed) {
	      this.value = fixed;
	      this.selectionStart = position;
	      this.selectionEnd = position;
	    }
	  });
	
//	$("#slcNacionalidad").change(cambiarNacionalidad);
	$("#slcColonia").change(function(){
		var idp = $("#slcColonia").val().trim();
		if(idp==''){
			 $("#txtCP").val('');
			 $("#txtCP").attr("disabled",false);
			 $("#btnBuscarCP").attr("disabled",false);
		}else{
			xajax_buscarIdPostal(idp);
		}
	});
	
	$("#btnLimpiar").click(function(){
		 $("#txtCP").val('');
		 $("#txtCP").attr("disabled",false);
		 cambioEntidadCont();
			$("#slcLocalidad").html(
			'<option value="">Selecciona una opci&oacute;n.</option>')
	$("#slcColonia").html(
			'<option value="">Selecciona una opci&oacute;n.</option>')

	});
	
	$("#slcLocalidad").change(cambioLocalidadDomicilio);
	$("#slcMunicipioDomicilio").change(cambioMunicipioDomicilio);
	
//	cambioEntidadCont();	
	$("#btnGuardar1").click(guardarTab1);
	$("#btnGuardar2").click(guardarTab2);
	$("#btnGuardar3").click(guardarTab3);
	$("#btnGuardar4").click(guardarTab4);
//	$("#btnGuardarTab5").click(guardarTab5);
//	$("#btnGuardarTabTodo").click(guardarTabTodo);
	$("#btnBuscarCP").click(buscarCPC);

	}
$(document).ready(function(){inicializarControles()});

var buscarCPC=function()
{	
	var cp=$("#txtCP").val().trim();
	if(cp.length==5)
	{
		mostrarAviso("Buscando Código Postal");
		xajax_buscarCPC(cp);
		
	}else{
		mostrarError("El C&oacute;digo Postal debe contener 5 digitos.");
	}
	return false;
};

function colocarCP(cp){
	$("#txtCP").val(cp);
	$("#txtCP").attr("disabled",true);
	$("#btnBuscarCP").attr("disabled",true);
}

var colocarDatosC=function(datos)
{
	if(datos!=null)
	{
		$("slcMunicipioDomicilio").attr("disabled","disabled");

		$("#slcMunicipioDomicilio").empty();  			    			
		$("#slcMunicipioDomicilio").append("<option value='"+datos.c_mnpio+"'>"+datos.municipio+"</option>");
		//$("#slcLocalidad").empty();
		$("#slcCiudad").append("<option value='"+datos.idPostal+"'>"+(datos.d_ciudad==''?datos.d_mnpio:datos.d_ciudad)+"</option>");
//		$("#slc").append("<option value='"+datos.+"'>"+datos.+"</option>");
 
		//ocultarMensaje();
		
	}
	else
	{
		$("#txtCP").val('');
		mostrarAviso("Sin coincidencias de Codigo Postal en base de datos.");
	}
	//colocaCambioAutocompleteAsentamiento();
};

function siguiente(num){
	mostrarAviso("Espere un momento...");
	xajax_avanzaSeccion(num,$("#txtIdTurno").val());
}