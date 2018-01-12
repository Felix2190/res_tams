<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';






	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDCallHistoryServiceCallsListDetailed
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $AccountId;
        public $Date;
		public $SwitchCurrency;
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

		public function setDate($Date)
		{
		    $this->Date = $Date;
		}

		public function getDate()
		{
		    return $this->Date;
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

	class responseDCallHistoryServiceCallsListDetailed
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;



		public $CallHistoryDetailed;
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



		public function getCallHistoryDetailed()
		{
			return $this->CallHistoryDetailed;
		}
		
		public function getTotalRecords()
		{
			return $this->TotalRecords;
		}

	}

	class DCallHistoryServiceCallsListDetailed extends WSDamaka
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
			$this->_operacion="CallHistoryService.callsListDetailed";
			$this->Param=new paramDCallHistoryServiceCallsListDetailed();
			$this->Response=new responseDCallHistoryServiceCallsListDetailed();
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
				$this->setError("Accout ID should be a number, and it's empty.");
				return false;
			}

			return true;
		}

	}

?>