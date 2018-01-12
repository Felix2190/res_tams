<?php

	class ModeloBaseExamen extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseExamen";

		
		var $idExamen=0;
		var $idTipoLicencia=0;
		var $descripcion='';
		var $calificacionAprobatoria=0;
		var $estatus='';
		var $tipo='';

		var $__s=array("idExamen","idTipoLicencia","descripcion","calificacionAprobatoria","estatus","tipo");
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

		
		public function setIdExamen($idExamen)
		{
			if($idExamen==0||$idExamen==""||!is_numeric($idExamen)|| (is_string($idExamen)&&!ctype_digit($idExamen)))return $this->setError("Tipo de dato incorrecto para idExamen.");
			$this->idExamen=$idExamen;
			$this->getDatos();
		}
		public function setIdTipoLicencia($idTipoLicencia)
		{
			
			$this->idTipoLicencia=$idTipoLicencia;
		}
		public function setDescripcion($descripcion)
		{
			
			$this->descripcion=$descripcion;
		}
		public function setCalificacionAprobatoria($calificacionAprobatoria)
		{
			
			$this->calificacionAprobatoria=$calificacionAprobatoria;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusActivo()
		{
			$this->estatus='activo';
		}
		public function setEstatusBaja()
		{
			$this->estatus='baja';
		}
		public function setTipo($tipo)
		{
			
			$this->tipo=$tipo;
		}
		public function setTipoMedico()
		{
			$this->tipo='medico';
		}
		public function setTipoTeorico()
		{
			$this->tipo='teorico';
		}
		public function setTipoPractico()
		{
			$this->tipo='practico';
		}
		

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdExamen()
		{
			return $this->idExamen;
		}
		public function getIdTipoLicencia()
		{
			return $this->idTipoLicencia;
		}
		public function getDescripcion()
		{
			return $this->descripcion;
		}
		public function getCalificacionAprobatoria()
		{
			return $this->calificacionAprobatoria;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getTipo()
		{
			return $this->tipo;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idExamen=0;
			$this->idTipoLicencia=0;
			$this->descripcion='';
			$this->calificacionAprobatoria=0;
			$this->estatus='';
			$this->tipo='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO examen(idTipoLicencia,descripcion,calificacionAprobatoria,estatus,tipo)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idTipoLicencia) . "','" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->calificacionAprobatoria) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseExamen::Insertar]");
				
				$this->idExamen=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE examen SET idTipoLicencia='" . mysqli_real_escape_string($this->dbLink,$this->idTipoLicencia) . "',descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "',calificacionAprobatoria='" . mysqli_real_escape_string($this->dbLink,$this->calificacionAprobatoria) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',tipo='" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "'
					WHERE idExamen=" . $this->idExamen;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseExamen::Update]");
				
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
				$SQL="DELETE FROM examen
				WHERE idExamen=" . mysqli_real_escape_string($this->dbLink,$this->idExamen);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseExamen::Borrar]");
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
						idExamen,idTipoLicencia,descripcion,calificacionAprobatoria,estatus,tipo
					FROM examen
					WHERE idExamen=" . mysqli_real_escape_string($this->dbLink,$this->idExamen);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseExamen::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idExamen==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>