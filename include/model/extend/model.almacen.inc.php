<?php

	require FOLDER_MODEL_BASE . "model.base.almacen.inc.php";

	class ModeloAlmacen extends ModeloBaseAlmacen
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseAlmacen";

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

		public function getAllNoSerieJSON($curp)
		{
			$curp=trim($curp);
			$query="SELECT						
				a.idalmacen,
				a.numeroSerie,
				a.mac, p.codigo
					FROM almacen  as a
                    left join producto as p on p.idproducto = a.idproducto
					WHERE a.numeroSerie like '%" . mysqli_real_escape_string($this->dbLink,$curp) . "%'
					and a.estatus ='disponible' and a.Inventariable ='si' ORDER BY numeroSerie ASC";
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las personas.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
				$arrRR=array();
				while($r=mysqli_fetch_assoc($result))
				{
					$arrR=array();
					$arrR['id']=$r['idalmacen'];
					$arrR['value']=$r['numeroSerie'];
					$arrR['label']=$r['numeroSerie'];
					$arrR['mac']=$r['mac'];
					$arrR['codigo']=$r['codigo'];
					$arrRR[]=$arrR;
				}
				return json_encode($arrRR);
		
		
		
		}
		
		public function getAllMacJSON($curp)
		{
			$curp=trim($curp);
			$query="SELECT
				a.idalmacen,
				a.numeroSerie,
				a.mac, p.codigo
					FROM almacen  as a
                    left join producto as p on p.idproducto = a.idproducto
					WHERE a.mac like '%" . mysqli_real_escape_string($this->dbLink,$curp) . "%'
					and a.estatus ='disponible' and a.Inventariable ='si' ORDER BY numeroSerie ASC";
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las personas.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
				$arrRR=array();
				while($r=mysqli_fetch_assoc($result))
				{
					$arrR=array();
					$arrR['id']=$r['idalmacen'];
					$arrR['value']=$r['mac'];
					$arrR['label']=$r['mac'];
					$arrR['numeroSerie']=$r['numeroSerie'];
					$arrR['codigo']=$r['codigo'];
					$arrRR[]=$arrR;
				}
				return json_encode($arrRR);
		
		
		
		}
		
		
		public function getCodigoSalidaJSON($curp)
		{
			$curp=trim($curp);
			$query="SELECT
						a.idalmacen,
						p.codigo,
						a.mac,
						a.numeroSerie
					FROM almacen as a 
					left join producto as p on p.idProducto = a.idProducto
					WHERE codigo like '%" . mysqli_real_escape_string($this->dbLink,$curp) . "%'
					and a.estatus ='disponible' and a.Inventariable ='si' ORDER BY numeroSerie ASC";
			$result=mysqli_query($this->dbLink, $query); //echo $query;
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
					$arrRR[]=$arrR;
				}
				return json_encode($arrRR);
		
		
		
		}
		
		public function getCodigoTrasladoJSON($curp)
		{
			$curp=trim($curp);
			$query="SELECT
						a.idalmacen,
						p.codigo,
						a.mac,
						a.numeroSerie,
						a.idubicacion
					FROM almacen as a 
					left join producto as p on p.idProducto = a.idProducto					
					WHERE p.codigo like '%" . mysqli_real_escape_string($this->dbLink,$curp) . "%'
					and a.estatus ='disponible' and a.Inventariable ='si' 
					and not exists (select * from almacentraslado as at 							
							where at.estatus ='traslado' and at.idalmacen = a.idalmacen) ORDER BY numeroSerie ASC";
			$result=mysqli_query($this->dbLink, $query); //echo $query;
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
		
		public function getAllNoSerieTrasladoJSON($curp)
		{
			$curp=trim($curp);
			$query="SELECT
						a.idalmacen,
						a.numeroSerie,
						a.mac, p.codigo,a.idubicacion
					FROM almacen as a
					left join producto as p on p.idProducto = a.idProducto
					WHERE a.numeroSerie like '%" . mysqli_real_escape_string($this->dbLink,$curp) . "%'
					and a.estatus ='disponible'  and a.Inventariable ='si' and not exists (select * from almacentraslado as at 							
							where at.estatus ='traslado' and at.idalmacen = a.idalmacen) ORDER BY numeroSerie ASC";
			$result=mysqli_query($this->dbLink, $query);//echo $query;
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las personas.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
				$arrRR=array();
				while($r=mysqli_fetch_assoc($result))
				{
					$arrR=array();
					$arrR['id']=$r['idalmacen'];
					$arrR['value']=$r['numeroSerie'];
					$arrR['label']=$r['numeroSerie'];
					$arrR['mac']=$r['mac'];
					$arrR['codigo']=$r['codigo'];
					$arrR['idubicacion']=$r['idubicacion'];
					$arrRR[]=$arrR;
				}
				return json_encode($arrRR);
		
		
		
		}
		
		public function getAllMacTrasladoJSON($curp)
		{
			$curp=trim($curp);
			$query="SELECT
						a.idalmacen,
						a.mac,
						a.numeroSerie,
					p.codigo,a.idubicacion
					FROM almacen as a
					left join producto as p on p.idProducto = a.idProducto
					WHERE a.mac like '%" . mysqli_real_escape_string($this->dbLink,$curp) . "%'
					and (a.estatus ='disponible' or a.estatus ='asignado' )and a.Inventariable ='si' ORDER BY numeroSerie ASC";
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las personas.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
				$arrRR=array();
				while($r=mysqli_fetch_assoc($result))
				{
					$arrR=array();
					$arrR['id']=$r['idalmacen'];
					$arrR['value']=$r['mac'];
					$arrR['label']=$r['mac'];
					$arrR['numeroSerie']=$r['numeroSerie'];
					$arrR['codigo']=$r['codigo'];
					$arrR['idubicacion']=$r['idubicacion'];
					$arrRR[]=$arrR;
				}
				return json_encode($arrRR);
		
		
		
		}
		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function buscarByFolio($folio)		{
			$f=mysqli_real_escape_string($this->dbLink, $folio);
			$query = "SELECT count(*) As cuenta FROM almacen where folio = '$f'";
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
		
		public function buscarByNoSerie($serie)		{
			$f=mysqli_real_escape_string($this->dbLink, $serie);
			$query = "SELECT count(*) As cuenta FROM almacen where numeroSerie = '$f'";
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
			$query = "SELECT count(*) As cuenta FROM almacen where mac = '$f'";
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
		
		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function validarDatos()
		{
			return true;
		}


	}

