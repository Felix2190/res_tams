<?php

	require FOLDER_MODEL_BASE . "model.base.examenpregunta.inc.php";
    require_once FOLDER_MODEL_EXTEND . "model.pregunta.inc.php";
	class ModeloExamenpregunta extends ModeloBaseExamenpregunta
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseExamenpregunta";

		var $__ss=array();
        var $pregunta; 
		#------------------------------------------------------------------------------------------------------#
		#--------------------------------------------Inicializacion--------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		function __construct()
		{
			parent::__construct();
            $this->pregunta= new ModeloPregunta();

		}
        
        

		function __destruct()
		{
			
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Setter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

        function getPreguntaByIdPregunta($idPregunta)
        {
            $this->pregunta->setIdPregunta($idPregunta);
            $this->pregunta->setRespuestasByPregunta();
            return $this->pregunta; 
        }
        
        function getPregunta()
        {
            return $this->pregunta;
            
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

