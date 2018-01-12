<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	
	require(FOLDER_MODEL_WS . "ws.class.AccountService.isUsernameExists.inc.php");
	require(FOLDER_MODEL_WS . "ws.class.AccountServiceGetBalance.inc.php");
	require(FOLDER_MODEL_WS . "ws.class.AccountService.login.inc.php");
	require(FOLDER_MODEL_WS . "ws.class.AccountService.getInfo.inc.php");
	require FOLDER_MODEL_WS . "ws.class.AccountService.getAccountCRMLanguage.inc.php";

	require(LIB_CONEXION);
	require 'admincuentas.php';
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

	

	function ingresarInterno($user)
	{
		
		
		
		
    //AuthenticationManager::connect();
		
	}
	
	$xajax=new xajax();
	function ingresar($user,$pass)
	{
		
	#$time=microtime(true);
		
		
		
		$r=new xajaxResponse();
		$arrSesion=loginUser(array('username'=>$user,'password'=>$pass));
//		$r->mostrarAviso($arrSesion);
//		return $r;
	if ($arrSesion [0]) {
		$arrDatos = $arrSesion [1];
		$objSession=new clsSession();
		$objSession->updateTime();
		$objSession->setObjetoGetInfo($arrDatos);

			$_SESSION['clientLanguage']="es_MX";
			$_SESSION['objSession']=serialize($objSession);
			
			$r->redirect("dashboard.php");
			return $r;
				
				
		
		
		
		
				$WSUserExist = new DAccountServiceIsUsernameExists ();
		
		
		/*
		$WSUserExist->Param->setUserName($user);
		$WSUserExist->execute();
		*/
	
	#$timeAux=microtime(true);
	#$time0=$timeAux-$time;
	#$time=$timeAux;
		/*
		if($WSUserExist->getError())
		{
			$r->mostrarError($WSUserExist->getStrError());
			return $r;
		}
		*/

		//$WSUserExist->makeDebugFile(FOLDER_LOG);
		/*
		if($WSUserExist->Response->getExists()==0)
		{
			$r->mostrarAviso(translateReturn("User is not registered."));
			return $r;
		}
		*/

		$WSLogin=new DAccountServiceLogin();

		//$WSLogin->debugEnable();

		$WSLogin->Param->setAccountUsername($user);
		$WSLogin->Param->setAccountPassword($pass);

		$WSLogin->execute();
	
	#$timeAux=microtime(true);
	#$time1=$timeAux-$time;
	#$time=$timeAux;

		#$WSLogin->makeDebugFile(FOLDER_LOG);




		if($WSLogin->getError())
		{
			$r->mostrarError($WSLogin->getStrError());
			return $r;
		}

		if($WSLogin->Response->getAccountId()=="")
		{
			$r->mostrarError(translateReturn("User or password doesn&apos;t match our records. Please check."));
			return $r;
		}
		$WSGetInfo=new DAccountGetInfo();
		$WSGetInfo->Param->setAccountId($WSLogin->Response->getAccountId());
		$WSGetInfo->execute();
		
	#$timeAux=microtime(true);
	#$time2=$timeAux-$time;
	#$time=$timeAux;

		if($WSGetInfo->getError())
		{
			$r->mostrarError($WSGetInfo->getStrError());
			return $r;
		}


				$objSession->setObjetoGetInfo($WSGetInfo->Response);

		//Get Language

		/*
		$Lenguage=new DAccountCRMLanguage();
		$Lenguage->Param->setAccountId($objSession->getAccountId());
		$Lenguage->execute();
		*/
	#$timeAux=microtime(true);
	#$time3=$timeAux-$time;
	#$time=$timeAux;
		/*
		if($Lenguage->getError())
		{
			$r->mostrarError($Lenguage->getStrError());
			return $r;
		}

		$L=$Lenguage->Response->getLanguage();
		if(!isset($L['language_code_a2']))
			$L['language_code_a2']="es";

		switch($L['language_code_a2'])
		{
			case "es":
		*/
				$_SESSION['clientLanguage']="es_MX";
		/*
				break;
			case "fr":
				$_SESSION['clientLanguage']="fr_FR";
				break;
			case "pt":
				$_SESSION['clientLanguage']="pt_BR";
				break;
			default:
				$_SESSION['clientLanguage']="en_US";
		}
		*/






		//Get Balance
		/*
		$wsBalance=new DAccountServiceGetBalance();
		$wsBalance->Param->setAccountId($objSession->getAccountId());
		$wsBalance->execute();
		*/
		
		
	#$timeAux=microtime(true);
	#$time4=$timeAux-$time;
	#$time=$timeAux;
		/*
		if($wsBalance->getError())
		{
			$r->mostrarError($wsBalance->getStrError());
			return $r;
		}
		$objSession->setBalance($wsBalance->Response->getBalance());
		
		*/
		
		
		
		
		$_SESSION['objSession']=serialize($objSession);
		
		
		
	
	#echo "[" . $time0 . "]\n";
	#echo "[" . $time1 . "]\n";
	#echo "[" . $time2 . "]\n";
	#echo "[" . $time3 . "]\n";
	#echo "[" . $time4 . "]\n";
	

		
		$r->redirect("dashboard.php");
		return $r;
	}else 
		{
			$r->mostrarError('Upss Datos incorrectos');
			return $r;
		}
		
	}

	$xajax->registerFunction("ingresar");

	$xajax->registerFunction("ingresarInterno");

	$xajax->processRequest();

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#------------------------------------- JavaScript array initialization     ---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	$_JAVASCRIPT_OUT="";

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Translate on JavaScript---------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	//You use the variable $_JAVASCRIPT_OUT
	//if it's not defined, define it, else concat with the existing one.
	if(!isset($_JAVASCRIPT_OUT))
		$_JAVASCRIPT_OUT="";
	$_JAVASCRIPT_OUT.= generaTranslateJS(array("Logging In"));


