<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	require_once FOLDER_MODEL_WS . 'ws.class.CallHistoryServiceCallsList.inc.php';






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





			$partesdeCadena=explode(":",$v['ChargeDuration']);
			$minutos=$partesdeCadena[0];
			$segundos=$partesdeCadena[1];

			$duracionSegundos=($minutos*60)+$segundos;
			if($v['SuccessfulCalls']!=0)
				$duracionPromedio=round($duracionSegundos/$v['SuccessfulCalls']);
			else
				$duracionPromedio=0;



			$segundos="";
			$s=$duracionPromedio%60;
			$m=(($duracionPromedio-$s)/60);
			$strMin=$m==0?"00":($m<10?"0" . $m:$m);
			$strSeg=$s==0?"00":($s<10?"0" . $s:$s);

			$acd=$strMin . ':' . $strSeg;




			$p=number_format(($v['SuccessfulCalls']/$v['TotalCalls'])*100,2);


			$strLlamadas.='<tr>
				<td><a href="callsdetail.php?idm=' . $v['month_idx'] . '&idd=' . $v['day_idx'] . '">' . $v['Day'] . '</a></td>
				<td class="hidden-xs">' . $v['TotalCalls'] . '</td>
				<td>' . $v['SuccessfulCalls'] . '</td>
				<td>' . $v['ChargeDuration'] . '</td>
				<td class="hidden-xs">' . $v['Cost'] . ' ' . $objSession->getCurrencyName() . '</td>
				<td>' . $p . ' %</td>
				<td class="hidden-xs">' . $acd . '</td>
			</tr>';

		}
		return $strLlamadas;
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

		#03/01/2014 - 03/31/2014
		$fechas=explode($fecha);
		$fechaIni=trim($fechas[0]);
		$fechaFin=trim($fechas[1]);


		$pedazos=explode("/",$fechaIni);
		$fechaIni=$pedazos[2] .$pedazos[1].$pedazos[0];

		$pedazos=explode("/",$fechaFin);
		$fechaFin=$pedazos[2] .$pedazos[1].$pedazos[0];


		$r=new xajaxResponse();


		$wsLlamadas=new DCallHistoryServiceCallsListDetailed();
		$wsLlamadas->Param->setAccountId($objSession->getAccountId());
		$wsLlamadas->Param->setDate($fecha);

		$wsLlamadas->execute();

		if($wsLlamadas->getError())
		{
			die($wsLlamadas->getStrError());
		}
		$strLlamadas=procesaLlamadas($wsLlamadas->Response->getCallHistoryDetailed());
		$r->assign("contenidoLlamadas", "innerHTML", $strLlamadas);
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


	$Date=date("Ymd");




	$strLlamadas="";

	$wsLlamadas=new DCallHistoryServiceCallsList();

	$wsLlamadas->Param->setAccountId($objSession->getAccountId());
	//$wsLlamadas->Param->setAccountId("1000");
	$wsLlamadas->Param->setMonth($_GET['idm']);
	$wsLlamadas->Param->setDay(0);
	$wsLlamadas->Param->setSwitchCurrency(1);
	$wsLlamadas->Param->setRowCount(0);
	$wsLlamadas->Param->setOffSet(0);
	$wsLlamadas->Param->setSortBy("Day");
	$wsLlamadas->Param->setOrderType("desc");


	$wsLlamadas->execute();

	if($wsLlamadas->getError())
	{
		die($wsLlamadas->getStrError());
	}

	$strLlamadas=procesaLlamadas($wsLlamadas->Response->getCallHistory());















?>