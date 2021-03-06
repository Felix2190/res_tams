<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';






	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDAccountServiceLogin
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $AccountUsername;
		public $AccountPassword;

		#-------------------------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------------Setters Getters-----------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function setAccountUsername($AccountUsername)
		{
		    $this->AccountUsername = $AccountUsername;
		}

		public function setAccountPassword($AccountPassword)
		{
		    $this->AccountPassword = $AccountPassword;
		}

		public function getAccountUsername()
		{
			return $this->AccountUsername;
		}

		public function getAccountPassword()
		{
			return md5($this->AccountPassword);
		}

	}

	#-----------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Response-----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class responseDAccountServiceLogin
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;

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

		public function getAccountId()
		{
			return $this->AccountId;
		}


	}

	class DAccountServiceLogin extends WSDamaka
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
			$this->_operacion="AccountService.login";
			$this->Param=new paramDAccountServiceLogin();
			$this->Response=new responseDAccountServiceLogin();
		}


		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Acciones--------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function clear()
		{

		}

		protected function validate()
		{
			$this->Param->AccountUsername.="";
			if(trim($this->Param->AccountUsername)=="")
			{
				$this->setError("Username is empty. Please check and try again.");
				return false;
			}

			$this->Param->AccountPassword.="";
			if(trim($this->Param->AccountPassword)=="")
			{
				$this->setError("You need to provide your password. If you don't have one, please register or contact support.");
				return false;
			}
			return true;
		}

	}

?>