<?php
	
	//https://api.juspay.in/order_status?orderId=825010829&merchantId=phptest
	//Get the order Id
	$orderId = $_GET["order_id"];
	$merchantId = "MMLT";

	$ch = curl_init('https://axisbank.juspay.in/order_status');

	curl_setopt($ch, CURLOPT_POSTFIELDS ,array('orderId' => $orderId , 'merchantId' => $merchantId ));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_USERPWD, '218E2D2311A445EA5380C6787035FE');

  $jsonResponse =  json_decode( curl_exec($ch) ); 
  	
	//get the information
	$merchantId = $jsonResponse->{'merchantId'};
	$customerId = $jsonResponse->{'customerId'};
	$orderId = $jsonResponse->{'orderId'};
	$status = $jsonResponse->{'status'};
	$statusId = $jsonResponse->{'statusId'};
	$amount = $jsonResponse->{'amount'};
	$refunded = $jsonResponse->{'refunded'};
	$amountRefunded = $jsonResponse->{'amount_refunded'};
	$returnUrl = $jsonResponse->{'return_url'};
	$udf1 = $jsonResponse->{'udf1'};
	$udf2 = $jsonResponse->{'udf2'};
	$udf3 = $jsonResponse->{'udf3'};
	//. . skipping other udf fields
	$txnId = $jsonResponse->{'txnId'};
	$gatewayId = $jsonResponse->{'gatewayId'};
	$bankErrorCode = $jsonResponse->{'bankErrorCode'};
	$bankErrorMessage = $jsonResponse->{'bankErrorMessage'};

?>

<html>
<head>
        <!--Twitter Bootstrap resources-->
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js"></script>
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap.no-icons.min.css" rel="stylesheet">

        <style type="text/css">
          .center {
           float: none;
           margin-left: auto;
           margin-right: auto; 
        }
        </style>
</head>

<body>
    <div class="span7 center">
    	<table class="table table-striped table-hover">  
        <br/>
    		<caption><b>Juspay Payment Status</b></caption>
            <tbody>
              <tr>  
                <td><b>MerchantId</b></td> 
                <td><?php echo $merchantId ?></td>  
              </tr>
            <tr>  
                <td><b>CustomerId</b></td> 
                <td><?php echo $customerId ?></td>  
              </tr> 
            <tr>  
                <td><b>OrderId</b></td> 
                <td><?php echo $orderId ?></td>  
          	</tr>
            <tr>  
                <td><b>Status</b></td> 
                <td><?php  echo $status ?></td>  
          	</tr>      	
            <tr>  
                <td><b>StatusId</b></td> 
                <td><?php echo $statusId ?></td>  
          	</tr>
            <tr>  
                <td><b>Amount</b></td> 
                <td><?php echo $amount ?></td>  
          	</tr>
            <tr>  
                <td><b>Refunded</b></td> 
                <td><?php echo $refunded ?></td>  
          	</tr>
            <tr>  
                <td><b>Amount Refunded</b></td> 
                <td><?php echo $amountRefunded ?></td>  
          	</tr>
            <tr>  
                <td><b>Return Url</b></td> 
                <td><?php echo $returnUrl ?></td>  
          	</tr>
            <tr>  
                <td><b>Udf1</b></td> 
                <td><?php echo $udf1 ?></td>  
          	</tr>
            <tr>  
                <td><b>Udf2</b></td> 
                <td><?php echo $udf2 ?></td>  
          	</tr>
            <tr>  
                <td><b>Udf3</b></td> 
                <td><?php echo $udf3 ?></td>  
          	</tr>
            <tr>  
                <td><b>TxnId</b></td> 
                <td><?php echo $txnId ?></td>  
          	</tr>
            <tr>  
                <td><b>GatewayId</b></td> 
                <td><?php echo $gatewayId ?></td>  
          	</tr>
            <tr>  
                <td><b>Bank Error Code</b></td> 
                <td><?php echo $bankErrorCode ?></td>  
          	</tr>
            <tr>  
                <td><b>Bank Error Message</b></td> 
                <td><?php echo $bankErrorMessage ?></td>  
          	</tr>    	      	      	
          </table> 
    </div>
</body>
</html>