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

mostrarEspera('Proceso de captura de iris...');
$("#widBio").show();
$("#divCapturaI").show();
$("#hdnIdTurno").val(idT);

var infoTurno='<div class="inner-padding"><p><strong>ID Turno: &ensp;</strong><label class="text-muted">'+idT+'</label></p>'+
'<p><strong>Nombre: &ensp;</strong><label class="text-muted">'+nombre+'</label></p>'+
'<p><strong>CURP: &ensp;</strong><label class="text-muted">'+CURP+'</label></p></div>';
	infoTurno='';
//$("#datosPersona").html(infoTurno);


$("#divCapturaI").html('<div class="col-sm-6" class="img-responsive"> '+infoTurno+'		<div class="spacer-50"></div><div class="col-sm-12 text-center img-responsive"" id="divBiomI" style="display: ;" > 	'+
		'<img alt="" src="images/capturaI_0.png" class="img-responsive"  height="300px"/> '+
		'<div id="i_OD" style="display: none; position:absolute; top:14%; left:15%; width: 100px;"> <img border="0"  src="images/nodisponible.png"  class="img-responsive"/> </div>'+
		'<div id="i_OI" style="display: none; position:absolute; top:14%; left:65%; width: 100px; height: 60px;"> <img border="0"  src="images/nodisponible.png"  class="img-responsive"/> </div>'+
		'</div> '+
		'	<div class="col-sm-12 img-responsive" id="divIm"></div>		</div> 	</div> 				<div class="col-sm-6" id="divContenidoI"> 			<div class="spacer-50"></div> 			<div class="spacer-50"></div>'+
	'<div class="col-sm-12 pull-rigth"> 				<div class="pull-right" id="divButtonsOjo"> 			<!--		<a type="button" class="btn btn-success" onclick="siguiente(\'i\');" id="btnIniciar">Iniciar</a> -->				</div> 			</div></div> 	</div> </div></div>');

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
			siguiente('i');
		}
	});
	
	var idtVigente=parseInt($("#hdnIdT").val());
	var nombre=$("#hdnPersona").val();
	var CURP=$("#hdnCURP").val();
  	//alert(idtVigente);
	if(idtVigente>0){
		verTurno(idtVigente, nombre, CURP);
	} else{
	
	}
	
}

function siguiente(bio) {
	var texto='';
	$("#divIm").html(''); // div iris capturadas
	switch(bio){
	case 'i':
		texto+='<tr class="columnatdI"><td>OD</td><td colspan="2">Iris derecho</td><input type="hidden" id="hdn11" value="OD"/>'+
		'<td><select id="slcOpcOD" onchange="comboDedo(\'OD\');" class="form-control"><option value="disponibleO">Disponible</option><option value="nodisponible">No disponible</option></select></td></tr>';
		texto+='<tr class="columnatdI"><td>OI</td><td colspan="2">Iris izquierdo</td><input type="hidden" id="hdn12" value="OI"/>'+
		'<td><select id="slcOpcOI" onchange="comboDedo(\'OI\');" class="form-control"><option value="disponibleO">Disponible</option><option value="nodisponible">No disponible</option></select></td></tr>';
		
	$("#divContenidoI").html(creaTabla(texto,'Ojo'));

	setTimeout(function(){
		ocultarMensaje();
		},1500);

		break;
	}
}

function creaTabla(contenido,bio){
	return '<div id="divExitosa'+bio+'" class="alert alert-success" style="display: none;"><button type="button" class="close" data-dismiss="alert">×</button> <i class="fa fa-check-circle"></i>Captura exitosa!</div>'+
	'<div class="spacer-30"></div><div class="inner-padding" id="divTabla">'+
	'<table class="table table-bordered table-condensed"><thead>'+
	'<tr id="columnath'+bio+'"><th scope="col">ID</th><th scope="col" colspan="2">'+bio+'</th><th scope="col">Opci&oacute;n</th></tr>'+
	'</thead><tbody>'+contenido+'</tbody></table>'+
	'</div><div class="spacer-50"></div><div class="spacer-20"></div><div class="col-sm-12 pull-rigth"><div class="pull-right" id="divButtons'+bio+'">'+
	'<a type="button" class="btn btn-warning" id="btnCancelar" href="biometricos_iris.php">Cancelar</a><a type="button" class="btn btn-info" onclick="capturar(\''+bio+'\')" >Capturar</a></div></div>';
}

function capturar(bio){
	mostrarEspera('Espere un momento...');
	switch(bio){
	case 'Ojo':
	
	setTimeout(function(){
		var imgD='<div style="position:relative; height: 400x;" class="img-responsive">'+
			'<div style="position:absolute; left:10%; width: 120px; " > <img alt="" src="images/'+$("#slcOpcOD").val()+'.png" height="100" /> </div>'+
			'<div style="position:absolute; left:50%; width: 120px; " > <img alt="" src="images/'+$("#slcOpcOI").val()+'.png" height="100"  /> </div>  </div>';
		if($("#slcOpcOD").val()=='disponibleI')
			huellas[11]='/biometricos/huellas/'+$("#slcOpcOD").val()+'OD.png';
		if($("#slcOpcOI").val()=='disponibleI')
				huellas[12]='/biometricos/huellas/'+$("#slcOpcOI").val()+'OI.png';
		$("#divIm").html(imgD+'<br /></div><div id="finDiv" class="spacer-50"></div><div class="spacer-50"></div>');
		ocultarMensaje();
	},2000);
	
	var t=$('.extratdI').length;
	if(t==0){
	$("#columnathOjo").append('<th>Captura</th>');
	
	$(".columnatdI").append('<td class="extratdI"><div class="btn btn-default btn-circle btn-success"><i class="fa fa-check "></i><input type="hidden" name="bol_user" value="true" /></div></td>');

	$("#divButtonsOjo").append('<a type="button" class="btn btn-success" onclick="terminar(\''+bio+'\')" >Guardar</a>');
	}
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

function comboDedo(opc){

	$("#i_"+opc).hide();
	$("#divIm").html(''); // div iris capturadas
	
	switch($("#slcOpc"+opc).val()){
	case 'nodisponible': $("#i_"+opc).show(); break;
	}
	
//	alert(opc+' '+$("#slcOpc"+opc).val());
};