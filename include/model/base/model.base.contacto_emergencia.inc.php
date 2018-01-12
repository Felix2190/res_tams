<?php

	class ModeloBaseContacto_emergencia extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseContacto_emergencia";

		
		var $idContacto=0;
		var $idPersona=0;
		var $nombre='';
		var $apellidoPaterno='';
		var $apellidoMaterno='';
		var $parentesco='';
		var $cveEnt='';
		var $cveMun='';
		var $cveLoc='';
		var $calle='';
		var $numeroExterrior='';
		var $numeroInterior='';
		var $colonia='';
		var $codigoPostal='';
		var $codigoPais='';
		var $ladaTel='';
		var $telefeno='';
		var $observaciones='';

		var $__s=array("idContacto","idPersona","nombre","apellidoPaterno","apellidoMaterno","parentesco","cveEnt","cveMun","cveLoc","calle","numeroExterrior","numeroInterior","colonia","codigoPostal","codigoPais","ladaTel","telefeno","observaciones");
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

		
		public function setIdContacto($idContacto)
		{
			if($idContacto==0||$idContacto==""||!is_numeric($idContacto)|| (is_string($idContacto)&&!ctype_digit($idContacto)))return $this->setError("Tipo de dato incorrecto para idContacto.");
			$this->idContacto=$idContacto;
			$this->getDatos();
		}
		public function setIdPersona($idPersona)
		{
			
			$this->idPersona=$idPersona;
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setApellidoPaterno($apellidoPaterno)
		{
			
			$this->apellidoPaterno=$apellidoPaterno;
		}
		public function setApellidoMaterno($apellidoMaterno)
		{
			
			$this->apellidoMaterno=$apellidoMaterno;
		}
		public function setParentesco($parentesco)
		{
			
			$this->parentesco=$parentesco;
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
		public function setCalle($calle)
		{
			
			$this->calle=$calle;
		}
		public function setNumeroExterrior($numeroExterrior)
		{
			
			$this->numeroExterrior=$numeroExterrior;
		}
		public function setNumeroInterior($numeroInterior)
		{
			$this->numeroInterior=$numeroInterior;
		}
		public function setColonia($colonia)
		{
			
			$this->colonia=$colonia;
		}
		public function setCodigoPostal($codigoPostal)
		{
			
			$this->codigoPostal=$codigoPostal;
		}
		public function setCodigoPais($codigoPais)
		{
			
			$this->codigoPais=$codigoPais;
		}
		public function setLadaTel($ladaTel)
		{
			
			$this->ladaTel=$ladaTel;
		}
		public function setTelefeno($telefeno)
		{
			
			$this->telefeno=$telefeno;
		}
		public function setObservaciones($observaciones)
		{
			$this->observaciones=$observaciones;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdContacto()
		{
			return $this->idContacto;
		}
		public function getIdPersona()
		{
			return $this->idPersona;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getApellidoPaterno()
		{
			return $this->apellidoPaterno;
		}
		public function getApellidoMaterno()
		{
			return $this->apellidoMaterno;
		}
		public function getParentesco()
		{
			return $this->parentesco;
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
		public function getCalle()
		{
			return $this->calle;
		}
		public function getNumeroExterrior()
		{
			return $this->numeroExterrior;
		}
		public function getNumeroInterior()
		{
			return $this->numeroInterior;
		}
		public function getColonia()
		{
			return $this->colonia;
		}
		public function getCodigoPostal()
		{
			return $this->codigoPostal;
		}
		public function getCodigoPais()
		{
			return $this->codigoPais;
		}
		public function getLadaTel()
		{
			return $this->ladaTel;
		}
		public function getTelefeno()
		{
			return $this->telefeno;
		}
		public function getObservaciones()
		{
			return $this->observaciones;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idContacto=0;
			$this->idPersona=0;
			$this->nombre='';
			$this->apellidoPaterno='';
			$this->apellidoMaterno='';
			$this->parentesco='';
			$this->cveEnt='';
			$this->cveMun='';
			$this->cveLoc='';
			$this->calle='';
			$this->numeroExterrior='';
			$this->numeroInterior='';
			$this->colonia='';
			$this->codigoPostal='';
			$this->codigoPais='';
			$this->ladaTel='';
			$this->telefeno='';
			$this->observaciones='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO contacto_emergencia(idPersona,nombre,apellidoPaterno,apellidoMaterno,parentesco,cveEnt,cveMun,cveLoc,calle,numeroExterrior,numeroInterior,colonia,codigoPostal,codigoPais,ladaTel,telefeno,observaciones)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idPersona) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->apellidoPaterno) . "','" . mysqli_real_escape_string($this->dbLink,$this->apellidoMaterno) . "','" . mysqli_real_escape_string($this->dbLink,$this->parentesco) . "','" . mysqli_real_escape_string($this->dbLink,$this->cveEnt) . "','" . mysqli_real_escape_string($this->dbLink,$this->cveMun) . "','" . mysqli_real_escape_string($this->dbLink,$this->cveLoc) . "','" . mysqli_real_escape_string($this->dbLink,$this->calle) . "','" . mysqli_real_escape_string($this->dbLink,$this->numeroExterrior) . "','" . mysqli_real_escape_string($this->dbLink,$this->numeroInterior) . "','" . mysqli_real_escape_string($this->dbLink,$this->colonia) . "','" . mysqli_real_escape_string($this->dbLink,$this->codigoPostal) . "','" . mysqli_real_escape_string($this->dbLink,$this->codigoPais) . "','" . mysqli_real_escape_string($this->dbLink,$this->ladaTel) . "','" . mysqli_real_escape_string($this->dbLink,$this->telefeno) . "','" . mysqli_real_escape_string($this->dbLink,$this->observaciones) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseContacto_emergencia::Insertar]");
				
				$this->idContacto=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE contacto_emergencia SET idPersona='" . mysqli_real_escape_string($this->dbLink,$this->idPersona) . "',nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',apellidoPaterno='" . mysqli_real_escape_string($this->dbLink,$this->apellidoPaterno) . "',apellidoMaterno='" . mysqli_real_escape_string($this->dbLink,$this->apellidoMaterno) . "',parentesco='" . mysqli_real_escape_string($this->dbLink,$this->parentesco) . "',cveEnt='" . mysqli_real_escape_string($this->dbLink,$this->cveEnt) . "',cveMun='" . mysqli_real_escape_string($this->dbLink,$this->cveMun) . "',cveLoc='" . mysqli_real_escape_string($this->dbLink,$this->cveLoc) . "',calle='" . mysqli_real_escape_string($this->dbLink,$this->calle) . "',numeroExterrior='" . mysqli_real_escape_string($this->dbLink,$this->numeroExterrior) . "',numeroInterior='" . mysqli_real_escape_string($this->dbLink,$this->numeroInterior) . "',colonia='" . mysqli_real_escape_string($this->dbLink,$this->colonia) . "',codigoPostal='" . mysqli_real_escape_string($this->dbLink,$this->codigoPostal) . "',codigoPais='" . mysqli_real_escape_string($this->dbLink,$this->codigoPais) . "',ladaTel='" . mysqli_real_escape_string($this->dbLink,$this->ladaTel) . "',telefeno='" . mysqli_real_escape_string($this->dbLink,$this->telefeno) . "',observaciones='" . mysqli_real_escape_string($this->dbLink,$this->observaciones) . "'
					WHERE idContacto=" . $this->idContacto;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseContacto_emergencia::Update]");
				
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
				$SQL="DELETE FROM contacto_emergencia
				WHERE idContacto=" . mysqli_real_escape_string($this->dbLink,$this->idContacto);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseContacto_emergencia::Borrar]");
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
						idContacto,idPersona,nombre,apellidoPaterno,apellidoMaterno,parentesco,cveEnt,cveMun,cveLoc,calle,numeroExterrior,numeroInterior,colonia,codigoPostal,codigoPais,ladaTel,telefeno,observaciones
					FROM contacto_emergencia
					WHERE idContacto=" . mysqli_real_escape_string($this->dbLink,$this->idContacto);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseContacto_emergencia::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idContacto==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>