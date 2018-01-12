<?php

	require FOLDER_MODEL_BASE . "model.base.contacto_emergencia.inc.php";

	class ModeloContacto_emergencia extends ModeloBaseContacto_emergencia
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseContacto_emergencia";

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
        public function verificaExisteContactoByIdPersona()
		{
			try
			{
				$SQL="SELECT COUNT(*) AS contador FROM contacto_emergencia WHERE idPersona=".$this->getIdpersona();
					
                    //	echo'ASDASDASDASDASD'. $SQL;
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePersona_biometrico::verificaExisteContactoByIdPersona][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
			

				if(mysqli_num_rows($result)==0)
				{
					//$this->limpiarPropiedades();
                    return 0;
				}
				else
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
					   $contador =$row_inf['contador']; 
			        }
                    return $contador;
				}
				
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
                public function getDatosByIdPersona()
		{
			try
			{
				$SQL="SELECT
						idContacto,idPersona,nombre,parentesco,cveEnt,cveMun,cveLoc,calle,numeroExterrior,colonia,codigoPostal,telefeno
					FROM contacto_emergencia
					WHERE idPersona=" . mysqli_real_escape_string($this->dbLink,$this->getIdPersona());
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseContacto_emergencia::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			$query = "SELECT idContacto FROM contacto_emergencia where idPersona= '" . mysqli_real_escape_string($this->dbLink,$id)."' ";
			$result = mysqli_query($this->dbLink,$query);
			if (! $result)
				return $this->setSystemError(
						"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
						"[" . $this->_nombreClase . "::LN67][" . $query . "][" . mysql_error() .
						"]");
				if ($row = mysqli_fetch_assoc($result))
					$idEvaluacion = $row['idContacto'];
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

