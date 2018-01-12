<?php

	require FOLDER_MODEL_BASE . "model.base.prospecto.inc.php";
	require FOLDER_MODEL_EXTEND . "model.login_user.inc.php";

	class ModeloProspecto extends ModeloBaseProspecto
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseProspecto";

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
		
		public function getNextEstatus()
		{
			
			$arrSiguientes=array(
					"nuevo>"=>"autorizado",
					"autorizado"=>"informacion",
					"informacion"=>"propuesta",
					"propuesta"=>"contrato",
					"contrato"=>"cliente"
			);
			if(isset($arrSiguientes[$this->estatus]))
				return $arrSiguientes[$this->estatus];
			return "";
		}
		
		public function getNombreAgente()
		{
			$User=new ModeloLogin_user();
			$User->setId_login($this->idUsuarioAsignado);
			return $User->getFirst_name() . " " . $User->getLast_name();
		}
		
		public function getFolio()
		{
			return str_pad($this->idProspecto, 7,"0",STR_PAD_LEFT);
		}
		
		public function getMensajes()
		{
			$query="SELECT 
						C.idProspectoComentario AS idComentario, 
						C.fecha AS fechaHora,
						CONCAT_WS(' ',U.first_name,U.last_name) As usuario,
						C.comentario AS comentario,
						C.sistema AS sistema
					FROM prospecto_comentario C 
					INNER JOIN login_user AS U ON C.idUsuario=U.id_login
					WHERE C.idProspecto=" . $this->idProspecto;
			$result=mysqli_query($this->dbLink, $query);
			if(!$result)
			{
				return $this->setSystemError("Ocurrio un error en la consulta de los comentarios de prospectos.", "[" . $this->_nombreClase . ":LN61][" . $query . "][" . mysqli_error($this->dbLink) . "]");
			}
			$retorno=array();
			while($row=mysqli_fetch_assoc($result))
			{				
				$retorno[$row['idComentario']]=$row;
			}
			return $retorno;
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


	}

