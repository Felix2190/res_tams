<?php

	class ModeloBasePago extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBasePago";

		
		var $idPago=0;
		var $idUsuarioCreacion=0;
		var $idUbicacion=0;
		var $idTurno=0;
		var $total=0;
		var $fechaCreacion='';
		var $fechaPago='';
		var $fechaCancelacion='';
		var $motivoCancelacion='';
		var $idUsuarioCancelacion=0;
		var $idUsuarioPago=0;
		var $estatus='pendiente';
		var $folioRecaudacion='pendiente';
		var $cometarios='';
		var $forma='efectivo';
		var $ultimosDigitosTarjeta='';
		var $idCorteCaja=0;

		var $__s=array("idPago","idUsuarioCreacion","idUbicacion","idTurno","total","fechaCreacion","fechaPago","fechaCancelacion","motivoCancelacion","idUsuarioCancelacion","idUsuarioPago","estatus","folioRecaudacion","cometarios","forma","ultimosDigitosTarjeta","idCorteCaja");
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

		
		public function setIdPago($idPago)
		{
			if($idPago==0||$idPago==""||!is_numeric($idPago)|| (is_string($idPago)&&!ctype_digit($idPago)))return $this->setError("Tipo de dato incorrecto para idPago.");
			$this->idPago=$idPago;
			$this->getDatos();
		}
		public function setIdUsuarioCreacion($idUsuarioCreacion)
		{
			
			$this->idUsuarioCreacion=$idUsuarioCreacion;
		}
		public function setIdUbicacion($idUbicacion)
		{
			
			$this->idUbicacion=$idUbicacion;
		}
		public function setIdTurno($idTurno)
		{
			
			$this->idTurno=$idTurno;
		}
		public function setTotal($total)
		{
			
			$this->total=$total;
		}
		public function setFechaCreacion($fechaCreacion)
		{
			$this->fechaCreacion=$fechaCreacion;
		}
		public function setFechaPago($fechaPago)
		{
			$this->fechaPago=$fechaPago;
		}
		public function setFechaCancelacion($fechaCancelacion)
		{
			$this->fechaCancelacion=$fechaCancelacion;
		}
		public function setMotivoCancelacion($motivoCancelacion)
		{
			$this->motivoCancelacion=$motivoCancelacion;
		}
		public function setIdUsuarioCancelacion($idUsuarioCancelacion)
		{
			
			$this->idUsuarioCancelacion=$idUsuarioCancelacion;
		}
		public function setIdUsuarioPago($idUsuarioPago)
		{
			
			$this->idUsuarioPago=$idUsuarioPago;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusPendiente()
		{
			$this->estatus='pendiente';
		}
		public function setEstatusPagado()
		{
			$this->estatus='pagado';
		}
		public function setEstatusCancelado()
		{
			$this->estatus='cancelado';
		}
		public function setFolioRecaudacion($folioRecaudacion)
		{
			
			$this->folioRecaudacion=$folioRecaudacion;
		}
		public function setCometarios($cometarios)
		{
			$this->cometarios=$cometarios;
		}
		public function setForma($forma)
		{
			
			$this->forma=$forma;
		}
		public function setFormaEfectivo()
		{
			$this->forma='efectivo';
		}
		public function setFormaTc()
		{
			$this->forma='tc';
		}
		public function setFormaTd()
		{
			$this->forma='td';
		}
		public function setUltimosDigitosTarjeta($ultimosDigitosTarjeta)
		{
			
			$this->ultimosDigitosTarjeta=$ultimosDigitosTarjeta;
		}
		public function setIdCorteCaja($idCorteCaja)
		{
			
			$this->idCorteCaja=$idCorteCaja;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdPago()
		{
			return $this->idPago;
		}
		public function getIdUsuarioCreacion()
		{
			return $this->idUsuarioCreacion;
		}
		public function getIdUbicacion()
		{
			return $this->idUbicacion;
		}
		public function getIdTurno()
		{
			return $this->idTurno;
		}
		public function getTotal()
		{
			return $this->total;
		}
		public function getFechaCreacion()
		{
			return $this->fechaCreacion;
		}
		public function getFechaPago()
		{
			return $this->fechaPago;
		}
		public function getFechaCancelacion()
		{
			return $this->fechaCancelacion;
		}
		public function getMotivoCancelacion()
		{
			return $this->motivoCancelacion;
		}
		public function getIdUsuarioCancelacion()
		{
			return $this->idUsuarioCancelacion;
		}
		public function getIdUsuarioPago()
		{
			return $this->idUsuarioPago;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getFolioRecaudacion()
		{
			return $this->folioRecaudacion;
		}
		public function getCometarios()
		{
			return $this->cometarios;
		}
		public function getForma()
		{
			return $this->forma;
		}
		public function getUltimosDigitosTarjeta()
		{
			return $this->ultimosDigitosTarjeta;
		}
		public function getIdCorteCaja()
		{
			return $this->idCorteCaja;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idPago=0;
			$this->idUsuarioCreacion=0;
			$this->idUbicacion=0;
			$this->idTurno=0;
			$this->total=0;
			$this->fechaCreacion='';
			$this->fechaPago='';
			$this->fechaCancelacion='';
			$this->motivoCancelacion='';
			$this->idUsuarioCancelacion=0;
			$this->idUsuarioPago=0;
			$this->estatus='pendiente';
			$this->folioRecaudacion='pendiente';
			$this->cometarios='';
			$this->forma='efectivo';
			$this->ultimosDigitosTarjeta='';
			$this->idCorteCaja=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO pago(idUsuarioCreacion,idUbicacion,idTurno,total,fechaCreacion,fechaPago,fechaCancelacion,motivoCancelacion,idUsuarioCancelacion,idUsuarioPago,estatus,folioRecaudacion,cometarios,forma,ultimosDigitosTarjeta,idCorteCaja)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioCreacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idTurno) . "','" . mysqli_real_escape_string($this->dbLink,$this->total) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaCreacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaPago) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaCancelacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->motivoCancelacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioCancelacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioPago) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->folioRecaudacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->cometarios) . "','" . mysqli_real_escape_string($this->dbLink,$this->forma) . "','" . mysqli_real_escape_string($this->dbLink,$this->ultimosDigitosTarjeta) . "','" . mysqli_real_escape_string($this->dbLink,$this->idCorteCaja) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePago::Insertar]");
				
				$this->idPago=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE pago SET idUsuarioCreacion='" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioCreacion) . "',idUbicacion='" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "',idTurno='" . mysqli_real_escape_string($this->dbLink,$this->idTurno) . "',total='" . mysqli_real_escape_string($this->dbLink,$this->total) . "',fechaCreacion='" . mysqli_real_escape_string($this->dbLink,$this->fechaCreacion) . "',fechaPago='" . mysqli_real_escape_string($this->dbLink,$this->fechaPago) . "',fechaCancelacion='" . mysqli_real_escape_string($this->dbLink,$this->fechaCancelacion) . "',motivoCancelacion='" . mysqli_real_escape_string($this->dbLink,$this->motivoCancelacion) . "',idUsuarioCancelacion='" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioCancelacion) . "',idUsuarioPago='" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioPago) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',folioRecaudacion='" . mysqli_real_escape_string($this->dbLink,$this->folioRecaudacion) . "',cometarios='" . mysqli_real_escape_string($this->dbLink,$this->cometarios) . "',forma='" . mysqli_real_escape_string($this->dbLink,$this->forma) . "',ultimosDigitosTarjeta='" . mysqli_real_escape_string($this->dbLink,$this->ultimosDigitosTarjeta) . "',idCorteCaja='" . mysqli_real_escape_string($this->dbLink,$this->idCorteCaja) . "'
					WHERE idPago=" . $this->idPago;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePago::Update]");
				
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
				$SQL="DELETE FROM pago
				WHERE idPago=" . mysqli_real_escape_string($this->dbLink,$this->idPago);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePago::Borrar]");
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
						idPago,idUsuarioCreacion,idUbicacion,idTurno,total,fechaCreacion,fechaPago,fechaCancelacion,motivoCancelacion,idUsuarioCancelacion,idUsuarioPago,estatus,folioRecaudacion,cometarios,forma,ultimosDigitosTarjeta,idCorteCaja
					FROM pago
					WHERE idPago=" . mysqli_real_escape_string($this->dbLink,$this->idPago);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePago::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idPago==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>