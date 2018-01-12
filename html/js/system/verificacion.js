var inicializarControles=function()
	{
  	 $("#btnVerificar").click(verificar);
  	 
	}


function verificar()
{
	mostrarEspera('Espere un momento...');
	setTimeout(function(){
	var pulgarD='<img alt="" src="images/'+$("#slcOpcD").val()+'.png" height="220"/>';
	var pulgarI='<img alt="" src="images/'+$("#slcOpcI").val()+'.png" height="220"/>';
	
	$("#divHuellas").html(pulgarD+'&nbsp;'+pulgarI);
	mostrarAviso('Verificaci&oacute;n correcta!...');
	  },2000);    
	
}

$(document).ready(function(){inicializarControles()});