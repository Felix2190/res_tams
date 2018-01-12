<?php

	require FOLDER_MODEL_BASE . "model.base.evaluacion.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.evaluaciondetalle.inc.php";
	class ModeloEvaluacion extends ModeloBaseEvaluacion
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseEvaluacion";

		var $__ss=array();
        var $items = array();
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

        public function setItems($items)
        {
            $this->items = $items;
        }

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
        public function getItems()
        {
            return $this->items;
        }


		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
        public function guardarEvaluacion()
        {
            
            $this->setFechaHora(date('Y-m-d H:i:s'));
            if($this->Guardar())
            {
                foreach($this->getItems() as $item)
                {
                    $objEvaDetalle = new ModeloEvaluaciondetalle();
                    $objEvaDetalle = $item;
                    $objEvaDetalle->setIdEvaluacion($this->getIdEvaluacion());
                    $objEvaDetalle->setFechaHora($this->getFechaHora());
                    $objEvaDetalle->Guardar();
                }
                
            }
            if($this->getError())
				return false;
            return true;
        }
        
        public function getEvaluacionByIdLicencia()
        {
            try
			{
				$SQL="SELECT
						idEvaluacion,idturno,idUsuario,fechaHora,idExamen,observaciones,calificacion,idLicencia
					FROM evaluacion
					WHERE idLicencia=" . mysqli_real_escape_string($this->dbLink,$this->idLicencia);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseEvaluacion::getEvalucionByIdLicencia][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
        
        public function getEvaluacionByIdLicenciaAndTipo($idLicencia,$tipo)
        {
            global $dbLink;
            $condicion='';
            if($tipo=='medico')
            {
                $condicion = " AND EV.estatus ='completo'";
            }
            else if($tipo =='teorico')
            {
                $condicion = " AND EV.estatus ='aprobado'";
            }
            
            $sql = "SELECT COUNT(*) AS contador  FROM evaluacion EV INNER JOIN examen EX ON EV.idExamen = EX.idExamen 
WHERE EV.idLicencia =". mysqli_real_escape_string($this->dbLink,$idLicencia) . " AND EX.tipo ='". mysqli_real_escape_string($this->dbLink,$tipo)."'" . $condicion;
   // echo $sql;
            $res = mysqli_query($dbLink, $sql);
            $contador=0;
            if ($res && mysqli_num_rows($res) > 0) {
    
                while ($row_inf = mysqli_fetch_assoc($res)) {
                    $contador =$row_inf['contador'];
                    
                }
    
            }
            return $contador;
        }

        //Obtiene una evaluacion del examen teorico no aprobada
         public function getEvaluacionTeorico($idLicencia,$idExamen)
        {
            global $dbLink;
            $condicion='';
            
            $sql = "SELECT COUNT(*) AS contador  FROM evaluacion WHERE idLicencia =". mysqli_real_escape_string($this->dbLink,$idLicencia) . " AND idExamen =". mysqli_real_escape_string($this->dbLink,$idExamen). " AND (estatus = 'no aprobado' OR estatus='incompleto')";
    
            $res = mysqli_query($dbLink, $sql);
            $contador=0;
            if ($res && mysqli_num_rows($res) > 0) {
    
                while ($row_inf = mysqli_fetch_assoc($res)) {
                    $contador =$row_inf['contador'];
                    
                }
    
            }
            return $contador;
        }


        public function getEvaluacionByIdTurnoAndIdExamen()
        {
            try
			{
				$SQL="SELECT
						idEvaluacion,idturno,idUsuario,fechaHora,idExamen,observaciones,calificacion,idLicencia,estatus
					FROM evaluacion
					WHERE idTurno=" . mysqli_real_escape_string($this->dbLink,$this->idturno) . ' AND idExamen='.mysqli_real_escape_string($this->dbLink,$this->idExamen);
					
                   // echo $SQL;
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloEvaluacion::getEvaluacionByIdTurnoAndIdExamen][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
        
       	public function ActualizarEstatusLicencia()
		{
		  global $dbLink;
			try
			{
				$SQL="UPDATE licencia SET estatus='aprobada' WHERE idLicencias=" . $this->idLicencia;
				//	echo $SQL;
				$result=mysqli_query($dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error($dbLink) . "][ModeloEvaluacion::ActualizarEstatusLicencia]");
			
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		
        public function getListaEvaluaciones()
        {
            
            global $dbLink;
	
        	$sql = "call getListaEvaluaciones";
        		
        	$res = mysqli_query ( $dbLink, $sql );
        	$evaluaciones = array ();
        	if ($res && mysqli_num_rows ( $res ) > 0) {
        	
        		while ( $row_inf = mysqli_fetch_assoc ( $res ) ) {
        			$evaluacion = array(
        					'numero'=>$row_inf['numero'],
        					'nombres'=>$row_inf['nombres'],
        					'primerAp'=>$row_inf['primerAp'],
        					'segundoAp'=>$row_inf['segundoAp'],
        					'href'=>$row_inf['href']
                            
        			);
        			$evaluaciones[]=$evaluacion;
        		}
        	
        	}
        	return $evaluaciones;
	
        }
        
      

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function validarDatos()
		{
			return true;
		}


	}

