var deviceName = "CROSSMATCH_GUARDIAN,IB_WATSONMINI,EXTERNAL";
var impressionsToCapture = [
    FingerprintCaptureApi.Impression.PLAIN_RIGHT_INDEX_FINGER,
    //FingerprintCaptureApi.Impression.PLAIN_RIGHT_FOUR_FINGERS,
    //FingerprintCaptureApi.Impression.PLAIN_DUAL_THUMBS
];
var impressionsIndex = 0;
var qualityScores = new Map();
var collectedImages = new Map();
var imgElement = document.getElementById("previewImage");
var statusElement = document.getElementById("status");
var promptElement = document.getElementById("prompt");
var markMissingElement = document.getElementById("markMissing");
var resetElement = document.getElementById("reset");
var previewScoreElement = document.getElementById("previewScore");

var captureComponent;
var setComponent;

function connect() {
    statusElement.innerText = "Creating Websocket...";
    websocket = new WebSocket("ws://localhost:2080");
    websocket.onopen = function (event) {
        var transport = createWebsocketTransport(websocket);
        statusElement.innerText = "Creating captureComponent...";
        createFingerprintCapture(transport, "FingerprintCapture").then(function (captureComponentValue) {
            captureComponent = captureComponentValue;
            statusElement.innerText = "Creating setComponent...";
            return createFingerprintSet(transport, "FingerprintSet")
        }).then(function (setComponentValue) {
            setComponent = setComponentValue;
            registerCallbacks();
            statusElement.innerText = "Loading autocapture config...";
            return loadConfig();
        }).then(function () {
            statusElement.innerText = "Opening Device...";
            return captureComponent.openDevice(deviceName);
        }).then(function () {
            statusElement.innerText = "Starting preview...";
            startPreview();
        }).catch(function (error) {
            console.log(error);
        });
    };
}

// Handler for receiving the preview image
function onPreviewImage(base64Image) {
    imgElement.src = "data:image/jpg;base64," + base64Image;
    captureComponent.requestNextPreviewImage();
}

// Handler for receiving autocapture status
function onAutocaptureStatus(status) {

    // Finger out this message for now
    if (status === FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURECONFIG_HANDEDNESS_NOT_RECOMMENDED) {
        return;
    }

    if (status === FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_CAPTURE_INITIATED) {
        markMissingElement.disabled = true;
    }
    autocaptureStatus.innerText = FingerprintCaptureApi.AutocaptureStatus[status];
}

function appendImage(imageData)
{
    document.body.appendChild(document.createElement("br"));
    var img = document.createElement("img");
    img.src = "data:image/jpg;base64," + imageData;
    document.body.appendChild(img);
}

// Handler for receiving the final captured image
function onCapturedImage(base64Image) {
    markMissingElement.disabled = true;
    statusElement.innerText = "Received final image.";
    imgElement.src = "data:image/jpg;base64," + base64Image;
    var impression = impressionsToCapture[impressionsIndex];
    collectedImages[impression] = base64Image;
    setComponent.setFingerprintCaptureImage(impression, captureComponent).then(function () {

        if(impression === FingerprintCaptureApi.Impression.PLAIN_RIGHT_INDEX_FINGER)
        {
            setComponent.getSegmentedImage(FingerprintSetApi.Impression.PLAIN_RIGHT_INDEX_FINGER,
                FingerprintSetApi.ImageFormat.PNG).then( function(imageData){
                appendImage(imageData);
            });
        }
        if (impression === FingerprintCaptureApi.Impression.PLAIN_LEFT_FOUR_FINGERS)
        {
            setComponent.getSegmentedImage(FingerprintSetApi.Impression.LEFT_SLAP_INDEX_FINGER,
                FingerprintSetApi.ImageFormat.PNG).then( function(imageData){
                appendImage(imageData);
            });
            setComponent.getSegmentedImage(FingerprintSetApi.Impression.LEFT_SLAP_MIDDLE_FINGER,
                FingerprintSetApi.ImageFormat.PNG).then( function(imageData){
                appendImage(imageData);
            });
            setComponent.getSegmentedImage(FingerprintSetApi.Impression.LEFT_SLAP_RING_FINGER,
            FingerprintSetApi.ImageFormat.PNG).then( function(imageData){
                appendImage(imageData);
            });
            setComponent.getSegmentedImage(FingerprintSetApi.Impression.LEFT_SLAP_LITTLE_FINGER,
                FingerprintSetApi.ImageFormat.PNG).then( function(imageData){
                appendImage(imageData);
            });
        }
        else if (impression === FingerprintCaptureApi.Impression.PLAIN_RIGHT_FOUR_FINGERS)
        {
            setComponent.getSegmentedImage(FingerprintSetApi.Impression.RIGHT_SLAP_INDEX_FINGER,
                FingerprintSetApi.ImageFormat.PNG).then( function(imageData){
                appendImage(imageData);
            });
            setComponent.getSegmentedImage(FingerprintSetApi.Impression.RIGHT_SLAP_MIDDLE_FINGER,
                FingerprintSetApi.ImageFormat.PNG).then( function(imageData){
                appendImage(imageData);
            });
            setComponent.getSegmentedImage(FingerprintSetApi.Impression.RIGHT_SLAP_RING_FINGER,
                FingerprintSetApi.ImageFormat.PNG).then( function(imageData){
                appendImage(imageData);
            });
            setComponent.getSegmentedImage(FingerprintSetApi.Impression.RIGHT_SLAP_LITTLE_FINGER,
                FingerprintSetApi.ImageFormat.PNG).then( function(imageData){
                appendImage(imageData);
            });
        }
        else if (impression === FingerprintCaptureApi.Impression.PLAIN_DUAL_THUMBS)
        {
            setComponent.getSegmentedImage(FingerprintSetApi.Impression.PLAIN_DUAL_THUMBS_RIGHT,
                FingerprintSetApi.ImageFormat.PNG).then( function(imageData){
                appendImage(imageData);
            });
            setComponent.getSegmentedImage(FingerprintSetApi.Impression.PLAIN_DUAL_THUMBS_LEFT,
                FingerprintSetApi.ImageFormat.PNG).then( function(imageData){
                appendImage(imageData);
            });
        }

        impressionsIndex++;
        startPreview();
    });
}

function onPreviewQualityScore (impressionString, afiqScore) {
    var impression = parseInt(impressionString, 10);
    qualityScores.set(impression, afiqScore);
    var positions = getPositions();
    var sortedScores = [];
    for (i = 0; i < positions.length; i++) {
        var score = qualityScores.get(positions[i]);
        if (score === undefined)
            score = 0;
        sortedScores.push(score);
    }
    previewScoreElement.innerText = sortedScores.join(" ");
}

/**
 * Returns the finger positions that contained in the current impression
 * @returns {*}
 */
function getPositions(){
    var impression = impressionsToCapture[impressionsIndex];
    if (impression === FingerprintCaptureApi.Impression.PLAIN_RIGHT_FOUR_FINGERS){
       return [
           FingerprintCaptureApi.Finger.RIGHT_INDEX_FINGER,
           FingerprintCaptureApi.Finger.RIGHT_MIDDLE_FINGER,
           FingerprintCaptureApi.Finger.RIGHT_RING_FINGER,
           FingerprintCaptureApi.Finger.RIGHT_LITTLE_FINGER
       ];
    }
    else if (impression === FingerprintCaptureApi.Impression.PLAIN_LEFT_FOUR_FINGERS){
        return [        
            FingerprintCaptureApi.Finger.LEFT_LITTLE_FINGER,
            FingerprintCaptureApi.Finger.LEFT_RING_FINGER,
            FingerprintCaptureApi.Finger.LEFT_MIDDLE_FINGER,
            FingerprintCaptureApi.Finger.LEFT_INDEX_FINGER
        ];
    }
    else if (impression === FingerprintCaptureApi.Impression.PLAIN_DUAL_THUMBS){
        return [
            FingerprintCaptureApi.Finger.LEFT_THUMB,
            FingerprintCaptureApi.Finger.RIGHT_THUMB
        ];
    }
    else {
        return [impression];
    }
}

function registerCallbacks() {
    captureComponent.setPreviewImageUpdated(onPreviewImage);
    captureComponent.setPreviewQualityScoreUpdated(onPreviewQualityScore);
    captureComponent.setAutocaptureStatusUpdated(onAutocaptureStatus);
    captureComponent.setCapturedImageUpdated(onCapturedImage);
}

function startPreview() {
    qualityScores.clear();
    previewScoreElement.innerText ="";
    if (impressionsIndex < impressionsToCapture.length) {
        var impression = impressionsToCapture[impressionsIndex];
        promptElement.innerText = FingerprintCaptureApi.Impression[impression];
        captureComponent.startAutoCapture(impression, FingerprintCaptureApi.ImageFormat.JPG).then(function () {
            statusElement.innerText = "Previewing image...";
            EnableMarkMissing(true);
        }).catch(function (error_code) {
            statusElement.innerText = "An error occurred: " + error_code;
        });
    } else {
        promptElement.innerText = "";
        statusElement.innerText = "Done Capturing.";
    }
}

function onMarkMissing() {
    EnableMarkMissing(false);
    captureComponent.endAutoCapture().then(function () {
        var impression = impressionsToCapture[impressionsIndex];
        setComponent.setFingerMissing(impression, true).then(function () {
            return captureComponent.setFingerMissing(impression, true)
        }).then(function () {
            statusElement.innerText = "Marked as missing.";
            impressionsIndex++;
            startPreview();
        });
    });
}

// Only enable for single fingers
function EnableMarkMissing(enable) {
    var impression = impressionsToCapture[impressionsIndex];
    if (impression > FingerprintCaptureApi.Finger.LEFT_LITTLE_FINGER){
        markMissingElement.disabled = true;
    } else {
        markMissingElement.disabled = !enable;
    }
}

function onReset() {
    statusElement.innerText = "Resetting...";
    EnableMarkMissing(false);
    captureComponent.endAutoCapture().then(function () {
        setComponent.reset().then(function () {
            return captureComponent.resetMissingFingers();
        }).then(function () {
            impressionsIndex = 0;
            startPreview();
        });
    });
}

function loadConfig() {
    return new Promise(function (resolve, reject) {
        var xhr = new XMLHttpRequest();
        xhr.addEventListener("load", function () {
            captureComponent.setAutoCaptureConfiguration(this.responseText)
                .then(function () {
                    resolve()
                });
        });
        xhr.open("GET", "autocapture_configuration.xml");
        xhr.send();
    });
}

// Event listener to start the connection
document.addEventListener("DOMContentLoaded", function () {
    markMissingElement.onclick = onMarkMissing;
    EnableMarkMissing(false);
    resetElement.onclick = onReset;
    connect();
});