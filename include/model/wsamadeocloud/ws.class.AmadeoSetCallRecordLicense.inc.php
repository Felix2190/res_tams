<?php

require_once FOLDER_MODEL_WSAMADEOCLOUD . "ws.class.AmadeoCloud.inc.php";

class AmadeoSetCallRecordLicense extends AmadeoCloudWS
{
	#--------------------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------Properties-----------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#


	#--------------Param--------------#
	var $TenantName;
	var $Status;
	var $NoOfLicense;

	#------------Response-------------#
	var $response;

	#--------------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Constructor-----------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function __construct()
	{
		parent::__construct();

		$this->_operationName="UISetCallRecordLicense";
		$this->_arrParam=array("TenantName","Status");

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

	public function setStatus($Status)
	{
		$this->Status=$Status;
	}

	public function setStatusON()
	{
		$this->Status="ON";
	}

	public function setStatusOFF()
	{
		$this->Status="OFF";
	}

	public function setNoOfLicense($noLicences)
	{
		$this->NoOfLicense=$noLicences;
	}

	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Getter-------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function getTenantName()
	{
		return $this->TenantName;
	}

	public function getStatus()
	{
		return $this->Status;
	}

	public function getStatusOFF()
	{
		return $this->NoOfLicense;
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