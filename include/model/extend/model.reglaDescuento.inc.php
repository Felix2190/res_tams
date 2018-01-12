<?php

	require FOLDER_MODEL_BASE . "model.base.reglaDescuento.inc.php";     

	class ModeloReglaDescuento extends ModeloBaseReglaDescuento
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseReglaDescuento";

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

    public function getListadoTipoTramitesSelect($idTipoLicencia = '')
    {
            try
			{
			    global $objSession;
          $SQL="SELECT tipo, descripcion, periodo, tipoTramite, idTipoLicencia FROM tipolicencia ORDER BY idTipoLicencia ASC";    
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				
        $slcListadoTipoTramite = '<option value="0">Seleccione una opcion</option>';
				if(mysqli_num_rows($result)>0)
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
            if($idTipoLicencia!='' && $idTipoLicencia==$row_inf['idTipoLicencia']){
					    $slcListadoTipoTramite .= '<option selected="selected" value="'.$row_inf['idTipoLicencia'].'">'.utf8_decode($row_inf['tipo']).' - '.$row_inf['descripcion'].' ('.ucfirst($row_inf['tipoTramite']).' - '.$row_inf['periodo'].' meses)</option>';
            }else{
              $slcListadoTipoTramite .= '<option value="'.$row_inf['idTipoLicencia'].'">'.utf8_decode($row_inf['tipo']).' - '.$row_inf['descripcion'].' ('.ucfirst($row_inf['tipoTramite']).' - '.$row_inf['periodo'].' meses)</option>';
            }
          }
				}
				return $slcListadoTipoTramite;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
    }
    
    public function getListadoReglas()
    {
            try
			{
			    global $objSession;
          $SQL="SELECT RD.idReglaDescuento, RD.cantidad, RD.esPorcentaje, RD.nombre, RD.estatus, TL.tipo, TL.descripcion, TL.periodo, TL.tipoTramite, TL.idTipoLicencia 
                FROM tipolicencia TL
                INNER JOIN reglaDescuento RD ON RD.idTipoLicencia = TL.idTipoLicencia
                ORDER BY RD.idReglaDescuento ASC";	          
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				
        $cadena = '';
				if(mysqli_num_rows($result)>0)
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
            $cadena.='<tr>';
             $cadena.='<td>'.$row_inf['tipo'].' '.$row_inf['descripcion'].' ('.$row_inf['periodo'].' meses)</td>';
             $cadena.='<td>'.$row_inf['nombre'].'</td>';
             $cadena.='<td>'.$row_inf['cantidad'].'</td>';
             if($row_inf['esPorcentaje']==1){
              $cadena.='<td>SI</td>';
             }else{
              $cadena.='<td>NO</td>';
             }
             $cadena.='<td>'.ucfirst($row_inf['estatus']).'</td>';
             $cadena.='<td class="opciones"><form action="reglaDescuento.php" method="POST"><input type="hidden" name="id" value="'.$row_inf['idReglaDescuento'].'" /><button class="btn btn-default btn-circle" type="submit"><i class="fa fa-eye"></i></button></form></td>';             
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
    
    public function calculaEdad( $fecha ) {
      list($Y,$m,$d) = explode("-",$fecha);
      return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    }    
    
    public function getLicenciasDescuento($idTipoLicencia)
    {
            try
			{
			    global $objSession;
                    
          $SQL="SELECT RD.*, TL.tipoTramite, TL.nuevaCosto, TL.revalidacionCosto, TL.reposicionCosto FROM reglaDescuento RD 
                INNER JOIN tipolicencia TL ON TL.idTipoLicencia = RD.idTipoLicencia
                WHERE RD.idTipoLicencia = '".$idTipoLicencia."' AND RD.estatus = 'activo'";	                     
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				
        $arregloGeneral = array();
        $arreglo = array();
				if(mysqli_num_rows($result)>0)
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
            $arreglo['idReglaDecreto'] = $row_inf['idReglaDecreto'];
            $arreglo['idTipoLicencia'] = $row_inf['idTipoLicencia'];
            if($row_inf['tipoTramite']=='nueva'){
              $arreglo['costo'] = $row_inf['nuevaCosto'];
            }else if($row_inf['tipoTramite']=='revalidacion'){
              $arreglo['costo'] = $row_inf['revalidacionCosto'];
            }else if($row_inf['tipoTramite']=='reposicion'){
              $arreglo['costo'] = $row_inf['reposicionCosto'];
            }
            $arreglo['esPorcentaje'] = $row_inf['esPorcentaje'];
            $arreglo['descuento'] = $row_inf['cantidad'];
            if($row_inf['esPorcentaje']==1){
              $cantidad_nueva = $arreglo['costo'] - (($arreglo['costo'] * $row_inf['cantidad']) / 100) * 1;
            }else{
              $cantidad_nueva = $arreglo['costo'] - $row_inf['cantidad'];
            }
            $arreglo['costoDescuento'] = $cantidad_nueva;
            $arreglo['edadMinima'] = $row_inf['edadMenor'];
            $arreglo['edadMaxima'] = $row_inf['edadMayor'];              
            array_push($arregloGeneral, $arreglo);
          }
				}
				return $arregloGeneral;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
    }

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function validarDatos()
		{
			return true;
		}


	}

