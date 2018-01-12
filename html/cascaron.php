<?php
	require("masterIncludeLogin.inc.php");
//	require 'admintickets.php';
	$nav = 'inicio';
	$subnav = 'home';
	
	
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
	$__pasoSubseccion="huellas";
	
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

    <title>Bienvenid@ <?php echo $objSession->getFirstName() . " " . $objSession->getLastName()?></title>

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
    
    <style type="text/css">
.legend li span {
	width: 1em;
	height: 1em;
	display: inline-block;
	margin-right: 5px;
}

.legend {
	list-style: none;
}


.col-centered{
    float: none;
    margin: 0 auto;
}


</style>
     <?php
	echo $_JAVASCRIPT_CSS;
	?>
</head>
<body>
	<div id="container" class="clearfix">
                   
		<aside id="sidebar-main" class="sidebar">
        	<?php include_once('header.php'); ?>
        	<?php echo armarPasosContenido($__pasoActual,$__pasoSubseccion)?>
        </aside><!-- End aside -->
        <div id="main" class="clearfix">
			<?php include_once('topnav.php'); ?>
            <div id="content" class="clearfix">
            <?php echo armarPasos($__pasoActual)?>
                <div class="window">
                    <div class="row ext-raster">
                    	<div class="col-sm-12">
                            <div class="row">
                            	<div class="col-sm-12">
                                    <div class="inner-padding">
                                    
                                    <!-- --------------------------------------------------------------------- -->
                                    <!-- -------------------------INICIO DE CONTENIDO------------------------- -->
                                    <!-- --------------------------------------------------------------------- -->
                                    
                                    
                                    
                                    
                                    <!-- --------------------------------------------------------------------- -->
                                    <!-- ---------------------------FIN DE CONTENIDO-------------------------- -->
                                    <!-- --------------------------------------------------------------------- -->
                                        	
                                    </div><!-- End .inner-padding -->
                                </div>
                            </div><!-- End .row -->
                        </div>
                        
                    </div>
                </div><!-- End .window -->
                
                
                <!-- ----------------------------------------------------------------------------------------- -->
				<!-- --------------------------Seccion de alertas y mensajes modales-------------------------- -->
				<!-- ----------------------------------------------------------------------------------------- -->
	
				<a data-toggle="modal" id="_alertShow" style="display: none" class="btn btn-danger" role="button" href="#_alertBox">Alert</a>
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
	
				<!-- ----------------------------------------------------------------------------------------- -->
				<!-- ----------------------Fin de seccion de alertas y mensajes modales----------------------- -->
				<!-- ----------------------------------------------------------------------------------------- -->
	                
	                
                <?php include_once('footer.php'); ?>
            </div><!-- End #content -->
    	</div>
    	<!-- End #main -->
    	
    	
    </div>
    <!-- End #container -->
    
    
        
     	<script src="js/lib/main.js"></script>
     	
</body>


</html>