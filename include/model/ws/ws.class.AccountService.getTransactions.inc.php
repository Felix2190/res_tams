<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';






	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDAccountServiceGetTransactions
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
		
		public function setSwitchCurrency($SwitchCurrency)
		{
		    $this->SwitchCurrency = $SwitchCurrency;
		}

		public function getSwitchCurrency()
		{
		    return $this->SwitchCurrency;
		}

	}

	#-----------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Response-----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class responseDAccountServiceGetTransactions
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;

		public $TransactionsList;

		/*

		public $TransactionId;
		public $Amount;
		public $Date;
		public $Description;
		public $Type;
		public $Ip;
		public $AccountId;
		public $TypeId;
		*/



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

		public function getTransactionsList()
		{
			return $this->TransactionsList;
		}


		/*

		public function getTransactionId()
		{
			return $this->TransactionId;
		}
		public function getAmount()
		{
			return $this->Amount;
		}
		public function getDate()
		{
			return $this->Date;
		}
		public function getDescription()
		{
			return $this->Description;
		}
		public function getType()
		{
			return $this->Type;
		}
		public function getIp()
		{
			return $this->Ip;
		}
		public function getAccountId()
		{
			return $this->AccountId;
		}
		public function getTypeId()
		{
			return $this->TypeId;
		}
		*/

	}

	class DAccountServiceGetTransactions extends WSDamaka
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
			$this->_operacion="AccountService.getTransactions";
			$this->Param=new paramDAccountServiceGetTransactions();
			$this->Response=new responseDAccountServiceGetTransactions();
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
				$this->setError("Account ID should be a number.");
				return false;
			}

			return true;
		}

	}

?>