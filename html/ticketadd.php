<?php
	require("masterIncludeLogin.inc.php");
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

    <title>Nuevo ticket de soporte</title>

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
    <link rel="stylesheet"
	href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    
    <!-- mouse wheel opt-->
    <script src="js/plugins/h5f.min.js"></script>
    <script src="js/plugins/hogan-2.0.0.js"></script>
    <script src="js/plugins/jquery.autosize-min.js"></script>
    <script src="js/plugins/layout.min.js"></script>
    <script src="js/plugins/masonry.pkgd.min.js"></script>
    
    <script src="js/plugins/generics.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
   <script src="js/plugins/formData.js"></script>
    
    
		<?php
			  echo $_JAVASCRIPT_CSS;
		//var_dump($strTabla)
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
                            <h2><i class="fa fa-pencil"></i> &nbsp;&nbsp;Crear Nuevo Ticket</h2>
                        </div>
                    </div>
            	</header>

                 <div class="window">
                    <div class="col-sm-12">
                    
                    
                    <div class="inner-padding form-horizontal"> 
 								<div class="col-sm-12">	    
 									<h4 class="sectionTitle">
										<i class="fa fa-folder-open text-muted"></i> &nbsp;Informaci&oacute;n General
									</h4>
									</div>
										<div class="spacer-50"> </div>
									<div class="col-sm-3">
										<label for="txtFolio">Fecha:</label> <input type="text"
											name="txtFecha" class="form-control"
											value="<?php echo date('Y-m-d'); ?>" readonly="readonly" />
									</div>
									
									<div class="col-sm-3">
		                                                    <label for="txtFolio">Fecha de Resoluci&oacute;n:</label>
		                                                    <input type="text" placeholder="AAAA-MM-DD" id="txtFechaResolucion" class="form-control datepicker" value="<?php echo $arrDatosTickets['fechaResolucion'];?>"/> 
	                                                	</div>
                                                        <div class="col-sm-3">
		                                                    <label for="txtFolio">Estatus:</label>
		                                                    <input type="text" name="txtEstatus" class="form-control" value="Nuevo" readonly /> 
	                                                	</div>
                                                        <div class="col-sm-3">
		                                                    <label for="txtFolio">Folio:</label>
		                                                    <input type="text" name="txtFolio" class="form-control" readonly /> 
	                                                	</div>
	                                            
                                                <div class="spacer-10">&nbsp;</div>
                                                        <div class="col-sm-3">
		                                                    <label for="txtCategorias">Categor&iacute;as</label>
		                                                    <select name="txtCategoria" id="slcCategorias" class="form-control">
		                                                    <option value="">Seleccione una opci&oacute;n</option>
		                                                    <?php
		                                                    foreach ($arrCategoria as $idCat => $nombre)
																echo '<option value="' . $idCat . '" > '.$nombre.' </option>';
															?>
		                                                    </select>
	                                                	</div>
	                                                	
	                                                	<div class="col-sm-3">
                                                            <label for="txtTipoSolicitud">Tipo de Solicitud:</label>
                                                            <select name="txtTipoSolicitud" id="slcTipoSolicitud" class="form-control ">
                                                            <?php 
                                                              	foreach ($arrSolicitudes as $idTipo => $nombre)
                                                              	echo  '<option value="' . $idTipo . '" > '.$nombre.' </option>';
                                                              	?>
                                                            </select>
                                                        </div>
                                                        
	                                                	<div class="col-sm-3">
                                                            <label for="txtAsignacion">Asignar a:</label>
                                                            <input type="hidden" id="idPerfilActual" value="<?php echo $_SESSION['id_perfil']; ?>" />
                                                           <?php if ($objSession->getIdRol()>3){?> 
                                                            <select name="txtAsignacion" class="form-control " id="slcAsignacion" >
                                                            <option value="">Seleccione una opci&oacute;n</option>
		                                                    <?php
		                                                    foreach ($arrUser as $idU => $nombre)
																echo '<option value="' . $idU . '"> '.$nombre.' </option>';
															?>
		                                                    </select>
                                                           <?php } else {?>
                                                            <input type="hidden" id="slcAsignacion" name="txtAsignacion" value="<?php echo $perfilAsignado; ?>" />
                                                            <input type="text" name="txtAdmin" class="form-control" value="Administrador" readonly />
                                                            <?php }?>
                                                        </div>                                                                                                                
	                                                
                                                        <div class="col-sm-3">
                                                            <label for="txtPrioridad">Prioridad:</label>
                                                            <select name="txtPrioridad" class="form-control " id="slcPrioridad"> 
                                                           	<?php
		                                                    foreach ($arrPrioridad as $idPrioridad => $nombre)
																echo '<option value="' . $idPrioridad. '" > '.$nombre.' </option>';
															?>
		                                                    </select>
                                                        </div>
                                               
                                                
                                                <div class="col-sm-12">
	                                                <div class="spacer-20"></div>
    	                                            <hr />
    	                                             <div class="spacer-20"></div>
    	                                            <h4 class="sectionTitle">
    	                                            <i class="fa fa-folder-open text-muted"></i> &nbsp;Detalles de Solicitud
    	                                            </h4> 
    	                                        </div>
                                                
                                                
                                                <div class="col-sm-12">
                                                	<div class="spacer-20"></div>
                                                	<div class="row">
                                                        <div class="col-sm-12">
                                                            <label for="txtTitulo">Titulo o Asunto:</label>
		                                                    <input type="text" id="txtTitulo" class="form-control"  />
                                                        </div>
                                                    </div>
                                                	<div class="spacer-10">&nbsp;</div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label for="txtResumen">Detalles del problema:</label>
                                                            <textarea class="form-control" id="txtResumen" name="txtResumen2" style=""></textarea>

                                                        </div>
<script>
	var editor=CKEDITOR.replace('txtResumen2');
	</script>
  	                                                    </div>
                                                </div>
                            					
                            					
                   
                            					 <div class="col-sm-12">
	                                                <div class="spacer-20"></div>
    	                                            <hr />
    	                                             <div class="spacer-20"></div>
    	                                            <h4 class="sectionTitle"><i class="fa fa-cloud-upload text-muted"></i> &nbsp;Adjuntar Documentos</h4> 
    	                                        </div>
    	                                        <div class="spacer-20"></div>
    	                                        <div class="col-sm-4">
									<div class="row row_archivos">
										<div class="col-sm-12">
										<div id="msjErrorArchivo" ></div>
										</div>
										<div class="spacer-10"></div>
										
										<div class="col-sm-8">
											<label for="image">Archivo 
											</label> <input type="file" name="archivoImagen" id="archivoImagen"  accept="image/*" />
											<div class="spacer-10"></div>
											<label>Descripci&oacute;n</label>
											<input type="text" name="txtDescripcionImagen" id="txtDescripcionImagen" class="form-control"  />
										</div>

										<div class="col-sm-3">
											<a href="javascript:agregar_archivo();" 
												class="btn btn-wide btn-primary"> <i class="fa fa-plus"></i>
												Agregar
											</a>
										</div>
									</div>
								</div>


								<div class="col-sm-8">
									<div class="table-wrapper" style="display: none" id="tablaArchivos">
										<header>
											<h3>Mis archivos</h3>
										</header>
										<div class="rt-table" id="divTabla">
											<table class="table table-bordered table-striped" id="tb1"
												data-rt-breakpoint="600">
												<thead>
													<tr>
														<th scope="col" colspan="2" data-rt-column="Archivo">Archivo</th>
														<th scope="col" colspan="3" data-rt-column="Descripcion">Descipci&oacute;n</th>
														<th scope="col" data-rt-column="Opciones">Opciones</th>
													</tr>
												</thead>
												
												<tbody id="contenedor_tabla">
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="spacer-20"></div>
    	                                        
    	                                        
    	                                        <div class="col-sm-12">
    	                                        	<div class="spacer-20"></div>
                                                    	<div class="col-sm-12">
                                                    		<div class="pull-right">
                                                    		<button class="btn btn-default" id="btnCancelar" name="btnCancelar"> Cancelar </button>												
												<button class="btn btn-primary" id="btnGuardar" name="btnGuardar"> Guardar </button>
	                                                    	</div>
                                                    </div>
    	                                        </div>
                            					
									
									<div class="spacer-50"> </div>
								</div>
								
                        
                    </div>
                </div><!-- End .window -->

                <?php include_once('footer.php'); ?>
                
                
            </div><!-- End #content -->
            
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
              
    	</div>
    	<!-- End #main -->
    </div>
    <!-- End #container --> 
</body>
</html>