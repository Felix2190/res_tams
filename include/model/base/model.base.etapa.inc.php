<?php

	class ModeloBaseEtapa extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseEtapa";

		
		var $idEtapa=0;
		var $descripcion='';
		var $orden='0';

		var $__s=array("idEtapa","descripcion","orden");
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

		
		public function setIdEtapa($idEtapa)
		{
			if($idEtapa==0||$idEtapa==""||!is_numeric($idEtapa)|| (is_string($idEtapa)&&!ctype_digit($idEtapa)))return $this->setError("Tipo de dato incorrecto para idEtapa.");
			$this->idEtapa=$idEtapa;
			$this->getDatos();
		}
		public function setDescripcion($descripcion)
		{
			
			$this->descripcion=$descripcion;
		}
		public function setOrden($orden)
		{
			$this->orden=$orden;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetOrden()
		{
			$this->orden=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdEtapa()
		{
			return $this->idEtapa;
		}
		public function getDescripcion()
		{
			return $this->descripcion;
		}
		public function getOrden()
		{
			return $this->orden;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idEtapa=0;
			$this->descripcion='';
			$this->orden='0';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO etapa(descripcion,orden)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->orden) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseEtapa::Insertar]");
				
				$this->idEtapa=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE etapa SET descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "',orden='" . mysqli_real_escape_string($this->dbLink,$this->orden) . "'
					WHERE idEtapa=" . $this->idEtapa;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseEtapa::Update]");
				
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
				$SQL="DELETE FROM etapa
				WHERE idEtapa=" . mysqli_real_escape_string($this->dbLink,$this->idEtapa);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseEtapa::Borrar]");
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
						idEtapa,descripcion,orden
					FROM etapa
					WHERE idEtapa=" . mysqli_real_escape_string($this->dbLink,$this->idEtapa);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseEtapa::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idEtapa==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>