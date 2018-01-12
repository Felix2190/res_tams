/* Copyright (C) 2017 Aware, Inc - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

"use strict";

var webEnroll = (function () {

    /* Location of the BioComponentServer. If using TLS,
     * use:
     *     "wss://localhost.aware.com:2080"
     */
    var biocomponentServerUrl = "ws://localhost:2080";

    /* Device to use for card scanning. Other values are:
     *   CardScanApi.DeviceId.EPSON_PERF11000XL,
     *   CardScanApi.DeviceId.EPSON_PERFV700,
     *   CardScanApi.DeviceId.EPSON_PERFV800,
     *   CardScanApi.DeviceId.EPSON_PERF4490,
     *   CardScanApi.DeviceId.MEMORY,
     */
    var cardScanDevice = CardScanApi.DeviceId.EPSON_PERFV700;

    /* Device to use for livescan. Other values are:
     *  'CROSSMATCH_GUARDIAN'
     *  'IB_WATSONMINI'
     *  'EXTERNAL'
     *
     *  You can add multiple entries to the array. First device found will be used.
     *  For example:
     *      liveScanDevices = ['CROSSMATCH_GUARDIAN', 'IB_WATSONMINI'];
     */
    var liveScanDevices = ['CROSSMATCH_GUARDIAN', 'IB_WATSONMINI'];

    /* Impression to capture.
     *
     * Example:
     *      collectionSet = [
     *          FingerprintCaptureApi.Impression.PLAIN_LEFT_FOUR_FINGERS,
     *          FingerprintCaptureApi.Impression.PLAIN_RIGHT_FOUR_FINGERS,
     *          FingerprintCaptureApi.Impression.PLAIN_DUAL_THUMBS
     *      ];
     *
     * Predefined arrays can also be used:
     *      CollectionSet.THIRTEEN_SLAP_SET
     *      CollectionSet.FOURTEEN_SLAP_SET
     *      CollectionSet.FOUR_SLAP_SET
     *      CollectionSet.THREE_SLAP_SET
     *      CollectionSet.TEN_FLAT_SET
     *
     * Example:
     *      collectionSet = CollectionSet.TEN_FLAT_SET;
     */
    var collectionSet =  CollectionSet.THREE_SLAP_SET;


    /* Use segmentedImpressions to have single impression images extracted from multi-impression
     * images. For example, to extract 4 fingers into individual records from from a single 4 finger slap
     *
     * The value of segmentedImpressions is an array of dictionaries with a size and impression property.
     * The size property is optional. If omitted, the image size will be the segmented size.
     * If it is set to an array with one numeric value, the image will be that width and height. If two
     * values are used, the first is the width and second is the height. If 4 values are specified the first
     * two are the minimum width and height, and the second two are the max width and height. If the width/height
     * of the image segmentation is not in the range, then they will be cropped/expanded so it is within the range.
     *
     * The example below shows how to extract single finger images out of a 4-4-2 slap collection:
     * 
     * segmentedImpressions = [
     *     {
     *         size:[800],
     *         impressions: [
     *             FingerprintCaptureApi.Impression.RIGHT_SLAP_INDEX_FINGER,
     *             FingerprintCaptureApi.Impression.RIGHT_SLAP_MIDDLE_FINGER,
     *             FingerprintCaptureApi.Impression.RIGHT_SLAP_RING_FINGER,
     *             FingerprintCaptureApi.Impression.RIGHT_SLAP_LITTLE_FINGER,
     *             FingerprintCaptureApi.Impression.LEFT_SLAP_INDEX_FINGER,
     *             FingerprintCaptureApi.Impression.LEFT_SLAP_MIDDLE_FINGER,
     *             FingerprintCaptureApi.Impression.LEFT_SLAP_RING_FINGER,
     *             FingerprintCaptureApi.Impression.LEFT_SLAP_LITTLE_FINGER,
     *             FingerprintCaptureApi.Impression.PLAIN_DUAL_THUMBS_RIGHT,
     *             FingerprintCaptureApi.Impression.PLAIN_DUAL_THUMBS_LEFT
     *         ]
     *     }
     * ];
     */
    var segmentedImpressions = [
        {
            impressions: [
                    FingerprintCaptureApi.Impression.RIGHT_SLAP_INDEX_FINGER,
                    FingerprintCaptureApi.Impression.RIGHT_SLAP_MIDDLE_FINGER,
                    FingerprintCaptureApi.Impression.RIGHT_SLAP_RING_FINGER,
                    FingerprintCaptureApi.Impression.RIGHT_SLAP_LITTLE_FINGER,
                    FingerprintCaptureApi.Impression.LEFT_SLAP_INDEX_FINGER,
                    FingerprintCaptureApi.Impression.LEFT_SLAP_MIDDLE_FINGER,
                    FingerprintCaptureApi.Impression.LEFT_SLAP_RING_FINGER,
                    FingerprintCaptureApi.Impression.LEFT_SLAP_LITTLE_FINGER,
                    FingerprintCaptureApi.Impression.PLAIN_DUAL_THUMBS_RIGHT,
                    FingerprintCaptureApi.Impression.PLAIN_DUAL_THUMBS_LEFT
            ]
        }
    ];

    /* Device to use for face capture. Other values are:
    *   'Logitech HD Pro Webcam C920',
    *   'Logitech QuickCam Pro 9000'
    *
    *  You can add multiple entries to the array. First device found will be used.
    *  For example:
    *      cameraDevices = ['Logitech HD Pro Webcam C920', 'Logitech QuickCam Pro 9000'];
    */
    var cameraDevices = ['Logitech HD Pro Webcam C930'];   

    /* Camera rotation angle for landscape or portrait mode.
     *
     * Available rotation angles in degrees can be used: 0, 90, 180, 270
     *
     * Example:
     *      cameraRotationAngle = 90;
     */
    var cameraRotationAngle = 90;
    
    /* Command format used to print the documents
     *
     * Available command formats are GDI and PCL
     *
     * Example:
     *      printingCommandFormat = PrintingComponentApi.OutputFormat.GDI;
     * or
     *      printingCommandFormat = PrintingComponentApi.OutputFormat.PCL;   
     */
    var printingCommandFormat = PrintingComponentApi.OutputFormat.GDI;


    /* Value to use for the SRC Source Agency value */
    var sourceAgency = "Some agency source value...";

    //pub is public object - returned at end of module, so each component can access to its functions.
    var pub = {};

    var printers = [];

    // 0: bio, 1: finger live scan, 2: card scan, 3: photo, 4: review
    pub.pageIndex = 0;
    // 0: bio, 1: finger, 2: photo, 3: review
    pub.listIndex = 0;

    // Keep previous card scan data when clicking button 'use card scan', if editing is true
    // otherwise, clean all the previous data when entering card scan page
    pub.editing = false;

    // Enrollment type, either new enrollment or retrieved enrollment
    pub.isRetrievedEnroll = false;

    // set page number color to in progress or success
    pub.setColor = function (status) {
        var number = $('li.list-group-item').eq(pub.listIndex).find('span:first');
        var lastClass = number.attr('class').split(' ').pop();
        number.removeClass(lastClass);
        number.addClass(status);
    };

    // Each component has its own "save and continue" button.
    // When clicking save button on each page, it will save data and move to next page.
    // These save buttons share similar code/function like update page title, update list number color etc,
    // so we create this function 'moveToNextPage' as below.
    // If it comes to bio/finger/face page from review page by clicking 'edit',
    // it should go back to review page by clicking "save and continue" button in that page
    pub.moveToNextPage = function () {
        var pages;
        if (pub.listIndex <= 2) {
            // Change current page number to success
            pub.setColor('badge-success');

            // Move to next page or review page and update list number
            if (pub.editing) {
                pub.listIndex = 3;
                pub.pageIndex = 4;
                pub.editing = false;

                // Change new page number color to in progress
                pub.setColor('badge-progress');

                // Display review page
                pages = $('#allPages > section');
                pages.eq(pub.pageIndex).show();
                pages.not(pages.eq(pub.pageIndex)).hide();

                pub.updateBioSets();
                pub.updateReviewPage();

                return;
            } else {
                if (pub.listIndex === 1) {
                    pub.pageIndex = 3;
                } else {
                    pub.pageIndex++;
                }
                pub.listIndex++;
            }
        } else {
            // Move to the first page
            pub.listIndex = 0;
            pub.pageIndex = 0;

            // Reset other pages number to disable
            var number = $('li.list-group-item:gt(0)').find('span:first');
            var lastClass = number.attr('class').split(' ').pop();
            number.removeClass(lastClass);
            number.addClass('badge-disable');

            // Reset image to empty for photo capture page
            $("#photoCameraDisplay").attr("src", "//:0");

            // Reset the other components
            pub.reset();
        }

        // Change new page number color to in progress
        pub.setColor('badge-progress');

        // Update page
        pages = $('#allPages > section');
        pages.eq(pub.pageIndex).show();
        pages.not(pages.eq(pub.pageIndex)).hide();

        if (pub.pageIndex === 0 && pub.isRetrievedEnroll) {
            $('#loadTransactionPanel').show();
        }
        else {
            $('#loadTransactionPanel').hide();
        }

        if (pub.pageIndex === 1) {
            Biographics.collectEntries();
            FingerprintComponent.activate();
        }

        if (pub.listIndex === 2) {
            PhotoComponent.activate();
        }

        if (pub.listIndex === 3) {
            // Update bio set and review page
            pub.updateBioSets();
            pub.updateReviewPage();
            pub.populatePrinters();
        }
        window.scrollTo(0,0);
    };
    
    /**
     * Tell components to clear their stored data
     */
    pub.reset = function () {
        // Perhaps put these into a configurable array?
        Biographics.reset();
        FingerprintComponent.reset();
        CardScanComponent.reset();
        PhotoComponent.reset();
        NistComponent.reset();
        PrintingComponent.reset();
    };

    /**
     * Called when the user wants to exit the current enrollment
     */
    pub.exitEnrollment = function () {
        $('#welcomeContainer').show();
        $('#startEnrollment').show();
        $('#enrollmentCompleted').hide();
        $('#enrollContainer').hide();
        // Set page index high so we loop around to the start
        pub.listIndex = 100;
        pub.moveToNextPage();
    };

    pub.completeEnrollment = function (enrollee) {
        var enrollInfo = '<span>' + "Enrollee: " + enrollee + ' has been successfully enrolled.' + '</span>';
        $('#enrolledSuccessfully').html(enrollInfo);

        $('#welcomeContainer').show();
        $('#enrollmentCompleted').show();
        $('#startEnrollment').hide();
        $('#enrollContainer').hide();
        // Set page index high so we loop around to the start
        pub.listIndex = 100;
        pub.moveToNextPage();
    };

    /**
     *  Pulls the captured images from the components and puts them on the display page
     */
    pub.updateReviewPage = function () {
        var $plains = $(".review-page__plains");
        var $right = $(".review-page__right-prints");
        var $left = $(".review-page__left-prints");

        $plains.empty();
        $right.empty();
        $left.empty();

        var captureList;
        var liveScan;
        if ($('.review__fingerprint-source--livescan').is(':checked')) {
            captureList = FingerprintComponent.getCaptureList();
            liveScan = true;
        }
        else {
            captureList = CardScanComponent.getCaptureList();
            liveScan = false;
        }

        for (var i = 0; i < captureList.length; i++) {
            var capture = captureList[i];
            var name = ImpressionInfo[capture.impression].name;
            var $entry = $("<li></li>");

            var $link = $("<a class='review__thumbnail'></a>");
            $entry.append($link);

            if ((liveScan && (capture.captureStatus === FingerprintComponent.CaptureStatus.CAPTURED)) ||
                (!liveScan && (capture.scanStatus === CardScanComponent.ScanStatus.SCANNED))) {
                var $image = $("<img class='review__thumbnail-image'>");
                $image.attr("src", "data:image/jpg;base64," + capture.imageData);
                $link.append($image);
            }

            var $textArea = $("<span style='display:inline-block'></span>");
            $link.append($textArea);

            var $title = $("<span class='review__thumbnail-title'>" + name + "</span>");
            $textArea.append($title);

            var $scores = $("<span class='review__thumbnail-scores'></span>");
            $.each(capture.nfiq, function (index, score) {
                $scores.append($("<span class='review__score'>" + score + "</span>"))
            });
            $.each(capture.afiq, function (index, score) {
                $scores.append($("<span class='review__score'>" + score + "</span>"))
            });

            if (capture.nfiq.length === 0 && capture.afiq.length === 0)
                $scores.append("-");

            $textArea.append($scores);

            if (liveScan && capture.captureStatus !== FingerprintComponent.CaptureStatus.CAPTURED) {
                $textArea.append("<span>" + capture.captureStatus + "</span>");
            } else if (!liveScan && capture.scanStatus !== CardScanComponent.ScanStatus.SCANNED) {
                $textArea.append("<span>" + capture.scanStatus + "</span>");
            }

            if (capture.impression <= 5) {
                $right.append($entry)
            }
            else if (capture.impression <= 10) {
                $left.append($entry)
            }
            else {
                $plains.append($entry)
            }
        }

        // Display the construct image from Face Capture component
        var img = PhotoComponent.getConstructImg();
        if (img != null) {
            $("#reviewFaceDisplay").attr("src", "data:image/jpg;base64," + img);
        } else {
            $("#reviewFaceDisplay").attr("src", "//:0");
        }

        var biographics = Biographics.getBiographicData();
        $.each(biographics, function (entry, data) {
            $('.biographicReview').append("<span>" + entry + ": " + data + "</span>");
        });


        NistComponent.displayStatus("clear");
        updateBiograhicReview();
    };

    /**
     * Update biographic review section.
     *
     */
    var updateBiograhicReview = function () {
        var biographicText = Biographics.getBiographicText();

        // get elements
        var $review_name = $("#biographicReview #name");
        var $review_born = $("#biographicReview #born");
        var $review_app1 = $("#biographicReview #app1");
        var $review_app2 = $("#biographicReview #app2");
        var $review_addi = $("#biographicReview #addi");

        // formatting display of race, height and ssn entries
        var race = biographicText["T2_RAC"];
        race = race.split('-')[0];
        var height = biographicText["T2_HGT"];
        height = height.substring(0, 1) + "'" + height.substring(1, 2) + '"';
        var ssn = biographicText["T2_SOC"];
        if (ssn !== "") {
            var lastFour = ssn.substring(ssn.length - 4);
            ssn = "SSN: XXX-XX-" + lastFour;
        }


        var name = biographicText["T2_NAM"];

        var born = "Born: " +
            biographicText["T2_POB"] + "    " +
            biographicText["T2_DOB"];

        var app1 = race + "    " +
            biographicText["T2_SEX"] + "    " +
            height + "    " +
            biographicText["T2_WGT"] + " lbs";

        var app2 = biographicText["T2_HAI"] + " Hair,  " +
            biographicText["T2_EYE"] + " Eyes";

        var addi = ssn;

        $review_name.text(name);
        $review_born.text(born);
        $review_app1.text(app1);
        $review_app2.text(app2);
        $review_addi.text(addi);
    };

    /**
     * Updates models holding biometric data for nist component
     */
    pub.updateBioSets = function () {
        var biographicData = Biographics.getBiographicData();
        var lsFpSet = FingerprintComponent.getFingerprintSet();
        var csFpSet = CardScanComponent.getFingerprintSet();
        var ptSet = PhotoComponent.getPhotoSet();
        NistComponent.setBiographicData(biographicData);
        NistComponent.setLiveScanFpSet(lsFpSet);
        NistComponent.setCardScanFpSet(csFpSet);
        NistComponent.setPtSet(ptSet);
    };

    /**
     * Populate available printer list
     *
     */ 
    pub.populatePrinters = function() {
        if (printers.length == 0) {
            printers = PrintingComponent.getPrinterList();
            console.log("Prints are " + printers);
            var selector = $("select[id='printers']");
            $(printers).each(function(i, printer) {
                selector.append($("<option>", { 
                    value: printer,
                    html: printer
                }));
            });
        }
    };
    
    /**
     * Reset everything needed to start enrollment
     */
    pub.startEnrollment = function (mode) {
        $('#welcomeContainer').hide();
        $('#enrollContainer').show();
        Biographics.setMode(mode);
        switch (mode) {
            case "new":
                $('#loadTransactionPanel').hide();
                pub.isRetrievedEnroll = false;
                break;
            case "retrieval":
                $('#loadTransactionPanel').show();
                pub.isRetrievedEnroll = true;
                break;
        }
    };

    /**
     * Load transaction
     */
    pub.loadTransaction = function (buffer) {
        // Get data object from each component / screen
        var biographicData = Biographics.getBiographicData();
        var lsFpSet = FingerprintComponent.getFingerprintSet().fingerprintSet;
        //var csFpSet = CardScanComponent.getFingerprintSet();
        var ptSet = PhotoComponent.getPhotoSet();

        NistComponent.readTransaction(buffer, biographicData, lsFpSet, ptSet).then(function () {
            // Start enrollment on loaded transaction.
            console.log("Reading transaction successfully.");
            Biographics.setRetrievalStatus(true);
            FingerprintComponent.setRetrievalStatus(true);
            CardScanComponent.setRetrievalStatus(true);
            PhotoComponent.setRetrievalStatus(true);
        }).catch(function (e) {
            console.log("Error reading transaction." + e);
        });
    };


    pub.createBiographics = function (transport) {
        //Load all the pages, and show the first page
        $('#biographicPage').load('NistComponent/biographic_info.html', function () {
            $('#biographicPage').show();
            Biographics.init({
                transport: transport,
                sourceAgency: sourceAgency,
                // Set value to true to get auto-fill button on Biographics page
                debug: true
            });
        });
    };

    pub.createFingerprint = function (transport) {
        $('#fingerprintPage').load('FingerprintComponent/fingerprint_component.html', function () {
            $('#fingerprintPage').hide();

            FingerprintComponent.init({
                transport: transport,
                collectionSet: collectionSet,
                deviceList: liveScanDevices,

                nfiqGoodCutoff: 2,
                nfiqMarginalCutoff: 4,
                autocaptureConfigurationFile: "FingerprintComponent/config/single_finger_autocapture_configuration.xml",

                // If true, you can navigate off fingerprint component even if the collection isn't complete
                allowIncompleteCollection: true,

                // Navigation callbacks
                cancelCallback: webEnroll.exitEnrollment,
                completedCallback: webEnroll.moveToNextPage,

                // Other settings:
                // qualityCutoffAlgorithm: "NFIQ",
                // afiqGoodCutoff: 95,
                // afiqMarginalCutoff: 90,
                // enableAudio: true,
                // numberOfRetries : 3,
                // noSaveUponRetry: true

                hideCardScanButton: false
            });

            $(document).on('click', '#useCardScannerButton', function () {
                $('#fingerprintPage').hide();
                $('#cardscanPage').show();
                pub.pageIndex = 2;
                CardScanComponent.activate(pub.editing);
            });
        });
    };

    pub.createScan = function (transport) {
        $('#cardscanPage').load('CardScanComponent/cardscan_component.html', function () {
            $('#cardscanPage').hide();
            CardScanComponent.init({

                deviceEnum: cardScanDevice,

                //collectionSet: CardScanCollectionSet.THIRTEEN_SLAP_SET,
                collectionSet: CardScanCollectionSet.FOURTEEN_SLAP_SET,

                // By default (which is false), allow to mark missing fingers 1 to 10 only, not image.
                // Image will be affected by fingers, e.g. dual thumbs image should not be in record if both thumbs 1 and 6 are marked as missing.
                // When set to true, allow to mark missing image, and image and fingers are independent.
                //markMissingImage: true,

                // CardScanComponent/FD249.xml is the template for CardScanCollectionSet.FOURTEEN_SLAP_SET
                // CardScanComponent/FD249_DualThumbs.xml is the template for CardScanCollectionSet.THIRTEEN_SLAP_SET
                // By default, the proper template file will be selected automatically based on which slap set you use
                // If you want to put template somewhere else, rather than "CardScanComponent/", you need to set it explicitly as below for FOURTEEN_SLAP_SET
                // scanTemplate: "My_Direction/FD249.xml",
                // or as this for THIRTEEN_SLAP_SET
                // scanTemplate: "My_Direction/FD249_DualThumbs.xml",

                // Function to call if the user wants to exit the fingerprint scan page
                cancelCallback: webEnroll.exitEnrollment,

                // Function to call when the user is done with fingerprint enrollment
                completedCallback: webEnroll.moveToNextPage,

                // Functions to call when scanning started, completed, cancelled, or error occurred.
                //scanStartCallback : function(){},
                //scanCompleteCallback : function(){},
                //scanCancelCallback : function(){},
                //scanErrorCallback: function(){},

                // Object used to send message to the server
                transport: transport,
                afiqGoodCutoff: 30,
                afiqMarginalCutoff: 20,
                nfiqGoodCutoff: 3,
                nfiqMarginalCutoff: 4
                // Show debugging info:
                //debug: true,
            });

            $(document).on('click', '.card-scan--useLiveScanner', function () {
                $('#cardscanPage').hide();
                $('#fingerprintPage').show();
                pub.pageIndex = 1;
            });
        });
    };

    pub.createPhoto = function (transport) {
        $('#photoPage').load('PhotoComponent/photo_component.html', function () {
            $('#photoPage').hide();
            PhotoComponent.init({

                deviceList: cameraDevices,

                cameraRotationAngle: cameraRotationAngle,

                // Function to call if the user wants to exit the photo page
                cancelCallback: webEnroll.exitEnrollment,

                // Object used to send message to the server
                transport: transport,

                // Function to call when the user is done with photo enrollment
                completedCallback: webEnroll.moveToNextPage,
            });
        });
    };

    pub.createPrint = function (transport) {
        PrintingComponent.init({
            transport: transport,
            commandFormat: printingCommandFormat
        });
    };
    
    function init()
    {
        var webSocket = new WebSocket(biocomponentServerUrl);
        var connectingToWebsocket = true;

        webSocket.onclose = function(event){
            if (connectingToWebsocket) {
                $(".webenroll-alert__open-failure-text").text("Could not connect to BioComponentServer at " + biocomponentServerUrl);
                $(".webenroll-alert__open-failure").show();
            } else {
                $(".webenroll-alert__connection-lost-text").text("Connection to the BioComponentServer has " +
                    "unexpectedly closed.");
                $(".webenroll-alert__connection-lost").show();
            }
        };
        webSocket.onopen = function (event) {
            connectingToWebsocket = false;
            var transport = createWebsocketTransport(webSocket);

            var bcs = createBiocomponentServer(transport, "BCS");
            bcs.getVersion().then(function(version){
                console.log("BioComponentServer Version: " + version);
            });
            bcs.getPluginList().then(function(pluginList){
                console.log("Loaded plugins: " + pluginList);
            });

            pub.createBiographics(transport);
            pub.createScan(transport);
            pub.createPhoto(transport);
            pub.createFingerprint(transport);
            pub.createPrint(transport);
            
            // To put FingerprintComponent on own websocket, disable line above and do:
            //
            //var webSocketFp = new WebSocket(bioComponentServerUrl);
            //webSocketFp.onopen = function (event) {
            //    var transportFp = createWebsocketTransport(webSocketFp);
            //    pub.createFingerprint(transportFp);
            //};

            $('#reviewPage').load('URCWeb/review.html', function () {
                var progressDlg = $('#progressDialog');
                
                $('#reviewPage').hide();
                NistComponent.init({
                    transport: transport,
                    segmentedImpressions: segmentedImpressions,
                    sourceAgency:sourceAgency
                });
                
                $('#printButton').click(function () {
                    var printer = $("#printers option:selected").text();
                    
                    NistComponent.createTransaction().then(function () {
                        PrintingComponent.print(NistComponent.getObject(), printer);
                    }).catch(function (error) {
                        console.log("Error to create transaction " + error);
                    });
                });
                
                $('#getPrintPreviewButton').click(function() {
                    console.log("Showing print preview.");
                    var dlg = $('#printPreviewDialog');
                    progressDlg.modal('show');
                    
                    NistComponent.createTransaction().then(function () {
                        return PrintingComponent.getPreviewImages(NistComponent.getObject());
                    }).then(function (imageData) {
                        progressDlg.modal('hide');
                        
                        var $frontImage = $("#preview_front_image");
                        $frontImage.attr("src", "data:image/jpg;base64," + imageData[0]);

                        var $backImage = $("#preview_back_image");
                        $backImage.attr("src", "data:image/jpg;base64," + imageData[1]);
                        
                        dlg.modal('show');                      
                    }).catch(function (error) {
                        console.log("Error to show print preview." + error);
                        progressDlg.modal('hide');                      
                    });
                });
                
                $('#previewCloseButton').click(function() {
                    console.log("Close print preview dialog");
                    var dlg = $('#printPreviewDialog');
                    dlg.modal('hide');
                });
                
                $('.review__fingerprint-source').click(function () {
                    pub.updateReviewPage();
                });
            });

            $('#newEnrollmentButton').click(function () {
                pub.startEnrollment("new");
            });

            $('#reEnrollmentButton').click(function () {
                pub.startEnrollment("retrieval");
            });

            $('#navbar-main').click(function () {
                pub.exitEnrollment();
            });

            $('#loadTransactionButton').change(function (e) {
                var file = e.target.files[0];
                var reader = new FileReader();
                reader.onload = function (e) {
                    const parts = reader.result.split(',', 2);
                    pub.loadTransaction(parts[1]);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    $('.webenroll__open-failure-reopen').on('click', function () {
        $('.webenroll-alert__open-failure').hide();
        init();
    });

    $('.webenroll__connection-lost-restart').on('click', function () {
        window.location.reload(false);
    });

    $(document).ready(function () {
        $('#welcomeContainer').show();
        $('#enrollmentCompleted').hide();
        $('#enrollContainer').hide();

        init();

    });
    return pub;
}());

//# sourceURL=urc_web.js
