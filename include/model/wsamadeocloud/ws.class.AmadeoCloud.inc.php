<?php
abstract class AmadeoCloudWS
{
	#--------------------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------Properties-----------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	#-------------Control-------------#
	var $_error=false;
	var $_strError="";
	var $_URL="";
	var $_key="";
	var $_operationName="";
	var $_arrParam;
	var $_strParam;
	var $_strResponse;
	var $_description;

	#--------------Param--------------#


	#------------Response-------------#
	var $statuscode;
	var $description;

	#--------------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Constructor-----------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function __construct()
	{
		$this->_error=false;
		$this->_strError="";
		$this->_key=WEBSERVICE_KEY;
		$this->_URL=WEBSERVICE_URL;
		$this->_operationName="UIeditTenant";
		$this->_strParam="";
	}


	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Setter-------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	public function setError($strError)
	{
		$this->_error=true;
		$this->_strError=$strError;
		return false;
	}

	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Getter-------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#



	public function getStatusCode()
	{
		return $this->statuscode;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getError()
	{
		return $this->_error;
	}

	public function getStrError()
	{
		return $this->_strError;
	}

	#--------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Actions------------------------------------------------------------#
	#--------------------------------------------------------------------------------------------------------------------------------#

	private function validate()
	{
		return true;
	}

	private function parseParam()
	{
		$arrP=array();
		$arrP[]="KEY=" . $this->_key;
		foreach($this->_arrParam AS $k=>$v)
		{
			if(!is_null($this->$v))
				$arrP[]=$v . "=" . ($this->$v);
		}
		$this->_strParam=implode("&",$arrP);
	}

	private function procesaRespuesta()
	{



		$response=simplexml_load_string($this->_strResponse);
		$oN=$this->_operationName;
		$code=$response->damaka->openinterface->$oN->statuscode->__toString();




		if($code!="200")
		{
			$description=$response->damaka->openinterface->$oN->description->__toString();
			return $this->setError($description);
		}


		$this->statuscode=$code;
		$this->_description=$response->damaka->openinterface->$oN->description;
		$this->procesaRespuestaPaticular();

	}

	abstract public function procesaRespuestaPaticular();

	public function exec()
	{
		$this->validate();
		if($this->_error)
			return false;
		$this->parseParam();

		$url=$this->_URL.$this->_operationName . '?'.$this->_strParam;

		ini_set('allow_url_fopen ','ON');

		$response = file_get_contents($url);


		if($response===false)
			return $this->setError("Imposible conectar con el servidor.");

		$response=print_r($response,true);
		$response = str_replace('<ns:'.$this->_operationName.'Response xmlns:ns="http://damaka.com/"><ns:return>', '', $response);
		$response = str_replace('</ns:return></ns:'.$this->_operationName.'Response>', '', $response);
		$this->_strResponse=str_replace(array("&lt;","&gt;"),array("<",">"),$response);
		$this->procesaRespuesta();
	}
}