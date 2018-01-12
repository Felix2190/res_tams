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
  $titulos=array("Ciudad","An&tilde;o","Oficina","Automovilista","Chofer","Motociclista","Menor","Total");
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

  	$b =  " Reporte de Licencias vigentes. Fecha inicio: ". $fi ." -  Fecha fin: ".$ff;
  	$objPHPExcel->setActiveSheetIndex ( 0 )->mergeCells('A'.$fila.':H'.$fila)->setCellValue ("A" . $fila,$b );
  	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloTabla1,"A" . $fila);
  	$fila++;
  	
  	$rega = $arreglo[$arrAnios[$i]];
  	//variables suman el total por localidad
  	$totalAu=0;
  	$totalCh=0;
  	$totalMo=0;
  	$totalMe=0;
  	$indice = 3;
  	foreach ( $rega as $key => $registro ) {//contiene las localidades como key y los datos como $registros
  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [1] . $fila, date("Y", strtotime($fi)) );//aÒo
  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [0] . $fila, $key );//ciudad
  		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [2] . $fila, $key );//oficina ciudad
  		//$indice++;
  		$totFila=0;
  		foreach($registro as $k1=>$r1){// contiene arreglo de [AUTOMOVILISTA] => 0, [CHOFER]  => 0, [MOTOCICLISTA] =>0, [menor] =>0,
  			//print_r($k1);
  			if($k1=="AUTOMOVILISTA"){
  				$totalAu += $r1; 
  			}elseif($k1=="CHOFER"){
  				$totalCh += $r1;
  			}elseif($k1=="MOTOCICLISTA"){
  				$totalMo += $r1;
  			}elseif($k1=="menor"){
  				$totalMe += $r1;
  			}
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [$indice] . $fila, $r1 );//datos por celda valores de expedicion reposicion revalidacion
			if($k1!="menor"){
				$totFila+=$r1;
			}
			
  			$indice++;
  		}
  			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [$indice] . ($fila), $totFila );//total por fila

  		$fila++;
  		$indice = 3;
  	}
  
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [3] . $fila, $totalAu );//total por fila
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [4] . $fila, $totalCh );//total por fila
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [5] . $fila, $totalMo );//total por fila
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [6] . $fila, $totalMe );//total por fila
  	$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $indicesTabla [7] . $fila, ($totalAu+$totalCh+$totalMo) );//total por fila
  	$indice=0;
  	$fila++;
  	$fila++;
  //}
  
  
  
  
  // establece dimensi√≥n
  for($i = 'A'; $i <= 'H'; $i++){
  	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
  }
  // 2016-08-04 10:33:19
  $fecha = str_replace("-", "_", date("Y-m-d H:i:s"));
  $fecha = str_replace(":", "_", $fecha);
  $fecha = str_replace(" ", "_", $fecha);
  $objPHPExcel->getActiveSheet()->setTitle('Reporte Licencias vigentes ');
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
 	
  	$arreglo_filas =array();
  	$expedidas=array();
  	$tipos =array();
  	$arrAnios;

  	$ubica;
  		/////////////////// Tipos de licencia        --------------------- busca las licencias por tipo y ubicacion////////////////////////////
  	
  		$query=" SELECT p.idPersona, p.RFC, p.CURP, p.nombres, p.primerAp, p.segundoAp,p.telCasa,p.email,
  				p.genero,id.nombreCalle,id.numeroExterior,id.colonia, mun.NOM_MUN, mun2.NOM_MUN as nacimiento,
  				id.codigoPostal,l.fechaExpedicion, l.numero, e.NOM_ENT FROM licencia l
				left join persona p on l.idPersona = p.idPersona
				left join persona_domicilio pd on pd.idPersona  = p.idPersona 
				left join inegi_domicilio id on id.idDomicilio = pd.idDomicilio
  				left join inegidomgeo_cat_estado e on e.CVE_ENT = p.nacCveEnt 
				left join inegidomgeo_cat_municipio mun on mun.CVE_ENT = id.cveEnt and mun.CVE_MUN = id.cveMun
				left join inegidomgeo_cat_municipio mun2 on mun2.CVE_ENT = p.nacCveEnt and mun2.CVE_MUN = p.nacCveMun 
  		 		where   l.estatus = 'aprobada' and l.fechaExpedicion  between DATE('".$FechaIni."') and DATE('".$FechaFin."')";  //echo $query;
  		mysqli_query($dbLink,"SET NAMES 'utf8'");// solucion en linux
  		$result=mysqli_query($dbLink,$query);
  		if(!$result)
  			die("Ocurrio un error en la consulta.");
  		if ($result->num_rows>0)  		
  			while($row = mysqli_fetch_assoc($result)) {	  			
	  			$t['RFC'] = $row['RFC'];
				$t['CURP'] = $row['CURP'];
				$t['nombres'] = $row['nombres'];
				$t['primerAp'] = $row['primerAp'];
				$t['segundoAp'] = $row['segundoAp'];
				$t['telCasa'] = $row['telCasa'];
				$t['email'] = $row['email'];
				$t['genero'] = $row['genero'];
				$t['nombreCalle'] = $row['nombreCalle'];
				$t['numeroExterior'] = $row['numeroExterior'];
				$t['colonia'] = $row['colonia'];
				$t['NOM_MUN'] = $row['NOM_MUN'];
				$t['nacimiento'] = $row['nacimiento'];
				$t['codigoPostal'] = $row['codigoPostal'];
				$t['fechaExpedicion'] = $row['fechaExpedicion'];
				$t['NOM_ENT'] = $row['NOM_ENT'];
				$t['numero'] = $row['numero'];
				$tipos[]=$t;
  			} 	
  		
  	
  	//$resumen[$arrAnios[$j]]=$tipos;
  
  	///***************************** otro reporte ******************************* 
  	///generar tabla tipos de licencia *******************************************************************
  	$content="";//con tiene el contenido del archivo txt 
  	$tablaExp .="<div class='table-wrapper'><header> Reporte de Licencias vigentes. Fecha inicio:".$FechaIni.", Fecha fin:".$FechaFin."</header> </div><table id='example' class='display nowrap' cellspacing='0' width='100%'>
					<thead>
  						<tr  class='border_bottom'>
  							<th scope='col'>RFC</th>
  							<th scope='col'>CURP</th>
  							<th scope='col'>Nombre</th>
  							<th scope='col'>Paterno</th>
  							<th scope='col'>Materno</th>  						
  							<th scope='col'>Calle</th>
  							<th scope='col'>N&uacute;mero Ext.</th>
				  			<th scope='col'>Colonia</th>
				  			<th scope='col'>Delegaci&oacute;n</th>				  			
				  			<th scope='col'>CP</th>
				  			<th scope='col'>Mun. Nac.</th>
				  			<th scope='col'>Edo. Nac.</th>
				  			<th scope='col'>Tel</th>
				  			<th scope='col'>Correo</th>
				  			<th scope='col'>Fecha Expedici&oacute;n</th>
				  			<th scope='col'>Licencia</th>
				  			<th scope='col'>Sexo</th>
				</tr>
  			</thead>
  			<tbody>
  	";
  	$content.="RFC,CURP,Nombre,Paterno,Materno,Calle,N&uacute;mero Ext.,Colonia,Delegaci&oacute;n,CP,Mun. Nac.,Edo. Nac.,Tel,Correo,Fecha Expedici&oacute;n,Licencia,Sexo".PHP_EOL;
  	$menor=0;
  	$Motociclista=0;
  	$Automovilista=0;
  	$Chofer=0;
  	$menor=0;
  	for($i=0; $i <count($tipos);$i++){
  		$value = $tipos[$i];
//   		$Motociclista+=$value['MOTOCICLISTA'];
//   		$Automovilista+=$value['AUTOMOVILISTA'];
//   		$Chofer+=$value['CHOFER'];
//   		$subt = $value['MOTOCICLISTA'] + $value['AUTOMOVILISTA'] +$value['CHOFER'];
//   		$menor+= $value['menor'];
  		$tablaExp .="<tr class='border_bottom'>
  		<td>".$value['RFC']."</td>
  		<td>".$value['CURP']."</td>	
  		<td>".$value['nombres']."</td>
  		<td>".$value['primerAp']."</td>
  		<td>".$value['segundoAp']."</td>  	  		
  		<td>".$value['nombreCalle']."</td>
  		<td>".$value['numeroExterior']."</td>
  		<td>".$value['colonia']."</td>
  		<td>".$value['NOM_MUN']."</td>  
		<td>".$value['codigoPostal']."</td>  				
  		<td>".$value['nacimiento']."</td>
		<td>".$value['NOM_ENT']."</td>
  		<td>".$value['telCasa']."</td>
  		<td>".$value['email']."</td>	
  		<td>".$value['fechaExpedicion']."</td>
  		<td>".$value['numero']."</td>
  		<td>".$value['genero']."</td>
  	  	</tr>";
  		
  		$content.=$value['RFC'].",".
				$value['CURP'].",".
				$value['nombres'].",".
				$value['primerAp'].",".
				$value['segundoAp'].",".
				$value['nombreCalle'].",".
				$value['numeroExterior'].",".
				$value['colonia'].",".
				$value['NOM_MUN'].",".
				$value['codigoPostal'].",".
				$value['nacimiento'].",".
				$value['NOM_ENT'].",".
				$value['telCasa'].",".
				$value['email'].",".
				$value['fechaExpedicion'].",".
				$value['numero'].",".
				$value['genero'].PHP_EOL;
  	}
  	$total = ($Motociclista+$Automovilista+$Chofer);
  	$tablaExp .="</tbody>
  	<footer>
  	<tr class='danger border_bottom'>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>  	
  	</tr>
  	</footer>
  		
  	</table><div class='spacer-20'></div>";
  	 $FechaIni = str_replace("-", "", $FechaIni);
  	 $FechaFin= str_replace("-", "", $FechaFin);
  	 $archivo = "tmp/TA_LI_".$FechaIni."_".$FechaFin.".txt";//ruta y nombre del archivo a descargar
  	$fp = fopen($archivo,"wb");
  	fwrite($fp,$content);
  	fclose($fp);
  	//} // fin arrray anios
  	//print_r($resumen);
  	//print_r($tipos);
  //	$archivo = generarExcel($arrAnios,$resumen,$FechaIni,$FechaFin);
  	;
  	//echo $tablaExp;
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
  		
  		