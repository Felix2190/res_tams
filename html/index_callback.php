<?php	

require("masterInclude.inc.php");

require(FOLDER_MODEL_WS . "ws.class.AccountService.isUsernameExists.inc.php");
require(FOLDER_MODEL_WS . "ws.class.AccountServiceGetBalance.inc.php");
require(FOLDER_MODEL_WS . "ws.class.AccountService.login.inc.php");
require(FOLDER_MODEL_WS . "ws.class.AccountService.getInfo.inc.php");
require FOLDER_MODEL_WS . "ws.class.AccountService.getAccountCRMLanguage.inc.php";

require(LIB_CONEXION);
require 'admincuentas.php';
	///Colocar dodfigo con variables de sesion
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
	$arrSesion=loginUserInt(array('username'=>$_SESSION['unique_name']));

	if ($arrSesion [0]) {
	$arrDatos = $arrSesion [1];
	$objSession=new clsSession();
	$objSession->updateTime();
	$objSession->setObjetoGetInfo($arrDatos);
	
	if (intval ( $arrDatos ['id_rol'] ) <= 3) {
		$WSGetInfo=new DAccountGetInfo();
		$WSGetInfo->Param->setAccountId($arrDatos['account_id']);
		$WSGetInfo->execute();				
			
		$objSession->setObjetoGetInfo($WSGetInfo->Response);
	}
	$_SESSION['clientLanguage']="es_MX";
	$_SESSION['objSession']=serialize($objSession);
		
	header("Location: dashboard.php");
	
	
	}
?>