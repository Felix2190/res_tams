<?php

	require FOLDER_MODEL_BASE . "model.base.persona.inc.php";

	class ModeloPersona extends ModeloBasePersona
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBasePersona";

		var $__ss=array();

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



		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

        public function getNombreCompleto()
        {
            return $this->getNombres() . ' ' .$this->getPrimerAp(). ' ' . $this->getSegundoAp();
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
		
		public function validaCurp($curp){
			$sql='select idPersona, concat_ws(" ", nombres, primerAp, segundoAp) as nombre, fechaNacimiento, genero, email, CURP from persona where CURP="'.$curp.'"';
			$result=mysqli_query($this->dbLink, $sql);
			$arrInfo=array();
			if ($result&&mysqli_num_rows($result)){
				$arrInfo=mysqli_fetch_assoc($result);
			}
			return $arrInfo;
		}


	}

