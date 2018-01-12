<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';

	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDAccountServiceEndpointAddUpdate
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $Id;
		public $MemberId;
		public $Name;
		public $Prefix;
		public $Ip;
		public $DigestUsername;
		public $DigestPassword;
		public $Port;
		public $Protocol;
		public $Authentication;
		public $Lines;
		public $NatEnabled;

		#-------------------------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------------Setters Getters-----------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function setId($Id)
		{
		    $this->Id = $Id;
		}

		public function getId()
		{
		    return $this->Id;
		}
		
		
		public function setMemberId($MemberId)
		{
		    $this->MemberId = $MemberId;
		}

		public function getMemberId()
		{
		    return $this->MemberId;
		}
		
		public function setName($Name)
		{
		    $this->Name = $Name;
		}

		public function getName()
		{
		    return $this->Name;
		}
		
		public function setPrefix($Prefix)
		{
		    $this->Prefix = $Prefix;
		}

		public function getPrefix()
		{
		    return $this->Prefix;
		}
		
		public function setIp($Ip)
		{
		    $this->Ip = $Ip;
		}

		public function getIp()
		{
		    return $this->Ip;
		}
		
		public function setDigestUsername($DigestUsername)
		{
		    $this->DigestUsername = $DigestUsername;
		}

		public function getDigestUsername()
		{
		    return $this->DigestUsername;
		}
		
		public function setDigestPassword($DigestPassword)
		{
		    $this->DigestPassword = $DigestPassword;
		}

		public function getDigestPassword()
		{
		    return $this->DigestPassword;
		}
		
		public function setPort($Port)
		{
		    $this->Port = $Port;
		}

		public function getPort()
		{
		    return $this->Port;
		}
		
		public function setProtocol($Protocol)
		{
		    $this->Protocol = $Protocol;
		}

		public function getProtocol()
		{
		    return $this->Protocol;
		}
		
		public function setAuthentication($Authentication)
		{
		    $this->Authentication = $Authentication;
		}

		public function getAuthentication()
		{
		    return $this->Authentication;
		}
		
		public function setLines($Lines)
		{
		    $this->Lines = $Lines;
		}

		public function getLines()
		{
		    return $this->Lines;
		}
		
		public function setNatEnabled($NatEnabled)
		{
		    $this->NatEnabled = $NatEnabled;
		}

		public function getNatEnabled()
		{
		    return $this->NatEnabled;
		}
		
		
	}

	#-----------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Response-----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class responseDAccountServiceEndpointAddUpdate
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;
		
		public $Status;
		public $Id;

		//public $List;


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
		
		public function getStatus()
		{
			return $this->Status;
		}
		
		public function getId()
		{
			return $this->Id;
		}

		// public function getList()
// 		{
// 			return $this->List;
// 		}


	}

	class DAccountServiceEndpointAddUpdate extends WSDamaka
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
			$this->_operacion="AccountService.EndpointAddUpdate";
			$this->Param=new paramDAccountServiceEndpointAddUpdate();
			$this->Response=new responseDAccountServiceEndpointAddUpdate();
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