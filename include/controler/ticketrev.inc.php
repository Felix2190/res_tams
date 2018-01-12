<?php

	//require_once FOLDER_MODEL_EXTEND . "model..inc.php";
require 'admintickets.php';
require 'admincuentas.php';

	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();
function movimiento($tipo, $arrMovimientoTicket) {
	global $objSession;
	$r = new xajaxResponse ();
	
	if ($tipo == 'cerrar' || $tipo == 'reabrir') {
		$pag='tickethis.php';
		$arrMovimientoTicket['fecha']= date('Y-m-d H:i:s');
		$operacion = ticketMovimiento ( $tipo, $arrMovimientoTicket );
		$info = $operacion [1];
		if ($operacion [0]&&$tipo == 'cerrar') {
			$perfil_actual = obtenerDatosPerfil ( $objSession->getIdUser () );
			$estatus = obtener_informacion_registro ( 'ticket_status', 'id_tstatus', 6 );
			$extra = '<br /><br />T&iacute;tulo: ' . $arrMovimientoTicket ['titulo'] . '<br />';
			$extra .= 'Estatus: ' . $estatus ['nombre'] . '<br />';
			preparar_mail_ticket ( $perfil_actual, '', 'ticket', 'cerrado', 'solicitante', $extra );
		}
	} else {
		$pag='ticket.php';
		$operacion = ticketMovimiento ( $tipo, $arrMovimientoTicket );
		$info = $operacion [1];
		if ($operacion [0]) {
			$perfil_autorizador = obtenerDatosPerfil ( $arrMovimientoTicket ['perfilAsignado'] );
			$perfil_login = obtenerDatosPerfil ( $objSession->getIdUser () );
			
			$estatus = obtener_informacion_registro ( 'ticket_status', 'id_tstatus', $arrMovimientoTicket ['estatus'] );
			$extra = '<br /><br />T&iacute;tulo: ' . $arrMovimientoTicket ['titulo'] . '<br />';
			$extra .= 'Estatus: ' . $estatus ['nombre'] . '<br />';
			
			preparar_mail_ticket ( $perfil_login, $perfil_autorizador, 'ticket', 'registrado', 'autorizador', $extra );
		}
	}
	$r->mostrarAviso ( $info ['msg'] );
	$r->redirect($pag,2);
	return $r;
}
$xajax->registerFunction ( "movimiento" );

	$xajax->processRequest();


	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#



	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	$desc_arc=$archivos_nombre = array();
	$idPerfil=$objSession->getIdUser();
	$id_ticket=$_SESSION['tid'];
	
	if((isset($_SESSION['tid'])) AND (is_numeric($_SESSION['tid']))){
		$idPerfil= $objSession->getIdUser();
		if ($objSession->getIdRol()<=3)
		$perfilAsign= getAdministadorUser();
		
				
				$arrInfoTicket=obtenerInfoTicket($_SESSION['tid']);
					//	echo 'si <br />';
				if(count($arrInfoTicket)>0){
					//echo $arrInfoTicket.'<br />';
					$infoTicket=$arrInfoTicket['info_general'];
						
					$noTicket = $infoTicket['id_ticket'];
					$titulo = sin_entidades($infoTicket['titulo']);
					$perfil = $infoTicket['id_solicitante'];
					$asignado = $infoTicket['nombreUsuario'];
					$notas = sin_entidades($infoTicket['notas']);
					$fecha = date("d M Y h:i:s", strtotime($infoTicket['fecha']));
					$fecha_resolucion = $infoTicket['fecha_resolucion'];
					$actualEstatus = $infoTicket['estatus'];
					$actualEstatus2 = $infoTicket['nestatus'];
					//Assign color value
					$prioridad = '<td><span class="label label-'.$infoTicket['prioridad'].'">'.$infoTicket['nprioridad'].'</span></td>';
						
					//Assign Estatus Color tag
					$estatus = '<td><i class="'.$infoTicket['estatus'].'"></i> '.$infoTicket['nestatus'].'</td>';
						
	
					$puesto = '';
					$ubicacion = '';
						
					if (isset($arrInfoTicket['info_solicitante'])){
						$infoSolicitante=$arrInfoTicket['info_solicitante'];
						$solicitante = '<span>'.$infoSolicitante['nombreUsuario'].'</span>';
						$empresa = $infoSolicitante['empresa'];
						$ubicacion=$infoSolicitante['ciudad'];
					}else{
						$solicitante = '<span class="text-danger"><i class="fa fa-exclamation-triangle text-danger"></i> Usuario Baja</span>';
						$empresa = '';
					}
	
					if (isset($arrInfoTicket['info_ultimo_historial'])){
						$infoSolicitanteHistorial=$arrInfoTicket['info_ultimo_historial'];
						$id_perfil_ultimo=$infoSolicitanteHistorial['id_solicitante'];
					}else{
						$id_perfil_ultimo = 0;
					}
					if (isset($arrInfoTicket['info_archivos'])){
						$infoArchivos=$arrInfoTicket['info_archivos'];
	
						$archivos .= '<h4 class="text-muted"><i class="fa fa-folder-open text-muted"></i> &nbsp;Archivos Relacionados</h4>
                        <div class="spacer-30"></div>
                        <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                           		Fecha
                                            </th>
                                            <th scope="col">
                                           		Autor
                                            </th>
                                            <th scope="col">
                                            	Archivo
                                            </th>
                                            <th scope="col">
                                            	Descripci&oacute;n
                                            </th>
                                            <th scope="col" class="th-3-action-btn">
                                            	Opts
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>';
						foreach ($arrInfoTicket['info_archivos'] as $archivoData){
							$archivos .= '<tr>
								<td>'.$archivoData['fecha'].'</td>
								<td>'.$archivoData['nombreUsuario'].'</td>
								<td>'.$archivoData['archivo'].'</td>
								<td>'.$archivoData['descripcion'].'</td>
								<td><a href="'.$archivoData['archivo'].'" target="_new"><i class="fa fa-cloud-download"></i></a></td>
							</tr>';
						}
							
						$archivos .= '</tbody>
                    	</table>
                        <div class="spacer-20"></div>
						<hr />
						<div class="spacer-20"></div>';
							
					}else{
						$archivos = '';
					}
						
					if (isset($arrInfoTicket['info_historial'])){
						$infoHistorial=$arrInfoTicket['info_historial'];
						foreach ($arrInfoTicket['info_historial'] as $infoHistorial){
							$histowner = '<span>'.$infoHistorial['nombreUsuario'].'</span>';
							//Case for ack
							if($infoHistorial['id_solicitante'] == $objSession->getIdUser()){
								$ackcolor = 'primary';
							}else{
								$ackcolor = 'success';
							}
	
							$historial .= '<div class="attention-box attention-'.$ackcolor.'">
						<h5><i class="fa fa-calendar"></i> '.date("d M Y h:i:s", strtotime($infoHistorial['fecha'])).' &nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i> '.$histowner.'</h5>
						<div class="spacer-20"></div>
						<p>'.sin_entidades($infoHistorial['notas']).'</p></div>	<div class="spacer-20"></div>';
						}
					}else{
						$historial = '<div class="attention-box attention-primary">
							<h5><i class="fa fa-calendar"></i> '.date("d M Y").' &nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i> Sistema</h5>
							<div class="spacer-20"></div>
							<p>Ticket a&uacute;n en proceso de revisi&oacute;n.</p>
						</div>
	
						<div class="spacer-20"></div>';
					}
	
				}
	}
	else
	{
		header("Location: ticket.php");
		die();
	}
	
	$arrCategoria=obtenerCategorias($objSession->getIdRol()<=3?true:false);
	
	
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
