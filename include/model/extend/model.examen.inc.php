<?php
require FOLDER_MODEL_BASE . "model.base.examen.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.examenpregunta.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.pregunta.inc.php";
class ModeloExamen extends ModeloBaseExamen
{
    #------------------------------------------------------------------------------------------------------#
    #----------------------------------------------Propiedades---------------------------------------------#
    #------------------------------------------------------------------------------------------------------#
    var $_nombreClase = "ModeloBaseExamen";
    var $__ss = array();
    var $examenPregunta;
    var $preguntas;
    var $idEvaluacion;
    #------------------------------------------------------------------------------------------------------#
    #--------------------------------------------Inicializacion--------------------------------------------#
    #------------------------------------------------------------------------------------------------------#
    function __construct()
    {
        parent::__construct();
        
    }
    function __destruct()
    {

    }
    #------------------------------------------------------------------------------------------------------#
    #------------------------------------------------Setter------------------------------------------------#
    #------------------------------------------------------------------------------------------------------#
    /*
    Retorna un array con las preguntas del examen
    */
    function setPreguntasByIdExamen()
    {
        global $dbLink;

        $sql = "SELECT idPregunta, valor FROM examenpregunta
					WHERE idExamen=" . $this->getIdExamen();
        $res = mysqli_query($dbLink, $sql);
        $arrExamenPregunta = array();
        if ($res && mysqli_num_rows($res) > 0) {
            while ($row_inf = mysqli_fetch_assoc($res)) {
                $idPregunta = $row_inf['idPregunta'];
                $this->examenPregunta = new ModeloExamenpregunta();
                $this->examenPregunta->getPreguntaByIdPregunta($idPregunta);
                $this->examenPregunta->setValor($row_inf['valor']);
                $arrExamenPregunta[] = $this->examenPregunta;
            }
        }
        $this->preguntas= $arrExamenPregunta;
    }
    public function setRespuestaCorrecta($idRespuesta,$idPregunta)
    {
        foreach($this->preguntas as $pregunta)
        {
            $objPregunta = new ModeloPregunta();
            $objPregunta = $pregunta->getPregunta();
            if($objPregunta->getIdPregunta()==$idPregunta)
            {
                $objPregunta->setIdRespuesta($idRespuesta);
                $objRespuesta = new ModeloRespuesta();
                
                foreach ($objPregunta->getRespuestas() as $respuesta)
                {
                    $objRespuesta = $respuesta;
                    if(($objRespuesta->getIdRespuesta()==$idRespuesta) &&($objRespuesta->getEsCorrecta()==1))
                    {
                        $objPregunta->setRespuestaCorrecta(1);
                        return;
                    }
                    else
                    {
                        $objPregunta->setRespuestaCorrecta(0);
                
                    }
                }
                
                return;
               
            }
        }
    }
    //NO SE USA
    public function setIdRespuestaByIdPregunta($idRespuesta,$idPregunta)
    {
        foreach($this->preguntas as $pregunta)
        {
            $objPregunta = new ModeloPregunta();
            $objPregunta = $pregunta->getPregunta();
            if($objPregunta->getIdPregunta()==$idPregunta)
            {
                $objPregunta->setIdRespuesta($idRespuesta);
                $objRespuesta = new ModeloRespuesta();
                $retorno;
                foreach ($objPregunta->getRespuestas() as $respuesta)
                {
                    $objRespuesta = $respuesta;
                    if(($respuesta->getIdRespuesta()==$idRespuesta) &&($respuesta->getEsCorrecta()==1))
                    {
                        $objPregunta->setRespuestaCorrecta(1);
                        return;
                    }
                    else
                    {
                        $objPregunta->setRespuestaCorrecta(0);
                
                    }
                }
                
                return;
               
            }
        }
    }
    
    public function setIdEvaluacion($idEvaluacion)
    {
        $this->idEvaluacion = $idEvaluacion;
        if($this->idEvaluacion!=0)
        {
           $this->setRespuestaContribuyente();
        }
    }
    
    public function setRespuestaContribuyente()
    {
        global $dbLink;
        foreach($this->getPreguntas() as $pregunta)
        {
            $objPregunta = new ModeloPregunta();
            $objPregunta = $pregunta->getPregunta();
            $sql = "SELECT idRespuesta FROM evaluaciondetalle
					WHERE idEvaluacion=" . $this->getIdEvaluacion() . " AND idPregunta=".$objPregunta->getIdPregunta();
                   // echo $sql;
            $res = mysqli_query($dbLink, $sql);
            
            if ($res && mysqli_num_rows($res) > 0) {
                while ($row_inf = mysqli_fetch_assoc($res)) {
                    $objPregunta->setIdRespuesta($row_inf['idRespuesta']);
                }
            }
                        
        }

        
    }
    
    #------------------------------------------------------------------------------------------------------#
    #-----------------------------------------------Unsetter-----------------------------------------------#
    #------------------------------------------------------------------------------------------------------#
    #------------------------------------------------------------------------------------------------------#
    #------------------------------------------------Getter------------------------------------------------#
    public function getPreguntas()
    {
        return $this->preguntas;
    }
    
    public function getPreguntaByIndex($index)
    {
        //if($index<count($this->preguntas))
        return $this->preguntas[$index];
    }
    
    public function getCalificacion()
    {
       foreach($this->preguntas as $pregunta)
        {
            $objPregunta = new ModeloPregunta();
            $objPregunta = $pregunta->getPregunta();
            $aciertos+= $objPregunta->getRespuestaCorrecta();
        }
        return ($aciertos/count($this->preguntas)*100);    
    }
                
    public function getIdEvaluacion()
    {
        return $this->idEvaluacion;
    }
    
    
    #------------------------------------------------------------------------------------------------------#
    #------------------------------------------------------------------------------------------------------#
    #------------------------------------------------Querys------------------------------------------------#
    #------------------------------------------------------------------------------------------------------#
    
    
    function getExameByIdTipoLicenciaAndTipoExamen($idTipoLicencia,$tipo)
    {
        global $dbLink;
        

        $sql = "SELECT idExamen,idTipoLicencia,descripcion,calificacionAprobatoria,estatus,tipo
					FROM examen
					WHERE idTipoLicencia=" . $idTipoLicencia." AND tipo='".$tipo."'";
//echo $sql;
        $res = mysqli_query($dbLink, $sql);
        $arrExamenes = array();
        if ($res && mysqli_num_rows($res) > 0) {

            while ($row_inf = mysqli_fetch_assoc($res)) {
                $this->setIdExamen($row_inf['idExamen']);
                /*$examen = array(
                    'idExamen' => $row_inf['idExamen'],
                    'idTipoLicencia' => $row_inf['idTipoLicencia'],
                    'descripcion' => $row_inf['descripcion'],
                    'calificacionAprobatoria' => $row_inf['calificacionAprobatoria'],
                    'estatus' => $row_inf['estatus'],
                    'tipo' => $row_inf['tipo']);
                $arrExamenes[] = $examen;*/
            }

        }
        else
        {
            
            	$this->limpiarPropiedades();
        }
        
    }
    
    function getExamenesByIdTipoLicencia($idTipoLicencia)
    {
        global $dbLink;

        $sql = "SELECT idExamen,idTipoLicencia,descripcion,calificacionAprobatoria,estatus,tipo
					FROM examen
					WHERE idTipoLicencia=" . $idTipoLicencia;

        $res = mysqli_query($dbLink, $sql);
        $arrExamenes = array();
        if ($res && mysqli_num_rows($res) > 0) {

            while ($row_inf = mysqli_fetch_assoc($res)) {
                $examen = array(
                    'idExamen' => $row_inf['idExamen'],
                    'idTipoLicencia' => $row_inf['idTipoLicencia'],
                    'descripcion' => $row_inf['descripcion'],
                    'calificacionAprobatoria' => $row_inf['calificacionAprobatoria'],
                    'estatus' => $row_inf['estatus'],
                    'tipo' => $row_inf['tipo']);
                $arrExamenes[] = $examen;
            }

        }
        return $arrExamenes;
    }
    
    
    #------------------------------------------------------------------------------------------------------#
    #------------------------------------------------Otras-------------------------------------------------#
    #------------------------------------------------------------------------------------------------------#

    public function validarDatos()
    {
        return true;
    }
}
