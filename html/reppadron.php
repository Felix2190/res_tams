<?php
//	require('validarpermiso.php');	
	
	require("masterIncludeLogin.inc.php");
	$nav = 'reportes';
	$subnav = 'reppadron';
	

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

    <title>Padron de licencias</title>

    
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
	
    <!-- Exportar-->
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
                            <h2><i class="fa fa-globe"></i> &nbsp; Padron de licencias</h2>                 
                        </div> 
                    </div>
            	</header>


                                     
                <div class="window">  
                    <div class="row ext-raster">
                    	<div class="col-sm-12">
                            
                            <hr />
                            <div class="row">
                            	<div class="col-sm-12"  >
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
                                
                                
                                <div class="col-sm-12"  id="reporte">
                                	<div class="inner-padding">
                                		<div class="table-wrapper">
											<header>Resultados</header>
											<div class="rt-table">
											<table class="table table-bordered table-striped" id="tb1" data-rt-breakpoint="600">
												<thead>
													<tr>
														<td scope="col" data-rt-column="ID">Concepto</td>
														<td scope="col" data-rt-column="Project">Total</td>														
													</tr>
												</thead>
												<tbody>
													     <?php 
													     if (1==1)
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
														 SELECT Año AS Estatus, total FROM (
	SELECT  COUNT(*) AS total,Estatus,CASE Estatus WHEN 'Vencida' THEN  CAST(DATEPART(YYYY,GETDATE())-Año AS VARCHAR) + ' Año Vencimiento '
		WHEN 'Vigente' THEN ' Proximas ' +  CAST(Año AS VARCHAR) END AS Año
	FROM 
		(SELECT CardId,  CASE WHEN CONVERT(char(10),textdata,120)<CONVERT(char(10),GETDATE(),120) THEN 'Vencida' ELSE 'Vigente '  END Estatus,
		CAST(DATEPART(yyyy,CONVERT(char(10),textdata,120))  AS INT) AS  Año,
		CAST(CONVERT(char(10),textdata,120) AS SMALLDATETIME)AS fechavencimiento
		,DATEDIFF(DD,CAST(CONVERT(char(10),textdata,120) AS SMALLDATETIME)+365 ,GETDATE())AS dif
		FROM [EPICMS].[dbo].[CardTextData] where FieldName = 'CARD.EXPIRATION_DATE' and LEFT(textdata, 4) < datepart(yyyy,GETDATE())+6 and LEFT(textdata, 4) > datepart(yyyy,GETDATE())-6 
		AND ISDATE(CONVERT(char(10),textdata,120))=1 AND LEN(LTRIM(CONVERT(char(10),textdata,120)))=10
		
		) AS a

	GROUP BY Estatus,Año
	) AS p
WHERE Año<>'0 Año Vencimiento'
ORDER BY Año ASC
";
	
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
																    		<td>' . str_replace("ñ","&ntilde;",$row['0'])  . '</td>
    																		<td>' . $row['1'] . '</td>';
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