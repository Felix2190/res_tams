<?php
#----------------------------------------------------------------------------------------------------------------------#
#-------------------------------------------------------Includes-------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
require FOLDER_MODEL_EXTEND . 'model.persona_documento.inc.php';
require FOLDER_MODEL_EXTEND . 'model.persona.inc.php';
require FOLDER_MODEL_EXTEND . 'model.turno.inc.php';
require FOLDER_MODEL_EXTEND . 'model.reglaLicencia.inc.php';
require FOLDER_MODEL_EXTEND . 'model.documento.inc.php';

require 'admincuentas.php';
#----------------------------------------------------------------------------------------------------------------------#
#---------------------------------------------Inicializacion de variables----------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#

	
        if ($_SESSION['etapa']!='documentos'){
	    header("Location: dashboard.php");
	    die();
	}
	
	

//Cargamos el Id de turno

	if(!isset($_SESSION['idTurno']))
	{
	    header("Location: dashboard.php");
	    die();
	}
	$turno=new ModeloBaseTurno();
$turno->setIdTurno($_SESSION['idTurno']);
$_SESSION['documentos']='';
if (isset($_SESSION['documentos'])){
$regla = new ModeloReglaLicencia();
$arrRegla=$regla->getDocumentosByTipoLicencias($turno->getIdTipoLicencia());
$docs = new ModeloDocumento();
$arrDocs=$docs->getListadoDocumentos();
$arrIdsDocs = array();
/*
foreach ($arrRegla as $doc=>$status){
    if ($status=='1')
        echo $doc.'<b>'.$arrDocs[$doc].'</b> id='.$arrDocs[$doc]['id'].' nombre='.$arrDocs[$doc]['nombre'].'<br />';
}
*/
    foreach ($arrRegla as $doc=>$status)
        if ($status=='1')
            array_push($arrIdsDocs, DWObject_.$arrDocs[$doc]['id']);
    
        
$persona=new ModeloPersona();
$persona->setIdPersona($turno->getIdPersona());
}else {
//    header("Location: listadoIdentidades.php");
//    die();
}



#----------------------------------------------------------------------------------------------------------------------#
#-------------------------------------------------------Funciones------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#

function guardarDocumento($idPersona,$idDoc,$file){
    
    $documentos=new ModeloPersona_documento();
    $mxh=$documentos->getMaximoHistoricoByPersona($idPersona);
    
    $documentos->setIdpersona($idPersona);
    $documentos->setIddocumento($idDoc);
    $documentos->setEstatusVigente();
    $documentos->setDocumentoimagen($file);
    $documentos->setFechacaptura( date('Y-m-d H:i:s'));
    $documentos->setHistorico($mxh+1);
    $documentos->Guardar();
    if($documentos->getError())
        return array(false,$documentos->getStrError());
    return array(true);
    
}
#----------------------------------------------------------------------------------------------------------------------#
#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#

$xajax=new xajax();
	
	function guardar($idPersona,$f1,$f2,$f3,$idTurno){
		global $dbLink;
		$r = new xajaxResponse ();
		$documentos=new ModeloPersona_documento();
		$documentos->transaccionIniciar();
		$mxh=$documentos->getMaximoHistoricoByPersona($idPersona);
		
		$documentos->setIdpersona($idPersona);
		$documentos->setIddocumento(1);//Fotografia
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
		
		$documentos2=new ModeloPersona_documento();
		
		$documentos2->setIdpersona($idPersona);
		$documentos2->setIddocumento(2);//Fotografia
		$documentos2->setEstatusVigente();
		$documentos2->setDocumentoimagen($f2);
		$documentos2->setFechacaptura( date('Y-m-d H:i:s'));
		$documentos2->setHistorico($mxh+1);
		$documentos2->Guardar();
		if($documentos2->getError())
		{
			$r->mostrarError($documentos2->getStrError());
			return $r;
		}
		
		$documentos3=new ModeloPersona_documento();
		$documentos3->setIdpersona($idPersona);
		$documentos3->setIddocumento(3);//Fotografia
		$documentos3->setEstatusVigente();
		$documentos3->setDocumentoimagen($f3);
		$documentos3->setFechacaptura( date('Y-m-d H:i:s'));
		$documentos3->setHistorico($mxh+1);
		$documentos3->Guardar();
		if($documentos3->getError())
		{
			$r->mostrarError($documentos3->getStrError());
			return $r;
		}
		
		$documentos->transaccionCommit();
		$r->mostrarAviso("Documentos Cargados.");
		unset($_SESSION['documentos']);
		//$r->redirect("dashboard.php");
		$r->redirect("biograficos.php?id=".$idTurno,2);
		header("Location: biometricos.php?id=".$idTurno);
		
		return $r;
	}
	$xajax->registerFunction("guardar");

	
	function guardarDocs($idPersona,$arrayInfo,$idTurno){
	    global $dbLink;
	    $r = new xajaxResponse ();
	    
	    foreach ($arrayInfo as $idDoc => $file){
	        $res=guardarDocumento($idPersona, $idDoc, $file);
	        if (!$res[0]){
	            $r->mostrarError($res[1]);
	            return $r;
    	    }
	    }
	    $r->mostrarAviso("Documentos Cargados.");
	    unset($_SESSION['documentos']);
	    //$r->redirect("dashboard.php");
	    $r->redirect("biograficos.php?id=".$idTurno,2);
	    
	    return $r;
	}
	$xajax->registerFunction("guardarDocs");
	

$xajax->processRequest();

#----------------------------------------------------------------------------------------------------------------------#
#---------------------------------------------Procesamiento de formulario----------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#

if (isset($_GET['id']))
    $IDT=$_GET['id'];
    else
        $IDT=0;
        