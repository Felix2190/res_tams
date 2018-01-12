<?php

	require_once FOLDER_MODEL_EXTEND . "model.ubicacion.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.almacen.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.almacenSalida.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.almacenTraslado.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.almacenHistorial.inc.php";

	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();
	function registroSalida($fecha,$folio,$Ubicacion,$UbicacionNueva,$codigo,$idalmacen,$numeroSerie,$mac,$comentarios)
	{
		global $_NOW_;
		global $objSession;
		$r=new xajaxResponse();
		
		$buscar=new ModeloAlmacenTraslado();
		if($folio !=""){
		$encontrado =$buscar->buscarByFolio($folio);
		if($encontrado ){			
			$r->mostrarAviso("Este folio ya se registro anteriormente.");
			return $r;
		}
		}
				
		
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
		
		
		$almacen=new ModeloAlmacen();
		$almacen->setIdalmacen($idalmacen);
		$almacen->setEstatusTraslado();
		$almacen->setIdUbicacion($UbicacionNueva);
		$almacen->Guardar();
		if($almacen->getError())
		{
			$mensaje = $almacen->getStrError();
			$r->mostrarAviso($mensaje);
			return $r;
		}
		
		$entrada=new ModeloAlmacenTraslado();
		//$entrada->setIdalmacenTraslado($idalmacenTraslado);
		$entrada->setIdalmacen($idalmacen);
		$entrada->setFechaAlta($fecha);
		$entrada->setFolio($folio);
		$entrada->setIdLoginMemberSalida($objSession->getIdLogin());
		$entrada->setNombreLoginMemberSalida($objSession->getUserName());
		$entrada->setTipoSalida();
		$entrada->setIdUbicacion($Ubicacion);
		$entrada->setIdUbicacionNueva($UbicacionNueva);
		//$entrada->setCodigo($codigo);
		//$entrada->setNumeroSerie($numeroSerie);
		//$entrada->setMac($mac);
		$entrada->setComentariosSalida($comentarios);
		$entrada->setEstatusTraslado();		
		
		$entrada->Guardar();
		if($entrada->getError())
		{
			$mensaje = $entrada->getStrError();
			$r->mostrarAviso($mensaje);
			return $r;
		}
		
		$historial=new ModeloAlmacenHistorial();
		//$historial->setIdalmacenHistorial($idalmacenHistorial);
		$historial->setFechaAlta($_NOW_);
		//$historial->setTipo($tipo);
		//$historial->setTipoSalida();
		//$historial->setTipoEntrada();
		$historial->setTipoTrasladoSalida();
		$historial->setIdProducto($almacen->getIdProducto());
		$historial->setNumeroSerie($almacen->getNumeroSerie());
		$historial->setMac($almacen->getMac());
		$historial->setIdLoginMember($objSession->getIdLogin());
		$historial->setNombreLoginMember($objSession->getUserName());
		$historial->setIdUbicacion($Ubicacion);
		$historial->setEstatusTraslado();
		$historial->setResponsable($objSession->getUserName());
		//$historial->setCantidad($cantidad);
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
		return $r;

	}
	$xajax->registerFunction("registroSalida");
	
	function registroRecepcion($fecha,$folio,$Ubicacion,$idalmacenT,$comentarios)
	{
		global $_NOW_;
		global $objSession;
		$r=new xajaxResponse();
	
		$buscar=new ModeloAlmacenTraslado();
		
// 		$e=new ModeloAlmacen();
// 		$e->setIdalmacen($idalmacen);
// 		$e->setEstatusTraslado();
// 		$e->setIdUbicacion($UbicacionNueva);
// 		$e->Guardar();
// 		if($e->getError())
// 		{
// 			$mensaje = $e->getStrError();
// 			$r->mostrarAviso($mensaje);
// 			return $r;
// 		}
	
		$entrada=new ModeloAlmacenTraslado();
		$entrada->setIdalmacenTraslado($idalmacenT);
		$entrada->setIdLoginMemberRecepcion($objSession->getIdLogin());
		$entrada->setNombreLoginMemberRecepcion($objSession->getUserName());
		$entrada->setFechaRecepcion($fecha);
		//$entrada->setTipo($tipo);
		//$entrada->setTipoSalida();
		$entrada->setTipoEntrada();
		$entrada->setIdUbicacionNueva($Ubicacion);
		$entrada->setComentariosEntrada($comentarios);
		$entrada->setEstatusDisponible();
	
		$entrada->Guardar();
		if($entrada->getError())
		{
			$mensaje = $entrada->getStrError();
			$r->mostrarAviso($mensaje);
			return $r;
		}
		

		$almacen=new ModeloAlmacen();
		$almacen->setIdalmacen($entrada->getIdAlmacen());
		$almacen->setEstatusDisponible();
		$almacen->Guardar();
		if($almacen->getError())
		{
			$mensaje = $almacen->getStrError();
			$r->mostrarAviso($mensaje);
			return $r;
		}
		
		$historial=new ModeloAlmacenHistorial();
		//$historial->setIdalmacenHistorial($idalmacenHistorial);
		$historial->setFechaAlta($_NOW_);
		//$historial->setTipo($tipo);
		//$historial->setTipoSalida();
		//$historial->setTipoEntrada();
		$historial->setTipoTrasladoEntrada();
		$historial->setIdProducto($almacen->getIdProducto());
		$historial->setNumeroSerie($almacen->getNumeroSerie());
		$historial->setMac($almacen->getMac());
		$historial->setIdLoginMember($objSession->getIdLogin());
		$historial->setNombreLoginMember($objSession->getUserName());
		$historial->setIdUbicacion($Ubicacion);
		$historial->setEstatusDisponible();
		$historial->setResponsable($objSession->getUserName());
		//$historial->setCantidad($cantidad);
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
		return $r;
	
	}
	$xajax->registerFunction("registroRecepcion");
	
	
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
