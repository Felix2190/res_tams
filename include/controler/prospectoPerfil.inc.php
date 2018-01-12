<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	require FOLDER_MODEL_EXTEND . 'model.prospecto_comentario.inc.php';
	require FOLDER_MODEL_EXTEND . 'model.prospecto.inc.php';
	
	#-----------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------Inicializacion de control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#



	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------Funciones----------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	
	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Procesamiento de Formulario (POST)----------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	if(isset($_GET['files']))
	{
		
		$error = false;
		$files = array();
		
		$uploaddir = '../include/propuestas/';
		foreach($_FILES as $file)
		{
			$fileName=$_GET['id'] . "_" . date("Ymd") . "_" . basename($file['name']);
			if(move_uploaded_file($file['tmp_name'], $uploaddir . $fileName))
			{
				$files[] = $uploaddir .$file['name'];
			}
			else
			{
				$error = true;
			}
		}
		
		if(!$error)
		{
			$Prospecto=new ModeloProspecto();
			$Prospecto->setIdProspecto($_GET['id']);
			$Prospecto->setFilePropuesta($fileName);
			$Prospecto->setFechaUltimaModificacion(_NOW_);
			$Prospecto->Guardar();
			
			$Comentario=new ModeloProspecto_comentario();
			$Comentario->setIdProspecto($idProspecto);
			$Comentario->setComentario("Se sube archivo de propuesta.");
			$Comentario->setFecha(_NOW_);
			$Comentario->setIdUsuario($objSession->getIdLogin());
			$Comentario->setSistemaY();
			$Comentario->Guardar();
			
			$data = array('success' => 'El archivo fue almacenado correctamente.','fileName'=>$fileName, 'formData' => $_POST);
		}
		else
		{
			$data = array('error' => 'Ocurrio un error en el almacenamiento del archivo.');
		}
		
		die(json_encode($data));
	}
	
	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------Seccion AJAX--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();
	
	function siguienteEtapa($idProspecto)
	{
		global $objSession;
		$r=new xajaxResponse();
		$Prospecto=new ModeloProspecto();
		$Prospecto->setIdProspecto($idProspecto);		
		$estatusActual=$Prospecto->getEstatus();		
		$estatusSiguiente=$Prospecto->getNextEstatus();
		
		if($estatusActual=="propuesta"&&$Prospecto->getFilePropuesta()=="")
		{
			$r->mostrarError("Aun no se sube el archivo con la propuesta.");
			return $r;
		}
		
		$Prospecto->setEstatus($estatusSiguiente);
		$Prospecto->Guardar();
		if($Prospecto->getError())
		{
			$r->mostrarError($Prospecto->getStrError());
			return $r;
		}
		
		$Comentario=new ModeloProspecto_comentario();
		$Comentario->setIdProspecto($idProspecto);
		$Comentario->setComentario("Cambio en etapa de venta de " . $estatusActual . " a " . $estatusSiguiente);
		$Comentario->setFecha(_NOW_);
		$Comentario->setIdUsuario($objSession->getIdLogin());
		$Comentario->setSistemaY();
		$Comentario->Guardar();
				
		$newBtn="";
		switch($Prospecto->getEstatus())
		{
			case "autorizado":
				$newBtn='Siguiente etapa (Informaci&oacute;n)';
				break;
			case "informacion":
				$newBtn='Siguiente etapa (Propuesta)';
				break;
			case "propuesta":
				$newBtn='Siguiente etapa (Contrato)';
				break;
			case "contrato":				
			case "cliente":				
			case "denegado":				
			case "pospuesto":				
				$newBtn="";
		}
		if($newBtn!="")
			$r->assign("btnNext", "innerHTML", $newBtn);
		else
			$r->assign("btnNext", "style.display", "none");
		
		if($Prospecto->getEstatus()=="propuesta")
		{
			$r->assign("divFilePropuesta", "style.display","");			
		}
		else			
		{
			$r->assign("divFilePropuesta", "style.display","none");
		}
		$r->call("mostrarComentario",$objSession->getFirstName() . " " . $objSession->getLastName(),_NOW_,$Comentario->getComentario(),true);
		$r->assign("lblEstatus", "innerHTML", ucfirst($estatusSiguiente));
		return $r;
	}
	$xajax->registerFunction("siguienteEtapa");
	
	function aceptarCambios($id, $idAgente, $estatus)
	{
		global $objSession;
		$r=new xajaxResponse();
		
		$Prospecto=new ModeloProspecto();		
		$Prospecto->transaccionIniciar();		
		$Prospecto->setIdProspecto($id);		
		if($estatus!=""&&$Prospecto->getEstatus()!=$estatus)
		{	
			$Comentario=new ModeloProspecto_comentario();
			$Comentario->setIdProspecto($id);
			$Comentario->setComentario("Cambio de estatus de " . $Prospecto->getEstatus() . " a " . $estatus);
			$Comentario->setFecha(_NOW_);
			$Comentario->setIdUsuario($objSession->getIdLogin());
			$Comentario->setSistemaY();
			$Comentario->Guardar();
			$Prospecto->setEstatus($estatus);
		}
		
		if($Prospecto->getIdUsuarioAsignado()!=$idAgente)
		{
			$Us=new ModeloLogin_user();			
			$Us->setId_login($Prospecto->getIdUsuarioAsignado());
			$Anterior=$Us->getFirst_name() . " ". $Us->getLast_name();			
			$Us->setId_login($idAgente);
			$Nuevo=$Us->getFirst_name() . " ". $Us->getLast_name();			
			$Comentario=new ModeloProspecto_comentario();
			$Comentario->setIdProspecto($id);
			$Comentario->setComentario("Reasignaci&oacute;n de agente de " . $Anterior . " a " . $Nuevo);
			$Comentario->setFecha(_NOW_);
			$Comentario->setIdUsuario($objSession->getIdLogin());
			$Comentario->setSistemaY();
			$Comentario->Guardar();
			$Prospecto->setIdUsuarioAsignado($idAgente);
		}
		
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
		$r->redirect("prospectoPerfil.php?id=" . $Prospecto->getIdProspecto());
		
		return $r;		
	}
	$xajax->registerFunction("aceptarCambios");
	
	function agregarComentario($idProspecto,$comentario)
	{
		global $objSession;
		$r=new xajaxResponse();
		
		$Comentario=new ModeloProspecto_comentario();
		$Comentario->setIdProspecto($idProspecto);
		$Comentario->setComentario($comentario);
		$Comentario->setFecha(_NOW_);
		$Comentario->setIdUsuario($objSession->getIdLogin());
		$Comentario->Guardar();
		if($Comentario->getError())
		{
			$r->mostrarAviso($Comentario->getStrError());
			return $r;
		}
		$r->call("mostrarComentario",$objSession->getFirstName() . " " . $objSession->getLastName(),_NOW_,$comentario,false);
		
		return $r;		
	}
	$xajax->registerFunction("agregarComentario");	


	$xajax->processRequest();

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	if($objSession->getIdRol()>=4)
	{
		$isRoot=true;
	}
	else
	{
		$isRoot=false;
	}
	
	
	if(!isset($_GET['id'])||!ctype_digit($_GET['id']))
	{
		header("Location: dashboard.php");
		die();
	}
	
	$Prospecto=new ModeloProspecto();
	$Prospecto->setIdProspecto($_GET['id']);
	
	$strProspectoComentarios='';
	
	
	foreach($Prospecto->getMensajes() AS $idMensaje=>$datos)
	{
		$strProspectoComentarios.='
			<div class="comment-content">
				<div class="comment-time">
					<i class="fa fa-' . ($datos['sistema']=="N"?"user":"gear") . '"></i> ' . $datos['usuario'] . ' &nbsp;&nbsp;<i class="fa fa-clock-o"></i> ' . $datos['fechaHora'] . '
				</div>
				<div class="comment-msg">
					' . $datos['comentario'] . '
				</div>
				<br>
			</div>';
	}
	
	$query="SELECT CONCAT_WS(' ',first_name,last_name) AS nombre, id_login FROM login_user ORDER BY nombre ASC";
	$result=mysqli_query($dbLink, $query);
	if(!result)
	{
		die("Ocurrio un error en la busqueda de usuario.");
	}
	
	$strListaAgentes="";
	
	while($row=mysqli_fetch_assoc($result))
	{
		$strListaAgentes.='<option value="' . $row['id_login'] . '" ' . ($row['id_login']==$Prospecto->getIdUsuarioAsignado()?"selected":"") . '>' . $row['nombre'] . '</option>';
	}
	
	$strProductos='';
	
	$query="SELECT identificador FROM producto_cotizado WHERE idProductoCotizado IN(SELECT idProductoCotizado FROM prospecto_producto WHERE idPRospecto=" . $Prospecto->getIdProspecto() . ")";
	$result=mysqli_query($dbLink, $query);
	if(!result)
	{
		die("Ocurrio un error en la busqueda de productos.");
	}
	
	
	while($row=mysqli_fetch_assoc($result))
	{
		$strProductos.='<span class="label label-default">' . $row['identificador'] . '</span>&nbsp;';
	}
	
	
	
	
	


	#-----------------------------------------------------------------------------------------------------------------#
	#------------------------------------- JavaScript array initialization     ---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	$_JAVASCRIPT_OUT="";

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Translate on JavaScript---------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	

	//You use the variable $_JAVASCRIPT_OUT
	//if it's not defined, define it, else concat with the existing one.
	
	/*
	if(!isset($_JAVASCRIPT_OUT))
		$_JAVASCRIPT_OUT="";
	$_JAVASCRIPT_OUT.= generaTranslateJS(array("Logging In"));
	*/


