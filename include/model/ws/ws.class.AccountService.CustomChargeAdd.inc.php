<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';






	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDAccountServiceCustomChargeAdd
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $AccountId;


		public $ChargeId;
		public $ChargeType;
		public $ChargeName;
		public $ChargeAmount;
		public $Quantity;
		public $IsProration;
		public $UnitId;
		public $Action;
		public $EffectiveDate;


		#-------------------------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------------Setters Getters-----------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

        public function setAccountId($AccountId)
        {
            $this->AccountId = $AccountId;
        }

        public function getAccountId()
        {
            return $this->AccountId;
        }

        public function setChargeId($ChargeId)
        {
            $this->ChargeId = $ChargeId;
        }

        public function getChargeId()
        {
            return $this->ChargeId;
        }

        public function setChargeType($ChargeType)
        {
            $this->ChargeType = $ChargeType;
        }

        public function getChargeType()
        {
            return $this->ChargeType;
        }


        public function setChargeName($ChargeName)
        {
            $this->ChargeName = $ChargeName;
        }

        public function getChargeName()
        {
            return $this->ChargeName;
        }

        public function setChargeAmount($ChargeAmount)
        {
            $this->ChargeAmount = $ChargeAmount;
        }

        public function getChargeAmount()
        {
            return $this->ChargeAmount;
        }

        public function setQuantity($Quantity)
        {
            $this->Quantity = $Quantity;
        }

        public function getQuantity()
        {
            return $this->Quantity;
        }


        public function setIsProration($IsProration)
        {
            $this->IsProration = $IsProration;
        }

        public function getIsProration()
        {
            return $this->IsProration;
        }


        public function setUnitId($UnitId)
        {
            $this->UnitId = $UnitId;
        }

        public function getUnitId()
        {
            return $this->UnitId;
        }

        public function setAction($Action)
        {
            $this->Action = $Action;
        }

        public function getAction()
        {
            return $this->Action;
        }

        public function setEffectiveDate($EffectiveDate)
        {
            $this->EffectiveDate = $EffectiveDate;
        }

        public function getEffectiveDate()
        {
            return $this->EffectiveDate;
        }
	}

	#-----------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Response-----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class responseDAccountServiceCustomChargeAdd
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;



		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Getters---------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function getErrorCode()
		{
			return $this->ErrorCode;
		}

		public function getErrorMessage()
		{
			return $this->ErrorMessage;
		}



	}

	class DAccountServiceCustomChargeAdd extends WSDamaka
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de Control--------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $Param;
		public $Response;

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Constructor/Destructor--------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function __construct()
		{
			parent::__construct(DAMAKA_URL_WS,DAMAKA_USER,DAMAKA_PASS);
			$this->_operacion="AccountService.customChargeAdd";
			$this->Param=new paramDAccountServiceCustomChargeAdd();
			$this->Response=new responseDAccountServiceCustomChargeAdd();
		}


		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Acciones--------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function clear()
		{

		}

		protected function validate()
		{
			$this->Param->AccountId.="";
			if(trim($this->Param->AccountId)=="")
			{
				$this->setError("El AccountId no debe estar vacio.");
				return false;
			}
			return true;
		}
	}

?>