<?php
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_estado.inc.php";
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_municipio.inc.php";
	require_once FOLDER_MODEL . "extend/model.inegidomgeo_cat_localidad.inc.php";
	require_once FOLDER_MODEL . "extend/model.listadoscortos.inc.php";
	require_once FOLDER_MODEL . "extend/model.paises.inc.php";
	
	require_once FOLDER_MODEL . "extend/model.persona_documento.inc.php";
	require_once FOLDER_MODEL . "extend/model.persona.inc.php";
	require_once FOLDER_MODEL . "extend/model.persona_datos_extras.inc.php";
        require_once FOLDER_MODEL . "extend/model.persona_domicilio.inc.php";
        require_once FOLDER_MODEL . "extend/model.inegi_domicilio.inc.php";
        require_once FOLDER_MODEL . "extend/model.contacto_emergencia.inc.php";
	
	require_once FOLDER_MODEL . "extend/model.etapa.inc.php";
	require_once FOLDER_MODEL . "extend/model.turno.inc.php";
	
	require_once FOLDER_MODEL . "extend/model.registertmp.inc.php";
	require_once FOLDER_MODEL . "extend/model.login_user.inc.php";
	
	require 'admincuentas.php';
	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	//Cargamos el Id de la paersona
	if(!isset($_GET['id']))
	{
		header("Location: listadoIdentidades.php");
		die();
	}
  
  $objTurno =  new ModeloTurno();
  $objTurno->setIdTurno($_GET['id']);
  
  $persona=new ModeloPersona();
  $persona->setIdPersona($objTurno->getIdPersona());
  if($persona->getError()!=0)
  {
      echo $persona->getStrError();
  }
  
  $personaDatosExtra= new ModeloPersona_datos_extras();
  $personaDatosExtra->setIdPersona($persona->getIdPersona());
  $personaDatosExtra->getDatosByIdPersona();
  if($personaDatosExtra->getError()!=0)
  {
  
      echo $personaDatosExtra->getStrError();
  }
  
  $objPersonaDomicilio = new ModeloPersona_domicilio();
  $objPersonaDomicilio->setIdPersona($persona->getIdPersona());
  $objPersonaDomicilio->getDatosByIdPersona();
  if($objPersonaDomicilio->getError()!=0)
  {
      echo $objPersonaDomicilio->getStrError();   
  }
  
  $objDomicilio = new ModeloInegi_domicilio();
  $objDomicilio->setIdDomicilio($objPersonaDomicilio->getIdDomicilio());
  if($objDomicilio->getError()!=0)
  {
      echo $objDomicilio->getStrError();   
  }
  
  $objContacto = new ModeloContacto_emergencia();
  $objContacto->setIdPersona($persona->getIdPersona());
  $objContacto->getDatosByIdPersona();
  if($objContacto->getError()!=0)
  {
      echo $objContacto->getStrError();
  }
	$txtIdTurno=$_GET['id'];
  
  
	
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	$xajax=new xajax();
	
	$xajax->registerFunction ( "guardar");
	
function guardar($paterno, $materno,$nombres,$fecha, $curp,$rfc,$genero,$slcEntidad ,$slcMunicipio ,
					$txtNacimiento ,$slcColorOjos ,$slcColorPelo ,$slcTipoSandre ,$txtPesoKG ,$slcEstado ,$slcMunicipioDom,$slcLocalidad,$txtCalle ,
					$txtNumExt ,$txtColonia ,$txtCP ,$txtTelefono ,$txtTelefonoMobil,$txtCorreoE ,
					$txtNombreContacto ,$slParentezcoContacto ,$slcEstadoContacto ,$slcLocalidadContacto ,$txtCalleContacto ,
					$txtNumExtContacto ,$txtColoniaContacto ,$txtCPContacto ,$txtTelefonoContacto,$txtIdTurno){
		global $dbLink;
		
		$r = new xajaxResponse ();
		
		$persona=new ModeloPersona();
		$persona->transaccionIniciar();
		$persona->setPrimerAp($paterno);
		$persona->setSegundoAp($materno);
		$persona->setNombres($nombres);
		$persona->setFechaNacimiento($fecha);
		$persona->setCURP($curp);	
		$persona->setRFC(substr($rfc,0,10));
		
		$persona->setGenero($genero);
		$persona->setHomoclave(substr($rfc,10,3));
		
		$persona->setEmail($txtCorreoE);
		$persona->setTelCasa($txtTelefono);
		$persona->setTelMovil($txtTelefonoMobil);
		$persona->setEstadoCivil(0);
		$persona->setNacCveEnt($slcEstado);
		$persona->setNacCveMun($slcMunicipioDom);
		$persona->setNacCveLoc(0);
		
		
		
		$persona->Guardar();		
		if($persona->getError())
		{
			$r->mostrarError($persona->getStrError());
			return $r;
		}
		
		$listados=new ModeloListadoscortos();
		
		$personaDatosExtra= new ModeloPersona_datos_extras();
		$personaDatosExtra->setIdPersona($persona->getIdPersona());
		
		$listados->setIdListado($slcColorOjos);		
		$personaDatosExtra->setColorOjos($listados->getValor());
		
		$listados->setIdListado($slcColorPelo);
		$personaDatosExtra->setColorCabello($listados->getValor());
		
		$personaDatosExtra->setPeso($txtPesoKG);
		$personaDatosExtra->setEstatura(170);
		$personaDatosExtra->setImpresionSangre(true);
		$personaDatosExtra->setTipoSangreOpos();
		$personaDatosExtra->setCertificadoMedico();
		$personaDatosExtra->setSenasParticulares('');
		if($chkEsJubilado){
			$personaDatosExtra->setJubilacionNumAfiliacion($txtNumJubilado);
			$personaDatosExtra->setJubilacionFechaAfiliacion($txtFechaAfiliacion);
			$personaDatosExtra->setJubilacionInstiitucion($slcInstitucionjubilacion);			
		}
		
		//$personaDatosExtra->unsetUsaLentes()
		//$personaDatosExtra->setDonaOrganos();
		//$personaDatosExtra->setUsaTransmisionAutomat1ica();
		//$personaDatosExtra->setEquipadoConductorDiscapacitado();
		//$personaDatosExtra->setEquipadoConductorProtesis()
		
		
		$personaDatosExtra->Guardar();
		if($personaDatosExtra->getError())
		{
			$r->mostrarError($personaDatosExtra->getStrError());
			return $r;
		}
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
		$turno->setIdPersona($persona->getIdPersona());
		
		$turno->setFechaHora(date('Y-m-d H:i:s'));
		$turno->setIdEtapa($etapa->getIdEtapa());
		$turno->Guardar();
		if($turno->getError()){
			$r->mostrarError($turno->getStrError());
			return $r;
		}
		
		$persona->transaccionCommit();
		/**
		$r->mostrarAviso("Datos biograficos registrados. ". $persona->getIdPersona());
		$r->redirect("documentos.php?id=".$persona->getIdPersona());
		
		***/
		$r->mostrarAviso("Datos biograficos registrados. ".$txtIdTurno);
		$r->redirect("documentos.php?id=".$turno->getIdTurno(),2);
		
		return $r;
	}
	
	$xajax->registerFunction ( "cambioMunicipio");
	
	function cambioMunicipio($cveEstado, $cveMunicipio,$campo,$cveLocalidad) {
		global $dbLink;
		$r = new xajaxResponse ();
	
		$Localidades = new ModeloInegidomgeo_cat_localidad ( $dbLink );
		$slcLocalidades = '<option value="">Seleccione una opci&oacute;n</option>';
		$arrLocalidades = $Localidades->getAll ( $cveEstado, $cveMunicipio );
		if ($Localidades->getError ()) {
			$r->mostrarError ( $Localidades->getStrError () );
			return $r;
		}
		foreach ( $arrLocalidades as $cvLocalidad => $nombre )
                {
                    if($cveLocalidad==$cvLocalidad)
                    {
                        $slcLocalidades .= '<option value="' . $cvLocalidad . '" selected="selected">' . TildesHtml($nombre) . '</option>';
                    }
                    else
                    {
                        $slcLocalidades .= '<option value="' . $cvLocalidad . '" >' . TildesHtml($nombre) . '</option>';
                    }
                }
			switch($campo){
				case 'domicilio':
					$r->assign ( "slcLocalidad", "innerHTML", $slcLocalidades );
				case 'contacto':
					$r->assign ( "slcLocalidadContacto", "innerHTML", $slcLocalidades );
			}
		
		
					
		$r->ocultarMensaje ();
		return $r;
	}
	
	
	
	
	function cambioEntidad($cveEstado,$campo,$cveMun) {
		global $dbLink;
		$r = new xajaxResponse ();
		$Ciudades = new ModeloInegidomgeo_cat_municipio ( $dbLink );
		$slcCiudades = '<option value="">Seleccione una opcion</option>';
		$arrCiudades = $Ciudades->getAll ( $cveEstado );
		if ($Ciudades->getError ()) {
			$r->mostrarError ( $Ciudades->getError () );
			return $r;
		}
		//$r->mostrarDenegado($cveMun);
		foreach ( $arrCiudades as $cvCiudad => $nombre )
                {
                    if($cveMun==$cvCiudad)
                    {
                     $slcCiudades .= '<option value="' . $cvCiudad . '" selected="selected">' . TildesHtml($nombre) . '</option>';   
                    }else{
			$slcCiudades .= '<option value="' . $cvCiudad . '">' . TildesHtml($nombre) . '</option>';
                    }
                }
		
		switch($campo){
			
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
	}
	
	$charset='ISO-8859-1'; // o 'UTF-8'
	
	foreach($arrEstados AS $cveEstado=>$nomEstado)
            
                $slcEstados.='<option value="' . $cveEstado . '" >' . TildesHtml($nomEstado) . '</option>';
	
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
        {
                if($personaDatosExtra->getColorOjos()==$valorListado)
                    $slcListadosOjos.='<option selected value="' . $idListado . '">' . strtoupper(TildesHtml($valorListado)) . '</option>';
                else
                    $slcListadosOjos.='<option value="' . $idListado . '">' . strtoupper(TildesHtml($valorListado)) . '</option>';
        }
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
            if($personaDatosExtra->getColorCabello()==$valorListado)
		$slcListadosPelo.='<option selected value="' . $idListado . '">' .  utf8_decode(TildesHtml(mb_strtoupper($valorListado))) . '</option>';
            else
               $slcListadosPelo.='<option value="' . $idListado . '">' .  utf8_decode(TildesHtml(mb_strtoupper($valorListado))) . '</option>';
	
	//----Tipo sangre---------------//
	$listados=new ModeloListadoscortos();
	$arrListado=$listados->getByListado("sangre");
	$slcListadosSangre='';
	if($listados->getError())
	{
		$arrListado=array('0'=>$listados->getStrError());
	}
	else
	{
		$slcListadosSangre.='<option value="">Selecciona una opci&oacute;n</option>';;
	}
        $tipoSangre = '';
        if (substr($personaDatosExtra->getTipoSangre(), -3, 3) == "pos") {
            $tipoSangre = substr($personaDatosExtra->getTipoSangre(),0, strlen($personaDatosExtra->getTipoSangre())-3). '+';
        } else {
            $tipoSangre = '-';
        }
       
foreach($arrListado AS $idListado=>$valorListado)
        
            if($tipoSangre==$valorListado)
		$slcListadosSangre.='<option selected value="' . $idListado . '">' . TildesHtml(strtoupper($valorListado)) . '</option>';
            else
                $slcListadosSangre.='<option value="' . $idListado . '">' . TildesHtml(strtoupper($valorListado)) . '</option>';
	
	//----Parentezco---------------//
	$listados=new ModeloListadoscortos();
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
            if($objContacto->getParentesco()==$valorListado)
		$slcListadosParentezco.='<option selected value="' . $idListado . '">' . TildesHtml(strtoupper($valorListado)) . '</option>';
            else
		$slcListadosParentezco.='<option value="' . $idListado . '">' . TildesHtml(strtoupper($valorListado)) . '</option>';
	
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
	
	
	
	