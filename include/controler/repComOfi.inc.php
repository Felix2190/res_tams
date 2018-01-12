<?php
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_municipio.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.ubicacion.inc.php";
	require_once FOLDER_INCLUDE.'lib/PHPExcel/PHPExcel.php';
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#



	
  function getMunicipios($cveEstado) {
  	global $dbLink;
  	$r = new xajaxResponse ();
  	$Ciudades = new ModeloInegidomgeo_cat_municipio ( $dbLink );
  	$arrCiudades = $Ciudades->getAll ( $cveEstado );
  	return $arrCiudades ;
  }
  
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
  
  function generarExcel($arrAnios,$arreglo,$fi,$ff)
  { global $_NOW_;
  $objPHPExcel = new PHPExcel();
  $indicesTabla=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
  $titulos=array("An&tilde;o","Oficina","Expedicion","Revalidacion","Reposicion","Total");
  $indice=0;
  $objPHPExcel
  ->getProperties()
  ->setCreator("SPI")
  ->setLastModifiedBy("SPI")
  ->setDescription("Reporte de comparativo por oficina ")
  ->setCategory("Reporte excel");
  $objPHPExcel->setActiveSheetIndex(0);
  
  $estiloTitulo=obtenEstiloCelda("TITULO");
  $objPHPExcel->getActiveSheet()->setSharedStyle($estiloTitulo,"A1:A1");
  
  $fila=1;
  $titulo="Reporte comparativo por oficina.";
  $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$fila.':H'.$fila)->setCellValue("A".$fila,$titulo);
  
  $estiloTitulo=obtenEstiloCelda("TITULO");
  $estiloTabla1=obtenEstiloCelda("TABLA1");
  $estiloSubTitulo=obtenEstiloCelda("SUBTITULO");
  $estiloTexto=obtenEstiloCelda("TEXTO");
  //Fecha
  $fila=2;
  $b =  "Criterio de Busqueda";
  $objPHPExcel->setActiveSheetIndex ( 0 )->mergeCells('A'.$fila.':H'.$fila)->setCellValue ("A" . $fila,$b );
  $objPHPExcel->getActiveSheet()->setSharedStyle($estiloTabla1,"A" . $fila);
  //encabezados
  $fila=5;
  for($a=0; $a<count($titulos);$a++) {
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [$a] . $fila, $titulos[$a] );
  	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloSubTitulo,$indicesTabla [$a] . $fila);
  }
  
  //Llenar datos celdas
  
  $fila++;  
  //for($i=0;$i<count($arreglo);$i++){//primer arreglo contiene el año
  //foreach ( $arreglo as $keya => $rega ) {
  for($i=0; $i < count($arrAnios); $i++){
//   	print_r($arrAnios);
//   	print_r($arreglo);
  	$b =  "Reporte de comparativo por oficina. Fecha inicio: ". $fi."-".$arrAnios[$i] ." - ". $ff ." Fecha fin: ".$arrAnios[$i];
  	$objPHPExcel->setActiveSheetIndex ( 0 )->mergeCells('A'.$fila.':H'.$fila)->setCellValue ("A" . $fila,$b );
  	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloTabla1,"A" . $fila);
  	$fila++;
  	
  	$rega = $arreglo[$arrAnios[$i]];
  	//$indice++;
  	//variables suman el total por localidad
  	$totalRp=0;
  	$totalRv=0;
  	$totalEx=0;
  	$indice = 2;
  	foreach ( $rega as $key => $registro ) {//contiene las localidades como key y los datos como $registros
  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [0] . $fila, $arrAnios[$i] );
  		//$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [0] . $fila, $key );
  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [1] . $fila, $key );
  		//$indice++;
  		$totFila=0;
  		foreach($registro as $k1=>$r1){// contiene arreglo de expedicion => 0, validacion => 0, revalidacion=>0
  			//print_r($k1);
  			if($k1=="expedicion"){
  				$totalEx += $r1; 
  			}elseif($k1=="revalidacion"){
  				$totalRv += $r1;
  			}elseif($k1=="reposicion"){
  				$totalRp += $r1;
  			}
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [$indice] . $fila, $r1 );//datos por celda valores de expedicion reposicion revalidacion 
			$totFila+=$r1;
  			$indice++;
  		}
  		/////// aqui llena los datos con las comparaciones de los años
  		if($i>0){
  			$fila++;
  			$anioActual = $arreglo[($arrAnios[$i]+1)];// contiene un array con todas las oficinas y totales
  			$anioAnterior = $arreglo[($arrAnios[$i])];// contiene un array con todas las oficinas y totales
  			$anioActualOf = $anioActual[$key];
  			$anioAnteriorOf = $anioAnterior[$key];
  			//$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [0] . $fila, $key );//total por fila
  			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [0] . $fila, ($arrAnios[$i]+1)."-".$arrAnios[$i] );//total por fila
  			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [1] . $fila, $key );//total por fila
  			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [2] . $fila, ($anioActualOf['expedicion']-$anioAnteriorOf['expedicion']) );//total por fila
  			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [3] . $fila, ($anioActualOf['revalidacion']-$anioAnteriorOf['revalidacion']) );//total por fila
  			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [4] . $fila, ($anioActualOf['reposicion']-$anioAnteriorOf['reposicion']) );//total por fila
//  			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [6] . $fila, ($totalEx+$totalRv+$totalRp) );//total por fila
//   			$tablaExp .="<tr class='tr-selected'>
//   			<th>$key</th>
//   			<th>".($arrAnios[$j]+1)."-".$arrAnios[$j]."</th>
//   				<th>Total</th>
  		
//   				<th>".($anioActualOf['expedicion']-$anioAnteriorOf['expedicion'])."</th>
//   				<th>".($anioActualOf['revalidacion']-$anioAnteriorOf['revalidacion'])."</th>
//   				<th>".($anioActualOf['reposicion']-$anioAnteriorOf['reposicion'])."</th>
//   				<th></th>
//   			</tr>";

  		}
  		
  		if($i>0){
  			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [$indice] . ($fila-1), $totFila );//total por fila
  		}else{
  			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [$indice] . ($fila), $totFila );//total por fila
  		}
  		$fila++;
  		$indice = 2;
  	}
  
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [2] . $fila, $totalEx );//total por fila
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [3] . $fila, $totalRv );//total por fila
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [4] . $fila, $totalRp );//total por fila
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [5] . $fila, ($totalEx+$totalRv+$totalRp) );//total por fila
  	$indice=0;
  	$fila++;
  	$fila++;
  }
  
  
  
  
  // establece dimensiÃ³n
  for($i = 'A'; $i <= 'H'; $i++){
  	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
  }
  // 2016-08-04 10:33:19
  $fecha = str_replace("-", "_", date("Y-m-d H:i:s"));
  $fecha = str_replace(":", "_", $fecha);
  $fecha = str_replace(" ", "_", $fecha);
  $objPHPExcel->getActiveSheet()->setTitle('Reporte comparativo ');
  $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $nomArchivo='Reporte_comparativo_'.$fecha;
  $writer->save('tmp/'. $nomArchivo .'.xls');
  return $nomArchivo.'.xls';
  }
  #----------------------------------------------------------------------------------------------------------------------#
  #-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
  #----------------------------------------------------------------------------------------------------------------------#

  $xajax=new xajax();
  
  function reporte($FechaIni,$FechaFin,$municipio,$chkA,$anios) { 	  	
  	global $dbLink;
  	$r = new xajaxResponse ();
  	//obtiene las ubicaciones
  	$Ubicacion=new ModeloUbicacion();
  	$ub = $Ubicacion->getAll();
  	if($Ubicacion->getError())
  	{
  		$Ubicacion->getStrError();
  	}
  	$FechaIniArr = explode("-", $FechaIni);
  	$FechaFinArr = explode("-", $FechaFin);
  	$FechaIni = $FechaIniArr[1] ."-".$FechaIniArr[2];//contiene mes y dia de la fecha
  	$FechaFin = $FechaFinArr[1] ."-".$FechaFinArr[2];//contiene mes y dia de la fecha 12-21  		
  	
  	$arreglo_filas =array();
  	$expedidas=array();
  	$tipos =array();
  	$arrAnios;
  	//se usa para hacer las comparaciones de años atras. Ejemplo 2017 con 2016
  	if($anios=="tres"){
  		$arrAnios[]=2017;
  		$arrAnios[]=2016;
  		$arrAnios[]=2015;
  	}elseif($anios=="dos"){
  		$arrAnios[]=2017;
  		$arrAnios[]=2016;
  		
  	}else{
  		$arrAnios[]=2017; 		
  		
  	}
  	$ubica;
  	////////*********** hace la busqueda solo por la ubicacion seleccionada
  	for($i=0; $i< count($chkA); $i++){
  		$cadena = $chkA[$i];//extrae el chk mas numero de ubicacion
  		$cade = substr($chkA[$i], 3);//extrae el id de ubicacion eliminando el texto chk
  		$ubica[$cade]=$ub[$cade];
  	}
  	//busqueda por años ***********************************************************************************
  	for($j=0; $j<count($arrAnios); $j++){
  		$FechaI =$arrAnios[$j] ."-". $FechaIni;// se arma la fecha para la busqueda en la BD
  		$FechaF =$arrAnios[$j] ."-". $FechaFin;
//   		print_r($FechaI);
//   		print_r($FechaF);
  	foreach($ubica As $idUbicacion=>$nombre){
  		/////////////////// expedicion, revalidacion y reposicion ////////////////////////////
  		/////////////////expedicion/////////////////
  		$query=" select count(*) AS total from licencia where idUbicacion = $idUbicacion and idTipoLicencia in(1,4,7) and estatus = 'aprobada' and fechaExpedicion  between DATE('".$FechaI."') and DATE('".$FechaF."')";//  echo $query;
  		mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
  		$result=mysqli_query($dbLink,$query);
  		if(!$result)
  			die("Ocurrio un error en la consulta.".$query);
  			 
  			while($row = mysqli_fetch_assoc($result)) {
  				$e['expedicion'] = $row['total'];
  			}
  		
  			/////////revalidacion/////////
  			$query=" select count(*)AS total from licencia where idUbicacion = $idUbicacion and idTipoLicencia in(2,5,8)  and estatus = 'aprobada' and fechaExpedicion  between DATE('".$FechaI."') and DATE('".$FechaF."')
  			";//  echo $query;
  			mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
  			$result=mysqli_query($dbLink,$query);
  			if(!$result)
  				die("Ocurrio un error en la consulta.");
  		
  				while($row = mysqli_fetch_assoc($result)) {
  					$e['revalidacion'] = $row['total'];
  				}
  				///////////////reposicion/////////////////
  				$query=" select count(*)AS total from licencia where idUbicacion = $idUbicacion and idTipoLicencia in(3,6,9) and estatus = 'aprobada' and fechaExpedicion  between DATE('".$FechaI."') and DATE('".$FechaF."')
  				";//  echo $query;
  				mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
  				$result=mysqli_query($dbLink,$query);
  				if(!$result)
  					die("Ocurrio un error en la consulta.");
  						
  					while($row = mysqli_fetch_assoc($result)) {
  						$e['reposicion'] = $row['total'];
  					}
  					$expedidas[$nombre]=$e;// var nombre contiene nombre de la oficina
  		
  		
  					
  		/////////////////// Tipos de licencia        --------------------- busca las licencias por tipo y ubicacion////////////////////////////
  		/////////////////AUTOMOVILISTA/////////////////
//   		$query=" select count(*)AS total from  licencia where idUbicacion = $idUbicacion and idTipoLicencia in(1,2,3) and estatus = 'aprobada' and fechaExpedicion  between DATE('".$FechaI."') and DATE('".$FechaF."')";//  echo $query;
//   		mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
//   		$result=mysqli_query($dbLink,$query);
//   		if(!$result)
//   			die("Ocurrio un error en la consulta.");
  	
//   		while($row = mysqli_fetch_assoc($result)) {
//   			$t['AUTOMOVILISTA'] = $row['total'];
//   		} 	
  		
  		/////////CHOFER/////////
//   		$query=" select count(*)AS total from  licencia where idUbicacion = $idUbicacion and idTipoLicencia in(4,5,6) and estatus = 'aprobada' and fechaExpedicion  between DATE('".$FechaI."') and DATE('".$FechaF."')
//   		";//  echo $query;
//   		mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
//   		$result=mysqli_query($dbLink,$query);
//   		if(!$result)
//   			die("Ocurrio un error en la consulta.");
  			 
//   			while($row = mysqli_fetch_assoc($result)) {
//   				$t['CHOFER'] = $row['total'];
//   			}
//   			///////////////MOTOCICLISTA/////////////////
//   			$query=" select count(*)AS total from  licencia where idUbicacion = $idUbicacion and idTipoLicencia in(7,8,9) and estatus = 'aprobada' and fechaExpedicion  between DATE('".$FechaI."') and DATE('".$FechaF."')
//   			";//  echo $query;
//   			mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
//   			$result=mysqli_query($dbLink,$query);
//   			if(!$result)
//   				die("Ocurrio un error en la consulta.");
  			
//   				while($row = mysqli_fetch_assoc($result)) {
//   					$t['MOTOCICLISTA'] = $row['total'];
//   				}
//   				$tipos[$nombre]=$t;
  				
 /////////////////// Tipos de licencia menor de edad       **************************************************************************
  				/////////////////AUTOMOVILISTA/////////////////
  				//$menorUb=array();
//   				$query=" SELECT TIMESTAMPDIFF(YEAR,fechaNacimiento,CURDATE()) AS edad FROM persona where  exists 
//   				(select idPersona from licencia where idUbicacion = $idUbicacion and idTipoLicencia in(1,2,3) and estatus = 'aprobada' and persona.idPersona = licencia.idPersona) 
//   				";//  echo $query;
//   				mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
//   				$result=mysqli_query($dbLink,$query);
//   				if(!$result)
//   					die("Ocurrio un error en la consulta.");
//   					$menor =0; 
//   					while($row = mysqli_fetch_assoc($result)) {
//   						if($row['edad']!=0)
//   						{
//   							$menor+=1;
//   						}
//   					}  					
//   					$menorUb[$nombre]=$menor;
  				
  		
  	}
  	
  	
  	
  	///generar tabla  de resumen general **************************************************************  	
//   	print_r($expedidas);
   	//print_r($tipos);
  	$tablaExp .="<div class='table-wrapper'><header>Reporte comparativo por oficina. Fecha inicio:".$FechaI.", Fecha fin:".$FechaF."</header> </div> <table class='table'>
					<thead>
  						<tr class='border_bottom'>
  							
  							<th scope='col'>A&ntilde;o</th>
  							<th scope='col'>Oficina</th>
  							<th scope='col'>Expedixi&oacute;n</th>
  							<th scope='col'>Revalidaci&oacute;n</th>
  							<th scope='col'>Reposici&oacute;n</th>
  							<th scope='col'>Total</th>
				</tr>
  			</thead>
  			<tbody>
  	";

  	$expedicion=0;
  	$revalidacion=0;
  	$reposicion=0;
  	//print_r($expedidas);
  	$resumen[$arrAnios[$j]]=$expedidas;
  	foreach($expedidas as $key=>$value){
  		//echo $key;
  		//print_r($value);
  		//echo " expedicion " .$value['reposicion'];
  		$expedicion+=$value['expedicion'];
  		$revalidacion+=$value['revalidacion'];
  		$reposicion+=$value['reposicion'];
  		$subt = $value['expedicion'] + $value['revalidacion'] +$value['reposicion'];
  		$tablaExp .="<tr class='border_bottom'>
  					<td>$arrAnios[$j]</td>
  					<td>$key</td>
  					
  					<td>".$value['expedicion']."</td>
  					<td>".$value['revalidacion']."</td>
  					<td>".$value['reposicion']."</td>
  					<td>$subt</td>
  		</tr>";
  		
  		if(count($resumen)>1){
  			$anioActual = $resumen[($arrAnios[$j]+1)];// contiene un array con todas las oficinas y totales
  			$anioAnterior = $resumen[($arrAnios[$j])];// contiene un array con todas las oficinas y totales
  			$anioActualOf = $anioActual[$key];
  			$anioAnteriorOf = $anioAnterior[$key]; 			
  			
  			$tablaExp .="<tr class='tr-selected border_bottom'>
  			
  			<th>".($arrAnios[$j]+1)."-".$arrAnios[$j]."</th>
  				<th>Total</th>
  		
  				<th>".($anioActualOf['expedicion']-$anioAnteriorOf['expedicion'])."</th>
  				<th>".($anioActualOf['revalidacion']-$anioAnteriorOf['revalidacion'])."</th>
  				<th>".($anioActualOf['reposicion']-$anioAnteriorOf['reposicion'])."</th>
  				<th></th>
  			</tr>";
  		}
  	}
  	
  	$total = ($expedicion+$revalidacion+$reposicion);
  	$tablaExp .="</tbody>
  			<footer>
  			<tr class='danger border_bottom'>
  				
  				<th>$arrAnios[$j]</th>
  				<th>Total</th>  				
  				<th>$expedicion</th>
  				<th>$revalidacion</th>
  				<th>$reposicion</th>
  				<th>$total</th>".$res."
  			</tr>
  			</footer>
  			
  			</table><div class='spacer-20'></div>";
  	
  	
  	//echo count($resumen);
  	} // fin arrray anios
  	//print_r($resumen);
  	$archivo = generarExcel($arrAnios,$resumen,$FechaIni,$FechaFin);
  	///***************************** otro reporte ******************************* 
  	///generar tabla tipos de licencia *******************************************************************
//   	$tablaExp .="<div class='table-wrapper'><header>Tipos de licencia</header> </div><table class='table'>
// 					<thead>
//   						<tr>
//   							<th scope='col'>Ciudad</th>
//   							<th scope='col'>A&ntilde;o</th>
//   							<th scope='col'>Oficina</th>
//   							<th scope='col'>Menor</th>
//   							<th scope='col'>Motociclista</th>
//   							<th scope='col'>Automovilista</th>
//   							<th scope='col'>Chofer</th>
//   							<th scope='col'>Total</th>
// 				</tr>
//   			</thead>
//   			<tbody>
//   	";
//   	$menor=0;
//   	$Motociclista=0;
//   	$Automovilista=0;
//   	$Chofer=0;
//   	$menor=0;
//   	foreach($tipos as $key=>$value){  	
//   		$Motociclista+=$value['MOTOCICLISTA'];
//   		$Automovilista+=$value['AUTOMOVILISTA'];
//   		$Chofer+=$value['CHOFER'];
//   		$subt = $value['MOTOCICLISTA'] + $value['AUTOMOVILISTA'] +$value['CHOFER'];
//   		$menor+= $menorUb[$key];
//   		$tablaExp .="<tr><td>$key</td>
//   		<td>$arrAnios[$j]</td>
//   		<td>$key</td>
//   		<td>.$menorUb[$key].</td>	
//   		<td>".$value['MOTOCICLISTA']."</td>
//   		<td>".$value['AUTOMOVILISTA']."</td>
//   		<td>".$value['CHOFER']."</td>
//   	  	<td>$subt</td>
//   	  	</tr>";
//   	}
//   	$total = ($Motociclista+$Automovilista+$Chofer);
//   	$tablaExp .="</tbody>
//   	<footer>
//   	<tr>
//   	<th></th>
//   	<th>$arrAnios[$j]</th>
//   	<th>Total</th>
//   	<th>$menor</th>
//   	<th>$Motociclista</th>
//   	<th>$Automovilista</th>
//   	<th>$Chofer</th>
//   	<th>$total</th>
//   	</tr>
//   	</footer>
  		
//   	</table>";
  	 
  	
  	;
  	//$r->call("llenarDatos",$tablaExp);
  	$r->call("llenarDatos",json_encode(array($tablaExp,$archivo)));
  	return $r;
  }
  $xajax->registerFunction ( "reporte" );
  
  
  
  
  $xajax->processRequest();

	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#




	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

  //CLAVES DE ESTADOS (ENTIDADES FEDERATIVAS)
  $arrEstados = getMunicipios(28);
  //$arrEstados=$Estados->getAll();
  //print_r($arrEstados);
  $slcMunicipios='';
  
  
  	$slcMunicipios.='<option value="0">Selecciona una opci&oacute;n</option>';;
  
  
  foreach($arrEstados AS $cveEstado=>$nomEstado)
  	$slcMunicipios.='<option value="' . $cveEstado . '">' . utf8_encode($nomEstado) . '</option>';
  
//ubicaciones

  	$Ubicacion=new ModeloUbicacion();
  	$ub = $Ubicacion->getAll();
  	if($Ubicacion->getError())
  	{
  		$ub=array('0'=>$Ubicacion->getStrError());
  	}
  	$boxes="";
  	$slcUbicaciones='<option value="0">Selecciona una opci&oacute;n.</option>';
  	$i=0;
  	foreach($ub As $idUbicacion=>$nombre){
  		$slcUbicaciones.='<option value="' . $idUbicacion . '">' . $nombre . '</option>';
  		
  		if(fmod($i, 5)==0){
  			$boxes .='<div class="spacer-5"></div>';
  		}
  		$i++;
  		$boxes .= '<div class="col-sm-1 text-right">'.
  		'<label for="chk'.$idUbicacion.'" class="chk'.$nombre.' ">'.$nombre.'</label>'.
  		'</div>  		<div class="col-sm-1">'.
  		'<input type="checkbox" class="form-control" id="chk'.$idUbicacion.'" name="chk'.$idUbicacion.'">'.
  		'</div>';
  		
  	}
  		//$anios
  		//echo date("Y"); 
  		$anios  .='<option value="uno">2017</option>';  
  		$anios  .='<option value="dos">2017-2016</option>';
  		$anios  .='<option value="tres">2017-2015</option>';
  		
  		