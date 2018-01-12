<?php
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_municipio.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.ubicacion.inc.php";
	require_once FOLDER_INCLUDE.'lib/PHPExcel/PHPExcel.php';
	
	require_once FOLDER_MODEL_EXTEND . "model.licencia.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.tipolicencia.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.ubicacion.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.persona.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.persona_documento.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.inegi_domicilio.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.persona_domicilio.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.inegidomgeo_cat_estado.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.inegidomgeo_cat_municipio.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.inegidomgeo_cat_localidad.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.persona_datos_extras.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.contacto_emergencia.inc.php";
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
  
  function reporte($CURP,$RFC,$Licencia,$GUID) { 	  	
  	global $dbLink;
  	$r = new xajaxResponse ();
 	
  	$arreglo_filas =array();
  	$expedidas=array();
  	$tipos =array();
  	$arrAnios;

  	$ubica;
  	
  	$consulta="";
  	
  	if(trim($CURP)!=""){
  		$consulta.=" p.CURP like '%" .$CURP. "%' ";
  	}
  	if(trim($RFC)!=""){
  		if($consulta!=""){
  			$consulta.=" and p.RFC like '%" .$RFC. "%' ";
  		}else{
  			$consulta.=" p.RFC like '%" .$RFC. "%' ";
  		}
  	}
  	if(trim($Licencia)!=""){
  		if($consulta!=""){
  			$consulta.=" and l.numero like '%" .$Licencia. "%' ";
  		}else{
  			$consulta.=" l.numero like '%" .$Licencia. "%' ";
  		}
  	}
  	if(trim($GUID)!=""){
  	
  	}
 
  		/////////////////// Tipos de licencia        --------------------- busca las licencias por tipo y ubicacion////////////////////////////
  	
  		$query=" SELECT p.idPersona, p.RFC, p.CURP, p.nombres, p.primerAp, p.segundoAp,p.telCasa,p.email,
  				p.genero,l.fechaExpedicion, l.numero, tl.descripcion, l.idLicencias from licencia l
				left join persona p on l.idPersona = p.idPersona
				left join tipolicencia tl on tl.idTipoLicencia  = l.idTipoLicencia				 
  		 		where   l.estatus = 'aprobada' and ". $consulta ; // echo $query;
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
				$t['fechaExpedicion'] = $row['fechaExpedicion'];
				$t['descripcion'] = $row['descripcion'];
				$t['numero'] = $row['numero'];
				$t['idLicencias'] = $row['idLicencias'];
				$tipos[]=$t;
  			} 	
  		
  	
  	//$resumen[$arrAnios[$j]]=$tipos;
  
  	///***************************** otro reporte ******************************* 
  	///generar tabla tipos de licencia *******************************************************************
  	$content="";//con tiene el contenido del archivo txt 
  	$tablaExp .="<div class='table-wrapper'><header> Resultados de la busqueda:</header> </div><table id='example' class='display nowrap' cellspacing='0' width='100%'>
					<thead>
  						<tr>							  							
  							<th scope='col'>Nombre</th>  							
				  			<th scope='col'>CURP</th>
				  			<th scope='col'>RFC</th>  			
  							<th scope='col'>No. Licencia</th>  							
				  			<th scope='col'>Fecha Expedici&oacute;n</th>
				  			<th scope='col'>Tipo</th>
				  			<th scope='col'>Acciones</th>
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
  		$tablaExp .="<tr>
  		
  		
  		<td>".$value['nombres']."</td>  		
		<td>".$value['CURP']."</td>	
		<td>".$value['RFC']."</td>
		<td>".$value['numero']."</td>	
  		<td>".$value['fechaExpedicion']."</td>
  		<td>".$value['descripcion']."</td>
  		<td><a href='edicionsimplificada.php?idL=".$value['idLicencias']."' class='btn btn-default btn-circle'><i class='fa fa-pencil'></i></a>
  			<a href='rupalta2.php?idL=".$value['idLicencias']."' class='btn btn-default btn-circle'><i class='fa fa-eye'></i></a>	
  				</td>
  	  	</tr>";
  		
  		
  	}
  
  	$tablaExp .="</tbody>
  	<footer>
  	<tr class='danger'>
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

  if(isset($_GET['idL'])){
  	$licencia = new ModeloLicencia();
  	$tipoLicencia = new ModeloTipolicencia();
  	$licencia->setIdLicencias($_GET['idL']);
  	$ubicacion = new ModeloUbicacion();
  	$ubicacion->setIdUbicacion($licencia->getIdUbicacion());
  	$persona = new ModeloPersona();
  	$persona->setIdPersona($licencia->getIdPersona());
  
  	$foto = new ModeloPersona_documento();
  	$imagenes = $foto->findImagenesByIdPersona($licencia->getIdPersona());
  	$arrImg;
  	for($i=0; $i< count($imagenes);$i++){
  		$f = new ModeloPersona_documento();
  		$f->setIdpersona_documento($imagenes[$i]);
  		$arrImg[]= $f;
  	}
  	//print_r($arrImg);
//   	$foto->setIdpersona_documento($idFoto);
//   	$firma = new ModeloPersona_documento();
//   	$idFirma = $firma->findFirmaByIdPersona($licencia->getIdPersona());
//   	$firma->setIdpersona_documento($idFirma);
  
  	$persona_domicilio = new ModeloPersona_domicilio();
  	$iddomicilio = $persona_domicilio->findDomicilioByIdPersona($licencia->getIdPersona());
  	$domicilio = new ModeloInegi_domicilio();
  	$domicilio->setIdDomicilio($iddomicilio);
  
  	$estado = new ModeloInegidomgeo_cat_estado();
  	$estado->setCVE_ENT($domicilio->getCveEnt());
  
  	$municipio = new ModeloInegidomgeo_cat_municipio();
  	$municipio->setCVE_ENT($domicilio->getCveEnt());
  	$municipio->setCVE_MUN($domicilio->getCveMun());
  
  	$localidad = new ModeloInegidomgeo_cat_localidad();
  	$localidad->setCVE_ENT($domicilio->getCveEnt());
  	$localidad->setCVE_MUN($domicilio->getCveMun());
  	$localidad->setCVE_LOC($domicilio->getCveLoc());
  
  	//******************************************************
  	$estadoN = new ModeloInegidomgeo_cat_estado();
  	$estadoN->setCVE_ENT($persona->getNacCveEnt());
  
  	$municipioN = new ModeloInegidomgeo_cat_municipio();
  	$municipioN->setCVE_ENT($persona->getNacCveEnt());
  	$municipioN->setCVE_MUN($persona->getNacCveMun());
  
  	$localidadN = new ModeloInegidomgeo_cat_localidad();
  	$localidadN->setCVE_ENT($persona->getNacCveEnt());
  	$localidadN->setCVE_MUN($persona->getNacCveMun());
  	$localidadN->setCVE_LOC($persona->getNacCveLoc());
  
  	$media_afi = new ModeloPersona_datos_extras();
  	$idmedia_afi = $media_afi->findIdByIdPersona($licencia->getIdPersona());
  	$media_afi->setIdPersonaDatosExtras($idmedia_afi);
  
  	$contacto = new ModeloContacto_emergencia();
  	$idcontacto = $contacto->findIdByIdPersona($licencia->getIdPersona());
  	$contacto->setIdContacto($idcontacto);
  
  	//******************************************************
  	$estadoC = new ModeloInegidomgeo_cat_estado();
  	$estadoC->setCVE_ENT($contacto->getCveEnt());
  
  	$municipioC = new ModeloInegidomgeo_cat_municipio();
  	$municipioC->setCVE_ENT($contacto->getCveEnt());
  	$municipioC->setCVE_MUN($contacto->getCveMun());
  
  	$localidadC = new ModeloInegidomgeo_cat_localidad();
  	$localidadC->setCVE_ENT($contacto->getCveEnt());
  	$localidadC->setCVE_MUN($contacto->getCveMun());
  	$localidadC->setCVE_LOC($contacto->getCveLoc());
  	
  	$requerimientos="";
  	if($media_afi->getUsaLentes()==1){
  		$requerimientos="Usa lentes";
  	}
  	if($media_afi->getDonaOrganos()==1){
  		if($requerimientos!="")
  			$requerimientos.=", donador de organos";
  			else
  				$requerimientos=" Donador de organos";
  	}
  	if($media_afi->getUsaTransmisionAutomat1ica()==1){
  		if($requerimientos!="")
  			$requerimientos.=", transmision automatica";
  			else
  				$requerimientos=" Transmision automatica";
  	}
  	if($media_afi->getEquipadoConductorDiscapacitado()==1){
  		if($requerimientos!="")
  			$requerimientos.=", equipo conductor discapacitado";
  			else
  				$requerimientos=" Equipo conductor discapacitado";
  	}
  	
  	if($media_afi->getEquipadoConductorProtesis()==1){
  		if($requerimientos!="")
  			$requerimientos.=", equipado conductor protesis";
  			else
  				$requerimientos=" Equipado conductor protesis";
  	}
  	if($requerimientos!="")
  		$requerimientos.=".";
  	
  	if($licencia->getIdLicencias()==0)
  	{
  		pdfErrorMensaje('No se encontro informacion. [0x1]');
  	}
  	else{
  		
  	}
  	
  	$strImagenes ="";
  	for($i=0; $i<count($arrImg);$i++){
  		$uno = $arrImg[$i];
  	 $strImagenes .= '<div class="col-xs-3"><a href="'. $uno->getDocumentoimagen() .'" class="thumbnail">
  	<img src="'.$uno->getDocumentoimagen().'" alt="125x125">
  	</a>
  	</div>';
  	}
  	 		
//   	<div class="col-xs-3">
//   	<a href="#" class="thumbnail">
//   	<img src="125x125.jpg" alt="125x125">
//   	</a>
//   	</div>
//   	<div class="col-xs-3">
//   	<a href="#" class="thumbnail">
//   	<img src="125x125.jpg" alt="125x125">
//   	</a>
//   	</div>
//   	<div class="col-xs-3">
//   	<a href="#" class="thumbnail">
//   	<img src="125x125.jpg" alt="125x125">
//   	</a>
//   	</div>
  	 
  	
  }
  