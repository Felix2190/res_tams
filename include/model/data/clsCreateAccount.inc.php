<?php

	#---------------------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------   Class Description   -----------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------------#
	/*
	 * This class is basically a mediatic process between data base temp registration and the execution of the web services needed to
	 * create an account in the different services/servers.
	 *
	 * It's assembled with "set" methods to give an instance to the the class properties which at the same time are related to the data fields
	 * in the database for saving the entry.
	 *
	 * Despues de hacer instanciar las propiedades, se procede a almacenar la informacion en base de datos con el metodo:
	 *
	 * addRegisterTmp
	 *
	 * A partir de este momento, ya tenemos a disposicion y con valor fijado la propiedad IdTmp
	 *
	 * Hasta aqui se puede para la ejecucion, por ejemplo, cuando se requiere la verificacion de los pagos (Paypal, otros)
	 *
	 * Despues se retoma la ejecucion, cuando dicha validacion ya fue satisfactoria, lo unico que se necesita es conocer el IdTmp con el
	 * que se almaceno en base de datos. La continuacion de la ejecucion se realiza llamando al siguiente metodo:
	 *
	 * createAccount($IdTmp)
	 *
	 * en donde el argumento $IdTmp es el idRegisterTmp de la tabla registerTmp que corresponde al registro desde el cual se desea crear
	 * una cuenta.
	 *
	 * Este metodo, dependiendo del tipo de registro (trial, payment, reseller) asigna una serie de pasos a ejecutar, en un orden concre-
	 * to. Cada paso se ejecuta primero validando si ya se ejecuto de manera previa, en caso de que efectivamanete dicho paso ya ha sido
	 * ejecutado, continua con el siguiente paso. La funcionalidad anterior nos permite retomar la creacion de una cuenta, justo en el
	 * punto que se quedo previamente. Por cada paso que se ejecuta, se almacena un registro en la tabla registroPasos.
	 *
	 * Se pueden agregar pasos a los procesos simplemente agregando el nombre del paso al arreglo (propiedad) "_steps", dicho nombre debe
	 * de coincidir con el nombre del metodo que realiza la accion de dicho paso.
	 *
	 * Consideraciones:
	 *
	 * A) Las propiedades que inician con "_" son en su mayoria de control
	 * B) La propiedad idAmadeoOptions es un arreglo que asocia las claves de los modulos de amadeo con el numero de licencias que ocu-
	 *    pa cada modulo
	 * C) Antes de ejecutar el metodo "addRegisterTmp" se debe especificar el tipo de registro con el metodo "setRegisterType"
	 * D) Si "idAmadeoOptions" tiene licencias para la clave "3" significa que es trial e ignorara el valor asignado al tipo de registro
	 *    con el metodo del punto C
	 * E) La clase contiene metodos para conocer si un error ocurre, se puede rescatar haciendo uso de los metodo "getError" y "getStrError"
	 * D) Esta clase no hace validaciones de pagos, se debe ejecutar una vez realizadas dichas validaciones cuando asi sea necesario.
	 *
	 *
	 *
	 * */


	#---------------------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------Archivos necesarios Require Include-----------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------------#

	require_once FOLDER_MODEL_DATA . "clsBasicCommon.inc.php";

	require_once(LIB_CONEXION);

	require_once FOLDER_MODEL_WS . "ws.class.AccountService.create.inc.php";
	require_once FOLDER_MODEL_WS . "ws.class.AccountService.assignAccountCategory.inc.php";
	require_once FOLDER_MODEL_WS . "ws.class.AccountService.applyPayment.inc.php";
	require_once FOLDER_MODEL_WS . "ws.class.AccountService.DebitBalance.inc.php";
	require_once FOLDER_MODEL_WS . "ws.class.AccountService.isUsernameExists.inc.php";
	require_once FOLDER_MODEL_WS . "ws.class.AccountService.isContactEmailExists.inc.php";
	require_once FOLDER_MODEL_WS . "ws.class.AccountService.isBillingEmailExists.inc.php";
	require_once FOLDER_MODEL_WS . "ws.class.AgentService.setAccountAgent.inc.php";
	require_once FOLDER_MODEL_WS . "ws.class.AccountService.CustomChargeAdd.inc.php";

	require_once FOLDER_MODEL_WSAMADEOCLOUD . "ws.class.AmadeoUpdateAmlyLicense.inc.php";
	require_once FOLDER_MODEL_WSAMADEOCLOUD . "ws.class.AmadeoUpdateSecureLicense.inc.php";
	require_once FOLDER_MODEL_WSAMADEOCLOUD . "ws.class.AmadeoUpdateU2C2License.inc.php";
	require_once FOLDER_MODEL_WSAMADEOCLOUD . "class.AmadeoUpdatePhoneLicense.inc.php";
	require_once FOLDER_MODEL_WSAMADEOCLOUD . "ws.class.AmadeoGetTenantDetails.inc.php";
	require_once FOLDER_MODEL_WSAMADEOCLOUD . "ws.class.AmadeoEditTenant.inc.php";
	require_once FOLDER_CONTROLLER . "cloudwebservice.php";
	require_once FOLDER_MODEL_DATA . "clsAddSupportOSTicket.inc.php";






class clsCreateAcccount extends clsBasicCommon
{
	#---------------------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------------------Atributos------------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------------#


	private $IdTmp;
	private $FullName;
	private $FullLastName;
	private $EmpresaTxt;
	private $Phone;
	private $IdCountry;
	private $State;
	private $City;
	private $AddressTxt;
	private $CpTxt;
	private $SameDir;

	private $FiscalFullName;
	private $FiscalEmail;
	private $FiscalPhone;
	private $FiscalAddressTxt;
	private $FiscalCpTxt;
	private $FiscalIdCountry;
	private $FiscalState;
	private $FiscalCity;
	private $FiscalVat;
	private $DomainName;
	private $Password;
	private $CrmLanguage;
	private $InvoiceLanguage;
	private $IdAmadeoOptionsStr;
	private $IdAmadeoOptionsArr;
	private $NbrUsers;
	private $OrderTotal;
	private $FechaAlta;
	private $Email;
	private $AgentId;
	private $ProveedorPago="";

	private $_status;
	private $_steps=array();
	private $_numSteps=0;
	private $_actualStep=""; //
	private $_registerType=""; //trial.reseller.payment
	private $_actualNumStep=0;
	private $_statusStep='pendiente';
	private $_idLicenses=array();
	private $_numLicenses=array();
	private $_ipnname;
	private $_idAccount;
	private $_expiryDate;
	private $_creationDate;
	private $_totalLicenses=0;
	private $_haveAnnualLicense=false;

	private $_strPathLog;
	private $_nameLog;


	private $_strErrorBD="There was an error with the data base operation.";
	private $_strErrorGenerico="There was an unexpected error. Tech support has been notified. Please wait for support feedback.";
	private $_currentDateSlash;

	private $_strTablaPasos="registroPasos";


	#---------------------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------------Construtor Destructor------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------------#

	public function __construct()
	{
		$this->_nameLog="log_" . date("YmdHis") . "_" . rand(100,999) . ".log";
		$this->_currentDateSlash=date("m/d/Y");
	}


	#---------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Setters-------------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------------#

	private function setErrorSystem($msg)
	{
		$this->Log("ErrorSystem :: " . $msg);
		if(!DEVELOPER)
		#if(false)
		{
			admin_mail("Error in Register Process",$msg,$this->_ipnname);
			amadeocloud_log("Error in Register Process " . $msg,$this->_ipnname );
		}
		$this->envioMailDesarrollo($msg);
	}

	public function Log($msg)
	{
		$date=date("Y-m-d H:i:s");
		$pf=fopen(FOLDER_LOG  . "createAccount.log", "a");
		$msg="[" . $date . "]\t[" . $this->DomainName . "][" . $this->_registerType . "]\t" . $msg;
		fwrite($pf,"\n" . $msg);
		fclose($pf);
	}

	public function setError($msg,$msgSystem="")
	{
		if($msgSystem!="")
			$this->setErrorSystem($msgSystem);
		return parent::setError($msg);
	}

	public function setLogPath($strLogPath)
	{
		$this->_strPathLog=$strLogPath;
	}

	public function setIdTmp($IdTmp)
	{
		if(trim($IdTmp)!=""&&$IdTmp!="0"&&is_numeric($IdTmp)&&$IdTmp>0)
		{
			$this->IdTmp=$IdTmp;
			$SQL="SELECT
					full_name,
					full_lastname,
					empresaTxt,
					phone,
					idCountry,
					state,
					city,
					addressTxt,
					cpTxt,
					sameDir,
					full_fiscalname,
					emailfiscal,
					phonefiscal,
					addressFiscalTxt,
					cpFiscalTxt,
					idCountryFiscal,
					stateFiscal,
					cityFiscal,
					vatFiscal,
					domainName,
					password,
					crmLanguage,
					invoiceLanguage,
					idAmadeoOptions,
					nbrUsers,
					orderTotal,
					fechaAlta,
					email,
					agentId,
					estatus,
					type,
					idAccount,
					proveedorPago
				FROM registerTmp WHERE IdRegisterTmp=" . mysql_real_escape_string($this->IdTmp);
			$record=mysql_query($SQL);
			if(!$record)
			{
				return $this->setError($this->_strErrorBD,"There was an error while searching the IdRegisterTmp. " . mysql_error());
			}
			if(mysql_numrows($record)<=0)
				return $this->setError("The IdTMP wasn't found in the data base.");
			$row=mysql_fetch_assoc($record);

			$this->FullName=$row['full_name'];
			$this->FullLastName=$row['full_lastname'];
			$this->EmpresaTxt=$row['empresaTxt'];
			$this->Phone=$row['phone'];
			$this->IdCountry=$row['idCountry'];
			$this->State=$row['state'];
			$this->City=$row['city'];
			$this->AddressTxt=$row['addressTxt'];
			$this->CpTxt=$row['cpTxt'];
			$this->SameDir=$row['sameDir'];
			$this->FiscalFullName=$row['full_fiscalname'];
			$this->FiscalEmail=$row['emailfiscal'];
			$this->FiscalPhone=$row['phonefiscal'];
			$this->FiscalAddressTxt=$row['addressFiscalTxt'];
			$this->FiscalCpTxt=$row['cpFiscalTxt'];
			$this->FiscalIdCountry=$row['idCountryFiscal'];
			$this->FiscalState=$row['stateFiscal'];
			$this->FiscalCity=$row['cityFiscal'];
			$this->FiscalVat=$row['vatFiscal'];
			$this->DomainName=$row['domainName'];
			$this->Password=$row['password'];
			$this->CrmLanguage=$row['crmLanguage'];
			$this->InvoiceLanguage=$row['invoiceLanguage'];
			$this->ProveedorPago=$row['proveedorPago'];

			$this->NbrUsers=$row['nbrUsers'];
			$this->OrderTotal=$row['orderTotal'];
			$this->FechaAlta=$row['fechaAlta'];
			$this->Email=$row['email'];
			$this->AgentId=$row['agentId'];

			$this->_status=$row['estatus'];
			$this->_registerType=$row['type'];
			$this->_ipnname="Domain name: " . $this->DomainName . "; Email: " . $this->Email;
			if($this->ProveedorPago!="")
				$this->_ipnname.=" ; Paid by " . $this->ProveedorPago;
			$this->_idAccount=$row['idAccount'];
			$this->setIdAmadeoOptions($row['idAmadeoOptions']);

			return true;
		}
		else
			return $this->setError("El IdTmp es incorrecto.");
	}

	public function setAccountId($AccountId)
	{
		$SQL="SELECT idRegisterTmp FROM registerTmp WHERE idAccount='" . $AccountId . "'";
		$record=mysql_query($SQL);
		if(!$record)
			return $this->setError($this->_strErrorBD,"Error mysql query [" . mysql_error() . "][" . $SQL . "]");
		$row=mysql_fetch_assoc($record);
		$this->setIdTmp($row['idRegisterTmp']);
	}

	public function setFullName($FullName)
	{
		$this->FullName=$FullName;
	}
	public function setFullLastName($FullLastName)
	{
		$this->FullLastName=$FullLastName;
	}
	public function setEmpresaTxt($EmpresaTxt)
	{
		$this->EmpresaTxt=$EmpresaTxt;
	}
	public function setPhone($Phone)
	{
		$this->Phone=$Phone;
	}
	public function setIdCountry($IdCountry)
	{
		$this->IdCountry=$IdCountry;
	}
	public function setState($State)
	{
		$this->State=$State;
	}
	public function setCity($City)
	{
		$this->City=$City;
	}
	public function setAddressTxt($AddressTxt)
	{
		$this->AddressTxt=$AddressTxt;
	}
	public function setCpTxt($CpTxt)
	{
		$this->CpTxt=$CpTxt;
	}
	public function setSameDir($SameDir)
	{
		$this->SameDir=$SameDir;
	}
	public function setFiscalFullName($FiscalFullName)
	{
		$this->FiscalFullName=$FiscalFullName;
	}
	public function setFiscalEmail($FiscalEmail)
	{
		$this->FiscalEmail=$FiscalEmail;
	}
	public function setFiscalPhone($FiscalPhone)
	{
		$this->FiscalPhone=$FiscalPhone;
	}
	public function setFiscalAddressTxt($FiscalAddressTxt)
	{
		$this->FiscalAddressTxt=$FiscalAddressTxt;
	}
	public function setFiscalCpTxt($FiscalCpTxt)
	{
		$this->FiscalCpTxt=$FiscalCpTxt;
	}
	public function setFiscalIdCountry($FiscalIdCountry)
	{
		$this->FiscalIdCountry=$FiscalIdCountry;
	}
	public function setFiscalState($FiscalState)
	{
		$this->FiscalState=$FiscalState;
	}
	public function setFiscalCity($FiscalCity)
	{
		$this->FiscalCity=$FiscalCity;
	}
	public function setFiscalVat($FiscalVat)
	{
		$this->FiscalVat=$FiscalVat;
	}
	public function setDomainName($DomainName)
	{
		$this->DomainName=$DomainName;
	}
	public function setPassword($Password)
	{
		$this->Password=$Password;
	}
	public function setCrmLanguage($CrmLanguage)
	{
		$this->CrmLanguage=$CrmLanguage;
	}
	public function setInvoiceLanguage($InvoiceLanguage)
	{
		$this->InvoiceLanguage=$InvoiceLanguage;
	}

	public function setIdAmadeoOptions($IdAmadeoOptions)
	{
		if(is_string($IdAmadeoOptions))
		{
			$this->IdAmadeoOptionsStr=$IdAmadeoOptions;
			$this->IdAmadeoOptionsArr=unserialize($IdAmadeoOptions);
		}
		else
		{
			$this->IdAmadeoOptionsArr=$IdAmadeoOptions;
			$this->IdAmadeoOptionsStr=serialize($IdAmadeoOptions);
		}
		$this->_idLicenses=array();
		$this->_numLicenses=array();
		foreach($this->IdAmadeoOptionsArr AS $k=>$v)
		{
			if($v!=""&&$v!="0")
			{
				$this->_idLicenses[]=$k;
				$this->_numLicenses[$k]=$v;
			}
		}

		$this->_totalLicenses=0;
		$this->_haveAnnualLicense=false;

		if(isset($this->_numLicenses[1]))
		{
			$this->_totalLicenses+=$this->_numLicenses[1];
			if($this->_numLicenses[1]>0)
				$this->_haveAnnualLicense=true;
		}

		if(isset($this->_numLicenses[2]))
		{
			$this->_totalLicenses+=$this->_numLicenses[2];
			if($this->_numLicenses[2]>0)
				$this->_haveAnnualLicense=true;
		}

		if(isset($this->_numLicenses[3]))
			$this->_totalLicenses+=$this->_numLicenses[3];

		if(isset($this->_numLicenses[4]))
			$this->_totalLicenses+=$this->_numLicenses[4];

		if(isset($this->_numLicenses[5]))
			$this->_totalLicenses+=$this->_numLicenses[5];

		$this->isTrial();

	}
	public function setNbrUsers($NbrUsers)
	{
		$this->NbrUsers=$NbrUsers;
	}
	public function setOrderTotal($OrderTotal)
	{
		$this->OrderTotal=$OrderTotal;
	}
	public function setFechaAlta($FechaAlta)
	{
		$this->FechaAlta=$FechaAlta;
	}
	public function setEmail($Email)
	{
		$this->Email=$Email;
	}
	public function setAgentId($AgentId)
	{
		$this->AgentId=$AgentId;
	}

	public function setProveedorPago($ProveedorPago)
	{
		$this->ProveedorPago=$ProveedorPago;
	}

	public function setRegisterType($type)//trial reseller payment
	{
		switch($type)
		{
			case "trial":
			case "reseller":
			case "payment":
			case "update":
			case "admin":
				$this->_registerType=$type;
				break;
			default:
				$this->setError($this->_strErrorGenerico,"The registration type is not valid. We can only register: trial, payment or reseller.");
		}
	}

	#---------------------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------------Getters-------------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------------#

	public function getIdTmp()
	{
		return $this->IdTmp;
	}
	public function getEmail()
	{
		return $this->Email;
	}
	public function getOrderTotal()
	{
		return $this->OrderTotal;
	}

	public function getStatus()
	{
	}
	public function getType()
	{
		return $this->_registerType;
	}

	public function getIdAccount()
	{
		return $this->_idAccount;
	}

	#---------------------------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------------------Actions--------------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------------#

	public function envioMailDesarrollo($message)
	{
		$mail_body_header	= "Developer,<br><br>";
		$mail_body_footer	= "<br><br><br>Thank you!<br>AmadeoCloud Website";
		$mail_headers		= "From: noreply@amadeocloud.com\r\n";
		$mail_headers		.= "Reply-To: customercare@amadeocloud.com\r\n";
		$mail_headers		.= "Return-Path: customercare@amadeocloud.com\r\n";
		$mail_headers		.= "X-Mailer: PHP\n";
		$mail_headers		.= 'MIME-Version: 1.0' . "\n";
		$mail_headers		.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$subject="There was an error during registration process";
		$Email		= "soporte@aiidia.com";
		$message		= $mail_body_header . $message . "<br /><br /> Tenant: " . $this->DomainName. "<br /><br />" . $mail_body_footer;
		@mail($Email, $subject, $message, $mail_headers);
		return;
	}


	public function isMexico()
	{
		return $this->FiscalIdCountry=="129";
	}

	public function haveAnnualLicense()
	{
		return $this->_haveAnnualLicense;
	}
	private function insert()
	{

		if(trim($this->IdAmadeoOptionsStr)=="")
			$this->IdAmadeoOptionsStr=serialize($this->IdAmadeoOptionsArr);


		$SQL="INSERT INTO registerTmp(full_name,
					full_lastname,
					empresaTxt,
					phone,
					idCountry,
					state,
					city,
					addressTxt,
					cpTxt,
					sameDir,
					full_fiscalname,
					emailfiscal,
					phonefiscal,
					addressFiscalTxt,
					cpFiscalTxt,
					idCountryFiscal,
					stateFiscal,
					cityFiscal,
					vatFiscal,
					domainName,
					password,
					crmLanguage,
					invoiceLanguage,
					idAmadeoOptions,
					nbrUsers,
					orderTotal,
					fechaAlta,
					email,agentId,proveedorPago,type)
				VALUES('" . $this->FullName . "',
					'" . $this->FullLastName . "',
					'" . $this->EmpresaTxt. "',
					'" . $this->Phone. "',
					'" . $this->IdCountry. "',
					'" . $this->State. "',
					'" . $this->City. "',
					'" . $this->AddressTxt. "',
					'" . $this->CpTxt. "',
					'" . $this->SameDir. "',
					'" . $this->FiscalFullName. "',
					'" . $this->FiscalEmail. "',
					'" . $this->FiscalPhone. "',
					'" . $this->FiscalAddressTxt. "',
					'" . $this->FiscalCpTxt. "',
					'" . $this->FiscalIdCountry. "',
					'" . $this->FiscalState. "',
					'" . $this->FiscalCity. "',
					'" . $this->FiscalVat. "',
					'" . $this->DomainName. "',
					'" . $this->Password. "',
					'" . $this->CrmLanguage. "',
					'" . $this->InvoiceLanguage. "',
					'" . $this->IdAmadeoOptionsStr. "',
					'" . $this->NbrUsers. "',
					'" . $this->OrderTotal. "',
					NOW(),
					'" . $this->Email . "',
					'" . $this->AgentId . "','" . $this->ProveedorPago . "',
					'" . $this->_registerType . "')";
		if(!mysql_query($SQL))
			return $this->setError($this->_strErrorBD,"There was an error while trying to insert the temporary registration");

		$this->IdTmp=mysql_insert_id();
		return true;
	}
	private function update()
	{


		return true;
	}
	public function isComplete()
	{
		return $this->_actualStep=="completeRegister";
	}
	public function isTrial()
	{
		if(isset($this->_numLicenses[3])&&$this->_numLicenses[3]!=""&&$this->_numLicenses[3]!="0")
		{
			$this->_registerType="trial";
			return true;
		}

		return false;
	}
	public function addRegisterTmp()
	{

		$wsAccount=new DAccountServiceIsUsernameExists();
		$wsAccount->Param->setUserName($this->DomainName);
		$wsAccount->execute();

		if($wsAccount->Response->getExists())
			return $this->setError("The Domain Name (username) is already in use. Please choose another.");

		$wsEmailExist=new DAccountServiceIsContactEmailExists();
		$wsEmailExist->Param->setEmail($this->Email);
		$wsEmailExist->execute();

		if($wsEmailExist->Response->getExists())
			return $this->setError("The contact email is already in use. Please choose another one.");

		$wsEmailBilling=new DAccountServiceIsBillingEmailExists();
		$wsEmailBilling->Param->setEmail($this->FiscalEmail);
		$wsEmailBilling->execute();

		if($wsEmailBilling->Response->getExists())
			return $this->setError("The billing email is already in use. Please choose another one.");

		if($this->IdTmp==""||$this->IdTmp==0)
			$this->insert();
		else
			$this->update();

		if($this->getError())
			return false;
		return true;
	}
	private function addStep($StepName)
	{
		$SQL="SELECT estatus FROM " . $this->_strTablaPasos . " WHERE idTmp=" . $this->IdTmp . " AND nombrePaso='" . $StepName . "'";
		$record=mysql_query($SQL);
		if(!$record)
			return $this->setError($this->_strErrorBD,"An error occur while trying to register/update the step in the table " . $this->_strTablaPasos . ".");

		if(mysql_num_rows($record)<1)
		{
			$SQL="INSERT INTO " . $this->_strTablaPasos . "(idTmp,nombrePaso,estatus,fechaInicio) VALUES(". $this->IdTmp . ",'" . $StepName . "','pendiente',NOW())";
			$record=mysql_query($SQL);
			if(!$record)
				return $this->setError($this->_strErrorBD,"An error occur while trying to register/update the step in the table " . $this->_strTablaPasos . ".");
			$this->_statusStep='pendiente';
		}
		else
		{
			$row=mysql_fetch_assoc($record);
			$this->_statusStep=$row['estatus'];
		}
		return true;
	}
	private function updateStep($StepName,$Description)
	{
		$SQL="UPDATE " . $this->_strTablaPasos . " SET observaciones=CONCAT(observaciones,'; ','" . $Description . "') WHERE idTmp=" . $this->IdTmp . " AND nombrePaso='" . $StepName . "'";
		$record=mysql_query($SQL);
		if(!$record)
			return $this->setError($this->_strErrorBD,"An error occur while trying to update the entry in the table " . $this->_strTablaPasos . ". [" . mysql_error() . "]");
		return true;
	}
	private function closeStep($StepName,$Description="")
	{
		$SQL="UPDATE " . $this->_strTablaPasos . " SET observaciones=CONCAT(observaciones,'; ','" . $Description . "'),estatus='completado',fechaCompletado=NOW() WHERE idTmp=" . $this->IdTmp . " AND nombrePaso='" . $StepName . "'";
		$record=mysql_query($SQL);
		if(!$record)
			return $this->setError($this->_strErrorBD,"An error occur while trying to close the entry in the table " . $this->_strTablaPasos . ". [" . mysql_error() . "]");
		return true;
	}
	private function getActualStep()
	{
		if($this->_registerType!="update")
		{
			$SQL="SELECT estatus FROM registerTmp WHERE idRegisterTmp=". $this->IdTmp;
			$record=mysql_query($SQL);
			if(!$record)
				return $this->setError($this->_strErrorBD,"Error while calculating the actual temp step of the registration/update process. [" . mysql_error() . "]");
			$row=mysql_fetch_assoc($record);
			$this->_status=$row['estatus'];
			if($this->_status=='completado')
			{
				$this->_actualStep='completeRegister';
				$this->_actualNumStep=999;
				return true;;
			}
		}
		$SQL="SELECT nombrePaso FROM " . $this->_strTablaPasos . " WHERE idTmp=" . $this->IdTmp . " AND estatus='pendiente'";
		$record=mysql_query($SQL);
		if(!$record)
			return $this->setError($this->_strErrorBD,"Error while calculating the actual temp step of the registration/update process. [" . mysql_error() . "]");
		if(mysql_num_rows($record)==0)
		{
			$this->_actualNumStep=0;
			$this->_actualStep="begin";
			return true;
		}

		$row=mysql_fetch_assoc($record);
		$this->_actualStep=$row['nombrePaso'];

		foreach($this->_steps AS $k=>$v)
		{
			if($v==$this->_actualStep)
			{
				$this->_actualNumStep=$k;
				break;
			}
		}
		return true;
	}
	private function initType()
	{
		switch($this->_registerType)
		{
			case "trial";
				$this->_steps=array("createAccountDamaka","insertClientDatabase","assignCategory","assignAgent","createTenant",
									"sendCustomerCpanelMail","sendAdminCpanelMail","addSupport","sendEmailMontlyHector","completeRegister");
				break;
			case "payment":
				$this->_steps=array("sendOrderMail","createAccountDamaka","insertClientDatabase","assignCategory","assignAgent","assignPayment",
									"paymentMonPhone","paymentMonUCC","paymentMonU2C2","paymentMonAmLy","paymentMonSecure",
									"paymentYeaPhone","paymentYeaUCC","paymentYeaU2C2","paymentYeaAmLy","paymentYeaSecure",
									"createTenant","assignNumberLicensesU2C2","assignNumberLicensesAmly","assignNumberLicensesSecure","assignNumberLicensesRecording","sendCustomerCpanelMail","sendAdminCpanelMail","addSupport","sendEmailMontlyHector","completeRegister");
				break;
			case "reseller":
				$this->_steps=array("sendOrderMail","createAccountDamaka","insertClientDatabase","assignCategory","assignAgent","assignPayment",
									"assignDebit","createTenant","assignNumberLicensesU2C2","assignNumberLicensesAmly","assignNumberLicensesSecure","assignNumberLicensesRecording","sendCustomerCpanelMail","sendAdminCpanelMail","addSupport","sendEmailMontlyHector","generateInvoice","completeRegister");
				break;
			case "admin":
				$this->_steps=array("sendOrderMail","createAccountDamaka","insertClientDatabase","assignCategory","assignAgent","createTenant","assignNumberLicensesU2C2","assignNumberLicensesAmly","assignNumberLicensesSecure","assignNumberLicensesRecording","sendCustomerCpanelMail","sendAdminCpanelMail","addSupport","sendEmailMontlyHector","generateInvoice","completeRegister");
				break;
			case "update":
				$this->_strTablaPasos="registroPasosUpdate";
				$this->_steps=array("updateClientDatabase","assignCategory","assignPayment",
									"paymentMonPhone","paymentMonUCC","paymentMonU2C2","paymentMonAmLy","paymentMonSecure",
									"paymentYeaPhone","paymentYeaUCC","paymentYeaU2C2","paymentYeaAmLy","paymentYeaSecure",
									"updateTenant","assignNumberLicensesU2C2","assignNumberLicensesAmly","assignNumberLicensesSecure","assignNumberLicensesRecording","sendCustomerCpanelMail","sendAdminCpanelMail","sendEmailMontlyHector","completeRegister");
				break;
		}
		$this->_numSteps=count($this->_steps);
	}

	public function createAccount($idTmp=0)
	{
		if($idTmp!=0)
			$this->setIdTmp($IdTmp);

		$this->initType();
		$this->getActualStep();
		if($this->getError())
			return false;

		$this->Log("Actual Step:" . $this->_actualStep);

		if($this->isComplete())
			return true;

		$this->Log("Registro no completo.");

		if(!is_array($this->_steps)||count($this->_steps)==0)
		{
			return $this->setError($this->_strErrorGenerico,"Could not define the step array.");
		}

		foreach($this->_steps AS $step)
		{
			$this->_actualStep=$step;

			$this->addStep($this->_actualStep);
			if($this->_statusStep=='completado')
				continue;
			$this->Log("Iniciando '" . $step . "'");
			$this->$step();
			if($this->getError())
			{
				$this->setErrorSystem("Error en paso: '" . $step . "' Mensaje: " . $this->getStrError());
				return false;
			}
			$this->closeStep($this->_actualStep);
			$this->Log("Paso '" . $step . "' terminado.");
		}
	}

	private function calcularFechaExpiracion()
	{
		$this->_creationDate=date("Y-m-d H:i:s");
		if($this->haveAnnualLicense())
			$this->_expiryDate=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", mktime()) . " + 1 year"));
		else
			$this->_expiryDate=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", mktime()) . " + 1 month"));

	}


	#---------------------------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------------------------Steps--------------------------------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------------#

	public function updateClientDatabase()
	{
		if(!mysql_query("START TRANSACTION"))
			return $this->setError($this->_strErrorBD,"Impossible to initiate the insert transaction of the client in the client table. [" . mysql_error() . "]");
		$this->_creationDate=date("Y-m-d H:i:s");


		if($this->haveAnnualLicense())
			$this->_expiryDate=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", mktime()) . " + 1 year"));
		else
			$this->_expiryDate=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", mktime()) . " + 1 month"));


		$SQL="DELETE  FROM clientMods WHERE idClient='" . $this->_idAccount . "'";
		$record=mysql_query($SQL);
		if(!$record)
			return $this->setError($this->_strErrorBD,"Impossible to initiate the update transaction of the client in the client table. [" . mysql_error() . "]");

		foreach($this->_numLicenses AS $idAmadeoOptions=>$numLicenses)
		{
			switch($idAmadeoOptions)
			{
				case 1:
				case 2:
				case 6:
				case 8:
				case 10:
					$expire=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", mktime()) . " + 1 year"));
					break;
				case 4:
				case 5:
				case 7:
				case 9:
				case 11:
					$expire=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", mktime()) . " + 1 month"));
					break;
			}

			$SQL="INSERT INTO clientMods (idClient,idAmadeoOptions,users, `create`,renew) VALUES('" . $this->_idAccount . "'," . $idAmadeoOptions . "," . $numLicenses . ",'" . $this->_creationDate . "','". $expire . "') ";
			$record=mysql_query($SQL);
			if(!$record)
				return $this->setError($this->_strErrorBD,"Impossible to update client module. [" . mysql_error() . "]["  . $SQL .  "]");
		}
		if(!mysql_query("COMMIT"))
			return $this->setError($this->_strErrorBD,"Impossible to initiate the client update in the client table. [" . mysql_error() . "]");
		return true;
	}

	public function updateTenant()
	{

		$this->calcularFechaExpiracion();


		$AmadeoUpdate=new AmadeocloudWSEditTenant();
		$AmadeoUpdate->setTenantName($this->DomainName);

		$AmadeoUpdate->setLicenseMaxUsers($this->_totalLicenses);


		$AmadeoUpdate->setLicenseExpiryDate(urlencode($this->_expiryDate));



		$edit_tenant_params		= "Tenant [".$this->DomainName."] License Max Users [".$this->_totalLicenses."] Expiry Date [".$this->_expiryDate."]";
		//amadeocloud_log("Going to Call Edit Tenant Webservice with following data ".$edit_tenant_params,$this->_ipnname);
		$AmadeoUpdate->exec();

		if($AmadeoUpdate->getError())
		{
			return $this->setError($this->_strErrorGenerico,"Error returned in edit tenant web service".$AmadeoUpdate->getStrError());
		}
	}


	public function sendOrderMail()
	{
		$order_mail_data="";
		$SQL="SELECT idAmadeoOptions,namePlain FROM amadeoOptions WHERE idAmadeoOptions IN(" . implode(",",$this->_idLicenses) . ") ORDER BY main DESC";
		$record=mysql_query($SQL);
		if(!$record)
			return $this->setError($this->_strErrorBD,"Error clsCreateAccount id 545, database query unsuccessful.");

		while($row=mysql_fetch_assoc($record))
		{
			$order_mail_data.='<li>' . $row['namePlain'] . ', ' . $this->_numLicenses[$row['idAmadeoOptions']] . ' licenses.</li>';
		}

		$numOrder="AM" . str_pad($this->IdTmp, 6,"0",STR_PAD_LEFT);
		$order_mail_data='<ul>' . $order_mail_data . '</ul>';
		$myfile = fopen("/etc/cloudOrderMail.txt", "r");
		$ordermail =fread($myfile,filesize("/etc/cloudOrderMail.txt"));
		fclose($myfile);
		$ordermail = str_replace('###ordernumber###', $numOrder, $ordermail);
		$ordermail = str_replace('###table###', $order_mail_data,$ordermail );
		customer_mail($this->Email,"Welcome to Amadeo Cloud",$ordermail,$this->_ipnname);
	}

	public function createAccountDamaka()
	{
		$wsCreate=new DAccountServiceCreate();


		$wsCreate->Param->setEmail($this->Email);
		$wsCreate->Param->setPassword($this->Password);
		$wsCreate->Param->setFirstName($this->FullName);
		$wsCreate->Param->setLastName($this->FullLastName);
		$wsCreate->Param->setUserName($this->DomainName);
		$wsCreate->Param->setCompanyName($this->EmpresaTxt);
		$wsCreate->Param->setPhone($this->Phone);
		$wsCreate->Param->setAddress($this->AddressTxt);
		$wsCreate->Param->setZip($this->CpTxt);
		$wsCreate->Param->setCountryId($this->IdCountry);
		if($this->IdCountry=="217"||$this->IdCountry=="37")
			$wsCreate->Param->setStateId($this->State);
		$wsCreate->Param->setCity($this->City);
		$wsCreate->Param->setBillFirstName($this->FiscalFullName);
		$wsCreate->Param->setBillLastName($this->FiscalFullName);
		$wsCreate->Param->setBillEmail($this->FiscalEmail);
		$wsCreate->Param->setBillPhone($this->FiscalPhone);
		$wsCreate->Param->setBillAddress($this->FiscalAddressTxt);
		$wsCreate->Param->setBillZip($this->FiscalCpTxt);
		$wsCreate->Param->setBillCountryId($this->FiscalIdCountry);
		if($this->FiscalIdCountry=="217"||$this->FiscalIdCountry=="37")
			$wsCreate->Param->setBillStateId($this->FiscalState);
		$wsCreate->Param->setBillCity($this->FiscalCity);

		if($this->FiscalIdCountry=="129")
			$wsCreate->Param->setPlanId(2);
		else
			$wsCreate->Param->setPlanId(3);

		$wsCreate->Param->setStatus(1);
		$wsCreate->Param->setType(1);
		$wsCreate->execute();

		$wsCreate->makeDebugFile(FOLDER_LOG);

		if($wsCreate->getError())
		{
			return $this->setError($this->_strErrorGenerico,"It was impossible to create the account in Damaka VOIP: " . $wsCreate->getStrError());
		}

		$this->_idAccount=$wsCreate->Response->getAccountId();
		$SQL="UPDATE registerTmp SET idAccount='" . $this->_idAccount . "' WHERE IdRegisterTmp=" . $this->IdTmp;
		$record=mysql_query($SQL);
		if(!$record)
			return $this->setError($this->_strErrorBD,"There was an error while trying to update the table registerTmp, IdAccount creado: " . $this->_idAccount . ". [" . mysql_error() . "]");
	}
	public function insertClientDatabase()
	{
		if(!mysql_query("START TRANSACTION"))
			return $this->setError($this->_strErrorBD,"Impossible to initiate the insert transaction of the client in the client table. [" . mysql_error() . "]");
		$this->_creationDate=date("Y-m-d H:i:s");

		if($this->_registerType=="trial")
		{
			$this->_expiryDate=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", mktime()) . " + 15 day"));
		}
		else
		{
			if($this->haveAnnualLicense())
				$this->_expiryDate=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", mktime()) . " + 1 year"));
			else
				$this->_expiryDate=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", mktime()) . " + 1 month"));
		}

		$SQL="INSERT INTO clients (AccountId,domain,users,setup,renew,estatus,email)
				VALUES('".$this->_idAccount . "','".$this->DomainName."',".$this->_totalLicenses.",'".$this->_creationDate."','".$this->_expiryDate."','activo','" . $this->Email . "')";
		$record=mysql_query($SQL);
		if(!$record)
			$this->setError($this->_strErrorBD,"Impossible to insert the client in the client table; [" . mysql_error() . "]");
		foreach($this->_numLicenses AS $idAmadeoOptions=>$numLicenses)
		{
			switch($idAmadeoOptions)
			{
				case 1:
				case 2:
				case 6:
				case 8:
				case 10:
					$expire=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", mktime()) . " + 1 year"));
					break;
				case 4:
				case 5:
				case 7:
				case 9:
				case 11:
					$expire=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", mktime()) . " + 1 month"));
					$this->_expiryDate=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", mktime()) . " + 1 month"));
					break;
				case 3:
					$expire=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", mktime()) . " + 15 day"));
			}
			$expire=
			$SQL="INSERT INTO clientMods (idClient,idAmadeoOptions,users, `create`,renew) VALUES('" . $this->_idAccount . "'," . $idAmadeoOptions . "," . $numLicenses . ",'" . $this->_creationDate . "','". $expire . "') ";
			$record=mysql_query($SQL);
			if(!$record)
				return $this->setError($this->_strErrorBD,"Impossible to register client module. [" . mysql_error() . "]["  . $SQL .  "]");
		}
		if(!mysql_query("COMMIT"))
			return $this->setError($this->_strErrorBD,"Impossible to initiate the client insertion in the client table. [" . mysql_error() . "]");
		return true;
	}
	public function assignCategory()
	{

		$assignCategory=new DAccountServiceAssignAccountCategory();
		$assignCategory->Param->setAccountId($this->_idAccount);
		switch($this->FiscalIdCountry)
		{
			case "129"://Mexico
				$assignCategory->Param->setCategoryId(2);
				break;
			case "217"://USA
				$assignCategory->Param->setCategoryId(3);
				break;
			default:
				$assignCategory->Param->setCategoryId(4);
		}
		$assignCategory->execute();
		if($assignCategory->getError())
			return $this->setError($this->_strErrorGenerico,"Impossible to assign category: " . $assignCategory->getStrError());


	}
	public function assignAgent()
	{
		$asignarAgente=new DAgentServiceSetAccountAgent();
		$asignarAgente->Param->setAccountId($this->_idAccount);
		$asignarAgente->Param->setAgentId($this->AgentId);
		$asignarAgente->execute();
		if($asignarAgente->getError())
		{
			$asignarAgente->Param->setAgentId(1);
			$asignarAgente->execute();
			if($asignarAgente->getError())
				return $this->setError($this->_strErrorGenerico,"Impossible to assign the agent. [" . $asignarAgente->getStrError() . "]");

			/*
				amadeocloud_log("Error in SetAccountAgent ipn.inc.php Ln 840[" . $asignarAgente->getStrError() . "]",$ipnname );
				fwrite($fLog,"\n\nError in SetAccountAgent ipn.inc.php Ln 840");
				admin_mail("Error in Register Process","Encountered an error while attempting to set Account Agent for user in VoIP".$paypal_results,$ipnname);
			*/


		}
		return true;
	}
	public function assignPayment()
	{
		$ApplyPayment	=new DAccountServiceApplyPayment();
		$ApplyPayment->Param->setAccountId($this->_idAccount);
		$ApplyPayment->Param->setAmount($this->OrderTotal);
		$ApplyPayment->Param->setIp(" ");
		$ApplyPayment->Param->setNote("AmadeoCloud Subscription Service");
		$ApplyPayment->execute();
		if($ApplyPayment->getError())
			return $this->setError($this->_strErrorGenerico,"Impossible to apply payment in the AvaVOIP account. [" . $ApplyPayment->getStrError() . "]");
		return true;

	}


	public function assignDebit()
	{




		/*
		$ApplyDebit=new DAccountServiceDebitBalance();
		$ApplyDebit->Param->setAccountId($this->_idAccount);
		$ApplyDebit->Param->setAmount($this->OrderTotal);
		$ApplyDebit->Param->setIp(" ");
		$ApplyDebit->Param->setNote("Amadeo Initial Purchase");
		$ApplyDebit->execute();
		if($ApplyDebit->getError())
			return $this->setError($this->_strErrorGenerico,"Impossible to apply the debit in the AvaVOIP account. [" . $ApplyDebit->getStrError() . "]");
		*/

	}
	public function createTenant()
	{
		$category		= "AmadeoCloud Subscription Service";
		$adminpassword		= base64_encode($this->Password);
		$Meeting		= "ON";
		$Broadcast		= "ON";
		$Pbx			= "ON";
		$Pstn			= "ON";
		$Vcs			= "ON";


		$UCCLicences=0;
		$PhoneLicences=0;

		/*Calcular la cantidad de licencias*/

		if($this->_registerType=="trial")
		{
			$UCCLicences=5;
			$PhoneLicences=0;
		}
		else
		{

			if(isset($this->_numLicenses[1]))
				$UCCLicences+=$this->_numLicenses[1];
			if(isset($this->_numLicenses[4]))
				$UCCLicences+=$this->_numLicenses[4];



			if(isset($this->_numLicenses[2]))
				$PhoneLicences+=$this->_numLicenses[2];
			if(isset($this->_numLicenses[5]))
				$PhoneLicences+=$this->_numLicenses[5];
		}



		/***********************************/

		if($UCCLicences!=0&&$PhoneLicences!=0)
			$PackageTypeVal="AMADEOUCC+AMADEOPHONE";
		elseif($UCCLicences!=0&&$PhoneLicences==0)
			$PackageTypeVal="AMADEOUCC";
		elseif($UCCLicences==0&&$PhoneLicences!=0)
			$PackageTypeVal="AMADEOPHONE";
		else
			return $this->setError($this->_strErrorGenerico,"Error en el calculo de las licencias en AddTenant");








		if($UCCLicences>0)
			$Ucc="ON";
		else
			$Ucc="OFF";

		if($this->_registerType=="trial")
			$trial_mode		= "ON";
		else
			$trial_mode		= "OFF";

		$result=tenant_creation(
				$this->_idAccount,
				$category,
				$this->_creationDate,
				$this->DomainName,
				$adminpassword,
				$UCCLicences,
				$this->_expiryDate,
				$Meeting,
				$Broadcast,
				$Pbx,
				$Pstn,
				$Vcs,
				$this->Email,
				$Ucc,
				$trial_mode,
				WEBSERVICE_KEY,
				$PackageTypeVal,
				$PhoneLicences);

		if($result->damaka->openinterface->UIaddTenant->statuscode!="200")
			return $this->setError($this->_strErrorGenerico,"There was an error while trying to create the Tenant. [" . $result->damaka->openinterface->UIaddTenant->description . "]");
		return true;
	}


	public function assignNumberLicensesUCC()
	{
		return true;
	}
	public function assignNumberLicensesPhone()
	{
		if($this->_registerType=="trial")
		//{
			return true;
			//$numLicenses=0;
		//}
		//else
		//{
			$numLicenses=0;
			if(isset($this->_numLicenses[2]))
				$numLicenses+=$this->_numLicenses[2];
			if(isset($this->_numLicenses[5]))
				$numLicenses+=$this->_numLicenses[5];
		//}



		if($numLicenses==0)
			return true;

		$wsAmadeoPhone=new AmadeoCloudWSUpdatePhoneLicense();
		$wsAmadeoPhone->setTenantName($this->DomainName);

		//if($numLicenses>0)
			$wsAmadeoPhone->setStatus("ON");
		//else
			//$wsAmadeoPhone->setStatus("OFF");

		$wsAmadeoPhone->setNoOfLicense($numLicenses);
		$wsAmadeoPhone->exec();

		if($wsAmadeoPhone->getError())
			return $this->setError($this->_strErrorGenerico,"There was an error while updating the Universal license module [" . $wsAmadeoPhone->getStrError() . "]");
		return true;
	}
	public function assignNumberLicensesU2C2()
	{
		if($this->_registerType=="trial")
		{
			$numLicenses=5;
		}
		else
		{
			$numLicenses=0;
			if(isset($this->_numLicenses[6]))
				$numLicenses+=$this->_numLicenses[6];
			if(isset($this->_numLicenses[7]))
				$numLicenses+=$this->_numLicenses[7];
		}

		$wsAmadeoUniversal=new AmadeoCloudWSUpdateU2C2License();
		$wsAmadeoUniversal->setTenantName($this->DomainName);
		$wsAmadeoUniversal->setStatus("ON");
		$wsAmadeoUniversal->setNoOfLicense($numLicenses);
		$wsAmadeoUniversal->exec();

		if($wsAmadeoUniversal->getError())
			return $this->setError($this->_strErrorGenerico,"There was an error while updating the Universal license module [" . $wsAmadeoUniversal->getStrError() . "]");
		return true;
	}
	public function assignNumberLicensesAmly()
	{
		return true;
		/*
		if($this->_registerType=="trial")
		{
			$numLicenses=5;
		}
		else
		{
			$numLicenses=0;
			if(isset($this->_numLicenses[8]))
				$numLicenses+=$this->_numLicenses[8];
			if(isset($this->_numLicenses[9]))
				$numLicenses+=$this->_numLicenses[9];
		}

		$wsAmadeoAmLy=new AmadeoCloudWSUpdateAmlyLicense();
		$wsAmadeoAmLy->setTenantName($this->DomainName);
		$wsAmadeoAmLy->setStatus("ON");
		$wsAmadeoAmLy->setNoOfLicense($numLicenses);
		$wsAmadeoAmLy->exec();


		if($wsAmadeoAmLy->getError())
			return $this->setError($this->_strErrorGenerico,"There was an error while updating the AmLy license module [" . $wsAmadeoAmLy->getStrError() . "]");
		return true;
		*/
	}
	public function assignNumberLicensesSecure()
	{
		return true;
		$numLicenses=0;
		if($this->_registerType!="trial")
		{
			if(isset($this->_numLicenses[10]))
				$numLicenses+=$this->_numLicenses[10];
			if(isset($this->_numLicenses[11]))
				$numLicenses+=$this->_numLicenses[11];
		}
		$wsAmadeoSecure=new AmadeoCloudWSUpdateSecureLicense();
		$wsAmadeoSecure->setTenantName($this->DomainName);
		$wsAmadeoSecure->setNoOfLicense($numLicenses);
		$wsAmadeoSecure->setStatus("ON");
		$wsAmadeoSecure->exec();
		if($wsAmadeoSecure->getError())
			$this->setError($this->_strErrorGenerico,"There was an error while updating the Secure license module [" . $wsAmadeoSecure->getStrError() . "]");
	}


	public function assignNumberLicensesRecording()
	{
		$Record=new AmadeoSetCallRecordLicense();
		$Record->setNoOfLicense($this->_numLicenses[13]+$this->_numLicenses[12]);
		$Record->setTenantName($this->DomainName);
		$Record->setStatusON();

		$Record->exec();

		if($Record->getError())
			return $this->setError($this->_strErrorGenerico,"There was an error while updating the PBX Recording Pack [" . $Record->getStrError() . "]");
		return true;

	}

	public function sendCustomerCpanelMail()
	{
		$customer_text_path	= "/etc/cloudClientActivationMail.txt";
		$myfile			= fopen($customer_text_path, "r") or die("Unable to open file!");
		$clientmail		= fread($myfile,filesize($customer_text_path));
		fclose($myfile);
		$clientmail		= str_replace('###USER_ID_PLACEHOLDER###', $this->FullName, $clientmail);
		$clientmail		= str_replace('###CPANEL_URL###',CPANEL_URL,$clientmail );
		$clientmail		= str_replace('###CUSTOMER###', $this->DomainName,$clientmail );
		$clientmail		= str_replace('###PASSWORD###', $this->Password,$clientmail );
		customer_mail($this->Email, "Welcome to Amadeo Cloud", $clientmail,$this->_ipnname);
		return true;
	}
	public function sendAdminCpanelMail()
	{
		$SQL="SELECT idAmadeoOptions,namePlain FROM amadeoOptions";
		$record=mysql_query($SQL);
		if(!$record)
			return $this->setError($this->_strErrorBD,"There was a calculation error in the amadeoOptions. [" . mysql_error() . "]");
		$amadeoOptions=array();
		while($row=mysql_fetch_assoc($record))
			$amadeoOptions[$row['idAmadeoOptions']]=$row['namePlain'];
		$package=array();
		$licensemaxusers=array();
		foreach ($this->_numLicenses AS $idLicense=>$numUsers)
		{
			$package[]=$amadeoOptions[$idLicense];
			$licensemaxusers[]=$numUsers;
		}
		$package=implode(", ",$package);
		$licensemaxusers=implode(", ",$licensemaxusers);
		$adminmail_text_path	= "/etc/cloudTrialActivationMail.txt";
		$adminmail		= fopen($adminmail_text_path, "r") or die("Unable to open file!");
		$adminmail		= fread($adminmail,filesize($adminmail_text_path));
		$package="Amadeo 14 Day Trial";
		$adminmail	=	str_replace('###NAME###',$this->FullName,$adminmail);
		$adminmail	=	str_replace('###CUSTOMER_ID###',$this->DomainName,$adminmail);
		$adminmail	=	str_replace('###PACKAGE###',$package,$adminmail);
		$adminmail	=	str_replace('###MAX_USERS###',$licensemaxusers,$adminmail);
		$adminmail	=	str_replace('###EXPIRY_DATE###',$this->_expiryDate,$adminmail);
		$adminmail	=	str_replace('###EMAIL_ID###',$this->Email,$adminmail);

		if($this->isTrial())
			$sub="Amadeo Cloud Trial Tenant Created";
		else
			$sub="Amadeo Cloud Payment Tenant Created";
		admin_mail($sub,$adminmail,$this->_ipnname);
		return true;
	}
	public function addSupport()
	{
		$add=new AddSupportSOTickect();
		if($add->getError())
		{
			$this->setError($this->_strErrorGenerico,"Impossible to initiate object for OS ticket support registration. [" . $add->getStrError() . "] [No se detiene proceso de alta de cuenta, solo no tiene soporte]");
			$this->error=false;
			ConectarBD();
			return true;
		}
		$add->setName($this->FullName . " " . $this->FullLastName);
		$add->setUserName($this->DomainName);
		$add->setEmail($this->Email);
		$add->setPass(OSTICKET_PASS);
		$add->exec();
		if($add->getError())
		{
			$this->setError($this->_strErrorGenerico,"Impossible OS Ticket support. [" . $add->getStrError() . "][Account is created, it just won't have access to support section]");
			$this->error=false;
			ConectarBD();
			return true;
		}

		//Se ejecuta la siguiente funcion para recuperar el enlace a la base de datos principal,
		//ya que la clase AddSupportSOTickect abre conexion a la base de datos de soporte.

		ConectarBD();

		return true;
	}
	public function sendEmailMontlyHector()
	{
		$suma=0;
		if(isset($this->_numLicenses[4])&&$this->_numLicenses[4]!=0)
			$suma+=$this->_numLicenses[4];
		if(isset($this->_numLicenses[5])&&$this->_numLicenses[5]!=0)
			$suma+=$this->_numLicenses[5];
		if($suma!=0)
		{

			$suma=
			$strEnvio='
				AccountID: ' . $this->_idAccount . '<br />
				Num users: ' . $suma . '<br />
				 		';

			$mail_headers = "From: noreply@amadeocloud.com\r\n";
			$mail_headers .= "X-Mailer: PHP\n";
			$mail_headers .= 'MIME-Version: 1.0' . "\n";
			$mail_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$Destino="hector@damaka.net";

			if(!@mail($Destino, "Monthly Amadeo Cloud Suscription", $strEnvio, $mail_headers))
				return $this->setError($this->_strErrorGenerico,"There was an error when trying to send the mail regarding monthly payments.");
		}
	}
	public function generateInvoice()
	{
		return true;
	}
	public function completeRegister()
	{
		$SQL="UPDATE registerTmp SET estatus='completado' WHERE IdRegisterTmp=" . $this->IdTmp;
		$record=mysql_query($SQL);
		if(!$record)
			return $this->setError($this->_strErrorBD,"An error occur while updating the estatus filed in the registerTmp table. [" . mysql_error() . "][" . $SQL . "]");
	}

	#---------------------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------   Metodos para asignacion de pagos con addCustomCharge   ------------------------------------#
	#---------------------------------------------------------------------------------------------------------------------------------#

	public function paymentMonPhone()
	{
		if(!isset($this->_numLicenses[5])||$this->_numLicenses[5]==0)
			return true;

		$charge=new DAccountServiceCustomChargeAdd();
		$charge->Param->setAccountId($this->_idAccount);
		$charge->Param->setChargeType(4);

		if($this->isMexico())
		{
			$charge->Param->setChargeId("130");
			$charge->Param->setUnitId("18");
		}
		else
		{
			$charge->Param->setChargeId("137");
			$charge->Param->setUnitId("16");
		}
		$charge->Param->setEffectiveDate($this->_currentDateSlash);
		$charge->Param->setQuantity($this->_numLicenses[5]);

		$charge->execute();
		if($charge->getError())
			return $this->setError($this->_strErrorGenerico,$charge->getStrError());
		return true;

	}
	public function paymentMonUCC()
	{
		if(!isset($this->_numLicenses[4])||$this->_numLicenses[4]==0)
			return true;

		$charge=new DAccountServiceCustomChargeAdd();
		$charge->Param->setAccountId($this->_idAccount);
		$charge->Param->setChargeType(4);

		if($this->isMexico())
		{
			$charge->Param->setChargeId("131");
			$charge->Param->setUnitId("18");
		}
		else
		{
			$charge->Param->setChargeId("136");
			$charge->Param->setUnitId("16");
		}
		$charge->Param->setEffectiveDate($this->_currentDateSlash);
		$charge->Param->setQuantity($this->_numLicenses[4]);

		$charge->execute();
		if($charge->getError())
			return $this->setError($this->_strErrorGenerico,$charge->getStrError());
		return true;

	}
	public function paymentMonU2C2()
	{
		if(!isset($this->_numLicenses[7])||$this->_numLicenses[7]==0)
			return true;

		$charge=new DAccountServiceCustomChargeAdd();
		$charge->Param->setAccountId($this->_idAccount);
		$charge->Param->setChargeType(4);

		if($this->isMexico())
		{
			$charge->Param->setChargeId("132");
			$charge->Param->setUnitId("18");
		}
		else
		{
			$charge->Param->setChargeId("138");
			$charge->Param->setUnitId("16");
		}
		$charge->Param->setEffectiveDate($this->_currentDateSlash);
		$charge->Param->setQuantity($this->_numLicenses[7]);

		$charge->execute();
		if($charge->getError())
			return $this->setError($this->_strErrorGenerico,$charge->getStrError());
		return true;

	}
	public function paymentMonAmLy()
	{
		if(!isset($this->_numLicenses[9])||$this->_numLicenses[9]==0)
			return true;

		$charge=new DAccountServiceCustomChargeAdd();
		$charge->Param->setAccountId($this->_idAccount);
		$charge->Param->setChargeType(4);

		if($this->isMexico())
		{
			$charge->Param->setChargeId("133");
			$charge->Param->setUnitId("18");
		}
		else
		{
			$charge->Param->setChargeId("139");
			$charge->Param->setUnitId("16");
		}
		$charge->Param->setEffectiveDate($this->_currentDateSlash);
		$charge->Param->setQuantity($this->_numLicenses[9]);

		$charge->execute();
		if($charge->getError())
			return $this->setError($this->_strErrorGenerico,$charge->getStrError());
		return true;

	}
	public function paymentMonSecure()
	{
		if(!isset($this->_numLicenses[11])||$this->_numLicenses[11]==0)
			return true;

		$charge=new DAccountServiceCustomChargeAdd();
		$charge->Param->setAccountId($this->_idAccount);
		$charge->Param->setChargeType(4);

		if($this->isMexico())
		{
			$charge->Param->setChargeId("134");
			$charge->Param->setUnitId("18");
		}
		else
		{
			$charge->Param->setChargeId("140");
			$charge->Param->setUnitId("16");
		}
		$charge->Param->setEffectiveDate($this->_currentDateSlash);
		$charge->Param->setQuantity($this->_numLicenses[11]);

		$charge->execute();
		if($charge->getError())
			return $this->setError($this->_strErrorGenerico,$charge->getStrError());
		return true;

	}
	public function paymentYeaPhone()
	{
		if(!isset($this->_numLicenses[2])||$this->_numLicenses[2]==0)
			return true;

		$charge=new DAccountServiceCustomChargeAdd();
		$charge->Param->setAccountId($this->_idAccount);
		$charge->Param->setChargeType(4);

		if($this->isMexico())
		{
			$charge->Param->setChargeId("148");
			$charge->Param->setUnitId("18");
		}
		else
		{
			$charge->Param->setChargeId("143");
			$charge->Param->setUnitId("16");
		}
		$charge->Param->setEffectiveDate($this->_currentDateSlash);
		$charge->Param->setQuantity($this->_numLicenses[2]);

		$charge->execute();
		if($charge->getError())
			return $this->setError($this->_strErrorGenerico,$charge->getStrError());
		return true;

	}
	public function paymentYeaUCC()
	{
		if(!isset($this->_numLicenses[1])||$this->_numLicenses[1]==0)
			return true;

		$charge=new DAccountServiceCustomChargeAdd();
		$charge->Param->setAccountId($this->_idAccount);
		$charge->Param->setChargeType(4);

		if($this->isMexico())
		{
			$charge->Param->setChargeId("147");
			$charge->Param->setUnitId("18");
		}
		else
		{
			$charge->Param->setChargeId("142");
			$charge->Param->setUnitId("16");
		}
		$charge->Param->setEffectiveDate($this->_currentDateSlash);
		$charge->Param->setQuantity($this->_numLicenses[1]);

		$charge->execute();
		if($charge->getError())
			return $this->setError($this->_strErrorGenerico,$charge->getStrError());
		return true;

	}
	public function paymentYeaU2C2()
	{

		if(!isset($this->_numLicenses[6])||$this->_numLicenses[6]==0)
			return true;

		$charge=new DAccountServiceCustomChargeAdd();
		$charge->Param->setAccountId($this->_idAccount);
		$charge->Param->setChargeType(4);

		if($this->isMexico())
		{
			$charge->Param->setChargeId("150");
			$charge->Param->setUnitId("18");
		}
		else
		{
			$charge->Param->setChargeId("145");
			$charge->Param->setUnitId("16");
		}
		$charge->Param->setEffectiveDate($this->_currentDateSlash);
		$charge->Param->setQuantity($this->_numLicenses[6]);

		$charge->execute();
		if($charge->getError())
			return $this->setError($this->_strErrorGenerico,$charge->getStrError());
		return true;

	}
	public function paymentYeaAmLy()
	{
		if(!isset($this->_numLicenses[8])||$this->_numLicenses[8]==0)
			return true;

		$charge=new DAccountServiceCustomChargeAdd();
		$charge->Param->setAccountId($this->_idAccount);
		$charge->Param->setChargeType(4);

		if($this->isMexico())
		{
			$charge->Param->setChargeId("149");
			$charge->Param->setUnitId("18");
		}
		else
		{
			$charge->Param->setChargeId("144");
			$charge->Param->setUnitId("16");
		}
		$charge->Param->setEffectiveDate($this->_currentDateSlash);
		$charge->Param->setQuantity($this->_numLicenses[8]);

		$charge->execute();
		if($charge->getError())
			return $this->setError($this->_strErrorGenerico,$charge->getStrError());
		return true;

	}
	public function paymentYeaSecure()
	{
		if(!isset($this->_numLicenses[10])||$this->_numLicenses[10]==0)
			return true;

		$charge=new DAccountServiceCustomChargeAdd();
		$charge->Param->setAccountId($this->_idAccount);
		$charge->Param->setChargeType(4);

		if($this->isMexico())
		{
			$charge->Param->setChargeId("151");
			$charge->Param->setUnitId("18");
		}
		else
		{
			$charge->Param->setChargeId("146");
			$charge->Param->setUnitId("16");
		}
		$charge->Param->setEffectiveDate($this->_currentDateSlash);
		$charge->Param->setQuantity($this->_numLicenses[10]);

		$charge->execute();
		if($charge->getError())
			return $this->setError($this->_strErrorGenerico,$charge->getStrError());
		return true;


	}





}