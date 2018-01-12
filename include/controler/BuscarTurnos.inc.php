<?php

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	require_once FOLDER_MODEL . "extend/model.verificacion_biografica.inc.php";
	require_once FOLDER_MODEL . "extend/model.etapa.inc.php";
	require_once FOLDER_MODEL . "extend/model.turno.inc.php";
	require_once FOLDER_MODEL . "extend/model.tipolicencia.inc.php";

	
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
	
	function armaConsulta($turnoExt,$turnoInt, $nombre,$apMat,$apPat,$fecha,$estatus,$curp){
		$query="SELECT t.idTurno, t.turnoExterno, t.fechaHoraCreacion, CONCAT(IFNULL(`primerAp`,'') , ' ' ,IFNULL(`segundoAp`,'') ,' ', IFNULL(`nombres`,''))  AS nombre, 
				IFNULL(CURP,'') AS CURP,DATE(t.fechaHora) AS fechaHora,IFNULL(e.descripcion,'') AS descripcion,
				IFNULL(u.nombre,'') AS ubicacion, t.idPersona, IFNULL(CONCAT(tp.descripcion,' ', tp.tipo, ' ' , tp.periodo,' meses'),'') as tramite
                FROM turno AS t
                LEFT JOIN ubicacion as u on u.idUbicacion=t.idUbicacion
                LEFT JOIN persona as p
                    ON t.idPersona=p.idPersona
                LEFT JOIN etapa AS e 
                	ON e.idEtapa=t.idEtapa
                LEFT JOIN tipolicencia as tp
                	ON t.idTipoLicencia=tp.idTipoLicencia
				WHERE 1 ";
		if($turnoExt!='' && is_numeric($turnoExt))
			$query.=" AND t.turnoExterno=".$turnoExt;
		
		if($turnoInt!='' && is_numeric($turnoInt))
			$query.=" AND t.idTurno=".$turnoInt;

		if($nombre!='')
			$query.=" AND nombres='".$nombre."'";

		if($apPat!='')
			$query.=" AND primerAp='".$apPat."'";

		if($apMat!='')
			$query.=" AND segundoAp='".$apMat."'";
		
		if($fecha!='' )
			$query.=" AND DATE(t.fechaHora)=".$fecha;
		
		if($curp!='')
			$query.=" AND p.CURP='".$curp ."'";
		
		if($estatus=='imcompleto')
			$query.=" AND (DATE(t.fechaHoraCierre)='1900-01-01' OR DATE(t.fechaHoraCierre)='0000-00-00')";
		else 
			$query.=" AND DATE(t.fechaHoraCierre)!='000-00-00'";
		
		return $query;
	}
	
	function consulta($turnoExt,$turnoInt, $nombre,$apMat,$apPat,$fecha,$estatus,$curp){
		//Busca las personas que no tengan un turno con fecha de dia de hoy
		global $dbLink;
		$r = new xajaxResponse ();
		$query="";
		$r = new xajaxResponse ();
		
		$query=armaConsulta($turnoExt,$turnoInt, $nombre,$apMat,$apPat,$fecha,$estatus,$curp);
		
		
		$result=mysqli_query($dbLink, $query);
		if(!$result)
		{
			if(DEVELOPER)
				$r->mostrarError("Ocurrio un error en la busqueda de los datos, intenta tu consulta mas tarde.[" . mysqli_error($dbLink) . "]");
				else
					$r->mostrarError("Ocurrio un error en la busqueda de los datos, intenta tu consulta mas tarde.");
					return $r;
		}
		$listaTurnos='';
		$filas=0;
		
		if ($result->num_rows>0)			
			while($row=mysqli_fetch_assoc($result))
			{
				
				$listaTurnos.="<tr><td>".TildesHtml($row['idTurno'])."</td>
						<td>".TildesHtml($row['turnoExterno'])."</td>
						<td>".TildesHtml($row['fechaHora'])."</td><td>".TildesHtml($row['nombre'])."</td>
						<td>".TildesHtml($row['CURP'])."</td><td>".TildesHtml($row['descripcion'])."</td>
						<td>".TildesHtml($row['tramite'])."</td><td>Segumiento</td>
								</tr>";
				$filas+=1;
			}
		//$r->mostrarAviso($fecha);
		$r->assign ( "tablaResultados", "innerHTML", $listaTurnos );
		$r->ocultarMensaje();		
		return $r;
	}
	
	$xajax->registerFunction ( "consulta");
	
	

	
	
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
	
		$strListaTramites='<tr></tr>';
		
		
		$etapaConfigurada='ninguna';
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
