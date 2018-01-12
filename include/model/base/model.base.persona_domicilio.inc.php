<?php

	class ModeloBasePersona_domicilio extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBasePersona_domicilio";

		
		var $idPersonaDomicilio=0;
		var $idPersona=0;
		var $idDomicilio=0;
		var $estatus='vigente';
		var $fechaAsignacion='0000-00-00 00:00:00';

		var $__s=array("idPersonaDomicilio","idPersona","idDomicilio","estatus","fechaAsignacion");
		var $__ss=array();

		#------------------------------------------------------------------------------------------------------#
		#--------------------------------------------Inicializacion--------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		function __construct()
		{
			global $dbLink;
			if(is_null($dbLink))
			{
				trigger_error("La coneccion a la base de datos no esta establecida.",E_ERROR);
				return;
			}
			$this->dbLink=$dbLink;
			$this->link=$dbLink;
		}

		function __destruct()
		{
			
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Setter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function setIdPersonaDomicilio($idPersonaDomicilio)
		{
			if($idPersonaDomicilio==0||$idPersonaDomicilio==""||!is_numeric($idPersonaDomicilio)|| (is_string($idPersonaDomicilio)&&!ctype_digit($idPersonaDomicilio)))return $this->setError("Tipo de dato incorrecto para idPersonaDomicilio.");
			$this->idPersonaDomicilio=$idPersonaDomicilio;
			$this->getDatos();
		}
		public function setIdPersona($idPersona)
		{
			
			$this->idPersona=$idPersona;
		}
		public function setIdDomicilio($idDomicilio)
		{
			
			$this->idDomicilio=$idDomicilio;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusVigente()
		{
			$this->estatus='vigente';
		}
		public function setEstatusNovigente()
		{
			$this->estatus='novigente';
		}
		public function setFechaAsignacion($fechaAsignacion)
		{
			$this->fechaAsignacion=$fechaAsignacion;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdPersonaDomicilio()
		{
			return $this->idPersonaDomicilio;
		}
		public function getIdPersona()
		{
			return $this->idPersona;
		}
		public function getIdDomicilio()
		{
			return $this->idDomicilio;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getFechaAsignacion()
		{
			return $this->fechaAsignacion;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idPersonaDomicilio=0;
			$this->idPersona=0;
			$this->idDomicilio=0;
			$this->estatus='vigente';
			$this->fechaAsignacion='0000-00-00 00:00:00';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO persona_domicilio(idPersona,idDomicilio,estatus,fechaAsignacion)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idPersona) . "','" . mysqli_real_escape_string($this->dbLink,$this->idDomicilio) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaAsignacion) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePersona_domicilio::Insertar]");
				
				$this->idPersonaDomicilio=mysqli_insert_id($this->dbLink);
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		protected function Actualizar()
		{
			try
			{
				$SQL="UPDATE persona_domicilio SET idPersona='" . mysqli_real_escape_string($this->dbLink,$this->idPersona) . "',idDomicilio='" . mysqli_real_escape_string($this->dbLink,$this->idDomicilio) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',fechaAsignacion='" . mysqli_real_escape_string($this->dbLink,$this->fechaAsignacion) . "'
					WHERE idPersonaDomicilio=" . $this->idPersonaDomicilio;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePersona_domicilio::Update]");
				
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function Borrar()
		{
			if($this->getError())
				return false;
			try
			{
				$SQL="DELETE FROM persona_domicilio
				WHERE idPersonaDomicilio=" . mysqli_real_escape_string($this->dbLink,$this->idPersonaDomicilio);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePersona_domicilio::Borrar]");
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function getDatos()
		{
			try
			{
				$SQL="SELECT
						idPersonaDomicilio,idPersona,idDomicilio,estatus,fechaAsignacion
					FROM persona_domicilio
					WHERE idPersonaDomicilio=" . mysqli_real_escape_string($this->dbLink,$this->idPersonaDomicilio);
					
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
		

		
		public function Guardar()
		{
			if(!$this->validarDatos())
				return false;
			if($this->getError())
				return false;
			if($this->idPersonaDomicilio==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>