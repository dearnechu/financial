Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

$(function() {
    var person = {
        userId: localStorage.getItem("customerId"),
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
               
                loanNumber = "<a class='best' href='javascript:showLoanDetails(" + data['data'][index]['loanNumber'] + ", \"" + data['data'][index]['branchId'] + "\", \"" + data['data'][index]['companyId'] + "\")'>" + data['data'][index]['loanNumber'] + "</a>";

                dataSet.push([
                    loanNumber, 
                    new Date(data['data'][index]['startDate']).format("d-M-Y"), 
                    data['data'][index]['loanAmount'].format(2, 3), 
                    new Date(data['data'][index]['revisedDate']).format("d-M-Y"), 
                    data['data'][index]['glScheme']['schemeName'].toUpperCase(),
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
            $("#LoanTable_wrapper .row .col-sm-6:first-child").append("<label> Online Payment </label><i> (Click over the loan account no for print pawn ticket) </i>");
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

    $('.remove').on('click', function () {
        $('.loanDetails').hide('slow');
    });          

});

function showLoanDetails(loanNo, branchId, companyId){ 
    $('.spinner-search').show();
    var data = {
            loanNumber: loanNo,
            branchId : branchId,
            companyId: companyId,
            startdate : new Date().toISOString()
        }
    
    jQuery.ajax({
            url: SERVICE_URL + 'PgCustomGoldLoan/GetPawnTicketDetails',
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
                $('#pawnTicketNumber').html(data.data.pawnTicketNumber);
                $('#loanNumber').html(loanNo);
                $('.loanAmount').html(data.data.loanAmount.format(2, 3));
                $('.startDate').html(new Date(data.data.revisedDate).format("d-M-Y"));
                $('#revisedDate').html(addMonths(new Date(data.data.revisedDate), 9).format("d-M-Y"));                

                $('#customerName').html(data.data.glCustomer.firstName + ' ' + data.data.glCustomer.lastName);
                $('#address').html(data.data.glCustomer.addressOne + ' ' + data.data.glCustomer.addressTwo + ' - Ph: ' + data.data.glCustomer.mobile);
              
                $('#article').html(data.data.glLoanDetail.map(x => x.glItem.itemName).join(', '));
                $('#grossWeight').html(data.data.glLoanDetail.map(x => x.grossWeight).reduce((a, b) => a + b) + ' gms');
                $('#netWeight').html(data.data.glLoanDetail.map(x => x.netWeight).reduce((a, b) => a + b) + ' gms');
                $('#carat').html(data.data.glLoanDetail.map(x => x.carat).reduce((a, b) => a + b) / data.data.glLoanDetail.length + ' Ct');
                $('.brancName').html(localStorage.getItem("location"));

                // $('#print').attr('href', 'pawn-ticket-print.php?branchid=' + branchId + '&companyId=' + companyId + '&startdate=' + new Date().toISOString() + '&loannumber=' + loanNo);
                localStorage.setItem("GetPawnTicketDetails", JSON.stringify(data.data));

                $('.loanDetails').show('slow');
                $('.spinner-search').hide();
            }
    });
}

function addMonths(date, months) {
    var d = date.getDate();
    date.setMonth(date.getMonth() + +months);
    if (date.getDate() != d) {
        date.setDate(0);
    }
    return date;
}

function getPrintData() {
    data = JSON.parse(localStorage.getItem("GetPawnTicketDetails"));
    $('.brancName').html(localStorage.getItem("location"));
    $('#pawnTicketNumber').html(data.pawnTicketNumber);
    $('#loanNumber').html(data.loanNumber);
    $('.loanAmount').html(data.loanAmount.format(2, 3));
    $('.startDate').html(new Date(data.revisedDate).format("d-M-Y"));

    $('#revisedDate').html(addMonths(new Date(data.revisedDate), 9).format("d-M-Y"));

    $('#customerName').html(data.glCustomer.firstName + ' ' + data.glCustomer.lastName);
    $('#address').html(data.glCustomer.addressOne + ' ' + data.glCustomer.addressTwo + ' - Ph: ' + data.glCustomer.mobile);

    $('#article').html(data.glLoanDetail.map(x => x.glItem.itemName).join(', '));
    $('#grossWeight').html(data.glLoanDetail.map(x => x.grossWeight).reduce((a, b) => a + b) + ' gms');
    $('#netWeight').html(data.glLoanDetail.map(x => x.netWeight).reduce((a, b) => a + b) + ' gms');
    $('#carat').html(data.glLoanDetail.map(x => x.carat).reduce((a, b) => a + b) / data.glLoanDetail.length + ' Ct');
    window.print();
}

