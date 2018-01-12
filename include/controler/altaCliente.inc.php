<?php
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_estado.inc.php";
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_municipio.inc.php";
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_localidad.inc.php";
	require_once FOLDER_MODEL . "extend/model.postales.inc.php";
	require_once FOLDER_MODEL . "extend/model.paises.inc.php";
	require_once FOLDER_MODEL . "extend/model.cliente.inc.php";
	require_once FOLDER_MODEL . "extend/model.registertmp.inc.php";
	require_once FOLDER_MODEL . "extend/model.login_user.inc.php";
	require 'admincuentas.php';
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

  function armar_filtros()
  {
    $filtros = '';
    if(isset($_GET['filter']) && $_GET['filter']!='')
    {
      foreach ($_GET['filter'] as $clave => $valor)
      {
        if($clave==0)
        {
          if($filtros=='')
          {
            $filtros .= " where  codigo  LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND codigo  LIKE '".$valor."%' ";
          }
        }
        else if($clave==1)
        {
          if($filtros=='')
          {
            $filtros .= " where nombre  LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND nombre LIKE '".$valor."%' ";
          }
        }
        else if($clave==2)
        {
          if($filtros=='')
          {
            $filtros .= " where precioVenta LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND precioVenta LIKE '".$valor."%' ";
          }
        }
        else if($clave==3)
        {
          if($filtros=='')
          {
            $filtros .= " where comisionMaxima LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND comisionMaxima  LIKE '".$valor."%' ";
          }
        }
        else if($clave==4)
        {
          if($filtros=='')
          {
            $filtros .= " where unidadesDisponibles LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND unidadesDisponibles comisionMaxima LIKE '".$valor."%' ";
          }
        }
       
      }
    }
    return $filtros;
  }

  function ordenar()
  {
    $ordenar = '';
    if(isset($_GET['col']) && $_GET['col']!='')
    {
      foreach ($_GET['col'] as $clave => $valor)
      {
        if($clave==0)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY codigo  ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY codigo DESC ';
          }
        }
        else if($clave==1)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY nombre ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY nombre DESC ';
          }
        }
        else if($clave==2)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY precioVenta ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY precioVenta DESC ';
          }
        }
        else if($clave==3)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY comisionMaxima ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY comisionMaxima DESC ';
          }
        }
        else if($clave==4)
        {
          if($valor==0)
          {
            $ordenar = ' ORDER BY unidadesDisponibles  ASC ';
          }
          else
          {
            $ordenar = ' ORDER BY unidadesDisponibles  DESC ';
          }
        }
        
      }
    }
    return $ordenar;
  }
	
  function getMunicipios($cveEstado) {
  	global $dbLink;
  	$r = new xajaxResponse ();
  	$Ciudades = new ModeloInegidomgeo_cat_municipio ( $dbLink );
  	$arrCiudades = $Ciudades->getAll ( $cveEstado );
  	return $arrCiudades ;
  }
  function getNombreMunicipio($cveEstado,$cveMunicipio) {
  	global $dbLink;
  	$r = new xajaxResponse ();
  	$Ciudades = new ModeloInegidomgeo_cat_municipio ( $dbLink );
  	$Ciudades->setCVE_ENT($cveEstado);
  	$Ciudades->setCVE_MUN($cveMunicipio);
  	if($Ciudades->getDatos())
  		return $Ciudades->getNOM_MUN();
  		return "No encontrado" ;
  }
	
  function valida_rfc_($valor){
  	$valor = str_replace("-", "", $valor);
  	$cuartoValor = substr($valor, 3, 1);
  	//RFC sin homoclave
  	if(strlen($valor)==10){
  		$letras = substr($valor, 0, 4);
  		$numeros = substr($valor, 4, 6);
  		if (ctype_alpha($letras) && ctype_digit($numeros)) {
  			return true;
  		}
  		return false;
  	}
  	// Sólo la homoclave
  	else if (strlen($valor) == 3) {
  		$homoclave = $valor;
  		if(ctype_alnum($homoclave)){
  			return true;
  		}
  		return false;
  	}
  	//RFC Persona Moral.
  	else if (ctype_digit($cuartoValor) && strlen($valor) == 12) {
  		$letras = substr($valor, 0, 3);
  		$numeros = substr($valor, 3, 6);
  		$homoclave = substr($valor, 9, 3);
  		if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) {
  			return true;
  		}
  		return false;
  		//RFC Persona Física.
  	} else if (ctype_alpha($cuartoValor) && strlen($valor) == 13) {
  		$letras = substr($valor, 0, 4);
  		$numeros = substr($valor, 4, 6);
  		$homoclave = substr($valor, 10, 3);
  		if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) {
  			return true;
  		}
  		return false;
  	}else {
  		return false;
  	}
  }//fin validaRF
  
  #----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
  //$xajax=new xajax();
  $xajax=new xajax();
  
  function cambioEstadoC($cveEstado) {
  	global $dbLink;
  	$r = new xajaxResponse ();
  	$Ciudades = new ModeloInegidomgeo_cat_municipio ( $dbLink );
  	$slcCiudades = '<option value="0">Seleccione una opcion</option>';
  	$arrCiudades = $Ciudades->getAll ( $cveEstado );
  	if ($Ciudades->getError ()) {
  		$r->mostrarError ( $Ciudades->getError () );
  		return $r;
  	}
  
  	foreach ( $arrCiudades as $cvCiudad => $nombre )
  		$slcCiudades .= '<option value="' . $cvCiudad . '">' . $nombre . '</option>';
  
  		$r->assign ( "municipioC", "innerHTML", $slcCiudades );
  
  		$r->ocultarMensaje ();
  		return $r;
  }
  $xajax->registerFunction ( "cambioEstadoC" );
  
  function cambioEstadoF($cveEstado) {
  	global $dbLink;
  	$r = new xajaxResponse ();
  	$Ciudades = new ModeloInegidomgeo_cat_municipio ( $dbLink );
  	$slcCiudades = '<option value="0">Seleccione una opcion</option>';
  	$arrCiudades = $Ciudades->getAll ( $cveEstado );
  	if ($Ciudades->getError ()) {
  		$r->mostrarError ( $Ciudades->getError () );
  		return $r;
  	}
  
  	foreach ( $arrCiudades as $cvCiudad => $nombre )
  		$slcCiudades .= '<option value="' . $cvCiudad . '">' . $nombre . '</option>';
  
  		$r->assign ( "municipioF", "innerHTML", $slcCiudades );
  
  		$r->ocultarMensaje ();
  		return $r;
  }
  $xajax->registerFunction ( "cambioEstadoF" );
  
  function cambioMunicipioC($cveEstado, $cveMunicipio) {
  	global $dbLink;
  	$r = new xajaxResponse ();
  
  	$Localidades = new ModeloInegidomgeo_cat_localidad ( $dbLink );
  	$slcLocalidades = '<option value="0">Seleccione una opci&oacute;n</option>';
  	$arrLocalidades = $Localidades->getAll ( $cveEstado, $cveMunicipio );
  	if ($Localidades->getError ()) {
  		$r->mostrarError ( $Localidades->getStrError () );
  		return $r;
  	}
  	foreach ( $arrLocalidades as $cvLocalidad => $nombre )
  		$slcLocalidades .= '<option value="' . $cvLocalidad . '">' . $nombre . '</option>';  	
  	$r->assign ( "ciudadC", "innerHTML", $slcLocalidades );
  	
  	$Codigo=new ModeloPostales();
	$asentamientos = $Codigo->getAllAsentamientosByEntidadMunicipio($cveEstado,$cveMunicipio);
	foreach ( $asentamientos as $cvLocalidad => $nombre )
		$slcAsentamiento .= '<option value="' . $cvLocalidad . '">' . $nombre . '</option>';  	
  	$r->assign("coloniaC","innerHTML",$slcAsentamiento);
  			
  			
  	$r->ocultarMensaje ();
  	return $r;
  }
  
  
  $xajax->registerFunction ( "cambioMunicipioC" );
  
  function cambioMunicipioF($cveEstado, $cveMunicipio) {
  	global $dbLink;
  	$r = new xajaxResponse ();
  
  	$Localidades = new ModeloInegidomgeo_cat_localidad ( $dbLink );
  	$slcLocalidades = '<option value="0">Seleccione una opci&oacute;n</option>';
  	$arrLocalidades = $Localidades->getAll ( $cveEstado, $cveMunicipio );
  	if ($Localidades->getError ()) {
  		$r->mostrarError ( $Localidades->getStrError () );
  		return $r;
  	}
  	foreach ( $arrLocalidades as $cvLocalidad => $nombre )
  		$slcLocalidades .= '<option value="' . $cvLocalidad . '">' . $nombre . '</option>';
  	$r->assign ( "ciudadF", "innerHTML", $slcLocalidades );
  		 
  	$Codigo=new ModeloPostales();
  	$asentamientos = $Codigo->getAllAsentamientosByEntidadMunicipio($cveEstado,$cveMunicipio);
  	foreach ( $asentamientos as $cvLocalidad => $nombre )
  		$slcAsentamiento .= '<option value="' . $cvLocalidad . '">' . $nombre . '</option>';
  	$r->assign("coloniaF","innerHTML",$slcAsentamiento);
  			
  			
  	$r->ocultarMensaje ();
  	return $r;
  }
  
  
  $xajax->registerFunction ( "cambioMunicipioF" );
  
  function buscarCPC($cp)
  {
  	$r=new xajaxResponse();
  
  	$Codigo=new ModeloPostales();
  	$datos=$Codigo->getInfo($cp);
  	if($Codigo->getError())
  	{
  		$r->mostrarError($Codigo->getStrError());
  		return $r;
  	}
  
  	if(count($datos)>0)
  	{
  
  	}
  	//print_r($datos);
  	$asentamientos = $Codigo->getAllAsentamientosByEntidadMunicipioCp($datos[c_estado],$datos[c_mnpio],$cp);
  	foreach ( $asentamientos as $cvLocalidad => $nombre )
  		$slcAsentamiento .= '<option value="' . $cvLocalidad . '">' . $nombre . '</option>';
  	//print_r($Codigo);
  	//print_r($asentamientos);
  	$r->assign("coloniaC","innerHTML",$slcAsentamiento);
  	
  	$r->call("colocarDatosC",$datos);
  	$r->ocultarMensaje();
  	return $r;
  
  }
  $xajax->registerFunction("buscarCPC");
  
  function buscarCPF($cp)
  {
  	$r=new xajaxResponse();
  
  	$Codigo=new ModeloPostales();
  	$datos=$Codigo->getInfo($cp);
  	if($Codigo->getError())
  	{
  		$r->mostrarError($Codigo->getStrError());
  		return $r;
  	}
  
  	if(count($datos)>0)
  	{
  
  	}
  	//print_r($datos);
  	$asentamientos = $Codigo->getAllAsentamientosByEntidadMunicipioCp($datos[c_estado],$datos[c_mnpio],$cp);
  	foreach ( $asentamientos as $cvLocalidad => $nombre )
  		$slcAsentamiento .= '<option value="' . $cvLocalidad . '">' . $nombre . '</option>';
  		//print_r($Codigo);
  		//print_r($asentamientos);
  	$r->assign("coloniaF","innerHTML",$slcAsentamiento);
  		 
  	$r->call("colocarDatosF",$datos);
  	$r->ocultarMensaje();
  	return $r;
  
  }
  $xajax->registerFunction("buscarCPF");
  
  function asentamientosCPC($c_estado,$c_mnpio,$cp)
  {
  	$r=new xajaxResponse();
  	$Codigo=new ModeloPostales();
  	$asentamientos = $Codigo->getAllAsentamientosByEntidadMunicipioCp($c_estado,$c_mnpio,$cp);
  	foreach ( $asentamientos as $cvLocalidad => $nombre )
  		$slcAsentamiento .= '<option value="' . $cvLocalidad . '">' . $nombre . '</option>';
  		//print_r($Codigo);
  		//print_r($asentamientos);
  	$r->assign("coloniaC","innerHTML",$slcAsentamiento);	   	  		 
  	return $r;
  
  }
  $xajax->registerFunction("asentamientosCPC");
  
  function asentamientosCPF($c_estado,$c_mnpio,$cp)
  {
  	$r=new xajaxResponse();
  	$Codigo=new ModeloPostales();
  	$asentamientos = $Codigo->getAllAsentamientosByEntidadMunicipioCp($c_estado,$c_mnpio,$cp);
  	foreach ( $asentamientos as $cvLocalidad => $nombre )
  		$slcAsentamiento .= '<option value="' . $cvLocalidad . '">' . $nombre . '</option>';
  		//print_r($Codigo);
  		//print_r($asentamientos);
  		$r->assign("coloniaF","innerHTML",$slcAsentamiento);
  		return $r;
  
  }
  $xajax->registerFunction("asentamientosCPF");
  
  function guardar($nombreC,
	$aPaternoC,
	$aMaternoC,
	$emailC,
	$rSocialC,
	$paisC,
	$estadoC,
	$CPC,
	$municipioC,
	$ciudadC,
	$coloniaC,
	$calleC,
	$noExteriorC,
	$noInteriorC,
	$areaTelefonoC,
	$ladaTelCasaC,
	$telCasaC,
	$extensionC,
	$nombreF,
	$aPaternoF,
	$aMaternoF,
	$emailF,
	$rSocialF,
	$paisF,
	$estadoF,
	$CPF,
	$municipioF,
	$ciudadF,
	$coloniaF,
	$calleF,
	$noExteriorF,
	$noInteriorF,
	$areaTelefonoF,
	$ladaTelCasaF,
	$telCasaF,
	$extensionF,
  	$RFC,
  	$areaTelCasaCA,
    $txtLadaTelCasaCA,
	$txtTelCasaCA,
    $nombreCF,
    $aPaternoCF,
	$aMaternoCF,
	$emailCF,
    $areaTelCasaCF,
    $txtLadaTelCasaCF,
    $txtTelCasaCF,
    $nombreCT,
    $aPaternoCT,
    $aMaternoCT,
    $emailCT,
    $areaTelCasaCT,
    $LadaTelCasaCT,
    $txtLadaTelCasaCT,
    $txtTelCasaCT,
	$usuario, 
    $password)
  {
  	global $_NOW_;
  	global $objSession;
  	
  	
  	$r=new xajaxResponse();
  	//var_dump(valida_rfc($RFC));
  	if(valida_rfc($RFC)==false){
  		$r->mostrarError("El RFC no es correcto.");
  		return $r;
  	}
  	
  	
  	$loginB = new ModeloLogin_user();
  	
  	
  	if($loginB->verificarUserName($usuario)==true){//si existe usuario
  		$r->mostrarError("Este usuario '".$usuario."' ya esta registrado.");
  		return $r;
  	}
  	if($loginB->getError()){
  		$r->mostrarError("error.".$loginB->getStrError());
  		return $r;
  	}
  	
  	//registertem 
  	$clienteTmp = new ModeloRegistertmp();
  	$clienteTmp->transaccionIniciar();
  	//$clienteTmp->setIdRegisterTmp($idRegisterTmp);
  	$clienteTmp->setFull_name($nombreCF);
  	$clienteTmp->setFull_lastname($aPaternoCF ." ". $aMaternoCF);
  	//$clienteTmp->setEmpresaTxt($empresaTxt);
  	$clienteTmp->setPhone($txtLadaTelCasaCF." ".$txtTelCasaCF);
  	//$clienteTmp->setIdCountry($idCountry);
  	$clienteTmp->setState($estadoC);
  	$clienteTmp->setCity($ciudadC);  	
  	$clienteTmp->setAddressTxt($calleC ." ". $noExteriorC." ".$noInteriorC);
  	$clienteTmp->setCpTxt($CPC);
  	//$clienteTmp->setSameDir();
  	$clienteTmp->setFull_fiscalname($nombreF ." ". $aPaternoF ." ".$aMaternoF);
  	$clienteTmp->setEmailfiscal($emailF);
  	$clienteTmp->setPhonefiscal($ladaTelCasaF." ". $telCasaF);
  	$clienteTmp->setAddressFiscalTxt($calleF ." ".$noExteriorF." ".$noInteriorF);
  	$clienteTmp->setCpFiscalTxt($CPF);
  	//$clienteTmp->setIdCountryFiscal($idCountryFiscal);
  	$clienteTmp->setStateFiscal($estadoF);
  	$clienteTmp->setCityFiscal($ciudadF);
  	$clienteTmp->setVatFiscal($RFC);
  	//$clienteTmp->setDomainName($domainName);
  	//$clienteTmp->setPassword($password);
  	$clienteTmp->setCrmLanguage("es");
  	$clienteTmp->setInvoiceLanguage("es");
  	//$clienteTmp->setIdAmadeoOptions($idAmadeoOptions);
  	//$clienteTmp->setNbrUsers($nbrUsers);
  	//$clienteTmp->setOrderTotal($orderTotal);
  	$clienteTmp->setFechaAlta($_NOW_);
  	//$clienteTmp->setEstatusPago($estatusPago);
  	$clienteTmp->setEstatusPagoPendiente();
//   	$clienteTmp->setEstatusPagoRechazado();
//   	$clienteTmp->setEstatusPagoAceptado();
  	//$clienteTmp->setProveedorPago($proveedorPago);
  	$clienteTmp->setEmail($email);
  	//$clienteTmp->setAgentId($agentId);
  	//$clienteTmp->setEstatus($estatus);
  	$clienteTmp->setEstatusCompletado();
  	//$clienteTmp->setEstatusPendiente();
  	//$clienteTmp->setType($type);
  	$clienteTmp->setTypeTrial();
//   	$clienteTmp->setTypePayment();
//   	$clienteTmp->setTypeReseller();
//   	$clienteTmp->setTypeAdmin();
  	//$clienteTmp->setTypeUpdate();
  	//$clienteTmp->setIdAccount($idAccount);
  	//$clienteTmp->setId_servicio($id_servicio);
  	
  	$clienteTmp->guardar();
  	if($clienteTmp->getStrError()){
  		$r->mostrarError("Ha ocurrido un error, intente más tarde. ");
  		return $r; 
  	}
  	
  	$login = new ModeloLogin_user();
  	//$login->setId_login($id_login);
  	$login->setId_usuario($clienteTmp->getIdRegisterTmp());
  	$login->setUser_name($usuario);
  	echo $password;
  	
  	$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
  	$passwordSalt = hash('sha512', $password. $random_salt);
  	
  	$login->setPassword($passwordSalt);
  	$login->setSalt($random_salt);
  	  	
  	$login->setFirst_name($nombreF);
  	$login->setLast_name($aPaternoF." ".$aMaternoF);
  	$login->setId_rol(1);//$login->setId_rol(2);
  	$login->guardar();
  	if($login->getStrError()){
  		$r->mostrarError("Ha ocurrido un error, intente más tarde. ".$login->getStrError());
  		return $r;
  	}
  	
  	
  	$cliente=new ModeloCliente();
  	//$cliente->setIdcliente($idcliente);
  	$cliente->setFechaAlta($_NOW_);  	
  	//print_r($objSession);
  	$cliente->setIdLoginMember($objSession->getIdLogin());
  	$cliente->setNombreC($nombreC);
  	$cliente->setAPaternoC($aPaternoC);
  	$cliente->setAMaternoC($aMaternoC);
  	$cliente->setEmailC($emailC);
  	$cliente->setRSocialC($rSocialC);
  	$cliente->setPaisC($paisC);
  	$cliente->setEstadoC($estadoC);
  	$cliente->setCPC($CPC);
  	$cliente->setMunicipioC($municipioC);
  	$cliente->setCiudadC($ciudadC);
  	$cliente->setColoniaC($coloniaC);
  	$cliente->setCalleC($calleC);
  	$cliente->setNoExteriorC($noExteriorC);
  	$cliente->setNoInteriorC($noInteriorC);
  	$cliente->setAreaTelefonoC($areaTelefonoC);
  	$cliente->setLadaTelCasaC($ladaTelCasaC);
  	$cliente->setTelCasaC($telCasaC);
  	$cliente->setExtensionC($extensionC);
  	$cliente->setNombreF($nombreF);
  	$cliente->setAPaternoF($aPaternoF);
  	$cliente->setAMaternoF($aMaternoF);
  	$cliente->setEmailF($emailF);
  	$cliente->setRSocialF($rSocialF);
  	$cliente->setPaisF($paisF);
  	$cliente->setEstadoF($estadoF);
  	$cliente->setCPF($CPF);
  	$cliente->setMunicipioF($municipioF);
  	$cliente->setCiudadF($ciudadF);
  	$cliente->setColoniaF($coloniaF);
  	$cliente->setCalleF($calleF);
  	$cliente->setNoExteriorF($noExteriorF);
  	$cliente->setNoInteriorF($noInteriorF);
  	$cliente->setAreaTelefonoF($areaTelefonoF);
  	$cliente->setLadaTelCasaF($ladaTelCasaF);
  	$cliente->setTelCasaF($telCasaF);
  	$cliente->setExtensionF($extensionF);
  	//$cliente->setEstatus($estatus);
  	$cliente->setEstatusDisponible();
  	$cliente->setRFC($RFC);
  	$cliente->setAreaTelCasaCA($areaTelCasaCA);
  	$cliente->setLadaTelCasaCA($txtLadaTelCasaCA);
  	$cliente->setTelCasaCA($txtTelCasaCA);
  	$cliente->setNombreCF($nombreCF);
  	$cliente->setAPaternoCF($aPaternoCF);
  	$cliente->setAMaternoCF($aMaternoCF);
  	$cliente->setEmailCF($emailCF);
  	$cliente->setAreaTelCasaCF($areaTelCasaCF);
  	$cliente->setLadaTelCasaCF($txtLadaTelCasaCF);
  	$cliente->setTelCasaCF($txtTelCasaCF);
  	$cliente->setNombreCT($nombreCT);
  	$cliente->setAPaternoCT($aPaternoCT);
  	$cliente->setAMaternoCT($aMaternoCT);
  	$cliente->setEmailCT($emailCT);
  	$cliente->setAreaTelCasaCT($areaTelCasaCT);
  	$cliente->setLadaTelCasaCT($txtLadaTelCasaCT);
  	$cliente->setTelCasaCT($txtTelCasaCT);
  	$cliente->setEstatus($estatus);
  	$cliente->setId_usuario($clienteTmp->getIdRegisterTmp());
  	
  	$cliente->guardar();
  	if($cliente->getStrError()){
  		$r->mostrarError("Ha ocurrido un error, intente más tarfde.");
  		return $r;
  	}
  	$clienteTmp->transaccionCommit();
  	//$cliente->setEstatusBaja();
  	//	$r->assign("coloniaF","innerHTML",$slcAsentamiento);
  	$r->ocultarMensaje();
  	$r->mostrarExito("La información se almaceno correctamente.");
  	$r->redirect("dashboard.php",1);
  	return $r;
  
  }
  $xajax->registerFunction("guardar");
  
  $xajax->processRequest();

	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#




	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

  //CLAVES DE ESTADOS (ENTIDADES FEDERATIVAS)
  $Estados=new ModeloInegidomgeo_cat_estado();
  $arrEstados=$Estados->getAll();
  
  $slcEstados='';
  if($Estados->getError())
  {
  	$arrEstados=array('0'=>$Estados->getStrError());
  }
  else
  {
  	$slcEstados.='<option value="0">Selecciona una opci&oacute;n</option>';;
  }
  
  foreach($arrEstados AS $cveEstado=>$nomEstado)
  	$slcEstados.='<option value="' . $cveEstado . '">' . $nomEstado . '</option>';
  
  //paises
  	//CLAVES DE ESTADOS (ENTIDADES FEDERATIVAS)
  	$Paises = new ModeloPaises();
  	$arrPaises=$Paises->getAll();
  	
  	$slcPaises='';
  	if($Paises->getError())
  	{
  		$arrPaises=array('0'=>$Paises->getStrError());
  	}
  	else
  	{
  		$slcPaises.='<option value="0">Selecciona una opci&oacute;n</option>';;
  	}
  	
  	foreach($arrPaises AS $cvePaises=>$nomPaises)
  		if($cvePaises==140)
  			$slcPaises.='<option selected value="' . $cvePaises. '">' . $nomPaises. '</option>';
  		else
  			$slcPaises.='<option value="' . $cvePaises. '">' . $nomPaises. '</option>';

  //codigo telefono
  		$arrPaisesCodigos=$Paises->getAllCodigoTel();
  		 
  		$slcPaisesCodigos='';
  		if($Paises->getError())
  		{
  			$arrPaisesCodigos=array('0'=>$Paises->getStrError());
  		}
  		else
  		{
  			//$slcPaises.='<option value="0">Selecciona una opci&oacute;n</option>';;
  		}
  		 //print_r($arrPaisesCodigos);
  		 foreach($arrPaisesCodigos AS $cve=>$nom){
  		 	$arreglo = $arrPaisesCodigos[$cve];
  		 	//print_r($arreglo);
  		 //	for($i=0;$i<count($arreglo); $i++){
  		 		if($arreglo['idPais']==140)
  		 			$slcPaisesCodigos.='<option selected value="' . $arreglo['idPais']. '">' . " (".$arreglo['phone_code'].")".$arreglo['nombre'] . '</option>';
  		 		else
  		 			$slcPaisesCodigos.='<option value="' . $arreglo['idPais']. '">' . " (".$arreglo['phone_code'].")".$arreglo['nombre'] . '</option>';
  		 //}
  		
  		}
  				