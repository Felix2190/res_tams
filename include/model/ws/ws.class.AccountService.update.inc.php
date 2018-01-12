<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';

	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDAccountUpdate
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $AccountId;
		public $Password;
		public $FirstName;
		public $LastName;
		public $UserName;
		public $Email;
		public $CompanyName;
		public $PaymentMethodId;
		public $Address;
		public $Phone;
		public $CountryId;
		public $StateId;
		public $Zip;
		public $City;

		public $BillAddress;
		public $BillCity;
		public $BillCountryId;
		public $BillStateId;
		public $BillZip;
		public $BillEmail;
		public $BillFirstName;
		public $BillLastName;
		public $Status;
		public $BillPhone;

		#-------------------------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------------Setters Getters-----------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		//para todas set y get-
		public function setAccountId($AccountId)
		{
		    $this->AccountId = $AccountId;
		}

		public function getAccountId()
		{
			return $this->AccountId;
		}

		public function setPassword($Password)
		{
		    $this->Password = $Password;
		}

		public function getPassword()
		{
			return $this->Password;
		}

		public function setFirstName($FirstName)
		{
		    $this->FirstName = $FirstName;
		}

		public function getFirstName()
		{
			return $this->FirstName;
		}

		public function setLastName($LastName)
		{
		    $this->LastName = $LastName;
		}

		public function getLastName()
		{
			return $this->LastName;
		}

		public function setUserName($UserName)
		{
		    $this->UserName = $UserName;
		}

		public function getUserName()
		{
			return $this->UserName;
		}

		public function setEmail($Email)
		{
		    $this->Email = $Email;
		}

		public function getEmail()
		{
			return $this->Email;
		}

		public function setCompanyName($CompanyName)
		{
		    $this->CompanyName = $CompanyName;
		}

		public function getCompanyName()
		{
			return $this->CompanyName;
		}


		public function setPaymentMethodId($PaymentMethodId)
		{
		    $this->PaymentMethodId = $PaymentMethodId;
		}

		public function getPaymentMethodId()
		{
			return $this->PaymentMethodId;
		}


		public function setAddress($Address)
		{
		    $this->Address = $Address;
		}

		public function getAddress()
		{
			return $this->Address;
		}

		public function setPhone($Phone)
		{
		    $this->Phone = $Phone;
		}

		public function getPhone()
		{
			return $this->Phone;
		}

		public function setCountryId($CountryId)
		{
		    $this->CountryId = $CountryId;
		}

		public function getCountryId()
		{
			return $this->CountryId;
		}

		public function setStateId($StateId)
		{
		    $this->StateId = $StateId;
		}

		public function getStateId()
		{
			return $this->StateId;
		}

		public function setZip($Zip)
		{
		    $this->Zip = $Zip;
		}

		public function getZip()
		{
			return $this->Zip;
		}

		public function setCity($City)
		{
		    $this->City = $City;
		}

		public function getCity()
		{
			return $this->City;
		}

		public function setBillAddress($BillAddress)
		{
		    $this->BillAddress = $BillAddress;
		}

		public function getBillAddress()
		{
			return $this->BillAddress;
		}

		public function setBillCity($BillCity)
		{
		    $this->BillCity = $BillCity;
		}

		public function getBillCity()
		{
			return $this->BillCity;
		}


		public function setBillCountryId($BillCountryId)
		{
		    $this->BillCountryId = $BillCountryId;
		}

		public function getBillCountryId()
		{
			return $this->BillCountryId;
		}

		public function setBillStateId($BillStateId)
		{
		    $this->BillStateId = $BillStateId;
		}

		public function getBillStateId()
		{
			return $this->BillStateId;
		}


		public function setBillZip($BillZip)
		{
		    $this->BillZip = $BillZip;
		}

		public function getBillZip()
		{
			return $this->BillZip;
		}

		public function setBillEmail($BillEmail)
		{
		    $this->BillEmail = $BillEmail;
		}

		public function getBillEmail()
		{
			return $this->BillEmail;
		}

		public function setBillFirstName($BillFirstName)
		{
		    $this->BillFirstName = $BillFirstName;
		}

		public function getBillFirstName()
		{
			return $this->BillFirstName;
		}



		public function setBillLastName($BillLastName)
		{
		    $this->BillLastName = $BillLastName;
		}

		public function getBillLastName()
		{
			return $this->BillLastName;
		}

		public function setStatus($Status)
		{
		    $this->Status = $Status;
		}

		public function getStatus()
		{
			return $this->Status;
		}

		public function setBillPhone($BillPhone)
		{
		    $this->BillPhone = $BillPhone;
		}

		public function getBillPhone()
		{
			return $this->BillPhone;
		}




	}

	#-----------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Response-----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class responseDAccountUpdate
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;

		public $AccountId;
		public $Status;
		public $Username;

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
			return $this->account_id;
		}

		public function getStatus()
		{
			return $this->Status;
		}

		public function getUsername()
		{
			return $this->Username;
		}

	}

	class DAccountServiceUpdate extends WSDamaka
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
			$this->_operacion="AccountService.update";
			$this->Param=new paramDAccountUpdate();
			$this->Response=new responseDAccountUpdate();
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