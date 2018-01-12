
<?php

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	//require_once APP_LOGIN;
	
	
	
	require_once FOLDER_MODEL . "model.persona.inc.php";
	require_once FOLDER_MODEL . "model.beneficiario.inc.php";
	require_once FOLDER_MODEL . "model.beneficiario_cuenta.inc.php";
	require_once FOLDER_MODEL . "model.comercio.inc.php";
	require_once FOLDER_MODEL . "model.comercio_cuenta.inc.php";
	require_once FOLDER_MODEL . "model.persona_movimiento.inc.php";
	require_once FOLDER_MODEL . "model.comercio_movimiento.inc.php";
	require_once FOLDER_INCLUDE . "lib/Image/php_image_magician.php";
	
	
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	/*
	function getIdPersonaValidacionHuella($huella)
	{
		$Biometrico = str_replace ( ' ', '+', $huella );
	$url = "http://216.58.174.68/nexafp/identify/mh";
	$huellas = array (
			'RIGHT_INDEX' => array (
					'image' => $Biometrico 
			) 
	);
	$data = json_encode ( array (
			'probe' => $huellas,
			'workflow' => array (
					'filters' => [ 
							array (
									'algorithm' => 'D350',
									'percentage' => 0.1,
									'minimum' => 100000,
									'fingerprint_types' => [ 
											'RIGHT_THUMB',
											'RIGHT_INDEX',
											'RIGHT_MIDDLE',
											'RIGHT_RING',
											'RIGHT_LITTLE',
											'LEFT_THUMB',
											'LEFT_INDEX',
											'LEFT_MIDDLE',
											'LEFT_RING',
											'LEFT_LITTLE' 
									] 
							) 
					],
					'comparator' => array (
							'algorithm' => 'D600',
							'fingerprint_types' => [ 
									'RIGHT_THUMB',
									'RIGHT_INDEX',
									'RIGHT_MIDDLE',
									'RIGHT_RING',
									'RIGHT_LITTLE',
									'LEFT_THUMB',
									'LEFT_INDEX',
									'LEFT_MIDDLE',
									'LEFT_RING',
									'LEFT_LITTLE' 
							] 
					) 
			),
			'candidate_list_size' => 3 
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
	
	#var_dump ( $response );
	#var_dump ( $status );
	
	if ($status == 200) {
		if (! is_null ( json_decode ( $json_response ) )) {
			$str=json_decode($json_response);
			if(json_encode($str->candidate_list)){
				foreach ( $response as $respuesta => $candidatos ) {
					foreach ( $candidatos as $num => $arraInfo ) {
						$id = $arraInfo ['id'];
						$score = $arraInfo ['score'];
						$score_fmr = $arraInfo ['score_fmr'];
						if ($score > 0) {
							return $id;
						}
						return false;
					}
				}
			}
			returnAppError ( $response ['error'] );
		}
		
	} else {
		if (! is_null ( json_decode ( $json_response ) )) {
			returnAppError ( $response ['error'] );
		} else {
			returnAppError ( $json_response );
		}
	}
		
	}
	*/
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------Validacion de variables------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	if(!isset($param['huella'])&&!isset($param['rostro']))
		returnAppError("No se encuentra el parametro de informacion biometrica");

	if(!isset($param['monto']))
		returnAppError("No se encuentra el parametro monto.");

	if(!is_numeric($param['monto'])||$param['monto']<=0)
		returnAppError("Parametro monto no valido.");
	
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------Procesamiento de comando-----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	//if ( $param['huella'] == null &&  $param['rostro'] === null)
		//	die(returnAppError("Falta dato biometrico"));
		
	if(isset($param['huella']))
		$bioData='huella';
	else 
		$bioData='rostro';
		//Huella en PNG base64
		$InfoBio = str_replace ( ' ', '+', $param [$bioData]);
	if(isset($param['huella'])){
		//Escribir archivo PNG
		$textoCSV=base64_decode($InfoBio);
		$archivoCS=FOLDER_INCLUDE . "tmp/" . uniqid() . ".png";
		$pf=fopen($archivoCS,"w");
		if(!$pf)
			die(returnAppError("Imposible abrir archivo"));
		
			fwrite($pf,$textoCSV);
			fclose($pf);
		
			//Escribe archivo en BMP
			$magicianObj = new imageLib($archivoCS);
			$fileBMPName=FOLDER_INCLUDE . "tmp/" . uniqid() . ".bmp";
			$magicianObj->saveImage($fileBMPName);
		
			//regresa a base64
			$InfoBio=base64_encode(file_get_contents($fileBMPName));
	}
	if ($bioData=='huella') {
		$validacion = getValidacionHuella($InfoBio);
	}else {
		$validacion = getValidacionRostro($InfoBio);
	}
	
	if($validacion[0]===false)
		die(returnAppError($bioData." no identificada."));
	$idPersonaBeneficiario=$validacion[1];
		
	$Persona=new ModeloPersona();
	$Persona->transaccionIniciar();
	
	$Persona->setIdPersona($idPersonaBeneficiario);
	if($Persona->getError())
		returnAppError($Persona->getStrError() . " code:[01]");
	
	$Beneficiario=new ModeloBeneficiario();
	$Beneficiario->getDatosByIdPersona($idPersonaBeneficiario);
	if($Beneficiario->getError())
		returnAppError($Beneficiario->getStrError() . " code:[02]");
	
	
	$Cuenta=new ModeloBeneficiario_cuenta();
	$Cuenta->setIdBeneficiario($Beneficiario->getIdBeneficiario());	
	$Cuenta->getDatosByIdBeneficiario();
	if($Cuenta->getError())
		returnAppError($Cuenta->getStrError() . " code:[03]");
	if($Cuenta->getSaldo()<$param['monto'])
		returnAppError("Saldo insuficiente.");
	
	
	$Comercio=new ModeloComercio();
	$Comercio->setIdLoginMember($App->getIdLoginMember());
	$Comercio->getDatosByIdLoginMember();
	if($Comercio->getError())
		returnAppError($Comercio->getStrError() . " code:[04]");
	
	$CuentaComercio=new ModeloComercio_cuenta();
	$CuentaComercio->setIdComercio($Comercio->getIdComercio());
	$CuentaComercio->getDatosByIdComercio();
	if($CuentaComercio->getError())
		returnAppError($CuentaComercio->getStrError() . " code:[05]");
		
	$Movimiento=new ModeloPersona_movimiento();
	$Movimiento->setFecha($_NOW_);
	$Movimiento->setIdPersona($idPersonaBeneficiario);
	$Movimiento->setMonto($param['monto']);
	$Movimiento->setTipoEgreso();
	$Movimiento->setIdComercio($Comercio->getIdComercio());
	$Movimiento->Guardar();
	if($Movimiento->getError())
		returnAppError($Movimiento->getStrError());
	
	$MovimientoComercio=new ModeloComercio_movimiento();
	$MovimientoComercio->setFecha($_NOW_);
	$MovimientoComercio->setIdBeneficiario($Beneficiario->getIdBeneficiario());
	$MovimientoComercio->setIdComercio($Comercio->getIdComercio());
	$MovimientoComercio->setIdLoginMember($App->getIdLoginMember());
	$MovimientoComercio->setIdPersona($Beneficiario->getIdPersona());
	$MovimientoComercio->setMonto($param['monto']);
	$MovimientoComercio->setTipoIngreso();
	$MovimientoComercio->Guardar();
	
	if($MovimientoComercio->getError())
		returnAppError($MovimientoComercio->getStrError() . " code:[06]");
	
	$Cuenta->setSaldo($Cuenta->getSaldo()-$param['monto']);
	$Cuenta->Guardar();
	if($Cuenta->getError())
		returnAppError($Cuenta->getStrError() . " code:[07]");
	$CuentaComercio->setSaldo($CuentaComercio->getSaldo()+$param['monto']);
	$CuentaComercio->Guardar();
	if($CuentaComercio->getError())
		returnAppError($CuentaComercio->getStrError() . " code:[08]");
	
	$Persona->transaccionCommit ();
	
	$respuesta = new clsAppGenericResponse ();
	$respuesta->setMsg ( "" );
	$respuesta->setResult ( "OK" );
	$dataResponse = array (
		"monto" => 'MXN ' . number_format ( $param ['monto'], 2, ",", "." ),
		"folio" => str_pad ( $MovimientoComercio->getIdComercioMovimiento (), 8, "0", STR_PAD_LEFT ) 
	);
	$respuesta->setData ( $dataResponse );
	die ( $respuesta->getJSONResponse () );
 	
	
		
	
	
	
	
	
		
	