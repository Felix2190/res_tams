<?php

	class ModeloBaseImpresion extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseImpresion";

		
		var $idImpresion=0;
		var $idTurno=0;
		var $estatus='';
		var $IP='';
		var $fechaHora='';
		var $nombreEquipo='';

		var $__s=array("idImpresion","idTurno","estatus","IP","fechaHora","nombreEquipo");
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

		
		public function setIdImpresion($idImpresion)
		{
			if($idImpresion==0||$idImpresion==""||!is_numeric($idImpresion)|| (is_string($idImpresion)&&!ctype_digit($idImpresion)))return $this->setError("Tipo de dato incorrecto para idImpresion.");
			$this->idImpresion=$idImpresion;
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
		public function setEstatusEsperaMicrotexto()
		{
			$this->estatus='esperaMicrotexto';
		}
		public function setEstatusProcesandoMicrotexto()
		{
			$this->estatus='procesandoMicrotexto';
		}
		public function setEstatusImprimir()
		{
			$this->estatus='imprimir';
		}
		public function setEstatusProcesada()
		{
			$this->estatus='procesada';
		}
		public function setIP($IP)
		{
			
			$this->IP=$IP;
		}
		public function setFechaHora($fechaHora)
		{
			$this->fechaHora=$fechaHora;
		}
		public function setNombreEquipo($nombreEquipo)
		{
			
			$this->nombreEquipo=$nombreEquipo;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdImpresion()
		{
			return $this->idImpresion;
		}
		public function getIdTurno()
		{
			return $this->idTurno;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getIP()
		{
			return $this->IP;
		}
		public function getFechaHora()
		{
			return $this->fechaHora;
		}
		public function getNombreEquipo()
		{
			return $this->nombreEquipo;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idImpresion=0;
			$this->idTurno=0;
			$this->estatus='';
			$this->IP='';
			$this->fechaHora='';
			$this->nombreEquipo='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO impresion(idTurno,estatus,IP,fechaHora,nombreEquipo)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idTurno) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->IP) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaHora) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombreEquipo) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseImpresion::Insertar]");
				
				$this->idImpresion=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE impresion SET idTurno='" . mysqli_real_escape_string($this->dbLink,$this->idTurno) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',IP='" . mysqli_real_escape_string($this->dbLink,$this->IP) . "',fechaHora='" . mysqli_real_escape_string($this->dbLink,$this->fechaHora) . "',nombreEquipo='" . mysqli_real_escape_string($this->dbLink,$this->nombreEquipo) . "'
					WHERE idImpresion=" . $this->idImpresion;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseImpresion::Update]");
				
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
				$SQL="DELETE FROM impresion
				WHERE idImpresion=" . mysqli_real_escape_string($this->dbLink,$this->idImpresion);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseImpresion::Borrar]");
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
						idImpresion,idTurno,estatus,IP,fechaHora,nombreEquipo
					FROM impresion
					WHERE idImpresion=" . mysqli_real_escape_string($this->dbLink,$this->idImpresion);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseImpresion::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idImpresion==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>