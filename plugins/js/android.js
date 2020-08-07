$(function() {
    var person = {
        "Firstname": "Firstname",
        "lastname": "lastname",
        "Addressone": "buildingname",
        "Addresstwo": "location name",
        "email": "tyest@gtmail.com",
        "mobile": "9897665555",
        "pin": "682043",
        "idproofnumber": "425252",
        "location": "location(sharelocation)"
    };
    jQuery.ajax({
        url: SERVICE_URL + 'PgCustomGoldLoan/SubmitUserRequest',
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
            console.log(data);
        }
    });

});
