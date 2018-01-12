<?php

	class ModeloBaseCortecaja extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseCortecaja";

		
		var $idCorteCaja=0;
		var $fecha='';
		var $fechaRealizacion='';
		var $idUbicacion=0;
		var $idUsuario=0;
		var $total=0;
		var $totalEfectivo=0;
		var $totalTarjeta=0;

		var $__s=array("idCorteCaja","fecha","fechaRealizacion","idUbicacion","idUsuario","total","totalEfectivo","totalTarjeta");
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

		
		public function setIdCorteCaja($idCorteCaja)
		{
			if($idCorteCaja==0||$idCorteCaja==""||!is_numeric($idCorteCaja)|| (is_string($idCorteCaja)&&!ctype_digit($idCorteCaja)))return $this->setError("Tipo de dato incorrecto para idCorteCaja.");
			$this->idCorteCaja=$idCorteCaja;
			$this->getDatos();
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setFechaRealizacion($fechaRealizacion)
		{
			$this->fechaRealizacion=$fechaRealizacion;
		}
		public function setIdUbicacion($idUbicacion)
		{
			
			$this->idUbicacion=$idUbicacion;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setTotal($total)
		{
			
			$this->total=$total;
		}
		public function setTotalEfectivo($totalEfectivo)
		{
			
			$this->totalEfectivo=$totalEfectivo;
		}
		public function setTotalTarjeta($totalTarjeta)
		{
			
			$this->totalTarjeta=$totalTarjeta;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdCorteCaja()
		{
			return $this->idCorteCaja;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getFechaRealizacion()
		{
			return $this->fechaRealizacion;
		}
		public function getIdUbicacion()
		{
			return $this->idUbicacion;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getTotal()
		{
			return $this->total;
		}
		public function getTotalEfectivo()
		{
			return $this->totalEfectivo;
		}
		public function getTotalTarjeta()
		{
			return $this->totalTarjeta;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idCorteCaja=0;
			$this->fecha='';
			$this->fechaRealizacion='';
			$this->idUbicacion=0;
			$this->idUsuario=0;
			$this->total=0;
			$this->totalEfectivo=0;
			$this->totalTarjeta=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO cortecaja(fecha,fechaRealizacion,idUbicacion,idUsuario,total,totalEfectivo,totalTarjeta)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaRealizacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->total) . "','" . mysqli_real_escape_string($this->dbLink,$this->totalEfectivo) . "','" . mysqli_real_escape_string($this->dbLink,$this->totalTarjeta) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseCortecaja::Insertar]");
				
				$this->idCorteCaja=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE cortecaja SET fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',fechaRealizacion='" . mysqli_real_escape_string($this->dbLink,$this->fechaRealizacion) . "',idUbicacion='" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',total='" . mysqli_real_escape_string($this->dbLink,$this->total) . "',totalEfectivo='" . mysqli_real_escape_string($this->dbLink,$this->totalEfectivo) . "',totalTarjeta='" . mysqli_real_escape_string($this->dbLink,$this->totalTarjeta) . "'
					WHERE idCorteCaja=" . $this->idCorteCaja;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCortecaja::Update]");
				
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
				$SQL="DELETE FROM cortecaja
				WHERE idCorteCaja=" . mysqli_real_escape_string($this->dbLink,$this->idCorteCaja);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCortecaja::Borrar]");
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
						idCorteCaja,fecha,fechaRealizacion,idUbicacion,idUsuario,total,totalEfectivo,totalTarjeta
					FROM cortecaja
					WHERE idCorteCaja=" . mysqli_real_escape_string($this->dbLink,$this->idCorteCaja);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseCortecaja::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idCorteCaja==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>