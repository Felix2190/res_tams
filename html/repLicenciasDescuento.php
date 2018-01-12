<?php	
	require("masterIncludeLogin.inc.php");
	$nav = 'reportes';
	$subnav = 'repProximasVencer';  
	$fechaini=date("Y-m-d");
	$fechafin=date("Y-m-d");
	
	
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

    <title>Reportes Licencias descuentos</title>

    
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
    <style type="text/css">tr.separador td,tr.separador th{border-bottom: 1px solid #fff; }</style>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />

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
                            <h2><i class="fa fa-map-marker"></i> &nbsp; Reporte Licencias descuentos</h2>                 
                        </div> 
                    </div>
            	</header>


                                     
                <div class="window">  
                    <div class="row ext-raster">
                    	<div class="col-sm-12" >
                            
											<div class="col-sm-3">
                                        		<label for="txtFechaIni"  class="txtFechaIni">Desde</label><br />
                								<input type="text" name="txtFechaIni" id="txtFechaIni" class="form-control txtFechaIni" value="<?php echo $fechaini; ?>" />
                							</div> 
                							<div class="col-sm-3">
                                        		<label for="txtFechaFin" class="txtFechaFin">Hasta</label><br />
                								<input type="text"  name="txtFechaFin" id="txtFechaFin" class="form-control txtFechaFin" value="<?php echo $fechafin; ?>" />
                							</div> 											
											<div class="spacer-20"></div>
											
						
						
											<div id="municipio" class="form-group col-sm-3">
											<label class=" control-label" for="planCycle">
												Ciudades
											</label>
											<div >
												<select id="municipioC" class="form-control municipioC"  >
												<?php echo $slcMunicipios ;?>																
												</select>
											</div>
										</div>
											
<!-- 										<div class="form-group col-sm-4"> -->
<!-- 											<label class=" control-label" for="planCycle"> -->
<!-- 												A&ntilde;os -->
<!-- 											</label> -->
<!-- 											<div class=""> -->
<!-- 												<select id="anios" class="form-control Oficina"  > -->
																											
<!-- 												</select> -->
<!-- 											</div> -->
<!-- 										</div> -->
										<div class="spacer-5"></div>
											<div class="form-group col-sm-4">
											<label class=" control-label" for="planCycle">
												Oficina
											</label>
<!--  											<div class="">  -->
<!--  												<select id="Oficina" class="form-control Oficina"  >  -->
												<?php  ;?>																
<!--  												</select>  -->
<!--  											</div>  -->
										</div>
									<div class="spacer-20"></div>
											<?php echo $boxes;?>																						
										<div class="spacer-5"></div>
                                			
                                			<div class="col-sm-3">
											
												<label>&nbsp;</label><br />
												<button  class="btn btn-success btn-block" id="btnGenerar" name="btnGenerar">Generar Reporte</button>
											</div>
                    
                    						<div class="spacer-20"></div>
                            <hr />
                            <div class="row">
                            	<div class="col-sm-12" >
                                    <div class="inner-padding">								
                                        <h4 class="text-muted">Resumen</h4>
                                        <br />                                                                                
                                    </div><!-- End .inner-padding -->  
                                </div>                                
                                
                                <div class="col-sm-12" id="reporte">
                                	<div class="inner-padding">
                                		<div class="table-wrapper">
<!-- 											<header>Reporte</header> -->
											<div class="rt-table">
<div class='table-wrapper'><header> Reporte Licencias Proximas a vencer.</header> </div><table class='table'>
					<thead>
  						<tr>
  							<th scope='col'>Oficina</th>
  							<th scope='col'>Tramites</th>  							
  							<th scope='col'>Total Tramites</th>
  							<th scope='col'>Tramites descuento</th>
  							<th scope='col'>Importe total</th>
  							<th scope='col'>Importe descuento</th>
  							<th scope='col'>Descontado</th>
  							<th scope='col'>Recaudado</th>
				</tr>
  			</thead>
  			<tbody>
  			<tr>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			</tr>
</tbody>
  	<footer>
  	<tr>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	<th></th>
  	</tr>
  	</footer>
  		
  	</table>											</div>
										</div>
								
                                	</div>
                                </div>
                                
                                
                                
                            </div><!-- End .row -->
                        </div>
                        
                    </div>
                </div><!-- End .window -->
                        <div><div class="inner-padding">
<!-- 							<div class="col-sm-1"> -->
<!-- 									<a href="javascript:imprSelec('reporte')" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-print"></span> Imprimir</a> -->
<!-- 							</div> -->
<!-- 							<div class="col-sm-1"> -->
<!-- 									&nbsp; -->
<!-- 							</div> -->
<!-- 							<div class="col-sm-1"> -->
<!-- 								<a href="#" class="btn btn-info btn-lg export"><span class="glyphicon glyphicon-floppy-save"></span> Exportar</a> -->
<!-- 							</div> -->
 										<div class="col-sm-6 inner-padding">       
                                              <a class="btn" id="generarCSV"  target="_blank">
                                                <i class="fa fa-cloud-download"></i> Descargar Reporte
                                              </a>
                                          </div>  
                                             <div class="col-sm-6 inner-padding">       
                                              <a class="btn" id="imprimir"  target="_blank" onclick="(0);imprSelec('reporte')";>
                                                <i class="fa fa-print"></i> Imprimir
                                              </a>
                                          </div>   
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