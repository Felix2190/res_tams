var inicializarControles=function()
	{     
	  	$("#txtFechaIni").datepicker({yearRange:"1900:2020",changeYear :true,changeMonth :true,constrainInput:true,
	        onSelect: function(selected) {           $("#txtFechaFin").datepicker("option","minDate", selected)        }});
	        $("#txtFechaFin").datepicker({yearRange:"1900:2020",changeYear :true,changeMonth :true,constrainInput:true,     
	      onSelect: function(selected) {      $("#txtFechaIni").datepicker("option","maxDate", selected)    }});

	    $("#btnGenerar").click(reporte);
	    $("#municipio").hide();
	    $("#generarCSV").hide();
	    $("#imprimir").hide();
	};
	
	var reporte = function(){
		chk = $(":checkbox");//selecciona todos los checkbox del dom
		chkA= new Array();//agrega los checkbox que esta checked
		for(i=0; i < chk.length; i++){
			console.log(document.getElementById(chk[i].id));
			c = document.getElementById(chk[i].id);			
			 if(c.checked) { 
				 chkA.push(chk[i].id);		// agrega al arreglo los checkbox seleccionados para pasarlos como parametros            
		        }  
		}
		FechaIni = $("#txtFechaIni").val();
		FechaFin = $("#txtFechaFin").val();
		municipio = $("#municipioC").val();
		if(FechaIni==""){
			mostrarAviso("No se ha seleccionado la Fecha de inicio.");
			return;
		}
		if(FechaFin==""){
			mostrarAviso("No se ha seleccionado la Fecha final.");
			return;
		}
		
		Oficina = $("#Oficina").val();
		anios = $("#anios").val();
		if(chkA.length ==0){
			mostrarAviso("No se ha seleccionado ninguna oficina.");
		}else{
			xajax_reporte(FechaIni,FechaFin,municipio,chkA,anios);
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
			$("#generarCSV").attr("href", "tmp/"+obj[1]);
			$("#generarCSV").show();
			$("#imprimir").show();
		}
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