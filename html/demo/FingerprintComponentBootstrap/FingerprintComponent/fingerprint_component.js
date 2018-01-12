/* Copyright (C) 2017 Aware, Inc - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

// Polyfill for window.Promise
if (!window.Promise) {
    var req = new XMLHttpRequest();
    req.open('GET', 'Common/lib/es6-promise/es6-promise.js', false);
    req.send();
    eval(req.responseText);
}

/**
 * Common capture sets
 * @enum {number[]}
 * @memberof! FingerprintComponent
 */
var CollectionSet = {
    FOURTEEN_SLAP_SET: [14, 12, 11, 13, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    THIRTEEN_SLAP_SET: [14, 13, 31, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    TEN_FLAT_SET: [11, 80, 81, 82, 83, 12, 84, 85, 86, 87],
    FOUR_SLAP_SET: [14, 12, 11, 13],
    THREE_SLAP_SET: [14, 13, 31]
};

/**
 * Main FingerprintComponent module
 * @namespace
 */
var FingerprintComponent = (function () {
    'use strict';

    /**
     * The different state an Impression capture can be in
     * @enum {string}
     * @memberof! FingerprintComponent
     */
    var CaptureStatus = {
        NOT_CAPTURED: "NOT_CAPTURED",
        CAPTURED: "CAPTURED",
        UNABLE_TO_PRINT: "UNABLE_TO_PRINT",
        AMPUTATED: "AMPUTATED",
        SKIPPED: "SKIPPED"
    };


    /**
     * States that the UI can be in
     * @enum {string}
     * @memberof! FingerprintComponent
     */
    var State = {
        NOT_CONNECTED: "NOT_CONNECTED",
        CONNECTING: "CONNECTING",
        CONNECTED: "CONNECTED",
        INITIALIZING_DEVICE: "INITIALIZING_DEVICE",
        IDLE: "IDLE",
        START_SCANNING: "START_SCANNING",
        SCANNING: "SCANNING",
        START_MANUAL_CAPTURE: "START_MANUAL_CAPTURE",
        CALIBRATING: "CALIBRATING",
        CALIBRATE_REQUIRED: "CALIBRATE_REQUIRED",
        CANCELING_SCANNING: "CANCELING_SCANNING",
        MANUAL_CAPTURE: "MANUAL_CAPTURE",
        CAPTURING: "CAPTURING"
    };


    /**
     * Quality Score
     * @enum {string}
     * @memberof! FingerprintComponent
     */
    var QualityBracket = {
        GOOD: "GOOD",
        MARGINAL: "MARGINAL",
        POOR: "POOR"
    };


    /** Configuration object
     * @memberof! FingerprintComponent
     * @property {string} url - URL of the biocomponent server .
     * @property {string[]} deviceList - Array of Livescan API device identifier strings listing in order of preference.
     * @property {string} collectionSet - Name of the set of image to capture (e.g. FOURTEEN_SLAP_SET|THIRTEEN_SLAP_SET|TEN_FLAT_SET|FOUR_SLAP_SET|THREE_SLAP_SET)
     * @property {string} sequencingMethod - Which sequencing method to use ANTI_SEQUENCING|FULL_SEQUENCING|SMART_SEQUENCING
     *
     * TODO finish documenting
     */
    var defaultConfig = {
        // Common Options
        url: "ws://localhost:2080",
        deviceList: ['CROSSMATCH_GUARDIAN', "IB_WATSONMINI"],
        collectionSet: CollectionSet.FOURTEEN_SLAP_SET,

        sequencingMethod: FingerprintSetApi.SequencingMethod.FULL_SEQUENCING,
        autocaptureConfigurationFile: "FingerprintComponent/config/multi_finger_autocapture_configuration.xml",
        imageDirectory: "FingerprintComponent/images",

        enableAudio: true,
        sequencingCutoff: 50000,
        antiSequencingCutoff: 50000,

        afiqGoodCutoff: 61,
        afiqMarginalCutoff: 35,
        afiqFingersGoodCutoff: {},
        afiqFingersMarginalCutoff: {},

        nfiqGoodCutoff: 2,
        nfiqMarginalCutoff: 3, // 1 is excellent
        nfiqFingersGoodCutoff: {},
        nfiqFingersMarginalCutoff: {},

        qualityCutoffAlgorithm: "NFIQ", // Value can be NFIQ|AFIQ

        minimumMinutiaRequired: 1,
        numberOfRetries: 3,
        noSaveUponRetry: false,
        requiredNumberOfFingers: 0,
        widthCheckPercent: 15,

        // If true, does not enable the save and continue button until a complete of prints are collected
        allowIncompleteCollection: false,

        // Called when the complete set of fingers are collected
        completedCallback: function () {
        },

        // Called when the user clicks the exit buttons
        cancelCallback: function () {
        },

        // Called when previewing starts
        scanStartCallback: function () {
        },

        // Called when previewing ends
        scanCompleteCallback: function () {
        },

        // Less Common Options

        // If defined, the transport of the BioComponents server used for the
        // FingerprintCapture component. This option is typically used for testing.
        captureTransport: null,

        // If defined, the transport of the BioComponents server used for the
        // FingerprintSet component. This option is typically used for testing.
        setTransport: null,

        // Hides the button that navigates to the Card Scan page. Used when you don't support card scan or have an
        // alternative way of navigating to the card scan page.
        hideCardScanButton: true,

        // Require a blank image before autocapture for consecutive captures. This option is used prevent a
        // scanner from capturing a finger impression a second time because the user did not remove their finger from the scanner quick enough.
        requireBlankImageBeforeCapture: true,

        // Show debugging info on UI
        debug: false
    };

    var config = null;

    /**
     * If set to true, when the module is initialized, it will try to connect and start autocapture.
     * @type {boolean}
     */
    var autoConnect = true;

    /**
     * Set to if we are in the process of collecting fingerprints. Used to signal scanningStarted callback
     * @type {boolean}
     */
    var scanningStarted = false;


    /** Holds an object of type ImpressionEntry that we are capturing */
    var nowCapturing = null;

    // Holds the captured prints
    // TODO is this needed?
    var captureSet = {};

    // Holds the finger positions that are missing
    var missingSet = new Map();

    // The list of ImpressionEntry for the impressions that are/will be collected
    var captureListing = [];

    // Current state of UI
    var state = State.NOT_CONNECTED;

    // Controller for  FingerprintSet service
    var setController = new SetController();

    // Object used to send message to server
    var transport;

    // Reference to the FingerprintCapture service
    var captureService;

    // Flag to indicate the text on the UI needs to be updated
    // This is used so we can update the screen when we start receiving new preview images
    var needScreenInfoUpdate = true;

    /** Call this function assigned to this variable when state changes */
    var stateChangeListener = null;

    /** True if the device should be opened when the BioComponentServer has been been successfully connected to */
    var openDeviceOnConnect = true;

    /** Number of times a scan has been retried */
    var retryCount = 0;

    // When capturing rolls, the guide is shown until the first preview image is received. This flag tells the
    // code that displays the preview that it must hide the guide
    var needToHideCaptureGuide = false;

    // Holds the result of the onDeviceStateUpdated callback
    var deviceState;

    // Keeps track of whether we have seen the blank image before a capture is done
    var noFingersMessageSeen = false;

    // Stores the captured device info
    var deviceInfo = undefined;

    /** If data is retrieved from existing enrollment or transaction */
    var isRetrieved = false;

    // When set to true, capture is taking place right after a previous caputre. Used for
    // double capture detection.
    var consecutiveCapture = false;

    // Only want to to tool tip indicator once at start of capture
    var showDigitIndicatorToolTip = true;


    /*
     *
     *  Module init / reset
     *
     */


    /**
     * Initializes the Fingerprint Capture Module
     *
     * @memberof! FingerprintComponent
     */
    var init = function (userConfig) {
        // Create the config for this instance
        config = {};
        $.extend(config, defaultConfig, userConfig);
        if (config.captureTransport === null)
            config.captureTransport = config.transport;
        if (config.setTransport === null)
            config.setTransport = config.transport;

        addFingerButtons();
        setState(State.NOT_CONNECTED);
        initializeCaptureListing();
        clearPreviewImage();

        if (config.allowIncompleteCollection) {
            $(".fingerprint__save-and-continue").prop("disabled", false);
        } else {
            $(".fingerprint__save-and-continue").prop("disabled", true);
        }

        // Sets up the panel that house buttons used for debugging
        ButtonStatePanel.init(FingerprintComponent);

        $('.fingerprint-alert__connection-failure-reconnect').on('click', function () {
            $('.fingerprint-alert__connection-failure').hide();
            autoConnect = true;
            connectToService();
        });

        $('.fingerprint-alert__calibration-required-calibrate').on('click', function () {
            calibrate();
        });

        $('.fingerprint-alert__open-failure-reopen').on('click', function () {
            $('.fingerprint-alert__open-failure').hide();
            autoConnect = true;
            showAlertConnecting();

            // Define function for the returned promise so errors
            // don't show up in console.
            openDevice().then(function () {
            }, function () {
            });
        });

        $('.fingerprint-alert__preview-failure-restart').on('click', function () {
            $('.fingerprint-alert__preview-failure').hide();
            var cleanupFunctions = [];
            if (deviceState === FingerprintCaptureApi.DeviceState.SCANNING ||
                deviceState === FingerprintCaptureApi.DeviceState.CAPTURING) {
                cleanupFunctions.push(endAutoCapture);
            }
            Promise.all(cleanupFunctions).then(function () {
                autoConnect = true;
                startAutoCapture();
            });
        });

        $('.fingerprint__save-and-continue').on('click', function () {
            config.completedCallback();
        });

        $(".fingerprint-scan__exit-enrollment").on('click', function () {
            if (scanningStarted) {
                config.scanCompleteCallback();
                scanningStarted = false;
            }
            config.cancelCallback();
        });

        $('.fingerprint-alert__rescan-accept').on('click', function () {
            $('.fingerprint-alert__rescan').hide();
            if (config.noSaveUponRetry) {
                setFingerButtonMissing(nowCapturing.impression);
            }
            else {
                finishCapture();
            }
        });

        $('.fingerprint-alert__rescan-rescan').on('click', function () {
            $('.fingerprint-alert__rescan').hide();
            retryCount++;
            captureImpression(nowCapturing.impression)
        });

        $('.fingerprint__manual-capture').on('click', function () {
            captureManually();
        });

        $('.fingerprint__calibrate').on('click', function () {
            calibrate();
        });

        $('.fingerprint__digit-indicator-tooltip-close').on('click', function () {
            $(".fingerprint__digit-indicator-tooltip").hide();
        });

        $('.fingerprint__digit-indicator-tooltip-disable-link').on('click', function () {
            document.cookie = "disableDigitTooltip=true;";
            $(".fingerprint__digit-indicator-tooltip").hide();
        });

        if (config.debug) {
            $(".debug-area").show();
        }
        else {
            $(".debug-area").hide()
        }

        if (config.hideCardScanButton) {
            $(".fingerprint__use-card-scanner").css('visibility', 'hidden');
        }

        // TODO report error if no transport
        transport = config.transport;
        if (!transport) {
            return Promise.resolve();
        }
		console.log('...................');
        autoConnect = false;
        showAlertConnecting();
        return connect();
    };

    /**
     * Clears out components and resets to initial state
     *
     * @memberof! FingerprintComponent
     */
    var reset = function (newConfigSettings) {
        nowCapturing = null;
        captureSet = {};
        missingSet = new Map();
        captureListing = [];

        setController.reset();
        needScreenInfoUpdate = true;
        openDeviceOnConnect = true;
        retryCount = 0;
        needToHideCaptureGuide = false;
        noFingersMessageSeen = false;
        isRetrieved = false;
        scanningStarted = false;

        console.log("Resetting FingerComponent. State:" + state);

        if(typeof newConfigSettings == 'object')
            $.extend(config, newConfigSettings);

        clearPreviewImage();
        initializeCaptureListing();
        CaptureTable.reset();
        updateProgressBar();
        fingerButtonReset();

        $(".capture-completed").hide();
        $(".fingerprint-scan").show();
        $(".fingerprint-scan__capturing-text").text("None");
        $(".fingerprint-scan__capturing-guidelines").html("");

        if (config.allowIncompleteCollection) {
            $(".fingerprint__save-and-continue").prop("disabled", false);
        } else {
            $(".fingerprint__save-and-continue").prop("disabled", true);
        }
        $('.fingerprint-alert').hide();
        if (state === State.SCANNING) {
            endAutoCapture().then(function () {
                resetMissing();
            })
        } else {
            resetMissing();
        }
    };

    /**
     * Disables UI element. Used when waiting for a process to finsih
     */
    var  disableUi= function(disable){
        if (disable){
            $(".fingerprint__use-card-scanner").prop("disabled", true);
            $(".fingerprint__save-and-continue").prop("disabled", true);
            fingerButtonReset();
        } else {
            if (config.allowIncompleteCollection) {
                $(".fingerprint__save-and-continue").prop("disabled", false);
            }
            $(".fingerprint__use-card-scanner").prop("disabled", false);
        }
    };

    /**
     * Reset the missing status of all the finger positions in the FingerprintCapture component. If this isn't
     * done, fingers mark as missing with preview, but never autocapture.
     * @returns {Promise}
     */
    var resetMissing = function () {
        var promises = [];
        for (var i = 1; i <= 10; i++) {
            promises.push(captureService.setFingerMissing(i, false));
        }
        return Promise.all(promises);
    };


    /*
     *
     *  Public API
     *
     */

    /**
     * Attempts to connect to service while updating the UI
     *
     * @memberof! FingerprintComponent
     */
    var connectToService = function () {
        showAlertConnecting();
        connect();
    };

    /*
     * Opens the fingerprint capture device on the server
     *
     * @memberof! FingerprintComponent
     */
    var openDevice = function () {
        return new Promise(function (resolve, reject) {
            setState(State.INITIALIZING_DEVICE);
            var deviceList = config.deviceList.join();
            console.log("Opening device from list:" + deviceList);
            captureService.openDevice(deviceList).then(
                function () {
                    showMessage("Successfully opened device");
                    showConnectionSuccess();
                    // Print out info
                    getDeviceInfo().then(function (info) {
                        console.log("Scanner make/model/serial number:" + JSON.stringify(info));
                    });
                },
                function (error) {
                    console.log("Error in openDevice 2:" + error);
                    showMessage("Failed to opened device");
                    autoConnect = false;
                    setState(State.CONNECTED);
                    showOpenFailure();
                    reject(error);
                }
            ).then(function () {
                return captureService.deviceEnableAudio(config.enableAudio);
            }).then(function () {
                return captureService.deviceGetProperty(FingerprintCaptureApi.DeviceProperty.ROLL_STATUS_SUPPORTED);
            }).then(function (isRollStatusSupported) {
                if (isRollStatusSupported === 0) {
                    return true;
                } else {
                    return captureService.deviceSetProperty(FingerprintCaptureApi.DeviceProperty.ROLL_STATUS_ENABLE, 1);
                }
            }, function(error){
                return false;
            }).then(function () {
                return captureService.deviceGetProperty(FingerprintCaptureApi.DeviceProperty.CALIBRATE_SUPPORTED);
            }).then(function (isCalibrationSupported) {
                if (isCalibrationSupported === 0) {
                    $(".fingerprint__calibrate").hide();
                    return true;
                } else {
                    $(".fingerprint__calibrate").show();
                    return captureService.deviceIsCalibrated();
                }
            }).then(function (isCalibrated) {
                if (isCalibrated === 0) {
                    $(".fingerprint-alert__calibration-required").show();
                    $(".fingerprint-alert__connection-success").hide();
                    setState(State.CALIBRATE_REQUIRED);
                    resolve();
                } else {
                    setState(State.IDLE);
                    resolve();
                }
            });
        });
    };

    /**
     *  Starts autocapturing of the next impression. If no more impressions are to be collected, updates the
     *  UI to show collection has been completed
     *
     *  @param isConsecutive Set to true if this scan takes place immediately after a capture. Use to detect
     *  double captures. If omitted, default value is false.
     *
     *  @memberof! FingerprintComponent
     */
    var startAutoCapture = function (isConsecutive) {
        consecutiveCapture = (typeof isConsecutive !== 'undefined') ?  isConsecutive : false;
        var nextImpression = nextCaptureImpression();
        if (nextImpression === null)
            showFinished();
        else
            captureImpression(nextImpression);
    };

    /**
     * Starts autocapturing of the specified impression
     * @param impression Impression to autocapture
     *
     * @memberof! FingerprintComponent
     */
    var captureImpression = function (impression) {

        if (state === State.START_SCANNING)
            return;

        // Verify the specified impression in in the captureListing
        var impressionEntry = Util.find(captureListing, function (x) {
            return x.impression === impression
        });
        if (impressionEntry === undefined) {
            console.log("Invalid impression. Impression:" + impression + "is not in captureListing ");
            return;
        }
        nowCapturing = impressionEntry;

        $(".capture-completed").hide();
        $(".fingerprint-scan").show();
        noFingersMessageSeen = false;
        if (config.requireBlankImageBeforeCapture && consecutiveCapture) {
            captureService.disableAutoCapture(true);
        } else {
            captureService.disableAutoCapture(false);
        }
        showMessage(' aqui 1');
        if (!scanningStarted) {
            scanningStarted = true;
            config.scanStartCallback();
        }

        if (showDigitIndicatorToolTip) {
            showDigitIndicatorToolTip = false;
            if (Util.getCookie("disableDigitTooltip") !== "true") {
                $(".fingerprint__digit-indicator-tooltip").delay(1000).fadeIn(400).delay(3000).fadeOut(400);
            }
        }
showMessage(' aqui 2');
        setState(State.START_SCANNING);

        // Show finger to capture guide image for rolls (capture guide image for plains will be shown when no fingers
        // are being previewed)
        if (ImpressionInfo.isRoll(impression)) {
            showCaptureGuide(impression);
            needToHideCaptureGuide = true;
        }
        showMessage(' aqui 3');
        captureService.startAutoCapture(nowCapturing.impression, FingerprintCaptureApi.ImageFormat.JPG).then(
            function () {
                setState(State.SCANNING);
                showMessage("Completed startAutoCapture");
                needScreenInfoUpdate = true;
            },
            function (error) {
                setState(State.IDLE);
                $(".fingerprint-alert__connection-success").hide();
                $(".fingerprint-alert__preview-failure-reason").text(error.message);
                $(".fingerprint-alert__preview-failure").show();
                showMessage(error);
            });
        console.log(' aqui 4');
    };

    /**
     * The UI can call this to stop previewing / autocapture
     *
     * @memberof! FingerprintComponent
     */
    var endAutoCapture = function () {
        return new Promise(function (resolve, reject) {
            if (state === State.CANCELING_SCANNING) {
                resolve();
                return;
            }
            setState(State.CANCELING_SCANNING);
            captureService.endAutoCapture()
                .then(function () {
                    setState(State.IDLE);
                    $(".fingerprint-scan__capture-guide").hide();
                    showMessage("Completed endAutoCapture");
                    resolve();
                }).catch(function (e) {
                    reject(e);
                }
            )
        });
    };

    /**
     * Manually captures the current image on the fingerprint scanner
     *
     * @memberof! FingerprintComponent
     */
    var captureManually = function () {
        setState(State.START_MANUAL_CAPTURE);
        captureService.captureImage().then(
            function () {
                showMessage("Completed captureImage");
                setState(State.MANUAL_CAPTURE);
            },
            function (error) {
                // TODO
            }
        );
    };

    /**
     * Check if calibrate can be called in current state. If capturing, stops capturing before calibration runs
     *
     * @memberof! FingerprintComponent
     */
    var calibrate = function () {
        if (state !== State.IDLE && state !== State.CALIBRATE_REQUIRED && state !== State.SCANNING)
            return Promise.resolve();
        if (state === State.SCANNING) {
            endAutoCapture().then(function () {
                return doCalibration();
            }).then(function () {
                return startAutoCapture();
            });
        } else {
            return doCalibration();
        }
    };

    // Updates the gui and state and call calibrates
    var doCalibration = function () {
        setState(State.CALIBRATING);
        disableUi(true);
        $(".fingerprint-alert__calibration-required").hide();
        $(".fingerprint-alert__calibrating").show();
        return captureService.calibrate().then(
            function () {
                showMessage("Completed calibration");
                $(".fingerprint-alert__calibrating").hide();
                setState(State.IDLE);
                disableUi(false);
            },
            function (error) {
                console.log("Error calibrating:" + error);
                setState(State.IDLE);
                disableUi(false);
            }
        );
    };

    /**
     * Causes the browser to put a window that allows the user to download the current image
     *
     * @memberof! FingerprintComponent
     */
    var downloadImage = function () {
        // Hackish way to download the final image
        //window.location.href = document.getElementById("finger-preview-image").src.replace('image/jpg', 'image/octet-stream');

        //var sampleBytes = base64ToArrayBuffer(captureSet[nowCapturing.impression].image);
        //saveByteArray([sampleBytes], 'fgp-' + nowCapturing.impression +'.wsq');

        var base64Data = captureSet[nowCapturing.impression].image;
        var fileName = 'fgp-' + nowCapturing.impression + '.jpg';
        BinaryFileSaver.saveBase64(base64Data, fileName);
    };

    /**
     * Call this to shut down the BioComponents server
     *
     * @memberof! FingerprintComponent
     */
    var shutdownServer = function () {
        var json_node = {};
        json_node["function"] = "shutdown";
        transport.send(json_node);
    };

    /** Set a function that will be called when the fingerprint
     *  capture component state changes
     *
     *  @memberof! FingerprintComponent
     */
    var addStateChangeListener = function (func) {
        stateChangeListener = func;
    };

    /**
     * Must be called when the fingerprint capture form is shown
     *
     * @memberof! FingerprintComponent
     */
    var activate = function () {
        if (config === null)
            return;
        autoConnect = true;
        if (state === State.NOT_CONNECTED) {
            $('.fingerprint-alert__connection-failure').hide();
            connectToService();
        }
        else if (state === State.IDLE) {
            if (autoConnect) {
                autoConnect = false;
                $("#progressDialogMessage").text("Starting Auto Capture...");
                startAutoCapture();
            }
        }
    };

    /**
     * @typedef {Object} DeviceInfo
     * @property {make} The manufacturer make from the active live scan device.
     * @property {model} The manufacturer model from the active live scan device.
     * @property {serialNumber} The serial number, or equivalent identification, from the active live scan device.
     */

    /**
     * Gets an object that has the scanner make, model and serial number.
     * Can only be called after scanner has been initialized and is in the IDLE state.
     *
     * @returns {Promise<DeviceInfo>} The scanner make, model and serial number (if available)
     * @memberof! FingerprintComponent
     */
    var getDeviceInfo = (function () {
        return new Promise(function (resolve, reject) {
            {
                // Already have it, so return it.
                if (deviceInfo) {
                    resolve(deviceInfo);
                    return;
                }
                var scannerInfo = [
                    captureService.deviceGetMake(),
                    captureService.deviceGetModel(),
                    captureService.deviceGetSerialNumber()
                ];
                Promise.all(scannerInfo).then(
                    function (scannerMakeModelSerial) {
                        deviceInfo = {
                            make: scannerMakeModelSerial[0],
                            model: scannerMakeModelSerial[1],
                            serialNumber: scannerMakeModelSerial[2]
                        };
                        resolve(deviceInfo);
                    },
                    function (error) {
                        reject(error);
                    }
                );
            }
        })
    });

    /**
     * Returns an array of ImpressionEntry that contains the prints that have been collected or mark as missing
     *
     * @returns {Array<ImpressionEntry>}
     * @memberof! FingerprintComponent
     */
    var getCaptureList = function () {
        var captureList = [];
        for (var i = 0; i < captureListing.length; i++) {
            var capture = captureListing[i];
            if (capture.captureStatus != CaptureStatus.NOT_CAPTURED ||
                capture.captureStatus != CaptureStatus.SKIPPED) {
                captureList.push(capture);
            }
        }
        return captureList;
    };

    /**
     * Exposes the setService object so the NIST Component can access it
     *
     * @returns FingerprintSet
     *
     * @memberof! FingerprintComponent
     */
    var getFingerprintSet = function () {
        return {
            fingerprintSet: setController.setService,
            missingSet: missingSet
        }
    };


    /*
     *
     *  Capture List Functions
     *
     */

    /**
     * @typedef {Object} ImpressionEntry
     * @property {integer} impression The impression that this entry represents (value from FingerprintSetApi.Impression)
     * @property {string} captureStatus The status of the capture, e.g. CaptureStatus.NOT_CAPTURED, CaptureStatus.AMPUTATED, etc
     * @property {string|null} imageData Contains a base64 encoded image data when the image has been captured
     */

    /**
     * A function that constructs an ImpressionEntry object
     *
     * @constructor
     * @memberof! FingerprintComponent
     * @param {integer} impression Impression to capture (value from FingerprintSetApi.Impression)
     * @returns {ImpressionEntry}
     */
    var ImpressionEntry = function (impression) {
        this.impression = impression;
        this.captureStatus = CaptureStatus.NOT_CAPTURED;
        this.imageData = null;
        this.afiq = [];
        this.nfiq = [];
        this.impressions = [];
    };

    /**
     * Populates the captureListing with the impressions that are to be captured from the configuration.
     */
    var initializeCaptureListing = function () {
        if (Util.hasDuplicates(config.collectionSet)) {
            throw new Error('collectionSet has duplicate impression values:' + JSON.stringify(config.collectionSet));
        }
        // Clear array
        captureListing.length = 0;
        for (var i = 0; i < config.collectionSet.length; i++) {
            var impression = config.collectionSet[i];
            captureListing.push(new ImpressionEntry(impression));
        }
    };

    /**
     * Iterates through the capture list and returns the first impression that has not been captured.
     *
     * @returns {number|null} The next impression to capture
     */
    var nextCaptureImpression = function () {
        for (var i = 0; i < captureListing.length; i++) {
            if (captureListing[i].captureStatus === CaptureStatus.NOT_CAPTURED) {
                nowCapturing = captureListing[i];
                return nowCapturing.impression;
            }
        }
        nowCapturing = null;
        return null;
    };

    /**
     * Sets the capture status of finger (e.g. CaptureStatus.AMPUTATED, CaptureStatus.NOT_CAPTURED)
     * Sets this value in the capture list, capture table and the missingSet.
     *
     * @param impression {number} Impression value 1-10
     * @param status {string}
     */
    var setFingerMissing = function (impression, status) {
        var isMissing = status === CaptureStatus.UNABLE_TO_PRINT || status === CaptureStatus.AMPUTATED;

        if (isMissing) {
            missingSet.set(impression, status);
        }
        else {
            missingSet.delete(impression);
        }

        captureListSetStatus(impression, status);

        captureService.setFingerMissing(impression, isMissing).then(function () {
            return setController.setMissing(impression, isMissing);
        }).then(function () {
            CaptureTable.removeEntry(impression);
            if (isMissing) {
                CaptureTable.addMissingEntry(impression, status);
            }
            // If we are currently capturing this position, move on to next one
            var positions = getRelatedPositions(impression);
            if (state === State.SCANNING && nowCapturing && positions.indexOf(nowCapturing.impression) !== -1) {
                if (state === State.CANCELING_SCANNING) return;
                setState(State.CANCELING_SCANNING);
                return captureService.endAutoCapture().then(function () {
                    setState(State.IDLE);
                    startAutoCapture();
                });
            }

            // Check if all impressions of a multi impression image are missing
            var impressions = ImpressionInfo[nowCapturing.impression].fingersCodes;
            if (allImpressionMissing(impressions)) {
                captureListSetStatus(nowCapturing.impression, status);
                if (state === State.CANCELING_SCANNING) return;
                setState(State.CANCELING_SCANNING);
                return captureService.endAutoCapture().then(function () {
                    setState(State.IDLE);
                    startAutoCapture();
                });
            }
        }).catch(function (e) {
            console.log("Error in setFingerMissing:" + e);
            console.log(e.stack);
            //todo
        });
    };

    /**
     * Returns true of all the specified impressions are missing
     *
     * @param impressions {number[]}
     * @returns {boolean}
     */
    var allImpressionMissing = function (impressions) {
        for (var i = 0; i < impressions.length; i++) {
            if (!missingSet.has(impressions[i])) {
                return false;
            }
        }
        return true;
    };

    /**
     * Locates the specified impression in the capture list and sets its capture status
     *
     * @param impression {number}
     * @param captureStatus {CaptureStatus}
     */
    var captureListSetStatus = function (impression, captureStatus) {
        var positions = getRelatedPositions(impression);
        for (var i = 0; i < captureListing.length; i++) {
            if (positions.indexOf(captureListing[i].impression) !== -1) {
                captureListing[i].captureStatus = captureStatus;
            }
        }

        /* If we are setting a print to NOT_CAPTURED, check if any multi-impression images contain the position and
         * set them to CaptureStatus.NOT_CAPTURED as well.
         */
        if (captureStatus === CaptureStatus.NOT_CAPTURED) {
            if (ImpressionInfo.SingleFingerImpressions.indexOf(impression) !== -1) {
                var containingImpressions = ImpressionInfo.GetContainingImpressions(impression);
                for (i = 0; i < containingImpressions.length; i++) {
                    captureListSetStatus(containingImpressions[i], CaptureStatus.NOT_CAPTURED);
                    CaptureTable.removeEntry(containingImpressions[i]);
                }
            }
        }
    };

    /**
     * Searches the list of captured impressions for an impression that contains the plain version of the specified
     * single impression image. If the plain is found in a multi-impression image, the single impression code will be
     * returned. This function is used to do the roll/plain width comparison check.
     *
     * @param singleImpression Single image impression to look for
     * @returns {number} Single image impression code of plain that has been captured or -1 if not found
     */
    var findCapturedPlain = function (singleImpression) {
        if (!ImpressionInfo.isRoll(singleImpression))
            throw Error("singleImpression argument must be a roll");

        for (var i = 0; i < captureListing.length; i++) {
            if (captureListing[i].captureStatus !== CaptureStatus.CAPTURED) {
                continue;
            }
            var impressionInfo = ImpressionInfo[captureListing[i].impression];
            if (!impressionInfo.isPlain) {
                continue;
            }
            var fingersCodesIndex = impressionInfo.fingersCodes.indexOf(singleImpression)
            if (fingersCodesIndex !== -1) {
                if (impressionInfo.hasOwnProperty("slapCodes")) {
                    return impressionInfo.slapCodes[fingersCodesIndex];
                }
                else {
                    return captureListing[i].impression;
                }
            }
        }
        return -1;
    };


    /*
     *
     *  Workflow Progression and State Transition
     *
     */


    /**
     * Connects to FingerprintCapture and FingerprintSet components. Sends autocapture configuration file and retrieves
     * device and version info.
     *
     * @returns {Promise}
     */
    var connect = function () {
        setState(State.CONNECTING);
        return new Promise(function (resolve, reject) {
            setController.connect(config.setTransport, config).then(function () {
                return createFingerprintCapture(config.captureTransport, "FingerprintCapture")
            }).then(function (instance) {
                captureService = instance;
                registerHandlers();
                showMessage("FingerprintCapture Created");
                return captureService.getVersionString();
            }, function (error) {
                showMessage("Failed to create FingerprintCapture object on server:" + error);
                reject(error);
            }).then(function (version) {
                showMessage("Got version");
                // TODO Store version
            }).then(function () {
                showMessage("Getting autocapture_configuration.xml");
                // Get the autocapture configure file from the server
                return Util.fetchFileFromServer("GET", config.autocaptureConfigurationFile +
                    "?_=" + new Date().getTime());
            }).then(function (responseXML) {
                showMessage("Sending autocapture_configuration.xml");
                // Call the API to set it
                return captureService.setAutoCaptureConfiguration(responseXML)
            }).then(function () {
                showMessage("Successfully set autocapture_configuration.xml");
                setState(State.CONNECTED);
                if (openDeviceOnConnect) {
                    openDeviceOnConnect = false; // Prevent reconnecting if first attempt failed
                    $("#progressDialogMessage").text("Initializing Scanner...");
                    return openDevice();
                } else {
                    return Promise.resolve();
                }
            }).then(function () {
                    resolve();
                },
                function (error) {
                    console.log("Error opening device:" + error.message);
                }
            ).catch(function (e) {
                // Called if any of the above have an error or if an exception is thrown
                setState(State.NOT_CONNECTED);
                var message = "An error occurred:" + "\n" + e;
                showMessage(e);
                reject(e);
            });
        });
    };

    /**
     * Sets the functions that will get called when the FingperintCapture component has data to report
     */
    var registerHandlers = function () {
        captureService.setPreviewImageUpdated(onPreviewImageUpdated);
        captureService.setCapturedImageUpdated(onCaptureImageUpdated);
        captureService.setPreviewQualityScoreUpdated(onPreviewQualityScoreUpdated);
        captureService.setAutocaptureStatusUpdated(onAutoCaptureStatusUpdated);
        captureService.setDeviceStateUpdated(onDeviceStateUpdated);
    };


    /**
     * Set retrieval status
     *
     */
    var setRetrievalStatus = function (status) {
        isRetrieved = status;
    };

    /**
     * Updates the UI based on the set state
     */
    var setState = function (newState) {
        state = newState;
        switch (state) {
            case State.NOT_CONNECTED:
                break;
            case State.CONNECTING:
                break;
            case State.CONNECTED:
                break;
            case State.INITIALIZING_DEVICE:
                break;
            case State.IDLE:
                if (autoConnect) {
                    autoConnect = false;
                    $("#progressDialogMessage").text("Starting Auto Capture...");
                    startAutoCapture();
                }
                break;
            case State.START_SCANNING:
                break;
            case State.SCANNING:
                $(".fingerprint-alert__connection-success").hide('slow');
                break;
            case State.CANCELING_SCANNING:
                break;
            case State.START_MANUAL_CAPTURE:
                break;
            case State.MANUAL_CAPTURE:
                break;
            case State.CAPTURING:
                break;
        }
        if (stateChangeListener) {
            stateChangeListener(state);
        }
    };

    /**
     * Rescan the specified impression
     * @param impression
     */
    var rescanImpression = function (impression) {
        // Scroll to top of windows
        window.scrollTo(0, 0);
        CaptureTable.removeEntry(impression);
        for (var j = 0; j < captureListing.length; j++) {
            if (captureListing[j].impression === impression) {
                captureListing[j].captureStatus = CaptureStatus.NOT_CAPTURED;
            }
        }
        updateProgressBar();

        // Handle resetting of values in case the user hits rescan when alert is up
        $('.fingerprint-alert__rescan').hide();
        retryCount = 0;

        // TODO check if no more captures then show "No Captures entry"?
        if (state === State.IDLE) {
            captureImpression(impression);
        } else if (state === State.SCANNING) {
            // If previewing, we need to stop previewing before we start capturing the new impression
            endAutoCapture().then(function () {
                captureImpression(impression);
            });
        }
        // Else ignore user click if not in one of the above states
    };

    /**
     * Called when the captured print passes tests (quality, sequencing etc) or when the user has chosen
     * to accept the image. Updates the status bar, place the impression in the captured list, and starts
     * capturing a next impression if needed.
     */
    var finishCapture = function () {
        nowCapturing.captureStatus = CaptureStatus.CAPTURED;
        updateProgressBar();
        CaptureTable.addEntry(nowCapturing.impression, nowCapturing.imageData, nowCapturing.afiq, nowCapturing.nfiq,
            nowCapturing.impressions);
        showMessage("Capture done...");
        retryCount = 0;
        if (nextCaptureImpression() !== null) {
            startAutoCapture(true);
        } else {
            showFinished()
        }
    };


    /*
     *
     *  Fingerprint Capture BioComponent Callback Targets
     *
     */

    /**
     * Call when a quality value is returned from the server
     *
     * @param impressionString Impression code as a string
     * @param afiqScore AFIQ quality score as an integer
     */
    var onPreviewQualityScoreUpdated = function (impressionString, afiqScore) {
        // TODO Should be tested with single finger plains
        var impression = parseInt(impressionString);

        if (ImpressionInfo.isRoll(nowCapturing.impression))
            return;

        var qualityBracket = getAfiqQualityBracket(impression, afiqScore);
        setFingerButtonQualityBracket(impression, qualityBracket);
    };

    /**
     * Called by server when autocapture status is updated
     *
     * @param {FingerprintCaptureApi.AutocaptureStatus} status
     */
    var onAutoCaptureStatusUpdated = function (status) {
        if (status === FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_CAPTURE_INITIATED) {
            setState(State.CAPTURING);
        }

        // Don't do updates if we are idling
        if (state === State.IDLE)
            return;

        if (needScreenInfoUpdate) {
            updateScreenCaptureInfo();
        }

        if (status === FingerprintCaptureApi.AutocaptureStatus.SOFTWAREAUTOCAPTURE_NO_FINGERS) {
            // Remove quality indicators when no fingers present
            $(".fingerprint-scan__finger-button").not(".fingerprint-scan__finger-button--missing")
                .removeClass("fingerprint-scan__finger-button--good fingerprint-scan__finger-button--marginal fingerprint-scan__finger-button--bad");

            // Set flag that we have seen frames with no fingers
            noFingersMessageSeen = true;

            if (config.requireBlankImageBeforeCapture && consecutiveCapture)
                captureService.disableAutoCapture(false);

            // Put up hand image that indicates which finger we are capturing
            var impressionInfo = ImpressionInfo[nowCapturing.impression];
            if (nowCapturing.impression === FingerprintCaptureApi.Impression.PLAIN_DUAL_THUMBS) {
                showCaptureGuide(31);
            }
            else if (impressionInfo.hand === "right") {
                $("#right-hand").show();
                if (nowCapturing.impression === FingerprintCaptureApi.Impression.PLAIN_RIGHT_FOUR_FINGERS) {
                    showCaptureGuide(13);
                }
                else if (nowCapturing.impression === FingerprintCaptureApi.Impression.PLAIN_RIGHT_THUMB) {
                    showCaptureGuide(1);
                }
                else {
                    showCaptureGuide(nowCapturing.impression);
                }
            }
            else if (impressionInfo.hand === "left") {
                $("#left-hand").show();
                if (nowCapturing.impression === FingerprintCaptureApi.Impression.PLAIN_LEFT_FOUR_FINGERS) {
                    showCaptureGuide(14);
                }
                else if (nowCapturing.impression === FingerprintCaptureApi.Impression.PLAIN_LEFT_THUMB) {
                    showCaptureGuide(6);
                }
                else {
                    showCaptureGuide(nowCapturing.impression);
                }
            }
            status = "Please place <b>" + ImpressionInfo[nowCapturing.impression].name + "</b> on scanner";
        }
        else {
            hideCaptureGuide();
            status = AutoCaptureStrings[status];
        }

        if (config.requireBlankImageBeforeCapture && !noFingersMessageSeen && consecutiveCapture)
            status = "Please remove fingers from scanner";

        $(".fingerprint-scan__capturing-guidelines").html(status);

        // This is for the debug display
        document.getElementById("autoCaptureStatus")
            .innerHTML = status;
    };


    /** Called by server when device status is updated */
    var onDeviceStateUpdated = function (status) {
        deviceState = FingerprintCaptureApi.DeviceState[status];
        console.log("Device state updated:" + deviceState)
    };


    /**
     * Called by server when there is new preview image to display
     *
     * @param imageData Image encoded in a base64
     */
    var onPreviewImageUpdated = function (imageData) {

        if (state !== State.SCANNING)
            return;

        if (needScreenInfoUpdate) {
            updateScreenCaptureInfo();
        }
        if (needToHideCaptureGuide) {
            needToHideCaptureGuide = false;
            hideCaptureGuide();
        }

        $(".fingerprint-scan__preview-image").attr("src", "data:image/jpg;base64," + imageData);
        captureService.requestNextPreviewImage();
    };

    /**
     * Called by the server when capture is done
     *
     * @param imageData Image encoded in a base64
     */
    var onCaptureImageUpdated = function (imageData) {
        setState(State.IDLE);
        var capturedImpression = nowCapturing.impression;
        nowCapturing.imageData = imageData;
        $(".fingerprint-scan__preview-image").attr("src", "data:image/jpg;base64," + imageData);

        var setImagePromise;
        if (config.captureTransport === config.setTransport) {
            // Using same server so we can do an internal copy
            setImagePromise = setController.setFingerprintCaptureImage(nowCapturing.impression, captureService);
        }
        else {
            // Copy image over
            setImagePromise = setController.setImage(nowCapturing.impression, imageData, 500);
        }

        setImagePromise.then(function (result) {
            switch (result) {
                case FingerprintSetApi.AnalysisResult.NO_FINGERPRINT_FOUND:
                    throw new Error('No fingerprint found.');
                case FingerprintSetApi.AnalysisResult.IMAGE_QUALITY_TOO_LOW:
                    throw new Error('Image quality too low.');
                case FingerprintSetApi.AnalysisResult.IMAGE_TOO_SMALL:
                    throw new Error('Image too small.');
            }
            return setController.getQuality(capturedImpression, missingSet);
        }).then(function (qualityValues) {
            // Clear the current arrays
            nowCapturing.afiq.length = 0;
            nowCapturing.nfiq.length = 0;
            nowCapturing.impressions.length = 0;

            // Fill the quality arrays in the correct order for display
            var impressionInfo = ImpressionInfo[nowCapturing.impression];
            if (impressionInfo.hasOwnProperty("slapCodes")) {
                for (var i = 0; i < impressionInfo.slapCodes.length; i++) {
                    var impression = impressionInfo.slapCodes[i];
                    if (qualityValues.hasOwnProperty("" + impression))
                        nowCapturing.afiq.push(qualityValues[impression].afiq);
                    if (qualityValues.hasOwnProperty("" + impression))
                        nowCapturing.nfiq.push(qualityValues[impression].nfiq);
                    nowCapturing.impressions.push(nowCapturing.impression);
                }
            }
            else {
                nowCapturing.afiq.push(qualityValues[nowCapturing.impression].afiq);
                nowCapturing.nfiq.push(qualityValues[nowCapturing.impression].nfiq);
                nowCapturing.impressions.push(nowCapturing.impression);
            }

            var errors = [];
            checkQuality(qualityValues, errors);
            var checks = [
                checkSequencing(errors),
                checkMinutia(errors)
            ];

            if (config.widthCheckPercent > 0) {
                checks.push(checkWidth(errors));
            }

            Promise.all(checks).then(function () {
                if (errors.length > 0) {
                    // TODO Check if rescans are allowed

                    if (config.enableAudio) {
                        captureService.playOnFailureAudio();
                    }

                    if (retryCount < config.numberOfRetries) {
                        var html = "Problems with capture:<ul>";
                        for (var i = 0; i < errors.length; i++) {
                            html += "<li>" + errors[i] + "</li>";
                        }
                        html += "</ul>";
                        html += "<p>Retries remaining: " + (config.numberOfRetries - retryCount) + "</p>";
                        $('.fingerprint-alert__rescan-text').html(html);
                        $('.fingerprint-alert__rescan').show();
                    }
                    else {
                        // TODO Should we not have played the audio?
                        retryCount = 0;
                        finishCapture();
                    }
                }
                else {
                    retryCount = 0;
                    finishCapture();
                }
            }).catch(function (error) {
                // TODO Check if rescans are allowed
                if (config.enableAudio) {
                    captureService.playOnFailureAudio();
                }
                $('.fingerprint-alert__rescan-text').text("An error occurred: " + error.message);
                $('.fingerprint-alert__rescan').show();
                console.log(error.stack);
            });

        }).catch(function (error) {
            // TODO Check if rescans are allowed
            $('.fingerprint-alert__rescan-text').text("An error occurred: " + error.message);
            $('.fingerprint-alert__rescan').show();
            console.log(error.stack);
        });
    };


    /*
     *
     *  Capture Image Checking
     *
     */

    /**
     * Checks the captured impression and adds any error to the captureError array
     * @param captureErrors
     * @returns {Promise}
     */
    var checkSequencing = function (captureErrors) {
        return new Promise(function (resolve, reject) {

            /* Build list of impression codes to check */
            var impression = nowCapturing.impression;
            var impressions = [];
            var impressionInfo = ImpressionInfo[impression];
            if (impressionInfo.hasOwnProperty("slapCodes")) {
                impressions = impressionInfo.slapCodes;
            }
            else {
                impressions.push(impression)
            }

            /* Call the fingerprint set for each impression code */
            var sequencingErrorPromises = [];
            for (var i = 0; i < impressions.length; i++) {
                sequencingErrorPromises.push(
                    setController.getSequencingErrors(impressions[i])
                );
            }

            /* Wait for and check the results */
            var hasErrors = false;
            Promise.all(sequencingErrorPromises).then(
                function (sequencingErrors) {
                    for (var j = 0; j < sequencingErrors.length; j++) {
                        var sequencingError = sequencingErrors[j];
                        if (sequencingError.falseMatches.length > 0 || sequencingError.falseNonMatches.length > 0) {
                            hasErrors = true;
                        }
                    }

                    if (hasErrors) {
                        captureErrors.push("Sequence Error Detected");
                    }
                    resolve();
                },
                function (error) {
                    showMessage("Error getting sequencing errors: " + error.errorMessage);
                    reject(error.errorMessage)
                }
            )
        });
    };

    /**
     * Checks that the captured prints contain the required about of minutia
     * @param errors
     * @returns {Promise}
     */
    var checkMinutia = function (errors) {
        return new Promise(function (resolve, reject) {
            var countPromises = [];

            var impressionInfo = ImpressionInfo[nowCapturing.impression];
            if (impressionInfo.fingersCodes.length > 1) {
                // Multi finger impressions
                for (var i = 0; i < impressionInfo.slapCodes.length; i++) {
                    var impression = impressionInfo.slapCodes[i];
                    var singleImpression = impressionInfo.fingersCodes[i];
                    if (!missingSet.has(singleImpression)) {
                        countPromises.push(setController.getMinutiaCount(impression))
                    }
                }
            }
            else {
                // Single finger impressions
                countPromises.push(setController.getMinutiaCount(nowCapturing.impression))
            }

            Promise.all(countPromises).then(function (minutiaCounts) {
                var insufficientMinutia = false;
                var insufficientMinutiaCount = 0;
                for (var i = 0; i < minutiaCounts.length; i++) {
                    if (minutiaCounts[i] < config.minimumMinutiaRequired) {
                        insufficientMinutia = true;
                        insufficientMinutiaCount = minutiaCounts[i];
                    }
                }

                if (insufficientMinutia) {
                    errors.push("Minimum minutia count not met. Found:" + insufficientMinutiaCount + ". Require:" +
                        config.minimumMinutiaRequired);
                }
                resolve();
            }).catch(function (error) {
                reject(error);
            });
        })
    };

    /**
     * Checks that width of the roll is a specified percent bigger than the plains
     *
     * @param errors If check fails, and error description is appended
     * @returns {Promise}
     */
    var checkWidth = function (errors) {
        return new Promise(function (resolve, reject) {
            var impressionInfo = ImpressionInfo[nowCapturing.impression];
            if (impressionInfo.isPlain) {
                resolve();
                return;
            }

            var plainImpression = findCapturedPlain(nowCapturing.impression);
            if (plainImpression === -1) {
                console.log("Cannot check width of roll, plain not captured");
                resolve();
                return;
            }

            Promise.all([
                setController.getSegmentationCoordinates(nowCapturing.impression),
                setController.getSegmentationCoordinates(plainImpression)
            ]).then(function (result) {
                var roll = result[0];
                var plain = result[1];
                var percent = ((roll.width / plain.width ) - 1) * 100;
                console.log("Roll width:" + roll.width + " Plain width:" + plain.width + " Percent:" + percent);
                if (percent < config.widthCheckPercent) {
                    errors.push("Roll must be " + config.widthCheckPercent + "% bigger than plain")
                }
                resolve();
            }).catch(function (error) {
                console.log("Error:" + error);
                reject(error);
            })
        })
    };


    /**
     * Checks that the captured images are of sufficient quality.
     * @param qualityValues
     * @returns {boolean} Captures images are not of sufficient quality
     */
    var checkQuality = function (qualityValues, errors) {
        var sufficientQuality = true;
        for (var position in qualityValues) {
            if (!qualityValues.hasOwnProperty(position))
                continue;
            var singleFingerCode = getFingerCode(position);
            var qualityBracket = QualityBracket.GOOD;

            if (config.qualityCutoffAlgorithm === "NFIQ") {
                var nfiqScore = qualityValues[position].nfiq;
                qualityBracket = getNfiqQualityBracket(singleFingerCode, nfiqScore);
                if (qualityBracket == QualityBracket.POOR) {
                    console.log("Position: " + position + " has insufficient NFIQ quality");
                    sufficientQuality = false;
                }
            }

            if (config.qualityCutoffAlgorithm === "AFIQ") {
                var afiqScore = qualityValues[position].afiq;
                qualityBracket = getAfiqQualityBracket(singleFingerCode, afiqScore);
                if (qualityBracket == QualityBracket.POOR) {
                    console.log("Position: " + position + " has insufficient AFIQ quality");
                    sufficientQuality = false;
                }
            }
            setFingerButtonQualityBracket(singleFingerCode, qualityBracket);
        }
        if (!sufficientQuality) {
            errors.push("Impression has insufficient quality");
        }
        return sufficientQuality;
    };


    /*
     *
     *  UI Manipulation
     *
     */

    /**
     * Updates the UI when a new finger preview starts up
     */
    var updateScreenCaptureInfo = function () {
        if (nowCapturing === null)
            return; // Value is not set so skip updating
        needScreenInfoUpdate = false;
        fingerButtonPrepareForCapture(nowCapturing.impression);
        // Set the text that shows the position we will be capturing
        $(".fingerprint-scan__capturing-text").text(ImpressionInfo[nowCapturing.impression].name);
    };

    /**
     * Updates the UI to show that collection is done
     */
    var showFinished = function () {
        $(".fingerprint-scan").hide(0, fingerButtonReset); // Reset buttons when completely hidden
        $(".capture-completed").show();
        $(".fingerprint__save-and-continue").prop("disabled", false);
        config.scanCompleteCallback();
        scanningStarted = false;
        clearPreviewImage();
    };

    /**
     * Shows capture guide image
     *
     * @param position {number} Finger to highlight
     */
    var showCaptureGuide = function (position) {

        // Translate single finger plains to codes 1-10
        if (position >= 80) {
            position = ImpressionInfo[position].fingersCodes[0];
        }
        $(".fingerprint-scan__capture-image").attr("src",  config.imageDirectory +
            "/finger-capture-position-" + position + ".svg");
        $(".fingerprint-scan__capture-guide").show();
        $(".fingerprint-scan__preview-image").hide();
    };

    var hideCaptureGuide = function () {
        $(".fingerprint-scan__preview-image").show();
        $(".fingerprint-scan__capture-guide").hide();
    };

    /**
     * Resets all the finger buttons and enables the buttons for the specified impression.
     *
     * @param impression {integer}
     */
    var fingerButtonPrepareForCapture = function (impression) {
        $(".fingerprint-scan__capturing-guidelines").html("");
        $(".fingerprint-scan__finger-button").removeClass("fingerprint-scan__finger-button--good fingerprint-scan__finger-button--marginal fingerprint-scan__finger-button--bad ");
        var positionsToEnable = ImpressionInfo[impression].fingersCodes;
        for (var impression = 1; impression <= 10; impression++) {
            var button = $(".fingerprint-scan__finger-button" + impression + "__button");
            var enabled = positionsToEnable.indexOf(impression) > -1;
            button.prop('disabled', !enabled);
            if (missingSet.has(impression)) {
                button.addClass("fingerprint-scan__finger-button--missing");
            }
        }
    };

    /**
     * Update the fingerprint buttons to indicate the quality of the specified finger.
     *
     * @param impression {number}
     * @param qualityBracket {QualityBracket}
     */
    var setFingerButtonQualityBracket = function (impression, qualityBracket) {
        var id = ".fingerprint-scan__finger-button" + impression + "__button";
        var $btn = $(id);
        $btn.removeClass("fingerprint-scan__finger-button--good fingerprint-scan__finger-button--marginal fingerprint-scan__finger-button--bad");

        if (qualityBracket === QualityBracket.GOOD) {
            $btn.addClass("fingerprint-scan__finger-button--good");
        }
        else if (qualityBracket === QualityBracket.MARGINAL) {
            $btn.addClass("fingerprint-scan__finger-button--marginal");
        }
        else if (qualityBracket === QualityBracket.POOR) {
            $btn.addClass("fingerprint-scan__finger-button--bad");
        }
    };

    /**
     * Removes all the missing finger indicators from the finger buttons
     */
    var fingerButtonReset = function () {
        $(".fingerprint-scan__finger-button").removeClass("fingerprint-scan__finger-button--good fingerprint-scan__finger-button--marginal fingerprint-scan__finger-button--bad fingerprint-scan__finger-button--missing");
        for (var pos = 1; pos <= 10; pos++) {
            var button = $(".fingerprint-scan__finger-button" + pos + "__button");
            button.prop('disabled', true);
        }
    };

    /**
     * Sets a finger button to unable to print. Used when a print is automatically marked missing
     * due to failed captured attempts
     *
     * @param impression {number} Impression to make as missing
     */
    var setFingerButtonMissing = function (impression) {
        var singleFingers = ImpressionInfo[impression].fingersCodes;
        $.each(singleFingers, function (index, singleImpression) {
            var $btn = $(".fingerButton" + singleImpression + " button");
            $btn.addClass("fingerprint-scan__finger-button--missing fingerprint-scan__finger-button--bad");
            setFingerMissing(singleImpression, CaptureStatus.UNABLE_TO_PRINT);
        });
    };

    /**
     * Displays the debugging info in the console and on the UI
     */
    var showMessage = function (message) {
        console.log(message);
        var p = document.getElementById("status");
        p.innerHTML = message;
    };

    var showConnectionError = function (message) {
        console.log("Displaying connection error:" + message);
        $('.fingerprint-alert__connecting').hide();
        $('.fingerprint-alert__connection-failure-text').text(message);
        $('.fingerprint-alert__connection-failure').show();
    };

    var showConnectionSuccess = function () {
        $(".fingerprint-alert__connecting").hide();
        $(".fingerprint-alert__connection-success").show();
    };

    var showOpenFailure = function () {
        $(".fingerprint-alert__connecting").hide();
        $(".fingerprint-alert__open-failure").show();
    };

    var showAlertConnecting = function () {
        $(".fingerprint-alert__open-failure").hide();
        $(".fingerprint-alert__connecting").show();
    };

    var updateProgressBar = function () {
        var capturedCount = 0;
        for (var i = 0; i < captureListing.length; i++) {
            if (captureListing[i].captureStatus !== CaptureStatus.NOT_CAPTURED) {
                capturedCount++;
            }
        }
        var percent = Math.round(capturedCount / captureListing.length * 100);
        $('.fingerprint-scan__progress-bar').css('width', percent + '%').attr('aria-valuenow', percent);
    };

    /**
     * Sets the preview image to a blank image
     */
    var clearPreviewImage = function () {
        // Set 1x1 gif image to clear out
        $('.fingerprint-scan__preview-image').attr('src', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAkwBADs=');
    };

    /**
     * Creates and shows a captured images in carousel modal window
     *
     * @param impression {number} Image to initial show
     */
    var showImpressionViewer = function (impression) {
        var entries = $(".impression-viewer__list");
        entries.empty();
        for (var i = 0; i < captureListing.length; i++) {
            if (captureListing[i].captureStatus === CaptureStatus.CAPTURED) {
                var selected = impression === captureListing[i].impression;
                var html = createImpressionViewerEntry(captureListing[i], selected);
                entries.append(html);
            }
        }
        $('.fingerprint-impression-viewer').modal('show');
    };

    /*
     *
     *  UI Creation
     *
     */

    /**
     * Createa finger button html
     * @param impression
     * @returns {string}
     */
    var createFingerButton = function (impression) {
        var id = "fingerprint-scan__finger-button" + impression;
        return '<div class="btn-group ' + id + '" data-impression="' + impression + '">' +
            '  <button type="button" class="' + id + '__button btn btn-default dropdown-toggle fingerprint-scan__btn-circle fingerprint-scan__finger-button" ' +
            '    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled>' +
            '  </button>' +
            '  <ul class="dropdown-menu ' + id + '__menu">' +
            '    <li><a href="#">Unable to Print</a></li>' +
            '    <li><a href="#">Amputated</a></li>' +
            '    <li role="separator" class="divider"></li>' +
            '    <li><a href="#">Present</a></li>' +
            '  </ul>' +
            '</div>';
    };

    /**
     * Returns a function that opens a finger button menu when a finger button is clicked
     * @param impression
     * @returns {Function}
     */
    var fingerButtonMenuHandler = function (impression) {
        return function (e) {
            var $div = $(this).parent().parent().parent();
            var $btn = $div.find('button');
            $div.removeClass('open');
            $btn.removeClass("fingerprint-scan__finger-button--good fingerprint-scan__finger-button--marginal fingerprint-scan__finger-button--bad");
            $btn.removeClass("fingerprint-scan__finger-button--missing fingerprint-scan__finger-button-collected");
            e.preventDefault();
            var status = CaptureStatus.NOT_CAPTURED;
            var selectedItem = $(this).text();
            if (selectedItem === "Amputated") {
                $btn.addClass("fingerprint-scan__finger-button--missing fingerprint-scan__finger-button--marginal");
                status = CaptureStatus.AMPUTATED;
            }
            else if (selectedItem === "Unable to Print") {
                $btn.addClass("fingerprint-scan__finger-button--missing fingerprint-scan__finger-button--bad");
                status = CaptureStatus.UNABLE_TO_PRINT;
            }
            else {
                $btn.removeClass("fingerprint-scan__finger-button--missing fingerprint-scan__finger-button--marginal fingerprint-scan__finger-button--bad");
            }
            setFingerMissing(impression, status);
            return false;
        };
    };

    /**
     * Adds a single finger button to the top the preview window
     * @param impression
     * @param destination
     */
    var addFingerButton = function (impression, destination) {

        var html = createFingerButton(impression);
        var id = "fingerprint-scan__finger-button" + impression;
        destination.append(html);

        $('.' + id + ' a').click(fingerButtonMenuHandler(impression));
    };

    /**
     * Adds finger buttons to top of the  preview windows. These buttons show quality and missing status
     */
    var addFingerButtons = function () {
        var leftHandButtons = $('.fingerprint-scan__left-hand-buttons');
        var left = [10, 9, 8, 7, 6];
        for (var i = 0; i < left.length; i++) {
            addFingerButton(left[i], leftHandButtons);
        }

        var rightHandButtons = $('.fingerprint-scan__right-hand-buttons');
        var right = [1, 2, 3, 4, 5];
        for (i = 0; i < right.length; i++) {
            addFingerButton(right[i], rightHandButtons);
        }
    };

    var createImpressionViewerEntry = function (impressionEntry, selected) {
        var active = selected ? " active" : "";
        var impressionInfo = ImpressionInfo[impressionEntry.impression];
        return '<div class="item' + active + '">' +
            '     <img src="data:image/jpg;base64,' + impressionEntry.imageData + '" alt="' + impressionInfo.name + '">' +
            '     <div class="carousel-caption">' +
            impressionInfo.name +
            '</div>' +
            '</div>';
    };


    /*
     *
     * Configuration Utility Functions
     *
     *
     */

    /**
     * Returns the NFIQ quality cutoff value for the given impression. If a specific value hasn't been
     * set for the impression, returns the default quality cutoff value.
     * @param impression
     * @returns {*}
     */
    var getNfiqGoodQualityCutoff = function (impression) {
        if (config.nfiqFingersGoodCutoff.hasOwnProperty(impression))
            return config.nfiqFingersGoodCutoff[impression];
        return config.nfiqGoodCutoff;
    };

    /**
     * Returns the AFIQ quality cutoff value for the given impression. If a specific value hasn't been
     * set for the impression, returns the default quality cutoff value.
     * @param impression
     * @returns {*}
     */
    var getAfiqGoodQualityCutoff = function (impression) {
        if (config.afiqFingersGoodCutoff.hasOwnProperty(impression))
            return config.afiqFingersGoodCutoff[impression];
        return config.afiqGoodCutoff;
    };

    /**
     * Returns the NFIQ quality cutoff value for the given impression. If a specific value hasn't been
     * set for the impression, returns the default quality cutoff value.
     * @param impression
     * @returns {*}
     */
    var getNfiqMarginalQualityCutoff = function (impression) {
        if (config.nfiqFingersMarginalCutoff.hasOwnProperty(impression))
            return config.nfiqFingersMarginalCutoff[impression];
        return config.nfiqMarginalCutoff;
    };

    /**
     * Returns the AFIQ quality cutoff value for the given impression. If a specific value hasn't been
     * set for the impression, returns the default quality cutoff value.
     * @param impression
     * @returns {*}
     */
    var getAfiqMarginalQualityCutoff = function (impression) {
        if (config.afiqFingersMarginalCutoff.hasOwnProperty(impression))
            return config.afiqFingersMarginalCutoff[impression];
        return config.afiqMarginalCutoff;
    };

    /**
     * Returns whether NFIQ the score is good, marginal or poor
     *
     * @param impression
     * @param nfiqScore
     * @returns {FingerprintComponent.QualityBracket|string}
     */
    var getNfiqQualityBracket = function (impression, nfiqScore) {
        if (nfiqScore <= getNfiqGoodQualityCutoff(impression))
            return QualityBracket.GOOD;
        if (nfiqScore <= getNfiqMarginalQualityCutoff(impression))
            return QualityBracket.MARGINAL;
        return QualityBracket.POOR;
    };

    /**
     * Returns whether the AFIQ score is good, marginal or poor
     *
     * @param impression
     * @param afiqScore
     * @returns {FingerprintComponent.QualityBracket|string}
     */
    var getAfiqQualityBracket = function (impression, afiqScore) {
        if (afiqScore >= getAfiqGoodQualityCutoff(impression))
            return QualityBracket.GOOD;
        if (afiqScore >= getAfiqMarginalQualityCutoff(impression))
            return QualityBracket.MARGINAL;
        return QualityBracket.POOR;
    };


    /*
     *
     * Other Utility Functions
     *
     *
     */

    /**
     * Given a impression, returns a list of any and all related impression. For example if given the thumb
     * impression, it will return the thumb and the flat thumb impression codes.
     * @param impression
     * @returns {number[]}
     */
    var getRelatedPositions = function (impression) {
        var positions;
        if (impression === 1 || impression === 11) {
            positions = [1, 11];
        }
        else if (impression === 6 || impression === 12) {
            positions = [6, 12];
        }
        else {
            positions = [impression];
        }
        return positions;
    };


    /**
     * Return the single finger code (1-10) for the given single finger impression
     * @param impression
     * @returns {*}
     */
    var getFingerCode = function (impression) {
        var fingerCodes = ImpressionInfo[impression].fingersCodes;
        if (fingerCodes.length != 1)
            throw new Error('Invalid impression, only single finger codes allowed.');
        return fingerCodes[0];
    };


    /*
     *
     * Other Modules
     *
     *
     */


    /**
     * Manages the the table of captured/missing impression on the UI
     * @type {{addEntry, addMissingEntry, removeEntry}}
     */
    var CaptureTable = (function () {
        var createMissingTableEntry = function (id, description, reason) {
            var str =
                '<tr class="' + id + ' fingerprint-captured-images">' +
                '<td>' + description + '-' + reason + '</td>' +
                '<td>' + '</td>' +
                '<td>' + '</td>' +
                '<td><a class="' + id + '__mark-as-present">Mark as present</a></td></tr>';
            return str;
        };

        /**
         * Creates an html string of the captured image entry
         * @param id
         * @param description
         * @param afiq
         * @param nfiq
         * @param impressions An array the has the impression that corresponds to the to AFIQ/NFIQ scores
         * @returns {string}
         */
        var createTableEntry = function (id, description, afiq, nfiq, impressions) {

            var afiqTable = "<table class='fingerprint-captured-images__quality-table'>";
            $.each(afiq, function (index, singleFingerAfiq) {
                var afiqIcon = getAfiqIcon(impressions[index], singleFingerAfiq);
                afiqTable += "<tr><td>" + singleFingerAfiq + afiqIcon + "</td></tr>";
            });
            if (afiq.length === 0) {
                afiqTable += "<tr><td>-"+ unavailableIcon() +"</td></tr>";
            }
            afiqTable += "</table>";

            var nfiqTable = "<table class='fingerprint-captured-images__quality-table'>";
            $.each(nfiq, function (index, singleFingerNfiq) {
                var nfiqIcon = getNfiqIcon(impressions[index], singleFingerNfiq);
                nfiqTable += "<tr><td>" + singleFingerNfiq + nfiqIcon + "</td></tr>";
            });
            if (nfiq.length === 0) {
                nfiqTable += "<tr><td>-"+ unavailableIcon() +"</td></tr>";
            }
            nfiqTable += "</table>";

            var str =
                '<tr class="fingerprint-captured-images ' + id + '">' +
                '<td><img class="' + id + '__image fingerprint-captured-images__image"/>  ' + description + '</td>' +
                '<td>' + afiqTable + '</td>' +
                '<td>' + nfiqTable + '</td>' +
                '<td><a class="' + id + '__rescan">Rescan</a></td></tr>';
            return str;
        };

        var getAfiqIcon = function (singleFingerCode, afiqScore) {
            var qualityBracket = getAfiqQualityBracket(singleFingerCode, afiqScore);
            if (qualityBracket === QualityBracket.GOOD) {
                return goodIcon();
            }
            if (qualityBracket === QualityBracket.MARGINAL) {
                return marginalIcon();
            }
            return poorIcon();
        };

        var getNfiqIcon = function (singleFingerCode, nfiqScore) {
            var qualityBracket = getNfiqQualityBracket(singleFingerCode, nfiqScore);
            if (qualityBracket === QualityBracket.GOOD) {
                return goodIcon();
            }
            if (qualityBracket === QualityBracket.MARGINAL) {
                return marginalIcon();
            }
            return poorIcon();
        };

        var goodIcon = function () {
            return '<span class="glyphicon glyphicon-ok-sign pull-right fingerprint-captured-images__quality-icon fingerprint-captured-images__quality-icon--good" style=""></span>'
        };

        var marginalIcon = function () {
            return '<span class="glyphicon glyphicon-ok-sign pull-right fingerprint-captured-images__quality-icon fingerprint-captured-images__quality-icon--marginal" style=""></span>'
        };

        var poorIcon = function () {
            return '<span class="glyphicon glyphicon-ok-sign pull-right fingerprint-captured-images__quality-icon fingerprint-captured-images__quality-icon--poor" style=""></span>'
        };

        var unavailableIcon = function () {
            return '<span class="glyphicon glyphicon-ok-sign pull-right fingerprint-captured-images__quality-icon fingerprint-captured-images__quality-icon--unavailable" style=""></span>'
        };

        return {
            addEntry: function (impression, imageData, afiq, nfiq, impressions) {
                var tableId = "fingerprint-captured-image-" + impression;
                var entry = createTableEntry(tableId, ImpressionInfo[impression].name, afiq, nfiq, impressions);
                $('#no-captures-text').hide();
                $('#captureTable').prepend(entry);
                $('.' + tableId + '__image').attr("src", "data:image/jpg;base64," + imageData);

                // User wants to rescan
                $('.' + tableId + '__rescan').on("click", function () {
                    window.scrollTo(0, 0);
                    rescanImpression(impression);
                });

                // User wants to view captured impression
                $('.' + tableId).on("click", "a,img", function (e) {
                    e.preventDefault();
                    showImpressionViewer(impression);
                });
            },

            addMissingEntry: function (impression, reason) {
                var tableId = "fingerprint-captured-image-" + impression;
                var entry = createMissingTableEntry(tableId, SingleImpressionInfo[impression].name, reason);
                $('#captureTable').prepend(entry);
                $('.' + tableId + '__mark-as-present').on("click", function () {
                    //Executed when the user wants mark finger as present
                    $('.' + tableId).remove();
                    // TODO check if no more captures then show "No Captures entry"?
                    //missingSet.delete(impression);

                    setFingerMissing(impression, CaptureStatus.NOT_CAPTURED);
                    $(".fingerprint-scan__finger-button" + impression + "__button").removeClass("fingerprint-scan__finger-button--missing");

                    if (state !== State.SCANNING) {
                        startAutoCapture();
                    }
                });
            },

            removeEntry: function (impression) {
                var tableId = "fingerprint-captured-image-" + impression;
                $('#captureTable').find('.' + tableId).remove();
            },

            reset: function () {
                $('.fingerprint-captured-images').remove();
            }
        };
    }());

    /** Module for utility functions
     * @namespace
     * @memberof FingerprintComponentInternal
     */
    var Util = (function () {

        return {
            /** XHR promise wrapper
             * @memberof! FingerprintComponent.Util
             * @param method {string} should be GET or POST
             * @param url {string} URL to retreive file from
             */
            fetchFileFromServer: function (method, url) {
                return new Promise(function (resolve, reject) {
                    var xhr = new XMLHttpRequest();
                    xhr.open(method, url);
                    xhr.onload = function () {
                        if (this.status >= 200 && this.status < 300) {
                            resolve(xhr.response);
                        } else {
                            reject({
                                status: this.status,
                                statusText: xhr.statusText
                            });
                        }
                    };
                    xhr.onerror = function () {
                        reject({
                            source: "fetchFileFromServer", status: this.status, statusText: xhr.statusText
                        });
                    };
                    xhr.send();
                });
            },

            /**
             * Test whether every element in arrayOfValues is in containerSet
             * @memberof! FingerprintComponent.Util
             * @param containerSet {Set} A set of values
             * @param arrayOfValues {number[]} An array of values
             * @returns {*}
             */
            isSubset: function (containerSet, arrayOfValues) {
                return arrayOfValues.reduce(function (previousValue, currentValue, currentIndex, array) {
                    return previousValue && containerSet.has(currentValue);
                }, true);
            },


            /**
             * Numerical sorts an array instead of the lexical sort which is the default
             * @memberof! FingerprintComponent.Util
             * @param array
             * @returns {*}
             */
            sortNumericArray: function (array) {
                return array.sort(function (a, b) {
                    return a - b;
                });
            },


            /**
             * Returns true if the array contains duplicate items
             * @param array
             * @returns {boolean} True if the array has duplicate items
             */
            hasDuplicates: function (array) {
                var set = new Set();
                for (var i = 0; i < array.length; i++) {
                    set.add(array[i]);
                }
                return set.size !== array.length;
            },

            /**
             * Finds an element in a list
             *
             * @param list
             * @param predicate Function that takes the current element as parameter and returns a boolean
             * @returns The first value in the list to pass the test; otherwise undefined
             */
            find: function (list, predicate) {
                for (var i = 0, value; i < list.length; i++) {
                    value = list[i];
                    if (predicate(value)) {
                        return value;
                    }
                }
                return undefined;
            },

            getCookie: function (key) {
                var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
                return keyValue ? keyValue[2] : null;
            }
        };
    })();

    return {
        init: init,
        addStateChangeListener: addStateChangeListener,
        connectToService: connectToService,
        openDevice: openDevice,
        startAutoCapture: startAutoCapture,
        captureImpression: captureImpression,
        endAutoCapture: endAutoCapture,
        captureManually: captureManually,
        downloadImage: downloadImage,
        shutdownServer: shutdownServer,
        activate: activate,
        getFingerprintSet: getFingerprintSet,
        getCaptureList: getCaptureList,
        reset: reset,
        getDeviceInfo: getDeviceInfo,
        setRetrievalStatus: setRetrievalStatus,
        State: State,
        CaptureStatus: CaptureStatus
    };
}());


/**
 * Controls user interaction from the debugging button on bottom of page
 * @type {{init, setState}}
 */
var ButtonStatePanel = (function () {
    "use strict";
    var connectButton;
    var initializeButton;
    var captureButton;
    var cancelButton;
    var closeButton;
    var manualCaptureButton;
    var downloadButton;
    var shutdownServerButton;

    var init = function (fingerprintComponent) {
        connectButton = document.getElementById('connect');
        initializeButton = document.getElementById('initialize');
        captureButton = document.getElementById('capture');
        cancelButton = document.getElementById('endAutoCapture');
        closeButton = document.getElementById('close');
        manualCaptureButton = document.getElementById('manualCapture');
        downloadButton = document.getElementById('download');
        shutdownServerButton = document.getElementById('shutdown');
        connectButton.onclick = fingerprintComponent.connectToService;
        initializeButton.onclick = fingerprintComponent.openDevice;
        captureButton.onclick = fingerprintComponent.startAutoCapture;
        cancelButton.onclick = fingerprintComponent.endAutoCapture;
        manualCaptureButton.onclick = fingerprintComponent.captureManually;
        downloadButton.onclick = fingerprintComponent.downloadImage;
        shutdownServerButton.onclick = fingerprintComponent.shutdownServer;

        $("#markAsAmputated").on("click", function () {
            $("#leftHandMissing").modal('show');
        });

        fingerprintComponent.addStateChangeListener(ButtonStatePanel.setState);
        ButtonStatePanel.setState(FingerprintComponent.State.NOT_CONNECTED);
        downloadButton.disabled = true;
    };

    var setState = function (newState) {
        connectButton.disabled = true;
        cancelButton.disabled = true;
        initializeButton.disabled = true;
        captureButton.disabled = true;
        manualCaptureButton.disabled = true;
        closeButton.disabled = true;
        shutdownServerButton.disabled = true;

        switch (newState) {
            case FingerprintComponent.State.NOT_CONNECTED:
                connectButton.disabled = false;
                break;
            case FingerprintComponent.State.CONNECTING:
                break;
            case FingerprintComponent.State.CONNECTED:
                initializeButton.disabled = false;
                closeButton.disabled = false;
                shutdownServerButton.disabled = false;
                break;
            case FingerprintComponent.State.INITIALIZING_DEVICE:
                break;
            case FingerprintComponent.State.IDLE:
                captureButton.disabled = false;
                closeButton.disabled = false;
                shutdownServerButton.disabled = false;
                break;
            case FingerprintComponent.State.START_SCANNING:
                break;
            case FingerprintComponent.State.SCANNING:
                manualCaptureButton.disabled = false;
                cancelButton.disabled = false;
                shutdownServerButton.disabled = false;
                break;
            case FingerprintComponent.State.CANCELING_SCANNING:
                break;
            case FingerprintComponent.State.START_MANUAL_CAPTURE:
                break;
            case FingerprintComponent.State.MANUAL_CAPTURE:
                break;
            case FingerprintComponent.State.CAPTURING:
                break;
        }
    };

    return {
        init: init,
        setState: setState
    };
})();

//# sourceURL=fingerprint_component.js
