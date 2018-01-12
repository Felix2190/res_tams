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

    <title>Alta de prospecto</title>

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
    	
		<script src="js/lib/jquery.numeric.js"></script>
	<link rel="stylesheet" href="vendor/select2/select2.min.css">
	
	
    <?php
			echo $_JAVASCRIPT_CSS;
		?>
    		
	
		<style>

		      #map {
		        height: 100%;
		      }
		      .controls {
		        margin-top: 10px;
		        border: 1px solid transparent;
		        border-radius: 2px 0 0 2px;
		        box-sizing: border-box;
		        -moz-box-sizing: border-box;
		        height: 32px;
		        outline: none;
		        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
		      }
		
		      #pac-input {
		        background-color: #fff;
		        font-family: Roboto;
		        font-size: 15px;
		        font-weight: 300;
		        margin-left: 12px;
		        margin-top: 12px;
		
		        padding: 5px 11px 5px 13px;
		        text-overflow: ellipsis;
		        width: 300px;
		      }
		
		      #pac-input:focus {
		        border-color: #4d90fe;
		      }
		
		      .pac-container {
		        font-family: Roboto;
		      }
		
		      #type-selector {
		        color: #fff;
		        background-color: #4d90fe;
		        padding: 5px 11px 0px 11px;
		      }
		
		      #type-selector label {
		        font-family: Roboto;
		        font-size: 13px;
		        font-weight: 300;
		      }
		      #target {
		        width: 345px;
		      }
		    </style>
		
		
		     
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
                            <h2>Alta de Prospecto</h2>                 
                        </div> 
                    </div>
            	</header>                                     
                 <div class="window">  
                    <!-- <div class="row ext-raster"> -->
                   	<!-- <div class="col-sm-12"> -->
                            <!-- <div class="row"> -->
                            	<div class="col-sm-12">
                                   <div class="subheading">
											<h3> Informaci&oacute;n del prospecto a registrar </h3>
										</div>
										
										<div class="inner-padding">						
                                    
										<div class="col-sm-12">
										
										<form role="form" class="form-horizontal" id="frmLogin" name="frmLogin">
										<div class="form-group">
											<label class="col-sm-4 control-label" for="txtFolio">
												Folio
											</label>
											<div class="col-sm-2">
												<input class="form-control" disabled type="text" value="" name="txtFolio" id="txtFolio"/>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="txtFolio">
												Categor&iacute;a
											</label>
											<div class="col-sm-2">
												<select id="slcCategoria" name="slcCategoria"  class="form-control">
													<option value="">Selecciona una opci&oacute;n</option>
													<option value="empresarial">Empresarial</option>
													<option value="gobiernoMunicipalEstatal">Gobierno Estatal y Municipal</option>
													<option value="gobiernoFederal">Gobierno Federal</option>												
												</select>
												
											</div>
										</div>
										
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="txtNombreContacto">
												Nombre del contacto
											</label>
											<div class="col-sm-6">
												<input class="form-control" type="text" value="" name="txtNombreContacto" id="txtNombreContacto" />
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="txtRazonSocial">
												Razon Social
											</label>
											<div class="col-sm-6">
												<input class="form-control" type="text" value=""  name="txtRazonSocial" id="txtRazonSocial" />
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="txtRFC">
												RFC
											</label>
											<div class="col-sm-2">
												<input class="form-control" type="text" value=""  name="txtRFC" id="txtRFC" />
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="slcProductos">
												Productos Cotizados
											</label>
											<div class="col-sm-6">
												<select class="form-control" name="slcProductos" id="slcProductos"  multiple="multiple" >
													<?php echo $strProductos?>													
												</select>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="txtValorAnual">
												Valor Anual Estimado
											</label>
											<div class="col-sm-2">
												<div class="input-group">
													<span class="input-group-addon"><i class="ti-money"></i></span>
													<input class="form-control" type="text" value=""  name="txtValorAnual" id="txtValorAnual" />
												</div>
												
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="txtProbabilidad">
												Probabilidad de &eacute;xito
											</label>
											<div class="col-sm-2">
												<div class="input-group">
													
													<input class="form-control" type="text" value=""  name="txtProbabilidad" id="txtProbabilidad" />
													<span class="input-group-addon"> % </span>
												</div>
												
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="slcMes">
												Mes Esperado de Cierre
											</label>
											<div class="col-sm-2">
												<select name="slcMes" id="slcMes" class="form-control">
													<option value="">Selecciona un mes</option>
													<option value="enero">Enero</option>
													<option value="febrero">Febrero</option>
													<option value="marzo">Marzo</option>
													<option value="abril">Abril</option>
													<option value="mayo">Mayo</option>
													<option value="junio">Junio</option>
													<option value="julio">Julio</option>
													<option value="agosto">Agosto</option>
													<option value="septiembre">Septiembre</option>
													<option value="octubre">Octubre</option>
													<option value="noviembre">Noviembre</option>
													<option value="diciembre">Diciembre</option>
												</select>
											</div>
										</div>
										
										
										<div class="form-group">
                                                <label class="col-sm-4 control-label">Referencias</label>
                                                <div class="col-sm-8">
                                                	<!--  <input id="pac-input" type="text" size="50">  -->
													<div id="map" style="width:100%;height:350px;"></div>
													<strong>Longitud:</strong><span id="spLon"></span><br />
													<strong>Latitud:</strong><span id="spLat"></span>
													<input type="hidden" value="" id="txtLon"  name="txtLon" />
													<input type="hidden" value="" id="txtLat" name="txtLat" />                                                    
                                                </div>
                                            </div>
										
										<div class="form-group">
											<label class="col-sm-4 control-label" for="txtComentarios">
												Comentarios
											</label>
											<div class="col-sm-6">
												<textarea rows="" cols="" class="form-control"  name="txtComentarios" id="txtComentarios"></textarea>
												
											</div>
										</div>
										
										<div class="form-group">
											<div class="col-sm-4">&nbsp;</div>
											<div class="col-sm-8">
												<button class="btn btn-default" id="btnCancelar" name="btnCancelar"> Cancelar </button>												
												<button class="btn btn-primary" id="btnGuardar" name="btnGuardar"> Guardar </button>
											</div>
										</div>
										
									</form>
									
										
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBme3PQPastJDF7T-RRTIoKjqFkABm3xL4&libraries=places&callback=initMap" async defer></script>
    <!-- End #container -->         
</body>
</html>