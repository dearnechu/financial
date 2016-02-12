$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });

        
    jQuery.ajax({
        url: SERVICE_URL + 'GlCustomCustomer/GetAllBranches',
        contentType: 'application/json',   
        beforeSend: function (xhr) {
           xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
        },
        error: function(xhr, status, error) {
            return false;
        },
        success: function(data) {                    
            for(var index in data['data']) { 
                $('#branch').append($('<option/>', { 
                    value: data['data'][index]['id'],
                    text : data['data'][index]['name'] 
                }));
            }
            $('.overlay').hide();
        }
    });

 
    var customerId;

    $( "#SignIn" ).click(function() {            
        if($.trim($("#mobile").val()) == ""){
            $(".mobile-group").addClass("has-error");
            $(".mobile-error").show();
            $("#mobile").focus();
            return false;;
        }     
 
        $('.overlay').show();
        
        mobileCheck();
        

    }); // End SignIn

    $('#mobile').on('keyup blur change', function(e) {
        $(".mobile-group").removeClass("has-error");
        $(".mobile-error").hide();
    });

});

function mobileCheck(){
    var person = {
        //branchId: "318C51A0-8F6B-454F-B727-021FC6C61279",
        //mobileNumber: "9567481919",
        branchId: $("#branch").val(),
        mobileNumber: $.trim($("#mobile").val()),
    }
    if($("#mobile").val().length == 10){
        $('.overlay').show();
        jQuery.ajax({
            url: SERVICE_URL + 'GlCustomCustomer/ResetPassword',
            method: "POST",    
            contentType: 'application/json',   
            data: JSON.stringify(person),                    
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
            },
            error: function(xhr, status, error) {
                $(".error-message").html("Sorry, could not able to connect the server. Please try again later");
                $(".error-message").show();
                $('.overlay').hide();
            },
            success: function(data) {
                if(data['status'] == "1"){
                    $(".error-message").hide();
                    $(".success-message").html("We have sent an SMS to your mobile with login details. Please check it");
                    $(".success-message").show();

                    var sms_data = {
                            mobile: "9895933511",
                            password: data['data']['password']
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
                }
                else{
                    $(".success-message").hide();
                    $(".error-message").html(data['message']);
                    $(".error-message").show();
                    $("#email").val("");
                }
                $('.overlay').hide();
            }
        });
    }
}
