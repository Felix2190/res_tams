<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	require_once FOLDER_MODEL_WS . 'ws.class.CallHistoryService.callsListDetailed.inc.php';






	#-----------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------Inicializacion de control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#



	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------Funciones----------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	function procesaLlamadas($arregloLlamadas)
	{
		global $objSession;
		$strLlamadas="";
		foreach ($arregloLlamadas AS $k0=>$v)
		{
			if(substr($v['Destination'], 0,8)=="incoming")
			{
				$destino= translateReturn("Incoming");
			}
			else
			{
				$destino=$v['Destination'];
			}


			$segundos="";

			$s=$v['Duration']%60;
			$m=($v['Duration']-$s)/60;
			$strMin=$m==0?"00":($m<10?"0" . $m:$m);
			$strSeg=$s==0?"00":($s<10?"0" . $s:$s);

			$segundos=$strMin . ':' . $strSeg . " min";


			$strLlamadas.='<tr>
				<td>' . $v['Calling'] . '</td>
				<td class="hidden-xs">' . $v['Time'] . '</td>
				<td>$ ' . $v['Amount'] . ' ' . $objSession->getCurrencyName() . '</td>
				<td>' . $v['Called'] . '</td>
				<td class="hidden-xs">' . ($destino) . '</td>
				<td>' . $segundos . '</td>
			</tr>';

		}

		return '<table class="table table-bordered table-striped" id="tb1"
												data-rt-breakpoint="600">
		<thead>
		<tr>
		<th>'."Origin No.".'</th>
		<th class="hidden-xs">'.("Date").'</th>
		<th>'.("Amount").'</th>
		<th>'.("Destination No.").'</th>
		<th class="hidden-xs">'.("Destination").'</th>
		<th>'.("Time (mm:ss)").'</th>
		</tr>
		</thead>
		<tbody>' . $strLlamadas . '</tbody></table>';
	}




	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------Seccion AJAX--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();

	function enviarFecha($fecha)
	{
		global $objSession;


		$r=new xajaxResponse();


		$fecha=str_replace("-","", $fecha);

		$wsLlamadas=new DCallHistoryServiceCallsListDetailed();
		$wsLlamadas->Param->setAccountId($objSession->getAccountId());
		$wsLlamadas->Param->setDate($fecha);

		$wsLlamadas->execute();

		if($wsLlamadas->getError())
		{
			die($wsLlamadas->getStrError());
		}
		$strLlamadas=procesaLlamadas($wsLlamadas->Response->getCallHistoryDetailed());
		#$r->assign("contenidoLlamadas", "innerHTML", $strLlamadas);
		$r->call("refrescaDatos",$strLlamadas);
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

	$wsLlamadas=new DCallHistoryServiceCallsListDetailed();
	$wsLlamadas->Param->setAccountId($objSession->getAccountId());
	//$wsLlamadas->Param->setAccountId("1000");
	$wsLlamadas->Param->setDate($_GET['idd']);
	$wsLlamadas->Param->setSwitchCurrency(1);

	$wsLlamadas->execute();

	if($wsLlamadas->getError())
	{
		die($wsLlamadas->getStrError());
	}

	$strLlamadas=procesaLlamadas($wsLlamadas->Response->getCallHistoryDetailed());

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
	$_JAVASCRIPT_OUT.= generaTranslateJS(array("Sending Filters"));
	
	$linkMES='callsmonth.php?idm=' . $_GET['idm'] ; 






?>