<?php

	require FOLDER_MODEL_BASE . "model.base.persona_domicilio.inc.php";

	class ModeloPersona_domicilio extends ModeloBasePersona_domicilio
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBasePersona_domicilio";

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
        public function verificaExisteDomicilioByIdPersona()
		{
			try
			{
				$SQL="SELECT COUNT(*) AS contador FROM persona_domicilio WHERE idPersona=".$this->getIdpersona(). " AND estatus='vigente'";
					
                    //	echo'ASDASDASDASDASD'. $SQL;
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePersona_biometrico::verificaExisteDomicilioByIdPersona][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
			

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
						idPersonaDomicilio,idPersona,idDomicilio,estatus,fechaAsignacion
					FROM persona_domicilio
					WHERE estatus = 'vigente' AND idPersona=" . mysqli_real_escape_string($this->dbLink,$this->getIdPersona());
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePersona_domicilio::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
		public function findDomicilioByIdPersona($id)
		{
			try
			{
				$SQL="SELECT idDomicilio FROM persona_domicilio WHERE idPersona='" . mysqli_real_escape_string($this->dbLink,$id)."' AND estatus='vigente'";
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePersona_biometrico::verificaExisteDomicilioByIdPersona][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
		
		
					if(mysqli_num_rows($result)==0)
					{
						//$this->limpiarPropiedades();
						return 0;
					}
					else
					{
						while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
							$contador =$row_inf['idDomicilio'];
						}
						return $contador;
					}
		
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function validarDatos()
		{
			return true;
		}


	}

