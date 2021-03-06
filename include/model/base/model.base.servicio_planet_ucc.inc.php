<?php

	class ModeloBaseServicio_planet_ucc extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseServicio_planet_ucc";

		
		var $idServicioPlanetUcc=0;
		var $id_usuario=0;
		var $codigo='';
		var $fecha_solicitud='';
		var $estatus='solicitado';
		var $descripcion='';
		var $cantidad=0;
		var $precio_unitario=0;
		var $renta_mensual='';
		var $plazo='';

		var $__s=array("idServicioPlanetUcc","id_usuario","codigo","fecha_solicitud","estatus","descripcion","cantidad","precio_unitario","renta_mensual","plazo");
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

		
		public function setIdServicioPlanetUcc($idServicioPlanetUcc)
		{
			if($idServicioPlanetUcc==0||$idServicioPlanetUcc==""||!is_numeric($idServicioPlanetUcc)|| (is_string($idServicioPlanetUcc)&&!ctype_digit($idServicioPlanetUcc)))return $this->setError("Tipo de dato incorrecto para idServicioPlanetUcc.");
			$this->idServicioPlanetUcc=$idServicioPlanetUcc;
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
		public function setCantidad($cantidad)
		{
			
			$this->cantidad=$cantidad;
		}
		public function setPrecio_unitario($precio_unitario)
		{
			
			$this->precio_unitario=$precio_unitario;
		}
		public function setRenta_mensual($renta_mensual)
		{
			$this->renta_mensual=$renta_mensual;
		}
		public function setPlazo($plazo)
		{
			
			$this->plazo=$plazo;
		}
		public function setPlazo1()
		{
			$this->plazo='1';
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

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdServicioPlanetUcc()
		{
			return $this->idServicioPlanetUcc;
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
		public function getCantidad()
		{
			return $this->cantidad;
		}
		public function getPrecio_unitario()
		{
			return $this->precio_unitario;
		}
		public function getRenta_mensual()
		{
			return $this->renta_mensual;
		}
		public function getPlazo()
		{
			return $this->plazo;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idServicioPlanetUcc=0;
			$this->id_usuario=0;
			$this->codigo='';
			$this->fecha_solicitud='';
			$this->estatus='solicitado';
			$this->descripcion='';
			$this->cantidad=0;
			$this->precio_unitario=0;
			$this->renta_mensual='';
			$this->plazo='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO servicio_planet_ucc(id_usuario,codigo,fecha_solicitud,estatus,descripcion,cantidad,precio_unitario,renta_mensual,plazo)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->id_usuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha_solicitud) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->cantidad) . "','" . mysqli_real_escape_string($this->dbLink,$this->precio_unitario) . "','" . mysqli_real_escape_string($this->dbLink,$this->renta_mensual) . "','" . mysqli_real_escape_string($this->dbLink,$this->plazo) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseServicio_planet_ucc::Insertar]");
				
				$this->idServicioPlanetUcc=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE servicio_planet_ucc SET id_usuario='" . mysqli_real_escape_string($this->dbLink,$this->id_usuario) . "',codigo='" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "',fecha_solicitud='" . mysqli_real_escape_string($this->dbLink,$this->fecha_solicitud) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "',cantidad='" . mysqli_real_escape_string($this->dbLink,$this->cantidad) . "',precio_unitario='" . mysqli_real_escape_string($this->dbLink,$this->precio_unitario) . "',renta_mensual='" . mysqli_real_escape_string($this->dbLink,$this->renta_mensual) . "',plazo='" . mysqli_real_escape_string($this->dbLink,$this->plazo) . "'
					WHERE idServicioPlanetUcc=" . $this->idServicioPlanetUcc;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseServicio_planet_ucc::Update]");
				
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
				$SQL="DELETE FROM servicio_planet_ucc
				WHERE idServicioPlanetUcc=" . mysqli_real_escape_string($this->dbLink,$this->idServicioPlanetUcc);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseServicio_planet_ucc::Borrar]");
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
						idServicioPlanetUcc,id_usuario,codigo,fecha_solicitud,estatus,descripcion,cantidad,precio_unitario,renta_mensual,plazo
					FROM servicio_planet_ucc
					WHERE idServicioPlanetUcc=" . mysqli_real_escape_string($this->dbLink,$this->idServicioPlanetUcc);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseServicio_planet_ucc::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idServicioPlanetUcc==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>