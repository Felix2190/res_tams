var guardar = function(){
  var existeError = false;
	var txtNombre = $("#txtNombre").val();

	if(txtNombre==""){
    $("#txtNombre").removeClass("isOk");
    $("#txtNombre").addClass("isError");
		existeError = true;
	}else{
    $("#txtNombre").removeClass("isError");
    $("#txtNombre").addClass("isOk");
  }
  var turnos = 0;
  var verificacion = 0;
  var modulo1 = 0;
  var modulo2 = 0;
  var modulo3 = 0;
  var reportes = 0;
  var usuarios = 0;
  var roles = 0;
  var recaudaciones = 0;
  var reglas = 0;
  var descuentos = 0;
  var soporte = 0;
  $.each($("input[name='turnos[]']:checked"), function(){            
    turnos += $(this).val() * 1;
  });
  $.each($("input[name='verificacion[]']:checked"), function(){            
    verificacion += $(this).val() * 1;
  });
  $.each($("input[name='modulo1[]']:checked"), function(){            
    modulo1 += $(this).val() * 1;
  });
  $.each($("input[name='modulo2[]']:checked"), function(){            
    modulo2 += $(this).val() * 1;
  });
  $.each($("input[name='modulo3[]']:checked"), function(){            
    modulo3 += $(this).val() * 1;
  });
  $.each($("input[name='reportes[]']:checked"), function(){            
    reportes += $(this).val() * 1;
  });
  $.each($("input[name='usuarios[]']:checked"), function(){            
    usuarios += $(this).val() * 1;
  });
  $.each($("input[name='roles[]']:checked"), function(){            
    roles += $(this).val() * 1;
  });
  $.each($("input[name='recaudaciones[]']:checked"), function(){            
    recaudaciones += $(this).val() * 1;
  });  
  $.each($("input[name='reglas[]']:checked"), function(){            
    reglas += $(this).val() * 1;
  });  
  $.each($("input[name='descuentos[]']:checked"), function(){            
    descuentos += $(this).val() * 1;
  });
  $.each($("input[name='soporte[]']:checked"), function(){            
    soporte += $(this).val() * 1;
  });                  

  if(existeError){
		mostrarAviso("Faltan capturar algunos campos.");
    return false;
  }


	mostrarEspera("Registrando información...");
    			xajax_guardar(    					
    					txtNombre,
    					turnos,
              verificacion,
              modulo1,
              modulo2,
              modulo3,
              reportes,
              usuarios,
              roles,
              recaudaciones,
              reglas,
              descuentos,
              soporte);
}

var inicializarControles=function()
	{	

  	 $("#btnGuardar").click(guardar);  
      $('.chk_lectura').click(function(){
        var nombre = $(this).attr('name');
        if($(this).is(':checked')){
          $('input:checkbox[name="' + nombre + '"]').removeAttr('disabled');
        }else{
          $('input:checkbox[name="' + nombre + '"]').prop('checked' , false);
          $('input:checkbox[name="' + nombre + '"]').attr('disabled','disabled');
          $(this).removeAttr('disabled');
        }
      });
  	
	};
	$(document).ready(function(){inicializarControles()});