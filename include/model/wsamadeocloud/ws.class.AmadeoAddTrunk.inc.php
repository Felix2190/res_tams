<?php

require_once FOLDER_MODEL_WSAMADEOCLOUD . "ws.class.AmadeoCloud.inc.php";

class AmadeocloudWSAddTrunk extends AmadeoCloudWS
{
	#--------------------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------Properties-----------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#


	#--------------Param--------------#
	var $TenantName;
	var $TrunkName;
	var $Host;
	var $Port;
	var $Auth;
	var $Username;
	var $Password;
	var $CallerID;
	var $Prefix;
	var $TrunkDigitsStart;
	var $TrunkDigitsEnd;
	var $Codec;
	var $Supportvideo;
	var $TrunkPrefixID;

	#------------Response-------------#
	var $response;

	#--------------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Constructor-----------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function __construct()
	{
		parent::__construct();

		$this->_operationName="UIaddTrunk";
		$this->_arrParam=array("VoipTrunkID","TenantName","TrunkName","Host","Port","Auth","Username","Password","CallerID","Prefix","TrunkDigitsStart","TrunkDigitsEnd","Codec","Supportvideo","TrunkPrefixID");

		foreach($this->_arrParam AS $k=>$param)
		{
			$this->$param=NULL;
		}
	}


	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Setter-------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function setVoipTrunkID($VoipTrunkID)
	{
		$this->VoipTrunkID=$VoipTrunkID;
	}

	public function setTenantName($TenantName)
	{
		$this->TenantName=$TenantName;
	}

	public function setTrunkName($TrunkName)
	{
		$this->TrunkName=$TrunkName;
	}

	public function setHost($Host)
	{
		$this->Host=$Host;
	}

	public function setPort($Port)
	{
		$this->Port=$Port;
	}

	public function setAuth($Auth)
	{
		$this->Auth=$Auth;
	}

	public function setUsername($Username)
	{
		$this->Username=$Username;
	}

	public function setPassword($Password)
	{
		$this->Password=$Password;
	}

	public function setCallerID($CallerID)
	{
		$this->CallerID=$CallerID;
	}

	public function setPrefix($Prefix)
	{
		$this->Prefix=$Prefix;
	}

	public function setTrunkDigitsStart($TrunkDigitsStart)
	{
		$this->TrunkDigitsStart=$TrunkDigitsStart;
	}

	public function setTrunkDigitsEnd($TrunkDigitsEnd)
	{
		$this->TrunkDigitsEnd=$TrunkDigitsEnd;
	}

	public function setCodec($Codec)
	{
		$this->Codec=$Codec;
	}

	public function setSupportvideo($Supportvideo)
	{
		$this->Supportvideo=$Supportvideo;
	}

	public function setTrunkPrefixID($TrunkPrefixID)
	{
		$this->TrunkPrefixID=$TrunkPrefixID;
	}


	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Getter-------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function getstatuscode()
	{
		return $this->statuscode;
	}

	public function getTrunkID()
	{
		return $this->TrunkID;
	}

	public function getTrunkName()
	{
		return $this->TrunkName;
	}



	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Actions------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function procesaRespuestaPaticular()
	{
		$this->description=$this->_description->__toString();
	}

	private function validate()
	{
		return true;
	}
}