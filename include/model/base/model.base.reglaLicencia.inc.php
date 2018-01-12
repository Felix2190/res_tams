<?php

	class ModeloBaseReglaLicencia extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseReglaLicencia";

		
		var $idReglaLicencia=0;
		var $idTipoLicencia=0;
		var $nombreRegla='';
		var $formatoSF001='';
		var $examenTransito='';
		var $identificacionOficial='';
		var $comprobanteDomicilio='';
		var $curp='';
		var $rfc='';
		var $actaNacimiento='';
		var $polizaSeguro='';
		var $cartaResponsiva='';
		var $identificacionPadreTutor='';
		var $formatoMigratorio='';
		var $constanciaLicenciaVigente='';
		var $licenciaAnterior='';
		var $estatus='';

		var $__s=array("idReglaLicencia","idTipoLicencia","nombreRegla","formatoSF001","examenTransito","identificacionOficial","comprobanteDomicilio","curp","rfc","actaNacimiento","polizaSeguro","cartaResponsiva","identificacionPadreTutor","formatoMigratorio","constanciaLicenciaVigente","licenciaAnterior","estatus");
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

		
		public function setIdReglaLicencia($idReglaLicencia)
		{
			if($idReglaLicencia==0||$idReglaLicencia==""||!is_numeric($idReglaLicencia)|| (is_string($idReglaLicencia)&&!ctype_digit($idReglaLicencia)))return $this->setError("Tipo de dato incorrecto para idReglaLicencia.");
			$this->idReglaLicencia=$idReglaLicencia;
			$this->getDatos();
		}
		public function setIdTipoLicencia($idTipoLicencia)
		{
			
			$this->idTipoLicencia=$idTipoLicencia;
		}
		public function setNombreRegla($nombreRegla)
		{
			
			$this->nombreRegla=$nombreRegla;
		}
		public function setFormatoSF001()
		{
			$this->formatoSF001=1;
		}
		public function setExamenTransito()
		{
			$this->examenTransito=1;
		}
		public function setIdentificacionOficial()
		{
			$this->identificacionOficial=1;
		}
		public function setComprobanteDomicilio()
		{
			$this->comprobanteDomicilio=1;
		}
		public function setCurp()
		{
			$this->curp=1;
		}
		public function setRfc()
		{
			$this->rfc=1;
		}
		public function setActaNacimiento()
		{
			$this->actaNacimiento=1;
		}
		public function setPolizaSeguro()
		{
			$this->polizaSeguro=1;
		}
		public function setCartaResponsiva()
		{
			$this->cartaResponsiva=1;
		}
		public function setIdentificacionPadreTutor()
		{
			$this->identificacionPadreTutor=1;
		}
		public function setFormatoMigratorio()
		{
			$this->formatoMigratorio=1;
		}
		public function setConstanciaLicenciaVigente()
		{
			$this->constanciaLicenciaVigente=1;
		}
		public function setLicenciaAnterior()
		{
			$this->licenciaAnterior=1;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusActivo()
		{
			$this->estatus='activo';
		}
		public function setEstatusInactivo()
		{
			$this->estatus='inactivo';
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetFormatoSF001()
		{
			$this->formatoSF001=0;
		}
		public function unsetExamenTransito()
		{
			$this->examenTransito=0;
		}
		public function unsetIdentificacionOficial()
		{
			$this->identificacionOficial=0;
		}
		public function unsetComprobanteDomicilio()
		{
			$this->comprobanteDomicilio=0;
		}
		public function unsetCurp()
		{
			$this->curp=0;
		}
		public function unsetRfc()
		{
			$this->rfc=0;
		}
		public function unsetActaNacimiento()
		{
			$this->actaNacimiento=0;
		}
		public function unsetPolizaSeguro()
		{
			$this->polizaSeguro=0;
		}
		public function unsetCartaResponsiva()
		{
			$this->cartaResponsiva=0;
		}
		public function unsetIdentificacionPadreTutor()
		{
			$this->identificacionPadreTutor=0;
		}
		public function unsetFormatoMigratorio()
		{
			$this->formatoMigratorio=0;
		}
		public function unsetConstanciaLicenciaVigente()
		{
			$this->constanciaLicenciaVigente=0;
		}
		public function unsetLicenciaAnterior()
		{
			$this->licenciaAnterior=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdReglaLicencia()
		{
			return $this->idReglaLicencia;
		}
		public function getIdTipoLicencia()
		{
			return $this->idTipoLicencia;
		}
		public function getNombreRegla()
		{
			return $this->nombreRegla;
		}
		public function getFormatoSF001()
		{
			return $this->formatoSF001;
		}
		public function getExamenTransito()
		{
			return $this->examenTransito;
		}
		public function getIdentificacionOficial()
		{
			return $this->identificacionOficial;
		}
		public function getComprobanteDomicilio()
		{
			return $this->comprobanteDomicilio;
		}
		public function getCurp()
		{
			return $this->curp;
		}
		public function getRfc()
		{
			return $this->rfc;
		}
		public function getActaNacimiento()
		{
			return $this->actaNacimiento;
		}
		public function getPolizaSeguro()
		{
			return $this->polizaSeguro;
		}
		public function getCartaResponsiva()
		{
			return $this->cartaResponsiva;
		}
		public function getIdentificacionPadreTutor()
		{
			return $this->identificacionPadreTutor;
		}
		public function getFormatoMigratorio()
		{
			return $this->formatoMigratorio;
		}
		public function getConstanciaLicenciaVigente()
		{
			return $this->constanciaLicenciaVigente;
		}
		public function getLicenciaAnterior()
		{
			return $this->licenciaAnterior;
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
			
			$this->idReglaLicencia=0;
			$this->idTipoLicencia=0;
			$this->nombreRegla='';
			$this->formatoSF001='';
			$this->examenTransito='';
			$this->identificacionOficial='';
			$this->comprobanteDomicilio='';
			$this->curp='';
			$this->rfc='';
			$this->actaNacimiento='';
			$this->polizaSeguro='';
			$this->cartaResponsiva='';
			$this->identificacionPadreTutor='';
			$this->formatoMigratorio='';
			$this->constanciaLicenciaVigente='';
			$this->licenciaAnterior='';
			$this->estatus='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO reglaLicencia(idTipoLicencia,nombreRegla,formatoSF001,examenTransito,identificacionOficial,comprobanteDomicilio,curp,rfc,actaNacimiento,polizaSeguro,cartaResponsiva,identificacionPadreTutor,formatoMigratorio,constanciaLicenciaVigente,licenciaAnterior,estatus)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idTipoLicencia) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombreRegla) . "','" . mysqli_real_escape_string($this->dbLink,$this->formatoSF001) . "','" . mysqli_real_escape_string($this->dbLink,$this->examenTransito) . "','" . mysqli_real_escape_string($this->dbLink,$this->identificacionOficial) . "','" . mysqli_real_escape_string($this->dbLink,$this->comprobanteDomicilio) . "','" . mysqli_real_escape_string($this->dbLink,$this->curp) . "','" . mysqli_real_escape_string($this->dbLink,$this->rfc) . "','" . mysqli_real_escape_string($this->dbLink,$this->actaNacimiento) . "','" . mysqli_real_escape_string($this->dbLink,$this->polizaSeguro) . "','" . mysqli_real_escape_string($this->dbLink,$this->cartaResponsiva) . "','" . mysqli_real_escape_string($this->dbLink,$this->identificacionPadreTutor) . "','" . mysqli_real_escape_string($this->dbLink,$this->formatoMigratorio) . "','" . mysqli_real_escape_string($this->dbLink,$this->constanciaLicenciaVigente) . "','" . mysqli_real_escape_string($this->dbLink,$this->licenciaAnterior) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseReglaLicencia::Insertar]");
				
				$this->idReglaLicencia=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE reglaLicencia SET idTipoLicencia='" . mysqli_real_escape_string($this->dbLink,$this->idTipoLicencia) . "',nombreRegla='" . mysqli_real_escape_string($this->dbLink,$this->nombreRegla) . "',formatoSF001='" . mysqli_real_escape_string($this->dbLink,$this->formatoSF001) . "',examenTransito='" . mysqli_real_escape_string($this->dbLink,$this->examenTransito) . "',identificacionOficial='" . mysqli_real_escape_string($this->dbLink,$this->identificacionOficial) . "',comprobanteDomicilio='" . mysqli_real_escape_string($this->dbLink,$this->comprobanteDomicilio) . "',curp='" . mysqli_real_escape_string($this->dbLink,$this->curp) . "',rfc='" . mysqli_real_escape_string($this->dbLink,$this->rfc) . "',actaNacimiento='" . mysqli_real_escape_string($this->dbLink,$this->actaNacimiento) . "',polizaSeguro='" . mysqli_real_escape_string($this->dbLink,$this->polizaSeguro) . "',cartaResponsiva='" . mysqli_real_escape_string($this->dbLink,$this->cartaResponsiva) . "',identificacionPadreTutor='" . mysqli_real_escape_string($this->dbLink,$this->identificacionPadreTutor) . "',formatoMigratorio='" . mysqli_real_escape_string($this->dbLink,$this->formatoMigratorio) . "',constanciaLicenciaVigente='" . mysqli_real_escape_string($this->dbLink,$this->constanciaLicenciaVigente) . "',licenciaAnterior='" . mysqli_real_escape_string($this->dbLink,$this->licenciaAnterior) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "'
					WHERE idReglaLicencia=" . $this->idReglaLicencia;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseReglaLicencia::Update]");
				
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
				$SQL="DELETE FROM reglaLicencia
				WHERE idReglaLicencia=" . mysqli_real_escape_string($this->dbLink,$this->idReglaLicencia);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseReglaLicencia::Borrar]");
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
						idReglaLicencia,idTipoLicencia,nombreRegla,formatoSF001,examenTransito,identificacionOficial,comprobanteDomicilio,curp,rfc,actaNacimiento,polizaSeguro,cartaResponsiva,identificacionPadreTutor,formatoMigratorio,constanciaLicenciaVigente,licenciaAnterior,estatus
					FROM reglaLicencia
					WHERE idReglaLicencia=" . mysqli_real_escape_string($this->dbLink,$this->idReglaLicencia);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseReglaLicencia::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idReglaLicencia==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>