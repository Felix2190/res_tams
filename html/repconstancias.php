<?php

	$tijuana='checked';
	$mexicali='checked';
	$ensenada='checked';
	$tecate='checked';
	$rosarito='checked';
	$txtBuscar='';
	
	
	if (isset($_POST['btnBuscar'])) {
		
		if (isset($_POST['txtBuscar']))
			$txtBuscar=$_POST['txtBuscar'];		

	}

	require("masterIncludeLogin.inc.php");
	$nav = 'reportes';
	$subnav = 'constancias';  
	

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

    <title>Constancias</title>

    
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
    
    <script type="text/javascript" src="js/lib/ui.datepicker-es-MX.js"></script>
    
    <script type="text/javascript" src="js/system/oficinas.js"></script>
	<script>
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
	<!-- Exportar -->
	<script src="js/libs/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/libs/jquery-git.js"></script>
	
	<script>
		
		
		$(document).ready(function () {

		function exportTableToCSV($table, filename) {

			var $rows = $table.find('tr:has(td)'),

				// Temporary delimiter characters unlikely to be typed by keyboard
				// This is to avoid accidentally splitting the actual contents
				tmpColDelim = String.fromCharCode(11), // vertical tab character
				tmpRowDelim = String.fromCharCode(0), // null character

				// actual delimiter characters for CSV format
				colDelim = '","',
				rowDelim = '"\r\n"',

				// Grab text from table into CSV formatted string
				csv = '"' + $rows.map(function (i, row) {
					var $row = $(row),
						$cols = $row.find('td');

					return $cols.map(function (j, col) {
						var $col = $(col),
							text = $col.text();

						return text.replace(/"/g, '""'); // escape double quotes

					}).get().join(tmpColDelim);

				}).get().join(tmpRowDelim)
					.split(tmpRowDelim).join(rowDelim)
					.split(tmpColDelim).join(colDelim) + '"',

				// Data URI
				csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

			$(this)
				.attr({
				'download': filename,
					'href': csvData,
					'target': '_blank'
			});
		}

		// This must be a hyperlink
		$(".export").on('click', function (event) {
			// CSV
			exportTableToCSV.apply(this, [$('#tb1'), 'export.csv']);
						
			// IF CSV, don't do event.preventDefault() or return false
			// We actually need this to be a typical hyperlink
		});
	});
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
                            <h2><i class="fa fa-file-text-o"></i> &nbsp; Constancias</h2>                 
                        </div> 
                    </div>
            	</header>


                                     
                <div class="window">  
                    <div class="row ext-raster">
                    	<div class="col-sm-12" >
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="post" name="form">
											<div class="col-sm-4">
                                        		<label for="txtBuscar" data-date-format="yy-mm-dd" class="txtBuscar" >Buscar </label><br />
                								<input type="text" name="txtBuscar" id="txtBuscar" class="form-control txtBuscar" placeholder="Indique: CURP o RFC o Numero de licencia o GUID" value="<?php echo $txtBuscar; ?>" />
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
                                        <br />

                                        
                                        
                                    </div><!-- End .inner-padding -->  
                                </div>
                                
                                
                                <div class="col-sm-12">
                                	<div class="inner-padding">
                                		<div class="table-wrapper">
											<header>Resultados</header>
											<div class="rt-table">
											<table class="table table-bordered table-striped" id="tb1" data-rt-breakpoint="600">
												<thead>
													<tr>
														<td scope="col" data-rt-column="ID">GUID</td >
														<td scope="col" data-rt-column="Project">Nombre</td>
														<td  scope="col" data-rt-column="Status">CURP</td>
														<td  scope="col" data-rt-column="Status">RFC</td>														
														<td  scope="col" data-rt-column="Progress">Numero licencia</td>
														<td  scope="col" data-rt-column="Progress">Fecha expedici&oacute;n</td>
														<td  scope="col" data-rt-column="Progress">Tipo</td>
														<td  scope="col" data-rt-column="Progress">Acciones</td>
													</tr>
												</thead>
												<tbody>
													     <?php 
													     if (isset($_POST['btnBuscar']))
													     {														 
														 $filtro="";
														 if (strlen($txtBuscar)<10){
															//NO es un parametro de busqueda
															$filtro="";	
															return;
														 }elseif(strlen($txtBuscar)==10){
															$filtro=" WHERE RFC.TextData='".$txtBuscar."'";
															//busquda con RFC
														}elseif(strlen($txtBuscar)==11){
															$filtro=" WHERE NUMEROLICENCIA.TextData='".$txtBuscar."'";
															//busquda con RFC
														 }elseif(strlen($txtBuscar)==13){
															//RFC + Homoclave
															$filtro=" WHERE RFC.TextData+HOMOCLAVE.TextData='".$txtBuscar."'";
														 }elseif(strlen($txtBuscar)==18){
															//RFC + Homoclave
															$filtro=" WHERE CURP.StringValue='".$txtBuscar."'";
														 }
														 elseif (strlen($txtBuscar)==36){
															//GUID
															 $filtro=" WHERE PER.Guid='".$txtBuscar."'";
															
														 }else{
															//Nombre
															$filtro=" WHERE NOMBRE.TextData + ' ' + PATERNO.TextData  + ' ' + MATERNO.TextData='".$txtBuscar."'";
														 }	
														   function sqlsrv_connect($serverName, $connectionInfo){
                                return false;
                               }
                               function sqlsrv_errors(){
                                return false;
                               }                                  													 
														 
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
													     
													     /* Query que nos mostrara el usuario con el que nos hemos conectado a la base de datos. */
													     $tsql = "SET NOCOUNT ON;
														 SELECT PER.ID,PER.Guid, NOMBRE.TextData + ' ' + PATERNO.TextData  + ' ' + MATERNO.TextData AS Nombre,RFC.TextData AS RFC,
HOMOCLAVE.TextData AS HomoClave,CURP.StringValue AS CURP,NUMEROLICENCIA.TextData AS NoLicencia
,FECHAEXPEDICION.TextData  AS Expedicion,FECHAVENCIMIENTO.TextData AS Vencimiento,TIPOLICENCIA.TextData AS tipolicencia

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
		ON CARD.CardID = FECHAVENCIMIENTO.CardId ".$filtro;
	
													     $stmt = sqlsrv_query( $conn, $tsql);
													     if( $stmt === false )
													     {
													     	echo "Error al ejecutar consulta.</br>";
													     	die( print_r( sqlsrv_errors(), true));
													     }
													     $registros='';
													     /* Mostramos el resultado. */
													     while($row = sqlsrv_fetch_array($stmt)){
													     	$registros.= 	'<tr>
																    		<td>' . $row['Guid'] . '</td>
    																		<td>' . $row['Nombre'] . '</td>
    																		<td>' . $row['CURP'] . '</td>
    																		<td>' . $row['RFC'] . '</td>
																			<td>' . $row['NoLicencia'] . '</td>
    																		<td>' . $row['Expedicion'] . '</td>
																			<td>' . $row['tipolicencia'] . '</td>
																			<td>';
															if($_SESSION['accesslvl']=='sroot' OR $_SESSION['accesslvl']=='constancias')
																$registros.='<a href="imprconstancia.php?guid=' . $row['Guid'] . '" target="_blank" class="btn btn-default btn-circle" alt="Imprimir constancia"><i class="fa fa-file-o text-success"></i></a>
																				<a href="imprvolante.php?guid=' . $row['Guid'] . '" target="_blank" class="btn btn-default btn-circle" alt="Imprimir volante"><i class="fa fa-file-text text-success"></i></a>';																			
															$registros.='<a href="verdetallelicencia.php?guid=' . $row['Guid'] . '" target="_blank" class="btn btn-default btn-circle" alt="ver detalle"><i class="fa fa-eye text-success"></i></a>
															</td>';
													     }
													     
													     echo $registros;
													     /* Cerramos la conexión, muy importante. */
													     sqlsrv_free_stmt( $stmt);
													     sqlsrv_close( $conn);
													     }
													     
													     ?>                                     
												</tbody>
											</table>
											
											</div>
										</div>
										<span><b>Nota:</b><span> Al imprimir una constancia o un volante se hace el registro, y se genera un costo.
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