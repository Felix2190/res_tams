$(document).ready(function(){inicializarControles()});

var inicializarControles=function()
	{
  	 $("#btnCapturar").click(capturar);
  	 
  	 
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
            ajaxUrl: 'getTurnosVerificacionBiom.php?page={page}&size={size}&{sortList:col}&{filterList:filter}',
            customAjaxUrl: function (table, url) {
                return url;
            },
            ajaxProcessing: function (ajax, table) {
            	$("#tablesorting-1").trigger("update");
            	$("#tablesorting-1").find('tbody').empty();
                if (ajax) {
                	$.each(ajax[1], function (i, item) {  
                    	var html = "<td>" + item.idTurno+ "</td>" +
                    	"<td>" + item.estatus+ "</td>" +
                    	"<td>" + item.fecha+ "</td>" +
                    	'<td><a href="javascript:verTurno('+item.idVerificacionBiografica+',\''+item.estatus+'\''+',\''+item.entrada+'\');" class="btn btn-default" name="btnPreview"><i class="fa fa-folder-open"></i></a> </td>';
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


function capturar()
{
	mostrarEspera('Espere un momento...');
	setTimeout(function(){
	var dedoM='<img alt="" src="images/'+$("#slcOpcM").val()+'.png" height="180"/>';
	var dedoA='<img alt="" src="images/'+$("#slcOpcA").val()+'.png" height="180"/>';
	var dedoE='<img alt="" src="images/'+$("#slcOpcE").val()+'.png" height="180"/>';
	var dedoI='<img alt="" src="images/'+$("#slcOpcI").val()+'.png" height="180"/>';
	
	$("#divHuellas").html(dedoI+'&nbsp;'+dedoE+'&nbsp;'+dedoA+'&nbsp;'+dedoM);
	mostrarAviso('Capturaci&oacute;n correcta!...');
	  },2000);    
	
	if($("#hdnEstatus").val()=='Válido'){
		$("#divButtons").html('<a type="button" class="btn btn-warning" id="btnCancelar">Cancelar</a>'
								+'<a type="button" class="btn btn-success" id="btnVerificar11">Verificar</a>');
		$("#btnVerificar11").click(verificar11);
	}else{
		$("#divButtons").html('<a type="button" class="btn btn-warning" id="btnCancelar">Cancelar</a>'
								+'<a type="button" class="btn btn-success" id="btnVerificar1N">Verificar</a>');
		$("#btnVerificar1N").click(verificar1N);
	  	 
	}
}

var verTurno=function(idT, estatus, entrada)
{
	  $('html,body').animate({
	        scrollTop: $("#verificaH").offset().top
	    }, 2000);
	  
mostrarAviso('Verificaci&oacute;n de huellas d&aacute;ctilares...');
$("#divBiom").show();
$("#hdnIdVerBiom").val(idT);
$("#hdnEstatus").val(estatus);

var label='CURP';
if(estatus=='Válido')
	label='Nombre';

var infoTurno='<div class="inner-padding"><p><strong>ID Turno: &ensp;</strong><label class="text-muted">'+idT+'</label></p>'+
				'<p><strong>'+label+': &ensp;</strong><label class="text-muted">'+entrada+'</label></p></div>';

$("#datosPersona").html(infoTurno);


 }


function verificar11(){
	mostrarEspera('Espere un momento...');
	setTimeout(function(){
		$("#divButtons").html('<a type="button" class="btn btn-warning" id="btnCancelar">Cancelar</a>'+
							'<a type="button" class="btn btn-success" id="btnVerificar1N">Verificar</a>');
		$("#btnVerificar1N").click(verificar1N);
	  	
	mostrarAviso('Verificaci&oacute;n 1:1 correcta!...');
	  },2000);    
	
}

function verificar1N(){
	mostrarEspera('Espere un momento...');
	setTimeout(function(){
	mostrarAviso('Verificaci&oacute;n 1:N correcta!...');
	  },2000);    
	
	xajax_validacionBiometrica($("#hdnIdVerBiom").val(),true);
}


