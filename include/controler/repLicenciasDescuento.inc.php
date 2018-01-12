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
  $titulos=array("Oficina","Tramites","Total Tramites","Tramites descuento","Importe total","Importe descuento","Descontado","Recaudado");
  $indice=0;
  $objPHPExcel
  ->getProperties()
  ->setCreator("SPI")
  ->setLastModifiedBy("SPI")
  ->setDescription("Reporte descuentos")
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
  $fila=3;
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

  	$b =  " Reporte descuentos. Fecha inicio: ". $fi."-".$arrAnios[$i] ." - ". $ff ." Fecha fin: ".$arrAnios[$i];
  	$objPHPExcel->setActiveSheetIndex ( 0 )->mergeCells('A'.$fila.':H'.$fila)->setCellValue ("A" . $fila,$b );
  	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloTabla1,"A" . $fila);
  	$fila++;
  	
  	
  	//variables suman el total por localidad
  	$FinaltotalTramites=0;
  	$FinaldescuentosTramites=0;
  	$FinalimporteOriginal=0;
  	$FinalimporteDescuento=0;
  	$Finaldescontado=0;
  	foreach ( $arreglo as $key => $registro ) {//contiene las localidades como key y los datos como $registros
  		//$key;//oficina
  		$registro;//arreglo de  totalTramites,descuentosTramites,importeOoriginal,importeDescuento,descontado
  		$Tramites=0;
  		$descuentosTramites=0;
  		$importeOriginal=0;
  		$importeDescuento=0;
  		$descontado=0;
  		foreach($registro as $indi=>$valor){//nueva, reposicion, revalidadion
  			$Tramites+=$valor['totalTramites'];
  			$descuentosTramites+=$valor['descuentosTramites'];
  			$importeOriginal+= $valor['importeOoriginal'];
  			$importeDescuento+= $valor['importeDescuento'];
  			$descontado+=$valor['descontado'];
  			
  			$FinaltotalTramites+=$valor['totalTramites'];
  			$FinaldescuentosTramites+=$valor['descuentosTramites'];
  			$FinalimporteOriginal+= $valor['importeOoriginal'];
  			$FinalimporteDescuento+= $valor['importeDescuento'];
  			$Finaldescontado+=$valor['descontado'];
  			
  			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [0] . $fila, $key );//oficina ciudad
	  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [1] . $fila, $indi );//oficina ciudad
	  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [2] . $fila, $valor['totalTramites'] );//oficina ciudad
	  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [3] . $fila, $valor['descuentosTramites'] );//oficina ciudad
	  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [4] . $fila, $valor['importeOoriginal'] );//oficina ciudad
	  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [5] . $fila, $valor['importeDescuento'] );//oficina ciudad
	  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [6] . $fila, $valor['descontado'] );//oficina ciudad
	  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [7] . $fila, ($valor['importeOoriginal'] + $valor['descontado']) );//oficina ciudad
  			$fila++;
  		}  		
  		$totFila=0;
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [2] . ($fila), $Tramites );//total por fila
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [3] . ($fila), $descuentosTramites );//total por fila
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [4] . ($fila), $importeOriginal );//total por fila
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [5] . ($fila), $importeDescuento );//total por fila
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [6] . ($fila), $descontado );//total por fila
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [7] . ($fila), ($importeOriginal+$descontado) );//total por fila
		//$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [0] . ($fila), $Tramites );//total por fila

  		$fila++;
  		$indice = 2;
  		$fila++;
  	}
  
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [2] . $fila, $FinaltotalTramites );//total por fila
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [3] . $fila, $FinaldescuentosTramites );//total por fila
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [4] . $fila, $FinalimporteOriginal );//total por fila
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [5] . $fila, $FinalimporteDescuento );//total por fila
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [6] . $fila, ($Finaldescontado) );//total por fila
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [7] . $fila, ($FinalimporteOriginal+$Finaldescontado) );//total por fila
  	$indice=0;
  	$fila++;
  	$fila++;
  //}
  
  
  
  
  // establece dimensión
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

  	$arreglo_filas =array();
  	$expedidas=array();
  	$oficina =array();
  	
  	$arrTipo;

  	$ubica;
  	$arrTipo[]="nueva";
  	$arrTipo[]="reposicion";
  	$arrTipo[]="revalidacion";
  	////////*********** hace la busqueda solo por la ubicacion seleccionada
  	for($i=0; $i< count($chkA); $i++){
  		$cadena = $chkA[$i];//extrae el chk mas numero de ubicacion
  		$cade = substr($chkA[$i], 3);//extrae el id de ubicacion eliminando el texto chk
  		$ubica[$cade]=$ub[$cade];
  	}

  	foreach($ubica As $idUbicacion=>$nombre){ 
  		$tipos =array();
  		foreach($arrTipo as $s=>$it){
  		
  		//total de tramites
  		if($it=="nueva")
  			$str =" and l.idTipoLicencia in(1,4,7) ";
  		elseif ($it=="reposicion")
  		    $str =" and l.idTipoLicencia in(3,6,9) ";
  		elseif ($it=="revalidacion")
  		    $str =" and l.idTipoLicencia in(2,5,8) ";
  		    
  		$query=" SELECT count(*)AS total FROM licencia l 
  		inner join turno t on l.idLicencias = t.idLicencias
  		inner join pago p on t.idTurno = p.idTurno
  		where l.estatus='impresa' and l.idUbicacion = $idUbicacion and l.fechaExpedicion between DATE('".$FechaIni."') and DATE('".$FechaFin."') $str";
  		//where l.estatus='impresa' and l.idUbicacion =  fechaExpedicion
  		mysqli_query($dbLink,"SET NAMES 'utf8'");//echo $query;// solucion en linux
  		$result=mysqli_query($dbLink,$query);
  		if(!$result)
  			die("Ocurrio un error en la consulta.");
  	
  		while($row = mysqli_fetch_assoc($result)) {
  			$t['totalTramites'] = $row['total'];
  		} 	
  		
  		/////////  		tramites descuentos
  		
  		$query=" SELECT count(*)AS total FROM licencia l
  		inner join turno t on l.idLicencias = t.idLicencias
  		inner join pago p on t.idTurno = p.idTurno
  		where exists(select * from pago_detalle pd where pd.idPago = p.idPago and pd.monto < 0) and l.estatus='impresa' and  l.idUbicacion = $idUbicacion and l.fechaExpedicion between DATE('".$FechaIni."') and DATE('".$FechaFin."') $str";
  		mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
  		$result=mysqli_query($dbLink,$query);
  		if(!$result)
  			die("Ocurrio un error en la consulta.");
  			 
  			while($row = mysqli_fetch_assoc($result)) {
  				$t['descuentosTramites'] = $row['total'];
  			}
  		///////////////  		importe original
  		
  		$query=" SELECT IFNULL(sum(tl.nuevaCosto),0) as total FROM licencia l
  		inner join turno t on l.idLicencias = t.idLicencias
  		inner join pago p on t.idTurno = p.idTurno
  		inner join tipolicencia tl on tl.idTipoLicencia = l.idTipoLicencia where l.estatus='impresa' and  l.idUbicacion = $idUbicacion and l.fechaExpedicion between DATE('".$FechaIni."') and DATE('".$FechaFin."') $str";
  			mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
  			$result=mysqli_query($dbLink,$query);
  			if(!$result)
  				die("Ocurrio un error en la consulta.");
  			
  				while($row = mysqli_fetch_assoc($result)) {
  					$t['importeOoriginal'] = $row['total'];
  				} 				  				
 /////////////////// importe descuento
 
  		$query=" SELECT IFNULL(sum(p.total),0) as total FROM licencia l
  		inner join turno t on l.idLicencias = t.idLicencias
  		inner join pago p on t.idTurno = p.idTurno
  		where exists(select * from pago_detalle pd where pd.idPago = p.idPago and pd.monto < 0)  and l.estatus='impresa' and l.idUbicacion = $idUbicacion and l.fechaExpedicion between DATE('".$FechaIni."') and DATE('".$FechaFin."') $str";  			
  				mysqli_query($dbLink,"SET NAMES 'utf8'");//echo $query;// solucion en linux
  				$result=mysqli_query($dbLink,$query);
  				if(!$result)
  					die("Ocurrio un error en la consulta.");
  					$menor =0; 
  					while($row = mysqli_fetch_assoc($result)) {
  						$t['importeDescuento']= $row['total'];
  					}	
  		//descontado
  		
  		$query=" SELECT IFNULL(sum(pde.monto),0) as total FROM licencia l
  		inner join turno t on l.idLicencias = t.idLicencias
  		inner join pago p on t.idTurno = p.idTurno
  		inner join pago_detalle pde on pde.idPago = p.idPago
  		where exists(select * from pago_detalle pd where pd.idPago = p.idPago and pd.monto < 0) and pde.monto < 0  and l.estatus='impresa' and  l.idUbicacion = $idUbicacion and l.fechaExpedicion between DATE('".$FechaIni."') and DATE('".$FechaFin."') $str";			
  		mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
  		$result=mysqli_query($dbLink,$query);
  		if(!$result)
  			die("Ocurrio un error en la consulta.");
  			$menor =0;
  			while($row = mysqli_fetch_assoc($result)) {
  				$t['descontado']= $row['total'];
  			}			
  	
  					$tipos[$it]=$t;//arreglo por oficina  					
  		}//for j
  		$oficina[$nombre]=$tipos;//arreglo por oficina
  		
  	}// for ubicacion  	  	
  	///***************************** otro reporte ******************************* 
  	///generar tabla tipos de licencia *******************************************************************
  	$tablaExp .="<div class='table-wrapper'><header> Reporte descuentos. Fecha inicio:".$FechaIni.", Fecha fin:".$FechaFin."</header> </div><table class='table'>
					<thead>
  						<tr class='border_bottom'>
  							  							
  							<th scope='col'>Oficina</th>
  							<th scope='col'>Tramites</th>
  							<th scope='col'>Total Tramites</th>
  							<th scope='col'>Tramites descuento</th>
  							<th scope='col'>Importe total</th>
  							<th scope='col'>Importe descuento</th>
  							<th scope='col'>Descontado</th>
  							<th scope='col'>Recaudado</th>
				</tr>
  			</thead>
  			<tbody>
  	";
  	
  	$FinaltotalTramites=0;
  	$FinaldescuentosTramites=0;
  	$FinalimporteOriginal=0;
  	$FinalimporteDescuento=0;
  	$Finaldescontado=0;
  	foreach($oficina as $key=>$value){
  		$totalTramites=0;
  		$descuentosTramites=0;
  		$importeOriginal=0;
  		$importeDescuento=0;
  		$descontado=0;
  		$of = $value;
  		foreach($of as $k=>$v){
  			$FinaltotalTramites+=$v['totalTramites'];
  			$totalTramites+=$v['totalTramites'];
  			$FinaldescuentosTramites+=$v['descuentosTramites'];
  			$descuentosTramites+=$v['descuentosTramites'];
  			$importeOriginal+=$v['importeOoriginal'];
  			$FinalimporteOriginal+=$v['importeOoriginal'];
  			$FinalimporteDescuento+=$v['importeDescuento'];
  			$importeDescuento+=$v['importeDescuento'];
  			$Finaldescontado+=$v['descontado'];
  			$descontado+=$v['descontado'];
   		$Automovilista+=$value['AUTOMOVILISTA'];
   		$Chofer+=$value['CHOFER'];
   		$subt = $value['MOTOCICLISTA'] + $value['AUTOMOVILISTA'] +$value['CHOFER'];
   		$menor+= $menorUb[$key];
  		
  		$tablaExp .="<tr class='border_bottom'>  		
  		<td>$key</td>
  		<td>$k</td>
  		<td>".$v['totalTramites']."</td>	
  		<td>".$v['descuentosTramites']."</td>
  		<td>".$v['importeOoriginal']."</td>
		<td>".$v['importeDescuento']."</td>
		<td>".$v['descontado']."</td>  		
  	  	<td>".($v['importeOoriginal']+$v['descontado'])."</td>
  	  	</tr>";
  	}// total por oficina
  	$tablaExp .="<tr class='success border_bottom bg'>
			  	<td class='total'></td>
			  	<td  class='total'>total</td>
			  	<td  class='total'>$totalTramites</td>
			  		<td  class='total'>$descuentosTramites</td>
			  		<td  class='total'>$importeOriginal</td>
					<td  class='total'>$importeDescuento</td>
					<td  class='total'>$descontado</td>
			  	  	<td  class='total'>".($importeOriginal+$descontado)."</td>
			  	  	</tr>";
  	
  	$tablaExp .="<tr class='separador'>
  	<td ></td>
  	<td ></td>
  	<td ></td>
  	<td ></td>
  	<td ></td>
  	<td ></td>
  	<td ></td>
  	<td ></td></tr>";
  	$tablaExp .="<tr>
  	<td ></td>
  	<td ></td>
  	<td ></td>
  	<td ></td>
  	<td ></td>
  	<td ></td>
  	<td ></td>
  	<td ></td></tr>";
  	}
  	
  	$tablaExp .="</tbody>
  	<footer>
  	<tr class='danger border_bottom'>
  	
  	<th></th>
  	<th></th>
  	<th>$FinaltotalTramites</th>
  	<th>$FinaldescuentosTramites</th>
  	<th>$FinalimporteOriginal</th>
  	<th>$FinalimporteDescuento</th>
  	<th>$Finaldescontado</th>
  	<th>".($FinalimporteOriginal+$Finaldescontado)."</th>
  	</tr>
  	</footer>
  		
  	</table><div class='spacer-20'></div>";
  	$archivo = generarExcel($arrAnios,$oficina,$FechaIni,$FechaFin);
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
  		
  		