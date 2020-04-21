Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

$(function() {
    var person = {
        customerid: localStorage.getItem("customerId"),
    }

    jQuery.ajax({
        url: SERVICE_URL + 'PgCustomGoldLoan/GetOnlineAvailLoansByCustomerId',
        url: SERVICE_URL + 'PgCustomGoldLoan/GetBankDetailsByCustomerId',
        contentType: 'application/json',   
        method: "POST",
        data: JSON.stringify(person),
        beforeSend: function (xhr) {
           xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
        },
        error: function(xhr, status, error) {
            $("#NoAccountBlock").show('slow');
            $("#AccountBlock").hide();
            return false;
        },
        success: function(data) {    
            $("#AccountBlock").show('slow');     
            $('#ifscCode').html(data['data']['ifscCode']);
            $('#accountNumber').html(data['data']['accountNumber']);
            $('#accountHolder').html(data['data']['accountHolder']);
            $('#bankName').html(data['data']['bank']['description'] + ', ' + data['data']['address']);
            $('.spinner-search').hide();            
        }
    });

    $("#udf1").val(localStorage.getItem("customerName"));
    $("#customer_email").val(localStorage.getItem("email"));
    $("#customer_phone").val(localStorage.getItem("mobile"));
    $("#customerId").val(localStorage.getItem("customerId"));
    $("#udf4").val(localStorage.getItem("location"));



    $(".close").click(function() {
        $(this).parent().parent().hide("slow");
    });


});