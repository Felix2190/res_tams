<?php

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	ini_set('memory_limit', '3G'); //
	require_once FOLDER_INCLUDE . 'lib/PHPExcel/PHPExcel.php';

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
// ESTILOS
	function obtenEstiloCelda($estilo) {
	$estiloCelda = new PHPExcel_Style ();
	switch ($estilo) {
		case 'TITULO' :
			$estiloCelda->applyFromArray ( array (
			'font' => array (
			'name' => 'Arial',
			'bold' => true,
			'italic' => true,
			'size' => 18,
			'color' => array (
			'rgb' => '0B6121'
					)
			),
			'fill' => array (
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array (
			'rgb' => 'FFFFFF'
					)
			),
			'alignment' => array (
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			'rotation' => 0,
			'wrap' => TRUE
			)
			) );
			break;

		case 'SUBTITULO' :
			$estiloCelda->applyFromArray ( array (
			'font' => array (
			'name' => 'Arial',
			'bold' => true,
			'size' => 14,
			'color' => array (
			'rgb' => '000000'
					)
			),
			'fill' => array (
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array (
			'rgb' => 'FFFFFF'
					)
			),
			'alignment' => array (
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			'rotation' => 0
			)
			) );
			break;

		case 'TEXTO' :
			$estiloCelda->applyFromArray ( array (
			'font' => array (
			'name' => 'Arial',
			'size' => 12,
			'color' => array (
			'rgb' => '000000'
					)
			),
			'fill' => array (
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array (
			'rgb' => 'FFFFFF'
					)
			),
			'alignment' => array (
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			'rotation' => 0
			)
			) );
			break;

		case 'TABLA1' :
			$estiloCelda->applyFromArray ( array (
			'font' => array (
			'name' => 'Arial',
			'bold' => true,
			'size' => 12,
			'color' => array (
			'rgb' => '0000000'
					)
			),
			'fill' => array (
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array (
			'rgb' => 'A9D0F5'
					)
			),

			'borders' => array (
			'left' => array (
			'style' => PHPExcel_Style_Border::BORDER_DOUBLE,
			'color' => array (
			'rgb' => 'FFFFFF'
					)
			),
			'right' => array (
			'style' => PHPExcel_Style_Border::BORDER_DOUBLE,
			'color' => array (
			'rgb' => 'FFFFFF'
					)
			)
			),
			'alignment' => array (
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			)
			) );
			break;
	}
	return $estiloCelda;
}
	
	function obtenQuery(){
		global $dbLink;
		$query="SELECT DISTINCT
	  		codigo,nombre,precioVenta
	      FROM producto
	   ";
	
	
	$result=mysqli_query($dbLink,$query);
	if(!$result)
	{
		die("Ocurrio un error en la consulta de producto [" . mysqli_error($dbLink) . "][" . $query . "].");
		die("Ocurrio un error en la consulta de productos");
	}
	
	while($row = $result->fetch_array(MYSQL_ASSOC)) {
		$arreglo_filas[] = $row;
	}
	return $arreglo_filas;
	}
	
	function bin2int ( $b ) {
		return ( ord( $b[ 0 ] )
				| ( ord( $b[ 1 ] ) << 8 )
				| ( ord( $b[ 2 ] ) << 16 )
				| ( ord( $b[ 3 ] ) << 24 ) );
	}
	
	function randnum ( $length )
	{
		$o = '';
	
		do {
			$b  = mcrypt_create_iv( 4, MCRYPT_DEV_URANDOM );
			$o .= str_replace( '-', '', bin2int( $b ) );
		} while ( strlen( $o ) < $length );
	
		return substr( $o, 0, $length );
	}
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	$xajax=new xajax();
	
	
	function generaExcel()
	{ 
		global $_NOW_;
	$r = new xajaxResponse ();
	$objPHPExcel = new PHPExcel();
	$indicesTabla=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	$titulos=array("codigo","Nombre","Precio de venta");
	$indice=0;
	$objPHPExcel
	->getProperties()
	->setCreator("SPI")
	->setLastModifiedBy("SPI")
	->setDescription("Reporte de productos y servicios ")
	->setCategory("Reporte excel");
	$objPHPExcel->setActiveSheetIndex(0);
	
	$estiloTitulo=obtenEstiloCelda("TITULO");
	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloTitulo,"A1:A1");
	
	$fila=1;
	$titulo="Reporte";
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$fila.':H'.$fila)->setCellValue("A".$fila,$titulo);
	
	$estiloTitulo=obtenEstiloCelda("TITULO");
	$estiloTabla1=obtenEstiloCelda("TABLA1");
	$estiloSubTitulo=obtenEstiloCelda("SUBTITULO");
	$estiloTexto=obtenEstiloCelda("TEXTO");
	//Fecha
	$fila=3;
	$b =  "Reporte de productos";
	$objPHPExcel->setActiveSheetIndex ( 0 )->mergeCells('A'.$fila.':H'.$fila)->setCellValue ("A" . $fila,$b );
	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloTabla1,"A" . $fila);
	//encabezados
	$fila=5;
	for($a=0; $a<count($titulos);$a++) {
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [$a] . $fila, $titulos[$a] );
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloSubTitulo,$indicesTabla [$a] . $fila);
	}
	
	//Llenar datos celdas
	$indice = 0;
	$fila++;
	$arreglo = obtenQuery();
	for($i=0;$i<count($arreglo);$i++){
		foreach ( $arreglo[$i] as $key => $registro ) {
	
// 			if($key =="fechaAsignacion"){
// 				$fec = explode(" ", $registro);
// 				$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [$indice] . $fila, $fec[0] );
// 			}else{
				$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [$indice] . $fila, utf8_encode($registro ));
			//}
			$objPHPExcel->getActiveSheet ()->setSharedStyle ( $estiloTexto, $indicesTabla [$indice] . $fila . ':' . $indicesTabla [$indice] . $fila );
	
	
			$indice++;
		}
		$fila++;
		$indice=0;
	}
	
	
	
	
	// establece dimensión
	for($i = 'A'; $i <= 'H'; $i++){
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
	}
	// 2016-08-04 10:33:19
	$fecha = str_replace("-", "_", $_NOW_);
	$fecha = str_replace(":", "_", $fecha);
	$fecha = str_replace(" ", "_", $fecha);
	$objPHPExcel->getActiveSheet()->setTitle('Reporte ');
	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	//$nomArchivo='Reporte_productos_'.$fecha;
	
	$nomArchivo='Reporte_productos_'.randnum( 8 );
	$writer->save('tmp/'. $nomArchivo .'.xls');
	//return $nomArchivo.'.xls';
	$r->mostrarAviso( "Reporte generado con exito" );
	$r->redirect ( 'tmp/'. $nomArchivo .'.xls' , 1 );
	//$r->call ("descargar", 'tmp/'. $nomArchivo .'.xls' );
	return $r;
	}	
	
	
	$xajax->registerFunction ( "generaExcel" );
	$xajax->processRequest();
	
	
	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	
	
	
	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	
	$strTabla='';
	
	$query="SELECT idproducto, nombre,codigo, precioVenta, comisionMaxima, unidadesDisponibles FROM producto
			where estatus <> 'baja' LIMIT 50";
	mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
	$result=mysqli_query($dbLink,$query);
	if(!$result)
		die("Ocurrio un error en la consulta de llamadas.");
	
		while($r=mysqli_fetch_assoc($result))
		{	
			
			$strTabla.='
				<tr>
					<td>' . $r['codigo'] . '</td>
					<td>' . $r['nombre'] . '</td>
					<td>' . $r['precioVenta'] . '</td>
					<td>' . $r['comisionMaxima'] . '</td>
					<td>' . $r['unidadesDisponibles'] . '</td>					
					<td>
						<a href="verProducto.php?id=' . $r['idproducto'] . '" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a>
						<a href="registroEntrada.php " class="btn btn-default btn-circle"><i class="fa fa-plus"></i></a>
					</td>
				</tr>';
			
		}
	
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
