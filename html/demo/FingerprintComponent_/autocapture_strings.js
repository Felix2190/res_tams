/* Copyright (C) 2017 Aware, Inc - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

AutoCaptureStrings = (function(){
    var autoCaptureStrings = {};
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_INITIALIZATION_STARTED] ='Device Initialization Started';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_INITIALIZATION_WARNING_OCCURRED] ='Warning During Device Initialization';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_INITIALIZATION_FAILED] ='Device Initialization Failed';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_INITIALIZATION_COMPLETED] ='Device Initialization Complete';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_CLOSE_STARTED] ='Device Close Started';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_CLOSE_WARNING_OCCURRED] ='Warning During Device Close';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_CLOSE_FAILED] ='Device Close Failed';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_CLOSE_COMPLETED] ='Device Closed';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_CALIBRATION_NOT_SUPPORTED] ='Calibration Not Supported';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_CALIBRATION_STARTED] ='Calibrating Device';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_CALIBRATION_FAILED] ='Error Calibrating Device';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_CALIBRATION_COMPLETED] ='Calibration Complete';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_CALIBRATION_MESSAGE] ='Device Calibration Message';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_RESET_STARTED] ='Resetting Device';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_RESET_WARNING_OCCURRED] ='Warning During Device Reset';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_RESET_FAILED] ='Device Reset Failed';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_RESET_COMPLETED] ='Device Successfully Reset';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_DIRTY] ='Scanner Is Dirty Or Fingers On Scanner';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SCANNER_DISCONNECTED] ='Scanner is disconnected or not responding';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.CAPTURE_PREVIEW_STARTED] ='Preview Started';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.CAPTURE_ABORTED] ='Capture Aborted';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.CAPTURE_COMPLETED] ='Capture Complete';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURECONFIG_HANDEDNESS_NOT_RECOMMENDED] ='Use of handedness detection is not recommended when fingers are missing';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_STARTED] ='Auto-capture Session Started';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_CAPTURE_INITIATED] ='Auto-capture Initiated';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_TOO_FEW_FINGERS] ='Too Few Fingers';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_TOO_MANY_FINGERS] ='Too Many Fingers';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_NO_FINGERS] ='No Fingers';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_INCORRECT_HAND] ='Incorrect Hand';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_INSUFFICIENT_FINGER_QUALITY] ='Insufficient Finger Quality';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_FINGER_ANGLE_TOO_LARGE] ='Finger Angle is Too Large';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_FINGER_TOUCHING_EDGE] ='Finger Touching Image Edge';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_FINGER_TOO_TALL] ='Finger Too Tall';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_FINGER_TOO_SHORT] ='Finger Too Short';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_FINGER_TOO_WIDE] ='Finger Too Wide';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_FINGER_TOO_NARROW] ='Finger Too Narrow';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_FINGER_MOVEMENT_DETECTED] ='Finger Movement Detected';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_PASSING_FRAME_COLLECTED] ='Passing Frames Collected';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_TIMEOUT_EXCEEDED_CAPTURING] ='Timeout Exceeded, Capturing';
    autoCaptureStrings[FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_TIMEOUT_EXCEEDED_ABORTED] ='Timeout Exceeded, Aborting';
    return autoCaptureStrings;
})();