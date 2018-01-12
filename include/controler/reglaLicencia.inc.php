<?php
	require_once FOLDER_MODEL . "extend/model.reglaLicencia.inc.php";
	require 'admincuentas.php';
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#


  
  #----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
  //$xajax=new xajax();
  $xajax=new xajax();
  
  function actualizar($idReglaLicencia,
              $nombre,
    					$formatoSF001,
    					$examenTransito,
    					$identificacionOficial,
    					$comprobanteDomicilio,
    					$curp,
    					$rfc,
    					$actaNacimiento,
    					$polizaSeguro,
    					$cartaResponsiva,
    					$identificacionPadreTutor,
    					$formatoMigratorio,
    					$constanciaLicenciaVigente,
              $licenciaAnterior,
              $slcTipoLicencia,              
              $estatus)
  {
  	global $_NOW_;
  	global $objSession;
  	
  	
  	$r=new xajaxResponse();
  	//register 
  	$reglaLicencia = new ModeloReglaLicencia();
  	$reglaLicencia->transaccionIniciar();
    $reglaLicencia->setIdReglaLicencia($idReglaLicencia);
    $reglaLicencia->setNombreRegla($nombre);
  	$reglaLicencia->setIdTipoLicencia($slcTipoLicencia); 
    if($formatoSF001==1){
      $reglaLicencia->setFormatoSF001($formatoSF001);
    }else{
      $reglaLicencia->unsetFormatoSF001($formatoSF001);
    }  
    if($examenTransito==1){
      $reglaLicencia->setExamenTransito($examenTransito);
    }else{
      $reglaLicencia->unsetExamenTransito($examenTransito);
    }        
    if($identificacionOficial==1){
      $reglaLicencia->setIdentificacionOficial($identificacionOficial);
    }else{
      $reglaLicencia->unsetIdentificacionOficial($identificacionOficial);
    }   
    if($comprobanteDomicilio==1){
      $reglaLicencia->setComprobanteDomicilio($comprobanteDomicilio);
    }else{
      $reglaLicencia->unsetComprobanteDomicilio($comprobanteDomicilio);
    }   
    if($curp==1){
      $reglaLicencia->setCurp($curp);
    }else{
      $reglaLicencia->unsetCurp($curp);
    }   
    if($rfc==1){
      $reglaLicencia->setRfc($rfc);
    }else{
      $reglaLicencia->unsetRfc($rfc);
    }   
    if($actaNacimiento==1){
      $reglaLicencia->setActaNacimiento($actaNacimiento);
    }else{
      $reglaLicencia->unsetActaNacimiento($actaNacimiento);
    }   
    if($polizaSeguro==1){
      $reglaLicencia->setPolizaSeguro($polizaSeguro);
    }else{
      $reglaLicencia->unsetPolizaSeguro($polizaSeguro);
    }   
    if($cartaResponsiva==1){
      $reglaLicencia->setCartaResponsiva($cartaResponsiva);
    }else{
      $reglaLicencia->unsetCartaResponsiva($cartaResponsiva);
    }                           
    if($identificacionPadreTutor==1){
      $reglaLicencia->setIdentificacionPadreTutor($identificacionPadreTutor);
    }else{
      $reglaLicencia->unsetIdentificacionPadreTutor($identificacionPadreTutor);
    } 
    if($formatoMigratorio==1){
      $reglaLicencia->setFormatoMigratorio($formatoMigratorio);
    }else{
      $reglaLicencia->unsetFormatoMigratorio($formatoMigratorio);
    } 
    if($constanciaLicenciaVigente==1){
      $reglaLicencia->setConstanciaLicenciaVigente($constanciaLicenciaVigente);
    }else{
      $reglaLicencia->unsetConstanciaLicenciaVigente($constanciaLicenciaVigente); 
    }    
    if($licenciaAnterior==1){
      $reglaLicencia->setLicenciaAnterior($licenciaAnterior);
    }else{
      $reglaLicencia->unsetLicenciaAnterior($licenciaAnterior); 
    }      
    if($estatus==1){
      $reglaLicencia->setEstatusActivo();
    }else{
      $reglaLicencia->setEstatusInactivo();
    }     
  	$reglaLicencia->guardar();
  	if($reglaLicencia->getStrError()){
  		$r->mostrarError("Ha ocurrido un error, intente más tarde. ".$reglaLicencia->getStrError());
  		return $r;
  	}
  
  	$reglaLicencia->transaccionCommit();
  	$r->mostrarAviso("La informaci&aacute;n se almaceno correctamente.");
  	$r->redirect("listadoReglasLicencia.php",1);
  	return $r;
  
  }
  $xajax->registerFunction("actualizar");
  
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

 