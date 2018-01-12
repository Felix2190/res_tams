<?php

	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------Archivos necesarios Require Include---------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	require_once FOLDER_MODEL_EXTEND . 'model.cortecaja.inc.php';






	#-----------------------------------------------------------------------------------------------------------------#
	#--------------------------------------------Inicializacion de control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#



	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#----------------------------------------------------Funciones----------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	function calcularTablaCorte()
	{
		global $objSession;
		global $dbLink;
	
		//var_dump($objSession->getIdUbicacion());
	
	
		$query="SELECT
					P.folioRecaudacion AS folio,
					D.personaNombre, CONCAT_WS(' ',personaprimerApellido,personaSegundoApellido) As personaApellidos,
					P.total AS total,
					P.fechaPago AS fecha,
					P.forma As forma
				FROM turnoDetalles As D
				INNER JOIN pago AS P ON P.idTurno=D.idTurno
				INNER JOIN tipolicencia AS T ON T.idTipoLicencia=D.idTipoLicencia
				WHERE P.estatus='pagado' AND DATE(P.fechaPago)=CURDATE() AND P.idCorteCaja=0";
	
		$result=mysqli_query($dbLink, $query);
		if(!$result)
		{
			die("Error en la consulta");
		}
	
		$tabla="";
		while($r=mysqli_fetch_assoc($result))
		{
			$tabla.='<tr>
						<td>' . $r["folio"] . '</td>
						<td>' . $r["personaNombre"] . '</td>
						<td>' . $r["fecha"] . '</td>
						<td>' . $r["forma"] . '</td>
						<td>$ ' . number_format($r["total"],2 , "." , ",") . '</td>
						<td><a href="' . DOMINIO . "recibos/" .$r['folio'] . '.pdf" target="_blank"><i class="fa fa-download" ></a></td>
					</tr>';
				
		}
	
		return $tabla;
	}




	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#


	#-----------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------------Seccion AJAX--------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	$xajax=new xajax();
	
	function corte()
	{
		global $dbLink;
		global $objSession;
		$r=new xajaxResponse();
		
		$query="SELECT count(*) AS cuenta FROM cortecaja WHERE fecha=CURDATE()";
		$result=mysqli_query($dbLink, $query);
		if(!$result)
		{
			$r->mostrarError("Ocurrio un error en la consula de los cortes.");
			return $r;
		}
		
		$row=mysqli_fetch_assoc($result);
		if($row['cuenta']>0)
		{
			$r->mostrarDenegado("Ya existe un corte para la fecha actual.");
			return $r;
		}
		
		
		
		$query="SELECT IFNULL(SUM(total),0) AS ventas FROM pago WHERE DATE(fechaPago)=CURDATE() AND estatus='pagado' AND idCorteCaja=0";
		$result=mysqli_query($dbLink, $query);
		$row=mysqli_fetch_assoc($result);
		$total=$row['ventas'];
		
		
		$query="SELECT IFNULL(SUM(total),0) AS ventas FROM pago WHERE DATE(fechaPago)=CURDATE() AND forma='efectivo' AND estatus='pagado' AND idCorteCaja=0";
		$result=mysqli_query($dbLink, $query);
		$row=mysqli_fetch_assoc($result);
		$efectivo=$row['ventas'];
		
		$query="SELECT IFNULL(SUM(total),0) AS ventas FROM pago WHERE DATE(fechaPago)=CURDATE() AND forma<>'efectivo' AND estatus='pagado' AND idCorteCaja=0";
		$result=mysqli_query($dbLink, $query);
		$row=mysqli_fetch_assoc($result);
		$tarjeta=$row['ventas'];
		
		
		$Corte=new ModeloCortecaja();
		$Corte->setFecha(date("Y-m-d"));
		$Corte->setFechaRealizacion(_NOW_);
		$Corte->setIdUbicacion($objSession->getIdUbicacion());
		$Corte->setIdUsuario($objSession->getIdUser());
		$Corte->setTotal($total);
		$Corte->setTotalEfectivo($efectivo);
		$Corte->setTotalTarjeta($tarjeta);
		
		$Corte->Guardar();
		
		
		$query="UPDATE pago SET idCorteCaja=" . $Corte->getIdCorteCaja() . " WHERE DATE(fechaPago)=CURDATE() AND estatus='pagado' AND idCorteCaja=0";
		$result=mysqli_query($dbLink, $query);
		
		
		$r->mostrarExito("Se almacen&oacute; el corte de manera correcta.");
		$r->redirect("corteHistorial.php");
		
		return $r;
	}
	$xajax->registerFunction("corte");




	$xajax->processRequest();

	#-----------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------Inicializacion de variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------------------------#
	
	
	$query="SELECT IFNULL(SUM(total),0) AS ventas FROM pago WHERE DATE(fechaPago)=CURDATE() AND estatus='pagado' AND idCorteCaja=0";
	$result=mysqli_query($dbLink, $query);
	$row=mysqli_fetch_assoc($result);
	$total=number_format($row['ventas'],2,".",",");
	
	
	$query="SELECT IFNULL(SUM(total),0) AS ventas FROM pago WHERE DATE(fechaPago)=CURDATE() AND forma='efectivo' AND estatus='pagado' AND idCorteCaja=0";
	$result=mysqli_query($dbLink, $query);
	$row=mysqli_fetch_assoc($result);
	$efectivo=number_format($row['ventas'],2,".",",");
	
	$query="SELECT IFNULL(SUM(total),0) AS ventas FROM pago WHERE DATE(fechaPago)=CURDATE() AND forma<>'efectivo' AND estatus='pagado' AND idCorteCaja=0";
	$result=mysqli_query($dbLink, $query);
	$row=mysqli_fetch_assoc($result);
	$tarjeta=number_format($row['ventas'],2,".",",");
	
	
	$listadoCorte=calcularTablaCorte();

