<?php
	require_once FOLDER_MODEL_WSDIDWW . 'class.ws.did.inc.php';

	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDIDWWUpdateMapping
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#


		/*

		 customer_id => Account ID
         did_number => (this is the number we got from the OrderCreate, in International format. Example for dallas number: 14692423638)
         map_data => array(
            map_type => URI
            map_proto => SIP
            map_detail => [did_number]@192.30.162.13 (important to do it like this. Example for the dallas number: 14692423638@192.30.162.13)
            map_pref_server => 0
            cli_format => raw
         )

		*/

		public $customer_id;
		public $did_number;
		public $city_prefix;
		public $map_data;


		#-------------------------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------------Setters Getters-----------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#


        public function setcustomer_id($customer_id)
        {
            $this->customer_id = $customer_id;
        }

        public function getcustomer_id()
        {
            return $this->customer_id;
        }

        public function setdid_number($did_number)
        {
            $this->did_number = $did_number;
        }

        public function getdid_number()
        {
            return $this->did_number;
        }

        public function setcity_prefix($city_prefix)
        {
            $this->city_prefix = $city_prefix;
        }

        public function getcity_prefix()
        {
            return $this->city_prefix;
        }

        public function setmap_data($map_data)
        {
            $this->map_data = $map_data;
        }

        public function getmap_data()
        {
            return $this->map_data;
        }


        public function setcli_format($cli_format)
        {
            $this->cli_format = $cli_format;
        }

        public function getcli_format()
        {
            return $this->cli_format;
        }



	}

	#-----------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Response-----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class responseDIDWWUpdateMapping extends responseDIDWWDefault
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		/*
			Expected response:
				error => 0
				result => 0
				means success.
		*/

		public $result;
		public $error;

		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Getters---------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function getresult()
		{
			return $this->result;
		}

		public function geterror()
		{
			return $this->error;
		}

	}

	class DIDWWUpdateMapping extends WSDIDWW
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de Control--------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#


		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Constructor/Destructor--------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function __construct()
		{
			parent::__construct(DIDWW_URL_WS,DIDWW_USER,DIDWW_PASS);
			$this->_operacion="didww_updatemapping";
			$this->Param=new paramDIDWWUpdateMapping();
			$this->Response=new responseDIDWWUpdateMapping();
		}


		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Acciones--------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function clear()
		{

		}

		protected function validate()
		{
			return true;
		}
	}

?>