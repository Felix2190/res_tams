<?php

	class ModeloBaseProspecto_producto extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseProspecto_producto";

		
		var $idProspectoProducto=0;
		var $idProspecto=0;
		var $idProductoCotizado=0;

		var $__s=array("idProspectoProducto","idProspecto","idProductoCotizado");
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

		
		public function setIdProspectoProducto($idProspectoProducto)
		{
			if($idProspectoProducto==0||$idProspectoProducto==""||!is_numeric($idProspectoProducto)|| (is_string($idProspectoProducto)&&!ctype_digit($idProspectoProducto)))return $this->setError("Tipo de dato incorrecto para idProspectoProducto.");
			$this->idProspectoProducto=$idProspectoProducto;
			$this->getDatos();
		}
		public function setIdProspecto($idProspecto)
		{
			
			$this->idProspecto=$idProspecto;
		}
		public function setIdProductoCotizado($idProductoCotizado)
		{
			
			$this->idProductoCotizado=$idProductoCotizado;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdProspectoProducto()
		{
			return $this->idProspectoProducto;
		}
		public function getIdProspecto()
		{
			return $this->idProspecto;
		}
		public function getIdProductoCotizado()
		{
			return $this->idProductoCotizado;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idProspectoProducto=0;
			$this->idProspecto=0;
			$this->idProductoCotizado=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO prospecto_producto(idProspecto,idProductoCotizado)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idProspecto) . "','" . mysqli_real_escape_string($this->dbLink,$this->idProductoCotizado) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseProspecto_producto::Insertar]");
				
				$this->idProspectoProducto=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE prospecto_producto SET idProspecto='" . mysqli_real_escape_string($this->dbLink,$this->idProspecto) . "',idProductoCotizado='" . mysqli_real_escape_string($this->dbLink,$this->idProductoCotizado) . "'
					WHERE idProspectoProducto=" . $this->idProspectoProducto;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseProspecto_producto::Update]");
				
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
				$SQL="DELETE FROM prospecto_producto
				WHERE idProspectoProducto=" . mysqli_real_escape_string($this->dbLink,$this->idProspectoProducto);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseProspecto_producto::Borrar]");
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
						idProspectoProducto,idProspecto,idProductoCotizado
					FROM prospecto_producto
					WHERE idProspectoProducto=" . mysqli_real_escape_string($this->dbLink,$this->idProspectoProducto);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseProspecto_producto::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idProspectoProducto==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>