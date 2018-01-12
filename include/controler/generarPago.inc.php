<?php

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	
	require_once FOLDER_MODEL_EXTEND . 'model.turno.inc.php';
	require_once FOLDER_MODEL_EXTEND . 'model.reglaDescuento.inc.php';
	require_once FOLDER_MODEL_EXTEND . 'model.pago.inc.php';
	require_once FOLDER_MODEL_EXTEND . 'model.pago_detalle.inc.php';
	require_once FOLDER_MODEL_EXTEND . 'model.tipolicencia.inc.php';
	

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	function calcularPagoTotal($idTipoLicencia)
	{
		
		$Costo=new ModeloReglaDescuento();
		
		$Licencia=new ModeloTipolicencia();
		$Licencia->setIdTipoLicencia($idTipoLicencia);
		
		$costoTramite=0;
		
		//$Licencia->getCosto();
		switch($Licencia->getTipoTramite())
		{
			case "nueva":
				$costoTramite=$Licencia->getNuevaCosto();
				break;
			case "revalidacion":
				$costoTramite=$Licencia->getRevalidacionCosto();
				break;
			case "reposicion":
				$costoTramite=$Licencia->getReposicionCosto();
				break;
			
		}
		
		
		$retorno=array();
		
		
		#Info de produccion
		$retorno[]=array("descripcion"=>$Licencia->getDescripcion() . " " . $Licencia->getTipo() . " " . $Licencia->getPeriodo() . " meses " . $Licencia->getTipoTramite(),
						"cantidad"=>$costoTramite,
						"opcional"=>"no"
				);
		
		
		#Info dummy
		/*
		$retorno[]=array("descripcion"=>"Licencia generica GENERICA 12 meses TIPO TRAMITE DUMMY",
				"cantidad"=>500,
				"opcional"=>"no"
		);
		*/
		
		
		
		$datos=$Costo->getLicenciasDescuento($idTipoLicencia);
		
		
		/*
		if(count($datos)==0)
		{
			return array();
		}
		*/
		
		
		//print_r($datos);
		$detalleElegido=null;
		foreach($datos AS $k=>$detalleDescuento)
		{
			/*
			 [0] => Array
	        (
	            [idReglaDecreto] =>
	            [idTipoLicencia] => 1
	            [costo] => 100
	            [esPorcentaje] => 1
	            [descuento] => 10
	            [costoDescuento] => 90
	            [edadMinima] => 18
	            [edadMaxima] => 65
	        )
	        */
			if($detalleDescuento["costoDescuento"]<$costoTramite)
			{
				$total=$detalleDescuento["costoDescuento"];
				$detalleElegido=$detalleDescuento;
				
				
				
			}
		}
		
		if(is_array($detalleElegido))
		{
			$retorno[]=array("descripcion"=>"Descuento",
					"cantidad"=>-($costoTramite-$detalleElegido["costoDescuento"]),
					"opcional"=>"no"
			);
		}
		
		
		
		return $retorno;
		
		
		
		/*
		return array(
				array("descripcion"=>"Licencia 5y",
						"cantidad"=>"450",
						"opcional"=>"no"
				),
			#array("descripcion"=>"Donacion Cruz Roja",
			#			"cantidad"=>"50",
			#			"opcional"=>"si"
			#	),
			
				array("descripcion"=>"Descuento adulto mayor",
						"cantidad"=>"-50",
						"opcional"=>"no"
				)
		);
				*/
	}
	
	
	function registrar($idTurno, $txtFolioTesoreria, $txtComentarios,$forma,$ultimos,$enviarBanco=false)
	{
		global $objSession;
		$r=new xajaxResponse();
		
		
		
		$query="SELECT count(*) AS cuenta FROM cortecaja WHERE fecha=CURDATE();";
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
		
		
		$Turno=new ModeloTurno();
		$Turno->setIdTurno($idTurno);
		if($Turno->getError())
		{
			$r->mostrarError($Turno->getStrError());
			if($enviarBanco)
				return array($r,true);
			return $r;
		}
		
		$Pago=new ModeloPago();
		
		$existe=$Pago->existePago($Turno->getIdTurno());
		if($Pago->getError())
		{
			$r->mostrarError($Pago->getStrError());
			if($enviarBanco)
				return array($r,true);
			return $r;
		}
		if($existe)
		{
			$r->mostrarAviso("El pago para este tr&aacute;mite ya est&aacute; registrado.<br />Folio recaudaci&oacute;n: <strong>" . $Pago->getFolioRecaudacion() . "</strong>");
			if($enviarBanco)
				return array($r,true);
			return $r;
		}
		
		
		
		
		$Pago->setIdTurno($idTurno);
		$Pago->setIdUsuarioCreacion($objSession->getIdUser());
		$Pago->setIdUbicacion($objSession->getIdUbicacion());
		$Pago->setFechaCreacion(_NOW_);
		
		$Pago->setForma($forma);
		$Pago->setUltimosDigitosTarjeta($ultimos);
		
		if($enviarBanco)
		{
			$Pago->setEstatusPendiente();
		}
		else
		{
			$Pago->setFechaPago(_NOW_);
			$Pago->setEstatusPagado();
		}
		
		$txtFolioTesoreria="PL" . str_pad($Turno->getIdUbicacion(), 3,"0",STR_PAD_LEFT) . date("ymdHis") . rand(100,999);
		
		$Pago->setFolioRecaudacion($txtFolioTesoreria);
		$Pago->setCometarios($txtComentarios);
		
		
		$detallesPago=calcularPagoTotal($Turno->getIdTipoLicencia());
		
		if(count($detallesPago)==0)
		{
			$r->mostrarError("No se tienen registros de costos para el tipo de licencia.");
			if($enviarBanco)
				return array($r,true);
			return $r;
		}
		
		$detallesTabla='';
		$total=0;
		foreach($detallesPago AS $k=>$detalles)
		{
			$total+=$detalles["cantidad"];
		}
		if($total<0)
			$total=0;
		
		
			$Pago->setTotal($total);
			$Pago->Guardar();
		
			if($Pago->getError())
			{
				$r->mostrarError($Pago->getStrError());
				if($enviarBanco)
					return array($r,true);
				return $r;
			}
		
			foreach($detallesPago AS $k=>$detalles)
			{
				$Detalle=new ModeloPago_detalle();
				$Detalle->setIdPago($Pago->getIdPago());
				$Detalle->setConcepto($detalles["descripcion"]);
				$Detalle->setMonto($detalles["cantidad"]);
				$Detalle->Guardar();
				if($Detalle->getError())
				{
					$r->mostrarError($Detalle->getStrError());
					if($enviarBanco)
						return array($r,true);
					return $r;
				}
			}
			
			
			$Pago->generaPDF(FOLDER_HTDOCS . "recibos/" . $Pago->getFolioRecaudacion() . ".pdf");
			
			$r->mostrarAviso('<table><tr><td>Se almacen&oacute; la informaci&oacute;n de manera correcta. </td><td><a target="_blank" href="' . DOMINIO . 'recibos/' . $Pago->getFolioRecaudacion() . '.pdf" class="btn btn-default"><i class="fa fa-download"></i> </a></td></tr></table>');
			
			
			
			//$r->redirect("impresion.php?idT=" . $idTurno,1);
			
			
			
			if($enviarBanco)
				return array($r,false);
			return $r;
	}
	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
	
	$xajax=new xajax();
	
	function generaPDF()
	{
		$r=new xajaxResponse();
		$Pago=new ModeloPago();
		$Pago->setIdPago(10);
		
		$nombre="algo_" . rand(10000,99999) . ".pdf";
		
		$Pago->generaPDF(FOLDER_HTML . "tmp/" . $nombre);
		
		if($Pago->getError())
		{
			$r->mostrarError($Pago->getStrSystemError());
		}
		else
		{
		
			$r->mostrarAviso('<a target="_blank" href="' . DOMINIO . 'tmp/' . $nombre . '">View PDF</a>');
			
		}
		return $r;
		
	}
	
	$xajax->registerFunction("generaPDF");
	
	function enviarBanco($idTurno, $txtFolioTesoreria, $txtComentarios,$forma, $ultimos)
	{
		list($r,$error)=registrar($idTurno, $txtFolioTesoreria, $txtComentarios,$forma, $ultimos,true);
		if($error)
			return $r;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";
		$Turno=new ModeloTurno();
		$Turno->setIdTurno($idTurno);
		$Pago=new ModeloPago();
		$Pago->getPagoPendienteByIdTurno($Turno->getIdTurno());
		$message="idTurno:" . $idTurno . "\nidUbicacion:" . $Turno->getIdUbicacion() . "\nfolio:" . $txtFolioTesoreria . "\ntotal:" . $Pago->getTotal() . "\ncomentario:" . $txtComentarios;
		@mail("banco@aiidia.com","Bancos",$message,$headers);
		return $r;
		/*Enviar a banco*/
	}
	$xajax->registerFunction("enviarBanco");
	
	function registrarPago($idTurno, $txtFolioTesoreria, $txtComentarios,$forma, $ultimos)
	{
		return registrar($idTurno, $txtFolioTesoreria, $txtComentarios,$forma, $ultimos);
		
	}
	
	$xajax->registerFunction("registrarPago");
	
	function buscarTurnoPago($idInterno, $idExterno)
	{
		$r=new xajaxResponse();
		
		$Turno=new ModeloTurno();
		
		if(trim($idInterno)==""&&trim($idExterno)=="")
		{
			$r->mostrarError("Especifique el turno interno o externo a buscar.");
			return $r;
		}
		
		if(trim($idInterno)!="")
		{
			$Turno->setIdTurno($idInterno);
		}
		else
		{
			$Turno->getDatosByIdExterno($idExterno);
		}
		if($Turno->getError())
		{
			$r->mostrarError($Turno->getStrError());
			$r->assign("divInfo", "innerHTML", "Sin informaci&oacute;n.");
			$r->call("removerInformacion");
			//$r->assign("divInfo", "innerHTML", "Sin informaci&oacute;n.");
			return $r;
		}
		
		
		$Pago=new ModeloPago();
		$existe=$Pago->existePago($Turno->getIdTurno());
		if($Pago->getError())
		{
			$r->mostrarError($Pago->getStrError());
			return $r;
		}
		if($existe)
		{
			
			
			$r->mostrarAviso("El pago para este tr&aacute;mite ya est&aacute; registrado.<br />Folio recaudaci&oacute;n: <strong>" . $Pago->getFolioRecaudacion() . "</strong>");
			$r->call("removerInformacion");
			return $r;
		}
		
		
		$detallesPago=calcularPagoTotal($Turno->getIdTipoLicencia());
		
		
		
		if(count($detallesPago)==0)
		{
			$r->mostrarError("No se tienen registros de costos para el tipo de licencia.");
			$r->call("removerInformacion");
			return $r;
		}
		
		$detallesTabla='';
		$total=0;
		foreach($detallesPago AS $k=>$detalles)
		{
			$total+=$detalles["cantidad"];
			if($detalles["cantidad"]>0)
			{
				$color="text-primary";
			}
			else
			{
				$color="text-danger";
			}
			$detallesTabla.='<tr>
								<td class="text-right"><strong>' . $detalles["descripcion"] . '</strong></td>
								<td><h3><span class="text ' . $color . '"><strong>$ ' . number_format($detalles["cantidad"],2,".",",") . '</strong></span></h3></td>
							</tr>
					';
			
		}
		if($total<0)
			$total=0;
		
		$detallesTabla.='
				
						<tr>
							<td class="text-right"><strong>Forma Pago</strong></td>
							<td>
								<select id="slcFormaPago" class="form-control">
									<option value="">Selecciona</option>
									<option value="efectivo">Efectivo</option>
									<option value="td">Tarjeta D&eacute;bito</option>
									<option value="tc">Tarjeta Cr&eacute;dito</option>
								</select>
							</td>
						</tr>
				
						<tr>
							<td class="text-right"><strong>&Uacute;ltimos 4 d&iacute;gitos</strong></td>
							<td><input type="text" id="txtUltimos" class="form-control input-md" disabled maxlength="4" /></td>
						</tr>
				
						<tr>
							<td class="text-right"><strong>Total</strong></td>
							<td><h2><span class="text text-success"><strong>$ ' . number_format($total,2,".",",") . '</strong></span></h2></td>
						</tr>
									
						<tr>
							<td class="text-right"><strong>Cantidad que se recibe</strong></td>
							<td><input type="text" id="txtRecibe" data="' . $total . '" class="form-control input-lg" /></td>
						</tr>
									
						<tr>
							<td class="text-right"><strong>Cambio</strong></td>
							<td><h2><span class="text text-default" id="lblCambio"></span></h2></td>
						</tr>
				';
		
		$Persona=new ModeloPersona();
		$Persona->setIdPersona($Turno->getIdPersona());
		$divInfo='<table class="table table-striped">
														<tr>
															<td class="text-right"><strong>Turno Interno</strong></td>
															<td><span class="label label-default">' . $Turno->getIdTurno() . '</span></td>
														</tr>
														<tr>
															<td class="text-right"><strong>Turno Externo</strong></td>
															<td><span class="label label-primary">' . $Turno->getTurnoExterno() . '</span></td>
														</tr>
														
														<tr>
															<td class="text-right"><strong>Nombre</strong></td>
															<td>' . $Persona->getNombres() . '</td>
														</tr>
														' . $detallesTabla . '
																
														<!--
														<tr>
															<td class="text-right"><strong>Folio Tesorer&iacute;a</strong></td>
															<td><input type="text" class="form-control" id="txtFolioTesoreria"></td>
														</tr>
														-->
														<tr>
															<td class="text-right"><strong>Comentarios</strong></td>
															<td>
																<input type="text" class="form-control" id="txtComentarios">
																<input type="hidden" id="idTurno" value="' . $Turno->getIdTurno() . '">
																
															</td>
														</tr>
													</table>';
		$r->ocultarMensaje();
		//$r->assign("divInfo", "innerHTML", $divInfo);
		$r->call("colocarInformacion",$divInfo);
		return $r;
	}
	$xajax->registerFunction("buscarTurnoPago");
	
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
