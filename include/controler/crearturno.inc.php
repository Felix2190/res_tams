<?php

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	require_once FOLDER_MODEL . "extend/model.verificacion_biografica.inc.php";
	require_once FOLDER_MODEL . "extend/model.etapa.inc.php";
	require_once FOLDER_MODEL . "extend/model.turno.inc.php";
	require_once FOLDER_MODEL . "extend/model.verificacion_biografica.inc.php";
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
							<button type="button" class="btn btn-default btn-circle fa fa-check-circle" onclick="ValidarBiografico('.$row['idPersona'].','.$filas.')"  data-toggle="tooltip" data-placement="top" title="Validar Biometrico">
							</td>	
				</tr> ';
				$filas+=1;
			}
		if($strPersonas==''){
			$r->assign("btnValBio","disabled", false);
			$strPersonas='<td colspan="8" align="center"> sin resultados</td>';
			$r->assign("lblsinresultados","style","visible");
			
		}
		else {
			$r->assign("lblsinresultados","style","visibility:hidden");
			$r->assign("btnValBio","disabled", true);
			
		}
			
			
		$r->ocultarMensaje();
		$r->assign("tablaResultados","innerHTML", $strPersonas);
		
		return $r;
	}
	
	$xajax->registerFunction ( "buscar");
	
	
	function agregaNuevoTurno($idUbicacion){
		global $dbLink;
		global $objSession;
		
		
		$r = new xajaxResponse ();
		
		
		$turno =new ModeloTurno();
		
		$turno->setFechaHoraCreacion(date('Y-m-d H:i:s'));
		$turno->setFechaHora(date('Y-m-d H:i:s'));	
				
		$ultimo=$turno->getUltimoTurno($idUbicacion);
		
		$turno->setTurnoExterno($ultimo+1);		
		
		$turno->setIdUsuario($objSession->getIdLogin());
		$turno->setIdUbicacion($idUbicacion);	
		$turno->setIdEtapa(1);//La etapa es generacion
		
		$turno->Guardar();
		if($turno->getError())
		{
			$r->mostrarError($turno->getStrError());
			return $r;
		}
		//  $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']
		$r->mostrarAviso("Turno generado exitosamente ".$turno->getTurnoExterno()." ");
		
		return $r;
	}
	$xajax->registerFunction ( "agregaNuevoTurno");
	
	function guardarTurno( $noTurno,$persona){
		global $dbLink;
		global $objSession;
		
		$r = new xajaxResponse ();
		$turno =new ModeloTurno();
		$turno->setFechaHoraCreacion(date('Y-m-d H:i:s'));
		$turno->setFechaHora(date('Y-m-d H:i:s'));		
		$turno->setTurnoExterno($noTurno);		
		$turno->setIdUsuario($objSession->getIdLogin());
		$turno->setIdUbicacion($objSession->getIdUbicacion());	
		
		if($persona>0)
			$turno->setIdPersona($persona);
		
		$turno->setIdEtapa(2);//La etapa es generacion
		$turno->Guardar();
		if($turno->getError())
		{
			$r->mostrarError($turno->getStrError());
			return $r;
		}
		//Insertamos la validacion  biografica como completa
		$biografico=new modeloVerificacion_biografica();
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
		}
		
		//$r->ocultarMensaje();
		limpiaTodo($r);
		$r->mostrarAviso("Turno generado exitosamente, turno(externo) ".$noTurno." en con turno(interno) ".$turno->getIdTurno());
		
		return $r;
	}
	
	$xajax->registerFunction ( "guardarTurno");
	
	
	function validarbio($idpersona){
		$r = new xajaxResponse ();
		$r->mostrarAviso("Datos biograficos registrados. ".$idpersona);
		$verifica=new Modelo();
		$verifica->setIdPersona($idPersona);
		$verifica->
		$r->redirect("documentos.php?id=".$idpersona);
		return $r;
	}
	$xajax->registerFunction ( "validarbio");
	

	
	
	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
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
		
		
			            	global $objSession;    			                          	
			            	$ubicacion=new ModeloUbicacion();
			            	$ubicacion->setIdUbicacion($objSession->getIdUbicacion());
							$idubicacion=$objSession->getIdUbicacion();
			            	$strubicacion= $ubicacion->getNombre();
							
		$strListaPersonas='sin datos';
		$strListaTurnos='<tr></tr>';
		
		$etapaActual=new ModeloEtapa();
		$etapaActual->setIdEtapa(1);//Buscamos cual es el orden de la Etapa Verificación
		if($etapaActual->getOrden()==0) //si el orden es 0 
			$etapaConfigurada='Verificación';
		else
			$etapaConfigurada='Generación';
		
		$strListaTurnos='';
	
		global $objSession;
		$query="SELECT T.idTurno, T.fechaHoraCreacion Inicio, DATE_FORMAT(fechaHora,'%h:%i') AS Actual,turnoExterno , LTRIm(RTRIM(CONCAT(IFNULL(P.nombres,''),' ',
				IFNULL(P.primerAP,''),' ',IFNULL(P.segundoAp,'')))) AS nombre, E.Descripcion, CONCAT(tp.descripcion, '-',tp.tipoTramite ) AS Tramite,
				U.nombre AS ubicacion 
				FROM `turno` AS T 
				INNER JOIN `etapa` AS E ON E.idEtapa=T.idEtapa 
				LEFT JOIN persona as P ON P.idPersona=T.idPersona 
				LEFT JOIN tipolicencia AS tp ON tp.idTipoLicencia=T.idTipoLicencia 
				LEFT JOIN ubicacion as U ON U.idUbicacion=T.idUbicacion 
				WHERE T.idUbicacion=". $objSession->getIdUbicacion()." 
				ORDER BY T.idTurno DESC";
		$result=mysqli_query($dbLink, $query);
		if ($result->num_rows>0)
			while($r=mysqli_fetch_assoc($result))
			{
				$strListaTurnos.='<tr>
									<td>' . $r['idTurno'] . '</td>
									<td>' . $r['Actual'] . '</td>
									<td>' . $r['turnoExterno'] . '</td>							
									<td>' . TildesHtml($r['nombre']) . '</td>
									<td>' . TildesHtml($r['Descripcion']) . '</td>
									<td>' . TildesHtml($r['Tramite']) . '</td>
									<td>' . TildesHtml($r['ubicacion']) . '</td>
									<!--<td>
										<a href="faroalta2.php?id=' . $r['idFaro'] . '" class="btn btn-default btn-circle"><i class="fa fa-eye text-success"></i></a>
										<a href="faroedicion.php?id=' . $r['idFaro'] . '" class="btn btn-default btn-circle"><i class="fa fa-pencil text-warning"></i></a>
										 <a href="#" class="btn btn-default btn-circle"><i class="fa fa-times text-danger"></i></a>
									</td>-->
								</tr>';
			}
		
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
