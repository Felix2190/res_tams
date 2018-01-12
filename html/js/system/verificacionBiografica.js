$(document).ready(function(){inicializarControles()});

var verTurno=function(idT)
{
mostrarAviso('Ingresa la curp para verificar tu identidad...');
$("#divCURP").show();
$("#hdnIdTurno").val(idT);
$("#txtCURP").val('');
//xajax_verTicket(idT);

	 }

function validarCURP(){
	if($("#txtCURP").val()==''){
		mostrarError('Debe ingresar la curp.');
		return false;
	}
	
	xajax_validaCURP($("#txtCURP").val(),$("#hdnIdTurno").val());
}

var inicializarControles=function(){
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
            ajaxUrl: 'getTurnosVerificacion.php?page={page}&size={size}&{sortList:col}&{filterList:filter}',
            customAjaxUrl: function (table, url) {
                return url;
            },
            ajaxProcessing: function (ajax, table) {
            	$("#tablesorting-1").trigger("update");
            	$("#tablesorting-1").find('tbody').empty();
                if (ajax) {
                	$.each(ajax[1], function (i, item) {  
                    	var html = "<td>" + item.idTurno+ "</td>" +
                    	"<td>" + item.turnoExterno+ "</td>" +
                    	"<td>" + item.idPersona+ "</td>" +
                    	"<td>" + item.fechaHora+ "</td>" +
                    	"<td><a href='javascript:verTurno("+item.idTurno+");' class='btn btn-default' name='btnPreview'><i class='fa fa-folder-open'></i></a> </td>" ;
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
  	

	
	}
