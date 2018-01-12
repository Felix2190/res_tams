<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	
	require FOLDER_MODEL_EXTEND . 'model.prospecto.inc.php';
	require FOLDER_MODEL_EXTEND . 'model.prospecto_comentario.inc.php';
	require FOLDER_MODEL_EXTEND . 'model.prospecto_producto.inc.php';
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
	#---------------------------------------------------Seccion AJAX--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();

	function registrarProspecto($Contacto, $RazonSocial, $RFC, $Productos, $Comentarios,$Longitud,$Latitud,$categoria, $valor, $probabilidad, $mes)
	{
		global $objSession;
		
		
		
		
		
		
		//global $_NOW_;
		$r=new xajaxResponse();
		
		if($valor<=0)
		{
			$r->mostrarError("El valor anual estimado debe ser mayor a cero.");
			return $r;
		}
		
		if($probabilidad<=0 || $probabilidad>100)
		{
			$r->mostrarError("La probabilidad de &eacute;xito debe estar entre cero y cien.");
			return $r;
		}
		
		
		$Prospecto=new ModeloProspecto();	
				
		$Prospecto->transaccionIniciar();
		
		//$Prospecto->setComentarios($Comentarios);
		$Prospecto->setContactoNombre($Contacto);
		$Prospecto->setEstatusNuevo();
		$Prospecto->setFechaAlta(_NOW_);
		$Prospecto->setFechaUltimaModificacion(_NOW_);
		$Prospecto->setIdUsuarioAlta($objSession->getIdLogin());
		$Prospecto->setIdUsuarioAsignado($objSession->getIdLogin());
		$Prospecto->setRazonSocial($RazonSocial);
		$Prospecto->setRFC($RFC);
		$Prospecto->setLatitud($Latitud);
		$Prospecto->setLongitud($Longitud);
		
		$Prospecto->setCategoria($categoria);
		$Prospecto->setValorAnualEstimado($valor);
		$Prospecto->setProbabilidadExito($probabilidad);
		$Prospecto->setMesCierreEsperado($mes);
		
		$Prospecto->Guardar();
		
		if($Prospecto->getError())
		{
			$r->mostrarAviso($Prospecto->getStrError());
			return $r;
		}
		
		
		if(count($Productos)==0)
		{
			$r->mostrarError("Selecciona por lo menos un producto que se cotice al prospecto.");
			return $r;
		}
		foreach($Productos AS $k=>$idProducto)
		{
			$Producto=new ModeloProspecto_producto();
			$Producto->setIdProspecto($Prospecto->getIdProspecto());
			$Producto->setIdProductoCotizado($idProducto);
			$Producto->Guardar();
			if($Producto->getError())
			{
				$r->mostrarAviso($Producto->getStrError());
				return $r;
			}
		}
		
		if(trim($Comentarios)!="")
		{
			$Comentario=new ModeloProspecto_comentario();
			$Comentario->setComentario(trim($Comentarios));
			$Comentario->setFecha(_NOW_);
			$Comentario->setIdProspecto($Prospecto->getIdProspecto());
			$Comentario->setIdUsuario($objSession->getIdLogin());
			$Comentario->Guardar();
			
			if($Comentario->getError())
			{
				$r->mostrarAviso($Comentario->getStrError());
				return $r;
			}
		}
				
		$Prospecto->transaccionCommit();				
		
		//$r->call("_habilitar");
		$r->mostrarAviso("Prospecto registrado.");
		$r->redirect("prospectoPerfil.php?id=" . $Prospecto->getIdProspecto());
		return $r;
	}

	$xajax->registerFunction("registrarProspecto");


	$xajax->processRequest();

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	$Prospecto=new ModeloProspecto();
	
	$strProductos="";
	
	$query="SELECT idProductoCotizado, identificador FROM producto_cotizado WHERE estatus='vigente' ";
	$result=mysqli_query($dbLink, $query);
	if(!$result)
	{
		die("Error en la consulta de productos.");
	}
	
	//$strProductos.='<option value="">' . $row['nombre'] . '</option>';
	while($row=mysqli_fetch_assoc($result))
	{
		$strProductos.='<option value="' . $row['idProductoCotizado'] . '">' . $row['identificador'] . '</option>';
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


