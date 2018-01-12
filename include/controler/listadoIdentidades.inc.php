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
			U.nombre AS ubicacion ,T.idPersona,E.idEtapa
			FROM `turno` AS T 
			INNER JOIN `etapa` AS E ON E.idEtapa=T.idEtapa 
			LEFT JOIN persona as P ON P.idPersona=T.idPersona 
			LEFT JOIN tipolicencia AS tp ON tp.idTipoLicencia=T.idTipoLicencia 
			LEFT JOIN ubicacion as U ON U.idUbicacion=T.idUbicacion 
			WHERE 1=1 AND  E.idEtapa IN (3,4,5) AND T.idUbicacion=". $objSession->getIdUbicacion()." 
			ORDER BY  T.idTurno DESC ";
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
								<td>';
			switch ($r['idEtapa']){
				
				case 3:	//biograficos
					$strListaTurnos.='<a href="biograficos.php?id=' . $r['idTurno'] . '" title="captura biograficos" class="btn btn-default btn-circle"><i class="fa fa-user text-success"></i></a>';
					break;
				case 4:	//documentos
					$strListaTurnos.='<a href="documentos.php?id=' . $r['idTurno'] . '" title="captura documentos" class="btn btn-default btn-circle"><i class="fa fa-file-text text-success"></i></a>';
					break;
				case 5:	//biometricos
					$strListaTurnos.='<a href="biograficos.php?id=' . $r['idTurno'] . '" title="captura biometricos" class="btn btn-default btn-circle"><i class="fa fa-eye text-success"></i></a>';
					break;
				
			}
			$strListaTurnos.='</td>
							</tr>';
		}
									
									
								
		
	
	
	
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
