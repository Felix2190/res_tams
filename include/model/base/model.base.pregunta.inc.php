<?php

	class ModeloBasePregunta extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBasePregunta";

		
		var $idPregunta=0;
		var $pregunta='';
		var $rutaImagen='';
		var $estatus='activo';
		var $idUsuarioAlta=0;
		var $idUsuarioBaja=0;

		var $__s=array("idPregunta","pregunta","rutaImagen","estatus","idUsuarioAlta","idUsuarioBaja");
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

		
		public function setIdPregunta($idPregunta)
		{
			if($idPregunta==0||$idPregunta==""||!is_numeric($idPregunta)|| (is_string($idPregunta)&&!ctype_digit($idPregunta)))return $this->setError("Tipo de dato incorrecto para idPregunta.");
			$this->idPregunta=$idPregunta;
			$this->getDatos();
		}
		public function setPregunta($pregunta)
		{
			
			$this->pregunta=$pregunta;
		}
		public function setRutaImagen($rutaImagen)
		{
			
			$this->rutaImagen=$rutaImagen;
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
		public function setIdUsuarioAlta($idUsuarioAlta)
		{
			
			$this->idUsuarioAlta=$idUsuarioAlta;
		}
		public function setIdUsuarioBaja($idUsuarioBaja)
		{
			
			$this->idUsuarioBaja=$idUsuarioBaja;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdPregunta()
		{
			return $this->idPregunta;
		}
		public function getPregunta()
		{
			return $this->pregunta;
		}
		public function getRutaImagen()
		{
			return $this->rutaImagen;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getIdUsuarioAlta()
		{
			return $this->idUsuarioAlta;
		}
		public function getIdUsuarioBaja()
		{
			return $this->idUsuarioBaja;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idPregunta=0;
			$this->pregunta='';
			$this->rutaImagen='';
			$this->estatus='activo';
			$this->idUsuarioAlta=0;
			$this->idUsuarioBaja=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO pregunta(pregunta,rutaImagen,estatus,idUsuarioAlta,idUsuarioBaja)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->pregunta) . "','" . mysqli_real_escape_string($this->dbLink,$this->rutaImagen) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioAlta) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioBaja) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePregunta::Insertar]");
				
				$this->idPregunta=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE pregunta SET pregunta='" . mysqli_real_escape_string($this->dbLink,$this->pregunta) . "',rutaImagen='" . mysqli_real_escape_string($this->dbLink,$this->rutaImagen) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',idUsuarioAlta='" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioAlta) . "',idUsuarioBaja='" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioBaja) . "'
					WHERE idPregunta=" . $this->idPregunta;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePregunta::Update]");
				
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
				$SQL="DELETE FROM pregunta
				WHERE idPregunta=" . mysqli_real_escape_string($this->dbLink,$this->idPregunta);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePregunta::Borrar]");
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
						idPregunta,pregunta,rutaImagen,estatus,idUsuarioAlta,idUsuarioBaja
					FROM pregunta
					WHERE idPregunta=" . mysqli_real_escape_string($this->dbLink,$this->idPregunta);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePregunta::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idPregunta==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>