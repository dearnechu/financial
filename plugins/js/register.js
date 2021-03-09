var customerId;
var invalidMobile = true;

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

    $( "#terms" ).on("ifClicked", function() {
        if($('#terms').prop('checked')){
            $('#SignIn').prop('disabled', true);
        }
        else{
            $('#SignIn').prop('disabled', false);
        }
    });

    $( "#SignIn" ).click(function() {            
        if(invalidMobile){
            $(".mobile-group").addClass("has-error");
            $(".mobile-error").show();
            $("#mobile").focus();
            return false;;
        }     
        if(isValidEmailAddress($("#email").val()) == false) {
            $(".mail-group").addClass("has-error");
            $(".email-error").show();
            $("#email").focus();
            return false;;
        }

         $('.overlay').show();
        
        var person = {
          "userName": $.trim($("#email").val()).toLowerCase(), 
          "customerId": customerId  
        }
        jQuery.ajax({
                url: SERVICE_URL + 'GlCustomCustomer/UserRegister',
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
                            mobile: $.trim($("#mobile").val()),
                            message: "You have registered Muthoot Online.",
                            email: $.trim($("#email").val()).toLowerCase(),
                            password: data['data']['password'],
                            template_id: '1607100000000032093'
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
                      $(".error-message").html("This email is already registered. Please contact your branch");
                      $(".error-message").show();
                      $("#email").val("");
                   }
                    $('.overlay').hide();
                }
            });

    }); // End SignIn

    $('#email').on('keyup blur change', function(e) {
        $(".mail-group").removeClass("has-error");
        $(".email-error").hide();
    });
    $('#mobile').on('keyup blur change', function(e) {
        $(".mobile-group").removeClass("has-error");
        $(".mobile-error").hide();
    });

    $("#mobile").on('keyup change', function (e) {
        mobileCheck();
    });

    $("#branch").on('change', function () {
        mobileCheck();
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
            url: SERVICE_URL + 'GlCustomCustomer/CheckUserDetails',
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
                    $("#email").val("");
                    if(data['data'].hasOwnProperty('email')){
                        $("#email").val(data['data']['email']);
                    }
                    customerId = data['data']['id'];
                    invalidMobile = false;
                    $("#email").focus();
                    $(".error-message").hide();
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
