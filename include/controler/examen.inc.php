<?php
require_once FOLDER_MODEL_EXTEND . "model.examen.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.evaluacion.inc.php";
require 'adminLicencias.php';
#-------------------------------------------------------Includes-------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#-------------------------------------------------------Funciones------------------------------------------------------#
function getEvaluaciones($idLicencia,$tipo)
{
    $objEvaluacion = new ModeloEvaluacion();
    return $objEvaluacion->getEvaluacionByIdLicenciaAndTipo($idLicencia,$tipo);
    
}
function getEvaliacionNoAprobada($idLicencia,$idExamen)
{
    $objEvaluacion = new ModeloEvaluacion();
    return $objEvaluacion->getEvaluacionTeorico($idLicencia,$idExamen);
}

#----------------------------------------------------------------------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
$xajax = new xajax();
function mostrarExamen($idLicencia,$idExamen,$tipo)
{
    global $objSession;
    $r = new xajaxResponse();
   	$_SESSION['idLicencia']=$idLicencia;
    $_SESSION['idExamen']=$idExamen;
    
    
    if($tipo=='teorico')
    {
        //validar que el medico este completo
        if(getEvaluaciones($idLicencia,'medico')>0)
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
            $r->mostrarAviso(utf8_encode("No se ha capturado el exámen médico."));
        }
    }
    else if($tipo=='practico')   
    {
        if(getEvaluaciones($idLicencia,'teorico')>0)
        {
            $r->redirect('examenAplica.php',2);
        }
        else
        {
            $r->mostrarAviso(utf8_encode("No se ha capturado el exámen teórico o no fue aprobado."));
        }
    }
    else
    {
        $r->redirect('examenAplica.php',2);    
    }
    
    
	
    return $r;
}
$xajax->registerFunction("mostrarExamen");
$xajax->processRequest();
#----------------------------------------------------------------------------------------------------------------------#
#---------------------------------------------Procesamiento de formulario----------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#---------------------------------------------Inicializacion de variables----------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#


if ((isset($_SESSION['idLicencia'])) and (is_numeric($_SESSION['idLicencia']))) {

    $arrInfoLicencia = obtenerLicenciaByIdLicencia($_SESSION['idLicencia']);

    if (count($arrInfoLicencia) > 0) {

        $idLicencia = $arrInfoLicencia['idLicencia'];
        $numero = $arrInfoLicencia['numero'];
        $nombreCompleto = strtoupper($arrInfoLicencia['nombres'] . '</br>' . $arrInfoLicencia['primerAp'] .
            ' ' . $arrInfoLicencia['segundoAp']);
        $tipoLicencia = $arrInfoLicencia['tipoLicencia'];
        $idTipoLicencia = $arrInfoLicencia['idTipoLicencia'];
        
        $objExamen = new ModeloExamen();
        $arrExamenes = $objExamen->getExamenesByIdTipoLicencia($arrInfoLicencia['idTipoLicencia']);
        
        //$arrEvaluaciones = $objExamen->getEvaluacionesByIdLicencia($idLicencia);
        if (count($arrExamenes) > 0) {
            foreach ($arrExamenes as $examen) {
                $tipo ="'".$examen['tipo']."'";
               
                $examenes .= '<a href="javascript: mostrarExamen('.$idLicencia.',' .$examen['idExamen'] .',' .$tipo .
                    ');"	class="btn-square-icontext opciones enterado" > <i	class="fa fa-file-text-o"></i>											<p>' .
                    $examen['descripcion'] . '</p></a>';
            }
        } else {
            $examenes .= 'No hay examenes para mostrar';
        }
    }

} else {
    header("Location: listadoLicencias.php?estatus=enTramite");
    die();
}


#----------------------------------------------------------------------------------------------------------------------#
#-------------------------------------------------Salida de Javascript-------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
