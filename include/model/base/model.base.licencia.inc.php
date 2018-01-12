<?php

	class ModeloBaseLicencia extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseLicencia";

		
		var $idLicencias=0;
		var $idPersona=0;
		var $numero='';
		var $fechaExpedicion='';
		var $idTipoLicencia=0;
		var $fechaExpiracion='';
		var $idUbicacion=0;
		var $estatus='enTramite';

		var $__s=array("idLicencias","idPersona","numero","fechaExpedicion","idTipoLicencia","fechaExpiracion","idUbicacion","estatus");
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

		
		public function setIdLicencias($idLicencias)
		{
			if($idLicencias==0||$idLicencias==""||!is_numeric($idLicencias)|| (is_string($idLicencias)&&!ctype_digit($idLicencias)))return $this->setError("Tipo de dato incorrecto para idLicencias.");
			$this->idLicencias=$idLicencias;
			$this->getDatos();
		}
		public function setIdPersona($idPersona)
		{
			
			$this->idPersona=$idPersona;
		}
		public function setNumero($numero)
		{
			
			$this->numero=$numero;
		}
		public function setFechaExpedicion($fechaExpedicion)
		{
			$this->fechaExpedicion=$fechaExpedicion;
		}
		public function setIdTipoLicencia($idTipoLicencia)
		{
			
			$this->idTipoLicencia=$idTipoLicencia;
		}
		public function setFechaExpiracion($fechaExpiracion)
		{
			$this->fechaExpiracion=$fechaExpiracion;
		}
		public function setIdUbicacion($idUbicacion)
		{
			
			$this->idUbicacion=$idUbicacion;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusActivo()
		{
			$this->estatus='activo';
		}
		public function setEstatusBaja()
		{
			$this->estatus='baja';
		}
		public function setEstatusEnTramite()
		{
			$this->estatus='enTramite';
		}
		public function setEstatusPagada()
		{
			$this->estatus='pagada';
		}
		public function setEstatusSuspendida()
		{
			$this->estatus='suspendida';
		}
		public function setEstatusImpresa()
		{
			$this->estatus='impresa';
		}
		public function setEstatusAprobada()
		{
			$this->estatus='aprobada';
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdLicencias()
		{
			return $this->idLicencias;
		}
		public function getIdPersona()
		{
			return $this->idPersona;
		}
		public function getNumero()
		{
			return $this->numero;
		}
		public function getFechaExpedicion()
		{
			return $this->fechaExpedicion;
		}
		public function getIdTipoLicencia()
		{
			return $this->idTipoLicencia;
		}
		public function getFechaExpiracion()
		{
			return $this->fechaExpiracion;
		}
		public function getIdUbicacion()
		{
			return $this->idUbicacion;
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
			
			$this->idLicencias=0;
			$this->idPersona=0;
			$this->numero='';
			$this->fechaExpedicion='';
			$this->idTipoLicencia=0;
			$this->fechaExpiracion='';
			$this->idUbicacion=0;
			$this->estatus='enTramite';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO licencia(idPersona,numero,fechaExpedicion,idTipoLicencia,fechaExpiracion,idUbicacion,estatus)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idPersona) . "','" . mysqli_real_escape_string($this->dbLink,$this->numero) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaExpedicion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idTipoLicencia) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaExpiracion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseLicencia::Insertar]");
				
				$this->idLicencias=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE licencia SET idPersona='" . mysqli_real_escape_string($this->dbLink,$this->idPersona) . "',numero='" . mysqli_real_escape_string($this->dbLink,$this->numero) . "',fechaExpedicion='" . mysqli_real_escape_string($this->dbLink,$this->fechaExpedicion) . "',idTipoLicencia='" . mysqli_real_escape_string($this->dbLink,$this->idTipoLicencia) . "',fechaExpiracion='" . mysqli_real_escape_string($this->dbLink,$this->fechaExpiracion) . "',idUbicacion='" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "'
					WHERE idLicencias=" . $this->idLicencias;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseLicencia::Update]");
				
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
				$SQL="DELETE FROM licencia
				WHERE idLicencias=" . mysqli_real_escape_string($this->dbLink,$this->idLicencias);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseLicencia::Borrar]");
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
						idLicencias,idPersona,numero,fechaExpedicion,idTipoLicencia,fechaExpiracion,idUbicacion,estatus
					FROM licencia
					WHERE idLicencias=" . mysqli_real_escape_string($this->dbLink,$this->idLicencias);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseLicencia::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idLicencias==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>