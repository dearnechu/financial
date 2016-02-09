/**
	Configuration for Muthoot
*/

var SERVICE_URL = "http://192.100.100.60/api/";
var AUTHENTICATION_PASSWORD = "ZYHWiOqBYiHORTVkmNarVeTrYHTLfp38";

var SERVICE_URL = "https://muthootlive.azure-mobile.net/api/";
var AUTHENTICATION_PASSWORD = "ZYHWiOqBYiHORTVkmNarVeTrYHTLfp38";

var MAIL_SERVICE_URL = "http://staging.experionglobal.com/Muthoot/Mail/";

var PROCESSING_FEE = 10;

function makeBaseAuth(user, pswd){ 
    var token = user + ':' + pswd;
    var hash = "";
    if (btoa) {
       hash = btoa(token);
    }
    return "Basic " + hash;
}

function getServiceCharge(amount){
    if(amount < 2000) return (amount * 0.75 / 100);
    return (amount * 1 / 100);
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
    var x = '<link rel="stylesheet" href="http://staging.experionglobal.com/Muthoot/bootstrap/css/bootstrap.min.css">' +
    '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">' +
    '<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">' +
    '<link rel="stylesheet" href="http://staging.experionglobal.com/Muthoot/plugins/datatables/dataTables.bootstrap.css">' +
    '<link rel="stylesheet" href="http://staging.experionglobal.com/Muthoot/dist/css/AdminLTE.min.css">' +
    '<link rel="stylesheet" href="http://staging.experionglobal.com/Muthoot/dist/css/skins/_all-skins.min.css">' +
    '<style type="text/css">table, .box-title {font-size: .8em !important;} .box-title {font-weight: bold} .removeHeader {display:none} </style>';
    w.document.write( x + $(elem).html() );

    setTimeout(function(){ w.print(); w.close() }, 1000);
}

    $(function() {
        if(localStorage.getItem("customerName") == null && location.href.match("login|register|forgot") == null){
            location.href = "login.html";
        }
        
        $(".logout").click(function(){
            localStorage.removeItem("customerName");
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

	TTS: SAM 006 MHT

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
    Pass: @Muthoot123

    TEST admin
    URL: 

    http://xpresssms.in/
    muthootmercantile
    muthootmercantile
    http://sms.xpresssms.in/api/api.php?ver=1&mode=1&action=push_sms&type=1&route=2&login_name=muthootmercantile&api_password=37d5822068b86f5c7316&message=Test%20Message&number=9895933511&sender=mthoot


*/