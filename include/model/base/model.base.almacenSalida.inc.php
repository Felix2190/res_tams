<?php

	class ModeloBaseAlmacensalida extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseAlmacensalida";

		
		var $idalmacenSalida=0;
		var $idalmacen=0;
		var $fechaAlta='';
		var $folio='';
		var $idLoginMember=0;
		var $nombreLoginMember='';
		var $idUbicacion=0;
		var $comentarios='';
		var $estatus='disponible';
		var $salida='stock';
		var $tipoSalida='personal';
		var $personaRecibe='';
		var $especifique='';

		var $__s=array("idalmacenSalida","idalmacen","fechaAlta","folio","idLoginMember","nombreLoginMember","idUbicacion","comentarios","estatus","salida","tipoSalida","personaRecibe","especifique");
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

		
		public function setIdalmacenSalida($idalmacenSalida)
		{
			if($idalmacenSalida==0||$idalmacenSalida==""||!is_numeric($idalmacenSalida)|| (is_string($idalmacenSalida)&&!ctype_digit($idalmacenSalida)))return $this->setError("Tipo de dato incorrecto para idalmacenSalida.");
			$this->idalmacenSalida=$idalmacenSalida;
			$this->getDatos();
		}
		public function setIdalmacen($idalmacen)
		{
			
			$this->idalmacen=$idalmacen;
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
		public function setSalida($salida)
		{
			
			$this->salida=$salida;
		}
		public function setSalidaConsignacion()
		{
			$this->salida='consignacion';
		}
		public function setSalidaRenta()
		{
			$this->salida='renta';
		}
		public function setSalidaVenta()
		{
			$this->salida='venta';
		}
		public function setSalidaStock()
		{
			$this->salida='stock';
		}
		public function setTipoSalida($tipoSalida)
		{
			
			$this->tipoSalida=$tipoSalida;
		}
		public function setTipoSalidaPersonal()
		{
			$this->tipoSalida='personal';
		}
		public function setTipoSalidaPaqueteria()
		{
			$this->tipoSalida='paqueteria';
		}
		public function setTipoSalidaOtro()
		{
			$this->tipoSalida='otro';
		}
		public function setPersonaRecibe($personaRecibe)
		{
			
			$this->personaRecibe=$personaRecibe;
		}
		public function setEspecifique($especifique)
		{
			
			$this->especifique=$especifique;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdalmacenSalida()
		{
			return $this->idalmacenSalida;
		}
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
		public function getComentarios()
		{
			return $this->comentarios;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getSalida()
		{
			return $this->salida;
		}
		public function getTipoSalida()
		{
			return $this->tipoSalida;
		}
		public function getPersonaRecibe()
		{
			return $this->personaRecibe;
		}
		public function getEspecifique()
		{
			return $this->especifique;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idalmacenSalida=0;
			$this->idalmacen=0;
			$this->fechaAlta='';
			$this->folio='';
			$this->idLoginMember=0;
			$this->nombreLoginMember='';
			$this->idUbicacion=0;
			$this->comentarios='';
			$this->estatus='disponible';
			$this->salida='stock';
			$this->tipoSalida='personal';
			$this->personaRecibe='';
			$this->especifique='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO almacensalida(idalmacen,fechaAlta,folio,idLoginMember,nombreLoginMember,idUbicacion,comentarios,estatus,salida,tipoSalida,personaRecibe,especifique)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idalmacen) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "','" . mysqli_real_escape_string($this->dbLink,$this->folio) . "','" . mysqli_real_escape_string($this->dbLink,$this->idLoginMember) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombreLoginMember) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->comentarios) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->salida) . "','" . mysqli_real_escape_string($this->dbLink,$this->tipoSalida) . "','" . mysqli_real_escape_string($this->dbLink,$this->personaRecibe) . "','" . mysqli_real_escape_string($this->dbLink,$this->especifique) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseAlmacensalida::Insertar]");
				
				$this->idalmacenSalida=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE almacensalida SET idalmacen='" . mysqli_real_escape_string($this->dbLink,$this->idalmacen) . "',fechaAlta='" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "',folio='" . mysqli_real_escape_string($this->dbLink,$this->folio) . "',idLoginMember='" . mysqli_real_escape_string($this->dbLink,$this->idLoginMember) . "',nombreLoginMember='" . mysqli_real_escape_string($this->dbLink,$this->nombreLoginMember) . "',idUbicacion='" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "',comentarios='" . mysqli_real_escape_string($this->dbLink,$this->comentarios) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',salida='" . mysqli_real_escape_string($this->dbLink,$this->salida) . "',tipoSalida='" . mysqli_real_escape_string($this->dbLink,$this->tipoSalida) . "',personaRecibe='" . mysqli_real_escape_string($this->dbLink,$this->personaRecibe) . "',especifique='" . mysqli_real_escape_string($this->dbLink,$this->especifique) . "'
					WHERE idalmacenSalida=" . $this->idalmacenSalida;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseAlmacensalida::Update]");
				
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
				$SQL="DELETE FROM almacensalida
				WHERE idalmacenSalida=" . mysqli_real_escape_string($this->dbLink,$this->idalmacenSalida);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseAlmacensalida::Borrar]");
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
						idalmacenSalida,idalmacen,fechaAlta,folio,idLoginMember,nombreLoginMember,idUbicacion,comentarios,estatus,salida,tipoSalida,personaRecibe,especifique
					FROM almacensalida
					WHERE idalmacenSalida=" . mysqli_real_escape_string($this->dbLink,$this->idalmacenSalida);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseAlmacensalida::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idalmacenSalida==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>