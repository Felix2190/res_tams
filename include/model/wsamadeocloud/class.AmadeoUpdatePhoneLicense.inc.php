<?php

require_once FOLDER_MODEL_WSAMADEOCLOUD . "ws.class.AmadeoCloud.inc.php";

class AmadeoCloudWSUpdatePhoneLicense extends AmadeoCloudWS
{
	#--------------------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------Properties-----------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#


	#--------------Param--------------#
	var $NoOfLicense;
	var $TenantName;
	var $Status;

	#-------------Response------------#

	var $response;

	#--------------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Constructor-----------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function __construct()
	{
		parent::__construct();

		$this->_operationName="UIUpdateAmadeoPhoneLicense";
		$this->_arrParam=array("Status","NoOfLicense","TenantName");

		foreach($this->_arrParam AS $k=>$param)
		{
			$this->$param=NULL;
		}
	}


	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Setter-------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#



	public function setNoOfLicense($NoOfLicense)
	{
		$this->NoOfLicense=$NoOfLicense;
	}

	public function setTenantName($TenantName)
	{
		$this->TenantName=$TenantName;
	}

	public function setStatus($Status)
	{
		$this->Status=$Status;
	}


	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Getter-------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function getNoOfLicense()
	{
		return $this->NoOfLicense;
	}

	public function getTenantName()
	{
		return $this->TenantName;
	}

	public function getStatus()
	{
		return $this->Status;
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