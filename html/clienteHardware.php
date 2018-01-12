<?php 
/*
El funcionamiento consiste en conectarse a una app de escritorio "ImpresionLicencias", que recibe la ruta de las imagenes 
(frontal y trasera) de la licencia, estas imagenes seran generadas en el sistema WEB y alojadas en la carpeta imagenLicencias
se realiza una coneccion a la app de escritorio por medio de sockets, que retorna el resultado de la operación: 
"Servidor no encontrado, Impresora Desconectad, OK (impresón realizada con éxito)".
*/
function conectarImpresoraLicencias($idLicencia){
$error = '';
$mensaje='';

    
     if(!$socket = @fsockopen("162.210.99.245", 1500))
     {
       // die("Servidor de hardware no encontrado.");
       $error='Servidor de hardware no encontrado.'; 
     }
     else
     {
          fwrite($socket, $idLicencia);
        	$datos="";
            while (!feof($socket))
            {
        		$datos.= fgets($socket, 128);
        	}
        	
            fclose($socket);
        	$mensaje = base64_decode($datos);
        	
     }
     return array(
      'error'=>$error,
      'mensaje'=>$mensaje
     );
 }
 
 function conectarLectorBiometrico($idBiometrico)
 {
  
  $error ='';
  $calidad=0;
  $archivo='';  
    if(!$socket = @fsockopen("192.168.1.64", 1225))
     {
        $error='Servidor de hardware no encontrado.';
         
     }
     else
     {
        $salida = $idBiometrico.',';    
        fwrite($socket, $salida);
    	$datos="";
        while (!feof($socket))
        {
    		$datos.= fgets($socket, 50000);
    	}
    	
        fclose($socket);
        if (strpos($datos, 'property') !== false)
        {
        
        	$datosArray =explode('property',$datos) ;
        	$data = base64_decode($datosArray[0]);
            $calidad=$datosArray[2];
            
    		$archivo = "images/huellas/".$datosArray[1];
        	
        	$pf2 = fopen ( $archivo, "w" );
        	if (! $pf2)
        		die ( returnAppError ( "Imposible abrir archivo" ) );
        
        	fwrite ( $pf2, $data );
        	fclose ( $pf2 );
            
        } 
        else
        {
            $error='Escaner Desconectado.';
        }
      	
     }
      //echo $datosHuella['calidad'];
       return array(
       'error'=>$error,
       'calidad'=>$calidad,
       'archivo'=>$archivo
       );
 }
?>