<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	require FOLDER_MODEL_WS . "ws.class.CallHistoryService.cdrLookup.inc.php";




	#-----------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------Inicializacion de control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#



	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------Funciones----------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	function presentaLista($Datos)
	{
		global $objSession;
		$strRetorno="";
		foreach($Datos AS $k => $v)
		{
			$p=explode(" ",$v['setup_time']);

			$date=$p[0];
			$time=$p[1];


			$session_duration;
			$segundos="";

			$s=$v['session_duration']%60;
			$m=($v['session_duration']-$s)/60;
			$strMin=$m==0?"00":($m<10?"0" . $m:$m);
			$strSeg=$s==0?"00":($s<10?"0" . $s:$s);

			$segundos=$strMin . ':' . $strSeg . " min";


			$strRetorno.='
				<tr>
					<td>' . $date . '</td>
					<td>' . $time . '</td>
					<td>' . $v['calling_party'] . '</td>
					<td>' . $v['called_party'] . '</td>
					<td>' . translateReturn($v['destination']) . '</td>
					<td>' . $segundos . '</td>
					<td>' . $v['charge'] . ' ' . $objSession->getCurrencyName() . '</td>
					<td>' . $v['category_name'] . '</td>
				</tr>';
		}

		$strRetorno='<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
						<thead>
							<tr>
								<th>'.translateReturn("Date").'</th>
								<th>'.translateReturn("Time").'</th>
								<th>'.translateReturn("Origin No.").'</th>
								<th>'.translateReturn("Destination No.").'</th>
								<th>'.translateReturn("Destination").'</th>
								<th>'.translateReturn("Duration (mm:ss)").'</th>
								<th>'.translateReturn("Charge").'</th>
								<th>'.translateReturn("Category").'</th>
							</tr>
						</thead>
						<tbody>
							' . $strRetorno . '
						</tbody>
					</table>';

		return $strRetorno;
	}


	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------Seccion AJAX--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();

	function enviarFecha($fechaIni,$fechaFin)
	{
		global $objSession;

		#03/01/2014 - 03/31/2014
		#$fechas=explode("-",$fecha);
		$fechaIni=trim($fechaIni);
		$fechaFin=trim($fechaFin);


		$pedazos=explode("/",$fechaIni);
		$fechaIni=$pedazos[2] .$pedazos[0].$pedazos[1];

		$pedazos=explode("/",$fechaFin);

		$fechaFin=date("Ymd",mktime(0,0,0,$pedazos[0],$pedazos[1]+1,$pedazos[2]));


		//$fechaFin=$pedazos[2] .$pedazos[0].$pedazos[1];


		$r=new xajaxResponse();


		$wsLlamadas=new DCallHistoryServiceCdrLookup();

		$wsLlamadas->Param->setAccountId($objSession->getAccountId());
		$wsLlamadas->Param->setStartTime($fechaIni);
		$wsLlamadas->Param->setEndTime($fechaFin);


		$wsLlamadas->execute();

		$wsLlamadas->makeDebugFile(FOLDER_LOG);

		if($wsLlamadas->getError())
		{
			die($wsLlamadas->getStrError());
		}
		$strLlamadas=presentaLista($wsLlamadas->Response->getCdrs());
		$r->assign("divTabla", "innerHTML", $strLlamadas);
		$r->ocultarMensaje();
		return $r;
	}
	$xajax->registerFunction("enviarFecha");



	$xajax->processRequest();

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	$strLlamadas="";
	
	#-----------------------------------------------------------------------------------------------------------------#
	#------------------------------------- JavaScript array initialization     ---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	//$_JAVASCRIPT_OUT=$strDatosTablaJS . $strAsignadosJS . $strDisponiblesJS;
	
	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Translate on JavaScript---------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	//You use the variable $_JAVASCRIPT_OUT
	//if it's not defined, define it, else concat with the existing one.
	if(!isset($_JAVASCRIPT_OUT))
		$_JAVASCRIPT_OUT="";
	$_JAVASCRIPT_OUT.= generaTranslateJS(array("Please, select the date range","Sending filters..."));

