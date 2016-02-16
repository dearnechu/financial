$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
        
    if(localStorage.getItem("rememberme") == 'true'){    
        $("#email").val(localStorage.getItem("email"));
        $("#password").val(localStorage.getItem("password"));
        $("#RemeberMe").iCheck('check');
    }
    else{
        $("#email").val('');
        $("#password").val('');
        $("#RemeberMe").attr('checked', false);
    }

    $( "#SignIn" ).click(function() {            
        if($.trim($("#email").val()) == ""){
            $(".mail-group").addClass("has-error");
            $(".email-error").show();
            $("#email").focus();
            return false;;
        }            
        if($.trim($("#password").val()) == ""){
            $(".password-group").addClass("has-error");
            $(".password-error").show();
            $("#password").focus();
            return false;;
        }
        $(".loader").show();
        if($("#RemeberMe:checked").length == 1){
            localStorage.setItem("email", $.trim($("#email").val()));
            localStorage.setItem("password", $("#password").val());
            localStorage.setItem("rememberme", true);
        }
        else{
            localStorage.removeItem("email");
            localStorage.removeItem("password");
            localStorage.removeItem("rememberme");
        }
            
        var person = {
            UserName: $.trim($("#email").val()),
            Password: $.md5($("#password").val())
        }
        jQuery.ajax({
            url: SERVICE_URL + 'GlCustomCustomer/GetCustomerDetails',
            method: "POST",    
            contentType: 'application/json',   
            data: JSON.stringify(person),                    
            beforeSend: function (xhr) {
               xhr.setRequestHeader('Authorization', makeBaseAuth('', AUTHENTICATION_PASSWORD));
            },
            error: function(xhr, status, error) {
                $(".error-message").html("Sorry, could not able to connect the server. Please try again later");
                $(".error-message").show();
                $(".loader").hide();
            },
            success: function(data) {
               if(data['status'] == "1"){
                    localStorage.setItem("email", $.trim($("#email").val()));
                    localStorage.setItem("mobile", 9895933522); // need to change
                    localStorage.setItem("location", "Trivandrum"); // need to change
                    localStorage.setItem("customerName", data['data']['customerName']);
                    localStorage.setItem("customerId", data['data']['id']);
                    location.href = "home.html";
               }
               else{
                  $(".error-message").show();
                  $(".loader").hide();
               }
            }
        });

    });

    $('#email').on('keyup blur change', function(e) {
        $(".mail-group").removeClass("has-error");
        $(".email-error").hide();
    });

    $('#password').on('keyup blur change', function(e) {
        $(".password-group").removeClass("has-error");
        $(".password-error").hide();
    });

});            
