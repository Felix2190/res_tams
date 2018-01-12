<?php
	require_once FOLDER_MODEL_WSDIDWW . 'class.ws.did.inc.php';

	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDIDWWOrderCreate
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		/*
			This are the correct values to send when purchasing a DID number.
			IMPORANT: after purchasing the number, you need to update the
			DID Map Data with the didww_updatemapping web service.

			customer_id => Account ID
         	country_iso => (get it from ws.class.GetCountries.inc.php , example: US)
         	city_prefix => (get it from ws.class.GetCities.inc.php , example for dallas: 496)
         	period => 1
         	map_data => array (
	            map_type => URI,
            	map_proto => SIP,
	            map_detail => 192.30.162.13
	            map_pref_server => 0
				cli_format => raw
				);
         prepaid_funds => 0
         uniq_hash => md5($orderID) (this is local value for us to identify it)
         city_id => (get it from ws.class.GetCities.inc.php, Example for Dallas: 274)
         autorenew_enable => 1


		*/
		public $customer_id;
		public $country_iso;
		public $city_prefix;
		public $period;
			#public $map_type;
			#public $map_proto;
			#public $map_detail;
			#public $map_pref_server;
		public $prepaid_funds;
		public $uniq_hash;
		public $city_id;
		public $autorenew_enable;
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

        public function setcountry_iso($country_iso)
        {
            $this->country_iso = $country_iso;
        }

        public function getcountry_iso()
        {
            return $this->country_iso;
        }


         public function setcity_prefix($city_prefix)
        {
            $this->city_prefix = $city_prefix;
        }

        public function getcity_prefix()
        {
            return $this->city_prefix;
        }

        public function setperiod($period)
        {
            $this->period = $period;
        }

        public function getperiod()
        {
            return $this->period;
        }


        public function getmap_data()
        {
        	return $this->map_data;
        }

        public function setmap_data($map_data)
        {
        	$this->map_data=$map_data;
        }

        /*

        public function setmap_type($map_type)
        {
            $this->map_type = $map_type;
        }

        public function getmap_type()
        {
            return $this->map_type;
        }

        public function setmap_proto($map_proto)
        {
            $this->map_proto = $map_proto;
        }

        public function getmap_proto()
        {
            return $this->map_proto;
        }

        public function setmap_detail($map_detail)
        {
            $this->map_detail = $map_detail;
        }

        public function getmap_detail()
        {
            return $this->map_detail;
        }

        public function setmap_pref_server($map_pref_server)
        {
            $this->map_pref_server = $map_pref_server;
        }

        public function getmap_pref_server()
        {
            return $this->map_pref_server;
        }
        */

         public function setprepaid_funds($prepaid_funds)
        {
            $this->prepaid_funds = $prepaid_funds;
        }

        public function getprepaid_funds()
        {
            return $this->prepaid_funds;
        }


        public function setuniq_hash($uniq_hash)
        {
            $this->uniq_hash = $uniq_hash;
        }

        public function getuniq_hash()
        {
            return $this->uniq_hash;
        }


        public function setcity_id($city_id)
        {
            $this->city_id = $city_id;
        }

        public function getcity_id()
        {
            return $this->city_id;
        }


        public function setautorenew_enable($autorenew_enable)
        {
            $this->autorenew_enable = $autorenew_enable;
        }

        public function getautorenew_enable()
        {
            return $this->autorenew_enable;
        }


	}

	#-----------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Response-----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class responseDIDWWOrderCreate extends responseDIDWWDefault
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $result;
		public $country_name;
		public $country_iso;
		public $city_name;
		public $city_prefix;
		public $city_id;
		public $did_number;
		public $did_status;
		public $did_timeleft;
		public $did_expire_date_gmt;
		public $order_id;
		public $order_status;
		public $did_mapping_format;
		public $did_setup;
		public $did_monthly;
		public $did_period;
		public $autorenew_enable;
		public $prepaid_balance;

		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Getters---------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function getresult()
		{
			return $this->result;
		}

		public function getcountry_name()
		{
			return $this->country_name;
		}

		public function getcountry_iso()
		{
			return $this->country_iso;
		}

		public function getcity_name()
		{
			return $this->city_name;
		}

		public function getcity_prefix()
		{
			return $this->city_prefix;
		}

		public function getcity_id()
		{
			return $this->city_id;
		}

		public function getdid_number()
		{
			return $this->did_number;
		}

		public function getdid_status()
		{
			return $this->did_status;
		}

		public function getdid_timeleft()
		{
			return $this->did_timeleft;
		}

		public function getdid_expire_date_gmt()
		{
			return $this->did_expire_date_gmt;
		}

		public function getorder_id()
		{
			return $this->order_id;
		}

		public function getorder_status()
		{
			return $this->order_status;
		}

		public function getdid_mapping_format()
		{
			return $this->did_mapping_format;
		}

		public function getdid_setup()
		{
			return $this->did_setup;
		}

		public function getdid_monthly()
		{
			return $this->did_monthly;
		}

		public function getdid_period()
		{
			return $this->did_period;
		}

		public function getautorenew_enable()
		{
			return $this->autorenew_enable;
		}

		public function getprepaid_balance()
		{
			return $this->prepaid_balance;
		}


	}

	class DIDWWOrderCreate extends WSDIDWW
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
			$this->_operacion="didww_ordercreate";
			$this->Param=new paramDIDWWOrderCreate();
			$this->Response=new responseDIDWWOrderCreate();

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