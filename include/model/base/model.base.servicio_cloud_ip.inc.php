<?php

	class ModeloBaseServicio_cloud_ip extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseServicio_cloud_ip";

		
		var $idServicioCloudIp=0;
		var $id_usuario=0;
		var $codigo='';
		var $fecha_solicitud='';
		var $estatus='solicitado';
		var $descripcion='';
		var $proveedor='';
		var $tipo='';
		var $IPs=0;
		var $capacidad_subida=0;
		var $capacidad_bajada=0;
		var $nombre_sitio='';
		var $direccion='';
		var $gasto_instalacion='';
		var $descuento_instalacion=0;
		var $renta_mensual=0;
		var $descuento_renta='';
		var $plazo='6';
		var $terminos_condiciones='';
		var $observaciones='';

		var $__s=array("idServicioCloudIp","id_usuario","codigo","fecha_solicitud","estatus","descripcion","proveedor","tipo","IPs","capacidad_subida","capacidad_bajada","nombre_sitio","direccion","gasto_instalacion","descuento_instalacion","renta_mensual","descuento_renta","plazo","terminos_condiciones","observaciones");
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

		
		public function setIdServicioCloudIp($idServicioCloudIp)
		{
			if($idServicioCloudIp==0||$idServicioCloudIp==""||!is_numeric($idServicioCloudIp)|| (is_string($idServicioCloudIp)&&!ctype_digit($idServicioCloudIp)))return $this->setError("Tipo de dato incorrecto para idServicioCloudIp.");
			$this->idServicioCloudIp=$idServicioCloudIp;
			$this->getDatos();
		}
		public function setId_usuario($id_usuario)
		{
			
			$this->id_usuario=$id_usuario;
		}
		public function setCodigo($codigo)
		{
			
			$this->codigo=$codigo;
		}
		public function setFecha_solicitud($fecha_solicitud)
		{
			$this->fecha_solicitud=$fecha_solicitud;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusSolicitado()
		{
			$this->estatus='solicitado';
		}
		public function setEstatusActivado()
		{
			$this->estatus='activado';
		}
		public function setDescripcion($descripcion)
		{
			$this->descripcion=$descripcion;
		}
		public function setProveedor($proveedor)
		{
			
			$this->proveedor=$proveedor;
		}
		public function setProveedorETP()
		{
			$this->proveedor='ETP';
		}
		public function setProveedorMTC()
		{
			$this->proveedor='MTC';
		}
		public function setProveedorILOX()
		{
			$this->proveedor='ILOX';
		}
		public function setProveedorLNDR()
		{
			$this->proveedor='LNDR';
		}
		public function setProveedorTLMX()
		{
			$this->proveedor='TLMX';
		}
		public function setTipo($tipo)
		{
			
			$this->tipo=$tipo;
		}
		public function setTipoSemi_dedicado()
		{
			$this->tipo='Semi-dedicado';
		}
		public function setTipoDedicado()
		{
			$this->tipo='Dedicado';
		}
		public function setTipoADSL()
		{
			$this->tipo='ADSL';
		}
		public function setIPs($IPs)
		{
			
			$this->IPs=$IPs;
		}
		public function setCapacidad_subida($capacidad_subida)
		{
			
			$this->capacidad_subida=$capacidad_subida;
		}
		public function setCapacidad_bajada($capacidad_bajada)
		{
			
			$this->capacidad_bajada=$capacidad_bajada;
		}
		public function setNombre_sitio($nombre_sitio)
		{
			
			$this->nombre_sitio=$nombre_sitio;
		}
		public function setDireccion($direccion)
		{
			$this->direccion=$direccion;
		}
		public function setGasto_instalacion($gasto_instalacion)
		{
			$this->gasto_instalacion=$gasto_instalacion;
		}
		public function setDescuento_instalacion($descuento_instalacion)
		{
			
			$this->descuento_instalacion=$descuento_instalacion;
		}
		public function setRenta_mensual($renta_mensual)
		{
			
			$this->renta_mensual=$renta_mensual;
		}
		public function setDescuento_renta($descuento_renta)
		{
			$this->descuento_renta=$descuento_renta;
		}
		public function setPlazo($plazo)
		{
			
			$this->plazo=$plazo;
		}
		public function setPlazo6()
		{
			$this->plazo='6';
		}
		public function setPlazo12()
		{
			$this->plazo='12';
		}
		public function setPlazo18()
		{
			$this->plazo='18';
		}
		public function setPlazo24()
		{
			$this->plazo='24';
		}
		public function setPlazo36()
		{
			$this->plazo='36';
		}
		public function setPlazo48()
		{
			$this->plazo='48';
		}
		public function setTerminos_condiciones($terminos_condiciones)
		{
			$this->terminos_condiciones=$terminos_condiciones;
		}
		public function setObservaciones($observaciones)
		{
			$this->observaciones=$observaciones;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdServicioCloudIp()
		{
			return $this->idServicioCloudIp;
		}
		public function getId_usuario()
		{
			return $this->id_usuario;
		}
		public function getCodigo()
		{
			return $this->codigo;
		}
		public function getFecha_solicitud()
		{
			return $this->fecha_solicitud;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getDescripcion()
		{
			return $this->descripcion;
		}
		public function getProveedor()
		{
			return $this->proveedor;
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getIPs()
		{
			return $this->IPs;
		}
		public function getCapacidad_subida()
		{
			return $this->capacidad_subida;
		}
		public function getCapacidad_bajada()
		{
			return $this->capacidad_bajada;
		}
		public function getNombre_sitio()
		{
			return $this->nombre_sitio;
		}
		public function getDireccion()
		{
			return $this->direccion;
		}
		public function getGasto_instalacion()
		{
			return $this->gasto_instalacion;
		}
		public function getDescuento_instalacion()
		{
			return $this->descuento_instalacion;
		}
		public function getRenta_mensual()
		{
			return $this->renta_mensual;
		}
		public function getDescuento_renta()
		{
			return $this->descuento_renta;
		}
		public function getPlazo()
		{
			return $this->plazo;
		}
		public function getTerminos_condiciones()
		{
			return $this->terminos_condiciones;
		}
		public function getObservaciones()
		{
			return $this->observaciones;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idServicioCloudIp=0;
			$this->id_usuario=0;
			$this->codigo='';
			$this->fecha_solicitud='';
			$this->estatus='solicitado';
			$this->descripcion='';
			$this->proveedor='';
			$this->tipo='';
			$this->IPs=0;
			$this->capacidad_subida=0;
			$this->capacidad_bajada=0;
			$this->nombre_sitio='';
			$this->direccion='';
			$this->gasto_instalacion='';
			$this->descuento_instalacion=0;
			$this->renta_mensual=0;
			$this->descuento_renta='';
			$this->plazo='6';
			$this->terminos_condiciones='';
			$this->observaciones='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO servicio_cloud_ip(id_usuario,codigo,fecha_solicitud,estatus,descripcion,proveedor,tipo,IPs,capacidad_subida,capacidad_bajada,nombre_sitio,direccion,gasto_instalacion,descuento_instalacion,renta_mensual,descuento_renta,plazo,terminos_condiciones,observaciones)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->id_usuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha_solicitud) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->proveedor) . "','" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "','" . mysqli_real_escape_string($this->dbLink,$this->IPs) . "','" . mysqli_real_escape_string($this->dbLink,$this->capacidad_subida) . "','" . mysqli_real_escape_string($this->dbLink,$this->capacidad_bajada) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombre_sitio) . "','" . mysqli_real_escape_string($this->dbLink,$this->direccion) . "','" . mysqli_real_escape_string($this->dbLink,$this->gasto_instalacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->descuento_instalacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->renta_mensual) . "','" . mysqli_real_escape_string($this->dbLink,$this->descuento_renta) . "','" . mysqli_real_escape_string($this->dbLink,$this->plazo) . "','" . mysqli_real_escape_string($this->dbLink,$this->terminos_condiciones) . "','" . mysqli_real_escape_string($this->dbLink,$this->observaciones) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseServicio_cloud_ip::Insertar]");
				
				$this->idServicioCloudIp=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE servicio_cloud_ip SET id_usuario='" . mysqli_real_escape_string($this->dbLink,$this->id_usuario) . "',codigo='" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "',fecha_solicitud='" . mysqli_real_escape_string($this->dbLink,$this->fecha_solicitud) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "',proveedor='" . mysqli_real_escape_string($this->dbLink,$this->proveedor) . "',tipo='" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "',IPs='" . mysqli_real_escape_string($this->dbLink,$this->IPs) . "',capacidad_subida='" . mysqli_real_escape_string($this->dbLink,$this->capacidad_subida) . "',capacidad_bajada='" . mysqli_real_escape_string($this->dbLink,$this->capacidad_bajada) . "',nombre_sitio='" . mysqli_real_escape_string($this->dbLink,$this->nombre_sitio) . "',direccion='" . mysqli_real_escape_string($this->dbLink,$this->direccion) . "',gasto_instalacion='" . mysqli_real_escape_string($this->dbLink,$this->gasto_instalacion) . "',descuento_instalacion='" . mysqli_real_escape_string($this->dbLink,$this->descuento_instalacion) . "',renta_mensual='" . mysqli_real_escape_string($this->dbLink,$this->renta_mensual) . "',descuento_renta='" . mysqli_real_escape_string($this->dbLink,$this->descuento_renta) . "',plazo='" . mysqli_real_escape_string($this->dbLink,$this->plazo) . "',terminos_condiciones='" . mysqli_real_escape_string($this->dbLink,$this->terminos_condiciones) . "',observaciones='" . mysqli_real_escape_string($this->dbLink,$this->observaciones) . "'
					WHERE idServicioCloudIp=" . $this->idServicioCloudIp;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseServicio_cloud_ip::Update]");
				
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
				$SQL="DELETE FROM servicio_cloud_ip
				WHERE idServicioCloudIp=" . mysqli_real_escape_string($this->dbLink,$this->idServicioCloudIp);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseServicio_cloud_ip::Borrar]");
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
						idServicioCloudIp,id_usuario,codigo,fecha_solicitud,estatus,descripcion,proveedor,tipo,IPs,capacidad_subida,capacidad_bajada,nombre_sitio,direccion,gasto_instalacion,descuento_instalacion,renta_mensual,descuento_renta,plazo,terminos_condiciones,observaciones
					FROM servicio_cloud_ip
					WHERE idServicioCloudIp=" . mysqli_real_escape_string($this->dbLink,$this->idServicioCloudIp);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseServicio_cloud_ip::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idServicioCloudIp==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>