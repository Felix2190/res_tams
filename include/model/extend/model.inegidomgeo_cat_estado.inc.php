<?php
require FOLDER_MODEL_BASE . "model.base.inegidomgeo_cat_estado.inc.php";

class ModeloInegidomgeo_cat_estado extends ModeloBaseInegidomgeo_cat_estado
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
	public function getAll ()
	{
		$query = "SELECT CVE_ENT,NOM_ENT FROM inegidomgeo_cat_estado ORDER BY NOM_ENT ASC";
		$result = mysqli_query($this->dbLink,$query);
		if (! $result)
			return $this->setSystemError(
					"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.", 
					"[model.inegidomgeo_cat_estado::LN36][" . $query . "][" . mysql_error() .
							 "]");
		$retorno = array();
		while ($row = mysqli_fetch_assoc($result))
			$retorno[$row['CVE_ENT']] = $row['NOM_ENT'];
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