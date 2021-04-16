Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};
var minimumInterestToBePaid = 1;
var maxTopupAmount = 50000;
var AvailLoan = 0;
var AvailLoanOrg = 0;
var AvailLoanScheme = 0;
var LoanNo = null;
var LoanNumber = null; // 4 digit number
var BranchName = null;
var CompanyId = null;
var BranchId = null;
var GoldLoanAmount = null;
var GoldLoanInterestDue = 0;
var planList = null;
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
            if (!data['data']) {
                $("#NoAccountBlock").show('slow');
                $("#AccountBlock").hide();
                $("#AccountListBlock").hide();
                return false;
            }
            $("#AccountBlock").show('slow');
            $("#AccountListBlock").show('slow');
            $('#ifscCode').html(data['data']['ifscCode']);
            $('#accountNumber').html(data['data']['accountNumber']);
            $('#accountHolder').html(data['data']['accountHolder']);
            $('#bankName').html(data['data']['bank']['code'] + ', ' + data['data']['branch']);
            storesession('GetBankDetailsByCustomerId', data['data']);
            getList();
        }
    });

    storesession('customer_email', localStorage.getItem("email"));
    storesession('customer_phone', localStorage.getItem("mobile"));

    $(".close").click(function() {
        $(this).parent().parent().hide("slow");
    });

    $("#isSwitchPlan").change(function() {
        if($("#isSwitchPlan").prop("checked")) {
            $(".schemeDetails").show();
        } else {
            $(".schemeDetails").hide();
        }
        setAvailLoan();
    });

    $("#TopupPlan").change(function() {
        planUpdate();
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
                if ($("#isSwitchPlan").prop("checked")) {
                    var v2 = {
                        glLoanDto: {
                            id: LoanNo,
                            startDate: new Date().toISOString(),
                            schemeId: $("#TopupPlan").val(),
                            loanAmount: loanAmount,
                            glCustomer: {
                                mobile: localStorage.getItem("mobile"),
                            }
                        }
                    }
                } else {
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

                        var sms_data = {
                            mobile: '9895933511',
                            message: "New Pledge No " + LoanNumber + " with loan amount of Rs " + loanAmount + " created in branch " + BranchName + " Bank Amount = " + loanAmount,
                            template_id: '1607100000000031562'
                        }
                        jQuery.ajax({
                            url: 'sms.php',
                            method: "POST",    
                            contentType: 'application/json',   
                            data: JSON.stringify(sms_data),                    
                            error: function(xhr, status, error) {
                                return false;
                            },
                            success: function(data) {
                              return true;
                            }
                        });
                        
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
        url: SERVICE_URL + 'PgCustomGoldLoan/GetAmountAvailablebyCustId',
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
            var dataSet = new Array();
            for (var index in data['data']) {

                var loanNumber = "<a class='best' href='javascript:showEmiDetails(\"" + data['data'][index]['id'] + "\")'>" + data['data'][index]['loanNumber'] + "</a>";

                if (!data['data'][index]['isEmi']) {
                    loanNumber = "<a class='best' href='javascript:showLoanDetails(" + data['data'][index]['loanNumber'] + ", \"" + data['data'][index]['availLoan'] + "\", \"" + data['data'][index]['id'] + "\", \"" + data['data'][index]['companyId'] + "\", \"" + data['data'][index]['branchId'] + "\", \"" + data['data'][index]['branch']['name'] + "\")'>" + data['data'][index]['loanNumber'] + "</a>";
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

function showLoanDetails(loanNo, availLoan, loanId, companyId, branchId, branchName) {
    $('.partpayment').show();
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
            if (data['data']['goldLoanInterestDue']) {
                GoldLoanInterestDue = Math.round(data['data']['goldLoanInterestDue']);
            }
            storesession('GetGoldLoanDetailsWeb', data['data']);

            var data = {
                branchId: branchId,
                companyId: companyId,
                loanId: loanId
            };
            jQuery.ajax({
                url: SERVICE_URL + 'PgCustomGoldLoan/GetActiveSchemes',
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
                    planList = data.data;

                    $("#TopupPlan option").each(function () {
                        $(this).remove();
                    });

                    data.data.forEach(element => {
                        $('#TopupPlan').append(`<option value="${element.id}"> ${element.schemeName} </option>`); 
                    });
                    planUpdate();
                }
            });
        }
    });

    AvailLoan = availLoan;
    AvailLoanOrg = availLoan;
    if (parseInt(AvailLoan) > maxTopupAmount) {
        AvailLoan = maxTopupAmount;
    }
    
    LoanNo = loanId;
    LoanNumber = loanNo;
    BranchName = branchName;
    CompanyId = companyId;
    BranchId = branchId;
    $("#loan_number").html(loanNo);
    $(".mainBox").after($('.loanDetails'));
    $('.loanDetails').show('slow');
    $("#minimum_amount_to_be_apply").html(minimumInterestToBePaid.format(2, 3));
    // $("#total_payable_amount").html(parseInt(AvailLoan).format(2, 3));
    setAvailLoan();
}

function planUpdate() {
    $('.partpayment').show();
    var planDetails = planList.find(x => x.id == $("#TopupPlan").val());
    $("#minimumInterestPeriod").html(planDetails.minimumInterestPeriod + ' Months');
    $("#currentSlabRate").html(planDetails.currentSlabRate + '%');

    var data = {
        loanId: LoanNo,
        paymentDetailId: $("#TopupPlan").val()
    }
    jQuery.ajax({
        url: SERVICE_URL + 'PgCustomGoldLoan/GetTopAmountbySchemeid',
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
            AvailLoanScheme = data.data.availLoan;
            $("#availLoan").html(data.data.availLoan.format(2, 3));
            $('.partpayment').hide();
            setAvailLoan();
        }
    });
}

function setAvailLoan() {
    if ($("#isSwitchPlan").prop("checked")) {
        AvailLoan = AvailLoanScheme;
    } else {
        AvailLoan = AvailLoanOrg;
    }
    if (parseInt(AvailLoan) > maxTopupAmount) {
        AvailLoan = maxTopupAmount;
    }
    $("#total_payable_amount").html(parseInt(AvailLoan).format(2, 3));
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
        url: 'axis-curl.php',
        error: function (xhr, status, error) {
            console.log(error);
        },
        success: function (data) {
            console.log(data);
        }
    });
}
