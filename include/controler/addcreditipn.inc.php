<?php
	include("cloudwebservice.php");

	include("/var/www/include/lib/Conexion/mysql.inc.php");
	#error_reporting(E_ALL);
	#ini_set("display_errors", "1");


	#------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------ TEST DATA  ------------------------------------------------#
	#------------------------------------------------------------------------------------------------------------#

	/*
	$_POST['mc_gross']="250.00";
	$_POST['protection_eligibility']="Ineligible";
	$_POST['payer_id']="8JWG27H972B2N";
	$_POST['tax']="0.00";
	$_POST['payment_date']="15:53:59 Apr 23, 2014 PDT";
	$_POST['payment_status']="Completed";
	$_POST['charset']="windows-1252";
	$_POST['first_name']="Antonio";
	$_POST['option_selection1']="1070";
	$_POST['mc_fee']="36.55";
	$_POST['notify_version']="3.8";
	$_POST['custom']="";
	$_POST['payer_status']="verified";
	$_POST['business']="jpacheco-facilitator@aiidia.com";
	$_POST['quantity']="1";
	$_POST['verify_sign']="AX-g0kVb83IL1xa9mVsy4L0a5kPuAon5PipEDqYaKGQ.8HOsDy9mDlRJ";
	$_POST['payer_email']="jpacheco_comprador@aiidia.com";
	$_POST['option_name1']="Email";
	$_POST['txn_id']="5K466754C33508055";
	$_POST['payment_type']="instant";
	$_POST['last_name']="Comprador";
	$_POST['receiver_email']="jpacheco-facilitator@aiidia.com";
	$_POST['payment_fee']="36.55";
	$_POST['receiver_id']="XNGRXDAYZTLZQ";
	$_POST['txn_type']="web_accept";
	$_POST['item_name']="Amadeo Account Setup";
	$_POST['mc_currency']="USD";
	$_POST['item_number']="";
	$_POST['residence_country']="US";
	$_POST['test_ipn']="1";
	$_POST['handling_amount']="0.00";
	$_POST['transaction_subject']="";
	$_POST['payment_gross']="250.00";
	$_POST['shipping']="0.00";
	$_POST['ipn_track_id']="1d8ca265ca292";

	*/


	#------------------------------------------------------------------------------------------------------------#
	#------------------------------------------------------------------------------------------------------------#

	// option_selection1 contains the Account ID for this PSTN Credit.
	amadeocloud_log("**** Incoming IPN: With Account ID [ ".$_POST['option_selection1']."]******\n","");
	
	#----------------------------Paypal Verification URL-------------------------#
	$raw_post_data = file_get_contents('php://input');
	$raw_post_array = explode('&', $raw_post_data);
	$myPost = array();
	foreach ($raw_post_array as $keyval) {
	  $keyval = explode ('=', $keyval);
	  if (count($keyval) == 2)
	     $myPost[$keyval[0]] = urldecode($keyval[1]);
	}
	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	if(function_exists('get_magic_quotes_gpc')) {
	   $get_magic_quotes_exists = true;
	}
	foreach ($myPost as $key => $value) {
	   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
	        $value = urlencode(stripslashes($value));
	   } else {
	        $value = urlencode($value);
	   }
	   $req .= "&$key=$value";
	}
	foreach ($_POST as $key => $value) {         // Loop through the notification NV pairs
	    $value = urlencode(stripslashes($value));  // Encode these values
	    $req  .= "&$key=$value";                   // Add the NV pairs to the acknowledgement
	  }
	//echo $req;

	// STEP 2: Post IPN data back to paypal to validate
	if(PAYPAL_SANDBOX=="true")
	{
		$ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
		amadeocloud_log("From Sandbox",$ipnname);
	}
	else
	{
		$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
		amadeocloud_log("From Production",$ipnname);
	}

	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

	// In wamp like environments that do not come bundled with root authority certificates,
	// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
	// of the certificate as shown below.
	// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
	if( !($res = curl_exec($ch)) ) {
	    // error_log("Got " . curl_error($ch) . " when processing IPN data");
		
		amadeocloud_log("** Error. curl_exec failed. when trying to post back to Paypal.",$ipnname);
		admin_mail("Error in PSTN Add Credit","Failed in curl_exec<br>".$paypal_results,$ipnname);
	    curl_close($ch);
	    exit;
	}
	curl_close($ch);


	// STEP 3: Inspect IPN validation result and act accordingly


	if (strcmp ($res, "VERIFIED") != 0) {
		amadeocloud_log("** Looks like Invalid IPN: Paypal *DID NOT* return VERIFIED, Instead returned[".$res."][".$_POST['option_selection1'],$ipnname);
		admin_mail("Error in PSTN Add Credit","Alert!!!!<br>Failed in Paypal Transcation verifcation<br>** Looks like Invalid IPN: Paypal *DID NOT* return VERIFIED".$paypal_results,$ipnname);
		
		exit;
	}

	#------------------------End of Payal verification"----------------------------#
	#------------------------Start of Validation Refund IPN----------------------------#
	if($_POST['payment_status']=="Refunded")
	{
	$paypal_results="<br>Paypal Details Listed Below";

	foreach($_POST as $k=>$v)

	{

		

		$paypal_results.="<br>" . str_pad($k,30,"-") . $v;

	}
		admin_mail("Refund Status Success ","PSTN Refund status for ".$_POST['first_name']." Email id [".$_POST['option_selection1']." ]are as follows:".$paypal_results,$ipnname);
		exit;	
	}	
	#------------------------End  of Validation Refund IPN----------------------------#
	$sql="select full_name,full_lastname,domainName,email from registerTmp where idRegisterTmp =(select distinct(idTmp) from registroPasos where observaciones ='idAccount:".$_POST['option_selection1']."')";
	amadeocloud_log($sql);
	$row=mysql_query($sql)or die(mysql_error());
	$result=mysql_fetch_assoc($row);
	error_log($row);
	$ipnname="Add PSTN Credit ::: Domain Name[ ".$result['domainName']." ]";

	amadeocloud_log("************ Add PSTN Credit IPN Results  With Account ID [ ".$_POST['option_selection1']."******\n",$ipnname);
	
	amadeocloud_log("Add Credit IPN Paypal Verification Success",$ipnname);
	
	amadeocloud_log("Values From IPN Amount is [ ".$_POST['mc_gross']." ] Payer Email [ ".$_POST['payer_email']." ]",$ipnname);

	$Status=$_POST['payment_status'];
	
	
	if($Status!="Completed")
	{
		// If Paypal says the Status is NOT Completed. We do not do anything at all. Technically, we need to wait for another IPN From Paypal
		// which will indicate this transaction is completed.
		amadeocloud_log("** Payment Status [".$Status."] is NOT 'Completed'. So not taking any action. Paid By : [".$_POST['payer_email']."] Credit Amount [".$_POST['mc_gross']."] Transaction ID [".$_POST['txn_id']."]",$ipnname);
		
		admin_mail("Error in PSTN Add Credit","** Payment Status [".$Status."] is NOT 'Completed'. So not taking any action. Paid By : [".$_POST['payer_email']."] Suscription Amount [".$_POST['mc_gross']."] Transaction ID [".$_POST['txn_id']."]".$paypal_results,$ipnname);
		exit();
	}

	$fileName="ipn_" . time() . ".log";
	$fLog=fopen(PAYPAL_FOLDER . $fileName,"w");
	fwrite($fLog,"\n" . date("Y-m-d H:i:s") . "\n\n");
	$str="";
	foreach($_POST as $k=>$v)
	{
		//echo fwrite($ipnLog,$k." :: ".$v);
		$str.="\n" . str_pad($k,30,"-") . $v;
	}
	amadeocloud_log($str,$ipnname);
	fwrite($fLog,$str);


	#------------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------Registro de pago en AvoIP------------------------------------------------#
	#------------------------------------------------------------------------------------------------------------------------#

	require(FOLDER_MODEL_WS . "ws.class.AccountService.applyPayment.inc.php");

	$wsAdd=new DAccountServiceApplyPayment();
	$wsAdd->debugEnable();
	$wsAdd->Param->setAccountId($_POST['option_selection1']);

	#$wsAdd->Param->setAccountId("1070");

	$wsAdd->Param->setAmount($_POST['mc_gross']);
	$wsAdd->Param->setIp("?");
	$wsAdd->Param->setNote("Apply Payment Test. Ref PayPal:" . $_POST['txn_id']);



	$wsAdd->execute();
	$wsAdd->makeDebugFile(FOLDER_LOG);
	if($wsAdd->getError())
	{
		fwrite($fLog,$wsAdd->getStrError());
		amadeocloud_log("VoIP Webservice Error".$wsAdd->getStrError(),$ipnname);
		admin_mail("Error in PSTN Add Credit","VoIP Webservice Error".$wsAdd->getStrError(),$ipnname);
		exit;
	}
	
	
	amadeocloud_log("Values Stored to VOIP Amount is [ ".$_POST['mc_gross']." ] Account ID is [".$_POST['option_selection1']." ]" ,$ipnname);
	$headers  = "From: noreply@amadeocloud.com\r\n";
	#$headers .= $i>1?"Bcc: " . $To . "\r\n":"";
	$headers .= "Reply-To: customercare@damaka.net\r\n";
	$headers .= "Return-Path: customercare@damaka.net\r\n";
	$headers .= "X-Mailer: PHP\n";
	$headers .= 'MIME-Version: 1.0' . "\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	////Sending Confirmation Email to Admin
	$xmlinfo = simplexml_load_file('/etc/cloud.config');
	$email_id= $xmlinfo->MailServer->AdminEmail;


	$pstn_mail_path="/etc/cloudPstnCreditMail.txt";
	$myfile = fopen($pstn_mail_path, "r");
	$adminmail =fread($myfile,filesize($pstn_mail_path));
	
	fclose($myfile);
	

	$adminmail = str_replace('###ACCOUNTID###', $_POST['option_selection1'], $adminmail);
	$adminmail = str_replace('###AMOUNT###',$_POST['mc_gross']." ".$_POST['mc_currency'],$adminmail );
	$adminmail = str_replace('###DOMAINNAME###', $result['domainName'], $adminmail);

	admin_mail("Amadeo Cloud PSTN Credit",$adminmail,$ipnname);
	
	amadeocloud_log("IPN :: AddCredit sent mail to ADMIN...[ ".$email_id." ]",$ipnname);
	
	
	
	
	amadeocloud_log("IPN :: AddCredit sending mail to customer...[ ".$result['email']." ]",$ipnname);
	
	$pstn_customer_mail_path="/etc/cloudPstnClientMail.txt";
	$clientMailFile = fopen($pstn_customer_mail_path, "r");
	$clientmail =fread($clientMailFile,filesize($pstn_customer_mail_path));
	fclose($clientMailFile);


	$clientmail = str_replace('###CUSTOMERNAME###',$result['full_name'].$result['full_lastname'] , $clientmail);
	$clientmail = str_replace('###AMOUNT###',$_POST['mc_gross']." ".$_POST['mc_currency'],$clientmail );
	customer_mail($result['email'], "Amadeo Cloud PSTN Credit",$clientmail,$ipnname);



