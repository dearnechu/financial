Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

$(function() {
    history(null, null);
});

function history(startDate, endDate) {
    var fromDate = moment().subtract(6, 'days');
    if(startDate != null){
        fromDate = startDate;
    }

    var toDate = moment();
    if(endDate != null){
        toDate = endDate;
    }

    var person = {
        userId: localStorage.getItem("customerId"),
        currentIndex: 0,
        pageSize: 20,
        fromDate: fromDate.toISOString(),  
        toDate: toDate.toISOString(),
        //userId: "9E3A0B3B-8ABB-4C64-A13A-A7AAF30472EC"
    }

    jQuery.ajax({
        url: SERVICE_URL + 'PgCustomGoldLoan/GetPaymentHistoryByCustomerId',
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
            for(var index in data['data']['glPaymentHistoryDto']) { 
                var Amount = 0;
                if(data['data']['glPaymentHistoryDto'][index].hasOwnProperty('loanAmount')){
                    Amount = data['data']['glPaymentHistoryDto'][index]['loanAmount'];
                }

                var loanInterest = 0;
                if(data['data']['glPaymentHistoryDto'][index].hasOwnProperty('loanInterest')){
                    loanInterest = data['data']['glPaymentHistoryDto'][index]['loanInterest'];
                }
                
                Amount += loanInterest;

                var transactionNumber = data['data']['glPaymentHistoryDto'][index]['transactionNumber'];
                if(transactionNumber == 0){
                    transactionNumber = data['data']['glPaymentHistoryDto'][index]['id'];
                }

                dataSet.push([
                    transactionNumber, 
                    data['data']['glPaymentHistoryDto'][index]['loanNumber'],
                    Amount.format(2, 3),
                    new Date(data['data']['glPaymentHistoryDto'][index]['transationDate']).format("d-M-Y H:i"), 
                    data['data']['glPaymentHistoryDto'][index]['paymentType'],
                    "<a href='javascript:showLoanStatements(\""+ data['data']['glPaymentHistoryDto'][index]['loanid'] +"\")'> View </a>"
                ]);
            }

             jQuery.ajax({
                url: SERVICE_URL + 'PgCustomGoldLoan/GetEmiPaymentHistoryByCustomerId',
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
                    for(var index in data['data']['emiPaymentDto']) { 
                        var Amount = 0;
                        if(data['data']['emiPaymentDto'][index].hasOwnProperty('paidAmount')){
                            Amount = data['data']['emiPaymentDto'][index]['paidAmount'];
                        }

                        var transactionNumber = data['data']['emiPaymentDto'][index]['transactionNumber'];
                        if(transactionNumber == 0){
                            transactionNumber = data['data']['emiPaymentDto'][index]['id'];
                        }

                        dataSet.push([
                            transactionNumber, 
                            data['data']['emiPaymentDto'][index]['loanNumber'],
                            Amount.format(2, 3),
                            new Date(data['data']['emiPaymentDto'][index]['date']).format("d-M-Y H:i"), 
                            data['data']['emiPaymentDto'][index]['paymentType'],
                            "<a href='javascript:showEmiLoanStatements(\""+ data['data']['emiPaymentDto'][index]['loanId'] +"\")'> View </a>"
                        ]);
                    }

                    $('#LoanTable').DataTable( {
                        "destroy": true,
                        "pageLength" : pageCount,
                        "data": dataSet,
                        "paging": dataSet.length > pageCount,
                        "lengthChange": false,
                        "searching": true,
                        "order": [[ 3, "desc" ]],
                        //"ordering": false,
                        "columnDefs": [ {
                          "targets"  : 'no-sort',
                          "orderable": false,
                        }],
                        "info": dataSet.length > pageCount,
                        "autoWidth": false,
                        
                    });     

                    $("#LoanTable_wrapper .row .col-sm-6:first-child").append('<button class="btn btn-default" id="daterange-btn">' +
                    '<i class="fa fa-calendar"></i> Date Range ' +
                    '&nbsp;<i class="fa fa-caret-down"></i>' +
                '</button>'); 

                    //Date range as a button
                    $('#daterange-btn').daterangepicker({
                        ranges: {
                          'Today': [moment(), moment()],
                          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                          'This Month': [moment().startOf('month'), moment().endOf('month')],
                          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        },
                        startDate: fromDate,
                        endDate: toDate,
                        maxDate: moment(),
                        showDropdowns: true,
                        dateLimit: {
                            months: 6
                        }, 
                      },
                      function (start, end) {
                            $('.spinner-search').show();
                            history(start, end);
                      }
                    );    

                    $('.spinner-search').hide();
                }
            }); 
            pageCount = 5;
            
            //$("#LoanTable_wrapper .row .col-sm-6:first-child").append("<label> Payment History </label>");
        }
   });
}; 
