<?php
	set_time_limit(300);
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	
 	require_once FOLDER_MODEL_EXTEND . "model.producto.inc.php";
	
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	function microtime_float()
	{
	list($useg, $seg) = explode(" ", microtime());
	return ((float)$useg + (float)$seg);
	}
	
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	
	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	
	
	
	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#			
	
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	global $_NOW_;
	global $objSession;	
	$tiempo_inicio = microtime_float();
	$total=0;
	$correctos=0;
	$incorrectos=0;
	$error="";
	$errorMotivo="";
	$insertados ="";
	$noinsertados ="";
	$totalRegistros ="";
	if(isset($_POST)){
		if(isset($_FILES)&& (!empty($_FILES))){
			if(($_FILES['archivo']['size'])>0){
	$tipo = $_FILES['archivo']['type'];	
	$tamanio = $_FILES['archivo']['size'];	
	$archivotmp = $_FILES['archivo']['tmp_name'];	
	$lineas = file($archivotmp);
	$i=0;
	
	foreach ($lineas as $linea_num => $linea)	 	
	{ 
		//echo " i ". $i;
		$errorMotivo="";
	   /*si es diferente a 0 significa que no se encuentra en la primera linea*/	   
	   if($i != 0){
	   //	echo " entra if ";
	   	//echo $linea;
	   		
	   		$datos = explode("|",$linea);
	   		$codigo=trim($datos[0]);
			$nombre= trim($datos[1]);// ccoutbound_llamada fecha
			$Imagen= trim($datos[2]);
			$CostoOrigen= trim($datos[3]);// ccoutbound_llamada idCcoutboundCatEstatus ccoutbound_cat_estatus
			$CostoFOBMXUSD= trim($datos[4]);// ccoutbound_llamada idCcoutboundCatResultado ccoutbound_cat_resultado
			$CostoMXP= trim($datos[5]);//nota// comentario
			$PrecioVentaUSD= trim($datos[6]);//satisfecho// servicio
			$PrecioVentaMXP= trim($datos[7]);//notaQueja
			$MargenMXP= trim($datos[8]);//Beneficiario_tarjeta numTarjeta			
			$Margen= trim($datos[9]);// persona TEL_CASA_CODIGO TEL_CASA
			$Comisi¢nMaxima= trim($datos[10]);// persona TEL_MOVIL_CODIGO TEL_MOVIL			
			$tipo= trim($datos[11]);// persona TEL_MOVIL_CODIGO TEL_MOVIL
						 
			//if($idBeneficiario>0 && $idLoginMember>0 && $idCcoutboundCatEstatus>0){		
				$producto = new ModeloProducto();								
				//$producto->setIdproducto($idproducto);
				//$producto->setIdLoginMember($idLoginMember);
				$producto->setCodigo($codigo);
				$producto->setNombre($nombre);
				//$producto->setFoto($foto);
				$producto->setTipo($tipo);
				//$producto->setTipoProducto();
				//$producto->setTipoServicio();
				$producto->setCostoOrígen($CostoOrigen);
				$producto->setCostoFOBMXUS($CostoFOBMXUSD);
				$producto->setCostoMXN($CostoMXP);
				$producto->setMargenPesos($MargenMXP);
				$producto->setMargenPorcentaje($margen);
				$producto->setPrecioVenta($PrecioVentaMXP);
				//$producto->setInventariable($Inventariable);
				if($tipo=="producto")				
					$producto->setInventariableSi();
				else
					$producto->setInventariableNo();
				
				$producto->setComisionMaxima($Comisi¢nMaxima);
				//$producto->setDescuentoMaximo($de);
				//$producto->setEstatus($estatus);
				$producto->setEstatusDisponible();
				//$producto->setEstatusAgotado();
				//$producto->setEstatusBaja();
				//$producto->setUnidadesDisponibles($unidadesDisponibles);
				//$producto->setNumeroSerie($numeroSerie);
				//$producto->setIdUbicacion($idUbicacion);
				//$producto->setFechaBaja($fechaBaja);								
				
				
				$producto->Guardar();
				if($producto->getError()){
					$errorMotivo .= $producto->getStrError();
					$incorrectos++;
					$lineaError=$i;
					$error.='
				<tr>
					<td>' . ($lineaError+1) . '</td>
					<td>' . $codigo. '</td>
					<td>' . $producto .'</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>';
						
				}
										
				$correctos++;
			//}else{
						//	}
	   }
	   $i++;
	   
	}
	$insertados ="Archivos insertados correctamente:".$correctos;
	$noinsertados ="Archivos no insertados:".$incorrectos;
	$totalRegistros ="Total de registros:".($i-1);
	$tiempo_fin = microtime_float();
	$tiempo = $tiempo_fin - $tiempo_inicio;
	echo "Tiempo empleado: " . ($tiempo_fin - $tiempo_inicio);
	 
	}
	}
}