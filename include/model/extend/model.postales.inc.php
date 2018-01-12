<?php

	require FOLDER_MODEL_BASE . "model.base.postales.inc.php";

	class ModeloPostales extends ModeloBasePostales
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBasePostales";

		var $__ss=array();

		#------------------------------------------------------------------------------------------------------#
		#--------------------------------------------Inicializacion--------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		function __construct()
		{
			parent::__construct();
		}

		function __destruct()
		{
			
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Setter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function getAllAsentamientosJSONByEntidadMunicipio($entidad, $municipio,$term)
		{
			$query="SELECT
						DISTINCT d_asenta AS asentamiento
					FROM postales 
					WHERE c_estado='" . mysqli_real_escape_string($this->dbLink,$entidad) . "' AND 
							c_mnpio='" . mysqli_real_escape_string($this->dbLink,$municipio) . "' AND
							d_asenta LIKE '%" . mysqli_real_escape_string($this->dbLink,$term) . "%'
							ORDER BY d_asenta ASC";
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las personas.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
				$arrRR=array();
				while($r=mysqli_fetch_assoc($result))
				{
					$arrR=array();
					$arrR['id']=$r['asentamiento'];
					$arrR['value']=$r['asentamiento'];
					$arrR['label']=$r['asentamiento'];
					$arrRR[]=$arrR;
				}
				return json_encode($arrRR);
					
					
					
		}
		
		public function getAllAsentamientosJSONByCP($cp,$term)
		{
			$query="SELECT
						DISTINCT d_asenta AS asentamiento
					FROM postales
					WHERE d_codigo='" . mysqli_real_escape_string($this->dbLink,$cp) . "' AND
							d_asenta LIKE '%" . mysqli_real_escape_string($this->dbLink,$term) . "%'
							ORDER BY d_asenta ASC";
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las personas.", "[" . $this->_nombreClase . ":ln81][" . $query . "][" . mysqli_error($this->dbLink) . "]");
				$arrRR=array();
				while($r=mysqli_fetch_assoc($result))
				{
					$arrR=array();
					$arrR['id']=$r['asentamiento'];
					$arrR['value']=$r['asentamiento'];
					$arrR['label']=$r['asentamiento'];
					$arrRR[]=$arrR;
				}
				return json_encode($arrRR);
					
					
					
		}
		
		public function getInfo($cp)
		{
		    $row=array(); 
			$query="SELECT idPostal,d_estado AS estado,D_mnpio AS municipio,d_ciudad,d_asenta,d_mnpio,d_tipo_asenta,c_estado,c_tipo_asenta,c_mnpio,d_zona FROM postales WHERE d_codigo='" . mysqli_real_escape_string($this->dbLink,$cp) . "'";
			mysqli_query($this->dbLink,"SET NAMES 'utf8'");// solucion en linux
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la consulta a la base de datos.", "[" . $this->_nombreClase . ":LN49][" . $query . "][" . mysqli_error($this->dbLink) . "]");
			$row=mysqli_fetch_assoc($result);
			return $row;
		}
		
		public function getAllAsentamientosByEntidadMunicipio($entidad, $municipio)
		{
		    $query="SELECT DISTINCT d_asenta AS asentamiento, idPostal
					FROM postales
					WHERE c_estado='" . mysqli_real_escape_string($this->dbLink,$entidad) . "' AND
							c_mnpio='" . mysqli_real_escape_string($this->dbLink,$municipio) . "'
							ORDER BY d_asenta ASC";
		    $result=mysqli_query($this->dbLink, $query);
		    if(!$result)
		        return $this->setSystemError("Ocurrio un error en la busqueda de las postales.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
		        $retorno = array();
		        while($r=mysqli_fetch_assoc($result))
		        {
		            $retorno[$r['idPostal']] = $r['asentamiento'];
		        }
		        return $retorno;
		}
		
		public function getAllAsentamientosByEntidadMunicipioCp($entidad, $municipio, $cp)
		{
			$query="SELECT DISTINCT d_asenta AS asentamiento, idPostal
					FROM postales
					WHERE c_estado='" . mysqli_real_escape_string($this->dbLink,$entidad) . "' AND
							c_mnpio='" . mysqli_real_escape_string($this->dbLink,$municipio) . "'
							AND d_codigo =" . mysqli_real_escape_string($this->dbLink,$cp) . " ORDER BY d_asenta ASC";
			mysqli_query($this->dbLink,"SET NAMES 'utf8'");// solucion en linux
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las postales.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
				$retorno = array();
				while($r=mysqli_fetch_assoc($result))
				{
						$retorno[$r['idPostal']] = $r['asentamiento'];					
				}													
					return $retorno;					
		}
		
		public function getCpByIdPostal($id)
		{
			$query="SELECT d_codigo FROM postales
					WHERE idPostal='" . mysqli_real_escape_string($this->dbLink,$id) . "' ";
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las postales.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
	
				if($r=mysqli_fetch_assoc($result))
				{
					return $r['d_codigo'];
				}
				
				return 0;
		}
		
		
		public function getAllCiudadesByIdPostal()
		{
			$query="SELECT idPostal, if(d_ciudad='',d_mnpio,d_ciudad) as ciudad FROM `postales`
							ORDER BY ciudad ASC";
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las postales.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
				$retorno = array();
				while($r=mysqli_fetch_assoc($result))
				{
					$retorno[$r['idPostal']] = utf8_encode($r['ciudad']);
				}
				return $retorno;
		}

		public function getCiudadesByEntidadMunicipio($entidad, $municipio)
		{
			$query="SELECT idPostal, if(d_ciudad='',d_mnpio,d_ciudad) as ciudad FROM `postales`
					WHERE c_estado='" . mysqli_real_escape_string($this->dbLink,$entidad) . "' AND
							c_mnpio='" . mysqli_real_escape_string($this->dbLink,$municipio) . "'
							GROUP BY d_mnpio,d_ciudad ORDER BY `d_ciudad` ASC  ";
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las personas.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
				$arrR=array();
				while($r=mysqli_fetch_assoc($result))
				{
					$arrR[$r['idPostal']]=utf8_encode($r['ciudad']);
						
				}
				return $arrR;
					
					
					
		}
		
		public function getCiudadesByEntidadMunicipioAC($entidad, $municipio)
		{
			$query="SELECT idPostal, d_ciudad,d_mnpio,d_ciudad  FROM `postales`
					WHERE c_estado='" . mysqli_real_escape_string($this->dbLink,$entidad) . "' AND
							c_mnpio='" . mysqli_real_escape_string($this->dbLink,$municipio) . "'
							GROUP BY d_mnpio,d_ciudad ORDER BY `d_ciudad` ASC ";
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las personas.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
				$arrR=array();
				while($r=mysqli_fetch_assoc($result))
				{
					$arrR[$r['idPostal']]=utf8_encode($r['d_ciudad']);
		
				}
				return $arrR;
					
					
					
		}
		
		public function getIdByIdPostal($id)
		{
			$query="SELECT d_codigo FROM postales
					WHERE idPostal='" . mysqli_real_escape_string($this->dbLink,$id) . "' ";
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las postales.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
		
				if($r=mysqli_fetch_assoc($result))
				{
					return $r['d_codigo'];
				}
		
				return 0;
		}
		
		
		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function validarDatos()
		{
			return true;
		}
		
		public function getCiudadAndColonia($idpostal)
		{
			$query="SELECT d_ciudad,d_asenta FROM postales WHERE idPostal='" . mysqli_real_escape_string($this->dbLink,$idpostal) . "'";
			mysqli_query($this->dbLink,"SET NAMES 'utf8'");// solucion en linux
			$result=mysqli_query($this->dbLink, $query);
			if($result)
				if ($row=mysqli_fetch_assoc($result))
					return $row;
			return array();
		}
		
	}

