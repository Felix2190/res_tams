<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#




	#-----------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------Inicializacion de control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#



	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------Funciones----------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------Seccion AJAX--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();
	
	
	
	function mostrarIframe()
	{
		$r=new xajaxResponse();
		$r->assign('divIFrame','innerHTML','<iframe src="../osticket/tickets.php" frameborder="0" style="min-height: 500px;" height="100%" width="100%"></iframe>');
		$r->ocultarMensaje();
		return $r;
	}
	$xajax->registerFunction("mostrarIframe");
	function iniciarSoporte()
	{
		global $objSession;
		$r=new xajaxResponse();
		$r->call("iniciaSoporte",$objSession->getUserName(),OSTICKET_PASS);
		$objSession->iniciarSoporte();
		$_SESSION['objSession']=serialize($objSession);
		return $r;
	}
	$xajax->registerFunction("iniciarSoporte");



	$xajax->processRequest();

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	$inicioSession="";
	// if(!$objSession->isSoporteIniciado())
	// {
	// 	$inicioSession='mostrarEspera("Starting support API, please wait.");xajax_iniciarSoporte();';
	// }