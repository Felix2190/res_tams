<?php

	require FOLDER_MODEL_BASE . "model.base.licencia.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.tipolicencia.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.configuracion.inc.php";
	class ModeloLicencia extends ModeloBaseLicencia
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseLicencia";

		var $__ss=array();
        var $objTipoLicencia;
		#------------------------------------------------------------------------------------------------------#
		#--------------------------------------------Inicializacion--------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		function __construct()
		{
			parent::__construct();
            $this->objTipoLicencia= new ModeloTipolicencia();
		}

		function __destruct()
		{
			
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Setter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

        public function setTipoLicencia()
        {
            $this->objTipoLicencia->setIdTipoLicencia($this->getIdTipoLicencia());
        }
        
        public function calcularNumero()
        {
            
            $numero='';
            $rut;
            $objConfiguracion = new ModeloConfiguracion();
            $objConfiguracion->getDatosByClave('inicialesEstado');
            $numero.=$objConfiguracion->getValor();
            $numero.=str_pad($this->getIdUbicacion(), 2, "0", STR_PAD_LEFT);
            $numero.=str_pad($this->getIdLicencias(), 6, "0", STR_PAD_LEFT);
            $numero.= getDigitoVerificador();
            return $numero;
        }
        
         function getDigitoVerificador() {
            /* Bonus: remuevo los ceros del comienzo. */
            $idLicencia = $this->getIdLicencias();
            while($idLicencia[0] == "0") {
                $idLicencia = substr($idLicencia, 1);
            }
            $factor = 2;
            $suma = 0;
            for($i = strlen($idLicencia) - 1; $i >= 0; $i--) {
                $suma += $factor * $idLicencia[$i];
                $factor = $factor % 7 == 0 ? 2 : $factor + 1;
            }
            $dv = 11 - $suma % 11;
            /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
            $dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
            return  $dv;
        }

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

        public function getTipoLicencia()
        {
            return $this->objTipoLicencia;
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

