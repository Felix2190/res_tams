<?php

	require FOLDER_INCLUDE . "lib/pdf/fpdf.php";
	require_once FOLDER_MODEL_EXTEND . "model.licencia.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.tipolicencia.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.ubicacion.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.persona.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.persona_documento.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.inegi_domicilio.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.persona_domicilio.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.inegidomgeo_cat_estado.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.inegidomgeo_cat_municipio.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.inegidomgeo_cat_localidad.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.persona_datos_extras.inc.php";
	require_once FOLDER_MODEL_EXTEND . "model.contacto_emergencia.inc.php";

	
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
Function pdfErrorMensaje($texto){
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->SetTitle("Constancia.pdf");
	$pdf->Cell(40,10,utf8_decode($texto));
	$pdf->Output();
}


	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#


	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#




	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

if(isset($_GET['idL'])){
	$licencia = new ModeloLicencia();
	$tipoLicencia = new ModeloTipolicencia();
	$licencia->setIdLicencias($_GET['idL']);
	$ubicacion = new ModeloUbicacion();
	$ubicacion->setIdUbicacion($licencia->getIdUbicacion());
	$persona = new ModeloPersona();
	$persona->setIdPersona($licencia->getIdPersona());
	
	$foto = new ModeloPersona_documento();		
	$idFoto = $foto->findFotoByIdPersona($licencia->getIdPersona());
	
	$foto->setIdpersona_documento($idFoto);
	$firma = new ModeloPersona_documento();
	$idFirma = $firma->findFirmaByIdPersona($licencia->getIdPersona());
	$firma->setIdpersona_documento($idFirma);

	$persona_domicilio = new ModeloPersona_domicilio();
	$iddomicilio = $persona_domicilio->findDomicilioByIdPersona($licencia->getIdPersona());
	$domicilio = new ModeloInegi_domicilio();
	$domicilio->setIdDomicilio($iddomicilio);
	
	$estado = new ModeloInegidomgeo_cat_estado();
	$estado->setCVE_ENT($domicilio->getCveEnt());
	
	$municipio = new ModeloInegidomgeo_cat_municipio();
	$municipio->setCVE_ENT($domicilio->getCveEnt());
	$municipio->setCVE_MUN($domicilio->getCveMun());
	
	$localidad = new ModeloInegidomgeo_cat_localidad();
	$localidad->setCVE_ENT($domicilio->getCveEnt());
	$localidad->setCVE_MUN($domicilio->getCveMun());
	$localidad->setCVE_LOC($domicilio->getCveLoc());
	
	//******************************************************
	$estadoN = new ModeloInegidomgeo_cat_estado();
	$estadoN->setCVE_ENT($persona->getNacCveEnt());
	
	$municipioN = new ModeloInegidomgeo_cat_municipio();
	$municipioN->setCVE_ENT($persona->getNacCveEnt());
	$municipioN->setCVE_MUN($persona->getNacCveMun());
	
	$localidadN = new ModeloInegidomgeo_cat_localidad();
	$localidadN->setCVE_ENT($persona->getNacCveEnt());
	$localidadN->setCVE_MUN($persona->getNacCveMun());
	$localidadN->setCVE_LOC($persona->getNacCveLoc());
	
	$media_afi = new ModeloPersona_datos_extras();
	$idmedia_afi = $media_afi->findIdByIdPersona($licencia->getIdPersona());
	$media_afi->setIdPersonaDatosExtras($idmedia_afi);
	
	$contacto = new ModeloContacto_emergencia();
	$idcontacto = $contacto->findIdByIdPersona($licencia->getIdPersona());
	$contacto->setIdContacto($idcontacto);
	
	//******************************************************
	$estadoC = new ModeloInegidomgeo_cat_estado();
	$estadoC->setCVE_ENT($contacto->getCveEnt());
	
	$municipioC = new ModeloInegidomgeo_cat_municipio();
	$municipioC->setCVE_ENT($contacto->getCveEnt());
	$municipioC->setCVE_MUN($contacto->getCveMun());
	
	$localidadC = new ModeloInegidomgeo_cat_localidad();
	$localidadC->setCVE_ENT($contacto->getCveEnt());
	$localidadC->setCVE_MUN($contacto->getCveMun());
	$localidadC->setCVE_LOC($contacto->getCveLoc());
	if($licencia->getIdLicencias()==0)
	{
		pdfErrorMensaje('No se encontro informacion. [0x1]');
	}
	else{			
		$tipoLicencia->setIdTipoLicencia($licencia->getIdTipoLicencia());

		class PDF extends FPDF{
			var $angulo=0;
			var $idHistoriaClinica=0;
			var $idLoginMemberImpresion=0;
		//Pie de Pagina
			function Footer()
			{
				$this->SetY(-15);
				$this->SetFont('Arial','I',8);
				//$this->Cell(0,10,'Control: ' . $this->idHistoriaClinica . ';' . $this->idLoginMemberImpresion . ' Fecha ' . utf8_decode("impresiÃ³n") . ': ' .date("Y-m-d H:i:s"),0,0,'C');
			}

			function PaginaUno(){						
			$this->Ln(10);
			$this->SetFont('Arial','B',18);
			$this->SetFillColor(2,118,191);
			//TItulo
			//$this->Image('images/theme/logoPsicologia.jpg',180,22.5,20,20);//
			$this->Cell(190,25,utf8_decode('GOBIERNO DEL ESTADO DE TAMAULIPAS '),0,0,'C',0);
			$this->SetFont('Arial','',14);
			$this->Ln(6);
			$this->Cell(190,25,utf8_decode('SECRETARIA DE PLANEACION Y FINANZAS '),0,0,'C',0);
			$this->Ln(6);
			$this->Cell(190,25,utf8_decode('SISTEMA DE EMISION DE LICENCIAS '),0,0,'C',0);
			$this->Ln(6);
			$this->Cell(190,25,utf8_decode('CONSTANCIA DE IDENTIFICACION '),0,0,'C',0);
			$this->Ln(18);
			//Salto de Linea
			$this->SetFont('Arial','',8);
			$this->Ln(6);
		}		
		 //Cell with horizontal scaling if text is too wide
		function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
		{
        //Get string width
			$str_width=$this->GetStringWidth($txt);
			if($str_width==0)
				$str_width=1;
        //Calculate ratio to fit cell
			if($w==0)
				$w = $this->w-$this->rMargin-$this->x;
			$ratio = ($w-$this->cMargin*2)/$str_width;

			$fit = ($ratio < 1 || ($ratio > 1 && $force));
			if ($fit)
			{
				if ($scale)
				{
                //Calculate horizontal scaling
					$horiz_scale=$ratio*100.0;
                //Set horizontal scaling
					$this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
				}
				else
				{
                //Calculate character spacing in points
					$char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                //Set character spacing
					$this->_out(sprintf('BT %.2F Tc ET',$char_space));
				}
            //Override user alignment (since text will fill up cell)
				$align='';
			}

        //Pass on to Cell method
			$this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

        //Reset character spacing/horizontal scaling
			if ($fit)
				$this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
		}

    //Cell with horizontal scaling only if necessary
		function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
		{
			$txt=strtoupper($txt);
			$this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,false);
		}
}// fin class pdf

$pdf = new PDF();


$pdf->AliasNbPages();
//$pdf->AddPage();
$pdf->AddPage(P,Letter);
$pdf->SetTitle("Constancia.pdf");
$pdf->SetFont('Arial','B','8');
$pdf->PaginaUno();
/************************* FICHA DE IDENTIFICACION *************************************/
$pdf->SetX(10);

/*******************************D A T O S - DE - LA - L I C E N C I A***************************************** L N ******/

$pdf->SetFont('Arial','B','10');
$pdf->Cell(140,8,strtoupper(utf8_decode('Datos de la licencia')),0,0,'L',0);
if($foto->getDocumentoimagen()==""){
	//$pdf->Image($foto->getDocumentoimagen() ,10,10,-300);
}else{
	$pdf->Image($foto->getDocumentoimagen() ,$pdf->GetX()+3,$pdf->GetY()+7,15);
}
if($firma->getDocumentoimagen()==""){
	//$pdf->Image($foto->getDocumentoimagen() ,10,10,-300);
}else{
	$pdf->Image($firma->getDocumentoimagen() ,$pdf->GetX()+3+18,$pdf->GetY()+7,15);
}
$pdf->Cell(35,8,strtoupper(utf8_decode('Fotografia y firma')),0,0,'L',0);

$pdf->Ln(6);
$pdf->Rect($pdf->GetX(), $pdf->GetY(), 140, 22);

$pdf->Cell(40,8,strtoupper(utf8_decode('No. licencia:')),0,0,'L',0);
$pdf->Cell(40,8,strtoupper(utf8_decode('Tipo de licencia:')),0,0,'L',0);
$pdf->Cell(40,8,strtoupper(utf8_decode('Tipo de movimiento:')),0,0,'L',0);
$pdf->Ln(4);
$pdf->SetFont('Arial','','10');
$pdf->Cell(40,8,utf8_decode($licencia->getNumero()),0,0,'L',0);
$pdf->Cell(40,8,utf8_decode($tipoLicencia->getDescripcion()),0,0,'L',0);
$pdf->Cell(40,8,utf8_decode($tipoLicencia->getTipoTramite()),0,0,'L',0);

$pdf->Ln();


$pdf->SetFont('Arial','B','10');
$pdf->Cell(40,8,strtoupper(utf8_decode('Fecha expedicion:')),0,0,'L',0);
$pdf->Cell(40,8,strtoupper(utf8_decode('Fecha vencimiento:')),0,0,'L',0);
$pdf->Cell(40,8,strtoupper(utf8_decode('Expedida en:')),0,0,'L',0);
$pdf->Ln(4);
$pdf->SetFont('Arial','','10');
if($licencia->getFechaExpedicion()==null)
	$pdf->Cell(40,8,'',0,0,'L',0);
else 
	$pdf->Cell(40,8,date_format(date_create($licencia->getFechaExpedicion()),'Y-m-d'),0,0,'L',0);
if($licencia->getFechaExpiracion()==null)
	$pdf->Cell(40,8,date_format(date_create($licencia->getFechaExpiracion()),'Y-m-d'),0,0,'L',0);
else 
	$pdf->Cell(40,8,date_format(date_create($licencia->getFechaExpiracion()),'Y-m-d'),0,0,'L',0);
$pdf->Cell(40,8,utf8_decode($ubicacion->getNombre()),0,0,'L',0);
$pdf->Ln();

/*******************************D A T O S - G E N E R A L E S ***************************************** L N ******/
$pdf->SetFont('Arial','B','10');
$pdf->Cell(190,8,strtoupper(utf8_decode('Datos GENERALES')),0,1,'L',0);
$pdf->Rect($pdf->GetX(), $pdf->GetY(), 190, 44);
$pdf->Cell(80,8,(utf8_decode('Nombre:')),0,0,'L',0);
$pdf->Cell(30,8,(utf8_decode('RFC:')),0,0,'L',0);
$pdf->Cell(45,8,(utf8_decode('CURP:')),0,0,'L',0);
$pdf->Cell(40,8,(utf8_decode('Fecha Nacimiento:')),0,0,'L',0);
$pdf->Ln(4);
$pdf->SetFont('Arial','','10');
$pdf->Cell(80,8,utf8_decode($persona->getNombreCompleto()),0,0,'L',0);
$pdf->Cell(30,8,utf8_decode($persona->getRFC()),0,0,'L',0);
$pdf->Cell(45,8,utf8_decode($persona->getCURP()),0,0,'L',0);
if($persona->getFechaNacimiento()==null)
	$pdf->Cell(40,8,"",0,0,'L',0);
else 
	$pdf->Cell(40,8,date_format(date_create($persona->getFechaNacimiento()),'Y-m-d'),0,0,'L',0);
$pdf->Ln();
//domicilio
$pdf->SetFont('Arial','B','10');
$pdf->Cell(160,8,(utf8_decode('Domicilio:')),0,0,'L',0);
$pdf->Cell(30,8,(utf8_decode('Telefono:')),0,0,'L',0);

$pdf->Ln(4);
$pdf->SetFont('Arial','','10');
$pdf->Cell(160,8,utf8_decode($domicilio->getNombreCalle()."".$domicilio->getNumeroExterior()." ". $domicilio->getColonia()),0,0,'L',0);
$pdf->Cell(30,8,utf8_decode($persona->getTelCasa()),0,0,'L',0);
$pdf->Ln(4);
$pdf->SetFont('Arial','B','10');
$pdf->Cell(60,8,(utf8_decode('Delegacion:')),0,0,'L',0);
$pdf->Cell(60,8,(utf8_decode('Municipio:')),0,0,'L',0);
$pdf->Cell(40,8,(utf8_decode('Estado:')),0,0,'L',0);

$pdf->Ln(4);
$pdf->SetFont('Arial','','10');
$pdf->Cell(60,8,utf8_decode($localidad->getNOM_LOC()),0,0,'L',0);
$pdf->Cell(60,8,utf8_decode($municipio->getNOM_MUN()),0,0,'L',0);
$pdf->Cell(40,8,utf8_decode($estado->getNOM_ENT()),0,0,'L',0);

$pdf->Ln(6);
$pdf->SetFont('Arial','B','10');
$pdf->Cell(50,8,(utf8_decode('Poblacion origen')),0,0,'L',0);
$pdf->Ln(4);
$pdf->Cell(60,8,(utf8_decode('Delegacion:')),0,0,'L',0);
$pdf->Cell(60,8,(utf8_decode('Municipio:')),0,0,'L',0);
$pdf->Cell(40,8,(utf8_decode('Estado:')),0,0,'L',0);

$pdf->Ln(4);
$pdf->SetFont('Arial','','10');
$pdf->Cell(60,8,utf8_decode($localidadN->getNOM_LOC()),0,0,'L',0);
$pdf->Cell(60,8,utf8_decode($municipioN->getNOM_MUN()),0,0,'L',0);
$pdf->Cell(40,8,utf8_decode($estadoN->getNOM_ENT()),0,0,'L',0);
$pdf->Ln(6);
/*******************************media- afiliacion***************************************** L N ******/
$pdf->SetFont('Arial','B','10');
$pdf->Cell(190,8,strtoupper(utf8_decode('media afiliacion')),0,1,'L',0);
$pdf->Rect($pdf->GetX(), $pdf->GetY(), 190, 34);
$pdf->Cell(40,8,(utf8_decode('Color ojos:')),0,0,'L',0);
$pdf->Cell(40,8,(utf8_decode('Color cabello:')),0,0,'L',0);
$pdf->Cell(25,8,(utf8_decode('Sexo:')),0,0,'L',0);
$pdf->Cell(40,8,(utf8_decode('Estatura:')),0,0,'L',0);
$pdf->Cell(40,8,(utf8_decode('Tipo sangre:')),0,0,'L',0);
$pdf->Ln(4);
$pdf->SetFont('Arial','','10');
$pdf->Cell(40,8,utf8_decode($media_afi->getColorOjos()),0,0,'L',0);
$pdf->Cell(40,8,utf8_decode($media_afi->getColorCabello()),0,0,'L',0);
$pdf->Cell(25,8,utf8_decode($persona->getGenero()),0,0,'L',0);
$pdf->Cell(40,8,$media_afi->getEstatura(),0,0,'L',0);
$pdf->Cell(40,8,$media_afi->getTipoSangre(),0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(1900,8,(utf8_decode('Señas particulares:')),0,0,'L',0);
$pdf->Ln(4);
$pdf->SetFont('Arial','','10');
$pdf->Cell(190,8,($media_afi->getSenasParticulares()),0,0,'L',0);
$pdf->SetFont('Arial','B','10');
$pdf->Ln(4);
$pdf->Cell(190,8,(utf8_decode('Requerimientos especiales:')),0,0,'L',0);
$pdf->Ln(4);
$requerimientos="";
if($media_afi->getUsaLentes()==1){
	$requerimientos="Usa lentes";
}
if($media_afi->getDonaOrganos()==1){
	if($requerimientos!="")
		$requerimientos.=", donador de organos";
	else
		$requerimientos=" Donador de organos";
}
if($media_afi->getUsaTransmisionAutomat1ica()==1){
	if($requerimientos!="")
		$requerimientos.=", transmision automatica";
	else
		$requerimientos=" Transmision automatica";
}
if($media_afi->getEquipadoConductorDiscapacitado()==1){
	if($requerimientos!="")
		$requerimientos.=", equipo conductor discapacitado";
	else
		$requerimientos=" Equipo conductor discapacitado";
}

if($media_afi->getEquipadoConductorProtesis()==1){
	if($requerimientos!="")
		$requerimientos.=", equipado conductor protesis";
	else
		$requerimientos=" Equipado conductor protesis";
}
if($requerimientos!="")
	$requerimientos.=".";
$pdf->SetFont('Arial','','10');
$pdf->Cell(190,8,utf8_decode($requerimientos),0,0,'L',0);
$pdf->Ln(9);

/*******************************En caso de accidente avisar a ***************************************** L N ******/
$pdf->SetFont('Arial','B','10');
$pdf->Cell(190,8,strtoupper(utf8_decode('En caso de accidente avisar a: ')),0,1,'L',0);
$pdf->Rect($pdf->GetX(), $pdf->GetY(), 190, 46);
$pdf->Cell(160,8,(utf8_decode('Nombre:')),0,0,'L',0);
$pdf->Cell(30,8,(utf8_decode('Telefono:')),0,0,'L',0);
$pdf->Ln(4);
$pdf->SetFont('Arial','','10');
$pdf->Cell(160,8,utf8_decode($contacto->getNombre()),0,0,'L',0);
$pdf->Cell(30,8,utf8_decode($contacto->getTelefeno()),0,0,'L',0);
$pdf->Ln();
//domicilio
$pdf->SetFont('Arial','B','10');
$pdf->Cell(160,8,(utf8_decode('Domicilio:')),0,0,'L',0);


$pdf->Ln(4);
$pdf->SetFont('Arial','','10');
$pdf->Cell(190,8,utf8_decode($contacto->getCalle()." ".$contacto->getNumeroExterrior()." ". $contacto->getColonia()),0,0,'L',0);

$pdf->Ln(4);
$pdf->SetFont('Arial','B','10');
$pdf->Cell(60,8,(utf8_decode('Delegacion:')),0,0,'L',0);
$pdf->Cell(60,8,(utf8_decode('Municipio:')),0,0,'L',0);
$pdf->Cell(40,8,(utf8_decode('Estado:')),0,0,'L',0);
$pdf->Cell(40,8,(utf8_decode('Pais:')),0,0,'L',0);

$pdf->Ln(4);
$pdf->SetFont('Arial','','10');
$pdf->Cell(60,8,utf8_decode($localidadC->getNOM_LOC()),0,0,'L',0);
$pdf->Cell(60,8,utf8_decode($municipioC->getNOM_MUN()),0,0,'L',0);
$pdf->Cell(40,8,utf8_decode($estadoC->getNOM_ENT()),0,0,'L',0);
$pdf->Cell(40,8,utf8_decode(""),0,0,'L',0);
$pdf->Ln(4);
$pdf->SetFont('Arial','B','10');
$pdf->Cell(40,8,(utf8_decode('Parentesco:')),0,0,'L',0);
$pdf->Ln(4);
$pdf->SetFont('Arial','','10');
$pdf->Cell(190,8,utf8_decode($contacto->getParentesco()),0,0,'L',0);
$pdf->SetFont('Arial','B','10');
$pdf->Ln(4);
$pdf->Cell(40,8,(utf8_decode('Observaciones:')),0,0,'L',0);
$pdf->Ln(4);
$pdf->SetFont('Arial','','10');
$pdf->Cell(190,8,utf8_decode(""),0,0,'L',0);

$pdf->Output();

}
}
else{
	pdfErrorMensaje('No se especifico un id.');
}
	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
?>1