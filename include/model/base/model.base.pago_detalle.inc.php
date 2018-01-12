<?php

	class ModeloBasePago_detalle extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBasePago_detalle";

		
		var $idPagoDetalle=0;
		var $idPago=0;
		var $concepto='';
		var $monto='';

		var $__s=array("idPagoDetalle","idPago","concepto","monto");
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

		
		public function setIdPagoDetalle($idPagoDetalle)
		{
			if($idPagoDetalle==0||$idPagoDetalle==""||!is_numeric($idPagoDetalle)|| (is_string($idPagoDetalle)&&!ctype_digit($idPagoDetalle)))return $this->setError("Tipo de dato incorrecto para idPagoDetalle.");
			$this->idPagoDetalle=$idPagoDetalle;
			$this->getDatos();
		}
		public function setIdPago($idPago)
		{
			
			$this->idPago=$idPago;
		}
		public function setConcepto($concepto)
		{
			
			$this->concepto=$concepto;
		}
		public function setMonto($monto)
		{
			$this->monto=$monto;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdPagoDetalle()
		{
			return $this->idPagoDetalle;
		}
		public function getIdPago()
		{
			return $this->idPago;
		}
		public function getConcepto()
		{
			return $this->concepto;
		}
		public function getMonto()
		{
			return $this->monto;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idPagoDetalle=0;
			$this->idPago=0;
			$this->concepto='';
			$this->monto='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO pago_detalle(idPago,concepto,monto)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idPago) . "','" . mysqli_real_escape_string($this->dbLink,$this->concepto) . "','" . mysqli_real_escape_string($this->dbLink,$this->monto) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePago_detalle::Insertar]");
				
				$this->idPagoDetalle=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE pago_detalle SET idPago='" . mysqli_real_escape_string($this->dbLink,$this->idPago) . "',concepto='" . mysqli_real_escape_string($this->dbLink,$this->concepto) . "',monto='" . mysqli_real_escape_string($this->dbLink,$this->monto) . "'
					WHERE idPagoDetalle=" . $this->idPagoDetalle;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePago_detalle::Update]");
				
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
				$SQL="DELETE FROM pago_detalle
				WHERE idPagoDetalle=" . mysqli_real_escape_string($this->dbLink,$this->idPagoDetalle);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePago_detalle::Borrar]");
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
						idPagoDetalle,idPago,concepto,monto
					FROM pago_detalle
					WHERE idPagoDetalle=" . mysqli_real_escape_string($this->dbLink,$this->idPagoDetalle);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePago_detalle::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idPagoDetalle==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>