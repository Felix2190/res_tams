<?php

namespace Microsoft\Office365\UnifiedAPI\Connect;
require_once ('include/AuthenticationManager.php');
require("masterInclude.inc.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    AuthenticationManager::connect();

}
 
	
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

	<head>
		<title>Planet Communication Login </title>
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
		<!-- <link rel="stylesheet" href="js/lib/jquery.alerts-1.1/jquery.alerts.css"> -->


		<script src="vendor/jquery/jquery.min.js"></script>
		<!--  <script src="js/lib/jquery.alerts-1.1/jquery.alerts.js"></script> -->



		<?php
			echo $_JAVASCRIPT_CSS;
		?>

	</head>

	<body class="login">
		<!-- start: LOGIN -->
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
					<img src="assets/images/logoBig.png" alt="Planet Communication"/>
				</div>
				<!-- start: LOGIN BOX -->
				<div class="box-login">
					<form class="form-login" id="frmLogin"  method="post">
					
							
						<fieldset>
							<legend>
								Ingresa a tu cuenta (Externo)
							</legend>
							<p>
								Usa tu usuario y contrase&ntilde;a
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" id="username" name="username" placeholder="Usuario">
									<i class="fa fa-user"></i> </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" id="pass" name="password" placeholder="Contrase&ntilde;a">
									<i class="fa fa-lock"></i>
									<a class="forgot" href="#">
										Olvid&eacute; mi contrase&ntilde;a
									</a> </span>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary pull-right" id="btnEnviar">
									Iniciar Sesi&oacute;n <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>

							

							<div class="new-account">
								A&uacute;n no tienes una cuenta?
								<a href="#">
									Crea una cuenta
								</a>
							</div>
						
					</form>
					<!-- start: COPYRIGHT -->
					<div class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> Planet Communication</span>.<br /><span>All rights reserved</span>
					</div>
					<!-- end: COPYRIGHT -->
				</div>
				<!-- end: LOGIN BOX -->
			</div>
		</div>



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




		<!-- end: LOGIN -->
		<!-- start: MAIN JAVASCRIPTS -->

		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/login.js"></script>
		<script>
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
	<!-- end: BODY -->
</html>