<?php

	require FOLDER_MODEL_BASE . "model.base.servicios.inc.php";

	class ModeloServicios extends ModeloBaseServicios
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseServicios";
		var $_nombreTabla="servicios";
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



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		public function getListaServiciosByCodigo()
		{
			$id='codigo';
			$nombre='nombre';
			$query = "SELECT ".$id.",".$nombre." FROM ".$this->_nombreTabla." ORDER By ".$nombre." ASC";
			$result = mysqli_query($this->dbLink,$query);
			if (! $result)
				return $this->setSystemError(
						"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
						"[model.".$this->_nombreTabla."::LN36][" . $query . "][" . mysql_error() .
						"]");
				$retorno = array();
				while ($row = mysqli_fetch_assoc($result))
					$retorno[$row[$id]] = $row[$nombre];
					return $retorno;
		}
		
		public function getListaServiciosById()
		{
			$id='idServicio';
			$nombre='nombre';
			$query = "SELECT ".$id.",".$nombre." FROM ".$this->_nombreTabla." ORDER By ".$nombre." ASC";
			$result = mysqli_query($this->dbLink,$query);
			if (! $result)
				return $this->setSystemError(
						"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
						"[model.".$this->_nombreTabla."::LN36][" . $query . "][" . mysql_error() .
						"]");
				$retorno = array();
				while ($row = mysqli_fetch_assoc($result))
					$retorno[$row[$id]] = $row[$nombre];
					return $retorno;
		}
		
		public function validarDatos()
		{
			return true;
		}


	}

