$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
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
        branchId: $("#branch").val(),
        mobileNumber: $.trim($("#mobile").val()),
        captcha: $.trim($("#captcha").val()),
    }
    if($("#mobile").val().length == 10){
        $('.overlay').show();
        jQuery.ajax({
            // url: SERVICE_URL + 'GlCustomCustomer/ResetPassword',
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
                $("#captcha-img").attr("src" , "captcha.php?=" + Math.random()); 
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
