$(function() {
    var person = {
        "RECORD": {
            "PAYMENT_DETAILS": [
                {
                    "PAYMENTS": {
                        "API_VERSION": "1",
                        "CORP_CODE": "DEMOCORP",
                        "CMPY_CODE": "DEMOCORP",
                        "TXN_CRNCY": "INR",
                        "TXN_PAYMODE": "FT",
                        "CUST_UNIQ_REF": "AJAX20181112125752705464",
                        "TXN_TYPE": "VEND",
                        "TXN_AMOUNT": "200",
                        "CORP_ACC_NUM": "910020034508608",
                        "CORP_IFSC_CODE": "AXIS789087",
                        "ORIG_USERID": "DEMOCORP18",
                        "USER_DEPARTMENT": "PAYMENT",
                        "TRANSMISSION_DATE": "24-01-2019 13-57-57",
                        "BENE_CODE": "33416ae1",
                        "VALUE_DATE": "24-01-2019",
                        "RUN_IDENTIFICATION": "AXISH2H_Register27062017_4010",
                        "FILE_NAME": "AXISS2S_Register27062017_4010",
                        "BENE_NAME": "Vineet kumar singh",
                        "BENE_ACC_NUM": "31136695259",
                        "BENE_IFSC_CODE": "SBIN0007115",
                        "BENE_AC_TYPE": "SB",
                        "BENE_BANK_NAME": "SBI",
                        "BASE_CODE": "DEMOCORP",
                        "CHEQUE_NUMBER": "",
                        "CHEQUE_DATE": [],
                        "PAYABLE_LOCATION": "1",
                        "PRINT_LOCATION": "1",
                        "PRODUCT_CODE": "B",
                        "BATCH_ID": "1",
                        "BENE_ADDR_1": "ADDR1",
                        "BENE_ADDR_2": "ADDR1",
                        "BENE_ADDR_3": "ADDR1",
                        "BENE_CITY": "MUMBAI",
                        "BENE_STATE": "MAHARASTRA",
                        "BENE_PINCODE": "400601",
                        "CORP_EMAIL_ADDR": "test@axisbank.com",
                        "BENE_EMAIL_ADDR1": "test@axisbank.com",
                        "BENE_EMAIL_ADDR2": "test@axisbank.com",
                        "BENE_MOBILE_NO": "9000012545",
                        "ENRICHMENT1": "test1",
                        "ENRICHMENT2": "test1",
                        "ENRICHMENT3": "test1",
                        "ENRICHMENT4": "test1",
                        "ENRICHMENT5": "test1",
                        "STATUS_ID": "1"
                    },
                    "INVOICE": [
                        {
                            "INVOICE_NUMBER": "INVOICE122",
                            "INVOICE_DATE": "2018-01-20",
                            "NET_AMOUNT": "50",
                            "TAX": "0",
                            "CASH_DISCOUNT": "0",
                            "INVOICE_AMOUNT": "50"
                        },
                        {
                            "INVOICE_NUMBER": "INVOICE122",
                            "INVOICE_DATE": "2018-01-20",
                            "NET_AMOUNT": "50",
                            "TAX": "0",
                            "CASH_DISCOUNT": "0",
                            "INVOICE_AMOUNT": "50"
                        }
                    ]
                }
            ]
        }
    };

    jQuery.ajax({
        url: 'https://qah2h.axisbank.co.in/RESTAdapter/AxisBank/muthootml/Pay',
        contentType: 'application/json',   
        method: "POST",
        data: JSON.stringify(person),
        error: function(xhr, status, error) {
            return false;
        },
        success: function(data) {         
            console.log(data);
        }
    });

});
