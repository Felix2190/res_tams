<?php

	class ModeloBaseProducto_cotizado extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseProducto_cotizado";

		
		var $idProductoCotizado=0;
		var $identificador='';
		var $descripcion='';
		var $estatus='vigente';

		var $__s=array("idProductoCotizado","identificador","descripcion","estatus");
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

		
		public function setIdProductoCotizado($idProductoCotizado)
		{
			if($idProductoCotizado==0||$idProductoCotizado==""||!is_numeric($idProductoCotizado)|| (is_string($idProductoCotizado)&&!ctype_digit($idProductoCotizado)))return $this->setError("Tipo de dato incorrecto para idProductoCotizado.");
			$this->idProductoCotizado=$idProductoCotizado;
			$this->getDatos();
		}
		public function setIdentificador($identificador)
		{
			
			$this->identificador=$identificador;
		}
		public function setDescripcion($descripcion)
		{
			$this->descripcion=$descripcion;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusVigente()
		{
			$this->estatus='vigente';
		}
		public function setEstatusBaja()
		{
			$this->estatus='baja';
		}
		public function setEstatusSuspendido()
		{
			$this->estatus='suspendido';
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdProductoCotizado()
		{
			return $this->idProductoCotizado;
		}
		public function getIdentificador()
		{
			return $this->identificador;
		}
		public function getDescripcion()
		{
			return $this->descripcion;
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
			
			$this->idProductoCotizado=0;
			$this->identificador='';
			$this->descripcion='';
			$this->estatus='vigente';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO producto_cotizado(identificador,descripcion,estatus)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->identificador) . "','" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseProducto_cotizado::Insertar]");
				
				$this->idProductoCotizado=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE producto_cotizado SET identificador='" . mysqli_real_escape_string($this->dbLink,$this->identificador) . "',descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "'
					WHERE idProductoCotizado=" . $this->idProductoCotizado;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseProducto_cotizado::Update]");
				
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
				$SQL="DELETE FROM producto_cotizado
				WHERE idProductoCotizado=" . mysqli_real_escape_string($this->dbLink,$this->idProductoCotizado);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseProducto_cotizado::Borrar]");
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
						idProductoCotizado,identificador,descripcion,estatus
					FROM producto_cotizado
					WHERE idProductoCotizado=" . mysqli_real_escape_string($this->dbLink,$this->idProductoCotizado);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseProducto_cotizado::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idProductoCotizado==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>