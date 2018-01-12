<?php

require_once FOLDER_MODEL_WSAMADEOCLOUD . "ws.class.AmadeoCloud.inc.php";

class AmadeoCloudWSAddDIDToTrunk extends AmadeoCloudWS
{
	#--------------------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------Properties-----------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#


	#--------------Param--------------#
	var $TrunkID;
	var $DIDNumber;
	var $Country;
	var $State;
	var $AreaCode;

	#-------------Response------------#

	var $response;

	#--------------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Constructor-----------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function __construct()
	{
		parent::__construct();

		$this->_operationName="UIaddDIDToTrunk";
		$this->_arrParam=array("TrunkID","DIDNumber","Country","State","AreaCode");

		foreach($this->_arrParam AS $k=>$param)
		{
			$this->$param=NULL;
		}
	}


	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Setter-------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function setTrunkID($TrunkID)
	{
		$this->TrunkID=$TrunkID;
	}
	
	public function setDIDNumber($DIDNumber)
	{
		$this->DIDNumber=$DIDNumber;
	}
	
	public function setCountry($Country)
	{
		$this->Country=$Country;
	}
	
	public function setState($State)
	{
		$this->State=$State;
	}
	
	public function setAreaCode($AreaCode)
	{
		$this->AreaCode=$AreaCode;
	}
	
	
	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Getter-------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function getTrunkID()
	{
		return $this->TrunkID;
	}
	
	public function getDIDNumber()
	{
		return $this->DIDNumber;
	}
	
	public function getCountry()
	{
		return $this->Country;
	}
	
	public function getState()
	{
		return $this->State;
	}
	
	public function getAreaCode()
	{
		return $this->AreaCode;
	}

	
	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Actions------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	function procesaRespuestaPaticular()
	{
		$this->description=$this->_description->__toString();
		//status code?
	}

	private function validate()
	{
		return true;
	}

}