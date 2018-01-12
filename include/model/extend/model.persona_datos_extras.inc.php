<?php

	require FOLDER_MODEL_BASE . "model.base.persona_datos_extras.inc.php";

	class ModeloPersona_datos_extras extends ModeloBasePersona_datos_extras
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBasePersona_datos_extras";

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



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
    public function getDatosByIdPersona()
		{
			try
			{
				$SQL="SELECT
						IdPersonaDatosExtras,idPersona,colorOjos,colorCabello,estatura,peso,impresionSangre,tipoSangre,certificadoMedico,senasParticulares,jubilacionNumAfiliacion,jubilacionFechaAfiliacion,jubilacionInstiitucion,usaLentes,donaOrganos,usaTransmisionAutomat1ica,equipadoConductorDiscapacitado,equipadoConductorProtesis
					FROM persona_datos_extras
					WHERE IdPersona=" . mysqli_real_escape_string($this->dbLink,$this->getIdPersona());
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePersona_datos_extras::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

				if(mysqli_num_rows($result)==0)
				{
					$this->limpiarPropiedades();
				}
				else
				{
					$datos=mysqli_fetch_assoc($result);
					foreach($datos as $k=>$v)
					{
						$campo="" . $k;
						$this->$campo=$v;
					}
				}
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		
		public function findIdByIdPersona($id)
		{
			$idEvaluacion = 0;
			$query = "SELECT IdPersonaDatosExtras FROM persona_datos_extras where idPersona= '" . mysqli_real_escape_string($this->dbLink,$id)."' ";
			$result = mysqli_query($this->dbLink,$query);
			if (! $result)
				return $this->setSystemError(
						"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
						"[" . $this->_nombreClase . "::LN67][" . $query . "][" . mysql_error() .
						"]");
				if ($row = mysqli_fetch_assoc($result))
					$idEvaluacion = $row['IdPersonaDatosExtras'];
					return $idEvaluacion;
		}
		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function validarDatos()
		{
			return true;
		}


	}

