/* Copyright (C) 2017 Aware, Inc - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

"use strict";

/** Class manages sequence checking
 *  @constructor
 */
var SetController = function () {
    var self = this;

    /**  Creates a fingerprint set on the Biocomponents server */
    this.connect = function (transport, config) {
        return new Promise(function (resolve, reject) {
            self.showMessage("Connected");
            /* Create the Fingerprint Set object */
            createFingerprintSet(transport, "FingerprintCaptureFingerprintSet").then(function (instance) {
                self.setService = instance;
                self.showMessage("FingerprintSet created");
                return Promise.all([
                    self.setService.setSequencingMethod(config.sequencingMethod),
                    self.setService.setSequencingCutoff(config.sequencingCutoff),
                    self.setService.setAntiSequencingCutoff(config.antiSequencingCutoff),
                    self.setService.setCaptureSource(FingerprintSetApi.CaptureSource.LIVESCAN)
                ]);
            }).then(function () {
                resolve()
            }).catch(function (error) {
                self.showMessage("FingerprintSet failed to create: " + error.errorMessage);
                reject(error.errorMessage)
            });
        });
    };

    this.reset = function () {
        self.setService.reset();
    };

    /** Sets image data from the client to server and get sequencing errors*/
    this.setImage = function (impression, image, resolution) {
        return self.setService.setImage(impression, image, resolution)
    };

    /** Tells the  FingerprintSet service to pull a fingerprint directly form the fingerprintCapture */
    this.setFingerprintCaptureImage = function (impression, fingerprintCapture) {
        return self.setService.setFingerprintCaptureImage(impression, fingerprintCapture);
    };

    /** Puts image data into the FingerprintSet */
    this.setImage = function (impression, image, resolution) {
        return self.setService.setImage(impression, image, resolution);
    };

    /** Returns a promise that contains the fingerpring sequencing errors for the given impression */
    this.getSequencingErrors = function (impression) {
        return self.setService.getSequencingErrors(impression);
    };

    /**
     * Tells the fingerprint set that a finger is missing
     * @param impression {number} Fingerprint code of the missing finger
     * @param missing {boolean} True if the finger is missing, false if the finger is present
     * @returns {Promise} Returns a promise
     */
    this.setMissing = function (impression, missing) {
        return self.setService.setFingerMissing(impression, missing);
    };

    this.getMinutiaCount = function (impression) {
        return self.setService.getMinutiaCount(impression);
    };

    this.getSegmentationCoordinates = function (impression) {
        return self.setService.getSegmentationCoordinates(impression);
    };

    /*
     * Returns a promise that will resolve with an dict of the impression codes to a dict of the quality scores.
     * The quality score dict will have 'afiq' and 'nfiq' as the keys. Example: {1:{afiq:90, nfiq:5}}
     */
    this.getQuality = function (impression, missing) {
        return new Promise(function (resolve, reject) {
            var impressionToGet = [];

            if (impression <= 10) {
                if (!missing.has(impression))
                    impressionToGet.push(impression);
            }
            else if (impression === 11) {
                if (!missing.has(1))
                    impressionToGet.push(impression);
            }
            else if (impression === 12) {
                if (!missing.has(6))
                    impressionToGet.push(impression);
            }
            else if (impression === 13) {
                if (!missing.has(2)) impressionToGet.push(FingerprintSetApi.Impression.RIGHT_SLAP_INDEX_FINGER);
                if (!missing.has(3)) impressionToGet.push(FingerprintSetApi.Impression.RIGHT_SLAP_MIDDLE_FINGER);
                if (!missing.has(4)) impressionToGet.push(FingerprintSetApi.Impression.RIGHT_SLAP_RING_FINGER);
                if (!missing.has(5)) impressionToGet.push(FingerprintSetApi.Impression.RIGHT_SLAP_LITTLE_FINGER);
            }
            else if (impression === 14) {
                if (!missing.has(10)) impressionToGet.push(FingerprintSetApi.Impression.LEFT_SLAP_LITTLE_FINGER);
                if (!missing.has(9)) impressionToGet.push(FingerprintSetApi.Impression.LEFT_SLAP_RING_FINGER);
                if (!missing.has(8)) impressionToGet.push(FingerprintSetApi.Impression.LEFT_SLAP_MIDDLE_FINGER);
                if (!missing.has(7)) impressionToGet.push(FingerprintSetApi.Impression.LEFT_SLAP_INDEX_FINGER);
            } else if (impression === 15 || impression === FingerprintSetApi.Impression.PLAIN_DUAL_THUMBS) {
                if (!missing.has(6)) impressionToGet.push(FingerprintSetApi.Impression.PLAIN_DUAL_THUMBS_LEFT);
                if (!missing.has(1)) impressionToGet.push(FingerprintSetApi.Impression.PLAIN_DUAL_THUMBS_RIGHT);
            }
            else if (impression >= 80 && impression <= 87) {
                var singleFingerCode = ImpressionInfo[impression].fingersCodes[0];
                if (!missing.has(singleFingerCode))
                    impressionToGet.push(impression);
            }


            var promises = [];
            for (var i = 0; i < impressionToGet.length; i++) {
                const imp = impressionToGet[i];
                promises.push(self.setService.getAfiqScore(imp));
                promises.push(self.setService.getNfiqScore(imp));
            }

            Promise.all(promises).then(function (scores) {
                    var results = {};
                    for (var i = 0; i < impressionToGet.length; i++) {
                        results[impressionToGet[i]] = {
                            "afiq": scores[i * 2],
                            "nfiq": scores[i * 2 + 1]
                        }
                    }
                    resolve(results);
                },
                function (error) {
                    reject(error);
                }
            );
        })
    };

    /** Logs a message */
    this.showMessage = function (message) {
        console.log(message)
    };

};