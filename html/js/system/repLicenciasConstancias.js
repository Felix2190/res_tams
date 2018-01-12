var inicializarControles=function()
	{     
	  	$("#txtFechaIni").datepicker({yearRange:"1900:2020",changeYear :true,changeMonth :true,constrainInput:true,
	        onSelect: function(selected) {           $("#txtFechaFin").datepicker("option","minDate", selected)        }});
	        $("#txtFechaFin").datepicker({yearRange:"1900:2020",changeYear :true,changeMonth :true,constrainInput:true,     
	      onSelect: function(selected) {      $("#txtFechaIni").datepicker("option","maxDate", selected)    }});

	    $("#btnBuscar").click(buscar);
	    $("#municipio").hide();
	    $("#generarCSV").hide();
	    $("#imprimir").hide();
     
	};
	
	var buscar = function(){
		
		var uno=false;
		
		
		CURP= $("#txtCURP").val();
		RFC = $("#txtRFC").val();
		Licencia = $("#txtLicencia").val();
		GUID = $("#txtGUID").val();		
		
		if(CURP==""){
			$(".txtCURP").removeClass("isOk");
			$(".txtCURP").addClass("isError");
			
			}
		else{
    			$(".txtCURP").removeClass("isError");
    			$(".txtCURP").addClass("isOk");
    		uno=true;
		}
		if(RFC==""){
			$(".txtRFC").removeClass("isOk");
			$(".txtRFC").addClass("isError");
			}
		else{
    			$(".txtRFC").removeClass("isError");
    			$(".txtRFC").addClass("isOk");
    			uno=true;
		}
		if(Licencia==""){
			$(".txtLicencia").removeClass("isOk");
			$(".txtLicencia").addClass("isError");
			}
		else{
    			$(".txtLicencia").removeClass("isError");
    			$(".txtLicencia").addClass("isOk");
    			uno=true;
		}
//		if(GUID==""){
//			$(".txtGUID").removeClass("isOk");
//			$(".txtGUID").addClass("isError");
//			}
//		else{
//    			$(".txtGUID").removeClass("isError");
//    			$(".txtGUID").addClass("isOk");
//    			uno=true;
//		}
		
		if(uno)
			xajax_reporte(CURP,RFC,Licencia,GUID);
		else{			
			mostrarAviso("No se ha llenado ningun campo.");
		}
		
	}
	
	var llenarDatos = function(datos){
		 obj = JSON.parse(datos);
		$(".rt-table").html(obj[0]);
		 $('html,body').animate({
		        scrollTop: $(".rt-table").offset().top
		    }, 2000);
		;
		if(obj[1]!=""){
			//$("#generarCSV").show();
			$("#generarCSV").attr("href", obj[1]);
			$("#generarCSV").show();
			$("#imprimir").show();
		}
		$('#tablesorting-1').tablesorter({
	  		theme          : "bootstrap", // this will 
	  		widthFixed     : true,
	  		headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!
	  		widgets        : [ "uitheme", "filter", "zebra" ],
	      serverSideSorting : true,
	  		widgetOptions  : {
	  			zebra : ["even", "odd"],
	  			filter_reset : ".reset",
	  		}
	  	})
		
		$('#example').DataTable( {
	        "scrollX": true
	    } );
	}
	function imprSelec(nombre)
	{
	var ficha = "<html><head><title></title>\	<style>	\	table {		width: 100%;	}		\	.table-striped, table.table-striped td, table.table-striped th,td,th {"+    
			"\			text-align:left;	\			font-size:10px;}	\	table.table-striped "+
			"{		border-collapse: collapse;		width: 100%;	}	\	.total{		font-weight: bold;"+	
			"border-bottom: 1px solid black;	}	\	.stotal , .encabezado{	font-weight: bold;	"+
			"border: 1px solid black;		} header { border: 1px solid #bbb; \ background-color: lightgrey;} .spacer-20{height: 20px;} tr.border_bottom td, tr.border_bottom th{border-bottom: 1px solid #bbb; }</style> \	</head><body><table> "+
			document.getElementById(nombre).innerHTML+"</table></body></html>";	
	var ventimp = window.open(' ', 'popimpr');
	ventimp.title="Reporte..."
	ventimp.document.write( ficha );
	ventimp.document.close();
	ventimp.print( );
	ventimp.close();
	}
	$(document).ready(function(){inicializarControles()});