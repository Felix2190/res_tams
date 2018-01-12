<?php

	require FOLDER_MODEL_BASE . "model.base.almacenTraslado.inc.php";

	class ModeloAlmacenTraslado extends ModeloBaseAlmacenTraslado
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseAlmacenTraslado";

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

		public function getCodigoTrasladoJSON($curp)
		{
			$curp=trim($curp);
			$query="SELECT
						at.idalmacen,
						p.codigo,
						a.mac,
						a.numeroSerie,
					at.idubicacion,
					at.folio
					FROM almacenTraslado as at
					left join almacen as a on a.idalmacen = at.idalmacen
					left join producto as p on p.idProducto = a.idProducto
					WHERE codigo like '%" . mysqli_real_escape_string($this->dbLink,$curp) . "%'
					and (estatus ='disponible' or estatus ='asignado') and Inventariable ='si' ORDER BY numeroSerie ASC";
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las personas.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
				$arrRR=array();
				while($r=mysqli_fetch_assoc($result))
				{
					$arrR=array();
					$arrR['id']=$r['idalmacen'];
					$arrR['value']=$r['codigo'];
					$arrR['label']=$r['codigo']."(".$r['mac'].")";
					$arrR['mac']=$r['mac'];
					$arrR['numeroSerie']=$r['numeroSerie'];
					$arrR['idubicacion']=$r['idubicacion'];
						
					$arrRR[]=$arrR;
				}
				return json_encode($arrRR);
		
		
		
		}

		
		public function getFolioTrasladoJSON($curp)
		{
			$curp=trim($curp);
			$query="SELECT
						at.idalmacenTraslado,
						p.codigo,
						a.mac,
						a.numeroSerie,
					at.idubicacion,
					at.idUbicacionNueva,
					at.folio,
					at.comentariosSalida
					FROM almacenTraslado as at
					left join almacen as a on a.idalmacen = at.idalmacen
					left join producto as p on p.idProducto = a.idProducto
					WHERE at.folio like '%" . mysqli_real_escape_string($this->dbLink,$curp) . "%'
					and (at.estatus ='traslado')  ";
			$result=mysqli_query($this->dbLink, $query);// echo  $query;
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las personas.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
				$arrRR=array();
				while($r=mysqli_fetch_assoc($result))
				{
					$arrR=array();
					$arrR['id']=$r['idalmacenTraslado'];
					$arrR['value']=$r['folio'];
					$arrR['label']=$r['codigo']."(".$r['mac'].")";
					$arrR['mac']=$r['mac'];
					$arrR['codigo']=$r['codigo'];
					$arrR['numeroSerie']=$r['numeroSerie'];
					$arrR['idubicacion']=$r['idubicacion'];
					$arrR['comentarioSalida']=$r['comentariosSalida'];
					$arrR['idUbicacionNueva']=$r['idUbicacionNueva'];
					
					$arrRR[]=$arrR;
				}
				return json_encode($arrRR);
		
		
		
		}
		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function buscarByFolio($folio)		{
			$f=mysqli_real_escape_string($this->dbLink, $folio);
			$query = "SELECT count(*) As cuenta FROM almacenTraslado as at 
			left join almacen as a on a.idalmacen = at.idalmacen
			where at.folio = '$f' and (at.estatus ='disponible' or at.estatus ='traslado') ";
			$result = mysqli_query($this->dbLink,$query);
			//echo $query;
			if (! $result)
				return $this->setSystemError(
						"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
						"[model.almacenTraslado::LN36][" . $query . "][" . mysql_error() .
						"]");
		
				$r=mysqli_fetch_assoc($result);
				if($r['cuenta']>0)
					return true;
					return false;
		}
		
		public function buscarByNoSerie($serie)		{
			$f=mysqli_real_escape_string($this->dbLink, $serie);
			$query = "SELECT count(*) As cuenta FROM almacenTraslado as at 
			left join almacen as a on a.idalmacen = at.idalmacen
			where a.numeroSerie = '$f' and at.estatus ='traslado'";
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
			$query = "SELECT count(*) As cuenta FROM almacenTraslado as at 
			left join almacen as a on a.idalmacen = at.idalmacen 
			where a.mac = '$f' and  at.estatus ='traslado' ";
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

