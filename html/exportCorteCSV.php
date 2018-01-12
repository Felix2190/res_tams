<?php

require("masterIncludeLogin.inc.php");
require_once FOLDER_MODEL_EXTEND . 'model.cortecaja.inc.php';
if(!isset($_GET['id']))
{
	$query="SELECT
					P.folioRecaudacion AS folio,
					CONCAT_WS(' ',personaprimerApellido,personaSegundoApellido,personaNombre) As personaApellidos,
					P.fechaPago AS fecha,
					P.forma As forma,
					P.total AS total
				FROM turnoDetalles As D
				INNER JOIN pago AS P ON P.idTurno=D.idTurno
				INNER JOIN tipolicencia AS T ON T.idTipoLicencia=D.idTipoLicencia
				WHERE P.estatus='pagado' AND DATE(P.fechaPago)=CURDATE() AND P.idCorteCaja=0";
	$nombre="corte.csv";
}
else
{
	
	$Corte=new ModeloCortecaja();
	$Corte->setIdCorteCaja($_GET['id']);
	$query="SELECT
					P.folioRecaudacion AS folio,
					CONCAT_WS(' ',personaprimerApellido,personaSegundoApellido,personaNombre) As personaApellidos,
					P.total AS total,
					P.fechaPago AS fecha,
					P.forma As forma
				FROM turnoDetalles As D
				INNER JOIN pago AS P ON P.idTurno=D.idTurno
				WHERE P.idCorteCaja=" . $_GET['id'];
	$nombre="corte_" . $Corte->getFecha() . ".csv";
	
}

$result=mysqli_query($dbLink, $query);


header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=" . $nombre);
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

$Cabeceras=array("Folio","Persona","Fecha","Forma","Total");




echo implode("\t", $Cabeceras) . "\n";

while($row=mysqli_fetch_assoc($result))
{
	echo implode("\t", $row) . "\n";
}





