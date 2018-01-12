<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';

	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDNumberServiceAddCallRule
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $AccountId;
		public $MemberId;
		public $CallRuleId;
		public $CallRuleName;
		public $RingType;
		public $RingDuration;
		public $OutCallerId;
		public $AuthCalls;


		public $Numbers;
		public $Destinations;

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


		public function setMemberId($MemberId)
		{
		    $this->MemberId = $MemberId;
		}

		public function getMemberId()
		{
		    return $this->MemberId;
		}


		public function setCallRuleId($CallRuleId)
		{
		    $this->CallRuleId = $CallRuleId;
		}

		public function getCallRuleId()
		{
		    return $this->CallRuleId;
		}


		public function setCallRuleName($CallRuleName)
		{
		    $this->CallRuleName = $CallRuleName;
		}

		public function getCallRuleName()
		{
		    return $this->CallRuleName;
		}


		public function setRingType($RingType)
		{
		    $this->RingType = $RingType;
		}

		public function getRingType()
		{
		    return $this->RingType;
		}


		public function setRingDuration($RingDuration)
		{
		    $this->RingDuration = $RingDuration;
		}

		public function getRingDuration()
		{
		    return $this->RingDuration;
		}


		public function setOutCallerId($OutCallerId)
		{
		    $this->OutCallerId = $OutCallerId;
		}

		public function getOutCallerId()
		{
		    return $this->OutCallerId;
		}


		public function setAuthCalls($AuthCalls)
		{
		    $this->AuthCalls = $AuthCalls;
		}

		public function getAuthCalls()
		{
		    return $this->AuthCalls;
		}



		public function setNumbers($Numbers)
		{
		    $this->Numbers = $Numbers;
		}

		public function getNumbers()
		{
		    return $this->Numbers;
		}

		public function setDestinations($Destinations)
		{
		    $this->Destinations = $Destinations;
		}

		public function getDestinations()
		{
		    return $this->Destinations;
		}








	}

	#-----------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Response-----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class responseDNumberServiceAddCallRule
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;


		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Getters---------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		//missing info on errors, it always gets the success code back =s.

		public function getErrorCode()
		{
			return $this->ErrorCode;
		}

		public function getErrorMessage()
		{
			return $this->ErrorMessage;
		}


	}

	class DNumberServiceAddCallRule extends WSDamaka
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
			$this->_operacion="NumberService.addCallRule";
			$this->Param=new paramDNumberServiceAddCallRule();
			$this->Response=new responseDNumberServiceAddCallRule();
		}


		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Acciones--------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function validate()
		{
			return true;
		}

		public function clear()
		{

		}
	}