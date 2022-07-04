var SERVICE_URL = "https://muthootdev.azure-mobile.net/api/";
var AUTHENTICATION_PASSWORD = "JODKFspBxMyxtIrHIqVSEExBzKfGlR50";

Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

$('form input').keydown(function (e) {
    if (e.keyCode == 13) {
        e.preventDefault();
        return false;
    }
});

var loanId = null;
function makeBaseAuth(user, pswd){ 
    var token = user + ':' + pswd;
    var hash = "";
    if (btoa) {
      hash = btoa(token);
    }
    return "Basic " + hash;
}

$(function () {
    if (sessionStorage.getItem("id")) {
        getBranchDetails(sessionStorage.getItem("id"));
    } else {
        location.href = "login.html";
    }

    $('input[type="checkbox"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
    });
});

$('#closeLoan').on('click', function() {
    if ($("#closeLoan").attr("disabled") != 'disabled') {
        generateOTP(loanId, sessionStorage.getItem("id"));
        $('#myModal').modal('toggle');
    }
});

$('#transactionContinue').on('click', function() {
    confirmOTP(loanId, sessionStorage.getItem("id"), $.trim($("#otp").val()));
});

$('#branch').on('change', function() {
    getCompanyDetails(this.value);
});

$('#submit').on('click', function() {
    getLoanDeatils($('#branch').val(), $('#company').val(), $('#loan_no').val());
});

function getBranchDetails(user_id) {
    jQuery.ajax({
        url: SERVICE_URL + 'CreateGoldLoan/GetBranch?userid=' + user_id,
        contentType: 'application/json',   
        beforeSend: function (xhr) {
           xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
        },
        error: function(xhr, status, error) {
            return false;
        },
        success: function(data) {               
            for(var index in data) { 
                $('#branch').append($('<option/>', { 
                    value: data[index]['id'],
                    text : data[index]['name'] 
                }));
            }
            $('.overlay').hide();
        }
    });
}

function getCompanyDetails(branch_id) {
    jQuery.ajax({
        url: SERVICE_URL + 'CreateGoldLoan/GetBranchByCompany?branch=' + branch_id,
        contentType: 'application/json',   
        beforeSend: function (xhr) {
           xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
        },
        error: function(xhr, status, error) {
            return false;
        },
        success: function(data) {
            $('#company').html('');     
            for(var index in data) { 
                console.log();
                $('#company').append($('<option/>', { 
                    value: data[index]['companyId'],
                    text : data[index]['branchId'] 
                }));
            }
            $('.overlay').hide();
        }
    });
}

function getLoanDeatils(branch_id, company_id, loan_no) {
    $('.overlay').show();
    let url = 'CreateGoldLoan/GetGoldLoanAllDetailsByBranchCompanyLoanNo';
    url += '?branchid=' + branch_id;
    url += '&companyID=' + company_id;
    url += '&loanno=' + loan_no;
    url += '&date=' + new Date().toISOString();
    jQuery.ajax({
        url: SERVICE_URL + url,
        contentType: 'application/json',   
        beforeSend: function (xhr) {
           xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
        },
        error: function(xhr, status, error) {
            $(".callout").show();
            setTimeout(function() {  $(".callout").hide("slow");  }, 10000);   
        },
        success: function(result) {     
            $('.loanForm').trigger("reset"); 
            $("#custometImageShow").hide();
            $("#goldImageShow").hide();
            let itemdetails = "";
            $("#itemDetails").html(itemdetails);
            $("#address").html("");

            if(!result) {
                $(".callout").show();
                setTimeout(function() {  $(".callout").hide("slow");  }, 10000);   
            } else{
                $(".callout").hide();
                const data = result['data'];
            
                $("#gl_number").val(loan_no);
                $("#customerCode").val(data.glCustomer.customerCode);
                $("#schemeName").val(data.glScheme.schemeName);
                $("#ratePerGram").val(data.glScheme.ratePerGram);
                $("#currentSlabInterestRate").val(data.currentSlabInterestRate);
                $("#grossWeight").val(data.grossWeight);
                $("#netWeight").val(data.netWeight);
                $("#pawnTicketNumber").val(data.pawnTicketNumber);
                $("#pawnTicketNumber").val(data.teeCoverNo);
                $("#startDate").val(new Date(data.startDate).format("d-M-Y"));
                $("#type").val(data.type);
                $("#loanAmount").val(data.loanAmount);
                $("#name").val(data.glCustomer.firstName + ' ' + data.glCustomer.lastName);
                $("#mobile").val(data.glCustomer.mobile);
                $("#address").html(data.glCustomer.addressOne + ' ' + data.glCustomer.addressTwo);
                $("#glPawnStatus").val(data.glPawnStatusFlag.name);

                var excessamount = 0;
                if (data.excessamount) {
                    excessamount = data.excessamount;
                }
                $("#excessamount").val(excessamount);
                $("#totalLoanAmount").val(excessamount + data.loanAmount);

                if(data.photoUrl.length > 10) {
                    $("#goldImageShow").show();
                    const photoUrl = data.photoUrl.substring(
                        data.photoUrl.indexOf("\"") + 1, 
                        data.photoUrl.lastIndexOf("\"")
                    );
                    $("#photoUrl").attr('src', photoUrl);
                }
                
                if(data.glCustomer.photoUrl.length > 10) {
                    $("#custometImageShow").show();
                    const glCustomerPhotoUrl = data.glCustomer.photoUrl.substring(
                        data.glCustomer.photoUrl.indexOf("\"") + 1, 
                        data.glCustomer.photoUrl.lastIndexOf("\"")
                    );
                    $("#glCustomerPhotoUrl").attr('src', glCustomerPhotoUrl);    
                }
            
                data.glLoanDetail.forEach((item, index) => {
                    itemdetails += "<tr>";
                    itemdetails += "<td>" + (index + 1) + "</td>";
                    itemdetails += "<td>" + item.glItem.itemName + "</td>";
                    itemdetails += "<td>" + item.itemQuantity + "</td>";
                    itemdetails += "<td><input type='checkbox' style='pointer-events: none' class='minimal' " + (item.isBroken == true ? 'checked' : '') + "></td>";
                    itemdetails += "<td>" + item.glPurity.carat + "</td>";
                    itemdetails += "<td>" + item.grossWeight + "</td>";
                    itemdetails += "<td>" + (item.grossWeight - item.netWeight) + "</td>";
                    itemdetails += "<td>" + (item.grossWeight - item.netWeight) * 100 / item.grossWeight + "% </td>";
                    itemdetails += "<td>" + item.netWeight + "</td>";
                    itemdetails += "<td>" + item.glPurity.description + "</td>";
                    itemdetails += "</tr>";
                });
                $("#itemDetails").append(itemdetails);
                getGoldLoanDetailsWeb($('#branch').val(), $('#company').val(), $('#loan_no').val(), data.customerId);
                $('.overlay').hide();
            }              
        }
    });
}

function getGoldLoanDetailsWeb(branch_id, company_id, loan_no, customer_id) {
    let url = 'PgCustomGoldLoan/GetGoldLoanDetailsWeb';
    var person = {
        branchId: branch_id,
        companyId: company_id,
        customerId: customer_id,
        loanNumber: loan_no,
        logindate: new Date().toISOString()
    }
    jQuery.ajax({
        url: SERVICE_URL + url,
        contentType: 'application/json',   
        method: "POST",
        data: JSON.stringify(person),
        beforeSend: function (xhr) {
           xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
        },
        error: function(xhr, status, error) {
            $(".callout").show();
            setTimeout(function() {  $(".callout").hide("slow");  }, 10000);   
        },
        success: function(result) {     
            if (result.data) {
                goldLoanAmountRemaining = 0;
                loanId = result.data.loanId;
                if (result.data.goldLoanAmountRemaining) {
                    goldLoanAmountRemaining = result.data.goldLoanAmountRemaining;
                }
                $("#goldLoanAmountRemaining").val(goldLoanAmountRemaining);
                if (goldLoanAmountRemaining == 0 &&  $("#glPawnStatus").val() == 'OPEN' ) {
                    $("#closeLoan").attr("disabled", false);
                }
            }
        }
    });
}

function generateOTP(loanId, userId) {
    jQuery.ajax({
        url: SERVICE_URL + 'CreateGoldLoan/GlCloseOtp?loanid=' + loanId + '&userid=' + userId,
        contentType: 'application/json',   
        method: "POST",
        beforeSend: function (xhr) {
           xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
        },
        error: function(xhr, status, error) {
            return false;
        },
        success: function(data) {
            $('.overlay').hide();
        }
    });
}

function confirmOTP(loanId, userId, password) {
    jQuery.ajax({
        url: SERVICE_URL + 'CreateGoldLoan/GetGlCloseOtpConfirm?loanid=' + loanId + '&userid=' + userId + '&password=' + password,
        contentType: 'application/json',   
        beforeSend: function (xhr) {
           xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
        },
        error: function(xhr, status, error) {
            return false;
        },
        success: function(data) {
            if (data.data) {
                $('.otp-success').show();
                setTimeout(function() {  $('#myModal').modal('toggle');  }, 10000);   
            } else {
                $('.otp-error').show();
            }
        }
    });
}