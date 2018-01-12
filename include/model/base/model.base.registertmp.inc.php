<?php

	class ModeloBaseRegistertmp extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseRegistertmp";

		
		var $idRegisterTmp=0;
		var $full_name='';
		var $full_lastname='';
		var $empresaTxt='';
		var $phone='';
		var $idCountry='0';
		var $state='';
		var $city='';
		var $addressTxt='';
		var $cpTxt='';
		var $sameDir='0';
		var $full_fiscalname='';
		var $emailfiscal='';
		var $phonefiscal='';
		var $addressFiscalTxt='';
		var $cpFiscalTxt='';
		var $idCountryFiscal='0';
		var $stateFiscal='';
		var $cityFiscal='';
		var $vatFiscal='';
		var $domainName='';
		var $password='';
		var $crmLanguage='';
		var $invoiceLanguage='';
		var $idAmadeoOptions='';
		var $nbrUsers=0;
		var $orderTotal='';
		var $fechaAlta='';
		var $estatusPago='pendiente';
		var $proveedorPago='';
		var $email='';
		var $agentId=0;
		var $estatus='pendiente';
		var $type='trial';
		var $idAccount='';
		var $id_servicio=0;

		var $__s=array("idRegisterTmp","full_name","full_lastname","empresaTxt","phone","idCountry","state","city","addressTxt","cpTxt","sameDir","full_fiscalname","emailfiscal","phonefiscal","addressFiscalTxt","cpFiscalTxt","idCountryFiscal","stateFiscal","cityFiscal","vatFiscal","domainName","password","crmLanguage","invoiceLanguage","idAmadeoOptions","nbrUsers","orderTotal","fechaAlta","estatusPago","proveedorPago","email","agentId","estatus","type","idAccount","id_servicio");
		var $__ss=array();

		#------------------------------------------------------------------------------------------------------#
		#--------------------------------------------Inicializacion--------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		function __construct()
		{
			global $dbLink;
			if(is_null($dbLink))
			{
				trigger_error("La coneccion a la base de datos no esta establecida.",E_ERROR);
				return;
			}
			$this->dbLink=$dbLink;
			$this->link=$dbLink;
		}

		function __destruct()
		{
			
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Setter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function setIdRegisterTmp($idRegisterTmp)
		{
			if($idRegisterTmp==0||$idRegisterTmp==""||!is_numeric($idRegisterTmp)|| (is_string($idRegisterTmp)&&!ctype_digit($idRegisterTmp)))return $this->setError("Tipo de dato incorrecto para idRegisterTmp.");
			$this->idRegisterTmp=$idRegisterTmp;
			$this->getDatos();
		}
		public function setFull_name($full_name)
		{
			
			$this->full_name=$full_name;
		}
		public function setFull_lastname($full_lastname)
		{
			
			$this->full_lastname=$full_lastname;
		}
		public function setEmpresaTxt($empresaTxt)
		{
			
			$this->empresaTxt=$empresaTxt;
		}
		public function setPhone($phone)
		{
			
			$this->phone=$phone;
		}
		public function setIdCountry($idCountry)
		{
			
			$this->idCountry=$idCountry;
		}
		public function setState($state)
		{
			
			$this->state=$state;
		}
		public function setCity($city)
		{
			
			$this->city=$city;
		}
		public function setAddressTxt($addressTxt)
		{
			
			$this->addressTxt=$addressTxt;
		}
		public function setCpTxt($cpTxt)
		{
			
			$this->cpTxt=$cpTxt;
		}
		public function setSameDir()
		{
			$this->sameDir=1;
		}
		public function setFull_fiscalname($full_fiscalname)
		{
			
			$this->full_fiscalname=$full_fiscalname;
		}
		public function setEmailfiscal($emailfiscal)
		{
			
			$this->emailfiscal=$emailfiscal;
		}
		public function setPhonefiscal($phonefiscal)
		{
			
			$this->phonefiscal=$phonefiscal;
		}
		public function setAddressFiscalTxt($addressFiscalTxt)
		{
			
			$this->addressFiscalTxt=$addressFiscalTxt;
		}
		public function setCpFiscalTxt($cpFiscalTxt)
		{
			
			$this->cpFiscalTxt=$cpFiscalTxt;
		}
		public function setIdCountryFiscal($idCountryFiscal)
		{
			
			$this->idCountryFiscal=$idCountryFiscal;
		}
		public function setStateFiscal($stateFiscal)
		{
			
			$this->stateFiscal=$stateFiscal;
		}
		public function setCityFiscal($cityFiscal)
		{
			
			$this->cityFiscal=$cityFiscal;
		}
		public function setVatFiscal($vatFiscal)
		{
			
			$this->vatFiscal=$vatFiscal;
		}
		public function setDomainName($domainName)
		{
			
			$this->domainName=$domainName;
		}
		public function setPassword($password)
		{
			
			$this->password=$password;
		}
		public function setCrmLanguage($crmLanguage)
		{
			
			$this->crmLanguage=$crmLanguage;
		}
		public function setInvoiceLanguage($invoiceLanguage)
		{
			
			$this->invoiceLanguage=$invoiceLanguage;
		}
		public function setIdAmadeoOptions($idAmadeoOptions)
		{
			
			$this->idAmadeoOptions=$idAmadeoOptions;
		}
		public function setNbrUsers($nbrUsers)
		{
			
			$this->nbrUsers=$nbrUsers;
		}
		public function setOrderTotal($orderTotal)
		{
			$this->orderTotal=$orderTotal;
		}
		public function setFechaAlta($fechaAlta)
		{
			$this->fechaAlta=$fechaAlta;
		}
		public function setEstatusPago($estatusPago)
		{
			
			$this->estatusPago=$estatusPago;
		}
		public function setEstatusPagoPendiente()
		{
			$this->estatusPago='pendiente';
		}
		public function setEstatusPagoRechazado()
		{
			$this->estatusPago='rechazado';
		}
		public function setEstatusPagoAceptado()
		{
			$this->estatusPago='aceptado';
		}
		public function setProveedorPago($proveedorPago)
		{
			
			$this->proveedorPago=$proveedorPago;
		}
		public function setEmail($email)
		{
			
			$this->email=$email;
		}
		public function setAgentId($agentId)
		{
			
			$this->agentId=$agentId;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusCompletado()
		{
			$this->estatus='completado';
		}
		public function setEstatusPendiente()
		{
			$this->estatus='pendiente';
		}
		public function setType($type)
		{
			
			$this->type=$type;
		}
		public function setTypeTrial()
		{
			$this->type='trial';
		}
		public function setTypePayment()
		{
			$this->type='payment';
		}
		public function setTypeReseller()
		{
			$this->type='reseller';
		}
		public function setTypeAdmin()
		{
			$this->type='admin';
		}
		public function setTypeUpdate()
		{
			$this->type='update';
		}
		public function setIdAccount($idAccount)
		{
			
			$this->idAccount=$idAccount;
		}
		public function setId_servicio($id_servicio)
		{
			
			$this->id_servicio=$id_servicio;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetSameDir()
		{
			$this->sameDir=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdRegisterTmp()
		{
			return $this->idRegisterTmp;
		}
		public function getFull_name()
		{
			return $this->full_name;
		}
		public function getFull_lastname()
		{
			return $this->full_lastname;
		}
		public function getEmpresaTxt()
		{
			return $this->empresaTxt;
		}
		public function getPhone()
		{
			return $this->phone;
		}
		public function getIdCountry()
		{
			return $this->idCountry;
		}
		public function getState()
		{
			return $this->state;
		}
		public function getCity()
		{
			return $this->city;
		}
		public function getAddressTxt()
		{
			return $this->addressTxt;
		}
		public function getCpTxt()
		{
			return $this->cpTxt;
		}
		public function getSameDir()
		{
			return $this->sameDir;
		}
		public function getFull_fiscalname()
		{
			return $this->full_fiscalname;
		}
		public function getEmailfiscal()
		{
			return $this->emailfiscal;
		}
		public function getPhonefiscal()
		{
			return $this->phonefiscal;
		}
		public function getAddressFiscalTxt()
		{
			return $this->addressFiscalTxt;
		}
		public function getCpFiscalTxt()
		{
			return $this->cpFiscalTxt;
		}
		public function getIdCountryFiscal()
		{
			return $this->idCountryFiscal;
		}
		public function getStateFiscal()
		{
			return $this->stateFiscal;
		}
		public function getCityFiscal()
		{
			return $this->cityFiscal;
		}
		public function getVatFiscal()
		{
			return $this->vatFiscal;
		}
		public function getDomainName()
		{
			return $this->domainName;
		}
		public function getPassword()
		{
			return $this->password;
		}
		public function getCrmLanguage()
		{
			return $this->crmLanguage;
		}
		public function getInvoiceLanguage()
		{
			return $this->invoiceLanguage;
		}
		public function getIdAmadeoOptions()
		{
			return $this->idAmadeoOptions;
		}
		public function getNbrUsers()
		{
			return $this->nbrUsers;
		}
		public function getOrderTotal()
		{
			return $this->orderTotal;
		}
		public function getFechaAlta()
		{
			return $this->fechaAlta;
		}
		public function getEstatusPago()
		{
			return $this->estatusPago;
		}
		public function getProveedorPago()
		{
			return $this->proveedorPago;
		}
		public function getEmail()
		{
			return $this->email;
		}
		public function getAgentId()
		{
			return $this->agentId;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getType()
		{
			return $this->type;
		}
		public function getIdAccount()
		{
			return $this->idAccount;
		}
		public function getId_servicio()
		{
			return $this->id_servicio;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idRegisterTmp=0;
			$this->full_name='';
			$this->full_lastname='';
			$this->empresaTxt='';
			$this->phone='';
			$this->idCountry='0';
			$this->state='';
			$this->city='';
			$this->addressTxt='';
			$this->cpTxt='';
			$this->sameDir='0';
			$this->full_fiscalname='';
			$this->emailfiscal='';
			$this->phonefiscal='';
			$this->addressFiscalTxt='';
			$this->cpFiscalTxt='';
			$this->idCountryFiscal='0';
			$this->stateFiscal='';
			$this->cityFiscal='';
			$this->vatFiscal='';
			$this->domainName='';
			$this->password='';
			$this->crmLanguage='';
			$this->invoiceLanguage='';
			$this->idAmadeoOptions='';
			$this->nbrUsers=0;
			$this->orderTotal='';
			$this->fechaAlta='';
			$this->estatusPago='pendiente';
			$this->proveedorPago='';
			$this->email='';
			$this->agentId=0;
			$this->estatus='pendiente';
			$this->type='trial';
			$this->idAccount='';
			$this->id_servicio=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO registertmp(full_name,full_lastname,empresaTxt,phone,idCountry,state,city,addressTxt,cpTxt,sameDir,full_fiscalname,emailfiscal,phonefiscal,addressFiscalTxt,cpFiscalTxt,idCountryFiscal,stateFiscal,cityFiscal,vatFiscal,domainName,password,crmLanguage,invoiceLanguage,idAmadeoOptions,nbrUsers,orderTotal,fechaAlta,estatusPago,proveedorPago,email,agentId,estatus,type,idAccount,id_servicio)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->full_name) . "','" . mysqli_real_escape_string($this->dbLink,$this->full_lastname) . "','" . mysqli_real_escape_string($this->dbLink,$this->empresaTxt) . "','" . mysqli_real_escape_string($this->dbLink,$this->phone) . "','" . mysqli_real_escape_string($this->dbLink,$this->idCountry) . "','" . mysqli_real_escape_string($this->dbLink,$this->state) . "','" . mysqli_real_escape_string($this->dbLink,$this->city) . "','" . mysqli_real_escape_string($this->dbLink,$this->addressTxt) . "','" . mysqli_real_escape_string($this->dbLink,$this->cpTxt) . "','" . mysqli_real_escape_string($this->dbLink,$this->sameDir) . "','" . mysqli_real_escape_string($this->dbLink,$this->full_fiscalname) . "','" . mysqli_real_escape_string($this->dbLink,$this->emailfiscal) . "','" . mysqli_real_escape_string($this->dbLink,$this->phonefiscal) . "','" . mysqli_real_escape_string($this->dbLink,$this->addressFiscalTxt) . "','" . mysqli_real_escape_string($this->dbLink,$this->cpFiscalTxt) . "','" . mysqli_real_escape_string($this->dbLink,$this->idCountryFiscal) . "','" . mysqli_real_escape_string($this->dbLink,$this->stateFiscal) . "','" . mysqli_real_escape_string($this->dbLink,$this->cityFiscal) . "','" . mysqli_real_escape_string($this->dbLink,$this->vatFiscal) . "','" . mysqli_real_escape_string($this->dbLink,$this->domainName) . "','" . mysqli_real_escape_string($this->dbLink,$this->password) . "','" . mysqli_real_escape_string($this->dbLink,$this->crmLanguage) . "','" . mysqli_real_escape_string($this->dbLink,$this->invoiceLanguage) . "','" . mysqli_real_escape_string($this->dbLink,$this->idAmadeoOptions) . "','" . mysqli_real_escape_string($this->dbLink,$this->nbrUsers) . "','" . mysqli_real_escape_string($this->dbLink,$this->orderTotal) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatusPago) . "','" . mysqli_real_escape_string($this->dbLink,$this->proveedorPago) . "','" . mysqli_real_escape_string($this->dbLink,$this->email) . "','" . mysqli_real_escape_string($this->dbLink,$this->agentId) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->type) . "','" . mysqli_real_escape_string($this->dbLink,$this->idAccount) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_servicio) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseRegistertmp::Insertar]");
				
				$this->idRegisterTmp=mysqli_insert_id($this->dbLink);
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		protected function Actualizar()
		{
			try
			{
				$SQL="UPDATE registertmp SET full_name='" . mysqli_real_escape_string($this->dbLink,$this->full_name) . "',full_lastname='" . mysqli_real_escape_string($this->dbLink,$this->full_lastname) . "',empresaTxt='" . mysqli_real_escape_string($this->dbLink,$this->empresaTxt) . "',phone='" . mysqli_real_escape_string($this->dbLink,$this->phone) . "',idCountry='" . mysqli_real_escape_string($this->dbLink,$this->idCountry) . "',state='" . mysqli_real_escape_string($this->dbLink,$this->state) . "',city='" . mysqli_real_escape_string($this->dbLink,$this->city) . "',addressTxt='" . mysqli_real_escape_string($this->dbLink,$this->addressTxt) . "',cpTxt='" . mysqli_real_escape_string($this->dbLink,$this->cpTxt) . "',sameDir='" . mysqli_real_escape_string($this->dbLink,$this->sameDir) . "',full_fiscalname='" . mysqli_real_escape_string($this->dbLink,$this->full_fiscalname) . "',emailfiscal='" . mysqli_real_escape_string($this->dbLink,$this->emailfiscal) . "',phonefiscal='" . mysqli_real_escape_string($this->dbLink,$this->phonefiscal) . "',addressFiscalTxt='" . mysqli_real_escape_string($this->dbLink,$this->addressFiscalTxt) . "',cpFiscalTxt='" . mysqli_real_escape_string($this->dbLink,$this->cpFiscalTxt) . "',idCountryFiscal='" . mysqli_real_escape_string($this->dbLink,$this->idCountryFiscal) . "',stateFiscal='" . mysqli_real_escape_string($this->dbLink,$this->stateFiscal) . "',cityFiscal='" . mysqli_real_escape_string($this->dbLink,$this->cityFiscal) . "',vatFiscal='" . mysqli_real_escape_string($this->dbLink,$this->vatFiscal) . "',domainName='" . mysqli_real_escape_string($this->dbLink,$this->domainName) . "',password='" . mysqli_real_escape_string($this->dbLink,$this->password) . "',crmLanguage='" . mysqli_real_escape_string($this->dbLink,$this->crmLanguage) . "',invoiceLanguage='" . mysqli_real_escape_string($this->dbLink,$this->invoiceLanguage) . "',idAmadeoOptions='" . mysqli_real_escape_string($this->dbLink,$this->idAmadeoOptions) . "',nbrUsers='" . mysqli_real_escape_string($this->dbLink,$this->nbrUsers) . "',orderTotal='" . mysqli_real_escape_string($this->dbLink,$this->orderTotal) . "',fechaAlta='" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "',estatusPago='" . mysqli_real_escape_string($this->dbLink,$this->estatusPago) . "',proveedorPago='" . mysqli_real_escape_string($this->dbLink,$this->proveedorPago) . "',email='" . mysqli_real_escape_string($this->dbLink,$this->email) . "',agentId='" . mysqli_real_escape_string($this->dbLink,$this->agentId) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',type='" . mysqli_real_escape_string($this->dbLink,$this->type) . "',idAccount='" . mysqli_real_escape_string($this->dbLink,$this->idAccount) . "',id_servicio='" . mysqli_real_escape_string($this->dbLink,$this->id_servicio) . "'
					WHERE idRegisterTmp=" . $this->idRegisterTmp;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseRegistertmp::Update]");
				
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function Borrar()
		{
			if($this->getError())
				return false;
			try
			{
				$SQL="DELETE FROM registertmp
				WHERE idRegisterTmp=" . mysqli_real_escape_string($this->dbLink,$this->idRegisterTmp);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseRegistertmp::Borrar]");
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function getDatos()
		{
			try
			{
				$SQL="SELECT
						idRegisterTmp,full_name,full_lastname,empresaTxt,phone,idCountry,state,city,addressTxt,cpTxt,sameDir,full_fiscalname,emailfiscal,phonefiscal,addressFiscalTxt,cpFiscalTxt,idCountryFiscal,stateFiscal,cityFiscal,vatFiscal,domainName,password,crmLanguage,invoiceLanguage,idAmadeoOptions,nbrUsers,orderTotal,fechaAlta,estatusPago,proveedorPago,email,agentId,estatus,type,idAccount,id_servicio
					FROM registertmp
					WHERE idRegisterTmp=" . mysqli_real_escape_string($this->dbLink,$this->idRegisterTmp);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseRegistertmp::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

				if(mysqli_num_rows($result)==0)
				{
					$this->limpiarPropiedades();
				}
				else
				{
					$datos=mysqli_fetch_assoc($result);
					foreach($datos as $k=>$v)
					{
						$campo="" . $k;
						$this->$campo=$v;
					}
				}
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function Guardar()
		{
			if(!$this->validarDatos())
				return false;
			if($this->getError())
				return false;
			if($this->idRegisterTmp==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>