<?php
	header("Location: index.php");
	
	
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

    <title>DRIVE ID Login</title>
    <link rel="shortcut icon" href="images/favicons/favicon.ico" />
    
    <meta name="application-name" content="DRIVE ID Licencias">
    <meta name="msapplication-TileColor" content="#333333" />
    <!-- // Handheld devices misc // -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="HandheldFriendly" content="true"/>   
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
    
    <!-- // Stylesheets // -->
    
    
    <link rel="stylesheet" href="bootstrap/core/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-custom.css"/>
    <link rel="stylesheet" href="css/bootstrap-extended.css"/>
    <link rel="stylesheet" href="css/light-theme.css"/>
    <link rel="stylesheet" href="css/login.css"/>
    
    <script src="js/plugins/modernizr.min.js"></script> 
    <script src="js/plugins/mobiledevices.js"></script>
    <script src="js/libs/jquery-1.11.0.min.js"></script>
    <script src="js/libs/jquery-ui-1.10.4.min.js"></script>
    <script src="bootstrap/core/dist/js/bootstrap.min.js"></script>
    <script src="js/plugins/showpassword.1.0.min.js"></script>
    <script src="js/plugins/nanogress.1.0.min.js"></script>
    <script src="js/plugins/powerwizard.1.0.min.js"></script>    
    <script src="js/plugins/jquery.pwstrength.min.js"></script>

    <script src="js/plugins/login.js"></script>
    <?php
		echo $_JAVASCRIPT_CSS;
	?>
</head>

<body> 
	<div id="container-login" class="clearfix"> 
    	
    	<div class="spacer-40"></div>
    			<div class="logo margin-top-30">
					<img src="images/theme/logobw.png" alt="Planet Communication"/>
				</div>
        				<div class="box-login">
        				
        								<form class="form-login" id="frmLogin"  method="post">
					
							
						<fieldset>
							<legend style="">
								
								Ingresa a tu cuenta (Externo)
								
							</legend>
							<p>
								
							</p>
							<div class="form-group">
								<span class="input-icon">
								<i class="fa fa-user"></i>Usuario
									<input type="text" class="form-control" id="username" name="username" placeholder="Usuario">
									 </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
								<i class="fa fa-lock"></i>Contrase&ntilde;a
									<input type="password" class="form-control password" id="pass" name="password" placeholder="Contrase&ntilde;a">
									
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
						</fieldset>
					</form>
					<!-- start: COPYRIGHT -->
					<div class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> ABG Technology</span>.<br /><span>All rights reserved</span>
					</div>
					<!-- end: COPYRIGHT -->
				</div>
				<!-- end: LOGIN BOX -->
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
		
        <footer id="login-footer">
            <strong>Copyright © 2016 Planet Communication </strong>
            <div class="spacer-5"></div>
            <small><a href="wwww.planetcommunication.net">http://planetcommunication.net</a></small>
        </footer>
        
    </div>
</body>
</html>