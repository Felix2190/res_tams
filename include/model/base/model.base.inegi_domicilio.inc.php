<?php

	class ModeloBaseInegi_domicilio extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseInegi_domicilio";

		
		var $idDomicilio=0;
		var $nombreCalle='';
		var $numeroExterior=0;
		var $numeroInterior='';
		var $colonia='';
		var $cveEnt='';
		var $cveMun='';
		var $cveLoc='';
		var $codigoPostal='';

		var $__s=array("idDomicilio","nombreCalle","numeroExterior","numeroInterior","colonia","cveEnt","cveMun","cveLoc","codigoPostal");
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

		
		public function setIdDomicilio($idDomicilio)
		{
			if($idDomicilio==0||$idDomicilio==""||!is_numeric($idDomicilio)|| (is_string($idDomicilio)&&!ctype_digit($idDomicilio)))return $this->setError("Tipo de dato incorrecto para idDomicilio.");
			$this->idDomicilio=$idDomicilio;
			$this->getDatos();
		}
		public function setNombreCalle($nombreCalle)
		{
			
			$this->nombreCalle=$nombreCalle;
		}
		public function setNumeroExterior($numeroExterior)
		{
			
			$this->numeroExterior=$numeroExterior;
		}
		public function setNumeroInterior($numeroInterior)
		{
			$this->numeroInterior=$numeroInterior;
		}
		public function setColonia($colonia)
		{
			
			$this->colonia=$colonia;
		}
		public function setCveEnt($cveEnt)
		{
			
			$this->cveEnt=$cveEnt;
		}
		public function setCveMun($cveMun)
		{
			
			$this->cveMun=$cveMun;
		}
		public function setCveLoc($cveLoc)
		{
			
			$this->cveLoc=$cveLoc;
		}
		public function setCodigoPostal($codigoPostal)
		{
			
			$this->codigoPostal=$codigoPostal;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdDomicilio()
		{
			return $this->idDomicilio;
		}
		public function getNombreCalle()
		{
			return $this->nombreCalle;
		}
		public function getNumeroExterior()
		{
			return $this->numeroExterior;
		}
		public function getNumeroInterior()
		{
			return $this->numeroInterior;
		}
		public function getColonia()
		{
			return $this->colonia;
		}
		public function getCveEnt()
		{
			return $this->cveEnt;
		}
		public function getCveMun()
		{
			return $this->cveMun;
		}
		public function getCveLoc()
		{
			return $this->cveLoc;
		}
		public function getCodigoPostal()
		{
			return $this->codigoPostal;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idDomicilio=0;
			$this->nombreCalle='';
			$this->numeroExterior=0;
			$this->numeroInterior='';
			$this->colonia='';
			$this->cveEnt='';
			$this->cveMun='';
			$this->cveLoc='';
			$this->codigoPostal='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO inegi_domicilio(nombreCalle,numeroExterior,numeroInterior,colonia,cveEnt,cveMun,cveLoc,codigoPostal)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->nombreCalle) . "','" . mysqli_real_escape_string($this->dbLink,$this->numeroExterior) . "','" . mysqli_real_escape_string($this->dbLink,$this->numeroInterior) . "','" . mysqli_real_escape_string($this->dbLink,$this->colonia) . "','" . mysqli_real_escape_string($this->dbLink,$this->cveEnt) . "','" . mysqli_real_escape_string($this->dbLink,$this->cveMun) . "','" . mysqli_real_escape_string($this->dbLink,$this->cveLoc) . "','" . mysqli_real_escape_string($this->dbLink,$this->codigoPostal) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseInegi_domicilio::Insertar]");
				
				$this->idDomicilio=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE inegi_domicilio SET nombreCalle='" . mysqli_real_escape_string($this->dbLink,$this->nombreCalle) . "',numeroExterior='" . mysqli_real_escape_string($this->dbLink,$this->numeroExterior) . "',numeroInterior='" . mysqli_real_escape_string($this->dbLink,$this->numeroInterior) . "',colonia='" . mysqli_real_escape_string($this->dbLink,$this->colonia) . "',cveEnt='" . mysqli_real_escape_string($this->dbLink,$this->cveEnt) . "',cveMun='" . mysqli_real_escape_string($this->dbLink,$this->cveMun) . "',cveLoc='" . mysqli_real_escape_string($this->dbLink,$this->cveLoc) . "',codigoPostal='" . mysqli_real_escape_string($this->dbLink,$this->codigoPostal) . "'
					WHERE idDomicilio=" . $this->idDomicilio;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseInegi_domicilio::Update]");
				
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
				$SQL="DELETE FROM inegi_domicilio
				WHERE idDomicilio=" . mysqli_real_escape_string($this->dbLink,$this->idDomicilio);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseInegi_domicilio::Borrar]");
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
						idDomicilio,nombreCalle,numeroExterior,numeroInterior,colonia,cveEnt,cveMun,cveLoc,codigoPostal
					FROM inegi_domicilio
					WHERE idDomicilio=" . mysqli_real_escape_string($this->dbLink,$this->idDomicilio);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseInegi_domicilio::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idDomicilio==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>