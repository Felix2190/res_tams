<?php
//error_reporting(E_ALL);
//ini_set("display_errors","1");

require("masterIncludeLogin.inc.php");
$route = 'menu_soporte';
	$submenu = 'sub_ticket';
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

	<head>
		<title>Nuevo Usuario</title>
		<!-- start: META -->
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: GOOGLE FONTS -->
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<!-- end: GOOGLE FONTS -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<!-- end: MAIN CSS -->

				<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		<link rel="stylesheet" href="vendor/jquery-ui/jquery-ui-1.10.1.custom.min.css" />
			    
    <!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<script type="text/javascript" src="js/lib/jquery.numeric.js"></script>
		        
	</head>

	<body>
		<div id="app">

			<?php include_once('nav.php'); ?>


			<div class="app-content">
				<?php include_once('header.php'); ?>

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: DASHBOARD TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Alta de Usuario</h1>
								</div>
							</div>
						</section>
						<!-- end: DASHBOARD TITLE -->

						<!-- start: FEATURED BOX LINKS -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
                            
                                <div class="col-sm-12">
                                <div class="inner-padding form-horizontal"> 
                                <form role="form" class="form-horizontal" id="frmLogin" name="frmLogin">
                                			
                                			<h3 class="sectionTitle">
										Datos de contacto
									</h3>
									<br />
										
									<div class="form-group">
                                			<div class="col-sm-2 text-right  ">
												<label for="txtNombres" class="txtNombres">Nombre</label>
											</div>
											<div class="col-sm-8">
												<input type="text" name="txtNombres" id="txtNombres" class="form-control txtNombres"  />
											</div>
								</div>
								<div class="form-group">
                    		            <div class="col-sm-2 text-right  ">
												<label for="txtPaterno" class="txtPaterno">Apellido Paterno</label>
											</div>

											<div class="col-sm-8 txtPaterno">
												<input type="text" name="txtPaterno" id="txtPaterno" class="form-control txtPaterno"   />
											</div>

									</div>
									
									
									<div class="form-group">
											<div class="col-sm-2 text-right ">
												<label for="txtMaterno" class="txtMaterno">Apellido Materno</label>
											</div>

											<div class="col-sm-8 txtMaterno">
												<input type="text" name="txtMaterno" id="txtMaterno" class="form-control txtMaterno"  />
											</div>

									</div>
									
									<div class="form-group">
									
										<div class="col-sm-2 text-right  ">
												<label for="txtEmail" class="">Correo electr&oacute;nico</label>
											</div>
											<div class="col-sm-3">
												<input type="text" name="txtEmail" id="txtEmail" class="form-control"  />
											</div>
											
											<div class="col-sm-2 text-right  ">
												<label for="txtRazon" class="">Raz&oacute;n Social</label>
											</div>
											<div class="col-sm-3">
												<input type="text" name="txtRazon" id="txtRazon" class="form-control"  />
											</div>
											
								</div>
								
								<div class="form-group">
											<div class="col-sm-2 text-right">
												<label for="slc" class="slcPais">Pa&iacute;s</label>
											</div>

											<div class="col-sm-3">
											<input type="hidden" name="hPais" id="hPais"  />
												<select class="form-control slcPais" id="slcPais" name="slcPais">
												<option value="">Seleccione una opci&oacute;n</option>
											    </select>
											</div>
											
									</div>
									
									
								<div class="form-group">
											
											<div class="col-sm-2 text-right">
												<label for="slc" class="slcCP">C&oacute;digo Postal</label>
											</div>

											<div class="col-sm-3">
												<input type="text" name="txtCP" maxlength="5" id="txtCP" class="form-control txtCP numeric cp"  />
											</div>
											<div class="mexico"><a onclick="buscarCP('')" class="btn btn-default btn-circle"><i class="fa fa-search"></i></a></div>
											
								</div>
								
								
											<div class="mexico" style="display: <?php echo $paisMX;?>">
								<div class="form-group">			
											<div class="col-sm-2 text-right">
												<label for="slc" class="slcEstado">Estado</label>
											</div>
											<input type="hidden" name="txtEstadoN" id="txtEstadoN"  />
											<div class="col-sm-3">
												<select class="form-control " id="slcEstado" name="slcEstado" disabled>
												<?php 
												foreach ($arrEstados as $id=>$estado)
													echo '<option value="'.$id.'" '.($arrDatos['Cestado']==$id?' selected':'').'>'.$estado.'</option>';
												?>
											    </select>
											</div>
											
											<div class="col-sm-2 text-right">
												<label for="slc" class="slcMunicipio">Municipio/Delegaci&oacute;n</label>
											</div>
											<input type="hidden" name="txtMunicipioN" id="txtMunicipioN"  />
											<div class="col-sm-3">
												<select class="form-control slcMunicipio" id="slcMunicipio" name="slcMunicipio" disabled>
												<?php 
												foreach ($arrMunicipios as $id=>$muni)
													echo '<option value="'.$id.'" '.($arrDatos['Cmunicipio']==$id?' selected':'').'>'.$muni.'</option>';
												?>
											    </select>
											</div>
												
								</div>
								
								<div class="form-group">
											<div class="col-sm-2 text-right">
												<label class="txtCiudad">Ciudad</label>
											</div>

											<div class="col-sm-3">
												<input type="text" name="txtCiudad" id="txtCiudad" class="form-control"  />
											</div>
											
											
											<div class="col-sm-2 text-right">
												<label for="slc" class="slcColonia">Colonia</label>
											</div>
											<input type="hidden" name="txtColoniaN" id="txtColoniaN" />
											<div class="col-sm-3">
												<select class="form-control slcColonia" id="slcColonia" name="slcColonia" disabled>
												<?php if (!empty ( $arrDatos ['Ccolonia'] )) 
															echo '<option value="'.$arrDatos['Ccolonia'].'">'.$arrDatos['CcoloniaN'].'</option>';
													else 
														echo '<option value="">Seleccione una opci&oacute;n</option>';
													?>
											    </select>
											</div>
											
								</div>	
											</div>
								<!-- ---------------------------------------------------------------------------- -->
											<div class="otros" style="display: <?php echo $paisO;?>">
									<div class="form-group">
											<div class="col-sm-2 text-right">
												<label for="slc" class="slcEstado">Estado</label>
											</div>

											<div class="col-sm-3">
												<input type="text" name="txtEstado2" id="txtEstado2" class="form-control txtEstado" />
											</div>
											
											<div class="col-sm-2 text-right">
												<label class="txtCiudad2">Ciudad</label>
											</div>

											<div class="col-sm-3">
												<input type="text" name="txtCiudad2" id="txtCiudad2" class="form-control" />
											</div>
																						
										</div>	
											</div>
											
									<!-- ----------------------- -->
									
									<div class="form-group">
											<div class="col-sm-2 text-right  ">
												<label for="txt" class="txtCalle">Calle</label>
											</div>
											<div class="col-sm-8">
												<input type="text" name="txtCalle" id="txtCalle" class="form-control txtCalle" />
											</div>
										</div>
									
									<div class="form-group">	
											<div class="col-sm-2 text-right  ">
												<label for="txt" class="txtExt">No. Exterior</label>
											</div>
											<div class="col-sm-3">
												<input type="text" name="txtExt" id="txtExt" class="form-control txtExt"  />
											</div>
											
											<div class="col-sm-2 text-right  ">
												<label for="txt" class="txtInt">No. Interior</label>
											</div>
											<div class="col-sm-3">
												<input type="text" name="txtInt" id="txtInt" class="form-control txtInt"  />
											</div>
											
									</div>	
											
									<div class="form-group">
											<div class="col-sm-2 text-right  ">
												<label for="txt" class="txtTel">Tel&eacute;fono</label>
											</div>
											<div class="col-sm-3">
												<input type="text" name="txtTel" placeholder="12 digitos" maxlength="12" id="txtTel" class="form-control txtTel numeric" />
											</div>
											<input type="hidden" name="tel_longitud" id="tel_longitud" value="true" />
											
											<div class="col-sm-2 text-right  ">
												<label for="txt" class="txtExtension">Extensi&oacute;n</label>
											</div>
											<div class="col-sm-3">
												<input type="text" name="txtExtension" id="txtExtension" class="form-control txtExtension numeric"  />
											</div>
									</div>
											<hr />
											
										   <div class="subheading">
                                				<h3>Datos de Facturaci&oacute;n</h3>
                                			</div>
                                			<br />
                                			

                                	<div class="form-group">
                                			<div class="col-sm-3 text-right">
												<label><input name="default-chckFact[]" id="chckFact" type="checkbox"><span></span> Utilizar los datos de contacto</label>
											</div>
									</div>

									<div class="form-group">
											<div class="col-sm-2 text-right  ">
												<label for="txtFEmpresa" class="txtFEmpresa">Empresa</label>
											</div>
											<div class="col-sm-8">
												<input type="text" name="txtFEmpresa" id="txtFEmpresa" class="form-control txtFEmpresa" />
											</div>
											
										</div>
										
                                <div id="divFact" style="display: <?php echo $bol_fact;?>">
                                			
                                <div class="form-group">
                                			<div class="col-sm-2 text-right  ">
												<label for="txtFNombres" class="txtFNombres">Nombre</label>
											</div>
											<div class="col-sm-8">
												<input type="text" name="txtFNombres" id="txtFNombres" class="form-control txtFNombres" />
											</div>
								</div>
								
								<div class="form-group">
                                <div class="col-sm-2 text-right  ">
												<label for="txtFPaterno" class="txtFPaterno">Apellido Paterno</label>
											</div>

											<div class="col-sm-8 txtFPaterno">
												<input type="text" name="txtFPaterno" id="txtFPaterno" class="form-control txtFPaterno"/>
											</div>

								</div>
									
											
									<div class="form-group">
											<div class="col-sm-2 text-right ">
												<label for="txtFMaterno" class="txtFMaterno">Apellido Materno</label>
											</div>

											<div class="col-sm-8 txtFMaterno">
												<input type="text" name="txtFMaterno" id="txtFMaterno" class="form-control txtFMaterno"/>
											</div>
									</div>		
								

							<div class="form-group">
										<div class="col-sm-2 text-right  ">
												<label for="txtFEmail" class="">Correo electr&oacute;nico</label>
											</div>
											<div class="col-sm-3">
												<input type="text" name="txtFEmail" id="txtFEmail" class="form-control" />
											</div>
											
											<div class="col-sm-2 text-right  ">
												<label for="txtFRazon" class="">Raz&oacute;n Social</label>
											</div>
											<div class="col-sm-3">
												<input type="text" name="txtFRazon" id="txtFRazon" class="form-control" />
											</div>
											
									</div>
									
									<div class="form-group">
											<div class="col-sm-2 text-right">
												<label for="slcF" class="slcFPais">Pa&iacute;s</label>
											</div>

											<div class="col-sm-3">
											<input type="hidden" name="hFPais" id="hFPais"  />
												<select class="form-control slcFPais" id="slcFPais" name="slcFPais" >
												<option value="">Seleccione una opci&oacute;n</option>
											    </select>
											</div>
											
									</div>
											
									<div class="form-group">
											<div class="col-sm-2 text-right">
												<label for="slcF" class="slcFCP">C&oacute;digo Postal</label>
											</div>

											<div class="col-sm-3">
												<input type="text" name="txtFCP" id="txtFCP" maxlength="5" class="form-control txtFCP cp numeric"/>
											</div>
											<div class="mexicoF"><a onclick="buscarCP('F')" class="btn btn-default btn-circle"><i class="fa fa-search"></i></a></div>
									</div>
										
									<div class="mexicoF" style="display: <?php echo $paisMXF;?>">
									
									<div class="form-group">
											<div class="col-sm-2 text-right">
												<label for="slcF" class="slcFEstado">Estado</label>
											</div>
											<input type="hidden" name="txtFEstadoN" id="txtFEstadoN" />
											<div class="col-sm-3">
												<select class="form-control slcFEstado" id="slcFEstado" name="slcFEstado" disabled>
												<?php 
												foreach ($arrEstados as $id=>$estado)
													echo '<option value="'.$id.'" '.($arrDatos['Festado']==$id?' selected':'').'>'.$estado.'</option>';
												?>
											    </select>
											</div>
											
											<div class="col-sm-2 text-right">
												<label for="slcF" class="slcFMunicipio">Municipio/Delegaci&oacute;n</label>
											</div>
											<input type="hidden" name="txtFMunicipioN" id="txtFMunicipioN"  />
											<div class="col-sm-3">
												<select class="form-control slcFMunicipio" id="slcFMunicipio" name="slcFMunicipio" disabled>
												<?php 
												foreach ($arrMunicipios as $id=>$muni)
													echo '<option value="'.$id.'" '.($arrDatos['Fmunicipio']==$id?' selected':'').'>'.$muni.'</option>';
												?>
											    </select>
											</div>
												
									</div>
									
									<div class="form-group">
											<div class="col-sm-2 text-right">
												<label class="txtFCiudad">Ciudad</label>
											</div>

											<div class="col-sm-3">
												<input type="text" name="txtFCiudad" id="txtFCiudad" class="form-control"  />
											</div>
																						
											<div class="col-sm-2 text-right">
												<label for="slcF" class="slcFColonia">Colonia</label>
											</div>
											<input type="hidden" name="txtFColoniaN" id="txtFColoniaN"  />
											<div class="col-sm-3">
												<select class="form-control slcFColonia" id="slcFColonia" name="slcFColonia"  disabled >
												<?php if (!empty ( $arrDatos ['Fcolonia'] )) 
															echo '<option value="'.$arrDatos['Fcolonia'].'">'.$arrDatos['FcoloniaN'].'</option>';
													else 
														echo '<option value="">Seleccione una opci&oacute;n</option>';
													?>
											    </select>
											</div>
									</div>
									</div>
									
											<!-- ---------------------------------------------------------------------------- -->
									<div class="otrosF" style="display: <?php echo $paisOF;?>">
									<div class="form-group">
											<div class="col-sm-2 text-right">
												<label for="slc" class="slcFEstado">Estado</label>
											</div>

											<div class="col-sm-3">
												<input type="text" name="txtFEstado2" id="txtFEstado2" class="form-control txtFEstado2" />
											</div>
											
											<div class="col-sm-2 text-right">
												<label class="txtFCiudad2">Ciudad</label>
											</div>

											<div class="col-sm-3">
												<input type="text" name="txtFCiudad2" id="txtFCiudad2" class="form-control" />
											</div>
																						
									</div>		
											</div>
											
									<!-- ----------------------- -->
								
									<div class="form-group">		
											<div class="col-sm-2 text-right  ">
												<label for="txtF" class="txtFCalle">Calle</label>
											</div>
											<div class="col-sm-8">
												<input type="text" name="txtFCalle" id="txtFCalle" class="form-control txtFCalle" />
											</div>
									</div>
									
									<div class="form-group">		
											<div class="col-sm-2 text-right  ">
												<label for="txtF" class="txtFExt">No. Exterior</label>
											</div>
											<div class="col-sm-3">
												<input type="text" name="txtFExt" id="txtFExt" class="form-control txtFExt" />
											</div>
											
											<div class="col-sm-2 text-right  ">
												<label for="txtF" class="txtFInt">No. Interior</label>
											</div>
											<div class="col-sm-3">
												<input type="text" name="txtFInt" id="txtFInt" class="form-control txtFInt" />
											</div>
											
									</div>
									
									<div class="form-group">		
											<div class="col-sm-2 text-right  ">
												<label for="txtF" class="txtFTel">Tel&eacute;fono</label>
											</div>
											<div class="col-sm-3">
												<input type="text" name="txtFTel" id="txtFTel" placeholder="12 digitos" maxlength="12" class="form-control numeric txtFTel "/>
											</div>
											<input type="hidden" name="telF_longitud" id="telF_longitud" value="true" />
											
											<div class="col-sm-2 text-right  ">
												<label for="txtF" class="txtFExtension">Extensi&oacute;n</label>
											</div>
											<div class="col-sm-3">
												<input type="text" name="txtFExtension" id="txtFExtension" class="form-control txtFExtension numeric"/>
											</div>
											
								</div>
											
								</div>
								
								<div class="form-group">
											<div class="col-sm-2 text-right ">
												<label for="txtF" class="txtFRFC">RFC</label>
											</div>
						
						
											<div class="col-sm-8 txtF">
												<input type="text" name="txtFRFC" id="txtFRFC" class="form-control txtFRFC" />
											</div>
											
								</div>
											
											<hr />
											
										   <div class="subheading">
                                				<h3>Configuraci&oacute;n de la cuenta</h3>
                                			</div>
                                <div class="form-group">			
											<div class="col-sm-2 text-right">
												<label for="slcF" class="slcFPlan">Plan</label>
											</div>
											<div class="col-sm-3">
											<input type="hidden" name="hPlan" id="hPlan" />
												<select class="form-control slcFPlan" id="slcFPlan" name="slcFPlan" >
												<option value="">Seleccione una opci&oacute;n</option>
												</select>
											</div>
											
											<div class="col-sm-2 text-right">
												<label for="slcF" class="slcFPTipoPlan">Tipo de plan</label>
											</div>

											<div class="col-sm-3">
												<select class="form-control slcFTipoPlan" id="slcFTipoPlan" name="slcFTipoPlan" >
												</select>
											</div>
												
											
								</div>
								
								<div class="form-group">			
											<div class="col-sm-2 text-right">
												<label for="slcF" class="slcRuta">Ruta</label>
											</div>

											<div class="col-sm-3">
											<input type="hidden" name="hRuta" id="hRuta" />
												<select class="form-control slcRuta" id="slcRuta" name="slcRuta" >
												<option value="">Seleccione una opci&oacute;n</option>
												</select>
											</div>
												
											<div class="col-sm-2 text-right">
												<label for="slcF" class="slcFEstatus">Estatus</label>
											</div>

											<div class="col-sm-3">
											<input type="hidden" name="hEstatus" id="hEstatus" />
												<select class="form-control slcEstatus" id="slcEstatus" name="slcEstatus" >
												<option value="">Seleccione una opci&oacute;n</option></select>
											</div>
											
									</div>
									
								<div class="form-group">		
											<div class="col-sm-2 text-right  ">
												<label for="txtF" class="txtMoneda">Moneda</label>
											</div>
											<input type="hidden" name="txtMonedaID" id="txtMonedaID" />
											<input type="hidden" name="txtMonedaN" id="txtMonedaN" />
											<div class="col-sm-3">
												<input type="text" name="txtMoneda" id="txtMoneda" class="form-control txtMoneda"  />
											</div>
											
									</div>		
											
											<hr />
											
										   <div class="subheading">
                                				<h3>CRM</h3>
                                			</div>
                                			
                                <div class="form-group">
                                			<div class="col-sm-2 text-right">
												<label for="slc" class="slcUserName">UserName</label>
											</div>

											<div class="col-sm-3">
												<input type="text" name="txtUserName" maxlength="12" id="txtUserName" class="form-control txtUserName"/>
											</div>
											<div class="col-sm-1">
											<a onclick="buscarUserName()" class="btn btn-default btn-circle"><i class="fa fa-search"></i></a>
											</div>
											<div class="col-sm-1">
											<div id="respUserName">
											<input type="hidden" name="bol_user" id="bol_user" value="false" />
											</div>
											</div>
									</div>
									
								<div class="form-group">		
											<div class="col-sm-2 text-right">
												<label for="slcF" class="slcIdiomaFac">Idioma para factura</label>
											</div>
											<div class="col-sm-3">
											<input type="hidden" name="hIdiomaFac" id="hIdiomaFac" />
												<select class="form-control slcIdiomaFac" id="slcIdiomaFac" name="slcIdiomaFac">
												<option value="">Seleccione una opci&oacute;n</option>
												</select>
											</div>
											
											<div class="col-sm-2 text-right">
												<label for="slcF" class="slcIdiomaCRM">Idioma CRM</label>
											</div>

											<div class="col-sm-3">
											<input type="hidden" name="hIdiomaCRM" id="hIdiomaCRM" />
												<select class="form-control slcIdiomaCRM" id="slcIdiomaCRM" name="slcIdiomaCRM" >
												<option value="">Seleccione una opci&oacute;n</option>
												</select>
											</div>
											
											
											
								</div>
								
								<br />

													<div class="pull-right">
															<button class="btn btn-default" id="btnCancelar" name="btnCancelar"> Cancelar </button>												
												<button class="btn btn-primary" id="btnAltaUsuario" name="btnAltaUsuario"> Guardar </button>
													</div>
													
													</form>
													
													</div>
													
												</div>
												<div class="spacer-40"></div>
                            </div>
						</div>
						<!-- end: FEATURED BOX LINKS -->

					</div>
				</div>
			</div>
			<?php include_once('footer.php'); ?>
			
			
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
		</div>
		
		
		<?php
			echo $_JAVASCRIPT_CSS;
		?>
		
	</body>
</html>
