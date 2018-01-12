<?php

	require_once FOLDER_MODEL_EXTEND . "model.persona.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.turno.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.verificacion_biografica.inc.php";
	
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();

	 function validaCURP($CURP,$idTurno)
	{
		global $objSession;
		$r=new xajaxResponse();
		$persona= new ModeloPersona();
		$arrInfo=$persona->validaCurp($CURP);
		
		$turno = new ModeloTurno();
		$turno->transaccionIniciar();
		$verifBiog=new ModeloVerificacion_biografica();
		$verifBiog->setIdTurno($idTurno);
		$verifBiog->setIdUsuario($objSession->getIdUser());
		$verifBiog->setFecha(date('Y-m-d H:i:s'));
		$verifBiog->setVerificacionPendiente();
		
		if (count($arrInfo)>0){
			$objInfo=(object) $arrInfo;
			$_SESSION['objPersona']=$objInfo;
			
			$turno->setIdTurno($idTurno);
			$turno->setIdPersona($objInfo->idPersona);
			$turno->Guardar();
			
			if ($turno->getError()){
				$r->mostrarError("Error al actualizar el turno.");
				return $r;
			}
			
			$verifBiog->setEstatusValidado();
			$verifBiog->setEntrada($arrInfo['nombre']);
			$r->mostrarAviso("CURP v&aacute;lida! ");
			
		}else {
			$verifBiog->setEstatusNo_valido();
			$verifBiog->setEntrada($CURP);
			$r->mostrarAviso("CURP no v&aacute;lida!");
			
		}
		
		$verifBiog->Guardar();
		if ($verifBiog->getError()){
			$r->mostrarError("Error al guardar la verificaci&oacute;n biogr&aacute;fica");
			return $r;
		}
		
		$verifBiog->transaccionCommit();
  //		$r->ocultarMensaje();
		
		$r->redirect("verificacionBiografica.php",2);
		
		return $r;

	}
	$xajax->registerFunction("validaCURP");

	$xajax->processRequest();


	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#




	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
		#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
