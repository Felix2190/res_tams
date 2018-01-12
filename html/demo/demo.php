<?php

//	require 'admintickets.php';
	$nav = 'inicio';
	$subnav = 'home';
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

    <title>Demo</title>

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
    <link rel="stylesheet" href="../bootstrap/core/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../bootstrap/typeahead/typeahead.min.css"/>
    <link rel="stylesheet" href="../fontawesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../css/bootstrap-custom.css"/>
    <link rel="stylesheet" href="../css/bootstrap-extended.css"/>
    <link rel="stylesheet" href="../css/animate.min.css"/>
    <link rel="stylesheet" href="../css/helpers.css"/>
    <link rel="stylesheet" href="../css/base.css"/>
    <link rel="stylesheet" href="../css/light-theme.css"/>
    <link rel="stylesheet" href="../css/mediaqueries.css"/>
    
    
    <!-- CSS Calendario -->
<link rel="stylesheet" href="../js/libs/jquery-ui-1.12.1/jquery-ui.css" />
    
    <!-- // Helpers // -->
    <script src="../js/plugins/modernizr.min.js"></script>
    <script src="../js/plugins/mobiledevices.js"></script>
    
    <!-- // jQuery core // -->
    <script src="../js/libs/jquery-1.11.0.min.js"></script>
    <script src="../js/libs/jquery-ui-1.10.4.min.js"></script>
    
    <!-- // Bootstrap // -->
    <script src="../bootstrap/core/dist/js/bootstrap.min.js"></script>
	<script src="../bootstrap/bootboxjs/bootboxjs.min.js"></script>
    <script src="../bootstrap/holder/holder.min.js"></script>
    <script src="../bootstrap/typeahead/typeahead.min.js"></script>
    
    <!-- // Custom/premium plugins // -->
    <script src="../js/plugins/mainmenu.1.0.min.js"></script>
    <script src="../js/plugins/bootstraptabsextend.1.0.min.js"></script>
 	<script src="../js/plugins/nanogress.1.0.min.js"></script>
    <script src="../js/plugins/simpleselect.1.0.min.js"></script>
      
    <!-- // Third-party plugins // -->
    <script src="../js/plugins/tinyscrollbar.min.js"></script>
    <!-- mouse wheel opt-->
    <script src="../js/plugins/h5f.min.js"></script>
    <script src="../js/plugins/hogan-2.0.0.js"></script>
    <script src="../js/plugins/jquery.autosize-min.js"></script>
    <script src="../js/plugins/layout.min.js"></script>
    <script src="../js/plugins/masonry.pkgd.min.js"></script>
    
    <script src="../js/Chart.js/Chart.min.js"></script>
   	<script src="../js/plugins/generics.js"></script>

<script src="../Common/lib/jquery/jquery.min.js"></script>
<script src="../Common/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../Common/lib/biocomponents/aw_fingerprint_capture.js"></script>
<script src="../Common/lib/biocomponents/aw_fingerprint_set.js"></script>
<script src="../Common/lib/biocomponents/ImpressionInfo.js"></script>
<script src="../Common/lib/biocomponents/WebsocketTransport.js"></script>
<script src="FingerprintComponent/autocapture_strings.js"></script>
<script src="FingerprintComponent/set_controller.js"></script>
<script src="FingerprintComponent/fingerprint_component.js"></script>


<script>
    "use strict";
    $(document).ready(function () {
        $('#fingerprintComponentContainer').load('fingerprintComponent/fingerprint_component.html',
            function () {
            
                // Fix path
                $(".shutter-svg").attr("src","../Common/images/shutter.svg");
                $(".dial-svg").attr("src","../Common/images/dial.svg");

                var websocket = new WebSocket("ws://localhost:2080");
                websocket.onopen = function (event) {
                    var transport = createWebsocketTransport(websocket);
                    console.log('conec1');
                    FingerprintComponent.init({
                        transport:transport,
                        cancelCallback: function() { window.location="../index.html";}
                    }).then(function(){
                        FingerprintComponent.activate();
                    });
                };
            })
    });

    function avanzaTemporal(){
    	//alert('ju');
    	window.location="../biometricos_iris.php";
//    	xajax_avanzaSinGuardar();
    	return false;
    }
        
</script>

	
</head>
<body>
	<div id="container" class="clearfix">
                   
		<aside id="sidebar-main" class="sidebar">
		
                <div class="sidebar-logo">
            	<a href="dashboard.php" id="logo-big">
            		<h1><img src="../images/theme/logobw.png" alt="DRIVE ID" title="DRIVE ID" /></h1>
            	</a>
            </div><!-- End .sidebar-logo -->
                    
            <div class="sidebar-module"> 
                <div class="sidebar-profile">
                	<div class="dropdown ext-dropdown-profile">
						<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">
						<img src="../images/users/user-1.jpg" alt="" class="avatar"/>
							Hola, <strong></strong>
							<i class="fa fa-caret-down pull-right"></i>
						</a>
						<ul role="menu" class="dropdown-menu">
							<li>
								<a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a>
							</li>
							<li>
								<a href="preferencias.php"><i class="fa fa-cogs"></i> Preferencias</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="logout.php"><i class="fa fa-sign-out"></i> Salir</a>
							</li>
						</ul>
	                </div>
                </div>
            </div><!-- /sidebar -->
                    
            <div class="sidebar-line"><!-- A seperator line --></div>
            
          <?php
            $modulo_activo = 3;
              $pagina_activa = 'biometrico_huellas';
            include_once('../navlicencias.php');
          ?>    
        </aside><!-- End aside -->
          
        
        
        <div id="main" class="clearfix">
       
		<header id="header-main">
            <div class="header-main-top">
	            		<div class="text-right"><strong>
	            </strong>
		            	</div>
						<div class="text-right" style="with:300px; float: right;">
							
							<button class="btn btn-success btn-xs" id="btnSiguiente" name="btnSiguiente"> Siguiente </button>
							<button class="btn btn-primary btn-xs" id="btnSaltar" name="btnSaltar"> Saltar </button>
		            	</div>
                    </div>
                	<div class="pull-left">
                    	<a href="dashboard.php" id="logo-small"><h4>Planet</h4> <h5>CRM</h5></a>
                    </div>
                    <div class="header-main-bottom">
                    </div>
                    </header>

        
        
        
            <div id="content" class="clearfix">

                
            <header id="header-sec">
                	<div class="inner-padding">
                        <div class="">

                        </div>
                    </div>
            	</header>

                                     
                <div class="window" >
                    <div class="row ext-raster">
                    	<div class="col-sm-12">
                            <div class="row">
                            	<div class="col-sm-12">
                                    <div class="inner-padding">
                                    
                                       <div id="fingerprintComponentContainer">
                <!--fingerprint component UI will be loaded here-->
            </div>
       <div class="spacer-30"></div>
        <a type="button" class="btn btn-success" onclick="avanzaTemporal();" >Siguiente</a>
                                    <div class="spacer-30"></div>   
                                       
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
	               
                
                
                <?php include_once('../footer.php'); ?>
            </div><!-- End #content -->
    	</div>
    	<!-- End #main -->
    	
    	
    </div>
    <!-- End #container -->
    
    
        
     	<script src="../js/lib/main.js"></script>
     	
</body>


</html>