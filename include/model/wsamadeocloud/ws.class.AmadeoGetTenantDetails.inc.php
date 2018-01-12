<?php

require_once FOLDER_MODEL_WSAMADEOCLOUD . "ws.class.AmadeoCloud.inc.php";

class AmadeoCloudWSGetTenantDetails extends AmadeoCloudWS
{
	#--------------------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------Properties-----------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#


	#--------------Param--------------#
	var $TenantName;

	#-------------Response------------#

	var $AccountNumber;
	var $Category;
	var $Status;
	var $AdminPassword;
	var $CreationDate;
	var $LicenseMaxUsers;
	var $LicenseExpiryDate;

	#--------------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Constructor-----------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function __construct()
	{
		parent::__construct();

		$this->_operationName="UIgetTenantDetails";
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

	public function getAccountNumber()
	{
		return $this->AccountNumber;
	}

	public function getCategory()
	{
		return $this->Category;
	}
	public function getStatusCode()
	{
		return $this->getStatusCode();
	}
	public function getAdminPassword()
	{
		return $this->AdminPassword;
	}
	public function getCreationDate()
	{
		return $this->CreationDate;
	}
	public function getLicenseMaxUsers()
	{
		return $this->LicenseMaxUsers;
	}
	public function getLicenseExpiryDate()
	{
		return $this->LicenseExpiryDate;
	}



	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Actions------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	function procesaRespuestaPaticular()
	{
		$this->AccountNumber=$this->_description->TenantName->AccountNumber->__toString();
		$this->Status=$this->_description->TenantName->Status->__toString();
		$this->AdminPassword=$this->_description->TenantName->AdminPassword->__toString();
		$this->CreationDate=$this->_description->TenantName->CreationDate->__toString();
		$this->LicenseMaxUsers=$this->_description->TenantName->LicenseMaxUsers->__toString();
		$this->LicenseExpiryDate=$this->_description->TenantName->LicenseExpiryDate->__toString();
	}

	private function validate()
	{
		return true;
	}

}