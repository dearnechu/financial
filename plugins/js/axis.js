$(function() {
    var person = {
        RECORD: {
            PAYMENT_DETAILS: [
                {
                    PAYMENTS: {
                        API_VERSION: "1.0",
                        CORP_CODE: "DEMOCORP133",
                        CMPY_CODE: "",
                        TXN_CRNCY: "INR",
                        TXN_PAYMODE: "",
                        CUST_UNIQ_REF: "AJAX20181112125752705465",
                        TXN_TYPE: "",
                        TXN_AMOUNT: "200",
                        CORP_ACC_NUM: "029010100347068",
                        CORP_IFSC_CODE: "",
                        ORIG_USERID: "",
                        USER_DEPARTMENT: "",
                        TRANSMISSION_DATE: "",
                        BENE_CODE: "33416ae1",
                        VALUE_DATE: "24-01-2019",
                        RUN_IDENTIFICATION: "",
                        FILE_NAME: "",
                        BENE_NAME: "Vineet kumar singh",
                        BENE_ACC_NUM: "31136695259",
                        BENE_IFSC_CODE: "SBIN0007115",
                        BENE_AC_TYPE: "",
                        BENE_BANK_NAME: "SBI",
                        BASE_CODE: "",
                        CHEQUE_NUMBER: "",
                        CHEQUE_DATE: "",
                        PAYABLE_LOCATION: "",
                        PRINT_LOCATION: "",
                        PRODUCT_CODE: "",
                        BATCH_ID: "1",
                        BENE_ADDR_1: "",
                        BENE_ADDR_2: "",
                        BENE_ADDR_3: "",
                        BENE_CITY: "",
                        BENE_STATE: "",
                        BENE_PINCODE: "",
                        CORP_EMAIL_ADDR: "",
                        BENE_EMAIL_ADDR1: "",
                        BENE_EMAIL_ADDR2: "",
                        BENE_MOBILE_NO: "",
                        ENRICHMENT1: "",
                        ENRICHMENT2: "",
                        ENRICHMENT3: "",
                        ENRICHMENT4: "",
                        ENRICHMENT5: "",
                        STATUS_ID: ""
                    }
                }
            ]
        }
    };

    jQuery.ajax({
        url: 'https://qah2h.axisbank.co.in/RESTAdapter/AxisBank/muthootml/Pay',
        contentType: 'application/json',   
        method: "POST",
        data: JSON.stringify(person),
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Basic Y29ycHVzZXI6YXhpc2NvcnBjb24xIQ==');
        },
        error: function(xhr, status, error) {
            return false;
        },
        success: function(data) {         
            console.log(data);
        }
    });

});
