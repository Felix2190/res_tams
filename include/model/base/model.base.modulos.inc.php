<?php

	class ModeloBaseModulos extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseModulos";

		
		var $idModulo=0;
		var $Descripcion='';
		var $IP='';
		var $fecha='';
		var $idUsuario=0;
		var $activo='1';

		var $__s=array("idModulo","Descripcion","IP","fecha","idUsuario","activo");
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

		
		public function setIdModulo($idModulo)
		{
			if($idModulo==0||$idModulo==""||!is_numeric($idModulo)|| (is_string($idModulo)&&!ctype_digit($idModulo)))return $this->setError("Tipo de dato incorrecto para idModulo.");
			$this->idModulo=$idModulo;
			$this->getDatos();
		}
		public function setDescripcion($Descripcion)
		{
			
			$this->Descripcion=$Descripcion;
		}
		public function setIP($IP)
		{
			
			$this->IP=$IP;
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setActivo()
		{
			$this->activo=1;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetActivo()
		{
			$this->activo=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdModulo()
		{
			return $this->idModulo;
		}
		public function getDescripcion()
		{
			return $this->Descripcion;
		}
		public function getIP()
		{
			return $this->IP;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getActivo()
		{
			return $this->activo;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idModulo=0;
			$this->Descripcion='';
			$this->IP='';
			$this->fecha='';
			$this->idUsuario=0;
			$this->activo='1';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO modulos(Descripcion,IP,fecha,idUsuario,activo)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->Descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->IP) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->activo) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseModulos::Insertar]");
				
				$this->idModulo=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE modulos SET Descripcion='" . mysqli_real_escape_string($this->dbLink,$this->Descripcion) . "',IP='" . mysqli_real_escape_string($this->dbLink,$this->IP) . "',fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',activo='" . mysqli_real_escape_string($this->dbLink,$this->activo) . "'
					WHERE idModulo=" . $this->idModulo;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseModulos::Update]");
				
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
				$SQL="DELETE FROM modulos
				WHERE idModulo=" . mysqli_real_escape_string($this->dbLink,$this->idModulo);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseModulos::Borrar]");
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
						idModulo,Descripcion,IP,fecha,idUsuario,activo
					FROM modulos
					WHERE idModulo=" . mysqli_real_escape_string($this->dbLink,$this->idModulo);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseModulos::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idModulo==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>