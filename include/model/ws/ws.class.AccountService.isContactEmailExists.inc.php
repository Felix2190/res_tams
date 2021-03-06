<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';






	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDAccountServiceIsContactEmailExists
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public  $Email;

		#-------------------------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------------Setters Getters-----------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function setEmail($Email)
		{
		    $this->Email = $Email;
		}

		public function getEmail()
		{
			return $this->Email;
		}


	}

	#-----------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Response-----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class responseDAccountServiceIsContactEmailExists
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;

		public $AccountId;
		public $Exists;


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

		function getExists()
		{
			return $this->Exists;
		}
	}

	class DAccountServiceIsContactEmailExists extends WSDamaka
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
			$this->_operacion="AccountService.isContactEmailExists";
			$this->Param=new paramDAccountServiceIsContactEmailExists();
			$this->Response=new responseDAccountServiceIsContactEmailExists();
		}


		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Acciones--------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function clear()
		{

		}

		protected function validate()
		{
			$this->Param->Email.="";
			if(trim($this->Param->Email)=="")
			{
				$this->setError("El email no debe estar vacio.");
				return false;
			}
			return true;
		}

	}

?>