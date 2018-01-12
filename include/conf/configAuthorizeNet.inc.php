<?php
/**
 * This file contains config info for the sample app.
 */

// Adjust this to point to the Authorize.Net PHP SDK
require_once FOLDER_AUTHORIZE . 'AuthorizeNet.php';


$METHOD_TO_USE = "AIM";
// $METHOD_TO_USE = "DIRECT_POST";         // Uncomment this line to test DPM


define("AUTHORIZENET_API_LOGIN_ID","7K8Zh4yS");    // Add your API LOGIN ID
define("AUTHORIZENET_TRANSACTION_KEY","7w9S2ch6V4s9qY5J"); // Add your API transaction key
define("AUTHORIZENET_SANDBOX",false);       // Set to false to test against production
define("TEST_REQUEST", "FALSE");           // You may want to set to true if testing against production


// You only need to adjust the two variables below if testing DPM
define("AUTHORIZENET_MD5_SETTING","");                // Add your MD5 Setting.
$site_root = "https://amadeocloud.com/admin/register.php"; // Add the URL to your site


if (AUTHORIZENET_API_LOGIN_ID == "") {
    die('Enter your merchant credentials in config.php before running the app.');
}
