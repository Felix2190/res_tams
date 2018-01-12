<?php
	require("masterIncludeLogin.inc.php");
//	require 'admintickets.php';
	$subnav = 'rol';
  require_once FOLDER_MODEL_EXTEND . "model.rol.inc.php";
  require_once FOLDER_MODEL_EXTEND . "model.rol_permisos.inc.php";  
  $rol = new ModeloRol();
  $rol_permisos = new ModeloRol_permisos();
  $rol->setId_rol($_POST['id']);
  $permisos = $rol_permisos->getPermisosRoles($_POST['id']);  
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

    <title>Alta rol</title>

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
     <style>
		 input[type="text"].isError,select.isError,input[type="number"].isError
	    {
	    	color:#b94a48;
	    	border-color:#b94a48;	    	
	    }

	    input[type="text"].isOk,select.isOk,input[type="number"].isOk
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
    
    <script src="js/Chart.js/Chart.min.js"></script>   
    <script src="js/plugins/generics.js"></script>  
    
    <script src="js/lib/jquery.formatCurrency-1.4.0.js"></script>
	    <script src="js/lib/i18n/jquery.formatCurrency.es-MX.js"></script>
    	<script type="text/javascript" src="js/lib/jquery.numeric.js"></script>
    	
    	<script type="text/javascript">
        function applyFormatCurrency(sender) {
            $(sender).formatCurrency({
                region: 'es-MX'
                , roundToDecimalPlace: -1
            });
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
                            <h2>Editar Rol</h2>                 
                        </div> 
                    </div>
            	</header>


                                     
                <div class="window">  
                    <div class="row ext-raster">
                    	<div class="col-sm-12">
                            <div class="row">
                            	<div class="col-sm-12">
                                    <div class="inner-padding">								
                                        	
                                        
                                        
                                        
                                        
					<!-- start: FEATURED BOX LINKS -->
						<div class="container-fluid container-fullw bg-white">
						
							<div class="row">
								
								<div class="col-md-12">

                
        					<div class="inner-padding">
        
        						<div class="col-sm-12">
                

                          <div class="inner-padding ">	
            								<div class="subheading">
            									<h3>Datos Generales</h3>
            								</div>
                            <input type="hidden" value="<?php echo $_POST['id']; ?>" id="id" />          
            								<div class="form-group">
            									<label class="col-sm-3 control-label txtNombres"
            										for="txtNombre"> Nombre </label>
            									<div class="col-sm-9">
            										<input id="txtNombre" class="form-control" type="text" value="<?php echo $rol->getNombre(); ?>" maxlength="50" />
            									</div>
            								</div>
                            <div class="spacer-20"></div> 
                            <div class="row">  
          										<div class="col-sm-3 text-right">
          											<label></label>
          										</div>
                              <div class="col-sm-9">
                                <div class="col-sm-3">
                                  <label>Lectura</label><br /> 
                                </div>
                                <div class="col-sm-3">
                                  <label>Edici&oacute;n</label> 
                                </div>
                                <div class="col-sm-3">
                                  <label>Agregar Registro</label> 
                                </div>
                                <div class="col-sm-3">
                                  <label>Eliminar Registro</label> 
                                </div>   
                              </div>
                           </div>          
                           <div class="spacer-20"></div>
          									<div class="row">
          										<div class="col-sm-3 text-right">
          											<label>Turnos</label>
          										</div>                  
                              <div class="col-sm-9">
                                <div class="col-sm-3">
                                  <input type="checkbox" name="turnos[]" value="1"  class="chk_lectura" <?php if($permisos['turnos']==1 || $permisos['turnos']==3 || $permisos['turnos']==5 || $permisos['turnos']==7 || $permisos['turnos']==9 || $permisos['turnos']==11 || $permisos['turnos']==13 || $permisos['turnos']==15){ echo 'checked="checked"'; } ?> /> 
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="turnos[]" value="2" <?php if($permisos['turnos']==2 || $permisos['turnos']==3 || $permisos['turnos']==6 || $permisos['turnos']==7 || $permisos['turnos']==10 || $permisos['turnos']==11 || $permisos['turnos']==14 || $permisos['turnos']==15){ echo 'checked="checked"'; } ?> /> 
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="turnos[]" value="4" <?php if($permisos['turnos']==4 || $permisos['turnos']==5 || $permisos['turnos']==6 || $permisos['turnos']==7 || $permisos['turnos']==12 || $permisos['turnos']==13 || $permisos['turnos']==14 || $permisos['turnos']==15){ echo 'checked="checked"'; } ?> /> 
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="turnos[]" value="8" <?php if($permisos['turnos']==8 || $permisos['turnos']==9 || $permisos['turnos']==10 || $permisos['turnos']==11 || $permisos['turnos']==12 || $permisos['turnos']==13 || $permisos['turnos']==14 || $permisos['turnos']==15){ echo 'checked="checked"'; } ?> /> 
                                </div>  
                              </div>
          									</div>
                            <div class="spacer-20"></div>
                            <div class="row">
          										<div class="col-sm-3 text-right">
          											<label>Verificaci&oacute;n</label>
          										</div>                  
                              <div class="col-sm-9">
                                <div class="col-sm-3">
                                  <input type="checkbox" name="verificacion[]" value="1"  class="chk_lectura" <?php if($permisos['verificacion']==1 || $permisos['verificacion']==3 || $permisos['verificacion']==5 || $permisos['verificacion']==7 || $permisos['verificacion']==9 || $permisos['verificacion']==11 || $permisos['verificacion']==13 || $permisos['verificacion']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="verificacion[]" value="2" <?php if($permisos['verificacion']==2 || $permisos['verificacion']==3 || $permisos['verificacion']==6 || $permisos['verificacion']==7 || $permisos['verificacion']==10 || $permisos['verificacion']==11 || $permisos['verificacion']==14 || $permisos['verificacion']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="verificacion[]" value="4" <?php if($permisos['verificacion']==4 || $permisos['verificacion']==5 || $permisos['verificacion']==6 || $permisos['verificacion']==7 || $permisos['verificacion']==12 || $permisos['verificacion']==13 || $permisos['verificacion']==14 || $permisos['verificacion']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="verificacion[]" value="8" <?php if($permisos['verificacion']==8 || $permisos['verificacion']==9 || $permisos['verificacion']==10 || $permisos['verificacion']==11 || $permisos['verificacion']==12 || $permisos['verificacion']==13 || $permisos['verificacion']==14 || $permisos['verificacion']==15){ echo 'checked="checked"'; } ?> />
                                </div>  
                              </div>
          									</div>
                            <div class="spacer-20"></div>          
                            <div class="row">
          										<div class="col-sm-3 text-right">
          											<label>M&oacute;dulo I Datos</label>
          										</div>                  
                              <div class="col-sm-9">
                                <div class="col-sm-3">
                                  <input type="checkbox" name="modulo1[]" value="1"  class="chk_lectura" <?php if($permisos['modulo1']==1 || $permisos['modulo1']==3 || $permisos['modulo1']==5 || $permisos['modulo1']==7 || $permisos['modulo1']==9 || $permisos['modulo1']==11 || $permisos['modulo1']==13 || $permisos['modulo1']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="modulo1[]" value="2" <?php if($permisos['modulo1']==2 || $permisos['modulo1']==3 || $permisos['modulo1']==6 || $permisos['modulo1']==7 || $permisos['modulo1']==10 || $permisos['modulo1']==11 || $permisos['modulo1']==14 || $permisos['modulo1']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="modulo1[]" value="4" <?php if($permisos['modulo1']==4 || $permisos['modulo1']==5 || $permisos['modulo1']==6 || $permisos['modulo1']==7 || $permisos['modulo1']==12 || $permisos['modulo1']==13 || $permisos['modulo1']==14 || $permisos['modulo1']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="modulo1[]" value="8" <?php if($permisos['modulo1']==8 || $permisos['modulo1']==9 || $permisos['modulo1']==10 || $permisos['modulo1']==11 || $permisos['modulo1']==12 || $permisos['modulo1']==13 || $permisos['modulo1']==14 || $permisos['modulo1']==15){ echo 'checked="checked"'; } ?> />
                                </div>  
                              </div>
          									</div>
                            <div class="spacer-20"></div> 
                            <div class="row">
          										<div class="col-sm-3 text-right">
          											<label>M&oacute;dulo II Ex&aacute;menes</label>
          										</div>                  
                              <div class="col-sm-9">
                                <div class="col-sm-3">
                                  <input type="checkbox" name="modulo2[]" value="1"  class="chk_lectura" <?php if($permisos['modulo2']==1 || $permisos['modulo2']==3 || $permisos['modulo2']==5 || $permisos['modulo2']==7 || $permisos['modulo2']==9 || $permisos['modulo2']==11 || $permisos['modulo2']==13 || $permisos['modulo2']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="modulo2[]" value="2" <?php if($permisos['modulo2']==2 || $permisos['modulo2']==3 || $permisos['modulo2']==6 || $permisos['modulo2']==7 || $permisos['modulo2']==10 || $permisos['modulo2']==11 || $permisos['modulo2']==14 || $permisos['modulo2']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="modulo2[]" value="4" <?php if($permisos['modulo2']==4 || $permisos['modulo2']==5 || $permisos['modulo2']==6 || $permisos['modulo2']==7 || $permisos['modulo2']==12 || $permisos['modulo2']==13 || $permisos['modulo2']==14 || $permisos['modulo2']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="modulo2[]" value="8" <?php if($permisos['modulo2']==8 || $permisos['modulo2']==9 || $permisos['modulo2']==10 || $permisos['modulo2']==11 || $permisos['modulo2']==12 || $permisos['modulo2']==13 || $permisos['modulo2']==14 || $permisos['modulo2']==15){ echo 'checked="checked"'; } ?> />
                                </div>  
                              </div>
          									</div>
                            <div class="spacer-20"></div> 
                            <div class="row">
          										<div class="col-sm-3 text-right">
          											<label>M&oacute;dulo III Pagos</label>
          										</div>                  
                              <div class="col-sm-9">
                                <div class="col-sm-3">
                                  <input type="checkbox" name="modulo3[]" value="1"  class="chk_lectura" <?php if($permisos['modulo3']==1 || $permisos['modulo3']==3 || $permisos['modulo3']==5 || $permisos['modulo3']==7 || $permisos['modulo3']==9 || $permisos['modulo3']==11 || $permisos['modulo3']==13 || $permisos['modulo3']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="modulo3[]" value="2" <?php if($permisos['modulo3']==2 || $permisos['modulo3']==3 || $permisos['modulo3']==6 || $permisos['modulo3']==7 || $permisos['modulo3']==10 || $permisos['modulo3']==11 || $permisos['modulo3']==14 || $permisos['modulo3']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="modulo3[]" value="4" <?php if($permisos['modulo3']==4 || $permisos['modulo3']==5 || $permisos['modulo3']==6 || $permisos['modulo3']==7 || $permisos['modulo3']==12 || $permisos['modulo3']==13 || $permisos['modulo3']==14 || $permisos['modulo3']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="modulo3[]" value="8" <?php if($permisos['modulo3']==8 || $permisos['modulo3']==9 || $permisos['modulo3']==10 || $permisos['modulo3']==11 || $permisos['modulo3']==12 || $permisos['modulo3']==13 || $permisos['modulo3']==14 || $permisos['modulo3']==15){ echo 'checked="checked"'; } ?> />
                                </div>  
                              </div>
          									</div>
                            <div class="spacer-20"></div> 
                            <div class="row">
          										<div class="col-sm-3 text-right">
          											<label>Reportes</label>
          										</div>                  
                              <div class="col-sm-9">
                                <div class="col-sm-3">
                                  <input type="checkbox" name="reportes[]" value="1"  class="chk_lectura" <?php if($permisos['reportes']==1 || $permisos['reportes']==3 || $permisos['reportes']==5 || $permisos['reportes']==7 || $permisos['reportes']==9 || $permisos['reportes']==11 || $permisos['reportes']==13 || $permisos['reportes']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="reportes[]" value="2" <?php if($permisos['reportes']==2 || $permisos['reportes']==3 || $permisos['reportes']==6 || $permisos['reportes']==7 || $permisos['reportes']==10 || $permisos['reportes']==11 || $permisos['reportes']==14 || $permisos['reportes']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="reportes[]" value="4" <?php if($permisos['reportes']==4 || $permisos['reportes']==5 || $permisos['reportes']==6 || $permisos['reportes']==7 || $permisos['reportes']==12 || $permisos['reportes']==13 || $permisos['reportes']==14 || $permisos['reportes']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="reportes[]" value="8" <?php if($permisos['reportes']==8 || $permisos['reportes']==9 || $permisos['reportes']==10 || $permisos['reportes']==11 || $permisos['reportes']==12 || $permisos['reportes']==13 || $permisos['reportes']==14 || $permisos['reportes']==15){ echo 'checked="checked"'; } ?> />
                                </div>  
                              </div>
          									</div>
                            <div class="spacer-20"></div> 
                            <div class="row">
          										<div class="col-sm-3 text-right">
          											<label>Usuarios</label>
          										</div>                  
                              <div class="col-sm-9">
                                <div class="col-sm-3">
                                  <input type="checkbox" name="usuarios[]" value="1"  class="chk_lectura" <?php if($permisos['usuarios']==1 || $permisos['usuarios']==3 || $permisos['usuarios']==5 || $permisos['usuarios']==7 || $permisos['usuarios']==9 || $permisos['usuarios']==11 || $permisos['usuarios']==13 || $permisos['usuarios']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="usuarios[]" value="2" <?php if($permisos['usuarios']==2 || $permisos['usuarios']==3 || $permisos['usuarios']==6 || $permisos['usuarios']==7 || $permisos['usuarios']==10 || $permisos['usuarios']==11 || $permisos['usuarios']==14 || $permisos['usuarios']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="usuarios[]" value="4" <?php if($permisos['usuarios']==4 || $permisos['usuarios']==5 || $permisos['usuarios']==6 || $permisos['usuarios']==7 || $permisos['usuarios']==12 || $permisos['usuarios']==13 || $permisos['usuarios']==14 || $permisos['usuarios']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="usuarios[]" value="8" <?php if($permisos['usuarios']==8 || $permisos['usuarios']==9 || $permisos['usuarios']==10 || $permisos['usuarios']==11 || $permisos['usuarios']==12 || $permisos['usuarios']==13 || $permisos['usuarios']==14 || $permisos['usuarios']==15){ echo 'checked="checked"'; } ?> />
                                </div>  
                              </div>
          									</div>
                            <div class="spacer-20"></div> 
                            <div class="row">
          										<div class="col-sm-3 text-right">
          											<label>Roles</label>
          										</div>                  
                              <div class="col-sm-9">
                                <div class="col-sm-3">
                                  <input type="checkbox" name="roles[]" value="1"  class="chk_lectura" <?php if($permisos['roles']==1 || $permisos['roles']==3 || $permisos['roles']==5 || $permisos['roles']==7 || $permisos['roles']==9 || $permisos['roles']==11 || $permisos['roles']==13 || $permisos['roles']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="roles[]" value="2" <?php if($permisos['roles']==2 || $permisos['roles']==3 || $permisos['roles']==6 || $permisos['roles']==7 || $permisos['roles']==10 || $permisos['roles']==11 || $permisos['roles']==14 || $permisos['roles']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="roles[]" value="4" <?php if($permisos['roles']==4 || $permisos['roles']==5 || $permisos['roles']==6 || $permisos['roles']==7 || $permisos['roles']==12 || $permisos['roles']==13 || $permisos['roles']==14 || $permisos['roles']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="roles[]" value="8" <?php if($permisos['roles']==8 || $permisos['roles']==9 || $permisos['roles']==10 || $permisos['roles']==11 || $permisos['roles']==12 || $permisos['roles']==13 || $permisos['roles']==14 || $permisos['roles']==15){ echo 'checked="checked"'; } ?> />
                                </div>  
                              </div>
          									</div>                           
                            <div class="spacer-20"></div> 
                            <div class="row">
          										<div class="col-sm-3 text-right">
          											<label>Recaudaciones</label>
          										</div>                  
                              <div class="col-sm-9">
                                <div class="col-sm-3">
                                  <input type="checkbox" name="recaudaciones[]" value="1"  class="chk_lectura" <?php if($permisos['recaudacion']==1 || $permisos['recaudacion']==3 || $permisos['recaudacion']==5 || $permisos['recaudacion']==7 || $permisos['recaudacion']==9 || $permisos['recaudacion']==11 || $permisos['recaudacion']==13 || $permisos['recaudacion']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="recaudaciones[]" value="2" <?php if($permisos['recaudacion']==2 || $permisos['recaudacion']==3 || $permisos['recaudacion']==6 || $permisos['recaudacion']==7 || $permisos['recaudacion']==10 || $permisos['recaudacion']==11 || $permisos['recaudacion']==14 || $permisos['recaudacion']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="recaudaciones[]" value="4" <?php if($permisos['recaudacion']==4 || $permisos['recaudacion']==5 || $permisos['recaudacion']==6 || $permisos['recaudacion']==7 || $permisos['recaudacion']==12 || $permisos['recaudacion']==13 || $permisos['recaudacion']==14 || $permisos['recaudacion']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="recaudaciones[]" value="8" <?php if($permisos['recaudacion']==8 || $permisos['recaudacion']==9 || $permisos['recaudacion']==10 || $permisos['recaudacion']==11 || $permisos['recaudacion']==12 || $permisos['recaudacion']==13 || $permisos['recaudacion']==14 || $permisos['recaudacion']==15){ echo 'checked="checked"'; } ?> />
                                </div>  
                              </div>
          									</div>                            
                            <div class="spacer-20"></div> 
                            <div class="row">
          										<div class="col-sm-3 text-right">
          											<label>Reglas</label>
          										</div>                  
                              <div class="col-sm-9">
                                <div class="col-sm-3">
                                  <input type="checkbox" name="reglas[]" value="1"  class="chk_lectura" <?php if($permisos['reglas']==1 || $permisos['reglas']==3 || $permisos['reglas']==5 || $permisos['reglas']==7 || $permisos['reglas']==9 || $permisos['reglas']==11 || $permisos['reglas']==13 || $permisos['reglas']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="reglas[]" value="2" <?php if($permisos['reglas']==2 || $permisos['reglas']==3 || $permisos['reglas']==6 || $permisos['reglas']==7 || $permisos['reglas']==10 || $permisos['reglas']==11 || $permisos['reglas']==14 || $permisos['reglas']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="reglas[]" value="4" <?php if($permisos['reglas']==4 || $permisos['reglas']==5 || $permisos['reglas']==6 || $permisos['reglas']==7 || $permisos['reglas']==12 || $permisos['reglas']==13 || $permisos['reglas']==14 || $permisos['reglas']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="reglas[]" value="8" <?php if($permisos['reglas']==8 || $permisos['reglas']==9 || $permisos['reglas']==10 || $permisos['reglas']==11 || $permisos['reglas']==12 || $permisos['reglas']==13 || $permisos['reglas']==14 || $permisos['reglas']==15){ echo 'checked="checked"'; } ?> />
                                </div>  
                              </div>
          									</div>
                            <div class="spacer-20"></div> 
                            <div class="row">
          										<div class="col-sm-3 text-right">
          											<label>Descuentos</label>
          										</div>                  
                              <div class="col-sm-9">
                                <div class="col-sm-3">
                                  <input type="checkbox" name="descuentos[]" value="1"  class="chk_lectura" <?php if($permisos['descuentos']==1 || $permisos['descuentos']==3 || $permisos['descuentos']==5 || $permisos['descuentos']==7 || $permisos['descuentos']==9 || $permisos['descuentos']==11 || $permisos['descuentos']==13 || $permisos['descuentos']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="descuentos[]" value="2" <?php if($permisos['descuentos']==2 || $permisos['descuentos']==3 || $permisos['descuentos']==6 || $permisos['descuentos']==7 || $permisos['descuentos']==10 || $permisos['descuentos']==11 || $permisos['descuentos']==14 || $permisos['descuentos']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="descuentos[]" value="4" <?php if($permisos['descuentos']==4 || $permisos['descuentos']==5 || $permisos['descuentos']==6 || $permisos['descuentos']==7 || $permisos['descuentos']==12 || $permisos['descuentos']==13 || $permisos['descuentos']==14 || $permisos['descuentos']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="descuentos[]" value="8" <?php if($permisos['descuentos']==8 || $permisos['descuentos']==9 || $permisos['descuentos']==10 || $permisos['descuentos']==11 || $permisos['descuentos']==12 || $permisos['descuentos']==13 || $permisos['descuentos']==14 || $permisos['descuentos']==15){ echo 'checked="checked"'; } ?> />
                                </div>  
                              </div>
          									</div>
                            <div class="spacer-20"></div> 
                            <div class="row">
          										<div class="col-sm-3 text-right">
          											<label>Soporte</label>
          										</div>                  
                              <div class="col-sm-9">
                                <div class="col-sm-3">
                                  <input type="checkbox" name="soporte[]" value="1"  class="chk_lectura" <?php if($permisos['soporte']==1 || $permisos['soporte']==3 || $permisos['soporte']==5 || $permisos['soporte']==7 || $permisos['soporte']==9 || $permisos['soporte']==11 || $permisos['soporte']==13 || $permisos['soporte']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="soporte[]" value="2" <?php if($permisos['soporte']==2 || $permisos['soporte']==3 || $permisos['soporte']==6 || $permisos['soporte']==7 || $permisos['soporte']==10 || $permisos['soporte']==11 || $permisos['soporte']==14 || $permisos['soporte']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="soporte[]" value="4" <?php if($permisos['soporte']==4 || $permisos['soporte']==5 || $permisos['soporte']==6 || $permisos['soporte']==7 || $permisos['soporte']==12 || $permisos['soporte']==13 || $permisos['soporte']==14 || $permisos['soporte']==15){ echo 'checked="checked"'; } ?> />
                                </div>
                                <div class="col-sm-3">
                                  <input type="checkbox" name="soporte[]" value="8" <?php if($permisos['soporte']==8 || $permisos['soporte']==9 || $permisos['soporte']==10 || $permisos['soporte']==11 || $permisos['soporte']==12 || $permisos['soporte']==13 || $permisos['soporte']==14 || $permisos['soporte']==15){ echo 'checked="checked"'; } ?> />
                                </div>  
                              </div>
          									</div>
                                                        
                           <div class="spacer-20"></div>
                          
            								<div class="form-group">
            									<label class="col-sm-3 control-label estatus"
            										for="estatus"> Activo </label>
            									<div class="col-sm-9">
            										<input id="estatus" class="form-controles" type="checkbox" <?php if($rol->getEstatus()=='activo'){ echo 'checked="checked"'; } ?> <?php if($permisos_roles<8){ echo 'disabled="disabled"'; } ?> />
            									</div>
            								</div>                             
        										<div class="row">
        											<div class="col-sm-12 text-right">
        												<input type="button" class="btn btn-success" name="btnGuardar" id="btnGuardar" value="Guardar" />
        											</div>
        										</div>                
                          
                          </div>	
    									</div>
    							</div>
    										
                                
                                <div class="spacer-30"></div>
                                
								</div>
							</div>
						
								
						</div>

						<!-- end: FEATURED BOX LINKS -->
                                        	
                                        	
                                    </div><!-- End .inner-padding -->  
                                </div>
                            </div><!-- End .row -->
                        </div>
                        
                    </div>
                </div><!-- End .window -->
                
                
                <?php include_once('footer.php'); ?>
                <a data-toggle="modal" id="_alertShow"
			style="display: none" class="btn btn-danger" role="button"
			href="#_alertBox">Alert</a>
		<div class="modal fade" id="_alertBox" tabindex="-1" role="dialog"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true" id="_alertCloseUp">&times;</button>
						<h4 class="modal-title" id="_alertTitle"></h4>
					</div>
					<div class="modal-body">
						<p id="_alertBody"></p>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal"
							id="_alertClose">OK</button>
					</div>
				</div>
			</div>
		</div>                
                
            </div><!-- End #content -->  
    	</div>
    	<!-- End #main -->
    	
    	
    </div>
    <!-- End #container -->
    
    
        
     	<script src="js/lib/main.js"></script>
     	
</body>


</html>