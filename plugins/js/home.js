Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

var minimumInterestToBePaid = 0;
var total = 0;
var nbtotal = 0;
var emiId = "";

$(function() {
    var person = {
        userId: localStorage.getItem("customerId"),
        //userId: "9E3A0B3B-8ABB-4C64-A13A-A7AAF30472EC"
    }
    $("#PartAmount").val('');

    //Flat red color scheme for iCheck
    $('input[type="radio"].flat-red').iCheck({
      radioClass: 'iradio_flat-green'
    });

    jQuery.ajax({
        url: SERVICE_URL + 'PgCustomGoldLoan/GetLoansByCustomerId',
        contentType: 'application/json',   
        method: "POST",
        data: JSON.stringify(person),
        beforeSend: function (xhr) {
           xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
        },
        error: function(xhr, status, error) {
            return false;
        },
        success: function(data) {         
            var dataSet = new Array();         
            for(var index in data['data']) { 
               
                var loanNumber = "<a class='best' href='javascript:showEmiDetails(\""+ data['data'][index]['id'] +"\")'>" + data['data'][index]['loanNumber'] + "</a>";
                var loanStatements = "<a href='javascript:showEmiLoanStatements(\""+ data['data'][index]['id'] +"\")'> View </a>";

                if(!data['data'][index]['isEmi']){
                    loanNumber = "<a class='best' href='javascript:showLoanDetails(" + data['data'][index]['loanNumber'] + ", \"" + data['data'][index]['branchId'] + "\", \"" + data['data'][index]['companyId'] + "\")'>" + data['data'][index]['loanNumber'] + "</a>";
                    loanStatements = "<a href='javascript:showLoanStatements(\""+ data['data'][index]['id'] +"\")'> View </a>";
                }
                dataSet.push([
                    loanNumber, 
                    new Date(data['data'][index]['startDate']).format("d-M-Y"), 
                    data['data'][index]['loanAmount'].format(2, 3), 
                    new Date(data['data'][index]['revisedDate']).format("d-M-Y"), 
                    data['data'][index]['glScheme']['schemeName'].toUpperCase(),
                    loanStatements
                    
                ]);
            }
            pageCount = 3;
            if(index > 9){
              pageCount = 5;
            }
            var table = $('#LoanTable').DataTable( {
                "pageLength" : pageCount,
                "data": dataSet,
                "paging": dataSet.length > pageCount,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": dataSet.length > pageCount,
                "autoWidth": false,
            });     
            $("#LoanTable_wrapper .row .col-sm-6:first-child").append("<label> Online Payment </label><i> (Click over the loan account no for making payment) </i>");
            $('.spinner-search').hide();   
            
            setTimeout(function() {  $(".pg-message").hide("slow");  }, 10000);   

            $('#LoanTable tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('bg-gray') ) {
                    $(this).removeClass('bg-gray');
                }
                else {
                    table.$('tr.bg-gray').removeClass('bg-gray');
                    $(this).addClass('bg-gray');
                }
            });            
        }
    });

    $("#udf1").val(localStorage.getItem("customerName"));
    $("#customer_email").val(localStorage.getItem("email"));
    $("#customer_phone").val(localStorage.getItem("mobile"));
    $("#customerId").val(localStorage.getItem("customerId"));
    $("#udf4").val(localStorage.getItem("location"));

    $("#EmiPayment").click(function() { 
        $(".emipayment").show();

        $("#vpc_MerchTxnRef").val("MGEMI" + "-" + new Date().format("YmdHis") );
        storesession("payment_type", "EMI");      
        storesession("payInstallments", $("#payInstallments").val());

        var form = "#";
        if($('.EMIType').prop('checked')) { 
            form += "PG";
            storesession("service_charge", $("#EmiServiceCharge").html());
        } else { 
            form += "NB"; 
            storesession("service_charge", 0);
        }

        $("#PG").submit();

    });

    $( "#FullPayment" ).click(function() { 
        $(".fullpayment").show();
        $("#vpc_MerchTxnRef").val("MGLFULL" + "-" + new Date().format("YmdHis") );

        storesession("payment_type", "FULL");
        
        if($('.FullPType').prop('checked')) { 
            storesession("service_charge", $("#service_charge").html());
            $("#vpc_Amount").val(total.toFixed(2));
            $("#vpc_mdd").val("DC");
            
        } else { 
            storesession("service_charge", $("#net_service_charge").html());
            $("#vpc_Amount").val(nbtotal.toFixed(2));
            $("#vpc_mdd").val("NB");
        }
        
        $("#PG").submit();
    });

    /*  $( ".PaymentType" ).on("ifChecked", function() {
        if($(this).val() == "FP"){
            $(".FPElements").show();
            $(".PPElements").hide();
        }
        else{
            $(".FPElements").hide();
            $(".PPElements").show();
        }
    }); */

    $('.EMIType').on('ifChecked', function(event){
        if($(this).val() == "NB"){
            $(".EMIPGSCharge, .EMIPGTotal").hide();
            $(".EMINBSCharge, .EMINBTotal").show();
            $('.FullPType').prop('disabled', false);
        }
        else{
            $(".EMIPGSCharge, .EMIPGTotal").show();
            $(".EMINBSCharge, .EMINBTotal").hide();                 
        }
    });

    $('.FullPType').on('ifChecked', function(event){
        if($(this).val() == "NB"){
            $(".FPGSCharge, .FPGTotal").hide();
            $(".FNBSCharge, .FNBTotal").show();
        }
        else{
            $(".FPGSCharge, .FPGTotal").show();
            $(".FNBSCharge, .FNBTotal").hide();
        }
    });

    var part_total = 0;
    $( "#PartPayment" ).click(function() { 
        if($.trim($("#PartAmount").val()) < 1){
            $("#PartAmount").focus();
            $(".part-payment-error").show();
            return false;;
        }   
        if($.trim($("#PartAmount").val()) < minimumInterestToBePaid){
            $("#PartAmount").focus();
            $(".part-payment-error").show();
            return false;;
        }   
        if($.trim($("#PartAmount").val()) > total){
            $("#PartAmount").focus();
            $(".part-payment-error").show();
            return false;;
        }   
        $(".part-payment-error").hide();
        $(".partpayment").show();
        $("#amount").val($("#NB_part_total").html());
        $("#vpc_MerchTxnRef").val("MGLPART" + "-" + new Date().format("YmdHis") );
        
        storesession("payment_type", "PART");
        
        if($('.PartPType').prop('checked')) { 
            storesession("service_charge", $("#part_service_charge").html());
            $("#vpc_mdd").val("DC");
            $("#vpc_Amount").val(part_total.toFixed(2));
        } else { 
            storesession("service_charge", $("#part_net_service_charge").html()); 
            $("#vpc_mdd").val("NB");
            $("#vpc_Amount").val(net_part_total.toFixed(2));
        }
        
        $("#PG").submit();
    });

    $('.PartPType').on('ifChecked', function(event){
        if($(this).val() == "NB"){
            $(".PPGSCharge, .PPGTotal").hide();
            $(".PNBSCharge, .PNBTotal").show();
        }
        else{
            $(".PPGSCharge, .PPGTotal").show();
            $(".PNBSCharge, .PNBTotal").hide();                 
        }
    });

    $(".close").click(function() {
        $(this).parent().parent().hide("slow");
    });

    $('#PartAmount').on('keyup blur change', function(e) {
        var service_charge = getServiceCharge($(this).val());
        $("#part_service_charge").html(service_charge.format(2,3));
        
        var net_service_charge = getNetBankingServiceCharge($(this).val());
        $("#part_net_service_charge").html(net_service_charge.format(2,3));

        part_total = ($(this).val() * 1) + service_charge;
        net_part_total = ($(this).val() * 1) + net_service_charge;
        $("#PG_part_total").html(part_total.format(2,3));
        $("#NB_part_total").html(net_part_total.format(2,3));
        $(".part-payment-error").hide();
    });

    $("#payInstallments").on("change", function(e) {
        $(".emipayment").show();
        CalculateEmiInterestOnline($(this).val());
    });


});
function showEmiDetails(loanNo){ 
    $('.spinner-search').show();
    $('.emipayment').show();
    
    var data = {
            loanId: loanNo,
        }
    
    jQuery.ajax({
        url: SERVICE_URL + 'PgCustomGoldLoan/GetEmiGoldLoanDetailsWeb',
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
            $(".mainBox").after($('.emiDetails'));
            $('.emiDetails').show('slow');                    
            if(data['status'] == "1"){
                $("#emi_number").html(data['data']['loanNumber']);
                emiId = data['data']['id'];

                $("#noOfInstallments").html(data['data']['paidInstallment'] + " / " + data['data']['noOfInstallments']);
                $("#emiMonthlyInstallment").html(Math.round(data['data']['emiMonthlyInstallment']).format(2, 3));

                var service_charge = getServiceCharge(data['data']['emiMonthlyInstallment']);
                $("#EmiServiceCharge").html(service_charge.format(2, 3)); 

                $('#payInstallments').empty();
                for(i=1; i<=(data['data']['noOfInstallments'] - data['data']['paidInstallment']); i++) { 
                    $('#payInstallments').append($('<option/>', { 
                        value: i,
                        text : i 
                    }));
                } 

                total = data['data']['emiMonthlyInstallment'] + service_charge;
                $("#emipgtotal").html("<b>" + total.format(2, 3) + "</b>");  
                $("#eminbtotal").html("<b>" + data['data']['emiMonthlyInstallment'].format(2, 3) + "</b>"); 

                CalculateEmiInterestOnline($("#payInstallments").val()); 
                            
            }
        }
    });
}

function CalculateEmiInterestOnline(numberOfinstallmentPaid){
    var data = {  
            "loanId": emiId,
            "numberOfinstallmentPaid": numberOfinstallmentPaid,
        }

        jQuery.ajax({
            url: SERVICE_URL + 'PgCustomGoldLoan/CalculateEmiInterestOnline',
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
                var penalty = 0;
                if(data.hasOwnProperty('penalty')){
                    penalty = Math.round(data['penalty']);
                }

                var discount = 0;
                if(data.hasOwnProperty('discount')){
                    discount = Math.round(data['discount']);
                }

                $("#penalty").html(penalty.format(2, 3));
                $("#discount").html("-" + discount.format(2, 3));

                var service_charge = getServiceCharge(data['totalAmountTobepaid']);
                $("#EmiServiceCharge").html(service_charge.format(2, 3)); 

                total = Math.round(data['totalAmountTobepaid']) + service_charge;
                $("#emipgtotal").html("<b>" + total.format(2, 3) + "</b>");  
                $("#eminbtotal").html("<b>" + Math.round(data['totalAmountTobepaid']).format(2, 3) + "</b>");  

                $("#vpc_Amount").val(total.toFixed(2));
                $("#amount").val(data['totalAmountTobepaid'].toFixed(2));

                storesession("payment", data);
                
                $('.spinner-search, .emipayment').hide();
            }
        });
}

function showLoanDetails(loanNo, branchId, companyId){ 
    $('.spinner-search').show();
    var data = {
            loanNumber: loanNo,
            branchId : branchId,
            companyId: companyId,
            customerId: localStorage.getItem("customerId"),
            logindate : new Date().toISOString()
        }
    
    jQuery.ajax({
            url: SERVICE_URL + 'PgCustomGoldLoan/GetGoldLoanDetailsWeb',
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
              $(".mainBox").after($('.loanDetails'));
              $('.loanDetails').show('slow');                    
              if(data['status'] == "1"){
                $("#loan_number").html(loanNo);

                var goldLoanAmountRemaining = 0;
                if(data['data'].hasOwnProperty('goldLoanAmountRemaining')){
                    goldLoanAmountRemaining = data['data']['goldLoanAmountRemaining'];
                }
                $("#principle_amount").html(goldLoanAmountRemaining.format(2, 3));
                
                var goldLoanInterestDue = 0;
                if(data['data'].hasOwnProperty('goldLoanInterestDue')){
                    goldLoanInterestDue = data['data']['goldLoanInterestDue'];
                    if(goldLoanInterestDue <= 5) {
                        goldLoanInterestDue = 5;
                    }
                }

                $("#interest").html(goldLoanInterestDue.format(2, 3));  
                var service_charge = getServiceCharge(goldLoanAmountRemaining + goldLoanInterestDue);
                $("#service_charge").html(service_charge.format(2, 3));  

                var net_service_charge = getNetBankingServiceCharge(goldLoanAmountRemaining + goldLoanInterestDue);
                $("#net_service_charge").html(net_service_charge.format(2, 3));  
                
                nbtotal = goldLoanAmountRemaining + goldLoanInterestDue + net_service_charge;
                total = goldLoanAmountRemaining + goldLoanInterestDue + service_charge;

                $("#vpc_Amount").val(total.toFixed(2));
                $("#amount").val((goldLoanAmountRemaining + goldLoanInterestDue).toFixed(2));
                $("#pgtotal").html("<b>" + total.format(2, 3) + "</b>");  
                $("#nbtotal").html("<b>" + nbtotal.format(2, 3) + "</b>");  
                minimumInterestToBePaid = 0;
                if(data['data'].hasOwnProperty('minimumInterestToBePaid')){
                    minimumInterestToBePaid = data['data']['minimumInterestToBePaid'];
                }
                $("#minimum_interest_amount").html(minimumInterestToBePaid.format(2, 3));  
                $("#total_payable_amount").html(total.format(2,3));  
                $('.spinner-search, .fullpayment, .partpayment').hide();
                storesession("payment", data['data']);
              }
            }
    });
}

function storesession(tag, data) {
  var session_data = {
            tag: tag,
            data: data
      }
  
  jQuery.ajax({
            url: 'storesession.php',
            method: "POST",    
            contentType: 'application/json',   
            data: JSON.stringify(session_data),                    
            error: function(xhr, status, error) {
                return false;
            },
            success: function(data) {
              return true;
            }
  });
}
