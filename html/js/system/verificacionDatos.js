var validacion=sig=false;
var inicializarControles=function()
{ 
	$("#slcBiometrico").change(function(){
		$('#divImagenBio').html('<img alt="" src="images/dedos/'+$("#slcBiometrico").val()+'.png"  class="img-responsive"/>');
	});
	
	
};
$(document).ready(function(){inicializarControles()});

function capturar(){
	mostrarEspera('Espere un momento...');
	setTimeout(function(){
		createWebsocket();
	},1500);
	
/*	setTimeout(function(){
		ocultarMensaje();
		$('#divImagenBio').html('<img  alt="" src="images/disponibleH.png" class="img-responsive"/>');
		validacion=true;
		sig=false;
	},1500);
*/
}

function validar(){
	if(validacion){
	mostrarEspera('Verificando...');
	setTimeout(function(){
	//	ocultarMensaje();
		mostrarEspera('Validaci&oacute;n exitosa!...');
		
		setTimeout(function(){
			ocultarMensaje();

			validacion=false;
			sig=true;
			
		},1500);
		
		
	},2500);
	}else{
		mostrarError('No se ha capturado la huella');
	}
}

function siguiente(){
	if(sig){
		
	}else{
		mostrarError('No se ha validado la informaci&oacute;n');
	}
}



//------------------------- AWARE COMPONENTES-----------------

var deviceName = "CROSSMATCH_GUARDIAN, IB_WATSONMINI, EXTERNAL";
var imgElement = document.getElementById("previewImage");
var statusElement = document.getElementById("status");
var captureComponent;

//Creates the websocket
function createWebsocket()
{
  var hasError = false;
//  statusElement.innerText = "Opening Websocket...";
  //alert('juu');
  websocket = new WebSocket("ws://localhost:2080");
  websocket.onerror = function (event) {
      hasError = true;
    mostrarError( "Error al conectarse con el servidor BioComponentServer, por favor verifique si est&aacute; en ejecuci&oacute;n.");
    return ;
  };
  websocket.onclose = function (event) {
      if (!hasError)
      	  mostrarError("Websocket closed. Refresh page to start over.");
  };
  websocket.onopen = function (event) {
      connectToServer(websocket);
  };
}

//Creates and connects to FingerprintCaptureComponent on the BioComponent server
function connectToServer(websocket) {
//  statusElement.innerText = "Connecting to FingerprintCaptureComponent...";
  var transport = createWebsocketTransport(websocket);
  createFingerprintCapture(transport, "FingerprintCapture").then(function (captureComponentValue) {
      captureComponent = captureComponentValue;
  //    captureComponent.setPreviewImageUpdated(onPreviewImage);
//      captureComponent.setCapturedImageUpdated(onCapturedImage);
//       captureComponent.setAutocaptureStatusUpdated(onAutocaptureStatus);
//       statusElement.innerText = "Opening device...";
      console.log("aqui:");
      window.location="demo/FingerprintCaptureComplete/demo2.php";
      captureComponent.openDevice(deviceName).then(
      		function (){},function (error) {
      			  mostrarError("Error en el dispositivo biom&eacute;trico:  " + error);
//                  showMessage("Failed to opened device");
              //    autoConnect = false;
               //   setState(State.CONNECTED);
              //    showOpenFailure();
            //      reject(error);
              }
          );
//      console.log("aqui 2:");
  }).then(function () {
  //    statusElement.innerText = "Starting preview...";
      var impression = FingerprintCaptureApi.Impression.PLAIN_LEFT_THUMB;
     
      return captureComponent.startAutoCapture(impression, FingerprintCaptureApi.ImageFormat.JPG)
  }).then(function () {
//      statusElement.innerText = "Previewing image...";
  }).catch(function (error_code) {
  	mostrarError( "Error en el dispositivo biom&eacute;trico: " + error_code);
	setTimeout(function(){
		ocultarMensaje();

		validacion=false;
		sig=true;
		
	},1500);
	
  });
}

