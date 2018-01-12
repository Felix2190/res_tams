<?php
require ("masterIncludeLogin.inc.php");
// $nav = 'inicio';
// $subnav = 'home';
// $nav='';
?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="ie ie6 lte9 lte8 lte7 no-js"> <![endif]-->
<!--[if IE 7]>     <html class="ie ie7 lte9 lte8 lte7 no-js"> <![endif]-->
<!--[if IE 8]>     <html class="ie ie8 lte9 lte8 no-js">      <![endif]-->
<!--[if IE 9]>     <html class="ie ie9 lte9 no-js">           <![endif]-->
<!--[if gt IE 9]>  <html class="no-js">                       <![endif]-->
<!--[if !IE]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Captura de datos biograficos</title>

<!-- // IOS webapp icons // -->

<meta name="apple-mobile-web-app-title" content="Karma Webapp">
<link rel="apple-touch-icon-precomposed" sizes="152x152"
	href="images/mobile/apple-touch-icon-152x152.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144"
	href="images/mobile/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon-precomposed" sizes="120x120"
	href="images/mobile/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114"
	href="images/mobile/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon-precomposed" sizes="76x76"
	href="images/mobile/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72"
	href="images/mobile/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon-precomposed"
	href="images/mobile/apple-touch-icon.png" />
<link rel="shortcut icon" href="images/favicons/favicon.ico" />

<!-- // IOS webapp splash screens // -->

<link rel="apple-touch-startup-image"
	media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)"
	href="/images/mobile/apple-touch-startup-image-1536x2008.png" />
<link rel="apple-touch-startup-image"
	media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)"
	href="/images/mobile/apple-touch-startup-image-1496x2048.png" />
<link rel="apple-touch-startup-image"
	media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)"
	href="/images/mobile/apple-touch-startup-image-768x1004.png" />
<link rel="apple-touch-startup-image"
	media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)"
	href="/images/mobile/apple-touch-startup-image-748x1024.png" />
<link rel="apple-touch-startup-image"
	media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)"
	href="/images/mobile/apple-touch-startup-image-640x1096.png" />
<link rel="apple-touch-startup-image"
	media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)"
	href="/images/mobile/apple-touch-startup-image-640x920.png" />
<link rel="apple-touch-startup-image"
	media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)"
	href="/images/mobile/apple-touch-startup-image-320x460.png" />

<!-- // Windows 8 tile // -->
<meta name="application-name" content="Unifica">
<meta name="msapplication-TileColor" content="#333333" />
<meta name="msapplication-TileImage"
	content="images/mobile/windows8-icon.png" />

<!-- // Handheld devices misc // -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="HandheldFriendly" content="true" />
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- // Stylesheets // -->
<link rel="stylesheet" href="bootstrap/core/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="bootstrap/typeahead/typeahead.min.css" />
<link rel="stylesheet" href="fontawesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="css/bootstrap-custom.css" />
<link rel="stylesheet" href="css/bootstrap-extended.css" />
<link rel="stylesheet" href="css/animate.min.css" />
<link rel="stylesheet" href="css/helpers.css" />
<link rel="stylesheet" href="css/base.css" />
<link rel="stylesheet" href="css/light-theme.css" />
<link rel="stylesheet" href="css/mediaqueries.css" />

<!-- // Helpers // -->
<script src="js/plugins/modernizr.min.js"></script>
<script src="js/plugins/mobiledevices.js"></script>

<!-- // jQuery core // -->
<script src="js/libs/jquery-1.11.0.min.js"></script>
<script src="js/libs/jquery-ui-1.10.4.min.js"></script>

<!-- // Bootstrap // -->
<script src="bootstrap/core/dist/js/bootstrap.min.js"></script>
<script src="bootstrap/bootboxjs/bootboxjs.min.js"></script>
<script src="bootstrap/holder/holder.min.js"></script>
<script src="bootstrap/typeahead/typeahead.min.js"></script>

<!-- // Custom/premium plugins // -->
<script src="js/plugins/mainmenu.1.0.min.js"></script>
<script src="js/plugins/bootstraptabsextend.1.0.min.js"></script>
<script src="js/plugins/nanogress.1.0.min.js"></script>
<script src="js/plugins/simpleselect.1.0.min.js"></script>

<!-- // Third-party plugins // -->
<script src="js/plugins/tinyscrollbar.min.js"></script>
<!-- mouse wheel opt-->
<script src="js/plugins/h5f.min.js"></script>
<script src="js/plugins/hogan-2.0.0.js"></script>
<script src="js/plugins/jquery.autosize-min.js"></script>
<script src="js/plugins/layout.min.js"></script>
<script src="js/plugins/masonry.pkgd.min.js"></script>

<script src="js/Chart.js/Chart.min.js"></script>
<script src="js/plugins/generics.js"></script>

<script src="js/plugins/jquery.tablesorter.min.js"></script>
<script src="js/plugins/jquery.tablesorter.widgets.min.js"></script>
<script src="js/plugins/jquery.tablesorter.pager.min.js"></script>
<script src="js/plugins/tablesort.js"></script>

<script src="js/plugins/generics.js"></script>
    
    
    
    
    <?php
				echo $_JAVASCRIPT_CSS;
				?>
         
    <!-- Calendar jQuery -->
<script type="text/javascript" src="js/lib/ui.datepicker-es-MX.js"></script>
<!-- CSS Calendario -->
<link rel="stylesheet" href="js/libs/jquery-ui-1.12.1/jquery-ui.css" />
<!-- Validadores de campos vacios -->
<link rel="stylesheet" href="css/validador.css" />
<!-- CURP -->
<script type="text/javascript" src="js/lib/curp.js"></script>
<!-- RFC -->
<script type="text/javascript" src="js/lib/calculadora_rfc.js"></script>

</head>
<body>
	<div id="container" class="clearfix">
		<aside id="sidebar-main" class="sidebar">            
        	<?php include_once('header.php'); ?>            
			<?php include_once('navhome.php'); ?>            
        </aside>
		<!-- End aside -->

		<div id="main" class="clearfix">       
			<?php include_once('topnav.php'); ?>                    
            <div id="content" class="clearfix">
				<header id="header-sec">
					<div class="inner-padding">
						<div class="pull-left">
							<h2>Datos biograficos</h2>
						</div>
					</div>
				</header>
				<div class="window">


					<!-- 
                        <div class="pull-right">

                        	<a class="btn" href="#" id="aDesc">

                            	<i class="fa fa-cloud-download"></i> Descargar Padr&oacute;n

                        	</a>
                        </div>
 						-->
				</div>
				<!-- <div class="row ext-raster"> -->
				<!-- <div class="col-sm-12"> -->
				<!-- <div class="row"> -->
				<input type="hidden" id="txtIdTurno" name="txtIdTurno" value="<?php echo $objTurno->getIdTurno(); ?>">
                                <input type="hidden" id="txtFechaNacimiento" name="txtFechaNacimiento" value="<?php echo $persona->getFechaNacimiento(); ?>">
                                <input type="hidden" id="txtEstadoDom" name="txtEstadoDom" value="<?php echo $objDomicilio->getCveEnt(); ?>">
                                <input type="text" id="txtMunicipioDom" name="txtMunicipioDom" value="<?php echo $objDomicilio->getCveMun(); ?>">
                                <input type="text" id="txtLocalidadDom" name="txtLocalidadDom" value="<?php echo $objDomicilio->getCveLoc(); ?>">
                                
				<div class="col-sm-12">
					<div class="subheading"></div>

					<div class="inner-padding">

						<div class="col-sm-12">

							<div class="inner-padding form-horizontal">

								<div class="subheading">
									<h3>Datos Generales</h3>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label txtApellidoPaterno"
										for="txtApellidoPaterno"> Apellido Paterno </label>
									<div class="col-sm-3">
										<input id="txtApellidoPaterno" name="txtApellidoPaterno"
											class="form-control" type="text" maxlength="50" value="<?php echo $persona->getPrimerAp(); ?>"/>
									</div>

									<label class="col-sm-3 control-label txtApellidoMaterno"
										for="txtApellidoMaterno"> Apellido Materno </label>
									<div class="col-sm-3">
										<input id="txtApellidoMaterno" class="form-control"
											type="text" maxlength="50" value="<?php echo $persona->getSegundoAp(); ?>" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label txtNombres"
										for="txtNombres"> Nombres </label>
									<div class="col-sm-9">
										<input id="txtNombres" class="form-control" type="text"
											maxlength="50" value="<?php echo $persona->getNombres(); ?>"/>
									</div>
								</div>

								<div class="subheading">
									<h3>Nacimiento</h3>
								</div>

								


								<div class="form-group">
									<label class="col-sm-3 control-label txtNacimiento"
										for="txtNacimiento"> Fecha Nacimiento </label> 
									<div class="col-sm-3">
										<input id="txtNacimiento" name="txtNacimiento"
											placeholder="AAAA-MM-DD" class="form-control" type="text" />
									</div>
								</div>

								<div class="subheading">
									<h3>Medida Filiaci&oacute;n</h3>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label slcColorOjos"
										for="slcColorOjos"> Color de ojos </label>
									<div class="col-sm-3">
										<select id="slcColorOjos" name="slcColorOjos"
											class="form-control " >        
											<?php echo $slcListadosOjos;?>
										</select>  
									</div>

									<label class="col-sm-3 control-label slcColorPelo"
										for="slcColorPelo"> Color de pelo </label>
									<div class="col-sm-3">
										<select id="slcColorPelo" class="form-control">
											<?php echo $slcListadosPelo; ?>
										</select>
									</div>
								</div>


								<div class="form-group">
									<label class="col-sm-3 control-label slcTipoSandre"
										for="slcTipoSandre"> Tipo Sangre </label>
									<div class="col-sm-3">
										<select id="slcTipoSandre" class="form-control">
											<?php echo $slcListadosSangre;?>
										</select>
									</div>
									<div class="col-sm-3">
										<input type="checkbox" name="chkImprimeTipoSangre" value="1"
											checked> <label for="slcTipoSandre" clas="slcTipoSandre">
											Imprime </label>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label slcGenero" for="slcGenero">
										Genero </label>
									<div class="col-sm-3">
										<select id="slcGenero" class="form-control">
											<option value="">Seleccione una opci&oacute;n</option>
                                                                                        <option value="H" <?php if($persona->getGenero() === 'H') echo 'selected'; ?>>Hombre</option>
											<option value="M" <?php if($persona->getGenero() === 'M') echo 'selected'; ?>>Mujer</option>
										</select>
									</div>

									<label class="col-sm-3 control-label txtPesoKG" for="txtPesoKG">
										Peso </label>
									<div class="col-sm-3">
										<input type="text" name="txtPesoKG" id="txtPesoKG"
											class="form-control txtPesoKG  numeric " placeholder="Kg"
											value="<?php echo $personaDatosExtra->getPeso();?>" maxlength="5">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label txtParticulares"
										for="txtParticulares"> Se&ntilde;as Particulares </label>
									<div class="col-sm-9">
										<textarea class="form-control" rows="3" id="txtParticulares"
											placeholder="Indique  cicatrices,  bigote etc."
											maxlength="50" ><?php echo $personaDatosExtra->getSenasParticulares();?></textarea>
									</div>
								</div>

								<div class="subheading">
									<h3>Domicilio</h3>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label slcEstadoDom" for="slcEstadoDom">
										Estado </label>
									<div class="col-sm-3">
										<select id="slcEstadoDom" class="form-control">											
											<?php echo $slcEstados;?>
										</select>
									</div>

									<label class="col-sm-3 control-label slcMunicipioDomicilio "
										for="slcMunicipioDomicilio"> Municipio </label>
									<div class="col-sm-3">
										<select id="slcMunicipioDomicilio" class="form-control">
											<option value="">Seleccione una opci&oacute;n</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label slcLocalidad"
										for="slcLocalidad"> Localidad </label>
									<div class="col-sm-9">
										<select id="slcLocalidad" class="form-control">
											<option value="">Seleccione una opci&oacute;n</option>
										</select>
									</div>
								</div>



								<div class="form-group">
									<label class="col-sm-3 control-label txtCalle" for="txtCalle">
										Calle </label>
									<div class="col-sm-9">

										<input type="text" name="txtCalle" id="txtCalle"
											class="form-control txtCalle " value="<?php echo $objDomicilio->getNombreCalle();?>">

									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label txtNumExt" for="txtNumExt">
										Numero Externo </label>
									<div class="col-sm-3">

										<input type="text" name="txtNumExt" id="txtNumExt"
											class="form-control txtNumExt " value="<?php echo $objDomicilio->getNumeroExterior();?>">

									</div>

									<label class="col-sm-3 control-label txtNumInt" for="txtNumInt">
										Numero Interno </label>
									<div class="col-sm-3">

										<input type="text" name="txtNumInt" id="txtNumExt"
											class="form-control txtNumInt ">

									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label txtColonia"
										for="txtColonia"> Colonia </label>
									<div class="col-sm-6">

										<input type="text" name="txtColonia" id="txtColonia"
											class="form-control txtColonia "value="<?php echo $objDomicilio->getColonia();?>">

									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label txtCP" for="txtCP"> Codigo
										Postal </label>
									<div class="col-sm-3">

										<input type="text" name="txtCP" id="txtCP"
											class="form-control txtCP " value="<?php echo $objDomicilio->getCodigoPostal();?>">

									</div>

									<label class="col-sm-3 control-label txtTelefono"
										for="txtTelefono"> Telefono </label>
									<div class="col-sm-3">

										<input type="text" name="txtTelefono" id="txtTelefono"
											class="form-control txtTelefono " value="<?php echo $persona->getTelCasa();?>">

									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label txtTelefono"
										for="txtTelefono"> Telefono  Mobil</label>
									<div class="col-sm-3">

										<input type="text" name="txtTelefonoMobil" id="txtTelefonoMobil"
											class="form-control txtTelefonoMobil " value="<?php echo $persona->getTelMovil();?>">

									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label txtCorreoE"
										for="txtCorreoE"> Correo Electronico </label>
									<div class="col-sm-6">

										<input type="text" name="txtCorreoE" id="txtCorreoE"
											class="form-control txtCorreoE " value="<?php echo $persona->getEmail();?>">

									</div>
								</div>

								

							

							


								

								<div class="subheading">
									<h3>Contacto Emergencia</h3>
								</div>
					
								
								<div class="form-group">
									<label class="col-sm-3 control-label txtNombreContacto"
										for="txtNombreContacto">Nombre </label>
									<div class="col-sm-6">

										<input type="text" name="txtNombreContacto" id="txtNombreContacto"
											class="form-control txtNombreContacto " value="<?php echo $objContacto->getNombre();?>">

									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label slParentezcoContacto"
										for="slParentezcoContacto"> Parentezco </label>
									<div class="col-sm-3">
										<select id="slParentezcoContacto" class="form-control">
											<?php echo $slcListadosParentezco;?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label slcEstadoContacto"
										for="slcEstadoContacto"> Estado </label>
									<div class="col-sm-3">
										<select id="slcEstadoContacto" class="form-control">											
											<?php echo $slcEstados;?>
										</select>
									</div>

									<label class="col-sm-3 control-label slcMunicipioContacto"
										for="slcMunicipioContacto"> Municipio </label>
									<div class="col-sm-3">
										<select id="slcMunicipioContacto" class="form-control">
											<option value="">Seleccione una opci&oacute;n</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label slcLocalidadContacto"
										for="slcLocalidadContacto"> Localidad </label>
									<div class="col-sm-9">
										<select id="slcLocalidadContacto" class="form-control">
											<option value="">Seleccione una opci&oacute;n</option>
										</select>
									</div>
								</div>



								<div class="form-group">
									<label class="col-sm-3 control-label txtCalleContacto"
										for="txtCalleContacto"> Calle </label>
									<div class="col-sm-9">

										<input type="text" name="txtCalleContacto" id="txtCalleContacto"
											class="form-control txtCalleContacto " value="<?php echo $objContacto->getCalle();?> ">

									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label txtNumExtContacto"
										for="txtNumExtContacto"> Numero Externo </label>
									<div class="col-sm-3">

										<input type="text" name="txtNumExtContacto"
											id="txtNumExtContacto"
											class="form-control txtNumExtContacto " value="<?php echo $objContacto->getNumeroExterrior();?> ">

									</div>

									<label class="col-sm-3 control-label txtNumIntContacto"
										for="txtNumIntContacto"> Numero Interno </label>
									<div class="col-sm-3">

										<input type="text" name="txtNumIntContacto"
											id="txtNumIntContacto"
											class="form-control txtNumIntContacto ">

									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label txtColoniaContacto"
										for="txtColoniaContacto"> Colonia </label>
									<div class="col-sm-6">

										<input type="text" name="txtColoniaContacto"
											id="txtColoniaContacto"
											class="form-control txtColoniaContacto " value="<?php echo $objContacto->getColonia();?> ">

									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label txtCPContacto"
										for="txtCPContacto"> Codigo Postal </label>
									<div class="col-sm-3">

										<input type="text" name="txtCPContacto" id="txtCPContacto"
											class="form-control txtCPContacto " value="<?php echo $objContacto->getCodigoPostal();?> ">

									</div>

									<label class="col-sm-3 control-label txtTelefonoContacto"
										for="txtTelefonoContacto"> Telefono </label>
									<div class="col-sm-3">

										<input type="text" name="txtTelefonoContacto" id="txtTelefonoContacto"
											class="form-control txtTelefonoContacto " value="<?php echo $objContacto->getTelefeno();?> ">

									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label txtObservacionesContacto"
										for="txtObservacionesContacto"> Observaciones </label>
									<div class="col-sm-6">

										<textarea class="form-control" rows="3"
											id="txtObservacionesContacto"
											placeholder="Observaciones del contacto." maxlength="100"></textarea>

									</div>
								</div>

								<div class="subheading">
									<h3>Requerimientos Especiales</h3>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="chkLentes"> Usa
										Lentes </label>
									<div class="col-sm-2">

										<input type="checkbox" name="chkLentes" value="1" <?php if($personaDatosExtra->getUsaLentes()==1) echo 'checked';?>>

									</div>

									<label class="col-sm-3 control-label" for="chkOrganos"> Dona
										Organos </label>
									<div class="col-sm-2">

										<input type="checkbox" name="chkOrganos" value="1" <?php if($personaDatosExtra->getDonaOrganos()==1) echo 'checked';?>>

									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-4 control-label"
										for="chkTransmisionAUtomatica"> Usa solo trasnmision
										automatica </label>
									<div class="col-sm-2">

										<input type="checkbox" name="chkTransmisionAUtomatica"
                                                                                       value="1" <?php if($personaDatosExtra->getUsaTransmisionAutomat1ica()==1) echo 'checked';?>>

									</div>
									<label class="col-sm-3 control-label"
										for="chkVehiculoDiscapacitado"> Vehiculo equipado para
										conductor discapacitado </label>
									<div class="col-sm-2">

										<input type="checkbox" name="chkVehiculoDiscapacitado"
											value="1" <?php if($personaDatosExtra->getEquipadoConductorDiscapacitado()==1) echo 'checked';?>>

									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label" for="chkProtesis">
										Vehiculo equipado para conductor con protesis </label>
									<div class="col-sm-2">

										<input type="checkbox" name="chkProtesis" value="1" <?php if($personaDatosExtra->getEquipadoConductorProtesis()==1) echo 'checked';?>>

									</div>

								</div>
							</div>


							<div class="form-group">
								<div class="col-sm-9">&nbsp;</div>
								<div class="col-sm-2">
									<button class="btn btn-default" id="btnCancelar"
										name="btnCancelar">Cancelar</button>
									<button class="btn btn-primary" id="btnGuardar"
										name="btnGuardar">Guardar</button>

								</div>
							</div>





							<div class="spacer-30"></div>
							<div class="spacer-30"></div>


						</div>


					</div>
				</div>
				<!-- </div> -->
				<!-- End .row -->
			</div>
			<!-- </div> -->
		</div>
		<!-- End .window -->                
                <?php include_once('footer.php'); ?>
                
                <a data-toggle="modal" id="_alertShow"
			style="display: none" class="btn btn-danger" role="button"
			href="#_alertBox">Alert</a>
		<div class="modal fade" id="_alertBox" tabindex="-1" role="dialog"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true" id="_alertCloseUp">&times;</button>
						<h4 class="modal-title" id="_alertTitle"></h4>
					</div>
					<div class="modal-body">
						<p id="_alertBody"></p>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal"
							id="_alertClose">OK</button>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- End #content -->
	</div>
	<!-- End #main -->

	<!-- End #container -->
</body>
</html>