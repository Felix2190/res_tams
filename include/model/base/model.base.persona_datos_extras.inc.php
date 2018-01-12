<?php

	class ModeloBasePersona_datos_extras extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBasePersona_datos_extras";

		
		var $IdPersonaDatosExtras=0;
		var $idPersona=0;
		var $colorOjos='';
		var $colorCabello='';
		var $estatura=0;
		var $peso='';
		var $impresionSangre='0';
		var $tipoSangre='nosabe';
		var $certificadoMedico='';
		var $senasParticulares='';
		var $jubilacionNumAfiliacion='';
		var $jubilacionFechaAfiliacion='';
		var $jubilacionInstiitucion='';
		var $usaLentes='0';
		var $donaOrganos='0';
		var $usaTransmisionAutomat1ica='0';
		var $equipadoConductorDiscapacitado='0';
		var $equipadoConductorProtesis='0';
		var $completo='0';

		var $__s=array("IdPersonaDatosExtras","idPersona","colorOjos","colorCabello","estatura","peso","impresionSangre","tipoSangre","certificadoMedico","senasParticulares","jubilacionNumAfiliacion","jubilacionFechaAfiliacion","jubilacionInstiitucion","usaLentes","donaOrganos","usaTransmisionAutomat1ica","equipadoConductorDiscapacitado","equipadoConductorProtesis","completo");
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

		
		public function setIdPersonaDatosExtras($IdPersonaDatosExtras)
		{
			if($IdPersonaDatosExtras==0||$IdPersonaDatosExtras==""||!is_numeric($IdPersonaDatosExtras)|| (is_string($IdPersonaDatosExtras)&&!ctype_digit($IdPersonaDatosExtras)))return $this->setError("Tipo de dato incorrecto para IdPersonaDatosExtras.");
			$this->IdPersonaDatosExtras=$IdPersonaDatosExtras;
			$this->getDatos();
		}
		public function setIdPersona($idPersona)
		{
			
			$this->idPersona=$idPersona;
		}
		public function setColorOjos($colorOjos)
		{
			
			$this->colorOjos=$colorOjos;
		}
		public function setColorCabello($colorCabello)
		{
			
			$this->colorCabello=$colorCabello;
		}
		public function setEstatura($estatura)
		{
			
			$this->estatura=$estatura;
		}
		public function setPeso($peso)
		{
			$this->peso=$peso;
		}
		public function setImpresionSangre()
		{
			$this->impresionSangre=1;
		}
		public function setTipoSangre($tipoSangre)
		{
			
			$this->tipoSangre=$tipoSangre;
		}
		public function setTipoSangreOpos()
		{
			$this->tipoSangre='Opos';
		}
		public function setTipoSangreOneg()
		{
			$this->tipoSangre='Oneg';
		}
		public function setTipoSangreApos()
		{
			$this->tipoSangre='Apos';
		}
		public function setTipoSangreAneg()
		{
			$this->tipoSangre='Aneg';
		}
		public function setTipoSangreABpos()
		{
			$this->tipoSangre='ABpos';
		}
		public function setTipoSangreABneg()
		{
			$this->tipoSangre='ABneg';
		}
		public function setTipoSangreNosabe()
		{
			$this->tipoSangre='nosabe';
		}
		public function setCertificadoMedico()
		{
			$this->certificadoMedico=1;
		}
		public function setSenasParticulares($senasParticulares)
		{
			$this->senasParticulares=$senasParticulares;
		}
		public function setJubilacionNumAfiliacion($jubilacionNumAfiliacion)
		{
			
			$this->jubilacionNumAfiliacion=$jubilacionNumAfiliacion;
		}
		public function setJubilacionFechaAfiliacion($jubilacionFechaAfiliacion)
		{
			$this->jubilacionFechaAfiliacion=$jubilacionFechaAfiliacion;
		}
		public function setJubilacionInstiitucion($jubilacionInstiitucion)
		{
			
			$this->jubilacionInstiitucion=$jubilacionInstiitucion;
		}
		public function setUsaLentes()
		{
			$this->usaLentes=1;
		}
		public function setDonaOrganos()
		{
			$this->donaOrganos=1;
		}
		public function setUsaTransmisionAutomat1ica()
		{
			$this->usaTransmisionAutomat1ica=1;
		}
		public function setEquipadoConductorDiscapacitado()
		{
			$this->equipadoConductorDiscapacitado=1;
		}
		public function setEquipadoConductorProtesis()
		{
			$this->equipadoConductorProtesis=1;
		}
		public function setCompleto()
		{
			$this->completo=1;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetImpresionSangre()
		{
			$this->impresionSangre=0;
		}
		public function unsetCertificadoMedico()
		{
			$this->certificadoMedico=0;
		}
		public function unsetUsaLentes()
		{
			$this->usaLentes=0;
		}
		public function unsetDonaOrganos()
		{
			$this->donaOrganos=0;
		}
		public function unsetUsaTransmisionAutomat1ica()
		{
			$this->usaTransmisionAutomat1ica=0;
		}
		public function unsetEquipadoConductorDiscapacitado()
		{
			$this->equipadoConductorDiscapacitado=0;
		}
		public function unsetEquipadoConductorProtesis()
		{
			$this->equipadoConductorProtesis=0;
		}
		public function unsetCompleto()
		{
			$this->completo=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdPersonaDatosExtras()
		{
			return $this->IdPersonaDatosExtras;
		}
		public function getIdPersona()
		{
			return $this->idPersona;
		}
		public function getColorOjos()
		{
			return $this->colorOjos;
		}
		public function getColorCabello()
		{
			return $this->colorCabello;
		}
		public function getEstatura()
		{
			return $this->estatura;
		}
		public function getPeso()
		{
			return $this->peso;
		}
		public function getImpresionSangre()
		{
			return $this->impresionSangre;
		}
		public function getTipoSangre()
		{
			return $this->tipoSangre;
		}
		public function getCertificadoMedico()
		{
			return $this->certificadoMedico;
		}
		public function getSenasParticulares()
		{
			return $this->senasParticulares;
		}
		public function getJubilacionNumAfiliacion()
		{
			return $this->jubilacionNumAfiliacion;
		}
		public function getJubilacionFechaAfiliacion()
		{
			return $this->jubilacionFechaAfiliacion;
		}
		public function getJubilacionInstiitucion()
		{
			return $this->jubilacionInstiitucion;
		}
		public function getUsaLentes()
		{
			return $this->usaLentes;
		}
		public function getDonaOrganos()
		{
			return $this->donaOrganos;
		}
		public function getUsaTransmisionAutomat1ica()
		{
			return $this->usaTransmisionAutomat1ica;
		}
		public function getEquipadoConductorDiscapacitado()
		{
			return $this->equipadoConductorDiscapacitado;
		}
		public function getEquipadoConductorProtesis()
		{
			return $this->equipadoConductorProtesis;
		}
		public function getCompleto()
		{
			return $this->completo;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->IdPersonaDatosExtras=0;
			$this->idPersona=0;
			$this->colorOjos='';
			$this->colorCabello='';
			$this->estatura=0;
			$this->peso='';
			$this->impresionSangre='0';
			$this->tipoSangre='nosabe';
			$this->certificadoMedico='';
			$this->senasParticulares='';
			$this->jubilacionNumAfiliacion='';
			$this->jubilacionFechaAfiliacion='';
			$this->jubilacionInstiitucion='';
			$this->usaLentes='0';
			$this->donaOrganos='0';
			$this->usaTransmisionAutomat1ica='0';
			$this->equipadoConductorDiscapacitado='0';
			$this->equipadoConductorProtesis='0';
			$this->completo='0';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO persona_datos_extras(idPersona,colorOjos,colorCabello,estatura,peso,impresionSangre,tipoSangre,certificadoMedico,senasParticulares,jubilacionNumAfiliacion,jubilacionFechaAfiliacion,jubilacionInstiitucion,usaLentes,donaOrganos,usaTransmisionAutomat1ica,equipadoConductorDiscapacitado,equipadoConductorProtesis,completo)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idPersona) . "','" . mysqli_real_escape_string($this->dbLink,$this->colorOjos) . "','" . mysqli_real_escape_string($this->dbLink,$this->colorCabello) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatura) . "','" . mysqli_real_escape_string($this->dbLink,$this->peso) . "','" . mysqli_real_escape_string($this->dbLink,$this->impresionSangre) . "','" . mysqli_real_escape_string($this->dbLink,$this->tipoSangre) . "','" . mysqli_real_escape_string($this->dbLink,$this->certificadoMedico) . "','" . mysqli_real_escape_string($this->dbLink,$this->senasParticulares) . "','" . mysqli_real_escape_string($this->dbLink,$this->jubilacionNumAfiliacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->jubilacionFechaAfiliacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->jubilacionInstiitucion) . "','" . mysqli_real_escape_string($this->dbLink,$this->usaLentes) . "','" . mysqli_real_escape_string($this->dbLink,$this->donaOrganos) . "','" . mysqli_real_escape_string($this->dbLink,$this->usaTransmisionAutomat1ica) . "','" . mysqli_real_escape_string($this->dbLink,$this->equipadoConductorDiscapacitado) . "','" . mysqli_real_escape_string($this->dbLink,$this->equipadoConductorProtesis) . "','" . mysqli_real_escape_string($this->dbLink,$this->completo) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePersona_datos_extras::Insertar]");
				
				$this->IdPersonaDatosExtras=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE persona_datos_extras SET idPersona='" . mysqli_real_escape_string($this->dbLink,$this->idPersona) . "',colorOjos='" . mysqli_real_escape_string($this->dbLink,$this->colorOjos) . "',colorCabello='" . mysqli_real_escape_string($this->dbLink,$this->colorCabello) . "',estatura='" . mysqli_real_escape_string($this->dbLink,$this->estatura) . "',peso='" . mysqli_real_escape_string($this->dbLink,$this->peso) . "',impresionSangre='" . mysqli_real_escape_string($this->dbLink,$this->impresionSangre) . "',tipoSangre='" . mysqli_real_escape_string($this->dbLink,$this->tipoSangre) . "',certificadoMedico='" . mysqli_real_escape_string($this->dbLink,$this->certificadoMedico) . "',senasParticulares='" . mysqli_real_escape_string($this->dbLink,$this->senasParticulares) . "',jubilacionNumAfiliacion='" . mysqli_real_escape_string($this->dbLink,$this->jubilacionNumAfiliacion) . "',jubilacionFechaAfiliacion='" . mysqli_real_escape_string($this->dbLink,$this->jubilacionFechaAfiliacion) . "',jubilacionInstiitucion='" . mysqli_real_escape_string($this->dbLink,$this->jubilacionInstiitucion) . "',usaLentes='" . mysqli_real_escape_string($this->dbLink,$this->usaLentes) . "',donaOrganos='" . mysqli_real_escape_string($this->dbLink,$this->donaOrganos) . "',usaTransmisionAutomat1ica='" . mysqli_real_escape_string($this->dbLink,$this->usaTransmisionAutomat1ica) . "',equipadoConductorDiscapacitado='" . mysqli_real_escape_string($this->dbLink,$this->equipadoConductorDiscapacitado) . "',equipadoConductorProtesis='" . mysqli_real_escape_string($this->dbLink,$this->equipadoConductorProtesis) . "',completo='" . mysqli_real_escape_string($this->dbLink,$this->completo) . "'
					WHERE IdPersonaDatosExtras=" . $this->IdPersonaDatosExtras;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePersona_datos_extras::Update]");
				
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
				$SQL="DELETE FROM persona_datos_extras
				WHERE IdPersonaDatosExtras=" . mysqli_real_escape_string($this->dbLink,$this->IdPersonaDatosExtras);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePersona_datos_extras::Borrar]");
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
						IdPersonaDatosExtras,idPersona,colorOjos,colorCabello,estatura,peso,impresionSangre,tipoSangre,certificadoMedico,senasParticulares,jubilacionNumAfiliacion,jubilacionFechaAfiliacion,jubilacionInstiitucion,usaLentes,donaOrganos,usaTransmisionAutomat1ica,equipadoConductorDiscapacitado,equipadoConductorProtesis,completo
					FROM persona_datos_extras
					WHERE IdPersonaDatosExtras=" . mysqli_real_escape_string($this->dbLink,$this->IdPersonaDatosExtras);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePersona_datos_extras::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->IdPersonaDatosExtras==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>