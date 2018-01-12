<?php
require_once FOLDER_MODEL_EXTEND . "model.examen.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.examenpregunta.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.evaluacion.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.licencia.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.persona.inc.php";



#-------------------------------------------------------Includes-------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#-------------------------------------------------------Funciones------------------------------------------------------#

function setPreguntaYRespuestas($Examen,$evaluacion)
{
    $objExamen = new ModeloExamen();
    $objExamen =$Examen;
    $objEvaluacion = new ModeloEvaluacion();
    $objEvaluacion = $evaluacion;
    
    $objPregunta = new ModeloPregunta();
    $objEvaDetalle = new ModeloEvaluaciondetalle();
    
    $contador = 1;
    
    foreach($objExamen->getPreguntas() as $exaPregunta)
    {
        $objPregunta = $exaPregunta->getPregunta();
        $objEvaDetalle->setIdEvaluacion($objEvaluacion->getIdEvaluacion());
        $objEvaDetalle->setIdPregunta($objPregunta->getIdPregunta());
        $arrRetorno = $objEvaDetalle->getIdEvaluacionDetalleAnterior();
        $objPregunta->setIdRespuesta($arrRetorno['idRespuesta']);
        //echo "Respuesta " . $objPregunta->getIdRespuesta();
        $cuestionario.='<strong>'.$contador .'.- '.(utf8_encode($objPregunta->getPregunta())).'</strong></br>';
        foreach($objPregunta->getRespuestas() as $objRespuesta)    
        {
            if($objPregunta->getIdRespuesta()==$objRespuesta->getIdRespuesta())
            {
                $cuestionario.= utf8_encode($objRespuesta->getRespuesta()).'</br></br>';
               // $checked='checked';
            }
            //$respuestas.='<input type="radio" name="respuestas" value="'.$objRespuesta->getIdRespuesta().'" '.$checked.'> '.utf8_encode($objRespuesta->getRespuesta()).'<br>';
        }
        $contador++;
    }
    
    if($objExamen->getTipo()!='teorico')
    {
        $cuestionario.='<strong>Observaciones:</strong></br>'.$objEvaluacion->getObservaciones().'</br>';
    }
    
        
    return $cuestionario;
    
}



#----------------------------------------------------------------------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
$xajax = new xajax();


function imprimir($idEvaluacion)
{
    global $objSession;
    $r = new xajaxResponse();
    
   // imprimirCuestionario($cuestionario);
    
    //$r->mostrarAviso("El tiempo ha terminado.");
    //$_SESSION['cuestionario'] = $cuestionario;
    $r->redirect("imprimeEvaluacion.php?idEva=".$idEvaluacion,2); 
    $r->mostrarAviso("Generando reporte...");  
   // unset($_SESSION['idEvaluacion']);  
    return $r;
}

$xajax->registerFunction("imprimir");


$xajax->processRequest();
#----------------------------------------------------------------------------------------------------------------------#
#---------------------------------------------Procesamiento de formulario----------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#---------------------------------------------Inicializacion de variables----------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#


if ((isset($_SESSION['idEvaluacion'])) and (is_numeric($_SESSION['idEvaluacion']))) {

    $objEvaluacion = new ModeloEvaluacion();
    $objEvaluacion->setIdEvaluacion($_SESSION['idEvaluacion']);
    
    
    $objExamen = new ModeloExamen ();
    $objExamen->setIdExamen($objEvaluacion->getIdExamen());
     $objExamen->setPreguntasByIdExamen();
    
    
    $objLicencia =  new ModeloLicencia();
    $objLicencia->setIdLicencias($objEvaluacion->getIdLicencia());
    $objLicencia->setTipoLicencia();
    
    $objPersona =  new ModeloPersona();
    $objPersona->setIdPersona($objLicencia->getIdPersona());
    
    $index = 0;    
    $cuestionario = setPreguntaYRespuestas($objExamen,$objEvaluacion);
    if(isset($_SESSION['paginaRetorno']))
    {
        $pagina = $_SESSION['paginaRetorno'];
        unset($_SESSION['paginaRetorno']);
    }
    else
    {
        $pagina = "evaluacionesLista.php";
    }
    $btnSalir='<a href="'.$pagina.'" class="btn-square-icontext">
											<i class="fa fa-times"></i>
											<p>Salir</p>
										</a>';
    //$contador = '<strong>Pregunta '.($index+1). ' de ' .count($objExamen->getPreguntas()).'</strong>';
    //$pregunta= $arrPreguntaRespuesta['pregunta'];
    //$respuestas=$arrPreguntaRespuesta['respuestas'];
    
    
   

} else {

    header("Location: evaluacionLista.php");
    die();
}


#----------------------------------------------------------------------------------------------------------------------#
#-------------------------------------------------Salida de Javascript-------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
