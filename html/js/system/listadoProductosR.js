
	var inicializarControles=function()
	{	
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
  	}).tablesorterPager({
            serverSideSorting : true,
            ajaxUrl: 'getListadoProductosR.php?page={page}&size={size}&{sortList:col}&{filterList:filter}',
            customAjaxUrl: function (table, url) {
                return url;
            },
            ajaxProcessing: function (ajax, table) {
              $("#tablesorting-1").trigger("update");            
                if (ajax) {
                	$("#tablesorting-1").find('tbody').empty();                    
                    $.each(ajax[1], function (i, item) {  
                    	var html = "<td>" + item.codigo + "</td>" +
                        "<td>" + item.nombre + "</td>" +
                        "<td>" + item.costoOrigen + "</td>" +
                        "<td>" + item.costoFOBMXUS + "</td>" +
                        "<td>" + item.CostoMXN + "</td>" +
                        "<td>" + item.precioVenta + "</td>" +
                        "<td>" + item.comisionMaxima+ "</td>" +
                        "<td>" +
		                  '<a href="verProductoR.php?id='+ item.idproducto + '" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a>'+
		                  '<a href="registroEntrada.php" class="btn btn-default btn-circle"><i class="fa fa-plus"></i></a>'+
	                  "</td>";
                        $("<tr/>").html(html).appendTo(table);
                    });
                    return [ajax[0]];                                        
                }                
            },
            container: $(".pager"),
            cssGoto: $(".pagenum"),
            cssPageSize: $(".pagesize"),
            cssPageDisplay: $(".pagedisplay"),
            removeRows: false,
            output: '{startRow} - {endRow} | {totalRows} [ {originalTotal} ]',
            savePages: false,
            fixedHeight: true
        }); 
  	
  	$("#aDesc").click(function() {
		
		mostrarEspera("Generando reporte... (puede tardar varios minutos)");
		
		xajax_generaExcel();
		return false;
	});
  	
  	var descargar = function(url){
  		window.open(url,"Reporte de productos");
  	}
  	
	};
	$(document).ready(function(){inicializarControles()});