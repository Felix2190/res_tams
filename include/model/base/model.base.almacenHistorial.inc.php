<?php

	class ModeloBaseAlmacenhistorial extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseAlmacenhistorial";

		
		var $idalmacenHistorial=0;
		var $fechaAlta='';
		var $tipo='salida';
		var $idProducto=0;
		var $numeroSerie='';
		var $mac='';
		var $idLoginMember=0;
		var $nombreLoginMember='';
		var $idUbicacion=0;
		var $cantidad=0;
		var $responsable='';
		var $estatus='disponible';

		var $__s=array("idalmacenHistorial","fechaAlta","tipo","idProducto","numeroSerie","mac","idLoginMember","nombreLoginMember","idUbicacion","cantidad","responsable","estatus");
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

		
		public function setIdalmacenHistorial($idalmacenHistorial)
		{
			if($idalmacenHistorial==0||$idalmacenHistorial==""||!is_numeric($idalmacenHistorial)|| (is_string($idalmacenHistorial)&&!ctype_digit($idalmacenHistorial)))return $this->setError("Tipo de dato incorrecto para idalmacenHistorial.");
			$this->idalmacenHistorial=$idalmacenHistorial;
			$this->getDatos();
		}
		public function setFechaAlta($fechaAlta)
		{
			$this->fechaAlta=$fechaAlta;
		}
		public function setTipo($tipo)
		{
			
			$this->tipo=$tipo;
		}
		public function setTipoSalida()
		{
			$this->tipo='salida';
		}
		public function setTipoEntrada()
		{
			$this->tipo='entrada';
		}
		public function setTipoTraslado()
		{
			$this->tipo='traslado';
		}
		public function setTipoTrasladoSalida()
		{
			$this->tipo='trasladoSalida';
		}
		public function setTipoTrasladoEntrada()
		{
			$this->tipo='trasladoEntrada';
		}
		public function setIdProducto($idProducto)
		{
			
			$this->idProducto=$idProducto;
		}
		public function setNumeroSerie($numeroSerie)
		{
			
			$this->numeroSerie=$numeroSerie;
		}
		public function setMac($mac)
		{
			
			$this->mac=$mac;
		}
		public function setIdLoginMember($idLoginMember)
		{
			
			$this->idLoginMember=$idLoginMember;
		}
		public function setNombreLoginMember($nombreLoginMember)
		{
			
			$this->nombreLoginMember=$nombreLoginMember;
		}
		public function setIdUbicacion($idUbicacion)
		{
			
			$this->idUbicacion=$idUbicacion;
		}
		public function setCantidad($cantidad)
		{
			
			$this->cantidad=$cantidad;
		}
		public function setResponsable($responsable)
		{
			
			$this->responsable=$responsable;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusDisponible()
		{
			$this->estatus='disponible';
		}
		public function setEstatusBaja()
		{
			$this->estatus='baja';
		}
		public function setEstatusTraslado()
		{
			$this->estatus='traslado';
		}
		public function setEstatusConsignacion()
		{
			$this->estatus='consignacion';
		}
		public function setEstatusVenta()
		{
			$this->estatus='venta';
		}
		public function setEstatusRenta()
		{
			$this->estatus='renta';
		}
		public function setEstatusStock()
		{
			$this->estatus='stock';
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdalmacenHistorial()
		{
			return $this->idalmacenHistorial;
		}
		public function getFechaAlta()
		{
			return $this->fechaAlta;
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getIdProducto()
		{
			return $this->idProducto;
		}
		public function getNumeroSerie()
		{
			return $this->numeroSerie;
		}
		public function getMac()
		{
			return $this->mac;
		}
		public function getIdLoginMember()
		{
			return $this->idLoginMember;
		}
		public function getNombreLoginMember()
		{
			return $this->nombreLoginMember;
		}
		public function getIdUbicacion()
		{
			return $this->idUbicacion;
		}
		public function getCantidad()
		{
			return $this->cantidad;
		}
		public function getResponsable()
		{
			return $this->responsable;
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
			
			$this->idalmacenHistorial=0;
			$this->fechaAlta='';
			$this->tipo='salida';
			$this->idProducto=0;
			$this->numeroSerie='';
			$this->mac='';
			$this->idLoginMember=0;
			$this->nombreLoginMember='';
			$this->idUbicacion=0;
			$this->cantidad=0;
			$this->responsable='';
			$this->estatus='disponible';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO almacenhistorial(fechaAlta,tipo,idProducto,numeroSerie,mac,idLoginMember,nombreLoginMember,idUbicacion,cantidad,responsable,estatus)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "','" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "','" . mysqli_real_escape_string($this->dbLink,$this->idProducto) . "','" . mysqli_real_escape_string($this->dbLink,$this->numeroSerie) . "','" . mysqli_real_escape_string($this->dbLink,$this->mac) . "','" . mysqli_real_escape_string($this->dbLink,$this->idLoginMember) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombreLoginMember) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->cantidad) . "','" . mysqli_real_escape_string($this->dbLink,$this->responsable) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseAlmacenhistorial::Insertar]");
				
				$this->idalmacenHistorial=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE almacenhistorial SET fechaAlta='" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "',tipo='" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "',idProducto='" . mysqli_real_escape_string($this->dbLink,$this->idProducto) . "',numeroSerie='" . mysqli_real_escape_string($this->dbLink,$this->numeroSerie) . "',mac='" . mysqli_real_escape_string($this->dbLink,$this->mac) . "',idLoginMember='" . mysqli_real_escape_string($this->dbLink,$this->idLoginMember) . "',nombreLoginMember='" . mysqli_real_escape_string($this->dbLink,$this->nombreLoginMember) . "',idUbicacion='" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "',cantidad='" . mysqli_real_escape_string($this->dbLink,$this->cantidad) . "',responsable='" . mysqli_real_escape_string($this->dbLink,$this->responsable) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "'
					WHERE idalmacenHistorial=" . $this->idalmacenHistorial;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseAlmacenhistorial::Update]");
				
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
				$SQL="DELETE FROM almacenhistorial
				WHERE idalmacenHistorial=" . mysqli_real_escape_string($this->dbLink,$this->idalmacenHistorial);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseAlmacenhistorial::Borrar]");
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
						idalmacenHistorial,fechaAlta,tipo,idProducto,numeroSerie,mac,idLoginMember,nombreLoginMember,idUbicacion,cantidad,responsable,estatus
					FROM almacenhistorial
					WHERE idalmacenHistorial=" . mysqli_real_escape_string($this->dbLink,$this->idalmacenHistorial);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseAlmacenhistorial::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idalmacenHistorial==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>