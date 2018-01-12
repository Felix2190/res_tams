<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';






	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDCdrFileListFiles
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $AccountId;
		public $StartDate;
		public $EndDate;






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


        public function setEndDate($EndDate)
        {
            $this->EndDate = $EndDate;
        }

        public function getEndDate()
        {
            return $this->EndDate;
        }



        public function setStartDate($StartDate)
        {
            $this->StartDate = $StartDate;
        }

        public function getStartDate()
        {
            return $this->StartDate;
        }




	}

	#-----------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Response-----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class responseDCdrFileListFiles
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;

		public $CDRs;


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

		public function getCDRs()
		{
			return $this->CDRs;
		}

	}

	class DCdrFileListFiles extends WSDamaka
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
			$this->_operacion="CdrFile.listFiles";
			$this->Param=new paramDCdrFileListFiles();
			$this->Response=new responseDCdrFileListFiles();
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