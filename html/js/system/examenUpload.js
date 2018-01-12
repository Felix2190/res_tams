var uploadfilename;

var subirImagen=function(myDWObject,id){
	if (myDWObject) {
		if (myDWObject.HowManyImagesInBuffer == 0)
			return;

		var Digital = new Date();
		var d = new Date().toISOString().slice(0,10);
		uploadfilename ="Documento_"+ String(id) + "_" + d +"_" +String(Digital.getMilliseconds()); // Uses milliseconds according to local time as the file name
		
		//upload_preparation(uploadfilename,myDWObject);
		myDWObject.IfShowCancelDialogWhenImageTransfer = false;
		strActionPage = CurrentPath + 'action/php.php';
		myDWObject.IfSSL = Dynamsoft.Lib.detect.ssl;
		
		myDWObject.HTTPPort =  80;
		
		var uploadIndexes = [];
		for (var i = myDWObject.HowManyImagesInBuffer - 1; i > -1 ; i--) {
			uploadIndexes.push(i);
		}
		var uploadJPGsOneByOne = function (errorCode, errorString, sHttpResponse) {
			//if (upload_returnSth)
				//_printUploadedFiles(sHttpResponse);
			if (uploadIndexes.length > 0) {
				var _index = uploadIndexes.pop();
				if (upload_returnSth)
					myDWObject.HTTPUploadThroughPost(strHTTPServer, _index, strActionPage, uploadfilename + "-" + _index.toString() + ".jpg", OnHttpUploadSuccess, uploadJPGsOneByOne);
				else
					myDWObject.HTTPUploadThroughPost(strHTTPServer, _index, strActionPage, uploadfilename + "-" + _index.toString() + ".jpg", uploadJPGsOneByOne, OnHttpServerReturnedSomething);
			}
		}
		var _index = uploadIndexes.pop();
		if (upload_returnSth)
			myDWObject.HTTPUploadThroughPost(strHTTPServer, _index, strActionPage, uploadfilename + "-" + _index.toString() + ".jpg", OnHttpUploadSuccess, uploadJPGsOneByOne);
		else
			myDWObject.HTTPUploadThroughPost(strHTTPServer, _index, strActionPage, uploadfilename + "-" + _index.toString() + ".jpg", uploadJPGsOneByOne, OnHttpServerReturnedSomething);
	}
}

var guardar = function(){
	existeError = false;
	//var idtVigente=parseInt($("#hdnIdT").val());
	// alert(idtVigente);
	//Validamos que tenga las imagenes escaneadas
	var faltante='';
	if (DWObject.HowManyImagesInBuffer == 0){
		faltante+="-Identificaci&oacute;n oficial.</br>";
		
	}
	/**if (DWObject.HowManyImagesInBuffer == 0){
		faltante+="-Comprobante de domiciliol.</br>";
		
	}
	if (DWObject.HowManyImagesInBuffer == 0){
		faltante+="-Acta de nacimiento.</br>";
		
	}
	
	if (faltante.length>0){
		mostrarAviso("Digitalece/Cargue: </br>" +faltante);
		return;
	}***/
	mostrarEspera("Cargando cargando documentos...");
	id=$("#txtIdTurno").val().trim();
	
	  
	var f1;
	subirImagen(DWObject,id);
	f1=uploadfilename;
	
	xajax_guardar(id,f1);
}

var inicializarControles=function(){
	
	$("#btnGuardar").click(guardar);
}

$(document).ready(function(){inicializarControles()});