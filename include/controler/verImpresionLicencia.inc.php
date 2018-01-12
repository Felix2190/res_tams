<?php

	require_once FOLDER_MODEL_EXTEND . "model.persona_biometrico.inc.php";
    require_once FOLDER_MODEL_EXTEND . "model.persona_documento.inc.php";
    require_once FOLDER_MODEL_EXTEND . "model.contacto_emergencia.inc.php";
    require_once FOLDER_MODEL_EXTEND . "model.persona_domicilio.inc.php";
require 'adminLicencias.php';
require 'clienteHardware.php';

	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#
function validar()
{
    
}
	#----------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();
function conectarImpresora( $idLicencia) {
	global $objSession;
	$r = new xajaxResponse ();
	
	 $arrRetorno = conectarImpresoraLicencias($idLicencia);
       
       
   if(strlen ($arrRetorno['error'])==0)
   {
      if (strpos($arrRetorno['mensaje'], 'Error') !== false)
      {
          $r->mostrarError( $arrRetorno['mensaje'] );
          $r->redirect('verImpresionLicencia.php',2);
      } 
      else
      {
          $r->mostrarAviso('Licencia impresa correctamente');
      }
   }
   else
   {    
    
	     $r->mostrarError ($arrRetorno['error'] );
    }
//	$r->redirect('verImpresionLicencia.php',2);
	return $r;
}
$xajax->registerFunction ( "conectarImpresora" );

	$xajax->processRequest();


	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#



	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	$desc_arc=$archivos_nombre = array();
	$idPerfil=$objSession->getIdUser();
	$id_ticket=$_SESSION['tid'];
	
	if((isset($_SESSION['idLicencia'])) AND (is_numeric($_SESSION['idLicencia']))){
				
                $arrInfoLicencia=obtenerLicenciaByIdLicencia($_SESSION['idLicencia']);
                $idPersona = $arrInfoLicencia['idPersona'];
				
                $datosSecretario = obtenerDatosSecretario();
					//	echo 'si <br />';
				if(count($arrInfoLicencia)>0){
				    $_SESSION['arrLicencia'] = $arrInfoLicencia;
						
					$idLicencia = $arrInfoLicencia['idLicencia'];
					$nombreCompleto =strtoupper( $arrInfoLicencia['nombres'].'</br>'.$arrInfoLicencia['primerAp'].' '.$arrInfoLicencia['segundoAp']);
                    $calle =strtoupper($arrInfoLicencia['nombreCalle'].' '.$arrInfoLicencia['numeroExterior']).'</br>';
                    $colonia =strtoupper( $arrInfoLicencia['colonia'].'</br>'.$arrInfoLicencia['municipio'].' '.$arrInfoLicencia['codigoPostal']
                        .'</br>'.$arrInfoLicencia['estado']);
                    $fechaExpedicion = date_format(date_create($arrInfoLicencia['fechaExpedicion']),'Y-m-d');
                    $fechaExpira = date_format(date_create($arrInfoLicencia['fechaExpedicion']),'Y-m-d');
                    
                    $imprimir = true;
                    $objPersonaBiometrico = new ModeloPersona_biometrico();
                    $objPersonaBiometrico->setIdPersona($idPersona);
                    if($objPersonaBiometrico->verificaExisteHuellaByIdPersona()>0)
                    {
                        $iconoHuella = 'fa fa-check';
                    }
                    else
                    {
                        $iconoHuella = 'fa fa-ban';
                        $imprimir = false;
                    }
                    
                    $objPersonaDocumento = new ModeloPersona_documento();
                    $objPersonaDocumento->setIdPersona($idPersona);
                    if($objPersonaDocumento->verificaExisteFotografiaByIdPersona()>0)
                    {
                        $iconoFoto = 'fa fa-check';
                    }
                    else
                    {
                        $iconoFoto = 'fa fa-ban';
                        $imprimir = false;
                    }  
                    
                    $objContacto = new ModeloContacto_emergencia();
                    $objContacto->setIdPersona($idPersona);
                    if($objContacto->verificaExisteContactoByIdPersona()>0)
                    {
                        $iconoContacto = 'fa fa-check';
                    }
                    else
                    {
                        $iconoContacto = 'fa fa-ban';
                        $imprimir = false;
                    }
                    
                    $objPersonaDomicilio = new ModeloPersona_domicilio();
                    $objPersonaDomicilio->setIdPersona($idPersona);
                    if($objPersonaDomicilio->verificaExisteDomicilioByIdPersona()>0)
                    {
                        $iconoDomicilio = 'fa fa-check';
                    }
                    else
                    {
                        $iconoDomicilio = 'fa fa-ban';
                        $imprimir = false;
                    }
                   
                    
	
				}
                if (count($datosSecretario)>0)
                {
                    $nombreSecretario = $datosSecretario['nombreSecretario'];
                    $nombrePuesto = $datosSecretario['nombrePuesto'];
                    $firmaSecretario = $datosSecretario['rutaFirmaSecretario'];
                }
	}
	else
	{
		header("Location: listadoLicencias.php?estatus=pagada");
		die();
	}
	

	
	
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
