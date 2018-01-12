<?php
	require("masterIncludeLogin.inc.php");
	$route = 'menu_inventario';
	$submenu = 'sub_busquedaProductos';	
?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="ie ie6 lte9 lte8 lte7 no-js"> <![endif]-->
<!--[if IE 7]>     <html class="ie ie7 lte9 lte8 lte7 no-js"> <![endif]-->
<!--[if IE 8]>     <html class="ie ie8 lte9 lte8 no-js">      <![endif]-->
<!--[if IE 9]>     <html class="ie ie9 lte9 no-js">           <![endif]-->
<!--[if gt IE 9]>  <html class="no-js">                       <![endif]-->
<!--[if !IE]><!--> <html class="no-js">                       <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Alta producto/servicio</title>

    <!-- // IOS webapp icons // -->
    
    <meta name="apple-mobile-web-app-title" content="Karma Webapp">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="images/mobile/apple-touch-icon-152x152.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/mobile/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="images/mobile/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/mobile/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="images/mobile/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/mobile/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" href="images/mobile/apple-touch-icon.png" />
    <link rel="shortcut icon" href="images/favicons/favicon.ico" />
    
    <!-- // IOS webapp splash screens // -->
    
    <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)"
          href="/images/mobile/apple-touch-startup-image-1536x2008.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)"
          href="/images/mobile/apple-touch-startup-image-1496x2048.png"/>     
 	<link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)"
          href="/images/mobile/apple-touch-startup-image-768x1004.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)"
          href="/images/mobile/apple-touch-startup-image-748x1024.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" 
          href="/images/mobile/apple-touch-startup-image-640x1096.png"/>    
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)"
          href="/images/mobile/apple-touch-startup-image-640x920.png"/>    
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)"
          href="/images/mobile/apple-touch-startup-image-320x460.png"/>    
    
    <!-- // Windows 8 tile // -->
    <meta name="application-name" content="Unifica">
    <meta name="msapplication-TileColor" content="#333333" />
	<meta name="msapplication-TileImage" content="images/mobile/windows8-icon.png" />

    <!-- // Handheld devices misc // -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="HandheldFriendly" content="true"/>   
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
    
    <!-- // Stylesheets // -->
    <link rel="stylesheet" href="bootstrap/core/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="bootstrap/typeahead/typeahead.min.css"/>
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-custom.css"/>
    <link rel="stylesheet" href="css/bootstrap-extended.css"/>
    <link rel="stylesheet" href="css/animate.min.css"/>
    <link rel="stylesheet" href="css/helpers.css"/>
    <link rel="stylesheet" href="css/base.css"/>
    <link rel="stylesheet" href="css/light-theme.css"/>
    <link rel="stylesheet" href="css/mediaqueries.css"/>   
     <style>
		 input[type="text"].isError,select.isError
	    {
	    	color:#b94a48;
	    	border-color:#b94a48;	    	
	    }

	    input[type="text"].isOk
	    {
	    	color:#468847;
	    	border-color:#468847;
	    }

    </style>
			     
    
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
    
    <script src="js/lib/jquery.formatCurrency-1.4.0.js"></script>
	    <script src="js/lib/i18n/jquery.formatCurrency.es-MX.js"></script>
    	<script type="text/javascript" src="js/lib/jquery.numeric.js"></script>
    	
    	<script type="text/javascript">
        function applyFormatCurrency(sender) {
            $(sender).formatCurrency({
                region: 'es-MX'
                , roundToDecimalPlace: -1
            });
        }
    	</script>
    
    <?php
			echo $_JAVASCRIPT_CSS;
		?>
		
         
</head>
<body> 
	<div id="container" class="clearfix">                   
		<aside id="sidebar-main" class="sidebar">            
        	<?php include_once('header.php'); ?>            
			<?php include_once('navhome.php'); ?>            
        </aside><!-- End aside -->                
        
        <div id="main" class="clearfix">       
			<?php include_once('topnav.php'); ?>                    
            <div id="content" class="clearfix">                
                <header id="header-sec"> 
                	<div class="inner-padding"> 
                        <div class="pull-left">
                            <h2>Cuenta</h2>                 
                        </div> 
                    </div>
            	</header>                                     
                 <div class="window">  
                    <!-- <div class="row ext-raster"> -->
                   	<!-- <div class="col-sm-12"> -->
                            <!-- <div class="row"> -->
                            	<div class="col-sm-12">
                                    
										<div class="inner-padding form-horizontal">						
                                    
										<div class="col-sm-12">
										
											   
 								
 									<h2 class="sectionTitle">
										Informaci&oacute;n de cuenta
									</h2>
									<div class="spacer-20"></div>
									<hr/>
									<div class="spacer-20"></div>
									
									<h3>Datos de contacto Administrativo</h3>
								
									<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												Nombre
											</label>
											<div class="col-sm-6">
												<input id="nombreC" class="form-control nombreC"  type="text" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												Apellido Paterno
											</label>
											<div class="col-sm-6">
												<input id="aPaternoC" class="form-control aPaternoC"  type="text" />
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Apellido Materno
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="aMaternoC" class="form-control aMaternoC"  type="text"/>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Correo electr&oacute;nico
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="emailC" class="form-control emailC"  type="text"/>
											</div>
										</div>
										
										<div class="form-group">
												<label for="txtLadaTelCasaCA" class="col-sm-4 control-label txtLadaTelCasaCA">Tel&eacute;fono</label>
											
											<div class="col-sm-2">
											<select id="LadaTelCasaCA" class="coloniaF form-control"  >			
												<?php echo $slcPaisesCodigos ;?>
											</select>
											</div>

											<div class="col-sm-2">
												<input type="text" name="txtLadaTelCasaCA" id="txtLadaTelCasaCA" class="form-control txtLadaTelCasaCA  numeric " placeholder="c&oacute;digo &aacute;rea" value="" maxlength="3"/>
											</div>

											<div class="col-sm-2">
												<input type="text" name="txtTelCasaCA" id="txtTelCasaCA" placeholder="tel&eacute;fono 8 digitos" class="txtTelCasaCA form-control numeric " value="" maxlength="8" />
											</div>
											</div>
										
										<div class="spacer-20"></div>
									<hr/>
									<div class="spacer-20"></div>
									
									<h3>Datos de contacto Facturaci&oacute;n</h3>
								
									<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												Nombre
											</label>
											<div class="col-sm-6">
												<input id="nombreCF" class="form-control nombreCF"  type="text" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												Apellido Paterno
											</label>
											<div class="col-sm-6">
												<input id="aPaternoCF" class="form-control aPaternoCF"  type="text" />
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Apellido Materno
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="aMaternoCF" class="form-control aMaternoCF"  type="text"/>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Correo electr&oacute;nico
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="emailCF" class="form-control emailCF"  type="text"/>
											</div>
										</div>
										
										<div class="form-group">
												<label for="txtLadaTelCasaCF" class="col-sm-4 control-label txtLadaTelCasaCF">Tel&eacute;fono</label>
											
											<div class="col-sm-2">
											<select id="LadaTelCasaCF" class="coloniaF form-control"  >			
												<?php echo $slcPaisesCodigos ;?>
											</select>
											</div>

											<div class="col-sm-2">
												<input type="text" name="txtLadaTelCasaC" id="txtLadaTelCasaCF" class="form-control txtLadaTelCasaC  numeric " placeholder="c&oacute;digo &aacute;rea" value="" maxlength="3"/>
											</div>

											<div class="col-sm-2">
												<input type="text" name="txtTelCasaCF" id="txtTelCasaCF" placeholder="tel&eacute;fono 8 digitos" class="txtTelCasaC form-control numeric txtTelCasa" value="" maxlength="8" />
											</div>
											</div>
										
											<div class="spacer-20"></div>
									<hr/>
									<div class="spacer-20"></div>
									
									<h3>Datos de contacto T&eacute;cnico</h3>
								
									<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												Nombre
											</label>
											<div class="col-sm-6">
												<input id="nombreCT" class="form-control nombreC"  type="text" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												Apellido Paterno
											</label>
											<div class="col-sm-6">
												<input id="aPaternoCT" class="form-control aPaternoCT"  type="text" />
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Apellido Materno
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="aMaternoCT" class="form-control aMaternoCT"  type="text"/>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Correo electr&oacute;nico
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="emailCT" class="form-control emailCT"  type="text"/>
											</div>
										</div>
										
										<div class="form-group">
												<label for="txtLadaTelCasaCT" class="col-sm-4 control-label txtLadaTelCasaCT">Tel&eacute;fono</label>
											
											<div class="col-sm-2">
											<select id="LadaTelCasaCT" class="coloniaF form-control"  >			
												<?php echo $slcPaisesCodigos ;?>
											</select>
											</div>

											<div class="col-sm-2">
												<input type="text" name="txtLadaTelCasaCT" id="txtLadaTelCasaCT" class="form-control txtLadaTelCasaCT  numeric " placeholder="c&oacute;digo &aacute;rea" value="" maxlength="3"/>
											</div>

											<div class="col-sm-2">
												<input type="text" name="txtTelCasaCT" id="txtTelCasaCT" placeholder="tel&eacute;fono 8 digitos" class="txtTelCasaCT form-control numeric txtTelCasa" value="" maxlength="8" />
											</div>
											</div>
										
										<div class="spacer-20"></div>
									<hr/>
									<div class="spacer-20"></div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Razon Social
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="rSocialC" class="form-control rSocialC"  type="text"/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												Pais
											</label>
											<div class="col-sm-6">
												<select id="paisC" class="form-control paisC"  >
												<?php echo $slcPaises;?>										
												</select>
											</div>
										</div>

										

										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCycle">
												Estado
											</label>
											<div class="col-sm-6">
												<select id="estadoC" class="form-control estadoC"  >
												<?php echo $slcEstados;?>																
												</select>
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Codigo Postal
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="CPC" class="form-control CPC numeric" maxlength=5 type="text"/>
												<button id="btnBuscarCPC">Buscar</button>
											</div>
										</div>																				
																	
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCycle">
												Delegaci&oacute;n/Municipio
											</label>
											<div class="col-sm-6">
												<select id="municipioC" class="form-control municipioC"  >
												<option value="">Seleccione una opci&oacute;n</option>																
												</select>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCycle">
												Ciudad
											</label>
											<div class="col-sm-6">
												<select id="ciudadC" class="form-control ciudadC"  >
												<option value="">Seleccione una opci&oacute;n</option>																														
												</select>
											</div>
										</div>
										
<!-- 										<div class="form-group"> -->
<!-- 											<label class="col-sm-4 control-label" for="planCycle"> -->
<!-- 												Localidad -->
<!-- 											</label> -->
<!-- 											<div class="col-sm-6"> -->
<!-- 												<select id="ciudadC" class="form-control ciudadC"  > -->
																									
<!-- 												</select> -->
<!-- 											</div> -->
<!-- 										</div> -->
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCycle">
												Asentamiento (Colonia)
											</label>
											<div class="col-sm-6">
												<select id="coloniaC" class="form-control coloniaC"  >
														<option value="">Seleccione una opci&oacute;n</option>																
												</select>
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Calle
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="calleC" class="form-control calleC"  type="text"/>
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												No. Exterior
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="noExteriorC" class="form-control noExteriorC"  type="text"/>
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												No. Interior
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="noInteriorC" class="form-control noInteriorC "  type="text"/>
											</div>
										</div>
										
<!-- 											<div class="form-group"> -->
<!-- 											<label class="col-sm-4 control-label" for="planCurrency"> -->
<!-- 												Telefono -->
<!-- 											</label> -->
<!-- 											<div class="col-sm-6"> -->
<!-- 												<input placeholder="" id="telefonoC" class="form-control telefonoC "  type="text"/> -->
<!-- 											</div> -->
<!-- 										</div> -->
										
										    <div class="form-group">
												<label for="txtLadaTelCasaC" class="col-sm-4 control-label txtLadaTelCasaC">Tel&eacute;fono</label>
											
											<div class="col-sm-2">
											<select id="LadaTelCasaC" class="coloniaF form-control"  >			
												<?php echo $slcPaisesCodigos ;?>
											</select>
											</div>

											<div class="col-sm-2">
												<input type="text" name="txtLadaTelCasaC" id="txtLadaTelCasaC" class="form-control txtLadaTelCasaC  numeric " placeholder="c&oacute;digo &aacute;rea" value="" maxlength="3"/>
											</div>

											<div class="col-sm-2">
												<input type="text" name="txtTelCasa" id="txtTelCasaC" placeholder="tel&eacute;fono 8 digitos" class="txtTelCasaC form-control numeric txtTelCasa" value="" maxlength="8" />
											</div>
											</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Extensi&oacute;n
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="extensionC" class="form-control extensionC numeric"  type="text"/>
											</div>
										</div>
										
									<hr/>
									<h3>Datos de Facturaci&oacute;n</h3>
										
										<div class="form-group">
											<label class="col-sm-4 control-label " for="planName">
												Utilizar mismos datos de contacto
											</label>
											<div class="col-sm-6 pull-left">
												<input type="checkbox" id="mismoDatos" class="pull-left "  type="text" onclick="hacercopia()";/>
											</div>
										</div>
<!-- 										<div class="form-group">	 -->
<!-- 																		<div class="col-sm-6"></div>		 -->
<!-- 											<div class="col-sm-6"> -->
<!-- 												<label class=" pull-left" for="planName"> -->
<!-- 													Contacto para facturaci&oacute;n y pagos. -->
<!-- 												</label>											 -->
<!-- 											</div> -->
<!-- 										</div> -->
																						
<!-- 										<div class="spacer-10"></div> -->
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												Contacto para facturaci&oacute;n y pagos.
											</label>
											<div class="col-sm-6">
												
											</div>
										</div>
										
																
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												Nombre
											</label>
											<div class="col-sm-6">
												<input id="nombreF" class="nombreF form-control"  type="text" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												Apellido Paterno
											</label>
											<div class="col-sm-6">
												<input id="aPaternoF" class="aPaternoF form-control"  type="text" />
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Apellido Materno
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="aMaternoF" class="aMaternoF form-control"  type="text"/>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Correo electr&oacute;nico (para envio de facturas)
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="emailF" class="emailF form-control"  type="text"/>
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Razon Social
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="rSocialF" class="rSocialF form-control"  type="text"/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												Pais
											</label>
											<div class="col-sm-6">
												<select id="paisF" class="paisF form-control"  >
												<?php echo $slcPaises;?>										
												</select>
											</div>
										</div>

										

										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCycle">
												Estado
											</label>
											<div class="col-sm-6">
												<select id="estadoF" class="estadoF form-control"  >
												<?php echo $slcEstados;?>																	
												</select>
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Codigo Postal
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="CPF" class="form-control numeric CPF"  maxlength=5 type="text"/>
												<button id="btnBuscarCPF">Buscar</button>
											</div>
										</div>																					
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCycle">
												Delegaci&oacute;n/Municipio
											</label>
											<div class="col-sm-6">
												<select id="municipioF" class="municipioF form-control"  >
												<option value="">Seleccione una opci&oacute;n</option>																														
												</select>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCycle">
												Ciudad
											</label>
											<div class="col-sm-6">
												<select id="ciudadF" class="ciudadF form-control"  >
												<option value="">Seleccione una opci&oacute;n</option>																														
												</select>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCycle">
												Asentamiento (Colonia)
											</label>
											<div class="col-sm-6">
												<select id="coloniaF" class="coloniaF form-control"  >
												<option value="">Seleccione una opci&oacute;n</option>																														
												</select>
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Calle
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="calleF" class="calleF form-control"  type="text"/>
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												No. Exterior
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="noExteriorF" class="noExteriorF form-control"  type="text"/>
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												No. Interior
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="noInteriorF" class="noInteriorF form-control"  type="text"/>
											</div>
										</div>
										
<!-- 											<div class="form-group"> -->
<!-- 											<label class="col-sm-4 control-label" for="planCurrency"> -->
<!-- 												Telefono -->
<!-- 											</label> -->
<!-- 											<div class="col-sm-6"> -->
<!-- 												<input placeholder="" id="telefonoF" class="telefonoF form-control"  type="text"/> -->
<!-- 											</div> -->
<!-- 										</div> -->
										
											


                                			<div class="form-group">
												<label for="txtLadaTelCasaF" class="col-sm-4 control-label txtLadaTelCasaF">Tel&eacute;fono</label>
											<div class="col-sm-2">
												<select id="LadaTelCasaF" class="coloniaF form-control"  >
												<?php echo $slcPaisesCodigos ;?>
																																										
												</select>
											</div>
											<div class="col-sm-2">
												<input type="text" name="txtLadaTelCasaF" id="txtLadaTelCasaF" class=" form-control numeric txtLadaTelCasaF" placeholder="c&oacute;digo &aacute;rea" value="" maxlength="3"/>
											</div>

											<div class="col-sm-2">
												<input type="text" name="txtTelCasa" id="txtTelCasaF" placeholder="tel&eacute;fono 8 digitos" class="txtTelCasaF form-control numeric" value="" maxlength="8" />
											</div>
											</div>

											
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Extensi&oacute;n
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="extensionF" class="form-control extensionF numeric"  type="text"/>
											</div>
										</div>
																			
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												RFC
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="RFC" class="form-control RFC"  type="text" maxlength=13/>
											</div>
										</div>
										
										<div class="spacer-20"></div>
									<hr/>
									<div class="spacer-20"></div>
									<h3>Datos de inicio de sesi&oacute;n</h3>
									<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Usuario
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="usuario" class="form-control usuario"  type="text" maxlength=13/>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Contrase&ntilde;a
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="password" class="form-control password"  type="password" maxlength=13/>
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-12 text-right">
												<input type="button" class="btn btn-success" name="btnGuardar" id="btnGuardar" value="Guardar" />
											</div>
										</div>
										
										<div class="spacer-50">
										</div><hr>
										<div class="spacer-50">
										</div>
									</div>
								</div>
                                    <div class="spacer-50"></div>                                       	
                                    <!-- End .inner-padding -->  
                                </div>
                             <!-- </div> --><!-- End .row -->
                        </div>                        
                     <!-- </div> -->
                 </div> <!-- End .window -->                
                <?php include_once('footer.php'); ?>
                
                <a data-toggle="modal" id="_alertShow" style="display:none" class="btn btn-danger" role="button" href="#_alertBox">Alert</a>
		<div class="modal fade" id="_alertBox" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="_alertCloseUp">
							&times;
						</button>
						<h4 class="modal-title" id="_alertTitle"></h4>
					</div>
					<div class="modal-body">
						<p id="_alertBody"></p>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal" id="_alertClose">
							OK
						</button>
					</div>
				</div>
			</div>
		</div>                
            </div><!-- End #content -->  
    	</div>
    	<!-- End #main -->  	    	    
    <!-- End #container -->         
</body>
</html>