<?php

	require("masterIncludeLogin.inc.php");
	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
		
	require FOLDER_MODEL_EXTEND . 'model.prospecto.inc.php';
	
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
	#---------------------------------------Procesamiento de Formulario (POST)----------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	
	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
		
	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------Seccion AJAX--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	$Prospecto=new ModeloProspecto();
	$Prospecto->setIdProspecto($_GET['id']);
	
	$file = "../include/propuestas/".$Prospecto->getFilePropuesta();
	
	if (file_exists($file))
	{
		$fileName =str_replace(" ","",$Prospecto->getFilePropuesta());
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename='.$fileName);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		ob_clean();
		flush();
		readfile($file);
		exit;
	}
	
	
	
	#-----------------------------------------------------------------------------------------------------------------#
	#------------------------------------- JavaScript array initialization     ---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	
	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Translate on JavaScript---------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	
		
		
		
	
	
