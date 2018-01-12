<?php

	require_once FOLDER_MODEL_EXTEND . "model.persona_biometrico.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.turno.inc.php";
	
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();

	 function guardarHuellas($id,$huellas,$bio)
	{
		global $objSession;
		$r=new xajaxResponse();
		
		$arrH=json_decode($huellas);
		
		$turno=new ModeloTurno();
		//$turno->transaccionIniciar();
		$turno->setIdTurno($id);
		
		
		foreach ($arrH as $key=>$img){
			$biometrico=new ModeloPersona_biometrico();
			$biometrico->setIdBiometrico($key);
			$biometrico->setArchivo($img);
			$biometrico->setIdPersona($turno->getIdPersona());
			$biometrico->Guardar();
			if ($biometrico->getError()){
				$r->mostrarError('Error al guardar la informaci&oacute;n biom&eaccute;trica');
				return $r;
			}
			
		}
		
		
		$turno->setIdEtapa(7);
		
		$turno->setFechaHora(date('Y-m-d H:i:s'));
		//$turno->Guardar();
		if ($turno->getError()){
			$r->mostrarError('Error al actualizar turno');
			return $r;
		}
		
		$turno->transaccionCommit() ;
		$r->assign('divButtons'.$bio, 'innerHTML','');
		$r->mostrarAviso("Informaci&oacute;n guardada con exito.");
		//$r->call('next');
		
		$r->redirect("biometricos_rostro.php",1);
		
		return $r;

	}
	$xajax->registerFunction("guardarHuellas");

	
	
	function siguienteTurno($id)
	{
		global $objSession;
		$r=new xajaxResponse();
	
		$turno=new ModeloTurno();
		$turno->transaccionIniciar();
		$turno->setIdTurno($id);
	
		$turno->setIdEtapa(7);
	
		$turno->setFechaHora(date('Y-m-d H:i:s'));
		$turno->Guardar();
		if ($turno->getError()){
			$r->mostrarError('Error al actualizar turno');
			return $r;
		}
		$turno->transaccionCommit() ;
		$r->redirect("examenUpload.php?idPersona=".$turno->getIdPersona(),2);
		
		return $r;
		
		}
		$xajax->registerFunction("siguienteTurno");
		
	$xajax->processRequest();


	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#




	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	$nombrePersona=$CURP='';
	if ($_SESSION['etapa']!='biometricos'){
	    header("Location: dashboard.php");
	    die();
	}
	/*
	 if ($_SESSION['datos']!='biograficos'){
	 header("Location: dashboard.php");
	 die();
	 }
	 */
	if(!isset($_SESSION['idTurno']))
	{
	    header("Location: dashboard.php");
	    die();
	}
	$IDT=$_SESSION['idTurno'];
	
	$turno=new ModeloTurno();
	$turno->setIdTurno($IDT);
	$persona = new ModeloPersona();
	$persona->setIdPersona($turno->getIdPersona());
	$nombrePersona=$persona->getNombres();
	$CURP=$persona->getCURP();
	
		#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
