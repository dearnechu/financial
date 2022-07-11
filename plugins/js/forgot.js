$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });

    const captcha = new Captcha($('#canvas'),{
        width: 200,
        height: 40,
        font:'bold 23px Arial',
        length: 6
    });

        
    jQuery.ajax({
        // url: SERVICE_URL + 'GlCustomCustomer/GetAllBranches',
        url: 'connect-server.html?url=' + 'GlCustomCustomer/GetAllBranches',
        // contentType: 'application/json',   
        method: "POST",    
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

 
    $( "#SignIn" ).click(function() {        
        const ans = captcha.valid($('input[name="code"]').val());    
        if($.trim($("#mobile").val()) == ""){
            $(".mobile-group").addClass("has-error");
            $(".mobile-error").show();
            $("#mobile").focus();
            return false;;
        }     

        if(!ans) {
            $(".captcha-group").addClass("has-error");
            $(".captcha-error").show();
            return false;;
        } else {
            $(".captcha-error").hide();
            captcha.refresh();
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
            url: 'connect-server.html?url=' + 'GlCustomCustomer/ResetPassword',
            method: "POST",    
            // contentType: 'application/json',   
            data: {data: JSON.stringify(person)},                    
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
            },
            error: function(xhr, status, error) {
                $(".error-message").html("Sorry, could not able to connect the server. Please try again later");
                $(".error-message").show();
                $('.overlay').hide();
            },
            success: function(data) {
                $(".error-message").hide();
                $(".success-message").html(data.message);
                $(".success-message").show();
                $('.overlay').hide();
                /*
                    var sms_data = {
                            mobile: $.trim($("#mobile").val()),
                            message: "You have reset your password.",
                            email: data['data']['email'],
                            password: data['data']['password'],
                            template_id: '1607100000000032098'
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
                    }); */
                $('.overlay').hide();
            }
        });
    }
}
