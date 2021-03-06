<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';






	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDAccountServiceDebitBalance
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $AccountId;

		public $Amount;
		public $Ip;
		public $Note;


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

        public function setAmount($Amount)
        {
            $this->Amount = $Amount;
        }

        public function getAmount()
        {
            return $this->Amount;
        }

        public function setIp($Ip)
        {
            $this->Ip = $Ip;
        }

        public function getIp()
        {
            return $this->Ip;
        }

        public function setNote($Note)
        {
            $this->Note = $Note;
        }

        public function getNote()
        {
            return $this->Note;
        }









	}

	#-----------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Response-----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class responseDAccountServiceDebitBalance
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;


		public $AccountId;
		public $Status;

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

		public function getAccountId()
		{
			return $this->AccountId;
		}

		public function getStatus()
		{
			return $this->Status;
		}


	}

	class DAccountServiceDebitBalance extends WSDamaka
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
			$this->_operacion="AccountService.DebitBalance";
			$this->Param=new paramDAccountServiceDebitBalance();
			$this->Response=new responseDAccountServiceDebitBalance();
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

			$this->Param->Amount.="";
			if(trim($this->Param->Amount)=="")
			{
				$this->setError("El Amount no debe estar vacio.");
				return false;
			}

			$this->Param->Note.="";
			if(trim($this->Param->Note)=="")
			{
				$this->setError("El Note no debe estar vacio.");
				return false;
			}

			return true;
		}
	}

?>