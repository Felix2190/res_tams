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
  $titulos=array("Oficina","Padr&oacute;n","Vencidas","% Vencidas","Vigentes","% Vigentes");
  $indice=0;
  $objPHPExcel
  ->getProperties()
  ->setCreator("SPI")
  ->setLastModifiedBy("SPI")
  ->setDescription("Reporte de Licencias vigentes")
  ->setCategory("Reporte excel");
  $objPHPExcel->setActiveSheetIndex(0);
  
  $estiloTitulo=obtenEstiloCelda("TITULO");
  $objPHPExcel->getActiveSheet()->setSharedStyle($estiloTitulo,"A1:A1");
  
  $fila=1;
  $titulo="Reporte de Licencias vigentes.";
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
 // for($i=0; $i < count($arrAnios); $i++){

  	$b =  " Reporte  avance de licencias. Fecha: ". $fi;
  	$objPHPExcel->setActiveSheetIndex ( 0 )->mergeCells('A'.$fila.':H'.$fila)->setCellValue ("A" . $fila,$b );
  	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloTabla1,"A" . $fila);
  	$fila++;
  	
  	$rega = $arreglo[$arrAnios[$i]];
  	//variables suman el total por localidad
  	$totalAu=0;
  	$totalP=0;
  	$totalVe=0;
  	$totalVi=0;
  	$indice = 2;
  	foreach ( $arreglo as $key => $registro ) {//contiene las localidades como key y los datos como $registros
  		
  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [0] . $fila, $key );//ciudad
  		//$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [1] . $fila, $key );//oficina ciudad
  		//$indice++;
  		$totFila=0;
  		$padron=0;
  		$vencidas=0;
  		$vigentes=0;
  		foreach($registro as $k1=>$r1){// contiene arreglo de [AUTOMOVILISTA] => 0, [CHOFER]  => 0, [MOTOCICLISTA] =>0, [menor] =>0,
  			//print_r($k1);
  			if($k1=="padron"){
  				$totalP += $r1;
  				$padron = $r1;
  				$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [1] . $fila, $r1 );//datos por celda valores de expedicion reposicion revalidacion
  			}elseif($k1=="vencidas"){
  				$vencidas = $r1;
  				$totalVe += $r1;
  				$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [2] . $fila, $r1 );//datos por celda valores de expedicion reposicion revalidacion
  			}elseif($k1=="vigentes"){
  				$vigentes = $r1;
  				$totalVi += $r1;
  				$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [4] . $fila, $r1 );//datos por celda valores de expedicion reposicion revalidacion
  			}else{
  				
  			}			
  			
  			$indice++;
  		}
  			if($vencidas!=0 && $padron!=0)
	  			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [3] . $fila, number_format ((($vencidas/$padron)*100),0,",","")."%" );//datos por celda valores de expedicion reposicion revalidacion
  			else
  				$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [3] . $fila, number_format (0,0,",","")."%" );//datos por celda valores de expedicion reposicion revalidacion
  			if($vigentes!=0 && $padron!=0)
	  			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [5] . $fila, number_format ((($vigentes/$padron)*100),0,",","")."%" );//datos por celda valores de expedicion reposicion revalidacion
  			else
  				$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [5] . $fila, number_format (0,0,",","")."%" );//datos por celda valores de expedicion reposicion revalidacion
	  		//number_format ((($value['vencidas']/$value['padron'])*100),0,",","")
  			//$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [$indice] . ($fila), $totFila );//total por fila

  		$fila++;
  		$indice = 2;
  	}
  
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [1] . $fila, $totalP );//total por fila
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [2] . $fila, $totalVe );//total por fila
  	if($totalVe!=0 && $totalP!=0)
  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [3] . $fila, number_format ((($totalVe/$totalP)*100),0,",","")."%"  );//total por fila
  	else 
  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [3] . $fila, number_format (0,0,",","")."%"  );//total por fila
  	
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [4] . $fila, $totalVi );//total por fila
  	if($totalVi!=0 && $totalP!=0)
  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [5] . $fila, number_format ((($totalVi/$totalP)*100),0,",","")."%" );//total por fila
  	else 
  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [5] . $fila, number_format (0,0,",","")."%" );//total por fila
  	$indice=0;
  	$fila++;
  	$fila++;
  //}
  
  
  
  
  // establece dimensiÃ³n
  for($i = 'A'; $i <= 'H'; $i++){
  	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
  }
  // 2016-08-04 10:33:19
  $fecha = str_replace("-", "_", date("Y-m-d H:i:s"));
  $fecha = str_replace(":", "_", $fecha);
  $fecha = str_replace(" ", "_", $fecha);
  $objPHPExcel->getActiveSheet()->setTitle('Reporte avance de licencias ');
  $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $nomArchivo='Reporte_licencias_vigentes_'.$fecha;
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
//   	$FechaIniArr = explode("-", $FechaIni);
//   	$FechaFinArr = explode("-", $FechaFin);
//   	$FechaIni = $FechaIniArr[1] ."-".$FechaIniArr[2];//contiene mes y dia de la fecha
//   	$FechaFin = $FechaFinArr[1] ."-".$FechaFinArr[2];//contiene mes y dia de la fecha 12-21  		
  	
  	$arreglo_filas =array();
  	$expedidas=array();
  	$tipos =array();
  	$arrAnios;
  	//se usa para hacer las comparaciones de años atras. Ejemplo 2017 con 2016
//   	if($anios=="tres"){
//   		$arrAnios[]=2017;
//   		$arrAnios[]=2016;
//   		$arrAnios[]=2015;
//   	}elseif($anios=="dos"){
//   		$arrAnios[]=2017;
//   		$arrAnios[]=2016;
  		
//   	}else{
//   		$arrAnios[]=2017; 		
  		
//   	}
  	$ubica;
  	////////*********** hace la busqueda solo por la ubicacion seleccionada
  	for($i=0; $i< count($chkA); $i++){
  		$cadena = $chkA[$i];//extrae el chk mas numero de ubicacion
  		$cade = substr($chkA[$i], 3);//extrae el id de ubicacion eliminando el texto chk
  		$ubica[$cade]=$ub[$cade];
  	}
  	//busqueda por años ***********************************************************************************
  	//for($j=0; $j<count($arrAnios); $j++){
  //		$FechaI =$arrAnios[$j] ."-". $FechaIni;// se arma la fecha para la busqueda en la BD
  //		$FechaF =$arrAnios[$j] ."-". $FechaFin;
//   		print_r($FechaI);
//   		print_r($FechaF);
  	foreach($ubica As $idUbicacion=>$nombre){	
  		/////////////////// Tipos de licencia        --------------------- busca las licencias por tipo y ubicacion////////////////////////////
  		/////////////////vencidas/////////////////
  		$query=" select count(*)AS total from  licencia where idUbicacion = $idUbicacion  and estatus = 'aprobada' and fechaExpiracion  <= DATE('".$FechaIni."') ";//  echo $query;
  		mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
  		$result=mysqli_query($dbLink,$query);//echo $query;
  		if(!$result)
  			die("Ocurrio un error en la consulta.");
  	
  		while($row = mysqli_fetch_assoc($result)) {
  			$t['vencidas'] = $row['total'];
  		} 	
  		
  		/////////padron/////////
  		$query=" select count(*)AS total from  licencia where idUbicacion = $idUbicacion  and estatus = 'aprobada'
  		";//  echo $query;
  		mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
  		$result=mysqli_query($dbLink,$query);
  		if(!$result)
  			die("Ocurrio un error en la consulta.");
  			 
  			while($row = mysqli_fetch_assoc($result)) {
  				$t['padron'] = $row['total'];
  			}
  			/////////vigentes/////////
  			$query=" select count(*)AS total from  licencia where idUbicacion = $idUbicacion  and estatus = 'aprobada' and fechaExpiracion  > DATE('".$FechaIni."') 
  			";//  echo $query;
  			mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
  			$result=mysqli_query($dbLink,$query);
  			if(!$result)
  				die("Ocurrio un error en la consulta.");
  			
  				while($row = mysqli_fetch_assoc($result)) {
  					$t['vigentes'] = $row['total'];
  				}
  						
  					
  					
  					$tipos[$nombre]=$t;//arreglo por oficina
  		
  	}// for ubicacion  	
  	
  	//$resumen[$arrAnios[$j]]=$tipos;
  	//print_r($tipos);
  	///***************************** otro reporte ******************************* 
  	///generar tabla tipos de licencia *******************************************************************
  	$tablaExp .="<div class='table-wrapper'><header> Reporte avance de licencias. Fecha:".$FechaIni."</header> </div><table class='table'>
					<thead>
  						<tr class='border_bottom'>
  														
  							<th scope='col'>Oficina</th>
  							<th scope='col'>Padr&oacute;n</th>
  							<th scope='col'>Vencidas</th>
  							<th scope='col'>% Vencidas</th>
  							<th scope='col'>Vigentes</th>
  							<th scope='col'>% Vigentes</th>
				</tr>
  			</thead>
  			<tbody>
  	";
 	
  	$totalPadron=0;
  	$totalVencidas=0;
  	$totalVigentes=0;
  	foreach($tipos as $key=>$value){  	
  		$totalPadron+= $value['padron'];
  		$totalVencidas+= $value['vencidas'];
  		$totalVigentes+=$value['vigentes'];
  		$vigentesporc =0;
  		$vencidasporc =0;
  		if($value['vencidas']!=0 && $value['padron']!=0){
  			$vencidasporc = ($value['vencidas']/$value['padron'])*100;
  		}
  		if($value['vigentes']!=0 && $value['padron']!=0){
  			$vigentesporc = ($value['vigentes']/$value['padron'])*100;
  		}
  		$tablaExp .="<tr class='border_bottom'>
  		
  		<td>$key</td> 		
  		<td>".$value['padron']."</td>
  		<td>".$value['vencidas']."</td>	
  		<td>".number_format ($vencidasporc,0,",","")."%</td>  		
  		<td>".$value['vigentes']."</td>
  	  	<td>".number_format ($vigentesporc,0,",","")."%</td>
  	  	</tr>";
  	}
  	$vencidasTotalporc=0;
  	$vigentesTotalporc=0;
  	if($totalVencidas!=0 && $totalPadron !=0)
  		$vencidasTotalporc = (($totalVencidas/$totalPadron)*100);
	if($totalVigentes!=0 && $totalPadron!=0)
  		$vigentesTotalporc = (($totalVigentes/$totalPadron)*100);
  	$total = ($Motociclista+$Automovilista+$Chofer);
  	$tablaExp .="</tbody>
  	<footer>
  	<tr class='danger border_bottom'>
	  	 	
	  	<th>Total</th>
	  	<th>$totalPadron</th>
	  	<th>$totalVencidas</th>
	  	<th>".number_format ($vencidasTotalporc ,0,",","")."%</th>
	  	<th>$totalVigentes</th>
	  	<th>".number_format ($vigentesTotalporc,0,",","")."%</th>
  	</tr>
  	</footer>
  		
  	</table><div class='spacer-20'></div>";
  	//} // fin arrray anios
  	//print_r($resumen);
  	//print_r($tipos);
  	$archivo = generarExcel($arrAnios,$tipos,$FechaIni,$FechaFin);
  	;
  	$r->call("llenarDatos",json_encode(array($tablaExp,$archivo)));
  	//$r->call("llenarDatos",json_encode(array($tablaExp,$archivo)));
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
  		
  		