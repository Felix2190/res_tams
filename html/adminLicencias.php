<?php

function obtenerLicenciasByExamen($tipo)
{
    global $dbLink;
    global $objSession;
	
    $fechaInicial = date('Y-m-d') ." 00:00:00";
    $fechaFin = date('Y-m-d')." 23:59:59";
	$sql = "SELECT L.idLicencias,L.idTipoLicencia, L.numero, P.idPersona, P.nombres, P.primerAp, P.segundoAp, TP.descripcion AS TipoLicencia, L.fechaExpedicion, L.fechaExpiracion, P.RFC,T.idTurno
FROM licencia L 
INNER JOIN tipolicencia TP ON L.idTipoLicencia = TP.idTipoLicencia
INNER JOIN persona P ON L.idPersona = P.idPersona
INNER JOIN turno T ON T.idTipoLicencia = L.idTipoLicencia
-- INNER JOIN evaluacion E ON L.idLicencias=E.idLicencia
-- INNER JOIN examen EX ON EX.idExamen = EX.idExamen
AND T.idPersona = L.idPersona

  WHERE T.estatus = 'examen".$tipo."' AND T.idUbicacion=".$objSession->getIdUbicacion() 
 
 ." AND T.fechaHora BETWEEN '" . $fechaInicial . "' AND '". $fechaFin."'";// AND '2017-06-26 23:59:59'";//AND T.fechaHora <= '20170626 23:59:59'";
	//	echo $sql;
	$res = mysqli_query ( $dbLink, $sql );
	$arrLicencias = array ();
	if ($res && mysqli_num_rows ( $res ) > 0) {
	
		while ( $row_inf = mysqli_fetch_assoc ( $res ) ) {
			$arrLicencia = array(
					'idLicencia'=>$row_inf['idLicencias'],
					'numero'=>$row_inf['numero'],
					'idPersona'=>$row_inf['idPersona'],
					'nombres'=>$row_inf['nombres'],
					'primerAp'=>$row_inf['primerAp'],
                    'segundoAp'=>$row_inf['segundoAp'],
					'tipoLicencia'=>$row_inf['TipoLicencia'],
					'fechaExpedicion'=>$row_inf['fechaExpedicion'],
					'fechaExpiracion'=>$row_inf['fechaExpiracion'],
					'RFC'=>$row_inf['RFC'],
					'idTipoLicencia'=>$row_inf['idTipoLicencia'],
                    'idTurno'=>$row_inf['idTurno']
                    
			);
			$arrLicencias[]=$arrLicencia;
		}
	
	}
	return $arrLicencias;
	
    
}
//Obtiene las licencias listas para imprimir
function obtenerLicencias($estatus){
	global $dbLink;
	
	$sql = "SELECT L.idLicencias,L.idTipoLicencia, L.numero, P.idPersona, P.nombres, P.primerAp, P.segundoAp, TP.descripcion AS TipoLicencia, L.fechaExpedicion, L.fechaExpiracion, P.RFC, ID.nombreCalle, ID.numeroExterior, ID.Colonia, getMunicipioByCveMunCveEnt(
ID.cveMun, ID.cveEnt
) AS Municipio, ID.codigoPostal, getEstadoByCveEnt(
ID.cveEnt
) AS Estado, DE.tipoSangre, DE.estatura, DE.colorOjos, DE.donaOrganos, DE.colorCabello, DE.senasParticulares, CE.nombre AS contacto, CE.telefeno AS telContacto
FROM licencia L
INNER JOIN tipolicencia TP ON L.idTipoLicencia = TP.idTipoLicencia
INNER JOIN persona P ON L.idPersona = P.idPersona
INNER JOIN turno T ON T.idTipoLicencia = L.idTipoLicencia
AND T.idPersona = L.idPersona
AND T.estatus =  'pago'
INNER JOIN contacto_emergencia CE ON P.idPersona = CE.idPersona
INNER JOIN persona_domicilio PD ON PD.idPersona = P.idPersona
INNER JOIN inegi_domicilio ID ON ID.idDomicilio = PD.idDomicilio
INNER JOIN persona_datos_extras DE ON DE.idPersona = P.idPersona
 WHERE L.estatus='" . $estatus . "'";
		
	$res = mysqli_query ( $dbLink, $sql );
	$arrLicencias = array ();
	if ($res && mysqli_num_rows ( $res ) > 0) {
	
		while ( $row_inf = mysqli_fetch_assoc ( $res ) ) {
			$arrLicencia = array(
					'idLicencia'=>$row_inf['idLicencias'],
					'numero'=>$row_inf['numero'],
					'idPersona'=>$row_inf['idPersona'],
					'nombres'=>$row_inf['nombres'],
					'primerAp'=>$row_inf['primerAp'],
                    'segundoAp'=>$row_inf['segundoAp'],
					'tipoLicencia'=>$row_inf['TipoLicencia'],
					'fechaExpedicion'=>$row_inf['fechaExpedicion'],
					'fechaExpiracion'=>$row_inf['fechaExpiracion'],
					'RFC'=>$row_inf['RFC'],
					'nombreCalle'=>$row_inf['nombreCalle'],
					'numeroExterior'=>$row_inf['numeroExterior'],
                    'colonia'=>$row_inf['Colonia'],
                    'municipio'=>$row_inf['Municipio'],
                    'codigoPostal'=>$row_inf['codigoPostal'],
                    'estado'=>$row_inf['Estado'],
                    'tipoSangre'=>$row_inf['tipoSangre'],
                    'estatura'=>$row_inf['estatura'],
                    'colorOjos'=>$row_inf['colorOjos'],
                    'donaOrganos'=>$row_inf['donaOrganos'],
                    'colorCabello'=>$row_inf['colorCabello'],
                    'senasParticulares'=>$row_inf['senasParticulares'],
                    'contacto'=>$row_inf['contacto'],
                    'telContacto'=>$row_inf['telContacto'],
                    'idTipoLicencia'=>$row_inf['idTipoLicencia']
                    
                    
                    
			);
			$arrLicencias[]=$arrLicencia;
		}
	
	}
	return $arrLicencias;
	
}

function obtenerLicenciaByIdLicencia($idLicencia){
	global $dbLink;
	
	$sql = "SELECT L.idLicencias,L.idTipoLicencia,  L.numero, P.idPersona, P.nombres, P.primerAp, P.segundoAp, TP.descripcion AS TipoLicencia, L.fechaExpedicion, L.fechaExpiracion, P.RFC, ID.nombreCalle, ID.numeroExterior, ID.Colonia, getMunicipioByCveMunCveEnt(
ID.cveMun, ID.cveEnt
) AS Municipio, ID.codigoPostal, getEstadoByCveEnt(
ID.cveEnt
) AS Estado, DE.tipoSangre, DE.estatura, DE.colorOjos, DE.donaOrganos, DE.colorCabello, DE.senasParticulares, CE.nombre AS contacto, CE.telefeno AS telContacto,P.idPersona
FROM licencia L
INNER JOIN tipolicencia TP ON L.idTipoLicencia = TP.idTipoLicencia
INNER JOIN persona P ON L.idPersona = P.idPersona
INNER JOIN turno T ON T.idTipoLicencia = L.idTipoLicencia
AND T.idPersona = L.idPersona
AND T.estatus =  'pago'
INNER JOIN contacto_emergencia CE ON P.idPersona = CE.idPersona
INNER JOIN persona_domicilio PD ON PD.idPersona = P.idPersona
INNER JOIN inegi_domicilio ID ON ID.idDomicilio = PD.idDomicilio
INNER JOIN persona_datos_extras DE ON DE.idPersona = P.idPersona
 WHERE  L.idLicencias =". $idLicencia;
		
	$res = mysqli_query ( $dbLink, $sql );
	//$arrLicencias = array ();
	if ($res && mysqli_num_rows ( $res ) > 0) {
	
		while ( $row_inf = mysqli_fetch_assoc ( $res ) ) {
			$arrLicencia = array(
					'idLicencia'=>$row_inf['idLicencias'],
					'numero'=>$row_inf['numero'],
					'idPersona'=>$row_inf['idPersona'],
					'nombres'=>$row_inf['nombres'],
					'primerAp'=>$row_inf['primerAp'],
                    'segundoAp'=>$row_inf['segundoAp'],
					'tipoLicencia'=>$row_inf['TipoLicencia'],
					'fechaExpedicion'=>$row_inf['fechaExpedicion'],
					'fechaExpiracion'=>$row_inf['fechaExpiracion'],
					'RFC'=>$row_inf['RFC'],
					'nombreCalle'=>$row_inf['nombreCalle'],
					'numeroExterior'=>$row_inf['numeroExterior'],
                    'colonia'=>$row_inf['Colonia'],
                    'municipio'=>$row_inf['Municipio'],
                    'codigoPostal'=>$row_inf['codigoPostal'],
                    'estado'=>$row_inf['Estado'],
                    'tipoSangre'=>$row_inf['tipoSangre'],
                    'estatura'=>$row_inf['estatura'],
                    'colorOjos'=>$row_inf['colorOjos'],
                    'donaOrganos'=>$row_inf['donaOrganos'],
                    'colorCabello'=>$row_inf['colorCabello'],
                    'senasParticulares'=>$row_inf['senasParticulares'],
                    'contacto'=>$row_inf['contacto'],
                    'telContacto'=>$row_inf['telContacto'],
                    'idTipoLicencia'=>$row_inf['idTipoLicencia']
                    
                    
			);
			//$arrLicencias[]=$arrLicencia;
		}
	
	}
	return $arrLicencia;
	
}


function obtenerDatosSecretario()
{
    $datosSecretario = array(
    'nombreSecretario'=>'Antonio Valladolid Rodriguez',
    'nombrePuesto'=>'Secretario de Planeacion y Finanzas',
    'rutaFirmaSecretario'=>'images/licencia/firmaSecretario.png'
    
    
    );
    return $datosSecretario;
    
}

?>