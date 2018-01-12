function mostrarPregunta(index)
{
   // mostrarEspera("calis");
   
    if (index>=0)
    {
        var idRespuesta = $("input[name='respuestas']:checked").val();
        var idPregunta = $('#idPregunta').val();
        //mostrarEspera(idPregunta);
        xajax_mostrarPregunta(index,idRespuesta,idPregunta);
    }
}
//Se usa cuando el examen es medico y se muestra una caja de texto para la captura de observaciones
//tambien en examen practico para seleccionar si el contribuyente aprueba o no el examen
function guardar()
{
    var  observaciones = $('#txtObservaciones').val();
    var aprobado = $("input[name='aprobado']:checked").val();
    if($('#tipoExamen').val()=='practico')
    {
        if(aprobado==undefined)
        {
            mostrarDenegado("Seleccione si el examen fue aprobado o no.");
            return;            
        }  
    }
    var  observaciones = $('#txtObservaciones').val();
    mostrarEspera("Procesando solicitud...");
    xajax_actualizarEvaluacion(observaciones,aprobado);
}

//var parametro = 1;
  //  mostrarConfirmacion("Quieres guardar datos", parametro,calis);
var calis =function()
{
    mostrarEspera("Procesando solicitud...");
   // xajax_guardarEvaluacion();
    //mostrarExpera(mensaje);
    
}

var totalTiempo=900;
var timestampStart = new Date().getTime();
var endTime=timestampStart+(totalTiempo*1000);
var timestampEnd=endTime-new Date().getTime();

/* Variable que contiene el tiempo restante */
var tiempRestante=totalTiempo;

$(document).ready(function() {
   
   if($('#tipoExamen').val()=='Teorico')
   {
    setValores($('#tiempoExamen').val())
    updateReloj();
   }
});
//setInterval(function() { updateReloj()}, 1000);
function setValores(tiempo)
{
    totalTiempo = tiempo*60;
    endTime=timestampStart+(totalTiempo*1000);    
    timestampEnd=endTime-new Date().getTime();
    tiempRestante=totalTiempo;
}

/* Ejecutamos la funcion updateReloj() al cargar la pagina */
//updateReloj();

function updateReloj() {
    var Seconds=tiempRestante;
    var Days = Math.floor(Seconds / 86400);
    Seconds -= Days * 86400;
    var Hours = Math.floor(Seconds / 3600);
    Seconds -= Hours * (3600);
    var Minutes = Math.floor(Seconds / 60);
    Seconds -= Minutes * (60);
    var TimeStr = ((Days > 0) ? Days + " dias " : "") + LeadingZero(Hours) + ":" + LeadingZero(Minutes) + ":" +         LeadingZero(Seconds);

    /* Este muestra el total de hora, aunque sea superior a 24 horas */
    //var TimeStr = LeadingZero(Hours+(Days*24)) + ":" + LeadingZero(Minutes) + ":" + LeadingZero(Seconds);
    document.getElementById('cronometro').innerHTML ="Tiempo Restante: " + TimeStr;
    if(endTime<=new Date().getTime())
    {
        document.getElementById('cronometro').innerHTML = "Tiempo Restante 00:00:00";
         xajax_actualizarEvaluacionTiempoTerminado();
        
    }else{
        /* Restamos un segundo al tiempo restante */
        tiempRestante-=1;
        /* Ejecutamos nuevamente la función al pasar 1000 milisegundos (1 segundo) */
        setTimeout("updateReloj()",1000);
    }
}

/* Funcion que pone un 0 delante de un valor si es necesario */
function LeadingZero(Time) {
    return (Time < 10) ? "0" + Time : + Time;
}



