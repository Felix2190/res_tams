<?php
require FOLDER_MODEL_BASE . "model.base.inegidomgeo_cat_localidad.inc.php";

class ModeloInegidomgeo_cat_localidad extends ModeloBaseInegidomgeo_cat_localidad
{
	// ------------------------------------------------------------------------------------------------------#
	// ----------------------------------------------Propiedades---------------------------------------------#
	// ------------------------------------------------------------------------------------------------------#
	var $__ss = array();
	
	// ------------------------------------------------------------------------------------------------------#
	// --------------------------------------------Inicializacion--------------------------------------------#
	// ------------------------------------------------------------------------------------------------------#
	function __construct ()
	{
		parent::__construct();
	}

	function __destruct ()
	{
	}
	
	// ------------------------------------------------------------------------------------------------------#
	// ------------------------------------------------Setter------------------------------------------------#
	// ------------------------------------------------------------------------------------------------------#
	
	// ------------------------------------------------------------------------------------------------------#
	// -----------------------------------------------Unsetter-----------------------------------------------#
	// ------------------------------------------------------------------------------------------------------#
	
	// ------------------------------------------------------------------------------------------------------#
	// ------------------------------------------------Getter------------------------------------------------#
	// ------------------------------------------------------------------------------------------------------#
	
	
	public function getDatos()
	{
		try
		{
	
			if($this->CVE_ENT==""||$this->CVE_MUN==""||$this->CVE_LOC=="")
				return;
	
				$SQL="SELECT
						CVE_ENT,CVE_MUN,CVE_LOC,CVE_PERIODO,NOM_LOC,AMBITO,AGREGADA
					FROM inegidomgeo_cat_localidad
					WHERE CVE_ENT='" . mysqli_real_escape_string($this->dbLink,$this->CVE_ENT) . "' AND CVE_MUN='" . mysqli_real_escape_string($this->dbLink,$this->CVE_MUN) . "'  AND CVE_LOC='" . mysqli_real_escape_string($this->dbLink,$this->CVE_LOC) . "'";
	
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloInegidomgeo_cat_localidad::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
	
	
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
	
	
	public function getAllAutocompleteJSON($cveEstado = "",$cveMunicipio = "",$term="")
	{
		
		
		
		
		if ($cveEstado == "")
			$cveEstado = $this->CVE_ENT;
		
		if ($cveMunicipio == "")
			$cveMunicipio = $this->CVE_MUN;
		if (is_null($cveEstado) || $cveEstado == "")
			return $this->setError(
					"No se especifico el estado para la busqueda de las localidades");

		if (is_null($cveMunicipio) || $cveMunicipio== "")
			return $this->setError(
					"No se especifico el municipio para la busqueda de las localidades");

		$query = "SELECT
					CVE_LOC,
					NOM_LOC
				FROM inegidomgeo_cat_localidad
				WHERE
					cve_ent='" .  mysqli_real_escape_string($this->dbLink,$cveEstado) . "' AND
					cve_mun='" . mysqli_real_escape_string($this->dbLink,$cveMunicipio) . "' AND
					NOM_LOC LIKE '%" . mysqli_real_escape_string($this->dbLink, $term) . "%'
				ORDER BY NOM_LOC ASC";
		$result = mysqli_query($this->dbLink,$query);
		if (! $result)
			return $this->setSystemError(
					"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
					"[model.inegidomgeo_cat_localidad::LN67][" . $query . "][" .
					mysqli_error($this->dbLink) . "]");

		$arrRR=array();
		while ($row = mysqli_fetch_assoc($result))
		{	
			$arrR=array();
			$arrR['id']=$row['CVE_LOC'];
			$arrR['value']=$row['NOM_LOC'];
			$arrR['label']=$row['NOM_LOC'];
			
			
			
			$arrRR[]=$arrR;
		}
		

		return json_encode($arrRR);
		
	}
	
	public function getAll ($cveEstado = "",$cveMunicipio = "")
	{
		if ($cveEstado == "")
			$cveEstado = $this->CVE_ENT;
		
		if ($cveMunicipio == "")
			$cveMunicipio = $this->CVE_MUN;
		if (is_null($cveEstado) || $cveEstado == "")
			return $this->setError(
					"No se especifico el estado para la busqueda de las localidades");
		
		if (is_null($cveMunicipio) || $cveMunicipio== "")
			return $this->setError(
					"No se especifico el municipio para la busqueda de las localidades");
		
		$query = "SELECT 
					CVE_LOC,
					NOM_LOC 
				FROM inegidomgeo_cat_localidad 
				WHERE 
					cve_ent='" .  mysqli_real_escape_string($this->dbLink,$cveEstado) . "' AND 
					cve_mun='" . mysqli_real_escape_string($this->dbLink,$cveMunicipio) . "'  ORDER BY CVE_LOC,NOM_LOC ASC";
		$result = mysqli_query($this->dbLink,$query);
		if (! $result)
			return $this->setSystemError(
					"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.", 
					"[model.inegidomgeo_cat_localidad::LN109][" . $query . "][" .
							 mysqli_error($this->dbLink) . "]");
		
		$retorno = array();
		while ($row = mysqli_fetch_assoc($result))
			$retorno[$row['CVE_LOC']] = $row['NOM_LOC'];
		return $retorno;
	}
	
	// ------------------------------------------------------------------------------------------------------#
	// ------------------------------------------------Querys------------------------------------------------#
	// ------------------------------------------------------------------------------------------------------#
	
	// ------------------------------------------------------------------------------------------------------#
	// ------------------------------------------------Otras-------------------------------------------------#
	// ------------------------------------------------------------------------------------------------------#
	public function validarDatos ()
	{
		return true;
	}
}

?>