<?php

require_once FOLDER_MODEL_WSAMADEOCLOUD . "ws.class.AmadeoCloud.inc.php";

class AmadeoCloudWSGetTrunksForTenant extends AmadeoCloudWS
{
	#--------------------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------Properties-----------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#


	#--------------Param--------------#
	var $TenantName;
	
	#-------------Response------------#
	
	//Trunk List con estos valores?
	var $TrunkID;
	var $TrunkName;
	var $HostIP;
	var $Port;
	var $AuthType;
	var $Username;
	var $CallerID;
	var $Prefix;
	var $TrunkDigitsStart;
	var $TrunkDigitsEnd;
	var $Codecs;
	var $SupportVideo;
	var $TrunkPrefixID;

	#--------------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Constructor-----------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function __construct()
	{
		parent::__construct();

		$this->_operationName="UIgetTrunksForTenant";
		$this->_arrParam=array("TenantName");

		foreach($this->_arrParam AS $k=>$param)
		{
			$this->$param=NULL;
		}
	}


	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Setter-------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function setTenantName($TenantName)
	{
		$this->TenantName=$TenantName;
	}



	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Getter-------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function getTrunkID()
	{
		return $this->TrunkID;
	}

	public function getTrunkName()
	{
		return $this->TrunkName;
	}
	public function getHostIP()
	{
		return $this->HostIP();
	}
	public function getPort()
	{
		return $this->Port;
	}
	public function getAuthType()
	{
		return $this->AuthType;
	}
	public function getUsername()
	{
		return $this->Username;
	}
	public function getCallerID()
	{
		return $this->CallerID;
	}
	
	public function getPrefix()
	{
		return $this->Prefix;
	}
	
	public function getTrunkDigitsStart()
	{
		return $this->TrunkDigitsStart;
	}
	
	public function getTrunkDigitsEnd()
	{
		return $this->TrunkDigitsEnd;
	}
	
	public function getCodecs()
	{
		return $this->Codecs;
	}
	
	public function getSupportVideo()
	{
		return $this->SupportVideo;
	}
	
	public function getTrunkPrefixID()
	{
		return $this->TrunkPrefixID;
	}
	

	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Actions------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	function procesaRespuestaPaticular()
	{
		$this->TrunkID=$this->_description->TenantName->TrunkID->__toString();
		$this->TrunkName=$this->_description->TenantName->TrunkName->__toString();
		$this->HostIP=$this->_description->TenantName->HostIP->__toString();
		$this->Port=$this->_description->TenantName->Port->__toString();
		$this->AuthType=$this->_description->TenantName->AuthType->__toString();
		$this->Username=$this->_description->TenantName->Username->__toString();
		$this->CallerID=$this->_description->TenantName->CallerID->__toString();
		$this->Prefix=$this->_description->TenantName->Prefix->__toString();
		$this->TrunkDigitsStart=$this->_description->TenantName->TrunkDigitsStart->__toString();
		$this->TrunkDigitsEnd=$this->_description->TenantName->TrunkDigitsEnd->__toString();
		$this->Codecs=$this->_description->TenantName->Codecs->__toString();
		$this->SupportVideo=$this->_description->TenantName->SupportVideo->__toString();
		$this->TrunkPrefixID=$this->_description->TenantName->TrunkPrefixID->__toString();
		
	}

	private function validate()
	{
		return true;
	}

}