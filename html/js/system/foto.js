var actionPage = 'action/ActionPage.php';

var dcsObject, imageViewer;

function onInitSuccess(videoViewerId, imageViewerId) {
    dcsObject = dynamsoft.dcsEnv.getObject(videoViewerId);
    imageViewer = dcsObject.getImageViewer(imageViewerId);    

    var cameraList = dcsObject.camera.getCameraList();
    if (cameraList.length > 0) {
        dcsObject.camera.takeCameraOwnership(cameraList[0]);
        dcsObject.camera.playVideo();
    } else {
        alert('No camera is connected.');
    }
	
	showLoadingLayer(false);
}

function onInitFailure(errorCode, errorString) {
    alert('Init failed: ' + errorString);
	
	showLoadingLayer(false);
}

function onUploadSuccess() {
    var fileName,
        responseData = dynamsoft.lib.parse(imageViewer.io.getHTTPResponse());
		
    document.getElementById('btn-upload').innerHTML = 'Guardar';
	
    if (responseData && responseData.success && responseData.fileName) {
        fileName = responseData.fileName;

        mostrarEspera('Enviando informaci&oacute;n'+fileName);
        
        xajax_guardar(13,fileName)
    }else if(responseData && responseData.error){
		alert(responseData.error);
	}
}

function onUploadFailure(errorCode, errorString) {
    document.getElementById('btn-upload').innerHTML = 'Upload';
    alert('Upload failed: ' + errorString);
}

var btnGuardarclick=function() {
    if (!dcsObject || !imageViewer) return;

    if (imageViewer.image.getCount() === 0) {
        alert('Please grab an image first.');
        return;
    }

    var counter,
        url = getCurPagePath() + actionPage,
        fileName = getFileName(),
        imageType = getCurEnumImageType(),
        //bMultiImages = isImgTypeChksChecked(),
        imageIndexArray = [];

    /**if (bMultiImages) {
        for (counter = 0; counter < imageViewer.image.getCount() ; counter++) imageIndexArray.push(counter);
    } else ***/
	imageIndexArray.push(imageViewer.image.getIndex());

    imageViewer.io.setHTTPFormFields({ "fileName": fileName });
    imageViewer.io.httpUploadAsync(url, imageIndexArray, imageType, onUploadSuccess, onUploadFailure);    
    
    document.getElementById('btn-upload').innerHTML = 'Cargando...';
}

var onBtnGrabClick=function() {
	
    if (!dcsObject) return;
	
	
	var arr = [];
	


	if(imageViewer.image.getCount()>0)
		{
			for (var i = 0; i < imageViewer.image.getCount(); i ++) {  //Select all the images in the image viewer
				arr.push(i);
			}
			imageViewer.image.remove(arr); //Remove all images in the image viewer
		}
		
		
	dcsObject.camera.captureImage('image-container');

    if (dcsObject.getErrorCode() !== EnumDCS_ErrorCode.OK) {
        alert('Capture error: ' + dcsObject.getErrorString());
    }
}
var limpiar=function(){
	  if (!dcsObject) return;
		
		
		var arr = [];
		


		if(imageViewer.image.getCount()>0)
			{
				for (var i = 0; i < imageViewer.image.getCount(); i ++) {  //Select all the images in the image viewer
					arr.push(i);
				}
				imageViewer.image.remove(arr); //Remove all images in the image viewer
			}
}

window.onload = function() {
    //setCheckboxEnable();
	
	//show loading layer
	showLoadingLayer(true);
	
    dynamsoft.dcsEnv.init('video-container', 'image-container', onInitSuccess, onInitFailure);
    $("#btnFoto").click(onBtnGrabClick);
    $("#btnLimpiar").click(limpiar);
    $("#btn-upload").click(btnGuardarclick);
};

window.onbeforeunload = function() {
    if (dcsObject) dcsObject.destroy();
};

//triggered when dcs service is not found
dynamsoft.dcsEnv.ondcsnotfound = function() {
    showLoadingLayer(false);
	return false;
};

//*********ui & utilities*********
function setCheckboxEnable(radioValue) {
    var imgTypeChks = document.getElementsByName('multi');
    for (var i = 0; i < imgTypeChks.length; i++) {
        imgTypeChks[i].checked = false;
        imgTypeChks[i].disabled = radioValue !== imgTypeChks[i].value;
    }
}

function isImgTypeChksChecked() {
    var imgTypeChks = document.getElementsByName('multi');

    for (var i = 0; i < imgTypeChks.length; i++) {
        if (imgTypeChks[i].checked) return true;
    }

    return false;
}

function getSelectedImgType() {
    var imgTypeRadios = document.getElementsByName('img-format');

    for (var i = 0; i < imgTypeRadios.length; i ++) {
        if (imgTypeRadios[i].checked) return imgTypeRadios[i].value;
    }
}

function getCurEnumImageType() {
    var enumImageType = imageViewer.io.EnumImageType,
        checkedRadioValue = getSelectedImgType();

    switch (checkedRadioValue) {
        case 'BMP':
            return enumImageType.BMP;
        case 'JPEG':
            return enumImageType.JPEG;
        case 'TIFF':
            return enumImageType.TIFF;
        case 'PNG':
            return enumImageType.PNG;
        case 'PDF':
            return enumImageType.PDF;
        default:
            return enumImageType.PNG;
    }
}

function getFileName() {
	var Digital = new Date();
    var uploadfilename = Digital.getMilliseconds();
	
    var fileName = uploadfilename+'_foto_'; //document.getElementById('txtFileName').value.replace(/^\s+|\s+$/g, ''); // trim

    if (fileName === '') return '';

    //var checkedRadioValue = getSelectedImgType();
	return fileName += '.jpg';
}

function getCurPagePath(){
	var strHttpServer = location.protocol + '//' +
			location.hostname + 
			(location.port === '' ? '' : ':' + location.port),
		curPathName = unescape(location.pathname),
		curPath = curPathName.substring(0, curPathName.lastIndexOf("/") + 1);
	
	return strHttpServer + curPath;
}

//show or hide loading layer
function showLoadingLayer(bShow){
	var loaderContent = document.getElementById('loaderContent'),
		elLoadingLayer = document.getElementById('loadingLayer');

	loaderContent.style.display = bShow ? 'block' : 'none';
	elLoadingLayer.style.display = bShow ? 'block' : 'none';
}