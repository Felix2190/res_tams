<?php

	class ModeloBasePaises extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBasePaises";

		
		var $idPais=0;
		var $nombre='';
		var $name='';
		var $nom='';
		var $iso2='';
		var $iso3='';
		var $phone_code='';

		var $__s=array("idPais","nombre","name","nom","iso2","iso3","phone_code");
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

		
		public function setIdPais($idPais)
		{
			if($idPais==0||$idPais==""||!is_numeric($idPais)|| (is_string($idPais)&&!ctype_digit($idPais)))return $this->setError("Tipo de dato incorrecto para idPais.");
			$this->idPais=$idPais;
			$this->getDatos();
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setName($name)
		{
			
			$this->name=$name;
		}
		public function setNom($nom)
		{
			
			$this->nom=$nom;
		}
		public function setIso2($iso2)
		{
			
			$this->iso2=$iso2;
		}
		public function setIso3($iso3)
		{
			
			$this->iso3=$iso3;
		}
		public function setPhone_code($phone_code)
		{
			
			$this->phone_code=$phone_code;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdPais()
		{
			return $this->idPais;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getName()
		{
			return $this->name;
		}
		public function getNom()
		{
			return $this->nom;
		}
		public function getIso2()
		{
			return $this->iso2;
		}
		public function getIso3()
		{
			return $this->iso3;
		}
		public function getPhone_code()
		{
			return $this->phone_code;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idPais=0;
			$this->nombre='';
			$this->name='';
			$this->nom='';
			$this->iso2='';
			$this->iso3='';
			$this->phone_code='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO paises(nombre,name,nom,iso2,iso3,phone_code)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->name) . "','" . mysqli_real_escape_string($this->dbLink,$this->nom) . "','" . mysqli_real_escape_string($this->dbLink,$this->iso2) . "','" . mysqli_real_escape_string($this->dbLink,$this->iso3) . "','" . mysqli_real_escape_string($this->dbLink,$this->phone_code) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePaises::Insertar]");
				
				$this->idPais=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE paises SET nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',name='" . mysqli_real_escape_string($this->dbLink,$this->name) . "',nom='" . mysqli_real_escape_string($this->dbLink,$this->nom) . "',iso2='" . mysqli_real_escape_string($this->dbLink,$this->iso2) . "',iso3='" . mysqli_real_escape_string($this->dbLink,$this->iso3) . "',phone_code='" . mysqli_real_escape_string($this->dbLink,$this->phone_code) . "'
					WHERE idPais=" . $this->idPais;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePaises::Update]");
				
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
				$SQL="DELETE FROM paises
				WHERE idPais=" . mysqli_real_escape_string($this->dbLink,$this->idPais);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePaises::Borrar]");
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
						idPais,nombre,name,nom,iso2,iso3,phone_code
					FROM paises
					WHERE idPais=" . mysqli_real_escape_string($this->dbLink,$this->idPais);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePaises::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idPais==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>