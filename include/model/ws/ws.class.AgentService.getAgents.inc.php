<?php
	require_once FOLDER_MODEL_WS . 'class.ws.inc.php';

	#-----------------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------------Parametros----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class paramDAgentServiceGetAgents
	{
		#-------------------------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Propiedades de Parametros------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		/*

			Solo se usa <AgentStatus xsi:type="xsd:string">1</AgentStatus> con "1" a pesar de
			que dice "active". El resto de los parámetros no se usa.

		*/


		public $AgentId;
		public $AgentFirstName;
		public $AgentLastName;
		public $AgentCompanyName;
		public $AgentEmail;
		public $CountryName;
		public $StateName;
		public $AgentStatus;
		public $RowCount;
		public $OffSet;
		public $SortBy;
		public $OrderType;

		#-------------------------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------------Setters Getters-----------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function setAgentId($AgentId)
		{
		    $this->AgentId = $AgentId;
		}

		public function getAgentId()
		{
		    return $this->AgentId;
		}

		public function setAgentFirstName($AgentFirstName)
		{
		    $this->AgentFirstName = $AgentFirstName;
		}

		public function getAgentFirstName()
		{
		    return $this->AgentFirstName;
		}


		public function setAgentLastName($AgentLastName)
		{
		    $this->AgentLastName = $AgentLastName;
		}

		public function getAgentLastName()
		{
		    return $this->AgentLastName;
		}


		public function setAgentCompanyName($AgentCompanyName)
		{
		    $this->AgentCompanyName = $AgentCompanyName;
		}

		public function getAgentCompanyName()
		{
		    return $this->AgentCompanyName;
		}


		public function setAgentEmail($AgentEmail)
		{
		    $this->AgentEmail = $AgentEmail;
		}

		public function getAgentEmail()
		{
		    return $this->AgentEmail;
		}


		public function setCountryName($CountryName)
		{
		    $this->CountryName = $CountryName;
		}

		public function getCountryName()
		{
		    return $this->CountryName;
		}


		public function setStateName($StateName)
		{
		    $this->StateName = $StateName;
		}

		public function getStateName()
		{
		    return $this->StateName;
		}


		public function setAgentStatus($AgentStatus)
		{
		    $this->AgentStatus = $AgentStatus;
		}

		public function getAgentStatus()
		{
		    return $this->AgentStatus;
		}


		public function setRowCount($RowCount)
		{
		    $this->RowCount = $RowCount;
		}

		public function getRowCount()
		{
		    return $this->RowCount;
		}

		public function setOffSet($OffSet)
		{
		    $this->OffSet = $OffSet;
		}

		public function getOffSet()
		{
		    return $this->OffSet;
		}


		public function setSortBy($SortBy)
		{
		    $this->SortBy = $SortBy;
		}

		public function getSortBy()
		{
		    return $this->SortBy;
		}


		public function setOrderType($OrderType)
		{
		    $this->OrderType = $OrderType;
		}

		public function getOrderType()
		{
		    return $this->OrderType;
		}


	}

	#-----------------------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------------Response-----------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------------------#

	class responseDAgentServiceGetAgents
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de resultado------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $ErrorCode;
		public $ErrorMessage;
		public $TotalRecords;
		public $List;

		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Getters---------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function getErrorCode()
		{
			return $this->ErrorCode;
		}

		public function getErrorMessage()
		{
			return $this->ErrorMessage;
		}

		public function getList()
		{
			return $this->List;
		}

		public function getTotalRecords()
		{
			return $this->TotalRecords;
		}


		//List Users ?.
		/*

				<ErrorCode xsi:type="xsd:int">0</ErrorCode>
               <ErrorMessage xsi:type="xsd:string"/>
               <TotalRecords xsi:type="xsd:int">1</TotalRecords>

               <List xsi:type="SOAP-ENC:Array" SOAP-ENC:arrayType="unnamed_struct_use_soapval[1]">
                  <item>
                     <AgentId xsi:type="xsd:int">1</AgentId>
                     <AgentFirstName xsi:type="xsd:string">Amadeo</AgentFirstName>
                     <AgentLastName xsi:type="xsd:string">Cloud</AgentLastName>
                     <AgentCompanyName xsi:type="xsd:string">Amadeo Cloud</AgentCompanyName>
                     <AgentEmail xsi:type="xsd:string">acagent@damaka.net</AgentEmail>
                     <CountryName xsi:type="xsd:string">UNITED STATES</CountryName>
                     <StateName xsi:type="xsd:string">TEXAS</StateName>
                     <AgentStatus xsi:type="xsd:string">Active</AgentStatus>
                     <SettlementPeriodTypeName xsi:type="xsd:string">Fixed date</SettlementPeriodTypeName>
                     <CommissionPeriodDays xsi:type="xsd:int">0</CommissionPeriodDays>
                     <CommissionPeriodBaseDay xsi:type="xsd:string">1</CommissionPeriodBaseDay>
                  </item>
               </List>

		*/

	}

	class DAgentServiceGetAgents extends WSDamaka
	{

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Propiedades de Control--------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public $Param;
		public $Response;

		#-------------------------------------------------------------------------------------------------------------------------#
		#-------------------------------------------------Constructor/Destructor--------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function __construct()
		{
			parent::__construct(DAMAKA_URL_WS,DAMAKA_USER,DAMAKA_PASS);
			$this->_operacion="AgentService.getAgents";
			$this->Param=new paramDAgentServiceGetAgents();
			$this->Response=new responseDAgentServiceGetAgents();
		}


		#-------------------------------------------------------------------------------------------------------------------------#
		#---------------------------------------------------------Acciones--------------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------------------------#

		public function validate()
		{
			return true;
		}

		public function clear()
		{

		}
	}