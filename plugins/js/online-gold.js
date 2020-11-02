Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};
var minimumInterestToBePaid = 1; // 1000
var maxTopupAmount = 50000;
var AvailLoan = 0;
var LoanNo = null;
var CompanyId = null;
var BranchId = null;
var GoldLoanAmount = null;
var GoldLoanInterestDue = null;
$(function() {
    var v1 = {
        customerId: localStorage.getItem("customerId"),
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
            $("#AccountListBlock").hide();
            return false;
        },
        success: function(data) {    
            $("#AccountBlock").show('slow');
            $("#AccountListBlock").show('slow');
            $('#ifscCode').html(data['data']['ifscCode']);
            $('#accountNumber').html(data['data']['accountNumber']);
            $('#accountHolder').html(data['data']['accountHolder']);
            $('#bankName').html(data['data']['bank']['code'] + ', ' + data['data']['branch']);
            $('.spinner-search').hide();
            storesession('GetBankDetailsByCustomerId', data['data']);
            getList();
        }
    });

    storesession('customer_email', localStorage.getItem("email"));
    storesession('customer_phone', localStorage.getItem("mobile"));

    $(".close").click(function() {
        $(this).parent().parent().hide("slow");
    });

    $("#confirm").click(function() {
        if ($.trim($("#PartAmount").val()) < minimumInterestToBePaid) {
            $("#PartAmount").focus();
            $(".part-payment-error").show();
            return false;;
        }
        if (parseInt($.trim($("#PartAmount").val())) > parseInt(AvailLoan)) {
            $("#PartAmount").focus();
            $(".part-payment-error").show();
            return false;;
        }   
        $('#myModal').modal('toggle');
    });


    $("#PartPayment").click(function () {
        $('#myModal').modal('toggle');
        $(".part-payment-error").hide();
        $(".partpayment").show();

        var loanAmount = $.trim($("#PartAmount").val());
        storesession('loanAmount', loanAmount);

        var v2 = {
            loanid: LoanNo,
            paymentStatus: 'Success',
            PaymentProcessType: 'Top Up',
            paidAmount: GoldLoanAmount + GoldLoanInterestDue,
            goldLoanAmount: GoldLoanAmount,
            goldLoanAmountRemaining: GoldLoanAmount,
            goldLoanInterestDue: GoldLoanInterestDue
        }

        jQuery.ajax({
            url: SERVICE_URL + 'PgCustomGoldLoan/CloseGoldLoanForNewGL',
            contentType: 'application/json',
            method: "POST",
            data: JSON.stringify(v2),
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
            },
            error: function (xhr, status, error) {
                return false;
            },
            success: function (data) {
                var v2 = {
                    glLoanDto: {
                        id: LoanNo,
                        startDate: new Date().toISOString(),
                        loanAmount: loanAmount,
                        glCustomer: {
                            mobile: localStorage.getItem("mobile"),
                        }
                    }
                }

                jQuery.ajax({
                    url: SERVICE_URL + 'PgCustomGoldLoan/AddGoldLoan',
                    contentType: 'application/json',
                    method: "POST",
                    data: JSON.stringify(v2),
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
                    },
                    error: function (xhr, status, error) {
                        return false;
                    },
                    success: function (data) {
                        $(".partpayment").hide();
                        payments();
                        location.reload();
                    }
                });

            }
        });
    });

    $('#PartAmount').on('keyup blur change', function (e) {
        part_total = ($(this).val() * 1);
        $("#PG_part_total").html(part_total.format(2, 3));
        $(".part-payment-error").hide();
    });

});

function getList() {
    var v2 = {
        userid: localStorage.getItem("customerId"),
    }

    jQuery.ajax({
        url: SERVICE_URL + 'PgCustomGoldLoan/GetLoanAvailableByCustId',
        contentType: 'application/json',
        method: "POST",
        data: JSON.stringify(v2),
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
        },
        error: function (xhr, status, error) {
            return false;
        },
        success: function (data) {
            console.log(data.data);

            var dataSet = new Array();
            for (var index in data['data']) {

                var loanNumber = "<a class='best' href='javascript:showEmiDetails(\"" + data['data'][index]['id'] + "\")'>" + data['data'][index]['loanNumber'] + "</a>";

                if (!data['data'][index]['isEmi']) {
                    loanNumber = "<a class='best' href='javascript:showLoanDetails(" + data['data'][index]['loanNumber'] + ", \"" + data['data'][index]['availLoan'] + "\", \"" + data['data'][index]['id'] + "\", \"" + data['data'][index]['companyId'] + "\", \"" + data['data'][index]['branchId'] + "\")'>" + data['data'][index]['loanNumber'] + "</a>";
                }

                if (data['data'][index]['availLoan'] && data['data'][index]['availLoan'] >= minimumInterestToBePaid) {
                    dataSet.push([
                        loanNumber,
                        new Date(data['data'][index]['startDate']).format("d-M-Y"),
                        data['data'][index]['loanAmount'].format(2, 3),
                        data['data'][index]['availLoan'].format(2, 3),
                        new Date(data['data'][index]['revisedDate']).format("d-M-Y"),
                        data['data'][index]['glScheme']['schemeName'].toUpperCase(),
                    ]);
                }
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
            $("#LoanTable_wrapper .row .col-sm-6:first-child").append("<label> Online Gold Loan </label><i> (Click over the loan account no for online gold loan) </i>");
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

function showLoanDetails(loanNo, availLoan, loanId, companyId, branchId) {
    $('.spinner-search').show();
    var data = {
        loanNumber: loanNo,
        branchId: branchId,
        companyId: companyId,
        customerId: localStorage.getItem("customerId"),
        logindate: new Date().toISOString()
    }
    jQuery.ajax({
        url: SERVICE_URL + 'PgCustomGoldLoan/GetGoldLoanDetailsWeb',
        method: "POST",
        contentType: 'application/json',
        data: JSON.stringify(data),
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
        },
        error: function (xhr, status, error) {
            return false;
        },
        success: function (data) {
            GoldLoanAmount = data['data']['goldLoanAmountRemaining'];
            GoldLoanInterestDue = Math.round(data['data']['goldLoanInterestDue']);
            storesession('GetGoldLoanDetailsWeb', data['data']);
        }
    });

    AvailLoan = availLoan;
    if (parseInt(AvailLoan) > maxTopupAmount) {
        AvailLoan = maxTopupAmount;
    }
    
    LoanNo = loanId;
    CompanyId = companyId;
    BranchId = branchId;
    $("#loan_number").html(loanNo);
    $(".mainBox").after($('.loanDetails'));
    $('.loanDetails').show('slow');
    $("#minimum_amount_to_be_apply").html(minimumInterestToBePaid.format(2, 3));
    $("#total_payable_amount").html(parseInt(AvailLoan).format(2, 3));
    $('.spinner-search, .fullpayment, .partpayment').hide();
}

function storesession(tag, data) {
    var session_data = {
        tag: tag,
        data: data
    }

    return jQuery.ajax({
        url: 'storesession.php',
        method: "POST",
        contentType: 'application/json',
        data: JSON.stringify(session_data),
        error: function (xhr, status, error) {
            return false;
        },
        success: function (data) {
            return true;
        }
    });
}

function payments() {
    jQuery.ajax({
        url: 'encrypt.php',
        async: true,
        error: function (xhr, status, error) {
            console.log(error);
        },
        success: function (data) {
            console.log(data);
        }
    });
}

function axisPost(data) {
    jQuery.ajax({
        url: 'https://h2h.axisbank.co.in/RESTAdapter/AxisBank/muthootml/Pay',
        method: "POST",
        data: data,
        beforeSend: function (xhr) {
            // xhr.setRequestHeader('Authorization', 'Basic Y29ycF9tdXRob290bWw6YXhpc2NvcnBjb24x');
            xhr.setRequestHeader('Authorization', makeBaseAuth('corp_muthootml', 'axiscorpcon1'));
        },
        error: function (xhr, status, error) {
            return false;
        },
        success: function (data) {
            console.log(data);
        }
    });
}

