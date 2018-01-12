<?php
#----------------------------------------------------------------------------------------------------------------------#
#-------------------------------------------------------Includes-------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
require FOLDER_MODEL_EXTEND . 'model.persona_documento.inc.php';
require FOLDER_MODEL_EXTEND . 'model.persona.inc.php';
require FOLDER_MODEL_EXTEND . 'model.turno.inc.php';
require FOLDER_MODEL_EXTEND . 'model.etapa.inc.php';
require 'admincuentas.php';
#----------------------------------------------------------------------------------------------------------------------#
#---------------------------------------------Inicializacion de variables----------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
//Cargamos el Id de la paersona

$_SESSION['etapa']='certificadoManejo';
$_SESSION['datos']='examen';
	
        if ($_SESSION['etapa']!='certificadoManejo'){
	    header("Location: dashboard.php");
	    die();
	}
	
	if ($_SESSION['datos']!='examen'){
	    header("Location: dashboard.php");
	    die();
	}
if(!isset($_GET['id']))
{
   
  	 header("Location: dashboard.php");
  	 die();
   
}
$objTurno=new ModeloBaseTurno();
$objTurno->setIdTurno($_GET['id']);

$persona=new ModeloBasePersona();
$persona->setIdPersona($objTurno->getIdPersona());


#----------------------------------------------------------------------------------------------------------------------#
#-------------------------------------------------------Funciones------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
function actualizarEstatusTurno()
{
       
        
        
        
}
#----------------------------------------------------------------------------------------------------------------------#
#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#

$xajax=new xajax();
	
	function guardar($idTurno,$f1){
		global $dbLink;
    global $objSession;
		$r = new xajaxResponse ();
    
    $objTurno = new ModeloTurno();
    $objTurno->setIdTurno($idTurno);
                   echo $objTurno->getIdTurno();
		$documentos=new ModeloPersona_documento();
		$documentos->transaccionIniciar();
		$mxh=$documentos->getMaximoHistoricoByPersona($objTurno->getIdTurno());
		
		$documentos->setIdpersona($objTurno->getIdTurno());
		$documentos->setIddocumento(21);//Comprabante de Manejo
		$documentos->setEstatusVigente();
		$documentos->setDocumentoimagen($f1);
		$documentos->setFechacaptura( date('Y-m-d H:i:s'));
		$documentos->setHistorico($mxh+1);
		$documentos->Guardar();
		if($documentos->getError())
		{
			$r->mostrarError($documentos->getStrError());
			return $r;
		}
    
    $objEtapa = new ModeloEtapa();
    $objEtapa->setIdEtapa($objTurno->getIdEtapa());
    $objEtapa->setOrden(10);//Etapa de pago
    $idEtapaSiguiente =$objEtapa->getEtapaByOrden();
    $objTurno->setIdEtapa($idEtapaSiguiente);
    $objTurno->setFechaHora(date('Y-m-d H:i:s'));
    $objTurno->setIdUsuario($objSession->getIdLogin());
    $objTurno->actualizarEtapa();
        
		if($objTurno->getError())
		{
			$r->mostrarError($objTurno->getStrError());
			return $r;
		}
    
		$documentos->transaccionCommit();
		$r->mostrarAviso("Documentos Cargados.");
		$r->redirect("listadoImpresion.php");
		return $r;
	}
	$xajax->registerFunction("guardar");


$xajax->processRequest();

#----------------------------------------------------------------------------------------------------------------------#
#---------------------------------------------Procesamiento de formulario----------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
