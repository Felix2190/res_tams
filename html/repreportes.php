<?php
	$mostrarCiudades='none';
	$chkMostrarCiudades='checked';
	
	$mostrarFechas='none';
	$chkmostrarFechas='checked';
	
	$mostrarTipo='none';
	$chkmostrarTipo='checked';
	
	$mostrarEmision='none';
	$chkmostrarEmision='checked';
	
	$viarapida='checked';
	$mariano='checked';
	$morelos='checked';
	$victoria='checked';
	$snfelipe='checked';
	$palaco='checked';
	$mexicali='checked';
	$ensenada='checked';
	$snqintin='checked';
	$tecate='checked';
	$rosarito='checked';
	
	$filas=0;
	$filtrofecha='checked';
	$fechaini=date("Y-m-d");
	$fechafin=date("Y-m-d");
	
	$txtBuscar='';
	$Paterno='';
	$Materno='';
	$nombres='';
	
	$expedicion='checked';
	$revalidacion='checked';
	$reposicion='checked';
	$garantiaSIELC='checked';
	$garantiaSMBMELC='checked';
	
	$menoredad='checked';
	$motociclista='checked';
	$automovilista='checked';
	$choferA='checked';
	$choferB='checked';
	$choferC='checked';
	$choferD='checked';	
	$provisionalAut='checked';
	$provisionalChofB='checked';
	$provisionalChofC='checked';
	
	$valor='';
	if (isset($_POST['btnBuscar'])) {
		
				
		if (isset($_POST['chkMostrarFechas'])){
			$chkMostrarFechas = 'checked';
			$mostrarFechas='block';
			}
		else{
			$chkMostrarFechas = 'unchecked';
			$mostrarFechas='none';
			}
			

		if (isset($_POST['chkMostrarCiudades'])){	
			
			$chkMostrarCiudades= 'checked';
			$mostrarCiudades='block';
			}
		else{
			$chkMostrarCiudades = 'unchecked';
			$mostrarCiudades='none';
			}
			
		if (isset($_POST['chkMostrarTipo'])){
			$chkmostrarTipo= 'checked';
			$mostrarTipo='block';
			}
		else{
			$chkmostrarTipo = 'unchecked';
			$mostrarTipo='none';
			}
		
		if (isset($_POST['chkmostrarEmision'])){
			$chkmostrarEmision='checked';
			$mostrarEmision= 'block';
			}
		else{
			$chkmostrarEmision = 'unchecked';
			$mostrarEmision='none';
			}		
			
			
		if (isset($_POST['chkFiltroFecha']))
			$filtrofecha = 'checked';
		else
			$filtrofecha = 'unchecked';
			
		if (isset($_POST['txtBuscar']))
			$txtBuscar=$_POST['txtBuscar'];		
		
		if (isset($_POST['txtPaterno']))
			$Paterno=$_POST['txtPaterno'];
		
		if (isset($_POST['txtMaterno']))
			$Materno=$_POST['txtMaterno'];
			
		if (isset($_POST['txtNombres']))
			$nombres=$_POST['txtNombres'];
			
		if (isset($_POST['chkexpedicion']))
			$expedicion = 'checked';
		else
			$expedicion = 'unchecked';
	
		if (isset($_POST['chkrevalidacion']))
			$revalidacion = 'checked';
		else
			$revalidacion = 'unchecked';
	
		if (isset($_POST['chkreposicion']))
			$reposicion = 'checked';
		else
			$reposicion = 'unchecked';
	
		if (isset($_POST['chkgarantiaSIELC']))
			$garantiaSIELC = 'checked';
		else
			$garantiaSIELC = 'unchecked';
	
		if (isset($_POST['chkgarantiaSMBMELC']))
			$garantiaSMBMELC = 'checked';
		else
			$garantiaSMBMELC = 'unchecked';
		
		if (isset($_POST['chkMenorEdad']))
			$menoredad = 'checked';
		else
			$menoredad = 'unchecked';
			
		if (isset($_POST['chkmotociclista']))
			$motociclista= 'checked';
		else
			$motociclista = 'unchecked';
		
		if (isset($_POST['chkautomovilista']))
			$automovilista= 'checked';
		else
			$automovilista = 'unchecked';
		
		if (isset($_POST['chkchoferA']))
			$choferA= 'checked';
		else
			$choferA = 'unchecked';
			
		if (isset($_POST['chkchoferB']))
			$choferB= 'checked';
		else
			$choferB = 'unchecked';
		
		if (isset($_POST['chkchoferC']))
			$choferC= 'checked';
		else
			$choferC = 'unchecked';
		
		if (isset($_POST['chkchoferC']))
			$choferC= 'checked';
		else
			$choferC = 'unchecked';
			
		if (isset($_POST['chkchoferD']))
			$choferD= 'checked';
		else
			$choferD = 'unchecked';
			
		if (isset($_POST['chkprovisionalAut']))
			$provisionalAut= 'checked';
		else
			$provisionalAut = 'unchecked';
		
		if (isset($_POST['chkprovisionalChofB']))
			$provisionalChofB= 'checked';
		else
			$provisionalChofB = 'unchecked';
		
		if (isset($_POST['chkprovisionalChofC']))
			$provisionalChofC= 'checked';
		else
			$provisionalChofC = 'unchecked';
		
		if (isset($_POST['chkmariano']))
			$mariano = 'checked';
		else
			$mariano = 'unchecked';
			
		if (isset($_POST['chkviarapida']))
			$viarapida = 'checked';
		else
			$viarapida = 'unchecked';
		
		if (isset($_POST['chkmorelos']))
			$morelos = 'checked';
		else
			$morelos = 'unchecked';
			
		if (isset($_POST['chkvictoria']))
			$victoria = 'checked';
		else
			$victoria = 'unchecked';
			
		if (isset($_POST['chkmsnfelipe']))
			$snfelipe = 'checked';
		else
			$snfelipe = 'unchecked';
		
		if (isset($_POST['chkpalaco']))
			$palaco = 'checked';
		else
			$palaco = 'unchecked';
		
		if (isset($_POST['chkMexicali']))
			$mexicali = 'checked';
		else
			$mexicali = 'unchecked';		

		if (isset($_POST['chkEnsenada']))
			$ensenada = 'checked';
		else
			$ensenada = 'unchecked';

		if (isset($_POST['chksnqintin']))
			$snqintin = 'checked';
		else
			$snqintin = 'unch	ecked';
			
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

	require("masterIncludeLogin.inc.php");	
	$nav = 'reportes';
	$subnav = 'reportes';  
	

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

    <title>Reportes</title>

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
    
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />

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
    <script src="bootstrap/holder/holder.min.js"></script>
    <script src="bootstrap/typeahead/typeahead.min.js"></script>
    
    <!-- // Custom //-->
    <script src="js/plugins/generics.js"></script>
    
	<!-- Calendar jQuery -->
	
	<script type="text/javascript" src="js/libs/ui.datepicker-es-MX.js"></script>
	<!-- CSS Calendario -->
	<link rel="stylesheet" href="js/libs/jquery-ui-1.12.1/jquery-ui.css" />
	
	<script type="text/javascript" src="js/libs/ui.datepicker-es-MX.js"></script>
   
    
    <script type="text/javascript" src="js/system/oficinas.js"></script>
	
	<script>
		$(document).on("ready",inicio);
		function inicio(){ 
			$('#btnBuscar').click(validar);
			
				$("#txtFechaIni").datepicker({changeYear :true,changeMonth :true,constrainInput:true,dateFormat:"yy-mm-dd"});
				$("#txtFechaFin").datepicker({changeYear :true,changeMonth :true,constrainInput:true,dateFormat:"yy-mm-dd"});
			$("#txtFechaIni").attr("readonly","readonly");
			$("#txtFechaFin").attr("readonly","readonly");
		}
		function validar(){
			//alert ("ya pase");
			return true;
		}
	</script>
	<script>
	function MyFunction() {
		
		var x = document.getElementById('myDiv');
		
		if (x.style.display === 'none') {
			x.style.display = 'block';
			$('#chkMostrarCiudades').attr('checked', true);
		} else {
			x.style.display = 'none';
			$('#chkMostrarCiudades').attr('checked',false);
		}
		
	}
	
	function MostrarTipo() {
		
		var x = document.getElementById('divTipoLicencias');
		
		if (x.style.display === 'none') {
			x.style.display = 'block';
			$('#chkmostrarTipo').attr('checked', true);
		} else {
			x.style.display = 'none';
			$('#chkmostrarTipo').attr('checked', false);
		}
		
	}
	
	function MostrarTransaccion() {
		
		var x = document.getElementById('divTransaccion');
		
		if (x.style.display === 'none') {
			x.style.display = 'block';
			$('#chkmostrarEmision').attr('checked', true);
		} else {
			x.style.display = 'none';
			$('#chkmostrarEmision').attr('checked', false);
		}
		
	}
	
	function MostrarFecha() {
		
		var x = document.getElementById('divFecha');
		
		if (x.style.display === 'none') {
			x.style.display = 'block';
			$('#chkMostrarFechas').attr('checked', true);  
		} else {
			x.style.display = 'none';
			$('#chkMostrarFechas').attr('checked', false);  
		}
		
	}
	
	function activarFecha(){
		$('#txtFechaIni').attr('disabled', !$('#chkFiltroFecha').is(":checked"));
		$('#txtFechaFin').attr('disabled', !$('#chkFiltroFecha').is(":checked"));
	}
	</script>
	
	<script>
		
		function Visible() {
		
			var x = document.getElementById('myDIV');
			if (x.style.display === 'none') {
				x.style.display = 'block';
			} else {
				x.style.display = 'none';
			}
		}
		function imprSelec(nombre)
		{
		var ficha = document.getElementById(nombre);
		var ventimp = window.open(' ', 'popimpr');
		ventimp.document.write( ficha.innerHTML );
		ventimp.document.close();
		ventimp.print( );
		ventimp.close();
		}
	</script>
	
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
                            <h2><i class="fa fa-file-text-o"></i> &nbsp; Reportes</h2>                 
                        </div> 
                    </div>
            	</header>


                                     
                <div class="window">  
                    <div class="row ext-raster">
                    	<div class="col-sm-12" >
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="post" name="form">
										<?php 
										$filtro=""; 
										$registros="";
										if (isset($_POST['btnBuscar']))
											 {		
											
											 $filtro="";
											 if (strlen($txtBuscar)<10){
												//NO es un parametro de busqueda
												$filtro="";	
												
											 }elseif(strlen($txtBuscar)==10){
												$filtro.=" AND RFC.TextData='".$txtBuscar."'";															
												//busquda con licencia
											}elseif(strlen($txtBuscar)==11){
												$filtro.=" AND NUMEROLICENCIA.TextData='".$txtBuscar."'";
												//busquda con RFC
											 }elseif(strlen($txtBuscar)==13){
												//RFC + Homoclave
												$filtro.=" AND RFC.TextData+HOMOCLAVE.TextData='".$txtBuscar."'";
											 }elseif(strlen($txtBuscar)==18){
												//CURP
												$filtro.=" AND CURP.StringValue='".$txtBuscar."'";
											 }
											 elseif (strlen($txtBuscar)==36){
												//GUID
												 $filtro.=" AND PER.Guid='".$txtBuscar."'";
												
											 }
											 //else{
												//Nombre
												//$filtro.=" AND NOMBRE.TextData + ' ' + PATERNO.TextData  + ' ' + MATERNO.TextData='".$txtBuscar."'";
											 //}	
											 if($filtro=="")
												$filtrofecha='checked';	//agregamos filtro de rango de fechas si no se  tiene un filto especifico (CURP, RFC, GUID,NUmero licencia	
											}
										?>
											<div class="col-sm-3">
                                        		<label for="txtBuscar"  class="txtBuscar" >Buscar </label><br />
                								<input type="text" name="txtBuscar" id="txtBuscar" class="form-control txtBuscar" placeholder="Indique: CURP o RFC o Numero de licencia o GUID" value="<?php echo $txtBuscar; ?>" />
                							</div> 
											<div class="col-sm-3">
                                        		<label for="txtPaterno"  class="txtPaterno" >Apellido Paterno </label><br />
                								<input type="text" name="txtPaterno" id="v" class="form-control txtPaterno" value="<?php echo $Paterno; ?>" />
                							</div>
											<div class="col-sm-3">
                                        		<label for="txtMaterno"  class="txtMaterno" >Apellido Materno </label><br />
                								<input type="text" name="txtMaterno" id="v" class="form-control txtMaterno" placeholder="" value="<?php echo $Materno; ?>" />
                							</div>
											<div class="col-sm-3">
                                        		<label for="txtNombres"  class="txtNombres" >Nombres</label><br />
                								<input type="text" name="txtNombres" id="v" class="form-control txtNombres" placeholder="" value="<?php echo $nombres; ?>" />
                							</div>
                						<div class="spacer-20"></div>
											<div class="col-sm-4">
												<label for="" class="">Ciudades<a href="#" onclick="MyFunction();" class="btn btn-default btn-circle" alt="Mostrar ciudades"><i class="fa fa-plus text-success"></i></a></label>
												<?php echo ":".$valor;?>
											</div>

											<input type="checkbox"  style="display:none;" class="form-control"  id="chkMostrarCiudades" name="chkMostrarCiudades" <?php echo $mostrarCiudades; ?>>
											<?php echo $valor;?>
										<div id="myDiv" style="display:<?php echo $mostrarCiudades; ?>">	
										<div class="spacer-10"></div>
										

							<div class="subheading">
                        <div class="col-sm-12">
                                				<h3>Ciudades</h3>
                                        </div>
                                			</div>
											

											

											<div class="col-sm-1 text-right"> 

												<label for="chkVictoria" class="chkVictoria">Cd Victoria</label>

											</div>

											<div class="col-sm-1">

												<input type="checkbox" class="form-control" id="chkVictoria" name="chkVictoria" <?php echo $victoria; ?> >

											</div>


											

					

										</div>
											
										<div class="spacer-20"></div>	
										<div class="col-sm-4">
												
												<label for="" class="">Fecha Emisi&oacute;n<a href="#" onclick="MostrarFecha();" class="btn btn-default btn-circle" alt="Mostrar Tipo licencias"><i class="fa fa-plus text-success"></i></a></label>
												
										</div>
										
											<input type="checkbox" class="form-control"  style="display:none" id="chkMostrarFechas" name="chkMostrarFechas" <?php echo $mostrarFechas; ?>>
											<div id="divFecha" style="display:<?php echo $mostrarFechas;?>">
												
												
												<div class="spacer-20"></div>
												<div class="col-sm-2">
													</br>
													<input type="checkbox" onchange="activarFecha()" class="form-control" id="chkFiltroFecha" name="chkFiltroFecha" <?php echo $filtrofecha; ?>>
												</div>
												<div class="col-sm-2">
													<label for="txtFechaIni" data-date-format="yy-mm-dd" class="txtFechaIni">Desde</label><br />
													<input type="date" name="txtFechaIni" id="txtFechaIni" <?php echo $filtrofecha; ?> class="form-control txtFechaIni" value="<?php echo $fechaini; ?>" />
												</div> 
												<div class="col-sm-2">
													<label for="txtFechaFin" class="txtFechaFin">Hasta</label><br />
													<input type="date" data-date-format='yy-mm-dd' <?php echo $filtrofecha; ?> name="txtFechaFin" id="txtFechaFin" class="form-control txtFechaFin" value="<?php echo $fechafin; ?>" />
												</div> 	
											</div>
										<div class="spacer-20"></div>
											<div class="col-sm-4">
												<label for="" class="">Tipo<a href="#" onclick="MostrarTipo();" class="btn btn-default btn-circle" alt="Mostrar Tipo licencias"><i class="fa fa-plus text-success"></i></a></label>
											</div>
											<input type="checkbox" class="form-control"  style="display:none" id="chkmostrarTipo" name="chkmostrarTipo" <?php echo $mostrarTipo ?>>
										<div id="divTipoLicencias" style="display:<?php echo $mostrarTipo;?>">
											<div class="spacer-20"></div>
											<div class="col-sm-1 text-right"> 
												<label for="chkMenorEdad" class="chkMenorEdad">Menor de Edad</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control" id="chkMenorEdad" name="chkMenorEdad" <?php echo $menoredad; ?>>
											</div>
											<div class="col-sm-1 text-right"> 
												<label for="chkmotociclista" class="chkTijuana">Motociclista</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control" id="chkmotociclista" name="chkmotociclista" <?php echo $motociclista; ?>>
											</div>
											
											<div class="col-sm-1 text-right"> 
												<label for="chkautomovilista" class="chkautomovilista">Automovilista</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control" id="chkautomovilista" name="chkautomovilista" <?php echo $automovilista; ?>>
											</div>
											<div class="col-sm-1 text-right"> 
												<label for="chkchoferA" class="chkchoferA">Chofer A</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control" id="chkchoferA" name="chkchoferA" <?php echo $choferA; ?>>
											</div>
											
											<div class="col-sm-1 text-right"> 
												<label for="chkchoferB" class="chkchoferB">Chofer B</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control" id="chkchoferB" name="chkchoferB" <?php echo $choferB; ?>>
											</div>
											
											<div class="col-sm-1 text-right"> 
												<label for="chkchoferC" class="chkchoferA">Chofer C</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control" id="chkchoferC" name="chkchoferC" <?php echo $choferC; ?>>
											</div>
											
											<div class="col-sm-1 text-right"> 
												<label for="chkchoferD" class="chkchoferA">Chofer D</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control" id="chkchoferD" name="chkchoferD" <?php echo $choferD; ?>>
											</div>
											
											<div class="col-sm-1 text-right"> 
												<label for="chkprovisionalAut" class="chkprovisionalAut">Provisional Aut</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control" id="chkprovisionalAut" name="chkprovisionalAut" <?php echo $provisionalAut; ?>>
											</div>
											
											<div class="col-sm-1 text-right"> 
												<label for="chkprovisionalChofB" class="provisionalChofB">Provisional Chofer B</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control" id="chkprovisionalChofB" name="chkprovisionalChofB" <?php echo $provisionalChofB; ?>>
											</div>
											
											<div class="col-sm-1 text-right"> 
												<label for="chkprovisionalChofB" class="chkprovisionalChofB">Provisional Chofer B</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control" id="chkprovisionalChofB" name="chkprovisionalChofB" <?php echo $provisionalChofB; ?>>
											</div>
										</div>
										
										<div class="spacer-20"></div>
											<div class="col-sm-4">
												<label for="" class="">Emisi&oacute;n</label>
												<a href="#" onclick="MostrarTransaccion();" class="btn btn-default btn-circle" alt="Mostrar Transaccion"><i class="fa fa-plus text-success"></i></a>
											</div>
											
										<input type="checkbox" class="form-control"  style="display:none" id="chkmostrarEmision" name="chkmostrarEmision" <?php echo $mostrarEmision; ?>>	
										<div id="divTransaccion" style="display:<?php echo $mostrarEmision; ?> ">
											<div class="spacer-20"></div>
											<div class="col-sm-1 text-right"> 
												<label for="chkexpedicion" class="chkexpedicion">Expedici&oacute;n</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control" id="chkexpedicion" name="chkexpedicion" <?php echo $expedicion; ?>>
											</div>
											
											<div class="col-sm-1 text-right"> 
												<label for="chkrevalidacion" class="chkrevalidacion">Revalidaci&oacute;n</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control" id="chkrevalidacion" name="chkrevalidacion" <?php echo $expedicion; ?>>
											</div>
											
											<div class="col-sm-1 text-right"> 
												<label for="chkreposicion" class="chkreposicion">Reposici&oacuten</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control chkreposicion" id="chkreposicion" name="chkreposicion" <?php echo $reposicion; ?>>
											</div>
											
											<div class="col-sm-1 text-right"> 
												<label for="chkgarantiaSIELC" class="chkgarantiaSIELC">Garantia SIELC</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control" id="chkgarantiaSIELC" name="chkgarantiaSIELC" <?php echo $garantiaSIELC; ?>>
											</div>
											
											<div class="col-sm-1 text-right"> 
												<label for="chkgarantiaSMBMELC" class="chkgarantiaSMBMELC">Garantia SMBMELC</label>
											</div>
											<div class="col-sm-1">
												<input type="checkbox" class="form-control" id="chkgarantiaSMBMELC" name="chkgarantiaSMBMELC" <?php echo $garantiaSMBMELC; ?>>
											</div>
											
										</div>
										
										<div class="spacer-20"></div>
											<div class="col-sm-1">
												&nbsp
											</div>
                                			<div class="col-sm-1">
											
												<br />
												<button type="submit" class="btn btn-success btn-block" id="btnBuscar" name="btnBuscar">Buscar..</button>
											</div>
                    
                    						<div class="spacer-20"></div>
										</form>
                            <hr />
                            <div class="row">
                            	<div class="col-sm-12" id="reporte">
                                    <div class="inner-padding">								
                                        <h4 class="text-muted">Resultados</h4>
                                        
                                    </div><!-- End .inner-padding -->  
                                </div>
                                
                                
                                <div class="col-sm-12">
                                	<div class="inner-padding">
                                		<div class="table-wrapper">
											<?php 
												 if (isset($_POST['btnBuscar']))
													{	
														   function sqlsrv_connect($serverName, $connectionInfo){
                                return false;
                               }
                               function sqlsrv_errors(){
                                return false;
                               }                                
														if ($filtrofecha=='checked'){															
															$filtro.=" AND /**".$filtrofecha."**/CONVERT(char(10),FECHAEXPEDICION.TextData,120) BETWEEN '".$fechaini."' AND '".$fechafin."'";
														}
														 if (strlen($Paterno)>0){
															$filtro.=" AND PATERNO.TextData ='".$Paterno."'";
														 }
														 
														 if (strlen($Materno)>0){
															$filtro.=" AND MATERNO.TextData ='".$Materno."'";
														 }
														 if (strlen($nombres)>0){
															$filtro.=" AND NOMBRE.TextData ='".$nombres."'";
														 }
														 
														 $filtroOficina="";
														 if ($viarapida=='checked')
															$filtroOficina.=",'05'";
														
														if ($mariano=='checked')
															$filtroOficina.=",'06'";
														
														if ($morelos=='checked')
															$filtroOficina.=",'02'";
														
														if ($victoria=='checked')
															$filtroOficina.=",'01'";
														
														if ($snfelipe=='checked')
															$filtroOficina.=",'03'";
														
														if ($palaco=='checked')
															$filtroOficina.=",'12'";
														
														if ($mexicali=='checked')
															$filtroOficina.=",'04'";
															
														if ($snqintin=='checked')
															$filtroOficina.=",'10'";
															
														if ($tecate=='checked')
															$filtroOficina.=",'07'";
															
														if ($rosarito=='checked')
															$filtroOficina.=",'09'";
															
														if ($ensenada=='checked')
															$filtroOficina.=",'08'";
															
														if(strlen($filtroOficina)>0)
															$filtro.=" AND RIGHT(LEFT(NUMEROLICENCIA.TextData, 4), 2) IN(".substr ($filtroOficina,1).")";
																												
														
														$filtroTransaccion="";
														if($revalidacion=='checked')
															$filtroTransaccion.=",'LRNW','RNWN','RNWY'";
															
														if($expedicion=='checked')
															$filtroTransaccion.=",'NEW','ADD'";
															
														if($reposicion=='checked')
															$filtroTransaccion.=",'LRPL','REPL'";
															
														if($garantiaSIELC=='checked')
															$filtroTransaccion.=",'LRPQ'";
															
														if($garantiaSMBMELC=='checked')
															$filtroTransaccion.=",'REPQ'";
														
														if(strlen($filtroTransaccion)>0)
															$filtro.=" AND emi.TextData IN (".substr ($filtroTransaccion,1).")";														
														
														$filtroTipo="";
														if($menoredad==='checked')
															$filtroTipo.=",'MEDE' ";
														if($motociclista==='checked')
															$filtroTipo.=",'MOTO' ";
														if($menoredad==='checked')
															$filtroTipo.=",'MEDE' ";
														if($automovilista==='checked')
															$filtroTipo.=",'AUTO' ";
														if($choferA==='checked')
															$filtroTipo.=",'CHFA' ";
														if($choferB==='checked')
															$filtroTipo.=",'CHFB' ";
														if($choferC==='checked')
															$filtroTipo.=",'CHFC' ";
														if($choferD==='checked')
															$filtroTipo.=",'CHFD' ";
														if($provisionalAut==='checked')
															$filtroTipo.=",'PRAU' ";
														if($provisionalChofB==='checked')
															$filtroTipo.=",'PRCB' ";
														if($provisionalChofC==='checked')
															$filtroTipo.=",'PRCC' ";
															
														if(strlen($filtroTipo)>0)
															$filtro.=" AND TIPOLICENCIA.TextData IN(".substr ($filtroTipo,1).")";
														
														
														 //echo $filtro;
													     $serverName = "172.31.8.48";
													     /* Usuario y clave.  */
													     $uid = "dba";
													     $pwd = "1qazxcv2@";
													     /* Array asociativo con la información de la conexion */
													     $connectionInfo = array( "UID"=>$uid,
													     		"PWD"=>$pwd,
													     		"Database"=>"POBLACIONF2");
													     
													     /* Nos conectamos mediante la autenticación de SQL Server . */
													     $conn = sqlsrv_connect( $serverName, $connectionInfo);
													     if( $conn === false )
													     {
													     	//echo "No es posible conectarse al servidor.</br>";
													     	die( print_r( sqlsrv_errors(), true));
													     }
													     ini_set('max_execution_time', 300);
														 
													     /* Query que nos mostrara el usuario con el que nos hemos conectado a la base de datos. */
													     $tsql = "SET NOCOUNT ON;
														 SELECT PER.ID,PER.Guid, NOMBRE.TextData + ' ' + PATERNO.TextData  + ' ' + MATERNO.TextData AS Nombre,RFC.TextData AS RFC,
HOMOCLAVE.TextData AS HomoClave,CURP.StringValue AS CURP,NUMEROLICENCIA.TextData AS NoLicencia
,FECHAEXPEDICION.TextData  AS Expedicion,FECHAVENCIMIENTO.TextData AS Vencimiento,TIPOLICENCIA.TextData AS tipolicencia,
case emi.TextData WHEN 'NEW' THEN 'Expedicion' WHEN 'ADD' THEN 'Expedicion' WHEN 'LRNW' THEN 'Revalidacion' WHEN
'RNWN' THEN 'Revalidacion' WHEN 'RNWY' THEN 'Revalidacion' WHEN 'LRPL' THEN 'Reposicion' WHEN 'REPL' THEN 'Reposicion'
WHEN 'LRPQ' THEN 'GarantiaSIELC' WHEN 'REPQ' THEN 'GarantiaSMBMELC' ELSE 'Desc' END AS Tramite,

CASE RIGHT(LEFT(NUMEROLICENCIA.TextData, 4), 2) WHEN '01' THEN 'Gpe Victoria' WHEN '02' THEN 'Cd Morelos' WHEN '03' THEN 'San Felipe' WHEN '04' THEN 'Mexicali'
               WHEN '05' THEN 'Via Rapida' WHEN '06' THEN 'Mariano' WHEN '07' THEN 'Tecate' WHEN '08' THEN 'Ensenada' WHEN '09' THEN 'Rosarito'
               WHEN '10' THEN 'San Quintin' WHEN '12' THEN 'Rec Palaco' END AS oficina
			   
FROM IdentityManager.dbo.Person PER
	INNER JOIN EPICMS.dbo.CardHolderExternalRefs CARDHER
		ON PER.Guid = CARDHER.RecordID
	INNER JOIN 
	(
		SELECT MAX(TA.CardID) AS CardID, TA.CardHolderUID
		FROM EPICMS.dbo.Card TA
			INNER JOIN EPICMS.dbo.CardTextData TB
				ON TA.CardID = TB.CardId
		WHERE TB.FieldName = 'CARD.ACTIVATION_DATE'
			AND TA.Status = 7
			AND ISDATE(TB.TextData) = 1
			AND ISDATE(TB.TextData) = 1
			AND TB.TextData IS NOT NULL
		GROUP BY TA.CardHolderUID
	) AS CARD
		ON CARDHER.CardholderUID = CARD.CardHolderUID
	INNER JOIN 
	(
		SELECT *
		FROM EPICMS.dbo.CardTextData
		WHERE FieldName = 'ADDRESS.ZIP_CODE'
	) AS CP
		ON CARD.CardID = CP.CardId
	
	LEFT JOIN
      (
		SELECT *
		FROM IdentityManager.dbo.PersonMetaData
		WHERE Name LIKE 'PERSON!METADATA!GovernmentIDNumber'
	) AS CURP ON Per.ID = CURP.PersonID
	
	LEFT JOIN 
	(
		SELECT *
		FROM EPICMS.dbo.CardTextData
		WHERE FieldName = 'PERSON.METADATA.MotherSurname'
	) AS MATERNO
		ON CARD.CardID = MATERNO.CardId
	INNER JOIN 
	(
		SELECT *
		FROM EPICMS.dbo.CardTextData
		WHERE FieldName = 'PERSON_INFO.LAST_NAME'
	) AS PATERNO
		ON CARD.CardID = PATERNO.CardId
	INNER JOIN 
	(
		SELECT *
		FROM EPICMS.dbo.CardTextData
		WHERE FieldName = 'PERSON_INFO.FIRST_NAME'
	) AS NOMBRE
		ON CARD.CardID = NOMBRE.CardId
	INNER JOIN 
	(
		SELECT *
		FROM EPICMS.dbo.CardTextData
		WHERE FieldName = 'PERSON_INFO.METADATA.RFC'
	) AS RFC
		ON CARD.CardID = RFC.CardId
	LEFT JOIN 
	(
		SELECT *
		FROM EPICMS.dbo.CardTextData
		WHERE FieldName = 'PERSON_INFO.METADATA.RFCExtension'
	) AS HOMOCLAVE
		ON CARD.CardID = HOMOCLAVE.CardId
	INNER JOIN 
	(
		SELECT *
		FROM EPICMS.dbo.CardTextData
		WHERE FieldName = 'DocumentDiscriminator'
	) AS NUMEROLICENCIA
		ON CARD.CardID = NUMEROLICENCIA.CardId
	INNER JOIN 
	(
		SELECT *
		FROM EPICMS.dbo.CardTextData
		WHERE FieldName = 'LicenseType'
	) AS TIPOLICENCIA
		ON CARD.CardID = TIPOLICENCIA.CardId
	
	INNER JOIN 
	(
		SELECT *
		FROM EPICMS.dbo.CardTextData
		WHERE FieldName = 'CARD.ACTIVATION_DATE'
			AND ISDATE(TextData) = 1
	) AS FECHAEXPEDICION
		ON CARD.CardID = FECHAEXPEDICION.CardId
	INNER JOIN 
	(
		SELECT *
		FROM EPICMS.dbo.CardTextData
		WHERE FieldName = 'CARD.EXPIRATION_DATE'
			AND ISDATE(TextData) = 1
	) AS FECHAVENCIMIENTO
		ON CARD.CardID = FECHAVENCIMIENTO.CardId 
	LEFT JOIN EPICMS.dbo.CardTextData emi
		ON CARD.CardID = emi.CardId AND emi.FieldName = 'BadgeIssuanceReasonCode'
	
	WHERE 1=1 	".$filtro;
	
													     $stmt = sqlsrv_query( $conn, $tsql);
													     if( $stmt === false )
													     {
													     	echo "Error al ejecutar consulta.</br>";
													     	die( print_r( sqlsrv_errors(), true));
													     }
													     $registros='';
													     /* Mostramos el resultado. */
														 $filas=0;
													     while($row = sqlsrv_fetch_array($stmt)){
													     	$registros.= 	'<tr>
																    		<td>' . $row['Guid'] . '</td>
    																		<td>' . $row['Nombre'] . '</td>
    																		<td>' . $row['CURP'] . '</td>
    																		<td>' . $row['RFC'] . '</td>
																			<td>' . $row['NoLicencia'] . '</td>
    																		<td>' . $row['Expedicion'] . '</td>
																			<td>' . $row['tipolicencia'] . '</td>
																			<td>' . $row['Tramite'] . '</td>
																			<td>' . $row['oficina'] . '</td>
																			<td align=center">';
															$filas=$filas+1;
															/**if($_SESSION['accesslvl']=='sroot' OR $_SESSION['accesslvl']=='constancias')
																$registros.='<a href="imprconstancia.php?guid=' . $row['Guid'] . '" target="_blank" class="btn btn-default btn-circle" alt="Imprimir constancia"><i class="fa fa-file-o text-success"></i></a>
																				<a href="imprvolante.php?guid=' . $row['Guid'] . '" target="_blank" class="btn btn-default btn-circle" alt="Imprimir volante"><i class="fa fa-file-text text-success"></i></a>';***/																			
															$registros.='<a href="verdetallelicencia.php?guid=' . $row['Guid'] . '" target="_blank" class="btn btn-default btn-circle" alt="ver detalle"><i class="fa fa-eye text-success"></i></a>
															</td>';
													     }
													     
													     
													     /* Cerramos la conexión, muy importante. */
													     sqlsrv_free_stmt( $stmt);
													     sqlsrv_close( $conn);
													     }
													     
													     ?> 
											<table class="table table-bordered table-striped" id="tb1" data-rt-breakpoint="600">
												<header>Resultados: <?php echo $filas;?> </header>
											<div class="rt-table">
											<table class="table table-bordered table-striped" id="tb1" data-rt-breakpoint="600">
												<thead>
													<tr>
														<td scope="col" data-rt-column="ID"><strong>GUID</strong></td >
														<td scope="col" data-rt-column="Project"><strong>Nombre</strong></td>
														<td  scope="col" data-rt-column="Status"><strong>CURP</strong></td>
														<td  scope="col" data-rt-column="Status"><strong>RFC</strong></td>														
														<td  scope="col" data-rt-column="Progress"><strong>Numero licencia</strong></td>
														<td  scope="col" data-rt-column="Progress"><strong>Fecha expedici&oacute;n</strong></td>
														<td  scope="col" data-rt-column="Progress"><strong>Tipo</strong></td>
														<td  scope="col" data-rt-column="Progress"><strong>Tramite</strong></td>
														<td  scope="col" data-rt-column="Progress"><strong>Oficina</strong></td>
														<td  scope="col" data-rt-column="Progress"><strong>Ver</strong></td>
													</tr>
												</thead>
												<tbody>
													     <?php echo $registros;?>                                    
												</tbody>
											</table>
											Coincidencias  <?php echo $filas;?>
											</div>
										</div>
										
                                	</div>
                                </div>
                                
                                </div>
                        
                    </div>
					
                </div><!-- End .window -->
                        <div>
						</div></div>                
                
                <?php //include_once('footer.php'); ?>
            </div><!-- End #content -->  
    	</div>
    	<!-- End #main -->
    	
    	
    </div>
    <!-- End #container --> 
</body>
</html>