<?php

	class ModeloBaseConfiguracion extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseConfiguracion";

		
		var $idConfiguracion=0;
		var $Clave='';
		var $Descripcion='';
		var $valor='';
		var $fecha='';
		var $idUsuario=0;

		var $__s=array("idConfiguracion","Clave","Descripcion","valor","fecha","idUsuario");
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

		
		public function setIdConfiguracion($idConfiguracion)
		{
			if($idConfiguracion==0||$idConfiguracion==""||!is_numeric($idConfiguracion)|| (is_string($idConfiguracion)&&!ctype_digit($idConfiguracion)))return $this->setError("Tipo de dato incorrecto para idConfiguracion.");
			$this->idConfiguracion=$idConfiguracion;
			$this->getDatos();
		}
		public function setClave($Clave)
		{
			
			$this->Clave=$Clave;
		}
		public function setDescripcion($Descripcion)
		{
			
			$this->Descripcion=$Descripcion;
		}
		public function setValor($valor)
		{
			
			$this->valor=$valor;
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

		
		public function getIdConfiguracion()
		{
			return $this->idConfiguracion;
		}
		public function getClave()
		{
			return $this->Clave;
		}
		public function getDescripcion()
		{
			return $this->Descripcion;
		}
		public function getValor()
		{
			return $this->valor;
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
			
			$this->idConfiguracion=0;
			$this->Clave='';
			$this->Descripcion='';
			$this->valor='';
			$this->fecha='';
			$this->idUsuario=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO configuracion(Clave,Descripcion,valor,fecha,idUsuario)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->Clave) . "','" . mysqli_real_escape_string($this->dbLink,$this->Descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->valor) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseConfiguracion::Insertar]");
				
				$this->idConfiguracion=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE configuracion SET Clave='" . mysqli_real_escape_string($this->dbLink,$this->Clave) . "',Descripcion='" . mysqli_real_escape_string($this->dbLink,$this->Descripcion) . "',valor='" . mysqli_real_escape_string($this->dbLink,$this->valor) . "',fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "'
					WHERE idConfiguracion=" . $this->idConfiguracion;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseConfiguracion::Update]");
				
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
				$SQL="DELETE FROM configuracion
				WHERE idConfiguracion=" . mysqli_real_escape_string($this->dbLink,$this->idConfiguracion);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseConfiguracion::Borrar]");
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
						idConfiguracion,Clave,Descripcion,valor,fecha,idUsuario
					FROM configuracion
					WHERE idConfiguracion=" . mysqli_real_escape_string($this->dbLink,$this->idConfiguracion);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseConfiguracion::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idConfiguracion==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>