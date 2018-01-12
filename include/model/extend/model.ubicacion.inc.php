<?php

	require FOLDER_MODEL_BASE . "model.base.ubicacion.inc.php";

	class ModeloUbicacion extends ModeloBaseUbicacion
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseUbicacion";

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

		public function getAll()		{
			
				$query = "SELECT idUbicacion,nombre FROM ubicacion ORDER BY nombre ASC";				
					$result = mysqli_query($this->dbLink,$query);
					if (! $result)
						return $this->setSystemError(
								"Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
								"[model.inegidomgeo_cat_estado::LN36][" . $query . "][" . mysql_error() .
								"]");
						$retorno = array();
						while ($row = mysqli_fetch_assoc($result))
							$retorno[$row['idUbicacion']] = $row['nombre'];
							return $retorno;
		}
    
    public function getListadoUbicacionSelect($idUbicacion = '')
    {
            try
			{
			    global $objSession;
          $SQL="SELECT idUbicacion, nombre FROM ubicacion WHERE estatus = 'activa' ORDER BY nombre ASC";    
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				
        $slcListadoUbicacion = '<option value="0">Seleccione una opcion</option>';
				if(mysqli_num_rows($result)>0)
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
            if($idUbicacion!='' && $idUbicacion==$row_inf['idUbicacion']){
					    $slcListadoUbicacion .= '<option selected="selected" value="'.$row_inf['idUbicacion'].'">'.$row_inf['nombre'].'</option>';
            }else{
              $slcListadoUbicacion .= '<option value="'.$row_inf['idUbicacion'].'">'.$row_inf['nombre'].'</option>';
            }
          }
				}
				return $slcListadoUbicacion;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
    }    
    
    public function getListadoRecaudaciones()
    {
            try
			{
			    global $objSession;
          $SQL="SELECT * FROM ubicacion ORDER BY nombre ASC";	
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				
        $cadena = '';
				if(mysqli_num_rows($result)>0)
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
            $cadena.='<tr>';
					   $cadena.='<td>'.$row_inf['nombre'].'</td>';
             $cadena.='<td>'.ucfirst($row_inf['estatus']).'</td>';
             $cadena.='<td class="opciones"><form action="recaudacion.php" method="POST"><input type="hidden" name="id" value="'.$row_inf['idUbicacion'].'" /><button class="btn btn-default btn-circle" type="submit"><i class="fa fa-eye"></i></button></form></td>';             
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

