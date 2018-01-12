<?php

	class ModeloBaseVerificacion_biografica extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseVerificacion_biografica";

		
		var $idVerificacionBiografica=0;
		var $idTurno=0;
		var $estatus='';
		var $verificacion='';
		var $fecha='';
		var $idUsuario=0;
		var $entrada='';

		var $__s=array("idVerificacionBiografica","idTurno","estatus","verificacion","fecha","idUsuario","entrada");
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

		
		public function setIdVerificacionBiografica($idVerificacionBiografica)
		{
			if($idVerificacionBiografica==0||$idVerificacionBiografica==""||!is_numeric($idVerificacionBiografica)|| (is_string($idVerificacionBiografica)&&!ctype_digit($idVerificacionBiografica)))return $this->setError("Tipo de dato incorrecto para idVerificacionBiografica.");
			$this->idVerificacionBiografica=$idVerificacionBiografica;
			$this->getDatos();
		}
		public function setIdTurno($idTurno)
		{
			
			$this->idTurno=$idTurno;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusValidado()
		{
			$this->estatus='validado';
		}
		public function setEstatusNo_valido()
		{
			$this->estatus='no_valido';
		}
		public function setVerificacion($verificacion)
		{
			
			$this->verificacion=$verificacion;
		}
		public function setVerificacionPendiente()
		{
			$this->verificacion='pendiente';
		}
		public function setVerificacionCerrada()
		{
			$this->verificacion='cerrada';
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setEntrada($entrada)
		{
			
			$this->entrada=$entrada;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdVerificacionBiografica()
		{
			return $this->idVerificacionBiografica;
		}
		public function getIdTurno()
		{
			return $this->idTurno;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getVerificacion()
		{
			return $this->verificacion;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getEntrada()
		{
			return $this->entrada;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idVerificacionBiografica=0;
			$this->idTurno=0;
			$this->estatus='';
			$this->verificacion='';
			$this->fecha='';
			$this->idUsuario=0;
			$this->entrada='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO verificacion_biografica(idTurno,estatus,verificacion,fecha,idUsuario,entrada)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idTurno) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->verificacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->entrada) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseVerificacion_biografica::Insertar]");
				
				$this->idVerificacionBiografica=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE verificacion_biografica SET idTurno='" . mysqli_real_escape_string($this->dbLink,$this->idTurno) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',verificacion='" . mysqli_real_escape_string($this->dbLink,$this->verificacion) . "',fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',entrada='" . mysqli_real_escape_string($this->dbLink,$this->entrada) . "'
					WHERE idVerificacionBiografica=" . $this->idVerificacionBiografica;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseVerificacion_biografica::Update]");
				
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
				$SQL="DELETE FROM verificacion_biografica
				WHERE idVerificacionBiografica=" . mysqli_real_escape_string($this->dbLink,$this->idVerificacionBiografica);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseVerificacion_biografica::Borrar]");
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
						idVerificacionBiografica,idTurno,estatus,verificacion,fecha,idUsuario,entrada
					FROM verificacion_biografica
					WHERE idVerificacionBiografica=" . mysqli_real_escape_string($this->dbLink,$this->idVerificacionBiografica);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseVerificacion_biografica::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idVerificacionBiografica==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>