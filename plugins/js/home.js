Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

var minimumInterestToBePaid = 0;
var total = 0;

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
                dataSet.push([
                    "<a class='best' href='javascript:showLoanDetails("+ data['data'][index]['loanNumber'] +", \"" + data['data'][index]['branchId'] + "\")'>" + data['data'][index]['loanNumber'] + "</a>", 
                    new Date(data['data'][index]['startDate']).format("d-M-Y"), 
                    data['data'][index]['loanAmount'].format(2, 3), 
                    new Date(data['data'][index]['revisedDate']).format("d-M-Y"), 
                    data['data'][index]['glScheme']['schemeName'].toUpperCase(),
                    "<a href='javascript:showLoanStatements(\""+ data['data'][index]['id'] +"\")'> View </a>"
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
    $("#udf2").val(localStorage.getItem("email"));
    $("#udf3").val(localStorage.getItem("mobile"));
    $("#udf4").val(localStorage.getItem("location"));

    
    $( "#FullPayment" ).click(function() { 
        $(".fullpayment").show();
        $("#vpc_MerchTxnRef").val("MGLFULL" + "-" + new Date().format("YmdHis") );
        
        storesession("payment_type", "FULL");
        
        var form = "#";
        if($('.FullPType').prop('checked')) { 
            form += "PG";
            storesession("service_charge", $("#service_charge").html());
        } else { 
            form += "NB"; 
            storesession("service_charge", 0);
        }
        
        $(form).submit();
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
        $("#vpc_Amount").val(part_total.toFixed(2) * 100);
        $("#amount").val($("#NB_part_total").html());
        $("#vpc_MerchTxnRef").val("MGLPART" + "-" + new Date().format("YmdHis") );
        
        storesession("payment_type", "PART");
        
        var form = "#";
        if($('.PartPType').prop('checked')) { 
            form += "PG";
            storesession("service_charge", $("#part_service_charge").html());
        } else { 
            form += "NB";
            storesession("service_charge", 0); 
        }
        
        $(form).submit();
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
        part_total = ($(this).val() * 1) + service_charge;
        $("#PG_part_total").html(part_total.format(2,3));
        $("#NB_part_total").html(($(this).val() * 1).toFixed(2));
        $(".part-payment-error").hide();
    });


});

function showLoanDetails(loanNo, branchId){ 
    $('.spinner-search').show();
    var data = {
            loanNumber: loanNo,
            branchId : branchId,
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
                }

                $("#interest").html(goldLoanInterestDue.format(2, 3));  
                var service_charge = getServiceCharge(goldLoanAmountRemaining + goldLoanInterestDue);
                $("#service_charge").html(service_charge.format(2, 3));  
                
                nbtotal = goldLoanAmountRemaining + goldLoanInterestDue;
                total = nbtotal + service_charge;

                $("#vpc_Amount").val(total.toFixed(2) * 100);
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
