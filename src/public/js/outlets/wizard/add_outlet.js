var avatar1 = new KTImageInput("kt_image_1");
$("#is_supplier").change(function () {
    if ($(this).prop("checked")) {
        $("#supplier_key").show();
        // fv.addField("public_key", notEmptyValidator);
        // console.log(initValidation());
    } else {
        $("#supplier_key").hide();
    }
});

function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
$("#public_key").inputmask("mask", {
    mask: "999999",
});
$('input[name="outlet_phone"]').inputmask("mask", {
    mask: "\\923999999999",
});
$('input[name="outlet_alt_phone"]').inputmask("mask", {
    mask: "\\923999999999",
});
$("#pub_key_gen").click(() => {
    let min = 100000;
    let max = 999999;
    var random = new Math.seedrandom(getRandomInt(min, max));
    $("#public_key").val(Math.abs(random.int32()));
});
