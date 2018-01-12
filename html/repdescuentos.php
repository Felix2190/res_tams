<?php


	//session_start();
	
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
	require("masterIncludeLogin.inc.php");
	$nav = 'reportes';
	$subnav = 'repdctos'; 


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

    <title>Descuentos Pensi&oacute;n</title>

   
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
                            <h2><i class="fa fa-tags"></i> &nbsp; Descuentos Pensi&oacute;n</h2>                 
                        </div> 
                    </div>
            	</header>


                                     
                <div class="window">  
                    <div class="row ext-raster">
                    	<div class="col-sm-12" >
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="post" name="form">
											<div class="col-sm-4">
                                        		<label for="txtFechaIni" data-date-format="yy-mm-dd" class="txtFechaIni">Desde</label><br />
                								<input type="date" name="txtFechaIni" id="txtFechaIni" class="form-control txtFechaIni" value="<?php echo $fechaini; ?>" />
                							</div> 
                							<div class="col-sm-4">
                                        		<label for="txtFechaFin" class="txtFechaFin">Hasta</label><br />
                								<input type="date" data-date-format='yy-mm-dd' name="txtFechaFin" id="txtFechaFin" class="form-control txtFechaFin" value="<?php echo $fechafin; ?>" />
                							</div> 											
											<div class="spacer-20"></div>
											<hr />
						
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
                                			
                                			<div class="col-sm-3">
											
												<label>&nbsp;</label><br />
												<button type="submit" class="btn btn-success btn-block" id="btnGenerar" name="btnGenerar">Generar Reporte</button>
											</div>
                    
                    						<div class="spacer-20"></div>
										</form>
                            <hr />
                            <div class="row">
                            	<div class="col-sm-12" >
                                    <div class="inner-padding">								
                                        <h4 class="text-muted">Resumen</h4>
                                        <br />
                                        <!--
                                        <div class="statistic-block">
											<header>
												<div class="pull-left">
													Expedici&oacute;n
												</div>
											</header>
											<div class="statistic-block-inner">
												<div class="pull-left">
													<div class="statistic-block-bigval">$9568</div>
													<div class="statistic-block-smalltext pull-right">Total</div>
												</div>
												<div class="pull-right">
													<span class="label label-success">+ 240%<i class="fa fa-caret-up pull-right"></i></span>
												</div>
												<span class="line"></span>    
												<div class="row">
													<div class="col-sm-4">
														<div class="statistic-block-smallval pull-right">1904</div>
														<div class="statistic-block-smalltext pull-right">Orders</div>
													</div>
													<div class="col-sm-4">
														<div class="statistic-block-smallval pull-right">255</div>
														<div class="statistic-block-smalltext pull-right">Sales</div>
													</div>
													<div class="col-sm-4">
														<div class="statistic-block-smallval pull-right">2889</div>
														<div class="statistic-block-smalltext pull-right">Clients</div>
													</div>
												</div>
											</div>
										</div> 
                                        
                                        <div class="statistic-block">
											<header>
												<div class="pull-left">
													Merma
												</div>
											</header>
											<div class="statistic-block-inner">
												<div class="pull-left">
													<div class="statistic-block-bigval">$9568</div>
													<div class="statistic-block-smalltext pull-right">Total</div>
												</div>
												<div class="pull-right">
													<span class="label label-success">+ 240%<i class="fa fa-caret-up pull-right"></i></span>
												</div>
												<span class="line"></span>    
												<div class="row">
													<div class="col-sm-4">
														<div class="statistic-block-smallval pull-right">1904</div>
														<div class="statistic-block-smalltext pull-right">Orders</div>
													</div>
													<div class="col-sm-4">
														<div class="statistic-block-smallval pull-right">255</div>
														<div class="statistic-block-smalltext pull-right">Sales</div>
													</div>
													<div class="col-sm-4">
														<div class="statistic-block-smallval pull-right">2889</div>
														<div class="statistic-block-smalltext pull-right">Clients</div>
													</div>
												</div>
											</div>
										</div> 
										
										
										<div class="statistic-block">
											<header>
												<div class="pull-left">
													Total de Tr&aacute;mites
												</div>
											</header>
											<div class="statistic-block-inner">
												<div class="pull-left">
													<div class="statistic-block-bigval">$9568</div>
													<div class="statistic-block-smalltext pull-right">Total</div>
												</div>
												<div class="pull-right">
													<span class="label label-success">+ 240%<i class="fa fa-caret-up pull-right"></i></span>
												</div>
												<span class="line"></span>    
												<div class="row">
													<div class="col-sm-4">
														<div class="statistic-block-smallval pull-right">1904</div>
														<div class="statistic-block-smalltext pull-right">Orders</div>
													</div>
													<div class="col-sm-4">
														<div class="statistic-block-smallval pull-right">255</div>
														<div class="statistic-block-smalltext pull-right">Sales</div>
													</div>
													<div class="col-sm-4">
														<div class="statistic-block-smallval pull-right">2889</div>
														<div class="statistic-block-smalltext pull-right">Clients</div>
													</div>
												</div>
											</div>
										</div>	End .statistic-block -->
                                        
                                        
                                    </div><!-- End .inner-padding -->  
                                </div>
                                
                                
                                <div class="col-sm-12" id="reporte">
                                	<div class="inner-padding">
                                		<div class="table-wrapper">
											<header>Resultados</header>
											<div class="rt-table">
											<table class="table table-bordered table-striped" id="tb1" data-rt-breakpoint="600">
												<thead>
													<tr>
														<td scope="col" data-rt-column="ID">Ciudad</td>
														<td scope="col" data-rt-column="Project">Oficina</td>
														<td scope="col" data-rt-column="Status">Importe</td>
														<td scope="col" data-rt-column="Status">Cantidad Donativos</td>																											
													</tr>
												</thead>
												<tbody>
													     <?php 
													     if(1==1)
													     {
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
DECLARE @descuentos TABLE(oficina VARCHAR(30),aportacion FLOAT, donativo FLOAT,tipo  varchar(20))
DECLARE @Resul TABLE(ciudad VARCHAR(30),Sitio VARCHAR(30),Importe FLOAT, CantidadDonativos INT, Tipo VARCHAR(30),ordeni INT,orden INT)

	DECLARE @fini varchar(10)
	DECLARE @ffin varchar(10)
	SET @fini='".$fechaini."'
	SET @ffin='".$fechafin."'
	
	INSERT INTO @descuentos
	SELECT cms_site,amountdd,TotalPaid, CASE  WHEN amountdd-TotalPaid=0 THEN 'total' ELSE 'parcial' END AS Tipo 
	FROM (
	

SELECT IdPayDocument,CASE cms_snum WHEN '01' THEN 'Gpe Victoria' WHEN '02' THEN 'Cd Morelos' WHEN '03' THEN 'San Felipe' WHEN '04' THEN 'Mexicali'
	WHEN '05' THEN 'Via Rapida' WHEN '06' THEN 'Mariano' WHEN '07' THEN 'Tecate' WHEN '08' THEN 'Ensenada' WHEN '09' THEN 'Rosarito'
	WHEN '10' THEN 'San Quintin' WHEN '12' THEN 'Rec Palaco' ELSE 'Otros' END AS cms_site,amountdd,TotalPaid
FROM 
	(
	SELECT  ta.IdPayDocument, GUID,[DATEADD],tb.Amount AS amountdd, TotalPaid
	FROM    mercurioprod.dbo.PayDocument TA
		INNER JOIN mercurioprod.dbo.PayDocumentDetail TB
			ON TA.IdPayDocument = TB.IdPayDocument
		INNER JOIN mercurioprod.dbo.PaymentItem TC
			ON TB.IdPaymentItem = TC.IdPaymentItem
		INNER JOIN mercurioprod.dbo.DiscountPaymentItemLicenseTypeOperationType TD
			ON TD.IdLicenseType = TA.IdLicenseType
			AND TD.IdOperationType = TA.IdOperationType
			AND TD.IdPeriod = TB.IdPeriod
			AND TD.IdPaymentItem = TC.IdPaymentItem
		INNER JOIN mercurioprod.dbo.Discount TE
			ON TD.IdDiscount = TE.IdDiscount
	WHERE tb.TotalDiscount <> 0 AND TA.[DateAdd] BETWEEN @fini AND @ffin
) as PER1	
INNER JOIN IdentityManager.dbo.Person PER
	ON per.Guid=per1.GUID
		INNER JOIN EPICMS.dbo.CardHolderExternalRefs CARDHER
			ON PER1.Guid = CARDHER.RecordID
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
			WHERE FieldName = 'ADDRESS.METADATA.County'
		) AS DELEGACION
			ON CARD.CardID = DELEGACION.CardId
	INNER JOIN		
	(SELECT     CardId, RIGHT(LEFT(TextData, 4), 2) AS cms_snum, TextData AS TextDatacms
		FROM          EPICMS.dbo.CardTextData
		WHERE      (FieldName = 'DocumentDiscriminator')) AS ofi
	ON ofi.CardId=card.CardID
	GROUP BY IdPayDocument,cms_snum,TextData,TextDatacms,amountdd,TotalPaid
) AS descuentos

INSERT INTO @Resul
SELECT * FROM (
	SELECT CASE oficina WHEN 'Cd Morelos' THEN 'Mexicali' WHEN 'Mariano' THEN 'Tijuana' 
		WHEN 'San Felipe' THEN 'Mexicali' WHEN 'Via Rapida' THEN 'Tijuana' WHEN 'Gpe Victoria' THEN 'Mexicali' 
		WHEN 'San Quintin' THEN 'Ensenada' Else oficina END AS Ciudad,
		oficina,sum(aportacion) AS importe,COUNT(*) aS [cantidad donativos],tipo,1 AS orden,0 AS ordeni   
	FROM @descuentos
	GROUP BY oficina,tipo
	) AS p 
WHERE Ciudad IN ( ";
	
	
														if ($mexicali=='checked')
													     	$tsql.=" 'Mexicali',";
												     	if ($tijuana=='checked')
												     		$tsql.=" 'Tijuana',";
												     	if ($rosarito=='checked')
												     		$tsql.=" 'Rosarito',";
												     	if ($ensenada=='checked')
												     		$tsql.=" 'Ensenada',";
												     	if ($tecate=='checked')
												     		$tsql.=" 'Tecate',";
														
												     	$tsql=trim($tsql,',').")  ORDER BY 1,oficina
														
														DECLARE @ciudad VARCHAR(20)
														DECLARE c_totales CURSOR FOR 
															SELECT ciudad FROM  @Resul 
															GROUP BY ciudad
														OPEN C_totales
														FETCH NEXT FROM C_Totales INTO @ciudad
														WHILE @@FETCH_STATUS = 0  
															BEGIN  
																INSERT INTO @Resul
																SELECT ciudad,'Total', SUM(Importe),SUM(CantidadDonativos),'',1 ,1
																FROM @Resul WHERE ciudad=@ciudad
																GROUP BY ciudad
																FETCH NEXT FROM C_Totales INTO @ciudad
															END
														CLOSE C_totales;  
														DEALLOCATE C_totales;	
															
														INSERT INTO @Resul
														SELECT 'Total','',SUM(Importe), SUM(CantidadDonativos), '',2,2 FROM @Resul 
														WHERE Sitio<>'Total'

														SELECT * FROM @Resul	
														ORDER BY ordeni,ciudad,orden";
	
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
																    		<td>' . $row['0'] . '</td>
    																		<td>' . $row['1'] . '</td>
    																		<td>' . $row['2'] . '</td>
    																		<td>' . $row['3'] . '</td>
																			<td>' . $row['4'] . '</td>';
													     }
													     
													     echo $registros;
													     /* Cerramos la conexión, muy importante. */
													     sqlsrv_free_stmt( $stmt);
													     sqlsrv_close( $conn);
													     }
													     
													     ?>                                     
												</tbody>
											</table></div>
										</div>
								
                                	</div>
                                </div>
                                
                                
                                
                            </div><!-- End .row -->
                        </div>
                        <div><div class="inner-padding"><div class="col-sm-1">
									<a href="javascript:imprSelec('reporte')" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
								</div>
								<div class="col-sm-1">
									&nbsp;
							</div>
							<div class="col-sm-1">
								<a href="#" class="btn btn-info btn-lg export"><span class="glyphicon glyphicon-floppy-save"></span> Exportar</a>
							</div>
						</div></div>                        
                    </div>
                </div><!-- End .window -->
                
                
                <?php //include_once('footer.php'); ?>
            </div><!-- End #content -->  
    	</div>
    	<!-- End #main -->
    	
    	
    </div>
    <!-- End #container --> 
</body>
</html>