<?php
	class responseDIDWWDefault
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $faultcode;
		public $faultstring;
		public $faultactor;
		public $detail;
		public $_responseArray=false;
		public $_response;



		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Getters---------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function getfaultcode()
		{
			return $this->faultcode;
		}

		public function getfaultstring()
		{
			return $this->faultstring;
		}

		public function getfaultactor()
		{
			return $this->faultactor;
		}

		public function getdetail()
		{
			return $this->detail;
		}

		public function getResponseArray()
		{
			return $this->_responseArray;
		}

		public function setResponseArray()
		{
			$this->_responseArray=true;
		}




	}