
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
            ajaxUrl: 'getListadoHistorial.php?page={page}&size={size}&{sortList:col}&{filterList:filter}',
            customAjaxUrl: function (table, url) {
                return url;
            },
            ajaxProcessing: function (ajax, table) {
              $("#tablesorting-1").trigger("update");            
                if (ajax) {
                	$("#tablesorting-1").find('tbody').empty();                    
                    $.each(ajax[1], function (i, item) {  
                    	var html = "<td>" + item.fechaAlta + "</td>" +
                        "<td>" + item.tipo + "</td>" +
                        "<td>" + item.codigo + "</td>" +
                        "<td>" + item.numeroSerie + "</td>" +
                        "<td>" + item.mac +"</td>" +
                        "<td>" + item.ubicacion + "</td>"                                                                                                             
                        ;
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
	};
	$(document).ready(function(){inicializarControles()});