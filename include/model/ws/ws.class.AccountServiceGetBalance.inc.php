<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';






	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDAccountServiceGetBalance
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $AccountId;

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


	}

	#-----------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Response-----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class responseDAccountServiceGetBalance
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;

		public $Balance;
		public $AccountId;


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

		public function getBalance()
		{
			return $this->Balance;
		}

		public function getAccountId()
		{
			return $this->AccountId;
		}


	}

	class DAccountServiceGetBalance extends WSDamaka
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
			$this->_operacion="AccountService.getBalance";
			$this->Param=new paramDAccountServiceGetBalance();
			$this->Response=new responseDAccountServiceGetBalance();
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