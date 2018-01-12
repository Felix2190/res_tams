	

	var buscar = function(){
		//alert();
		var nombre = $("#nombre").val().trim();
		var numSerie = $("#numSerie").val().trim();
		var estatus = $("#estatus").val();
		var codigo = $("#codigo").val().trim();
		var tipo = $("#tipo").val();
		var existencias = $("#existencias").val();
		var existencias = $('input:radio[name=existencias]:checked').val();
		
		uno = false;
		if (nombre != ""){
			uno = true;
		}
		
		if (numSerie != ""){
			uno = true;
		}
		if (codigo != ""){
			uno = true;
		}
		
		if(uno){
			xajax_buscar(nombre,numSerie,estatus,codigo,tipo,existencias);
		}else{
			mostrarError("Captura ls informaci&oacute;n de busqueda.");
		}
		
		
	}
	
	var cargar=function(datos)
	{		 obj = JSON.parse(datos);
			datos = obj[1];
  	         //console.log(obj[1]);
                if (datos) {
                	$("#tablesorting-1").find('tbody').empty();                    
                    $.each(datos, function (i, item) {  
                    	var html = "<tr><td>" + item.codigo + "</td>" +
                        "<td>" + item.nombre + "</td>" +
                        "<td>" + item.precioVenta + "</td>" +
                        "<td>" + item.comisionMaxima + "</td>" +
                        "<td>" + item.unidadesDisponibles + "</td>" +                                                                                                            
                        "<td>" +
					                  '<a href="listadollamadasedicion.php?id='+ item.idproducto + '" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a>'+
					                  '<a href="listadollamadasedicion.php?id='+ item.idproducto + '" class="btn btn-default btn-circle"><i class="fa fa-plus"></i></a>'+
				                  "</td></tr>";
                        //$("<tr/>").html(html).appendTo(table);
                        $("#tablesorting-1 tbody").append(html)
                    });
                    return [obj[0]];                                        
                }                
            
        };
        
        var buscador=function()
    	{	
        	
        	var nombre = $("#nombre").val().trim();
    		var numSerie = $("#numSerie").val().trim();
    		var estatus = $("#estatus").val();
    		var codigo = $("#codigo").val().trim();
    		var tipo = $("#tipo").val();
    		var existencias = $("#existencias").val();
    		var existencias = $('input:radio[name=existencias]:checked').val();
    		
    		uno = false;
    		if (nombre != ""){
    			uno = true;
    		}
    		
    		if (numSerie != ""){
    			uno = true;
    		}
    		if (codigo != ""){
    			uno = true;
    		}
    		
    		if(uno){
    			//$('table').trigger('pageSet', 1);//pagina inicial
    			page=0;
    			size=50,
    			col="";
    			filter="";
    			mostrarAviso("Procesando solicitud.");
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
    	                ajaxUrl: 'getBuscarProductos.php?page={page}&size={size}&{sortList:col}&{filterList:filter}',
    	            	ajaxObject: {
    	                    dataType: 'json',
    	                    data: {
    	                    	nombre:nombre,
    	                    	numSerie:numSerie,
    	                    	estatus:estatus,
    	                    	codigo:codigo,
    	                    	tipo:tipo,
    	                    	existencias:existencias,    	                    	
    							page:page,
    							size:size,
    							sortList:col,
    							filterList:filter    	                    	
    	                    },
    	                    type: 'POST',
    	                    ContentType: 'application/json; charset=utf-8',
    	                },
    	                pageReset:0,
    	                customAjaxUrl: function (table, url) {
    	                    return url;
    	                },
    	                ajaxProcessing: function (ajax, table) {
    	                  $("#tablesorting-1").trigger("update");            
    	                    if (ajax) {
    	                    	$("#tablesorting-1").find('tbody').empty();                    
    	                        $.each(ajax[1], function (i, item) {  //Código, foto, nombre, existencia, estatus, MAC*, opciones (ver detalle)
    	                        	var html = "<td>" + item.codigo + "</td>" +
    	                            "<td><img src='/images/productos/" + item.foto + "' alt='' border=3 height=100 width=100></img></td>" +
    	                            "<td>" + item.nombre  + "</td>" +
    	                            "<td>" + item.unidadesDisponibles + "</td>" +
    	                            "<td>" + item.estatus + "</td>" +  
    	                            
    	                            "<td>" +
    	    					                  '<a href="verProducto.php?id='+ item.idproducto + '" class="btn btn-default btn-circle"><i class="fa fa-eye"></i></a>'+    	    					                  
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
    			ocultarMensaje();
    		}else{
    			mostrarError("Captura ls informaci&oacute;n de busqueda.");
    		}
        
      	                                                            
    	};
  	
	var inicializarControles=function()
	{	
		$("#btnBuscar").click(buscador);
	};
	$(document).ready(function(){inicializarControles()});