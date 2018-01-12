<?php

	class ModeloBaseLog_turno extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseLog_turno";

		
		var $idLog=0;
		var $idTurno=0;
		var $idEtapa=0;
		var $fecha='';
		var $idUsuario=0;

		var $__s=array("idLog","idTurno","idEtapa","fecha","idUsuario");
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

		
		public function setIdLog($idLog)
		{
			if($idLog==0||$idLog==""||!is_numeric($idLog)|| (is_string($idLog)&&!ctype_digit($idLog)))return $this->setError("Tipo de dato incorrecto para idLog.");
			$this->idLog=$idLog;
			$this->getDatos();
		}
		public function setIdTurno($idTurno)
		{
			
			$this->idTurno=$idTurno;
		}
		public function setIdEtapa($idEtapa)
		{
			
			$this->idEtapa=$idEtapa;
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdLog()
		{
			return $this->idLog;
		}
		public function getIdTurno()
		{
			return $this->idTurno;
		}
		public function getIdEtapa()
		{
			return $this->idEtapa;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idLog=0;
			$this->idTurno=0;
			$this->idEtapa=0;
			$this->fecha='';
			$this->idUsuario=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO log_turno(idTurno,idEtapa,fecha,idUsuario)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idTurno) . "','" . mysqli_real_escape_string($this->dbLink,$this->idEtapa) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseLog_turno::Insertar]");
				
				$this->idLog=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE log_turno SET idTurno='" . mysqli_real_escape_string($this->dbLink,$this->idTurno) . "',idEtapa='" . mysqli_real_escape_string($this->dbLink,$this->idEtapa) . "',fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "'
					WHERE idLog=" . $this->idLog;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseLog_turno::Update]");
				
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
				$SQL="DELETE FROM log_turno
				WHERE idLog=" . mysqli_real_escape_string($this->dbLink,$this->idLog);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseLog_turno::Borrar]");
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
						idLog,idTurno,idEtapa,fecha,idUsuario
					FROM log_turno
					WHERE idLog=" . mysqli_real_escape_string($this->dbLink,$this->idLog);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseLog_turno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idLog==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>