<?php
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_estado.inc.php";
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_municipio.inc.php";
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_localidad.inc.php";
	require_once FOLDER_MODEL . "extend/model.listadoscortos.inc.php";
	require_once FOLDER_MODEL . "extend/model.paises.inc.php";
	require_once FOLDER_MODEL . "extend/model.inegi_domicilio.inc.php";
	
	
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
//	unset($_SESSION['idPersonaExtras']);
	//Cargamos el Id del turno
	if(!isset($_GET['id']))
	{
		header("Location: listadoEdicionBiograficos.php");
		die();
	}
	$txtIdTurno=$_GET['id'];
	
	// recuperar datos
	$turno = new ModeloTurno();

	$resp=$turno->existsTurnoInEtapa($txtIdTurno, 13);

	if (!$resp[0]){
	    
	    header("Location: listadoEdicionBiograficos.php");
	    die();
	}
	$turno->setIdTurno($txtIdTurno);
	    
	if ($turno->getIdPersona()>0){
	    $_SESSION['idPersonaBio']=$turno->getIdPersona();
	    
	    $personaDatosExtra= new ModeloPersona_datos_extras();
	    $personaDatosExtra->setIdPersona($turno->getIdPersona());
	    $personaDatosExtra->getDatosByIdPersona();
	   if ($personaDatosExtra->getIdPersonaDatosExtras()>0)
            {
                $_SESSION['idFilacion']=$personaDatosExtra->getIdPersonaDatosExtras();
                 $_SESSION['idPersonaExtras']=$personaDatosExtra->getIdPersonaDatosExtras();
                 
            }
	    
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
	         
	        
	}
         if(isset($_SESSION['idPersonaExtras'])&&isset($_SESSION['idContacto'])&&isset($_SESSION['idDomicilio'])&&isset($_SESSION['idFilacion'])&&isset($_SESSION['idPersonaBio'])){
     $tabTodo=true;
 }
	
	$classTab1="alert alert-danger";
	$imagenTab1="fa fa-exclamation-triangle";
	$msjTab1="Datos no capturados";
	
	$classTab2="alert alert-danger";
	$imagenTab2="fa fa-exclamation-triangle";
	$msjTab2="Datos no capturados";
	
	$classTab3="alert alert-danger";
	$imagenTab3="fa fa-exclamation-triangle";
	$msjTab3="Datos no capturados";
	
	$classTab4="alert alert-danger";
	$imagenTab4="fa fa-exclamation-triangle";
	$msjTab4="Datos no capturados";
	
	$classTab5="alert alert-danger";
   	$imagenTab5="fa fa-exclamation-triangle";
	$msjTab5="Datos no capturados";
	
	$tabActivo='1';
	
	$datosTab1=array('apellidoM'=>'','apellidoP'=>'','nombre'=>'','sexo'=>'','nacionalidad'=>'','estado'=>'','municipio'=>'','fechaNac'=>'');
	$datosTab2=array('ojos'=>'','pelo'=>'','sangre'=>'','peso'=>'','extras'=>'');
	$datosTab3=array('estado'=>'','municipio'=>'','localidad'=>'','calle'=>'','numExt'=>'','numInt'=>'','colonia'=>''
	    ,'cp'=>'','telCasa'=>'','telMovil'=>'','email'=>''
	);
	$datosTab4=array('nombre'=>'','parentezco'=>'','estado'=>'','municipio'=>'','localidad'=>'','calle'=>'','numExt'=>'','numInt'=>'','colonia'=>'','cp'=>'','tel'=>'','observaciones'=>'');
	$datosTab5=array('jubilado'=>'','institucion'=>'','numero'=>'','fechaAfiliacion'=>'','edocivil'=>'',
	    'lentes'=>''	    ,'organos'=>'','transmicion'=>'','vehiculo'=>'','protesis'=>''
	);
	
	$slcEstadosContacto=$slcMunicipiosContacto=$slcLocContacto=$slcLocDom=$slcMunicipiosDom=$slcMunicipios = '<option value="">Seleccione una opcion</option>';
	
	
	if(isset($_SESSION['idPersonaBio'])){
	    $tabActivo='2';
	    $persona=new ModeloPersona();
	    $persona->setIdPersona($_SESSION['idPersonaBio']);
	    $datosTab1['apellidoP']=$persona->getPrimerAp();
	    $datosTab1['apellidoM']=$persona->getSegundoAp();
	    $datosTab1['nombre']=$persona->getNombres();
	    $datosTab1['sexo']=$persona->getGenero();
	    $datosTab1['nacionalidad']=$persona->getNacionalidad();
	    $datosTab1['fechaNac']=$persona->getFechaNacimiento();
	    $datosTab1['estado']=$persona->getNacCveEnt();
	    $datosTab1['municipio']=$persona->getNacCveMun();
	    
	    
	    if ($datosTab1['estado']!=''&&$datosTab1['municipio']!=''){
	        $Municipios = new ModeloInegidomgeo_cat_municipio ( );
	    $arrMun = $Municipios->getAll ( $datosTab1['estado'] );
	       if (!$Municipios->getError ())
	           foreach ( $arrMun as $cvMunicipios => $nombre )
	               $slcMunicipios .= '<option value="' . $cvMunicipios . '"  '.($datosTab1['municipio']==$cvMunicipios?' selected ':' ').'>' . TildesHtml($nombre) . '</option>';
	    }
	    
	    $classTab1="alert alert-success";
	    $imagenTab1="fa fa-check-circle";
	    $msjTab1="Datos capturados";
//_	    echo $_SESSION['idPersonaBio'].'<br />'; 
	}
	if(isset($_SESSION['idFilacion'])){
	    $tabActivo='3';
	    $personaDatosExtra= new ModeloPersona_datos_extras();
	    $personaDatosExtra->setIdPersonaDatosExtras($_SESSION['idFilacion']);
	    $datosTab2['ojos']=$personaDatosExtra->getColorOjos();
	    $datosTab2['pelo']=$personaDatosExtra->getColorCabello();
	    $datosTab2['sangre']=obtenerTipoSagre($personaDatosExtra->getTipoSangre());
//	    echo $datosTab2['sangre'].'<br />';
	    $datosTab2['imprime']=$personaDatosExtra->getImpresionSangre();
	    $datosTab2['peso']=$personaDatosExtra->getPeso();
	    $datosTab2['extras']=$personaDatosExtra->getSenasParticulares();
	    
	    
	    $classTab2="alert alert-success";
	    $imagenTab2="fa fa-check-circle";
	    $msjTab2="Datos capturados";
	}
	
	if(isset($_SESSION['idDomicilio'])){
	    $tabActivo='4';
	    $personaDom= new ModeloPersona_domicilio();
	    $personaDom->setIdPersonaDomicilio($_SESSION['idDomicilio']);
	    
	    $persona=new ModeloPersona();
	    $persona->setIdPersona($_SESSION['idPersonaBio']);
	    $datosTab3['telCasa']=$persona->getTelCasa();
	    $datosTab3['telMovil']=$persona->getTelMovil();
	    $datosTab3['email']=$persona->getEmail();
	    
	    $inegiDom= new ModeloInegi_domicilio();
	    $inegiDom->setIdDomicilio($personaDom->getIdDomicilio());

	    $datosTab3['estado']=$inegiDom->getCveEnt();
	    $datosTab3['municipio']=$inegiDom->getCveMun();
	    $datosTab3['localidad']=$inegiDom->getCveLoc();
	    $datosTab3['calle']=$inegiDom->getNombreCalle();
	    $datosTab3['numExt']=$inegiDom->getNumeroExterior();
	    $datosTab3['numInt']=$inegiDom->getNumeroInterior();
	    $datosTab3['colonia']=$inegiDom->getColonia();
	    $datosTab3['cp']=$inegiDom->getCodigoPostal();
	    
	    if ($datosTab3['estado']!=''&&$datosTab3['municipio']!=''){
	        $Municipios = new ModeloInegidomgeo_cat_municipio ( );
	        $arrMun = $Municipios->getAll ( $datosTab3['estado'] );
	        if (!$Municipios->getError ())
	            foreach ( $arrMun as $cvMunicipios => $nombre )
	                $slcMunicipiosDom .= '<option value="' . $cvMunicipios . '"  '.($datosTab3['municipio']==$cvMunicipios?' selected ':' ').'>' . TildesHtml($nombre) . '</option>';
	                
	                if ($datosTab3['localidad']!=''){
	                    $localidades = new ModeloInegidomgeo_cat_localidad();
	                    $arrLoc = $localidades->getAll($datosTab3['estado'],$datosTab3['municipio']);
	                    if (!$localidades->getError ())
	                        foreach ( $arrLoc as $cvLoc => $nombre )
	                            $slcLocDom .= '<option value="' . $cvLoc . '"  '.($datosTab3['localidad']==$cvLoc?' selected ':' ').'>' . TildesHtml($nombre) . '</option>';
	                            
	                }
	    }
	    
	    $classTab3="alert alert-success";
	    $imagenTab3="fa fa-check-circle";
	    $msjTab3="Datos capturados";
	    
	}
	
	if(isset($_SESSION['idContacto'])){
	    $tabActivo='5';
	    $contactoE=new ModeloContacto_emergencia();
	    $contactoE->setIdContacto($_SESSION['idContacto']);
	    $datosTab4['nombre']=$contactoE->getNombre();
	    $datosTab4['parentezco']=$contactoE->getParentesco();
	    $datosTab4['estado']=$contactoE->getCveEnt();
	    $datosTab4['municipio']=$contactoE->getCveMun();
	    $datosTab4['localidad']=$contactoE->getCveLoc();
	    $datosTab4['calle']=$contactoE->getCalle();
	    $datosTab4['numExt']=$contactoE->getNumeroExterrior();
	    $datosTab4['numInt']=$contactoE->getNumeroInterior();
	    $datosTab4['colonia']=$contactoE->getColonia();
	    $datosTab4['cp']=$contactoE->getCodigoPostal();
	    $datosTab4['tel']=$contactoE->getTelefeno();
	    $datosTab4['observaciones']=$contactoE->getObservaciones();
//	    echo $contactoE->getParentesco().'<br />';
	    ///var_dump($datosTab4);
//	    echo $_SESSION['idContacto'].'<br />';
	    
	    if ($datosTab4['estado']!=''&&$datosTab4['municipio']!=''){
	        $Municipios = new ModeloInegidomgeo_cat_municipio ( );
	        $arrMun = $Municipios->getAll ( $datosTab4['estado'] );
	        if (!$Municipios->getError ())
	            foreach ( $arrMun as $cvMunicipios => $nombre )
	                $slcMunicipiosContacto .= '<option value="' . $cvMunicipios . '"  '.($datosTab4['municipio']==$cvMunicipios?' selected ':' ').'>' . TildesHtml($nombre) . '</option>';
	                
	                if ($datosTab4['localidad']!=''){
	                    $localidades = new ModeloInegidomgeo_cat_localidad();
	                    $arrLoc = $localidades->getAll($datosTab4['estado'],$datosTab4['municipio']);
	                    if (!$localidades->getError ())
	                        foreach ( $arrLoc as $cvLoc => $nombre )
	                            $slcLocContacto .= '<option value="' . $cvLoc . '"  '.($datosTab4['localidad']==$cvLoc?' selected ':' ').'>' . TildesHtml($nombre) . '</option>';
	                            
	                }
	    }
	    
	    
	    $classTab4="alert alert-success";
	    $imagenTab4="fa fa-check-circle";
	    $msjTab4="Datos capturados";
	    
	    
	}
	if(isset($_SESSION['idPersonaExtras'])){
	    $personaDatosExtra= new ModeloPersona_datos_extras();
	    $personaDatosExtra->setIdPersonaDatosExtras($_SESSION['idPersonaExtras']);
	    //$datosTab5['jubilado']=$personaDatosExtra->get();
	    $datosTab5['institucion']=$personaDatosExtra->getJubilacionInstiitucion();
	    $datosTab5['numero']=$personaDatosExtra->getJubilacionNumAfiliacion();
	    $datosTab5['fechaAfiliacion']=$personaDatosExtra->getJubilacionFechaAfiliacion();
	    if ($datosTab5['institucion']!=''){
	        $datosTab5['jubilado']=1;
	    }
	    $datosTab5['lentes']=$personaDatosExtra->getUsaLentes();
	    $datosTab5['organos']=$personaDatosExtra->getDonaOrganos();
	    $datosTab5['transmicion']=$personaDatosExtra->getUsaTransmisionAutomat1ica();
	    $datosTab5['vehiculo']=$personaDatosExtra->getEquipadoConductorDiscapacitado();
	    $datosTab5['protesis']=$personaDatosExtra->getEquipadoConductorProtesis();
	    $persona= new ModeloPersona();
	    $persona->setIdPersona($_SESSION['idPersonaBio']);
	    $datosTab5['edocivil']=$persona->getEstadoCivil();
//	var_dump($datosTab5);    
	    
	$classTab5="alert alert-success";
	$imagenTab5="fa fa-check-circle";
	$msjTab5="Datos capturados";
	}
	
	if(isset($_SESSION['idPersonaExtras'])&&isset($_SESSION['idContacto'])&&isset($_SESSION['idDomicilio'])&&isset($_SESSION['idFilacion'])&&isset($_SESSION['idPersonaBio'])){
	    $tabTodo=true;
	}
	//echo $tabActivo.'<br />';
	
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	$xajax=new xajax();
	
	//$xajax->registerFunction ( "guardar");
	
	
	function guardarTab1($paterno, $materno,$nombres,$fecha, $curp,$rfc,$genero,$Nacionalidad ,$slcEntidad ,$slcMunicipio,$txtIdTurno){
	        global $dbLink;
	        
	        $r = new xajaxResponse ();
	        $persona=new ModeloPersona();
	        $persona->transaccionIniciar();
	       if(isset($_SESSION['idPersonaBio'])){ // ver sesi�n guardada
	            $persona->setIdPersona($_SESSION['idPersonaBio']);
	        }
	        
	        $persona->setPrimerAp($paterno);
	        $persona->setSegundoAp($materno);
	        $persona->setNombres($nombres);
	        $persona->setFechaNacimiento($fecha);
	        $persona->setCURP($curp);
	        $persona->setRFC(substr($rfc,0,10));
	        
	        $persona->setGenero($genero);
	        $persona->setHomoclave(substr($rfc,10,3));
	        
	        //$persona->setEstadoCivil(0);
	        $persona->setNacCveEnt($slcEntidad);
	        $persona->setNacCveMun($slcMunicipio);
	        //$persona->setNacCveLoc(0);
	
	        $persona->Guardar();
	        if($persona->getError())
	        {
	            $r->mostrarError($persona->getStrError());
	            return $r;
	        }
	        
	        $turno=new ModeloTurno();
	        $turno->setIdTurno($txtIdTurno);
	        $turno->setIdPersona($_SESSION['idPersonaBio']);
	        $turno->Guardar();
	        if($turno->getError()){
	            $r->mostrarError($turno->getStrError());
	            return $r;
	        }
	        
	        
	        $_SESSION['idPersonaBio']=$persona->getIdPersona();
	        $persona->transaccionCommit();
	        
	        $r->mostrarAviso("Informaci&oacute;n general guardada del turno ".$txtIdTurno);
	        
	        $r->redirect("biograficosEdicion.php?id=" . $txtIdTurno, 2);
	        
	        return $r;
	        
	}
	$xajax->registerFunction ( "guardarTab1");
	
	function guardarTab2($slcColorOjos ,$slcColorPelo ,$slcTipoSandre ,$txtPesoKG ,$txtSenas, $txtIdTurno){
	    global $dbLink;
	    
	    $r = new xajaxResponse ();
	    
	    $listados=new ModeloListadoscortos();
	    
	    $personaDatosExtra= new ModeloPersona_datos_extras();
	    if(isset($_SESSION['idFilacion'])){ // ver sesi�n guardada
	        $personaDatosExtra->setIdPersonaDatosExtras($_SESSION['idFilacion']);
	    }
	    
	    $personaDatosExtra->setIdPersona($_SESSION['idPersonaBio']);
	    
	    $listados->setIdListado($slcColorOjos);
	    $personaDatosExtra->setColorOjos($listados->getValor());
	    
	    $listados->setIdListado($slcColorPelo);
	    $personaDatosExtra->setColorCabello($listados->getValor());
	    
	    $personaDatosExtra->setPeso($txtPesoKG);
	    
	    $personaDatosExtra->setImpresionSangre(true);
	    
///	    $listados->setIdListado($slcTipoSandre);
	    $personaDatosExtra->setTipoSangre(obtenerTipoSagre($slcTipoSandre));
	    $personaDatosExtra->setSenasParticulares($txtSenas);
	    
	    $personaDatosExtra->Guardar();
	    if($personaDatosExtra->getError())
	    {
	        $r->mostrarError($personaDatosExtra->getStrError());
	        return $r;
	    }
	    $_SESSION['idFilacion']=$personaDatosExtra->getIdPersonaDatosExtras();
	    
	    $r->mostrarAviso("Datos media filaci&oacute;n guardada del turno ".$txtIdTurno);
	    
	    $r->redirect("biograficosEdicion.php?id=" . $txtIdTurno, 2);
	    
	    return $r;
	    
	}
	$xajax->registerFunction ( "guardarTab2");
	
	
	function guardarTab3($slcEstado ,$slcMunicipioDom,$slcLocalidad,$txtCalle, $txtNumExt, $txtNumInt ,$txtColonia ,$txtCP,
	                       $txtTelefono ,$txtTelefonoMobil,$txtCorreoE ,$txtIdTurno){
	    global $dbLink;
	    
	    $r = new xajaxResponse ();
	    
	    $personaDom= new ModeloPersona_domicilio();
	    $personaDom->transaccionIniciar();
	    if(isset($_SESSION['idDomicilio'])){ // ver sesi�n guardada
	        $personaDom->setIdPersonaDomicilio($_SESSION['idDomicilio']);
	    }
	    
	    $persona = new ModeloPersona();
	    $persona->setIdPersona($_SESSION['idPersonaBio']);
	    $persona->setTelCasa($txtTelefono);
	    $persona->setTelMovil($txtTelefonoMobil);
	    $persona->setEmail($txtCorreoE);
	    
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
	    $inegiDom->setCveEnt($slcEstado);
	    $inegiDom->setCveMun($slcMunicipioDom);
	    $inegiDom->setCveLoc($slcLocalidad);
	    $inegiDom->setNombreCalle($txtCalle);
	    $inegiDom->setNumeroExterior($txtNumExt);
	    $inegiDom->setNumeroInterior($txtNumInt);
	    $inegiDom->setColonia($txtColonia);
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
	    
	    $r->mostrarAviso("Datos de domicilio guardados del turno ".$txtIdTurno);
	    
	    $r->redirect("biograficosEdicion.php?id=" . $txtIdTurno, 2);
	    
	    return $r;
	}
	$xajax->registerFunction ( "guardarTab3");
	
	function guardarTab4($txtNombreContacto ,$slParentezcoContacto ,$slcEstadoContacto, $slcMunicipio ,$slcLocalidadContacto ,$txtCalleContacto ,
	    $txtNumExtContacto, $txtNumIntContacto ,$txtColoniaContacto ,$txtCPContacto ,$txtTelefonoContacto,$txtObservaciones,$txtIdTurno){
	    global $dbLink;
	    
	    $r = new xajaxResponse ();
	    
	    $contactoE= new ModeloContacto_emergencia();
	    if(isset($_SESSION['idContacto'])){ // ver sesi�n guardada
	        $contactoE->setIdContacto($_SESSION['idContacto']);
	    }
	    $contactoE->setIdPersona($_SESSION['idPersonaBio']);
	    $contactoE->setNombre($txtNombreContacto);
	    $contactoE->setParentesco(obtenerParentezco($slParentezcoContacto));
	    $contactoE->setCveEnt($slcEstadoContacto);
	    $contactoE->setCveMun($slcMunicipio);
	    $contactoE->setCveLoc($slcLocalidadContacto);
	    $contactoE->setCalle($txtCalleContacto);
	    $contactoE->setNumeroExterrior($txtNumExtContacto);
	    $contactoE->setNumeroInterior($txtNumIntContacto);
	    $contactoE->setColonia($txtColoniaContacto);
	    $contactoE->setCodigoPostal($txtCPContacto);
	    $contactoE->setTelefeno($txtTelefonoContacto);
	    $contactoE->setObservaciones($txtObservaciones);
	    
	    $contactoE->Guardar();
	    if($contactoE->getError())
	    {
	        $r->mostrarError($contactoE->getStrError());
	        return $r;
	    }
	    
	    $_SESSION['idContacto']=$contactoE->getIdContacto();
	    
	    $r->mostrarAviso("Datos de contacto de emergencia guardados del turno ".$txtIdTurno);
	    
	    $r->redirect("biograficosEdicion.php?id=" . $txtIdTurno, 2);
	    
	    return $r;
	    
	}
	$xajax->registerFunction ( "guardarTab4");
	
	function guardarTab5( $slcEstadoCivil,$chkLentes,$chkOrganos,$chkTransmisionAUtomatica,$chkVehiculo,$chkProtesis,$txtIdTurno){
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
	    
	    $extra->Guardar();
	    if($extra->getError())
	    {
	        $r->mostrarError($extra->getStrError());
	        return $r;
	    }
	    
	    $extra->transaccionCommit();
	    
	    $_SESSION['idPersonaExtras']=$extra->getIdPersonaDatosExtras();
	    
	    $r->mostrarAviso("Datos extras guardados del turno ".$txtIdTurno);
	    
	    $r->redirect("biograficosEdicion.php?id=" . $txtIdTurno, 2);
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
	    $turno->setIdEtapa(11);
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
	    $r->mostrarAviso("Datos biograficos actualizados, regrese al módulo de impresión. " );
	    $r->redirect("listadoEdicionBiograficos.php" , 2);
	    return $r;
	    
	    
	}
	$xajax->registerFunction ( "guardarTodo");

$xajax->registerFunction("cambioMunicipio");

function cambioMunicipio($cveEstado, $cveMunicipio, $campo)
{
    global $dbLink;
    $r = new xajaxResponse();
    
    $Localidades = new ModeloInegidomgeo_cat_localidad($dbLink );
		$slcLocalidades = '<option value="">Seleccione una opci&oacute;n</option>';
		$arrLocalidades = $Localidades->getAll ( $cveEstado, $cveMunicipio );
		if ($Localidades->getError ()) {
			$r->mostrarError ( $Localidades->getStrError () );
			return $r;
		}
		foreach ( $arrLocalidades as $cvLocalidad => $nombre )
			$slcLocalidades .= '<option value="' . $cvLocalidad . '">' . TildesHtml($nombre) . '</option>';
			switch($campo){
				case 'domicilio':
					$r->assign ( "slcLocalidad", "innerHTML", $slcLocalidades );
				case 'contacto':
					$r->assign ( "slcLocalidadContacto", "innerHTML", $slcLocalidades );
			}
		
		
					
		$r->ocultarMensaje ();
		return $r;
	}
	
	
	
	
	function cambioEntidad($cveEstado,$campo) {
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
			$slcCiudades .= '<option value="' . $cvCiudad . '">' . TildesHtml($nombre) . '</option>';
		
		switch($campo){
			case 'nacimiento': 
				$r->assign ( "slcMunicipioNac", "innerHTML", $slcCiudades );
				break;
			case 'domicilio':
				$r->assign ( "slcMunicipioDomicilio", "innerHTML", $slcCiudades );
				break;
			case 'contacto':
				$r->assign ( "slcMunicipioContacto", "innerHTML", $slcCiudades );
		}
			$r->ocultarMensaje ();
			return $r;
					
	}
	$xajax->registerFunction ( "cambioEntidad" );
	
	
	
	
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
	
	$Estados=new ModeloInegidomgeo_cat_estado();
	$arrEstados=$Estados->getAll();
	
	$slcEstados='';
	if($Estados->getError())
	{
		$arrEstados=array('0'=>$Estados->getStrError());
	}
	else
	{
		$slcEstados.='<option value="">Selecciona una opci&oacute;n</option>';;
		$slcEstadosDom.='<option value="">Selecciona una opci&oacute;n</option>';;
	}
	
	$charset='ISO-8859-1'; // o 'UTF-8'
	
	foreach($arrEstados AS $cveEstado=>$nomEstado){
		$slcEstados.='<option '.($datosTab1['estado']==$cveEstado?' selected ':' ').'value="' . $cveEstado . '">' . TildesHtml($nomEstado) . '</option>';
		$slcEstadosDom.='<option '.($datosTab3['estado']==$cveEstado?' selected ':' ').'value="' . $cveEstado . '">' . TildesHtml($nomEstado) . '</option>';
		$slcEstadosContacto.='<option '.($datosTab4['estado']==$cveEstado?' selected ':' ').'value="' . $cveEstado . '">' . TildesHtml($nomEstado) . '</option>';
	}
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
		$slcListadosOjos.='<option '.($datosTab2['ojos']==$valorListado?' selected ':' ').' value="' . $idListado . '">' . strtoupper(TildesHtml($valorListado)) . '</option>';
	
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
		$slcListadosPelo.='<option '.($datosTab2['pelo']==$valorListado?' selected ':' ').' value="' . $idListado . '">' .  utf8_decode(TildesHtml(mb_strtoupper($valorListado))) . '</option>';

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
    $slcListadosSangre .= '<option '.($datosTab2['sangre']==$idListado?' selected ':' ').' value="' . $idListado . '">' . TildesHtml(strtoupper($valorListado)) . '</option>';

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
		$slcPaises.='<option value="">Selecciona una opci&oacute;n</option>';;
	}
	 
	foreach($arrPaises AS $cvePaises=>$nomPaises)
		if($cvePaises==140)
			$slcPaises.='<option selected value="' . $cvePaises. '">' . $nomPaises. '</option>';
			else
				$slcPaises.='<option value="' . $cvePaises. '">' . $nomPaises. '</option>';
	
	
					
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

    
