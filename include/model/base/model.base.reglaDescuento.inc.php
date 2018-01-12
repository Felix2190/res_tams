<?php

	class ModeloBaseReglaDescuento extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseReglaDescuento";

		
		var $idReglaDescuento=0;
		var $idInciso=0;
		var $idTipoLicencia=0;
		var $nombre='';
		var $descripcion='';
		var $edadMenor=0;
		var $edadMayor=0;
		var $cantidad='';
		var $esPorcentaje='';
		var $estatus='';

		var $__s=array("idReglaDescuento","idInciso","idTipoLicencia","nombre","descripcion","edadMenor","edadMayor","cantidad","esPorcentaje","estatus");
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

		
		public function setIdReglaDescuento($idReglaDescuento)
		{
			if($idReglaDescuento==0||$idReglaDescuento==""||!is_numeric($idReglaDescuento)|| (is_string($idReglaDescuento)&&!ctype_digit($idReglaDescuento)))return $this->setError("Tipo de dato incorrecto para idReglaDescuento.");
			$this->idReglaDescuento=$idReglaDescuento;
			$this->getDatos();
		}
		public function setIdInciso($idInciso)
		{
			
			$this->idInciso=$idInciso;
		}
		public function setIdTipoLicencia($idTipoLicencia)
		{
			
			$this->idTipoLicencia=$idTipoLicencia;
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setDescripcion($descripcion)
		{
			$this->descripcion=$descripcion;
		}
		public function setEdadMenor($edadMenor)
		{
			
			$this->edadMenor=$edadMenor;
		}
		public function setEdadMayor($edadMayor)
		{
			
			$this->edadMayor=$edadMayor;
		}
		public function setCantidad($cantidad)
		{
			$this->cantidad=$cantidad;
		}
		public function setEsPorcentaje()
		{
			$this->esPorcentaje=1;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusActivo()
		{
			$this->estatus='activo';
		}
		public function setEstatusInactivo()
		{
			$this->estatus='inactivo';
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetEsPorcentaje()
		{
			$this->esPorcentaje=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdReglaDescuento()
		{
			return $this->idReglaDescuento;
		}
		public function getIdInciso()
		{
			return $this->idInciso;
		}
		public function getIdTipoLicencia()
		{
			return $this->idTipoLicencia;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getDescripcion()
		{
			return $this->descripcion;
		}
		public function getEdadMenor()
		{
			return $this->edadMenor;
		}
		public function getEdadMayor()
		{
			return $this->edadMayor;
		}
		public function getCantidad()
		{
			return $this->cantidad;
		}
		public function getEsPorcentaje()
		{
			return $this->esPorcentaje;
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
			
			$this->idReglaDescuento=0;
			$this->idInciso=0;
			$this->idTipoLicencia=0;
			$this->nombre='';
			$this->descripcion='';
			$this->edadMenor=0;
			$this->edadMayor=0;
			$this->cantidad='';
			$this->esPorcentaje='';
			$this->estatus='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO reglaDescuento(idInciso,idTipoLicencia,nombre,descripcion,edadMenor,edadMayor,cantidad,esPorcentaje,estatus)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idInciso) . "','" . mysqli_real_escape_string($this->dbLink,$this->idTipoLicencia) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->edadMenor) . "','" . mysqli_real_escape_string($this->dbLink,$this->edadMayor) . "','" . mysqli_real_escape_string($this->dbLink,$this->cantidad) . "','" . mysqli_real_escape_string($this->dbLink,$this->esPorcentaje) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseReglaDescuento::Insertar]");
				
				$this->idReglaDescuento=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE reglaDescuento SET idInciso='" . mysqli_real_escape_string($this->dbLink,$this->idInciso) . "',idTipoLicencia='" . mysqli_real_escape_string($this->dbLink,$this->idTipoLicencia) . "',nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "',edadMenor='" . mysqli_real_escape_string($this->dbLink,$this->edadMenor) . "',edadMayor='" . mysqli_real_escape_string($this->dbLink,$this->edadMayor) . "',cantidad='" . mysqli_real_escape_string($this->dbLink,$this->cantidad) . "',esPorcentaje='" . mysqli_real_escape_string($this->dbLink,$this->esPorcentaje) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "'
					WHERE idReglaDescuento=" . $this->idReglaDescuento;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseReglaDescuento::Update]");
				
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
				$SQL="DELETE FROM reglaDescuento
				WHERE idReglaDescuento=" . mysqli_real_escape_string($this->dbLink,$this->idReglaDescuento);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseReglaDescuento::Borrar]");
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
						idReglaDescuento,idInciso,idTipoLicencia,nombre,descripcion,edadMenor,edadMayor,cantidad,esPorcentaje,estatus
					FROM reglaDescuento
					WHERE idReglaDescuento=" . mysqli_real_escape_string($this->dbLink,$this->idReglaDescuento);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseReglaDescuento::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idReglaDescuento==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>