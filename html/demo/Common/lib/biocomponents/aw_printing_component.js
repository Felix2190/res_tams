/* Copyright (C) 2017 Aware, Inc - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
 
/** @namespace
  */
var PrintingComponentApi =
{
    /** Printing Output format
     *  @enum {number} */
    OutputFormat : 
    (function()
    {
        var values = {};
        /** GDI format */
        values[values.GDI = 1] = "GDI";

        /** PCL format */
        values[values.PCL = 2] = "PCL";

        /** PostScript format */
        values[values.PS = 3] = "PS";

        return values;
    })(),

    /** Image format
     *  @enum {number} */
    ImageFormat : 
    (function()
    {
        var values = {};
        /** RAW format */
        values[values.RAW = 1] = "RAW";

        /** BMP format */
        values[values.BMP = 2] = "BMP";

        /** WSQ format */
        values[values.WSQ = 3] = "WSQ";

        /** JPEG format */
        values[values.JPG = 5] = "JPG";

        /** PNG format */
        values[values.PNG = 7] = "PNG";

        return values;
    })(),

    /** Sharpening value
     *  @enum {number} */
    Sharpening : 
    (function()
    {
        var values = {};
        /** Sharpening is disabled */
        values[values.OFF = 0] = "OFF";

        /** Light sharpening */
        values[values.LIGHT = 1] = "LIGHT";

        /** Medium sharpening */
        values[values.MEDIUM = 2] = "MEDIUM";

        return values;
    })(),

    /** Dithering value
     *  @enum {number} */
    Dithering : 
    (function()
    {
        var values = {};
        /** Accurpint Dither is enabled */
        values[values.DITHER_ON = 0] = "DITHER_ON";

        /** Accurpint Dither is disabled */
        values[values.DITHER_OFF = 1] = "DITHER_OFF";

        return values;
    })(),

    /** Paper Size
     *  @enum {number} */
    PaperSize : 
    (function()
    {
        var values = {};
        /** Executive paper size */
        values[values.EXECUTIVE = 1] = "EXECUTIVE";

        /** Letter paper size */
        values[values.LETTER = 2] = "LETTER";

        /** Legal paper size */
        values[values.LEGAL = 3] = "LEGAL";

        /** B5 paper size */
        values[values.B5_PAPER = 12] = "B5_PAPER";

        /** A4 paper size */
        values[values.A4_PAPER = 26] = "A4_PAPER";

        /** A5 paper size */
        values[values.A5_PAPER = 13] = "A5_PAPER";

        /** Monarch 734 paper size */
        values[values.MONARCH_734 = 80] = "MONARCH_734";

        /** COM 10 paper size */
        values[values.COM_10 = 81] = "COM_10";

        /** COM 9 paper size */
        values[values.COM_9 = 89] = "COM_9";

        /** DL paper size */
        values[values.DL = 90] = "DL";

        /** C5 paper size */
        values[values.C5 = 91] = "C5";

        /** B5 Envelope paper size */
        values[values.B5_ENV = 99] = "B5_ENV";

        /** Custom paper size */
        values[values.CUSTOM = 101] = "CUSTOM";

        /** Other paper size */
        values[values.OTHER_ENV = 600] = "OTHER_ENV";

        /** Executive Aux Paper Size */
        values[values.EXECUTIVE_AUX_FEEDER = 601] = "EXECUTIVE_AUX_FEEDER";

        /** Letter Paper Aux Feeder Paper Size */
        values[values.LETTER_PAPER_AUX_FEEDER = 602] = "LETTER_PAPER_AUX_FEEDER";

        /** Legal Paper Aux Feeder Paper Size */
        values[values.LEGAL_PAPER_AUX_FEEDER = 603] = "LEGAL_PAPER_AUX_FEEDER";

        /** B5 Paper Aux Feeder Paper Size */
        values[values.B5_PAPER_AUX_FEEDER = 612] = "B5_PAPER_AUX_FEEDER";

        /** A5 Paper Aux Feeder Paper Size */
        values[values.A5_PAPER_AUX_FEEDER = 613] = "A5_PAPER_AUX_FEEDER";

        /** A4 Paper Aux Feeder Paper Size */
        values[values.A4_PAPER_AUX_FEEDER = 626] = "A4_PAPER_AUX_FEEDER";

        return values;
    })(),

    /** Paper Tray
     *  @enum {number} */
    PaperTray : 
    (function()
    {
        var values = {};
        /** Primary feed */
        values[values.PRIMARY_FEED = 1] = "PRIMARY_FEED";

        /** Manual feed */
        values[values.MANUAL_FEED = 2] = "MANUAL_FEED";

        /** Manual feed envelope */
        values[values.MANUAL_ENV = 3] = "MANUAL_ENV";

        /** Paper Tray 2 */
        values[values.TRAY_2 = 4] = "TRAY_2";

        /** Paper Tray 3 */
        values[values.TRAY_3 = 5] = "TRAY_3";

        /** Paper Feeder 1 */
        values[values.FEEDER_1 = 6] = "FEEDER_1";

        /** Auto Select */
        values[values.AUTO_SELECT = 7] = "AUTO_SELECT";

        /** Multipurpose Feeder */
        values[values.MP_FEEDER = 8] = "MP_FEEDER";

        /** Paper Tray 4 */
        values[values.TRAY_4 = 20] = "TRAY_4";

        /** Paper Tray 5 */
        values[values.TRAY_5 = 21] = "TRAY_5";

        /** Paper Feeder 2 */
        values[values.FEEDER_2 = 62] = "FEEDER_2";

        return values;
    })(),

    /** Orientation value
     *  @enum {number} */
    Orientation : 
    (function()
    {
        var values = {};
        /** Portrait Orientation */
        values[values.PORTRAIT = 0] = "PORTRAIT";

        /** Landscape Orientation */
        values[values.LANDSCAPE = 1] = "LANDSCAPE";

        /** Reversed Portrait Orientation */
        values[values.REV_PORTRAIT = 2] = "REV_PORTRAIT";

        /** Reversed Landscape Orientation */
        values[values.REV_LANDSCAPE = 3] = "REV_LANDSCAPE";

        return values;
    })(),

    /** Duplexing value value
     *  @enum {number} */
    Duplex : 
    (function()
    {
        var values = {};
        /** Single sided */
        values[values.SINGLE_SIDED = 0] = "SINGLE_SIDED";

        /** Duplex on long edge */
        values[values.DUPLEX_LONG_EDGE = 1] = "DUPLEX_LONG_EDGE";

        /** Duplex on short edge */
        values[values.DUPLEX_SHORT_EDGE = 2] = "DUPLEX_SHORT_EDGE";

        return values;
    })(),


    /** List of error codes.
     *  @enum {number} */
    ErrorCode : 
    (function()
    {
        var values = {};
        /** No errors or warnings. */
        values[values.NO_ERRORS = 0] = "NO_ERRORS";

        /** Unidentified error. */
        values[values.UNIDENTIFIED_ERROR = 1] = "UNIDENTIFIED_ERROR";

        /** The library failed to allocate memory. */
        values[values.OUT_OF_MEMORY = 100] = "OUT_OF_MEMORY";

        /** The printing_component object was NULL. */
        values[values.NULL_PRINTING_COMPONENT_OBJ = 101] = "NULL_PRINTING_COMPONENT_OBJ";

        /** Invalid image format. */
        values[values.INVALID_IMAGE_FORMAT = 102] = "INVALID_IMAGE_FORMAT";

        /** A parameter value is invalid or out of range. */
        values[values.INVALID_PARAMETER_VALUE = 103] = "INVALID_PARAMETER_VALUE";

        /** Invalid output format. */
        values[values.INVALID_OUTPUT_FORMAT = 104] = "INVALID_OUTPUT_FORMAT";

        /** Failed to set transaction. */
        values[values.FAILED_TO_SET_TRANSACTION = 150] = "FAILED_TO_SET_TRANSACTION";

        /** Failed to set verification. */
        values[values.FAILED_TO_SET_VERIFICATION = 151] = "FAILED_TO_SET_VERIFICATION";

        /** Transaction is not loaded. */
        values[values.TRANSACTION_NOT_LOADED = 200] = "TRANSACTION_NOT_LOADED";

        /** Verification is not loaded. */
        values[values.VERIFICATION_NOT_LOADED = 201] = "VERIFICATION_NOT_LOADED";

        /** Unsupported image format. */
        values[values.UNSUPPORTED_IMAGE_FORMAT = 202] = "UNSUPPORTED_IMAGE_FORMAT";

        /** Specified mnemonic was not found. */
        values[values.MNEMONIC_NOT_FOUND = 203] = "MNEMONIC_NOT_FOUND";

        /** Invalid operation. */
        values[values.INVALID_OPERATION = 204] = "INVALID_OPERATION";

        /** Invalid layout command. */
        values[values.INVALID_LAYOUT_COMMAND = 205] = "INVALID_LAYOUT_COMMAND";

        /** Invalid rotation value. */
        values[values.INVALID_ROTATION_VALUE = 206] = "INVALID_ROTATION_VALUE";

        /** Invalid option. */
        values[values.INVALID_OPTION = 207] = "INVALID_OPTION";

        /** Invalid option value. */
        values[values.INVALID_OPTION_VALUE = 208] = "INVALID_OPTION_VALUE";

        /** Print document has not started. */
        values[values.DOCUMENT_NOT_BEGUN = 209] = "DOCUMENT_NOT_BEGUN";

        /** Print document has not done. */
        values[values.DOCUMENT_NOT_DONE = 210] = "DOCUMENT_NOT_DONE";

        /** Barcode format is not supported. */
        values[values.UNSUPPORTED_BARCODE_FORMAT = 211] = "UNSUPPORTED_BARCODE_FORMAT";

        /** Invalid resolution specified. */
        values[values.INVALID_RESOLUTION = 212] = "INVALID_RESOLUTION";

        /** The Nist Component library was not found and is unavailable. */
        values[values.NIST_COMPONENT_NOT_AVAILABLE = 213] = "NIST_COMPONENT_NOT_AVAILABLE";

        /** Failed to parse the JSON request. */
        values[values.FAILED_TO_PARSE_JSON = 10001] = "FAILED_TO_PARSE_JSON";

        /** The function name was not valid. */
        values[values.INVALID_FUNCTION_NAME = 10002] = "INVALID_FUNCTION_NAME";

        /** The parameter list must be a JSON array. */
        values[values.INVALID_PARAMETER_LIST = 10003] = "INVALID_PARAMETER_LIST";

        /** A parameter had an incorrect type. */
        values[values.INVALID_PARAMETER_TYPE = 10004] = "INVALID_PARAMETER_TYPE";

        /** The wrong number of parameters were passed to the function. */
        values[values.INCORRECT_PARAMETER_COUNT = 10005] = "INCORRECT_PARAMETER_COUNT";

        /** The channel name is incorrect, hasn't been opened, or is closed. */
        values[values.INVALID_CHANNEL_NAME = 10006] = "INVALID_CHANNEL_NAME";

        return values;
    })(),


};

/** Creates an object that implements the PrintingComponent API.
  *
  * @param websocketHandle - Handle to an open websocket connection, connected
  *      to the aw_bio_component_server. The caller is responsible for handling
  *      the "onerror" callback, whereas this class will handle the "onmessage"
  *      callback.
  *
  * @return Object that implements the PrintingComponent API.
  */
var createPrintingComponent = (function( transportObject, channelName )
{
    var callbacks = {};
    var onReturnDictionary = {};
    var currentMessageId = 0;
    var transport = transportObject;
    var channel = channelName;

    var onMessage = function( result )
    {
        var functionName = result.function;
        var isCallback = false;

        if ( !isCallback )
        {
            var messageId = result.message_id;
            if( !messageId ) return;
            var onReturn = onReturnDictionary[messageId.toString()];
            delete onReturnDictionary[messageId.toString()];
            if ( typeof onReturn == "function" )
            {
                onReturn(
                    result.return_value,
                    result.error.code,
                    result.error.message );
            }
        }
    };

    // Register the channel name with transport so we will receive messages from the server
    transport.register(channel, onMessage);

    var internalStoreOnReturn = function( onReturn )
    {
        if ( currentMessageId >= Number.MAX_SAFE_INTEGER )
        {
            currentMessageId = 0;
        }
        else
        {
            currentMessageId += 1;
        }
        onReturnDictionary[currentMessageId.toString()] = onReturn;
    };


    /** This function destroys the PrintingComponent object.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var destroy = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_destroy";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };

    /** Get print list.
     *  
     *  @returns {Promise<Object,Error>} A list of available printers.
     *   */
    var getPrinterList = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_get_printer_list";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };

    /** Set transaction.
     *  @param {String} transaction Buffer containing transaction data.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var setTransaction = function( transaction )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_set_transaction";
            jsonNode.args = [ transaction ];
            transport.send( jsonNode );
        } );
    };

    /** Set transaction.
     *  @param {String} nistComponent Buffer containing transaction data.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var setTransactionFromNistComponent = function( nistComponent )
    {
        nistComponent = nistComponent.channel;
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_set_transaction_from_nist_component";
            jsonNode.args = [ nistComponent ];
            transport.send( jsonNode );
        } );
    };

    /** Set verification.
     *  @param {String} verification Buffer containing verification data.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var setVerification = function( verification )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_set_verification";
            jsonNode.args = [ verification ];
            transport.send( jsonNode );
        } );
    };

    /** Set verification from file.
     *  @param {String} filename Filename of verification file.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var readVerification = function( filename )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_read_verification";
            jsonNode.args = [ filename ];
            transport.send( jsonNode );
        } );
    };

    /** Sets a layout file.
     *  @param {String} layoutFile Buffer containing layout data.
     *  
     *  @returns {Promise<Number,Error>} Index used to reference the layout
     *  file.
     *   */
    var setLayoutFile = function( layoutFile )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_set_layout_file";
            jsonNode.args = [ layoutFile ];
            transport.send( jsonNode );
        } );
    };

    /** Reads a layout from disk and stores it .
     *  @param {String} filename Filename of layout file.
     *  
     *  @returns {Promise<Number,Error>} Index used to reference the layout
     *  file.
     *   */
    var readLayoutFile = function( filename )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_read_layout_file";
            jsonNode.args = [ filename ];
            transport.send( jsonNode );
        } );
    };

    /** Set paper options.
     *  @param {Number} paperSize Paper size.
     *  @param {Number} orientation Orientation.
     *  @param {Number} duplex Duplex.
     *  @param {Number} tray Tray.
     *  @param {Number} copies Copies.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var setPaperOptions = function( paperSize, orientation, duplex, tray, copies )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_set_paper_options";
            jsonNode.args = [ paperSize, orientation, duplex, tray, copies ];
            transport.send( jsonNode );
        } );
    };

    /** Set levels.
     *  @param {Number} pBlack Black.
     *  @param {Number} pWhite White.
     *  @param {Number} gamma Gamma.
     *  @param {Number} sharpening Sharpening.
     *  @param {Number} inputDpi Input dpi
     *  @param {Number} outputDpi Output dpi.
     *  @param {Number} disableDithering Disable dithering.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var setLevels = function( pBlack, pWhite, gamma, sharpening, inputDpi, outputDpi, disableDithering )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_set_levels";
            jsonNode.args = [ pBlack, pWhite, gamma, sharpening, inputDpi, outputDpi, disableDithering ];
            transport.send( jsonNode );
        } );
    };

    /** Doc begin printing.
     *  @param {Number} width Width.
     *  @param {Number} height Height.
     *  @param {Number} outputFormat Output format.
     *  @param {String} printerPath Printer path.
     *  @param {String} jobName Job name.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var docBeginPrinting = function( width, height, outputFormat, printerPath, jobName )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_doc_begin_printing";
            jsonNode.args = [ width, height, outputFormat, printerPath, jobName ];
            transport.send( jsonNode );
        } );
    };

    /** Doc begin image.
     *  @param {Number} width Width.
     *  @param {Number} height Height.
     *  @param {Number} outputDpi Output dpi.
     *  @param {Number} format Image format
     *  
     *  @returns {Promise<,Error>}
     *   */
    var docBeginImage = function( width, height, outputDpi, format )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_doc_begin_image";
            jsonNode.args = [ width, height, outputDpi, format ];
            transport.send( jsonNode );
        } );
    };

    /** Doc set mnemonic text.
     *  @param {String} mnemonic Mnemonic
     *  @param {Number} occurence Occurence.
     *  @param {String} text Text.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var docSetMnemonicText = function( mnemonic, occurence, text )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_doc_set_mnemonic_text";
            jsonNode.args = [ mnemonic, occurence, text ];
            transport.send( jsonNode );
        } );
    };

    /** Doc set mnemonic barcode.
     *  @param {String} mnemonic Mnemonic
     *  @param {Number} occurence Occurence.
     *  @param {String} text Text.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var docSetMnemonicBarcode = function( mnemonic, occurence, text )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_doc_set_mnemonic_barcode";
            jsonNode.args = [ mnemonic, occurence, text ];
            transport.send( jsonNode );
        } );
    };

    /** Doc set mnemonic barcode image.
     *  @param {String} mnemonic Mnemonic
     *  @param {Number} occurence Occurence.
     *  @param {String} imageBuffer Barcode image buffer.
     *  @param {Number} encodingMode Encoding mode.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var docSetMnemonicBarcodeImage = function( mnemonic, occurence, imageBuffer, encodingMode )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_doc_set_mnemonic_barcode_image";
            jsonNode.args = [ mnemonic, occurence, imageBuffer, encodingMode ];
            transport.send( jsonNode );
        } );
    };

    /** Doc print page.
     *  @param {Number} index Page index.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var docRenderLayout = function( index )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_doc_render_layout";
            jsonNode.args = [ index ];
            transport.send( jsonNode );
        } );
    };

    /** Doc print next page.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var docNextPage = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_doc_next_page";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };

    /** Get preview doc image.
     *  
     *  @returns {Promise<String,Error>} Image buffer.
     *   */
    var docDoneImage = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_doc_done_image";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };

    /** Doc done printing.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var docDonePrinting = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_doc_done_printing";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };

    /** Reset printing component.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var reset = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_reset";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };

    /** Simple print a card with predefined parameters.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var simplePrint = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_simple_print";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };

    /** Returns integer value indicating the current version of the
     *  component.
     *  
     *  @returns {Promise<Number,Error>} An integer indicating the library
     *  version number.
     *   */
    var getVersion = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_get_version";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };

    /** Returns a text string indicating the current version of the
     *  component.
     *  
     *  @returns {Promise<String,Error>} A string indicating the library
     *  version number.
     *   */
    var getVersionString = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in PrintingComponentApi.ErrorCode )
                    {
                        if ( PrintingComponentApi.ErrorCode[errorEntry] == errorCode )
                        {
                            error.errorName = errorEntry;
                            break;
                        }
                    }
                    reject( error );
                }
            } );
            var jsonNode = {};
            jsonNode.message_id = currentMessageId.toString();
            jsonNode.channel = channel;
            jsonNode.function = "aw_printing_component_get_version_string";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };




    var instance = {};
    instance.onMessage = onMessage;
    instance.channel = channel;
    instance.destroy = destroy;
    instance.getPrinterList = getPrinterList;
    instance.setTransaction = setTransaction;
    instance.setTransactionFromNistComponent = setTransactionFromNistComponent;
    instance.setVerification = setVerification;
    instance.readVerification = readVerification;
    instance.setLayoutFile = setLayoutFile;
    instance.readLayoutFile = readLayoutFile;
    instance.setPaperOptions = setPaperOptions;
    instance.setLevels = setLevels;
    instance.docBeginPrinting = docBeginPrinting;
    instance.docBeginImage = docBeginImage;
    instance.docSetMnemonicText = docSetMnemonicText;
    instance.docSetMnemonicBarcode = docSetMnemonicBarcode;
    instance.docSetMnemonicBarcodeImage = docSetMnemonicBarcodeImage;
    instance.docRenderLayout = docRenderLayout;
    instance.docNextPage = docNextPage;
    instance.docDoneImage = docDoneImage;
    instance.docDonePrinting = docDonePrinting;
    instance.reset = reset;
    instance.simplePrint = simplePrint;
    instance.getVersion = getVersion;
    instance.getVersionString = getVersionString;

    return new Promise( function( resolve, reject )
    {
        internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
        {
            if ( errorCode == PrintingComponentApi.ErrorCode.NO_ERRORS )
            {
                resolve( instance );
            }
            else
            {
                reject( errorMessage );
            }
        } );
        var jsonNode = {};
        jsonNode.message_id = currentMessageId.toString();
        jsonNode.function = "aw_printing_component_create";
        jsonNode.channel = channel;
        transport.send( jsonNode );
    } );
});

