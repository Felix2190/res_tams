<?php
	require("masterIncludeLogin.inc.php");
	//$nav = 'inicio';
	//$subnav = 'home';
//	$nav='';
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

    <title>Registro de entrada</title>

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
    
        <script src="js/plugins/jquery.tablesorter.min.js"></script>
    <script src="js/plugins/jquery.tablesorter.widgets.min.js"></script>
    <script src="js/plugins/jquery.tablesorter.pager.min.js"></script>
    <script src="js/plugins/tablesort.js"></script>
    
    
    <?php
			echo $_JAVASCRIPT_CSS;
		?>
         
         		    <!-- Numeric jQuery -->
    <script type="text/javascript" src="js/lib/jquery.numeric.js"></script>
    
    <!-- Calendar jQuery -->
    <script type="text/javascript" src="js/lib/ui.datepicker-es-MX.js"></script>
         
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
                            <h2>Registro de entrada</h2>                 
                        </div> 
                    </div>
            	</header>                                     
                 <div class="window">  
                    <!-- <div class="row ext-raster"> -->
                   	<!-- <div class="col-sm-12"> -->
                            <!-- <div class="row"> -->
                            	<div class="col-sm-12">
                                    <div class="subheading">
										</div>
										
										<div class="inner-padding">						
                                    
										<div class="col-sm-12">
										 								<div class="inner-padding form-horizontal"> 									
 									    
 										<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												Fecha
											</label>
											<div class="col-sm-6">
												<input id="fecha" name="fecha" placeholder="AAAA-MM-DD" class="form-control"  type="text" />
											</div>
										</div>
										
 									<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												Folio
											</label>
											<div class="col-sm-6">
												<input id="folio" name="folio"  class="form-control"  type="text"/>
											</div>
										</div>																					
										
										  <div class="spacer-20"></div>
										  
										  <div class="form-group">
											<label class="col-sm-4 control-label" for="planCycle">
												Ubicacion 
											</label>
											
											<div class="col-sm-6">
												<select id="Ubicacion" name="Ubicacion" class="form-control"  >
												
												<?php echo $slcUbicaciones ;?>>
<!-- 												<option value="">Seleccione una opci&oacute;n</option> -->
<!-- 												<option value="si">Si</option> -->
<!-- 												<option value="no">No</option>																						 -->
												</select>
											</div>
											<div class="col-sm-2">
												<a href="altaUbicacion.php" class="btn btn-default btn-circle"><i class="fa fa-plus" title="alta de ubicaci&oacute;n"></i></a> 
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCycle">
												Tipo
											</label>
											<div class="col-sm-6">
												<select id="tipo" name="tipo"  class="form-control"  >
												<option value="">Seleccione una opci&oacute;n</option>
												<option value="producto">Producto</option>
												<option value="servicio">Servicio</option>																		
												</select>
											</div>
										</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												C&oacute;digo del producto/servicio
											</label>
											<div class="col-sm-6">
												<input id="codigo" name="codigo" placeholder="Teclea 4 caracteres para iniciar la busqueda." class="form-control"  type="text" />
											</div>
											<input type="hidden" id="idcodigo" name="idcodigo" value="">
										</div>										
																			
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCycle">
												Inventariable 
											</label>
											
											<div class="col-sm-6">
												<select id="inventariable" name="inventariable" class="form-control"  >
												<option value="">Seleccione una opci&oacute;n</option>
												<option value="si">Si</option>
												<option value="no">No</option>																						
												</select>
											</div>
										</div>
										<div id="datosInventario">
											<div class="form-group">
												<label class="col-sm-4 control-label" for="planName">
													N&uacute;mero de serie
												</label>
												<div class="col-sm-6">
													<input id="numeroSerie" name="numeroSerie" class="form-control"  type="text" />
												</div>
											</div>
										
											<div class="form-group">
												<label class="col-sm-4 control-label" for="planName">
													 Mac Address
												</label>
												<div class="col-sm-6">
													<input id="mac" name="mac" placeholder="XX:XX:XX:XX:XX:XX" class="form-control"  type="text" maxlength = 17/>
												</div>
											</div>
											</div>
										
											<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												Comentarios
											</label>
											
											<div class="col-sm-6">
												<textarea id="comentarios" name="comentarios" rows="10" cols="50">
												</textarea>
											</div>
											</div>																			
																						
										<div class="row">
											<div class="col-sm-12 text-right">
<!-- 												<input type="button" class="btn btn-success" name="btnGuardar" id="btnGuardar" value="Guardar" /> -->
											</div>
										</div>
										
										
										<div class="form-group">
											<div class="col-sm-4">&nbsp;</div>
											<div class="col-sm-8">									
											<button id="btnGuardar" class="btn btn-wide btn-success" type="button"> Guardar Datos</button>
											</div>
										</div>
										
										<div class="spacer-50">
										</div><hr>
										<div class="spacer-50">
										</div>
										
								
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