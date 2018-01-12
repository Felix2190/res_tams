<?php

	require FOLDER_MODEL_BASE . "model.base.reglaLicencia.inc.php";
  require_once FOLDER_MODEL_EXTEND . "model.persona.inc.php";
  require_once FOLDER_MODEL_EXTEND . "model.tipolicencia.inc.php";      
   
	class ModeloReglaLicencia extends ModeloBaseReglaLicencia
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseReglaLicencia";

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
          $SQL="SELECT RL.idReglaLicencia, RL.nombreRegla, RL.estatus, TL.tipo, TL.descripcion, TL.periodo, TL.tipoTramite, TL.idTipoLicencia 
                FROM tipolicencia TL
                INNER JOIN reglaLicencia RL ON RL.idTipoLicencia = TL.idTipoLicencia                
                ORDER BY RL.idReglaLicencia ASC";	
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				
        $cadena = '';
				if(mysqli_num_rows($result)>0)
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
            $cadena.='<tr>';
					   $cadena.='<td>'.ucfirst($row_inf['tipoTramite']).'</td>';
             $cadena.='<td>'.$row_inf['tipo'].' '.$row_inf['descripcion'].' ('.$row_inf['periodo'].' meses)</td>';
             $cadena.='<td>'.$row_inf['nombreRegla'].'</td>';
             $cadena.='<td>'.ucfirst($row_inf['estatus']).'</td>';
             $cadena.='<td class="opciones"><form action="reglaLicencia.php" method="POST"><input type="hidden" name="id" value="'.$row_inf['idReglaLicencia'].'" /><button class="btn btn-default btn-circle" type="submit"><i class="fa fa-eye"></i></button></form></td>';             
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
    
    public function getLicenciasVigentesByPersona($idPersona){
      $bandera = false;
            try
			{
			    global $objSession;
          $SQL="SELECT * FROM licencia
                WHERE idPersona = '".$idPersona."' AND estatus = 'activo'";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				
				if(mysqli_num_rows($result)>0)
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
            $bandera = true;
          }
				}
				return $bandera;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
    }
    
    public function getLicenciasTurnosVigentesByPersona($idPersona){
      $diferencia = 0;
      $bandera = false;
            try
			{
			    global $objSession;
          $SQL="SELECT * FROM licencia
                WHERE idPersona = '".$idPersona."' AND (estatus != 'activo' && estatus != 'baja' && estatus != 'suspendido' )";                
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				
				if(mysqli_num_rows($result)>0)
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
            $hoy = date('Y-m-d');
            $arreglo_fecha = explode(' ', $row_inf['fechaExpedicion']);
            $diferencia = $this->dateDiff($arreglo_fecha[0], $hoy);
          }
				}
        
        if($diferencia<=30){
          $bandera = true;
        }                 
        $diferencia = 0;        
        $SQL="SELECT * FROM turno
                WHERE idPersona = '".$idPersona."'";                                
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				
				if(mysqli_num_rows($result)>0)
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
            $hoy = date('Y-m-d');
            $arreglo_fecha = explode(' ', $row_inf['fechaHoraCreacion']);
            $diferencia = $this->dateDiff($arreglo_fecha[0], $hoy);
          }
				}
        if($diferencia<=30){
          $bandera = true;
        }        
				return $bandera;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
    }
    
    function dateDiff($start, $end) { 
      $start_ts = strtotime($start);       
      $end_ts = strtotime($end);       
      $diff = $end_ts - $start_ts;       
      return round($diff / 86400); 
    } 
    
    public function calculaEdad( $fecha ) {
      list($Y,$m,$d) = explode("-",$fecha);
      return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    }    
    
    public function getLicenciasPermitidas($idPersona = 0)
    {
            try
			{
		    global $objSession;
        
        if($idPersona!=0){
          $persona = new ModeloPersona();
          $persona->setIdPersona($idPersona);                   
          $edad = $this->calculaEdad($persona->getFechaNacimiento());          
          $SQL="SELECT * FROM reglaLicencia WHERE estatus = 'activo'";	 
  				$result=mysqli_query($this->dbLink,$SQL);
  				if(!$result)
  					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
  				
          $arregloGeneral = array();
          $arreglo = array();
  				if(mysqli_num_rows($result)>0)
  				{
  					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
              $tipoLicencia = new ModeloBaseTipolicencia();
              $tipoLicencia->setIdTipoLicencia($row_inf['idTipoLicencia']);                            
              if($tipoLicencia->getTipoTramite()=='reposicion'){
              //  if(!$this->getLicenciasVigentesByPersona($idPersona) && !$this->getLicenciasTurnosVigentesByPersona($idPersona)){
                  $arreglo['idReglaLicencia'] = $row_inf['idReglaLicencia'];
                  $arreglo['idTipoLicencia'] = $row_inf['idTipoLicencia'];
                  array_push($arregloGeneral, $arreglo);
              //  }
              }
            }
  				}
        }else{     
          $SQL="SELECT * FROM reglaLicencia WHERE estatus = 'activo'";	 
  				$result=mysqli_query($this->dbLink,$SQL);
  				if(!$result)
  					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
  				
          $arregloGeneral = array();
          $arreglo = array();
  				if(mysqli_num_rows($result)>0)
  				{
  					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
                $tipoLicencia = new ModeloBaseTipolicencia();
                $tipoLicencia->setIdTipoLicencia($row_inf['idTipoLicencia']);                            
                if($tipoLicencia->getTipoTramite()=='nueva'){
                  $arreglo['idReglaLicencia'] = $row_inf['idReglaLicencia'];
                  $arreglo['idTipoLicencia'] = $row_inf['idTipoLicencia'];
                  array_push($arregloGeneral, $arreglo);
                }

            }
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
    
		public function getDocumentosByTipoLicencias($idLicencia)
    {
        $SQL = "SELECT formatoSF001, examenTransito, identificacionOficial, comprobanteDomicilio, curp, rfc, actaNacimiento, polizaSeguro, 
                cartaResponsiva, identificacionPadreTutor, formatoMigratorio, constanciaLicenciaVigente, licenciaAnterior FROM reglaLicencia
                WHERE idTipoLicencia = '" . $idLicencia . "' AND estatus = 'activo'";
        $result = mysqli_query($this->dbLink, $SQL);
        if (! $result)
            return $this->setSystemError("Error en la obtencion de detalles de registro.", "[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
        
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
        return array();
    }
		


	}

