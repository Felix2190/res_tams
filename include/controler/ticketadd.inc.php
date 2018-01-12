<?php

	//require_once FOLDER_MODEL_EXTEND . "model..inc.php";
	require_once 'admintickets.php';
	require_once 'admincuentas.php';
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();

	 function GuardarTicket($arrDatosTickets,$archivos_nombre,$desc_arc)
	{
		global $objSession;
		$r=new xajaxResponse();
		
		$arrDatosTickets['fecha'] = date('Y-m-d H:i:s');
		$arrDatosTickets['idPerfil']= $objSession->getIdUser();
		
		if (guardaTicket($arrDatosTickets,$archivos_nombre,$desc_arc)){
			$perfil= obtenerDatosPerfil($objSession->getIdUser());
			$perfil_autorizador=obtenerDatosPerfil($arrDatosTickets['perfilAsignado']);
			$estatus = obtener_informacion_registro('ticket_status', 'id_tstatus', $arrDatosTickets['estatus']);
			$tipo = obtener_informacion_registro('ticket_tipo', 'id_ttipo', $arrDatosTickets['tipoSolicitud']);
				
			$extra = '<br /><br />T&iacute;tulo: '.$arrDatosTickets['titulo'].'<br />';
			$extra .= 'Estatus: '.$estatus['nombre'].'<br />';
			$extra .= 'Tipo: '.$tipo['nombre'].'<br />';
			preparar_mail_ticket($perfil, $perfil_autorizador, 'ticket', 'registrado', 'autorizador', $extra);
				
			$r->ocultarMensaje();
		$r->mostrarAviso("Su petici&oacute;n ha sido registrada correctamente.<br />En breve estaremos atendiendo la petici&oacute;n.");
		
		$r->redirect("ticket.php",3);
		}else{
			$r->mostrarAviso("Ha ocurrido un error, no ha sido registrado correctamente el ticket.");
		}
		return $r;

	}
	$xajax->registerFunction("GuardarTicket");

	$xajax->processRequest();


	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#




	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	$arrUser=$desc_arc=$archivos_nombre = $arrDatosTickets=array();
	
	if ($objSession->getIdRol()<=3)
		$perfilAsignado= getAdministadorUser();
		
	$arrSolicitudes= array(''=>'Seleccione una opci&oacute;n');
		
	$arrCategoria=obtenerCategorias($objSession->getIdRol()<=4?true:false);
	$arrPrioridad=obtenerPrioridad();
		
		#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
