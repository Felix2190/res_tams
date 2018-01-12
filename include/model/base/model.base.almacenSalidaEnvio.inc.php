<?php

	class ModeloBaseAlmacenSalidaEnvio extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseAlmacenSalidaEnvio";

		
		var $idalmacenSalidaEnvio=0;
		var $fechaAlta='';
		var $idLoginMember=0;
		var $paqueteria='';
		var $guia='';
		var $estatus='disponible';
		var $idalmacensalida=0;

		var $__s=array("idalmacenSalidaEnvio","fechaAlta","idLoginMember","paqueteria","guia","estatus","idalmacensalida");
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

		
		public function setIdalmacenSalidaEnvio($idalmacenSalidaEnvio)
		{
			if($idalmacenSalidaEnvio==0||$idalmacenSalidaEnvio==""||!is_numeric($idalmacenSalidaEnvio)|| (is_string($idalmacenSalidaEnvio)&&!ctype_digit($idalmacenSalidaEnvio)))return $this->setError("Tipo de dato incorrecto para idalmacenSalidaEnvio.");
			$this->idalmacenSalidaEnvio=$idalmacenSalidaEnvio;
			$this->getDatos();
		}
		public function setFechaAlta($fechaAlta)
		{
			$this->fechaAlta=$fechaAlta;
		}
		public function setIdLoginMember($idLoginMember)
		{
			
			$this->idLoginMember=$idLoginMember;
		}
		public function setPaqueteria($paqueteria)
		{
			
			$this->paqueteria=$paqueteria;
		}
		public function setGuia($guia)
		{
			
			$this->guia=$guia;
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
		public function setIdalmacensalida($idalmacensalida)
		{
			
			$this->idalmacensalida=$idalmacensalida;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdalmacenSalidaEnvio()
		{
			return $this->idalmacenSalidaEnvio;
		}
		public function getFechaAlta()
		{
			return $this->fechaAlta;
		}
		public function getIdLoginMember()
		{
			return $this->idLoginMember;
		}
		public function getPaqueteria()
		{
			return $this->paqueteria;
		}
		public function getGuia()
		{
			return $this->guia;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getIdalmacensalida()
		{
			return $this->idalmacensalida;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idalmacenSalidaEnvio=0;
			$this->fechaAlta='';
			$this->idLoginMember=0;
			$this->paqueteria='';
			$this->guia='';
			$this->estatus='disponible';
			$this->idalmacensalida=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO almacenSalidaEnvio(fechaAlta,idLoginMember,paqueteria,guia,estatus,idalmacensalida)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "','" . mysqli_real_escape_string($this->dbLink,$this->idLoginMember) . "','" . mysqli_real_escape_string($this->dbLink,$this->paqueteria) . "','" . mysqli_real_escape_string($this->dbLink,$this->guia) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->idalmacensalida) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseAlmacenSalidaEnvio::Insertar]");
				
				$this->idalmacenSalidaEnvio=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE almacenSalidaEnvio SET fechaAlta='" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "',idLoginMember='" . mysqli_real_escape_string($this->dbLink,$this->idLoginMember) . "',paqueteria='" . mysqli_real_escape_string($this->dbLink,$this->paqueteria) . "',guia='" . mysqli_real_escape_string($this->dbLink,$this->guia) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',idalmacensalida='" . mysqli_real_escape_string($this->dbLink,$this->idalmacensalida) . "'
					WHERE idalmacenSalidaEnvio=" . $this->idalmacenSalidaEnvio;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseAlmacenSalidaEnvio::Update]");
				
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
				$SQL="DELETE FROM almacenSalidaEnvio
				WHERE idalmacenSalidaEnvio=" . mysqli_real_escape_string($this->dbLink,$this->idalmacenSalidaEnvio);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseAlmacenSalidaEnvio::Borrar]");
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
						idalmacenSalidaEnvio,fechaAlta,idLoginMember,paqueteria,guia,estatus,idalmacensalida
					FROM almacenSalidaEnvio
					WHERE idalmacenSalidaEnvio=" . mysqli_real_escape_string($this->dbLink,$this->idalmacenSalidaEnvio);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseAlmacenSalidaEnvio::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idalmacenSalidaEnvio==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>