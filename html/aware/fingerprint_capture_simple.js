
// Variables
var deviceName = "CROSSMATCH_GUARDIAN, IB_WATSONMINI, EXTERNAL";
var imgElement = document.getElementById("previewImage");
var statusElement = document.getElementById("status");
var captureComponent;

// Creates the websocket
function createWebsocket()
{
    var hasError = false;
    statusElement.innerText = "Opening Websocket...";
    websocket = new WebSocket("ws://localhost:2080");
    websocket.onerror = function (event) {
        hasError = true;
        statusElement.innerText = "Error connecting to BioComponentServer. Please verify it is running.";
    };
    websocket.onclose = function (event) {
        if (!hasError)
            statusElement.innerText = "Websocket closed. Refresh page to start over.";
    };
    websocket.onopen = function (event) {
        connectToServer(websocket);
    };
}

// Creates and connects to FingerprintCaptureComponent on the BioComponent server
function connectToServer(websocket) {
    statusElement.innerText = "Connecting to FingerprintCaptureComponent...";
    var transport = createWebsocketTransport(websocket);
    createFingerprintCapture(transport, "FingerprintCapture").then(function (captureComponentValue) {
        captureComponent = captureComponentValue;
        captureComponent.setPreviewImageUpdated(onPreviewImage);
        captureComponent.setCapturedImageUpdated(onCapturedImage);
        captureComponent.setAutocaptureStatusUpdated(onAutocaptureStatus);
        statusElement.innerText = "Opening device...";
        console.log("aqui:");
        captureComponent.openDevice(deviceName).then(
        		function (){},function (error) {
                    console.log("Error in openDevice:  " + error);
                    showMessage("Failed to opened device");
                    
                //    autoConnect = false;
                 //   setState(State.CONNECTED);
                //    showOpenFailure();
              //      reject(error);
                }
            );
        console.log("aqui 2:");
    }).then(function () {
        statusElement.innerText = "Starting preview...";
        var impression = FingerprintCaptureApi.Impression.PLAIN_LEFT_THUMB;
        return captureComponent.startAutoCapture(impression, FingerprintCaptureApi.ImageFormat.JPG)
    }).then(function () {
        statusElement.innerText = "Previewing image...";
    }).catch(function (error_code) {
        statusElement.innerText = "An error occurred: " + error_code;
    });
}

// Handler for receiving the preview image
function onPreviewImage(base64Image) {
    imgElement.src = "data:image/jpg;base64," + base64Image;
    captureComponent.requestNextPreviewImage();
}

// Handler for receiving autocapture status
function onAutocaptureStatus(status) {
    autocaptureStatus.innerText = FingerprintCaptureApi.AutocaptureStatus[status];
}

// Handler for receiving the final captured image
function onCapturedImage(base64Image) {
    statusElement.innerText = "Received final image.";
    imgElement.src = "data:image/jpg;base64," + base64Image;
    var format = FingerprintCaptureApi.ImageFormat.WSQ;
    captureComponent.getCapturedImage(format).then(function (base64WsqImage) {
        statusElement.innerText =  "base64WsqImage size is:" + base64WsqImage.length;
        BinaryFileSaver.saveBase64(base64WsqImage, "capture.wsq");
        return captureComponent.close()
    }).then(function () {
        return captureComponent.destroy()
    }).then(function () {
        websocket.close();
    }).catch(function (error_code) {
        statusElement.innerText = "An error occurred: " + error_code;
    });
}

// Event listener to start the connection
document.addEventListener("DOMContentLoaded", function () {
    createWebsocket();
});

