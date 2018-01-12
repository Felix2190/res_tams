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
				<td  ><a href="prospectoPerfil.php?id=' . $k . '">' . $v['Folio'] . '</a></td>
				<td  >' . $v['categoria'] . '</td>
				<td  >' . $v['FechaAlta'] . '</td>
				<td  ><a href="prospectoPerfil.php?id=' . $k . '">' . $v['RazonSocial'] . '</a></td>
				<td  >' . $v['Agente'] . '</td>
				<td  >' . $v['Estatus'] . '</td>
				<td  >$&nbsp;' . number_format($v['valor'],2,".",",") . '</td>
				<td  >' . number_format($v['probabilidad'],2) . '&nbsp;%</td>
				<td  >' . $v['mes'] . '</td>
				<td  >' . $v['modificacion'] . '</td>				
				<td  >
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
			INNER JOIN login_user U ON P.idUsuarioAsignado=U.id_login
			WHERE U.id_login=" . $objSession->getIdLogin();
	$result=mysqli_query($dbLink, $query);
	if(!$record)
		die("Ocurrio un error en la busqueda de prospectos.");
	
	$Listado=array();
	while($row=mysqli_fetch_assoc($result))
	{
		$Listado[$row['Folio']]=$row;
	}
	/*
	<th>Folio</th>
	<th>Categor&iacute;a</th>
	<th>Fecha Alta</th>
	<th>Raz&oacute;n Social</th>
	<th>Agente</th>
	<th>Estatus</th>
	<th>Valor Anual Estimado</th>
	<th>Probabilidad de &Eacute;xito</th>
	<th>Mes Esperado de Cierre</th>
	<th>&Uacute;ltima Actualizaci&oacute;n</th>
	*/

	$strListadoProspectos=procesaProspectos($Listado);















?>