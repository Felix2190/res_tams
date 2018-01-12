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

    <title>Perfil de prospecto</title>

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
    <link rel="stylesheet" href="vendor/select2/select2.min.css">
		
		
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
		
		
		<script>
		function initMap() 
		{
	        var map = new google.maps.Map(document.getElementById('map'), 
	       {
	          center: {lat: <?php echo $Prospecto->getLatitud()?>, lng: <?php echo $Prospecto->getLongitud()?>},
	          zoom: 11,
	          mapTypeId: google.maps.MapTypeId.MAP
	        });

	       
	        
	        
	        var myLatlng = new google.maps.LatLng(<?php echo $Prospecto->getLatitud()?>, <?php echo $Prospecto->getLongitud()?>);
			
			
			infoWindow = new google.maps.InfoWindow();
			 
		    var marker = new google.maps.Marker({
		        position: myLatlng,
		        draggable: true,
		        map: map,
		        title:"Arrastre el marcador a la coordenada de la comunidad."
		    });
		    
		    
		    
		    colocarLOGLAT(marker);
	        
	        
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
                            <h2></h2>                 
                        </div> 
                    </div>
            	</header>                                     
                 <div class="window">  
                    <!-- <div class="row ext-raster"> -->
                   	<!-- <div class="col-sm-12"> -->
                            <!-- <div class="row"> -->
                            	<div class="col-sm-12">
										
										<div class="inner-padding">						
                                    
																		<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-6">
											<div class="subheading">
												<h3> <?php echo $Prospecto->getRazonSocial()?> </h3>
											</div>
										</div>
										<div class="col-sm-6">
											<h4 class="sectionTitle">
												Comentarios
											</h4>
										</div>
									</div>
									
									
									<div class="row">
										<div class="col-sm-6">
											<div class="row">
												<form role="form" class="form-horizontal" id="frmDatos">
													<input type="hidden" value="<?php echo $Prospecto->getIdProspecto()?>" id="hId" name="hId"/>											
													<div class="form-group">
														<label class="col-sm-4 control-label" for="txtFolio">
															Folio
														</label>
														<div class="col-sm-2">
															<input class="form-control" disabled type="text" value="<?php echo $Prospecto->getFolio()?>" name="txtFolio" id="txtFolio"/>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-4 control-label" for="txtCategoria">
															Categor&iacute;a
														</label>
														<div class="col-sm-6">													
															<span class="label label-default"><?php echo ucfirst($Prospecto->getCategoria())?></span>
														</div>
													</div>
													
													
													<div class="form-group">
														<label class="col-sm-4 control-label" for="txtNombreContacto">
															Nombre del contacto
														</label>
														<div class="col-sm-6">
															<input class="form-control" type="text" disabled value="<?php echo $Prospecto->getContactoNombre()?>" name="txtNombreContacto" id="txtNombreContacto" />
														</div>
													</div>
													
													
													
													<div class="form-group">
														<label class="col-sm-4 control-label" for="txtRFC">
															RFC
														</label>
														<div class="col-sm-4">
															<input class="form-control" type="text" disabled value="<?php echo $Prospecto->getRFC()?>"  name="txtRFC" id="txtRFC" />
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-4 control-label" for="slcProductos">
															Productos Cotizados
														</label>
														<div class="col-sm-6">
															<?php echo $strProductos?>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-4 control-label" for="txtRFC">
															Valor Anual Estimado
														</label>
														<div class="col-sm-4">
															<div class="input-group">
																<span class="input-group-addon"><i class="ti-money"></i></span>
																<input class="form-control" type="text" disabled value="<?php echo number_format($Prospecto->getValorAnualEstimado(),2,".",",")?>"  name="txtRFC" id="txtRFC" />
															</div>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-4 control-label" for="txtRFC">
															Probabilidad de &Eacute;xito
														</label>
														<div class="col-sm-4">
															<div class="input-group">															
																<input class="form-control" type="text" disabled value="<?php echo number_format($Prospecto->getProbabilidadExito(),2,".",",")?>"  name="txtRFC" id="txtRFC" />
																<span class="input-group-addon">%</i></span>
															</div>
														</div>
													</div>
																										
													<div class="form-group">
														<label class="col-sm-4 control-label" for="txtNombreContacto">
															Mes Esperado de Cierre
														</label>
														<div class="col-sm-6">													
															<span class="label label-default"><?php echo ucfirst($Prospecto->getMesCierreEsperado())?></span>
														</div>
													</div>
													
													<div class="form-group">
		                                                <label class="col-sm-4 control-label">Referencias</label>
		                                                <div class="col-sm-8">
		                                                	<!--  <input id="pac-input" type="text" size="50">  -->
															<div id="map" style="width:90%;height:350px;"></div>
															<strong>Longitud:</strong><span id="spLon"><?php echo $Prospecto->getLongitud()?></span><br />
															<strong>Latitud:</strong><span id="spLat"><?php echo $Prospecto->getLatitud()?></span>   
		                                                </div>
		                                            </div>
		                                            
		                                            <div class="form-group">
														<label class="col-sm-4 control-label" for="">
															Etapa de Venta
														</label>
														<div class="col-sm-6">													
															<span class="label label-default" id="lblEstatus"><?php echo ucfirst($Prospecto->getEstatus()=="autorizado"?"prospecto":$Prospecto->getEstatus())?></span>
															
															<?php if(in_array($Prospecto->getEstatus(), array("autorizado","informacion","propuesta"))):?>
																<button class="btn btn-success pull-right btn-sm" id="btnNext">
																<?php
																	switch($Prospecto->getEstatus())
																	{
																		case "autorizado":
																			echo 'Siguiente etapa (Informaci&oacute;n)';
																			break;
																		case "informacion":
																			echo 'Siguiente etapa (Propuesta)';
																			break;
																		case "propuesta":
																			echo 'Siguiente etapa (Contrato)';
																			break;
																		case "contrato":
																		case "cliente":
																		case "denegado":
																		case "pospuesto":
																		case "nuevo":
																			echo "-";
																			break;
																		
																	}
																?>
																</button>
															<?php else:?>
																<button class="btn btn-success pull-right btn-sm" id="btnNext" style="display:none">-</button>
															<?php endif;?>
															
														</div>
													</div>
													
													<div class="form-group" id="divFilePropuesta" style="<?php echo $Prospecto->getEstatus()!="propuesta"?"display:none":""?>">
														<label class="col-sm-4 control-label" for="flPropuesta">
															Archivo de propuesta
														</label>
														<div class="col-sm-5">																													
															<input type="file" id="flPropuesta" name="flPropuesta" />
														</div>
														<div class="col-sm-1"><button id="btnSubir" name="btnSubir"><i class="ti-upload"></i></button></div>
													</div>
													
													<div class="form-group" id="divFileDownload"  style="<?php echo $Prospecto->getFilePropuesta()==""?"display:none":""?>">
														<label class="col-sm-4 control-label" for="txtNombreContacto">
															Propuesta Actual
														</label>
														<div class="col-sm-5">														
															<span id="lblFileName"><?php echo $Prospecto->getFilePropuesta()?></span><a target="_blank" href="download.php?id=<?php echo $Prospecto->getIdProspecto()?>" class="btn btn-default pull-right"><i class="ti-download" ></i></a>
														</div>
														
													</div>
													
													<?php if($isRoot):?>
															<div class="form-group">
															<label class="col-sm-4 control-label" for="txtNombreContacto">
																Agente
															</label>
															<div class="col-sm-6">
																<select class="form-control" id="slcAgente" name="slcAgente">
																	<option value="">Selecciona una opci&oacute;n</option>
																	<?php echo $strListaAgentes?>
																</select>													
															</div>
														</div>
													<?php else:?>												
														<div class="form-group">
															<label class="col-sm-4 control-label" for="txtNombreContacto">
																Agente
															</label>
															<div class="col-sm-6">
																<span class="label label-primary"><?php echo $Prospecto->getNombreAgente()?></span>													
															</div>
														</div>
													<?php endif;?>
													<div class="form-group">
														<div class="col-sm-4">&nbsp;</div>
														<div class="col-sm-8">
															<a href="prospectoListado.php" class="btn btn-default" id="btnListado" > Regresar a listado </a>
															<?php if($isRoot):?>												
																<a href="#" class="btn btn-primary" id="btnEditar" > Cambiar Agente </a>
															<?php endif;?>
															<a href="#" class="btn btn-default" id="btnCancelar"> Cancelar </a>												
															<a href="#" class="btn btn-primary" id="btnAceptar" > Aceptar </a>
														</div>
													</div>
												</form>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row" id="divComentarios">
												<?php echo $strProspectoComentarios?>
											</div>
											<div class="row">
												<input type="hidden" id="idP" name="idP" value="<?php echo $Prospecto->getIdProspecto()?>"/>	
												<textarea class="form-control" id="txtComentario"></textarea>											
												<div style="margin-top:10px">
													<div class="pull-right">
														<a href="#" class="btn btn-primary" data="" id="btnAgregarNota"><i class="fa fa-floppy-o"></i>&nbsp;Publicar comentario</a>
													</div>
												</div>
											</div>
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
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBme3PQPastJDF7T-RRTIoKjqFkABm3xL4&libraries=places&callback=initMap" async defer></script>
    
    <!-- End #container -->         
</body>
</html>