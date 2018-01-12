<?php

	class ModeloBaseTipolicencia extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseTipolicencia";

		
		var $idTipoLicencia=0;
		var $tipo='';
		var $descripcion='';
		var $notas='';
		var $periodo=0;
		var $tipoTramite='';
		var $nuevaCosto='';
		var $revalidacionCosto='';
		var $reposicionCosto='';
		var $restriccionLicencia='';

		var $__s=array("idTipoLicencia","tipo","descripcion","notas","periodo","tipoTramite","nuevaCosto","revalidacionCosto","reposicionCosto","restriccionLicencia");
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

		
		public function setIdTipoLicencia($idTipoLicencia)
		{
			if($idTipoLicencia==0||$idTipoLicencia==""||!is_numeric($idTipoLicencia)|| (is_string($idTipoLicencia)&&!ctype_digit($idTipoLicencia)))return $this->setError("Tipo de dato incorrecto para idTipoLicencia.");
			$this->idTipoLicencia=$idTipoLicencia;
			$this->getDatos();
		}
		public function setTipo($tipo)
		{
			
			$this->tipo=$tipo;
		}
		public function setDescripcion($descripcion)
		{
			
			$this->descripcion=$descripcion;
		}
		public function setNotas($notas)
		{
			$this->notas=$notas;
		}
		public function setPeriodo($periodo)
		{
			
			$this->periodo=$periodo;
		}
		public function setTipoTramite($tipoTramite)
		{
			
			$this->tipoTramite=$tipoTramite;
		}
		public function setTipoTramiteNueva()
		{
			$this->tipoTramite='nueva';
		}
		public function setTipoTramiteRevalidacion()
		{
			$this->tipoTramite='revalidacion';
		}
		public function setTipoTramiteReposicion()
		{
			$this->tipoTramite='reposicion';
		}
		public function setNuevaCosto($nuevaCosto)
		{
			$this->nuevaCosto=$nuevaCosto;
		}
		public function setRevalidacionCosto($revalidacionCosto)
		{
			$this->revalidacionCosto=$revalidacionCosto;
		}
		public function setReposicionCosto($reposicionCosto)
		{
			$this->reposicionCosto=$reposicionCosto;
		}
		public function setRestriccionLicencia($restriccionLicencia)
		{
			
			$this->restriccionLicencia=$restriccionLicencia;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdTipoLicencia()
		{
			return $this->idTipoLicencia;
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getDescripcion()
		{
			return $this->descripcion;
		}
		public function getNotas()
		{
			return $this->notas;
		}
		public function getPeriodo()
		{
			return $this->periodo;
		}
		public function getTipoTramite()
		{
			return $this->tipoTramite;
		}
		public function getNuevaCosto()
		{
			return $this->nuevaCosto;
		}
		public function getRevalidacionCosto()
		{
			return $this->revalidacionCosto;
		}
		public function getReposicionCosto()
		{
			return $this->reposicionCosto;
		}
		public function getRestriccionLicencia()
		{
			return $this->restriccionLicencia;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idTipoLicencia=0;
			$this->tipo='';
			$this->descripcion='';
			$this->notas='';
			$this->periodo=0;
			$this->tipoTramite='';
			$this->nuevaCosto='';
			$this->revalidacionCosto='';
			$this->reposicionCosto='';
			$this->restriccionLicencia='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO tipolicencia(tipo,descripcion,notas,periodo,tipoTramite,nuevaCosto,revalidacionCosto,reposicionCosto,restriccionLicencia)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "','" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->notas) . "','" . mysqli_real_escape_string($this->dbLink,$this->periodo) . "','" . mysqli_real_escape_string($this->dbLink,$this->tipoTramite) . "','" . mysqli_real_escape_string($this->dbLink,$this->nuevaCosto) . "','" . mysqli_real_escape_string($this->dbLink,$this->revalidacionCosto) . "','" . mysqli_real_escape_string($this->dbLink,$this->reposicionCosto) . "','" . mysqli_real_escape_string($this->dbLink,$this->restriccionLicencia) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseTipolicencia::Insertar]");
				
				$this->idTipoLicencia=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE tipolicencia SET tipo='" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "',descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "',notas='" . mysqli_real_escape_string($this->dbLink,$this->notas) . "',periodo='" . mysqli_real_escape_string($this->dbLink,$this->periodo) . "',tipoTramite='" . mysqli_real_escape_string($this->dbLink,$this->tipoTramite) . "',nuevaCosto='" . mysqli_real_escape_string($this->dbLink,$this->nuevaCosto) . "',revalidacionCosto='" . mysqli_real_escape_string($this->dbLink,$this->revalidacionCosto) . "',reposicionCosto='" . mysqli_real_escape_string($this->dbLink,$this->reposicionCosto) . "',restriccionLicencia='" . mysqli_real_escape_string($this->dbLink,$this->restriccionLicencia) . "'
					WHERE idTipoLicencia=" . $this->idTipoLicencia;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTipolicencia::Update]");
				
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
				$SQL="DELETE FROM tipolicencia
				WHERE idTipoLicencia=" . mysqli_real_escape_string($this->dbLink,$this->idTipoLicencia);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTipolicencia::Borrar]");
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
						idTipoLicencia,tipo,descripcion,notas,periodo,tipoTramite,nuevaCosto,revalidacionCosto,reposicionCosto,restriccionLicencia
					FROM tipolicencia
					WHERE idTipoLicencia=" . mysqli_real_escape_string($this->dbLink,$this->idTipoLicencia);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTipolicencia::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idTipoLicencia==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>