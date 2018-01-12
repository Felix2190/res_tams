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
			//$this->Ln(10);
			
			//TItulo
			$this->Image('images/theme/logobw.png',10,10,35);//
			
			$this->SetFont('Arial','B',18);
			$this->SetFillColor(2,118,191);
			$this->Cell(175,25,utf8_decode('GOBIERNO DEL ESTADO DE TAMAULIPAS '),0,0,'R',0);
			$this->SetFont('Arial','',14);
			
			$this->SetFont('Arial','',8);
			$this->Cell(20,6,utf8_decode(DATE('Y-m-d')),0,0,'R',0);
				
			$this->SetFont('Arial','',12);
			$this->Ln(6);
			$this->Cell(190,25,utf8_decode(' Verificacion de licencias'),0,0,'C',0);
			//$this->Ln(6);
			$this->SetFont('Arial','',8);
			$this->Ln(6);
			//$this->Cell(190,25,utf8_decode('CONSTANCIA DE IDENTIFICACION '),0,0,'C',0);
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
$pdf->SetTitle("volante.pdf");
$pdf->SetFont('Arial','B','8');
$pdf->PaginaUno();
/************************* FICHA DE IDENTIFICACION *************************************/
$pdf->SetX(10);

/*******************************informacion general***************************************** L N ******/
$pdf->SetFont('Arial','B','10');
$pdf->Cell(140,8,strtoupper(utf8_decode('Informacion general')),0,0,'L',0);



$pdf->Ln(6);
$pdf->SetFont('Arial','','10');
$pdf->Cell(35,5,(utf8_decode('Nombre:')),0,0,'L',0);
$pdf->Cell(160,5,utf8_decode($persona->getNombreCompleto()),0,1,'L',0);
$pdf->Cell(35,5,(utf8_decode('Expedicion:')),0,0,'L',0);
$pdf->Cell(35,5,date_format(date_create($licencia->getFechaExpedicion()),'Y-m-d'),0,1,'L',0);
$pdf->Cell(35,5,(utf8_decode('Licencia:')),0,0,'L',0);
$pdf->Cell(35,5,utf8_decode($licencia->getNumero()),0,1,'L',0);
$pdf->Cell(35,5,(utf8_decode('Oficina de Expedicion:')),0,0,'L',0);
$pdf->Cell(35,5,utf8_decode($ubicacion->getNombre()),0,1,'L',0);
$pdf->Cell(35,5,(utf8_decode('Tipo de licencia:')),0,0,'L',0);
$pdf->Cell(40,5,utf8_decode($tipoLicencia->getDescripcion()),0,1,'L',0);



/*******************************informacion personal***************************************** L N ******/
$pdf->Ln(6);
$pdf->SetFont('Arial','B','10');
$pdf->Cell(140,8,strtoupper(utf8_decode('Informacion personal')),0,0,'L',0);
$pdf->Ln(6);
$pdf->SetFont('Arial','','10');
$pdf->Cell(30,6,(utf8_decode('RFC:')),0,0,'L',0);
$pdf->Cell(30,6,utf8_decode($persona->getRFC()),0,1,'L',0);
$pdf->Cell(30,5,(utf8_decode('CURP:')),0,0,'L',0);
$pdf->Cell(30,5,utf8_decode($persona->getCURP()),0,1,'L',0);
$pdf->Cell(30,5,(utf8_decode('Calle:')),0,0,'L',0);
$pdf->Cell(160,5,utf8_decode($domicilio->getNombreCalle()."".$domicilio->getNumeroExterior()),0,1,'L',0);
$pdf->Cell(30,5,(utf8_decode('Colonia:')),0,0,'L',0);
$pdf->Cell(160,5,utf8_decode($domicilio->getColonia()),0,1,'L',0);
$pdf->Cell(30,5,(utf8_decode('Municipio:')),0,0,'L',0);
$pdf->Cell(100,5,utf8_decode($municipio->getNOM_MUN()),0,1,'L',0);
$pdf->Cell(30,5,(utf8_decode('Codigo Postal:')),0,0,'L',0);
$pdf->Cell(100,5,utf8_decode($domicilio->getCodigoPostal()),0,1,'L',0);
$pdf->Cell(30,5,(utf8_decode('Fecha Nacimiento:')),0,0,'L',0);
if($persona->getFechaNacimiento()== null)
	$pdf->Cell(100,5,"No especificado",0,1,'L',0);
else
	$pdf->Cell(100,5,date_format(date_create($persona->getFechaNacimiento()),'Y-m-d'),0,1,'L',0);
$pdf->Cell(30,5,(utf8_decode('Entidad de origen:')),0,0,'L',0);
$pdf->Cell(100,5,utf8_decode($estadoN->getNOM_ENT()),0,1,'L',0);
$pdf->Cell(35,5,strtoupper(utf8_decode('Fotografia y firma')),0,0,'L',0);

$pdf->Ln(6);

/*******************************informacion medica***************************************** L N ******/
$pdf->Ln(6);
$pdf->SetFont('Arial','B','10');
$pdf->Cell(140,8,strtoupper(utf8_decode('Informacion medica')),0,0,'L',0);
$pdf->Ln(6);
$pdf->SetFont('Arial','','10');
$pdf->Cell(30,5,(utf8_decode('Tipo de sangre:')),0,0,'L',0);
$pdf->Cell(160,5,$media_afi->getTipoSangre(),0,1,'L',0);

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

	
$pdf->Cell(30,5,(utf8_decode('Restricciones:')),0,0,'L',0);
$pdf->Cell(160,5,utf8_decode($requerimientos),0,1,'L',0);
//$pdf->Rect($pdf->GetX(), $pdf->GetY(), 140, 22);






/******************************* fotografia y firma ***************************************** L N ******/
// $pdf->SetFont('Arial','B','10');
// $pdf->Cell(1900,8,(utf8_decode('Señas particulares:')),0,0,'L',0);
// $pdf->Ln(4);
// $pdf->SetFont('Arial','','10');
// $pdf->Cell(190,8,($media_afi->getSenasParticulares()),0,0,'L',0);
// $pdf->SetFont('Arial','B','10');
// $pdf->Ln(4);
// $pdf->Cell(190,8,(utf8_decode('Requerimientos especiales:')),0,0,'L',0);
// $pdf->Ln(4);
// $pdf->SetFont('Arial','','10');
// $pdf->Cell(190,8,utf8_decode($requerimientos),0,0,'L',0);
// $pdf->Ln(9);
	$pdf->Ln(6);
	$pdf->SetFont('Arial','B','10');
	$pdf->Cell(140,8,strtoupper(utf8_decode('Fotografia y firma')),0,1,'L',0);

if($foto->getDocumentoimagen()==""){
	//$pdf->Image($foto->getDocumentoimagen() ,10,10,-300);
}else{
	$pdf->Image($foto->getDocumentoimagen() ,$pdf->GetX(),$pdf->GetY(),55);
}
if($firma->getDocumentoimagen()==""){
	//$pdf->Image($foto->getDocumentoimagen() ,10,10,-300);
}else{
	$pdf->Image($firma->getDocumentoimagen() ,$pdf->GetX()+70,$pdf->GetY(),55);
}

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