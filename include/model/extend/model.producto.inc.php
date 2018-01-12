<?php

	require FOLDER_MODEL_BASE . "model.base.producto.inc.php";

	class ModeloProducto extends ModeloBaseProducto
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseProducto";

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

		public function getAllCodigoJSON($curp)
		{
			$curp=trim($curp);
			$query="SELECT
						idproducto,
						codigo,
						nombre						
					FROM producto
					WHERE codigo like '%" . mysqli_real_escape_string($this->dbLink,$curp) . "%'
					and tipo ='producto' and estatus = 'disponible' ORDER BY codigo,nombre ASC";
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la busqueda de las personas.", "[" . $this->_nombreClase . ":ln74][" . $query . "][" . mysqli_error($this->dbLink) . "]");
				$arrRR=array();
				while($r=mysqli_fetch_assoc($result))
				{
					$arrR=array();
					$arrR['id']=$r['idproducto'];
					$arrR['value']=$r['codigo'] . " (" . $r["nombre"] . ")";
					$arrR['label']=$r['codigo'] . " (" . $r["nombre"] . ")";
					$arrRR[]=$arrR;
				}
				return json_encode($arrRR);
		
		
		
		}
		
		
		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function buscarByCodigo($folio)		{
			$f=mysqli_real_escape_string($this->dbLink, $folio);
			$query = "SELECT count(*) As cuenta FROM producto where codigo = '$f' and estatus <> 'baja' ";
			$result = mysqli_query($this->dbLink,$query);
			//echo $query;
			if (! $result)
				return $this->setSystemError(
						"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
						"[model.producto::LN36][" . $query . "][" . mysql_error() .
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

