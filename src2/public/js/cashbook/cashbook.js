$("#amount").inputmask("decimal", {
    rightAlignNumerics: false,
    allowMinus: false,
});
$("#payment_date")
    .datetimepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        orientation: "bottom left",
        todayHighlight: true,
        templates: "arrows",
    })
    .on("hide", function (e) {
        e.stopPropagation();
    });
$("#cashIn").click(function () {
    $("#cashbookModal").modal("show");
    $("#transaction_type").val("0");
    $("#cashbookModalLabel").text("Cash In Entry");
});
$("#cashOut").click(function () {
    $("#cashbookModal").modal("show");
    $("#transaction_type").val("1");
    $("#cashbookModalLabel").text("Cash Out Entry");
});
$("#supplierBtn").click(function () {
    $("#supplierSelect").show();
    $("#customerSelect").hide();
    $("#supplierCustomerBtn").hide();
});
$("#customerBtn").click(function () {
    $("#supplierSelect").hide();
    $("#customerSelect").show();
    $("#supplierCustomerBtn").hide();
});
$("#supplierRemove").click(function () {
    $("#supplierSelect").hide();
    $("#supplierSelect").find(".selectpicker").selectpicker("val", "");
    $("#supplierCustomerBtn").show();
});
$("#customerRemove").click(function () {
    $("#customerSelect").hide();
    $("#customerSelect").find(".selectpicker").selectpicker("val", "");
    $("#supplierCustomerBtn").show();
});

$("#cashbookModal").on("hidden.bs.modal", function (e) {
    $("#cashbookModal").modal("hide");
    $("#cashbookForm").trigger("reset");
    $("#supplierSelect").hide();
    $("#customerSelect").hide();
    $("#supplierCustomerBtn").show();
    $(".selectpicker").selectpicker("refresh");
});
