<?php

	class ModeloBaseEvaluaciondetalle extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseEvaluaciondetalle";

		
		var $idEvaluacionDetalle=0;
		var $idPregunta=0;
		var $idRespuesta=0;
		var $fechaHora='';
		var $idEvaluacion=0;

		var $__s=array("idEvaluacionDetalle","idPregunta","idRespuesta","fechaHora","idEvaluacion");
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

		
		public function setIdEvaluacionDetalle($idEvaluacionDetalle)
		{
			if($idEvaluacionDetalle==0||$idEvaluacionDetalle==""||!is_numeric($idEvaluacionDetalle)|| (is_string($idEvaluacionDetalle)&&!ctype_digit($idEvaluacionDetalle)))return $this->setError("Tipo de dato incorrecto para idEvaluacionDetalle.");
			$this->idEvaluacionDetalle=$idEvaluacionDetalle;
		//	$this->getDatos();
		}
		public function setIdPregunta($idPregunta)
		{
			
			$this->idPregunta=$idPregunta;
		}
		public function setIdRespuesta($idRespuesta)
		{
			
			$this->idRespuesta=$idRespuesta;
		}
		public function setFechaHora($fechaHora)
		{
			$this->fechaHora=$fechaHora;
		}
		public function setIdEvaluacion($idEvaluacion)
		{
			
			$this->idEvaluacion=$idEvaluacion;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdEvaluacionDetalle()
		{
			return $this->idEvaluacionDetalle;
		}
		public function getIdPregunta()
		{
			return $this->idPregunta;
		}
		public function getIdRespuesta()
		{
			return $this->idRespuesta;
		}
		public function getFechaHora()
		{
			return $this->fechaHora;
		}
		public function getIdEvaluacion()
		{
			return $this->idEvaluacion;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idEvaluacionDetalle=0;
			$this->idPregunta=0;
			$this->idRespuesta=0;
			$this->fechaHora='';
			$this->idEvaluacion=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO evaluaciondetalle(idPregunta,idRespuesta,fechaHora,idEvaluacion)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idPregunta) . "','" . mysqli_real_escape_string($this->dbLink,$this->idRespuesta) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaHora) . "','" . mysqli_real_escape_string($this->dbLink,$this->idEvaluacion) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseEvaluaciondetalle::Insertar]");
				
				$this->idEvaluacionDetalle=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE evaluaciondetalle SET idPregunta='" . mysqli_real_escape_string($this->dbLink,$this->idPregunta) . "',idRespuesta='" . mysqli_real_escape_string($this->dbLink,$this->idRespuesta) . "',fechaHora='" . mysqli_real_escape_string($this->dbLink,$this->fechaHora) . "',idEvaluacion='" . mysqli_real_escape_string($this->dbLink,$this->idEvaluacion) . "'
					WHERE idEvaluacionDetalle=" . $this->idEvaluacionDetalle;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseEvaluaciondetalle::Update]");
				
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
				$SQL="DELETE FROM evaluaciondetalle
				WHERE idEvaluacionDetalle=" . mysqli_real_escape_string($this->dbLink,$this->idEvaluacionDetalle);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseEvaluaciondetalle::Borrar]");
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
						idEvaluacionDetalle,idPregunta,idRespuesta,fechaHora,idEvaluacion
					FROM evaluaciondetalle
					WHERE idEvaluacionDetalle=" . mysqli_real_escape_string($this->dbLink,$this->idEvaluacionDetalle);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseEvaluaciondetalle::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idEvaluacionDetalle==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>