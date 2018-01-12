<?php
require_once FOLDER_MODEL_EXTEND . "model.examen.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.examenpregunta.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.evaluacion.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.evaluaciondetalle.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.turno.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.etapa.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.examen_reprobado.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.configuracion.inc.php";



#-------------------------------------------------------Includes-------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#-------------------------------------------------------Funciones------------------------------------------------------#

//Guarda la evaluacion en la BD
function guardarEvaluacion($observaciones, $calificacion,$estatus,$idTurno)
{
    global $objSession;
    $objExamen = new ModeloExamen();
    $objExamen=unserialize($_SESSION['objExamen']);
    $objEvaluacion =  new ModeloEvaluacion();
    if (isset($_SESSION['objEvaluacion']))
    {
        $objEvaluacion = unserialize($_SESSION['objEvaluacion']);
         
    }
    else
    {
        $objEvaluacion->setIdturno($idTurno);
        $objEvaluacion->setIdUsuario($objSession->getIdLogin());
        $objEvaluacion->setIdExamen($objExamen->getIdExamen());
    }
    $objEvaluacion->setEstatus($estatus);    
    $objEvaluacion->setObservaciones($observaciones);
    $objEvaluacion->setCalificacion($calificacion);
    $objEvaluacion->setFechaHora(date('Y-m-d H:i:s'));
    
    if($objEvaluacion->Guardar())
    {
        if($estatus=='aprobado'||$estatus=='completo')
        {
            actualizarEstatusTurno();
        }
    }
    else if($objEvaluacion->getError())
    {
        echo $objEvaluacion->getStrError();
        $objEvaluacion->clearError();
    }
        
    $_SESSION['objEvaluacion'] = serialize($objEvaluacion);
   
}

//Guarda la respuesta del contribuyente en la BD
function guardarRespuesta($idRespuesta,$idPregunta)
{
    $objEvaluacion = new ModeloEvaluacion();
    $objEvaluacion=unserialize($_SESSION['objEvaluacion']);
    $objEvaDetalle =  new ModeloEvaluaciondetalle();
    $objEvaDetalle->setIdPregunta($idPregunta);
    $objEvaDetalle->setIdRespuesta($idRespuesta);
    $objEvaDetalle->setFechaHora(date('Y-m-d H:i:s'));
    $objEvaDetalle->setIdEvaluacion($objEvaluacion->getIdEvaluacion());
    $objEvaDetalle->guardarDetalleEvaluacion();
    if($objEvaDetalle->getError()>0)
    {
        echo $objEvaDetalle->getStrError();
    }
}
//Retorna true si todas las preguntas del examen han sido contestadas; false en caso contrario
function validarPreguntasContestadas()
{
    global $objSession;
    $objExamen = new ModeloExamen();
    $objExamen=unserialize($_SESSION['objExamen']);
    $contador =0;
    foreach($objExamen->getPreguntas() as $examenPregunta)
    {
        $objPregunta = new ModeloPregunta();
        $objPregunta = $examenPregunta->getPregunta();
        
        if($objPregunta->getIdRespuesta()!=0)
        {
            $contador++;
        }
    }
    return ($contador==count($objExamen->getPreguntas()));
    
}
//carga las preguntas y respuestas del examen, asi como las respuesta que ya ha seleccionado la persona previamente
function setPreguntaYRespuestas($Examen,$indice)
{
    $objExamen =$Examen;
    $objPregunta = new ModeloPregunta();
    $objPregunta =$objExamen->getPreguntaByIndex($indice)->getPregunta();
    $pregunta =utf8_encode($objPregunta->getPregunta());
    foreach($objPregunta->getRespuestas() as $objRespuesta)    
    {
        $checked = '';
        if($objPregunta->getIdRespuesta()==$objRespuesta->getIdRespuesta())
        {
            $checked='checked';
        }
        $respuestas.='<input type="radio" name="respuestas" value="'.$objRespuesta->getIdRespuesta().'" '.$checked.'> '.utf8_encode($objRespuesta->getRespuesta()).'<br>';
    }    
    return array(
    'pregunta' =>$pregunta,
    'respuestas'=>$respuestas
    );
    
}

//muestras las observaciones para el examen medico
function mostrarObservaciones()
{
    $objEvaluacion = new ModeloEvaluacion();
    $objEvaluacion=unserialize($_SESSION['objEvaluacion']);
    return array(
        'divPregunta'=>"Observaciones",
        'divRespuestas'=>'<center><textarea cols="100" rows="30" wrap="virtual" maxlength="1000" id="txtObservaciones"  >'.$objEvaluacion->getObservaciones().'</textarea></center>',
        //'divBotones'=>'<input type="button" id="btnGuardarObservaciones" title="Guardar" value="Guardar"  class="btn-square-icontext opciones enterado" onclick="javascript: guardar();"/> ',
        'divBotones'=>'<a enable="true" id="btnGuardar" href="javascript: guardar();"
											class="btn-square-icontext opciones enterado"> <i
											class="fa fa-floppy-o"></i>
											<p>Guardar</p>
										</a>'
        
        
    );
}

//Muestra los datos extras para el examen practico
function mostrarDatosExamenPractico()
{
   $objEvaluacion = new ModeloEvaluacion();
    $objEvaluacion=unserialize($_SESSION['objEvaluacion']);
    if($objEvaluacion->getEstatus()=='aprobado')
    {}
    $datos = '
    <textarea cols="50" rows="30" wrap="virtual" maxlength="1000" id="txtObservaciones"  >'.$objEvaluacion->getObservaciones().'</textarea></br>
    <input type="radio" name="aprobado" value="1" '.(($objEvaluacion->getEstatus()=='aprobado')?'checked':'').' >Aprobado</br>
    <input type="radio" name="aprobado" value="0" '.(($objEvaluacion->getEstatus()=='no aprobado')?'checked':'').'>No Aprobado
    ';
    return array(
        'divPregunta'=>"Señale el resultado del examen práctico.",
        'divRespuestas'=>$datos,
        'divBotones'=>'<a enable="true" id="btnGuardar" href="javascript: guardar();"
											class="btn-square-icontext opciones enterado"> <i
											class="fa fa-floppy-o"></i>
											<p>Guardar</p>
										</a>'
        
    ); 
}
//elimina los valores de sesion
function unsetSesion()
{
    unset($_SESSION['objEvaluacion']);
    unset($_SESSION['objExamen']);
    
}
//Actualiza el turno a la siguiente etapa
function actualizarEstatusTurno()
{
        global $objSession;
        $objTurno = unserialize($_SESSION['objTurno']);
        $objEtapa = new ModeloEtapa();
        $objEtapa->setIdEtapa($objTurno->getIdEtapa());
        $idEtapaSiguiente =$objEtapa->getSiguienteEtapa($objEtapa->getOrden()+1);
        $objTurno->setIdEtapa($idEtapaSiguiente);
        $objTurno->setFechaHora(date('Y-m-d H:i:s'));
        $objTurno->setIdUsuario($objSession->getIdLogin());
        $objTurno->actualizarEtapa();
        
        
}

function insertarExamenTeoricoReprobado()
{
    $objEvaluacion = new ModeloEvaluacion();
    $objEvaluacion = unserialize($_SESSION['objEvaluacion']);
    $objTurno = new ModeloTurno();
    $objTurno = unserialize($_SESSION['objTurno']);
    
    $objExamenReprobado =  new ModeloExamen_reprobado();
    $objExamenReprobado->setIdEvaluacion($objEvaluacion->getIdEvaluacion());
    $objExamenReprobado->setIdExamen($objEvaluacion->getIdExamen());
    $objExamenReprobado->setIdPersona($objTurno->getIdPersona());
    $objExamenReprobado->setIdTurno($objTurno->getIdTurno());
    if(!$objExamenReprobado->Guardar() & $objExamenReprobado->getError())
    {
        echo $objExamenReprobado->getStrError();
    }
    
    $objConfiguracion = new ModeloConfiguracion();
    $objConfiguracion->getDatosByClave('diasExamenTeorico');
    $objTurno->actualizarFecha($objConfiguracion->getValor());
    
}

#----------------------------------------------------------------------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
$xajax = new xajax();
//Muestra la siguiente pregunta del examen o las observaciones 
function mostrarPregunta($indice,$idRespuesta,$idPregunta)
{
    global $objSession;
    $r = new xajaxResponse();
    $objExamen = new ModeloExamen();
    $objExamen=unserialize($_SESSION['objExamen']);
    if (is_numeric($idRespuesta))//guardamos la respuesta del usuario
    {
        $objExamen->setRespuestaCorrecta($idRespuesta,$idPregunta);
       // $objExamen->setIdRespuestaByIdPregunta($idRespuesta,$idPregunta);
        $_SESSION['objExamen'] = serialize($objExamen);//Se guarda en sesion los cambios que se hacen al objExamen
        guardarRespuesta($idRespuesta,$idPregunta);
    } 
        
    $objExamen=unserialize($_SESSION['objExamen']);
    if (($indice>=0) && ($indice < count($objExamen->getPreguntas())))
    {
        $arrPreguntaRespuestas=setPreguntaYRespuestas($objExamen,$indice);
        $r->assign('divPregunta',"innerHTML",$arrPreguntaRespuestas['pregunta']);
        $r->assign('divRespuestas',"innerHTML",$arrPreguntaRespuestas['respuestas']);
        $r->assign('divContador',"innerHTML",'<strong>Pregunta '.($indice+1). ' de ' .count($objExamen->getPreguntas()).'</strong>');
        $r->assign('btnBack',"href","javascript: mostrarPregunta(".($indice-1).");");
        $r->assign('btnNext',"href","javascript: mostrarPregunta(".($indice+1).");");
        $r->assign('idPregunta',"value",$objExamen->getPreguntaByIndex($indice)->getPregunta()->getIdPregunta());
    }
    else
    {
        if(validarPreguntasContestadas())
            {
            if(($objExamen->getTipo()=='Medico')||($objExamen->getTipo()=='Practico'))
            {
                $arrDiv =(($objExamen->getTipo()=='Medico')? mostrarObservaciones():mostrarDatosExamenPractico());
                $r->assign('divPregunta',"innerHTML",utf8_encode($arrDiv['divPregunta']));
                $r->assign('divRespuestas',"innerHTML",$arrDiv['divRespuestas']);
                $r->assign('divContador',"innerHTML",'');
                $r->assign('divBotones',"innerHTML",$arrDiv['divBotones']);
                //$r->assign('btnBack',"href","javascript: mostrarPregunta(".($indice-1).");");
            }
            else//teorico
            {
                
                    $calificacion = $objExamen->getCalificacion();
                    $aprobado = false;
                    if($calificacion>=$objExamen->getCalificacionAprobatoria())
                    {
                        $aprobado=true;
                    }
                    
                    guardarEvaluacion($observaciones,$calificacion,($aprobado? 'aprobado':'no aprobado'),0 );
                    
                    if(!$aprobado)
                    {
                        insertarExamenTeoricoReprobado();
                    } 
                    
                    $r->mostrarAviso("Examen terminado. ".utf8_encode("Calificación: " .$calificacion). (($calificacion>=$objExamen->getCalificacionAprobatoria())? ' APROBADO.':' NO APROBADO.') );
                    $objTurno = new ModeloTurno();
                    $objTurno = unserialize($_SESSION['objTurno']);
                    $r->redirect("listadoExamen.php?idEtapa=".$objTurno->getIdEtapa(),2); 
                     
                
            }
        }
        else
        {
            $r->mostrarAviso("Algunas preguntas no han sido contestadas.");
            
        }  
    }  
    return $r;
}

$xajax->registerFunction("mostrarPregunta");

//Se usa para los examenes medicos y practicos despues de capturar las observaciones del examen
function actualizarEvaluacion($observaciones,$aprobado)
{
    global $objSession;
    $r = new xajaxResponse();
    $objExamen = new ModeloExamen();
    $objExamen=unserialize($_SESSION['objExamen']);
    if(is_numeric($aprobado))
    {
        if($aprobado==1)
            $aprobado='aprobado';
        else
            $aprobado='no aprobado';
    }
    
    guardarEvaluacion($observaciones,0,($objExamen->getTipo()=='Practico')?$aprobado:'completo',0);
    
    $objTurno = new  ModeloTurno();
    $objTurno = unserialize($_SESSION['objTurno']);
    $r->mostrarAviso("Examen terminado.");
    $r->redirect("listadoExamen.php?idEtapa=".$objTurno->getIdEtapa(),2); 
        
    return $r;
}

$xajax->registerFunction("actualizarEvaluacion");

//Cuando en el examen teorico se terminan los 15 minutos asignados
function actualizarEvaluacionTiempoTerminado()
{
    global $objSession;
    $r = new xajaxResponse();
    $objExamen = new ModeloExamen();
    $objExamen=unserialize($_SESSION['objExamen']);
    guardarEvaluacion("Tiempo terminado",0,'incompleto',0);
    insertarExamenTeoricoReprobado();
    
    $objTurno = new ModeloTurno();
    $objTurno = unserialize($_SESSION['objTurno']);
    
    $r->mostrarAviso("El tiempo ha terminado.");
    $r->redirect("listadoExamen.php?idEtapa=".$objTurno->getIdEtapa(),2); 
        
    return $r;
}

$xajax->registerFunction("actualizarEvaluacionTiempoTerminado");


$xajax->processRequest();
#----------------------------------------------------------------------------------------------------------------------#
#---------------------------------------------Procesamiento de formulario----------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
#---------------------------------------------Inicializacion de variables----------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#


if ((isset($_SESSION['idTurno'])) and (is_numeric($_SESSION['idTurno']))) {

    unsetSesion();
    $objTurno  = new ModeloTurno();
    $objTurno->setIdTurno($_SESSION['idTurno']);
    $_SESSION['objTurno'] = serialize($objTurno);
    
    $objExamen = new ModeloExamen();
    $objExamen->setIdExamen($_SESSION['idExamen']);
    $objExamen->setPreguntasByIdExamen();
    
    $_SESSION['objExamen'] = serialize($objExamen);
    
    $objEvaluacion = new ModeloEvaluacion();
    $objEvaluacion->setIdturno($objTurno->getIdTurno());
    $objEvaluacion->setIdExamen($objExamen->getIdExamen());
    $objEvaluacion->getEvaluacionByIdTurnoAndIdExamen();
    
    if($objExamen->getTipo()=='Teorico')
    {
        $objConfiguracion = new ModeloConfiguracion();
        $objConfiguracion->getDatosByClave('tiempoExamenTeorico');
       // echo '<input type="hidden" id="tiempoExamen" name="examen" value="'.$objConfiguracion->getValor().'">';
    }
    //unset($_SESSION['idTurno']);
    //unset($_SESSION['idExamen']);
    
    if($objEvaluacion->getIdEvaluacion()==0 ||$objEvaluacion->getEstatus()=='no aprobado')
    {
       // echo 'insert';
       $objEvaluacion = new ModeloEvaluacion();
        guardarEvaluacion("",0,"iniciado",$objTurno->getIdTurno());
    }
    
    else
    {
        $_SESSION['objEvaluacion'] = serialize($objEvaluacion);
    }
    
    /*
    if(($objEvaluacion->getEstatus()=='completo')||($objEvaluacion->getEstatus()=='aprobado'))
    {
        $_SESSION['idEvaluacion'] = $objEvaluacion->getIdEvaluacion();
        $_SESSION['paginaRetorno'] = 'examen.php';
        unsetSesion();
        header("Location: evaluacionVer.php");
    }*/
    $objExamen->setIdEvaluacion($objEvaluacion->getIdEvaluacion());
    $_SESSION['objExamen'] = serialize($objExamen);
    
    
    $index = 0;    
    $arrPreguntaRespuesta = setPreguntaYRespuestas($objExamen,$index);
    $contador = '<strong>Pregunta '.($index+1). ' de ' .count($objExamen->getPreguntas()).'</strong>';
    $pregunta= $arrPreguntaRespuesta['pregunta'];
    $respuestas=$arrPreguntaRespuesta['respuestas'];
    
    
   

} else {
    header("Location: biograficos.php");
    die();
}


#----------------------------------------------------------------------------------------------------------------------#
#-------------------------------------------------Salida de Javascript-------------------------------------------------#
#----------------------------------------------------------------------------------------------------------------------#
