<?php
	require_once FOLDER_MODEL . "extend/model.ubicacion.inc.php";
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
  
  function guardar($txtNombre)
  {
  	global $_NOW_;
  	global $objSession;
  	global $dbLink;
  	
  	$r=new xajaxResponse();
  	//register     
  	$ubicacion = new ModeloUbicacion();
  	$ubicacion->transaccionIniciar();
    $ubicacion->setNombre($txtNombre);
    $ubicacion->setEstatusActiva();  
  	$ubicacion->guardar();
  	if($ubicacion->getStrError()){
  		$r->mostrarError("Ha ocurrido un error, intente m�s tarde. ".$ubicacion->getStrError());
  		return $r;
  	}
  
  	$ubicacion->transaccionCommit();
  	$r->mostrarAviso("La informaci&oacute;n se almaceno correctamente.");
  	$r->redirect("listadoRecaudaciones.php",1);
  	return $r;
  
  }
  $xajax->registerFunction("guardar");
  
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

 