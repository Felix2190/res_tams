<?php

	error_reporting(E_ALL);
	ini_set("display_errors", "1");


	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------CONTEO DE LLAMADAS DIARIAS--------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	require_once(LIB_CONEXION);
	require_once FOLDER_MODEL_WS . "ws.class.CallHistoryService.callsListDetailed.inc.php";
	
	$fecha=getdate();
	$a=$fecha['year'];
	$m=$fecha['mon']<0?"0" . $fecha['mon']:$fecha['mon'];
	$diaActual=$fecha['mday']<0?"0" . $fecha['mday']:$fecha['mday'];
	$cantidadDias=$fecha["mday"]-1;
	
	/*
	$cDias=getdate(mktime(0,0,0,$m+1,0,$a));
	$cantidadDias=$cDias["mday"];
	*/
	
	
	for($i=1;$i<=$cantidadDias;$i++)
	{
		$dia=$i<10?"0" . $i:$i;
		$query="SELECT count(*) AS cuenta FROM cantidadllamadas WHERE mes='" . $a . $m . "' AND dia='" . $dia . "' AND AccountId='" . $objSession->getAccountId() . "'";
		$result=mysql_query($query)or die("Ocurrio un error en la busqueda de registros en BD");
		$row=mysql_fetch_assoc($result);
		if($row['cuenta']==0)
		{
			
			$Detalles=new DCallHistoryServiceCallsListDetailed();
			$Detalles->Param->setAccountId($objSession->getAccountId());
			$Detalles->Param->setAccountId("1000");
			$Detalles->Param->setDate($a . $m . $dia);
			$Detalles->execute();
			
			$query="INSERT INTO cantidadllamadas (AccountId,mes,dia,cantidad) VALUES('" . $objSession->getAccountId() . "','" . $a.$m . "','" . $dia . "'," . $Detalles->Response->getTotalRecords() . ")";
			mysql_query($query)or die("Ocurrio un error en la insercion de datos.");
		}
	}
	
	$query="SELECT cantidad,dia FROM cantidadllamadas WHERE mes='" . $a . $m . "' AND Accountid='" . $objSession->getAccountId() . "' ORDER BY dia ASC";
	$result=mysql_query($query)or die("Ocurrio un error en la busqueda de registros en BD");
	$cantidades=array();
	while($row=mysql_fetch_assoc($result))
	{
		$cantidades[$row['dia']]=$row['cantidad'];
	}
	
	
	$Detalles=new DCallHistoryServiceCallsListDetailed();
	$Detalles->Param->setAccountId($objSession->getAccountId());
	$Detalles->Param->setAccountId("1000");
	$Detalles->Param->setDate($a . $m . $diaActual);
	$Detalles->execute();
	
	if($Detalles->getError())
		die($Detalles->getStrError());
	
	$cantidades[$diaActual]=$Detalles->Response->getTotalRecords();
	
	$cDias=getdate(mktime(0,0,0,$m+1,0,$a));
	$cantidadDias=$cDias["mday"];
	
	for($i=1;$i<$cantidadDias;$i++)
	{
		$dia=$i<10?"0" . $i:$i;
		if(!isset($cantidades[$dia]))
			$cantidades[$dia]=0;
		
	}
	
	
	
	print_r($cantidades);
	
	
	
	
	
	
	
	
	

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------OSTICKET----------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	/*
		require_once(LIB_CONEXION);
		require_once FOLDER_MODEL_DATA . "clsAddSupportOSTicket.inc.php";
		
		 $add=new AddSupportSOTickect();
		 if($add->getError())
		 {
		 $this->setError($this->_strErrorGenerico,"Impossible to initiate object for OS ticket support registration. [" . $add->getStrError() . "] [No se detiene proceso de alta de cuenta, solo no tiene soporte]");
		 $this->error=false;
		 ConectarBD();
		 return true;
		 }
		 $add->setName("Antonio Pacheco");
		 $add->setUserName("makkotest");
		 $add->setEmail("jpacheco1@aiidia.com");
		 $add->setPass(OSTICKET_PASS);
		 //$add->setPass("270784LLflLFL_");
		 $add->exec();
		 if($add->getError())
		 	die("Erorr");
		
		 	//Se ejecuta la siguiente funcion para recuperar el enlace a la base de datos principal,
		 	//ya que la clase AddSupportSOTickect abre conexion a la base de datos de soporte.
		
		
		 	echo "Ok";
		 	ConectarBD();
		 	*/

	