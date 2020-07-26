Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

$(function() {
    var v1 = {
        customerId: localStorage.getItem("customerId"),
    }

    var v2 = {
        userid: localStorage.getItem("customerId"),
    }

    jQuery.ajax({
        url: SERVICE_URL + 'PgCustomGoldLoan/GetBankDetailsByCustomerId',
        contentType: 'application/json',   
        method: "POST",
        data: JSON.stringify(v1),
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
            jQuery.ajax({
                url: SERVICE_URL + 'PgCustomGoldLoan/GetAmountAvailableByCustId',
                contentType: 'application/json',
                method: "POST",
                data: JSON.stringify(v2),
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
                },
                error: function (xhr, status, error) {
                    $("#NoAccountBlock").show('slow');
                    $("#AccountBlock").hide();
                    return false;
                },
                success: function (data) {
                    console.log(data.data);

                    var dataSet = new Array();
                    for (var index in data['data']) {

                        var loanNumber = "<a class='best' href='javascript:showEmiDetails(\"" + data['data'][index]['id'] + "\")'>" + data['data'][index]['loanNumber'] + "</a>";

                        if (!data['data'][index]['isEmi']) {
                            loanNumber = "<a class='best' href='javascript:showLoanDetails(" + data['data'][index]['loanNumber'] + ", \"" + data['data'][index]['branchId'] + "\", \"" + data['data'][index]['companyId'] + "\")'>" + data['data'][index]['loanNumber'] + "</a>";
                        }

                        dataSet.push([
                            loanNumber,
                            new Date(data['data'][index]['startDate']).format("d-M-Y"),
                            data['data'][index]['loanAmount'].format(2, 3),
                            data['data'][index]['availLoan'].format(2, 3),
                            new Date(data['data'][index]['revisedDate']).format("d-M-Y"),
                            data['data'][index]['glScheme']['schemeName'].toUpperCase(),
                        ]);
                    }
                    pageCount = 3;
                    if (index > 9) {
                        pageCount = 5;
                    }
                    var table = $('#LoanTable').DataTable({
                        "pageLength": pageCount,
                        "data": dataSet,
                        "paging": dataSet.length > pageCount,
                        "lengthChange": false,
                        "searching": true,
                        "ordering": false,
                        "info": dataSet.length > pageCount,
                        "autoWidth": false,
                    });
                    $("#LoanTable_wrapper .row .col-sm-6:first-child").append("<label> Online Payment </label><i> (Click over the loan account no for online gold loan) </i>");
                    $('.spinner-search').hide();

                    setTimeout(function () { $(".pg-message").hide("slow"); }, 10000);

                    $('#LoanTable tbody').on('click', 'tr', function () {
                        if ($(this).hasClass('bg-gray')) {
                            $(this).removeClass('bg-gray');
                        }
                        else {
                            table.$('tr.bg-gray').removeClass('bg-gray');
                            $(this).addClass('bg-gray');
                        }
                    });                        
                }
            });
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