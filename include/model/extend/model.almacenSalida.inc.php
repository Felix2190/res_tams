<?php

	require FOLDER_MODEL_BASE . "model.base.almacenSalida.inc.php";

	class ModeloAlmacenSalida extends ModeloBaseAlmacenSalida
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseAlmacenSalida";

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

		public function buscarByFolio($folio)		{
			$f=mysqli_real_escape_string($this->dbLink, $folio);
			$query = "SELECT count(*) As cuenta FROM almacenSalida 
			where folio = '$f' and estatus ='disponible' ";
			$result = mysqli_query($this->dbLink,$query);
			//echo $query;
			if (! $result)
				return $this->setSystemError(
						"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
						"[model.almacenSalida::LN36][" . $query . "][" . mysql_error() .
						"]");
		
				$r=mysqli_fetch_assoc($result);
				if($r['cuenta']>0)
					return true;
					return false;
		}	
		
		public function buscarByNoSerie($serie)		{
			$f=mysqli_real_escape_string($this->dbLink, $serie);
			$query = "SELECT count(*) As cuenta FROM almacenSalida as at 
			left join almacen as a on a.idalmacen = at.idalmacen
			where a.numeroSerie = '$f' and at.estatus ='disponible'";
			$result = mysqli_query($this->dbLink,$query);
			//echo $query;
			if (! $result)
				return $this->setSystemError(
						"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
						"[model.almacen::LN36][" . $query . "][" . mysql_error() .
						"]");
		
				$r=mysqli_fetch_assoc($result);
				if($r['cuenta']>0)
					return true;
					return false;
		}
		
		public function buscarByMac($serie)		{
			$f=mysqli_real_escape_string($this->dbLink, $serie);
			$query = "SELECT count(*) As cuenta FROM almacenSalida as at 
			left join almacen as a on a.idalmacen = at.idalmacen
			where a.mac = '$f' and at.estatus ='disponible' ";
			$result = mysqli_query($this->dbLink,$query);
			//echo $query;
			if (! $result)
				return $this->setSystemError(
						"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
						"[model.almacenSalida::LN36][" . $query . "][" . mysql_error() .
						"]");
		
				$r=mysqli_fetch_assoc($result);
				if($r['cuenta']>0)
					return true;
					return false;
		}
		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function validarDatos()
		{
			return true;
		}


	}

