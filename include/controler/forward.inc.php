<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	require FOLDER_MODEL_WS . "ws.class.NumberService.getCallRules.inc.php";




	#-----------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------Inicializacion de control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#



	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------Funciones----------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------Seccion AJAX--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();



	$xajax->processRequest();

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	$Rules=new DNumberServiceGetCallRules();
	$Rules->Param->setAccountId($objSession->getAccountId());
	
	$Rules->execute();

	//$Rules->makeDebugFile(FOLDER_LOG);

	if($Rules->getError())
		die($Rules->getStrError());


	$strForward="";


	foreach($Rules->Response->getRecords() AS $k=>$v)
	{


		$strForward.='
				<tr>
					<td><a href="forwardedit.php?id=' . $v['call_fwd_rule_id'] . '">' . $v['call_fwd_rule_name'] . '</a></td>
					<td class="hidden-xs">' . $v['member_name'] . '</td>
					<td>' . $v['count_numbers'] . '</td>
					<td>' . translateReturn($v['ring_destination_name']) . '</td>
					<td class="hidden-xs">' . $v['out_caller_id'] . '</td>
					<td>' . ($v['auth_incoming_calls']==1?translateReturn("Yes"):translateReturn("No")) . '</td>
				</tr>';

	}

