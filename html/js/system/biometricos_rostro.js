$(document).ready(function() {
	inicializarControles()
});

var ini = 0, limiteI=0, limiteS=3, numBio=0;
var arr, huellas={};


var verTurno=function(idT,nombre,CURP)
{
    $('html,body').animate({
        scrollTop: $("#verificaC").offset().top
    }, 2000);

mostrarEspera('Proceso de captura de rostro');
$("#widBio").show();
$("#divCapturaR").show();
$("#hdnIdTurno").val(idT);

var infoTurno='<div class="inner-padding"><p><strong>ID Turno: &ensp;</strong><label class="text-muted">'+idT+'</label></p>'+
'<p><strong>Nombre: &ensp;</strong><label class="text-muted">'+nombre+'</label></p>'+
'<p><strong>CURP: &ensp;</strong><label class="text-muted">'+CURP+'</label></p></div>';
infoTurno='';
//$("#datosPersona").html(infoTurno);

$("#divCapturaR").html('<div class="col-sm-6"> '+infoTurno+'<div class="inner-padding"> 	<div class="spacer-50"></div><div class="col-sm-12 align-center" id="divBiomR" style="display: ;"> 					<img alt="" src="images/capturaR_0.png" class="img-responsive" width="300px" /> 				</div> 			</div> 		</div> 		 		<div class="col-sm-6" id="divContenidoR"> '+
		'<div id="divExitosaRostro" class="alert alert-success" style="display: none;"><button type="button" class="close" data-dismiss="alert">×</button> <i class="fa fa-check-circle"></i>Captura exitosa!</div>'+
		'			<div class="spacer-50"></div> 			<div class="spacer-50"></div> '+
		'<div class="col-sm-12 pull-rigth"> 				<div class="pull-right" id="divButtonsRostro"> 					<a type="button" class="btn btn-info" onclick="capturar(\'Rostro\')" >Capturar</a>				</div> 			</div></div> 	</div> </div>');

setTimeout(function(){
	ocultarMensaje();
	},1500);
	

}

var inicializarControles = function() {
	$.ajax({
		method : "post",
		url : "adminFunciones.php",
		data : {
			getKeyHuellas : ''
		},
		success : function(data) {
			arr=JSON.parse(data);
		}
	});
	
	var idtVigente=parseInt($("#hdnIdT").val());
	var nombre=$("#hdnPersona").val();
	var CURP=$("#hdnCURP").val();
  	//alert(idtVigente);
	if(idtVigente>0){
		verTurno(idtVigente, nombre, CURP);
	} else{	}
	
}


function capturar(bio){
	mostrarEspera('Espere un momento...');
	switch(bio){

	case 'Rostro':
		setTimeout(function(){
			var imgD='<img alt="" src="images/rostro.jpg" width="300px" class="img-responsive"/>&nbsp;';
			huellas[13]='/biometricos/huellas/disponibleR.png';

			$("#divBiomR").html(imgD);
			ocultarMensaje();
		},2000);

		$("#divButtonsRostro").html('<a type="button" class="btn btn-info" onclick="capturar(\'Rostro\')" >Capturar</a> <a type="button" class="btn btn-success" onclick="terminar(\''+bio+'\')" >Guardar</a>');
		
		break;

	}
	
}

function terminar(bio){
	mostrarEspera('Espere un momento...');
	$("#tab"+bio).css("background-color","inactivecaption");
	$("#divExitosa"+bio).show();
	xajax_guardarHuellas($("#hdnIdTurno").val(), JSON.stringify(huellas),bio);
}

function next(){
	numBio++;
	 huellas={};
	 if(numBio==3)
		 xajax_siguienteTurno($("#hdnIdTurno").val());
}