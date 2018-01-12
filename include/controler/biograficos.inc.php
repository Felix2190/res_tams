<?php
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_estado.inc.php";
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_municipio.inc.php";
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_localidad.inc.php";
	require_once FOLDER_MODEL . "extend/model.listadoscortos.inc.php";
	require_once FOLDER_MODEL . "extend/model.paises.inc.php";
	require_once FOLDER_MODEL . "extend/model.inegi_domicilio.inc.php";
	require_once FOLDER_MODEL . "extend/model.postales.inc.php";
	
	require_once FOLDER_MODEL . "extend/model.persona_documento.inc.php";
	require_once FOLDER_MODEL . "extend/model.persona.inc.php";
	require_once FOLDER_MODEL . "extend/model.persona_datos_extras.inc.php";
	require_once FOLDER_MODEL . "extend/model.persona_domicilio.inc.php";
	require_once FOLDER_MODEL . "extend/model.contacto_emergencia.inc.php";
	
	require_once FOLDER_MODEL . "extend/model.etapa.inc.php";
	require_once FOLDER_MODEL . "extend/model.turno.inc.php";
	require_once FOLDER_MODEL . "extend/model.estado_civil.inc.php";
	
	require_once FOLDER_MODEL . "extend/model.registertmp.inc.php";
	require_once FOLDER_MODEL . "extend/model.login_user.inc.php";
	
	require 'admincuentas.php';
	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
//    	$_SESSION['etapa']='datos';
  //  	$_SESSION['datos']='biograficos';
    //	$_SESSION['_biograficos']= 1;
	
//	unset($_SESSION['idPersonaExtras']);
	//Cargamos el Id del turno
	if ($_SESSION['etapa']!='datos'){
	    header("Location: dashboard.php");
	    die();
	}
	
	if ($_SESSION['datos']!='biograficos'){
	    header("Location: dashboard.php");
	    die();
	}
	
	if(!isset($_SESSION['idTurno']))
	{
	    header("Location: dashboard.php");
	    die();
	}
	$txtIdTurno=$_SESSION['idTurno'];
	
	// recuperar datos
	$turno = new ModeloTurno();

/*	$resp=$turno->existsTurnoInEtapa($txtIdTurno, 3);

	if (!$resp[0]){
	    
	    header("Location: listadoIdentidades.php");
	    die();
	}
	*/
	$turno->setIdTurno($txtIdTurno);
	    
	    $_SESSION['idPersonaBio']=$turno->getIdPersona();
	    
	    $personaDatosExtra= new ModeloPersona_datos_extras();
	    $personaDatosExtra->setIdPersona($turno->getIdPersona());
	    $personaDatosExtra->getDatosByIdPersona();
	    if ($personaDatosExtra->getIdPersonaDatosExtras()>0)
	        $_SESSION['idPersonaExtras']=$personaDatosExtra->getIdPersonaDatosExtras();
	    
	     $personaDom= new ModeloPersona_domicilio();
	     $personaDom->setIdPersona($_SESSION['idPersonaBio']);
	     $personaDom->getDatosByIdPersona();
	     if ($personaDom->getIdPersonaDomicilio()>0)
	         $_SESSION['idDomicilio']=$personaDom->getIdPersonaDomicilio();
	         
	     $contactoE=new ModeloContacto_emergencia();
	     $contactoE->setIdPersona($_SESSION['idPersonaBio']);
	     $contactoE->getDatosByIdPersona();
	     if ($contactoE->getIdContacto()>0)
	         $_SESSION['idContacto']=$contactoE->getIdContacto();
	         
	
	$datosTab1=array('apellidoM'=>'','apellidoP'=>'','nombre'=>'','sexo'=>'','nacionalidad'=>'','estado'=>'','municipio'=>'','fechaNac'=>'','nombre2'=>'','email'=>'');
	
	$datosTab2=array('estado'=>'','municipio'=>'','localidad'=>'','calle'=>'','numExt'=>'','numInt'=>'','colonia'=>''
	    ,'cp'=>'','telCasa'=>'','telMovil'=>'','codPais'=>'','lada'=>''
	);
	
	$datosTab3=array('ojos'=>'','sangre'=>'','peso'=>'','extras'=>'','estatura'=>'','organo'=>'');
	
	$datosTab4=array('apellidoM'=>'','apellidoP'=>'','nombre'=>'','telCasa'=>'','telMovil'=>'','codPais'=>'','lada'=>'');
	
	
	$slcColonia=$slcEstadosContacto=$slcMunicipiosContacto=$slcLocContacto=$slcLocDom=$slcMunicipiosDom=$slcMunicipios = '<option value="">Seleccione una opcion</option>';
	
	
	if(isset($_SESSION['idPersonaBio'])){
	    $persona=new ModeloPersona();
	    $persona->setIdPersona($_SESSION['idPersonaBio']);
	    $datosTab1['apellidoP']=$persona->getPrimerAp();
	    $datosTab1['apellidoM']=$persona->getSegundoAp();
	    $datosTab1['nombre']=$persona->getNombres();
	    $datosTab1['nombre2']=$persona->getSegundoNombre();
	    $datosTab1['sexo']=$persona->getGenero();
	    $datosTab1['nacionalidad']=$persona->getNacionalidad();
	    $datosTab1['fechaNac']=$persona->getFechaNacimiento();
	    $datosTab1['estado']=$persona->getNacCveEnt();
	    $datosTab1['municipio']=$persona->getNacCveMun();
	    $datosTab1['email']=$persona->getEmail();
	    
      if($datosTab1['fechaNac']=='0000-00-00'){
        $datosTab1['fechaNac'] = '';
      }else{
        $arreglo = explode('-',$datosTab1['fechaNac']);
        $datosTab1['fechaNac'] = $arreglo[2].'/'.$arreglo[1].'/'.$arreglo[0];
      }
	    
	    
	    
	}
	
	if(isset($_SESSION['idDomicilio'])){
	    $personaDom= new ModeloPersona_domicilio();
	    $personaDom->setIdPersonaDomicilio($_SESSION['idDomicilio']);
	    
	    $persona=new ModeloPersona();
	    $persona->setIdPersona($_SESSION['idPersonaBio']);
	    $datosTab2['telCasa']=$persona->getTelCasa();
	    $datosTab2['telMovil']=$persona->getTelMovil();
	    
	    $datosTab2['codPais']=$persona->getCodigoPais();
	    $datosTab2['lada']=$persona->getLadaTel();
	    
	    $inegiDom= new ModeloInegi_domicilio();
	    $inegiDom->setIdDomicilio($personaDom->getIdDomicilio());
	    
	    $datosTab2['estado']=$inegiDom->getCveEnt();
	    $datosTab2['municipio']=$inegiDom->getCveMun();
	    $datosTab2['localidad']=$inegiDom->getCveLoc();
	    $datosTab2['calle']=$inegiDom->getNombreCalle();
	    $datosTab2['numExt']=$inegiDom->getNumeroExterior();
	    $datosTab2['numInt']=$inegiDom->getNumeroInterior();
	    $datosTab2['colonia']=$inegiDom->getColonia();
	    $datosTab2['cp']=$inegiDom->getCodigoPostal();
	    
	    if ($datosTab2['estado']!=''&&$datosTab2['municipio']!=''){
	        $Municipios = new ModeloInegidomgeo_cat_municipio ( );
	        $arrMun = $Municipios->getAll ( $datosTab2['estado'] );
	        if (!$Municipios->getError ())
	            foreach ( $arrMun as $cvMunicipios => $nombre )
	                $slcMunicipiosDom .= '<option value="' . $cvMunicipios . '"  '.($datosTab2['municipio']==$cvMunicipios?' selected ':' ').'>' . $nombre . '</option>';
	                
	                if ($datosTab2['localidad']!=''){
	                    //$localidades = new ModeloPostales();
	                    $localidades = new ModeloInegidomgeo_cat_localidad();
	                    $arrLoc = $localidades->getAll( $datosTab2['estado'], $datosTab2['municipio'] );
	                    if (!$localidades->getError ())
	                        foreach ( $arrLoc as $cvLoc => $nombre ){
	                            $slcLocDom .= '<option value="' . $cvLoc . '"  '.($datosTab2['localidad']==$cvLoc?' selected ':' ').'>' . $nombre . '</option>';
	                    }
	                    $arrColonias = $localidades->getAllAsentamientosByEntidadMunicipio($datosTab2['estado'], $datosTab2['municipio'] );
	                    if (!$localidades->getError ())
	                        foreach ( $arrColonias as $cvColonia => $nombre ){
	                            $slcColonia .= '<option value="' . $cvColonia . '"  '.($datosTab2['colonia']==$cvColonia?' selected ':' ').'>' . $nombre . '</option>';
	                    }
	                }
	    }
	    
	}
	
	if(isset($_SESSION['idPersonaExtras'])){
	    $personaDatosExtra= new ModeloPersona_datos_extras();
	    $personaDatosExtra->setIdPersonaDatosExtras($_SESSION['idPersonaExtras']);
	    $datosTab3['ojos']=$personaDatosExtra->getColorOjos();
	    $datosTab3['sangre']=obtenerTipoSagre($personaDatosExtra->getTipoSangre());
      $datosTab3['donador']=$personaDatosExtra->getImpresionSangre();
//	    echo $datosTab2['sangre'].'<br />';
	    $datosTab3['peso']=$personaDatosExtra->getPeso();
	    $datosTab3['estatura']=$personaDatosExtra->getEstatura();
	    $datosTab3['extras']=$personaDatosExtra->getSenasParticulares();
	    $datosTab3['organos']=$personaDatosExtra->getDonaOrganos();
	    
	}
	
	
	if(isset($_SESSION['idContacto'])){
	    $tabActivo='5';
	    $contactoE=new ModeloContacto_emergencia();
	    $contactoE->setIdContacto($_SESSION['idContacto']);
	    $datosTab4['nombre']=$contactoE->getNombre();
	    $datosTab4['apellidoP']=$contactoE->getApellidoPaterno();
	    $datosTab4['apellidoM']=$contactoE->getApellidoMaterno();
	    $datosTab4['telCasa']=$contactoE->getTelefeno();
	    $datosTab4['codPais']=$contactoE->getCodigoPais();
	    $datosTab4['lada']=$contactoE->getLadaTel();
	    $datosTab4['observaciones']=$contactoE->getObservaciones();
//	    echo $contactoE->getParentesco().'<br />';
	    ///var_dump($datosTab4);
//	    echo $_SESSION['idContacto'].'<br />';
	    
	    
	    
	}
	
	
	//echo $tabActivo.'<br />';
	
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	$xajax=new xajax();
	
	//$xajax->registerFunction ( "guardar");
	
	
	function guardarTab1($paterno, $materno,$nombres,$nombre2,$fecha, $Sexo, $Nacionalidad ,$correo, $txtIdTurno){
	        global $dbLink;
	        
	        $r = new xajaxResponse ();
	        $persona=new ModeloPersona();
	        $persona->transaccionIniciar();
	       if(isset($_SESSION['idPersonaBio'])){ // ver sesi�n guardada
	            $persona->setIdPersona($_SESSION['idPersonaBio']);
	        }
	        $arreglo_fecha = explode('/',$fecha);
          $fecha = $arreglo_fecha[2].'-'.$arreglo_fecha[1].'-'.$arreglo_fecha[0];
	        $persona->setPrimerAp($paterno);
	        $persona->setSegundoAp($materno);
	        $persona->setNombres($nombres);
	        $persona->setFechaNacimiento($fecha);
	        $persona->setCURP($_SESSION['curp']);
//	        $persona->setRFC(substr($rfc,0,10));
	        
	        $persona->setGenero($Sexo);
	        $persona->setSegundoNombre($nombre2);
	        $persona->setEmail($correo);
	        $persona->setNacionalidad($Nacionalidad);
	        
//	        $persona->setHomoclave(substr($rfc,10,3));
	        
	        //$persona->setEstadoCivil(0);
	//        $persona->setNacCveEnt($slcEntidad);
	 //       $persona->setNacCveMun($slcMunicipio);
	        //$persona->setNacCveLoc(0);
	
	        $persona->Guardar();
	        if($persona->getError())
	        {
	            $r->mostrarError($persona->getStrError());
	            return $r;
	        }
	    /*    
	        $turno=new ModeloTurno();
	        $turno->setIdTurno($txtIdTurno);
  	        $turno->setIdPersona($_SESSION['idPersonaBio']);
	        $turno->Guardar();
	        if($turno->getError()){
	            $r->mostrarError($turno->getStrError());
	            return $r;
	        }
	        
	  */      
	        $_SESSION['idPersonaBio']=$persona->getIdPersona();
	        $persona->transaccionCommit();
	        
	       // $r->mostrarAviso("Informaci&oacute;n general guardada del turno ".$txtIdTurno);
	        
//	        $r->redirect("biograficos.php?id=" . $txtIdTurno, 2);
	        
	        return $r;
	        
	}
	$xajax->registerFunction ( "guardarTab1");
	
	function guardarTab3($slcColorOjos ,$slcTipoSandre, $estatura, $txtPesoKG ,$txtSenas, $donador, $txtIdTurno){
	    global $dbLink;
	    
	    $r = new xajaxResponse ();
	    
	    $listados=new ModeloListadoscortos();
	    
	    $personaDatosExtra= new ModeloPersona_datos_extras();
	    if(isset($_SESSION['idPersonaExtras'])){ // ver sesi�n guardada
	        $personaDatosExtra->setIdPersonaDatosExtras($_SESSION['idPersonaExtras']);
	    }
	    
	    $personaDatosExtra->setIdPersona($_SESSION['idPersonaBio']);
	    
	    $listados->setIdListado($slcColorOjos);
	    $personaDatosExtra->setColorOjos($listados->getValor());
	    

	    $personaDatosExtra->setPeso($txtPesoKG);
      $personaDatosExtra->setEstatura($estatura);
	    
	    $personaDatosExtra->setImpresionSangre($donador);
	    
///	    $listados->setIdListado($slcTipoSandre);
	    $personaDatosExtra->setTipoSangre(obtenerTipoSagre($slcTipoSandre));
	    $personaDatosExtra->setSenasParticulares($txtSenas);
	    
	    $personaDatosExtra->Guardar();
	    if($personaDatosExtra->getError())
	    {
	        $r->mostrarError($personaDatosExtra->getStrError());
	        return $r;
	    }      
	    $_SESSION['idPersonaExtras']=$personaDatosExtra->getIdPersonaDatosExtras();
	    
	    //$r->mostrarAviso("Datos Informaci&oacute;n de licencia guardada del turno ".$txtIdTurno);
	    
	    //$r->redirect("biograficos.php?id=" . $txtIdTurno, 3);
	    
	    return $r;
	    
	}
	$xajax->registerFunction ( "guardarTab3");
	
	
	function guardarTab2($slcEstado ,$slcMunicipioDom,$slcLocalidad, $slcColonia, $txtCalle, $txtNumExt, $txtNumInt , $txtCP,
	    $txtCodigoPais, $txtLada, $txtTelefono ,$txtTelefonoMobil,$txtIdTurno){
	    global $dbLink;
	    
	    $r = new xajaxResponse ();
	    
	    $personaDom= new ModeloPersona_domicilio();
	    $personaDom->transaccionIniciar();
	    if(isset($_SESSION['idDomicilio'])){ // ver sesi�n guardada
	        $personaDom->setIdPersonaDomicilio($_SESSION['idDomicilio']);
	    }
	    
	    $persona = new ModeloPersona();
	    
	    $persona->setIdPersona($_SESSION['idPersonaBio']);
	    $persona->setCodigoPais($txtCodigoPais);
	    $persona->setLadaTel($txtLada);
	    $persona->setTelCasa($txtTelefono);
	    $persona->setTelMovil($txtTelefonoMobil);
	    
	    $persona->Guardar();
	    if($persona->getError())
	    {
	        $r->mostrarError($persona->getStrError());
	        return $r;
	    }
	    
	    $personaDom->setIdPersona($persona->getIdPersona());
	    
	    $inegiDom= new ModeloInegi_domicilio();
	    if(isset($_SESSION['idDomicilio'])){ // ver sesi�n guardada
	        $inegiDom->setIdDomicilio($personaDom->getIdDomicilio());
	    }
	    
	///    $r->mostrarError($slcColonia.'    '.$slcLocalidad);
	    //return $r;
	    
	    $inegiDom->setCveEnt($slcEstado);
	    $inegiDom->setCveMun($slcMunicipioDom);
	    $inegiDom->setCveLoc($slcLocalidad);
	    $inegiDom->setColonia($slcColonia);
	    $inegiDom->setNombreCalle($txtCalle);
	    $inegiDom->setNumeroExterior($txtNumExt);
	    $inegiDom->setNumeroInterior($txtNumInt);
//	    $inegiDom->setColonia($txtColonia);
	    $inegiDom->setCodigoPostal($txtCP);
	    
	    $inegiDom->Guardar();
	    if($inegiDom->getError())
	    {
	        $r->mostrarError($inegiDom->getStrError());
	        return $r;
	    }
	    
	    $personaDom->setIdDomicilio($inegiDom->getIdDomicilio());
	    $personaDom->setEstatusVigente();
	    $personaDom->setFechaAsignacion(date('Y-m-d H:i:s'));
	    $personaDom->Guardar();
	    if($personaDom->getError())
	    {
	        $r->mostrarError($personaDom->getStrError());
	        return $r;
	    }
	    
	    $_SESSION['idDomicilio']=$personaDom->getIdPersonaDomicilio();
	    $personaDom->transaccionCommit();
	    
	    //$r->mostrarAviso("Datos de domicilio guardados del turno ".$txtIdTurno);
	    
	    //$r->redirect("biograficos.php?id=" . $txtIdTurno, 2);
	    
	    return $r;
	}
	$xajax->registerFunction ( "guardarTab2");
	
	function guardarTab4($txtNombreContacto, $txtApellidoPaternoContacto, $txtApellidoMaternoContacto, $txtCodPaisCont, $txtLadaCont, $txtTelCont, $txtIdTurno){
	    global $dbLink;
	    
	    $r = new xajaxResponse ();
	    
	    $contactoE= new ModeloContacto_emergencia();
	    if(isset($_SESSION['idContacto'])){ // ver sesi�n guardada
	        $contactoE->setIdContacto($_SESSION['idContacto']);
	    }
	    $contactoE->setIdPersona($_SESSION['idPersonaBio']);
	    $contactoE->setNombre($txtNombreContacto);
	    $contactoE->setApellidoPaterno($txtApellidoPaternoContacto);
	    $contactoE->setApellidoMaterno($txtApellidoMaternoContacto);
	    $contactoE->setCodigoPais($txtCodPaisCont);
	    $contactoE->setLadaTel($txtLadaCont);
	    $contactoE->setTelefeno($txtTelCont);
	    
	    $contactoE->Guardar();
	    if($contactoE->getError())
	    {
	        $r->mostrarError($contactoE->getStrError());
	        return $r;
	    }
	    
	    $_SESSION['idContacto']=$contactoE->getIdContacto();
	    
	    $r->mostrarAviso("Datos biogr&aacute;ficos guardados del turno ".$txtIdTurno);
	    
	    //$r->redirect("biograficos.php?id=" . $txtIdTurno, 4);
	    
	    return $r;
	    
	}
	$xajax->registerFunction ( "guardarTab4");
	
	function guardarTab5($chkEsJubilado,$slcInstitucionjubilacion ,$txtNumJubilado ,$txtFechaAfiliacion,
	    $slcEstadoCivil,$chkLentes,$chkOrganos,$chkTransmisionAUtomatica,$chkVehiculo,$chkProtesis,$txtIdTurno){
	    global $dbLink;
	    
	    $r = new xajaxResponse ();
	    
	    $extra= new ModeloPersona_datos_extras();
	    $extra->transaccionIniciar();
	    $extra->setIdPersonaDatosExtras($_SESSION['idFilacion']);
	    if(isset($_SESSION['idPersonaExtras'])){ // ver sesi�n guardada
	        $extra->setIdPersonaDatosExtras($_SESSION['idPersonaExtras']);
	    }
	    
	    $persona= new ModeloPersona();
	    $persona->setIdPersona($_SESSION['idPersonaBio']);
	    $persona->setEstadoCivil($slcEstadoCivil);
	    
	    $persona->Guardar();
	    if($persona->getError())
	    {
	        $r->mostrarError($persona->getStrError());
	        return $r;
	    }
	    $extra->setJubilacionFechaAfiliacion('');
	    $extra->setJubilacionInstiitucion('');
	    $extra->setJubilacionNumAfiliacion('');
	    
	    if ($chkEsJubilado){
	    $extra->setJubilacionFechaAfiliacion($txtFechaAfiliacion);
	    $extra->setJubilacionInstiitucion($slcInstitucionjubilacion);
	    $extra->setJubilacionNumAfiliacion($txtNumJubilado);
	    }
	    if ($chkLentes){
	        $extra->setUsaLentes();
	    }else{
	        $extra->unsetUsaLentes();
	    }
	    if ($chkOrganos){
	        $extra->setDonaOrganos();
	    }else{
	        $extra->unsetDonaOrganos();
	    }
	    if ($chkTransmisionAUtomatica){
	        $extra->setUsaTransmisionAutomat1ica();
	    }else{
	        $extra->unsetUsaTransmisionAutomat1ica();
	    }
	    if ($chkVehiculo){
	        $extra->setEquipadoConductorDiscapacitado();
	    }else{
	        $extra->unsetEquipadoConductorDiscapacitado();
	    }
	    if ($chkProtesis){
	        $extra->setEquipadoConductorProtesis();
	    }else{
	        $extra->unsetEquipadoConductorProtesis();
	    }
	    
	    $extra->setCompleto();
	    
	    
	    $extra->Guardar();
	    if($extra->getError())
	    {
	        $r->mostrarError($extra->getStrError());
	        return $r;
	    }
	    
	    $extra->transaccionCommit();
	    
	    $_SESSION['idPersonaExtras']=$extra->getIdPersonaDatosExtras();
	    
	    $r->mostrarAviso("Datos extras guardados del turno ".$txtIdTurno);
	    
	    $r->redirect("biograficos.php?id=" . $txtIdTurno, 2);
	    return $r;
	    
	    
	}
	$xajax->registerFunction ( "guardarTab5");
	
	
	function guardarTodo( $txtIdTurno){
	    global $dbLink;
	    
	    $r = new xajaxResponse ();
	    
	    $turno=new ModeloTurno();
	    $turno->setIdTurno($txtIdTurno);
	    
	    $etapa=new ModeloEtapa();
	    $etapa->setIdEtapa($turno->getIdEtapa()+1);
	    $etapa->setOrden($etapa->getOrden()+1);
	    $etapa->getEtapaByOrden();
	    
	    $etapa=new ModeloEtapa();
	    $etapa->setIdEtapa($turno->getIdEtapa());
	    $etapa->setOrden($etapa->getOrden()+1);
	    $etapa->getEtapaByOrden();
	    $turno->setIdPersona($_SESSION['idPersonaBio']);
	    
	    $turno->setFechaHora(date('Y-m-d H:i:s'));
	    $turno->setIdEtapa($etapa->getIdEtapa());
	    $turno->Guardar();
	    if($turno->getError()){
	        $r->mostrarError($turno->getStrError());
	        return $r;
	        
	    }
	    unset($_SESSION['idPersonaBio']);
	    unset($_SESSION['idPersonaExtras']);
	    unset($_SESSION['idDomicilio']);
	    unset($_SESSION['idFilacion']);
	    unset($_SESSION['idContacto']);
	    $r->mostrarAviso("Datos biograficos registrados. " );
	    $r->redirect("documentos.php?id=" . $turno->getIdTurno(), 2);
	    return $r;
	    
	    
	}
	$xajax->registerFunction ( "guardarTodo");

	
	function avanzaSeccion($seccion,$txtTurno) {
	    $r = new xajaxResponse ();
	   // if (intval($seccion)==5){
	        //$_SESSION['etapa']= 'h';
	        
	        $turno=new ModeloTurno();
	        $turno->setIdTurno($txtTurno);
	        
	        $etapa=new ModeloEtapa();
	        $etapa->setIdEtapa($turno->getIdEtapa()+1);
	        $etapa->setOrden($etapa->getOrden()+1);
	        $etapa->getEtapaByOrden();
	        
	        $etapa=new ModeloEtapa();
	        $etapa->setIdEtapa($turno->getIdEtapa());
	        $etapa->setOrden($etapa->getOrden()+1);
	        $etapa->getEtapaByOrden();
	        $turno->setIdPersona($_SESSION['idPersonaBio']);
	        
	        $turno->setFechaHora(date('Y-m-d H:i:s'));
	        $turno->setIdEtapa($etapa->getIdEtapa());
	        $turno->Guardar();
	        if($turno->getError()){
	            $r->mostrarError($turno->getStrError());
	            return $r;
	            
	        }
	        unset($_SESSION['idPersonaBio']);
	        unset($_SESSION['idPersonaExtras']);
	        unset($_SESSION['idDomicilio']);

	        unset($_SESSION['idContacto']);
	        
	        $_SESSION['etapa']='biometricos';
	        
	        $_SESSION['_biograficos']= 1;
	        
	        
	        $r->mostrarAviso("Datos biograficos registrados. " );
	        
	        $r->redirect("biometricos_huella.php",2);
	        
	    //}
      
      /*
      else {
	    $_SESSION['_biograficos']= $seccion;
	    
	    $r->redirect("biograficos.php" ,2);
	    }*/
	    return $r;
	        
	}
	$xajax->registerFunction ( "avanzaSeccion" );
	
	
	function cambioEntidad($cveEstado) {
	    global $dbLink;
	    $r = new xajaxResponse ();
	    $Ciudades = new ModeloInegidomgeo_cat_municipio ( $dbLink );
	    $slcCiudades = '<option value="">Seleccione una opcion</option>';
	    $arrCiudades = $Ciudades->getAll ( $cveEstado );
	    if ($Ciudades->getError ()) {
	        $r->mostrarError ( $Ciudades->getError () );
	        return $r;
	    }
	    
	    foreach ( $arrCiudades as $cvCiudad => $nombre )
	        $slcCiudades .= '<option value="' . $cvCiudad . '">' . $nombre . '</option>';
	
	        $r->assign ( "slcMunicipioDomicilio", "innerHTML", $slcCiudades );
	        $r->ocultarMensaje ();
	        return $r;
	        
	}
	$xajax->registerFunction ( "cambioEntidad" );
	
	
$xajax->registerFunction("cambioMunicipio");

function cambioMunicipio($cveEstado, $cveMunicipio)
{
    global $dbLink;
    $r = new xajaxResponse();
    
//    $Localidades = new ModeloPostales($dbLink );
    $slcLocalidades = '<option value="">Seleccione una opci&oacute;n</option>';
    $localidades = new ModeloInegidomgeo_cat_localidad($dbLink);
    $arrLoc = $localidades->getAll( $cveEstado, $cveMunicipio );
		if ($localidades->getError()) {
			$r->mostrarError ( $Localidades->getStrError () );
			return $r;
		}
		foreach ( $arrLoc as $cvLocalidad => $nombre )
			$slcLocalidades .= '<option value="' . $cvLocalidad . '">' . $nombre . '</option>';
	$r->assign ( "slcLocalidad", "innerHTML", $slcLocalidades );
		$r->ocultarMensaje ();
		return $r;
	}
	
	$xajax->registerFunction("cambioLocalidad");
	
	function cambioLocalidad($cveEstado, $cveMunicipio)
	{
	    global $dbLink;
	    $r = new xajaxResponse();
	    
	    $colonia = new ModeloPostales($dbLink );
	    $slcColonias = '<option value="">Seleccione una opci&oacute;n</option>';
	    $arrColona = $colonia->getAllAsentamientosByEntidadMunicipio( $cveEstado, $cveMunicipio);
	    if ($colonia->getError ()) {
	        $r->mostrarError ( $colonia->getStrError () );
	        return $r;
	    }
	    foreach ( $arrColona as $cvColonia => $nombre )
	        $slcColonias .= '<option value="' . $cvColonia . '">' . $nombre . '</option>';
	        $r->assign ( "slcColonia", "innerHTML", $slcColonias );
	        $r->ocultarMensaje ();
	        return $r;
	}
	
	
	function buscarCPC($cp) {
	    $r = new xajaxResponse ();
	    
	    $Codigo = new ModeloPostales ();
	    $datos = $Codigo->getInfo ( $cp );
	    if ($Codigo->getError ()) {
	        $r->mostrarError ( $Codigo->getStrError () );
	        return $r;
	    }
	    if (count($datos)>0){
	    // print_r($datos);
	    $slcAsentamiento = '<option value="">Seleccione una opci&oacute;n</option>';
	    $asentamientos = $Codigo->getAllAsentamientosByEntidadMunicipioCp ( $datos [c_estado], $datos [c_mnpio], $cp );
	    foreach ( $asentamientos as $cvLocalidad => $nombre )
	        $slcAsentamiento = '<option value="' . $cvLocalidad . '">' . $nombre . '</option>';
	        
//	        $slcAsentamiento .= '<option value="otro">Otro(a)</option>';
	        // print_r($Codigo);
	        // print_r($asentamientos);
	        $r->assign ( "slcColonia", "innerHTML", $slcAsentamiento );
	    }
	        $r->call ( "colocarDatosC", $datos );
	        
	        ///$r->ocultarMensaje ();
	        return $r;
	}
	$xajax->registerFunction ( "buscarCPC" );
	
	
	function buscarIdPostal($idp) {
	    global $dbLink;
	    $r = new xajaxResponse ();
	    
	    $Codigo = new ModeloPostales ();
	    $cp = $Codigo->getCpByIdPostal( $idp );
///	    $r->mostrarAviso($idp);
	        $r->call ( "colocarCP", $cp );
//	        $r->ocultarMensaje ();
	        return $r;
	}
	$xajax->registerFunction ( "buscarIdPostal" );
	
	
	
	
	
	function TildesHtml($cadena)
	{
		$cadena=utf8_encode($cadena);
		return str_replace(array("�","�","�","�","�","�","�","�","�","�","�","�"),
				array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;",
						"&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;"), $cadena);
	}

	function obtenerTipoSagre($id){
	    $arrTipo=array('13'=>'Opos','14'=>'Oneg','9'=>'Apos','10'=>'Aneg','24'=>'ABpos','25'=>'ABneg','nosabe');
	    if (key_exists($id, $arrTipo)){
	        return $arrTipo[$id];
	    }else if (in_array($id, $arrTipo)){
	       foreach ($arrTipo as $idS=>$valor)
	            if ($valor==$id)
	                return $idS;
	    }
	    return '0';
	}
	
	function obtenerParentezco($id){
	    $listados = new ModeloListadoscortos();
	    $arrListado=$listados->getByListado("parentezco");
	    if (key_exists($id, $arrListado)){
	        return $arrListado[$id];
	    }else if (in_array($id, $arrListado)){
    	    foreach($arrListado AS $idListado=>$valorListado)
    	        if ($valorListado==$id)
    	            return $idListado;
	    }
	        
	}
	
	$xajax->processRequest();
	
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	
	//----Color de Ojos---------------//
	$listados=new ModeloListadoscortos();
	$arrListado=$listados->getByListado("ojos");
	$slcListadosOjos='';
	if($listados->getError())
	{
		$arrListado=array('0'=>$listados->getStrError());
	}
	else
	{
		$slcListadosOjos.='<option value="">Selecciona una opci&oacute;n</option>';;
	}
	foreach($arrListado AS $idListado=>$valorListado)
		$slcListadosOjos.='<option '.($datosTab3['ojos']==$valorListado?' selected ':' ').' value="' . $idListado . '">' . strtoupper(TildesHtml($valorListado)) . '</option>';
	
	//----Color de Pelo---------------//
	$listados=new ModeloListadoscortos();
	$arrListado=$listados->getByListado("pelo");
	$slcListadosPelo='';
	if($listados->getError())
	{
		$arrListado=array('0'=>$listados->getStrError());
	}
	else
	{
		$slcListadosPelo.='<option value="">Selecciona una opci&oacute;n</option>';;
	}
	foreach($arrListado AS $idListado=>$valorListado)
		$slcListadosPelo.='<option '.($datosTab3['pelo']==$valorListado?' selected ':' ').' value="' . $idListado . '">' .  utf8_decode(TildesHtml(mb_strtoupper($valorListado))) . '</option>';

// ----Tipo sangre---------------//
$listados = new ModeloListadoscortos();
$arrListado = $listados->getByListado("sangre");
$slcListadosSangre = '';
if ($listados->getError()) {
    $arrListado = array(
        '0' => $listados->getStrError()
    );
} else {
    $slcListadosSangre .= '<option value="">Selecciona una opci&oacute;n</option>';
    ;
}
foreach ($arrListado as $idListado => $valorListado)
    $slcListadosSangre .= '<option '.($datosTab3['sangre']==$idListado?' selected ':' ').' value="' . $idListado . '">' . TildesHtml(strtoupper($valorListado)) . '</option>';

// ----Parentezco---------------//
$listados = new ModeloListadoscortos();
$arrListado=$listados->getByListado("parentezco");
	$slcListadosParentezco='';
	if($listados->getError())
	{
		$arrListado=array('0'=>$listados->getStrError());
	}
	else
	{
		$slcListadosParentezco.='<option value="">Selecciona una opci&oacute;n</option>';;
	}
	foreach($arrListado AS $idListado=>$valorListado)
		$slcListadosParentezco.='<option '.($datosTab4['parentezco']==$valorListado?' selected ':' ').' value="' . $idListado . '">' . TildesHtml(strtoupper($valorListado)) . '</option>';
	
	
	
	
	
					
// estado civil
$edoCivil = new ModeloEstado_civil();
$arrEdoCivil = $edoCivil->getAll();
$slcEdoCivil='<option value="">Selecciona una opci&oacute;n</option>';
if ($edoCivil->getError()){
    $arrEdoCivil=array('0'=>$edoCivil->getStrError());
}
    foreach ($arrEdoCivil as $id => $valor){
        $slcEdoCivil.='<option '.($datosTab5['edocivil']==$id?' selected ':' ').' value="' . $id . '">' . (strtoupper($valor)) . '</option>';
    }

    
if($datosTab2['codPais']==''){ $datosTab2['codPais'] = '52'; }
if($datosTab4['codPais']==''){ $datosTab4['codPais'] = '52'; }
if($datosTab1['email']==''){ $datosTab1['email'] = '@'; }
