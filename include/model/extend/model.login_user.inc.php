<?php

	require FOLDER_MODEL_BASE . "model.base.login_user.inc.php";

	class ModeloLogin_user extends ModeloBaseLogin_user
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseLogin_user";

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

		function verificarUserName($userName) {			
			$query = "SELECT count(*) As cuenta FROM login_user where user_name='" . $userName . "'";			
			$result = mysqli_query ( $this->dbLink, $query );
			if (! $result)
				return $this->setSystemError(
						"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
						"[model.".$this->_nombreTabla."::LN36][" . $query . "][" . mysql_error() .
						"]");
			
				$r=mysqli_fetch_assoc($result);
				if($r['cuenta']>0)
					return true;
					return false;
			
					
		}

    public function getListadoUsuarios()
    {
            try
			{
			    global $objSession;
          $SQL="SELECT LU.*, R.nombre as rolNombre FROM login_user LU
                LEFT JOIN rol R ON R.id_rol = LU.id_rol ORDER BY LU.first_name ASC";	
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				
        $cadena = '';
				if(mysqli_num_rows($result)>0)
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
            $cadena.='<tr>';
					   $cadena.='<td>'.$row_inf['user_name'].'</td>';
             $cadena.='<td>'.$row_inf['first_name'].' '.$row_inf['last_name'].'</td>';
             $cadena.='<td>'.$row_inf['rolNombre'].'</td>';
             $cadena.='<td>'.ucfirst($row_inf['estatus']).'</td>';
             $cadena.='<td class="opciones"><form action="usuario.php" method="POST"><input type="hidden" name="id" value="'.$row_inf['id_login'].'" /><button class="btn btn-default btn-circle" type="submit"><i class="fa fa-eye"></i></button></form></td>';             
            $cadena.='</tr>';
          }
				}
				return $cadena;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
    }                                    
    
    function HashPassword($input) {
    	$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    	$hash = hash("sha256", $salt . $input);
    	$final = $salt . $hash;
    	return $final;
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

