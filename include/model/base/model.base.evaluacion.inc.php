<?php

	class ModeloBaseEvaluacion extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseEvaluacion";

		
		var $idEvaluacion=0;
		var $idturno='';
		var $idUsuario=0;
		var $fechaHora='';
		var $idExamen=0;
		var $observaciones='';
		var $calificacion=0;
		var $idLicencia=0;
		var $estatus='';

		var $__s=array("idEvaluacion","idturno","idUsuario","fechaHora","idExamen","observaciones","calificacion","idLicencia","estatus");
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

		
		public function setIdEvaluacion($idEvaluacion)
		{
			if($idEvaluacion==0||$idEvaluacion==""||!is_numeric($idEvaluacion)|| (is_string($idEvaluacion)&&!ctype_digit($idEvaluacion)))return $this->setError("Tipo de dato incorrecto para idEvaluacion.");
			$this->idEvaluacion=$idEvaluacion;
			$this->getDatos();
		}
		public function setIdturno($idturno)
		{
			$this->idturno=$idturno;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setFechaHora($fechaHora)
		{
			$this->fechaHora=$fechaHora;
		}
		public function setIdExamen($idExamen)
		{
			
			$this->idExamen=$idExamen;
		}
		public function setObservaciones($observaciones)
		{
			
			$this->observaciones=$observaciones;
		}
		public function setCalificacion($calificacion)
		{
			
			$this->calificacion=$calificacion;
		}
		public function setIdLicencia($idLicencia)
		{
			
			$this->idLicencia=$idLicencia;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusIncompleto()
		{
			$this->estatus='incompleto';
		}
		public function setEstatusCompleto()
		{
			$this->estatus='completo';
		}
		public function setEstatusAprobado()
		{
			$this->estatus='aprobado';
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdEvaluacion()
		{
			return $this->idEvaluacion;
		}
		public function getIdturno()
		{
			return $this->idturno;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getFechaHora()
		{
			return $this->fechaHora;
		}
		public function getIdExamen()
		{
			return $this->idExamen;
		}
		public function getObservaciones()
		{
			return $this->observaciones;
		}
		public function getCalificacion()
		{
			return $this->calificacion;
		}
		public function getIdLicencia()
		{
			return $this->idLicencia;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idEvaluacion=0;
			$this->idturno='';
			$this->idUsuario=0;
			$this->fechaHora='';
			$this->idExamen=0;
			$this->observaciones='';
			$this->calificacion=0;
			$this->idLicencia=0;
			$this->estatus='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO evaluacion(idturno,idUsuario,fechaHora,idExamen,observaciones,calificacion,idLicencia,estatus)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idturno) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaHora) . "','" . mysqli_real_escape_string($this->dbLink,$this->idExamen) . "','" . mysqli_real_escape_string($this->dbLink,$this->observaciones) . "','" . mysqli_real_escape_string($this->dbLink,$this->calificacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idLicencia) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "')";
                        
                       // echo $SQL;
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseEvaluacion::Insertar]");
				
				$this->idEvaluacion=mysqli_insert_id($this->dbLink);
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

        protected function Actualizar()
		{
		  global $dbLink;
			try
			{
			
			// echo 'actualizar '.$this->getEstatus();
				$SQL="UPDATE evaluacion SET idturno=" .$this->getIdturno() . ",idUsuario=" . $this->getIdUsuario() . ",fechaHora='" . $this->getFechaHora() . "',idExamen=" . $this->getIdExamen() . ",observaciones='" . $this->getObservaciones() . "',calificacion=" . $this->getCalificacion() . ",idLicencia=" . $this->getIdLicencia() . ",estatus='". $this->getEstatus()."'
					WHERE idEvaluacion=" . $this->idEvaluacion;
				//echo $SQL;
				$result=mysqli_query($dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error($dbLink) . "][ModeloBaseEvaluacion::Update]");
				
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		protected function Actualizar2()
		{
			try
			{
				$SQL="UPDATE evaluacion SET idturno='" . mysqli_real_escape_string($this->dbLink,$this->idturno) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',fechaHora='" . mysqli_real_escape_string($this->dbLink,$this->fechaHora) . "',idExamen='" . mysqli_real_escape_string($this->dbLink,$this->idExamen) . "',observaciones='" . mysqli_real_escape_string($this->dbLink,$this->observaciones) . "',calificacion='" . mysqli_real_escape_string($this->dbLink,$this->calificacion) . "',idLicencia='" . mysqli_real_escape_string($this->dbLink,$this->idLicencia) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "'
					WHERE idEvaluacion=" . $this->idEvaluacion;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseEvaluacion::Update]");
				
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
				$SQL="DELETE FROM evaluacion
				WHERE idEvaluacion=" . mysqli_real_escape_string($this->dbLink,$this->idEvaluacion);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseEvaluacion::Borrar]");
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
						idEvaluacion,idturno,idUsuario,fechaHora,idExamen,observaciones,calificacion,idLicencia,estatus
					FROM evaluacion
					WHERE idEvaluacion=" . mysqli_real_escape_string($this->dbLink,$this->idEvaluacion);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseEvaluacion::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idEvaluacion==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>