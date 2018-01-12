<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';






	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDAccountGetInfo
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

	class responseDAccountGetInfo
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;

		public $account_id;
		public $first_name;
		public $status_id;
		public $last_name;
		public $user_name;
		public $email;
		public $company_name;
		public $type_id;
		public $taxable;
		public $date_created;
		public $payment_method_id;
		public $currency_id;
		public $currency_name;
		public $bill_address;
		public $bill_city;
		public $bill_country_id;
		public $bill_country_name;
		public $bill_state_id;
		public $bill_state_name;
		public $bill_zip;
		public $bill_first_name;
		public $bill_last_name;
		public $bill_email;
		public $bill_phone;
		public $address;
		public $country_id;
		public $country_name;
		public $zip;
		public $phone;
		public $city;
		public $state_id;
		public $state_name;


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

		public function getFirstName()
		{
			return $this->first_name;
		}

		public function getStatusId()
		{
			return $this->status_id;
		}

		public function getLastName()
		{
			return $this->last_name;
		}

		public function getUserName()
		{
			return $this->user_name;
		}

		public function getEmail()
		{
			return $this->email;
		}

		public function getCompanyName()
		{
			return $this->company_name;
		}

		public function getTypeId()
		{
			return $this->type_id;
		}

		public function getTaxable()
		{
			return $this->taxable;
		}

		public function getDateCreated()
		{
			return $this->date_created;
		}

		public function getPaymentMethodId()
		{
			return $this->payment_method_id;
		}

		public function getCurrencyId()
		{
			return $this->currency_id;
		}

		public function getCurrencyName()
		{
			return $this->currency_name;
		}

		public function getBillAddress()
		{
			return $this->bill_address;
		}

		public function getBillCity()
		{
			return $this->bill_city;
		}

		public function getBillCountryId()
		{
			return $this->bill_country_id;
		}

		public function getBillCountryName()
		{
			return $this->bill_country_name;
		}

		public function getBillStateId()
		{
			return $this->bill_state_id;
		}

		public function getBillStateName()
		{
			return $this->bill_state_name;
		}

		public function getBillZip()
		{
			return $this->bill_zip;
		}

		public function getBillFirstName()
		{
			return $this->bill_first_name;
		}

		public function getBillLastName()
		{
			return $this->bill_last_name;
		}

		public function getBillEmail()
		{
			return $this->bill_email;
		}

		public function getBillPhone()
		{
			return $this->bill_phone;
		}

		public function getAddress()
		{
			return $this->address;
		}

		public function getCountryId()
		{
			return $this->country_id;
		}

		public function getCountryName()
		{
			return $this->country_name;
		}

		public function getZip()
		{
			return $this->zip;
		}

		public function getPhone()
		{
			return $this->phone;
		}

		public function getCity()
		{
			return $this->city;
		}

		public function getStateId()
		{
			return $this->state_id;
		}

		public function getStateName()
		{
			return $this->state_name;
		}

	}

	class DAccountGetInfo extends WSDamaka
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
			$this->_operacion="AccountService.getInfo";
			$this->Param=new paramDAccountGetInfo();
			$this->Response=new responseDAccountGetInfo();
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