/**
	Configuration for Muthoot
*/

var SERVICE_URL = "http://192.100.100.60/api/";
var AUTHENTICATION_PASSWORD = "ZYHWiOqBYiHORTVkmNarVeTrYHTLfp38";

var SERVICE_URL = "https://muthootdev.azure-mobile.net/api/";
var AUTHENTICATION_PASSWORD = "JODKFspBxMyxtIrHIqVSEExBzKfGlR50";

var DOMAIN_URL = "http://staging.experionglobal.com/Muthoot/";
var MAIL_SERVICE_URL = DOMAIN_URL + "Mail/";

var PROCESSING_FEE = 10;

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}

function makeBaseAuth(user, pswd){ 
    var token = user + ':' + pswd;
    var hash = "";
    if (btoa) {
       hash = btoa(token);
    }
    return "Basic " + hash;
}

function getServiceCharge(amount){
    if(amount < 2000) return (amount * 0 / 100);
    return (amount * 0.8 / 100);
}

function getNetBankingServiceCharge(amount){
    if(amount < 2000) return (amount * 0 / 100);
    return (amount * 0.8 / 100);
}

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function PrintElem(elem)
{
    w=window.open(null, 'MuthootOne', '');  
    var x = '<link rel="stylesheet" href="'+ DOMAIN_URL +'bootstrap/css/bootstrap.min.css">' +
    '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">' +
    '<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">' +
    '<link rel="stylesheet" href="'+ DOMAIN_URL +'plugins/datatables/dataTables.bootstrap.css">' +
    '<link rel="stylesheet" href="'+ DOMAIN_URL +'dist/css/AdminLTE.min.css">' +
    '<link rel="stylesheet" href="'+ DOMAIN_URL +'dist/css/skins/_all-skins.min.css">' +
    '<style type="text/css">table, .box-title {font-size: .8em !important;} .box-title {font-weight: bold} .removeHeader {display:none} </style>';
    w.document.write( x + $(elem).html() );

    setTimeout(function(){ w.print(); w.close() }, 1000);
}


function showLoanStatements(loanId){ 
    $('.spinner-search').show();
    var data = {
            loanId: loanId,
            //loanId: "3e32a621-183c-45f8-bc7c-f43f144cb181",
        }
    
        jQuery.ajax({
            url: SERVICE_URL + 'PgCustomGoldLoan/GetPaymentHistoryByLoanId',
            method: "POST",    
            contentType: 'application/json',   
            data: JSON.stringify(data),                    
            beforeSend: function (xhr) {
               xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
            },
            error: function(xhr, status, error) {
                return false;
            },
            success: function(data) {
              $('.appneded').remove();
              $('.loanStatements').show('slow');     
              
               $(".mainBox").after($('.loanStatements'));

                if(data['status'] == "1"){
                    $("#name").html(data['data']['glCustomerDto']['firstName']); 
                    if(data['data']['glCustomerDto'].hasOwnProperty('lastName')){
                        $("#name").html($("#name").html() + ' ' +  data['data']['glCustomerDto']['lastName']);
                    }
                    $("#address").html(data['data']['glCustomerDto']['addressOne']);

                    var itemName = ""; 
                    for(i=0; i<data['data']['glLoanDto']['glLoanDetail'].length; i++){
                        itemName += data['data']['glLoanDto']['glLoanDetail'][i]['glItem']['itemName'] + ", ";
                    }

                    $("#description").html(itemName.slice(0, -2)); 
                    $("#scheme_name").html(data['data']['glLoanDto']['glScheme']['schemeName'].toUpperCase()); 

                    $("#pledge_no").html(data['data']['glLoanDto']['loanNumber']); 
                    $("#pledge_date").html(new Date(data['data']['glLoanDto']['startDate']).format("d-M-Y")); 
                    $("#pledge_value").html(data['data']['glLoanDto']['loanAmount'].format(2, 3)); 
                    $("#net_weight").html(data['data']['glLoanDto']['netWeight']); 

                    $("#branch_name").html(data['data']['glLoanDto']['branch']['name']); 
                    $("#branch_code").html(data['data']['glLoanDto']['branch']['code']); 

                    $("#current_date").html(new Date().format("d-M-Y h:i A"));

                    var Description = "AMOUNT PAID"; 
                    $('#StatementTable tr:last').after('<tr class="appneded">' +
                          '<td>' + new Date(data['data']['glLoanDto']['startDate']).format("d-M-Y") + '</td>' +
                          '<td>' + Description + '</td>' +
                          '<td>' + data['data']['glLoanDto']['loanAmount'].format(2, 3) + '</td>' +
                          '<td></td>' +
                          '<td>' + data['data']['glLoanDto']['loanAmount'].format(2, 3) + '</td>' +
                          '</tr>');

                    var Description = "INTEREST ADDED TILL DATE (" + new Date().format("d-M-Y") +")"; 
                    $('#StatementTable tr:last').after('<tr class="appneded">' +
                          '<td>' + new Date(data['data']['glLoanDto']['startDate']).format("d-M-Y") + '</td>' +
                          '<td>' + Description + '</td>' +
                          '<td>' + data['data']['glLoanDto']['interestTillDate'].format(2, 3) + '</td>' +
                          '<td></td>' +
                          '<td>' + (data['data']['glLoanDto']['loanAmount'] + data['data']['glLoanDto']['interestTillDate']).format(2, 3) + '</td>' +
                          '</tr>');
                    var balanceAmount = data['data']['glLoanDto']['loanAmount'] + data['data']['glLoanDto']['interestTillDate'];
                    for(var index in data['data']['glPaymentHistoryDto']) { 

                        var loanAmount = 0;
                        if(data['data']['glPaymentHistoryDto'][index].hasOwnProperty('loanAmount')){
                          loanAmount = data['data']['glPaymentHistoryDto'][index]['loanAmount'];
                        }

                        var loanInterest = 0;
                        if(data['data']['glPaymentHistoryDto'][index].hasOwnProperty('loanInterest')){
                          loanInterest = data['data']['glPaymentHistoryDto'][index]['loanInterest'];
                        }

                        balanceAmount -= (loanAmount + loanInterest);

                        var isPaidOnline = false;
                        if(data['data']['glPaymentHistoryDto'][index].hasOwnProperty('isPaidOnline')){
                            isPaidOnline = data['data']['glPaymentHistoryDto'][index]['isPaidOnline'];
                        }

                        if(isPaidOnline){
                            var paymentProcessType = "Online";
                            if(data['data']['glPaymentHistoryDto'][index].hasOwnProperty('paymentProcessType')){
                                paymentProcessType = data['data']['glPaymentHistoryDto'][index]['paymentProcessType'];
                            }
                            Description = paymentProcessType;
                        }else {
                            Description = "CASH RCVD";
                        }

                        var transactionNumber = data['data']['glPaymentHistoryDto'][index]['transactionNumber'];
                        if(transactionNumber == 0){
                            transactionNumber = data['data']['glPaymentHistoryDto'][index]['id'];
                        }

                        if (transactionNumber) {
                            Description += " -- " + transactionNumber
                        }
                        /*
                        var balanceAmount = 0;
                        if(data['data']['glPaymentHistoryDto'][index].hasOwnProperty('balanceAmount')){
                          balanceAmount = data['data']['glPaymentHistoryDto'][index]['balanceAmount'];
                        }
                        */
                        $('#StatementTable tr:last').after('<tr class="appneded">' +
                          '<td>' + new Date(data['data']['glPaymentHistoryDto'][index]['transationDate']).format("d-M-Y") + '</td>' +
                          '<td>' + Description + '</td>' +
                          '<td></td>' +
                          '<td>' + (loanAmount + loanInterest).format(2, 3) + '</td>' +
                          '<td>' + balanceAmount.format(2, 3) + '</td>' +
                          '</tr>');
                    }
                }
                $('.spinner-search').hide();
            }
    });
}


function showEmiLoanStatements(loanId){ 
    $('.spinner-search').show();
    var data = {
            loanId: loanId,
        }
    
        jQuery.ajax({
            url: SERVICE_URL + 'PgCustomGoldLoan/GetEmiPaymentHistoryByLoanId',
            method: "POST",    
            contentType: 'application/json',   
            data: JSON.stringify(data),                    
            beforeSend: function (xhr) {
               xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
            },
            error: function(xhr, status, error) {
                return false;
            },
            success: function(data) {
              $('.appneded').remove();
              $('.loanStatements').show('slow');     
              
               $(".mainBox").after($('.loanStatements'));

                if(data['status'] == "1"){
                    $("#name").html(data['data']['glCustomerDto']['firstName']); 
                    if(data['data']['glCustomerDto'].hasOwnProperty('lastName')){
                        $("#name").html($("#name").html() + ' ' +  data['data']['glCustomerDto']['lastName']);
                    }
                    $("#address").html(data['data']['glCustomerDto']['addressOne']);

                    var itemName = ""; 
                    for(i=0; i<data['data']['glLoanDto']['glLoanDetail'].length; i++){
                        itemName += data['data']['glLoanDto']['glLoanDetail'][i]['glItem']['itemName'] + ", ";
                    }

                    $("#description").html(itemName.slice(0, -2)); 
                    $("#scheme_name").html(data['data']['glLoanDto']['glScheme']['schemeName'].toUpperCase()); 

                    $("#pledge_no").html(data['data']['glLoanDto']['loanNumber']); 
                    $("#pledge_date").html(new Date(data['data']['glLoanDto']['startDate']).format("d-M-Y")); 
                    $("#pledge_value").html(data['data']['glLoanDto']['loanAmount'].format(2, 3)); 
                    $("#net_weight").html(data['data']['glLoanDto']['netWeight']); 

                    $("#branch_name").html(data['data']['glLoanDto']['branch']['name']); 
                    $("#branch_code").html(data['data']['glLoanDto']['branch']['code']); 

                    $("#current_date").html(new Date().format("d-M-Y h:i A"));

                    var Description = "AMOUNT PAID"; 
                    $('#StatementTable tr:last').after('<tr class="appneded">' +
                          '<td>' + new Date(data['data']['glLoanDto']['startDate']).format("d-M-Y") + '</td>' +
                          '<td>' + Description + '</td>' +
                          '<td>' + data['data']['glLoanDto']['loanAmount'].format(2, 3) + '</td>' +
                          '<td></td>' +
                          '<td>' + data['data']['glLoanDto']['glScheme']['totalEmi'] + ' EMI' + '</td>' +
                          '</tr>');

                    var balance = data['data']['glLoanDto']['glScheme']['totalEmi'];
                    
                    for(var index in data['data']['emiPaymentDto']) { 

                        var isPaidOnline = false;
                        if(data['data']['emiPaymentDto'][index].hasOwnProperty('isPaidOnline')){
                            isPaidOnline = data['data']['emiPaymentDto'][index]['isPaidOnline'];
                        }

                        if(isPaidOnline){
                            var paymentProcessType = "Online";
                            if(data['data']['emiPaymentDto'][index].hasOwnProperty('paymentProcessType')){
                                paymentProcessType = data['data']['emiPaymentDto'][index]['paymentProcessType'];
                            }
                            Description = paymentProcessType;
                        }else {
                            Description = "CASH RCVD";
                        }

                        var transactionNumber = 0;
                        if(data['data']['emiPaymentDto'][index].hasOwnProperty('transactionNumber')){
                            var transactionNumber = data['data']['emiPaymentDto'][index]['transactionNumber'];
                        }                        
                        if(transactionNumber == 0){
                            transactionNumber = data['data']['emiPaymentDto'][index]['id'];
                        }

                        Description += " - " + transactionNumber;

                        var numberOfEmiPaid = 1;
                        if(data['data']['emiPaymentDto'][index].hasOwnProperty('numberOfEmiPaid')){
                            numberOfEmiPaid = data['data']['emiPaymentDto'][index]['numberOfEmiPaid']
                        }
                        balance -= numberOfEmiPaid;

                        paidAmount = data['data']['emiPaymentDto'][index]['paidAmount'];

                        var penaltyAmount = 0;
                        if(data['data']['emiPaymentDto'][index].hasOwnProperty('penaltyAmount')){
                            var penaltyAmount = data['data']['emiPaymentDto'][index]['penaltyAmount'];
                        }   
                        paidAmount += penaltyAmount;

                        var discountAmount = 0;
                        if(data['data']['emiPaymentDto'][index].hasOwnProperty('discountAmount')){
                            var discountAmount = data['data']['emiPaymentDto'][index]['discountAmount'];
                        }   
                        paidAmount -= discountAmount;


                        $('#StatementTable tr:last').after('<tr class="appneded">' +
                          '<td>' + new Date(data['data']['emiPaymentDto'][index]['date']).format("d-M-Y") + '</td>' +
                          '<td>' + Description + '</td>' +
                          '<td></td>' +
                          '<td>' + paidAmount.format(2,3) + '</td>' +
                          '<td>' + balance + ' EMI</td>' +
                          '</tr>');
                    }
                }
                $('.spinner-search').hide();
            }
    });
}


    $(function() {
        if(localStorage.getItem("customerName") == null && location.href.match("login|register|forgot") == null){
            location.href = "login.html";
        }
        
        $(".logout").click(function(){
            localStorage.removeItem("customerName");
            localStorage.removeItem("mobile");
            localStorage.removeItem("customerId");
            location.href = "login.html";
        });

        $(".customer-name").html(localStorage.getItem("customerName"));      

        //$("body").css("font-size", "12px");

    });

/**	
	MailGun

	Gmail
	User: muthoot.mercantile@gmail.com
	Pass: @Muthoot123

	http://smshorizon.co.in/api/sendsms.php?user=dearnechu&apikey=IkHvmEoi94uTkG21xcDB&mobile=9895933511&message=Testing&senderid=MYTEXT&type=txt 9182302

	Login URL: http://smshorizon.co.in 
	Username: dearnechu 
	Password: 832711 (Change after logging in)

	%%site_url%% -> http://localhost/Muthoot

	Terms and conditions
	Email address -> @muthootenterprises.com
	website details -
		-> Add links
		-> Cpanel Details
		-> FTP Credentials
	
	SMS API

	Forgot Password
	Local Storage to session Storage
	language JS

    SSH: ssh azureuser@muthootone.cloudapp.net
    Pass: @Magento123456789

    TEST admin
    URL: 

    http://xpresssms.in/
    muthootmercantile
    muthootmercantile@123
    http://sms.xpresssms.in/api/api.php?ver=1&mode=1&action=push_sms&type=1&route=2&login_name=muthootmercantile&api_password=37d5822068b86f5c7316&message=Test%20Message&number=9895933511&sender=mthoot


	https://sftp.axisbank.com/MUTHOOTML
	User id:- corpdemo
	utibank

	URL : https://qas2axis.axisbank.co.in/irj/portal
	User_Id: DEMOCORP133_USER1
	welcome@5
*/