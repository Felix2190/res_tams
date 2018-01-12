<?php

	class ModeloBaseServicios extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseServicios";

		
		var $idServicio=0;
		var $nombre='';
		var $descripcion='';
		var $codigo='';

		var $__s=array("idServicio","nombre","descripcion","codigo");
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

		
		public function setIdServicio($idServicio)
		{
			if($idServicio==0||$idServicio==""||!is_numeric($idServicio)|| (is_string($idServicio)&&!ctype_digit($idServicio)))return $this->setError("Tipo de dato incorrecto para idServicio.");
			$this->idServicio=$idServicio;
			$this->getDatos();
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setDescripcion($descripcion)
		{
			$this->descripcion=$descripcion;
		}
		public function setCodigo($codigo)
		{
			
			$this->codigo=$codigo;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdServicio()
		{
			return $this->idServicio;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getDescripcion()
		{
			return $this->descripcion;
		}
		public function getCodigo()
		{
			return $this->codigo;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idServicio=0;
			$this->nombre='';
			$this->descripcion='';
			$this->codigo='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO servicios(nombre,descripcion,codigo)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseServicios::Insertar]");
				
				$this->idServicio=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE servicios SET nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "',codigo='" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "'
					WHERE idServicio=" . $this->idServicio;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseServicios::Update]");
				
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
				$SQL="DELETE FROM servicios
				WHERE idServicio=" . mysqli_real_escape_string($this->dbLink,$this->idServicio);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseServicios::Borrar]");
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
						idServicio,nombre,descripcion,codigo
					FROM servicios
					WHERE idServicio=" . mysqli_real_escape_string($this->dbLink,$this->idServicio);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseServicios::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idServicio==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>