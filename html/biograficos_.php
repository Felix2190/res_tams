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
				<input type="hidden" id="txtIdTurno" name="txtIdTurno" value="<?php echo $txtIdTurno; ?>">
				<input type="hidden" id="hdnPermiso" name="hdnPermiso" value="<?php echo $permisos_modulo1; ?>">



<?php
?>				
				<div class="col-sm-12">
					<div class="subheading"></div>

					<div class="inner-padding">

						<div class="col-sm-12">
                                <ul class="ext-tabs">
                                    <li class="<?php echo ($tabActivo=='1'?' active ':' ');?>">
                                        <a href="#content-tab-7-a ">Informaci&oacute;n General</a>
                                    </li>
                                    <li class="<?php echo ($tabActivo=='2'?' active ':' ');?>">
                                        <a href="#content-tab-7-b ">Media Filaci&oacute;n</a>
                                    </li>
                                    <li class="<?php echo ($tabActivo=='3'?' active ':' ');?>">
                                       <a href="#content-tab-7-c ">Domicilio</a>
                                    </li>          
                                    <li class="<?php echo ($tabActivo=='4'?' active ':' ');?>">
                                        <a href="#content-tab-7-d ">Contacto de Emergencia</a>
                                    </li>
                                   	<li class="<?php echo ($tabActivo==''?' active ':' ');?>">
                                        <a href="#content-tab-7-e ">Extra</a>
                                    </li>          
                                </ul><!-- End .ext-tabs -->
                                <div class="tab-content ext-tabs-boxed">
								<div id="content-tab-7-a" class="tab-pane <?php echo ($tabActivo=='1'?' active ':' ');?>">
									<div class="inner-padding">
									<div id="divMsjTab1" style="display: ;" class="col-sm-12">
											<div class="<?php echo $classTab1;?>">
												<button type="button" class="close" data-dismiss="alert">x</button>
												<p id="tab1Msj"> <i class="<?php echo $imagenTab1;?>"></i>  <?php echo $msjTab1;?> </p>
											</div>
										</div>
									
										<div class="spacer-10"></div>
										
										<div class="col-sm-5">

											<div class="subheading">
												<h3>Datos personales</h3>
											</div>

											<div class="row">
												<div class="col-sm-12">
													<label class="control-label txtApellidoPaterno"
														for="txtApellidoPaterno"> Apellido Paterno </label> <input
														id="txtApellidoPaterno" name="txtApellidoPaterno"
														class="form-control" type="text" maxlength="50" value="<?php echo $datosTab1['apellidoP'];?>"/>
												</div>
												<div class="spacer-10"></div>
												<div class="col-sm-12">
													<label class="control-label txtApellidoMaterno"
														for="txtApellidoMaterno"> Apellido Materno </label> <input
														id="txtApellidoMaterno" class="form-control" type="text" value="<?php echo $datosTab1['apellidoM'];?>"
														maxlength="50" />
												</div>
												
												<div class="spacer-10"></div>
												
												<div class="col-sm-12">
													<label class="control-label txtNombres" for="txtNombres">
														Nombres </label> <input id="txtNombres"
														class="form-control" type="text" maxlength="50" value="<?php echo $datosTab1['nombre'];?>"/>
												</div>
												
												<div class="spacer-10"></div>

												<div class="col-sm-6">
													<label class="control-label slcGenero" for="slcGenero">
														G&eacute;nero </label> <select id="slcGenero"
														class="form-control">
														<option value="">Seleccione una opci&oacute;n</option>
														<option value="H" <?php echo ($datosTab1['sexo']=='H'?' selected ':' ');?>>Hombre</option>
														<option value="M" <?php echo ($datosTab1['sexo']=='M'?' selected ':' ');?>>Mujer</option>
													</select>
												</div>
											</div>

										</div>
										<!-- 	<span class="ext-raster-line-5"></span> -->
										<div class="col-sm-7">

											<div class="subheading">
												<h3>Nacimiento</h3>
											</div>

											<div class="row">
												<div class="col-sm-6">
													<label class="control-label slcNacionalidad"
														for="slcNacionalidad"> Nacionalidad </label> <select
														id="slcNacionalidad" class="form-control">
														<option value="">Seleccione una opci&oacute;n</option>
														<option value="mex" <?php echo ($datosTab1['nacionalidad']=='mex'?' selected ':' ');?>>Mexicana</option>
														<option value="ext" <?php echo ($datosTab1['nacionalidad']=='ext'?' selected ':' ');?>>Extrangero</option>

													</select>
												</div>

												<div class="col-sm-6">
													<label class="control-label slcEntidadNac"
														for="slcEntidadNac"> Entidad </label> <select
														id="slcEntidadNac" class="form-control">											
											<?php echo $slcEstados;?>
										</select>
												</div>

												<div class="spacer-10"></div>

												<div class="col-sm-6">
													<label class="control-label slcMunicipioNac"
														for="slcMunicipioNac"> Municipio </label> <select
														id="slcMunicipioNac" name="slcMunicipioNac"
														class="form-control">
														<?php echo $slcMunicipios;?>
													</select>
												</div>

												<div class="spacer-20"></div>

												<div class="col-sm-6">

													<label class="control-label txtNacimiento"
														for="txtNacimiento"> Fecha Nacimiento </label> <input
														id="txtNacimiento" name="txtNacimiento"
														placeholder="AAAA-MM-DD" class="form-control" type="text" value="<?php echo $datosTab1['fechaNac'];?>"/>
												</div>
											</div>


										</div>
									</div>


									<div class="inner-padding">
										<div class="btn-group pull-right nomargin">
											<button class="btn btn-primary" id="btnGuardarTab1"
												name="btnGuardarTab1">Guardar</button>

										</div>
										
									</div>


								</div>

								<div id="content-tab-7-b" class="tab-pane <?php echo ($tabActivo=='2'?' active ':' ');?>">  
                                        <div class="inner-padding" >
										
										<div id="divMsjTab2" style="display: ;" class="col-sm-12">
											<div class="<?php echo $classTab2;?>">
												<button type="button" class="close" data-dismiss="alert">x</button>
												<p id="tab2Msj"><i class="<?php echo $imagenTab2;?>"></i>  <?php echo $msjTab2;?> </p>
											</div>
										</div>
										
									<div class="spacer-10"></div>
								<div class="col-sm-6">
											<div class="subheading">
												<h3>Caracter&iacute;sticas</h3>
											</div>


											<div class="row">
												<div class="col-sm-12">
													<label class="control-label slcColorOjos"
														for="slcColorOjos"> Color de ojos </label> <select
														id="slcColorOjos" name="slcColorOjos"
														class="form-control ">
											<?php echo $slcListadosOjos;?>
										</select>
												</div>
												<div class="spacer-10"></div>
												<div class="col-sm-12">
													<label class="control-label slcColorPelo"
														for="slcColorPelo"> Color de pelo </label> <select
														id="slcColorPelo" class="form-control">
											<?php echo $slcListadosPelo; ?>
										</select>
												</div>
												<div class="spacer-10"></div>
												<div class="col-sm-6">
													<label class="control-label slcTipoSandre"
														for="slcTipoSandre"> Tipo Sangre </label> <select
														id="slcTipoSandre" class="form-control">
											<?php echo $slcListadosSangre;?>
										</select>
												</div>
												<div class="col-sm-5">
													<br /> <input type="checkbox" name="chkImprimeTipoSangre"
														value="1" checked> <label for="slcTipoSandre"
														class="slcTipoSandre"> Imprime </label>
												</div>

												

											</div>
										</div>

										<div class="col-sm-6">
										
											
										<div class="spacer-50"></div>
											<div class="spacer-30"></div>
											
											<div class="row">
												<div class="col-sm-6">

													<label class="control-label txtPesoKG" for="txtPesoKG">
														Peso </label> <input type="text" name="txtPesoKG"
														id="txtPesoKG" class="form-control txtPesoKG  numeric " value="<?php echo $datosTab2['peso'];?>"
														placeholder="Kg" value="" maxlength="5">
												</div>

												<div class="spacer-10"></div>

												<div class="col-sm-12">
													<label class="control-label txtParticulares"
														for="txtParticulares"> Se&ntilde;as Particulares </label>

													<textarea class="form-control" rows="6"
														id="txtParticulares"
														placeholder="Indique  cicatrices,  bigote etc." 
														maxlength="50">
														<?php echo $datosTab2['extras'];?>
														</textarea>
												</div>
											</div>
											
											<div class="spacer-50"></div>
											<div class="spacer-50"></div>
											
											<div class="btn-group pull-right nomargin" style="display: <?php echo (isset($_SESSION['idPersonaBio'])?' ':'none;')?>">
											<button class="btn btn-primary" id="btnGuardarTab2"
												name="btnGuardarTab2">Guardar</button>

											</div>
										

										</div>

									</div>
                                    </div>
                                    <div id="content-tab-7-c" class="tab-pane <?php echo ($tabActivo=='3'?' active ':' ');?>">
                                    	<div class="inner-padding">
                                    	
                                    	<div id="divMsjTab3" style="display: ;" class="col-sm-12">
											<div class="<?php echo $classTab3;?>">
												<button type="button" class="close" data-dismiss="alert">x</button>
												<p id="tab3Msj"> <i class="<?php echo $imagenTab3;?>"></i> <?php echo $msjTab3;?> </p>
											</div>
										</div>
									
									<div class="spacer-10"></div>
								<div class="col-sm-6">

											<div class="subheading">
												<h3>Direcci&oacute;n</h3>
											</div>
											
							<div class="row">
							<div class="col-sm-6">
									<label class="control-label slcEstadoDom" for="slcEstadoDom">
										Estado </label>
										<select id="slcEstadoDom" class="form-control">											
											<?php echo $slcEstadosDom;?>
										</select>
									</div>
									
									<div class="col-sm-6">
									<label class="control-label slcMunicipioDomicilio "
										for="slcMunicipioDomicilio"> Municipio </label>
										<select id="slcMunicipioDomicilio" class="form-control">
											
											<?php echo $slcMunicipiosDom;?>
										</select>
									</div>
									
									<div class="spacer-10"></div>
									
									<div class="col-sm-12">
									<label class="control-label slcLocalidad"
										for="slcLocalidad"> Localidad </label>
										<select id="slcLocalidad" class="form-control">
										<?php echo $slcLocDom;?>
										</select>
									</div>
								
								<div class="spacer-10"></div>
								
								<div class="col-sm-12">
									<label class="control-label txtCalle" for="txtCalle">
										Calle </label>
										<input type="text" name="txtCalle" id="txtCalle" value="<?php echo $datosTab3['calle'];?>"
											class="form-control txtCalle ">

									</div>
									
									<div class="spacer-10"></div>
									
									<div class="col-sm-6">
									<label class="control-label txtNumExt" for="txtNumExt">
										Numero Externo </label>
										<input type="text" name="txtNumExt" id="txtNumExt" value="<?php echo $datosTab3['numExt'];?>"
											class="form-control txtNumExt numeric2">

									</div>

									<div class="col-sm-6">
									<label class="control-label txtNumInt" for="txtNumInt">
										Numero Interno </label>
										<input type="text" name="txtNumInt" id="txtNumInt" value="<?php echo $datosTab3['numInt'];?>"
											class="form-control txtNumInt numeric2 ">

									</div>
								</div>

								
											
											
										</div>
										
										
										<div class="col-sm-6">

										<div class="spacer-50"></div>
											<div class="spacer-30"></div>
											
								<div class="row">
								<div class="col-sm-12">
									<label class="control-label txtColonia"
										for="txtColonia"> Colonia </label>

										<input type="text" name="txtColonia" id="txtColonia" value="<?php echo $datosTab3['colonia'];?>"
											class="form-control txtColonia ">

									</div>
									<div class="spacer-10"></div>
									
									<div class="col-sm-6">
									
									<label class="control-label txtCP" for="txtCP"> Codigo
										Postal </label>
											<input type="text" name="txtCP" id="txtCP" value="<?php echo $datosTab3['cp'];?>"
											class="form-control txtCP  numeric2" maxlength="5">

									</div>
									
									<div class="spacer-10"></div>
									
									<div class="col-sm-6">
									<label class="control-label txtTelefono"
										for="txtTelefono"> Telefono (casa)</label>
										<input type="text" name="txtTelefono" id="txtTelefono" value="<?php echo $datosTab3['telCasa'];?>"
											class="form-control txtTelefono  numeric2" maxlength="10">

									</div>
									
								<div class="col-sm-6">
									<label class="control-label txtTelefono"
										for="txtTelefono"> Telefono  (m&oacute;vil)</label>
										<input type="text" name="txtTelefonoMobil" id="txtTelefonoMobil" value="<?php echo $datosTab3['telMovil'];?>"
											class="form-control txtTelefonoMobil  numeric2" maxlength="10"> 

									</div>
									
									<div class="spacer-10"></div>
								
								<div class="col-sm-12">
									<label class="control-label txtCorreoE"
										for="txtCorreoE"> Correo Electronico </label>
										
										<input type="text" name="txtCorreoE" id="txtCorreoE" value="<?php echo $datosTab3['email'];?>"
											class="form-control txtCorreoE ">

									</div>
									
									<div class="spacer-10"></div>
									
									<div class="col-sm-12">
										<input type="checkbox" name="txtComprobanteANombre" value="1"
											checked>
										<label class="control-label txtComprobanteANombre"
										for="txtComprobanteANombre"> Comprobante a su nombre </label>

									</div>
									
									
											<div class="spacer-50"></div>
											
											<div class="btn-group pull-right nomargin" style="display: <?php echo (isset($_SESSION['idPersonaBio'])?' ':'none;')?>">
											<button class="btn btn-primary" id="btnGuardarTab3"
												name="btnGuardarTab3">Guardar</button>

											</div>
										
										
								</div>
								
										</div>
										
                                       </div>
                                   </div>
                                   <div id="content-tab-7-d" class="tab-pane <?php echo ($tabActivo=='4'?' active ':' ');?>">  
                                        <div class="inner-padding">
                                        
                                        <div id="divMsjTab" style="display: ;" class="col-sm-12">
											<div class="<?php echo $classTab4;?>">
												<button type="button" class="close" data-dismiss="alert">x</button>
												<p id="tab4Msj"> <i class="<?php echo $imagenTab4;?>"></i>  <?php echo $msjTab4;?> </p>
											</div>
										
										</div>
								
                                        <div class="spacer-10"></div>
								<div class="col-sm-6">
										
											<div class="subheading">
												<h3>Informaci&oacute;n de contacto</h3>
											</div>
											
							<div class="row">
								<div class="col-sm-12">
									<label class="control-label txtNombreContacto"
										for="txtNombreContacto">Nombre </label>
											<input type="text" name="txtNombreContacto" id="txtNombreContacto" value="<?php echo $datosTab4['nombre'];?>"
											class="form-control txtNombreContacto ">
									</div>
								
								<div class="spacer-10"></div>
								
								<div class="col-sm-6">
									<label class="control-label slParentezcoContacto"
										for="slParentezcoContacto"> Parentezco </label>
										<select id="slParentezcoContacto" class="form-control">
											<?php echo $slcListadosParentezco;?>
										</select>
									</div>
								
								<div class="spacer-10"></div>
									
									<div class="col-sm-6">
									<label class="control-label slcEstadoContacto"
										for="slcEstadoContacto"> Estado </label>
										<select id="slcEstadoContacto" class="form-control">											
											<?php echo $slcEstadosContacto;?>
										</select>
									</div>
									
									<div class="col-sm-6">
									<label class="control-label slcMunicipioContacto"
										for="slcMunicipioContacto"> Municipio </label>
										<select id="slcMunicipioContacto" class="form-control">
											<?php echo $slcMunicipiosContacto;?>
										</select>
									</div>
								
								<div class="spacer-10"></div>
									
									<div class="col-sm-12">
									<label class="control-label slcLocalidadContacto"
										for="slcLocalidadContacto"> Localidad </label>
										<select id="slcLocalidadContacto" class="form-control">
											<?php echo $slcLocContacto;?>
										</select>
									</div>
								
								<div class="spacer-10"></div>
									
									<div class="col-sm-12">
									<label class="control-label txtCalleContacto"
										for="txtCalleContacto"> Calle </label>
										<input type="text" name="txtCalleContacto" id="txtCalleContacto" value="<?php echo $datosTab4['calle'];?>"
											class="form-control txtCalleContacto ">
									</div>
								
								<div class="spacer-10"></div>
									
									<div class="col-sm-6">
									<label class="control-label txtNumExtContacto"
										for="txtNumExtContacto"> Numero Externo </label>
										<input type="text" name="txtNumExtContacto" value="<?php echo $datosTab4['numExt'];?>"
											id="txtNumExtContacto"
											class="form-control txtNumExtContacto  numeric2">
									</div>
									
									<div class="col-sm-6">
									<label class="control-label txtNumIntContacto"
										for="txtNumIntContacto"> Numero Interno </label>
										<input type="text" name="txtNumIntContacto" value="<?php echo $datosTab4['numInt'];?>"
											id="txtNumIntContacto"
											class="form-control txtNumIntContacto  numeric2">
									</div>
								</div>
											
											
										</div>
										
										<div class="col-sm-6">
											<div class="spacer-50"></div>
											<div class="spacer-30"></div>
								
								<div class="row">		
								<div class="col-sm-6">
									<label class="control-label txtColoniaContacto"
										for="txtColoniaContacto"> Colonia </label>
										<input type="text" name="txtColoniaContacto" value="<?php echo $datosTab4['colonia'];?>"
											id="txtColoniaContacto"
											class="form-control txtColoniaContacto ">
								</div>
								
								<div class="spacer-10"></div>
								
								<div class="col-sm-6">
									<label class="control-label txtCPContacto"
										for="txtCPContacto"> Codigo Postal </label>
										<input type="text" name="txtCPContacto" id="txtCPContacto" value="<?php echo $datosTab4['cp'];?>"
											class="form-control txtCPContacto  numeric2" maxlength="5">
									</div>
								
								<div class="spacer-10"></div>
									
									<div class="col-sm-6">
									<label class="control-label txtTelefonoContacto"
										for="txtTelefonoContacto"> Telefono </label>
										<input type="text" name="txtTelefonoContacto" id="txtTelefonoContacto" value="<?php echo $datosTab4['tel'];?>"
											class="form-control txtTelefonoContacto  numeric2" maxlength="10">
									</div>
								
								<div class="spacer-10"></div>
									
									<div class="col-sm-12">
									<label class="control-label txtObservacionesContacto"
										for="txtObservacionesContacto"> Observaciones </label>
												<textarea class="form-control" rows="3"
											id="txtObservacionesContacto"
											placeholder="Observaciones del contacto." maxlength="100"><?php echo $datosTab4['observaciones'];?></textarea>

									</div>

											<div class="spacer-50"></div>
											
											<div class="btn-group pull-right nomargin" style="display: <?php echo (isset($_SESSION['idPersonaBio'])?' ':'none;')?>">
											<button class="btn btn-primary" id="btnGuardarTab4"
												name="btnGuardarTab4">Guardar</button>

											</div>
								
								</div>
										                   
                                        </div>
                                        </div>
                                    </div>
                                    <div id="content-tab-7-e" class="tab-pane <?php echo ($tabActivo=='5'?' active ':' ');?>">
                                    	<div class="inner-padding">
                                    	
                                    	<div id="divMsjTab5" style="display: ;" class="col-sm-12">
											<div class="<?php echo $classTab5;?>">
												<button type="button" class="close" data-dismiss="alert">x</button>
												<p id="tab5Msj"> <i class="<?php echo $imagenTab5;?>"></i> <?php echo $msjTab5;?> </p>
											</div>
										</div>
								
								
								<div class="spacer-10"></div>
								
                                    	<div class="col-sm-6">

											<div class="subheading">
												<h3>Jubilaci&oacute;n</h3>
											</div>
											
						<div class="row">
								<div class="col-sm-6">
									<label class="control-label chkEsJubilado"
										for="chkEsJubilado"> Jubilado </label>
										<input type="checkbox" name="chkEsJubilado" id="chkEsJubilado" value="jubilado" <?php echo ($datosTab5['jubilado']==1?'checked':'')?>>
									</div>
									
									<div class="spacer-10"></div>
									
								<div class="col-sm-12">
									<label class="control-label slcInstitucionjubilacion"
										for="slcInstitucionjubilacion"> Instituci&oacute;n </label>
										<select id="slcInstitucionjubilacion" class="form-control">
											<option value="">Seleccione una opci&oacute;n</option>
											<option value="1" <?php echo ($datosTab5['institucion']=='1'?' selected ':' ');?>>DIF</option>
										</select>
									</div>
									
									<div class="spacer-10"></div>
									
									<div class="col-sm-6">
											<label class="control-label txtNumJubilado"
										for="txtNumJubilado"> Numero </label>
									<input type="text" name="txtNumJubilado" id="txtNumJubilado" value="<?php echo $datosTab5['numero'];?>"
											class="form-control txtNumJubilado  numeric2">
									</div>
									
									<div class="spacer-10"></div>
									
									<div class="col-sm-6">
									<label class="control-label txtFechaAfiliacion"
										for="txtFechaAfiliacion"> Fecha Afiliaci&oacute;n </label>
										<input id="txtFechaAfiliacion" name="txtFechaAfiliacion" value="<?php echo $datosTab5['fechaAfiliacion'];?>"
											placeholder="AAAA-MM-DD" class="form-control" type="text" />
									</div>
								</div>
											
										</div>
										
                                    	<div class="col-sm-6">

											<div class="subheading">
												<h3>Requerimientos especiales</h3>
											</div>
								
							<div class="row">		
							

												<div class="col-sm-6">
													<label class="control-label slcEstadoCivil" for="slcEdoCivil">
														Estado civil </label> <select id="slcEstadoCivil"
														class="form-control">
														<?php echo $slcEdoCivil;?>
													</select>
												</div>
							<div class="spacer-10"></div>						
								<div class="col-sm-12">
									<input type="checkbox" name="chkLentes" value="1" id="chkLentes" <?php echo ($datosTab5['lentes']==1?'checked':'')?>>
									<label class="control-label chkLentes" for="chkLentes"> Usa
										Lentes </label>
									</div>
									
									<div class="spacer-10"></div>
									
									<div class="col-sm-12">
									<input type="checkbox" name="chkOrganos" value="1" id="chkOrganos" <?php echo ($datosTab5['organos']==1?'checked':'')?>>
									<label class="control-label chkOrganos" for="chkOrganos"> Dona
										&Oacute;rganos </label>
									</div>
									
									<div class="spacer-10"></div>
									
									<div class="col-sm-12">
										<input type="checkbox" name="chkTransmisionAUtomatica" id="chkTransmisionAUtomatica" <?php echo ($datosTab5['transmicion']==1?'checked':'')?>
											value="1">
									 	<label class="control-label chkTransmisionAUtomatica"
										for="chkTransmisionAUtomatica"> Usa solo trasnmision
										automatica </label>

									</div>
									
									<div class="spacer-10"></div>
									
									<div class="col-sm-12">
									<input type="checkbox" name="chkVehiculoDiscapacitado" id="chkVehiculoDiscapacitado" <?php echo ($datosTab5['vehiculo']==1?'checked':'')?>
											value="1">
									<label class="control-label chkVehiculoDiscapacitado"
										for="chkVehiculoDiscapacitado"> Vehiculo equipado para
										conductor discapacitado </label>
									</div>
									
									<div class="spacer-10"></div>
									
									<div class="col-sm-12">
									<input type="checkbox" name="chkProtesis" value="1" id="chkProtesis" <?php echo ($datosTab5['protesis']==1?'checked':'')?>>
									<label class="ontrol-label chkProtesis" for="chkProtesis">
										Vehiculo equipado para conductor con protesis </label>										
									</div>
								
										<div class="spacer-30"></div>
											
											<div class=" pull-right nomargin" style="display: <?php echo (isset($_SESSION['idFilacion'])?' ':'none;')?>">
												<button class="btn btn-warning" id="btnCancelar"
												name="btnCancelar">Cancelar</button>
											<button class="btn btn-primary" id="btnGuardarTab5"
												name="btnGuardarTab5">Guardar</button>
												<?php if (isset($tabTodo)) :
												 ?>
											<button class="btn btn-success" id="btnGuardarTabTodo"
												name="btnGuardarTabTodo">Guardar todo</button>
												<?php endif;?>

											</div>
								
								</div>
									
								</div>
								
                                       </div>
                                   </div>
                                </div><!-- End .tab-content --> 
                            </div>
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