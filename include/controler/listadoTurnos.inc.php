<?php

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	
	
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
	
	
	
	$xajax->processRequest();
	
	
	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	
	
	
	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
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
