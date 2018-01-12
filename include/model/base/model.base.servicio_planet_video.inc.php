<?php

	class ModeloBaseServicio_planet_video extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseServicio_planet_video";

		
		var $idServicioPlanetVideo=0;
		var $id_usuario=0;
		var $codigo='';
		var $fecha_solicitud='';
		var $estatus='solicitado';
		var $descripcion='';
		var $salas=0;
		var $participantes=0;
		var $cantidad=0;
		var $precio_unitario='';
		var $renta=0;
		var $descuento_renta='';
		var $plazo='';

		var $__s=array("idServicioPlanetVideo","id_usuario","codigo","fecha_solicitud","estatus","descripcion","salas","participantes","cantidad","precio_unitario","renta","descuento_renta","plazo");
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

		
		public function setIdServicioPlanetVideo($idServicioPlanetVideo)
		{
			if($idServicioPlanetVideo==0||$idServicioPlanetVideo==""||!is_numeric($idServicioPlanetVideo)|| (is_string($idServicioPlanetVideo)&&!ctype_digit($idServicioPlanetVideo)))return $this->setError("Tipo de dato incorrecto para idServicioPlanetVideo.");
			$this->idServicioPlanetVideo=$idServicioPlanetVideo;
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
		public function setSalas($salas)
		{
			
			$this->salas=$salas;
		}
		public function setParticipantes($participantes)
		{
			
			$this->participantes=$participantes;
		}
		public function setCantidad($cantidad)
		{
			
			$this->cantidad=$cantidad;
		}
		public function setPrecio_unitario($precio_unitario)
		{
			$this->precio_unitario=$precio_unitario;
		}
		public function setRenta($renta)
		{
			
			$this->renta=$renta;
		}
		public function setDescuento_renta($descuento_renta)
		{
			$this->descuento_renta=$descuento_renta;
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

		
		public function getIdServicioPlanetVideo()
		{
			return $this->idServicioPlanetVideo;
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
		public function getSalas()
		{
			return $this->salas;
		}
		public function getParticipantes()
		{
			return $this->participantes;
		}
		public function getCantidad()
		{
			return $this->cantidad;
		}
		public function getPrecio_unitario()
		{
			return $this->precio_unitario;
		}
		public function getRenta()
		{
			return $this->renta;
		}
		public function getDescuento_renta()
		{
			return $this->descuento_renta;
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
			
			$this->idServicioPlanetVideo=0;
			$this->id_usuario=0;
			$this->codigo='';
			$this->fecha_solicitud='';
			$this->estatus='solicitado';
			$this->descripcion='';
			$this->salas=0;
			$this->participantes=0;
			$this->cantidad=0;
			$this->precio_unitario='';
			$this->renta=0;
			$this->descuento_renta='';
			$this->plazo='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO servicio_planet_video(id_usuario,codigo,fecha_solicitud,estatus,descripcion,salas,participantes,cantidad,precio_unitario,renta,descuento_renta,plazo)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->id_usuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha_solicitud) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->salas) . "','" . mysqli_real_escape_string($this->dbLink,$this->participantes) . "','" . mysqli_real_escape_string($this->dbLink,$this->cantidad) . "','" . mysqli_real_escape_string($this->dbLink,$this->precio_unitario) . "','" . mysqli_real_escape_string($this->dbLink,$this->renta) . "','" . mysqli_real_escape_string($this->dbLink,$this->descuento_renta) . "','" . mysqli_real_escape_string($this->dbLink,$this->plazo) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseServicio_planet_video::Insertar]");
				
				$this->idServicioPlanetVideo=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE servicio_planet_video SET id_usuario='" . mysqli_real_escape_string($this->dbLink,$this->id_usuario) . "',codigo='" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "',fecha_solicitud='" . mysqli_real_escape_string($this->dbLink,$this->fecha_solicitud) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "',salas='" . mysqli_real_escape_string($this->dbLink,$this->salas) . "',participantes='" . mysqli_real_escape_string($this->dbLink,$this->participantes) . "',cantidad='" . mysqli_real_escape_string($this->dbLink,$this->cantidad) . "',precio_unitario='" . mysqli_real_escape_string($this->dbLink,$this->precio_unitario) . "',renta='" . mysqli_real_escape_string($this->dbLink,$this->renta) . "',descuento_renta='" . mysqli_real_escape_string($this->dbLink,$this->descuento_renta) . "',plazo='" . mysqli_real_escape_string($this->dbLink,$this->plazo) . "'
					WHERE idServicioPlanetVideo=" . $this->idServicioPlanetVideo;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseServicio_planet_video::Update]");
				
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
				$SQL="DELETE FROM servicio_planet_video
				WHERE idServicioPlanetVideo=" . mysqli_real_escape_string($this->dbLink,$this->idServicioPlanetVideo);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseServicio_planet_video::Borrar]");
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
						idServicioPlanetVideo,id_usuario,codigo,fecha_solicitud,estatus,descripcion,salas,participantes,cantidad,precio_unitario,renta,descuento_renta,plazo
					FROM servicio_planet_video
					WHERE idServicioPlanetVideo=" . mysqli_real_escape_string($this->dbLink,$this->idServicioPlanetVideo);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseServicio_planet_video::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idServicioPlanetVideo==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>