<?php	
	require("masterIncludeLogin.inc.php");
	$nav = 'reportes';
	$subnav = 'repoficina';  
	
	
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

    <title>Reportes Licencias Exportar SAT</title>

    
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
    <link rel="stylesheet" href="css/datatables.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
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
        <!-- // Bootstrap // -->
    <script src="bootstrap/core/dist/js/bootstrap.min.js"></script>
	<script src="bootstrap/bootboxjs/bootboxjs.min.js"></script>
    <script src="bootstrap/typeahead/typeahead.min.js"></script>
    
        <!-- table sort -->
    <script src="js/plugins/jquery.tablesorter.min.js"></script>
    <script src="js/plugins/jquery.tablesorter.widgets.min.js"></script>
    <script src="js/plugins/jquery.tablesorter.pager.min.js"></script>
    <script src="js/plugins/tablesort.js"></script>
    <script src="js/plugins/tablesort.js"></script>
    <script src="js/lib/datatables.min.js"></script>
    
    <!-- // Custom //-->
    <script src="js/plugins/generics.js"></script>
    
    <!-- Calendar jQuery -->
    
    <script type="text/javascript" src="js/lib/ui.datepicker-es-MX.js"></script>   

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
                            <h2><i class="fa fa-map-marker"></i> &nbsp; Licencia</h2>                 
                        </div> 
                    </div>
            	</header>


                                     
                <div class="window">  
                    <div class="row ext-raster">
                    	<div class="col-sm-12" >                     	                						
                            <div class="row">
                            	<div class="col-sm-12">
                            	
                            	<div class="inner-padding">
                            	
                            	<div class="widget divSeccion">
												<header>
												<div class="pull-left">
													<h2><i class="fa icon-drivers-license-o" aria-hidden="true"></i> <span id="lblTicketNombre"></span></h2>
												</div>
												<h2><i class="fa  fa-id-card"></i> Datos generales</h2></header>

												<div class="inner-padding" id="contenedor_padecimientos_fam">
													<div class="col-sm-12">														
							                           	<div class="col-sm-1">
															<label for="" class="">Nombre:</label>
														</div>
							                           	<div class="col-sm-5">
							                           		<label for="" class="text-muted"><?php echo $persona->getNombreCompleto(); ?></label>
															
														</div>
														
															<div class="col-sm-1">
															<label for="" class="">RFC:</label>
														</div>
							                           	<div class="col-sm-5">
							                           		<label for="" class="text-muted"><?php echo $persona->getRFC(); ?></label>
															
														</div>
														
														
															<div class="col-sm-1">
															<label for="" class="">CURP:</label>
														</div>
							                           	<div class="col-sm-5">
							                           		<label for="" class="text-muted"><?php echo $persona->getCURP(); ?></label>
															
														</div>
														
														<div class="col-sm-3">
															<label for="" class="">Fecha Nacimiento:</label>
														</div>
							                           	<div class="col-sm-3">
							                           		<label for="" class="text-muted"><?php echo $persona->getFechaNacimiento(); ?></label>
															
														</div>
														
														<div class="col-sm-2">
															<label for="" class="">Domicilio:</label>
														</div>
							                           	<div class="col-sm-10">
							                           		<label for="" class="text-muted"><?php echo $domicilio->getNombreCalle()."".$domicilio->getNumeroExterior()." ". $domicilio->getColonia(); ?></label>
															
														</div>
														
														<div class="col-sm-2">
															<label for="" class="">Telefono:</label>
														</div>
							                           	<div class="col-sm-4">
							                           		<label for="" class="text-muted"><?php echo $persona->getTelCasa(); ?></label>
															
														</div>
														
														<div class="col-sm-2">
															<label for="" class="">Delegacion:</label>
														</div>
							                           	<div class="col-sm-4">
							                           		<label for="" class="text-muted"><?php echo $localidad->getNOM_LOC(); ?></label>
															
														</div>
														
														<div class="col-sm-2">
															<label for="" class="">Municipio:</label>
														</div>
							                           	<div class="col-sm-4">
							                           		<label for="" class="text-muted"><?php echo $municipio->getNOM_MUN(); ?></label>
															
														</div>
														
														
														<div class="col-sm-2">
															<label for="" class="">Estado:</label>
														</div>
							                           	<div class="col-sm-4">
							                           		<label for="" class="text-muted"><?php echo $estado->getNOM_ENT(); ?></label>
															
														</div>
														<div class="spacer-20"></div>
														<div class="col-sm-12">
															<label for="" class="">Poblacion origen</label>
														</div>
							                           
														
															<div class="col-sm-2">
															<label for="" class="">Delegacion:</label>
														</div>
							                           	<div class="col-sm-4">
							                           		<label for="" class="text-muted"><?php echo $localidadN->getNOM_LOC(); ?></label>
															
														</div>
														
														<div class="col-sm-2">
															<label for="" class="">Municipio:</label>
														</div>
							                           	<div class="col-sm-4">
							                           		<label for="" class="text-muted"><?php echo $municipioN->getNOM_MUN(); ?></label>
															
														</div>
														
														
														<div class="col-sm-2">
															<label for="" class="">Estado:</label>
														</div>
							                           	<div class="col-sm-4">
							                           		<label for="" class="text-muted"><?php echo $estadoN->getNOM_ENT(); ?></label>
															
														</div>
														
							                           	<div class="spacer-5"></div>

							                           
													</div>

												</div>
										</div><!--  fin datos generales -->
										
										
										<div class="widget divSeccion">
												<header>
												<div class="pull-left">
													<h2><i class="fa fa-pencil-square-o"></i> <span id="lblTicketNombre"></span></h2>
												</div>
												<h2><i class="fa  "></i> Media afiliacion</h2></header>

												<div class="inner-padding" id="contenedor_padecimientos_fam">
													<div class="col-sm-12">														
							                           	<div class="col-sm-2">
															<label for="" class="">Color ojos:</label>
														</div>
							                           	<div class="col-sm-2">
							                           		<label for="" class="text-muted"><?php echo $media_afi->getColorOjos(); ?></label>
															
														</div>
														
															<div class="col-sm-3">
															<label for="" class="">Color cabello:</label>
														</div>
							                           	<div class="col-sm-2">
							                           		<label for="" class="text-muted"><?php echo $media_afi->getColorCabello(); ?></label>
															
														</div>
														
														
															<div class="col-sm-1">
															<label for="" class="">Sexo:</label>
														</div>
							                           	<div class="col-sm-2">
							                           		<label for="" class="text-muted"><?php echo $persona->getGenero(); ?></label>
															
														</div>
														
														<div class="col-sm-2">
															<label for="" class="">Estatura:</label>
														</div>
							                           	<div class="col-sm-2">
							                           		<label for="" class="text-muted"><?php echo $media_afi->getEstatura(); ?></label>
															
														</div>
														
															
														<div class="col-sm-3">
															<label for="" class="">Tipo sangre:</label>
														</div>
							                           	<div class="col-sm-3">
							                           		<label for="" class="text-muted"><?php echo $media_afi->getTipoSangre(); ?></label>
															
														</div>
														<div class="spacer-5"></div> 
														<div class="col-sm-3">
															<label for="" class="">Se&ntilde;as particulares:</label>
														</div>
							                           	<div class="col-sm-9">
							                           		<label for="" class="text-muted"><?php echo utf8_encode($media_afi->getSenasParticulares()); ?></label>
															
														</div>
														<div class="spacer-5"></div> 
														<div class="col-sm-4">
															<label for="" class="">Requerimientos especiales:</label>
														</div>
							                           	<div class="col-sm-8">
							                           		<label for="" class="text-muted"><?php echo utf8_encode($requerimientos); ?></label>
															
														</div>
																												
							                           	<div class="spacer-5"></div>

							                           
													</div>

												</div>
										</div><!--  media afiliacion -->
										
										
										<div class="widget divSeccion">
												<header>
												<div class="pull-left">
													<h2><i class="fa fa-ambulance"></i> <span id="lblTicketNombre"></span></h2>
												</div>
												<h2><i class="fa  "></i> En caso de accidente avisar a</h2></header>

												<div class="inner-padding" id="contenedor_padecimientos_fam">
													<div class="col-sm-12">														
							                           	<div class="col-sm-1">
															<label for="" class="">Nombre:</label>
														</div>
							                           	<div class="col-sm-8">
							                           		<label for="" class="text-muted"><?php echo $contacto->getNombre(); ?></label>
															
														</div>
														
															<div class="col-sm-1">
															<label for="" class="">Telefono:</label>
														</div>
							                           	<div class="col-sm-2">
							                           		<label for="" class="text-muted"><?php echo $contacto->getTelefeno(); ?></label>
															
														</div>
														
														
														<div class="col-sm-2">
															<label for="" class="">Domicilio:</label>
														</div>
							                           	<div class="col-sm-10">
							                           		<label for="" class="text-muted"><?php echo utf8_decode($contacto->getCalle()." ".$contacto->getNumeroExterrior()." ". $contacto->getColonia()); ?></label>
															
														</div>
														
														<div class="col-sm-2">
															<label for="" class="">Delegacion:</label>
														</div>
							                           	<div class="col-sm-4">
							                           		<label for="" class="text-muted"><?php echo utf8_decode($localidadC->getNOM_LOC()); ?></label>
															
														</div>
														
														<div class="col-sm-2">
															<label for="" class="">Municipio:</label>
														</div>
							                           	<div class="col-sm-4">
							                           		<label for="" class="text-muted"><?php echo utf8_decode($municipioC->getNOM_MUN()); ?></label>
															
														</div>
														
														
														<div class="col-sm-2">
															<label for="" class="">Estado:</label>
														</div>
							                           	<div class="col-sm-4">
							                           		<label for="" class="text-muted"><?php echo utf8_decode($estadoC->getNOM_ENT()); ?></label>
															
														</div>	
														
														<div class="col-sm-2">
															<label for="" class="">Pais:</label>
														</div>
							                           	<div class="col-sm-4">
							                           		<label for="" class="text-muted"><?php ?></label>
															
														</div>	
														
														<div class="spacer-5"></div> 
														<div class="col-sm-3">
															<label for="" class="">Parentesco:</label>
														</div>
							                           	<div class="col-sm-9">
							                           		<label for="" class="text-muted"><?php echo utf8_decode($contacto->getParentesco()); ?></label>
															
														</div>
														<div class="spacer-5"></div> 
														<div class="col-sm-3">
															<label for="" class="">Observaciones:</label>
														</div>
							                           	<div class="col-sm-9">
							                           		<label for="" class="text-muted"><?php   ?></label>
															
														</div>
																												
							                           	<div class="spacer-5"></div>

							                           
													</div>

												</div>
										</div><!--  media afiliacion -->
										
										
																				<div class="widget divSeccion">
												<header>
												<div class="pull-left">
													<h2><i class="fa fa-picture-o"></i> <span id="lblTicketNombre"></span></h2>
												</div>
												<h2><i class="fa"></i> Imagenes</h2></header>

												<div class="inner-padding" id="contenedor_padecimientos_fam">
													<div class="col-sm-12">	                          
														<?php  echo $strImagenes; ?>							                           
													</div>

												</div>
										</div><!--  media afiliacion -->
									</div> 
									
									
									
                            	</div>  
                            </div><!-- End .row -->
                        </div>
                        
                    </div>
                </div><!-- End .window -->
                        <div><div class="inner-padding">

 									
						</div></div>                
                
                <?php //include_once('footer.php'); ?>
            </div><!-- End #content -->  
    	</div>
    	<!-- End #main -->
    	
    	
    </div>
    <!-- End #container --> 
    
    	<!-- start: ALERTS MODAL WINDOWS -->
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

		<!-- end: ALERTS MODAL WINDOWS -->
</body>
</html>