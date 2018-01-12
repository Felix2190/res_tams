/* Copyright (C) 2017 Aware, Inc - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
 
/** @namespace
  */
var NistComponentApi =
{
    /** Feature of an entity or identity.
     *  @enum {number} */
    Feature : 
    (function()
    {
        var values = {};
        /** Full name. */
        values[values.FULL_NAME = 0] = "FULL_NAME";

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

        /** JPEG 2000 Lossy format */
        values[values.JP2 = 4] = "JP2";

        /** JPEG format */
        values[values.JPG = 5] = "JPG";

        /** JPEG 2000 Lossless format */
        values[values.JP2L = 6] = "JP2L";

        /** PNG format */
        values[values.PNG = 7] = "PNG";

        return values;
    })(),

    /** Finger.
     *  @enum {number} */
    Finger : 
    (function()
    {
        var values = {};
        /** Unknown finger. */
        values[values.UNKNOWN_FINGER = 0] = "UNKNOWN_FINGER";

        /** Right thumb. */
        values[values.RIGHT_THUMB = 1] = "RIGHT_THUMB";

        /** Right index finger. */
        values[values.RIGHT_INDEX_FINGER = 2] = "RIGHT_INDEX_FINGER";

        /** Right middle finger. */
        values[values.RIGHT_MIDDLE_FINGER = 3] = "RIGHT_MIDDLE_FINGER";

        /** Right ring finger. */
        values[values.RIGHT_RING_FINGER = 4] = "RIGHT_RING_FINGER";

        /** Right little finger. */
        values[values.RIGHT_LITTLE_FINGER = 5] = "RIGHT_LITTLE_FINGER";

        /** Left thumb. */
        values[values.LEFT_THUMB = 6] = "LEFT_THUMB";

        /** Left index finger. */
        values[values.LEFT_INDEX_FINGER = 7] = "LEFT_INDEX_FINGER";

        /** Left middle finger. */
        values[values.LEFT_MIDDLE_FINGER = 8] = "LEFT_MIDDLE_FINGER";

        /** Left ring finger. */
        values[values.LEFT_RING_FINGER = 9] = "LEFT_RING_FINGER";

        /** Left little finger. */
        values[values.LEFT_LITTLE_FINGER = 10] = "LEFT_LITTLE_FINGER";

        /** Plain right thumb. */
        values[values.PLAIN_RIGHT_THUMB = 11] = "PLAIN_RIGHT_THUMB";

        /** Plain left thumb. */
        values[values.PLAIN_LEFT_THUMB = 12] = "PLAIN_LEFT_THUMB";

        /** Plain right four fingers (may include extra digits). */
        values[values.PLAIN_RIGHT_FOUR_FINGERS = 13] = "PLAIN_RIGHT_FOUR_FINGERS";

        /** Plain left four fingers (may include extra digits). */
        values[values.PLAIN_LEFT_FOUR_FINGERS = 14] = "PLAIN_LEFT_FOUR_FINGERS";

        /** Left and right thumbs. */
        values[values.LEFT_RIGHT_THUMBS = 15] = "LEFT_RIGHT_THUMBS";

        /** Right extra digit. */
        values[values.RIGHT_EXTRA_DIGIT = 16] = "RIGHT_EXTRA_DIGIT";

        /** Left extra digit. */
        values[values.LEFT_EXTRA_DIGIT = 17] = "LEFT_EXTRA_DIGIT";

        /** Unknown friction ridge. */
        values[values.UNKNOWN_FRICTION_RIDGE = 18] = "UNKNOWN_FRICTION_RIDGE";

        /** EJI or tip. */
        values[values.EJI_OR_TIP = 19] = "EJI_OR_TIP";

        return values;
    })(),

    /** Impression.
     *  @enum {number} */
    Impression : 
    (function()
    {
        var values = {};
        /** Rolled right thumb. */
        values[values.ROLLED_RIGHT_THUMB = 1] = "ROLLED_RIGHT_THUMB";

        /** Rolled right index finger. */
        values[values.ROLLED_RIGHT_INDEX_FINGER = 2] = "ROLLED_RIGHT_INDEX_FINGER";

        /** Rolled right middle finger. */
        values[values.ROLLED_RIGHT_MIDDLE_FINGER = 3] = "ROLLED_RIGHT_MIDDLE_FINGER";

        /** Rolled right ring finger. */
        values[values.ROLLED_RIGHT_RING_FINGER = 4] = "ROLLED_RIGHT_RING_FINGER";

        /** Rolled right little finger. */
        values[values.ROLLED_RIGHT_LITTLE_FINGER = 5] = "ROLLED_RIGHT_LITTLE_FINGER";

        /** Rolled left thumb. */
        values[values.ROLLED_LEFT_THUMB = 6] = "ROLLED_LEFT_THUMB";

        /** Rolled left index finger. */
        values[values.ROLLED_LEFT_INDEX_FINGER = 7] = "ROLLED_LEFT_INDEX_FINGER";

        /** Rolled left middle finger. */
        values[values.ROLLED_LEFT_MIDDLE_FINGER = 8] = "ROLLED_LEFT_MIDDLE_FINGER";

        /** Rolled left ring finger. */
        values[values.ROLLED_LEFT_RING_FINGER = 9] = "ROLLED_LEFT_RING_FINGER";

        /** Rolled left little finger. */
        values[values.ROLLED_LEFT_LITTLE_FINGER = 10] = "ROLLED_LEFT_LITTLE_FINGER";

        /** Plain right thumb. */
        values[values.PLAIN_RIGHT_THUMB = 11] = "PLAIN_RIGHT_THUMB";

        /** Plain left thumb. */
        values[values.PLAIN_LEFT_THUMB = 12] = "PLAIN_LEFT_THUMB";

        /** Four fingered slap of the right hand. */
        values[values.PLAIN_RIGHT_FOUR_FINGERS = 13] = "PLAIN_RIGHT_FOUR_FINGERS";

        /** Four fingered slap of the left hand. */
        values[values.PLAIN_LEFT_FOUR_FINGERS = 14] = "PLAIN_LEFT_FOUR_FINGERS";

        /** Plain right index finger found within a plain right four finger
         *  slap */
        values[values.RIGHT_SLAP_INDEX_FINGER = 15] = "RIGHT_SLAP_INDEX_FINGER";

        /** Plain right middle finger found within a plain right four finger
         *  slap. */
        values[values.RIGHT_SLAP_MIDDLE_FINGER = 16] = "RIGHT_SLAP_MIDDLE_FINGER";

        /** Plain right ring finger found within a plain right four finger
         *  slap. */
        values[values.RIGHT_SLAP_RING_FINGER = 17] = "RIGHT_SLAP_RING_FINGER";

        /** Plain right little finger found within a plain right four finger
         *  slap. */
        values[values.RIGHT_SLAP_LITTLE_FINGER = 18] = "RIGHT_SLAP_LITTLE_FINGER";

        /** Plain left index finger found within a plain left four finger
         *  slap. */
        values[values.LEFT_SLAP_INDEX_FINGER = 19] = "LEFT_SLAP_INDEX_FINGER";

        /** Plain left middle finger found within a plain left four finger
         *  slap. */
        values[values.LEFT_SLAP_MIDDLE_FINGER = 20] = "LEFT_SLAP_MIDDLE_FINGER";

        /** Plain left ring finger found within a plain left four finger
         *  slap. */
        values[values.LEFT_SLAP_RING_FINGER = 21] = "LEFT_SLAP_RING_FINGER";

        /** Plain left little finger found within a plain left four finger
         *  slap. */
        values[values.LEFT_SLAP_LITTLE_FINGER = 22] = "LEFT_SLAP_LITTLE_FINGER";

        /** Plain dual (right and left) thumbs */
        values[values.PLAIN_DUAL_THUMBS = 31] = "PLAIN_DUAL_THUMBS";

        /** Plain right thumb from within a dual thumb impression */
        values[values.PLAIN_DUAL_THUMBS_RIGHT = 32] = "PLAIN_DUAL_THUMBS_RIGHT";

        /** Plain left thumb from within a dual thumb impression. */
        values[values.PLAIN_DUAL_THUMBS_LEFT = 33] = "PLAIN_DUAL_THUMBS_LEFT";

        /** Plain right index finger. */
        values[values.PLAIN_RIGHT_INDEX_FINGER = 80] = "PLAIN_RIGHT_INDEX_FINGER";

        /** Plain right middle finger. */
        values[values.PLAIN_RIGHT_MIDDLE_FINGER = 81] = "PLAIN_RIGHT_MIDDLE_FINGER";

        /** Plain right ring finger. */
        values[values.PLAIN_RIGHT_RING_FINGER = 82] = "PLAIN_RIGHT_RING_FINGER";

        /** Plain right little finger. */
        values[values.PLAIN_RIGHT_LITTLE_FINGER = 83] = "PLAIN_RIGHT_LITTLE_FINGER";

        /** Plain left index finger. */
        values[values.PLAIN_LEFT_INDEX_FINGER = 84] = "PLAIN_LEFT_INDEX_FINGER";

        /** Plain left middle finger. */
        values[values.PLAIN_LEFT_MIDDLE_FINGER = 85] = "PLAIN_LEFT_MIDDLE_FINGER";

        /** Plain left ring finger. */
        values[values.PLAIN_LEFT_RING_FINGER = 86] = "PLAIN_LEFT_RING_FINGER";

        /** Plain left little finger. */
        values[values.PLAIN_LEFT_LITTLE_FINGER = 87] = "PLAIN_LEFT_LITTLE_FINGER";

        /** Five fingered slap of the right hand. */
        values[values.PLAIN_RIGHT_FIVE_FINGERS = 100] = "PLAIN_RIGHT_FIVE_FINGERS";

        /** Five fingered slap of the left hand. */
        values[values.PLAIN_LEFT_FIVE_FINGERS = 101] = "PLAIN_LEFT_FIVE_FINGERS";

        /** Plain right index found within a five finger slap. */
        values[values.RIGHT_FIVE_SLAP_INDEX_FINGER = 102] = "RIGHT_FIVE_SLAP_INDEX_FINGER";

        /** Plain right middle found within a five finger slap. */
        values[values.RIGHT_FIVE_SLAP_MIDDLE_FINGER = 103] = "RIGHT_FIVE_SLAP_MIDDLE_FINGER";

        /** Plain right ring found within a five finger slap. */
        values[values.RIGHT_FIVE_SLAP_RING_FINGER = 104] = "RIGHT_FIVE_SLAP_RING_FINGER";

        /** Plain right little found within a five finger slap. */
        values[values.RIGHT_FIVE_SLAP_LITTLE_FINGER = 105] = "RIGHT_FIVE_SLAP_LITTLE_FINGER";

        /** Plain right aux found within a five finger slap. */
        values[values.RIGHT_FIVE_SLAP_AUX_FINGER = 106] = "RIGHT_FIVE_SLAP_AUX_FINGER";

        /** Plain left index found within a five finger slap. */
        values[values.LEFT_FIVE_SLAP_INDEX_FINGER = 107] = "LEFT_FIVE_SLAP_INDEX_FINGER";

        /** Plain left middle found within a five finger slap. */
        values[values.LEFT_FIVE_SLAP_MIDDLE_FINGER = 108] = "LEFT_FIVE_SLAP_MIDDLE_FINGER";

        /** Plain left ring found within a five finger slap. */
        values[values.LEFT_FIVE_SLAP_RING_FINGER = 109] = "LEFT_FIVE_SLAP_RING_FINGER";

        /** Plain left little found within a five finger slap. */
        values[values.LEFT_FIVE_SLAP_LITTLE_FINGER = 110] = "LEFT_FIVE_SLAP_LITTLE_FINGER";

        /** Plain left aux found within a five finger slap. */
        values[values.LEFT_FIVE_SLAP_AUX_FINGER = 111] = "LEFT_FIVE_SLAP_AUX_FINGER";

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

        /** The transaction object was NULL. */
        values[values.NULL_NIST_COMPONENT_OBJ = 101] = "NULL_NIST_COMPONENT_OBJ";

        /** The transaction pointer is NULL. */
        values[values.NULL_TRANS_OBJ = 102] = "NULL_TRANS_OBJ";

        /** The verification pointer is NULL. */
        values[values.NULL_VERI_OBJ = 103] = "NULL_VERI_OBJ";

        /** Error during reading file. */
        values[values.READING_FILE = 104] = "READING_FILE";

        /** Error during writing file. */
        values[values.WRITING_FILE = 105] = "WRITING_FILE";

        /** Error opening file for reading. */
        values[values.OPENING_FILE_FOR_READING = 106] = "OPENING_FILE_FOR_READING";

        /** Error opening file for writing. */
        values[values.OPENING_FILE_FOR_WRITING = 107] = "OPENING_FILE_FOR_WRITING";

        /** No transaction is loaded. */
        values[values.TRANSACTION_NOT_LOADED = 108] = "TRANSACTION_NOT_LOADED";

        /** No verification is loaded. */
        values[values.VERIFICATION_NOT_LOADED = 109] = "VERIFICATION_NOT_LOADED";

        /** The transaction type was not found the current verification file */
        values[values.TRANSACTION_TYPE_NOT_FOUND = 110] = "TRANSACTION_TYPE_NOT_FOUND";

        /** Invalid field number found in record. */
        values[values.FIELD_NUM_IN_RECORD = 111] = "FIELD_NUM_IN_RECORD";

        /** Invalid field. */
        values[values.INVALID_FIELD_NUM = 112] = "INVALID_FIELD_NUM";

        /** Invalid subfield. */
        values[values.INVALID_SUBFIELD_NUM = 113] = "INVALID_SUBFIELD_NUM";

        /** Invalid item. */
        values[values.INVALID_ITEM_NUM = 114] = "INVALID_ITEM_NUM";

        /** Unsupported record type. */
        values[values.UNSUPPORTED_RECORD_TYPE = 115] = "UNSUPPORTED_RECORD_TYPE";

        /** Max records exceeded. */
        values[values.MAX_RECORDS_EXCEEDED = 116] = "MAX_RECORDS_EXCEEDED";

        /** Image height or width not set. */
        values[values.IMG_HEIGHT_OR_WIDTH_NOT_SET = 117] = "IMG_HEIGHT_OR_WIDTH_NOT_SET";

        /** Mnemonic not found. */
        values[values.MNEMONIC_NOT_FOUND = 118] = "MNEMONIC_NOT_FOUND";

        /** Could not find a record of the specified type and index. */
        values[values.RECORD_NOT_FOUND = 119] = "RECORD_NOT_FOUND";

        /** The fingerprint set object is NULL. */
        values[values.NULL_FINGERPRINT_SET = 200] = "NULL_FINGERPRINT_SET";

        /** The photo set object is NULL. */
        values[values.NULL_PHOTO_SET = 201] = "NULL_PHOTO_SET";

        /** Unknown image format. */
        values[values.UNKNOWN_IMAGE_FORMAT = 202] = "UNKNOWN_IMAGE_FORMAT";

        /** No photo image data from photo set. */
        values[values.NO_PHOTO_IMAGE_DATA = 203] = "NO_PHOTO_IMAGE_DATA";

        /** Unknown impression type found when loading transaction. */
        values[values.UNKNOWN_IMPRESSION_TYPE = 204] = "UNKNOWN_IMPRESSION_TYPE";

        /** Unknown finger position found when loading transaction. */
        values[values.UNKNOWN_FINGER_POSITION = 205] = "UNKNOWN_FINGER_POSITION";

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

        /** The parameter value is invalid. */
        values[values.INVALID_PARAMETER_VALUE = 10006] = "INVALID_PARAMETER_VALUE";

        /** The channel name is incorrect, hasn't been opened, or is closed. */
        values[values.INVALID_CHANNEL_NAME = 10007] = "INVALID_CHANNEL_NAME";

        return values;
    })(),


};

/** Creates an object that implements the NistComponent API.
  *
  * @param websocketHandle - Handle to an open websocket connection, connected
  *      to the aw_bio_component_server. The caller is responsible for handling
  *      the "onerror" callback, whereas this class will handle the "onmessage"
  *      callback.
  *
  * @return Object that implements the NistComponent API.
  */
var createNistComponent = (function( transportObject, channelName )
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


    /** This function destroys the NistComponent object.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var destroy = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_destroy";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };

    /** Creates a new transaction and loads it.
     *  @param {String} transactionType Transaction type.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var newTransaction = function( transactionType )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_new_transaction";
            jsonNode.args = [ transactionType ];
            transport.send( jsonNode );
        } );
    };

    /** Loads a verification file from.
     *  @param {String} verificationFile Path to verification file.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var readVerification = function( verificationFile )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_read_verification";
            jsonNode.args = [ verificationFile ];
            transport.send( jsonNode );
        } );
    };

    /** Loads a transaction from the supplied buffer.
     *  @param {String} transaction Buffer containing the transaction to
     *  load.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var readTransaction = function( transaction )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_read_transaction";
            jsonNode.args = [ transaction ];
            transport.send( jsonNode );
        } );
    };

    /** Writes the data in a transaction to a buffer.
     *  
     *  @returns {Promise<String,Error>} Buffer containing the transaction
     *  data.
     *   */
    var write = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_write";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };

    /** This function inserts a record of the type specified by record type
     *  into the transaction. The index of the new record is returned.
     *  @param {Number} recordType Record type.
     *  
     *  @returns {Promise<Number,Error>} Index of the new record.
     *   */
    var addRecord = function( recordType )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_add_record";
            jsonNode.args = [ recordType ];
            transport.send( jsonNode );
        } );
    };

    /** This function deletes all records of the specified type.
     *  @param {Number} recordType Record type.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var deleteRecords = function( recordType )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_delete_records";
            jsonNode.args = [ recordType ];
            transport.send( jsonNode );
        } );
    };

    /** Returns the number of records of the specified type
     *  @param {Number} recordType Record type.
     *  
     *  @returns {Promise<Number,Error>} Number of records.
     *   */
    var getRecordTypeCount = function( recordType )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_get_record_type_count";
            jsonNode.args = [ recordType ];
            transport.send( jsonNode );
        } );
    };

    /** Returns a list of all the records in a transaction.
     *  
     *  @returns {Promise<Object,Error>} List of records in transaction.
     *   */
    var listRecords = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_list_records";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };

    /** Returns a list of all the records in a transaction.
     *  @param {Number} recordType Record type.
     *  @param {Number} recordIndex Index of the new record.
     *  
     *  @returns {Promise<Object,Error>} List of fields in a record.
     *   */
    var listFields = function( recordType, recordIndex )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_list_fields";
            jsonNode.args = [ recordType, recordIndex ];
            transport.send( jsonNode );
        } );
    };

    /** Closes the current transaction.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var close = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_close";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };

    /** Finds the number of subfields in the field Field of the record
     *  record_index, and of type record_type.
     *  @param {Number} recordType Record type.
     *  @param {Number} recordIndex Record index.
     *  @param {Number} field Field number.
     *  
     *  @returns {Promise<Number,Error>} Number of subfields.
     *   */
    var numSubfields = function( recordType, recordIndex, field )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_num_subfields";
            jsonNode.args = [ recordType, recordIndex, field ];
            transport.send( jsonNode );
        } );
    };

    /** Finds the number of items in subfield subfield in the field Field of
     *  the record record_index, of type record_type.
     *  @param {Number} recordType Record type.
     *  @param {Number} recordIndex Record index.
     *  @param {Number} field Field number.
     *  @param {Number} subfield Subfield number.
     *  
     *  @returns {Promise<Number,Error>} Number of subfields.
     *   */
    var numItems = function( recordType, recordIndex, field, subfield )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_num_items";
            jsonNode.args = [ recordType, recordIndex, field, subfield ];
            transport.send( jsonNode );
        } );
    };

    /** Use this function to retrieve data by specifying the record type,
     *  field, subfield, and index.
     *  @param {Number} recordType Record type.
     *  @param {Number} recordIndex Record index.
     *  @param {Number} field Field number.
     *  @param {Number} subfield Subfield number.
     *  @param {Number} item Item number.
     *  
     *  @returns {Promise<String,Error>} Item data.
     *   */
    var findItem = function( recordType, recordIndex, field, subfield, item )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_find_item";
            jsonNode.args = [ recordType, recordIndex, field, subfield, item ];
            transport.send( jsonNode );
        } );
    };

    /** Use this function to get data by mnemonic.
     *  @param {String} mnemonic Field mnemonic.
     *  @param {Number} occurrence Occurrence.
     *  @param {Number} recordIndex Record index.
     *  
     *  @returns {Promise<String,Error>} Field data.
     *   */
    var get = function( mnemonic, occurrence, recordIndex )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_get";
            jsonNode.args = [ mnemonic, occurrence, recordIndex ];
            transport.send( jsonNode );
        } );
    };

    /** Use this function to set data by mnemonic.
     *  @param {String} mnemonic Field mnemonic.
     *  @param {String} data Field data.
     *  @param {Number} occurrence Occurrence.
     *  @param {Number} recordIndex Record index.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var set = function( mnemonic, data, occurrence, recordIndex )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_set";
            jsonNode.args = [ mnemonic, data, occurrence, recordIndex ];
            transport.send( jsonNode );
        } );
    };

    /** Use this function to set data by specifying the record type, field,
     *  subfield, and index.
     *  @param {String} data Item data.
     *  @param {Number} recordType Record type.
     *  @param {Number} recordIndex Record index.
     *  @param {Number} field Field number.
     *  @param {Number} subfield Subfield number.
     *  @param {Number} item Item number.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var setItem = function( data, recordType, recordIndex, field, subfield, item )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_set_item";
            jsonNode.args = [ data, recordType, recordIndex, field, subfield, item ];
            transport.send( jsonNode );
        } );
    };

    /** Use this function to set image.
     *  @param {Number} recordType Record type.
     *  @param {Number} recordIndex Record index.
     *  @param {Number} inputFormat Input format.
     *  @param {String} image Image buffer.
     *  @param {Number} storageFormat Format of the image when stored in the
     *  transaction.
     *  @param {Number} compressionValue Compression value if the image
     *  needs to be compressed or recompressed.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var setImage = function( recordType, recordIndex, inputFormat, image, storageFormat, compressionValue )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_set_image";
            jsonNode.args = [ recordType, recordIndex, inputFormat, image, storageFormat, compressionValue ];
            transport.send( jsonNode );
        } );
    };

    /** Use this function to set image.
     *  @param {Number} recordType Record type.
     *  @param {Number} recordIndex Record index.
     *  @param {Number} outputFormat Output format.
     *  
     *  @returns {Promise<String,Error>} Image buffer.
     *   */
    var getImageAs = function( recordType, recordIndex, outputFormat )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_get_image_as";
            jsonNode.args = [ recordType, recordIndex, outputFormat ];
            transport.send( jsonNode );
        } );
    };

    /** Removes the record data by mnemonic.
     *  @param {String} mnemonic Field mnemonic.
     *  @param {Number} index Index value.
     *  @param {Number} recordIndex Record index.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var remove = function( mnemonic, index, recordIndex )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_remove";
            jsonNode.args = [ mnemonic, index, recordIndex ];
            transport.send( jsonNode );
        } );
    };

    /** Removes the specified item.
     *  @param {Number} recordType Record type.
     *  @param {Number} recordIndex Record index.
     *  @param {Number} field Field number.
     *  @param {Number} subfield Subfield number.
     *  @param {Number} item Item number.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var removeItem = function( recordType, recordIndex, field, subfield, item )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_remove_item";
            jsonNode.args = [ recordType, recordIndex, field, subfield, item ];
            transport.send( jsonNode );
        } );
    };

    /** Read a list of fingerprint's data into transaction from fingerprint
     *  set and returns an array of the indexes of the newly create records.
     *  @param {String} fingerprintSet FingerprintSet object containing
     *  fingerprint data.
     *  @param {Number} recordType Record Type, could be either Type 4 or
     *  Type 14 record.
     *  @param {Object} impressions List of impressions.
     *  @param {Number} imageFormat Image format.
     *  
     *  @returns {Promise<Object,Error>} Array of allowed values.
     *   */
    var importFromFingerprintSet = function( fingerprintSet, recordType, impressions, imageFormat )
    {
        fingerprintSet = fingerprintSet.channel;
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_import_from_fingerprint_set";
            jsonNode.args = [ fingerprintSet, recordType, impressions, imageFormat ];
            transport.send( jsonNode );
        } );
    };

    /** Read a list of fingerprint's data into transaction from fingerprint
     *  set resizing images as necessary and returns an array of the indexes
     *  of the newly create records.
     *  @param {String} fingerprintSet FingerprintSet object containing
     *  fingerprint data.
     *  @param {Number} recordType Record Type, could be either Type 4 or
     *  Type 14 record.
     *  @param {Object} impressions List of impressions.
     *  @param {Number} imageFormat Image format.
     *  @param {Number} minWidth If image width is smaller than this value,
     *  it will be expanded to this value.
     *  @param {Number} minHeight If image height is smaller than this
     *  value, it will be expanded to this value.
     *  @param {Number} maxWidth If image width is larger than this value,
     *  it will be cropped to this value.
     *  @param {Number} maxHeight If image height is larger than this value,
     *  it will be cropped to this value.
     *  
     *  @returns {Promise<Object,Error>} Array of allowed values.
     *   */
    var importFromFingerprintSetSized = function( fingerprintSet, recordType, impressions, imageFormat, minWidth, minHeight, maxWidth, maxHeight )
    {
        fingerprintSet = fingerprintSet.channel;
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_import_from_fingerprint_set_sized";
            jsonNode.args = [ fingerprintSet, recordType, impressions, imageFormat, minWidth, minHeight, maxWidth, maxHeight ];
            transport.send( jsonNode );
        } );
    };

    /** Export fingerprint data from transaction to fingerprint set.
     *  @param {String} fingerprintSet FingerprintSet object that
     *  transaction exported to.
     *  @param {Number} recordType Record Type, could be either Type 4 or
     *  Type 14 record.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var exportToFingerprintSet = function( fingerprintSet, recordType )
    {
        fingerprintSet = fingerprintSet.channel;
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_export_to_fingerprint_set";
            jsonNode.args = [ fingerprintSet, recordType ];
            transport.send( jsonNode );
        } );
    };

    /** Read photo data into transaction from photo set.
     *  @param {String} photoSet PhotoSet object containing facial data.
     *  @param {Object} imageIdArray An array containing the identifiers of
     *  the images to import.
     *  @param {Number} imageFormat Image format.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var importFromPhotoSet = function( photoSet, imageIdArray, imageFormat )
    {
        photoSet = photoSet.channel;
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_import_from_photo_set";
            jsonNode.args = [ photoSet, imageIdArray, imageFormat ];
            transport.send( jsonNode );
        } );
    };

    /** Export photo data from transaction to photo set. The image id will
     *  be 'imageN' where N is the record index.
     *  @param {String} photoSet Photo object that transaction exported to.
     *  
     *  @returns {Promise<,Error>}
     *   */
    var exportToPhotoSet = function( photoSet )
    {
        photoSet = photoSet.channel;
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve();
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_export_to_photo_set";
            jsonNode.args = [ photoSet ];
            transport.send( jsonNode );
        } );
    };

    /** Returns information used to verify the data defined in the
     *  verification file
     *  @param {String} transactionType Transaction type.
     *  @param {String} mnemonic Mnemonic.
     *  
     *  @returns {Promise<Object,Error>} List of transaction tag data.
     *   */
    var getRule = function( transactionType, mnemonic )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_get_rule";
            jsonNode.args = [ transactionType, mnemonic ];
            transport.send( jsonNode );
        } );
    };

    /** Returns code table defined in the verification file given the
     *  transaction type and mnemonic
     *  @param {String} transactionType Transaction type.
     *  @param {String} mnemonic Mnemonic.
     *  @param {Number} occurrence Occurrence.
     *  @param {Number} recordIndex Record Index.
     *  
     *  @returns {Promise<Object,Error>} Array of allowed values.
     *   */
    var getAllowedValues = function( transactionType, mnemonic, occurrence, recordIndex )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_get_allowed_values";
            jsonNode.args = [ transactionType, mnemonic, occurrence, recordIndex ];
            transport.send( jsonNode );
        } );
    };

    /** Returns code table defined in the verification file given the
     *  transaction type and mnemonic
     *  @param {String} transactionType Transaction type.
     *  @param {String} mnemonic Mnemonic.
     *  
     *  @returns {Promise<Object,Error>} Array of allowed values.
     *   */
    var getCodes = function( transactionType, mnemonic )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_get_codes";
            jsonNode.args = [ transactionType, mnemonic ];
            transport.send( jsonNode );
        } );
    };

    /** This function returns whether the entire transaction passes all
     *  verification requirements.
     *  
     *  @returns {Promise<Boolean,Error>} Whether the entire transaction
     *  passes all verification requirements.
     *   */
    var verify = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_verify";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };

    /** This function verifies the transaction and returns an array of
     *  errors. If the transaction pass verification, and empty array is
     *  returned.
     *  
     *  @returns {Promise<Object,Error>} List of verification errors.
     *   */
    var verifyAndReturnErrors = function( )
    {
        return new Promise( function( resolve, reject )
        {
            internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
            {
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_verify_and_return_errors";
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
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_get_version";
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
                if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
                {
                    resolve( returnValue );
                }
                else
                {
                    var error = new Error( errorMessage );
                    error.errorCode = errorCode;
                    for ( var errorEntry in NistComponentApi.ErrorCode )
                    {
                        if ( NistComponentApi.ErrorCode[errorEntry] == errorCode )
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
            jsonNode.function = "aw_nist_component_get_version_string";
            jsonNode.args = [ ];
            transport.send( jsonNode );
        } );
    };




    var instance = {};
    instance.onMessage = onMessage;
    instance.channel = channel;
    instance.destroy = destroy;
    instance.newTransaction = newTransaction;
    instance.readVerification = readVerification;
    instance.readTransaction = readTransaction;
    instance.write = write;
    instance.addRecord = addRecord;
    instance.deleteRecords = deleteRecords;
    instance.getRecordTypeCount = getRecordTypeCount;
    instance.listRecords = listRecords;
    instance.listFields = listFields;
    instance.close = close;
    instance.numSubfields = numSubfields;
    instance.numItems = numItems;
    instance.findItem = findItem;
    instance.get = get;
    instance.set = set;
    instance.setItem = setItem;
    instance.setImage = setImage;
    instance.getImageAs = getImageAs;
    instance.remove = remove;
    instance.removeItem = removeItem;
    instance.importFromFingerprintSet = importFromFingerprintSet;
    instance.importFromFingerprintSetSized = importFromFingerprintSetSized;
    instance.exportToFingerprintSet = exportToFingerprintSet;
    instance.importFromPhotoSet = importFromPhotoSet;
    instance.exportToPhotoSet = exportToPhotoSet;
    instance.getRule = getRule;
    instance.getAllowedValues = getAllowedValues;
    instance.getCodes = getCodes;
    instance.verify = verify;
    instance.verifyAndReturnErrors = verifyAndReturnErrors;
    instance.getVersion = getVersion;
    instance.getVersionString = getVersionString;

    return new Promise( function( resolve, reject )
    {
        internalStoreOnReturn( function( returnValue, errorCode, errorMessage )
        {
            if ( errorCode == NistComponentApi.ErrorCode.NO_ERRORS )
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
        jsonNode.function = "aw_nist_component_create";
        jsonNode.channel = channel;
        transport.send( jsonNode );
    } );
});

