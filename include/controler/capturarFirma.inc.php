<?php

//echo FOLDER_MODEL . "extend/model.producto.inc.php";
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#



	#----------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();

	 function capturar()
	{
		global $_NOW_,$_HOST_,$_PORT_,$_ERRNO_,$ERRSTR,$_X_;
		global $objSession;
		$r=new xajaxResponse();
		/*
		$fp = fsockopen($_HOST_,$_PORT_,$_ERRNO_,$ERRSTR,$_X_);
		
		if (!$fp)
		{
		    $r->mostrarError("Error: $errstr ($errno)");
		}
		else
		{
		    $idturno = "7"; // parametro que recibe la app de escritorio
		    fwrite($fp, $out);
		    $datos="";
		    while (!feof($fp))
		    {
		        $datos.= fgets($fp, 50000);
		        //echo $datos;
		        //echo "\n";
		        
		    }
		    fclose($fp);
		    
		    $datosArray =explode('nombreImagen',$datos) ;
		    $data = base64_decode($datosArray[0]);
		    */
		    $archivoCS = "images/huellas/temp.bmp";//.$datosArray[1];
		    //$fotoJPG = substr(explode(";",$fotoJPG)[0], 7);
		    //file_put_contents('imagenes/img.bmp', base64_decode($data));
		    $pf2 = fopen ( $archivoCS, "w" );
		    if (! $pf2)
		        die ( returnAppError ( "Imposible abrir archivo" ) );
		        
		        fwrite ( $pf2, $data );
		        fclose ( $pf2 );
		        
		        
		        $r->assign("divImagen", "innerHTML", "<img src=".$archivoCS." border='10' />");
		        //		        $r->assign("divImagen", "innerHTML", '<img class="media-object" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAACWCAYAAACb3McZAAAC0klEQVR4nO3ZQc6aQACA0d7/BixZu+YAXoAbeBa7aMYgwa+iTdqkb/GSX+fHYTEfDPrjdrvdgWM//vYJwL9MIBAEAkEgEAQCQSAQBAJBIBAEAkEgEAQCQSAQBAJBIBAEAkEgEAQCQSAQBAJBIBAEAkEgEAQCQSAQBAJBIBAEAkEgEAQCQSAQBAJBIBAEAkEgEAQCQSAQBAJBIBAEAkEgEAQCQSAQBAJBIBAEAkEgEAQCQSAQBAJBIBAEAkEgEAQCQSAQBAJBIBAEAkEgEAQCQSAQBAJBIBAEAkEgEAQCQSAQBAJBIBAEctLlcrlP0/RwvV4fY+u6Po1tj6uxs3Nv37ter0+fO03TfV3XPzbn/04gJyzL8hTFWLBjQc7zfL9cLo+/53l+HFtj75jn+XChj3Ma57A/5ps5EchXxtV7WZbH1XpZlvvt9rxwa+ydefZ3iO3YCGd/zLdz8otAvrC9o4xYxt1l+7rGttug8blj0Y/FPMaOYtjHczTH0WveI5AvbBf2fvu1vbvU2PbYo//d2gey/5ztlu93c/IegXxoLMaxAL8J5HZ7fsYYzw17r7ZTw9k5+T2BfGB7xR/vfbrFGsdvt1qvnhPOBGKL9WcI5KSx0PZX+VfbpnVdc2wcP03Ty2+qhk8C8ZD+HYGcVFf5T7/m3T47vApwHPfOM8g7c/IegZwwrsJ7261W/TB3NHYUxP75Zji6g+zPaR+uHwq/IxAIAoEgEAgCgSAQCAKBIBAIAoEgEAgCgSAQCAKBIBAIAoEgEAgCgSAQCAKBIBAIAoEgEAgCgSAQCAKBIBAIAoEgEAgCgSAQCAKBIBAIAoEgEAgCgSAQCAKBIBAIAoEgEAgCgSAQCAKBIBAIAoEgEAgCgSAQCAKBIBAIAoEgEAgCgSAQCAKBIBAIAoEgEAgCgSAQCAKBIBAIAoEgEAgCgSAQCAKBIBAIAoEgEAgCgSAQCD8BhL2ml0nGYXAAAAAASUVORK5CYII=" alt="Firma" style=" width: 500px; height: 250px;" data-src="holder.js/200x150/karma-grey">');
		        
		        
		        
		
		$r->mostrarAviso("Captura correcta");
		return $r;
		

//	}
	 }
	$xajax->registerFunction("capturar");

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
