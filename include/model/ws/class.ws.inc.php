<?php
	require_once LIB_NUSOAP;
	abstract class WSDamaka
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#--------------------------------------------------Propiedades Estaticas--------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#


		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------------Propiedades-------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		protected $_user;
		protected $_pass;
		protected $_url_ws;
		protected $_error;
		protected $_cliente;
		protected $_strError;
		protected $_operacion;
		protected $_numResponses;
		protected $_strErrorDebug;
		public $_result=array();
		public $_salidaHTML;
		protected $_params=array();
		protected $_prefixResponse="";
		protected $debugEnabled=false;

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Constructor/Destructor--------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function __construct($URL="",$user="",$pass="")
		{
			if($URL!="")
				$this->setURL($URL);
			if($user!="")
				$this->setWSUser($user);
			if($pass!="")
				$this->setWSPassword($pass);

		}

		public function __destruct()
		{

		}

		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Setters---------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		protected function setError($strError)
		{
			$this->_error=true;
			$this->_strError=$strError;
		}

		public function setWSPassword($pass)
		{
			$this->_pass=$pass;
		}

		public function setWSUser($user)
		{
			$this->_user=$user;
		}

		public function setURL($url)
		{
			$this->_url_ws_wsdl=$url;
		}

		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Getters---------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function getError()
		{
			return $this->_error;
		}

		public function getStrError()
		{
			return $this->_strError;
		}

		public function getStrDebug()
		{
			return $this->_strErrorDebug;
		}

		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Acciones--------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function debugEnable()
		{
			$this->debugEnabled=true;
		}

		public function makeDebugFile($folder)
		{
			$file="ws.debug." . date("YmdHis") . "." . rand(1000,9999) . ".log.html";
			$pf=fopen($folder . $file,"w");
			fwrite($pf,$this->_salidaHTML);
			fclose($pf);
			return $file;
		}

		abstract protected function validate();
		abstract protected function clear();

		private function serializeParams()
		{
			$retorno=array();

			foreach($this->Param AS $k=>$v)
			{
				$nameMethod="get" . $k;
				$parametro=$this->Param->$nameMethod() . "";
				if(trim($parametro!=""))
					$retorno[$k]=$this->Param->$nameMethod();
			}
			return $retorno;
		}

		protected function procesarResultado()
		{
			foreach($this->_result AS $k=>$v)
			{
				$this->Response->$k=$v;
			}
			#$this->Responses[$this->_numResponses]=$this->Response;
			#$this->_numResponses++;
		}

		public function clearError()
		{
			$this->_error=false;
			$this->_strError="";
		}

		protected function clientCall()
		{
			return $this->_cliente->call(
					$this->_operacion, //accion
					#array("param"=>array("AccountId"=>1000)),//parametros
					array("param"=>$this->serializeParams()),//parametros
					"urn:AvaVoip",//namespace
					"urn:AvaVoip",//namespace
					array("user"=>$this->_user,"password"=>MD5($this->_pass)));

		}

		protected function preparaResultado($result)
		{
			if(is_array($result))
			{
				$this->_result=$result[0];

				if(isset($this->_result['ErrorCode'])&&$this->_result['ErrorCode']!=0)
				{
					$this->setError("ErrorCode:[" . $this->_result['ErrorCode'] . "] Response with error: " . $this->_result['ErrorMessage']);
					return false;
				}

			}
			else
			{
				$this->_result['result']=$result;
			}
		}

		public function execute()
		{
			$this->clear();
			if($this->_url_ws_wsdl=="")
			{
				$this->setError("No se especifico la URL de los servicios web (ws).");
				return false;
			}
			if($this->_user=="")
			{
				$this->setError("No se especifico el usuario para la conexion ws.");
				return false;
			}
			if($this->_pass=="")
			{
				$this->setError("No se especifico el password para la conexion ws.");
				return false;
			}
			if(!$this->validate())
				return false;

			$this->_cliente=new nusoap_client($this->_url_ws_wsdl,true);
			if(!$this->debugEnabled)
				$this->_cliente->setDebugLevel(0);
			$err = $this->_cliente->getError();
			if ($err)
			{
				$this->setError($err);
				$this->_strErrorDebug=$cliente->getDebug();
				return false;
			}

			$result = $this->clientCall();



			/*if ($this->_cliente->fault)
			{
				$this->setError("la respuesta contiene una estructura SOAP no valida");
				$this->_strErrorDebug=$this->_cliente->getDebug();
				return false;
			}
			*/

			if ($err)
			{
				$this->setError($err);
				$this->_strErrorDebug=$this->_cliente->getDebug();
				return false;
			}

			$this->_salidaHTML=
				'<h2>Request</h2><pre>' . htmlspecialchars($this->_cliente->request, ENT_QUOTES) . '</pre>
				<h2>Response</h2><pre>' . htmlspecialchars($this->_cliente->response, ENT_QUOTES) . '</pre>
				<h2>Debug</h2><pre>' . htmlspecialchars($this->_cliente->getDebug(), ENT_QUOTES) . '</pre>
				<h2>Result Client Call</h2><pre>' . htmlspecialchars(print_r($result,true), ENT_QUOTES) . '</pre>

						';

			$this->preparaResultado($result);
			$this->procesarResultado();
		}
	}

?>