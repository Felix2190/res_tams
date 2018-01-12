<?php

	class ModeloBaseTurno extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseTurno";

		
		var $idTurno='';
		var $fechaHoraCreacion='';
		var $fechaHora='';
		var $turnoExterno='';
		var $idTipoLicencia=0;
		var $idUsuario=0;
		var $idUbicacion=0;
		var $idPersona=0;
		var $idEtapa=0;
		var $fechaHoraCierre='';
		var $idLicencias=0;

		var $__s=array("idTurno","fechaHoraCreacion","fechaHora","turnoExterno","idTipoLicencia","idUsuario","idUbicacion","idPersona","idEtapa","fechaHoraCierre","idLicencias");
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

		
		public function setIdTurno($idTurno)
		{
			$this->idTurno=$idTurno;
			$this->getDatos();
		}
		public function setFechaHoraCreacion($fechaHoraCreacion)
		{
			$this->fechaHoraCreacion=$fechaHoraCreacion;
		}
		public function setFechaHora($fechaHora)
		{
			$this->fechaHora=$fechaHora;
		}
		public function setTurnoExterno($turnoExterno)
		{
			
			$this->turnoExterno=$turnoExterno;
		}
		public function setIdTipoLicencia($idTipoLicencia)
		{
			
			$this->idTipoLicencia=$idTipoLicencia;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setIdUbicacion($idUbicacion)
		{
			
			$this->idUbicacion=$idUbicacion;
		}
		public function setIdPersona($idPersona)
		{
			
			$this->idPersona=$idPersona;
		}
		public function setIdEtapa($idEtapa)
		{
			
			$this->idEtapa=$idEtapa;
		}
		public function setFechaHoraCierre($fechaHoraCierre)
		{
			$this->fechaHoraCierre=$fechaHoraCierre;
		}
		public function setIdLicencias($idLicencias)
		{
			
			$this->idLicencias=$idLicencias;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdTurno()
		{
			return $this->idTurno;
		}
		public function getFechaHoraCreacion()
		{
			return $this->fechaHoraCreacion;
		}
		public function getFechaHora()
		{
			return $this->fechaHora;
		}
		public function getTurnoExterno()
		{
			return $this->turnoExterno;
		}
		public function getIdTipoLicencia()
		{
			return $this->idTipoLicencia;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getIdUbicacion()
		{
			return $this->idUbicacion;
		}
		public function getIdPersona()
		{
			return $this->idPersona;
		}
		public function getIdEtapa()
		{
			return $this->idEtapa;
		}
		public function getFechaHoraCierre()
		{
			return $this->fechaHoraCierre;
		}
		public function getIdLicencias()
		{
			return $this->idLicencias;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idTurno='';
			$this->fechaHoraCreacion='';
			$this->fechaHora='';
			$this->turnoExterno='';
			$this->idTipoLicencia=0;
			$this->idUsuario=0;
			$this->idUbicacion=0;
			$this->idPersona=0;
			$this->idEtapa=0;
			$this->fechaHoraCierre='';
			$this->idLicencias=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO turno(fechaHoraCreacion,fechaHora,turnoExterno,idTipoLicencia,idUsuario,idUbicacion,idPersona,idEtapa,fechaHoraCierre,idLicencias)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->fechaHoraCreacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaHora) . "','" . mysqli_real_escape_string($this->dbLink,$this->turnoExterno) . "','" . mysqli_real_escape_string($this->dbLink,$this->idTipoLicencia) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idPersona) . "','" . mysqli_real_escape_string($this->dbLink,$this->idEtapa) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaHoraCierre) . "','" . mysqli_real_escape_string($this->dbLink,$this->idLicencias) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseTurno::Insertar]");
				
				$this->idTurno=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE turno SET fechaHoraCreacion='" . mysqli_real_escape_string($this->dbLink,$this->fechaHoraCreacion) . "',fechaHora='" . mysqli_real_escape_string($this->dbLink,$this->fechaHora) . "',turnoExterno='" . mysqli_real_escape_string($this->dbLink,$this->turnoExterno) . "',idTipoLicencia='" . mysqli_real_escape_string($this->dbLink,$this->idTipoLicencia) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',idUbicacion='" . mysqli_real_escape_string($this->dbLink,$this->idUbicacion) . "',idPersona='" . mysqli_real_escape_string($this->dbLink,$this->idPersona) . "',idEtapa='" . mysqli_real_escape_string($this->dbLink,$this->idEtapa) . "',fechaHoraCierre='" . mysqli_real_escape_string($this->dbLink,$this->fechaHoraCierre) . "',idLicencias='" . mysqli_real_escape_string($this->dbLink,$this->idLicencias) . "'
					WHERE idTurno=" . $this->idTurno;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTurno::Update]");
				
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
				$SQL="DELETE FROM turno
				WHERE idTurno=" . mysqli_real_escape_string($this->dbLink,$this->idTurno);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTurno::Borrar]");
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
						idTurno,fechaHoraCreacion,fechaHora,turnoExterno,idTipoLicencia,idUsuario,idUbicacion,idPersona,idEtapa,fechaHoraCierre,idLicencias
					FROM turno
					WHERE  idTurno=" . mysqli_real_escape_string($this->dbLink,$this->idTurno);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idTurno==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>