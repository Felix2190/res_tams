<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	error_reporting(E_ALL);
	ini_set("display_errors", "1");

	
	require_once FOLDER_MODEL_WS . "ws.class.Plan.getAccountPlan.inc.php";

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

	#$xajax=new xajax();



	#$xajax->processRequest();

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	$errorbit = FALSE;
	
	$SQL="SELECT amadeoOptions.idAmadeoOptions, amadeoOptions.name AS name, clientMods.idClientMod,  clientMods.create AS setup, clientMods.idClient, clientMods.idAmadeoOptions,
			clientMods.renew AS renew, clientMods.users AS users FROM amadeoOptions, clientMods
			WHERE amadeoOptions.idAmadeoOptions = clientMods.idAmadeoOptions AND clientMods.idClient =" . $objSession->getAccountId() ." ORDER BY clientMods.idAmadeoOptions ASC LIMIT 0,1 ";
	$record=mysqli_query($dbLink,$SQL);
	if($record&&mysqli_num_rows($record)>0)
	{
		/*
		while($row_inf=mysql_fetch_assoc($record))
		{
			//Verify case for each type of license.
		}
		*/
		
		$infoTicket=mysqli_fetch_assoc($record);
		$amadeoVersion = $infoTicket['name'];
		$amadeoUsers=$infoTicket['users'];
		$dateStart=$infoTicket['setup'];
		$dateFinish=$infoTicket['renew'];
	}
	else
	{
		$errorbit = TRUE;
	}

	#$planType=$objSession->detallesPlan['PostPaid']?"Postpaid":"Prepaid";
	$planType=$objSession->getPaymentMethodId()==1?translateReturn("Postpaid"):translateReturn("Prepaid");

	/* Error message */
	if($errorbit)
		{
			$error_alert = '<div class="col-md-12">
							<div class="alert alert-warning">
								<i class="fa fa-info-circle"></i>
								'.translateReturn("<strong>Oh oh! we got a problem</strong><br />
								We can&apos;t retrieve your complete suscription plan information. Either your registration is incomplete or you are in a trial mode.<br />
								If you think this maybe a mistake, please <strong>contact support</strong>.").'
							</div>
						</div>';
		}
		
	
		
	if(!$objSession->tieneDetallesPlan())
	{
		$Plan=new DPlanGetAccountPlan();
		$Plan->Param->setAccountId($objSession->getAccountId());
		$Plan->execute();
		$objSession->setObjetoDetallesPlan($Plan->Response->PlanDetails);
		$_SESSION['objSession']=serialize($objSession);
	}
	
	//print_r($Plan->Response->PlanDetails);
	//die();
	
	
	
