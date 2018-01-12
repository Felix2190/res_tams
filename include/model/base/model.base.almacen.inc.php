<?php

	class ModeloBaseAlmacen extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseAlmacen";

		
		var $idalmacen=0;
		var $fechaAlta='';
		var $folio='';
		var $idLoginMember=0;
		var $nombreLoginMember='';
		var $idUbicacion=0;
		var $idProducto=0;
		var $Inventariable='si';
		var $numeroSerie='';
		var $mac='';
		var $comentarios='';
		var $estatus='disponible';

		var $__s=array("idalmacen","fechaAlta","folio","idLoginMember","nombreLoginMember","idUbicacion","idProducto","Inventariable","numeroSerie","mac","comentarios","estatus");
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

		
		public function setIdalmacen($idalmacen)
		{
			if($idalmacen==0||$idalmacen==""||!is_numeric($idalmacen)|| (is_string($idalmacen)&&!ctype_digit($idalmacen)))return $this->setError("Tipo de dato incorrecto para idalmacen.");
			$this->idalmacen=$idalmacen;
			$this->getDatos();
		}
		public function setFechaAlta($fechaAlta)
		{
			$this->fechaAlta=$fechaAlta;
		}
		public function setFolio($folio)
		{
			
			$this->folio=$folio;
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
		public function setIdProducto($idProducto)
		{
			
			$this->idProducto=$idProducto;
		}
		public function setInventariable($Inventariable)
		{
			
			$this->Inventariable=$Inventariable;
		}
		public function setInventariableSi()
		{
			$this->Inventariable='si';
		}
		public function setInventariableNo()
		{
			$this->Inventariable='no';
		}
		public function setNumeroSerie($numeroSerie)
		{
			
			$this->numeroSerie=$numeroSerie;
		}
		public function setMac($mac)
		{
			
			$this->mac=$mac;
		}
		public function setComentarios($comentarios)
		{
			$this->comentarios=$comentarios;
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

		
		public function getIdalmacen()
		{
			return $this->idalmacen;
		}
		public function getFechaAlta()
		{
			return $this->fechaAlta;
		}
		public function getFolio()
		{
			return $this->folio;
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
		public function getIdProducto()
		{
			return $this->idProducto;
		}
		public function getInventariable()
		{
			return $this->Inventariable;
		}
		public function getNumeroSerie()
		{
			return $this->numeroSerie;
		}
		public function getMac()
		{
			return $this->mac;
		}
		public function getComentarios()
		{
			return $this->comentarios;
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
			
			$this->idalmacen=0;
			$this->fechaAlta='';
			$this->folio='';
			$this->idLoginMember=0;
			$this->nombreLoginMember='';
			$this->idUbicacion=0;
			$this->idProducto=0;
			$this->Inventariable='si';
			$this->numeroSerie='';
			$this->mac='';
			$this->comentarios='';
			$this->estatus='disponible';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO almacen(fechaAlta,folio,idLoginMember,nombreLoginMember,idUbicacion,idProducto,Inventariable,numeroSerie,mac,comentarios,estatus)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "','" . mysqli_real_escape_string($this->dbLink,$this->folio) . "','" . mysqli_real_escape_string($this->dbLink,$this->idLoginMember) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombreLoginMember) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idProducto) . "','" . mysqli_real_escape_string($this->dbLink,$this->Inventariable) . "','" . mysqli_real_escape_string($this->dbLink,$this->numeroSerie) . "','" . mysqli_real_escape_string($this->dbLink,$this->mac) . "','" . mysqli_real_escape_string($this->dbLink,$this->comentarios) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseAlmacen::Insertar]");
				
				$this->idalmacen=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE almacen SET fechaAlta='" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "',folio='" . mysqli_real_escape_string($this->dbLink,$this->folio) . "',idLoginMember='" . mysqli_real_escape_string($this->dbLink,$this->idLoginMember) . "',nombreLoginMember='" . mysqli_real_escape_string($this->dbLink,$this->nombreLoginMember) . "',idUbicacion='" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "',idProducto='" . mysqli_real_escape_string($this->dbLink,$this->idProducto) . "',Inventariable='" . mysqli_real_escape_string($this->dbLink,$this->Inventariable) . "',numeroSerie='" . mysqli_real_escape_string($this->dbLink,$this->numeroSerie) . "',mac='" . mysqli_real_escape_string($this->dbLink,$this->mac) . "',comentarios='" . mysqli_real_escape_string($this->dbLink,$this->comentarios) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "'
					WHERE idalmacen=" . $this->idalmacen;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseAlmacen::Update]");
				
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
				$SQL="DELETE FROM almacen
				WHERE idalmacen=" . mysqli_real_escape_string($this->dbLink,$this->idalmacen);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseAlmacen::Borrar]");
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
						idalmacen,fechaAlta,folio,idLoginMember,nombreLoginMember,idUbicacion,idProducto,Inventariable,numeroSerie,mac,comentarios,estatus
					FROM almacen
					WHERE idalmacen=" . mysqli_real_escape_string($this->dbLink,$this->idalmacen);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseAlmacen::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idalmacen==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>