<?php

// *********************
// START OF MAIN PROGRAM
// *********************

// Define Constants
// ----------------
// This is secret for encoding the SHA256 hash
  $SECURE_SECRET = "154E0E8E5C53404CDB5CF31C7EA9BD1D";

// add the start of the vpcURL querystring parameters
$vpcURL = $_POST["vpc_URL"] . "?";

// Remove the ePP Client URL from the parameter hash as we 
// do not want to send these fields to the ePP Client.
unset($_POST["vpc_URL"]); 
unset($_POST["SubButL"]);

// The URL link for the receipt to do another transaction.
// Note: This is ONLY used for this example and is not required for 
// production code. You would hard code your own URL into your application.

// Get and URL Encode the AgainLink. Add the AgainLink to the array
// Shows how a user field (such as application SessionIDs) could be added
//$_POST['AgainLink']=urlencode($HTTP_REFERER);

// Create the request to the ePP Client which is a URL encoded GET
// request. Since we are looping through all the data we may as well sort it in
// case we want to create a secure hash and add it to the VPC data if the
// merchant secret has been provided.
$SHA256HashData = $SECURE_SECRET;
ksort ($_POST);

// set a parameter to show the first pair in the URL
$appendAmp = 0;

foreach($_POST as $key => $value) {

    // create the SHA256 input and URL leaving out any fields that have no value
    if (strlen($value) > 0) {
        
        // this ensures the first paramter of the URL is preceded by the '?' char
        if ($appendAmp == 0) {
            $vpcURL .= urlencode($key) . '=' . urlencode($value);
            $appendAmp = 1;
        } else {
            $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
        }
        $SHA256HashData .= $value;
    }
}

// Create the secure hash and append it to the ePP Client Data if
// the merchant secret has been provided.
if (strlen($SECURE_SECRET) > 0) {
    $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash("sha256",$SHA256HashData,false));
}

// FINISH TRANSACTION - Redirect the customers using the Digital Order
// ===================================================================
header("Location: ".$vpcURL);

// *******************
// END OF MAIN PROGRAM
// *******************
