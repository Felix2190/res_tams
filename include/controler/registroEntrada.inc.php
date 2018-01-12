<?php

	require_once FOLDER_MODEL_EXTEND . "model.ubicacion.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.almacen.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.almacenHistorial.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.producto.inc.php";
	
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();

	 function entrada($fecha,$folio,$Ubicacion,$tipo,$idcodigo,$inventariable,$numeroSerie,$mac,$comentarios)
	{
		global $_NOW_;
		global $objSession;
		$r=new xajaxResponse();
		
		$buscar=new ModeloAlmacen();
		if($folio !=""){
			$encontrado = $buscar->buscarByFolio($folio);
			//var_dump($encontrado);
			if($encontrado){
				$r->mostrarAviso("El folio ya ha sido registrado anteriormente.");
				return $r;
			}
		}
		
		if($inventariable=='si'){
			if($numeroSerie !=""){
				$encontrado =$buscar->buscarByNoSerie($numeroSerie);
				if($encontrado){
					$r->mostrarAviso("El numero de serie ya ha sido registrado anteriormente.");
					return $r;
				}
			}
// 			else{
// 				$r->mostrarAviso("El numero de serie debe ser capturado.");
// 				return $r;
// 			}
			
			if($mac !=""){
				$encontrado =$buscar->buscarByMac($mac);
				if($encontrado){
					$r->mostrarAviso("El MAC ya ha sido registrado anteriormente.");
					return $r;
				}
			}
// 			else{
// 				$r->mostrarAviso("El numero de serie debe ser capturado.");
// 				return $r;
// 			}
		}
		$entrada=new ModeloAlmacen();
		

		//$entrada->setIdalmacen($idalmacen);
		$entrada->setFechaAlta($fecha);
		$entrada->setFolio($folio);
		
		$entrada->setIdLoginMember($objSession->getIdLogin());
		$entrada->setNombreLoginMember($objSession->getUserName());
		$entrada->setIdUbicacion($Ubicacion);
		$entrada->setidProducto($idcodigo);
		$entrada->setInventariable($inventariable);
		//$entrada->setInventariableSi();
		//$entrada->setInventariableNo();
		$entrada->setNumeroSerie($numeroSerie);
		$entrada->setMac($mac);
		$entrada->setComentarios($comentarios);
		//$entrada->setEstatus($estatus);
		$entrada->setEstatusDisponible();
		//$entrada->setEstatusAsignado();
		//$entrada->setEstatusBaja();
		$entrada->Guardar();
		if($entrada->getError())
		{
			$mensaje = $entrada->getStrError();
			$r->mostrarAviso($mensaje);
			return $r;
		}
		
		$producto=new ModeloProducto();
		$producto->setIdProducto($idcodigo);
		$cantidad = $producto->getUnidadesDisponibles();
		if(is_numeric($cantidad)) {
			$cantidad+=1;
		}else{
			$cantidad=1;
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
		//$historial->setTipoSalida();
		$historial->setTipoEntrada();
		//$historial->setTipoTraslado();
		$historial->setIdProducto($idcodigo);
		$historial->setNumeroSerie($numeroSerie);
		$historial->setMac($mac);
		$historial->setIdLoginMember($objSession->getIdLogin());
		$historial->setNombreLoginMember($objSession->getUserName());
		$historial->setIdUbicacion($Ubicacion);
		//$historial->setCantidad($cantidad);
		$historial->setResponsable($objSession->getUserName());
		$historial->Guardar();
		if($historial->getError())
		{
			$mensaje = $historial->getStrError();
			$r->mostrarAviso($mensaje);
			return $r;
		}
		
		$r->ocultarMensaje();
		$r->mostrarAviso("Informaci&oacute;n guardada con exito.");
		$r->redirect("listadoProductos.php");
		//$UbicacionRecepcion=new ModeloRecepcion_ubicacion();
		
		
		return $r;

	}
	$xajax->registerFunction("entrada");

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
