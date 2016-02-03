<?php

// *********************
// START OF MAIN PROGRAM
// *********************

// Define Constants
// ----------------
// This is secret for encoding the SHA256 hash
// This secret will vary from merchant to merchant
// To not create a secure hash, let SECURE_SECRET be an empty string - ""
// $SECURE_SECRET = "secure-hash-secret";
  $SECURE_SECRET = "154E0E8E5C53404CDB5CF31C7EA9BD1D";//Add your secure secret 

// If there has been a merchant secret set then sort and loop through all the
// data in the ePP Client response. While we have the data, we can
// append all the fields that contain values (except the secure hash) so that
// we can create a hash and validate it against the secure hash in the Virtual
// Payment Client response.

// NOTE: If the vpc_TxnResponseCode in not a single character then
// there was a ePP Client error and we cannot accurately validate
// the incoming data from the secure hash. */

// get and remove the vpc_TxnResponseCode code from the response fields as we
// do not want to include this field in the hash calculation
$vpc_Txn_Secure_Hash = $_GET["vpc_SecureHash"];
unset($_GET["vpc_SecureHash"]); 


// set a flag to indicate if hash has been validated
$errorExists = false;

if (strlen($SECURE_SECRET) > 0 && $_GET["vpc_TxnResponseCode"] != "7" && $_GET["vpc_TxnResponseCode"] != "No Value Returned") {

    $SHA256HashData = $SECURE_SECRET;

    ksort ($_GET);
    // sort all the incoming vpc response fields and leave out any with no value
    foreach($_GET as $key => $value) {
        if ($key != "vpc_SecureHash" or strlen($value) > 0) {
            $SHA256HashData .= $value;
        }
    }

    // Validate the Secure Hash (remember SHA256 hashes are not case sensitive)
	// This is just one way of displaying the result of checking the hash.
	// In production, you would work out your own way of presenting the result.
	// The hash check is all about detecting if the data has changed in transit.
    if (strtoupper($vpc_Txn_Secure_Hash) == strtoupper(hash("sha256",$SHA256HashData,false))) {
        // Secure Hash validation succeeded, add a data field to be displayed
        // later.
        $hashValidated = "<FONT color='#00AA00'><strong>CORRECT</strong></FONT>";
    } else {
        // Secure Hash validation failed, add a data field to be displayed
        // later.
        $hashValidated = "<FONT color='#FF0066'><strong>INVALID HASH</strong></FONT>";
        $errorExists = true;
    }
} else {
    // Secure Hash was not validated, add a data field to be displayed later.
    $hashValidated = "<FONT color='orange'><strong>Not Calculated - No 'SECURE_SECRET' present.</strong></FONT>";
}

// Define Variables
// ----------------
// Extract the available receipt fields from the VPC Response
// If not present then let the value be equal to 'No Value Returned'

// Standard Receipt Data
$vpc_Amount          = null2unknown($_GET["vpc_Amount"]);
$vpc_MerchTxnRef     = null2unknown($_GET["vpc_MerchTxnRef"]);
$auth_trans_ref_no     = null2unknown($_GET["auth_trans_ref_no"]);

$auth_response     = null2unknown($_GET["auth_response"]);
$auth_time     = null2unknown($_GET["auth_time"]);
$message     = null2unknown($_GET["message"]);


$req_amount     = null2unknown($_GET["req_amount"]);
$auth_avs_code_raw     = null2unknown($_GET["auth_avs_code_raw"]);
$auth_cv_result     = null2unknown($_GET["auth_cv_result"]);

$req_reference_number     = null2unknown($_GET["req_reference_number"]);
$req_currency     = null2unknown($_GET["req_currency"]);
$signed_date_time     = null2unknown($_GET["signed_date_time"]);
$auth_cv_result_raw     = null2unknown($_GET["auth_cv_result_raw"]);



$auth_amount     = null2unknown($_GET["auth_amount"]);
$reason_code     = null2unknown($_GET["reason_code"]);
$req_locale     = null2unknown($_GET["req_locale"]);
$auth_code     = null2unknown($_GET["auth_code"]);
$vpc_Merchant     = null2unknown($_GET["vpc_Merchant"]);
$bill_trans_ref_no     = null2unknown($_GET["bill_trans_ref_no"]);
$auth_avs_code     = null2unknown($_GET["auth_avs_code"]);


// *******************
// END OF MAIN PROGRAM
// *******************

// FINISH TRANSACTION - Process the VPC Response Data
// =====================================================
// For the purposes of demonstration, we simply display the Result fields on a
// web page.

// Show 'Error' in title if an error condition

// Show this page as an error page if vpc_TxnResponseCode equals '7'
if ($txnResponseCode == "7" || $txnResponseCode == "No Value Returned" || $errorExists) {
	$errorTxt = "Error ";
}
    
// This is the display title for 'Receipt' page 
$title = $_GET["Title"];

// The URL link for the receipt to do another transaction.
// Note: This is ONLY used for this example and is not required for 
// production code. You would hard code your own URL into your application
// to allow customers to try another transaction.
//TK//$againLink = URLDecode($_GET["AgainLink"]);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title><?php $title?> - <?php $errorTxt?>Response Page</title>
        <meta http-equiv="Content-Type" content="text/html, charset=iso-8859-1">
        <style type="text/css">
            <!--
            h1       { font-family:Arial,sans-serif; font-size:24pt; color:#08185A; font-weight:100}
            h2.co    { font-family:Arial,sans-serif; font-size:24pt; color:#08185A; margin-top:0.1em; margin-bottom:0.1em; font-weight:100}
            h3.co    { font-family:Arial,sans-serif; font-size:16pt; color:#000000; margin-top:0.1em; margin-bottom:0.1em; font-weight:100}
            body     { font-family:Verdana,Arial,sans-serif; font-size:10pt; color:#08185A background-color:#FFFFFF }
            p        { font-family:Verdana,Arial,sans-serif; font-size:8pt; color:#FFFFFF }
            a:link   { font-family:Verdana,Arial,sans-serif; font-size:8pt; color:#08185A }
            a:visited{ font-family:Verdana,Arial,sans-serif; font-size:8pt; color:#08185A }
            a:hover  { font-family:Verdana,Arial,sans-serif; font-size:8pt; color:#FF0000 }
            a:active { font-family:Verdana,Arial,sans-serif; font-size:8pt; color:#FF0000 }
			tr       { height:25px; }
			tr.shade { height:25px; background-color:#E1E1E1 }
			tr.title { height:25px; background-color:#C1C1C1 }
            td       { font-family:Verdana,Arial,sans-serif; font-size:8pt; color:#08185A }
            td.red   { font-family:Verdana,Arial,sans-serif; font-size:8pt; color:#FF0066 }
            td.green { font-family:Verdana,Arial,sans-serif; font-size:8pt; color:#00AA00 }
            th       { font-family:Verdana,Arial,sans-serif; font-size:10pt; color:#08185A; font-weight:bold; background-color:#E1E1E1; padding-top:0.5em; padding-bottom:0.5em}
            input    { font-family:Verdana,Arial,sans-serif; font-size:8pt; color:#08185A; background-color:#E1E1E1; font-weight:bold }
            select   { font-family:Verdana,Arial,sans-serif; font-size:8pt; color:#08185A; background-color:#E1E1E1; font-weight:bold; width:463 }
            textarea { font-family:Verdana,Arial,sans-serif; font-size:8pt; color:#08185A; background-color:#E1E1E1; font-weight:normal; scrollbar-arrow-color:#08185A; scrollbar-base-color:#E1E1E1 }
            -->
        </style>
    </head>
    <body>
		<!-- start branding table -->
		<table width='100%' border='2' cellpadding='2' bgcolor='#C1C1C1'>
			<tr>
				<td bgcolor='#E1E1E1' width='90%'><h2 class='co'>&nbsp;ePP Client 2.5 Example</h2></td>
				<td bgcolor='#C1C1C1' align='center'><h3 class='co'>ePP</h3></td>
			</tr>
		</table>
		<!-- end branding table -->
        <!-- End Branding Table -->
        <center><h1><?php "ERROR"?> - <?php $errorTxt?>Response Page</h1></center>
        <table width="85%" align="center" cellpadding="5" border="0">
            <tr class="title">
                <td colspan="2" height="25"><P><strong>&nbsp;Basic Transaction Fields</strong></P></td>
            </tr>

   <tr>
            <td align='right' width='50%'><strong><i>auth_avs_code: </i></strong></td>
            <td width='50%'><?php echo $auth_avs_code;?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>bill_trans_ref_no: </i></strong></td>
            <td><?php echo $bill_trans_ref_no;?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>Merchant Transaction Reference: </i></strong></td>
            <td><?php echo $vpc_MerchTxnRef;?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Merchant ID: </i></strong></td>
            <td><?php echo $vpc_Merchant;?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>auth_code: </i></strong></td>
            <td><?php echo $auth_code;?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Locale: </i></strong></td>
            <td><?php echo $req_locale;?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>reason_code: </i></strong></td>
            <td><?php echo $reason_code;?></td>
        </tr>

       

        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>auth_amount: </i></strong></td>
            <td><?php echo $auth_amount;?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>auth_cv_result_raw: </i></strong></td>
            <td><?php echo $auth_cv_result_raw;?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>signed_date_time: </i></strong></td>
            <td><?php echo $signed_date_time;?></td>
        </tr>
         <tr>
            <td align='right'><strong><i>req_currency: </i></strong></td>
            <td><?php echo $req_currency;?></td>
        </tr>

       

        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>auth_cv_result: </i></strong></td>
            <td><?php echo $auth_cv_result;?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>auth_avs_code_raw: </i></strong></td>
            <td><?php echo $auth_avs_code_raw;?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Amount: </i></strong></td>
            <td><?php echo $vpc_Amount;?></td>
        </tr>
         <tr>
            <td align='right'><strong><i>message: </i></strong></td>
            <td><?php echo $message;?></td>
        </tr>

       

        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>auth_time: </i></strong></td>
            <td><?php echo $auth_time;?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>auth_response: </i></strong></td>
            <td><?php echo $auth_response;?></td>
        </tr> 
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>auth_trans_ref_no: </i></strong></td>
            <td><?php echo $auth_trans_ref_no;?></td>
        </tr>


        <tr bgcolor="#C1C1C1">
            <td colspan="2" height="25"><p><strong>&nbsp;Hash Validation</strong></p></td>
        </tr>
        <tr>
            <td align="right"><strong><i>Hash Validated Correctly: </i></strong></td>
            <td><?php echo $hashValidated;?></td>
        </tr>

<? 
?>    </table>
    </body>
</html>

<?php
// End Processing

// This method uses the QSI Response code retrieved from the Digital
// Receipt and returns an appropriate description for the QSI Response Code
//
// @param $responseCode String containing the QSI Response Code
//
// @return String containing the appropriate description
//
// If input is null, returns string "No Value Returned", else returns input
function null2unknown($data) {
    if ($data == "") {
        return "No Value Returned";
    } else {
        return $data;
    }
} 
   
//  ----------------------------------------------------------------------------
?>
