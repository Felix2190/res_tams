<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';






	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDAccountServiceInvoicesList
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $AccountId;
		#public $StartDate;
		#public $EndDate;
		#public $RowCount;
		#public $OffSet;
		#public $SortBy;
		#public $OrderType;

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


		public function setStartDate($StartDate)
		{
		    $this->StartDate = $StartDate;
		}

		public function getStartDate()
		{
		    return $this->StartDate;
		}


		public function setEndDate($EndDate)
		{
		    $this->EndDate = $EndDate;
		}

		public function getEndDate()
		{
		    return $this->EndDate;
		}


		public function setRowCount($RowCount)
		{
		    $this->RowCount = $RowCount;
		}

		public function getRowCount()
		{
		    return $this->RowCount;
		}

		public function setOffSet($OffSet)
		{
		    $this->OffSet = $OffSet;
		}

		public function getOffSet()
		{
		    return $this->OffSet;
		}




		public function setSortBy($SortBy)
		{
		    $this->SortBy = $SortBy;
		}

		public function getSortBy()
		{
		    return $this->SortBy;
		}


		public function setOrderType($OrderType)
		{
		    $this->OrderType = $OrderType;
		}

		public function getOrderType()
		{
		    return $this->OrderType;
		}



	}

	#-----------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Response-----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class responseDAccountServiceInvoicesList
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;

		public $TotalRecords;
        public $InvoicesList;


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

		public function getTotalRecords()
		{
			return $this->TotalRecords;
		}

		public function getInvoicesList()
		{
			return $this->InvoicesList;
		}


	}

	class DAccountServiceInvoicesList extends WSDamaka
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
			$this->_operacion="AccountService.invoicesList";
			$this->Param=new paramDAccountServiceInvoicesList();
			$this->Response=new responseDAccountServiceInvoicesList();
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