<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';






	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDAccountServiceCreate
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#


		public $Type;
        public $Status;
        public $Taxable;
        public $Password;
        public $FirstName;
        public $LastName;
        public $UserName;
        public $Email;
        public $CompanyName;
        public $PlanId;
        public $PlanType;
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
        public $BillCountry;
        public $BillState;
        public $BillZip;
        public $BillEmail;
        public $BillFirstName;
        public $BillLastName;
        public $BillPhone;


		#-------------------------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------------Setters Getters-----------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#




        public function setType($Type)
        {
            $this->Type = $Type;
        }

        public function getType()
        {
            return $this->Type;
        }


        public function setStatus($Status)
        {
            $this->Status = $Status;
        }

        public function getStatus()
        {
            return $this->Status;
        }


        public function setTaxable($Taxable)
        {
            $this->Taxable = $Taxable;
        }

        public function getTaxable()
        {
            return $this->Taxable;
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


        public function setPlanId($PlanId)
        {
            $this->PlanId = $PlanId;
        }

        public function getPlanId()
        {
            return $this->PlanId;
        }


        public function setPlanType($PlanType)
        {
            $this->PlanType = $PlanType;
        }

        public function getPlanType()
        {
            return $this->PlanType;
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


        public function setBillCountry($BillCountry)
        {
            $this->BillCountry = $BillCountry;
        }

        public function getBillCountry()
        {
            return $this->BillCountry;
        }


        public function setBillState($BillState)
        {
            $this->BillState = $BillState;
        }

        public function getBillState()
        {
            return $this->BillState;
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

	class responseDAccountServiceCreate
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

	class DAccountServiceCreate extends WSDamaka
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
			$this->_operacion="AccountService.create";
			$this->Param=new paramDAccountServiceCreate();
			$this->Response=new responseDAccountServiceCreate();
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