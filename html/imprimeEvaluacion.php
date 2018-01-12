<?php


error_reporting(E_ALL);ini_set("display_errors", "1");
	require("masterIncludeLogin.inc.php");

require_once '../dompdf/autoload.inc.php';
require_once FOLDER_MODEL_EXTEND . "model.examen.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.examenpregunta.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.evaluacion.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.licencia.inc.php";
require_once FOLDER_MODEL_EXTEND . "model.persona.inc.php";

use Dompdf\Dompdf;
function setPreguntaYRespuestas($Examen,$evaluacion)
{
    $objExamen = new ModeloExamen();
    $objExamen =$Examen;
    $objEvaluacion = new ModeloEvaluacion();
    $objEvaluacion = $evaluacion;
    
    $objPregunta = new ModeloPregunta();
    $objEvaDetalle = new ModeloEvaluaciondetalle();
    
    $contador = 1;
    
    foreach($objExamen->getPreguntas() as $exaPregunta)
    {
        $objPregunta = $exaPregunta->getPregunta();
        $objEvaDetalle->setIdEvaluacion($objEvaluacion->getIdEvaluacion());
        $objEvaDetalle->setIdPregunta($objPregunta->getIdPregunta());
        $arrRetorno = $objEvaDetalle->getIdEvaluacionDetalleAnterior();
        $objPregunta->setIdRespuesta($arrRetorno['idRespuesta']);
        //echo "Respuesta " . $objPregunta->getIdRespuesta();
        $cuestionario.='<tr><td></td></tr>';
        $cuestionario.='<tr><td><strong>'.$contador .'.- '.(utf8_encode($objPregunta->getPregunta())).'</strong></td></tr>';
        foreach($objPregunta->getRespuestas() as $objRespuesta)    
        {
            if($objPregunta->getIdRespuesta()==$objRespuesta->getIdRespuesta())
            {
                $cuestionario.='<tr><td>'. utf8_encode($objRespuesta->getRespuesta()).'</td></tr>';
              
            }
            
        }
        $contador++;
    }
    
    if($objExamen->getTipo()!='teorico')
    {
        $cuestionario.='<tr><td><strong>Observaciones:</strong></td></tr><tr><td>'.$objEvaluacion->getObservaciones().'</td><tr>';
    }
    
        
    return $cuestionario;
    
}

    $objEvaluacion = new ModeloEvaluacion();
    $objEvaluacion->setIdEvaluacion($_GET['idEva']);
    
    
    $objExamen = new ModeloExamen ();
    $objExamen->setIdExamen($objEvaluacion->getIdExamen());
    $objExamen->setPreguntasByIdExamen();
    
    $objLicencia =  new ModeloLicencia();
    $objLicencia->setIdLicencias($objEvaluacion->getIdLicencia());
    $objLicencia->setTipoLicencia();
    
    $objPersona =  new ModeloPersona();
    $objPersona->setIdPersona($objLicencia->getIdPersona());
    
    $cuestionario.='<tr><td> <strong>Present&oacute;: </strong>'.$objPersona->getNombreCompleto().'</td></tr>';
    $cuestionario.='<tr><td> <strong>Fecha de examen: </strong>'.$objEvaluacion->getFechaHora().'</td></tr>';
    $cuestionario.='<tr><td> <strong>Para obtener la licencia de: </strong>'.$objLicencia->getTipoLicencia()->getDescripcion().' '.$objLicencia->getTipoLicencia()->getTipo().'</td></tr>';
    $cuestionario.='<tr><td> <strong>Estatus evaluaci&oacute;n: </strong>'.$objEvaluacion->getEstatus().($objExamen->getTipo()=='teorico'?'  <strong>Calificaci&oacute;n:</strong>'.$objEvaluacion->getCalificacion():' ').'</td></tr>';
    
    $index = 0;    
    $cuestionario.= setPreguntaYRespuestas($objExamen,$objEvaluacion);
    
$content = '<html>';
$content .= '<head>
	<link rel="stylesheet" href="bootstrap/core/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="bootstrap/typeahead/typeahead.min.css"/>
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-custom.css"/>
    <link rel="stylesheet" href="css/bootstrap-extended.css"/>
    <link rel="stylesheet" href="css/animate.min.css"/>
    <link rel="stylesheet" href="css/helpers.css"/>
    <link rel="stylesheet" href="css/base.css"/>
    <link rel="stylesheet" href="css/light-theme.css"/>
    <link rel="stylesheet" href="css/mediaqueries.css"/>';
	
$content .= '<style> 
				tr.enc{font-weight:bold;}
				table.borde{border: 1px solid black;}';
				
$content .= '</style>';
$content .= '</head><body bgcolor="white">
	<table width=100%>
            <tr><td></td></tr>
            <tr><td style="text-align:center" ><img src="images/theme/logobw.png" width="186" height="52" /></td></tr>
			<tr><td style="text-align:center"><h2>GOBIERNO DEL ESTADO DE BAJA CALIFORNIA</h2></td></tr>
			<tr><td style="text-align:center"><h3>SECRETARIA DE PLANECION Y FINANZAS</h3></td></tr>
			<tr><td style="text-align:center"><h4>SISTEMA DE EMISION DE LICENCIAS</h4></td></tr>
			<tr><td style="text-align:center"><h4>'.$objExamen->getDescripcion().'</h4></td></tr>
            <tr><td></td></tr>
			</table>';
            $content.='<table width=90% align="right">'.$cuestionario.'</table>';
            $content .= '</body></html>';

//echo $content; exit;

$dompdf = new Dompdf();
$dompdf->loadHtml($content);
//$dompdf->setPaper('A4', 'portrait'); // (Opcional) Configurar papel y orientación
$dompdf->render(); // Generar el PDF desde contenido HTML
$pdf = $dompdf->output(); // Obtener el PDF generado
$dompdf->stream($objExamen->getDescripcion()); // Enviar el PDF generado al navegador
?>