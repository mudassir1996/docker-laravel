<script src="https://code.jquery.com/jquery-1.12.4.min.js"
integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>


<input id="Key1" name="Key1" type="hidden" value="j2C9E7Kmvb7vKMNr">
<input id="Key2" name="Key2" type="hidden" value="8682790133301763">

<h3>Handshake</h3>
<form action="https://sandbox.bankalfalah.com/HS/HS/HS" id="HandshakeForm" method="post">
    <input id="HS_RequestHash" name="HS_RequestHash" type="hidden" value="">
    <input id="HS_IsRedirectionRequest" name="HS_IsRedirectionRequest" type="hidden" value="1">
    <input id="HS_ChannelId" name="HS_ChannelId" type="hidden" value="1001">
    <input id="HS_ReturnURL" name="HS_ReturnURL" type="hidden" value="https://www.dashboard.mgt0s.com/alfa-return">
    <input id="HS_MerchantId" name="HS_MerchantId" type="hidden" value="17262">
    <input id="HS_StoreId" name="HS_StoreId" type="hidden" value="022776">
    <input id="HS_MerchantHash" name="HS_MerchantHash" type="hidden"
        value="OUU362MB1uo4YtUNmgMoz7dclVTMbgzHadjKfqsuNXeXs1/dYsuyOQ/38LjS3WXs2fCqKPUYoH0=">
    <input id="HS_MerchantUsername" name="HS_MerchantUsername" type="hidden" value="okedip">
    <input id="HS_MerchantPassword" name="HS_MerchantPassword" type="hidden" value="nMQWHYnlJ7FvFzk4yqF7CA==">
    <input id="HS_TransactionReferenceNumber" name="HS_TransactionReferenceNumber" autocomplete="off"
        placeholder="Order ID" value="">
    <button type="submit" class="btn btn-custon-four btn-danger" id="handshake">Handshake</button>
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
