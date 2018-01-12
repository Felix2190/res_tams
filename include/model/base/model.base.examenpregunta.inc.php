<?php

	class ModeloBaseExamenpregunta extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseExamenpregunta";

		
		var $idExamenPregunta=0;
		var $idExamen=0;
		var $idPregunta=0;
		var $estatus='';
		var $idUsuarioAlta=0;
		var $idUsuarioBaja=0;
		var $valor=0;

		var $__s=array("idExamenPregunta","idExamen","idPregunta","estatus","idUsuarioAlta","idUsuarioBaja","valor");
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

		
		public function setIdExamenPregunta($idExamenPregunta)
		{
			if($idExamenPregunta==0||$idExamenPregunta==""||!is_numeric($idExamenPregunta)|| (is_string($idExamenPregunta)&&!ctype_digit($idExamenPregunta)))return $this->setError("Tipo de dato incorrecto para idExamenPregunta.");
			$this->idExamenPregunta=$idExamenPregunta;
			$this->getDatos();
		}
		public function setIdExamen($idExamen)
		{
			
			$this->idExamen=$idExamen;
		}
		public function setIdPregunta($idPregunta)
		{
			
			$this->idPregunta=$idPregunta;
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
		public function setValor($valor)
		{
			
			$this->valor=$valor;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdExamenPregunta()
		{
			return $this->idExamenPregunta;
		}
		public function getIdExamen()
		{
			return $this->idExamen;
		}
		public function getIdPregunta()
		{
			return $this->idPregunta;
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
		public function getValor()
		{
			return $this->valor;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idExamenPregunta=0;
			$this->idExamen=0;
			$this->idPregunta=0;
			$this->estatus='';
			$this->idUsuarioAlta=0;
			$this->idUsuarioBaja=0;
			$this->valor=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO examenpregunta(idExamen,idPregunta,estatus,idUsuarioAlta,idUsuarioBaja,valor)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idExamen) . "','" . mysqli_real_escape_string($this->dbLink,$this->idPregunta) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioAlta) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioBaja) . "','" . mysqli_real_escape_string($this->dbLink,$this->valor) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseExamenpregunta::Insertar]");
				
				$this->idExamenPregunta=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE examenpregunta SET idExamen='" . mysqli_real_escape_string($this->dbLink,$this->idExamen) . "',idPregunta='" . mysqli_real_escape_string($this->dbLink,$this->idPregunta) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',idUsuarioAlta='" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioAlta) . "',idUsuarioBaja='" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioBaja) . "',valor='" . mysqli_real_escape_string($this->dbLink,$this->valor) . "'
					WHERE idExamenPregunta=" . $this->idExamenPregunta;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseExamenpregunta::Update]");
				
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
				$SQL="DELETE FROM examenpregunta
				WHERE idExamenPregunta=" . mysqli_real_escape_string($this->dbLink,$this->idExamenPregunta);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseExamenpregunta::Borrar]");
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
						idExamenPregunta,idExamen,idPregunta,estatus,idUsuarioAlta,idUsuarioBaja,valor
					FROM examenpregunta
					WHERE idExamenPregunta=" . mysqli_real_escape_string($this->dbLink,$this->idExamenPregunta);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseExamenpregunta::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idExamenPregunta==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>