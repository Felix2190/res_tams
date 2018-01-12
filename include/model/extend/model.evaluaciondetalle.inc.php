<?php

	require FOLDER_MODEL_BASE . "model.base.evaluaciondetalle.inc.php";

	class ModeloEvaluaciondetalle extends ModeloBaseEvaluaciondetalle
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseEvaluaciondetalle";

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
        public function getIdEvaluacionDetalleAnterior()
        {
            $idEvaluacionDetalle=0;
            $idRespuesta = 0;
             global $dbLink;

            $sql = "SELECT idEvaluacionDetalle,idRespuesta FROM evaluaciondetalle
    					WHERE idPregunta=" . $this->getIdPregunta() . " AND idEvaluacion=".$this->getIdEvaluacion() ;
                        
            $res = mysqli_query($dbLink, $sql);
           // echo $sql;
            //$arrRespuestas = array();
            if ($res && mysqli_num_rows($res) > 0) {
    
                while ($row_inf = mysqli_fetch_assoc($res)) {
                    $idEvaluacionDetalle =$row_inf['idEvaluacionDetalle'];
                    $idRespuesta  =$row_inf['idRespuesta'];
                    
                }
            }

            return array(
            'idEvaluacionDetalle'=> $idEvaluacionDetalle,
            'idRespuesta'=>$idRespuesta
            );
            
        }
        
        public function guardarDetalleEvaluacion()
        {
            $arrRetorno = $this->getIdEvaluacionDetalleAnterior();
            if($arrRetorno['idEvaluacionDetalle']>0)
            {
                if($arrRetorno['idRespuesta']!=$this->idRespuesta)
                {
                    $this->setIdEvaluacionDetalle($arrRetorno['idEvaluacionDetalle']);
                    return $this->Guardar();    
                }
                
            }
            else
            {
               return $this->Guardar(); 
            }
            return true;
            
        }
		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function validarDatos()
		{
			return true;
		}


	}

