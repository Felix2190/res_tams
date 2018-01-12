<?php
	require_once 'masterIncludeLogin.inc.php';

	if(!isset($_GET['o']))
	{
		echo "NOK";
		die();
	}

	$origen=$_GET['o'];



	if(!isset($_FILES['RemoteFile'])||!isset($_SESSION['subirArchivos']))
	{
		header("Location:dashboard.php");
		die();
	}





	if($_SESSION['subirArchivos'][$origen]['actual']>=$_SESSION['subirArchivos'][$origen]['total']||$_SESSION['subirArchivos'][$origen]['actual']==-1)
	{
		echo "NOK";
		die();
	}

	/*
	$_SESSION['subirArchivos']['lista']=array("IDENTIFICACION","COMPROBANTE");
	$_SESSION['subirArchivos']['archivos']=array();
	$_SESSION['subirArchivos']['actual']=0;
	$_SESSION['subirArchivos']['total']=2;
	*/


	$fileName = "./tmp/" . rand(10000,99999) . "_" . $_SESSION['subirArchivos'][$origen]['lista'][$_SESSION['subirArchivos'][$origen]['actual']] . "_" . $_FILES['RemoteFile']['name'];

	$_SESSION['subirArchivos'][$origen]['archivos'][$_SESSION['subirArchivos'][$origen]['actual']]=$fileName;


	$fileTempName = $_FILES['RemoteFile']['tmp_name'];
	$fileSize = $_FILES['RemoteFile']['size'];

	$fWriteHandle = fopen($fileName, 'w');
	$fReadHandle = fopen($fileTempName, 'rb');
	$fileContent = fread($fReadHandle, $fileSize);
	fwrite($fWriteHandle, $fileContent);
	fclose($fWriteHandle);
	$_SESSION['subirArchivos'][$origen]['actual']++;

	//print_r($_SESSION['subirArchivos']);

	echo "OK";

