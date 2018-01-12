<?php
	require("masterIncludeLogin.inc.php");
	$tijuana='checked';
	$mexicali='checked';
	$ensenada='checked';
	$tecate='checked';
	$rosarito='checked';
	$fechaini=date("Y-m-d");
	$fechafin=date("Y-m-d");
	
	if (isset($_POST['btnGenerar'])) {
		if (isset($_POST['chkTijuana']))
			$tijuana = 'checked';
			else
				$tijuana = 'unchecked';
	
				if (isset($_POST['chkMexicali']))
					$mexicali = 'checked';
					else
						$mexicali = 'unchecked';
	
						if (isset($_POST['chkEnsenada']))
							$ensenada = 'checked';
							else
								$ensenada = 'unchecked';
	
								if (isset($_POST['chkTecate']))
									$tecate = 'checked';
									else
										$tecate = 'unchecked';
											
										if (isset($_POST['chkRosarito']))
											$rosarito = 'checked';
											else
												$rosarito = 'unchecked';
												if (isset($_POST['txtFechaIni']))
													$fechaini=$_POST['txtFechaIni'];
													if (isset($_POST['txtFechaFin']))
														$fechafin=$_POST['txtFechaFin'];
	}
	
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

    <title>Reportes/POA</title>

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
                            <h2>Reportes POA</h2>                 
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
												Nombre del producto/servicio
											</label>
											<div class="col-sm-6">
												<input id="nombre" class="form-control"  type="text" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												MAC Address o N&uacute;mero de serie
											</label>
											<div class="col-sm-6">
												<input id="numSerie" class="form-control"  type="text" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label" for="planName">
												Estatus
											</label>
											<div class="col-sm-6">
												<select id="estatus" class="form-control"  >
												<option value="">Seleccione una opci&oacute;n</option>
												<option value="disponible">Disponible</option>
												<option value="agotado">Agotado</option>
												<option value="baja">Baja</option>												
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCurrency">
												C&oacute;digo
											</label>
											<div class="col-sm-6">
												<input placeholder="" id="codigo" class="form-control"  type="text"/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCycle">
												Tipo
											</label>
											<div class="col-sm-6">
												<select id="tipo" class="form-control"  >
												<option value="">Seleccione una opci&oacute;n</option>
												<option value="producto">Producto</option>
												<option value="servicio">Servicio</option>																		
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label" for="planCycle">
												&iquest;Que cuente con existencias?
											</label>
											<div class="col-sm-6">
												<input type="radio" name="existencias" value="si">si
												<input type="radio" name="existencias" value="no">no												
											</div>
										</div>
																				
										<div class="form-group">
											<div class="col-sm-4">&nbsp;</div>
											<div class="col-sm-8">									
												<input type="button" class="btn btn-success" name="btnBuscar" id="btnBuscar" value="Buscar" />
											</div>
										</div>
										
										
										
										
										
										<div class="spacer-30">
										</div><hr>
										<div class="spacer-30">
										</div>
								<div class="col-sm-12">

 									<table class="table" id="tablesorting-1">
										<thead>
											<tr>
												<th>C&oacute;digo</th>
												<th>Foto</th>
												<th>Nombre</th>
												<th>Existencias</th>
												<th>Estatus</th>
<!-- 												<th>No. Serie/MAC</th> -->
												<th>Opciones</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
										
										<tfoot>
                  												<tr>
                  													<td colspan="6" class="pager form-horizontal">
                  														<button class="btn first"><i class="fa fa-step-backward"></i></button>
                  														<button class="btn prev"><i class="fa fa-arrow-left"></i></button>
                  														<span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                  														<button class="btn next"><i class="fa fa-arrow-right"></i></button>
                  														<button class="btn last"><i class="fa fa-step-forward"></i></button>
                  														<select class="pagesize input-xs" title="Select page size">
                  															<option value="50" selected="selected">50</option>
                  															<option value="100">100</option>
                  															<option value="200">200</option>
                  															<option value="400">400</option>
                  														</select>
                  														<select class="pagenum input-xs" title="Seleccione P&aacute;gina"></select>
                  													</td>
                  												</tr>
                  											</tfoot>
                  											
									</table>
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