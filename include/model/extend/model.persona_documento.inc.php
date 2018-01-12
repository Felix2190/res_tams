<?php

	require FOLDER_MODEL_BASE . "model.base.persona_documento.inc.php";

	class ModeloPersona_documento extends ModeloBasePersona_documento
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBasePersona_documento";

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
        public function verificaExisteFotografiaByIdPersona()
		{
			try
			{
				$SQL="SELECT COUNT(*) AS contador FROM persona_documento WHERE idPersona=".$this->getIdpersona(). " AND iddocumento=1 AND estatus='vigente'";
					
                    //	echo'ASDASDASDASDASD'. $SQL;
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePersona_biometrico::verificaExisteFotografiaByIdPersona][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
			

				if(mysqli_num_rows($result)==0)
				{
					//$this->limpiarPropiedades();
                    return 0;
				}
				else
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
					   $contador =$row_inf['contador']; 
			        }
                    return $contador;
				}
				
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		
		public function findFotoByIdPersona($id)
		{
			$idEvaluacion = 0;
			$query = "SELECT idpersona_documento FROM persona_documento where idpersona= '" . mysqli_real_escape_string($this->dbLink,$id)."' and iddocumento = 1 and estatus = 'vigente'";
			$result = mysqli_query($this->dbLink,$query);
			if (! $result)
				return $this->setSystemError(
						"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
						"[" . $this->_nombreClase . "::LN67][" . $query . "][" . mysql_error() .
						"]");
				if ($row = mysqli_fetch_assoc($result))
					$idEvaluacion = $row['idpersona_documento'];
					return $idEvaluacion;
		}
		public function findFirmaByIdPersona($id)
		{
			$idEvaluacion = 0;
			$query = "SELECT idpersona_documento FROM persona_documento where idpersona= '" . mysqli_real_escape_string($this->dbLink,$id)."' and iddocumento = 3 and estatus = 'vigente'";
			$result = mysqli_query($this->dbLink,$query);
			if (! $result)
				return $this->setSystemError(
						"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
						"[" . $this->_nombreClase . "::LN67][" . $query . "][" . mysql_error() .
						"]");
				if ($row = mysqli_fetch_assoc($result))
					$idEvaluacion = $row['idpersona_documento'];
					return $idEvaluacion;
		}
		
		public function findImagenesByIdPersona($id)
		{
			$idEvaluacion;
			$query = "SELECT idpersona_documento FROM persona_documento where idpersona= '" . mysqli_real_escape_string($this->dbLink,$id)."' and estatus = 'vigente'";
			$result = mysqli_query($this->dbLink,$query);
			if (! $result)
				return $this->setSystemError(
						"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
						"[" . $this->_nombreClase . "::LN67][" . $query . "][" . mysql_error() .
						"]");
				while ($row = mysqli_fetch_assoc($result))
					$idEvaluacion[] = $row['idpersona_documento'];
					return $idEvaluacion;
		}
		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function validarDatos()
		{
			return true;
		}

		public function getMaximoHistoricoByPersona($idPersona){
			$scp=mysqli_real_escape_string($this->dbLink, $idPersona);
			$query="SELECT IFNULL(MAX(historico),0) AS MXH FROM `persona_documento` WHERE idpersona=" . $scp . "";
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
				return $this->setSystemError("Ocurrio un error en la b&uacute;squeda de persona_documento.", "[" . $this->_nombreClase . ":60][" . $query . "][" . mysqli_error($this->dbLink) . "]");
			$r=mysqli_fetch_assoc($result);			
				return $r['MXH'];
					
		}
	}

