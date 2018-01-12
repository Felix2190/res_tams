<?php

// ----------------------------------------------------------------------------------------------------------------------#
// -------------------------------------------------------Includes-------------------------------------------------------#
// ----------------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL . "model.persona.inc.php";
require_once FOLDER_MODEL . "model.persona_biometrico.inc.php";
require_once FOLDER_MODEL . "model.biometrico.inc.php";
require_once FOLDER_MODEL . "model.beneficiario.inc.php";
require_once FOLDER_MODEL . "model.beneficiario_cuenta.inc.php";


require_once FOLDER_INCLUDE . "lib/Image/php_image_magician.php";

// ----------------------------------------------------------------------------------------------------------------------#
// -------------------------------------------------------Funciones------------------------------------------------------#
// ----------------------------------------------------------------------------------------------------------------------#
function enrolamientoHuella($datosBiometricos) {
	$url = "http://216.58.174.68/nexafp/add/mh";
	$data = json_encode ( array (
			'encounter' => $datosBiometricos 
	) );
	
	$curl = curl_init ( $url );
	curl_setopt ( $curl, CURLOPT_CUSTOMREQUEST, "POST" );
	curl_setopt ( $curl, CURLOPT_POSTFIELDS, $data );
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
	curl_setopt ( $curl, CURLOPT_HTTPHEADER, array (
			'Content-Type: application/json',
			'Content-Length: ' . strlen ( $data ) 
	) );
	$json_response = curl_exec ( $curl );
	
	
	
	$status = curl_getinfo ( $curl, CURLINFO_HTTP_CODE );
	curl_close ( $curl );
	$response = json_decode ( $json_response, true );
	
	//echo "[Status:" . $status . "]";
	if ($status != 200) 
	{
		if (! is_null ( json_decode ( $json_response ) )) 
		{
			$msjError = $response ['error'];
			return array (
					'error' => true,
					'msj' => "[x1]" . $msjError ['description'] 
			);
		} 
		else 
		{
			return array (
					'error' => true,
					'msj' => "[x2]" . $json_response 
			);
		}
	} 
	else 
	{
		return array (
				'error' => false,
				'id'=>$response['id']
		);
	}
	// /print_r( $json_response.' '.$status);
}

function enrolamientoRostro($datosBiometricos) {
	$url = "http://216.58.174.68:8081/nexaface/add";
	$data = json_encode ( array (
			'encounter' => $datosBiometricos
	) );

	$curl = curl_init ( $url );
	curl_setopt ( $curl, CURLOPT_CUSTOMREQUEST, "POST" );
	curl_setopt ( $curl, CURLOPT_POSTFIELDS, $data );
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
	curl_setopt ( $curl, CURLOPT_HTTPHEADER, array (
			'Content-Type: application/json',
			'Content-Length: ' . strlen ( $data )
	) );
	$json_response = curl_exec ( $curl );


	$status = curl_getinfo ( $curl, CURLINFO_HTTP_CODE );
	curl_close ( $curl );
	$response = json_decode ( $json_response, true );

	//echo "[Status:" . $status . "]";
	if ($status != 200)
	{
		if (! is_null ( json_decode ( $json_response ) ))
		{
			$msjError = $response ['error'];
			return array (
					'error' => true,
					'msj' => "[x1]" . $msjError ['description']
			);
		}
		else
		{
			return array (
					'error' => true,
					'msj' => "[x2]" . $json_response
			);
		}
	}
	else
	{
		return array (
				'error' => false,
				'id'=>$response['external_id']
		);
	}
	// /print_r( $json_response.' '.$status);
}


function nuevo_enroll($arrayParam) {
	if(!isset($arrayParam['huella'])&&!isset($arrayParam['rostro']))
		die(returnAppError("Falta dato biometrico"));
	
	if (isset ( $arrayParam ['huella'] )) {
		if (! isset ( $arrayParam ['nombre'] ))
			returnAppError ( "Falta parametro Nombre" );
		if (! isset ( $arrayParam ['ap'] ))
			returnAppError ( "Falta parametro Apellido paterno" );
		if (! isset ( $arrayParam ['am'] ))
			returnAppError ( "Falta parametro apellido materno" );
		
		$nombre = $arrayParam ['nombre']; // capturar el nombre
		$ap = $arrayParam ['ap'];
		$am = $arrayParam ['am'];
	}
		// no existe key idPersona
	///} else if (! array_key_exists ( 'data', $arrayParam )) {
		// no existe key data biometrics

			if (isset($arrayParam ['huella'])) {
			// Huella en PNG base64
			$huella = str_replace ( ' ', '+', $arrayParam ['huella'] );
			
			// Escribir archivo PNG
			$imgPng = base64_decode ( $huella );
			$filePNGName = FOLDER_INCLUDE . "tmp/" . uniqid () . ".png";
			$pf = fopen ( $filePNGName, "w" );
			if (! $pf)
				die ( returnAppError ( "Imposible abrir archivo" ) );
			
			fwrite ( $pf, $imgPng );
			fclose ( $pf );
			
			// Escribe archivo en BMP
			$magicianObj = new imageLib ( $filePNGName );
			$fileBMPName = FOLDER_INCLUDE . "tmp/" . uniqid () . ".bmp";
			$magicianObj->saveImage ( $fileBMPName );
			
			// regresa a base64
			$huella = base64_encode ( file_get_contents ( $fileBMPName ) );
			
			$validacion = getValidacionHuella ( $huella );
			if ($validacion [0] == true)
				die ( returnAppError ( "Dato biometrico existente en repositorio" ) );
			
			$KeyBIO = 'RIGHT_INDEX';
			$claveBio = 'DI';
			$NombreID = 'id';
			$InfoBio = $huella;
			$encounter = array (
					'image' => str_replace ( ' ', '+', $InfoBio ) 
			);
		} else if (isset($arrayParam ['rostro'])) {
			// Huella en PNG base64
			$InfoBio = str_replace ( ' ', '+', $arrayParam ['rostro'] );
			
			// Escribir archivo PNG
			$imgPng = base64_decode ( $InfoBio );
			$filePNGName = FOLDER_INCLUDE . "tmp/" . uniqid () . ".png";
			$pf = fopen ( $filePNGName, "w" );
			if (! $pf)
				die ( returnAppError ( "Imposible abrir archivo" ) );
			
			fwrite ( $pf, $imgPng );
			fclose ( $pf );
			
			$validacion = getValidacionRostro( $InfoBio );
			
			if ($validacion [0] == true)
				die ( returnAppError ( "Dato biometrico existente en repositorio" ) );
					
			$KeyBIO = 'VISIBLE_FRONTAL';
			$claveBio = 'RS';
			$NombreID = 'external_id';
			$encounter = $InfoBio;
		}
		$Biometrico = new ModeloBiometrico ();
		$clavesPermitidas = $Biometrico->getArrayClaves (); // claver Aware biometricos
		$arrayData = array ();
		$BiometricosData = array ();
		///$arrayDataBio = $arrayParam ['data']; // datos biometricos
		/*
		if (! is_null ( $arrayDataBio )) {
			$KeyRecibidas = array ();
			foreach ( $arrayDataBio as $KeyBio => $Dato ) { // recorrer el array Data
				$JSON_DataBio = $arrayDataBio [$KeyBio]; // verificar que cada dato sea un json
				if (is_null ( $JSON_DataBio )) { // dato json null?
					die ( returnAppError ( $KeyBio . " no es un objeto JSON" ) );
				}
				if (! array_key_exists ( $KeyBio, $clavesPermitidas )) { // verificar que es una key aware
					die ( returnAppError ( "La clave para el biometrico " . $KeyBio . " no permitida." ) );
				}
				if (in_array ( $KeyBio, $KeyRecibidas )) { // verificar que no haya duplicidad
					die ( returnAppError ( "La clave para el biometrico " . $KeyBio . " esta repetida." ) );
				}
				$KeyRecibidas [] = $KeyBio;
				$arrayData [$clavesPermitidas [$KeyBio]] = array (
						'image' => str_replace ( ' ', '+', $Dato ['image'] ) 
				);
				$BiometricosData [] = array (
						$KeyBio,
						str_replace ( ' ', '+', $Dato ['image'] ) 
				);
			}
		*/	
		
		
		$arrayData [$KeyBIO] =$encounter;
		$BiometricosData [] = array (
				$claveBio,
				str_replace ( ' ', '+', $InfoBio)
		);
		$IDS=array();
		if ((isset($arrayParam['rostro'])&&!isset($arrayParam['id']))||isset($arrayParam['huella']))
			$IDS=obtenerId($nombre, $ap, $am);
		else 
			$IDS[]=$arrayParam['id'];
		//if (isset($arrayParam ['huella'])) 
			$arrayData [$NombreID] = $IDS[0].'';
			
			if (guardarBiometricos ($IDS[0].'', $BiometricosData )) {
				if (isset($arrayParam ['huella'])) {
					$WS_resultado = enrolamientoHuella ( $arrayData );
				}else {
					print_r('rostro comparre');
					$WS_resultado = enrolamientoRostro( $arrayData );
				}
				if ($WS_resultado ['error']) 
				{
					$Persona = new ModeloPersona ();
					$Persona->setIdPersona($IDS[0]);
					$Beneficiario=new ModeloBeneficiario();
					$Beneficiario->setIdBeneficiario($IDS[1]);
					$Cuenta=new ModeloBeneficiario_cuenta();
					$Cuenta->setIdBeneficiarioCuenta($IDS[2]);
					$Cuenta->Borrar();
					$Beneficiario->Borrar();
					$Persona->Borrar();
					die ( returnAppError ("[03] " .  $WS_resultado ['msj'] ) );
				}
				// $Persona->transaccionCommit();
				$respuesta = new clsAppGenericResponse ();
				$respuesta->setMsg ( "Enrolamiento exitoso! Su id es ". $WS_resultado['id']);
				$respuesta->setResult ( "OK" );
				$respuesta->setData($WS_resultado['id']);
				die ( $respuesta->getJSONResponse () );
			}
			/*
			 * $ID=obtenerId($nombre);
			 * $respuesta=new clsAppGenericResponse();
			 * $respuesta->setMsg("Enrolamiento exitoso!");
			 * $respuesta->setResult("OK");
			 * $respuesta->setData($ID);
			 * die($respuesta->getJSONResponse());
			 */
			// print_r('imprimir '.$banderaJSON);
	/*	} else {
			// no es un objeto json data
			die ( returnAppError ( "" ) );
		}
		*/

}
function obtenerId($nombre,$ap, $am) {
	$Persona = new ModeloPersona ();
	$Persona->transaccionIniciar();
	$Persona->setNB_NOMBRE ( $nombre );
	$Persona->setNB_PRIMER_AP($ap);
	$Persona->setNB_SEGUNDO_AP($am);
	$Persona->setFH_NACIMIENTO ( "0000-00-00" );
	$Persona->setCD_SEXOH ();
	$Persona->setFechaHoraAlta ( date ( "Y-m-d H:i:s" ) );
	$Persona->setCD_EDO_CIVIL ( 9 );
	$Persona->Guardar ();
	if ($Persona->getError ()) {
		die ( returnAppError ( "No se puede registrar a " . $nombre ) );
	}
	
	$Beneficiario=new ModeloBeneficiario();
	$Beneficiario->setIdPersona($Persona->getIdPersona());
	$Beneficiario->setIdPrograma(10);
	$Beneficiario->setIdVacante(15);
	$Beneficiario->setFechaAsignacio(date ( "Y-m-d H:i:s" ) );
	$Beneficiario->setFechaBaja(date ( "Y-m-d H:i:s" ) );
	$Beneficiario->setFechaRevisionDocumento(date ( "Y-m-d H:i:s" ) );
	$Beneficiario->Guardar();
	if ($Beneficiario->getError ()) {
		die ( returnAppError ( "No se puede registrar a beneficiario [" . $Beneficiario->getStrError() . "]") );
	}
	
	
	$Cuenta=new ModeloBeneficiario_cuenta();
	$Cuenta->setIdBeneficiario($Beneficiario->getIdBeneficiario());
	$Cuenta->setIdPersona($Persona->getIdPersona());
	$Cuenta->setSaldo(600);
	$Cuenta->Guardar();
	if ($Cuenta->getError ()) {
		die ( returnAppError ( "No se puede registrar cuenta de beneficiario [" . $Cuenta->getStrError() . "]") );
	}
	$idP=$Persona->getIdPersona();
	$Persona->transaccionCommit();
	return array($idP,$Beneficiario->getIdBeneficiario(),$Cuenta->getIdBeneficiarioCuenta() );
}
function guardarBiometricos($idPersona, $Biometricos) {
	$Carpeta = "../biometrico/" . $idPersona . "/";
	
	if (! is_dir ( $Carpeta ))
		if (! mkdir ( $Carpeta ))
			die ( returnAppError ( "Imposible creacion de carpeta para almacenar informacion." ) );
	
	global $_NOW_;
	foreach ( $Biometricos as $biometrico ) {
		$B = new ModeloPersona_biometrico ();
		$B->setIdPersona ( $idPersona );
		$B->setBiometrico ( $biometrico [0] );
		$B->clearBiometrico ();
		if ($B->getError ())
			die ( returnAppError ("[01] " . $B->getStrError () ) );
		$B->setEstatusVigente ();
		$B->setFechaAlta ( $_NOW_ );
		$B->setIdLoginMember ( 1 );
		
		$archivo = $biometrico [0] . "_" . $idPersona . "_" . date ( "YmdHis" ) . "_" . rand ( 1000, 9999 ) . ".base64";
		
		$pf = fopen ( $Carpeta . $archivo, "w" );
		if (! $pf)
			die ( returnAppError ( "Imposible creacion de archivo para almacenar informacion." ) );
		if (! fwrite ( $pf, $biometrico [1] ))
			die ( returnAppError ( "Imposible grabar datos." ) );
		fclose ( $pf );
		
		$B->setArchivo ( $archivo );
		$B->Guardar ();
		if ($B->getError ())
			die ( returnAppError ("[02] " .  $B->getStrError () ) );
		$B->transaccionCommit ();
		return true;
	}
}
// ----------------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------Procesamiento de comando-----------------------------------------------#
// ----------------------------------------------------------------------------------------------------------------------#

// var_dump ( $param );
nuevo_enroll ( $param );
	