<?php

require_once FOLDER_MODEL . "extend/model.producto.inc.php";
//echo FOLDER_MODEL . "extend/model.producto.inc.php";
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#


	function existeOperadorUbicacion($idOperador,$idUbicacion,$rol){		
			$Operador_ubicacion = new ModeloOperador_ubicacion();
		 	$result = $Operador_ubicacion->existeOperadorUbicacion($idOperador, $idUbicacion);
			return  $result;		
	}

	#----------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();

	 function asociar($idLoginMember,$idUbicacion)
	{
		global $_NOW_;
		global $objSession;
		$r=new xajaxResponse();
		//$UbicacionRecepcion=new ModeloRecepcion_ubicacion();

		
		
		$r->ocultarMensaje();
		$r->mostrarAviso($msg);

		//$UbicacionRecepcion=new ModeloRecepcion_ubicacion();
		
		
		return $r;

	}
	$xajax->registerFunction("asociar");

	$xajax->processRequest();


	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#




	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	$buscar = new ModeloProducto();
	$mensaje="";
	if(isset($_POST) && $_POST){//
		$codigo = $_POST['codigo'];
		$band = $buscar->buscarByCodigo($codigo);
		if(!$band){
			$producto = new ModeloProducto();
		
			$nombre = $_POST['nombre'];
				
			$tipo = $_POST['tipo'];
			$costoOrigen = $_POST['costoOrigen'];
			$costoFobmx = $_POST['costoFobmx'];
			$costoMx = $_POST['costoMx'];
			$margenPesos = $_POST['margenPesos'];
			$margenPorcentaje = $_POST['margenPorcentaje'];
			$precioVenta = $_POST['precioVenta'];
			$inventariable = $_POST['inventariable'];
			$comisionMaxima = $_POST['comisionMaxima'];
			$descuentoMaximo = $_POST['descuentoMaximo'];
			$estatus = $_POST['estatus'];		
			$descripcion = $_POST['descripcion'];
			//$producto->setIdproducto($idproducto);
			$producto->setIdLoginMember($objSession->getIdLogin());
			$producto->setCodigo($codigo);
			$producto->setNombre($nombre);		//
			$producto->setDescripcion($descripcion);		//
			$producto->setTipo($tipo);
			//$producto->setTipoProducto();
			//$producto->setTipoServicio();
			$producto->setCostoOrigen($costoOrigen);
			$producto->setCostoFOBMXUS($costoFobmx);
			$producto->setCostoMXN($costoMx);
			$producto->setMargenPesos($margenPesos);
			$producto->setMargenPorcentaje($margenPorcentaje);
			$producto->setPrecioVenta($precioVenta);
			$producto->setInventariable($inventariable);
			echo 
			//$producto->setInventariableSi();
			//$producto->setInventariableNo();
			$producto->setComisionMaxima($comisionMaxima);
			$producto->setDescuentoMaximo($descuentoMaximo);
			$producto->setEstatus($estatus);
			//$producto->setEstatusDisponible();
			//$producto->setEstatusAgotado();
			//$producto->setEstatusBaja();		
			//$producto->setUnidadesDisponibles($unidadesDisponibles);
			//$producto->setNumeroSerie($numeroSerie);
			//$producto->setUbicacion($ubicacion);
			//$producto->setFechaBaja($fechaBaja);
			//var_dump($objSession);
			
			$dir_subida = './images/productos/';
			$fichero_subido = $dir_subida . basename($_FILES['foto']['name']);				
			if (move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido)) {
				$producto->setFoto($_FILES['foto']['name']);
				//echo "El fichero es válido y se subió con éxito.\n";
	// 			[name] => transportador.jpg
	// 			[type] => image/jpeg
	// 			[tmp_name] => C:\xampp\tmp\phpB125.tmp
	// 			[error] => 0
	// 			[size] => 215204
			} else {
				//echo "¡Posible ataque de subida de ficheros!\n";
			}
			
			//brochure
			$dir_su = './doctos/brochure/';
			$fichero_subido = $dir_su . basename($_FILES['brochure']['name']);
			if (move_uploaded_file($_FILES['brochure']['tmp_name'], $fichero_subido)) {
				$producto->setBrochure($_FILES['brochure']['name']);
			} else {
				//echo "¡Posible ataque de subida de ficheros!\n";
			}
			
			$producto->Guardar();
			if($producto->getError())
			{	
				$mensaje = $producto->getStrError();
				$_JAVASCRIPT_OUT = '
				$(document).ready(function()
				{
					mostrarError("' . $mensaje . ');
				});
				';
		
			}else{
				$_JAVASCRIPT_OUT = '
				$(document).ready(function()
				{
					mostrarAviso("El registro se almaceno correctamente.");
				});
						';
			}		
		}else{
			$_JAVASCRIPT_OUT = '
				$(document).ready(function()
				{
					mostrarAviso("El c&oacute;digo ya ha sido registrado.");
				});
					';
		}
	}
	else{
			

}
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
