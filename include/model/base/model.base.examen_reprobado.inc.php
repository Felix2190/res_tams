<?php

	class ModeloBaseExamen_reprobado extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseExamen_reprobado";

		
		var $idExamenReprobado=0;
		var $idTurno=0;
		var $idEvaluacion=0;
		var $idPersona=0;
		var $idExamen=0;

		var $__s=array("idExamenReprobado","idTurno","idEvaluacion","idPersona","idExamen");
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

		
		public function setIdExamenReprobado($idExamenReprobado)
		{
			if($idExamenReprobado==0||$idExamenReprobado==""||!is_numeric($idExamenReprobado)|| (is_string($idExamenReprobado)&&!ctype_digit($idExamenReprobado)))return $this->setError("Tipo de dato incorrecto para idExamenReprobado.");
			$this->idExamenReprobado=$idExamenReprobado;
			$this->getDatos();
		}
		public function setIdTurno($idTurno)
		{
			
			$this->idTurno=$idTurno;
		}
		public function setIdEvaluacion($idEvaluacion)
		{
			
			$this->idEvaluacion=$idEvaluacion;
		}
		public function setIdPersona($idPersona)
		{
			
			$this->idPersona=$idPersona;
		}
		public function setIdExamen($idExamen)
		{
			
			$this->idExamen=$idExamen;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdExamenReprobado()
		{
			return $this->idExamenReprobado;
		}
		public function getIdTurno()
		{
			return $this->idTurno;
		}
		public function getIdEvaluacion()
		{
			return $this->idEvaluacion;
		}
		public function getIdPersona()
		{
			return $this->idPersona;
		}
		public function getIdExamen()
		{
			return $this->idExamen;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idExamenReprobado=0;
			$this->idTurno=0;
			$this->idEvaluacion=0;
			$this->idPersona=0;
			$this->idExamen=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO examen_reprobado(idTurno,idEvaluacion,idPersona,idExamen)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idTurno) . "','" . mysqli_real_escape_string($this->dbLink,$this->idEvaluacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idPersona) . "','" . mysqli_real_escape_string($this->dbLink,$this->idExamen) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseExamen_reprobado::Insertar]");
				
				$this->idExamenReprobado=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE examen_reprobado SET idTurno='" . mysqli_real_escape_string($this->dbLink,$this->idTurno) . "',idEvaluacion='" . mysqli_real_escape_string($this->dbLink,$this->idEvaluacion) . "',idPersona='" . mysqli_real_escape_string($this->dbLink,$this->idPersona) . "',idExamen='" . mysqli_real_escape_string($this->dbLink,$this->idExamen) . "'
					WHERE idExamenReprobado=" . $this->idExamenReprobado;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseExamen_reprobado::Update]");
				
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
				$SQL="DELETE FROM examen_reprobado
				WHERE idExamenReprobado=" . mysqli_real_escape_string($this->dbLink,$this->idExamenReprobado);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseExamen_reprobado::Borrar]");
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
						idExamenReprobado,idTurno,idEvaluacion,idPersona,idExamen
					FROM examen_reprobado
					WHERE idExamenReprobado=" . mysqli_real_escape_string($this->dbLink,$this->idExamenReprobado);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseExamen_reprobado::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idExamenReprobado==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>