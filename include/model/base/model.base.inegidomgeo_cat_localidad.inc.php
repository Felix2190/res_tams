<?php

	class ModeloBaseInegidomgeo_cat_localidad extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseInegidomgeo_cat_localidad";

		
		var $CVE_ENT='';
		var $CVE_MUN='';
		var $CVE_LOC='';
		var $CVE_PERIODO='';
		var $NOM_LOC='';
		var $AMBITO='';
		var $AGREGADA='';

		var $__s=array("CVE_ENT","CVE_MUN","CVE_LOC","CVE_PERIODO","NOM_LOC","AMBITO","AGREGADA");
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

		
		public function setCVE_ENT($CVE_ENT)
		{
			if(trim($CVE_ENT)=="")return $this->setError("El valor CVE_ENT no puede ser vacio.");
			$this->CVE_ENT=$CVE_ENT;
			$this->getDatos();
		}
		public function setCVE_MUN($CVE_MUN)
		{
			if(trim($CVE_MUN)=="")return $this->setError("El valor CVE_MUN no puede ser vacio.");
			$this->CVE_MUN=$CVE_MUN;
			$this->getDatos();
		}
		public function setCVE_LOC($CVE_LOC)
		{
			if(trim($CVE_LOC)=="")return $this->setError("El valor CVE_LOC no puede ser vacio.");
			$this->CVE_LOC=$CVE_LOC;
			$this->getDatos();
		}
		public function setCVE_PERIODO($CVE_PERIODO)
		{
			$this->CVE_PERIODO=$CVE_PERIODO;
		}
		public function setNOM_LOC($NOM_LOC)
		{
			
			$this->NOM_LOC=$NOM_LOC;
		}
		public function setAMBITO($AMBITO)
		{
			$this->AMBITO=$AMBITO;
		}
		public function setAGREGADA($AGREGADA)
		{
			
			$this->AGREGADA=$AGREGADA;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getCVE_ENT()
		{
			return $this->CVE_ENT;
		}
		public function getCVE_MUN()
		{
			return $this->CVE_MUN;
		}
		public function getCVE_LOC()
		{
			return $this->CVE_LOC;
		}
		public function getCVE_PERIODO()
		{
			return $this->CVE_PERIODO;
		}
		public function getNOM_LOC()
		{
			return $this->NOM_LOC;
		}
		public function getAMBITO()
		{
			return $this->AMBITO;
		}
		public function getAGREGADA()
		{
			return $this->AGREGADA;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->CVE_ENT='';
			$this->CVE_MUN='';
			$this->CVE_LOC='';
			$this->CVE_PERIODO='';
			$this->NOM_LOC='';
			$this->AMBITO='';
			$this->AGREGADA='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO inegidomgeo_cat_localidad(CVE_ENT,CVE_MUN,CVE_PERIODO,NOM_LOC,AMBITO,AGREGADA)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->CVE_ENT) . "','" . mysqli_real_escape_string($this->dbLink,$this->CVE_MUN) . "','" . mysqli_real_escape_string($this->dbLink,$this->CVE_PERIODO) . "','" . mysqli_real_escape_string($this->dbLink,$this->NOM_LOC) . "','" . mysqli_real_escape_string($this->dbLink,$this->AMBITO) . "','" . mysqli_real_escape_string($this->dbLink,$this->AGREGADA) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseInegidomgeo_cat_localidad::Insertar]");
				
				$this->CVE_LOC=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE inegidomgeo_cat_localidad SET CVE_ENT='" . mysqli_real_escape_string($this->dbLink,$this->CVE_ENT) . "',CVE_MUN='" . mysqli_real_escape_string($this->dbLink,$this->CVE_MUN) . "',CVE_PERIODO='" . mysqli_real_escape_string($this->dbLink,$this->CVE_PERIODO) . "',NOM_LOC='" . mysqli_real_escape_string($this->dbLink,$this->NOM_LOC) . "',AMBITO='" . mysqli_real_escape_string($this->dbLink,$this->AMBITO) . "',AGREGADA='" . mysqli_real_escape_string($this->dbLink,$this->AGREGADA) . "'
					WHERE CVE_LOC=" . $this->CVE_LOC;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseInegidomgeo_cat_localidad::Update]");
				
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
				$SQL="DELETE FROM inegidomgeo_cat_localidad
				WHERE CVE_LOC=" . mysqli_real_escape_string($this->dbLink,$this->CVE_LOC);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseInegidomgeo_cat_localidad::Borrar]");
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
						CVE_ENT,CVE_MUN,CVE_LOC,CVE_PERIODO,NOM_LOC,AMBITO,AGREGADA
					FROM inegidomgeo_cat_localidad
					WHERE CVE_LOC=" . mysqli_real_escape_string($this->dbLink,$this->CVE_LOC);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseInegidomgeo_cat_localidad::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->CVE_LOC==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>