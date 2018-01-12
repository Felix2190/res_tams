<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	require FOLDER_MODEL_EXTEND . 'model.prospecto.inc.php';

	#-----------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------Inicializacion de control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#



	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------Funciones----------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	function procesaProspectos($arregloProspectos)
	{
		global $objSession;
		$strProspectos="";
		foreach ($arregloProspectos AS $k=>$v)
		{
			switch($v['categoria'])
			{
				case "empresarial":
					$v['categoria']='<span class="label label-default">Empresarial</span>';
					break;
				case "gobiernofederal":
					$v['categoria']='<span class="label label-primary">Gobierno Federal</span>';
					break;
				default:
					$v['categoria']='<span class="label label-success">Gobierno Estatal/Municipal</span>';
			}
			switch($v['Estatus'])
			{
				case "nuevo":
					$v['Estatus']='<span class="label label-default">Nuevo</span>';
					break;
				case "autorizado":
					$v['Estatus']='<span class="label label-primary">Autorizado</span>';
					break;
				case "cancelado":
					$v['Estatus']='<span class="label label-warning">Rechazado</span>';
					break;					
				case "cliente":					
				case "reasignado":
					$v['Estatus']='<span class="label label-success">' . $v['Estatus'] . '</span>';
					break;
			}
			$v['Folio']=str_pad($v['Folio'], 7,"0",STR_PAD_LEFT);
			$strProspectos.='<tr>
				<td class="rt-hide-td" data-rt-column="FOLIO"><a href="prospectoPerfil.php?id=' . $k . '">' . $v['Folio'] . '</a></td>
				<td class="rt-hide-td" data-rt-column="CATEGORIA">' . $v['categoria'] . '</td>
				<td class="rt-hide-td" data-rt-column="FECHA">' . $v['FechaAlta'] . '</td>
				<td  class="rt-hide-td" data-rt-column="RAZONSOCIAL"><a href="prospectoPerfil.php?id=' . $k . '">' . $v['RazonSocial'] . '</a></td>
				<td class="rt-hide-td" data-rt-column="AGENTE">' . $v['Agente'] . '</td>
				<td class="rt-hide-td" data-rt-column="ESTATUS">' . $v['Estatus'] . '</td>
				<td class="rt-hide-td" data-rt-column="VALOR">$&nbsp;' . number_format($v['valor'],2,".",",") . '</td>
				<td class="rt-hide-td" data-rt-column="PROBABILIDAD">' . number_format($v['probabilidad'],2) . '&nbsp;%</td>
				<td class="rt-hide-td" data-rt-column="MES">' . $v['mes'] . '</td>
				<td class="rt-hide-td" data-rt-column="MODIFICACION">' . $v['modificacion'] . '</td>				
				<td class="rt-hide-td" data-rt-column="OPCIONES">
					<a href="prospectoPerfil.php?id=' . $k . '"> <span class="ti-user" ></span> </a>
					<!-- <a href="prospectoAlta.php?id=' . $k . '">Editar</a> -->
				</td>
			</tr>';

		}
		return $strProspectos;
	}




	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------Seccion AJAX--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();

	


	$xajax->processRequest();

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	$query="SELECT 
				P.idProspecto	As Folio,
				P.categoria As categoria,
				P.fechaAlta	As FechaAlta,
				P.razonSocial	As RazonSocial,
				P.estatus	AS Estatus,
				CONCAT_WS(' ',U.first_name, U.last_name)	As Agente,
				P.valorAnualEstimado AS valor,
				P.probabilidadExito AS probabilidad,
				P.mesCierreEsperado AS mes,
				P.fechaUltimaModificacion AS modificacion
			FROM prospecto As P
			INNER JOIN login_user U ON P.idUsuarioAsignado=U.id_login";
			
	$result=mysqli_query($dbLink, $query);
	if(!$record)
		die("Ocurrio un error en la busqueda de prospectos.");
	
	$Listado=array();
	while($row=mysqli_fetch_assoc($result))
	{
		$Listado[$row['Folio']]=$row;
	}
	
	

	$strListadoProspectosRoot=procesaProspectos($Listado);















?>