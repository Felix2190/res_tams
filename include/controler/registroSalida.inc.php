<?php

	require_once FOLDER_MODEL_EXTEND . "model.ubicacion.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.almacen.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.almacenSalida.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.almacenHistorial.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.producto.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.almacenSalidaEnvio.inc.php";
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();
	function registroSalida($fecha,$folio,$Ubicacion,$codigo,$idalmacen,$inventariable,$numeroSerie,$mac,$comentarios,$txtsalida,$tipoSalida ,$paqueteria ,$guia ,$especifique ,$personaRecibe )
	{
		global $_NOW_;
		global $objSession;
		$r=new xajaxResponse();
		
		$salida=new ModeloAlmacenSalida();
		$salida->transaccionIniciar();
		
		$buscar=new ModeloAlmacenSalida();
		if($folio !=""){
			$encontrado =$buscar->buscarByFolio($folio);
			if($encontrado ){			
				$r->mostrarAviso("Este folio ya se registro anteriormente.");
				return $r;
			}
		}
		//if($folio !=""){
			//$encontrado = $buscar->buscarByFolio($folio);		
			//if($encontrado){
				//$r->mostrarAviso("El folio ya ha sido registrado anteriormente.");
				//return $r;
		///	}
		//}
		
		if($inventariable=='si'){
			if($numeroSerie !=""){
				$encontrado =$buscar->buscarByNoSerie($numeroSerie);
				if($encontrado){
					$r->mostrarAviso("El numero de serie ya ha sido registrado anteriormente.");
					return $r;
				}
			}			
				
			if($mac !=""){
				$encontrado =$buscar->buscarByMac($mac);
				if($encontrado){
					$r->mostrarAviso("El MAC ya ha sido registrado anteriormente.");
					return $r;
				}
			}			
		}
		
		$entrada=new ModeloAlmacen();
		$entrada->setIdalmacen($idalmacen);
		//$entrada->setEstatusAsignado();//$txtsalida
		$entrada->setEstatus($txtsalida);//
		$entrada->Guardar();
		if($entrada->getError())
		{
			$mensaje = $entrada->getStrError();
			$r->mostrarAviso($mensaje);
			return $r;
		}
						
		//$salida->setIdalmacenSalida($idalmacenSalida);
		$salida->setIdalmacen($idalmacen);
		$salida->setFechaAlta($fecha);
		$salida->setFolio($folio);
		$salida->setIdLoginMember($objSession->getIdLogin());
		$salida->setNombreLoginMember($objSession->getUserName());
		$salida->setIdUbicacion($Ubicacion);
		//$salida->setCodigo($codigo);
		//$salida->setNumeroSerie($numeroSerie);
		//$salida->setMac($mac);
		$salida->setComentarios($comentarios);
		//$salida->setEstatus($estatus);
		$salida->setEstatusDisponible();
		//$salida->setEstatusBaja();
		$salida->setSalida($txtsalida);
// 		setSalidaConsignacion();
// 		setSalidaRenta();
// 		setSalidaVenta();
// 		setSalidaStock();
		$salida->setTipoSalida($tipoSalida);
// 		setTipoSalidaPersonal();
// 		setTipoSalidaPaqueteria();
// 		setTipoSalidaOtro();
		$salida->setPersonaRecibe($personaRecibe);
		$salida->setEspecifique($especifique);
		
		$salida->Guardar();
		if($salida->getError())
		{
			$mensaje = $salida->getStrError();
			$r->mostrarAviso($mensaje);
			return $r;
		}
		if($tipoSalida=="paqueteria"){		
			$envio=new ModeloAlmacenSalidaEnvio();
			//$envio->setIdalmacenSalidaEnvio($idalmacenSalidaEnvio);
			$envio->setFechaAlta($_NOW_);
			$envio->setIdLoginMember($objSession->getIdLogin());
			$envio->setPaqueteria($paqueteria);
			$envio->setGuia($guia);
			//$envio->setEstatus($estatus);
			$envio->setEstatusDisponible();
			//$envio->setEstatusBaja();
			$envio->setIdalmacensalida($salida->getIdalmacenSalida());
			$envio->Guardar();
			if($envio->getError())
			{
				$mensaje = $envio->getStrError();
				$r->mostrarAviso($mensaje);
				return $r;
			}
		}
		$producto=new ModeloProducto();
		$producto->setIdProducto($entrada->getIdProducto());
		$cantidad = $producto->getUnidadesDisponibles();
		if(is_numeric($cantidad)) {
			$cantidad-=1;
		}else{
			//$cantidad=1;
		}
		$producto->setUnidadesDisponibles($cantidad);
		$producto->Guardar();
		if($producto->getError())
		{
			$mensaje = $producto->getStrError();
			$r->mostrarAviso($mensaje);
			return $r;
		}
		
		
		$historial=new ModeloAlmacenHistorial();
		//$historial->setIdalmacenHistorial($idalmacenHistorial);
		$historial->setFechaAlta($_NOW_);
		//$historial->setTipo($tipo);
		$historial->setTipoSalida();
		//$historial->setTipoEntrada();
		//$historial->setTipoTraslado();
		$historial->setIdProducto($entrada->getIdProducto());
		$historial->setNumeroSerie($numeroSerie);
		$historial->setMac($mac);
		$historial->setIdLoginMember($objSession->getIdLogin());
		$historial->setNombreLoginMember($objSession->getUserName());
		$historial->setIdUbicacion($Ubicacion);
		$historial->setEstatus($txtsalida);
		$historial->setResponsable($personaRecibe);
		//$historial->setCantidad($cantidad);
		$historial->Guardar();
		if($historial->getError())
		{
			$mensaje = $historial->getStrError();
			$r->mostrarAviso($mensaje);
			return $r;
		} 
		$salida->transaccionCommit();
		
		$r->ocultarMensaje();
		$r->mostrarAviso("Informaci&oacute;n guardada con exito.");
		$r->redirect("listadoProductos.php");
		return $r;

	}
	$xajax->registerFunction("registroSalida");

	$xajax->processRequest();


	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#




	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	$Ubicacion=new ModeloUbicacion();
	$ub = $Ubicacion->getAll();
	if($Ubicacion->getError())
	{
		$ub=array('0'=>$Tipos->getStrError());
	}
	
	$slcUbicaciones='<option value="0">Selecciona una opci&oacute;n.</option>';
	foreach($ub As $idUbicacion=>$nombre)
		$slcUbicaciones.='<option value="' . $idUbicacion . '">' . $nombre . '</option>';
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
