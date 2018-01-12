<?php

	require FOLDER_MODEL_BASE . "model.base.pregunta.inc.php";
    require_once FOLDER_MODEL_EXTEND . "model.respuesta.inc.php";
    

	class ModeloPregunta extends ModeloBasePregunta
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBasePregunta";

		var $__ss=array();
        var $respuestas;
        var $objRespuesta;
        var $idRespuesta;
        var $respuestaCorrecta = 0;

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
        //obtiene las respuestas relacionadas a la pregunta
        public function setRespuestasByPregunta()
        {
             global $dbLink;

            $sql = "SELECT idRespuesta FROM respuesta
    					WHERE idPregunta=" . $this->getIdPregunta();
            $res = mysqli_query($dbLink, $sql);
            $arrRespuestas = array();
            if ($res && mysqli_num_rows($res) > 0) {
    
                while ($row_inf = mysqli_fetch_assoc($res)) {
                    
                    $this->objRespuesta = new ModeloRespuesta();
                    $this->objRespuesta->setIdRespuesta($row_inf['idRespuesta']);
                    $arrRespuestas[] = $this->objRespuesta;
                }
                
            }
            $this->respuestas=$arrRespuestas;
        }
        //idRespuesta seleccionada por el usuario
        public function setIdRespuesta($idRespuesta)
        {
            $this->idRespuesta = $idRespuesta;
            
        }
        
        public function setRespuestaCorrecta($esCorrecta)
        {
            $this->respuestaCorrecta = $esCorrecta;
            
        }

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
        
        public function getRespuestas()
        {
            return $this->respuestas;    
            
        }
        //idRespuesta seleccionada por el usuario
        public function getIdRespuesta()
        {
            return $this->idRespuesta;
            
        }
        
        public function getRespuestaCorrecta()
        {
            return $this->respuestaCorrecta;
        }

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

        
        
        
		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function validarDatos()
		{
			return true;
		}


	}

