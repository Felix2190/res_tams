<?php
require ("masterIncludeLogin.inc.php");
$__pasoActual="datos";  //turno, tramite, pago, datos, documentos,verificacion, examen, impresion


/*
 * Posibles valores $__pasoSubseccion:
 *
 * 		turno=>"",
 tramite=>"curp","tipo",
 pago=>"resumen","impresion",
 datos=>"biograficos","domicilio","huellas","iris","extra","contacto",
 documentos=>"",
 verificacion=>"datos","firma",
 examen=>"",
 impresion=>"impresion","verificacion","activacion"
 *
 * */
$__pasoSubseccion="biograficos";

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
    	<script type="text/javascript" src="js/lib/jquery.numeric.js"></script>
    	
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
                        <div class="">
                           <?php echo armarPasos($__pasoActual)?>
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
				<input type="hidden" id="txtIdTurno" name="txtIdTurno" value="<?php echo $txtIdTurno; ?>">
				<input type="hidden" id="hdnPermiso" name="hdnPermiso" value="<?php echo $permisos_modulo1; ?>">



<?php
?>				
				<div class="col-sm-12">
					<div class="subheading"></div>

					<div class="inner-padding">
					<?php if ($_SESSION['_biograficos']==1):?>
						<fieldset>
							<legend>Datos Biogr&aacute;ficos</legend>
<!--							<div class="row">
 									<div class="col-sm-3  text-right ">
										<label class="control-label txtTipoPersona">Tipo de persona</label>
									</div>
									<div class="col-sm-9">
										<div class="inline-labels">
											<label>
											<input name="gender"  checked="" id="radioTipoPersonaF"
												type="radio"><span></span> F&iacute;sica</label> 
												
												<label>
												<input name="gender" type="radio" id="radioTipoPersonaM"><span></span>
												Motal</label>
										</div>
									</div>
								</div>
								<div class="spacer-20"></div>
								<hr>
								<div class="spacer-30"></div>
	-->							
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label txtNombres" for="txtNombres">
														Primer nombre </label> 
								</div>
								<div class="col-sm-7">
								<input id="txtNombres"  class="form-control" type="text" maxlength="50" value="<?php echo $datosTab1['nombre'];?>"/>
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label txtNombres2" for="txtNombres2">
															Segundo nombre </label> 
								</div>
								<div class="col-sm-7">
								<input id="txtNombres2"  class="form-control" type="text" maxlength="50" value="<?php echo $datosTab1['nombre2'];?>"/>
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label txtApellidoPaterno"
														for="txtApellidoPaterno"> Apellido Paterno </label> 	
								</div>
								<div class="col-sm-7">
								<input  id="txtApellidoPaterno" name="txtApellidoPaterno"
														class="form-control" type="text" maxlength="50" value="<?php echo $datosTab1['apellidoP'];?>"/>
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label txtApellidoMaterno"
														for="txtApellidoMaterno"> Apellido Materno </label>
								</div>
								<div class="col-sm-7">
								<input id="txtApellidoMaterno" class="form-control" type="text" value="<?php echo $datosTab1['apellidoM'];?>"
														maxlength="50" />
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label txtNacimiento"
														for="txtNacimiento"> Fecha Nacimiento </label> 
								</div>
								<div class="col-sm-4">
								<input id="txtNacimiento" name="txtNacimiento"
														placeholder="AAAA-MM-DD" class="form-control" type="text" value="<?php echo $datosTab1['fechaNac'];?>"/>
								</div>
							</div>
							<div class="spacer-10"></div>
		<!--					
							<div class="row">
								<div class="col-sm-3 text-right">
								<label class="control-label txtRFC" for="txtRFC">RFC </label>
								</div>
								<div class="col-sm-7">
								<input id="txtRFC" class="form-control txtRFC" type="text" value="<?php echo $datosTab1['RFC'];?>" />
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
								<label class="control-label txtCURP" for="txtCURP">CURP </label>
								</div>
								<div class="col-sm-7">
								<input id="txtCURP" class="form-control txtCURP" type="text" value="<?php echo $datosTab1['CURP'];?>" />
								</div>
							</div>
			-->				<div class="spacer-20"></div>
								<hr>
							
							<div class="spacer-30"></div>
								
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label slcGenero" for="slcGenero">
														G&eacute;nero </label>
								</div>
								<div class="col-sm-4">
								<select id="slcGenero"  class="form-control">
														<option value="">Seleccione una opci&oacute;n</option>
														<option value="H" <?php echo ($datosTab1['sexo']=='H'?' selected ':' ');?>>Hombre</option>
														<option value="M" <?php echo ($datosTab1['sexo']=='M'?' selected ':' ');?>>Mujer</option>
													</select>
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label slcNacionalidad"
														for="slcNacionalidad"> Nacionalidad </label> 
								</div>
								<div class="col-sm-5">
								<select id="slcNacionalidad" class="form-control">
														<option value="">Seleccione una opci&oacute;n</option>
														<option value="mex" <?php echo ($datosTab1['nacionalidad']=='mex'?' selected ':' ');?>>Mexicana</option>
														<option value="ext" <?php echo ($datosTab1['nacionalidad']=='ext'?' selected ':' ');?>>Extranjero</option>
													</select>
								</div>
							</div>
							<!--
							<div class="spacer-10"></div>
							
								<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label slcIdentificacion"
														for="slcIdentificacion">Identificaci&oacute;n </label> 
								</div>
								<div class="col-sm-7">
								<select id="slcIdentificacion" class="form-control">
														<option value="">Seleccione una opci&oacute;n</option>
													</select>
								</div>
							</div>
						
						<div class="spacer-10"></div>
						
						<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label slcProfesion"
														for="slcProfesion">Profesi&oacute;n </label> 
								</div>
								<div class="col-sm-7">
								<select id="slcProfesion" class="form-control">
														<option value="">Seleccione una opci&oacute;n</option>
													</select>
								</div>
							</div>
						-->
						<div class="spacer-10"></div>
						
							
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label txtCorreoE"
										for="txtCorreoE"> Correo Electronico </label>
								</div>
								<div class="col-sm-7">
										<input type="text" name="txtCorreoE" id="txtCorreoE" value="<?php echo $datosTab1['email'];?>"
											class="form-control txtCorreoE ">
								</div>
							</div>
							<div class="spacer-10"></div>
								<hr>
								<div class="spacer-40"></div>
								<div class="row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-primary pull-right" id="btnGuardar1">Guardar</button>
									</div>
								</div>
							
							</fieldset>
							
							<div class="spacer-30"></div>
								<div class="row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-default pull-right" onclick="siguiente(2);">Siguiente</button>
									</div>
								</div>
							
							<?php
							endif;
							
							if ($_SESSION['_biograficos']==2):?>
							
							<fieldset>
								<legend>Domicilio Fiscal</legend>
							
							<div class="row">
								<div class="col-sm-3 text-right">
								<label class="control-label txtCP" for="txtCP">C&oacute;digo Postal </label>
								</div>
								<div class="col-sm-2">
								<input id="txtCP" class="form-control txtCP numeric2" maxlength="5" type="text" value="<?php echo $datosTab2['cp'];?>" />
								</div>
								<div class="col-sm-1">
								<button type="submit" class="btn btn-primary " id="btnBuscarCP">Buscar</button>
								</div>
								<div class="col-sm-1">
								<button type="submit" class="btn btn-default " id="btnLimpiar">Limpiar</button>
								</div>
								
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label slcEstadoDom" for="slcEstadoDom">
										Estado </label>
								</div>
								<div class="col-sm-7">
										<select id="slcEstadoDom" class="form-control" disabled="disabled">											
											<option value="28">Tamaluipas</option>
										</select>
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label slcMunicipioDomicilio "
										for="slcMunicipioDomicilio"> Municipio </label>
								</div>
								<div class="col-sm-7">
										<select id="slcMunicipioDomicilio" class="form-control">
											<?php echo $slcMunicipiosDom;?>
										</select>
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label slcLocalidad"
										for="slcLocalidad"> Localidad </label>
								</div>
								<div class="col-sm-7">
										<select id="slcLocalidad" class="form-control">
										<?php echo $slcLocDom;?>
										</select>
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label slcColonia"
										for="slcColonia"> Colonia</label>
								</div>
								<div class="col-sm-7">
										<select id="slcColonia" class="form-control">
										<?php echo $slcColonia;?>
										</select>
								</div>
							</div>
							
							<div class="spacer-20"></div>
								<hr>
							
							<div class="spacer-30"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label txtCalle" for="txtCalle">
										Calle </label>
								</div>
								<div class="col-sm-7">
										<input type="text" name="txtCalle" id="txtCalle" value="<?php echo $datosTab2['calle'];?>"
											class="form-control txtCalle ">
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label txtNumExt" for="txtNumExt">
										Numero Externo </label>
								</div>
								<div class="col-sm-3">
										<input type="text" name="txtNumExt" id="txtNumExt" value="<?php echo $datosTab2['numExt'];?>"
											class="form-control txtNumExt numeric2">
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label txtNumInt" for="txtNumInt">
										Numero Interno </label>
								</div>
								<div class="col-sm-3">
										<input type="text" name="txtNumInt" id="txtNumInt" value="<?php echo $datosTab2['numInt'];?>"
											class="form-control txtNumInt numeric2 ">
								</div>
							</div>
							<div class="spacer-10"></div>
							<!--
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label txtCalle1" for="txtCalle1">
										Entre la Calle </label>
								</div>
								<div class="col-sm-7">
										<input type="text" name="txtCalle1" id="txtCalle1" value="<?php echo $datosTab3['calle1'];?>"
											class="form-control txtCalle2 ">
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label txtCalle2" for="txtCalle2">
										y la Calle </label>
								</div>
								<div class="col-sm-7">
										<input type="text" name="txtCalle2" id="txtCalle2" value="<?php echo $datosTab3['calle2'];?>"
											class="form-control txtCalle2">
								</div>
							</div>
							
							<div class="spacer-20"></div>
								<hr>
							
							<div class="spacer-30"></div>
							-->
							
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label txtTelefono"
										for="txtTelefono"> Telefono (casa)</label>
								</div>
								
								<div class="col-sm-5">
								<div class="col-sm-2">
								<input id="txtCodPais" class="form-control txtCodPais numeric2" maxlength="2" value="<?php echo $datosTab2['codPais'];?>" />
								<div class="helper-text-box"><p>C&oacute;digo de pa&iacute;s</p></div>
								</div>
								<div class="col-sm-1">
								<label>-</label>
								</div>
								<div class="col-sm-3">
								<input id="txtLada" class="form-control txtLada numeric2" maxlength="3" value="<?php echo $datosTab2['lada'];?>" />
								<div class="helper-text-box"><p>Lada</p></div>
								</div>
								<div class="col-sm-1">
								<label>-</label>
								</div>
								<div class="col-sm-4">
								<input id="txtTelefono" class="form-control txtTelefono numeric2" maxlength="8" value="<?php echo $datosTab2['telCasa'];?>" />
								<div class="helper-text-box"><p>N&uacute;mero</p></div>
								</div>
								</div>
							
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label txtTelefono"
										for="txtTelefono"> Telefono  (m&oacute;vil)</label>
								</div>
								<div class="col-sm-7">
										<input type="text" name="txtTelefonoMobil" id="txtTelefonoMobil" value="<?php echo $datosTab2['telMovil'];?>"
											class="form-control txtTelefonoMobil  numeric2" maxlength="10"> 
								</div>
							</div>
							<div class="spacer-10"></div>
								<hr>
								<div class="spacer-40"></div>
								<div class="row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-primary pull-right" id="btnGuardar2">Guardar</button>
									</div>
								</div>
							
							</fieldset>
							
							<div class="spacer-30"></div>
								<div class="row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-default pull-right" onclick="siguiente(3);">Siguiente</button>
									</div>
								</div>
							
							<?php
							endif;
							
							if ($_SESSION['_biograficos']==3):?>
							
							<fieldset>
								<legend>Informaci&oacute;n Licencia</legend>
							<!--
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label slcTipoLicencia"
										for="slcTipoLicencia"> Tipo de Licencia</label>
								</div>
								<div class="col-sm-7">
										<select id="slcTipoLicencia" class="form-control">
										<?php echo $slcTipoLicencia;?>
										</select>
								</div>
							</div>
							
							<div class="spacer-10"></div>
							-->
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label slcColorOjos"
														for="slcColorOjos"> Color de ojos </label>
								</div>
								<div class="col-sm-4">
								 <select id="slcColorOjos" name="slcColorOjos"
														class="form-control ">
											<?php echo $slcListadosOjos;?>
										</select>
								</div>
							</div>
							<div class="spacer-10"></div>
		<!-- 					
							<div class="row">
								<div class="col-sm-3 text-right"> 
													<label class="control-label slcColorPelo"
														for="slcColorPelo"> Color de pelo </label>
								</div>
								<div class="col-sm-4">
								 <select		id="slcColorPelo" class="form-control">
											<?php echo $slcListadosPelo; ?>
										</select>
								</div>
							</div>
							
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label slcColorPiel"
										for="slcColorPiel"> Color de Piel</label>
								</div>
								<div class="col-sm-4">
										<select id="slcColorPiel" class="form-control">
										<?php echo $slcColorPiel;?>
										</select>
								</div>
							</div>
							
							<div class="spacer-20"></div>
								<hr>
							
							<div class="spacer-30"></div>
			 -->				
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label slcTipoSandre"
														for="slcTipoSandre"> Tipo Sangre </label> 
								</div>
								<div class="col-sm-4">
								<select id="slcTipoSandre" class="form-control">
											<?php echo $slcListadosSangre;?>
										</select>
								
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label txtPesoKG" for="txtPesoKG">
														Peso </label> 
								</div>
								<div class="col-sm-3">
								<input type="text" name="txtPesoKG"
														id="txtPesoKG" class="form-control txtPesoKG  numeric " value="<?php echo $datosTab3['peso'];?>"
														placeholder="Kg" value="" maxlength="5">
												</div>
								
								</div>
							
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label txtEstatura" for="txtEstatura">
														Estatura </label> 
								</div>
								<div class="col-sm-3">
								<input type="text" name="txtEstatura"
														id="txtEstatura" class="form-control txtEstatura  numeric " value="<?php echo $datosTab3['estatura'];?>"
														placeholder="metros" value="" maxlength="5">
												</div>
								
								</div>
							
							<!--
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
									<label class="control-label slcAlergias"
										for="slcAlergias">Alergia</label>
								</div>
								<div class="col-sm-7">
										<select id="slcAlergias" class="form-control">
										<?php echo $slcAlergias;?>
										</select>
								</div>
							</div>
							-->
							<div class="spacer-10"></div>
							
							
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label txtParticulares"
														for="txtParticulares"> Se&ntilde;as Particulares </label>
								</div>
								<div class="col-sm-7">
													<textarea class="form-control" rows="6"
														id="txtParticulares"
														placeholder="Indique  cicatrices,  bigote etc." 
														maxlength="50">
														<?php echo $datosTab3['extras'];?>
														</textarea>
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
									<div class="col-sm-3  text-right">
										<label class="control-label txtOrganos">Donador de &Oacute;rganos</label>
									</div>
									<div class="col-sm-9">
										<div class="inline-labels">
											<label>
											<input name="gender" checked
												type="radio"><span></span> Si
											</label> 
												<label>
												<input name="gender" type="radio"><span></span>No
												</label> 
												
										</div>
									</div>
								</div>
								<div class="spacer-10"></div>
							
								<hr>
								<div class="spacer-40"></div>
								<div class="row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-primary pull-right" id="btnGuardar3">Guardar</button>
									</div>
								</div>
							
							</fieldset>
							
							<div class="spacer-30"></div>
								<div class="row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-default pull-right" onclick="siguiente(4);">Siguiente</button>
									</div>
								</div>
							
							<?php
							endif;
							
							if ($_SESSION['_biograficos']==4):?>
							
							<fieldset>
								<legend>Persona Contacto</legend>
							
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label txtNombreContacto" for="txtNombreContacto">
														Nombre </label> 
								</div>
								<div class="col-sm-7">
								<input id="txtNombreContacto"  class="form-control" type="text" maxlength="50" value="<?php echo $datosTab4['nombre'];?>"/>
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label txtApellidoPaternoContacto"
														for="txtApellidoPaternoContacto"> Apellido Paterno </label> 	
								</div>
								<div class="col-sm-7">
								<input  id="txtApellidoPaternoContacto" name="txtApellidoPaternoContacto"
														class="form-control" type="text" maxlength="50" value="<?php echo $datosTab14['apellidoP'];?>"/>
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
													<label class="control-label txtApellidoMaternoContacto"
														for="txtApellidoMaternoContacto"> Apellido Materno </label>
								</div>
								<div class="col-sm-7">
								<input id="txtApellidoMaternoContacto" class="form-control" type="text" value="<?php echo $datosTab4['apellidoM'];?>"
														maxlength="50" />
								</div>
							</div>
							<div class="spacer-10"></div>
							
							<div class="row">
								<div class="col-sm-3 text-right">
								<label class="control-label txtTelContacto" for="txtTelContacto">Tel&eacute;fono </label>
								</div>
								<div class="col-sm-5">
								<div class="col-sm-2">
								<input id="txtCodPaisCont" class="form-control txtCodPaisCont"  value="<?php echo $datosTab4['codPais'];?>" />
								<div class="helper-text-box"><p>C&oacute;digo de pa&iacute;s</p></div>
								</div>
								<div class="col-sm-1">
								<label>-</label>
								</div>
								<div class="col-sm-2">
								<input id="txtLadaCont" class="form-control txtLadaCont" value="<?php echo $datosTab4['lada'];?>" />
								<div class="helper-text-box"><p>Lada</p></div>
								</div>
								<div class="col-sm-1">
								<label>-</label>
								</div>
								<div class="col-sm-4">
								<input id="txtTelCont" class="form-control txtTelCont"  value="<?php echo $datosTab4['telCasa'];?>" />
								<div class="helper-text-box"><p>N&uacute;mero</p></div>
								</div>
								</div>
							</div>
								<div class="spacer-10"></div>
							
								<hr>
								<div class="spacer-40"></div>
								<div class="row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-primary pull-right" id="btnGuardar4">Guardar</button>
									</div>
								</div>
							
							</fieldset>
							
							<div class="spacer-30"></div>
								<div class="row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-default pull-right" onclick="siguiente(5);">Siguiente</button>
									</div>
								</div>
							
							<?php
							endif;
							?>
							
							<div class="spacer-40"></div>
							
														
														
														
														
														
														
														
														
													
					</div>
							<div class="inner-padding">

						<div class="col-sm-12">
						
							<div class="inner-padding form-horizontal">


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
						<button class="btn btn-primary" data-dismiss="modal"
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