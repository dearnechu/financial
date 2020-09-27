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
        // customerId: 'Pending', // 'In Progress'  // 'Completed'
        currentIndex: 0,
        pageSize: 20,
        fromDate: fromDate.toISOString(),  
        toDate: toDate.toISOString(),
    }

    jQuery.ajax({
        url: SERVICE_URL + 'PgCustomGoldLoan/Getusersubmitdetailsbydate',
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
            if (data['data']) {
                for (var index in data['data']['userrequestDto']) {
                    dataSet.push([
                        data['data']['userrequestDto'][index]['firstname'] + ' ' + data['data']['userrequestDto'][index]['lastname'],
                        data['data']['userrequestDto'][index]['mobile'],
                        data['data']['userrequestDto'][index]['pIn'],
                        new Date(data['data']['userrequestDto'][index]['requesteddate']).format("d-M-Y H:i"),
                        data['data']['userrequestDto'][index]['status'],
                        "<a href='javascript:showLoanStatements(\"" + data['data']['userrequestDto'][index]['id'] + "\")'> View </a>"
                    ]);
                }
    
            }
            
            pageCount = 5;
            $('#LoanTable').DataTable({
                "destroy": true,
                "pageLength": pageCount,
                "data": dataSet,
                "paging": dataSet.length > pageCount,
                "lengthChange": false,
                "searching": true,
                "order": [[3, "desc"]],
                "ordering": false,
                "columnDefs": [{
                    "targets": 'no-sort',
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
}; 
