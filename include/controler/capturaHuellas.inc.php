<?php

require_once FOLDER_MODEL_EXTEND . "model.persona_biometrico.inc.php";
require 'clienteHardware.php';
require 'adminLicencias.php';
require 'adminBiometrico.php';


	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#
function eliminarArchivo($archivo)
{
    
    //unlink($archivo);
}
	#----------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();
function obtenerHuella($idBiometrico,$imgID) {
	global $objSession;
    
	$r = new xajaxResponse ();
    $datosHuella= conectarLectorBiometrico($idBiometrico);
    
    if(strlen ($datosHuella['error'])==0)
    {
        $_SESSION['huellas'][]=array(
    
            'idBiometrico'=>$idBiometrico,
            'ruta'=>DOMINIO.$datosHuella['archivo']
        );
       $r->assign('img'.$imgID,"src",$datosHuella['archivo']);
       $r->assign('img'.$imgID,"title","Calidad: ".$datosHuella['calidad']);            
	   $r->mostrarAviso ( 'Huella capturada correctamente.' );    
    }
    else
    {
        $r->mostrarError($datosHuella['error']);
    }
    
	
	return $r;
}
$xajax->registerFunction ( "obtenerHuella" );


function guardarHuellas($idPersona)
{
    $r = new xajaxResponse ();
    
    if(count($_SESSION['huellas'])>0)
    {
        	foreach ($_SESSION['huellas'] as $biometrico)
            {
                $objPB = new ModeloPersona_biometrico();
                $objPB->setIdPersona($idPersona);
                $objPB->setIdBiometrico($biometrico['idBiometrico']);
                
                /*Verifica si existe la misma huella basado en idBiometrico, si existe el registro se actualiza el idPersonaBiometrico 
                y al guardar se hace una actualizacion del archivo*/ 
                if($objPB->verificaHuellaByIdBiometrico())
                {
                    eliminarArchivo($objPB->getArchivo());
                }
                $objPB->setArchivo($biometrico['ruta']);
                $objPB->Guardar();
            }
        
        
        $r->mostrarAviso ( 'Datos guardados correctamente.' );
	    $r->redirect("impresion.php",2); 
    }
    else
    {
        $r->mostrarAviso ( 'No se capturo ninguna huella' );
    }   
   	
    return $r;
    
}
$xajax->registerFunction ( "guardarHuellas" );


	$xajax->processRequest();


	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#



	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	if((isset($_SESSION['idLicencia'])) AND (is_numeric($_SESSION['idLicencia']))){
				
				$arrHuellasCapturadas = array();
                $_SESSION['huellas']=$arrHuellasCapturadas;
                $arrInfoLicencia=obtenerLicenciaByIdLicencia($_SESSION['idLicencia']);
               	if(count($arrInfoLicencia)>0){
					$idLicencia = $arrInfoLicencia['idLicencia'];
					$nombreCompleto =strtoupper( $arrInfoLicencia['nombres'].'</br>'.$arrInfoLicencia['primerAp'].' '.$arrInfoLicencia['segundoAp']);
                    $calle =strtoupper($arrInfoLicencia['nombreCalle'].' '.$arrInfoLicencia['numeroExterior']).'</br>';
                    $colonia =strtoupper( $arrInfoLicencia['colonia'].'</br>'.$arrInfoLicencia['municipio'].' '.$arrInfoLicencia['codigoPostal']
                        .'</br>'.$arrInfoLicencia['estado']);
                    $fechaExpedicion = date_format(date_create($arrInfoLicencia['fechaExpedicion']),'Y-m-d');
                    $fechaExpiracion = date_format(date_create($arrInfoLicencia['fechaExpiracion']),'Y-m-d');
                    $idPersona=$arrInfoLicencia['idPersona'];
				}
                $arrBiometrico=obtenerBiometricos();
                if (count($arrBiometrico)>0)
                {
                    $objPersonaBio = new ModeloPersona_biometrico();
                    $objPersonaBio->setIdPersona($idPersona);
                   	foreach ($arrBiometrico as $biometrico)
                       {
                        $objPersonaBio->setIdBiometrico($biometrico['idBiometrico']);
                        $archivo = 'images/huellas/fingerCapture.png';
                        if($objPersonaBio->verificaHuellaByIdBiometrico())
                        {
                            $archivo=$objPersonaBio->getArchivo();
                        }
               	            if (strpos($biometrico['nombre'], 'Izquierdo')!== false)
                            {
                                $huellasLeft.='
                                        <td>'.utf8_encode($biometrico['nombre']).'</td>';
                                        //<img src="images/fingerCapture.png" href="javascript:capturaHuella('.$biometrico['idBiometrico'].'); />
                                $imgLeft.='<td><a href="javascript:getHuella('.$biometrico['idBiometrico'].',&#039;'.$biometrico['keyAware'].'&#039;);" name="'.$biometrico['keyAware'].'"><img src="'.$archivo.'" id="img'.$biometrico['keyAware'].'" style="width:128px;height:150px;border:0;" title="Calidad:"/></a></td>';
                            }
                            else
                            {
                                $huellasRight.='
                                        <td>'.utf8_encode($biometrico['nombre']).'</td>';
                                $imgRight.='<td><a href="javascript:getHuella('.$biometrico['idBiometrico'].',&#039;'.$biometrico['keyAware'].'&#039;);" name="'.$biometrico['keyAware'].'"><img src="'.$archivo.'" id="img'.$biometrico['keyAware'].'" style="width:128px;height:150px;border:0;" title="Calidad:"/></a></td>';
                            } 
                   	       
                    }
                    
                }else{$huellasRight.='No hay biometricos para mostrar';}
               
               
	}
	else
	{
		header("Location: listadoLicencias.php?estatus=enTramite");
		die();
	}
	
	//$arrCategoria=obtenerCategorias($objSession->getIdRol()<=3?true:false);
	
	
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
