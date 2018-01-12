<?php

	require FOLDER_MODEL_BASE . "model.base.turno.inc.php";
    require_once FOLDER_MODEL_EXTEND . "model.persona.inc.php";
    require_once FOLDER_MODEL_EXTEND . "model.tipolicencia.inc.php";
    require_once FOLDER_MODEL_EXTEND . "model.ubicacion.inc.php";
    require_once FOLDER_MODEL_EXTEND . "model.examen_reprobado.inc.php";    

	class ModeloTurno extends ModeloBaseTurno
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseTurno";

		var $__ss=array();
        var $objPersona;
        var $objTipoLicencia;
        var $objUbicacion;
        var $arrTurnos=array();

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

		public function getSiguienteTurno($idUbicacion)
		{
			if($idUbicacion=="")
			{
				return $this->setError("Especifique la ubicación.");
			}
			$query="SELECT MIN(CONVERT(`turnoExterno`,unsigned)) AS siguiente 
			FROM turno AS t
			LEFT JOIN log_turno AS lt
				ON lt.idTurno=t.idTurno
			WHERE t.idEtapa=1 AND idUbicacion=".$idUbicacion." and DATE(`fechaHoraCreacion`)=DATE('".date('Y-m-d')."') AND IFNULL(lt.idTurno,0)=0";
			$result=mysqli_query($this->dbLink, $query);
			if(mysqli_num_rows($result)==0)
			{
				return $this->setError("No se encontr&oacute; el turno externo.");
			}
			$row=mysqli_fetch_assoc($result);
			return ($row["siguiente"]);
		}
		
		public function getUltimoTurno($idUbicacion)
		{
			if($idUbicacion=="")
			{
				return $this->setError("Especifique la ubicación.");
			}
			$query="SELECT MAX(ultimo) AS ultimo FROM(
						SELECT IFNULL(MAX(convert(`turnoExterno`,unsigned)),0) AS ultimo FROM turno WHERE `idUbicacion`=". $idUbicacion . " and DATE(`fechaHoraCreacion`)=DATE('".date('Y-m-d')."')
						UNION 
						SELECT 0 AS ultimo) AS ultimo";
			$result=mysqli_query($this->dbLink, $query);
			if(mysqli_num_rows($result)==0)
			{
				return $this->setError("No se encontr&oacute; el turno externo.");
			}
			$row=mysqli_fetch_assoc($result);
			return ($row["ultimo"]);
		}
		
		public function getDatosByIdExterno($idExterno)
		{
			if(trim($idExterno)=="")
			{
				return $this->setError("Especifique el turno externo a buscar.");
			}
			$query="SELECT idTurno FROM turno WHERE turnoExterno=" . $idExterno . "";
			$result=mysqli_query($this->dbLink, $query);
			if(mysqli_num_rows($result)==0)
			{
				return $this->setError("No se encontr&oacute; el turno externo.");
			}
			$row=mysqli_fetch_assoc($result);
			return $this->setIdTurno($row["idTurno"]);
		}
		
		public function getDatosByIdExternoFecha($idExterno, $fecha)
		{
			if(trim($idExterno)=="")
			{
				return $this->setError("Especifique el turno externo a buscar.");
			}
			$query="SELECT idTurno FROM turno WHERE turnoExterno=" . $idExterno . " AND DATE(fechaHoraCreacion)='".$fecha."' ";
			$result=mysqli_query($this->dbLink, $query);
			if(mysqli_num_rows($result)==0)
			{
				return $this->setError("No se encontr&oacute; el turno externo.");
			}
			$row=mysqli_fetch_assoc($result);
			return $this->setIdTurno($row["idTurno"]);
		}
		
        public function getObjTipoLicencia()
        {
            return $this->objTipoLicencia;
        }
        
        public function getObjPersona()
        {
            return $this->objPersona;
        }
        public function getObjUbicacion()
        {
            return $this->objUbicacion;
        }

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
        public function getListadoExamenes($idEtapa)
        {
            try
			{
			    global $objSession;
                $fechaInicial = date('Y-m-d') ." 00:00:00";
                $fechaFin = date('Y-m-d')." 23:59:59";
                $andClause = '';
                if($idEtapa==11)
                {//los turnos que han solicitado impresion son exluidos con esta condicion
                    $andClause = ' AND idTurno NOT IN (SELECT idTurno FROM impresion )';
                }
				$SQL="SELECT
						idTurno,idTipoLicencia,idUbicacion,idPersona FROM turno	WHERE idUbicacion=" . $objSession->getIdUbicacion(). " AND idEtapa=".$idEtapa." AND fechaHora BETWEEN '" . $fechaInicial . "' AND '". $fechaFin."'".$andClause;
					
                    //echo  $SQL;
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTurno::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

				if(mysqli_num_rows($result)>0)
				{
					while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
					   $objTurno = new ModeloTurno();
                       $objTurno->setIdTurno($row_inf['idTurno']);
					   $this->objPersona = new ModeloPersona();
                       $this->objPersona->setIdPersona($row_inf['idPersona']);
                       $this->objTipoLicencia = new ModeloTipolicencia();
                       $this->objTipoLicencia->setIdTipoLicencia($row_inf['idTipoLicencia']);
                       $this->objUbicacion = new ModeloUbicacion();
                       $this->objUbicacion->setIdUbicacion($row_inf['idUbicacion']);
                       //echo $objTurno->getIdTurno();
                       $arrDatos = array(
                        'turno'=>$objTurno,
                        'persona'=>$this->objPersona,
                        'tipoLicencia'=>$this->objTipoLicencia,
                        'ubicacion'=>$this->objUbicacion
                       );
                       $this->arrTurnos[]=$arrDatos;
                    }
				}
				return $this->arrTurnos;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
        }
        
        public function actualizarEtapa()
		{
		   global $dbLink;
			try
			{
				$SQL="UPDATE turno SET fechaHora='" . $this->getFechaHora() . "',idUsuario=" .$this->getIdUsuario() . ",idEtapa=" . $this->getIdEtapa() ." WHERE idTurno=" . $this->getIdTurno();
				//echo $SQL;
				$result=mysqli_query($dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error($dbLink) . "][ModeloBaseTurno::actualizarEtapa]");
				
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
        
        public function actualizarFecha($NoDias)
        {
            global $dbLink;
			try
			{
				$SQL="UPDATE turno SET fechaHora=DATE_ADD(fechaHora,INTERVAL ".$NoDias." DAY) WHERE idTurno=" . $this->getIdTurno();
				//echo $SQL;
				$result=mysqli_query($dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error($dbLink) . "][ModeloBaseTurno::actualizarEtapa]");
				
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
        }
        
        public function getTurnosByIdEtapa($idEtapa)
        {
        	try
        	{
        		global $objSession;
        		$fechaInicial = date('Y-m-d') ." 00:00:00";
        		$fechaFin = date('Y-m-d')." 23:59:59";
        		$SQL="SELECT * FROM turno	
        				WHERE idUbicacion=" . $objSession->getIdUbicacion(). " AND idEtapa=".$idEtapa." AND fechaHora BETWEEN '" . $fechaInicial . "' AND '". $fechaFin."'";
        		$arrDatos=array();
        		$result=mysqli_query($this->dbLink,$SQL);
        		if($result&&mysqli_num_rows($result)>0)
        			$arrDatos = mysqli_fetch_assoc ( $result ) ;
        				
        		return $arrDatos;
        	}
        	catch (Exception $e)
        	{
        		return $arrDatos;
        	}
        }
        
        public function existsTurnoInEtapa($idTurno,$idEtapa){
            global $objSession;
            $fechaInicial = date('Y-m-d') ." 00:00:00";
            $fechaFin = date('Y-m-d')." 23:59:59";
            
            $query="SELECT t.idTurno,concat_ws(' ', nombres, primerAp, segundoAp) as nombre, p.CURP 
					FROM turno as t 
                    LEFT join persona as p on t.idPersona=p.idPersona
                    WHERE  t.idUbicacion=" . $objSession->getIdUbicacion(). " 
                    AND t.idEtapa=".$idEtapa." AND t.idTurno=".$idTurno." 
                    AND t.fechaHora BETWEEN '" . $fechaInicial . "' AND '". $fechaFin."'";
            
            
            $result=mysqli_query($this->dbLink,$query);
            if($result&&mysqli_num_rows($result)>0){
                $row_inf = mysqli_fetch_assoc ( $result );
                return array(true,$row_inf['nombre'],$row_inf['CURP']);
            }else {
                return array(false);
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

