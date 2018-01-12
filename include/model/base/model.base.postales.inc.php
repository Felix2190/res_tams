<?php

	class ModeloBasePostales extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBasePostales";

		
		var $d_codigo='';
		var $d_asenta='';
		var $d_tipo_asenta='';
		var $D_mnpio='';
		var $d_estado='';
		var $d_ciudad='';
		var $d_CP='';
		var $c_estado='';
		var $c_oficina='';
		var $c_CP='';
		var $c_tipo_asenta='';
		var $c_mnpio='';
		var $id_asenta_cpcons='';
		var $d_zona='';
		var $c_cve_ciudad='';
		var $idPostal=0;

		var $__s=array("d_codigo","d_asenta","d_tipo_asenta","D_mnpio","d_estado","d_ciudad","d_CP","c_estado","c_oficina","c_CP","c_tipo_asenta","c_mnpio","id_asenta_cpcons","d_zona","c_cve_ciudad","idPostal");
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

		
		public function setD_codigo($d_codigo)
		{
			
			$this->d_codigo=$d_codigo;
		}
		public function setD_asenta($d_asenta)
		{
			
			$this->d_asenta=$d_asenta;
		}
		public function setD_tipo_asenta($d_tipo_asenta)
		{
			
			$this->d_tipo_asenta=$d_tipo_asenta;
		}
		public function setD_mnpio($D_mnpio)
		{
			
			$this->D_mnpio=$D_mnpio;
		}
		public function setD_estado($d_estado)
		{
			
			$this->d_estado=$d_estado;
		}
		public function setD_ciudad($d_ciudad)
		{
			
			$this->d_ciudad=$d_ciudad;
		}
		public function setD_CP($d_CP)
		{
			
			$this->d_CP=$d_CP;
		}
		public function setC_estado($c_estado)
		{
			
			$this->c_estado=$c_estado;
		}
		public function setC_oficina($c_oficina)
		{
			
			$this->c_oficina=$c_oficina;
		}
		public function setC_CP($c_CP)
		{
			
			$this->c_CP=$c_CP;
		}
		public function setC_tipo_asenta($c_tipo_asenta)
		{
			
			$this->c_tipo_asenta=$c_tipo_asenta;
		}
		public function setC_mnpio($c_mnpio)
		{
			
			$this->c_mnpio=$c_mnpio;
		}
		public function setId_asenta_cpcons($id_asenta_cpcons)
		{
			
			$this->id_asenta_cpcons=$id_asenta_cpcons;
		}
		public function setD_zona($d_zona)
		{
			
			$this->d_zona=$d_zona;
		}
		public function setC_cve_ciudad($c_cve_ciudad)
		{
			
			$this->c_cve_ciudad=$c_cve_ciudad;
		}
		public function setIdPostal($idPostal)
		{
			if($idPostal==0||$idPostal==""||!is_numeric($idPostal)|| (is_string($idPostal)&&!ctype_digit($idPostal)))return $this->setError("Tipo de dato incorrecto para idPostal.");
			$this->idPostal=$idPostal;
			$this->getDatos();
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getD_codigo()
		{
			return $this->d_codigo;
		}
		public function getD_asenta()
		{
			return $this->d_asenta;
		}
		public function getD_tipo_asenta()
		{
			return $this->d_tipo_asenta;
		}
		public function getD_mnpio()
		{
			return $this->D_mnpio;
		}
		public function getD_estado()
		{
			return $this->d_estado;
		}
		public function getD_ciudad()
		{
			return $this->d_ciudad;
		}
		public function getD_CP()
		{
			return $this->d_CP;
		}
		public function getC_estado()
		{
			return $this->c_estado;
		}
		public function getC_oficina()
		{
			return $this->c_oficina;
		}
		public function getC_CP()
		{
			return $this->c_CP;
		}
		public function getC_tipo_asenta()
		{
			return $this->c_tipo_asenta;
		}
		public function getC_mnpio()
		{
			return $this->c_mnpio;
		}
		public function getId_asenta_cpcons()
		{
			return $this->id_asenta_cpcons;
		}
		public function getD_zona()
		{
			return $this->d_zona;
		}
		public function getC_cve_ciudad()
		{
			return $this->c_cve_ciudad;
		}
		public function getIdPostal()
		{
			return $this->idPostal;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->d_codigo='';
			$this->d_asenta='';
			$this->d_tipo_asenta='';
			$this->D_mnpio='';
			$this->d_estado='';
			$this->d_ciudad='';
			$this->d_CP='';
			$this->c_estado='';
			$this->c_oficina='';
			$this->c_CP='';
			$this->c_tipo_asenta='';
			$this->c_mnpio='';
			$this->id_asenta_cpcons='';
			$this->d_zona='';
			$this->c_cve_ciudad='';
			$this->idPostal=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO postales(d_codigo,d_asenta,d_tipo_asenta,D_mnpio,d_estado,d_ciudad,d_CP,c_estado,c_oficina,c_CP,c_tipo_asenta,c_mnpio,id_asenta_cpcons,d_zona,c_cve_ciudad)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->d_codigo) . "','" . mysqli_real_escape_string($this->dbLink,$this->d_asenta) . "','" . mysqli_real_escape_string($this->dbLink,$this->d_tipo_asenta) . "','" . mysqli_real_escape_string($this->dbLink,$this->D_mnpio) . "','" . mysqli_real_escape_string($this->dbLink,$this->d_estado) . "','" . mysqli_real_escape_string($this->dbLink,$this->d_ciudad) . "','" . mysqli_real_escape_string($this->dbLink,$this->d_CP) . "','" . mysqli_real_escape_string($this->dbLink,$this->c_estado) . "','" . mysqli_real_escape_string($this->dbLink,$this->c_oficina) . "','" . mysqli_real_escape_string($this->dbLink,$this->c_CP) . "','" . mysqli_real_escape_string($this->dbLink,$this->c_tipo_asenta) . "','" . mysqli_real_escape_string($this->dbLink,$this->c_mnpio) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_asenta_cpcons) . "','" . mysqli_real_escape_string($this->dbLink,$this->d_zona) . "','" . mysqli_real_escape_string($this->dbLink,$this->c_cve_ciudad) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePostales::Insertar]");
				
				$this->idPostal=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE postales SET d_codigo='" . mysqli_real_escape_string($this->dbLink,$this->d_codigo) . "',d_asenta='" . mysqli_real_escape_string($this->dbLink,$this->d_asenta) . "',d_tipo_asenta='" . mysqli_real_escape_string($this->dbLink,$this->d_tipo_asenta) . "',D_mnpio='" . mysqli_real_escape_string($this->dbLink,$this->D_mnpio) . "',d_estado='" . mysqli_real_escape_string($this->dbLink,$this->d_estado) . "',d_ciudad='" . mysqli_real_escape_string($this->dbLink,$this->d_ciudad) . "',d_CP='" . mysqli_real_escape_string($this->dbLink,$this->d_CP) . "',c_estado='" . mysqli_real_escape_string($this->dbLink,$this->c_estado) . "',c_oficina='" . mysqli_real_escape_string($this->dbLink,$this->c_oficina) . "',c_CP='" . mysqli_real_escape_string($this->dbLink,$this->c_CP) . "',c_tipo_asenta='" . mysqli_real_escape_string($this->dbLink,$this->c_tipo_asenta) . "',c_mnpio='" . mysqli_real_escape_string($this->dbLink,$this->c_mnpio) . "',id_asenta_cpcons='" . mysqli_real_escape_string($this->dbLink,$this->id_asenta_cpcons) . "',d_zona='" . mysqli_real_escape_string($this->dbLink,$this->d_zona) . "',c_cve_ciudad='" . mysqli_real_escape_string($this->dbLink,$this->c_cve_ciudad) . "'
					WHERE idPostal=" . $this->idPostal;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePostales::Update]");
				
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
				$SQL="DELETE FROM postales
				WHERE idPostal=" . mysqli_real_escape_string($this->dbLink,$this->idPostal);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePostales::Borrar]");
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
						d_codigo,d_asenta,d_tipo_asenta,D_mnpio,d_estado,d_ciudad,d_CP,c_estado,c_oficina,c_CP,c_tipo_asenta,c_mnpio,id_asenta_cpcons,d_zona,c_cve_ciudad,idPostal
					FROM postales
					WHERE idPostal=" . mysqli_real_escape_string($this->dbLink,$this->idPostal);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePostales::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idPostal==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>