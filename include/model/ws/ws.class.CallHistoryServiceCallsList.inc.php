<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';






	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDCallHistoryServiceCallsList
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		var $AccountId;
        var $Month;
        var $Day;
        var $SwitchCurrency;
        var $RowCount;
        var $OffSet;
        var $SortBy;
        var $OrderType;

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

        public function setMonth($Month)
        {
            $this->Month = $Month;
        }

        public function getMonth()
        {
            return $this->Month;
        }

        public function setDay($Day)
        {
            $this->Day = $Day;
        }

        public function getDay()
        {
            return $this->Day;
        }

        public function setSwitchCurrency($SwitchCurrency)
        {
            $this->SwitchCurrency = $SwitchCurrency;
        }

        public function getSwitchCurrency()
        {
            return $this->SwitchCurrency;
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

	class responseDCallHistoryServiceCallsList
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;

		public $CallHistory;
		public $TotalRecords;


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

		public function getCallHistory()
		{
			return $this->CallHistory;
		}

		public function  getTotalRecords()
		{
			return $this->TotalRecords;
		}


	}

	class DCallHistoryServiceCallsList extends WSDamaka
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
			$this->_operacion="CallHistoryService.callsList";
			$this->Param=new paramDCallHistoryServiceCallsList();
			$this->Response=new responseDCallHistoryServiceCallsList();
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