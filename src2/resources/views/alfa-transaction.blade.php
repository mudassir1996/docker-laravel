<script src="https://code.jquery.com/jquery-1.12.4.min.js"
integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>

<input id="Key1" name="Key1" type="hidden" value="j2C9E7Kmvb7vKMNr">
<input id="Key2" name="Key2" type="hidden" value="8682790133301763">

<h3>Page Redirection Request</h3>
<form action="https://sandbox.bankalfalah.com/SSO/SSO/SSO" id="PageRedirectionForm" method="post"
    novalidate="novalidate">
    <input id="AuthToken" name="AuthToken" type="hidden" value="{{ $auth_token }}">
    <input id="RequestHash" name="RequestHash" type="hidden" value="">
    <input id="ChannelId" name="ChannelId" type="hidden" value="1001">
    <input id="Currency" name="Currency" type="hidden" value="PKR">
    <input id="IsBIN" name="IsBIN" type="hidden" value="0">
    <input id="ReturnURL" name="ReturnURL" type="hidden" value="https://www.dashboard.mgt0s.com/alfa-return">
    <input id="MerchantId" name="MerchantId" type="hidden" value="17262">
    <input id="StoreId" name="StoreId" type="hidden" value="022776">
    <input id="MerchantHash" name="MerchantHash" type="hidden"
        value="OUU362MB1uo4YtUNmgMoz7dclVTMbgzHadjKfqsuNXeXs1/dYsuyOQ/38LjS3WXs2fCqKPUYoH0=">
    <input id="MerchantUsername" name="MerchantUsername" type="hidden" value="okedip">
    <input id="MerchantPassword" name="MerchantPassword" type="hidden" value="nMQWHYnlJ7FvFzk4yqF7CA==">
    <select autocomplete="off" id="TransactionTypeId" name="TransactionTypeId">
        <option value="">Select Transaction Type</option>
        <option value="1">Alfa Wallet</option>
        <option value="2">Alfalah Bank Account</option>
        <option value="3">Credit/Debit Card</option>
    </select>
    <input autocomplete="off" id="TransactionReferenceNumber" name="TransactionReferenceNumber" placeholder="Order ID"
        type="text" value="">
    <input autocomplete="off" id="TransactionAmount" name="TransactionAmount" placeholder="Transaction Amount"
        type="text" value="">
    <button type="submit" class="btn btn-custon-four btn-danger" id="run">RUN</button>
</form>
<script type="text/javascript">
    $(function() {

        $("#handshake").click(function(e) {
            e.preventDefault();
            $("#handshake").attr('disabled', 'disabled');
            submitRequest("HandshakeForm");
            if ($("#HS_IsRedirectionRequest").val() == "1") {
                document.getElementById("HandshakeForm").submit();
            } else {
                var myData = {
                    HS_MerchantId: $("#HS_MerchantId").val(),
                    HS_StoreId: $("#HS_StoreId").val(),
                    HS_MerchantHash: $("#HS_MerchantHash").val(),
                    HS_MerchantUsername: $("#HS_MerchantUsername").val(),
                    HS_MerchantPassword: $("#HS_MerchantPassword").val(),
                    HS_IsRedirectionRequest: $("#HS_IsRedirectionRequest").val(),
                    HS_ReturnURL: $("#HS_ReturnURL").val(),
                    HS_RequestHash: $("#HS_RequestHash").val(),
                    HS_ChannelId: $("#HS_ChannelId").val(),
                    HS_TransactionReferenceNumber: $("#HS_TransactionReferenceNumber").val(),
                }


                $.ajax({
                    type: 'POST',
                    url: 'https://sandbox.bankalfalah.com/HS/HS/HS',
                    contentType: "application/x-www-form-urlencoded",
                    data: myData,
                    dataType: "json",
                    beforeSend: function() {},
                    success: function(r) {
                        if (r != '') {
                            if (r.success == "true") {
                                $("#AuthToken").val(r.AuthToken);
                                $("#ReturnURL").val(r.ReturnURL);
                                alert('Success: Handshake Successful');
                            } else {
                                alert('Error: Handshake Unsuccessful');
                            }
                        } else {
                            alert('Error: Handshake Unsuccessful');
                        }
                    },
                    error: function(error) {
                        alert('Error: An error occurred');
                    },
                    complete: function(data) {
                        $("#handshake").removeAttr('disabled', 'disabled');
                    }
                });
            }

        });

        $("#run").click(function(e) {
            e.preventDefault();
            submitRequest("PageRedirectionForm");
            document.getElementById("PageRedirectionForm").submit();
        });
    });

    function submitRequest(formName) {

        var mapString = '',
            hashName = 'RequestHash';
        if (formName == "HandshakeForm") {
            hashName = 'HS_' + hashName;
        }

        $("#" + formName + " :input").each(function() {
            if ($(this).attr('id') != '') {
                mapString += $(this).attr('id') + '=' + $(this).val() + '&';
            }
        });

        $("#" + hashName).val(CryptoJS.AES.encrypt(CryptoJS.enc.Utf8.parse(mapString.substr(0, mapString.length - 1)),
            CryptoJS.enc.Utf8.parse($("#Key1").val()), {
                keySize: 128 / 8,
                iv: CryptoJS.enc.Utf8.parse($("#Key2").val()),
                mode: CryptoJS.mode.CBC,
                padding: CryptoJS.pad.Pkcs7
            }));
    }
</script>
