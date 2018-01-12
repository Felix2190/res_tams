<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

//require 'adminLicencias.php';
require_once FOLDER_MODEL_EXTEND . "model.examen.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.turno.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.persona.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.tipolicencia.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.ubicacion.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.etapa.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.examen_reprobado.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.configuracion.inc.php";

	#-----------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------Inicializacion de control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#



	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------Funciones----------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
    function getExamenesReprobadoByIdPersona($idPersona)
    {
        
    }

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------Seccion AJAX--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();
	

function mostrarExamen($idTurno)
{
$r = new xajaxResponse();
    $r->redirect('examenUpload.php?id='.$idTurno,2);
    return $r;
/*
    global $objSession;
    $r = new xajaxResponse();
    
    if($idExamen==0)
    {
     $r->mostrarDenegado('No existe un examen asociado al tipo de trámite');   
    }
    else
    {
   	    $_SESSION['idTurno']=$idTurno;
        $_SESSION['idExamen']=$idExamen;
    
    /*
    if($tipo=='teorico')
    {
            //validar que no exista una evaluacion teorica no aprobada
            if(getEvaliacionNoAprobada($idLicencia, $idExamen))
            {
                $r->mostrarAviso(utf8_encode("Este examen ya fue presentado obteniendo una calificación no aprobatoria."));
            }
            else
            {
                $r->redirect('examenAplica.php',2);
            }
        
    }
    else
    {
        $r->redirect('examenAplica.php',2);    
    }
    $r->redirect('examenAplica.php',2);
    }
    return $r;
    */
}
$xajax->registerFunction("mostrarExamen");

function cargaDocumento($idTurno)
{
   
    $r = new xajaxResponse();
    $r->redirect('examenUpload.php?id='.$idTurno,2);
    return $r;
}
$xajax->registerFunction("cargaDocumento");
$xajax->processRequest();
	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
//if (is_numeric($_GET['idEtapa'])) {
	
    $idEtapa = '9';
    
    
    
    $objTurno = new ModeloTurno();
    
	$arrDatos=$objTurno->getListadoExamenes($idEtapa);
    $objExamen = new ModeloExamen();
    
	if (count($arrDatos)>0){
  	foreach ($arrDatos as $dato){
  	   $objTurno = $dato['turno'];
  	   $objPersona = new ModeloPersona();
         $objPersona = $dato['persona'];
         $objTipoLicencia = new ModeloTipolicencia();
         $objTipoLicencia = $dato['tipoLicencia'];
         $objUbicacion = new ModeloUbicacion();
         $objUbicacion = $dato['ubicacion'];
         
         
         $opciones='<a href="javascript:mostrarExamen(' .$objTurno->getIdTurno().');"class="btn btn-default" name="btnExamen"><i class="fa fa-file-text-o" title="Aplicar examen"></i></a>';
        
          
  		$listado .= '<tr>
  						<td>'.$objPersona->getIdPersona().'</td>
  						<td>'.utf8_encode($objPersona->getNombres()).'</td>
  						<td>'.utf8_encode($objPersona->getPrimerAp().' '.$objPersona->getSegundoAp()).'</td>
                          <td>'.$objUbicacion->getNombre().'</td>
                          <td>'.$objTipoLicencia->getDescripcion().'</td>
                          <td>'.$objTipoLicencia->getTipoTramite().'</td>
                          <td>'.$objTipoLicencia->getPeriodo().'</td>
  						<td>'.$opciones.'</td>
  					</tr>';
  		
  	}
	}else {
		$listado .= '<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
		              <td>&nbsp;</td>
				</tr>';
	
	}
    //} 
    /*else {
    header("Location: examen.php");
    die();
}*/
