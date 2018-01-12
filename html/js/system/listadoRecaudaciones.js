var inicializarControles=function()
	{	
    var p = $('#p').val();
    if(p==1){
      $.each( $('#tablesorting-1 tr td.opciones'), function( key, value ) {
        $(this).html('N/A');
      });    
    }  	
	};
	$(document).ready(function(){inicializarControles()});