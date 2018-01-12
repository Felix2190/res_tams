<?php

	class ModeloBaseCliente extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseCliente";

		
		var $idcliente=0;
		var $fechaAlta='';
		var $idLoginMember=0;
		var $nombreC='';
		var $aPaternoC='';
		var $aMaternoC='';
		var $emailC='';
		var $rSocialC='';
		var $paisC='';
		var $estadoC='';
		var $CPC='';
		var $municipioC='';
		var $ciudadC='';
		var $coloniaC='';
		var $calleC='';
		var $noExteriorC='';
		var $noInteriorC='';
		var $areaTelefonoC='';
		var $ladaTelCasaC='';
		var $telCasaC='';
		var $extensionC='';
		var $nombreF='';
		var $aPaternoF='';
		var $aMaternoF='';
		var $emailF='';
		var $rSocialF='';
		var $paisF='';
		var $estadoF='';
		var $CPF='';
		var $municipioF='';
		var $ciudadF='';
		var $coloniaF='';
		var $calleF='';
		var $noExteriorF='';
		var $noInteriorF='';
		var $areaTelefonoF='';
		var $ladaTelCasaF='';
		var $telCasaF='';
		var $extensionF='';
		var $RFC='';
		var $areaTelCasaCA='';
		var $LadaTelCasaCA='';
		var $TelCasaCA='';
		var $nombreCF='';
		var $aPaternoCF='';
		var $aMaternoCF='';
		var $emailCF='';
		var $areaTelCasaCF='';
		var $LadaTelCasaCF='';
		var $TelCasaCF='';
		var $nombreCT='';
		var $aPaternoCT='';
		var $aMaternoCT='';
		var $emailCT='';
		var $areaTelCasaCT='';
		var $LadaTelCasaCT='';
		var $TelCasaCT='';
		var $estatus='disponible';
		var $id_usuario=0;

		var $__s=array("idcliente","fechaAlta","idLoginMember","nombreC","aPaternoC","aMaternoC","emailC","rSocialC","paisC","estadoC","CPC","municipioC","ciudadC","coloniaC","calleC","noExteriorC","noInteriorC","areaTelefonoC","ladaTelCasaC","telCasaC","extensionC","nombreF","aPaternoF","aMaternoF","emailF","rSocialF","paisF","estadoF","CPF","municipioF","ciudadF","coloniaF","calleF","noExteriorF","noInteriorF","areaTelefonoF","ladaTelCasaF","telCasaF","extensionF","RFC","areaTelCasaCA","LadaTelCasaCA","TelCasaCA","nombreCF","aPaternoCF","aMaternoCF","emailCF","areaTelCasaCF","LadaTelCasaCF","TelCasaCF","nombreCT","aPaternoCT","aMaternoCT","emailCT","areaTelCasaCT","LadaTelCasaCT","TelCasaCT","estatus","id_usuario");
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

		
		public function setIdcliente($idcliente)
		{
			if($idcliente==0||$idcliente==""||!is_numeric($idcliente)|| (is_string($idcliente)&&!ctype_digit($idcliente)))return $this->setError("Tipo de dato incorrecto para idcliente.");
			$this->idcliente=$idcliente;
			$this->getDatos();
		}
		public function setFechaAlta($fechaAlta)
		{
			$this->fechaAlta=$fechaAlta;
		}
		public function setIdLoginMember($idLoginMember)
		{
			
			$this->idLoginMember=$idLoginMember;
		}
		public function setNombreC($nombreC)
		{
			
			$this->nombreC=$nombreC;
		}
		public function setAPaternoC($aPaternoC)
		{
			
			$this->aPaternoC=$aPaternoC;
		}
		public function setAMaternoC($aMaternoC)
		{
			
			$this->aMaternoC=$aMaternoC;
		}
		public function setEmailC($emailC)
		{
			
			$this->emailC=$emailC;
		}
		public function setRSocialC($rSocialC)
		{
			
			$this->rSocialC=$rSocialC;
		}
		public function setPaisC($paisC)
		{
			
			$this->paisC=$paisC;
		}
		public function setEstadoC($estadoC)
		{
			
			$this->estadoC=$estadoC;
		}
		public function setCPC($CPC)
		{
			
			$this->CPC=$CPC;
		}
		public function setMunicipioC($municipioC)
		{
			
			$this->municipioC=$municipioC;
		}
		public function setCiudadC($ciudadC)
		{
			
			$this->ciudadC=$ciudadC;
		}
		public function setColoniaC($coloniaC)
		{
			
			$this->coloniaC=$coloniaC;
		}
		public function setCalleC($calleC)
		{
			
			$this->calleC=$calleC;
		}
		public function setNoExteriorC($noExteriorC)
		{
			
			$this->noExteriorC=$noExteriorC;
		}
		public function setNoInteriorC($noInteriorC)
		{
			
			$this->noInteriorC=$noInteriorC;
		}
		public function setAreaTelefonoC($areaTelefonoC)
		{
			
			$this->areaTelefonoC=$areaTelefonoC;
		}
		public function setLadaTelCasaC($ladaTelCasaC)
		{
			
			$this->ladaTelCasaC=$ladaTelCasaC;
		}
		public function setTelCasaC($telCasaC)
		{
			
			$this->telCasaC=$telCasaC;
		}
		public function setExtensionC($extensionC)
		{
			
			$this->extensionC=$extensionC;
		}
		public function setNombreF($nombreF)
		{
			
			$this->nombreF=$nombreF;
		}
		public function setAPaternoF($aPaternoF)
		{
			
			$this->aPaternoF=$aPaternoF;
		}
		public function setAMaternoF($aMaternoF)
		{
			
			$this->aMaternoF=$aMaternoF;
		}
		public function setEmailF($emailF)
		{
			
			$this->emailF=$emailF;
		}
		public function setRSocialF($rSocialF)
		{
			
			$this->rSocialF=$rSocialF;
		}
		public function setPaisF($paisF)
		{
			
			$this->paisF=$paisF;
		}
		public function setEstadoF($estadoF)
		{
			
			$this->estadoF=$estadoF;
		}
		public function setCPF($CPF)
		{
			
			$this->CPF=$CPF;
		}
		public function setMunicipioF($municipioF)
		{
			
			$this->municipioF=$municipioF;
		}
		public function setCiudadF($ciudadF)
		{
			
			$this->ciudadF=$ciudadF;
		}
		public function setColoniaF($coloniaF)
		{
			
			$this->coloniaF=$coloniaF;
		}
		public function setCalleF($calleF)
		{
			
			$this->calleF=$calleF;
		}
		public function setNoExteriorF($noExteriorF)
		{
			
			$this->noExteriorF=$noExteriorF;
		}
		public function setNoInteriorF($noInteriorF)
		{
			
			$this->noInteriorF=$noInteriorF;
		}
		public function setAreaTelefonoF($areaTelefonoF)
		{
			
			$this->areaTelefonoF=$areaTelefonoF;
		}
		public function setLadaTelCasaF($ladaTelCasaF)
		{
			
			$this->ladaTelCasaF=$ladaTelCasaF;
		}
		public function setTelCasaF($telCasaF)
		{
			
			$this->telCasaF=$telCasaF;
		}
		public function setExtensionF($extensionF)
		{
			
			$this->extensionF=$extensionF;
		}
		public function setRFC($RFC)
		{
			
			$this->RFC=$RFC;
		}
		public function setAreaTelCasaCA($areaTelCasaCA)
		{
			
			$this->areaTelCasaCA=$areaTelCasaCA;
		}
		public function setLadaTelCasaCA($LadaTelCasaCA)
		{
			
			$this->LadaTelCasaCA=$LadaTelCasaCA;
		}
		public function setTelCasaCA($TelCasaCA)
		{
			
			$this->TelCasaCA=$TelCasaCA;
		}
		public function setNombreCF($nombreCF)
		{
			
			$this->nombreCF=$nombreCF;
		}
		public function setAPaternoCF($aPaternoCF)
		{
			
			$this->aPaternoCF=$aPaternoCF;
		}
		public function setAMaternoCF($aMaternoCF)
		{
			
			$this->aMaternoCF=$aMaternoCF;
		}
		public function setEmailCF($emailCF)
		{
			
			$this->emailCF=$emailCF;
		}
		public function setAreaTelCasaCF($areaTelCasaCF)
		{
			
			$this->areaTelCasaCF=$areaTelCasaCF;
		}
		public function setLadaTelCasaCF($LadaTelCasaCF)
		{
			
			$this->LadaTelCasaCF=$LadaTelCasaCF;
		}
		public function setTelCasaCF($TelCasaCF)
		{
			
			$this->TelCasaCF=$TelCasaCF;
		}
		public function setNombreCT($nombreCT)
		{
			
			$this->nombreCT=$nombreCT;
		}
		public function setAPaternoCT($aPaternoCT)
		{
			
			$this->aPaternoCT=$aPaternoCT;
		}
		public function setAMaternoCT($aMaternoCT)
		{
			
			$this->aMaternoCT=$aMaternoCT;
		}
		public function setEmailCT($emailCT)
		{
			
			$this->emailCT=$emailCT;
		}
		public function setAreaTelCasaCT($areaTelCasaCT)
		{
			
			$this->areaTelCasaCT=$areaTelCasaCT;
		}
		public function setLadaTelCasaCT($LadaTelCasaCT)
		{
			
			$this->LadaTelCasaCT=$LadaTelCasaCT;
		}
		public function setTelCasaCT($TelCasaCT)
		{
			
			$this->TelCasaCT=$TelCasaCT;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusDisponible()
		{
			$this->estatus='disponible';
		}
		public function setEstatusBaja()
		{
			$this->estatus='baja';
		}
		public function setId_usuario($id_usuario)
		{
			
			$this->id_usuario=$id_usuario;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdcliente()
		{
			return $this->idcliente;
		}
		public function getFechaAlta()
		{
			return $this->fechaAlta;
		}
		public function getIdLoginMember()
		{
			return $this->idLoginMember;
		}
		public function getNombreC()
		{
			return $this->nombreC;
		}
		public function getAPaternoC()
		{
			return $this->aPaternoC;
		}
		public function getAMaternoC()
		{
			return $this->aMaternoC;
		}
		public function getEmailC()
		{
			return $this->emailC;
		}
		public function getRSocialC()
		{
			return $this->rSocialC;
		}
		public function getPaisC()
		{
			return $this->paisC;
		}
		public function getEstadoC()
		{
			return $this->estadoC;
		}
		public function getCPC()
		{
			return $this->CPC;
		}
		public function getMunicipioC()
		{
			return $this->municipioC;
		}
		public function getCiudadC()
		{
			return $this->ciudadC;
		}
		public function getColoniaC()
		{
			return $this->coloniaC;
		}
		public function getCalleC()
		{
			return $this->calleC;
		}
		public function getNoExteriorC()
		{
			return $this->noExteriorC;
		}
		public function getNoInteriorC()
		{
			return $this->noInteriorC;
		}
		public function getAreaTelefonoC()
		{
			return $this->areaTelefonoC;
		}
		public function getLadaTelCasaC()
		{
			return $this->ladaTelCasaC;
		}
		public function getTelCasaC()
		{
			return $this->telCasaC;
		}
		public function getExtensionC()
		{
			return $this->extensionC;
		}
		public function getNombreF()
		{
			return $this->nombreF;
		}
		public function getAPaternoF()
		{
			return $this->aPaternoF;
		}
		public function getAMaternoF()
		{
			return $this->aMaternoF;
		}
		public function getEmailF()
		{
			return $this->emailF;
		}
		public function getRSocialF()
		{
			return $this->rSocialF;
		}
		public function getPaisF()
		{
			return $this->paisF;
		}
		public function getEstadoF()
		{
			return $this->estadoF;
		}
		public function getCPF()
		{
			return $this->CPF;
		}
		public function getMunicipioF()
		{
			return $this->municipioF;
		}
		public function getCiudadF()
		{
			return $this->ciudadF;
		}
		public function getColoniaF()
		{
			return $this->coloniaF;
		}
		public function getCalleF()
		{
			return $this->calleF;
		}
		public function getNoExteriorF()
		{
			return $this->noExteriorF;
		}
		public function getNoInteriorF()
		{
			return $this->noInteriorF;
		}
		public function getAreaTelefonoF()
		{
			return $this->areaTelefonoF;
		}
		public function getLadaTelCasaF()
		{
			return $this->ladaTelCasaF;
		}
		public function getTelCasaF()
		{
			return $this->telCasaF;
		}
		public function getExtensionF()
		{
			return $this->extensionF;
		}
		public function getRFC()
		{
			return $this->RFC;
		}
		public function getAreaTelCasaCA()
		{
			return $this->areaTelCasaCA;
		}
		public function getLadaTelCasaCA()
		{
			return $this->LadaTelCasaCA;
		}
		public function getTelCasaCA()
		{
			return $this->TelCasaCA;
		}
		public function getNombreCF()
		{
			return $this->nombreCF;
		}
		public function getAPaternoCF()
		{
			return $this->aPaternoCF;
		}
		public function getAMaternoCF()
		{
			return $this->aMaternoCF;
		}
		public function getEmailCF()
		{
			return $this->emailCF;
		}
		public function getAreaTelCasaCF()
		{
			return $this->areaTelCasaCF;
		}
		public function getLadaTelCasaCF()
		{
			return $this->LadaTelCasaCF;
		}
		public function getTelCasaCF()
		{
			return $this->TelCasaCF;
		}
		public function getNombreCT()
		{
			return $this->nombreCT;
		}
		public function getAPaternoCT()
		{
			return $this->aPaternoCT;
		}
		public function getAMaternoCT()
		{
			return $this->aMaternoCT;
		}
		public function getEmailCT()
		{
			return $this->emailCT;
		}
		public function getAreaTelCasaCT()
		{
			return $this->areaTelCasaCT;
		}
		public function getLadaTelCasaCT()
		{
			return $this->LadaTelCasaCT;
		}
		public function getTelCasaCT()
		{
			return $this->TelCasaCT;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getId_usuario()
		{
			return $this->id_usuario;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idcliente=0;
			$this->fechaAlta='';
			$this->idLoginMember=0;
			$this->nombreC='';
			$this->aPaternoC='';
			$this->aMaternoC='';
			$this->emailC='';
			$this->rSocialC='';
			$this->paisC='';
			$this->estadoC='';
			$this->CPC='';
			$this->municipioC='';
			$this->ciudadC='';
			$this->coloniaC='';
			$this->calleC='';
			$this->noExteriorC='';
			$this->noInteriorC='';
			$this->areaTelefonoC='';
			$this->ladaTelCasaC='';
			$this->telCasaC='';
			$this->extensionC='';
			$this->nombreF='';
			$this->aPaternoF='';
			$this->aMaternoF='';
			$this->emailF='';
			$this->rSocialF='';
			$this->paisF='';
			$this->estadoF='';
			$this->CPF='';
			$this->municipioF='';
			$this->ciudadF='';
			$this->coloniaF='';
			$this->calleF='';
			$this->noExteriorF='';
			$this->noInteriorF='';
			$this->areaTelefonoF='';
			$this->ladaTelCasaF='';
			$this->telCasaF='';
			$this->extensionF='';
			$this->RFC='';
			$this->areaTelCasaCA='';
			$this->LadaTelCasaCA='';
			$this->TelCasaCA='';
			$this->nombreCF='';
			$this->aPaternoCF='';
			$this->aMaternoCF='';
			$this->emailCF='';
			$this->areaTelCasaCF='';
			$this->LadaTelCasaCF='';
			$this->TelCasaCF='';
			$this->nombreCT='';
			$this->aPaternoCT='';
			$this->aMaternoCT='';
			$this->emailCT='';
			$this->areaTelCasaCT='';
			$this->LadaTelCasaCT='';
			$this->TelCasaCT='';
			$this->estatus='disponible';
			$this->id_usuario=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO cliente(fechaAlta,idLoginMember,nombreC,aPaternoC,aMaternoC,emailC,rSocialC,paisC,estadoC,CPC,municipioC,ciudadC,coloniaC,calleC,noExteriorC,noInteriorC,areaTelefonoC,ladaTelCasaC,telCasaC,extensionC,nombreF,aPaternoF,aMaternoF,emailF,rSocialF,paisF,estadoF,CPF,municipioF,ciudadF,coloniaF,calleF,noExteriorF,noInteriorF,areaTelefonoF,ladaTelCasaF,telCasaF,extensionF,RFC,areaTelCasaCA,LadaTelCasaCA,TelCasaCA,nombreCF,aPaternoCF,aMaternoCF,emailCF,areaTelCasaCF,LadaTelCasaCF,TelCasaCF,nombreCT,aPaternoCT,aMaternoCT,emailCT,areaTelCasaCT,LadaTelCasaCT,TelCasaCT,estatus,id_usuario)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "','" . mysqli_real_escape_string($this->dbLink,$this->idLoginMember) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombreC) . "','" . mysqli_real_escape_string($this->dbLink,$this->aPaternoC) . "','" . mysqli_real_escape_string($this->dbLink,$this->aMaternoC) . "','" . mysqli_real_escape_string($this->dbLink,$this->emailC) . "','" . mysqli_real_escape_string($this->dbLink,$this->rSocialC) . "','" . mysqli_real_escape_string($this->dbLink,$this->paisC) . "','" . mysqli_real_escape_string($this->dbLink,$this->estadoC) . "','" . mysqli_real_escape_string($this->dbLink,$this->CPC) . "','" . mysqli_real_escape_string($this->dbLink,$this->municipioC) . "','" . mysqli_real_escape_string($this->dbLink,$this->ciudadC) . "','" . mysqli_real_escape_string($this->dbLink,$this->coloniaC) . "','" . mysqli_real_escape_string($this->dbLink,$this->calleC) . "','" . mysqli_real_escape_string($this->dbLink,$this->noExteriorC) . "','" . mysqli_real_escape_string($this->dbLink,$this->noInteriorC) . "','" . mysqli_real_escape_string($this->dbLink,$this->areaTelefonoC) . "','" . mysqli_real_escape_string($this->dbLink,$this->ladaTelCasaC) . "','" . mysqli_real_escape_string($this->dbLink,$this->telCasaC) . "','" . mysqli_real_escape_string($this->dbLink,$this->extensionC) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombreF) . "','" . mysqli_real_escape_string($this->dbLink,$this->aPaternoF) . "','" . mysqli_real_escape_string($this->dbLink,$this->aMaternoF) . "','" . mysqli_real_escape_string($this->dbLink,$this->emailF) . "','" . mysqli_real_escape_string($this->dbLink,$this->rSocialF) . "','" . mysqli_real_escape_string($this->dbLink,$this->paisF) . "','" . mysqli_real_escape_string($this->dbLink,$this->estadoF) . "','" . mysqli_real_escape_string($this->dbLink,$this->CPF) . "','" . mysqli_real_escape_string($this->dbLink,$this->municipioF) . "','" . mysqli_real_escape_string($this->dbLink,$this->ciudadF) . "','" . mysqli_real_escape_string($this->dbLink,$this->coloniaF) . "','" . mysqli_real_escape_string($this->dbLink,$this->calleF) . "','" . mysqli_real_escape_string($this->dbLink,$this->noExteriorF) . "','" . mysqli_real_escape_string($this->dbLink,$this->noInteriorF) . "','" . mysqli_real_escape_string($this->dbLink,$this->areaTelefonoF) . "','" . mysqli_real_escape_string($this->dbLink,$this->ladaTelCasaF) . "','" . mysqli_real_escape_string($this->dbLink,$this->telCasaF) . "','" . mysqli_real_escape_string($this->dbLink,$this->extensionF) . "','" . mysqli_real_escape_string($this->dbLink,$this->RFC) . "','" . mysqli_real_escape_string($this->dbLink,$this->areaTelCasaCA) . "','" . mysqli_real_escape_string($this->dbLink,$this->LadaTelCasaCA) . "','" . mysqli_real_escape_string($this->dbLink,$this->TelCasaCA) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombreCF) . "','" . mysqli_real_escape_string($this->dbLink,$this->aPaternoCF) . "','" . mysqli_real_escape_string($this->dbLink,$this->aMaternoCF) . "','" . mysqli_real_escape_string($this->dbLink,$this->emailCF) . "','" . mysqli_real_escape_string($this->dbLink,$this->areaTelCasaCF) . "','" . mysqli_real_escape_string($this->dbLink,$this->LadaTelCasaCF) . "','" . mysqli_real_escape_string($this->dbLink,$this->TelCasaCF) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombreCT) . "','" . mysqli_real_escape_string($this->dbLink,$this->aPaternoCT) . "','" . mysqli_real_escape_string($this->dbLink,$this->aMaternoCT) . "','" . mysqli_real_escape_string($this->dbLink,$this->emailCT) . "','" . mysqli_real_escape_string($this->dbLink,$this->areaTelCasaCT) . "','" . mysqli_real_escape_string($this->dbLink,$this->LadaTelCasaCT) . "','" . mysqli_real_escape_string($this->dbLink,$this->TelCasaCT) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->id_usuario) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseCliente::Insertar]");
				
				$this->idcliente=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE cliente SET fechaAlta='" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "',idLoginMember='" . mysqli_real_escape_string($this->dbLink,$this->idLoginMember) . "',nombreC='" . mysqli_real_escape_string($this->dbLink,$this->nombreC) . "',aPaternoC='" . mysqli_real_escape_string($this->dbLink,$this->aPaternoC) . "',aMaternoC='" . mysqli_real_escape_string($this->dbLink,$this->aMaternoC) . "',emailC='" . mysqli_real_escape_string($this->dbLink,$this->emailC) . "',rSocialC='" . mysqli_real_escape_string($this->dbLink,$this->rSocialC) . "',paisC='" . mysqli_real_escape_string($this->dbLink,$this->paisC) . "',estadoC='" . mysqli_real_escape_string($this->dbLink,$this->estadoC) . "',CPC='" . mysqli_real_escape_string($this->dbLink,$this->CPC) . "',municipioC='" . mysqli_real_escape_string($this->dbLink,$this->municipioC) . "',ciudadC='" . mysqli_real_escape_string($this->dbLink,$this->ciudadC) . "',coloniaC='" . mysqli_real_escape_string($this->dbLink,$this->coloniaC) . "',calleC='" . mysqli_real_escape_string($this->dbLink,$this->calleC) . "',noExteriorC='" . mysqli_real_escape_string($this->dbLink,$this->noExteriorC) . "',noInteriorC='" . mysqli_real_escape_string($this->dbLink,$this->noInteriorC) . "',areaTelefonoC='" . mysqli_real_escape_string($this->dbLink,$this->areaTelefonoC) . "',ladaTelCasaC='" . mysqli_real_escape_string($this->dbLink,$this->ladaTelCasaC) . "',telCasaC='" . mysqli_real_escape_string($this->dbLink,$this->telCasaC) . "',extensionC='" . mysqli_real_escape_string($this->dbLink,$this->extensionC) . "',nombreF='" . mysqli_real_escape_string($this->dbLink,$this->nombreF) . "',aPaternoF='" . mysqli_real_escape_string($this->dbLink,$this->aPaternoF) . "',aMaternoF='" . mysqli_real_escape_string($this->dbLink,$this->aMaternoF) . "',emailF='" . mysqli_real_escape_string($this->dbLink,$this->emailF) . "',rSocialF='" . mysqli_real_escape_string($this->dbLink,$this->rSocialF) . "',paisF='" . mysqli_real_escape_string($this->dbLink,$this->paisF) . "',estadoF='" . mysqli_real_escape_string($this->dbLink,$this->estadoF) . "',CPF='" . mysqli_real_escape_string($this->dbLink,$this->CPF) . "',municipioF='" . mysqli_real_escape_string($this->dbLink,$this->municipioF) . "',ciudadF='" . mysqli_real_escape_string($this->dbLink,$this->ciudadF) . "',coloniaF='" . mysqli_real_escape_string($this->dbLink,$this->coloniaF) . "',calleF='" . mysqli_real_escape_string($this->dbLink,$this->calleF) . "',noExteriorF='" . mysqli_real_escape_string($this->dbLink,$this->noExteriorF) . "',noInteriorF='" . mysqli_real_escape_string($this->dbLink,$this->noInteriorF) . "',areaTelefonoF='" . mysqli_real_escape_string($this->dbLink,$this->areaTelefonoF) . "',ladaTelCasaF='" . mysqli_real_escape_string($this->dbLink,$this->ladaTelCasaF) . "',telCasaF='" . mysqli_real_escape_string($this->dbLink,$this->telCasaF) . "',extensionF='" . mysqli_real_escape_string($this->dbLink,$this->extensionF) . "',RFC='" . mysqli_real_escape_string($this->dbLink,$this->RFC) . "',areaTelCasaCA='" . mysqli_real_escape_string($this->dbLink,$this->areaTelCasaCA) . "',LadaTelCasaCA='" . mysqli_real_escape_string($this->dbLink,$this->LadaTelCasaCA) . "',TelCasaCA='" . mysqli_real_escape_string($this->dbLink,$this->TelCasaCA) . "',nombreCF='" . mysqli_real_escape_string($this->dbLink,$this->nombreCF) . "',aPaternoCF='" . mysqli_real_escape_string($this->dbLink,$this->aPaternoCF) . "',aMaternoCF='" . mysqli_real_escape_string($this->dbLink,$this->aMaternoCF) . "',emailCF='" . mysqli_real_escape_string($this->dbLink,$this->emailCF) . "',areaTelCasaCF='" . mysqli_real_escape_string($this->dbLink,$this->areaTelCasaCF) . "',LadaTelCasaCF='" . mysqli_real_escape_string($this->dbLink,$this->LadaTelCasaCF) . "',TelCasaCF='" . mysqli_real_escape_string($this->dbLink,$this->TelCasaCF) . "',nombreCT='" . mysqli_real_escape_string($this->dbLink,$this->nombreCT) . "',aPaternoCT='" . mysqli_real_escape_string($this->dbLink,$this->aPaternoCT) . "',aMaternoCT='" . mysqli_real_escape_string($this->dbLink,$this->aMaternoCT) . "',emailCT='" . mysqli_real_escape_string($this->dbLink,$this->emailCT) . "',areaTelCasaCT='" . mysqli_real_escape_string($this->dbLink,$this->areaTelCasaCT) . "',LadaTelCasaCT='" . mysqli_real_escape_string($this->dbLink,$this->LadaTelCasaCT) . "',TelCasaCT='" . mysqli_real_escape_string($this->dbLink,$this->TelCasaCT) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',id_usuario='" . mysqli_real_escape_string($this->dbLink,$this->id_usuario) . "'
					WHERE idcliente=" . $this->idcliente;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCliente::Update]");
				
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
				$SQL="DELETE FROM cliente
				WHERE idcliente=" . mysqli_real_escape_string($this->dbLink,$this->idcliente);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCliente::Borrar]");
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
						idcliente,fechaAlta,idLoginMember,nombreC,aPaternoC,aMaternoC,emailC,rSocialC,paisC,estadoC,CPC,municipioC,ciudadC,coloniaC,calleC,noExteriorC,noInteriorC,areaTelefonoC,ladaTelCasaC,telCasaC,extensionC,nombreF,aPaternoF,aMaternoF,emailF,rSocialF,paisF,estadoF,CPF,municipioF,ciudadF,coloniaF,calleF,noExteriorF,noInteriorF,areaTelefonoF,ladaTelCasaF,telCasaF,extensionF,RFC,areaTelCasaCA,LadaTelCasaCA,TelCasaCA,nombreCF,aPaternoCF,aMaternoCF,emailCF,areaTelCasaCF,LadaTelCasaCF,TelCasaCF,nombreCT,aPaternoCT,aMaternoCT,emailCT,areaTelCasaCT,LadaTelCasaCT,TelCasaCT,estatus,id_usuario
					FROM cliente
					WHERE idcliente=" . mysqli_real_escape_string($this->dbLink,$this->idcliente);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseCliente::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idcliente==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>