<?php

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	require_once FOLDER_MODEL . "extend/model.verificacion_biografica.inc.php";
	require_once FOLDER_MODEL . "extend/model.etapa.inc.php";
	require_once FOLDER_MODEL . "extend/model.turno.inc.php";
	require_once FOLDER_MODEL . "extend/model.verificacion_biografica.inc.php";
	require_once FOLDER_MODEL . "extend/model.log_turno.inc.php";
	require_once FOLDER_MODEL . "extend/model.reglaLicencia.inc.php";    
	require_once FOLDER_MODEL . "extend/model.tipolicencia.inc.php"; 
	require_once FOLDER_MODEL . "extend/model.persona.inc.php"; 
	
	require 'admincuentas.php';
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	function TildesHtml($cadena)
	{
		return str_replace(array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ"),
				array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;",
						"&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;"), $cadena);
	}
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	$xajax=new xajax();
	function buscar($curp, $rfc,$licencia){
		//Busca las personas que no tengan un turno con fecha de dia de hoy
		global $dbLink;
		$r = new xajaxResponse ();
		
		
		$buscar='';
		if($curp!='')
			$buscar=" AND CURP='".$curp."'";
		if($rfc!='')
			$buscar=" AND RFC='".$rfc."'";
		if ($licencia)
			$buscar=" AND numero='".$licencia."'";
		
		$query="SELECT p.`idPersona`, IFNULL(`primerAp`,'') paterno, IFNULL(`segundoAp`,'') materno, IFNULL(`nombres`,'') nombres,  IFNULL(`CURP`,'') CURP, 
					CONCAT( IFNULL(`RFC`,''), IFNULL(`homoclave`,'')) RFC,COUNT(l.idLicencias) as totlicecncias
				FROM `persona` AS p	 
				LEFT JOIN licencia as l
					ON l.idPersona=p.idPersona
                LEFT JOIN turno AS t
                	ON t.idPersona=p.idPersona AND (DATE(t.fechaHoraCierre) ='0000-00-00' )
				WHERE 1 AND  t.idTurno IS NULL  ".$buscar."
				GROUP BY p.`idPersona`, `primerAp`, `segundoAp`, `nombres`,  `CURP`, `RFC`, `homoclave` ";
					
		$result=mysqli_query($dbLink, $query);
		
		if(!$result)
		{
			if(DEVELOPER)
				$r->mostrarError("Ocurrio un error en la busqueda de los datos, intenta tu consulta mas tarde.[" . mysqli_error($dbLink) . "]");
				else
					$r->mostrarError("Ocurrio un error en la busqueda de los datos, intenta tu consulta mas tarde.");
					return $r;
		}
		$strPersonas='';
		$filas=2;
		
		if ($result->num_rows>0)			
			while($row=mysqli_fetch_assoc($result))
			{
				$strPersonas.='<tr>
					<td>'.$row['idPersona'].'</td>
					<td>'.$row['paterno'].'</td>
					<td>'.$row['materno'].'</td>
					<td>'.$row['nombres'].'</td>
					<td>'.$row['CURP'].'</td>
					<td>'.$row['RFC'].'</td>
					<td>'.$row['totlicecncias'].'</td>	
					<td>
							<button type="button" class="btn btn-default btn-circle fa fa-check-circle" onclick="ValidarBiografico('.$row['idPersona'].','.$filas.')"  data-toggle="tooltip" data-placement="top" title="Seleccionar">
							</td>	
				</tr> ';
				$filas+=1;
			}
		
		if($strPersonas==''){
			$r->assign("btnValBio","disabled", false);
			$strPersonas='<td colspan="8" align="center"> sin resultados</td>';
			$r->assign("lblsinresultados","style","visible");
			$r->assign("txtIdPersona","value","0");
			//Cargamos la lista de opciones para una persona nueva
			mostrarListadoLicencias(0,$r);
		}
		else {
			
			$r->assign("lblsinresultados","style","visibility:hidden");
			
			
			
		}
			
		$r->ocultarMensaje();
		$r->assign("tablaResultados","innerHTML", $strPersonas);
		
		return $r;
	}
	
	$xajax->registerFunction ( "buscar");
	
	function mostrarListadoLicencias($idpersona,$r){
		$reglaLicencia = new ModeloReglaLicencia();
		$tiposlic=new ModeloTipolicencia();
		
		$licencias = $reglaLicencia->getLicenciasPermitidas(0);
		
		$strlicencias='<option value="">Seleccione una opci&oacute;n</option>';
		$filas=2;
		
		foreach($licencias AS $rlic){
				$tiposlic->setIdTipoLicencia($rlic['idTipoLicencia']);
				$strlicencias.= '<option value="' . $rlic['idTipoLicencia'] . '">' .TildesHtml($tiposlic->getDescripcion())
				. " " . TildesHtml($tiposlic->getPeriodo()) ." meses ". TildesHtml($tiposlic->getTipoTramite()) . '</option>';
				$filas+=1;
		}
		
		$r->assign("slcTramites","innerHTML", $strlicencias);
		$r->mostrarAviso($strlicencias);
	}
	
	function guardarTurno( $noTurno,$persona,$tramite){
		global $dbLink;
		global $objSession;
		
		$olog_turno=new Modelolog_Turno();
		$r = new xajaxResponse ();
		
		$turno =new ModeloTurno();
		$turno->getDatosByIdExternoFecha($noTurno,date('Y-m-d'));		
		

		$olog_turno->setIdTurno($turno->getIdTurno());				
		$olog_turno->setIdEtapa($turno->getIdEtapa());		
		
		$olog_turno->setFecha($turno->getFechaHora());
		
		$olog_turno->setIdUsuario($turno->getIdUsuario());
		
		$olog_turno->Guardar();
		
		$turno->setFechaHora(date('Y-m-d H:i:s'));				
		$turno->setIdUsuario($objSession->getIdLogin());
		if($persona==0){
			$opersona=new ModeloPersona();
			$opersona->setfechaNacimiento(date('Y-m-d')-365*18);
			$opersona->setCURP("");
			$opersona->Guardar();
			$persona=$opersona->getIdPersona();
		}
		$turno->setIdPersona($persona);	
		$turno->setIdTipoLicencia($tramite);
		$turno->setIdEtapa(4);//La etapa es documentos
		
		$turno->Guardar();
		if($turno->getError())
		{
			$r->mostrarError($turno->getStrError());
			return $r;
		}
		
		//Insertamos la validacion  biografica como completa
		/**$biografico=new modeloVerificacion_biografica();
		$biografico->setidTurno($turno->getIdTurno());
		if ($persona>0){
			$biografico->setEstatusValidado();
			$biografico->setVerificacionCerrada();
		}
		else{
			$biografico->setEstatusNo_valido();
			$biografico->setVerificacionPendiente();
		}
		$biografico->setFecha(date('Y-m-d H:i:s'));
		$biografico->setIdUsuario($objSession->getIdLogin());
		$biografico->Guardar();
		if($biografico->getError())
		{
			$r->mostrarError($biografico->getStrError());
			return $r;
		}**/
		
		//$r->ocultarMensaje();
		//limpiaTodo($r);
		$r->call("limpiar");
		$r->mostrarAviso("Turno generado exitosamente, turno(externo) ".$noTurno." en con turno(interno) ".$turno->getIdTurno());
		$r->redirect("generarTurnos.php");
		return $r;
	}
	
	$xajax->registerFunction ( "guardarTurno");
	
	
	function validarbio($idpersona){
		$r = new xajaxResponse ();
		$r->mostrarAviso("Cargando biograficos ".$idpersona);
		mostrarListadoLicencias($idpersona,$r);
		return $r;
	}
	$xajax->registerFunction ( "validarbio");
	

	
	
	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
function avanzaTurno($turno){
	//Marcamos el turno en el log
	global $objSession;
	$r = new xajaxResponse ();
	
	$olog_turno=new Modelolog_Turno();
	
	$oturno=new ModeloTurno();
	$oturno->getDatosByIdExternoFecha($turno, date('Y-m-d'));
	$olog_turno->setIdTurno($oturno->getIdTurno());
	$olog_turno->setIdEtapa($oturno->getIdEtapa());
	$olog_turno->setFecha(date('Y-m-d H:i:s'));
	$olog_turno->setIdUsuario($objSession->getIdLogin());
	$olog_turno->Guardar();
	$r->redirect("generarTurnos.php");
	//$r->mostrarAviso("Se cargo el turno ".$oturno->getIdTurno());
	//$r->redirect("generarTurnos.php");
	//mostramos el ultimo turno
	
	return $r;
	
	
}	
$xajax->registerFunction ( "avanzaTurno");


	function atender($turno){
		//Marcamos el turno en el log
		global $objSession;
		$oturno=new ModeloTurno();
		$oturno->getDatosByIdExternoFecha($turno, date('Y-m-d'));
		
		$r = new xajaxResponse ();
		$_SESSION['turno']=$oturno->getIdTurno();;
		$r->mostrarAviso("Se asigno el turno ".$oturno->getTurnoExterno());
		//$r->redirect("generarTurnos.php");
		//mostramos el ultimo turno
		
		return $r;
		
		
	}	
	$xajax->registerFunction ( "atender");


function limpiaTodo($r){
		
		$r->assign("txtRFC","value", "");
		$r->assign("txtCURP","value", "");
		$r->assign("txtLicencia","value", "");
		$r->assign("txtIdPersona","value", "");
		$r->assign("txtTurno","value", "");
		$tablevacia='<tr></tr>';
		$r->assign("tablaResultados","innerHTML",$tablavacia);				
		
	}
	
	
	$xajax->registerFunction ( "limpiaTodo");
	
	$xajax->processRequest();
	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	//if(!isset($strListaPersonas))
		$strListaPersonas='sin datos';
		$strListaTurnos='<tr></tr>';
		$listadoTramites.='<tr><td colspan="3"> Sin resultados </td></tr>';
		
		global $objSession;
		$turno=new ModeloTurno();		
		$strUltimoTurno=$turno->getSiguienteTurno($objSession->getIdUbicacion());
		
		$etapaActual=new ModeloEtapa();
		$etapaActual->setIdEtapa(1);//Buscamos cual es el orden de la Etapa Verificación
		if($etapaActual->getOrden()==0) //si el orden es 0 
			$etapaConfigurada='Verificación';
		else
			$etapaConfigurada='Generación';
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
