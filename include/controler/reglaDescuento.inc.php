<?php
	require_once FOLDER_MODEL . "extend/model.reglaDescuento.inc.php";
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
  
  function actualizar($nombre,
    					$descripcion,
    					$esPorcentaje,
              $cantidad,
    					$txtEdadMinima,
    					$txtEdadMaxima,
    					$slcTipoLicencia,
              $idReglaLicencia,
              $estatus)
  {
  
  	global $_NOW_;
  	global $objSession;
  	
  	
  	$r=new xajaxResponse();
  	//register 
  	$reglaDescuento = new ModeloReglaDescuento();
  	$reglaDescuento->transaccionIniciar();
    $reglaDescuento->setIdReglaDescuento($idReglaLicencia);
    $reglaDescuento->setNombre($nombre);
    $reglaDescuento->setDescripcion($descripcion);
    $reglaDescuento->setCantidad($cantidad);
  	$reglaDescuento->setIdTipoLicencia($slcTipoLicencia);
    $reglaDescuento->setEdadMenor($txtEdadMinima);
    $reglaDescuento->setEdadMayor($txtEdadMaxima);  
    if($esPorcentaje==1){
      $reglaDescuento->setEsPorcentaje($esPorcentaje);
    }else{
      $reglaDescuento->unsetEsPorcentaje($esPorcentaje);
    }    
          
    if($estatus==1){
      $reglaDescuento->setEstatusActivo();
    }else{
      $reglaDescuento->setEstatusInactivo();
    }     
  	$reglaDescuento->guardar();
  	if($reglaDescuento->getStrError()){
  		$r->mostrarError("Ha ocurrido un error, intente más tarde. ".$reglaDescuento->getStrError());
  		return $r;
  	}
  
  	$reglaDescuento->transaccionCommit();
  	$r->mostrarAviso("La informaci&oacute;n se almaceno correctamente.");
  	$r->redirect("listadoReglasDescuento.php",1);
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

 