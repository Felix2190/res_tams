<?php

	//require_once FOLDER_MODEL_EXTEND . "model..inc.php";
	require 'admintickets.php';

	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();
	function verTicket($idTicket)
	{
		$r=new xajaxResponse();
		$_SESSION['tid']=$idTicket;
		
		$r->redirect("ticketrev.php",2);
	
		return $r;
	
	}
	$xajax->registerFunction("verTicket");
	
	
	$xajax->processRequest();


	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#


	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	if(isset($_SESSION['tid'])){unset($_SESSION['tid']);}

	$arrTickets=obtenerHistoriaTickets($objSession->getIdUser());
	if (count($arrTickets)>0){
	foreach ($arrTickets as $ticket){
		$segundos=strtotime('now') - strtotime($ticket['fecha']);
		$diferencia_dias=intval($segundos/60/60/24);
		if($diferencia_dias>0&&$diferencia_dias<3){
			$cadena_dias = '<strong style="color:green;"><i class="fa fa-clock-o text-muted"></i> '.$diferencia_dias.' d&iacute;as abierto</strong>';
		}else if($diferencia_dias>2&&$diferencia_dias<6){
			$cadena_dias = '<strong style="color:yellow;"><i class="fa fa-clock-o text-muted"></i> '.$diferencia_dias.' d&iacute;as abierto</strong>';
		}else if($diferencia_dias>5){
			$cadena_dias = '<strong style="color:red;"><i class="fa fa-clock-o text-muted"> </i> '.$diferencia_dias.' d&iacute;as abierto</strong>';
		}else if($diferencia_dias==0){
			$cadena_dias = 'Nuevo';
		}
		$listado .= '<tr>
						<td>'.$ticket['id_ticket'].'</td>
						<td>'.$ticket['titulo'].'</td>
						<td>'.utf8_encode($ticket['nombreUsuario']).'</td>
						<td>'.utf8_encode($ticket['nombreUsuario2']).'</td>
						'.$ticket['tipo'].'
						<td><span class="label label-'.$ticket['prioridad'].'">'.$ticket['nprioridad'].'</span></td>
						<td><i class="'.$ticket['estatus'].'"></i> '.$ticket['nestatus'].'</td>
						<td>'.date("d M Y h:i:s", strtotime($ticket['fecha'])).'</td>
            <td>'.$cadena_dias.'</td>
						<td>
								<a href="javascript:abrirTicket('.$ticket['id_ticket'].');"class="btn btn-default" name="btnPreview"><i class="fa fa-folder-open"></i></a>
						</td>
					</tr>';
	
		}
	}else {
		$listado .= '<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
          <td>&nbsp;</td>
				</tr>';
	
	}
	
		#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
