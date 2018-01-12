<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	require FOLDER_MODEL_EXTEND . 'model.prospecto.inc.php';
	require FOLDER_MODEL_EXTEND . 'model.prospecto_comentario.inc.php';

	#-----------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------Inicializacion de control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#



	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------Funciones----------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	function procesaAutorizacionProspectos($arregloProspectos)
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
					<a href="prospectoPerfil.php?id=' . $k . '" alt="Perfil" title="Perfil"> <span class="ti-user" ></span> </a>&nbsp;
					<a href="#" data="' . $k . '" alt="Autorizar" title="Autorizar" class="btnAutorizar"> <span class="ti-check" ></span> </a>&nbsp;
					<a href="#" data="' . $k . '" alt="Rechazar" title="Rechazar" class="btnRechazar"> <span class="ti-close" ></span> </a>&nbsp;
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
	
	function autorizaProspecto($idProspecto)
	{
		global $objSession;
		$r=new xajaxResponse();
		
		$Prospecto=new ModeloProspecto();
		$Prospecto->transaccionIniciar();
		$Prospecto->setIdProspecto($idProspecto);
		
		$Comentario=new ModeloProspecto_comentario();
		$Comentario->setIdProspecto($id);
		$Comentario->setComentario("Autorizacion de prospecto");
		$Comentario->setFecha(_NOW_);
		$Comentario->setIdUsuario($objSession->getIdLogin());
		$Comentario->setSistemaY();
		$Comentario->Guardar();
		$Prospecto->setEstatusAutorizado();
		
		$Prospecto->Guardar();
		if($Prospecto->getError())
		{
			$r->mostrarAviso($Prospecto->getStrError());
			return $r;
		}
		
		//$r->mostrarAviso("")
		//$r->ocultarMensaje();
		
		//$r->call("cerrarCampos");
		$Prospecto->transaccionCommit();
		$r->redirect("prospectoAutorizacion.php");		
		return $r;
	}
	$xajax->registerFunction("autorizaProspecto");
	
	function rechazarProspecto($idProspecto)
	{
		global $objSession;
		$r=new xajaxResponse();
	
		$Prospecto=new ModeloProspecto();
		$Prospecto->transaccionIniciar();
		$Prospecto->setIdProspecto($idProspecto);
	
		$Comentario=new ModeloProspecto_comentario();
		$Comentario->setIdProspecto($id);
		$Comentario->setComentario("Rechazo de prospecto");
		$Comentario->setFecha(_NOW_);
		$Comentario->setIdUsuario($objSession->getIdLogin());
		$Comentario->setSistemaY();
		$Comentario->Guardar();
		$Prospecto->setEstatusCancelado();
	
		$Prospecto->Guardar();
		if($Prospecto->getError())
		{
			$r->mostrarAviso($Prospecto->getStrError());
			return $r;
		}
	
		//$r->mostrarAviso("")
		//$r->ocultarMensaje();
	
		//$r->call("cerrarCampos");
		$Prospecto->transaccionCommit();
		$r->redirect("prospectoAutorizacion.php");
		return $r;
	}
	$xajax->registerFunction("rechazarProspecto");

	


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
			WHERE P.estatus='nuevo'";
	$result=mysqli_query($dbLink, $query);
	if(!$record)
		die("Ocurrio un error en la busqueda de prospectos.");
	
	$Listado=array();
	while($row=mysqli_fetch_assoc($result))
	{
		$Listado[$row['Folio']]=$row;
	}
	
	

	$strAutorizacionProspectos=procesaAutorizacionProspectos($Listado);















?>