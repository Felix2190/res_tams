<?php

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	require_once FOLDER_MODEL . "extend/model.verificacion_biografica.inc.php";
	require_once FOLDER_MODEL . "extend/model.etapa.inc.php";
	require_once FOLDER_MODEL . "extend/model.turno.inc.php";
	require_once FOLDER_MODEL . "extend/model.tipolicencia.inc.php";
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_estado.inc.php";
	
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
	function asignar($idTpLicencia, $idturno){
		global $dbLink;
		$r = new xajaxResponse ();
		
		$turno=new ModeloTurno();		
		$turno->setIdTurno($idturno);
		$turno->setIdTipoLicencia($idTpLicencia);
		
		$etapa=new ModeloEtapa();
		
		$etapa->setIdEtapa($turno->getIdEtapa());
		$etapa->setOrden($etapa->getOrden()+1);
		$etapa->getEtapaByOrden(); 
		
		$turno->setFechaHora(date('Y-m-d H:i:s'));
		$turno->setIdEtapa($etapa->getIdEtapa());
		$turno->Guardar();
		if($turno->getError()){
			$r->mostrarError($turno->getStrError());
			return $r;
		}
		
		$r->mostrarAviso("Se asigno tipo de tramite ".$etapa->getIdEtapa());
		
		limpiaTodo($r);
		return $r;
	}
	$xajax->registerFunction ( "asignar");
	
	function consulta($turno){
		//Busca las personas que no tengan un turno con fecha de dia de hoy
		global $dbLink;
		$r = new xajaxResponse ();
		
		
		
		$query="SELECT t.idTurno, t.turnoExterno, t.fechaHoraCreacion, CONCAT(IFNULL(`primerAp`,'') , ' ' ,IFNULL(`segundoAp`,'') ,' ', IFNULL(`nombres`,''))  AS nombre, 
				u.nombre AS ubicacion, t.idPersona
                FROM turno AS t
                LEFT JOIN ubicacion as u on u.idUbicacion=t.idUbicacion
                LEFT JOIN persona as p
                    ON t.idPersona=p.idPersona 
                WHERE 1 AND t.idEtapa=2 AND t.idTurno=".$turno;
						
		$result=mysqli_query($dbLink, $query);
		if(!$result)
		{
			if(DEVELOPER)
				$r->mostrarError("Ocurrio un error en la busqueda de los datos, intenta tu consulta mas tarde.[" . mysqli_error($dbLink) . "]");
				else
					$r->mostrarError("Ocurrio un error en la busqueda de los datos, intenta tu consulta mas tarde.");
					return $r;
		}
		$idPersona='';
		$filas=2;
		if ($result->num_rows>0)			
			while($row=mysqli_fetch_assoc($result))
			{
				$r->assign("txtTurnoInt","value", $row['idTurno']);
				$r->assign("txtTurnoExt","value", $row['turnoExterno']);
				$r->assign("txtFecha","value", $row['fechaHoraCreacion']);
				$r->assign("txtNombre","value", $row['nombre']);
				$idPersona= $row['idPersona'];
				
				$filas+=1;
			}
		
		
		$Estados=new ModeloTipolicencia();
		$arrEstados=$Estados->getAll();
		
		$slcEstados='';
		if($Estados->getError() || $filas==2)		
			$listadoTramites.='<tr><td colspan="3"> Sin resultados </td></tr>';
		else {
			$filas=2;
			foreach($arrEstados AS $cveTramite=>$nomTramite){
				$listadoTramites.='<tr><td>' . $cveTramite .'<td>'. TildesHtml($nomTramite) . '</td><td><button type="button" class="btn btn-default btn-circle fa fa-check-circle" onclick="asignaTramite('.$cveTramite.','.$filas.')"  data-toggle="tooltip" data-placement="top" title="Asignar tramite"></td>';
				$filas+=1;
			}
		}
		
			
		$r->assign ( "tablaResultados", "innerHTML", $listadoTramites );
		
		
		$r->ocultarMensaje();		
		return $r;
	}
	
	$xajax->registerFunction ( "consulta");
	
	

	
	
	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
function limpiaTodo($r){
		
		$r->assign("txtTurnoInt","value", "");
		$r->assign("txtTurnoExt","value", "");
		$r->assign("txtIdTurno","value", "");
		$r->assign("txtNombre","value", "");
		$r->assign("txtIdTurno","value", "");
		$r->assign("txtTurno","value", "");
		$r->assign("txtFecha","value", "");
		$tablevacia='<tr></tr>';
		$r->assign("tablaResultados","innerHTML",$tablavacia);				
		
	}
	
	
	$xajax->registerFunction ( "limpiaTodo");
	
	$xajax->processRequest();
	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
		$strListaTramites='<tr></tr>';
		
		
		$etapaConfigurada='ninguna';
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
