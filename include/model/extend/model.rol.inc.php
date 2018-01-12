<?php

	require FOLDER_MODEL_BASE . "model.base.rol.inc.php";

	class ModeloRol extends ModeloBaseRol
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseRol";

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

    public function getListadoRolesSelect($idRol = '')
    {
            try
			{
			    global $objSession;
          $SQL="SELECT id_rol, nombre FROM rol WHERE estatus = 'activo' ORDER BY nombre ASC";    
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				
        $slcListadoRol = '<option value="0">Seleccione una opcion</option>';
				if(mysqli_num_rows($result)>0)
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
            if($idRol!='' && $idRol==$row_inf['id_rol']){
					    $slcListadoRol .= '<option selected="selected" value="'.$row_inf['id_rol'].'">'.$row_inf['nombre'].'</option>';
            }else{
              $slcListadoRol .= '<option value="'.$row_inf['id_rol'].'">'.$row_inf['nombre'].'</option>';
            }
          }
				}
				return $slcListadoRol;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
    }
    
    public function getListadoRoles()
    {
            try
			{
			    global $objSession;
          $SQL="SELECT * FROM rol ORDER BY nombre ASC";	
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				
        $cadena = '';
				if(mysqli_num_rows($result)>0)
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
            $cadena.='<tr>';
					   $cadena.='<td>'.ucfirst($row_inf['nombre']).'</td>';
             $cadena.='<td>'.ucfirst($row_inf['estatus']).'</td>';
             $cadena.='<td class="opciones"><form action="rol.php" method="POST"><input type="hidden" name="id" value="'.$row_inf['id_rol'].'" /><button class="btn btn-default btn-circle" type="submit"><i class="fa fa-eye"></i></button></form></td>';             
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

